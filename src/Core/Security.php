<?php

namespace Digi\Todoapp\Core;

use Digi\Todoapp\Model\Users;

class Security
{
    public static function isConnected()
    {
        session_start();
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
        $searchPseudo = Users::getByAttribute('pseudo', $pseudo);

        // look into adding a cookie for user authentification 
        // and getting their login when they dont kill their own session
        // to add -> password_verify(), nous avons pas le hash pour les mot de pass encore
        if ($pseudo === $searchPseudo[0]->getPseudo() && $pwd === $searchPseudo[0]->getPwd()) {
            session_start();
            $_SESSION['connected'] = true;
        }
    }
}
