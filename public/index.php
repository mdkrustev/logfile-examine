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
    On how many distinct devices are these licenses installed?<br><br>Solution: For every line from the log file 'specs' is a string and after decoding, it becomes an object array. It is necessary to create new array,
    which is used to grouping mac addresses by license serial. When one license is installed on more than one device than from the grouped mac addresses array by license get only the keys which arrays are more than one element.
    ",

    // Task 3
    "task3" => "Bonus: Based on the information given in the specs metadata, try to identify the
    different classes of hardware that are in use and provide the number of licenses that are
    active on these types of hardware.
    <br><br>Solution:
    First, active devices should be detected according to the l2tp parameter found in the array obtained by decoding 'specs'. It should be in 'UP' status. Licenses are then grouped by CPU for each device.
    ",
];



const SPECS = 12;
const SERIAL = 10;

const SPECS_TYPE_MAC = 'specs_type_mac';
const SPECS_TYPE_HARDWARE = 'specs_type_hardware';



//Loading the css style from resources
$style = file_get_contents(PROJECT_ROOT . 'resources/css/logfile-examine.css');
$script = file_get_contents(PROJECT_ROOT . 'resources/js/logfile-examine.js');
define("STYLE", $style);
define("SCRIPT", $script);

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
