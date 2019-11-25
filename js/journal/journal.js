var id;
var journalNote;

function getJournalNoteById(action) {
    $.ajax({
        data: "journal_note_id=" + id + "&action=get_by_id&table=journal",
        url: 'php/general/tables_crud.php',
        type: 'POST',
        success: function (response)
        {
            if (response === '')
            {
                id = null;
                $('#main_div').html(response);
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
        data: "action=get_table&table=journal",
        type: 'POST',
        url: 'php/general/tables_crud.php',
        success: function(response)
        {
            $('#table').html(response);

            setupDeleteAndChangeButtons();
        }

    });
}

function setupMarksSelect(){
    $.ajax({
        data: "action=get_marks_select_list&table=journal",
        type: 'POST',
        url: 'php/general/tables_crud.php',
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
                data: "journal_note_id=" + id  + "&action=get_mark&table=journal",
                url: 'php/general/tables_crud.php',
                type: 'POST',
                success: function (response)
                {
                    if (response !== '')
                    {
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
            var formData = new FormData($('#createForm')[0]);
            formData.append('action', 'add');
            formData.append('table', 'journal');

            $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: 'php/general/tables_crud.php',
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
        formData.append('action', 'change');
        formData.append('table', 'journal');

        if (journalDataValidating('change'))
        {
            $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: 'php/general/tables_crud.php',
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
            data: "id=" + id + "&action=delete&table=journal",
            url: 'php/general/tables_crud.php',
            type: 'POST',
            success: function ()
            {
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

    $('#')
});