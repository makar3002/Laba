<?php
function authorized_html_produce($data, $email, $marks)
{
    $code = '<caption>
        <h5>Журнал с данными пользователя '."$email".'!</h5>
    </caption>
    <tr>
        <td width="7%">№</td>
        <td width="22%">Номер автомобиля</td>
        <td width="22%">Марка</td>
        <td width="22%">Дата принятия</td>
        <td width="9%">Статус</td>
        <td width="9%">Изменить</td>
        <td width="9%">Удалить</td>
    </tr> ';
    for ($i = 1; $i <= count($data); $i++) {
        $r = $data[$i - 1];
        $code .= '<tr>
            <td width="7%">'.$i.'</td>';
            $code .= '<td width="22%">'.$r['number'].'</td>
            <td width="22%">'.$marks[$r['mark_id']].'</td>
            <td width="22%">'.$r['date'].'</td>
            <td width="11%">'.$r['status'].'</td>
            <td width="8%">Изменить</td>
            <td width="8%">Удалить</td>
        </tr>';
    }
    return $code;
}

function unauthorized_html_produce(){
    return '<h5>Вы не авторизованы, авторизуйтесь, пожалуйста</h5>';
}

function marks_select_html_produce($marks){
    $code = '';
    foreach ($marks as $mark){
        $code .= '<option value = '.$mark['id'].'>'.$mark['mark_name'].'</option>';
    }
    return $code;
}
?>
