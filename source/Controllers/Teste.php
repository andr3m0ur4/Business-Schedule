<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Administrator;
use Source\Models\AdministratorDAO;
use Source\Models\Employee;
use Source\Models\EmployeeDAO;
use Source\Models\Studio;
use Source\Models\StudioDAO;
use Source\Models\Switcher;
use Source\Models\Schedule;
use Source\Models\TvShow;
use Source\Models\EmployeeHour;
use Source\Models\TvShowHour;


class Teste extends Controller
{
    public function admin() : void
    {
        $admin = (new AdministratorDAO())->findByEmail('andre@teste.com');
        $admin->setPhone('(12) 98324-4243');

        $admins = (new AdministratorDAO())->all();

        $data = [
            'data' => $admin,
            'array' => $admins
        ];

        $this->loadTemplate('teste', $data);
    }

    public function adminInsert() : void
    {
        $administrator = new Administrator();
        $administrator->setName('Beltrano');
        $administrator->setEmail('beltrano@teste.com');
        $administrator->setPassword('123456789');
        $administrator->setPhone('(12) 98324-1111');
        $administrator->setJob('CEO');

        $administrator = (new AdministratorDAO())->save($administrator);

        print_r($administrator);
    }

    public function adminUpdate($params) : void
    {
        $administrator = new Administrator();
        $administrator->setId($params['id']);
        $administrator->setName('Rodrigo');
        $administrator->setEmail('rodrigo@teste.com');
        $administrator->setPassword('123456789');
        $administrator->setPhone('(12) 98324-7777');
        $administrator->setJob('dba');

        $administrator = (new AdministratorDAO())->save($administrator);
        
        print_r($administrator);
    }

    public function adminDelete($params) : void
    {
        $administrator = new Administrator($params['id']);
        
        $administrator = (new AdministratorDAO())->destroy($administrator);

        var_dump($administrator);
    }

    public function employee() : void
    {
        $employee = (new EmployeeDAO())->findByEmail('Ciclano@teste.com');
        $employee->setPhone('(12) 99999-9999');

        $employees = (new EmployeeDAO())->all();

        $data = [
            'data' => $employee,
            'array' => $employees
        ];

        $this->loadTemplate('teste', $data);
    }

    public function employeeInsert() : void
    {
        $employee = new Employee();
        $employee->setName('Ciclano');
        $employee->setEmail('Ciclano@teste.com');
        $employee->setPassword('123456789');
        $employee->setPhone('(12) 98324-2222');
        $employee->setJob('Funcionario');

        $employee = (new EmployeeDAO())->save($employee);

        print_r($employee);
    }

    public function employeeUpdate($params) : void
    {
        $employee = new Employee();
        $employee->setId($params['id']);
        $employee->setName('Joao');
        $employee->setEmail('Joao@teste.com');
        $employee->setPassword('123456789');
        $employee->setPhone('(12) 55555-7777');
        $employee->setJob('Audio');

        $employee = (new EmployeeDAO())->save($employee);
        
        print_r($employee);
    }

    public function employeeDelete($params) : void
    {
        $employee = new Employee($params['id']);
        
        $employee = (new EmployeeDAO())->destroy($employee);

        var_dump($employee);
    }

    public function studio() : void
    {
        $studio = (new StudioDAO())->findByName('Audio');
        $studio->setName('Video');

        $studios = (new StudioDAO())->all();

        $data = [
            'data' => $studio,
            'array' => $studios
        ];

        $this->loadTemplate('teste', $data);
    }

    public function studioInsert() : void
    {
        $studio = new Studio();
        $studio->setName('Audio');
        $studio = (new StudioDAO())->save($studio);

        print_r($studio);
    }

    public function studioUpdate($params) : void
    {
        $studio = new Studio();
        $studio->setId($params['id']);
        $studio->setName('Camera');

        $studio = (new StudioDAO())->save($studio);
        
        print_r($studio);
    }

    public function studioDelete($params) : void
    {
        $studio = new Studio($params['id']);
        
        $studio = (new StudioDAO())->destroy($studio);

        var_dump($studio);
    }


    public function switcher() : void
    {
        $studio = new Switcher();
        $studio->setId(1);
        $studio->setName('switcher 1');

        $data = [
            'data' => $studio
        ];

        $this->loadTemplate('teste', $data);
    }

    public function schedule() : void
    {
        $schedule = new Schedule();
        $schedule->setId(1);
        $schedule->setStartDate('14/08');
        $schedule->setFinalDate('15/08');
        $schedule->setYear('2021');

        $data = [
            'data' => $schedule
        ];

        $this->loadTemplate('teste', $data);
    }

    public function tv_show() : void
    {
        $tvShow = new TvShow();
        $tvShow->setId(1);
        $tvShow->setName('Santa Receita');
        $tvShow->setStartTime('13:00');
        $tvShow->setFinalTime('14:00');
        $tvShow->setDate('15');
        $tvShow->setType('Culinaria');
        $tvShow->setIdSwitcher(2);
        $tvShow->setIdStudio(3);

        $data = [
            'data' => $tvShow
        ];

        $this->loadTemplate('teste', $data);
    }

    public function employee_hour() : void
    {
        $employeeHours = new EmployeeHour();
        $employeeHours->setId(1);
        $employeeHours->setStartTime('18:00');
        $employeeHours->setFinalTime('10:00');
        $employeeHours->setDate('20');
        $employeeHours->setIdEmployee(10);
        $employeeHours->setIdSchedule(11);

        $data = [
            'data' => $employeeHours
        ];

        $this->loadTemplate('teste', $data);
    }

    public function tv_show_hour() : void
    {
        $tvShowsHours = new TvShowHour();
        $tvShowsHours->setId(1);
        $tvShowsHours->setIdTvShow(6);
        $tvShowsHours->setIdEmployeeHour(7);

        $data = [
            'data' => $tvShowsHours
        ];

        $this->loadTemplate('teste', $data);
    }
}
