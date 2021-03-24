<?php

namespace Solital\Components\Controller\Auth;

use Solital\Core\Wolf\Wolf;
use Solital\Core\Security\Hash;
use Solital\Core\Security\Guardian;
use Solital\Core\Database\Forgot\Reset;
use Solital\Core\Database\Forgot\Forgot;

class ForgotController
{
    /**
     * @return void
     */
    public function forgot(): void
    {
        Guardian::checkLogged();

        Wolf::loadView('auth.forgot-form', [
            'title' => 'Forgot Password'
        ]);
    }

    /**
     * @param string $hash
     * 
     * @return void
     */
    public function change($hash): void
    {
        $res = Hash::decrypt($hash)::isValid();

        if ($res == true) {
            $email = Hash::decrypt($hash)::value();

            Wolf::loadView('auth.change-pass-form', [
                'title' => 'Change Password',
                'email' => $email,
                'hash' => $hash
            ]);
        } else {
            response()->redirect(url('login'));
        }
    }

    /**
     * @return void
     */
    public function forgotPost(): void
    {
        $email = input()->post('email')->getValue();

        $res = (new Reset())->table('tb_auth', 'username')->forgotPass($email, '/admin/change');

        if ($res == true) {
            response()->redirect(url('forgot'));
        }
    }

    /**
     * @param string $hash
     * 
     * @return void
     */
    public function changePost($hash): void
    {
        $res = Hash::decrypt($hash)::isValid();
        $email = Hash::decrypt($hash)::value();

        if ($res == true) {
            $pass = input()->post('pass')->getValue();
            $confPass = input()->post('confPass')->getValue();

            if ($pass != $confPass) {
                response()->redirect(url('change', ['hash' => $hash]));
            } else {
                echo 'enter the code that will change the password here';
            }
        } else {
            response()->redirect(url('login'));
        }
    }
}
