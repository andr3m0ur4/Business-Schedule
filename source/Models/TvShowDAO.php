<?php

namespace Source\Models;

use Source\Core\DAO;

class TvShowDAO extends DAO
{
    protected static $entity = 'tv_shows';

    public function find(string $terms, string $params, string $collumns = '*') : ?TvShow
    {
        $find = $this->read("SELECT {$collumns} FROM " . self::$entity . " WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            $this->message->warning('Programa não encontrado para o código informado');
            return null;
        }

        $tvShow = $find->fetchObject();
        return new TvShow($tvShow->id, $tvShow->name, $tvShow->start_time, $tvShow->final_time, $tvShow->date, $tvShow->type, $tvShow->id_switcher, $tvShow->id_studio);
    }

    public function findById(int $id, string $collumns = '*') : ?TvShow
    {
        return $this->find("id = :id", "id={$id}", $collumns);
    }

    public function all(int $limit = 30, int $offset = 0, string $collumns = '*') : ?array
    {
        $all = $this->read(
            "SELECT {$collumns} FROM " . self::$entity . " LIMIT :limit OFFSET :offset",
            "limit={$limit}&offset={$offset}"
        );

        if ($this->fail() || !$all->rowCount()) {
            $this->message->warning('Sua consulta não retornou programas');
            return null;
        }

        $tvShows = [];

        foreach ($all->fetchAll(\PDO::FETCH_OBJ) as $tvShow) {
            $tvShows[] = new TvShow($tvShow->id, $tvShow->name, $tvShow->start_time, $tvShow->final_time, $tvShow->date, $tvShow->type, $tvShow->id_switcher, $tvShow->id_studio);
        }

        return $tvShows;
    }

    public function save(TvShow $tvShow) : ?TvShow
    {
        if (!$tvShow->required()) {
            $this->message->warning('Nome do programa é obrigatório');
            return null;
        }

        // TV Show Update
        if (!empty($tvShow->getId())) {
            $tvShowId = $tvShow->getId();

            $this->update(self::$entity, $tvShow->safe(), 'id = :id', "id={$tvShowId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return null;
            }
        }
        
        // TV Show Create
        if (empty($tvShow->getId())) {
            $tvShowId = $this->create(self::$entity, $tvShow->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return null;
            }
        }

        return $this->findById($tvShowId);
    }

    public function destroy(TvShow $tvShow) : ?TvShow
    {
        if (!empty($tvShow->getId())) {
            $this->delete(self::$entity, 'id = :id', "id={$tvShow->getId()}");
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o programa.');
            return null;
        }

        $this->message->success('Programa removido com sucesso');
        $tvShow = null;
        return $tvShow;
    }
}
