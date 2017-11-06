
function onvictory(victory) {
    $.ajax({
        type: "POST",
        url: base_url + "public/leaguelist/league_victory",
        data: {victory: victory},
        cache: false,
        dataType: 'JSON',
        success: function (data) {
            if (data.status === "false") {
                //                    location.href = base_url + "user/login";
                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#defeat_img_' + victory).removeClass('victory_single_active');
                $('#victory_img_' + victory).removeClass('victory_single_active');
                var total_point = parseInt($('#point_' + victory).text()) - 1;
                $('#point_' + victory).text(total_point);
            } else if (data.status === "update") {
                $('#defeat_img_' + victory).removeClass('victory_single_active');
                $('#victory_img_' + victory).addClass('victory_single_active');
                var total_point = parseInt($('#point_' + victory).text()) + 2;
                $('#point_' + victory).text(total_point);
            } else if (data.status === "insert") {
                $('#defeat_img_' + victory).removeClass('victory_single_active');
                $('#victory_img_' + victory).addClass('victory_single_active');
                var total_point = parseInt($('#point_' + victory).text()) + 1;
                $('#point_' + victory).text(total_point);
            } else {
                location.reload();
            }
        }
    });
}
function ondefeat(defeat) {
    $.ajax({
        type: "POST",
        url: base_url + "public/leaguelist/league_defeat",
        data: {defeat: defeat},
        cache: false,
        dataType: 'JSON',
        success: function (data) {
            if (data.status == "false") {
//              location.href = base_url + "user/login";
                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#victory_img_' + defeat).removeClass('victory_single_active');
                $('#defeat_img_' + defeat).removeClass('victory_single_active');
                var total_point = parseInt($('#point_' + defeat).text()) + 1;
                $('#point_' + defeat).text(total_point);
            } else if (data.status === "update") {
                $('#victory_img_' + defeat).removeClass('victory_single_active');
                $('#defeat_img_' + defeat).addClass('victory_single_active');
                var total_point = parseInt($('#point_' + defeat).text()) - 2;
                $('#point_' + defeat).text(total_point);
            } else if (data.status === "insert") {
                $('#victory_img_' + defeat).removeClass('victory_single_active');
                $('#defeat_img_' + defeat).addClass('victory_single_active');
                var total_point = parseInt($('#point_' + defeat).text()) - 1;
                $('#point_' + defeat).text(total_point);
            } else {
                location.reload();
            }
        }
    });
}
