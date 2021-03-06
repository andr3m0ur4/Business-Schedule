<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Employee as EmployeeModel;
use Source\Models\EmployeeDAO;

class Employee extends Controller
{
    public function index() : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
            
        } else if (session()->__get('level') != 2) {
            redirect('/home');
        }

        $dao = new EmployeeDAO();
        $message = null;

        $name = '';
        $pag = filter_input(INPUT_GET, 'pag', FILTER_SANITIZE_STRIPPED);

        $limit = 7;
        $current_page = intval($pag ?? 1);
        $current_page = $current_page > 0 ? $current_page : 1;
        $offset = ($current_page * $limit) - $limit;

        if (isset($_GET['name']) && !empty($_GET['name']) ) {
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRIPPED);
            $employees = $dao->findByName($name)->limit($limit)->offset($offset)->all();
            $total = $dao->countEmployee($name);

            $name = 'name=' . $_GET['name'] . '&';
        } else {
            $employees = $dao->find()->limit($limit)->offset($offset)->all();
            $total = $dao->countEmployee();

        }

        $pages = ceil($total / $limit);

        $url = "/funcionario?" . $name . "pag=";

        if (session()->has('message')) {
            $message = session()->__get('message');
            session()->unset('message');
        }

        echo $this->view->render('employee', [
            'title' => 'Business Schedule - Funcionário',
            'file' => 'employee',
            'employees' => $employees,
            'message' => $message,
            'pages' => $pages,
            'current_page' => $current_page,
            'url' => $url
        ]);
    }

    public function save($params) : void
    {

        if (!session()->__get('idUser')) {
            redirect('/entrar');
            
        } else if (session()->__get('level') != 2) {
            redirect('/home');
        }

        $message = null;
        $dao = new EmployeeDAO();
        $employee = new EmployeeModel();

        if (!empty($params)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRIPPED);
            $job = filter_input(INPUT_POST, 'job', FILTER_SANITIZE_STRIPPED);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRIPPED);

            $employee = new EmployeeModel(null, $name, $email, $password, $phone, $job, $description);

            if ($dao->save($employee)) {
                $employee = new EmployeeModel();
            }

            $message = $dao->message();
        }

        echo $this->view->render('employee-save', [
            'title' => 'Business Schedule - Funcionário',
            'file' => 'employee',
            'employee' => $employee,
            'message' => $message,
            'exibir' => false
        ]);
    }

    public function update($params) : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
            
        } else if (session()->__get('level') != 2) {
            redirect('/home');
        }

        $message = null;
        $dao = new EmployeeDAO();
        
        if (isset($params['id']) && $params['id'] > 0) {
            $id = (int) filter_var($params['id'], FILTER_SANITIZE_STRIPPED);
            $employee = $dao->findById($id);
        }
        
        if (isset($params['name'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRIPPED);
            $job = filter_input(INPUT_POST, 'job', FILTER_SANITIZE_STRIPPED);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRIPPED);

            if (empty($password)) {
                $password = $employee->getPassword();
            }
            
            $employee = new EmployeeModel($id, $name, $email, $password, $phone, $job, $description);
            
            if ($dao->save($employee)) {
                $employee = $dao->data();
            }
            
            $message = $dao->message();
        }

        echo $this->view->render('employee-save', [
            'title' => 'Business Schedule - Funcionário',
            'file' => 'employee',
            'employee' => $employee,
            'message' => $message,
            'exibir' => true
        ]);
    }

    public function delete($param) : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
            
        } else if (session()->__get('level') != 2) {
            redirect('/home');
        }
        
        if (isset($param['id'])) {
            $id = (int) filter_var($param['id'], FILTER_SANITIZE_STRIPPED);
            $dao = new EmployeeDAO();
            $dao->destroy($id);
            $message = $dao->message();
            session()->set('message', $message);
        }

        redirect('/funcionario');
    }

    public function load($param) : void
    {
        $dao = new EmployeeDAO();
        $employee = $dao->findById($param['id']);
        echo json_encode($employee);
    }

    public function changePassword($params) : void
    {

        $message = null;
        $dao = new EmployeeDAO();
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
