<?php

namespace Source\Controllers;

use DateTime;
use Source\Core\Controller;
use Source\Models\TvShowHour as TvShowHourModel;
use Source\Models\TvShowHourDAO;
use Source\Models\TvShowDAO;
use Source\Models\SwitcherDAO;
use Source\Models\StudioDAO;

class TvShowHour extends Controller
{
    public function save($params) : void
    {
        $message = null;
        $tvShowHour = new TvShowHourModel();
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

            $tvShowHour = new TvShowHourModel(null, $tvShow->getId(), $tvStartTime, $tvFinalTime, $switcher->getId(), $studio->getId(), $tvDate, $tvType);
            $dao = new TvShowHourDAO();

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

   
}
