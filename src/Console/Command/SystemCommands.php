<?php

namespace Solital\Core\Console\Command;

use Solital\CustomConsole;
use Solital\Core\Console\Version;
use Solital\Core\Console\Style\Table;
use Solital\Core\Console\Style\Colors;
use Solital\Core\Console\Command\Commands;

class SystemCommands extends Commands
{
    /**
     * @var instance
     */
    private $table;

    /**
     * @var array
     */
    private array $cmd;

    /**
     * @var array
     */
    private array $desc;

    /**
     * @var array
     */
    private array $dir_cache;

    /**
     * Construct
     */
    public function __construct($debug = false)
    {
        parent::__construct($debug);

        $this->color = new Colors();
        $this->table = new Table();
        #$this->table = new Table('', true, true);
    }

    /**
     * @return bool
     */
    public function clearSession(): bool
    {
        if ($this->debug == true) {
            $msg = $this->color->stringColor("SESSION: Debug mode enabled! It is not possible to delete the sessions!", "yellow", "red", true);
            print_r($msg);

            die;
        }

        $this->dir = SITE_ROOT_VINCI . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Storage" . DIRECTORY_SEPARATOR . "session" . DIRECTORY_SEPARATOR;

        if (!is_dir($this->dir)) {
            \mkdir($this->dir);
        }

        $directory = dir($this->dir);

        while ($file = $directory->read()) {
            if (($file != '.') && ($file != '..')) {
                unlink($this->dir . $file);
            }
        }

        $directory->close();

        $msg = $this->color->stringColor("Sessions was cleared successfully!", "green", null, true);
        print_r($msg);

        return true;
    }

    /**
     * @return bool
     */
    public function clearCache(): bool
    {
        $this->dir_cache = [
            'sql',
            'wolf'
        ];

        if ($this->debug == true) {
            $msg = $this->color->stringColor("CACHE: Debug mode enabled! It is not possible to delete the cache!", "yellow", "red", true);
            print_r($msg);

            die;
        }

        foreach ($this->dir_cache as $folder) {
            $this->dir = SITE_ROOT_VINCI . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Storage" . DIRECTORY_SEPARATOR . "cache" . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

            if (!is_dir($this->dir)) {
                \mkdir($this->dir);
            }

            $directory = dir($this->dir);

            while ($file = $directory->read()) {
                if (($file != '.') && ($file != '..')) {
                    unlink($this->dir . $file);
                }
            }

            $directory->close();
        }

        $msg = $this->color->stringColor("Cache was cleared successfully!", "green", null, true);
        print_r($msg);

        return true;
    }

    /**
     * @return bool
     */
    public function version(): bool
    {
        $data = [
            [
                'solitalVersion' => Version::SOLITAL_VERSION,
                'vinciVersion' => Version::VINCI_VERSION,
                'katrinaVersion' => Version::katrinaVersion(),
                'phpVersion' => PHP_MAJOR_VERSION . "." . PHP_MINOR_VERSION . "." . PHP_RELEASE_VERSION
            ]
        ];

        $link = $this->color->stringColor("https://solital.github.io/docs-v1/", "cyan", null);
        $thanks = "Thank you for using Solital, you can see the full documentation at $link\n";

        print_r($this->color->stringColor("\nSolital framework\n", "cyan", null, true));
        print_r($this->color->stringColor($thanks, "white", null, true));

        $this->table->setTableColor('cyan');
        $this->table->setHeaderColor('cyan');
        $this->table->addField('Solital Version', 'solitalVersion', false, 'white');
        $this->table->addField('Vinci Console',  'vinciVersion', false, 'white');
        $this->table->addField('Katrina Version',  'katrinaVersion', false, 'white');
        $this->table->addField('PHP Version',  'phpVersion', false, 'white');
        $this->table->injectData($data);
        $this->table->display();

        return true;
    }

    /**
     * @return bool
     */
    public function show(): bool
    {
        $usage = $this->color->stringColor("Usage:\n", "yellow", null, true);
        $create_component = $this->color->stringColor("  php vinci [component]:[file_name]\n", "green", null, true);
        $execute_cmd = $this->color->stringColor("  php vinci [command]\n", "green", null, true);

        print_r("Below is a list of all vinci commands\n\n");
        print_r($usage);

        print_r("To create a component:\n");
        print_r($create_component);

        print_r("To run a command:\n");
        print_r($execute_cmd);

        $components_title = $this->color->stringColor("Components:\n", "yellow", null, true);
        print_r($components_title);

        $this->defaultRegisteredComponents();

        $commands_title = $this->color->stringColor("Commands:\n", "yellow", null, true);
        print_r($commands_title);

        $this->defaultRegisteredCommands();

        $custom_commands_title = $this->color->stringColor("Custom Commands:\n", "yellow", null, true);
        print_r($custom_commands_title);

        $this->defaultRegisteredCustomCommands();

        return true;
    }

