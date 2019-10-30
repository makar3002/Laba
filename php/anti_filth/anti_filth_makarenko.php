<?php
require_once('../general/connect.php');
require_once('change_text.php');
$connection = connect1('authorization', 'root', '');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['input_text'])) {
        $text = $_POST['input_text'];
        $polite_text = '';
        mb_internal_encoding('utf-8');
        $query = "SET NAMES utf8";
        $connection->prepare($query)->execute();
        $query = "SELECT * FROM bad_words";
        $sdh = $connection->prepare($query);
        $sdh->execute();

        $words = array_column($sdh->fetchAll(), 1);
        foreach ($words as $word){
            do  {
                $position = mb_stripos($text, $word);
                $length = mb_strlen($word);
                if ($position === false) $polite_text .= $text;
                else full_change($text, $word, $polite_text, $position, $length);
            } while ($position !== false);
            $text = $polite_text;
            $polite_text = '';
        }
        echo $text;
    }
}
?>