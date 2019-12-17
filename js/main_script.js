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

function modalFormMessage(mes){
	$("#modalFormMain").html(`
	<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalFormMessage">
		<div class="modal-dialog modal-dialog-centered modal-sm">
		
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Сообщение</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				`+mes+`
			</div>
		</div>
		</div>
	</div>
	  `);
	$("#modalFormMessage").modal('show');
	$('#modalFormMessage').on('hidden.bs.modal', function (e) {
		$("#modalFormMain").html('');
	})
}

//В fields подается ассоциативный массив (map), у которого поля - названия полей формы,
//а значения полей - {'type': ... , ' label': ...}, 
//где type - тип поля, а label - надпись над полем формы 
//Соотв. password - пароль, array - ассоциативный массив (map) с данными для select'а

function modalForm(name, fields, buttonName, buttonCallback){
	var formName = "modalForm";
	var dataFormName = "dataModalForm";
	var formFields = "";
	fields.forEach(function(value, key, map){
		switch(value.type){
			case "date":
			case "password":
			case "text" : formFields+=`<div class="form-group">
				<label for="${key}" class="col-form-label">${value.label}</label>
				<input type="${value.type}" name="${key}" class="form-control" placeholder="${value.label}" required autofocus>
				</div>`;
				break;
			case "select":
				var selectOptions = "";
				value.array.forEach(function(val, ind, ar){
					selectOptions+=`<option value="${ind}">${val}</option>`;
				});
				formFields+=`<div class="form-group">
				<label for="${key}" class="col-form-label">${value.label}</label>
				<select name="${key}" id="addMark" class="form-control mark" required>
				${selectOptions};
				</select>
				</div>`;
		}
	});
	$("#modalFormMain").html(`
					<div class="modal fade" id="${formName}" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalLongTitle">${name}</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form class="form" id="${dataFormName}" enctype="application/x-www-form-urlencoded">
										${formFields}
										<div class="modal-footer">
											<button class="btn btn-primary" type="submit" id="modalFormButton">${buttonName}</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>`);
					$("#modalFormButton").click(function(event){buttonCallback(event, formName, dataFormName)});
					$("#modalForm").modal('show');
					$('#modalForm').on('hidden.bs.modal', function (e) {
						$("#modalFormMain").html('');
					})
}

var SetJournalTable = function(arr){
	var addButton = `
	<button type="button" class="btn btn-primary my-2 p-3" id="buttonCreate">
		Добавить в журнал
  	</button>
	`;
	var table = `<table class="table">
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
            '<td width="8%"><button type="button" class="btn btn-primary change px-2 py-0" id="button_chan_'+arr.values[i]['id']+'">Изменить</button></td>'+
            '<td width="8%"><button type="button" class="btn btn-primary delete px-2 py-0" id="button_del_'+arr.values[i]['id']+'">Удалить</button></td>'+
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
				var marks = new Map();
				/*
				for(var i = 0; i < response.values.length; i++){
					marksOptions += '<option value="'+response.values[i].id+'">'+response.values[i].mark_name+'</option>'
					marks.set(response.values[i].id, response.values[i].mark_name);
				}
				*/
				response.values.forEach(function(value, i, a){
					marks.set(value.id, value.mark_name);
				})
				modalForm("Добавить в журнал", 
					new Map([
					["number", {label: "Номер автомобиля:", type: "text"}],
					["mark_id", {label: "Марка автомобиля:", type: "select", array: marks}],
					["date", {label: "Дата добавления:", type:"date"}]
					]),
					"Добавить",
					function(event, formName, dataFormName){
						event.preventDefault();
						var form = $(`#${dataFormName}`);
						var form_data=JSON.stringify(form.serializeObject());
						form_data = '{"jwt":"'+$.cookie("jwt")+'",'+form_data.substring(1);
						alert(form_data);
						$.ajax({
							url:"php/journal_note/create.php",
							type: "POST",
							contentType: 'raw',
							data: form_data,
							success: function(result){
								$(`#${formName}`).modal('hide');
								SetJournalPage();
							},
							error: function(xhr, resp, text){
								$(`#${formName}`).modal('dispose');
								modalFormMessage(`something gone wrong... ${text}`);
							}
						});
					}
				);
				/*
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
											`+marksOptions+`
											</select>
										</div>
										<div class="form-group">
											<label for="date" class="col-form-label">Дата добавления:</label>
											<input type="date" name="date" id="addDate" class="form-control" placeholder="Дата добавления" required>
										</div>
										<div class="modal-footer">
											<button class="btn btn-primary" type="submit" id="buttonCreate">Добавить</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>`);
					*/
					/*
				$("#createForm").on("sumbit", function(event){
					//Потом здесь будет валидация
					event.preventDefault();
					var form = $("#createForm");
					var form_data=JSON.stringify(form.serializeObject());
					form_data = '{"jwt":"'+$.cookie("jwt")+'",'+form_data.substring(1);
					alert(form_data);
					/*
					$.ajax({
						url:"php/journal_note/create.php",
						type: "POST",
						contentType: 'raw',
						data: form_data,
						success: function(result){

						},
						error: function(xhr, resp, text){
							
						}
					});
						
				});
				$("#modalFormCreate").modal('show');
				$('#modalFormCreate').on('hidden.bs.modal', function (e) {
					$("#modalFormMain").html('');
				})
				*/
			}
		});
	});
}

