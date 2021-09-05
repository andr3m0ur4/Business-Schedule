<?php

namespace Source\Models;

use Source\Core\DAO;

class TvShowHourDAO extends DAO
{
    protected static $entity = 'tv_shows_hours';

    public function find(string $terms, string $params, string $collumns = '*') : ?TvShowHour
    {
        $find = $this->read("SELECT {$collumns} FROM " . self::$entity . " WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            $this->message->warning('Horário de programa não encontrado para o código informado');
            return null;
        }

        $tvShowHour = $find->fetchObject();
        return new TvShowHour($tvShowHour->id, $tvShowHour->id_tv_show, $tvShowHour->id_employee_hour);
    }

    public function findById(int $id, string $collumns = '*') : ?TvShowHour
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
            $this->message->warning('Sua consulta não retornou horários de programas');
            return null;
        }

        $tvShowHours = [];

        foreach ($all->fetchAll(\PDO::FETCH_OBJ) as $tvShowHour) {
            $tvShowHours[] = new TvShowHour($tvShowHour->id, $tvShowHour->id_tv_show, $tvShowHour->id_employee_hour);
        }

        return $tvShowHours;
    }

    public function save(TvShowHour $tvShowHour) : ?TvShowHour
    {
        if (!$tvShowHour->required()) {
            $this->message->warning('Código do programa e código do horário do funcionário são obrigatórios');
            return null;
        }

        // TV Show Hour Update
        if (!empty($tvShowHour->getId())) {
            $tvShowHourId = $tvShowHour->getId();

            $this->update(self::$entity, $tvShowHour->safe(), 'id = :id', "id={$tvShowHourId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return null;
            }
        }
        
        // TV Show Hour Create
        if (empty($tvShowHour->getId())) {
            $tvShowHourId = $this->create(self::$entity, $tvShowHour->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return null;
            }
        }

        return $this->findById($tvShowHourId);
    }

    public function destroy(TvShowHour $tvShowHour) : ?TvShowHour
    {
        if (!empty($tvShowHour->getId())) {
            $this->delete(self::$entity, 'id = :id', "id={$tvShowHour->getId()}");
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o horário do programa.');
            return null;
        }

        $this->message->success('Horário do programa removido com sucesso');
        $tvShowHour = null;
        return $tvShowHour;
    }
}
