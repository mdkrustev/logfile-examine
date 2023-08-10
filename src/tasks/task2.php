<?php
/**
 * @var $style
 * @var $uri
 * @var $task
 * @var $description
 */

$ldr = new LogfileData();



// Read data from log file and make array from serial and specs;
$ldr->setLinesLogFile(PROJECT_ROOT . 'logfiles/updatev12-access-pseudonymized.log', [SERIAL,SPECS]);

$type = $uri == '/task2-json' ? 'json' : 'html';

/*
 *  Display data as:
 *  Html tabel
 *  http://localhost:8080/task2
 *  or
 *  Json string
 *  http://localhost:8080/task2-json
 */

$result = LogicService::getRuleBreakerDevices($ldr->getFileLines());

DisplayData::showResults($task, $description, $result, ["Serial", "mac address"], $type, $style);
exit;
