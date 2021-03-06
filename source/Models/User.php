<?php

namespace Source\Models;

use Source\Core\Model;

abstract class User extends Model
{
    protected ?int $id;
    protected ?string $name;
    protected ?string $email;
    protected ?string $password;
    protected ?string $phone;
    protected ?bool $status;

    public function __construct(?int $id = null, ?string $name = null, ?string $email = null, ?string $password = null, ?string $phone = null)
    {
        parent::__construct(['id'], ['name', 'email', 'password']);
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setPhone($phone);
        $this->setStatus(true);
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

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPhone() : ?string
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getStatus() : ?bool
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function __toString()
    {
        return "ID: {$this->id} - Nome: {$this->name} - E-mail: {$this->email} - Password: {$this->password}  - Celular: {$this->phone}";
    }
}
