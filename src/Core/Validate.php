<?php

namespace Digi\Todoapp\Core;

class Validate
{
    public static function ValidatePseudo($pseudo, $message)
    {
        $return = '';
        $pattern = "/^([a-zA-Z0-9' -]+)$/";
        if (!preg_match($pattern, $pseudo)) {
            $return = $message;
        }
        return $return;
    }

    public static function ValidateEmail($mail)
    {
        $return = '';
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $return = 'Le mail est incorrecte<br>';
        }
        return $return;
    }

    /**
     * Fonction pour vérifier que les mots de passes sont bien remplis
     *
     * @param [string] $pwd
     * @return string
     */
    public static function verifyPassword($pwd)
    {
        $return = '';
        if ($pwd === '') {
            $return = 'Le mot de passe doit être renseigné <br>';
        }
        return $return;
    }

    /**
     * Fonction pour vérifier que le mot de passe et la confirmation sont alignés
     *
     * @param string $pwd
     * @param string $pwdConfirm
     * @return string
     */
    public static function verifyConfirmPassword($pwd, $pwdConfirm)
    {
        $return = '';
        if ($pwd !== $pwdConfirm) {
            $return = 'Le mot de passe n\'est pas le même <br>';
        }
        return $return;
    }
}
