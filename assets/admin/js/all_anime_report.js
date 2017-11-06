
function active_report(id, status, league_report_id, leagueimage_id) {
    var r = confirm("Are You Sure?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/leaguelist/update_report_status",
            data: "id=" + id + "&report_status=" + status +"&league_report_id=" + league_report_id +"&leagueimage_id="+leagueimage_id ,
            success: function (msg) {
                location.reload();
            }
        });
    }
}
