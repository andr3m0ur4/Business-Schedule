<?php

namespace Source\Models;

class Administrator extends User
{
    public function __construct(?int $id = null, ?string $name = null, ?string $email = null, ?string $password = null, ?string $phone = null)
    {
        parent::__construct($id, $name, $email, $password, $phone);
    }

    public function __toString()
    {
        return parent::__toString();
    }
}
