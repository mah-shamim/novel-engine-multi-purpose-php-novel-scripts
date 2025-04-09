<?php


require_once __DIR__.'/shuraih/SHURAIH_CMD.php';

$command = $argv[1] ?? null;
$arguments = array_slice($argv, 2);

SHURAIH_CMD::run($command, $arguments);
