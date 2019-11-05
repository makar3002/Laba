function marks_table_update(unused_button = null, unused_request = null){
    var table = document.getElementById('table');
    ajax_request(
        function (request){
            request.open('POST', 'php/marks/marks.php', true);
        },
        function (request) {
            table.innerHTML = request.responseText;
        }
    );
}

document.addEventListener("DOMContentLoaded",function() {
    var form = document.getElementById('form');
    if (form != null) {
        var button_add = document.getElementById('button_add');
        ajax_request_on_button_click(
            button_add,
            function (button, request) {
                request.open('POST', 'php/marks/add_mark.php', true);
                var close_form_button = document.getElementById('close_form');
                close_form_button.click();
            },
            marks_table_update,
            mark_data_validating
        );
    }
    marks_table_update();
});