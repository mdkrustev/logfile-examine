<?php


class LogicService
{
    public static function getTheMostServerAccessAttempts($first_serial_licenses, $fileLines)
    {
        $elementCounts = array_count_values($fileLines);
        arsort($elementCounts);
        return array_slice($elementCounts, 0, $first_serial_licenses, true);
    }

    public static function getRuleBreakerDevices($fileLines)
    {
        $buffer = [];
        $ruleBreakers = [];
        //$fileLines = array_slice($fileLines, 0, 100);
        //echo json_encode($fileLines);
        //exit;
        foreach ($fileLines as $lineArray) {
            $serial = !empty($lineArray[0]) ? str_replace("serial=", "", $lineArray[0]) : null;

            if ($serial) {

                $mac = $lineArray[1];
                if ($mac == null) continue;

                if (!isset($buffer[$serial]))
                    $buffer[$serial] = [];

                if (!in_array($mac, $buffer[$serial]))
                    $buffer[$serial][] = $mac;

                // There is more than one distinct mac address
                if (sizeof($buffer[$serial]) > 1) {

                    $ruleBreakers[$serial] = [];
                    foreach ($buffer[$serial] as $bufferSerialMac) {
                        $ruleBreakers[$serial][] = $bufferSerialMac;
                    }
                }
            }
        }

        arsort($ruleBreakers);

        return array_slice($ruleBreakers, 0, 10, true);

        //$ruleBreakers


        // Sort the array using the custom comparison function
        /*uasort($ruleBreakers, function ($a, $b) {
            $countA = count($a);
            $countB = count($b);
            if ($countA === $countB)
                return 0;
            return ($countA > $countB) ? -1 : 1;
        });

        $mostRuleBreakers = [];
        $count = 0;
        foreach ($ruleBreakers as $serial => $ruleBreaker) {
            if($count >= 10) break;
            $mostRuleBreakers[$serial] = $ruleBreaker;
            $count++;
        }*/


        //return $mostRuleBreakers;
    }

    /*
 * ($a, $b) {
        $countA = count($a);
        $countB = count($b);

        if ($countA === $countB) {
            return 0;
        }

        return ($countA > $countB) ? -1 : 1;
    }
 */
}
