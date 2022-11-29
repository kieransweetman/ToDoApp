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
        if (isset($_GET['insert'])) {
            $this->createTache();
            $data = explode("/", $_GET['insert']);
            $projet = $data[1];
            var_dump($_POST['submit']);
            return;
        }

        if (isset($_POST['submit'])) {
            $this->changeStatut();
        } else {
            $this->AffichesTaches();
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

    public function createTache($projet_id = null)
    {
        $view = new Views('CreateUpdateTaches', 'Creez un Tache');
        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            header('location: index.php');
        }
        $view->render();
        // Taches::create();
        // 'insert into "table" values(NULL, titre, priorite, statut, description, id_users, id_projets) ';
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
