var id;
var journalNote;

function getJournalNoteById(action) {
    $.ajax({
        data: "journal_note_id=" + id,
        url: 'php/journal/get_journal_note_by_id.php',
        type: 'POST',
        success: function (response)
        {
            if (response === '')
            {
                id = null;

                alert('Такой записи не найдено, повторите попытку!');

                setupJournalTable();
            }
            else
            {
                journalNote = $.parseJSON(response);

                action();
            }
        }
    });
}

function setupJournalTable(){
    $.ajax({
        type: 'POST',
        url: 'php/journal/get_journal_table.php',
        success: function(response)
        {
            $('#table').html(response);

            setupDeleteAndChangeButtons();
        }

    });
}

function setupMarksSelect(){
    $.ajax({
        type: 'POST',
        url: 'php/journal/marks_select_list.php',
        success: function(response)
        {
            $('.mark').html(response);
        }
    });
}

function setupDeleteAndChangeButtons()
{
    var changeButtons = $('.change');

    changeButtons.each(function ()
    {
        $(this).click(function (event)
        {
            event.preventDefault();

            id = $(this).attr('id').substring(12);

            getJournalNoteById(function ()
            {
                var form = $('#changeForm');
                if (null == form) { return; }

                var changeNumber = $('#changeNumber');
                if (null == changeNumber) { return; }

                var changeMark = $('#changeMark');
                if (null == changeMark) { return; }

                var changeDate = $('#changeDate');
                if (null == changeDate) { return; }

                changeNumber.val(journalNote['number']);
                changeMark.val(journalNote['mark_id']);
                changeDate.val(journalNote['date']);

                $('#modalChangeCenter').modal('show');
            });
        });
    });

    var deleteButtons = $('.delete');

    deleteButtons.each(function ()
    {
        $(this).click(function (event)
        {
            event.preventDefault();

            id = $(this).attr('id').substring(11);
            getJournalNoteById(function ()
            {
                $('#modalDeleteCenter').modal('show');
            });
        });
    });

    var markOfJournalNote = $('.markOfJournalNote');

    markOfJournalNote.each(function ()
    {
        $(this).click(function (event)
        {
            event.preventDefault();

            id = $(this).attr('id').substring(13);

            $.ajax({
                data: "journal_note_id=" + id ,
                url: 'php/journal/get_mark_by_journal_note.php',
                type: 'POST',
                success: function (response)
                {
                    if (response !== '')
                    {
                        console.log(response);
                        $('#search').html(response);
                    }
                    else
                    {
                        alert('Такой машины не существует!');
                    }

                    setupJournalTable();
                    setupMarksSelect();
                }
            });
        });
    });
}

$(document).ready(function() {
    var form = $('#form');
    if (null == form) { return; }

    var buttonAdd = $('#buttonAdd');
    if (null == buttonAdd) { return; }

    buttonAdd.click(function (event)
    {
        event.preventDefault();

        if (journalDataValidating('add'))
        {
            $.ajax({
                data: new FormData($('#createForm')[0]),
                processData: false,
                contentType: false,
                url: 'php/journal/add_journal_note.php',
                type: 'POST',
                success: function () {
                    setupJournalTable();
                    setupMarksSelect();
                    $('#closeCreateModal').click();
                }
            });
        }
    });

    var buttonChange = $('#buttonChange');
    if (null == buttonChange) { return; }

    buttonChange.click(function (event)
    {
        event.preventDefault();

        var formData = new FormData($('#changeForm')[0]);
        formData.append('id', id);

        if (journalDataValidating('change'))
        {
            $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: 'php/journal/change_journal_note.php',
                type: 'POST',
                success: function ()
                {
                    $('#closeChangeModal').click();
                    setupJournalTable();
                    setupMarksSelect();
                }
            });
        }
    });

    var buttonDeleteYes = $('#buttonDeleteYes');
    if (null == buttonDeleteYes) { return; }

    var buttonDeleteNo = $('#buttonDeleteNo');
    if (null == buttonDeleteNo) { return; }

    buttonDeleteYes.click(function ()
    {
        if (null == id)
        {
            $('#closeDeleteModal').click();
            alert('Ошибка, повторите попытку!');
            return;
        }

        $.ajax({
            data: "id=" + id,
            url: 'php/journal/delete_journal_note.php',
            type: 'POST',
            success: function (response)
            {
                console.log(response);
                $('#closeDeleteModal').click();
                setupJournalTable();
                setupMarksSelect();
            }
        });
    });

    buttonDeleteNo.click(function ()
    {
        $('#closeDeleteModal').click();
        id = null;
    });

    setupJournalTable();
    setupMarksSelect();
});