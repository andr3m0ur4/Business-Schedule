<?php

    namespace Source\Controllers;

    use Source\Core\Controller;

    class NotFoundController extends Controller
    {
        public function index()
        {
            $this->loadView('404', []);
        }
    }
