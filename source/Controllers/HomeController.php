<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Usuario;

class HomeController extends Controller
{
    public function index() : void
    {
        $data = [];

        // $usuarios = new Usuario();
        // $data['usuarios'] = $usuarios->getAll();

        $this->loadTemplate('home', $data);
    }

    public function sobre() : void
    {
        $this->loadTemplate('sobre', []);
    }
}
