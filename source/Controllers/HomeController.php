<?php

    namespace Source\Controllers;

    use Source\Core\Controller;
    use Source\Models\Usuario;

    class HomeController extends Controller
    {
        public function index()
        {
            $data = [];

            // $usuarios = new Usuario();
            // $data['usuarios'] = $usuarios->getAll();

            $this->loadTemplate('home', $data);
        }

        public function sobre()
        {
            $this->loadTemplate('sobre', []);
        }
    }
