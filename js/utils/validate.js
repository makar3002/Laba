function journalDataValidating(){
    var noteNumber = $('#number');
    var noteMark = $('#mark');
    var noteDate = $('#date');
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