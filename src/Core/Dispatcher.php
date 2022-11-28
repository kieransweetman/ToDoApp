<?php

namespace Digi\Todoapp\Core;

use Digi\Todoapp\Controller\DefaultPageController;
use Digi\Todoapp\Controller\UserController;

// Dispatcher pour aller de page en page

class Dispatcher
{

    public function __construct()
    {
        //rajouter isset pour la connection
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'afficheprojets':
                    echo 'Page Mes projets';
                    break;
                case 'affichetaches':
                    echo 'Page Mes taches';
                    break;
                case 'CreateUpdateCompte':
                    new UserController();
                    break;
                default:
                    //page de login qui apparait par defaut
                    new DefaultPageController();
                    break;
            }
        } else {
            new DefaultPageController();
        }
    }
}
