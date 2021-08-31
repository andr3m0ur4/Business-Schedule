<?php

namespace Source\Models;

class Administrator extends User
{
    public ?string $job;

    public function __construct(?int $id = 5, ?string $name = null, ?string $email = null, ?string $password = null, ?string $job = null)
    {
        parent::__construct($id, $name, $email, $password);
        $this->setJob($job);
    }

    public function getJob() : string
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
