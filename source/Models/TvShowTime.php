<?php

namespace Source\Models;

use Source\Core\Model;

class TvShowTime extends Model
{
    protected ?int $id;
    protected ?string $start_time;
    protected ?string $final_time;
    protected ?string $date;
    protected ?int $week_day;
    protected ?string $type;
    protected ?int $id_tv_show;
    protected ?int $id_switcher;
    protected ?int $id_studio;
    protected ?bool $status;

    public function __construct(
        ?int $id = null, ?string $start_time = null, ?string $final_time = null,
        ?string $date = null, ?int $week_day = null, ?string $type = null,
        ?int $id_tv_show = null, ?int $id_switcher = null, ?int $id_studio = null
    )
    {
        parent::__construct(
            ['id'], ['id_tv_show', 'start_time', 'final_time', 'id_switcher', 'id_studio', 'date', 'type']
        );

        $this->setId($id);
        $this->setStartTime($start_time);
        $this->setFinalTime($final_time);
        $this->setDate($date);
        $this->setWeekDay($week_day);
        $this->setType($type);
        $this->setIdTvShow($id_tv_show);
        $this->setIdSwitcher($id_switcher);
        $this->setIdStudio($id_studio);
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

    public function getWeekDay() : int
    {
        return $this->week_day;
    }

    public function setWeekDay($week_day)
    {
        $this->week_day = $week_day;
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

    public function getStatus() : ?bool
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
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
