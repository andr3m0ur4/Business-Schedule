<?php

namespace Source\Models;

use Source\Core\Model;

class EmployeeHour extends Model
{
    private ?int $id;
    private ?string $start_time;
    private ?string $final_time;
    private ?string $date;
    private ?int $id_employee;
    private ?int $id_schedule;

    public function __construct(?int $id = null, ?string $start_time = null, ?string $final_time = null, ?string $date = null, ?int $id_employee = null, ?int $id_schedule  = null)
    {
        $this->setId($id);
        $this->setStartTime($start_time);
        $this->setFinalTime($final_time);
        $this->setDate($date);
        $this->setIdEmployee($id_employee);
        $this->setIdSchedule($id_schedule );
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getStartTime() : string
    {
        return $this->start_time;
    }

    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
        return $this;
    }

    public function getFinalTime() : string
    {
        return $this->final_time;
    }

    public function setFinalTime($final_time)
    {
        $this->final_time = $final_time;
        return $this;
    }

    public function getDate() : string
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getIdEmployee() : string
    {
        return $this->id_employee;
    }

    public function setIdEmployee($id_employee)
    {
        $this->id_employee = $id_employee;
        return $this;
    }

    public function getIdSchedule() : string
    {
        return $this->idSchedule ;
    }

    public function setIdSchedule($id_schedule )
    {
        $this->idSchedule  = $id_schedule ;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Hora Inicial: {$this->start_time} - Hora Final: {$this->final_time} - Data: {$this->date} - Funcionario: {$this->id_employee} - Escala: {$this->idSchedule }";
    }
}
