<?php

namespace Source\Models;

use Source\Core\Model;

class TvShow extends Model
{
    private ?int $id;
    private ?string $name;
    private ?string $start_time;
    private ?string $final_time;
    private ?string $date;
    private ?string $type;
    private ?int $id_switcher;
    private ?int $id_studio;

    public function __construct(?int $id = null, ?string $name = null, ?string $start_time = null, ?string $final_time = null, ?string $date = null, ?string $type = null, ?int $id_switcher = null, ?int $id_studio = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setStartTime($start_time);
        $this->setFinalTime($final_time);
        $this->setDate($date);
        $this->setType($type);
        $this->setIdSwitcher($id_switcher);
        $this->setIdStudio($id_studio);
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

    public function getName() : string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getStartTime() : string
    {
        return $this->startTime;
    }

    public function setStartTime($start_time)
    {
        $this->startTime = $start_time;
        return $this;
    }

    public function getFinalTime() : string
    {
        return $this->finalTime;
    }

    public function setFinalTime($final_time)
    {
        $this->finalTime = $final_time;
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

    public function getType() : string
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getIdSwitcher() : string
    {
        return $this->idSwitcher;
    }

    public function setIdSwitcher($id_switcher)
    {
        $this->idSwitcher = $id_switcher;
        return $this;
    }

    public function getIdStudio() : string
    {
        return $this->idStudio;
    }

    public function setIdStudio($id_studio)
    {
        $this->idStudio = $id_studio;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Hora Inicial: {$this->startTime} - Hora Final: {$this->finalTime} - Data: {$this->date} - Tipo: {$this->type} - Switcher: {$this->idSwitcher} - Estudio: {$this->idStudio}";
    }
}
