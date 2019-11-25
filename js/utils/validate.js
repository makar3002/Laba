function signInDataValidating() {
    var authPassword = $('#auth-password');
    if (authPassword.val().length <= 5) {
        alert("Неправильный пароль - должно быть больше 5 символов!");
        return false;
    }
    return true;
}

function signUpDataValidating() {
    var regPassword = $('#reg-password');
    var anotherRegPassword = $('#another-reg-password');
    if (regPassword.val().length <= 5) {
        alert("Неправильный пароль - должно быть больше 5 символов!");
        return false;
    }

    if (regPassword.val() !== anotherRegPassword.val()) {
        alert("Введенные пароли не совпадают");
        return false;
    }
    return true;
}

function journalDataValidating(type){
    var noteNumber = $('#' + type + 'Number');
    var noteMark = $('#' + type + 'Mark');
    var noteDate = $('#' + type + 'Date');
    if (noteNumber.val().length !== 6) {
        alert("Неправильные данные в номере - только 6 символов!");
        return false;
    }
    if (noteMark.val().length === 0) {
        alert("Неправильные данные в марке - поле не должно быть пустым!");
        return false;
    }
    if (noteDate.val().length === 0) {
        alert("Неправильные данные в дате - выберете нужную дату!");
        return false;
    }
    return true;
}

function markDataValidating(type){
    var markName = $('#' + type + 'Name');
    var markLogo = $('#' + type + 'File');
    if (markName.val().length === 0) {
        alert("Неправильные данные в названии - поле не должно быть пустым!");
        return false;
    }
    if (markLogo.val().length === 0 && type !== 'change') {
        alert("Неправильные данные в поле логотипа - нужно выбрать файл!");
        return false;
    }
    if (checkFormat(markName.val(), 'word') !== true) {
        alert("Неправильные данные в названии - только буквы!");
        return false;
    }
    return true;
}