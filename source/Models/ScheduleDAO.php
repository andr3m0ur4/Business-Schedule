<?php

namespace Source\Models;

use Source\Core\DAO;

class ScheduleDAO extends DAO
{
    protected static $entity = 'schedules';

    public function find(string $terms, string $params, string $collumns = '*') : ?Schedule
    {
        $find = $this->read("SELECT {$collumns} FROM " . self::$entity . " WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            $this->message->warning('Escala não encontrada para o código informado');
            return null;
        }

        $object = $find->fetchObject();
        return new Schedule($object->id, $object->start_date, $object->final_date, $object->year);
    }

    public function findById(int $id, string $collumns = '*') : ?Schedule
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
            $this->message->warning('Sua consulta não retornou escalas');
            return null;
        }

        $schedules = [];

        foreach ($all->fetchAll(\PDO::FETCH_OBJ) as $schedule) {
            $schedules[] = new Schedule($schedule->id, $schedule->start_date, $schedule->final_date, $schedule->year);
        }

        return $schedules;
    }

    public function save(Schedule $schedule) : ?Schedule
    {
        if (!$schedule->required()) {
            $this->message->warning('Data de início, data final e ano são obrigatórios');
            return null;
        }

        // Schedule Update
        if (!empty($schedule->getId())) {
            $scheduleId = $schedule->getId();

            $this->update(self::$entity, $schedule->safe(), 'id = :id', "id={$scheduleId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return null;
            }
        }
        
        // schedule Create
        if (empty($schedule->getId())) {
            $scheduleId = $this->create(self::$entity, $schedule->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return null;
            }
        }

        return $this->findById($scheduleId);
    }

    public function destroy(Schedule $schedule) : ?Schedule
    {
        if (!empty($schedule->getId())) {
            $this->delete(self::$entity, 'id = :id', "id={$schedule->getId()}");
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover a escala.');
            return null;
        }

        $this->message->success('Escala removida com sucesso');
        $schedule = null;
        return $schedule;
    }
}
