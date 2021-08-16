<?php

use Source\Core\Core;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$core = new Core();
$core->run();
