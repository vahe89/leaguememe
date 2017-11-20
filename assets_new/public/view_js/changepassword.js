$('#close').click(function () {
    $('#popup').hide();
    $('.popup_outer').css('display', 'none');
});

function subme() {
    var a = document.getElementbyId('new_password').value();
    var b = document.getElementbyId('cpswd').value();
    if (a != b || a.length < 5) {
        return false;
    } else {
        return true;
    }
}

$(document).ready(function () {
    $("#change_paswd").validate({
        rules: {
            current_password: {
                required: true,
                minlength: 5
            },
            new_password: {
                required: true,
                minlength: 5
            },
            new_password_repeat: {
                required: true,
                equalTo: "#new_password"
            }
        },
        messages: {
            current_password: {
                required: "Please provide a password"
            },
            new_password: {
                required: "Please provide new password"
            },
            new_password_repeat: {
                required: "Please confirm new password",
                equalTo: "Passwords do not match"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});