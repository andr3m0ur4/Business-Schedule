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
        $route->get('/escalas', 'Home:schedule');

        /**
         * TESTS
         */
        $route->namespace('Source\Controllers');
        $route->get('/admin', 'Teste:admin');
        $route->get('/admin/insert', 'Teste:adminInsert');
        $route->get('/employee', 'Teste:employee');
        $route->get('/studio', 'Teste:studio');
        $route->get('/switcher', 'Teste:switcher');
        $route->get('/schedule', 'Teste:schedule');
        $route->get('/tv_show', 'Teste:tv_show');
        $route->get('/employee_hour', 'Teste:employee_hour');
        $route->get('/tv_show_hour', 'Teste:tv_show_hour');

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
