<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Core\Views;

class ProjtectPage
{

    public function __construct()
    {
        $view = new Views('ProjectPage', 'Accueil');
        $view->setVar('TitrePage', 'Mes Projets');
        $view->setVar('hello', 'Hello');
        $view->setVar('liste', 'Liste de mes projets');
        $view->render();
    }
}
