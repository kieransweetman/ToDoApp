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
        $this->AffichesTaches();
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
