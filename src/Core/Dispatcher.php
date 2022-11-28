<?php

namespace Digi\Todoapp\Core;

use Digi\Todoapp\Controller\DefaultPageController;
use Digi\Todoapp\Controller\TachesController;
use Digi\Todoapp\Controller\ProjetController;
use Digi\Todoapp\Controller\UserController;

// Dispatcher pour aller de page en page

class Dispatcher
{
    public function __construct()
    {
        if (isset($_GET['session'])) {
            session_start();
            session_destroy();
            header('location: index.php');
        }
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'afficheprojets':
                    echo 'Page Mes projets';
                    new ProjetController();
                    break;
                case 'affichetaches':
                    new TachesController();
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
