<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\EmployeeDAO;
use Source\Models\AdministratorDAO;

class Home extends Controller
{
    public function index() : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
        }

        $data = [
            'title' => 'Business Schedule',
            'file' => 'home',
        ];

        echo $this->view->render('home', $data);
    }

    public function signin() : void
    {
        if (session()->__get('idUser')) {
            redirect('/home');
        }

        $error = null;

        if ($_POST) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRIPPED);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            


            $employeeDao = new EmployeeDAO();
            if (!$employeeDao->login($email, $password)) {
                $error = $employeeDao->message()->getText();
            }


           

        }

        $data = [
            'title' => 'Business Schedule - Login',
            'file' => 'signin',
            'error' => $error
        ];

        echo $this->view->render('signin', $data);
    }

    public function signinAdm() : void
    {
        if (session()->__get('idUser')) {
            redirect('/home');
        }

        $error = null;

        if ($_POST) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRIPPED);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            
            $adminDao = new AdministratorDAO();
            if (!$adminDao->login($email, $password)) {

                $error = $adminDao->message()->getText();

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
        if (session()->__get('idUser')) {
            redirect('/home');
        }

        $data = [
            'title' => 'Business Schedule',
            'file' => 'signin'
        ];

        echo $this->view->render('forgot-password', $data);
    }
}
