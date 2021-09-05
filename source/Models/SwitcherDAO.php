<?php

namespace Source\Models;

use Source\Core\DAO;

class SwitcherDAO extends DAO
{
    protected static $entity = 'switchers';

    public function find(string $terms, string $params, string $collumns = '*') : ?Switcher
    {
        $find = $this->read("SELECT {$collumns} FROM " . self::$entity . " WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            $this->message->warning('Switcher não encontrado para o código informado');
            return null;
        }

        $object = $find->fetchObject();
        return new Switcher($object->id, $object->name);
    }

    public function findById(int $id, string $collumns = '*') : ?Switcher
    {
        return $this->find("id = :id", "id={$id}", $collumns);
    }

    public function findByName(string $name, string $collumns = '*') : ?Switcher
    {
        return $this->find("name = :name", "name={$name}", $collumns);
    }

    public function all(int $limit = 30, int $offset = 0, string $collumns = '*') : ?array
    {
        $all = $this->read(
            "SELECT {$collumns} FROM " . self::$entity . " LIMIT :limit OFFSET :offset",
            "limit={$limit}&offset={$offset}"
        );

        if ($this->fail() || !$all->rowCount()) {
            $this->message->warning('Sua consulta não retornou switchers');
            return null;
        }

        $switchers = [];

        foreach ($all->fetchAll(\PDO::FETCH_OBJ) as $switcher) {
            $switchers[] = new Switcher($switcher->id, $switcher->name);
        }

        return $switchers;
    }

    public function save(Switcher $switcher) : ?Switcher
    {
        if (!$switcher->required()) {
            $this->message->warning('Nome é obrigatório');
            return null;
        }

        // Administrator Update
        if (!empty($switcher->getId())) {
            $switcherId = $switcher->getId();
            
            if ($this->find('name = :name AND id != :id', "name={$switcher->getName()}&id={$switcherId}")) {
                $this->message->warning('O nome do estudio informado já está cadastrado');
                return null;
            }

            $this->update(self::$entity, $switcher->safe(), 'id = :id', "id={$switcherId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return null;
            }
        }
        
        // Administrator Create
        if (empty($switcher->getId())) {
            if ($this->findByName($switcher->getName())) {
                $this->message->warning('O nome informado já está cadastrado');
                return null;
            }
            
            $switcherId = $this->create(self::$entity, $switcher->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return null;
            }
        }

        return $this->findById($switcherId);
    }

    public function destroy(Switcher $switcher) : ?Switcher
    {
        if (!empty($switcher->getId())) {
            $this->delete(self::$entity, 'id = :id', "id={$switcher->getId()}");
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o estudio.');
            return null;
        }

        $this->message->success('Estudio removido com sucesso');
        $switcher = null;
        return $switcher;
    }
}
