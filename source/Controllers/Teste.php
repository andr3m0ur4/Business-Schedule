<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Administrator;
use Source\Models\Employee;

class Teste extends Controller
{
    public function admin() : void
    {
        $admin = new Administrator();
        $admin->setId(1);
        $admin->setName('André');
        $admin->setEmail('andre@teste.com');
        $admin->setPassword('123');
        $admin->setJob('developer');

        $data = [
            'data' => $admin
        ];

        $this->loadTemplate('teste', $data);
    }

    public function employee() : void
    {
        $employee = new Employee();
        $employee->setId(1);
        $employee->setName('Rodrigo');
        $employee->setEmail('rodrigo@teste.com');
        $employee->setPassword('123');
        $employee->setJob('dba');

        $data = [
            'data' => $employee
        ];

        $this->loadTemplate('teste', $data);
    }

    public function studio() : void
    {
        $data = [];

        $this->loadTemplate('teste', $data);
    }

    public function switcher() : void
    {
        $data = [];
        
        $this->loadTemplate('teste', $data);
    }

    public function schedule() : void
    {
        $data = [];
        
        $this->loadTemplate('teste', $data);
    }

    public function tv_show() : void
    {
        $data = [];
        
        $this->loadTemplate('teste', $data);
    }

    public function employee_hour() : void
    {
        $data = [];
        
        $this->loadTemplate('teste', $data);
    }

    public function tv_show_hour() : void
    {
        $data = [];
        
        $this->loadTemplate('teste', $data);
    }
}
