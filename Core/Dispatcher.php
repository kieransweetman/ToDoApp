<?php

namespace Digi\Todoapp\Core;

use Digi\Todoapp\Controller\ProjtectPage;

// Dispatcher pour aller de page en page

class Dispatcher
{

    public function __construct()
    {
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'affichetaches':

                    break;
                case 'affichecompte':

                    break;
                default:
                    //page de login qui apparait par defaut
                    new ProjtectPage();
                    break;
            }
        } else {
            new ProjtectPage();
        }
    }
}
