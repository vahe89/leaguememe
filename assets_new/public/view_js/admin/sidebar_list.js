function delete_sidebar_img(sid) {

    var deleteSidebar = confirm("Can you confirm this?");
    if (deleteSidebar == true) {
        $.ajax({
            type: "POST",
            url: "admin/delete_side_link",
            data: {
                'sid': sid
            },
            success: function (msg) {
                location.reload();
            }
        });
    }
}