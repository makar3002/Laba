function request_open(button, request){
    if (button === document.getElementById('button_makarenko')) {
        request.open('POST', 'php/anti_filth/anti_filth_makarenko.php', true);
    } else {
        request.open('POST', 'php/anti_filth/anti_filth_zuzin.php', true);
    }

}

function text_change(button, request){
    var text;
    if (button === document.getElementById('button_makarenko')) {
        text = document.getElementById('polite_text_makarenko');
    } else {
        text = document.getElementById('polite_text_zuzin');
    }
    text.innerHTML = request.responseText !== '' ? request.responseText : 'Вы ничего не ввели';
}

document.addEventListener("DOMContentLoaded",function() {
    var button_makarenko = document.getElementById('button_makarenko');
    var button_zuzin = document.getElementById('button_zuzin');
    ajax_request_on_button(button_makarenko, request_open, text_change);
    ajax_request_on_button(button_zuzin, request_open, text_change);
});