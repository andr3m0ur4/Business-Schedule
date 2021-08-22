<?php

namespace Source\Controllers;

use Source\Core\Controller;

class NotFound extends Controller
{
    public function error() : void
    {
        $this->loadView('404', []);
    }
}
