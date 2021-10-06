<?php

namespace Source\Models;

use Source\Core\DAO;

class StudioDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('studios');
    }

    public function findById(int $id, string $collumns = '*') : ?Studio
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $studio = $find->fetch();

        if ($this->fail() || !$studio) {
            $this->message->warning('Estúdio não encontrado para o código informado');
            return null;
        }

        return new Studio($studio->id, $studio->name);
    }

    public function findByName(string $name, string $collumns = '*') : ?StudioDAO
    {
        return $this->find('name LIKE :name', "name=%{$name}%", $collumns);
    }

    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou estúdios');
            return [];
        }

        $studios = [];

        foreach ($all as $studio) {
            $studios[] = new Studio($studio->id, $studio->name);
        }

        return $studios;
    }

    public function save(Studio $studio) : bool
    {
        if (!$studio->required()) {
            $this->message->warning('Nome é obrigatório');
            return false;
        }

        // Administrator Update
        if (!empty($studio->getId())) {
            $studioId = $studio->getId();
            
            if ($this->find('name = :name AND id != :id', "name={$studio->getName()}&id={$studioId}")->fetch()) {
                $this->message->warning('O nome do estúdio informado já está cadastrado');
                return false;
            }

            $this->update($studio->safe(), 'id = :id', "id={$studioId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // Administrator Create
        if (empty($studio->getId())) {
            if ($this->findByName($studio->getName())) {
                $this->message->warning('O nome informado já está cadastrado');
                return false;
            }
            
            $studioId = $this->create($studio->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($studioId);
        return true;
    }

    public function destroy(int $id) : bool
    {
        if (!empty($id)) {
            $this->delete('id', $id);
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o estúdio.');
            return false;
        }

        $this->message->success('Estúdio removido com sucesso');
        return true;
    }
}
