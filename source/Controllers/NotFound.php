<?php

namespace Source\Controllers;

use Source\Core\Controller;

class NotFound extends Controller
{
    public function error() : void
    {
        echo $this->view->render('404', []);
    }
}
