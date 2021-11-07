<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Studio as StudioModel;
use Source\Models\StudioDAO;

class Studio extends Controller
{
    public function index() : void
    {
        $dao = new StudioDAO();
        $message = null;

        if ($_GET) {
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRIPPED);
            $studios = $dao->findByName($name)->all();
        } else {
            $studios = $dao->find()->all();
        }

        if (session()->has('message')) {
            $message = session()->__get('message');
            session()->unset('message');
        }

        echo $this->view->render('studio', [
            'title' => 'Business Schedule - Estudio',
            'file' => 'studio',
            'studios' => $studios,
            'message' => $message
        ]);
    }

    public function save($params) : void
    {
        $message = null;
        $dao = new StudioDAO();
        $studio = new StudioModel();

        if (!empty($params)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);

            $studio = new StudioModel(null, $name);
            if ($dao->save($studio)) {
                $studio = new StudioModel();
            }

            $message = $dao->message();
        }

        echo $this->view->render('studio-save', [
            'title' => 'Business Schedule - Estudio',
            'file' => 'studio',
            'studio' => $studio,
            'message' => $message
        ]);
    }

    public function update($params) : void
    {
        $message = null;
        $dao = new StudioDAO();
        
        if (isset($params['id']) && $params['id'] > 0) {
            $id = (int) filter_var($params['id'], FILTER_SANITIZE_STRIPPED);
            $studio = $dao->findById($id);
        }

        if (isset($params['name'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $studio = new StudioModel($id, $name);
            if ($dao->save($studio)) {
                $studio = $dao->data();
            }
            
            $message = $dao->message();
        }

        echo $this->view->render('studio-save', [
            'title' => 'Business Schedule - Estudio',
            'file' => 'studio',
            'studio' => $studio,
            'message' => $message
        ]);
    }

    public function delete($param) : void
    {
        if (isset($param['id'])) {
            $id = (int) filter_var($param['id'], FILTER_SANITIZE_STRIPPED);
            $dao = new StudioDAO();
            $dao->destroy($id);
            $message = $dao->message();
            session()->set('message', $message);
        }

        redirect('/estudio');
    }

    
    public function listStudio() : void
    {
        $dao = new StudioDAO();
        $studios = $dao->find()->all();
        echo json_encode($studios);
    }
}
