<?php
function search_html_produce($data, $request)
{
    if (isset($data['journal'])) $journal_data = $data['journal'];
    if (isset($data['marks'])) $marks_data = $data['marks'];

    $code = '<article class="m-5 entry">';

    if (empty($journal_data) && empty($marks_data))
    {
        $code .= '<h5>По запросу "' . $request . '" ничего не найдено!</h5>';
    }
    else
    {
        if (count($marks_data) == 0)
        {
            $code .= '<h5>Марок по запросу "' . $request . '" не найдено!</h5>';
        }
        else
        {
            $code .= '<table class="table">
        <caption>
            <h5>Список марок по запросу "' . $request . '"!</h5>
        </caption>
        <tr>
            <td width="20%">№</td>
            <td width="40%">Картинка</td>
            <td width="40%">Название</td>
        </tr>';
            for ($i = 1; $i <= count($marks_data); $i++) {
                $r = $marks_data[$i - 1];
                $code .= '<tr>
                <td width="20%">'.$i.'</td>';
                $code .= '<td width="40%"><a class="popupimg">Картинка<span><img src="files/images/marks/'.$r['id'].'.png" alt="'.$r['mark_name'].'"></span></a></td>';
                $code .= '<td width="40%">'.$r['mark_name'].'</td>';
                $code .= '</tr>';
            }
            $code .= '</table>';
        }

        $code .= '<br>';

        if (count($journal_data) == 0)
        {
            $code .= '<h5>Записей журнала по запросу "' . $request . '" не найдено!</h5>';
        }
        else
        {
            $code .= '<table class="table">
            <caption>
                <h5>Записи журнала по запросу "' . $request . '"!</h5>
            </caption>
            <tr>
                    <td width="11%">№</td>
                    <td width="26%">Номер автомобиля</td>
                    <td width="26%">Марка</td>
                    <td width="26%">Дата принятия</td>
                    <td width="11%">Статус</td>
                </tr>';
            for ($i = 1; $i <= count($journal_data); $i++) {
                $r = $journal_data[$i - 1];
                $code .= '<tr>
                    <td width="11%">' . $i . '</td>';
                $code .= '<td width="26%">' . $r['number'] . '</td>
                    <td width="26%">' . $r['mark_name'] . '</td>
                    <td width="26%">' . $r['date'] . '</td>
                    <td width="11%">' . $r['status'] . '</td>
                </tr>';
            }
            $code .= '</table>';
        }
    }

    $code .= '</article>';

    return $code;
}

?>
