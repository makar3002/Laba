function setupMarksTable(unused_button = null, unused_request = null){
    $.ajax({
        type: 'POST',
        url: 'php/marks/marks.php',
        success: function(response) {
            $('#table').html(response);
        }

    });
}

$(document).ready(function() {
    var form = $('#form');
    if (null == form) { return; }

    var button_add = $('#button_add');
    if (null == button_add) { return; }

    button_add.click(function (event) {
        event.preventDefault();
        if (markDataValidating()) {
            $.ajax({
                data: new FormData($('#form')[0]),
                processData: false,
                contentType: false,
                url: 'php/marks/add_mark.php',
                type: 'POST',
                success: function (request) {
                    setupMarksTable();
                    $('#close_form').click();
                }
            });
        }
    });
    setupMarksTable();
});