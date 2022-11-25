<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Core\Views;

class ProjtectPage
{

    public function __construct()
    {
        $view = new Views('ProjectPage', 'Mes projets');
        $view->setVar('message', 'Bienvenue sur mon appli');
        $view->setVar('main', '<br>On est bien ici');
        $view->render();
    }
}
