var SetHeaderButtons = function(){
		var jwt = $.cookie("jwt");
		if(jwt == undefined)
		{
			$("#header_buttons").html('<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalFormReg">Регистрация</button>'+'<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalFormAuth">Войти</button>');
			$("#forModalForm").html(`
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
											<form class="form" id="form_auth" enctype="application/x-www-form-urlencoded">
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
															<button class="btn btn-primary" type="submit" id="button_auth">Зарегистрироваться!</button>
													</div>
											</form>
									</div>
							</div>
					</div>
			</div>`);
			$("#button_auth").click(function (event){
				event.preventDefault();
				//Потом здесь будет валидация
				$.ajax({
					data: json,
					processData: false,
					contentType: false,
					url: 'localhost/3rd_var/php/login.php',
					type: 'POST',
				});
			});
		}
		else {
			$("#header_buttons").html(`<button type="button" class="btn btn-sm btn-outline-secondary" id="logout">Выйти</button>`)
		}
}



$(document).ready(function() {
	var magic_button =$('magic_button');
	$('#magic_button').click(function (event){
		event.preventDefault();
		alert(document.cookie);
	});
	SetHeaderButtons();
});
