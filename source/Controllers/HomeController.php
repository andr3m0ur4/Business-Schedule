<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\UserDAO;

class HomeController extends Controller
{
    public function index() : void
    {
        $data = [];

        $usuarios = new UserDAO();
        //$data['usuarios'] = $usuarios->getAll();

        $this->loadTemplate('home', $data);
    }

    public function sobre() : void
    {
        $this->loadTemplate('sobre', []);
    }
}
