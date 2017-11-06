
$("#passwordchnage").validate({
    rules: {
        current_password: {
            required: true,
        },
        new_password: {
            required: true,
        },
        new_password_repeats: {
            required: true,
        }
    },
    messages: {
        current_password: {
            required: "Please enter Current Password",
        },
        new_password: {
            required: "Please enter New Password",
        },
        new_password_repeats: {
            required: "Please enter Repeat Password",
        }
    },
    submitHandler: function (form) {
        if ($(form).valid()) {
            var data = $("#passwordchnage").serialize();
            $.ajax({
                url: base_url + "public/user/update_pswd",
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (msg) {
                    if (msg.result === "success") {

                        $("#alert_pass").show();
                        $("#alert_pass").append('<strong>' + msg.msg + '</strong>');
                    } else if (msg.result === "error") {
                        $("#alert_password").show();
                        $("#alert_password").append('<strong>' + msg.msg + '</strong>');
                    }
                }
            });
        } else {
            form.preventDefault();
        }
    }
});

$("#useremail").validate({
    rules: {
        username: {
            remote: {
                url: base_url + "public/user/user_check",
                type: "POST",
                data: {
                    u_name: function () {
                        return $('#username1').val();
                    }
                }
            }
        },
        email: {
            email: true,
            remote: {
                url: base_url + "public/user/email_check",
                type: "POST",
                data: {
                    email_id: function () {
                        return $('#email1').val();
                    }
                }
            }
        }
    },
    messages: {
        username: {
            remote: jQuery.validator.format("{0} is already taken.")
        },
        email: {
            email: "Enter Valid Email",
            remote: jQuery.validator.format("{0} is already taken.")
        }

    },
    submitHandler: function (form) {
        if ($(form).valid()) {


            var data = $("#useremail").serialize()

            $.ajax({
                url: base_url + "public/user/set_user_mail",
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (msg) {
                    if (msg.result == "ok") {
                        $("#alert_user").show();
                        $("#alert_user").append('<strong>' + msg.msg + '</strong>');
                    } else if (msg.result == "error") {
                        $("#alert_username").show();
                        $("#alert_username").append('<strong>' + msg.msg + '</strong>');
                    }
                }
            });
        } else {
            form.preventDefault();
        }
    }
});