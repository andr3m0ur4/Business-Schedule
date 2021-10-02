<?php

namespace Source\Controllers;

use Source\Core\Controller;

class Administrator extends Controller
{
    public function index() : void
    {
        echo $this->view->render('admin');
    }
}
