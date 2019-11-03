function journal_data_validating(){
    var car_number = document.getElementById('number');
    var car_mark = document.getElementById('mark');
    if (car_number.value.length !== 6){
        alert("Неправильные данные в номере - только 6 символов!");
        return false;
    }
    if (check_format(car_mark.value, 'word') === true){
        alert("Неправильные данные в марке - только буквы!");
        return false;
    }
    return true;
}