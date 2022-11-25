<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Core\Views;

class DefaultPageController
{

    public function __construct()
    {
        $view = new Views('DefaultPage', 'Accueil');
        $view->setVar('TitrePage', 'Mes Projets');
        $view->setVar('hello', 'Hello');
        $view->render();
    }
}
