function ajaxAntiFilth(event, url, outputID) {
    event.preventDefault();
    $.ajax({
        type: 'GET',
        data: {'input_text': $('#input_text').val()},
        url: url,
        success: function (response) {
            $('#'+outputID).text(response === '' ? 'Вы ничего не ввели' : response);
        }
    });
}

$(document).ready(function () {
    var button_makarenko = $('#button_makarenko');
    if (null == button_makarenko) return;

    var button_zuzin = $('#button_zuzin');
    if (null == button_zuzin) return;

    button_makarenko.click(function (event) {
        ajaxAntiFilth(event, 'php/anti_filth/anti_filth_makarenko.php', 'polite_text_makarenko');
    });

    button_zuzin.click(function (event) {
        ajaxAntiFilth(event, 'php/anti_filth/anti_filth_zuzin.php', 'polite_text_zuzin');
    });
});