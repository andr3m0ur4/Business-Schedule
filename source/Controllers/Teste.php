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
use Source\Models\SwitcherDAO;
use Source\Models\Schedule;
use Source\Models\TvShow;
use Source\Models\EmployeeHour;
use Source\Models\EmployeeHourDAO;
use Source\Models\ScheduleDAO;
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
        $employee->setPhone('(12) 98324-3333');
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
        $employee->setPhone('(12) 55555-3333');
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
        $switcher = (new SwitcherDAO())->findByName('Switcher 1');
        $switcher->setName('Switcher 22');

        $switchers = (new SwitcherDAO())->all();

        $data = [
            'data' => $switcher,
            'array' => $switchers
        ];

        $this->loadTemplate('teste', $data);
    }

    public function switcherInsert() : void
    {
        $switcher = new Switcher();
        $switcher->setName('Switcher 1');
        $switcher = (new SwitcherDAO())->save($switcher);

        print_r($switcher);
    }

    public function switcherUpdate($params) : void
    {
        $switcher = new Switcher();
        $switcher->setId($params['id']);
        $switcher->setName('Studio22');

        $switcher = (new SwitcherDAO())->save($switcher);
        
        print_r($switcher);
    }

    public function switcherDelete($params) : void
    {
        $switcher = new Switcher($params['id']);
        
        $switcher = (new SwitcherDAO())->destroy($switcher);

        var_dump($switcher);
    }

    public function schedule() : void
    {
        $schedule = (new ScheduleDAO())->findById(1);

        $schedules = (new ScheduleDAO())->all();

        $data = [
            'data' => $schedule,
            'array' => $schedules
        ];

        $this->loadTemplate('teste', $data);
    }

    public function scheduleInsert() : void
    {
        $schedule = new Schedule();
        $schedule->setStartDate('2021-08-29');
        $schedule->setFinalDate('2021-09-04');
        $schedule->setYear('2021');

        $schedule = (new ScheduleDAO())->save($schedule);

        $data = [
            'data' => $schedule,
            'array' => []
        ];

        $this->loadTemplate('teste', $data);
    }

    public function scheduleUpdate($params) : void
    {
        $schedule = new Schedule($params['id']);
        $schedule->setStartDate('2021-09-05');
        $schedule->setFinalDate('2021-09-11');
        $schedule->setYear('2021');

        $schedule = (new ScheduleDAO())->save($schedule);

        $data = [
            'data' => $schedule,
            'array' => []
        ];

        $this->loadTemplate('teste', $data);
    }

    public function scheduleDelete($params) : void
    {
        $schedule = new Schedule($params['id']);
        
        $schedule = (new ScheduleDAO())->destroy($schedule);

        var_dump($schedule);
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

    public function employeeHour() : void
    {
        $employeeHour = (new EmployeeHourDAO())->findById(3);

        $employeeHours = (new EmployeeHourDAO())->all();

        $data = [
            'data' => $employeeHour,
            'array' => $employeeHours
        ];

        $this->loadTemplate('teste', $data);
    }

    public function employeeHourInsert() : void
    {
        $employeeHours = new EmployeeHour();
        $employeeHours->setStartTime('7:00');
        $employeeHours->setFinalTime('13:00');
        $employeeHours->setDate('2021-09-20');
        $employeeHours->setIdEmployee(1);
        $employeeHours->setIdSchedule(1);

        $employeeHours = (new EmployeeHourDAO())->save($employeeHours);

        $data = [
            'data' => $employeeHours,
            'array' => []
        ];

        $this->loadTemplate('teste', $data);
    }

    public function employeeHourUpdate($params) : void
    {
        $employeeHour = new EmployeeHour($params['id']);
        $employeeHour->setStartTime('06:00');
        $employeeHour->setFinalTime('12:00');
        $employeeHour->setDate('2021-09-10');
        $employeeHour->setIdEmployee(1);
        $employeeHour->setIdSchedule(1);

        $employeeHour = (new EmployeeHourDAO())->save($employeeHour);

        $data = [
            'data' => $employeeHour,
            'array' => []
        ];

        $this->loadTemplate('teste', $data);
    }

    public function employeeHourDelete($params) : void
    {
        $employeeHour = new EmployeeHour($params['id']);
        
        $employeeHour = (new EmployeeHourDAO())->destroy($employeeHour);

        var_dump($employeeHour);
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
