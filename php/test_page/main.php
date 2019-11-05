<?php
	require_once("php/general/connect.php");
	require_once("php/general/data.php");
	function modal_form()
	{
		echo '
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary p-3" data-toggle="modal" data-target="#exampleModalCenter">
		<!--  Добавить в журнал -->
		Текст на кнопке
		</button>

		<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Добавить в журнал</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_form">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="form" enctype="application/x-www-form-urlencoded">
                            <div class="form-group">
                                <label for = "Number" class = "col-form-label">Номер Автомобиля:</label>
                                <input type="text" name="number" id="number" class="form-control" placeholder="Номер Автомобиля" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for = "Mark" class = "col-form-label">Марка Автомобиля:</label>
                                <input type="text" name="mark" id="mark" class="form-control" placeholder="Марка автомобиля" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for = "Date" class = "col-form-label">Дата Добавления:</label>
                                <input type="date" name="date" id="date" class="form-control" placeholder="Дата добавления" required autofocus>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" id="button_add">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
				';
	}

	function data_table($email ,$user_id)
	{
		$connection = connect('authorization', 'root', '');
		$data_array = get_journal_data_from_db($connection, $user_id);
		$code = '<caption>
        <h5>Журнал с данными пользователя '.$email.'!</h5>
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
		for ($i = 0; $i < count($data_array); $i++) {
			$data = $data_array[$i];
			$code .= '<tr>';
					$iter = 0;
					foreach ($data->value as $data_part) {
							$iter++;
							if ($iter == 2)
								continue;
							if ($iter == 1){
								$code.='<td width="7%">'.($i+1).'</td>';
							}else
							if ($iter == count($data->value)) {
									$code .= '<td width="11%">'.$data_part.'</td>';
							} else {
									$code .= '<td width="22%">'.$data_part.'</td>';
							}
					}
					$code .= '<td width="8%">Изменить</td>
					<td width="8%">Удалить</td>
			</tr>';
		}
		echo '
		<article class="m-5 entry">
				<table class="table" id="table">'.$code.'
				</table>
		</article>
		';
	}

?>
