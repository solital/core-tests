<?php

namespace Solital\Core\Security;

use Solital\Core\Resource\Session;
use Solital\Core\Database\Forgot\Forgot;
use Solital\Core\Exceptions\NotFoundException;

class Guardian
{
    /**
     * @var string
     */
    private string $table;

    /**
     * Verify login
     */
    protected static function verifyLogin()
    {
        return new static;
    }

    /**
     * @param string $table
     */
    public function table(string $table): Guardian
    {
        $this->table = $table;
        
        return $this;
    }

    /**
     * @param string $email_column
     * @param string $pass_column
     * @param string $email
     * @param string $password
     */
    protected function fields(string $email_column, string $pass_column, string $email, string $password)
    {
        $sql = "SELECT * FROM $this->table WHERE $email_column = '$email';";
        $res = (new Forgot())->queryDatabase($sql);

        if (password_verify($password, $res[$pass_column])) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * @param string $table
     * @param string $email_column
     * @param string $email
     * @return bool
     */
    public static function verifyEmail(string $table, string $email_column, string $email): bool
    {
        $sql = "SELECT * FROM $table WHERE $email_column = '$email';";
        $res = (new Forgot())->queryDatabase($sql);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $index Optional
     */
    public static function checkLogin(string $index = ''): void
    {
        if ($index == '') {
            $index = $_ENV['INDEX_LOGIN'];
        }

        self::verifyConstants();
        if (empty($_SESSION[$index])) {
            response()->redirect($_ENV['URL_LOGIN']);
            exit;
        }
    }

    /**
     * @param string $index Optional
     */
    public static function checkLogged(string $index = ''): void
    {
        if ($index == '') {
            $index = $_ENV['INDEX_LOGIN'];
        }

        self::verifyConstants();
        if (isset($_SESSION[$index])) {
            response()->redirect($_ENV['URL_DASHBOARD']);
            exit;
        }
    }

    /**
     * @param string $index Optional
     */
    protected static function validate(string $session, string $index = ''): void
    {
        if ($index == '') {
            $index = $_ENV['INDEX_LOGIN'];
        }

        self::verifyConstants();
        Session::new($index, $session);
        response()->redirect($_ENV['URL_DASHBOARD']);
        exit;
    }

    /**
     * @param string $index Optional
     * @return null
     */
    public static function logoff(string $index = ''): void
    {
        if ($index == '') {
            $index = $_ENV['INDEX_LOGIN'];
        }

        self::verifyConstants();
        Session::delete($index);
        response()->redirect($_ENV['URL_LOGIN']);
        exit;
    }

    /**
     * Checks for constants
     * @return null
     */
    private static function verifyConstants(): void
    {
        if ($_ENV['INDEX_LOGIN'] == "" || empty($_ENV['INDEX_LOGIN'])) {
            NotFoundException::notFound(404, "INDEX_LOGIN not defined", "You have not determined any 
            indexes in the INDEX_LOGIN constant. Check your 'config.php' file", "Guardian");
        }

        if ($_ENV['URL_DASHBOARD'] == "" || empty($_ENV['URL_DASHBOARD'])) {
            NotFoundException::notFound(404, "URL_DASHBOARD not defined", "You have not determined any 
            indexes in the URL_DASHBOARD constant. Check your 'config.php' file", "Guardian");
        }

        if ($_ENV['URL_LOGIN'] == "" || empty($_ENV['URL_LOGIN'])) {
            NotFoundException::notFound(404, "URL_LOGIN not defined", "You have not determined any 
            indexes in the URL_LOGIN constant. Check your 'config.php' file", "Guardian");
        }
    }
}
