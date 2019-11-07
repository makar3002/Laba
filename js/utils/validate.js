function journalDataValidating(){
    var noteNumber = document.getElementById('number');
    var noteMark = document.getElementById('mark');
    var noteDate = document.getElementById('date');
    if (noteNumber.value.length !== 6) {
        alert("Неправильные данные в номере - только 6 символов!");
        return false;
    }
    if (noteMark.value.length === 0) {
        alert("Неправильные данные в марке - поле не должно быть пустым!");
        return false;
    }
    if (noteDate.value.length === 0) {
        alert("Неправильные данные в дате - выберете нужную дату!");
        return false;
    }
    return true;
}

function markDataValidating(){
    var markName = document.getElementById('name');
    if (markName.value.length === 0) {
        alert("Неправильные данные в названии - поле не должно быть пустым!");
        return false;
    }
    if (checkFormat(markName.value, 'word') !== true) {
        alert("Неправильные данные в названии - только буквы!");
        return false;
    }
    return true;
}