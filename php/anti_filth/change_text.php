<?php
function change(&$text, &$polite_text, $position, $length) {
    $polite_text .= mb_substr($text, 0, $position) . str_repeat("*", $length);
    $text = mb_substr($text, $position + $length);
}

function without_change(&$text, $word, &$polite_text, $position, $length) {
    $polite_text .= mb_substr($text, 0, $position+$length);
    $text = mb_substr($text, $position + $length);
}

function mb_ctype_alpha($char){
    return preg_match("/[a-zA-Zа-яА-Я]/", $char) === 1;
}

function full_change(&$text, $word, &$polite_text, $position, $length){
    if ($position === 0) {
        if (mb_strlen($text) == $length) {
            change($text, $polite_text, $position, $length);
        } else {
            $text_part_after = mb_substr($text, $position + $length,1);
            if (!mb_ctype_alpha($text_part_after)) change($text, $polite_text, $position, $length);
            else without_change($text, $word, $polite_text, $position, $length);
        }
    } elseif ($position + $length == mb_strlen($text)){
        if ($position >= 1) {
            $text_part_before = mb_substr($text, $position - 1,1);
            if (!mb_ctype_alpha($text_part_before)) change($text, $polite_text, $position, $length);
            else without_change($text, $word, $polite_text, $position, $length);
        }
    } else {
        $text_part_after = mb_substr($text, $position + $length,1);
        $text_part_before = mb_substr($text, $position - 1,1);
        if (!mb_ctype_alpha($text_part_before) && !mb_ctype_alpha($text_part_after)) change($text, $polite_text, $position, $length);
        else without_change($text, $word, $polite_text, $position, $length);
    }
}
?>