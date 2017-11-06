function onvictory(victory) {

    $.ajax({
        type: "POST",
        url: base_url + "public/patch_note/patch_victory",
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
                $('#defeat_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/down.png');
                $('#victory_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/up.png');

                var total_point = parseInt($('#point_' + victory).text()) - 1;
                $('#point_' + victory).text(total_point);
                 new PNotify({
                    title: 'Victory',
                    text: 'Victory Remove',
                    type: 'info'
                });
            } else if (data.status === "update") {
                $('#defeat_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/down.png');
                $('#victory_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/up-hover.png');
                var total_point = parseInt($('#point_' + victory).text()) + 2;
                
                $('#point_' + victory).text(total_point);
                 new PNotify({
                    title: 'Victory',
                    text: 'Victory Update',
                    type: 'info'
                });

            } else if (data.status === "insert") {
                $('#defeat_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/down.png');
                $('#victory_img_' + victory).attr('src', base_url + 'assets/public/img/icon/post/up-hover.png');
                var total_point = parseInt($('#point_' + victory).text()) + 1;
                $('#point_' + victory).text(total_point);
                 new PNotify({
                    title: 'Victory',
                    text: 'Victory Save',
                    type: 'success'
                });
            } else {
                location.reload();
            }
        }
    });
}
function ondefeat(defeat) {
    $.ajax({
        type: "POST",
        url: base_url + "public/patch_note/patch_defeat",
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
                $('#victory_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/up.png');
                $('#defeat_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/down.png');
                var total_point = parseInt($('#point_' + defeat).text()) + 1;
                $('#point_' + defeat).text(total_point);
                new PNotify({
                    title: 'Defeat',
                    text: 'Defeat Remove',
                    type: 'info'
                });
            } else if (data.status === "update") {
                $('#victory_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/up.png');
                $('#defeat_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/down-hover.png');
                var total_point = parseInt($('#point_' + defeat).text()) - 2;
                $('#point_' + defeat).text(total_point);
                    new PNotify({
                    title: 'Defeat',
                    text: 'Defeat Update',
                    type: 'info'
                });
            } else if (data.status === "insert") {
                $('#victory_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/up.png');
                $('#defeat_img_' + defeat).attr('src', base_url + 'assets/public/img/icon/post/down-hover.png');
                var total_point = parseInt($('#point_' + defeat).text()) - 1;
                $('#point_' + defeat).text(total_point);
                    new PNotify({
                    title: 'Defeat',
                    text: 'Defeat Save',
                    type: 'success'
                });
            } else {
                location.reload();
            }
        }
    });
}

function onfavourites(favourites) {
//    alert(favourites);
    $.ajax({
        type: "POST",
        url: base_url + "public/patch_note/patch_favourites",
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

//                $('#favourites_img_' + favourites).addClass('fa fa-folder-open');
                $('#favourites_img_' + favourites).attr('src', base_url + 'assets/public/img/icon/post/open.png');
                new PNotify({
                    title: 'Bookmark ',
                    text: 'Bookmark Unsaved',
                    type: 'info'
                });


            } else if (data.status === "insert") {
//              $('#favourites_img_' + favourites).addClass('fa fa-folder');
                $('#favourites_img_' + favourites).attr('src', base_url + 'assets/public/img/icon/post/open-hover.png');
                new PNotify({
                    title: 'Bookmark ',
                    text: 'Bookmark saved',
                    type: 'success'
                });
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





