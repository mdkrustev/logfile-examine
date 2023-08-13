<?php


class LogicService
{
    public static function getTheMostServerAccessAttempts($first_serial_licenses, $fileLines): array
    {
        $elementCounts = array_count_values($fileLines);
        arsort($elementCounts);
        return array_slice($elementCounts, 0, $first_serial_licenses, true);
    }

    public static function getRuleBreakerDevices($fileLines): array
    {
        $buffer = [];
        $ruleBreakers = [];
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
    }

    public static function getHardwareDeviceSerials($fileLines): array
    {
        $devices = [];

        foreach ($fileLines as $device => $serials) {
            $devices[$device] = sizeof($serials);
        }

        arsort($devices);
       return $devices;
    }
}
