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
                    if (!is_array($index)) {
                        if (!empty($lineElements[$index]))
                            $lines[] = $lineElements[$index];
                    } else {

                        // Set many elements
                        $specLine = [];
                        foreach ($index as $element) {
                            //$empty_mac = 0;
                            if ($element == SPECS) {
                                if (!empty($lineElements[$element])) {
                                    $specs = str_replace('specs=', '', $lineElements[$element]);
                                    //try {
                                        // Decode base64
                                        $decodedData = base64_decode($specs);

                                        // Decompress gzip
                                        $decompressedData = gzdecode($decodedData);
                                        $specsArray = json_decode($decompressedData, true);

                                        /**
                                         * Set mac address as array string element
                                         * After decoding base64 | gzip some of the mac addresses are empty string
                                         * than mac address will be set as "00:00:00:00:00:00" value
                                         */

                                        //Set mac address as array string element
                                        if(!empty($specsArray['mac']) && $specsArray['mac'] != "null" && $specsArray['mac']) {
                                            $specLine[] = $specsArray['mac'];
                                        } else {
                                            $specLine[] = '00:00:00:00:00:00';
                                        }
                                        $specLine[] = $decompressedData;
                                }

                            } else {
                                if (!empty($lineElements[$element]))
                                    $specLine[] = $lineElements[$element];
                            }
                            $lines[] = $specLine;
                        }
                    }
                } else {
                    $lines[] = $line;
                }
                $count++;
                if ($limit && $count >= $limit) break;
            }
            fclose($file);
            // Set value to the class variable
            $this->fileLines = $lines;
        } else {
            echo "Failed to open the file.";
        }
    }


    public function getFileLines()
    {
        return $this->fileLines;
    }
}
