<?php
require_once('connect.php');
$connection = connect('authorization');
setlocale(LC_ALL, 'ru_RU.UTF-8');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['inputText'])) {
        $text = $_POST['inputText'];
        $polite_text = '';
        $query = "SET NAMES utf8";
        mysqli_query($connection, $query);
        mb_internal_encoding('UTF-8');

        echo $text[0].' ';
        $query = "SELECT * FROM bad_words";
        $result = mysqli_query($connection, $query);
        $words = array_column(mysqli_fetch_all($result), 1);
        $words[8] = 'блять';
        foreach ($words as $word){
            while (1){
                echo $word[0].' ';
                $position = stripos($text, $word);
                echo  $position;
                $length = strlen($word);
                if (!$position) break;
                elseif ($position === 0) {
                    echo 6;
                    if (strlen($text) != $length && !ctype_alpha($text[$position + $length])) {
                        echo 1;
                        $polite_text .= stristr($text, $word, 1) . str_repeat("*", $length);
                        $text = substr($text, $position + $length);
                    }
                } elseif ($position + $length == strlen($text)){
                    echo 5;
                    if (!ctype_alpha($text[$position - 1])) {
                        echo 2;
                        $polite_text .= stristr($text, $word, 1) . str_repeat("*", $length);
                        $text = substr($text, $position + $length);
                        break;
                    }
                } else {
                    echo 4;
                    if (!ctype_alpha($text[$position - 1]) && !ctype_alpha($text[$position + $length]))  {
                        echo 3;
                        $polite_text .= stristr($text, $word, 1) . str_repeat("*", $length);
                        $text = substr($text, $position + $length);
                    }
                }
            }
            $text = $polite_text;
            $polite_text = '';
        }
        echo $text;
    }
}
?>