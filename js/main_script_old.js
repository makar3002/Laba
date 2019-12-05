// функция для преобразования значений формы в формат JSON
$.fn.serializeObject = function(){

    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

// функция setCookie() поможет нам сохранить JWT в файле cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


// Функция поможет нам прочитать JWT, который мы сохранили ранее.
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' '){
            c = c.substring(1);
        }

        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

var SetJournalTable = function(arr){
	//data-toggle="modal" data-target="#modalCreateCenter"
	var addButton = `
	<button type="button" class="btn btn-primary p-3" id="buttonCreate">
		Добавить в журнал
  	</button>
	`;
	var table = `<table class="table">
	<caption>
		<h5>Журнал</h5>
	</caption>
	<tr>
		<td width="7%">№</td>
		<td width="22%">Номер автомобиля</td>
		<td width="22%">Марка</td>
		<td width="22%">Дата принятия</td>
		<td width="9%">Статус</td>
		<td width="9%">Изменить</td>
		<td width="9%">Удалить</td>
	</tr>`;
	for(var i = 0; i < arr.values.length; i++){
		table +=
		'<td width="7%">'+(i+1)+'</td>'+
            '<td width="22%">'+arr.values[i]['number']+'</td>'+
            '<td width="22%">'+arr.values[i]['mark_name']+'</td>'+
            '<td width="22%">'+arr.values[i]['date']+'</td>'+
            '<td width="11%">'+arr.values[i]['status']+'</td>'+
            '<td width="8%"><button type="button" class="btn btn-primary change p-0" id="button_chan_'+arr.values[i]['id']+'">Изменить</button></td>'+
            '<td width="8%"><button type="button" class="btn btn-primary delete p-0" id="button_del_'+arr.values[i]['id']+'">Удалить</button></td>'+
        '</tr>';
	}
	table += '</table>';
	$("#journalTable").html(addButton + table);
	$("#buttonCreate").click(function(event){
		event.preventDefault();
		$.ajax({
			url: 'php/mark_notes/read.php',
			dataType : 'json',
			success: function(response){

				var marksOptions = "";
				for(var i = 0; i < response.values.length; i++){
					marksOptions += '<option>'+response.values[i].mark_name+'</option>'
				}
				$("#modalFormMain").html(`
					<!-- Create Modal -->
					<div class="modal fade" id="modalFormCreate" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalLongTitle">Добавить в журнал</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCreateModal">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form class="form" id="createForm" enctype="application/x-www-form-urlencoded">
										<div class="form-group">
											<label for="number" class="col-form-label">Номер автомобиля:</label>
											<input type="text" name="number" id="addNumber" class="form-control" placeholder="Номер автомобиля" required autofocus>
										</div>
										<div class="form-group">
											<label for="mark" class="col-form-label">Марка автомобиля:</label>
											<select name="mark" id="addMark" class="form-control mark" required>
											</select>
										</div>
										<div class="form-group">
											<label for="date" class="col-form-label">Дата добавления:</label>
											<input type="date" name="date" id="addDate" class="form-control" placeholder="Дата добавления" required>
										</div>
										<div class="modal-footer">
											<button class="btn btn-primary" type="submit" id="buttonAdd">Добавить</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>`);
				$("#modalFormCreate").modal('show');
				$('#modalFormCreate').on('hidden.bs.modal', function (e) {
					$("#modalFormMain").html('');
				})
			}
		});
	});
}

var SetJournalPage = function(){
	$("main").html(`<div class="text-center" id="journalTable"></div>`);
	var cookieData='{"jwt":"'+getCookie("jwt")+'"}';
	//alert(cookieData);
	$.ajax({
		url:"php/journal/read.php",
		type : "POST",
		contentType : 'raw',
		dataType : 'json',   
       	data : cookieData,
       	success : function(result) {
			//alert(result);   
			SetJournalTable(result);
        },
		error: function(xhr, resp, text){
           	$("#journalTable").html("<p class='text-danger'>Неправильный логин или пароль!</p>"+text);
        }
	});
	//AJAX-запрос на сервер
	//Если пришел положительный ответ (200), то
	// SetJournalTable()	
	//Иначе
	// в center div положить сообщение об ошибке
}

var SetIndexPage = function(){
	$("main").html(`
		<article class=" d-flex entry">
			<section class="m-3 idea">
				<h2>Автомобильный гараж</h2>
				<h1>У нас только лучшие тачки!</h1>
				<p>Качественный сервис, Экзибит позавидует!</p>
				<p>Охрана и хранение вашей ласточки</p>
				<p>Охрана и хранение вашей ласточки</p>
			</section>
			<section class="m-3 contacts">
				<h1>Контакты: </h1>
				<p>///...///</p>
				<p>///...///</p>
				<p>///...///</p>
			</section>
		</article>
		<section class="photos">
			<figure class="slides">
				<img src="images/mainpage/1.jpg" alt="Машина 1">
				<img src="images/mainpage/2.jpeg" alt="Машина 2">
				<img src="images/mainpage/3.jpg" alt="Машина 3">
				<img src="images/mainpage/4.jpg" alt="Машина 4">
			</figure>
		</section>
		`);
};

