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
                $data = explode('/', $_GET['insert']);
                $projet = $data[1];
                $this->createTache($projet);
            }
            if (isset($_POST['create'])) {
                Taches::create();
            }

            if (isset($_GET['update'])) {
                $idTache = $_GET['update'];
                $this->updateTache($idTache);

                if (isset($_POST['update'])) {
                    // 1. cherchez tout les taches d'un projet
                    // 2. les ordonnee par priorite
                    // 3. un algo avec le priorite change, qui boucle sur la liste des taches, et change la priorite
                    Taches::updateById();
                    echo '<meta http-equiv="refresh" content="0;URL=index.php?page=afficheprojets">';
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

    private function delTache($idTache = null)
    {
        $this->updateTache($idTache);

        if (isset($_POST['oui'])) {
            Taches::deleteById($_GET['delete']);
            echo '<meta http-equiv="refresh" content="0;URL=index.php?page=afficheprojets">';
        }
        if (isset($_POST['non'])) {
            echo '<meta http-equiv="refresh" content="0;URL=index.php?page=afficheprojets">';
        }
    }

    private function changeStatut()
    {

        if (isset($_POST['statut'])) {
            $selected = $_POST['statut'];

            $selected = explode('/', $selected);

            Taches::updateAttributeById('statut', $selected[0], $selected[1]);
        }
    }

    /**
     * Modifier et mettre à jour un tache
     *
     * @param  $idTache
     * @return void
     */
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
        $users = Affectation::getByAttribute('id_projets', $tache[0]->id_projets);


        // genere un tableau avec tout les users affecté sur un projet 
        $return = [];
        foreach ($users as $user) {
            
            $user = Users::getById($user->getId_users());
            $return[] = $user[0];
        }
        // variables

        $view->setVar('tache', $tache[0]);
        $view->setVar('TitrePage', 'Update une tâche');
        $view->setVar('users', $return);
        $view->setVar('projet', $projet[0]);
        $view->render();
    }

    private function createTache($projet_id = null)
    {
        $view = new Views('CreateUpdateTaches', 'Creez une Tâche');

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }

        $projet = Projets::getByAttribute('id', $projet_id);
        $users = Affectation::getByAttribute('id_projets', $projet_id);

        //  genere un tableau avec tout les users affecté sur un projet 
        $return = [];
        foreach ($users as $user) {
            
            $user = Users::getById($user->getId_users());
            $return[] = $user[0];
        }
        // variables

        $view->setVar('TitrePage', 'Creez une Tâche');
        $view->setVar('projet_id', $projet_id);
        $view->setVar('users', $return);
        $view->setVar('projet', $projet[0]);
        $view->render();
    }

    private function AffichesTaches()
    {
        $view = new Views('AfficheTaches', 'Mes Tâches');

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }

        $user = $_SESSION['id'];
        $projets = Projets::getAllOrderBy('id');
        $taches = Taches::getAllOrderBy('priorite');
        $affectations = Affectation::getByAttribute('id_users', $user);

        // variables
        $view->setVar('TitrePage', 'Mes Tâches');
        $view->setVar('user', $user);
        $view->setVar('affectations', $affectations);
        $view->setVar('taches', $taches);
        $view->setVar('projets', $projets);
        $view->render();
    }
}
