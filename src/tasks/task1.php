<?php

/**
 * @var $uri
 * @var $task
 * @var $description
 */

$ldr = new LogfileData();

// Read data from log file and make array from all serials;
$ldr->setLinesLogFile(PROJECT_ROOT . 'logfiles/updatev12-access-pseudonymized.log', SERIAL);

// Get the first 10 from array that try to access the server the most
$result = LogicService::getTheMostServerAccessAttempts(10, $ldr->getFileLines());

$type = $uri == '/task1-json' ? 'json' : 'html';

/*
 *  Display data as:
 *  Html table
 *  http://localhost:8080/task1
 *  or
 *  Json string
 *  http://localhost:8080/task1-json
 */
DisplayData::showResults($task, $description, $result, ["License serial", "Number of attempts to access the server"], $type);
