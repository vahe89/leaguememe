function onvictory(victory) {
    $.ajax({
        type: "POST",
        url: base_url + "leaguelist/league_victory",
        data: {victory: victory},
        cache: false,
        dataType: 'JSON',
        success: function (data) {
            if (data.status === "false") {
                location.href = base_url + "user/login";
            } else {
                //location.reload();
            }
        }
    });
}

function ondefeat(defeat) {
    $.ajax({
        type: "POST",
        url: base_url + "leaguelist/league_defeat",
        data: {defeat: defeat},
        cache: false,
        dataType: 'JSON',
        success: function (data) {
            if (data.status == "false") {
                location.href = base_url + "user/login";
            } else {
                location.reload();
            }
        }
    });
}

$(document).ready(function () {
    $("#toggler").click(function () {
        $("#editpoint").show('slow');
    });

    if ($("#newone").hasClass('active')) {
        $("#populardiv").hide();
        $("#newdiv").show();
    }

    if ($("#popular").hasClass('active')) {
        $("#newdiv").hide();
        $("#populardiv").show();
    } else {
        $("#newone").addClass('active');
        $("#populardiv").hide();
        $("#newdiv").show();
    }

    $('.btn-group a').click(function (e) {
        $('.btn-group a').removeClass('active');
        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
    });

    $(".m_r").click(function () {
        $(".txt").fadeOut(500);
    });

});

function doFavAction(league_img_id, user_id, status) {

    if (user_id == '0') {
        window.location.href = base_url + "user/login";
    } else {
        var url;
        if (status == 'add') {
            url = "home/add_favourites";
        } else {
            url = "home/remove_favourites";
        }

        $.ajax({
            type: "POST",
            url: url,
            data: "id=" + league_img_id,
            success: function (result) {
                alert(result);
                if (result == 'notfav') {
                    $('#favornot' + league_img_id).attr("src", "assets/img/addfavourite.png");
                }
                else {
                    $('#favornot' + league_img_id).attr("src", "assets/img/addfavourite_hover.png");
                }
            }
        });
        return false;
    }
}

function pop_share(league_id) {
    $("#pop" + league_id).fadeToggle("slow");
}

$('#close').click(function () {
    $('#popup').hide();
    $('.popup_outer').css('display', 'none');
});

function toggleSlides() {

    $('.toggler').click(function (e) {
        var id = $(this).attr('id');
        var widgetId = id.substring(id.indexOf('-') + 1, id.length);
        $('#' + widgetId).slideToggle();
        $(this).toggleClass('sliderExpanded');
        $('.closeSlider').click(function () {
            $(this).parent().hide('slow');
            var relatedToggler = 'toggler-' + $(this).parent().attr('id');
            $('#' + relatedToggler).removeClass('sliderExpanded');
        });
        if ($('#cmnt_count_' + id).val() == 0) {
            $('.content').css("height", "1");
        } else {
            $('.content').css("height", "220");
        }
    });
}

$(function () {
    toggleSlides(30000);
});

$(document).ready(function () {
    $(".defeat1").click(function () {
        var defeat = $(this).attr('rel');
        $.ajax({
            type: "POST",
            url: base_url + "leaguelist/league_defeat",
            data: {defeat: defeat},
            cache: false,
            dataType: 'html',
            success: function (data) {
                if (data == "false") {
                    location.href = base_url + "user/login";
                } else {
                    location.reload();
                }
            }
        });
    });

    $("#newone").click(function () {
        var pathArray = window.location.pathname.split('/');
        var a = pathArray[2];
        var m = pathArray[3];
        var s = pathArray[4];
        if (m != "index" && s != "undefined" && a == "LoL") {
            location.href = base_url + "LoL/New/" + s;
        } else {
            location.href = base_url + "LoL/New/allthethings";
        }
        $("#popular").removeClass("active");
        $("#populardiv").hide();
        $("#newdiv").show();
    });

    $("#popular").click(function () {
        var pathArray = window.location.pathname.split('/');
        var a = pathArray[2];
        var m = pathArray[3];
        var s = pathArray[4];
        if (m != "index" && s != "undefined" && a == "LoL") {
            location.href = base_url + "LoL/Popular/" + s;
        } else {
            location.href = base_url + "LoL/Popular/allthethings";
        }
        $("#newone").removeClass("active");
        $("#newdiv").hide();
        $("#populardiv").show();
    });
});

function delete_league(league_id) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "leaguelist/deleteleague_img",
            data: {league_img_id: league_id},
            cache: false,
            dataType: 'html',
            success: function (data) {
                location.reload();
            }
        });
    }
}

function add_comment(league_id) {
    var comments = $("[name=comments" + league_id + "]").val();
    $.ajax({
        type: "POST",
        url: base_url + "leaguelist/add_comment",
        data: {league_img_id: league_id, comment: comments},
        cache: false,
        dataType: 'html',
        success: function (data) {
            location.reload();
        }
    });
}

function delete_comment(comment_id) {
    $.ajax({
        type: "POST",
        url: base_url + "leaguelist/delete_comment",
        data: {comment_id: comment_id},
        cache: false,
        dataType: 'html',
        success: function (data) {
            $("#comment_" + comment_id).hide();
        }
    });
}

(function ($) {
    $(window).load(function () {

        $("a[rel='load-content']").click(function (e) {
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function (data) {
                $(".content .mCSB_container").append(data); //load new content inside .mCSB_container
                //scroll-to appended content 
                $(".content").mCustomScrollbar("scrollTo", "h2:last");
            });
        });

        $(".content").delegate("a[href='top']", "click", function (e) {
            e.preventDefault();
            $(".content").mCustomScrollbar("scrollTo", $(this).attr("href"));
        });
    });
})(jQuery);