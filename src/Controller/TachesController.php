<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Model\Taches;
use Digi\Todoapp\Model\Users;
use Digi\Todoapp\Core\Security;
use Digi\Todoapp\Core\Views;
use Digi\Todoapp\Model\Affectation;
use Digi\Todoapp\Model\Projets;

class TachesController
{
    public function __construct()
    {

        if ($_GET['page'] === 'CreateUpdateTache') {
            if (isset($_GET['insert'])) {
                $data = explode("/", $_GET['insert']);
                $projet = $data[1];
                $this->createTache($projet);
            }
            if (isset($_POST['create'])) {

                Taches::create();
                var_dump($_POST);
            
            }
            if (isset($_GET['update'])) {
                $idTache = $_GET['update'];
                $this->updateTache($idTache);

                if (isset($_POST['update'])) {
                    $idTache = $_GET['update'];
                    $tache = Taches::getById($idTache);
                    $projetId = $tache[0]->id_projets;
                    $this->prioriteCheck($tache[0]->getPriorite(),$_POST["priorite"], $projetId);
                    // Taches::updateById();
                    // return  header("Refresh:0; url=index.php?page=CreateUpdateTache&update=$idTache");
                    return;
                }
            }
            if (isset($_GET['delete'])) {
                $idTache = $_GET['delete'];
                $this->delTache($idTache);
            }
        }

        if ($_GET['page'] === 'affichetaches') {

            if (isset($_POST['submit'])) {
                $this->changeStatut();
                $this->AffichesTaches();
                return;
            } else {
                $this->AffichesTaches();
                return;
            }
        }
    }

    private function prioriteCheck($currentPriorite = null, $newPriorite = null, $projet_id)
    {
        $return = [];
        $taches = Taches::getByAttribute('id_projets', $projet_id);
        foreach ($taches as $tache) {
            $return += [$tache->getId()=>$tache->getPriorite()];
        }
        foreach ($return as $id => $priorite) {
            if ($newPriorite > $currentPriorite) {
                if ($newPriorite == $priorite) {
                   $return[$id] -= 1;
                } elseif ($currentPriorite == $priorite){
                    $return[$id] = $newPriorite;
                }

            } 
            if ($newPriorite < $currentPriorite) {
                if ($newPriorite <= $priorite) {
                    echo $priorite;
                    echo $id;
                    $return[$id] += 1;
                 } elseif ($currentPriorite == $priorite){
                     $return[$id] = $newPriorite;
                 }
            }
        }
        var_dump($return);
    }

    private function changePriorite($taches = null)
    {
        foreach ($taches as $id => $priorite) {
            Taches::updateAttributeById('priorite', $priorite, $id);
        }
    }

    private function delTache($idTache = null)
    {
        $this->updateTache($idTache);

        if (isset($_POST['oui'])) {
            Taches::deleteById($_GET['delete']);
            header('refresh:0; url=index.php?page=afficheprojets');
        }
        if (isset($_POST['non'])) {

            header('location: index.php?page=afficheprojets');
        }
    }

    private function changeStatut()
    {
        if (isset($_POST['statut'])) {
            $selected = $_POST['statut'];
            $selected = explode("/", $selected);
            Taches::updateAttributeById('statut', $selected[0], $selected[1]);
        }
    }

    private function updateTache($idTache = null)
    {
        $view = new Views('CreateUpdateTaches', 'Update Tache');
        $idTache = intVal($idTache);

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }


        $tache = Taches::getByAttribute('id', $idTache);
        $projet = Projets::getByAttribute('id', $tache[0]->id_projets);

        // $view->setVar("projet", $projet);


        $users = Affectation::getByAttribute('id_projets', $tache[0]->id_projets);
        $return = [];

        foreach ($users as $user) {
            $user = Users::getById($user->getId_users());
            $return[] = $user[0];
        }


        $view->setVar('tache', $tache[0]);
        $view->setVar('TitrePage', "Update un tache");
        $view->setVar('users', $return);
        $view->setVar('projet', $projet[0]);
        $view->render();
    }

    private function createTache($projet_id = null)
    {
        $view = new Views('CreateUpdateTaches', 'Creez un Tache');

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }

        $projet = Projets::getByAttribute('id', $projet_id);
        $users = Affectation::getByAttribute('id_projets', $projet_id);

        //retourne la liste des users qui sont affecté au projet
        $return = [];

        foreach ($users as $user) {
            $user = Users::getById($user->getId_users());
            $return[] = $user[0];
        }
        // variables

        $view->setVar('TitrePage', "Creez un Tache");
        $view->setVar("projet_id", $projet_id);
        $view->setVar('users', $return);
        $view->setVar('projet', $projet[0]);
        $view->render();
    }


    private function AffichesTaches()
    {
        $view = new Views('AfficheTaches', 'Mes Taches');

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }


        $user = $_SESSION['id'];
        $projets = Projets::getAllOrderBy('id');
        $taches = Taches::getAllOrderBy('priorite');
        $affectiations = Affectation::getByAttribute('id_users', $user);


        // variables
        $view->setVar("TitrePage", "Mes Taches");
        $view->setVar('user', $user);
        $view->setVar('affectations', $affectiations);
        $view->setVar('taches', $taches);
        $view->setVar('projets', $projets);
        $view->render();
    }
}
