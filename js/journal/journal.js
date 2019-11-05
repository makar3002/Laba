function journal_table_update(unused_button = null, unused_request = null){
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

function marks_select_update(){
    var select = document.getElementById('mark');
    ajax_request(
        function (request){
            request.open('POST', 'php/journal/marks_select.php', true);
        },
        function (request) {
            select.innerHTML = request.responseText;
        }
    );
}

document.addEventListener("DOMContentLoaded",function() {
    var form = document.getElementById('form');
    if (form != null) {
        form.onsubmit = journal_data_validating;
        var button_add = document.getElementById('button_add');
        ajax_request_on_button_click(
            button_add,
            function (button, request) {

                request.open('POST', 'php/journal/add_journal.php', true);
                var close_form_button = document.getElementById('close_form');
                close_form_button.click();
                marks_select_update();
            },
            journal_table_update,
            journal_data_validating
        );
    }
    journal_table_update();
    marks_select_update();
});