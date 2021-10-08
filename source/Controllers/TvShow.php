<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\TvShow as TvShowModel;
use Source\Models\TvShowDAO;
use Source\Models\Switcher as SwitcherModel;
use Source\Models\SwitcherDAO;
use Source\Models\Studio as StudioModel;
use Source\Models\StudioDAO;

class TvShow extends Controller
{
    public function index() : void
    {
        $dao = new TvShowDAO();

        $message = null;

        if ($_GET) {
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRIPPED);
            $tvShows = $dao->findByName($name)->all();
        } else {
            $tvShows = $dao->find()->all();
        }

        if (session()->has('message')) {
            $message = session()->__get('message');
            session()->unset('message');
        }



        echo $this->view->render('tvShow', [
            'title' => 'Business Schedule - Estudio',
            'file' => 'tvShow',
            'tvShows' => $tvShows,
            'message' => $message
        ]);
    }

    public function save($params) : void
    {
        $message = null;
        $dao = new TvShowDAO();
        $studio = new TvShowModel();

        if (!empty($params)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $start_time = filter_input(INPUT_GET, 'start_time', FILTER_SANITIZE_STRIPPED);
            $start_time = filter_input(INPUT_GET, 'final_time', FILTER_SANITIZE_STRIPPED);
            $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRIPPED);
            $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRIPPED);
            $id_switcher = filter_input(INPUT_GET, 'id_switcher', FILTER_SANITIZE_STRIPPED);
            $id_studio = filter_input(INPUT_GET, 'id_studio', FILTER_SANITIZE_STRIPPED);

            $tvShow = new TvShowModel(null, $name, $start_time, $start_time, $date, $type, $id_switcher, $id_studio);
            if ($dao->save($tvShow)) {
                $tvShow = new TvShowModel();
            }

            $message = $dao->message();
        }

        echo $this->view->render('tvShow-save', [
            'title' => 'Business Schedule - Programas',
            'file' => 'tvShow',
            'tvShow' => $tvShow,
            'message' => $message
        ]);
    }

    public function update($params) : void
    {
        $message = null;
        $dao = new TvShowDAO();
        
        if (isset($params['id']) && $params['id'] > 0) {
            $id = (int) filter_var($params['id'], FILTER_SANITIZE_STRIPPED);
            $tvShow = $dao->findById($id);
        }

        if (isset($params['name'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $start_time = filter_input(INPUT_GET, 'start_time', FILTER_SANITIZE_STRIPPED);
            $start_time = filter_input(INPUT_GET, 'final_time', FILTER_SANITIZE_STRIPPED);
            $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRIPPED);
            $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRIPPED);
            $id_switcher = filter_input(INPUT_GET, 'id_switcher', FILTER_SANITIZE_STRIPPED);
            $id_studio = filter_input(INPUT_GET, 'id_studio', FILTER_SANITIZE_STRIPPED);
            $tvShow = new TvShowModel($id, $name, $start_time, $start_time, $date, $type, $id_switcher, $id_studio);

            if ($dao->save($tvShow)) {
                $tvShow = $dao->data();
            }
            
            $message = $dao->message();
        }

        echo $this->view->render('tvShow-save', [
            'title' => 'Business Schedule - Programas',
            'file' => 'tvShow',
            'tvShow' => $tvShow,
            'message' => $message
        ]);
    }

    public function delete($param) : void
    {
        if (isset($param['id'])) {
            $id = (int) filter_var($param['id'], FILTER_SANITIZE_STRIPPED);
            $dao = new TvShowDAO();
            $dao->destroy($id);
            $message = $dao->message();
            session()->set('message', $message);
        }

        redirect('/tvShow');
    }
}
