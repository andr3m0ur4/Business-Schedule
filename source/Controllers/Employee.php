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

        if ($_GET) {
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRIPPED);
            $employee = $dao->findByName($name)->all();
        } else {
            $employee = $dao->find()->all();
        }

        echo $this->view->render('employee', [
            'title' => 'Business Schedule - Employee',
            'file' => 'func',
            'func' => $employee
        ]);
    }

    public function save() : void
    {
        $message = null;
        $dao = new EmployeeDAO();

        if ($_POST) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRIPPED);
            $job = filter_input(INPUT_POST, 'job', FILTER_SANITIZE_STRIPPED);

            $employee = new EmployeeModel(null, $name, $email, $password, $phone, $job);
            $dao->save($employee);
            $message = $dao->message();
        }

        echo $this->view->render('employee-save', [
            'title' => 'Business Schedule - Admin',
            'file' => 'employee',
            'message' => $message
        ]);
    }
}
