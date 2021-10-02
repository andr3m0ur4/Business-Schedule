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
        $route->get('/entrar', 'Home:signin');
        $route->get('/sair', 'Home:signout');
        $route->get('/sobre', 'Home:about');
        $route->get('/escalas', 'Home:schedule');
        
        $route->post('/entrar', 'Home:signin');
        
        $route->get('/escala', 'Schedule:index');

        $route->get('/admin', 'Administrator:index');
        $route->get('/admin/novo', 'Administrator:save');
        $route->post('/admin/novo', 'Administrator:save');

        /**
         * TESTS
         */
        $route->namespace('Source\Controllers');
        $route->get('/administrator', 'Teste:admin');
        $route->get('/administrator/insert', 'Teste:adminInsert');
        $route->get('/administrator/update/{id}', 'Teste:adminUpdate');
        $route->get('/administrator/delete/{id}', 'Teste:adminDelete');

        $route->get('/employee', 'Teste:employee');
        $route->get('/employee/insert', 'Teste:employeeInsert');
        $route->get('/employee/update/{id}', 'Teste:employeeUpdate');
        $route->get('/employee/delete/{id}', 'Teste:employeeDelete');
        
        $route->get('/studio', 'Teste:studio');
        $route->get('/studio/insert', 'Teste:studioInsert');
        $route->get('/studio/update/{id}', 'Teste:studioUpdate');
        $route->get('/studio/delete/{id}', 'Teste:studioDelete');
        
        $route->get('/schedule', 'Teste:schedule');
        $route->get('/schedule/insert', 'Teste:scheduleInsert');
        $route->get('/schedule/update/{id}', 'Teste:scheduleUpdate');
        $route->get('/schedule/delete/{id}', 'Teste:scheduleDelete');

        $route->get('/switcher', 'Teste:switcher');
        $route->get('/switcher/insert', 'Teste:switcherInsert');
        $route->get('/switcher/update/{id}', 'Teste:switcherUpdate');
        $route->get('/switcher/delete/{id}', 'Teste:switcherDelete');

        $route->get('/tv_show', 'Teste:tvShow');
        $route->get('/tv_show/insert', 'Teste:tvShowInsert');
        $route->get('/tv_show/update/{id}', 'Teste:tvShowUpdate');
        $route->get('/tv_show/delete/{id}', 'Teste:tvShowDelete');

        $route->get('/employee_hour', 'Teste:employeeHour');
        $route->get('/employee_hour/insert', 'Teste:employeeHourInsert');
        $route->get('/employee_hour/update/{id}', 'Teste:employeeHourUpdate');
        $route->get('/employee_hour/delete/{id}', 'Teste:employeeHourDelete');

        $route->get('/tv_show_hour', 'Teste:tvShowHour');
        $route->get('/tv_show_hour/insert', 'Teste:tvShowHourInsert');
        $route->get('/tv_show_hour/update/{id}', 'Teste:tvShowHourUpdate');
        $route->get('/tv_show_hour/delete/{id}', 'Teste:tvShowHourDelete');
        
        $route->get('/grid', 'Teste:grid');

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