var SetJournalPage = function(){
	
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
			$("main").html(`<div class="content"><div class="container text-center" id="journalTable"></div></div>`);
			SetJournalTable(result);
        },
		error: function(xhr, resp, text){
           	modalFormMessage("Авторизируйтесь, чтобы зайти в журнал!");
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
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="bd-placeholder-img" width="100%" height="100%" src="images/index/1.png" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" ></img>
			<div class="container">
			<div class="carousel-caption text-left">
				<h1>Представляем вам наш гараж!</h1>
				<p>Стильные решения, высокая безопасность, низкие цены</p>
			</div>
			</div>
		</div>
		<div class="carousel-item">
		<img class="bd-placeholder-img" width="100%" height="100%" src="images/index/2.jpg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" ></img>
			<div class="container">
			<div class="carousel-caption">
				<h1>Не только для автомобилей</h1>
				<p>Наши гаражи - не только для хранения автомобилей, но и для приятного времяпровождения</p>
			</div>
			</div>
		</div>
		<div class="carousel-item">
		<img class="bd-placeholder-img" width="100%" height="100%" src="images/index/3.jpg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" ></img>
			<div class="container">
			<div class="carousel-caption text-right">
				<h1>От классики до лофта</h1>
				<p>Наш дизайн способен поразить даже искушенных ценителей</p>
			</div>
			</div>
		</div>
		</div>
		<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
		</a>
	</div>
		`);
};

var SetHeaderButtons = function(){
		var jwt = $.cookie("jwt");
		if(jwt === undefined || jwt === '')
		{
			$("#header_buttons").html('<button type="button" class="btn btn-outline-primary mr-2 my-2 my-sm-0" data-toggle="modal" data-target="#modalFormAuth">Войти</button>' + '<button type="button" class="btn btn-outline-primary my-2 mr-2 my-sm-0" data-toggle="modal" data-target="#modalFormReg">Регистрация</button>');
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
			$("#header_buttons").html(`<button type="button" class="btn btn-outline-primary my-2 mr-2 my-sm-0" id="logout">Выйти</button>`);
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
	$("#MB2").click(function(event){
		event.preventDefault();
		modalForm("ТЕСТ", new Map([
			["name1", {label: 'label', type: "text"}],
			["name2", {label: 'Another label', type: "password"}],
			["name3", {label: 'cool select', type: "select", array: new Map([
				["1" ,"first"],
				["2", "second"],
				["4", "last"]])}]
		]),
		"testButton",
		function(event, formName, dataFormName){
			event.preventDefault();
			var form = $(`#${dataFormName}`);
			var form_data=JSON.stringify(form.serializeObject());
			alert(form_data);
			$(`#${formName}.close`).click();
		})
	})
	SetHeaderButtons();
	SetIndexPage();

});
