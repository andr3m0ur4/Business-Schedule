<?php

namespace Source\Models;

class Employee extends User
{
    protected ?string $job;

    public function __construct(?int $id = null, ?string $name = null, ?string $email = null, ?string $password = null,  ?string $phone = null, ?string $job = null)
    {
        parent::__construct($id, $name, $email, $password, $phone);
        $this->setJob($job);
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

    public function __toString()
    {
        return parent::__toString() . " - Função: {$this->job}";
    }
}
