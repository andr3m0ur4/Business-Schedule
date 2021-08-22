<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\UserDAO;
use Source\Models\Usuario;

class Home extends Controller
{
    public function index() : void
    {
        $data = [];

        $usuarios = (new Usuario())
            ->nome('André Moura')
            ->idade(30);

        $data = [
            'nome' => $usuarios->nome(),
            'idade' =>$usuarios->idade()
        ];
        //$data['usuarios'] = $usuarios->getAll();

        $this->loadTemplate('home', $data);
    }

    public function about() : void
    {
        $this->loadTemplate('sobre', []);
    }
}
