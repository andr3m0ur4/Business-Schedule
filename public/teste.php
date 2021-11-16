<?php

$startTime = new DateTime('09:00');
$finalTime = new DateTime('10:00');
$date = new DateTime('2021-11-17');
$dateNow = new DateTime('today');

echo ($dateNow->getTimestamp());
echo PHP_EOL;
echo ($date->getTimestamp());
echo PHP_EOL;
var_dump($date >= $dateNow);