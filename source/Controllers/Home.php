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
            'title' => 'Business Schedule',
            'file' => 'home'
        ];

        echo $this->view->render('home', $data);
    }

    public function signin() : void
    {
        $data = [
            'title' => 'Business Schedule - Login',
            'file' => 'signin'
        ];

        echo $this->view->render('signin', $data);
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