var SetHeaderButtons = function(){
		var jwt = $.cookie("jwt");
		if(jwt === undefined || jwt === '')
		{
			$("#header_buttons").html('<button type="button" class="btn btn-outline-primary my-2 mx-2 my-sm-0" data-toggle="modal" data-target="#modalFormReg">Регистрация</button>'+'<button type="button" class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#modalFormAuth">Войти</button>');
			$("#modalFormHeader").html(`
				<div class="modal fade" id="modalFormAuth" tabindex="-1" role="dialog" aria-labelledby="modalFormAuthTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
									<div class="modal-header">
											<h5 class="modal-title" id="modalLongTitle">Авторизация</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeAuthModal">
													<span aria-hidden="true">&times;</span>
											</button>
									</div>
									<div class="modal-body">
											<form class="form" id="form_auth" enctype="application/x-www-form-urlencoded">
													<div class="form-group">
														<label for="email" class="col-form-label">Адрес электронной почты</label>
														<input type="text" name="email" id="email_auth" class="form-control" placeholder="" required autofocus>
													</div>
													<div class="form-group">
															<label for="password" class="col-form-label">Пароль</label>
															<input type="password" name="password" id="password_auth" class="form-control" required>
													</div>
													<div id="response"></div>
													<div class="checkbox mb-3">
					                    				<label>
					                        				<input type="checkbox" value="remember-me"> Запомнить меня
					                    				</label>
					                				</div>
													<div class="modal-footer">
														<button class="btn btn-primary" type="submit" id="button_auth">Авторизоваться</button>
													</div>
											</form>
									</div>
							</div>
					</div>
			</div>
			<div class="modal fade" id="modalFormReg" tabindex="-1" role="dialog" aria-labelledby="modalFormRegTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
									<div class="modal-header">
											<h5 class="modal-title" id="modalLongTitle">Регистрация</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCreateModal">
													<span aria-hidden="true">&times;</span>
											</button>
									</div>
									<div class="modal-body">
											<form class="form" id="form_reg" enctype="application/x-www-form-urlencoded">
													<div class="form-group">
															<label for="email" class="col-form-label">Адрес электронной почты</label>
															<input type="text" name="email" id="email_reg" class="form-control" placeholder="" required autofocus>
													</div>
													<div class="form-group">
															<label for="password" class="col-form-label">Пароль</label>
															<input type="password" name="password" id="password_reg" class="form-control" required>
													</div>
													<div class="form-group">
															<label for="password_rep" class="col-form-label">Повторите пароль</label>
															<input type="password" name="password_rep" id="password_rep_reg" class="form-control" required>
													</div>
													<div class="modal-footer">
															<button class="btn btn-primary" type="submit" id="button_reg">Зарегистрироваться!</button>
													</div>
											</form>
									</div>
							</div>
					</div>
			</div>`);
			$('#modalFormAuth').on('hide.bs.modal', function (e) {
  				$("#response").html("");
			});
			$("#button_auth").click(function (event){
				event.preventDefault();
				//Потом здесь будет валидация
				
				var form = $("#form_auth");
				var form_data=JSON.stringify(form.serializeObject());
				alert(form_data);
				$.ajax({
					url:"php/login.php",
					type : "POST",
        			contentType : 'raw',
        			data : form_data,
        			success : function(result) {
            			// сохранить JWT в куки
            			setCookie("jwt", result.jwt, 1);
            			$(".close").click();
            			SetHeaderButtons();
            		},
					error: function(xhr, resp, text){
            			$("#response").html("<p class='text-danger'>Неправильный логин или пароль!</p>");
            		}
				});
			});
			$("#button_reg").click(function (event){
				event.preventDefault();
				//Потом здесь будет валидация
				
				var form = $("#form_reg");
				var form_data=JSON.stringify(form.serializeObject());
				$.ajax({
					url:"php/user/create.php",
					type : "POST",
        			contentType : 'raw',
        			data : form_data,
        			success : function(result) {
            			 // сохранить JWT в куки
            			setCookie("jwt", result.jwt, 1);
            			$(".close").click();
            			SetHeaderButtons();
					},
					error: function(xhr, resp, text){
            			alert("что то пошло не так ..."+text);
            		}
				});
			});
		}
		else {
			$("#header_buttons").html(`<button type="button" class="btn btn-outline-primary my-2 mx-2 my-sm-0" id="logout">Выйти</button>`);
			$("#logout").click(function(event){
				    // удаление jwt
    				setCookie("jwt", "", 1);
					SetHeaderButtons();
					SetIndexPage();
			});

		}
}


$(document).ready(function() {
	var magic_button =$('magic_button');
	$('#magic_button').click(function(event){
		event.preventDefault();
		alert(document.cookie);
	});
	$("#journal").click(function(event){
		event.preventDefault();
		SetJournalPage();
	});
	$("#index").click(function(event){
		event.preventDefault();
		SetIndexPage();	
	})
	SetHeaderButtons();
	SetIndexPage();

});
