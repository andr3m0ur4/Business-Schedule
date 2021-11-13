<?php

namespace Source\Models;

use Source\Core\DAO;

class TvShowHourDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('tv_shows_hours');
    }

    public function findById(int $id, string $collumns = '*') : ?TvShowHour
    {
        $find = $this->find('id = :id', "id={$id}", $collumns);

        $tvShowHour = $find->fetch();

        if ($this->fail() || !$tvShowHour) {
            $this->message->warning('Horário do programa não encontrado para o código informado');
            return null;
        }

        return new TvShowHour(
            $tvShowHour->id,
            $tvShowHour->id_tv_show,
            $tvShowHour->start_time,
            $tvShowHour->final_time,
            $tvShowHour->id_switcher,
            $tvShowHour->id_studio,
            $tvShowHour->date,
            $tvShowHour->type
        );
    }

    public function all() : array
    {
        $all = parent::fetch(true);

        if ($this->fail() || !$all) {
            $this->message->warning('Sua consulta não retornou horários de programas');
            return [];
        }

        $tvShowHours = [];

        foreach ($all as $tvShowHour) {
            $tvShowHour =  new TvShowHour(
                $tvShowHour->id,
                $tvShowHour->id_tv_show,
                $tvShowHour->start_time,
                $tvShowHour->final_time,
                $tvShowHour->id_switcher,
                $tvShowHour->id_studio,
                $tvShowHour->date,
                $tvShowHour->type
            );

            $tvShowHour->tvShow = (new TvShowDAO())->findById($tvShowHour->getIdTvShow());
            $tvShowHour->studio = (new StudioDAO())->findById($tvShowHour->getIdStudio());
            $tvShowHour->switcher = (new SwitcherDAO())->findById($tvShowHour->getIdSwitcher());

            $tvShowHours[] = $tvShowHour;
        }

        return $tvShowHours;
    }

    public function save(TvShowHour $tvShowHour) : bool
    {
        if (!$tvShowHour->required()) {
            $this->message->warning('Código do programa e código do horário do funcionário são obrigatórios');
            return false;
        }

        // TV Show Hour Update
        if (!empty($tvShowHour->getId())) {
            $tvShowHourId = $tvShowHour->getId();

            $this->update($tvShowHour->safe(), 'id = :id', "id={$tvShowHourId}");

            if ($this->fail()) {
                $this->message->error('Erro ao atualizar, verifique os dados');
                return false;
            }
        }
        
        // TV Show Hour Create
        if (empty($tvShowHour->getId())) {

            $tvShowHourId = $this->create($tvShowHour->safe());

            if ($this->fail()) {
                $this->message->error('Erro ao cadastrar, verifique os dados');
                return false;
            }
        }

        $this->message->success('Dados salvos com sucesso');
        $this->data = $this->findById($tvShowHourId);
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
