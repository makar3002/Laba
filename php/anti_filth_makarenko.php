<?php
require_once('connect.php');
require_once('change_text.php');
$connection = connect('authorization');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['input_text'])) {
        $text = $_POST['input_text'];
        $polite_text = '';
        mb_internal_encoding('utf-8');
        $query = "SET NAMES utf8";
        mysqli_query($connection, $query);
        $query = "SELECT * FROM bad_words";
        $result = mysqli_query($connection, $query);
        $words = array_column(mysqli_fetch_all($result), 1);
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