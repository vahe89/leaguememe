function ondiscussionvictory(victory) {

    $.ajax({
        type: "POST",
        url: base_url + "public/animelist/anime_victory",
        data: {victory: victory},
        cache: false,
        dataType: 'JSON',
        success: function (data) {

            if (data.status === "false") {

                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle.png');
                var total_point = parseInt($('#point_' + victory).text()) - 1;
                $('#point_' + victory).text(total_point);
            } else if (data.status === "update") {
                $('#dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle-hover.png');
                var total_point = parseInt($('#point_' + victory).text()) + 2;
                $('#point_' + victory).text(total_point);

            } else if (data.status === "insert") {
                $('#dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle-hover.png');
                var total_point = parseInt($('#point_' + victory).text()) + 1;
                $('#point_' + victory).text(total_point);
            } else {
                location.reload();
            }
        }
    });
}
function ondiscussiondefeat(defeat) {
    $.ajax({
        type: "POST",
        url: base_url + "public/animelist/anime_defeat",
        data: {defeat: defeat},
        cache: false,
        dataType: 'JSON',
        success: function (data) {
            if (data.status == "false") {

                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle.png');
                var total_point = parseInt($('#point_' + defeat).text()) + 1;
                $('#point_' + defeat).text(total_point);

            } else if (data.status === "update") {
                $('#like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle-hover.png');
                var total_point = parseInt($('#point_' + defeat).text()) - 2;
                $('#point_' + defeat).text(total_point);

            } else if (data.status === "insert") {
                $('#like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle-hover.png');
                var total_point = parseInt($('#point_' + defeat).text()) - 1;
                $('#point_' + defeat).text(total_point);
            } else {
                location.reload();
            }
        }
    });
}
$(document).ready(function () {
    $('#login_close').click(function () {

        $('#login').removeClass('in');
        $('#login').hide();
        $('#modal_backdrop').remove();
    });
});