function ajax_request_on_button_click(button, request_open, action = null, data_validating = function (){return true}) {
    button.addEventListener("click", function(e) {
        e.preventDefault();
        var request = new XMLHttpRequest();
        request.addEventListener('readystatechange', function() {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    if (action != null) action(button, request);
                } else {
                    alert('Error Code: ' + request.status);
                    alert('Error Message: ' + request.statusText);
                }
            }
        });
        request_open(button, request);
        var data = new FormData(document.getElementById('form'));
        if (data_validating()) request.send(data);
    })
}

function ajax_request(request_open, action = null){
    var request = new XMLHttpRequest();
    request.addEventListener('readystatechange', function() {
        if (request.readyState === 4) {
            if (request.status === 200) {
                if (action != null) action(request);
            } else {
                alert('Error Code: ' + request.status);
                alert('Error Message: ' + request.statusText);
            }
        }
    });
    request_open(request);
    request.send();
}