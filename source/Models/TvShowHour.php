<?php

namespace Source\Models;

use Source\Core\Model;

class TvShowHour extends Model
{
    protected ?int $id;
    protected ?int $id_tv_show;
    protected ?string $start_time;
    protected ?string $final_time;
    protected ?int $id_switcher;
    protected ?int $id_studio;
    protected ?string $date;
    protected ?string $type;

    public function __construct(?int $id = null, ?int $id_tv_show = null, ?string $start_time = null, ?string $final_time = null, ?int $id_switcher = null, ?int $id_studio = null, ?string $date = null, ?string $type = null)
    {
        parent::__construct(['id'], ['id_tv_show', 'start_time', 'final_time', 'id_switcher', 'id_studio', 'date', 'type']);
        $this->setId($id);
        $this->setIdTvShow($id_tv_show);
        $this->setStartTime($start_time);
        $this->setFinalTime($final_time);
        $this->setIdSwitcher($id_switcher);
        $this->setIdStudio($id_studio);
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

    public function setFinalTime($final_time)
    {
        $this->final_time = date_format_app($final_time);
        return $this;
    }

    public function getIdSwitcher() : ?int
    {
        return $this->id_switcher;
    }

    public function setIdSwitcher($id_switcher)
    {
        $this->id_switcher = $id_switcher;
        return $this;
    }

    public function getIdStudio() : ?int
    {
        return $this->id_studio;
    }

    public function setIdStudio($id_studio)
    {
        $this->id_studio = $id_studio;
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
        return "Id: {$this->id} - Programa: {$this->id_tv_show} - "
        . date_formatt($this->start_time, 'H\hi') .  " - Hora Final: " . date_formatt($this->final_time, 'H\hi') .
        " - Switcher: {$this->id_switcher} - Estudio: {$this->id_studio}" . " - Data: " . date_formatt($this->date, 'd/m') .
        " - Tipo: {$this->type}";
    }
}
