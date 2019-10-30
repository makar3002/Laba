<?php
function check_format ($data, $type){
    switch ($type) {
        case 'email':
            $pattern = '/[a-zA-Z0-9][a-zA-Z0-9\._]*@[a-zA-Z0-9]+\.[a-zA-Z0-9]+/';
            if (preg_match($pattern, $data)) {
                return true;
            }
            return false;
        case 'string':
            foreach ($data as $char) {
                if (is_numeric($char)) return false;
            }
            return true;
            break;
        default:
            return false;
    }

}