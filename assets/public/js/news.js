function onArticleVictory(victory) {

    $.ajax({
        type: "POST",
        url: base_url + "public/news/article_victory",
        data: {victory: victory},
        cache: false,
        dataType: 'JSON',
        success: function(data) {
//            console.log(data);
            if (data.status === "false") {
//                location.href = base_url + "user/login";
//                  $('#login-modal').trigger('click');
                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#article_article_defeat_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/down.png');
                $('#article_victory_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/up.png');

                var total_point = parseInt($('#article_point_' + victory).text()) - 1;
                $('#article_point_' + victory).text(total_point);
            } else if (data.status === "update") {
                $('#article_defeat_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/down.png');
                $('#article_victory_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/up-hover.png');
                var total_point = parseInt($('#article_point_' + victory).text()) + 2;
                $('#article_point_' + victory).text(total_point);

            } else if (data.status === "insert") {
                $('#article_defeat_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/down.png');
                $('#article_victory_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/up-hover.png');
                var total_point = parseInt($('#article_point_' + victory).text()) + 1;
                $('#article_point_' + victory).text(total_point);
            } else {
                location.reload();
            }
        }
    });
}
function onArticleDefeat(defeat) {
    $.ajax({
        type: "POST",
        url: base_url + "public/news/article_defeat",
        data: {defeat: defeat},
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            if (data.status == "false") {
//                location.href = base_url + "user/login";
//                  $('#login_modal').trigger('click');
                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#article_victory_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/up.png');
                $('#article_defeat_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/down.png');
                var total_point = parseInt($('#article_point_' + defeat).text()) + 1;
                $('#article_point_' + defeat).text(total_point);

            } else if (data.status === "update") {
                $('#article_victory_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/up.png');
                $('#article_defeat_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/down-hover.png');
                var total_point = parseInt($('#article_point_' + defeat).text()) - 2;
                $('#article_point_' + defeat).text(total_point);

            } else if (data.status === "insert") {
                $('#article_victory_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/up.png');
                $('#article_defeat_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/down-hover.png');
                var total_point = parseInt($('#article_point_' + defeat).text()) - 1;
                $('#article_point_' + defeat).text(total_point);
            } else {
                location.reload();
            }
        }
    });
}

function onArticleFavourites(favourites) {
//    alert(favourites);
    $.ajax({
        type: "POST",
        url: base_url + "public/news/article_favourites",
        data: {favourites: favourites},
        cache: false,
        dataType: 'JSON',
        success: function(data) {
            if (data.status == "false") {
//                location.href = base_url + "user/login";
//                  $('#login_modal').trigger('click');
                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {

//                $('#article_favourites_img_' + favourites).addClass('fa fa-folder-open');
                $('#article_favourites_img_' + favourites).attr('src', base_url + 'assets/public/img/icon/post/open.png');


            } else if (data.status === "insert") {
//              $('#article_favourites_img_' + favourites).addClass('fa fa-folder');
                $('#article_favourites_img_' + favourites).attr('src', base_url + 'assets/public/img/icon/post/open-hover.png');

            } else {
                location.reload();
            }
        }
    });
}
$(document).ready(function() {
    $('#login_close').click(function() {

        $('#login').removeClass('in');
        $('#login').hide();
        $('#modal_backdrop').remove();
    });
});





