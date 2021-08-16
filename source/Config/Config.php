<?php

$config = [];

if (ENVIRONMENT == 'development') {
    $config = [
        'dbname' => CONF_DB_NAME,
        'host' => CONF_DB_HOST,
        'dbuser' => CONF_DB_USER,
        'dbpass' => CONF_DB_PASS
    ];
} else {
    $config = [
        'dbname' => CONF_DB_NAME,
        'host' => CONF_DB_HOST,
        'dbuser' => CONF_DB_USER,
        'dbpass' => CONF_DB_PASS
    ];
}

global $db;
