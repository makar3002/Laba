<?php
function check_format ($data, $type)
{
    switch ($type)
    {
        case 'email': //проверка регуляркой на email
            $pattern = '/[a-zA-Z0-9][a-zA-Z0-9\._]*@[a-zA-Z0-9]+\.[a-zA-Z0-9]+/';
            if (preg_match($pattern, $data))
            {
                return true;
            }
            return false;
        case 'word': //проверка на слово
            for ($i = 0; $i < mb_strlen($data); $i++)
            {
                if (preg_match("/[a-zA-Zа-яА-Я]/", mb_substr($data, $i, 1)) === 0) return false;
            }
            return true;
        case 'date': // проверка на дату формата уууу-мм-дд
            if (mb_strlen($data) == 10)
            {
                $day = mb_substr($data, 8, 2);
                $month = mb_substr($data, 5, 2);
                $year = mb_substr($data, 0, 4);
                if (strlen($year.$month.$day) == strlen((int)$year.$month.$day))
                { //если приведение типов не уменьшило количество символов в конкатинации всех трех величин, значит, они все натуральные числа
                    $day = (int) $day; //приводим к натуральным числам, чтобы быть уверенными, что операции сравнения проводятся с числами, а не со строками
                    $month = (int) $month;
                    $year = (int) $year;
                }
                else return false;
                if ($year >= 1000 && $year <= 3000 && $month >= 1 && $day >= 1)
                {
                    if ($month == 2)
                    {
                        if ($year % 4 == 0 && $day <= 29) return true; //проверка на февраль високосного года
                        elseif  ($year % 4 != 0 && $day <= 28) return true;
                    }
                    elseif ($month <= 12 && $day >= 1)
                    {
                        if ($month % 2 == 0 && $day <= 30) return true;
                        elseif ($month % 2 == 1 && $day <= 31) return true;
                    }
                }
            }
            return 0;
        case 'password':
            if (mb_strlen($data) > 5)
            {
                return true;
            }
            return false;
        default:
            return false;
    }
}