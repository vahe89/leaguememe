function delete_youtube_img(league_img_id) {

    var r = confirm("Can you confirm this?");

    if (r == true) {

        $.ajax({
            type: "POST",
            url: "leaguelist/delete_youtube_img",
            data: "league_img_id=" + league_img_id,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function update_status_video(league_id, league_status) {
    var r = confirm("Can you confirm this?");
    if (r == true) {

        $.ajax({
            type: "POST",
            url: "leaguelist/update_status_video",
            data:  {
                "league_id" : league_id,
                "league_status" : league_status
            },
                    
            success: function (msg) {
//                alert(msg);
                location.reload();
            }
        });
    }
}