<?php

namespace Source\Models;

use Source\Core\Model;

class TvShowHour extends Model
{
    private ?int $id;
    private ?int $idTvShow;
    private ?int $idEmployeeHour;

    public function __construct(?int $id = null, ?int $idTvShow = null, ?int $idEmployeeHour  = null)
    {
        $this->setId($id);
        $this->setIdTvShow($idTvShow);
        $this->setIdEmployeeHour($idEmployeeHour );
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

    public function getIdTvShow() : string
    {
        return $this->idTvShow;
    }

    public function setIdTvShow($idTvShow)
    {
        $this->idTvShow = $idTvShow;
        return $this;
    }

    public function getIdEmployeeHour() : string
    {
        return $this->idEmployeeHour ;
    }

    public function setIdEmployeeHour($idEmployeeHour )
    {
        $this->idEmployeeHour  = $idEmployeeHour ;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Progama: {$this->idTvShow} - Hoarario do Funcionario: {$this->idEmployeeHour }";
    }
}
