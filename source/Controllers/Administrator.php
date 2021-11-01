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
        $message = null;

        if ($_GET) {
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRIPPED);
            $administrators = $dao->findByName($name)->all();
        } else {
            $administrators = $dao->find()->all();
        }

        if (session()->has('message')) {
            $message = session()->__get('message');
            session()->unset('message');
        }

        echo $this->view->render('admin', [
            'title' => 'Business Schedule - Admin',
            'file' => 'admin',
            'administrators' => $administrators,
            'message' => $message
        ]);
    }

    public function save($params) : void
    {
        $message = null;
        $dao = new AdministratorDAO();
        $administrator = new AdministratorModel();

        if (!empty($params)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRIPPED);

            $admin = new AdministratorModel(null, $name, $email, $password, $phone);

            if ($dao->save($admin)) {
                $admin = new AdministratorModel();
            }

            $message = $dao->message();
        }

        echo $this->view->render('admin-save', [
            'title' => 'Business Schedule - Admin',
            'file' => 'admin',
            'administrator' => $administrator,
            'message' => $message
        ]);
    }

    public function update($param) : void
    {
        $message = null;
        $dao = new AdministratorDAO();
        if (!empty($_POST)) {
            var_dump($_POST);exit;
        }
        
        if (isset($param['id']) && $param['id'] > 0) {
            $id = (int) filter_var($param['id'], FILTER_SANITIZE_STRIPPED);
            $administrator = $dao->findById($id);
        }

        if ($_POST) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRIPPED);

            if (empty($password)) {
                $password = $administrator->getPassword();
            }

            $administrator = new AdministratorModel($id, $name, $email, $password, $phone);
            
            if ($dao->save($administrator)) {
                $administrator = $dao->data();
            }

            $message = $dao->message();
        }

        echo $this->view->render('admin-save', [
            'title' => 'Business Schedule - Admin',
            'file' => 'admin',
            'administrator' => $administrator,
            'message' => $message
        ]);
    }

    public function delete($param) : void
    {
        if (isset($param['id'])) {
            $id = (int) filter_var($param['id'], FILTER_SANITIZE_STRIPPED);
            $dao = new AdministratorDAO();
            $dao->destroy($id);
            $message = $dao->message();
            session()->set('message', $message);
        }

        redirect('/admin');
    }
}
