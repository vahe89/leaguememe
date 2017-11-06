function delete_category(category_id) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: "admin/deletebrand",
            data: "category_id=" + category_id,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function active_brand(category_id, category_status) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: "admin/update_status",
            data: "category_id=" + category_id + "&category_status=" + category_status,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function ban_show(i) {
    $("#days" + i).show();
}