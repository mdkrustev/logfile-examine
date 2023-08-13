<?php


class DisplayData
{
    public static function showResults($title, $description, $data, $tableHeaders = ['key', 'value'], $type = 'html', $style = null, $keyAsUri = false)
    {
        switch ($type) {
            case 'html':

                echo "<style>" . STYLE . "</style>";
                echo "<script>" . SCRIPT . "</script>";
                echo '<div class="results">';
                if ($title) {
                    echo '<div class="title"><a href="/">Back to the Tasks</a> / ' . ucfirst($title) . '</div>';
                } else {
                    echo '<div class="title">Tasks</div>';
                }
                echo '<p class="description">' . $description . '</p>';
                echo self::htmlTable($data, $tableHeaders, $keyAsUri);
                echo '</div>';
                break;
            case 'json':
                self::asJson($data);
                break;
        }
        exit;
    }

    public static function htmlTable($data, $tableHeaders = ['key', 'value'], $keyAsUri = false)
    {

        // Create an HTML table
        $html = "<table>";
        $html .= "<tr>";
        foreach ($tableHeaders as $th)
            $html .= "<th>" . $th . "</th>";
        $html .= "</tr>";
        foreach ($data as $key => $value) {
            $row++;
            $html .= "<tr>";
            $tdKey = $keyAsUri ? '<a href="/' . $key . '">' . $key . '</a>' : $key;
            $html .= "<td>
       
            $tdKey</td>";
            if (is_array($value)) {
                $html .= "<td>";
                foreach ($value as $item) {
                    $html .= '<div>' . $item . '</div>';
                }
                $html .= "</td>";
            } else {
                $html .= "<td>$value</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        return $html;
    }

    public static function asJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
