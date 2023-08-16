<?php

class LogfileData
{


    private $fileLines = [];

    public function setLinesLogFile($logFilePath, $indexes, $specs_type = null, $limit = null)
    {
        ini_set('memory_limit', '512M');

        $lines = [];
        $count = 0;
        if ($file = fopen($logFilePath, 'r')) {

            //Reading the file line by line
            while (($line = fgets($file)) !== false) {

                //Every line is separated with empty spaces into array elements
                $lineElements = explode(' ', $line);

                //If index is defined than find the element of line elements
                if ($indexes) {

                    // Set one element
                    if (!is_array($indexes)) {
                        if (!empty($lineElements[$indexes]))
                            $lines[] = $lineElements[$indexes];
                    } else {
                        // Set many elements
                        $specLine = [];
                        foreach ($indexes as $element) {

                            if ($element == SPECS) {
                                if (!empty($lineElements[$element])) {

                                    //Set mac address as a string
                                    if ($specs_type == SPECS_TYPE_MAC)
                                        $specLine[] = $this->setMac($lineElements[$element]);

                                    //Set hardware specification as a string
                                    if ($specs_type == SPECS_TYPE_HARDWARE) {
                                        $activeHardwareClass = $this->setHardware($lineElements[$element]);

                                        if ($activeHardwareClass)
                                            $specLine[] = $activeHardwareClass;
                                    }
                                }
                            } else {
                                if (!empty($lineElements[$element]))
                                    $specLine[] = $lineElements[$element];
                            }
                        }
                        if ($specs_type == SPECS_TYPE_HARDWARE) {

                            // If device is active than the second element of $specLine array should not be empty.
                            if (!empty($specLine[1])) {
                                $lines[$specLine[1]][] = $specLine[0];
                            }

                        } else {
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


    private function decodeBase64GzipJson($str)
    {
        // Decode base64
        $decodedData = base64_decode($str);
        // Decompress gzip
        $decompressedData = gzdecode($decodedData);
        return json_decode($decompressedData, true);
    }

    private function setMac($lineElement)
    {

        $specs = str_replace('specs=', '', $lineElement);
        $specsArray = $this->decodeBase64GzipJson($specs);

        /**
         * Set mac address as array string element
         * After decoding base64 | gzip some of the mac addresses are empty string
         * than mac address will be set as "00:00:00:00:00:00" value
         */

        //Set mac address as array string element
        if (!empty($specsArray['mac']) && $specsArray['mac'] != "null" && $specsArray['mac']) {
            $specLine = $specsArray['mac'];
        } else {
            $specLine = '00:00:00:00:00:00';
        }
        return $specLine;

    }


    private function setHardware($lineElement)
    {

        $specs = str_replace('specs=', '', $lineElement);
        $specsArray = $this->decodeBase64GzipJson($specs);

        if (!empty($specsArray['l2tp']) && $specsArray['l2tp'] == 'UP') {
            return 'cpu:'.$specsArray['cpu'];
        }
    }

    public function getFileLines()
    {
        return $this->fileLines;
    }
}
