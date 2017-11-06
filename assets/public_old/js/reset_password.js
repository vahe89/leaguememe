$(document).ready(function () {
    $("#change").validate({
        rules: {
            current_password: {
                required: true,
            },
            new_password: {
                required: true,
                minlength: 5
            },
            cpswd: {
                required: true,
                equalTo: "#new_password"
            }

        },
        messages: {
            current_password: {
                required: "Please provide a password"
            },
            new_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            cpswd: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            }
        }
    });
});