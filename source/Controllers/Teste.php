<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Administrator;
use Source\Models\AdministratorDAO;
use Source\Models\Employee;
use Source\Models\Studios;
use Source\Models\Switchers;
use Source\Models\Schedules;
use Source\Models\TvShows;
use Source\Models\EmployeeHours;
use Source\Models\TvShowsHours;


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
        $administrator->setName('Ciclano');
        $administrator->setEmail('ciclano@teste.com');
        $administrator->setPassword('123456789');
        $administrator->setPhone('(12) 98324-1111');
        $administrator->setJob('programmer');

        $administrator = (new AdministratorDAO())->save($administrator);

        print_r($administrator);
    }

    public function employee() : void
    {
        $employee = new Employee();
        $employee->setId(1);
        $employee->setName('Rodrigo');
        $employee->setEmail('rodrigo@teste.com');
        $employee->setPassword('123');
        $employee->setPhone('(12) 98324-4243');
        $employee->setJob('dba');

        $data = [
            'data' => $employee
        ];

        $this->loadTemplate('teste', $data);
    }

    public function studio() : void
    {
        $studio = new Studios();
        $studio->setId(1);
        $studio->setName('estudio 1');

        $data = [
            'data' => $studio
        ];

        $this->loadTemplate('teste', $data);
    }

    public function switcher() : void
    {
        $studio = new Switchers();
        $studio->setId(1);
        $studio->setName('switcher 1');

        $data = [
            'data' => $studio
        ];

        $this->loadTemplate('teste', $data);
    }

    public function schedule() : void
    {
        $schedule = new Schedules();
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
        $tvShow = new TvShows();
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
        $employeeHours = new EmployeeHours();
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
        $tvShowsHours = new TvShowsHours();
        $tvShowsHours->setId(1);
        $tvShowsHours->setIdTvShow(6);
        $tvShowsHours->setIdEmployeeHour(7);

        $data = [
            'data' => $tvShowsHours
        ];

        $this->loadTemplate('teste', $data);
    }
}
