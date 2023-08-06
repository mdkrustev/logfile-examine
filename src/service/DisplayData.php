<?php


class DisplayData
{
    public static function showResults($data, $tableHeaders = ['key', 'value'], $type = 'html')
    {
        switch ($type) {
            case 'html':
            self::htmlTable($data, $tableHeaders);
            break;
            case 'json':
                self::asJson($data);
                break;
        }
    }

    public static function htmlTable($data, $tableHeaders = ['key', 'value'])
    {
        $html = "<style>
                    table {border: 1px solid #000; border-collapse: collapse; width: 100%; max-width: 991px; font-family: Arial, sans-serif}
                    th, td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background: #000;
                        color: #fff;
                    }
                 </style>";
        // Create an HTML table
        $html .= "<table>";
        $html .= "<tr>";
        foreach ($tableHeaders as $th) {
            $html .= "<th>" . $th . "</th>";
        }
        $html .= "</tr>";

        foreach ($data as $key => $value) {
            $html .= "<tr>";
            $html .= "<td>$key</td>";
            $html .= "<td>$value</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
        echo $html;
        exit;
    }
    public static function asJson($data) {
        header('Content-type: application/json');
        echo json_encode($data);
        exit;
    }
}
