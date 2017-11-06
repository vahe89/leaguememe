
function delete_patch_notes(id) {

    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/patch_note/delete_patch_notes",
            data: "id=" + id,
            success: function(msg) {
                location.reload();
            }
        });
    }
}

function active_patch_notes(rule_id, status) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/patch_note/update_status",
            data: "id=" + rule_id + "&status=" + status,
            success: function(msg) {
                location.reload();
            }
        });
    }
}