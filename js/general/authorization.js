function setupSignInUpOutButtons(){
    $.ajax({
        url: 'php/auth/sign_inupout_buttons.php',
        type: 'GET',
        success: function (response)
        {
            $('#sign-inupout-buttons').html(response);

            var signOut = $('#sign-out');
            console.log(signOut);
            if (null != signOut)
            {
                signOut.click(function () {
                    $.ajax({
                        data: 'action=sign_out',
                        url: 'php/auth/authorization.php',
                        type: 'POST',
                        success: function (res)
                        {
                            console.log(res);
                            setupSignInUpOutButtons();
                        }
                    });
                });
            }
        }
    });
}
$(document).ready(function () {
    setupSignInUpOutButtons();

    $('#auth-btn').click(function (event)
    {
        event.preventDefault();

        var formData = new FormData($('#authorizationForm')[0]);
        formData.append('action', 'sign_in');

        if (signInDataValidating())
        {
            $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: 'php/auth/authorization.php',
                type: 'POST',
                success: function () {
                    $('#closeAuthorizationModal').click();
                    setupSignInUpOutButtons();
                }
            });
        }
    });
    $('#reg-btn').click(function (event)
    {
        event.preventDefault();

        var formData = new FormData($('#registrationForm')[0]);
        formData.append('action', 'sign_up');

        if (signUpDataValidating())
        {
            $.ajax({
                data: formData,
                processData: false,
                contentType: false,
                url: 'php/auth/authorization.php',
                type: 'POST',
                success: function (response)
                {
                    if (response !== ''){
                        alert(response);
                    }
                    else
                    {
                        $('#closeRegistrationModal').click();
                        setupSignInUpOutButtons();
                    }
                }
            });
        }
    });
});