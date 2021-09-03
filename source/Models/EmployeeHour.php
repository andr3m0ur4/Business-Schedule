<?php

namespace Source\Models;

use Source\Core\Model;

class EmployeeHour extends Model
{
    private ?int $id;
    private ?string $startTime;
    private ?string $finalTime;
    private ?string $date;
    private ?int $idEmployee;
    private ?int $idSchedule;

    public function __construct(?int $id = null, ?string $startTime = null, ?string $finalTime = null, ?string $date = null, ?int $idEmployee = null, ?int $idSchedule  = null)
    {
        $this->setId($id);
        $this->setStartTime($startTime);
        $this->setFinalTime($finalTime);
        $this->setDate($date);
        $this->setIdEmployee($idEmployee);
        $this->setIdSchedule($idSchedule );
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
        return $this->startTime;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    public function getFinalTime() : string
    {
        return $this->finalTime;
    }

    public function setFinalTime($finalTime)
    {
        $this->finalTime = $finalTime;
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
        return $this->idEmployee;
    }

    public function setIdEmployee($idEmployee)
    {
        $this->idEmployee = $idEmployee;
        return $this;
    }

    public function getIdSchedule() : string
    {
        return $this->idSchedule ;
    }

    public function setIdSchedule($idSchedule )
    {
        $this->idSchedule  = $idSchedule ;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Hora Inicial: {$this->startTime} - Hora Final: {$this->finalTime} - Data: {$this->date} - Funcionario: {$this->idEmployee} - Escala: {$this->idSchedule }";
    }
}
