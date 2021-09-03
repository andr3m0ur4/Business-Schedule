<?php

namespace Source\Models;

use Source\Core\DAO;

class UserDAO extends DAO
{
    protected static $safe = [];
    protected static $entity = 'employees';
    protected static $required = [];

    public function find(string $terms, string $params, string $collumns = '*') : ?Employee
    {
        $find = $this->read("SELECT {$collumns} FROM " . self::$entity . " WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            $this->message->warning('Funcionário não encontrado para o código informado');
            return null;
        }

        $object = $find->fetchObject();
        return new Employee($object->id, $object->name, $object->email, $object->password, $object->job);
    }

    public function findById(int $id, string $collumns = '*') : ?Employee
    {
        return $this->find("id = :id", "id={$id}", $collumns);
    }

    public function findByEmail(string $email, string $collumns = '*') : ?Employee
    {
        return $this->find("email = :email", "email={$email}", $collumns);
    }

    public function all(int $limit = 30, int $offset = 0, string $collumns = '*') : ?array
    {
        $all = $this->read(
            "SELECT {$collumns} FROM " . self::$entity . " LIMIT :limit OFFSET :offset",
            "limit={$limit}&offset={$offset}"
        );

        if ($this->fail() || !$all->rowCount()) {
            $this->message->warning('Sua consulta não retornou funcionários');
            return null;
        }

        $employees = [];

        foreach ($all->fetchAll(\PDO::FETCH_OBJ) as $employee) {
            $employees[] = new Employee($employee->id, $employee->name, $employee->email, $employee->password, $employee->job);
        }

        return $employees;
    }

}
