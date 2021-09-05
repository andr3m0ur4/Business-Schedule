<?php

namespace Source\Models;

use Source\Core\Model;

class Schedule extends Model
{
    private ?int $id;
    protected ?string $start_date;
    protected ?string $final_date;
    protected ?string $year;
    protected static array $safe = ['id'];
    protected static array $required = ['start_date', 'final_date', 'year'];

    public function __construct(?int $id = null, ?string $startDate = null, ?string $finalDate = null, ?string $year = null)
    {
        $this->setId($id);
        $this->setStartDate($startDate);
        $this->setFinalDate($finalDate);
        $this->setYear($year);
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

    public function getStartDate() : string
    {
        return $this->start_date;
    }

    public function setStartDate(?string $startDate)
    {
        $this->start_date = date_format_app($startDate);
        return $this;
    }

    public function getFinalDate() : string
    {
        return $this->final_date;
    }

    public function setFinalDate(?string $finalDate)
    {
        $this->final_date = date_format_app($finalDate);
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
        return "Id: {$this->id} - Data Inicial: " . date_formatt($this->start_date, 'd/m') . ' - Data Final: ' .
            date_formatt($this->final_date, 'd/m') . " - Ano: {$this->year}";
    }
}
