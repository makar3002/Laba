<?php
function authorized_journal_html_produce($data, $email)
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
            <td width="22%">'.$r['mark_name'].'</td>
            <td width="22%">'.$r['date'].'</td>
            <td width="11%">'.$r['status'].'</td>
            <td width="8%"><button type="button" class="btn btn-primary change p-0" id="button_chan_'.$r['id'].'">Изменить</button></td>
            <td width="8%"><button type="button" class="btn btn-primary delete p-0" id="button_del_'.$r['id'].'">Удалить</button></td>
        </tr>';
    }
    return $code;
}

function unauthorized_journal_html_produce(){
    return '<h5>Вы не авторизованы, авторизуйтесь, пожалуйста</h5>';
}

function marks_select_html_produce($marks){
    $code = '<option value = "">Не выбрано</option>';
    foreach ($marks as $mark){
        $code .= '<option value = '.$mark['id'].'>'.$mark['mark_name'].'</option>';
    }
    return $code;
}
?>
