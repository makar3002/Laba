var id;
var mark_name;

function getMarkById(action) {
    $.ajax({
        data: "id=" + id,
        url: 'php/marks/get_mark_by_id.php',
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
                mark_name = response;

                action();
            }
        }
    });
}

function setupMarksTable()
{
    $.ajax({
        type: 'POST',
        url: 'php/marks/get_marks_table.php',
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
            $.ajax({
                data: new FormData($('#createForm')[0]),
                processData: false,
                contentType: false,
                url: 'php/marks/add_mark.php',
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

        if (markDataValidating('change'))
        {
            $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: 'php/marks/change_mark.php',
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
            data: "id=" + id,
            url: 'php/marks/delete_mark.php',
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