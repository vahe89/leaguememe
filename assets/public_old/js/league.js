function onvictory(victory) {
    $.ajax({
        type: "POST",
        url: base_url + "public/leaguelist/league_victory",
        data: {victory: victory},
        cache: false,
        dataType: 'JSON',
        success: function (data) {
//            console.log(data);
            if (data.status === "false") {
//                location.href = base_url + "user/login";
//                  $('#login-modal').trigger('click');
                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login-modal').addClass('in');
                $('#login-modal').show();
//                  $('#login-modal').addClass('in');
            } else if (data.status === "delete") {
                $('#defeat_img_' + victory).removeClass('defeat_active');
                $('#victory_img_' + victory).removeClass('victory_active');

                var total_point = parseInt($('#point_' + victory).text()) - 1;
                $('#point_' + victory).text(total_point);
            } else if (data.status === "update") {
                $('#defeat_img_' + victory).removeClass('defeat_active');
                $('#victory_img_' + victory).addClass('victory_active');
                var total_point = parseInt($('#point_' + victory).text()) + 2;
                $('#point_' + victory).text(total_point);

            } else if (data.status === "insert") {
                $('#defeat_img_' + victory).removeClass('defeat_active');
                $('#victory_img_' + victory).addClass('victory_active');
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
//                location.href = base_url + "user/login";
//                  $('#login_modal').trigger('click');
                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login-modal').addClass('in');
                $('#login-modal').show();
            } else if (data.status === "delete") {
                $('#victory_img_' + defeat).removeClass('victory_active');
                $('#defeat_img_' + defeat).removeClass('defeat_active');
                var total_point = parseInt($('#point_' + defeat).text()) + 1;
                $('#point_' + defeat).text(total_point);

            } else if (data.status === "update") {
                $('#victory_img_' + defeat).removeClass('victory_active');
                $('#defeat_img_' + defeat).addClass('defeat_active');
                var total_point = parseInt($('#point_' + defeat).text()) - 2;
                $('#point_' + defeat).text(total_point);

            } else if (data.status === "insert") {
                $('#victory_img_' + defeat).removeClass('victory_active');
                $('#defeat_img_' + defeat).addClass('defeat_active');
                var total_point = parseInt($('#point_' + defeat).text()) - 1;
                $('#point_' + defeat).text(total_point);
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
        url: base_url + "public/leaguelist/league_favourites",
        data: {favourites :favourites},
        cache: false,
        dataType: 'JSON',
        success: function (data) {
            if (data.status == "false") {
//                location.href = base_url + "user/login";
//                  $('#login_modal').trigger('click');
                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login-modal').addClass('in');
                $('#login-modal').show();
            }  else if (data.status === "delete") {
               
//                $('#favourites_img_' + favourites).addClass('fa fa-folder-open');
                $('#favourites_img_' + favourites).removeClass('favourites_active');
               

            } else if (data.status === "insert") {
//              $('#favourites_img_' + favourites).addClass('fa fa-folder');
                $('#favourites_img_' + favourites).addClass('favourites_active');
              
            } else {
                location.reload();
            }
        }
    });
}
$(document).ready(function () {
    $('#login_close_btn').click(function () {

        $('#login-modal').removeClass('in');
        $('#login-modal').hide();
        $('#modal_backdrop').remove();
    });
});





