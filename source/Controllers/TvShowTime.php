<?php

namespace Source\Controllers;

use DateTime;
use Source\Core\Controller;
use Source\Models\TvShowTime as TvShowTimeModel;
use Source\Models\TvShowDAO;
use Source\Models\SwitcherDAO;
use Source\Models\StudioDAO;
use Source\Models\TvShowTimeDAO;

class TvShowTime extends Controller
{
    public function index() : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
        }

        $dao = new TvShowTimeDAO();
        $message = null;

        if ($_GET) {
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRIPPED);
            $tvShowsTimes = $dao->findByName($name)->all();
        } else {
            $tvShowsTimes = $dao->find()->all();
        }

        if (session()->has('message')) {
            $message = session()->__get('message');
            session()->unset('message');
        }

        echo $this->view->render('tvShowTime', [
            'title' => 'Business Schedule - Horários de Programas',
            'file' => 'tvShowTime',
            'tvShowsTimes' => $tvShowsTimes,
            'message' => $message
        ]);
    }

    public function save($params) : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
        }

        $message = null;
        $dao = new TvShowTimeDAO();
        $tvShowTime = new TvShowTimeModel();

        if (!empty($params)) {
            $startTime = filter_input(INPUT_POST, 'startTime', FILTER_SANITIZE_STRIPPED);
            $finalTime = filter_input(INPUT_POST, 'finalTime', FILTER_SANITIZE_STRIPPED);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRIPPED);
            $weekDay = date_formatt($date, 'N');
            $mode = filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_STRIPPED);
            $idTvShow = filter_input(INPUT_POST, 'tvShow', FILTER_SANITIZE_STRIPPED);
            $idSwitcher = filter_input(INPUT_POST, 'switcher', FILTER_SANITIZE_STRIPPED);
            $idStudio = filter_input(INPUT_POST, 'studio', FILTER_SANITIZE_STRIPPED);

            $tvShowTime = new TvShowTimeModel(
                null, $startTime, $finalTime, $date, $weekDay, $mode, $idTvShow, $idSwitcher, $idStudio
            );

            if ($dao->save($tvShowTime)) {
                $tvShowTime = new TvShowTimeModel();
            }

            $message = $dao->message();
        }

        $tvShows = (new TvShowDAO())->find()->all();
        $studios = (new StudioDAO())->find()->all();
        $switchers = (new SwitcherDAO())->find()->all();

        echo $this->view->render('tvShowTime-save', [
            'title' => 'Business Schedule - Horários de Programas',
            'file' => 'tvShowTime',
            'tvShowTime' => $tvShowTime,
            'tvShows' => $tvShows,
            'studios' => $studios,
            'switchers' => $switchers,
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
        $dao = new TvShowTimeDAO();
        
        if (isset($params['id']) && $params['id'] > 0) {
            $id = (int) filter_var($params['id'], FILTER_SANITIZE_STRIPPED);
            $tvShowTime = $dao->findById($id);
        }

        if (isset($params['startTime'])) {
            $startTime = filter_input(INPUT_POST, 'startTime', FILTER_SANITIZE_STRIPPED);
            $finalTime = filter_input(INPUT_POST, 'finalTime', FILTER_SANITIZE_STRIPPED);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRIPPED);
            $weekDay = date_formatt($date, 'N');
            $mode = filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_STRIPPED);
            $idTvShow = filter_input(INPUT_POST, 'tvShow', FILTER_SANITIZE_STRIPPED);
            $idSwitcher = filter_input(INPUT_POST, 'switcher', FILTER_SANITIZE_STRIPPED);
            $idStudio = filter_input(INPUT_POST, 'studio', FILTER_SANITIZE_STRIPPED);
            
            $tvShowTime = new TvShowTimeModel(
                $id, $startTime, $finalTime, $date, $weekDay, $mode, $idTvShow, $idSwitcher, $idStudio
            );

            if ($dao->save($tvShowTime)) {
                $tvShowTime = $dao->data();
            }
            
            $message = $dao->message();
        }

        $tvShows = (new TvShowDAO())->find()->all();
        $studios = (new StudioDAO())->find()->all();
        $switchers = (new SwitcherDAO())->find()->all();

        echo $this->view->render('tvShowTime-save', [
            'title' => 'Business Schedule - Horários de Programas',
            'file' => 'tvShowTime',
            'tvShowTime' => $tvShowTime,
            'tvShows' => $tvShows,
            'studios' => $studios,
            'switchers' => $switchers,
            'message' => $message
        ]);
    }
    
    public function create($params) : void
    {
        $message = null;
        $tvShowHour = new TvShowTimeModel();
        $error = [
            'type' => 1,
            'message' => 'Horario Final está antes do horario inicial'
        ];


        if (!empty($params)) {
  
            $tvTvShow = filter_input(INPUT_POST, 'tvShow', FILTER_SANITIZE_STRIPPED);
            $tvStartTime = filter_input(INPUT_POST, 'tvStartTime', FILTER_SANITIZE_STRIPPED);
            $tvFinalTime = filter_input(INPUT_POST, 'tvFinalTime', FILTER_SANITIZE_STRIPPED);
            $tvSwitcher = filter_input(INPUT_POST, 'tvSwitcher', FILTER_SANITIZE_STRIPPED);
            $tvStudio = filter_input(INPUT_POST, 'tvStudio', FILTER_SANITIZE_STRIPPED);
            $tvDate = filter_input(INPUT_POST, 'tvDate', FILTER_SANITIZE_STRIPPED);
            $tvType = filter_input(INPUT_POST, 'tvType', FILTER_SANITIZE_STRIPPED);

            $tvShowDAO = new TvShowDAO();
            $tvShow = $tvShowDAO->findByFullName($tvTvShow);

            $switcherDAO = new SwitcherDAO();
            $switcher = $switcherDAO->findByFullName($tvSwitcher);

            $studioDAO = new StudioDAO();
            $studio = $studioDAO->findByFullName($tvStudio);

            $tvShowHour = new TvShowTimeModel(null, $tvShow->getId(), $tvStartTime, $tvFinalTime, $switcher->getId(), $studio->getId(), $tvDate, $tvType);
            $dao = new TvShowTimeDAO();

            $startTime = new DateTime($tvStartTime);
            $finalTime = new DateTime($tvFinalTime);
            $date = new DateTime($tvDate);
            $dateNow = new DateTime('NOW');

            if ($finalTime > $startTime) {
                $error['message'] = 'A data é anterior ao ano atual';
                if ($date >= $dateNow) {
                    $dao->save($tvShowHour);
                    $message = $dao->message();
                    echo($message->json());
                    return;
                }
            }

            echo json_encode($error);   
        
        }
    }

    public function load()
    {
        $dao = new TvShowTimeDAO();
        echo json_encode($dao->find()->all());
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
            $dao = new TvShowTimeDAO();
            $dao->destroy($id);
            $message = $dao->message();
            session()->set('message', $message);
        }

        redirect('/horario-programa');
    }
}
