<?php

namespace Source\Core;

abstract class Controller
{
    protected View $view;

    public function __construct($pathToViews = null)
    {
        if ($pathToViews instanceof Route) {
            $pathToViews = CONF_VIEW_PATH;
        }

        $this->view = new View($pathToViews);
    }

    public function loadView(string $viewName, array $viewData = []) : void
    {
        extract($viewData);

        require __DIR__ . "/../Views/{$viewName}.php";
    }

    public function loadTemplate(string $viewName, array $viewData = []) : void
    {
        require __DIR__ . '/../Views/template.php';
    }

    public function loadViewInTemplate(string $viewName, array $viewData = []) : void
    {
        extract($viewData);
        
        require __DIR__ . "/../Views/{$viewName}.php";
    }
}
