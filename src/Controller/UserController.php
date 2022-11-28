<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Core\Views;
use Digi\Todoapp\Core\Security;
use Digi\Todoapp\Model\Users;
use Digi\Todoapp\Core\Validate;


class UserController
{
    public function __construct()
    {
        $this->createUser();
    }

    public function createUser()
    {
        $view = new Views('CreateUpdateCompte', 'Création d\'un utilisateur');
        $view->setVar('TitrePage', 'Créer / Modifier mon compte');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        if (isset($_POST['submit'])) {
            if (($message = $this->isValid()) === '') {
                unset($_POST['submit']);
                unset($_POST['confirmpwd']);
                $_POST['pwd'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                if (Users::create()) {
                    $view->setVar('message', "L'utilisateur a bien été créé <br>");
                }
            } else {
                $view->setVar('message', $message);
            }
            $view->setVar('pseudo', $_POST['pseudo']);
            $view->setVar('mail', $_POST['mail']);
        }

        $view->render();
    }

    private function isValid()
    {
        $return = '';
        $return .= Validate::ValidatePseudo($_POST['pseudo'], 'Le pseudo ne doit pas contenir de caractères speciaux<br>');
        $return .= Validate::ValidateEmail($_POST['mail']);
        $return .= Validate::verifyPassword($_POST['pwd']);
        $return .= Validate::verifyConfirmPassword($_POST['pwd'], $_POST['confirmpwd']);
        $user = Users::getByAttribute('mail', $_POST['mail']);
        if (count($user) > 0) {
            $return .= "L'utilisateur existe déjà<br>";
        }
        $pseudo = Users::getByAttribute('pseudo', $_POST['pseudo']);
        if (count($pseudo) > 0) {
            $return .= "Le pseudo existe déjâ<br>";
        }
        return $return;
    }
}
