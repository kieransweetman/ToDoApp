<?php

namespace Digi\Todoapp\Core;

use Digi\Todoapp\Model\Users;

class Security {
    public static function isConnected() {
        session_start();
        if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
            return true;
        }
        session_destroy();
        return false;
    }

    public static function ConnectUser() {
        $user = $_POST['user'];
        $pwd = $_POST['pwd'];
        $searchUser = Users::getByAttribute('mail',$user);

        if ($user === $searchUser[0]->getMail() && password_verify($_POST['pwd'],$searchUser[0]->getPwd())) {
            session_start();
            $_SESSION['connected'] = true;
        }
    }
}