<?php


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

$project_root = $_SERVER['DOCUMENT_ROOT'] . '/../';

//Loading the css style from resources
$style = file_get_contents($project_root . 'resources/css/logfile-examine.css');

require $project_root . 'src/service/DisplayData.php';
require $project_root . 'src/service/LogfileData.php';

$uri = $_SERVER['REQUEST_URI'];

//Request a different task by calling a different URL
switch ($uri) {
    case '/':
        require_once $project_root . 'src/tasks/default.php';
        break;
    default:
        foreach ($tasks as $task => $description) {
            if ($uri == "/$task" || $uri == "/$task-json")
                require_once $project_root . '/src/tasks/' . $task . '.php';
        }
}

die('404 Page not found');
