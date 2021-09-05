<?php

namespace Source\Models;

use Source\Core\Model;

class Switcher extends Model
{
    protected ?int $id;
    protected ?string $name;
    protected static array $safe = ['id'];
    protected static array $required = ['name'];

    public function __construct(?int $id = null, ?string $name = null)
    {
        $this->setId($id);
        $this->setName($name);
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

    public function getName() : string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function __toString()
    {
        return "ID: {$this->id} - Nome: {$this->name}";
    }
}
