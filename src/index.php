<?php
require __DIR__ . '/service/DisplayData.php';
require __DIR__ . '/service/LogfileData.php';

switch ($_SERVER['REQUEST_URI']) {
    case '/task1':
    case '/task1-json':

        $ldr = new LogfileData();
        // Read data from log file and make array from all serials;
        $ldr->setLinesLogFile(__DIR__ . '/logfiles/updatev12-access-pseudonymized.log', 10);

        // Get the first 10 from array that try to access the server the most
        $result = $ldr->getTheMostServerAccessAttempts(10);

        $type = $_SERVER['REQUEST_URI'] == '/task1-json' ? 'json' : 'html';

        /*
         *  Display data as:
         *  Html tabel
         *  http://localhost:8080/task1
         *  or
         *  Json string
         *  http://localhost:8080/task1-json
         */
        DisplayData::showResults($result, ["License serial", "Number of attempts to access the server"], $type);

        break;
    case '/task2':
        break;
}
