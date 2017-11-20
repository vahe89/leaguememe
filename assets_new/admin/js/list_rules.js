
function delete_rules_template(id) {

    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/rules_template/delete_rules_template",
            data: "rules_id=" + id,
            success: function(msg) {
                location.reload();
            }
        });
    }
}

function active_rules_template(rule_id, status) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/rules_template/update_status",
            data: "rule_id=" + rule_id + "&rule_status=" + status,
            success: function(msg) {
                location.reload();
            }
        });
    }
}