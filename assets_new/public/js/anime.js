$(document).ready(function () { 
    $('#allanime').css('background', '#b83c54');
    $('#allanime').css('color', 'white');
    var mainTab = "popular";
    var main = '';
    anime_list(main, mainTab);
    $('.tabs').each(function () {

        var data = $(this).children().attr('id');
        $('#' + data).click(function () {
            mainTab = $(this).attr('id');
            anime_list(main, mainTab);
        });
    });
    $('.subTab').each(function () {
        var data = $(this).attr('id');
        $('#' + data).click(function () {
            $('.subTab').css('color', '#b83c54');
            $('.subTab').css('background', 'white');
            if (data == 'allanime') {
                main = '';
            } else {
                main = $(this).attr('id');
            }
            $('#' + data).css('background', '#b83c54');
            $('#' + data).css('color', 'white');
            anime_list(main, mainTab);
        });
    });
    $('.subTabRes').each(function () {

        var data = $(this).children().attr('id');
        $('#' + data).click(function () {

            if (data == 'allanimeall') {
                main = '';
            } else {
                main = $(this).attr('id');
                var str = $(this).attr('id');
                var spiltmain = str.split("_");
                main = spiltmain[1];
            }
            $('#freshVal').text($(this).text());

            anime_list(main, mainTab);
        });
    });
    $('#searchanime').keyup(function () {
        main = $(this).val();
        anime_list(main, mainTab);
    });
    $('#searchanimeres').keyup(function () {
        main = $(this).val();
        anime_list(main, mainTab);
    });
    function anime_list(main, mainTab) {
        $.ajax({
            type: "POST",
            url: base_url + 'public/animelist/anime_get_list',
            data: {main: main, mainTab: mainTab},
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (msg) {
                $("#loader").hide();
                $('#anime_id').html(msg);

            }
        });
    }
});

function review() {
    var anime_id = $('#anime_name').val();
    $.ajax({
        type: "POST",
        url: base_url + 'public/animelist/anime_review_sec_tab',
        dataType: 'html',
        data: {anime_id: anime_id},
        beforeSend: function () {
            $('.anime_loader').show();
        },
        success: function (msg) {
            $('.anime_loader').hide();
            $('#anime_switch').addClass('col-md-12');
            $('#anime_switch').removeClass('col-md-7');
            $('#anime_ads').hide();
            $('#anime_switch').html(msg);

        }
    });
}

function postReview() {
    var anime_id = $('#anime_name').val();
    $.ajax({
        type: "POST",
        url: base_url + 'public/animelist/anime_post_review_tab',
        data: {anime_id: anime_id},
        beforeSend: function () {
            $('.anime_loader').show();
        },
        success: function (msg) {
            $('.anime_loader').hide();
            $('#anime_switch').addClass('col-md-12');
            $('#anime_switch').removeClass('col-md-7');
            $('#anime_ads').hide();
            $('#anime_switch').html(msg);

        }
    });
}
