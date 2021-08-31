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
}
