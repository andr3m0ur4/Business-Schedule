<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Employee as EmployeeModel;
use Source\Models\EmployeeDAO;

class Employee extends Controller
{
    public function index() : void
    {
        $dao = new EmployeeDAO();
        $message = null;

        if ($_GET) {
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRIPPED);
            $employees = $dao->findByName($name)->all();
        } else {
            $employees = $dao->find()->all();
        }

        if (session()->has('message')) {
            $message = session()->__get('message');
            session()->unset('message');
        }

        echo $this->view->render('employee', [
            'title' => 'Business Schedule - Funcionário',
            'file' => 'employee',
            'employees' => $employees,
            'message' => $message
        ]);
    }

    public function save($params) : void
    {
        $message = null;
        $dao = new EmployeeDAO();
        $employee = new EmployeeModel();

        if (!empty($params)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRIPPED);
            $job = filter_input(INPUT_POST, 'job', FILTER_SANITIZE_STRIPPED);

            $employee = new EmployeeModel(null, $name, $email, $password, $phone, $job);

            if ($dao->save($employee)) {
                $employee = new EmployeeModel();
            }

            $message = $dao->message();
        }

        echo $this->view->render('employee-save', [
            'title' => 'Business Schedule - Funcionário',
            'file' => 'employee',
            'employee' => $employee,
            'message' => $message
        ]);
    }

    public function update($params) : void
    {
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
            
            if (empty($password)) {
                $password = $employee->getPassword();
            }
            
            $employee = new EmployeeModel($id, $name, $email, $password, $phone, $job);
            
            if ($dao->save($employee)) {
                $employee = $dao->data();
            }
            
            $message = $dao->message();
        }

        echo $this->view->render('employee-save', [
            'title' => 'Business Schedule - Funcionário',
            'file' => 'employee',
            'employee' => $employee,
            'message' => $message
        ]);
    }

    public function delete($param) : void
    {
        if (isset($param['id'])) {
            $id = (int) filter_var($param['id'], FILTER_SANITIZE_STRIPPED);
            $dao = new EmployeeDAO();
            $dao->destroy($id);
            $message = $dao->message();
            session()->set('message', $message);
        }

        redirect('/funcionario');
    }

<<<<<<< HEAD
    public function changePassword($params) : void
    {
        $message = null;
        $dao = new EmployeeDAO();
        $employee = new EmployeeModel();

 
        $oldPassword = filter_input(INPUT_POST, 'oldPassword', FILTER_SANITIZE_STRIPPED);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_EMAIL);
        $passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm', FILTER_SANITIZE_STRIPPED);

        echo $oldPassword;
        echo $password;
        echo $passwordConfirm;

=======
    public function load($param) : void
    {
        $dao = new EmployeeDAO();
        $employee = $dao->findById($param['id']);
        echo json_encode($employee);
>>>>>>> d0275cf62a930093eab1a563e6e2842fb68f7dec
    }
}
