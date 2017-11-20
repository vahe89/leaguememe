$(document).ready(function () {
    summary();
});
function summary() {
    $('#recent_dis').show();
    var anime_id = $('#anime_name').val();
    $.ajax({
        type: "POST",
        url: base_url + 'public/animelist/anime_first_tab',
        data: {anime_id: anime_id},
        beforeSend: function () {
            $('.anime_loader').show();
        },
        success: function (msg) {
            $('.anime_loader').hide();
            $('#anime_switch').removeClass('col-md-12');
            $('#anime_switch').addClass('col-md-7');
            $('#anime_ads').show();
            $('#anime_switch').html(msg);

        }
    });
}
$('#discussion').click(function () {
    var anime_id = $('#anime_name').val();
    $.ajax({
        type: "POST",
        url: base_url + 'public/animelist/anime_discussion_tab',
        data: {anime_id: anime_id},
        beforeSend: function () {
            $('.anime_loader').show();
        },
        success: function (msg) {
            $('.anime_loader').hide();
            $('#anime_switch').removeClass('col-md-12');
            $('#anime_switch').addClass('col-md-7');
            $('#anime_ads').show();
            $('#anime_switch').html(msg);

        }
    });
});



$('#theories').click(function () {
    var anime_id = $('#anime_name').val();
    $.ajax({
        type: "POST",
        url: base_url + 'public/animelist/anime_theories_tab',
        data: {anime_id: anime_id},
        beforeSend: function () {
            $('.anime_loader').show();
        },
        success: function (msg) {
            $('.anime_loader').hide();
            $('#anime_switch').removeClass('col-md-12');
            $('#anime_switch').addClass('col-md-7');
            $('#anime_ads').show();
            $('#anime_switch').html(msg);

        }
    });
});
$('#episode-sec').click(function () {
    var anime_id = $('#anime_name').val();
    $.ajax({
        type: "POST",
        url: base_url + 'public/animelist/anime_episode_sec_tab',
        data: {anime_id: anime_id},
        beforeSend: function () {
            $('.anime_loader').show();
        },
        success: function (msg) {
            $('.anime_loader').hide();
            $('#anime_switch').removeClass('col-md-12');
            $('#anime_switch').addClass('col-md-7');
            $('#anime_ads').show();
            $('#anime_switch').html(msg);

        }
    });
});
$('#manga').click(function () {
    var anime_id = $('#anime_name').val();
    $.ajax({
        type: "POST",
        url: base_url + 'public/animelist/anime_manga_tab',
        data: {anime_id: anime_id},
        beforeSend: function () {
            $('.anime_loader').show();
        },
        success: function (msg) {
            $('.anime_loader').hide();
            $('#anime_switch').removeClass('col-md-12');
            $('#anime_switch').addClass('col-md-7');
            $('#anime_ads').show();
            $('#anime_switch').html(msg);

        }
    });
});
$('#quotes-sec').click(function () {
    var anime_id = $('#anime_name').val();
    $.ajax({
        type: "POST",
        url: base_url + 'public/animelist/anime_quotes_sec_tab',
        data: {anime_id: anime_id},
        beforeSend: function () {
            $('.anime_loader').show();
        },
        success: function (msg) {
            $('.anime_loader').hide();
            $('#anime_switch').removeClass('col-md-12');
            $('#anime_switch').addClass('col-md-7');
            $('#anime_ads').show();
            $('#anime_switch').html(msg);

        }
    });
});
