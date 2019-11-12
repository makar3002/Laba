<?php
function marks_html_produce($data)
{
    $code = '<caption>
        <h5>Список марок!</h5>
    </caption>
    <tr>
        <td width="10%">№</td>
        <td width="35%">Картинка</td>
        <td width="35%">Название</td>
        <td width="10%">Изменить</td>
        <td width="10%">Удалить</td>
    </tr>';
    for ($i = 1; $i <= count($data); $i++) {
        $r = $data[$i - 1];
        $code .= '<tr>
            <td width="10%">'.$i.'</td>';
        $code .= '<td width="35%"><a class="popupimg">Картинка<span><img src="files/images/marks/'.$r['id'].'.png" alt="'.$r['mark_name'].'"></span></a></td>';
        $code .= '<td width="35%">'.$r['mark_name'].'</td>';
        $code .= '<td width="10%"><button type="button" class="btn btn-primary change p-0" id="button_chan_'.$r['id'].'">Изменить</button></td>
            <td width="10%"><button type="button" class="btn btn-primary delete p-0" id="button_del_'.$r['id'].'">Удалить</button></td>
        </tr>';
    }
    return $code;
}
?>
