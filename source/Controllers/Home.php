<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\UserDAO;
use Source\Models\Usuario;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct(CONF_VIEW_PATH);
    }

    public function index() : void
    {
        $data = [
            'title' => 'Página Web',
            'content' => 'Hello World!!'
        ];

        echo $this->view->render('home', $data);
    }

    public function about() : void
    {
        $this->loadTemplate('sobre', []);
    }

    public function schedule() : void
    {
        $this->loadTemplate('escala', []);
    }
}
