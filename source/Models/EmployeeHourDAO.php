<?php

namespace Source\Models;

use Source\Core\DAO;

class EmployeeHourDAO extends DAO
{
    protected static $entity = 'employee_hours';

    public function find(string $terms, string $params, string $collumns = '*') : ?EmployeeHour
    {
        $find = $this->read("SELECT {$collumns} FROM " . self::$entity . " WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            $this->message->warning('Horário de funcionário não encontrado para o código informado');
            return null;
        }

        $employeeHour = $find->fetchObject();
        return new EmployeeHour($employeeHour->id, $employeeHour->start_time, $employeeHour->final_time, $employeeHour->date, $employeeHour->id_employee, $employeeHour->id_schedule);
    }

    public function findById(int $id, string $collumns = '*') : ?EmployeeHour
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
            $this->message->warning('Sua consulta não retornou horários de funcionários');
            return null;
        }

        $employeeHours = [];

        foreach ($all->fetchAll(\PDO::FETCH_OBJ) as $employeeHour) {
            $employeeHours[] = new EmployeeHour($employeeHour->id, $employeeHour->start_time, $employeeHour->final_time, $employeeHour->date, $employeeHour->id_employee, $employeeHour->id_schedule);
        }

        return $employeeHours;
    }

    public function save(EmployeeHour $employeeHour) : ?EmployeeHour
    {
        if (!$employeeHour->required()) {
            $this->message->warning('Horário inicial, horário final e data são obrigatórios');
            return null;
        }

        // Employee Hour Update
        if (!empty($employeeHour->getId())) {
            $employeeHourId = $employeeHour->getId();

            $this->update(self::$entity, $employeeHour->safe(), 'id = :id', "id={$employeeHourId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return null;
            }
        }
        
        // Employee Hour Create
        if (empty($employeeHour->getId())) {
            $employeeHourId = $this->create(self::$entity, $employeeHour->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return null;
            }
        }

        return $this->findById($employeeHourId);
    }

    public function destroy(EmployeeHour $employeeHour) : ?EmployeeHour
    {
        if (!empty($employeeHour->getId())) {
            $this->delete(self::$entity, 'id = :id', "id={$employeeHour->getId()}");
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o horário do funcionário.');
            return null;
        }

        $this->message->success('Horário de funcionário removido com sucesso');
        $employeeHour = null;
        return $employeeHour;
    }
}
