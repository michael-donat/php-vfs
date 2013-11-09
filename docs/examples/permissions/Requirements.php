<?php

require_once 'Checker.php';

define('APP_DIR', __DIR__);

echo 'Checking filesystem permissions:'.PHP_EOL;
$checker = new Checker(APP_DIR);
$checker->result($checker->checkCache(), 'Cache: ');
$checker->result($checker->checkLib(), 'Lib: ');
$checker->result($checker->checkLog(), 'Log: ');
$checker->result($checker->checkInstaller(), 'Installer removed: ');
