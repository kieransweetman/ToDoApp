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

        if(!$searchUser){
            $message = "Ce compte n'existe pas/ Ou vous n'avez pas saisie vos identifiants correctement";
            return $message;
        }

        if(!password_verify($_POST['pwd'], $searchUser[0]->getPwd())){
            $message = "Mot de passe non valide";
            return $message;
        }

        // Gestion login password_hash
        if ($pseudo === $searchUser[0]->getPseudo() && password_verify($_POST['pwd'], $searchUser[0]->getPwd())) {
            session_start();
            $_SESSION['connected'] = true;
            $_SESSION['pseudo'] = $_POST['pseudo'];
            $_SESSION['id'] = $searchUser[0]->getId();
        }

    }
}
