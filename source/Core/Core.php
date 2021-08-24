<?php

namespace Source\Core;

class Core
{
    public function run() : void
    {
        $route = new Route(url(), ':');

        /**
         * WEB ROUTES
         */
        $route->namespace('Source\Controllers');
        $route->get('/', 'Home:index');
        $route->get('/home', 'Home:index');
        $route->get('/sobre', 'Home:about');

        /**
         * TESTS
         */
        $route->namespace('Source\Controllers');
        $route->get('/admin', 'Teste:admin');
        $route->get('/employee', 'Teste:employee');

        /**
         * ERROR ROUTES
         */
        $route->namespace('Source\Controllers')->group('/ops');
        $route->get('/{errcode}', 'NotFound:error');

        /**
         * ROUTE
         */
        $route->dispatch();

        /**
         * ERROR REDIRECT
         */
        if ($route->error()) {
            $route->redirect("/ops/{$route->error()}");
        }
    }
}
