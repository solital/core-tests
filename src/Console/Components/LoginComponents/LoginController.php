<?php

namespace Solital\Components\Controller\Auth;

use Solital\Core\Auth\Auth;
use Solital\Core\Wolf\Wolf;
use Solital\Core\Resource\Message;

class LoginController extends Auth
{
    /**
     * Construct
     */
    public function __construct()
    {
        Auth::defineUrl(url('auth'), url('dashboard'));
        $this->message = new Message();
    }

    /**
     * @return void
     */
    public function auth(): void
    {
        Auth::isLogged();

        Wolf::loadView('auth.login', [
            'title' => 'Login',
            'msg' => $this->message->get('login')
        ]);
    }

    /**
     * @return void
     */
    public function authPost(): void
    {
        $res = Auth::login('tb_auth')
            ->columns('username', 'password')
            ->values('inputEmail', 'inputPassword')
            ->register();

        if ($res == false) {
            $this->message->new('login', 'Invalid username and/or password!');
            response()->redirect(url('auth'));
        }
    }

    /**
     * @return void
     */
    public function dashboard(): void
    {
        Auth::isNotLogged();

        Wolf::loadView('auth.dashboard', [
            'title' => 'Dashboard',
        ]);
    }

    /**
     * @return void
     */
    public function exit(): void
    {
        $this->message->new('login', 'Logoff successfully!');
        Auth::logoff();
    }
}
