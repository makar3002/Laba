function data_validating(){
    var car_number = document.getElementById('number');
    var car_mark = document.getElementById('mark');
    if (car_number.value.length !== 6){
        alert("Неправильные данные в номере - только 6 символов!");
        return false;
    }
    if (is_number_in_string(car_mark.value) === true){
        alert("Неправильные данные в марке - только буквы!");
        return false;
    }
    return true;
}

function is_number_in_string(str) {
    for (var i = 0; i < str.length; i++){
        if (str[i] >= '0' && str[i] <= '9')
            return true;
    }
    return false;
}

document.addEventListener("DOMContentLoaded",function() {
    var form = document.getElementById('form');
    form.onsubmit = data_validating;
});