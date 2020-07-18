<?php

namespace Helpers;

use Db\User;

class Auth
{
    public static function login($username, $password)
    {
        $userDb = new User();
        $user = $userDb->getUser($username, $password);

        if ($user) {
            $_SESSION['auth'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

            return true;
        }
        return true;
    }

    public static function checkLogin()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!isset($_SESSION['auth']) || $_SESSION['ip'] != $ip) {
            return false;
        }
        return true;
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
    }
}
