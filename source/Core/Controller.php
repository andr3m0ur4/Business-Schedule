<?php

    namespace Source\Core;

    class Controller
    {
        public function loadView($viewName, $viewData = [])
        {
            extract($viewData);

            require __DIR__ . "/../Views/{$viewName}.php";
        }

        public function loadTemplate($viewName, $viewData = [])
        {
            require __DIR__ . '/../Views/template.php';
        }

        public function loadViewInTemplate($viewName, $viewData = [])
        {
            extract($viewData);
            
            require __DIR__ . "/../Views/{$viewName}.php";
        }
    }
