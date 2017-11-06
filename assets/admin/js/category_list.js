function delete_category(category_id) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/category/delete_category",
            data: "category_id=" + category_id,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function active_category(category_id, category_status) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/category/update_category_status",
            data: "category_id=" + category_id + "&category_status=" + category_status,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

$(document).ready(function () {
    $('#edit_category_form').validate({
        rules: {
            category_name: {
                required: true,
            }
        },
        messages: {
            category_name: {
                required: "Category Name field is reqiured.",
            }
        }
    });
    $('#add_category_form').validate({
        rules: {
            category_name: {
                required: true,
            },
            category_photo: {
                required: true,
            }
        },
        messages: {
            category_name: {
                required: "Category Name field is reqiured.",
            }, 
            category_photo: {
                required: "Category photo is reqiured.",
            },
        }
    });
});

