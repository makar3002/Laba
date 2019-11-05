function journal_data_validating(){
    var car_number = document.getElementById('number');
    var car_mark = document.getElementById('mark');
    var car_date = document.getElementById('date');
    if (car_number.value.length !== 6) {
        alert("Неправильные данные в номере - только 6 символов!");
        return false;
    }
    if (car_mark.value.length === 0) {
        alert("Неправильные данные в марке - поле не должно быть пустым!");
        return false;
    }
    if (car_date.value.length === 0) {
        alert("Неправильные данные в дате - выберете нужную дату!");
        return false;
    }
    return true;
}

function mark_data_validating(){
    var mark_name = document.getElementById('name');
    if (mark_name.value.length === 0) {
        alert("Неправильные данные в названии - поле не должно быть пустым!");
        return false;
    }
    if (check_format(mark_name.value, 'word') !== true) {
        alert("Неправильные данные в названии - только буквы!");
        return false;
    }
    return true;
}