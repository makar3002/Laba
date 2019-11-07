function setupJournalTable(){
    $.ajax({
        type: 'POST',
        url: 'php/journal/user_journal.php',
        success: function(response) {
            $('#table').html(response);
        }

    });
}

function setupMarksSelect(){
    $.ajax({
        type: 'POST',
        url: 'php/journal/marks_select.php',
        success: function(response) {
            $('#mark').html(response);
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
        if (journalDataValidating()) {
            $.ajax({
                data: new FormData($('#form')[0]),
                processData: false,
                contentType: false,
                url: 'php/journal/add_journal.php',
                type: 'POST',
                success: function (request) {
                    setupJournalTable();
                    setupMarksSelect();
                    $('#close_form').click();
                }
            });
        }
    });
    setupJournalTable();
    setupMarksSelect();
});