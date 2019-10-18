function ajax_request(button){
    button.addEventListener("click", function(e) {
        e.preventDefault();
        var request = new XMLHttpRequest();
        request.addEventListener('readystatechange', function() {

            if (request.readyState === 4) {
                if (request.status === 200) {
                    text_change(button, request);
                } else {
                    alert('Error Code: ' + request.status);
                    alert('Error Message: ' + request.statusText);
                }
            }
        });
        request_open(button, request, 'php/anti_filth_makarenko.php', 'php/anti_filth_zuzin.php')
        var data = new FormData(document.getElementById('form'));
        request.send(data);
    })
}

function request_open(button, request, url1, url2){
    if (button === document.getElementById('button_makarenko')) {
        request.open('POST', url1, true);
    } else {
        request.open('POST', url2, true);
    }

}

function text_change(button, request){
    var text;
    if (button === document.getElementById('button_makarenko')) {
        text = document.getElementById('polite_text_makarenko');
    } else {
        text = document.getElementById('polite_text_zuzin');
    }
    text.innerHTML = request.responseText;
}

document.addEventListener("DOMContentLoaded",function() {
    var button_makarenko = document.getElementById('button_makarenko');
    var button_zuzin = document.getElementById('button_zuzin');
    ajax_request(button_makarenko);
    ajax_request(button_zuzin);
});