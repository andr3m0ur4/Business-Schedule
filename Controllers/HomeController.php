<?php

    namespace Controllers;

    use Core\Controller;
    use Models\Usuario;

    class HomeController extends Controller
    {
        public function index()
        {
            $data = [];

            // $usuarios = new Usuario();
            // $data['usuarios'] = $usuarios->getAll();

            $this->loadTemplate('home', $data);
        }
    }
