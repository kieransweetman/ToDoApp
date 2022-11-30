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
            if (isset($_POST['oui'])) {
                Taches::deleteByAttribute('id_projets', $_GET['delete']);
                Affectation::deleteByAttribute('id_projets', $_GET['delete']);
                Projets::deleteById((int)$_GET['delete']);
            }
            if (isset($_POST['non'])) {
                //Pour recharger la page en cours et faire disparaître le form de l'affichage
                header('location: index.php?page=afficheprojets');
            }
            $this->AfficheProjets();
        }
        if (isset($_GET['insert'])) {
            $this->CreateProjet();
        } elseif (isset($_GET['update'])) {
            $this->UpdateProjet();
        } else {
            $this->AfficheProjets();
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
                    //Création et affectation au projet en administrateur
                    Affectation::createAffectation(Projets::getLastId(), $_SESSION['id'], '1');
                    $view->setVar('message', 'Un projet a bien été créé');
                    $view->setVar('action', '');
                    $view->setVar('submit', 'Retour');
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

    public function UpdateProjet()
    {
        //Création de la vue
        $view = new Views('CreateUpdateProjets', 'Modification d\'un projet');
        //Vérification et maintien de la session, sinon retour à l'accueil

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        
        //Ajout de variables au tableau setVar pour les récupérer sur la View
        $view->setVar('TitrePage', 'Modification de projet');
        $view->setVar('action', "&update=" . $_GET['update']);
        $view->setVar('submit', 'Modifier');
        $view->setvar('users',$this->AfficheUsers());
        $projet = Projets::getById($_GET['update']);
        $view->setVar('libelle', $projet[0]->getLibelle());
        if (isset($_POST['create'])) {
            if (($message = $this->isValid()) === '') {
                //Modification du nom d'un projet
                if (Projets::updateById()) {
                    $view->setVar('message', 'Un projet a été modifié');
                }
                $view->setVar('libelle', $_POST['libelle']);
            } else {
                $view->setVar('message', $message);
            }
        }
        if (($message1 = $this->isValidAddUser()) === '') {
            if (isset($_POST['pseudo'])) {
                $user = Users::getByAttribute('pseudo', $_POST['pseudo']);
                $id_user = $user[0]->getId();
                //Créer affectation à un utilisateur non admin
                if (($message1 = $this->isValidAddAdmin()) === '') {
                Affectation::createAffectation($_GET['update'], $id_user, '0');
                $view->setVar('message1', 'L\'utilisateur a bien été ajouté');
                header('location: index.php?page=afficheprojets&update='.$_GET['update']);
            }else {
                $view->setVar('message1', $message1);
            }
        }
        } else {
            $view->setVar('message1', $message1);
        }
        //Supression de l'affectation d'un utlisateur
        if(isset($_GET['deleteuser'])){
            $user = Users::getByAttribute('pseudo', $_GET['deleteuser']);
            $id_user = $user[0]->getId();
            if(isset($_GET['deleteuser'])){
                if (isset($_POST['oui'])) {
                    Affectation::deleteByTwoAttributes('id_users', $id_user, 'id_projets', $_GET['update'] );
                    //désaffectation des tâches
                    header('location: index.php?page=afficheprojets&update='.$_GET['update']);
                }
                elseif (isset($_POST['non'])) {
                    header('location: index.php?page=afficheprojets&update='.$_GET['update']);
                }
            }
        }
        $view->render();
    }

    //Affichage des utilisateurs du projets courant
    private function AfficheUsers()
    {
        $projet = $_GET['update'];
        $affectations = Affectation::getByAttribute('id_projets',$projet);
        $users = [];
        foreach($affectations as $value){
            $users[] = $value->getId_Users();
        }
        return Users::getPseudoWithId($users);
        
    }

    //Test de validation pour éviter les doublons de libellé en modification
    private function isValid()
    {
        $return = '';
        $projets = Projets::getByAttribute('libelle', $_POST['libelle']);
        $affectation = Affectation::getByAttribute('id_users', $_SESSION['id']);
        //Stock tous les id Projet ayant le meme libelle que le formulaire post dans un tableau
        $tableauLibelle=[];
        foreach ($projets as $projet){
            $tableauLibelle[] = $projet->getId();
        }
        //Stock tous les id Projet de l'utilisateur dans un tableau
        $tableauUser=[];
        foreach ($affectation as $affect){
            $tableauUser[] = $affect->getId_projets();
        }
        //Créé un troisieme tableau qui ressort les id commun entre le tableauUser et le TableaiLibelle. Et donc si il y a un libellé identique sur le compte de l'utilisateur
        $intersect = [];
        $intersect = array_intersect($tableauLibelle,$tableauUser);
        //Si le tableau intersect n'est pas vide, le libellé exite déja sur le compte de l'utilisateur et donc on montre le message d erreur du doublon
        if (count($projets) > 0 && !empty($intersect)) {
            $return = "Le libellé de ce projet existe déjà";
        }
        return $return;
    }

    private function isValidAddUser()
    {
        $return = '';
        // Validation du formulaire si le pseudo n'est pas dans la BDD 
        if (isset($_POST['pseudo'])) {
            $pseudo = Users::getByAttribute('pseudo', $_POST['pseudo']);
            if (count($pseudo) == 0) {
                $return .= "Veuillez créer l'utilisateur <a href='index.php?page=afficheprojets&update=".$_GET['update']."&adduser='>Cliquez ici<br></a><br>";
            }
        }
        return $return;
    }

    private function isValidAddAdmin()
    {
        $return = '';
        // Validation du formulaire pour qu'un admin ne puisse pas s'affecter à un projet qu'il a créé
        if (isset($_POST['pseudo'])) {
            $pseudo = Users::getByAttribute('pseudo', $_POST['pseudo']);
            $affectation = Affectation::getByAttribute('id_users', $_SESSION['id']);
            if ($pseudo[0]->getId() == $affectation[0]->getId_user()) {
                $return .= "Un admnistrateur ne peut pas être affecté à un projet";
            }
        }
        return $return;
    }
}