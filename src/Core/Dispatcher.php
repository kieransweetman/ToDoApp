<?php

namespace Digi\Todoapp\Core;

use Digi\Todoapp\Controller\ProjectPage;

// Dispatcher pour aller de page en page

class Dispatcher
{

    public function __construct()
    {
        //rajouter isset pour la connection
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'affichetaches':
                    echo 'Page Mes taches';
                    break;
                case 'affichecompte':
                    echo 'Page mon compte';
                    break;
                default:
                    //page de login qui apparait par defaut
                    new ProjectPage();
                    break;
            }
        } else {
            new ProjectPage();
        }
    }
}
