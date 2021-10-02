<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Administrator as AdministratorModel;
use Source\Models\AdministratorDAO;

class Administrator extends Controller
{
    public function index() : void
    {
        $dao = new AdministratorDAO();
        $administrators = $dao->all();

        echo $this->view->render('admin', [
            'title' => 'Business Schedule - Admin',
            'file' => 'admin',
            'administrators' => $administrators
        ]);
    }

    public function save() : void
    {
        $message = null;
        $dao = new AdministratorDAO();

        if ($_POST) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRIPPED);

            $admin = new AdministratorModel(null, $name, $email, $password, $phone);
            $dao->save($admin);
            $message = $dao->message();
        }

        echo $this->view->render('admin-save', [
            'title' => 'Business Schedule - Admin',
            'file' => 'admin',
            'message' => $message
        ]);
    }
}
