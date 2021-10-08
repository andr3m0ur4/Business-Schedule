<?php

namespace Source\Models;

use Source\Core\DAO;

class TvShowDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('tv_shows');
    }

    public function findById(int $id, string $collumns = '*') : ?TvShow
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $tvShow = $find->fetch();

        if ($this->fail() || !$tvShow) {
            $this->message->warning('Programa não encontrado para o código informado');
            return null;
        }

        return new TvShow(
            $tvShow->id,
            $tvShow->name,
            $tvShow->date,
            $tvShow->type,
        );
    }

    public function findByName(string $name, string $collumns = '*') : ?TvShowDAO
    {
        return $this->find('name LIKE :name', "name=%{$name}%", $collumns);
    }

    public function findByFullName(string $name, string $collumns = '*') : ?TvShow
    {
        $find = $this->find('name = :name', "name={$name}", $collumns);

        $tvShow = $find->fetch();

        if ($this->fail() || !$tvShow) {
            $this->message->warning('Programa não encontrado para o nome informado');
            return null;
        }

        return new TvShow($tvShow->id, $tvShow->name);

    }

    public function all() : array
    {

        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou programas');
            return [];
        }

        $tvShows = [];

        foreach ($all as $tvShow) {
            $tvShows[] = new TvShow(
                $tvShow->id,
                $tvShow->name,
                $tvShow->date,
                $tvShow->type,
            );
        }

        return $tvShows;
    }

    public function save(TvShow $tvShow) : bool
    {
        if (!$tvShow->required()) {
            $this->message->warning('Nome do programa é obrigatório');
            return false;
        }
        // TV Show Update
        if (!empty($tvShow->getId())) {
            $tvShowId = $tvShow->getId();

            if ($this->find('name = :name AND id != :id', "name={$tvShow->getName()}&id={$tvShowId}")->fetch()) {
                $this->message->warning('O nome do programa informado já está cadastrado');
                return false;
            }

            $this->update($tvShow->safe(), 'id = :id', "id={$tvShowId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // TV Show Create
        if (empty($tvShow->getId())) {
            if ($this->findByFullName($tvShow->getName())) {
                $this->message->warning('O nome informado já está cadastrado');
                return false;
            }

            $tvShowId = $this->create($tvShow->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($tvShowId);
        return true;
    }

    public function destroy(int $id) : bool
    {
        if (!empty($id)) {
            $this->delete('id', $id);
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o programa.');
            return false;
        }

        $this->message->success('Programa removido com sucesso');
        return true;
    }
}
