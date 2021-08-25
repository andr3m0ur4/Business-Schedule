<?php

namespace Source\Models;

use Source\Core\Model;

class Schedules extends Model
{
    private ?int $id;
    private ?string $startDate;
    private ?string $finalDate;
    private ?string $year;

    public function __construct(?int $id = null, ?string $startDate = null, ?string $finalDate = null, ?string $year = null)
    {
        $this->setId($id);
        $this->setStartDate($startDate);
        $this->setFinalDate($finalDate);
        $this->setYear($year);
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

    public function getStartDate() : string
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getFinalDate() : string
    {
        return $this->finalDate;
    }

    public function setFinalDate($finalDate)
    {
        $this->finalDate = $finalDate;
        return $this;
    }

    public function getYear() : string
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Data Inicial: {$this->startDate} - Data Final: {$this->finalDate}- Ano: {$this->year}";
    }
}
