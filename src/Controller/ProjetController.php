<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Core\Views;
use Digi\Todoapp\Model\Projets;
use Digi\Todoapp\Model\Taches;
use Digi\Todoapp\Model\Users;

class ProjetController {

    public function __construct(){
        $this->AfficheProjets();
    }
    //Page d'affichage de mes projets
    public function AfficheProjets(){
        $view = new Views('AfficheProjets','Liste des Projets');
        $projets = Projets::getAllOrderBy('id');
        $taches = Taches::getAllOrderBy('priorite');
        $users = Users::getAll();
        $view->setVar('projets',$projets);
        $view->setVar('taches',$taches);
        $view->setVar('users',$users);
        $view->setVar('TitrePage', 'Mes Projets');
        $view->render();
    }
}