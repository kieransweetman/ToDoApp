<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Core\Security;
use Digi\Todoapp\Core\Views;
use Digi\Todoapp\Model\Affectation;
use Digi\Todoapp\Model\Projets;
use Digi\Todoapp\Model\Taches;
use Digi\Todoapp\Model\Users;

class ProjetController {

    //Constructeur de la page ProjetController
    public function __construct(){
        if (isset($_GET['delete'])) {
            if(isset($_POST['oui'])){
                Taches::deleteByAttribute('id_projets',$_GET['delete']);
                Affectation::deleteByAttribute('id_projets',$_GET['delete']);
                Projets::deleteById((int)$_GET['delete']);
            }
            if(isset($_POST['non'])){
                //Pour recharger la page en cours et faire disparaître le form de l'affichage
                header('location: index.php?page=afficheprojets');
            }
            $this->AfficheProjets();
        }
        else{
            $this->AfficheProjets();
        }
    }

    //Page d'affichage de mes projets
    public function AfficheProjets(){
        //Création de la vue
        $view = new Views('AfficheProjets','Liste des Projets');
        //Vérification et maintien de la session, sinon retour à l'accueil
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        //On va cherchez les projets, les tâches, les users et les affectations de la base de données
        $projets = Projets::getAllOrderBy('id');
        $taches = Taches::getAllOrderBy('priorite');
        $users = Users::getAll();
        $affectations = Affectation::getAll();
        //On assigne nos résultats au tableau de setVar pour les récupérer sur la vue
        $view->setVar('projets',$projets);
        $view->setVar('taches',$taches);
        $view->setVar('users',$users);
        $view->setVar('affectations',$affectations);
        $view->setVar('TitrePage', 'Mes Projets');
        //On crée et on affiche la page
        $view->render();
    }
}