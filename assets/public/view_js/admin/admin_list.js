

function active_admin(admin_id, status) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: "admin/active_admin",
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
            url: "admin/delete_admin",
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

