<?php
/**
 * @var $project_root
 * @var $style
 * @var $uri
 * @var $task
 * @var $description
 */

$ldr = new LogfileData();
// Read data from log file and make array from all serials;
$ldr->setLinesLogFile($project_root . 'logfiles/updatev12-access-pseudonymized.log', 10);

// Get the first 10 from array that try to access the server the most
$result = $ldr->getTheMostServerAccessAttempts(10);

$type = $uri == '/task1-json' ? 'json' : 'html';

/*
 *  Display data as:
 *  Html tabel
 *  http://localhost:8080/task1
 *  or
 *  Json string
 *  http://localhost:8080/task1-json
 */
DisplayData::showResults($task, $description, $result, ["License serial", "Number of attempts to access the server"], $type, $style);
