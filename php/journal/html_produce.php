<?php
function authorized_journal_html_produce($data, $email, $type = '', $mark_name = null)
{
    $code = '<article class="m-5 entry">';
    if (count($data) == 0)
    {
        $code .= '<h5>По пользователю ' . "$email" . ' нет данных' . (($type == 'byMark') ? (' с маркой '.$mark_name) : ''). '!</h5>';
    }
    else
    {
        $code .= '<table class="table">
            <caption>
                <h5>Журнал с данными пользователя ' . "$email" . (($type == 'byMark') ? (' с маркой '.$mark_name) : ''). '!</h5>
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
            $code .= '<td width="22%">' . (($type != 'byMark') ? ('<a href class="markOfJournalNote" id="journal_note_'.$r['id'].'">'.$r['number'].'</a>') : ($r['number'])) . '</td>
                <td width="22%">'.$r['mark_name'].'</td>
                <td width="22%">'.$r['date'].'</td>
                <td width="11%">'.$r['status'].'</td>
                <td width="8%"><button type="button" class="btn btn-primary change p-0" id="button_chan_'.$r['id'].'">Изменить</button></td>
                <td width="8%"><button type="button" class="btn btn-primary delete p-0" id="button_del_'.$r['id'].'">Удалить</button></td>
            </tr>';
        }
        $code .= '</table>';
    }

    $code .= '</article>';
    return $code;
}

function unauthorized_journal_html_produce()
{
    return '<article class="m-5 entry">
        <h5>Вы не авторизованы, авторизуйтесь, пожалуйста</h5>
    </article>';
}

function marks_select_html_produce($marks)
{
    $code = '<option value = "">Не выбрано</option>';
    foreach ($marks as $mark){
        $code .= '<option value = '.$mark['id'].'>'.$mark['mark_name'].'</option>';
    }
    return $code;
}
?>
