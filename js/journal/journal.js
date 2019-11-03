function table_update(unused_button = null, unused_request = null){
    var table = document.getElementById('table');
    ajax_request(
        function (request){
            request.open('POST', 'php/journal/user_journal.php', true);
        },
        function (request) {
            table.innerHTML = request.responseText;
        }
    );
}

document.addEventListener("DOMContentLoaded",function() {
    var form = document.getElementById('form');
    if (form != null) {
        form.onsubmit = journal_data_validating;
        var button_add = document.getElementById('button_add');
        ajax_request_on_button(
            button_add,
            function (button, request) {
                request.open('POST', 'php/journal/add_journal.php', true);
            }, table_update);
    }
    table_update();
});