<?php

namespace Source\Models;

use Source\Core\DAO;

class AdministratorDAO extends DAO
{
    protected static $safe = [];
    protected static $entity = 'administrators';
    protected static $required = [];

    public function find(string $terms, string $params, string $collumns = '*') : ?Administrator
    {
        $find = $this->read("SELECT {$collumns} FROM " . self::$entity . " WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            $this->message->warning('Administrador não encontrado para o código informado');
            return null;
        }

        $object = $find->fetchObject();
        return new Administrator($object->id, $object->name, $object->email, $object->password, $object->job);
    }

    public function findById(int $id, string $collumns = '*') : ?Administrator
    {
        return $this->find("id = :id", "id={$id}", $collumns);
    }

    public function findByEmail(string $email, string $collumns = '*') : ?Administrator
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
            $this->message->warning('Sua consulta não retornou administradores');
            return null;
        }

        $administrators = [];

        foreach ($all->fetchAll(\PDO::FETCH_OBJ) as $administrator) {
            $administrators[] = new Administrator($administrator->id, $administrator->name, $administrator->email, $administrator->password, $administrator->job);
        }

        return $administrators;
    }
}
