
function active_admin(admin_id, status) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/admin/active_admin",
            data: {
                'admin_id': admin_id,
                'status': status
            },
            success: function (msg) {
                if (msg == "true")
                    location.reload();
            }
        });
    }
}

function delete_admin(admin_id) {

    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/admin/delete_admin",
            data: {
                'admin_id': admin_id
            },
            success: function (msg) {
                if (msg == "true")
                    location.reload();
            }
        });
    }
}

$(document).ready(function () {
    $('#edit_admin_form').validate({
        rules: {
            web_title: {
                required: true,
            },
            email: {
                required: true
            },
            username: {
                required: true
            }
        },
        messages: {
            web_title: {
                required: "Web Title field is reqiured.",
            },
            email: {
                required: "Email field is reqiured."
            },
            username: {
                required: "UserName field is reqiured."
            }
        }
    });
    $('#add_admin_form').validate({
        rules: {
            web_title: {
                required: true,
            },
            email: {
                required: true
            },
            username: {
                required: true
            },
            password: {
                required: true
            },
            c_password: {
                required: true
            }
        },
        messages: {
            web_title: {
                required: "Web Title field is reqiured.",
            },
            email: {
                required: "Email field is reqiured."
            },
            username: {
                required: "UserName field is reqiured."
            },
            password: {
                required: "Password field is reqiured."
            },
            c_password: {
                required: "Confirm Password field is reqiured."
            }
        }
    });
});



