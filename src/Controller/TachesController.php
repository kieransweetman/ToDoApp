<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Model\Taches;
use Digi\Todoapp\Model\Users;
use Digi\Todoapp\Core\Views;
use Digi\Todoapp\Model\Projets;


class TachesController
{
    public function __construct()
    {
        $this->AffichesTaches();
    }

    public function AffichesTaches()
    {
        $view = new Views('AfficheTaches', "Mes Taches");
        $projets = Projets::getAllOrderBy('id');
        echo "<pre>";
        var_dump($projets);
        echo "</pre>";
        $taches = Taches::getAllOrderBy('priorite');
        $view->setVar('taches', $taches);
        $view->setVar('projets', $projets);
        $view->render();
    }
}

// recup le user