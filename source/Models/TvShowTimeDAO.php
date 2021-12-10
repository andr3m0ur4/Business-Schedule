<?php

namespace Source\Models;

use Source\Core\DAO;

class TvShowTimeDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('tv_shows_times');
    }

    public function findById(int $id, string $collumns = '*') : ?TvShowTime
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $tvShowTime = $find->fetch();

        if ($this->fail() || !$tvShowTime) {
            $this->message->warning('Horário do programa não encontrado para o código informado');
            return null;
        }

        return new TvShowTime(
            $tvShowTime->id,
            $tvShowTime->start_time,
            $tvShowTime->final_time,
            $tvShowTime->date,
            $tvShowTime->week_day,
            $tvShowTime->mode,
            $tvShowTime->id_tv_show,
            $tvShowTime->id_switcher,
            $tvShowTime->id_studio
        );
    }

    public function findByName(string $name, string $collumns = 'TST.*') : ?TvShowTimeDAO
    {
        $this->query = "SELECT {$collumns} FROM tv_shows_times AS TST
                        INNER JOIN tv_shows AS TS
                        ON (TS.id = TST.id_tv_show)
                        WHERE TS.name LIKE :name";
        
        parse_str("name=%{$name}%", $this->params);
        return $this;
    }

    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou horários de programas');
            return [];
        }

        $tvShowTimes = [];

        foreach ($all as $tvShowTime) {
            $tvShowTimes[] =  new TvShowTime(
                $tvShowTime->id,
                $tvShowTime->start_time,
                $tvShowTime->final_time,
                $tvShowTime->date,
                $tvShowTime->week_day,
                $tvShowTime->mode,
                $tvShowTime->id_tv_show,
                $tvShowTime->id_switcher,
                $tvShowTime->id_studio
            );
        }

        return $tvShowTimes;
    }

    public function save(TvShowTime $tvShowTime) : bool
    {
        if (!$tvShowTime->required()) {
            $this->message->warning('Código do programa e código do horário do funcionário são obrigatórios');
            return false;
        }

        // TV Show Hour Update
        if (!empty($tvShowTime->getId())) {
            $tvShowTimeId = $tvShowTime->getId();

            $this->update($tvShowTime->safe(), 'id = :id', "id={$tvShowTimeId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // TV Show Hour Create
        if (empty($tvShowTime->getId())) {

            $tvShowTimeId = $this->create($tvShowTime->safe());

            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($tvShowTimeId);
        return true;
    }

    public function destroy(int $id) : bool
    {
        if (!empty($id)) {
            $this->delete('id', $id);
        }

        if ($this->fail()) {
            $this->message->warning('Não foi possível remover o horário do programa.');
            return false;
        }

        $this->message->success('Horário do programa removido com sucesso');
        return true;
    }
}
