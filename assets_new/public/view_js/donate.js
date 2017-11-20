$(document).ready(function () {
    $("#form_upload").validate({
        rules: {
            username: {
                required: true
            },
            amount: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Enter Username"
            },
            amount: {
                required: "Enter Amount"
            }
        }
    });
});