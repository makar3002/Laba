var id;
var mark_name;

function getMarkById(action) {
    $.ajax({
        data: "mark_id=" + id + "&action=get_by_id&table=marks",
        url: 'php/general/tables_crud.php',
        type: 'POST',
        success: function (response)
        {
            if (response === '')
            {
                id = null;
                alert('Такой записи не найдено, повторите попытку!');
                setupMarksTable();
            }
            else
            {
                mark_name = $.parseJSON(response)['mark_name'];

                action();
            }
        }
    });
}

function setupMarksTable()
{
    $.ajax({
        data: "action=get_table&table=marks",
        type: 'POST',
        url: 'php/general/tables_crud.php',
        success: function(response)
        {
            $('#table').html(response);
            setupDeleteAndChangeButtons();
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
            getMarkById(function ()
            {
                var form = $('#changeForm');
                if (null == form) { return; }

                var changeName = $('#changeName');
                if (null == changeName) { return; }

                changeName.val(mark_name);

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
            getMarkById(function ()
            {
                $('#modalDeleteCenter').modal('show');
            });
        });
    });

    var journalNotesOfMarkButtons = $('.journalNotesOfMark');

    journalNotesOfMarkButtons.each(function ()
    {
        $(this).click(function (event)
        {
            event.preventDefault();

            id = $(this).attr('id').substring(5);

            $.ajax({
                data: "mark_id=" + id + "&action=get_journal_notes&table=marks",
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
                        alert('Такой марки не существует!');
                    }

                    setupMarksTable();
                }
            });
        });
    });
}

$(document).ready(function()
{
    var form = $('#createForm');
    if (null == form) { return; }

    var buttonAdd = $('#buttonAdd');
    if (null == buttonAdd) { return; }

    buttonAdd.click(function (event)
    {
        event.preventDefault();

        if (markDataValidating('add'))
        {
            var formData = new FormData($('#createForm')[0]);
            formData.append('action', 'add');
            formData.append('table', 'marks');

            $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: 'php/general/tables_crud.php',
                type: 'POST',
                success: function ()
                {
                    $('#closeCreateModal').click();
                    setupMarksTable();
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
        formData.append('table', 'marks');

        if (markDataValidating('change'))
        {
            $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: 'php/general/tables_crud.php',
                type: 'POST',
                success: function (response)
                {
                    if (response !== ''){
                        alert(response);
                    }
                    $('#closeChangeModal').click();
                    setupMarksTable();
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
            alert('Такой записи не найдено, повторите попытку!');
            return;
        }

        $.ajax({
            data: "id=" + id + "&action=delete&table=marks",
            url: 'php/general/tables_crud.php',
            type: 'POST',
            success: function ()
            {
                $('#closeDeleteModal').click();
                setupMarksTable();
            }
        });
    });

    buttonDeleteNo.click(function ()
    {
        $('#closeDeleteModal').click();
        id = null;
    });

    setupMarksTable();
});