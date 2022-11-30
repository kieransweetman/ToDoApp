<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Core\Security;
use Digi\Todoapp\Core\Validate;
use Digi\Todoapp\Core\Views;
use Digi\Todoapp\Model\Affectation;
use Digi\Todoapp\Model\Projets;
use Digi\Todoapp\Model\Taches;
use Digi\Todoapp\Model\Users;

class ProjetController
{

    //Constructeur de la page ProjetController
    public function __construct()
    {
        if (isset($_GET['delete'])) {
            $this->delProjet();
            $this->AfficheProjets();
        }

        if (isset($_GET['insert'])) {
            $this->CreateProjet();
        } else {
            $this->AfficheProjets();
        }


        $this->AfficheProjets();
    }

    public function delProjet()
    {
        if (isset($_POST['oui'])) {
            Taches::deleteByAttribute('id_projets', $_GET['delete']);
            Affectation::deleteByAttribute('id_projets', $_GET['delete']);
            Projets::deleteById((int)$_GET['delete']);
        }
        if (isset($_POST['non'])) {
            //Pour recharger la page en cours et faire disparaître le form de l'affichage
            header('location: index.php?page=afficheprojets');
        }
    }

    //Page d'affichage de mes projets
    public function AfficheProjets()
    {
        //Création de la vue
        $view = new Views('AfficheProjets', 'Liste des Projets');
        //Vérification et maintien de la session, sinon retour à l'accueil
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        //On va cherchez les projets, les tâches, les users et les affectations de la base de données
        $projets = Projets::getAllOrderBy('id');
        $taches = Taches::getAllOrderBy('priorite');
        $users = Users::getAll(); //Voir pour sortir que l'utilisateur de la session
        $affectations = Affectation::getAll();
        //On assigne nos résultats au tableau de setVar pour les récupérer sur la vue
        $view->setVar('projets', $projets);
        $view->setVar('taches', $taches);
        $view->setVar('users', $users);
        $view->setVar('affectations', $affectations);
        $view->setVar('TitrePage', 'Mes Projets');
        //On crée et on affiche la page
        $view->render();
    }

    //Page de création de projet
    public function CreateProjet()
    {
        //Création de la vue
        $view = new Views('CreateUpdateProjets', 'Création d\'un projet');
        //Vérification et maintien de la session, sinon retour à l'accueil
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        //Ajout de variables au tableau setVar pour les récupérer sur la View
        $view->setVar('TitrePage', 'Création de projet');
        $view->setVar('action', '&insert=projet');
        $view->setVar('submit', 'Créer projet');
        if (isset($_POST['create'])) {
            if (($message = $this->isValid()) === '') {
                if (Projets::create()) {
                    Affectation::createAffectation(Projets::getLastId());
                    $view->setVar('message', 'Un projet a bien été créé');
                } else {
                    $view->setVar('message', 'Une erreur est survenue!');
                }
            } else {
                $view->setVar('message', $message);
            }
            $view->setVar('libelle', $_POST['libelle']);
        }
        $view->render();
    }

    //Test de validation pour éviter les doublons de libellé
    private function isValid()
    {
        $return = '';
        $projets = Projets::getByAttribute('libelle', $_POST['libelle']);
        if (count($projets) > 0) {
            $return = "Le libellé de ce projet existe déjà";
        }
        return $return;
    }
}
