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
        $route->get('/admin/update/{id}', 'Teste:adminUpdate');
        $route->get('/admin/delete/{id}', 'Teste:adminDelete');

        $route->get('/employee', 'Teste:employee');
        $route->get('/employee/insert', 'Teste:employeeInsert');
        $route->get('/employee/update/{id}', 'Teste:employeeUpdate');
        $route->get('/employee/delete/{id}', 'Teste:employeeDelete');
        
        $route->get('/studio', 'Teste:studio');
        $route->get('/studio/insert', 'Teste:studioInsert');
        $route->get('/studio/update/{id}', 'Teste:studioUpdate');
        $route->get('/studio/delete/{id}', 'Teste:studioDelete');
        $route->get('/switcher', 'Teste:switcher');
        
        $route->get('/schedule', 'Teste:schedule');
        $route->get('/schedule/insert', 'Teste:scheduleInsert');
        $route->get('/schedule/update/{id}', 'Teste:scheduleUpdate');
        $route->get('/schedule/delete/{id}', 'Teste:scheduleDelete');

        $route->get('/tv_show', 'Teste:tv_show');

        $route->get('/employee_hour', 'Teste:employeeHour');
        $route->get('/employee_hour/insert', 'Teste:employeeHourInsert');
        $route->get('/employee_hour/update/{id}', 'Teste:employeeHourUpdate');
        $route->get('/employee_hour/delete/{id}', 'Teste:employeeHourDelete');

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
