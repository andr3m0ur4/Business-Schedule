<?php

namespace Source\Models;

class Employee extends User
{
    protected ?string $job;
    protected ?string $description;

    public function __construct(?int $id = null, ?string $name = null, ?string $email = null, ?string $password = null,  ?string $phone = null, ?string $job = null, ?string $description = null)
    {
        parent::__construct($id, $name, $email, $password, $phone, $description);
        $this->setJob($job);
        $this->setDescription($description);
    }

    public function getJob() : ?string
    {
        return $this->job;
    }

    public function setJob($job)
    {
        $this->job = $job;
        return $this;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function jsonSerialize() : array
    {
        $vars = parent::jsonSerialize();
        unset($vars['password']);
        return $vars;
    }

    public function __toString()
    {
        return parent::__toString() . " - Função: {$this->job}";
    }
}
