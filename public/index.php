<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

define("PROJECT_ROOT", $_SERVER['DOCUMENT_ROOT'] . '/../');

$tasks = [
    // Task 1
    "task1" => "What are the 10 license serial numbers that try to access the server the most? How many
    times are they trying to access the server?",

    // Task 2
    "task2" => "One license serial number should only be active on one physical device. Describe how
    you identify a single device as such. Provide a way to identify licenses that are installed
    on more than one device. What are the 10 license serials that violoate this rule the most?
    On how many distinct devices are these licenses installed?",

    // Task 3
    "task3" => "Bonus: Based on the information given in the specs metadata, try to identify the
    different classes of hardware that are in use and provide the number of licenses that are
    active on these types of hardware.",
];



const SPECS = 12;
const SERIAL = 10;



//Loading the css style from resources
$style = file_get_contents(PROJECT_ROOT . 'resources/css/logfile-examine.css');

require PROJECT_ROOT . 'src/service/DisplayData.php';
require PROJECT_ROOT . 'src/service/LogfileData.php';
require PROJECT_ROOT . 'src/service/LogicService.php';

$uri = $_SERVER['REQUEST_URI'];

//Request a different task by calling a different URL
switch ($uri) {
    case '/':
        require_once PROJECT_ROOT . 'src/tasks/default.php';
        break;
    default:
        foreach ($tasks as $task => $description) {
            if ($uri == "/$task" || $uri == "/$task-json")
                require_once PROJECT_ROOT . '/src/tasks/' . $task . '.php';
        }
}

die('404 Page not found');
