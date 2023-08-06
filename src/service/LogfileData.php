<?php

class LogfileData
{
    private $fileLines = [];

    public function setLinesLogFile($logFilePath, $index = null)
    {
        ini_set('memory_limit', '5012M');

        $lines = [];
        if ($file = fopen($logFilePath, 'r')) {

            //Reading the file line by line
            while (($line = fgets($file)) !== false) {

                //Every line is separated with empty spaces into array elements
                $lineElements = explode(' ', $line);

                //If index is defined than find the element of line elements
                if ($index) {
                    if (!empty($lineElements[$index]))
                        $lines[] = $lineElements[10];
                } else {
                    $lines[] = $line;
                }
            }
            fclose($file);
            // Set value to the class variable
            $this->fileLines = $lines;
        } else {
            echo "Failed to open the file.";
        }
    }

    public function getTheMostServerAccessAttempts($first_serial_licenses)
    {
        $elementCounts = array_count_values($this->fileLines);
        arsort($elementCounts);
        return array_slice($elementCounts, 0, $first_serial_licenses, true);
    }
}
