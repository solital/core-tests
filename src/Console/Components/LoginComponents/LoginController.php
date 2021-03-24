<?php

namespace Solital\Components\Controller\Auth;

use Solital\Core\Auth\Auth;
use Solital\Core\Wolf\Wolf;
use Solital\Core\Security\Guardian;

class LoginController extends Auth
{
    /**
     * Construct
     */
    public function __construct()
    {
        Guardian::checkLogin();
    }
    /**
     * @return void
     */
    public function login(): void
    {
        Guardian::checkLogged();

        Wolf::loadView('auth.login-form', [
            'title' => 'Login'
        ]);
    }

    /**
     * @return void
     */
    public function verify(): void
    {
        $res = $this->columns('username', 'pass')
            ->values('email', 'pass')
            ->register('tb_auth');

        if ($res == false) {
            response()->redirect(url('login'));
        }
    }

    /**
     * @return void
     */
    public function dashboard(): void
    {
        Wolf::loadView('auth.login-dashboard', [
            'title' => 'Dashboard',
        ]);
    }

    /**
     * @return void
     */
    public function exit(): void
    {
        Guardian::logoff();
    }
}
