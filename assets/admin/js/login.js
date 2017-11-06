$(document).ready(function(){
    $('#login_form').validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Email field is reqiured.",
            },
            password: {
                required: "Password field is reqiured."
            }
        }
    });
});
