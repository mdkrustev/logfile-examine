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
$ldr->setLinesLogFile($project_root . 'logfiles/updatev12-access-pseudonymized.log', [10,12], 10);

echo json_encode($ldr->getFileLines());

exit;
