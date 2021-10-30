<?php

namespace Source\Models;

use Source\Core\Model;

class EmployeeTvShowHour extends Model
{
    protected ?int $id;
    protected ?int $id_employee_hours;
    protected ?int $id_tv_show_hours;

    public function __construct(?int $id = null, ?int $id_employee_hours = null, ?int $id_tv_show_hours = null)
    {
        parent::__construct(['id'], ['id_employee_hours, id_tv_show_hours']);
        $this->setId($id);
        $this->setIdEmployeeHours($id_employee_hours);
        $this->setIdTvShowHours($id_tv_show_hours);
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

    public function getIdEmployeeHours() : ?int
    {
        return $this->id_employee_hours;
    }

    public function setIdEmployeeHours($id_employee_hours)
    {
        $this->id_employee_hours = $id_employee_hours;
        return $this;
    }

    public function getIdTvShowHours() : ?int
    {
        return $this->id_tv_show_hours;
    }

    public function setIdTvShowHours($id_tv_show_hours)
    {
        $this->id_tv_show_hours = $id_tv_show_hours;
        return $this;
    }

    public function __toString()
    {
        return "ID: {$this->id} - Id do Funcionario: {$this->id_employee_hours} - Id do programa: {$this->id_tv_show_hours}";
    }
}