    public function routes()
    {
        if (!isset($_SERVER["REQUEST_METHOD"]) && !isset($_SERVER["REQUEST_URI"])) {
            $_SERVER["REQUEST_METHOD"] = "GET";
            $_SERVER["REQUEST_URI"] = "/";
        }

        SystemCommandsCourse::start(true);
    }

    /**
     * @return SystemCommands
     */
    public function register(): SystemCommands
    {
        return $this;
    }

    /**
     * @param array $cmd
     * @param array $desc
     * 
     * @return array
     */
    public function component(array $cmd, array $desc): array
    {
        $this->cmd = $cmd;
        $this->desc = $desc;

        $values = $this->unifyValues($this->cmd, $this->desc);

        return $values;
    }

    /**
     * @param array $cmd
     * @param array $desc
     * 
     * @return array
     */
    public function command(array $cmd, array $desc): array
    {
        $this->cmd = $cmd;
        $this->desc = $desc;

        $values = $this->unifyValues($this->cmd, $this->desc);

        return $values;
    }

    /**
     * @return array
     */
    public function componentsRegistered(string $new_cmd = "", string $new_desc = ""): array
    {
        $cmd = [
            "controller",
            "model",
            "view",
            "router",
            "js",
            "css",
            "remove-controller",
            "remove-model",
            "remove-view",
            "remove-router",
            "remove-js",
            "remove-css"
        ];

        $desc = [
            "Create a new Controller",
            "Create a new Model",
            "Create a new View",
            "Create a new Router",
            "Create a new JavaScript file",
            "Create a new Cascading Style Sheet file",
            "Remove a Controller",
            "Remove a Model",
            "Remove a View",
            "Remove a Router",
            "Remove a JavaScript file",
            "Remove a Cascading Style Sheet file"
        ];

        if (!empty($cmd) && !empty($desc)) {
            array_push($cmd, $new_cmd);
            array_push($desc, $new_desc);
        }

        return [
            'cmd' => $cmd,
            'desc' => $desc
        ];
    }

    /**
     * @return array
     */
    public function commandsRegistered(): array
    {
        $cmd = [
            "version",
            "show",
            "routes",
            "cache-clear",
            "session-clear",
            "login",
            "remove-login",
            "forgot",
            "remove-forgot"
        ];

        $desc = [
            "Shows version of solital and components",
            "Lists all Vinci commands",
            "Lists all routers",
            "Clears the solital cache",
            "Clears the solital sessions",
            "Create classes for login",
            "Removes the components created for login",
            "Create classes for forgot password",
            "Removes the components created for forgot password"
        ];

        return [
            'cmd' => $cmd,
            'desc' => $desc
        ];
    }

    /**
     * @return array
     */
    public function defaultRegisteredComponents()
    {
        $values = $this->componentsRegistered();
        $components = $this->register()->component($values['cmd'], $values['desc']);

        $this->consoleTable($components);
    }

    /**
     * @return array
     */
    public function defaultRegisteredCommands()
    {
        $values = $this->commandsRegistered();
        $commands = $this->register()->command($values['cmd'], $values['desc']);

        $this->consoleTable($commands);
    }

    /**
     * @return array
     */
    public function defaultRegisteredCustomCommands()
    {
        $commands = (new CustomConsole())->execute();
        $msg = $this->color->stringColor("The custom commands below are listed along with the methods that will be executed. \n", "white", null, true);
        print_r($msg);

        $this->consoleTable($commands);
    }

    /**
     * @param array $values
     * 
     * @return SystemCommands
     */
    private function consoleTable(array $values): SystemCommands
    {
        $mask = "%30.40s %10.120s\n";

        foreach ($values as $k_comp => $comp) {
            printf($mask, "\033[32m" . $k_comp . "\033[0m", " - " . $comp . "\n");
        }

        return $this;
    }

    /**
     * @param array $array1
     * @param array $array2
     * 
     * @return array
     */
    private function unifyValues(array $array1, array $array2): array
    {
        $array_cmd = [];
        $array_desc = [];

        foreach ($this->cmd as $cmd) {
            array_push($array_cmd, $cmd);
        }

        foreach ($this->desc as $desc) {
            array_push($array_desc, $desc);
        }

        return array_combine($array1, $array2);
    }
}
