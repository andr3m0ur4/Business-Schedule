<?php

namespace Source\Controllers;

use Source\Core\Controller;

class Administrator extends Controller
{
    public function index() : void
    {
        echo $this->view->render('admin', [
            'title' => 'Business Schedule - Admin',
            'file' => 'admin'
        ]);
    }

    public function save() : void
    {
        echo $this->view->render('admin-save', [
            'title' => 'Business Schedule - Admin'
        ]);
    }
}
