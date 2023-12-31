<?php
/**
 * @var $uri
 * @var $task
 * @var $description
 */

$ldr = new LogfileData();



// Read data from log file and make array from serial and specs;
$ldr->setLinesLogFile(PROJECT_ROOT . 'logfiles/updatev12-access-pseudonymized.log', [SERIAL,SPECS], SPECS_TYPE_HARDWARE);

$type = $uri == '/task3-json' ? 'json' : 'html';

/*
 *  Display data as:
 *  Html table
 *  http://localhost:8080/task3
 *  or
 *  Json string
 *  http://localhost:8080/task3-json
 */

$result = LogicService::getHardwareDeviceSerials($ldr->getFileLines());

DisplayData::showResults($task, $description, $result, ["Active Devices - Hardware", "Number of licenses"], $type);
exit;
