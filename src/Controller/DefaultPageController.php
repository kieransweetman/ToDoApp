<?php

namespace Digi\Todoapp\Controller;

use Digi\Todoapp\Core\Security;
use Digi\Todoapp\Core\Views;
use Digi\Todoapp\Model\Users;

class DefaultPageController
{
    public function __construct()
    {
        $view = new Views('DefaultPage', 'Accueil');

        if (isset($_POST['submit'])) {
            $status = Security::ConnectUser();
            $view->setVar('message', $status);
        }

        if (Security::isConnected()) {
            $view->setVar('connected', true);
        } else {
            $view->setVar('connected', false);
        }

        $view->setVar('TitrePage', 'ToDoApp');
        $view->setVar('hello', 'Hello');
        $view->render();
    }
}
