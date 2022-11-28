<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Core\Views;
use Digi\Todoapp\Model\Projets;
use Digi\Todoapp\Model\Taches;

class ProjetController {

    public function __construct(){
        $this->AfficheProjets();
    }

    public function AfficheProjets(){
        $view = new Views('AfficheProjets','Liste des Projets');
        $projets = Projets::getAll();
        $taches = Taches::getAll();
        $view->setVar('projets',$projets);
        $view->setVar('taches',$taches);
        $view->setVar('TitrePage', 'Mes Projets');
        $view->render();
    }
}