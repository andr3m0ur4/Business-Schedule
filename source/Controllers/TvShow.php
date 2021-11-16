<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\TvShow as TvShowModel;
use Source\Models\TvShowDAO;

class TvShow extends Controller
{
    
    public function index() : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
            
        } else if (session()->__get('level') != 2) {
            redirect('/home');
        }

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
            'title' => 'Business Schedule - Programas',
            'file' => 'tvShow',
            'tvShows' => $tvShows,
            'message' => $message
        ]);
    }

    public function save($params) : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
            
        } else if (session()->__get('level') != 2) {
            redirect('/home');
        }

        $message = null;
        $dao = new TvShowDAO();
        $tvShow = new TvShowModel();

        if (!empty($params)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);

            $tvShow = new TvShowModel(null, $name);
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
        if (!session()->__get('idUser')) {
            redirect('/entrar');
            
        } else if (session()->__get('level') != 2) {
            redirect('/home');
        }

        $message = null;
        $dao = new TvShowDAO();
        
        if (isset($params['id']) && $params['id'] > 0) {
            $id = (int) filter_var($params['id'], FILTER_SANITIZE_STRIPPED);
            $tvShow = $dao->findById($id);
        }

        if (isset($params['name'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            
            $tvShow = new TvShowModel($id, $name);
          

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
        if (!session()->__get('idUser')) {
            redirect('/entrar');
            
        } else if (session()->__get('level') != 2) {
            redirect('/home');
        }

        if (isset($param['id'])) {
            $id = (int) filter_var($param['id'], FILTER_SANITIZE_STRIPPED);
            $dao = new TvShowDAO();
            $dao->destroy($id);
            $message = $dao->message();
            session()->set('message', $message);
        }

        redirect('/programa');
    }

    public function list() : void
    {
        $dao = new TvShowDAO();
        $tvShows = $dao->find()->all();
        echo json_encode($tvShows);
    }
}
