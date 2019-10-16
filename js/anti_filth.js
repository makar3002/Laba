
document.addEventListener("DOMContentLoaded",function() {
    var button = document.getElementById('button');

    button.addEventListener("click", function(e) {
        e.preventDefault();
        var text = document.getElementById('inputText').value;
        var request = new XMLHttpRequest();
        request.addEventListener('readystatechange', function() {

            if (request.readyState === 4) {
                if (request.status === 200) {
                    var text = document.getElementById('inputText');
                    console.log(request.responseText);
                    text.value = request.responseText;
                } else {
                    alert('Error Code: ' + request.status);
                    alert('Error Message: ' + request.statusText);
                }
            }
        });
        request.open('POST', 'php/anti_filth.php', true);
        //request.setRequestHeader('Content-Type', 'text/plain');

        var data = new FormData(document.getElementById('form'));
        for (var key of data.keys())
            console.log(key, data.get(key));
        request.send(data);
    })
});