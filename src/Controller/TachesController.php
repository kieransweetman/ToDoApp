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
            }

            if (isset($_GET['update'])) {
                $projet = substr($_GET['update'], -1);


                $this->updateTache($projet);
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

    private function changeStatut()
    {
        if (isset($_POST['statut'])) {
            $selected = $_POST['statut'];
            $selected = explode("/", $selected);
            Taches::updateAttributeById('statut', $selected[0], $selected[1]);
        }
    }

    private function updateTache($projet_id = null)
    {
        $view = new Views('CreateUpdateTaches', 'Update Tache');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->setVar("projet_id", $projet_id);
        if ($projet_id != null) {
            $projet_id = intval($projet_id);
        }
        $projet = Projets::getByAttribute('id', $projet_id);

        $view->setVar('TitrePage', "Update un tache");
        $users = Affectation::getByAttribute('id_projets', $projet_id);
        $return = [];

        foreach ($users as $user) {
            $user = Users::getById($user->getId_users());
            $return[] = $user[0];
        }

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
        $view->setVar("projet_id", $projet_id);

        $projet = Projets::getByAttribute('id', $projet_id);
        $view->setVar('TitrePage', "Creez un Tache");
        $users = Affectation::getByAttribute('id_projets', $projet_id);
        $return = [];

        foreach ($users as $user) {
            $user = Users::getById($user->getId_users());
            $return[] = $user[0];
        }

        $view->setVar('users', $return);
        $view->setVar('projet', $projet[0]);
        $view->render();
    }


    private function AffichesTaches()
    {
        $view = new Views('AfficheTaches', 'Mes Taches');
        $view->setVar("TitrePage", "Mes Taches");

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }


        $projets = Projets::getAllOrderBy('id');
        $taches = Taches::getAllOrderBy('priorite');
        $user = $_SESSION['id'];
        $projs = Affectation::getByAttribute('id_users', $user);

        $view->setVar('user', $user);
        $view->setVar('projs', $projs);
        $view->setVar('taches', $taches);
        $view->setVar('projets', $projets);
        $view->render();
    }
}
