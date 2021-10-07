<?php

namespace Source\Models;

use Source\Core\DAO;

class ScheduleDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('schedules');
    }

    public function findById(int $id, string $collumns = '*') : ?Schedule
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $schedule = $find->fetch();

        if ($this->fail() || !$schedule) {
            $this->message->warning('Escala não encontrada para o código informado');
            return null;
        }

        return new Schedule($schedule->id, $schedule->start_date, $schedule->final_date, $schedule->year);
    }

    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou escalas');
            return [];
        }

        $schedules = [];

        foreach ($all as $schedule) {
            $schedules[] = new Schedule($schedule->id, $schedule->start_date, $schedule->final_date, $schedule->year);
        }

        return $schedules;
    }

    public function save(Schedule $schedule) : bool
    {
        if (!$schedule->required()) {
            $this->message->warning('Data de início, data final e ano são obrigatórios');
            return false;
        }

        // Schedule Update
        if (!empty($schedule->getId())) {
            $scheduleId = $schedule->getId();

            $this->update($schedule->safe(), 'id = :id', "id={$scheduleId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // schedule Create
        if (empty($schedule->getId())) {
            $scheduleId = $this->create($schedule->safe());
            
            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($scheduleId);
        return true;
    }

    public function destroy(int $id) : bool
    {
        if (!empty($id)) {
            $this->delete('id', $id);
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover a escala.');
            return false;
        }

        $this->message->success('Escala removida com sucesso');
        return true;
    }
}
