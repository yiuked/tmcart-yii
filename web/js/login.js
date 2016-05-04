/**
 * Created by Administrator on 2016/4/24.
 */
$(document).ready(function() {
    $('#email').select();
    $('#submit-login-form').click(function() {
        if (isEmail($("#email").val()) == false) {
            $("#email").parent().addClass('has-error');
            return;
        }
        if (isPasswd($("#passwd").val()) == false) {
            $("#passwd").parent().addClass('has-error');
            return;
        }
        doAjaxLogin();
    });

    $('#forgot_password_form').submit(function(e) {
        // Kill default behaviour
        e.preventDefault();
        doAjaxForgot();
    });

    $('.show-forgot-password').click(function(e) {
        // Kill default behaviour
        e.preventDefault();
        displayForgotPassword();
    });

    $('.show-login-form').click(function(e) {
        // Kill default behaviour
        e.preventDefault();
        displayLogin();
    });
    $("#passwd").keyup(function(){
        if (isPasswd($(this).val()) == false) {
            $(this).parent().addClass('has-error');
        } else {
            $(this).parent().removeClass('has-error');
        }
    })
    $("#email").keyup(function(){
        if (isEmail($(this).val()) == false) {
            $(this).parent().addClass('has-error');
        } else {
            $(this).parent().removeClass('has-error');
        }
    })
});

function isEmail(email) {
    if ( email == "") {
        return false;
    } else {
        if (! /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(email)) {
            return false;
        }
    }
    return true;
}
function isPasswd(passwd) {
    if ( passwd == "") {
        return false;
    } else {
        if (passwd.length >= 6 && passwd.length <= 30) {
            return true;
        }
    }
    return false;
}

function displayForgotPassword() {
    $('#error').addClass('hidden');
    $('#login_form').addClass('hidden');
    $("#forgot_password_form").removeClass('hidden');
}

function displayLogin() {
    $('#error').addClass('hidden');
    $('#login_form').removeClass('hidden');
    $("#forgot_password_form").addClass('hidden');
}

/**
 * Check user credentials
 *
 * @param string redirect name of the controller to redirect to after login (or null)
 */
function doAjaxLogin() {
    $('#error').addClass('hidden');
    $('#login_form .ajax-loader').removeClass("hidden");
    $.ajax({
        type: "POST",
        url: ajaxUrl,
        dataType: "json",
        data: {passwd: $('#passwd').val(),email: $('#email').val()},
        success: function(callBack) {
            if (callBack.statusCode == 1) {
                window.location.href = mailUrl;
            } else {
                $(".error-tip").text(callBack.msg);
                $(".error-tip").removeClass('hidden')
            }
        }
    });
}
function doAjaxForgot() {
    $('#error').addClass('hidden');
    $('#forgot_password_form .ajax-loader').fadeIn('slow', function() {
        $.ajax({
            type: "POST",
            url: "public/ajax-tab.php",
            async: true,
            dataType: "json",
            data: {
                ajax: "1",
                token: "",
                controller: "AdminLogin",
                submitForgot: "1",
                email_forgot: $('#email_forgot').val()
            },
            success: function(callback) {
                if (callback.hasErrors)
                    displayErrors(jsonData.errors);
                else
                {
                    alert(jsonData.confirm);
                    $('#forgot_password_form .ajax-loader').hide();
                    displayLogin();
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $('#error').html('<h3>TECHNICAL ERROR:</h3><p>Details: Error thrown: ' + XMLHttpRequest + '</p><p>Text status: ' + textStatus + '</p>').show();
                $('#forgot_password_form .ajax-loader').fadeOut('slow');
            }
        });
    });
}
function displayErrors(msg) {
    str_errors = '<p class="bg-danger">' + msg + '</p>';
    $('#login_form .ajax-loader').addClass('hidden');
    $('#error').html(str_errors).removeClass("hidden");
}