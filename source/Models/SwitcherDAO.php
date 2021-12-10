<?php

namespace Source\Models;

use Source\Core\DAO;

class SwitcherDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('switchers');
    }

    public function findById(int $id, string $collumns = '*') : ?Switcher
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $switcher = $find->fetch();

        if ($this->fail() || !$switcher) {
            $this->message->warning('Switcher não encontrado para o código informado');
            return null;
        }

        return new Switcher($switcher->id, $switcher->name);
    }

    public function findByName(string $name, string $collumns = '*') : ?SwitcherDAO
    {
        return $this->find('name LIKE :name', "name=%{$name}%", $collumns);
    }

    public function findByFullName(string $name, string $collumns = '*') : ?Switcher
    {
        $find = $this->find('name = :name', "name={$name}", $collumns);

        $switcher = $find->fetch();

        if ($this->fail() || !$switcher) {
            $this->message->warning('Switcher não encontrado para o nome informado');
            return null;
        }

        return new Switcher($switcher->id, $switcher->name);

    }
    
    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou switchers');
            return [];
        }

        $switchers = [];

        foreach ($all as $switcher) {
            $switchers[] = new Switcher($switcher->id, $switcher->name);
        }

        return $switchers;
    }

    public function save(Switcher $switcher) : bool
    {
        if (!$switcher->required()) {
            $this->message->warning('Nome é obrigatório');
            return false;
        }

        // Switcher Update
        if (!empty($switcher->getId())) {
            $switcherId = $switcher->getId();
            
            if ($this->find('name = :name AND id != :id', "name={$switcher->getName()}&id={$switcherId}")->fetch()) {
                $this->message->warning('O nome do switcher informado já está cadastrado');
                return false;
            }

            $this->update($switcher->safe(), 'id = :id', "id={$switcherId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // Switcher Create
        if (empty($switcher->getId())) {
            if ($this->findByFullName($switcher->getName())) {
                $this->message->warning('O nome informado já está cadastrado');
                return false;
            }
            
            $switcherId = $this->create($switcher->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($switcherId);
        return true;
    }

    public function destroy(int $id) : bool
    {
        if (!empty($id)) {
            $this->delete('id', $id);
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o switcher.');
            return false;
        }

        $this->message->success('Switcher removido com sucesso');
        return true;
    }
}
