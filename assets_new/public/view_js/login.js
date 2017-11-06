$('#close').click(function () {
    $('#popup').hide();
    $('.popup_outer').css('display', 'none');
});

$(document).ready(function () {
    $("#forget").click(function () {
        $(".signin").hide();
        $("#forgot").show();
    });

    $('#clickuser_log').click(function () {
        if ($("#rememberme").is(":checked")) {
            var rememberme = 'Yes';
        } else {
            var rememberme = '0';
        }
    });

    $("#user_llogin").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Please enter Username"
            },
            password: {
                required: "Please enter Password"
            }
        }
    });

    $("#forgot_password").validate({
        rules: {
            email: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please enter your Email Address"
            }
        },
        submitHandler: function (form) {
            $('#for_error22').hide();
        $('#change_pass').hide();
        var email = $('#email').val();
        $.ajax({
            type: "POST",
            url: base_url + "user/forgot_password",
            data: {
                'email' : email
            },
            success: function (msg) {
                if (msg == "false") {
                    $('#for_error22').show();
                } else if (msg == "error") {
                    $('#email_error').show();
                } else {
                    $('#change_pass').show();
                }
            }
        });
        }
    });

});