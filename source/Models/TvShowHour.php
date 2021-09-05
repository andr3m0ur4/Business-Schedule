<?php

namespace Source\Models;

use Source\Core\Model;

class TvShowHour extends Model
{
    private ?int $id;
    private ?int $id_tv_show;
    private ?int $id_employee_hour;

    public function __construct(?int $id = null, ?int $id_tv_show = null, ?int $id_employee_hour  = null)
    {
        $this->setId($id);
        $this->setIdTvShow($id_tv_show);
        $this->setIdEmployeeHour($id_employee_hour );
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

    public function setIdTvShow($id_tv_show)
    {
        $this->idTvShow = $id_tv_show;
        return $this;
    }

    public function getIdEmployeeHour() : string
    {
        return $this->idEmployeeHour ;
    }

    public function setIdEmployeeHour($id_employee_hour )
    {
        $this->idEmployeeHour  = $id_employee_hour ;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Progama: {$this->idTvShow} - Hoarario do Funcionario: {$this->idEmployeeHour }";
    }
}
