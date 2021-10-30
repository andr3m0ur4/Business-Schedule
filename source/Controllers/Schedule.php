<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\EmployeeDAO;

class Schedule extends Controller
{
    public function index() : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
        }

        $dao = new EmployeeDAO();

        $data = [
            'title' => 'Business Schedule - Escala',
            'file' => 'schedule',
            'employees' => $dao->find()->all()
        ];

        echo $this->view->render('schedule', $data);
    }
}
