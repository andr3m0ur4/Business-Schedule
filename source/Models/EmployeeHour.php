<?php

namespace Source\Models;

use Source\Core\Model;

class EmployeeHour extends Model
{
    private ?int $id;
    protected ?string $start_time;
    protected ?string $final_time;
    protected ?string $date;
    protected ?int $id_employee;
    protected ?int $id_schedule;
    protected static array $safe = ['id'];
    protected static array $required = ['start_time', 'final_time', 'date'];

    public function __construct(
        ?int $id = null, ?string $startTime = null, ?string $finalTime = null, ?string $date = null, ?int $idEmployee = null, ?int $idSchedule  = null
    )
    {
        $this->setId($id);
        $this->setStartTime($startTime);
        $this->setFinalTime($finalTime);
        $this->setDate($date);
        $this->setIdEmployee($idEmployee);
        $this->setIdSchedule($idSchedule );
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

    public function getStartTime() : string
    {
        return $this->start_time;
    }

    public function setStartTime($startTime)
    {
        $this->start_time = date_format_app($startTime);
        return $this;
    }

    public function getFinalTime() : string
    {
        return $this->final_time;
    }

    public function setFinalTime($finalTime)
    {
        $this->final_time = date_format_app($finalTime);
        return $this;
    }

    public function getDate() : string
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = date_format_app($date);
        return $this;
    }

    public function getIdEmployee() : string
    {
        return $this->id_employee;
    }

    public function setIdEmployee($idEmployee)
    {
        $this->id_employee = $idEmployee;
        return $this;
    }

    public function getIdSchedule() : string
    {
        return $this->id_schedule ;
    }

    public function setIdSchedule($idSchedule )
    {
        $this->id_schedule  = $idSchedule ;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Hora Inicial: " . date_formatt($this->start_time, 'H\hi') . " - Hora Final: " . date_formatt($this->final_time, 'H\hi') . " - Data: " . date_formatt($this->date, 'd/m') . " - Funcionario: {$this->id_employee} - Escala: {$this->id_schedule }";
    }
}
