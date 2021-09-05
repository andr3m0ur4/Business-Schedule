<?php

namespace Source\Models;

use Source\Core\Model;

class TvShowHour extends Model
{
    private ?int $id;
    protected ?int $id_tv_show;
    protected ?int $id_employee_hour;
    protected static array $safe = ['id'];
    protected static array $required = ['id_tv_show', 'id_employee_hour'];

    public function __construct(?int $id = null, ?int $idTvShow = null, ?int $idEmployeeHour  = null)
    {
        $this->setId($id);
        $this->setIdTvShow($idTvShow);
        $this->setIdEmployeeHour($idEmployeeHour);
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

    public function getIdTvShow() : int
    {
        return $this->id_tv_show;
    }

    public function setIdTvShow($idTvShow)
    {
        $this->id_tv_show = $idTvShow;
        return $this;
    }

    public function getIdEmployeeHour() : int
    {
        return $this->id_employee_hour;
    }

    public function setIdEmployeeHour($idEmployeeHour )
    {
        $this->id_employee_hour  = $idEmployeeHour;
        return $this;
    }

    public function __toString()
    {
        return "Id: {$this->id} - Programa: {$this->id_tv_show} - Horário do Funcionario: {$this->id_employee_hour}";
    }
}
