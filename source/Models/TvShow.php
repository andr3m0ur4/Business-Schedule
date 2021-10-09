<?php

namespace Source\Models;

use Source\Core\Model;

class TvShow extends Model
{
    private ?int $id;
    protected ?string $name;
    protected ?string $date;
    protected ?string $type;

    public function __construct(?int $id = null, ?string $name = null, ?string $date = null, ?string $type = null)
    {
        parent::__construct(['id'], ['name', 'date', 'type']);
        $this->setId($id);
        $this->setName($name);
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

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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
        return "Id: {$this->id} - Nome: {$this->name}: " . " - Data: " . date_formatt($this->date, 'd/m') .
            " - Tipo: {$this->type}";
    }
}
