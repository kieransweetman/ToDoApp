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
        if (isset($_GET['update'])) {
            $this->UpdateUser();
        } else {
            $this->createUser();
        }
    }

    // Fonction pour créer un utilisateur
    public function createUser()
    {
        $view = new Views('CreateUpdateCompte', 'Création d\'un utilisateur');
        $view->setVar('TitrePage', 'Créer mon compte');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            $view->setVar('connected', false);
        }
        //Traitement du formulaire pour créer un compte
        if (isset($_POST['submit'])) {
            if (($message = $this->isValidCreate()) === '') {
                //Suppression de SUBMIT et password confirmation du tabkeau POST
                unset($_POST['submit']);
                unset($_POST['confirmpwd']);
                //Hachage du password
                $_POST['pwd'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                //Creation du User dans la BDD
                if (Users::create()) {
                    $view->setVar('message', "L'utilisateur a bien été créé <br>");
                }
            } else {
                //Message d'erreur
                $view->setVar('message', $message);
            }
            //Affichage des valeur quand le formulaire est confirmé
            $view->setVar('pseudo', $_POST['pseudo']);
            $view->setVar('mail', $_POST['mail']);
        }
        $view->render();
    }

    // Fonction pour modifier le User
    public function UpdateUser()
    {
        $view = new Views('CreateUpdateCompte', 'Modification d\'un utilisateur');
        $view->setVar('TitrePage', 'Modifier mon compte');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
            $user = Users::getById($_GET['update']);
            $view->setVar('pseudo', $user[0]->getPseudo());
            $view->setVar('mail', $user[0]->getMail());
        } else {
            header('location: index.php');
        }
        //Traitement du formulaire pour modifier un compte
        if (isset($_POST['create'])) {
            if (($message = $this->isValidUpdate()) === '') {
                //Suppression de password confirmation et du password si il n'est pas renseigné du tabkeau POST
                unset($_POST['confirmpwd']);
                if ($_POST['pwd'] === '') {
                    unset($_POST['pwd']);
                } else {
                    //Hachage du password
                    $_POST['pwd'] = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                }
                //Modification du User dans la BDD
                if (Users::updateById()) {
                    $view->setVar('message', 'Le compte a bien été mis à jour');
                }
            } else {
                //Message d'erreur
                $view->setVar('message', $message);
            }
            //Affichage des valeur quand le formulaire est confirmé
            $view->setVar('pseudo', $_POST['pseudo']);
            $view->setVar('mail', $_POST['mail']);
        }
        $view->render();
    }

    // Fonction pour vérifier les entrées du formulaire de création d'un utilisateur
    private function isValidCreate()
    {
        $return = '';
        $return .= Validate::ValidatePseudo($_POST['pseudo'], 'Le pseudo n\'est pas valide<br>');
        $return .= Validate::ValidateEmail($_POST['mail']);
        $return .= Validate::verifyPassword($_POST['pwd']);
        $return .= Validate::verifyConfirmPassword($_POST['pwd'], $_POST['confirmpwd']);
        // Validation du formulaire si le mail n'est pas dans la BDD 
        $user = Users::getByAttribute('mail', $_POST['mail']);
        if (count($user) > 0) {
            $return .= "Le mail existe déjà<br>";
        }
        // Validation du formulaire si le pseudo n'est pas dans la BDD 
        $pseudo = Users::getByAttribute('pseudo', $_POST['pseudo']);
        if (count($pseudo) > 0) {
            $return .= "Le pseudo existe déjâ<br>";
        }
        return $return;
    }

    // Fonction pour vérifier les entrées du formulaire de modification d'un utilisateur
    private function isValidUpdate()
    {
        $return = '';
        $return .= Validate::ValidatePseudo($_POST['pseudo'], 'Le pseudo n\'est pas valide<br>');
        $return .= Validate::ValidateEmail($_POST['mail']);
        $return .= Validate::verifyConfirmPassword($_POST['pwd'], $_POST['confirmpwd']);

        // Validation du formulaire si le mail n'est pas dans la BDD sans modifier le pseudo
        $user = Users::getByAttribute('mail', $_POST['mail']);
        $doublon = Users::getById($_GET['update']);
        if (count($user) > 0  && $_POST['mail'] !== $doublon[0]->getMail()) {
            $return .= "Le mail existe déjà<br>";
        }
        // Validation du formulaire si le pseudo n'est pas dans la BDD sans modifier le mail
        $pseudo = Users::getByAttribute('pseudo', $_POST['pseudo']);
        if (count($pseudo) > 0 && $_POST['pseudo'] !== $doublon[0]->getPseudo()) {
            $return .= "Le pseudo existe déjâ<br>";
        }
        return $return;
    }
}
