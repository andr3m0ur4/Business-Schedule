<?php

namespace Source\Controllers;

use Source\Core\Controller;
use Source\Models\Switcher as SwitcherModel;
use Source\Models\SwitcherDAO;

class Switcher extends Controller
{
    public function index() : void
    {
        if (!session()->__get('idUser')) {
            redirect('/entrar');
            
        } else if (session()->__get('level') != 2) {
            redirect('/home');
        }

        $dao = new SwitcherDAO();
        $message = null;

        if ($_GET) {
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRIPPED);
            $switchers = $dao->findByName($name)->all();
        } else {
            $switchers = $dao->find()->all();
        }

        if (session()->has('message')) {
            $message = session()->__get('message');
            session()->unset('message');
        }

        echo $this->view->render('switcher', [
            'title' => 'Business Schedule - Switcher',
            'file' => 'switcher',
            'switchers' => $switchers,
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
        $dao = new SwitcherDAO();
        $switcher = new SwitcherModel();

        if (!empty($params)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);

            $switcher = new SwitcherModel(null, $name);
            if ($dao->save($switcher)) {
                $switcher = new SwitcherModel();
            }

            $message = $dao->message();
        }

        echo $this->view->render('switcher-save', [
            'title' => 'Business Schedule - switcher-save',
            'file' => 'switcher',
            'switcher' => $switcher,
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
        $dao = new SWitcherDAO();
        
        if (isset($params['id']) && $params['id'] > 0) {
            $id = (int) filter_var($params['id'], FILTER_SANITIZE_STRIPPED);
            $switcher = $dao->findById($id);
        }

        if (isset($params['name'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
            $switcher = new SwitcherModel($id, $name);
            if ($dao->save($switcher)) {
                //erro aqui ao charmar save
                $switcher = $dao->data();
            }
            
            $message = $dao->message();
        }

        echo $this->view->render('switcher-save', [
            'title' => 'Business Schedule - switcher-save',
            'file' => 'switcher',
            'switcher' => $switcher,
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
            $dao = new SwitcherDAO();
            $dao->destroy($id);
            $message = $dao->message();
            session()->set('message', $message);
        }

        redirect('/switcher');
    }

    public function listSwitcher() : void
    {
        $dao = new SwitcherDAO();
        $switchers = $dao->find()->all();
        echo json_encode($switchers);
    }
}
