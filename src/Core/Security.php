<?php

namespace Digi\Todoapp\Core;

use Digi\Todoapp\Model\Users;

class Security
{
    public static function isConnected()
    {
        if (session_status() !== 2) {
            session_start();
        }

        if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) {
            return true;
        }
        session_destroy();
        return false;
    }

    public static function ConnectUser()
    {
        $pseudo = $_POST['pseudo'];
        $pwd = $_POST['pwd'];
        $searchUser = Users::getByAttribute('pseudo', $pseudo);

        // Gestion login password_hash
        if ($pseudo === $searchUser[0]->getPseudo() && password_verify($_POST['pwd'], $searchUser[0]->getPwd())) {
            session_start();
            $_SESSION['connected'] = true;
            $_SESSION['pseudo'] = $_POST['pseudo'];
            $_SESSION['id'] = $searchUser[0]->getId();
        }

        // Gestion login password initiaux sans hash
        if (
            $pseudo === $searchUser[0]->getPseudo() &&
            $_POST['pwd'] === $searchUser[0]->getPwd()
        ) {
            session_start();
            $_SESSION['connected'] = true;
            $_SESSION['pseudo'] = $_POST['pseudo'];
            $_SESSION['id'] = $searchUser[0]->getId();
        }
    }
}
