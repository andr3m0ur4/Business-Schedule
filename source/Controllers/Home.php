<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\UserDAO;
use Source\Models\Usuario;

class Home extends Controller
{
    public function index() : void
    {
        $data = [];

        $this->loadTemplate('home', $data);
    }

    public function about() : void
    {
        $this->loadTemplate('sobre', []);
    }
}
