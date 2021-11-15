<?php

namespace Source\Models;

use Source\Core\Model;

class EmployeeTime extends Model
{
    private ?int $id;
    protected ?string $start_time;
    protected ?string $final_time;
    protected ?string $date;
    protected ?int $week_day;
    protected ?int $id_employee;
    protected ?bool $status;
    protected static array $safe = ['id'];
    protected static array $required = ['start_time', 'final_time', 'date', 'week_day', 'id_employee'];

    public function __construct(
        ?int $id = null, ?string $startTime = null, ?string $finalTime = null,
        ?string $date = null, ?int $week_day = null, ?int $id_employee = null
    )
    {
        $this->setId($id);
        $this->setStartTime($startTime);
        $this->setFinalTime($finalTime);
        $this->setDate($date);
        $this->setWeekDay($week_day);
        $this->setIdEmployee($id_employee);
        $this->setStatus(true);
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

    public function getWeekDay() : int
    {
        return $this->week_day;
    }

    public function setWeekDay($week_day)
    {
        $this->week_day = $week_day;
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

    public function getStatus() : ?bool
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function employee() : ?Employee
    {
        if ($this->id_employee) {
            return (new EmployeeDAO())->findById($this->id_employee);
        }

        return null;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Hora Inicial: " . date_formatt($this->start_time, 'H\hi') . " - Hora Final: " . date_formatt($this->final_time, 'H\hi') . " - Data: " . date_formatt($this->date, 'd/m') . " - Funcionario: {$this->id_employee} - Escala: {$this->id_schedule }";
    }
}
