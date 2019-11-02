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

function table_update(unused_button = null, unused_request = null){
    var table = document.getElementById('table');
    ajax_request(function (request){
        request.open('POST', 'php/journal/user_journal.php', true);
    }, function (request) {
        table.innerHTML = request.responseText;
    });
}

function request_open(button, request){
    request.open('POST', 'php/journal/add_journal.php', true);
}

document.addEventListener("DOMContentLoaded",function() {
    var form = document.getElementById('form');
    form.onsubmit = data_validating;
    var button_add = document.getElementById('button_add');
    ajax_request_on_button(button_add, request_open, table_update);
    table_update();
});