<?php

namespace Source\Models;

use Source\Core\DAO;

class StudioDAO extends DAO
{
    protected static $entity = 'studios';

    public function find(string $terms, string $params, string $collumns = '*') : ?Studio
    {
        $find = $this->read("SELECT {$collumns} FROM " . self::$entity . " WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            $this->message->warning('Estudio não encontrado para o código informado');
            return null;
        }

        $object = $find->fetchObject();
        return new Studio($object->id, $object->name);
    }

    public function findById(int $id, string $collumns = '*') : ?Studio
    {
        return $this->find("id = :id", "id={$id}", $collumns);
    }

    public function findByName(string $name, string $collumns = '*') : ?Studio
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
            $this->message->warning('Sua consulta não retornou estudios');
            return null;
        }

        $studios = [];

        foreach ($all->fetchAll(\PDO::FETCH_OBJ) as $studio) {
            $studios[] = new Studio($studio->id, $studio->name);
        }

        return $studios;
    }

    public function save(Studio $studio) : ?Studio
    {
        if (!$studio->required()) {
            $this->message->warning('Nome é obrigatório');
            return null;
        }

        // Administrator Update
        if (!empty($studio->getId())) {
            $studioId = $studio->getId();
            
            if ($this->find('name = :name AND id != :id', "name={$studio->getName()}&id={$studioId}")) {
                $this->message->warning('O nome do estudio informado já está cadastrado');
                return null;
            }

            $this->update(self::$entity, $studio->safe(), 'id = :id', "id={$studioId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return null;
            }
        }
        
        // Administrator Create
        if (empty($studio->getId())) {
            if ($this->findByName($studio->getName())) {
                $this->message->warning('O nome informado já está cadastrado');
                return null;
            }
            
            $studioId = $this->create(self::$entity, $studio->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return null;
            }
        }

        return $this->findById($studioId);
    }

    public function destroy(Studio $studio) : ?Studio
    {
        if (!empty($studio->getId())) {
            $this->delete(self::$entity, 'id = :id', "id={$studio->getId()}");
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o estudio.');
            return null;
        }

        $this->message->success('Estudio removido com sucesso');
        $studio = null;
        return $studio;
    }
}
