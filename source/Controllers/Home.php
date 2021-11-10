<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\EmployeeDAO;

class Home extends Controller
{
    public function index() : void
    {
        //if (!session()->__get('idUser')) {
            //redirect('/entrar');
        //}

        $data = [
            'title' => 'Business Schedule',
            'file' => 'home'
        ];

        echo $this->view->render('home', $data);
    }

    public function signin() : void
    {
        $error = null;

        if ($_POST) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRIPPED);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            
            $dao = new EmployeeDAO();
            if (!$dao->login($email, $password)) {
                $error = $dao->message()->getText();
            }
        }

        $data = [
            'title' => 'Business Schedule - Login',
            'file' => 'signin',
            'error' => $error
        ];

        echo $this->view->render('signin', $data);
    }

    public function signout() : void
    {
        session()->destroy();
        redirect('/entrar');
    }

    public function about() : void
    {
        $this->loadTemplate('sobre', []);
    }

    public function schedule() : void
    {
        $this->loadTemplate('escala', []);
    }

    public function forgotPassword() : void
    {

        $data = [
            'title' => 'Business Schedule',
            'file' => 'signin'
        ];

        echo $this->view->render('forgot-password', $data);
    }
}
