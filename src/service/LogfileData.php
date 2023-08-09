<?php

class LogfileData
{
    private $fileLines = [];

    public function setLinesLogFile($logFilePath, $index = null, $limit = null)
    {
        ini_set('memory_limit', '5012M');

        $lines = [];
        $count = 0;
        if ($file = fopen($logFilePath, 'r')) {

            //Reading the file line by line
            while (($line = fgets($file)) !== false) {

                //Every line is separated with empty spaces into array elements
                $lineElements = explode(' ', $line);

                //If index is defined than find the element of line elements
                if ($index) {

                    // Set one element
                    if(!is_array($index)) {
                        if (!empty($lineElements[$index]))
                            $lines[] = $lineElements[$index];
                    } else {

                    // Set many elements
                        $specLine = [];
                        foreach ($index as $element)
                            $specLine[] = $lineElements[$element];
                        $lines[] = implode(" ", $specLine);
                    }
                } else {
                    $lines[] = $line;
                }
                $count++;
                if($limit && $count >= $limit) break;
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

    public function getFileLines() {
        return $this->fileLines;
    }
}
