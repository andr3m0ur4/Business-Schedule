<?php

namespace Source\Models;

use Source\Core\Model;

class TvShow extends Model
{
    private ?int $id;
    private ?string $name;
    private ?string $startTime;
    private ?string $finalTime;
    private ?string $date;
    private ?string $type;
    private ?int $idSwitcher;
    private ?int $idStudio;

    public function __construct(?int $id = null, ?string $name = null, ?string $startTime = null, ?string $finalTime = null, ?string $date = null, ?string $type = null, ?int $idSwitcher = null, ?int $idStudio = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setStartTime($startTime);
        $this->setFinalTime($finalTime);
        $this->setDate($date);
        $this->setType($type);
        $this->setIdSwitcher($idSwitcher);
        $this->setIdStudio($idStudio);
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

    public function setIdSwitcher($idSwitcher)
    {
        $this->idSwitcher = $idSwitcher;
        return $this;
    }

    public function getIdStudio() : string
    {
        return $this->idStudio;
    }

    public function setIdStudio($idStudio)
    {
        $this->idStudio = $idStudio;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Hora Inicial: {$this->startTime} - Hora Final: {$this->finalTime} - Data: {$this->date} - Tipo: {$this->type} - Switcher: {$this->idSwitcher} - Estudio: {$this->idStudio}";
    }
}
