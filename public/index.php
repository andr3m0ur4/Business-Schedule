<?php

use Source\Core\Core;
use Source\Support\Session;

// configurar headers para permitir o acesso de um domínio externo
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: jwt, Content-Type');

require __DIR__ . '/../vendor/autoload.php';

/**
 * BOOTSTRAP
 */
$session = new Session();

$core = new Core();
$core->run();
