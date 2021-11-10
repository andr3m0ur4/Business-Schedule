<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\EmployeeDAO;
use Source\Models\EmployeeHourDAO;

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
            'employees' => $dao->find()->all(),
            'lastIdEmployeeHour' => (new EmployeeHourDAO())->getLastId() + 1
        ];

        // echo $this->view->render('examples/schedule', $data);
        echo $this->view->render('schedule', $data);
    }
}
