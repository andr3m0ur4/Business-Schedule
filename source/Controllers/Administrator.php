<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Administrator as AdministratorModel;
use Source\Models\AdministratorDAO;

class Administrator extends Controller
{
    public function session() : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
        }
    }
    
    public function index() : void
    {
        session();

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
        session();

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
            'message' => $message,
            'exibirAdmin' => false
        ]);
    }

    public function update($param) : void
    {
        session();

        $message = null;
        $dao = new AdministratorDAO();

        
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
            'message' => $message,
            'exibirAdmin' => true
        ]);
    }

    public function delete($param) : void
    {
        session();

        if (isset($param['id'])) {
            $id = (int) filter_var($param['id'], FILTER_SANITIZE_STRIPPED);
            $dao = new AdministratorDAO();
            $dao->destroy($id);
            $message = $dao->message();
            session()->set('message', $message);
        }

        redirect('/admin');
    }

    public function changePassword($params) : void
    {

        
        $message = null;
        $dao = new AdministratorDAO();
        $employee = $dao->findById($params['id']);
        $error = [
            'type' => 1,
            'message' => 'Senha antiga errada'
        ];


        $oldPassword = filter_input(INPUT_POST, 'oldPassword', FILTER_SANITIZE_STRIPPED);
        $password = filter_input(INPUT_POST, 'passwordForgot', FILTER_SANITIZE_STRIPPED);
        $passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm', FILTER_SANITIZE_STRIPPED);


        if (password_verify($oldPassword, $employee->getPassword())) {
            $error['message'] = 'Senha atuais diferentes';
            
            if($password == $passwordConfirm){
                $error['message'] = 'Senha antiga igual a senha atual';

                if($oldPassword != $password){

                    $employee->setPassword($password);
                    $dao->save($employee);
                    $message = $dao->message();
                    echo($message->json());
                    return;
                
                }
            }
        }

        echo json_encode($error);        
        
    }

}
