<?php

namespace Source\Models;

use Source\Core\Model;

class Schedule extends Model
{
    protected ?int $id;
    protected ?int $id_employee;
    protected ?int $id_tv_show_time;

    public function __construct(
        ?int $id = null, ?int $id_employee = null, ?int $id_tv_show_time = null
    )
    {
        parent::__construct(['id'], ['id_employee, id_tv_show_time']);
        $this->setId($id);
        $this->setIdEmployee($id_employee);
        $this->setIdTvShowTime($id_tv_show_time);
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getIdEmployee() : ?int
    {
        return $this->id_employee;
    }

    public function setIdEmployee($id_employee)
    {
        $this->id_employee = $id_employee;
        return $this;
    }

    public function getIdTvShowTime() : ?int
    {
        return $this->id_tv_show_time;
    }

    public function setIdTvShowTime($id_tv_show_time)
    {
        $this->id_tv_show_time = $id_tv_show_time;
        return $this;
    }

    public function employee() : ?Employee
    {
        if ($this->id_employee) {
            return (new EmployeeDAO())->findById($this->id_employee);
        }

        return null;
    }

    public function tvShowTime() : ?TvShowTimeDAO
    {
        if ($this->id_tv_show_time) {
            return (new TvShowTimeDAO())->findById($this->id_tv_show_time);
        }

        return null;
    }

    public function __toString()
    {
        return "ID: {$this->id} - Id do Funcionario: {$this->id_employee} -
            Id do programa: {$this->id_tv_show_time}";
    }
}
