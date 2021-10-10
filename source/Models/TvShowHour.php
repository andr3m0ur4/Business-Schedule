<?php

namespace Source\Models;

use Source\Core\Model;

class TvShowHour extends Model
{
    private ?int $id;
    protected ?int $id_tv_show;
    protected ?int $id_employee_hour;
    protected ?string $start_time;
    protected ?string $final_time;
    protected ?int $id_switcher;
    protected ?int $id_studio;

    public function __construct(?int $id = null, ?int $idTvShow = null, ?int $idEmployeeHour  = null, ?string $startTime = null, ?string $finalTime = null, ?int $idSwitcher = null, ?int $idStudio = null, ?string $date = null, ?string $type = null)
    {
        parent::__construct(['id'], ['idTvShow', 'idEmployeeHour', 'start_time', 'final_time', 'id_switcher', 'id_studio', 'date', 'type']);
        $this->setId($id);
        $this->setIdTvShow($idTvShow);
        $this->setIdEmployeeHour($idEmployeeHour);
        $this->setStartTime($startTime);
        $this->setFinalTime($finalTime);
        $this->setIdSwitcher($idSwitcher);
        $this->setIdStudio($idStudio);
        $this->setDate($date);
        $this->setType($type);
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

    public function getIdTvShow() : ?int
    {
        return $this->id_tv_show;
    }

    public function setIdTvShow($idTvShow)
    {
        $this->id_tv_show = $idTvShow;
        return $this;
    }

    public function getIdEmployeeHour() : ?int
    {
        return $this->id_employee_hour;
    }

    public function setIdEmployeeHour($idEmployeeHour )
    {
        $this->id_employee_hour  = $idEmployeeHour;
        return $this;
    }

    public function getStartTime() : ?string
    {
        return $this->start_time;
    }

    public function setStartTime($startTime)
    {
        $this->start_time = date_format_app($startTime);
        return $this;
    }

    public function getFinalTime() : ?string
    {
        return $this->final_time;
    }

    public function setFinalTime($finalTime)
    {
        $this->final_time = date_format_app($finalTime);
        return $this;
    }

    public function getIdSwitcher() : ?int
    {
        return $this->id_switcher;
    }

    public function setIdSwitcher($idSwitcher)
    {
        $this->id_switcher = $idSwitcher;
        return $this;
    }

    public function getIdStudio() : ?int
    {
        return $this->id_studio;
    }

    public function setIdStudio($idStudio)
    {
        $this->id_studio = $idStudio;
        return $this;
    }

    public function getDate() : ?string
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getType() : ?string
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Programa: {$this->id_tv_show} - Horário do Funcionario: {$this->id_employee_hour}"
        . date_formatt($this->start_time, 'H\hi') .  " - Hora Final: " . date_formatt($this->final_time, 'H\hi') .
        " - Switcher: {$this->id_switcher} - Estudio: {$this->id_studio}" . " - Data: " . date_formatt($this->date, 'd/m') .
        " - Tipo: {$this->type}";
    }
}
