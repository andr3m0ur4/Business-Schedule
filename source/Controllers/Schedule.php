<?php

namespace Source\Controllers;

use Source\Core\Controller;

class Schedule extends Controller
{
    public function index() : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
        }

        $data = [
            'title' => 'Business Schedule - Escala',
            'file' => 'schedule'
        ];

        echo $this->view->render('schedule', $data);
    }
}
