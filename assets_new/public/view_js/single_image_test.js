!function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
    if (!d.getElementById(id)) {
        js = d.createElement(s);
        js.id = id;
        js.src = p + '://platform.twitter.com/widgets.js';
        fjs.parentNode.insertBefore(js, fjs);
    }
}(document, 'script', 'twitter-wjs');

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

function onvictory(victory) {
    $.ajax({
        type: "POST",
        url: base_url + "leaguelist/league_victory",
        data: {victory: victory},
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
    $(".toggler").click(function () {
        $("#editpoint").show('slow');
    });
    $(".share").click(function () {
        $("#pop").fadeToggle("slow");
    });
});

function delete_comment(comment_id) {
    $.ajax({
        type: "POST",
        url: base_url + "leaguelist/delete_comment",
        data: {comment_id: comment_id},
        cache: false,
        dataType: 'html',
        success: function (data) {
            location.reload();
        }

    });
}

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
    });
}

$(function () {
    toggleSlides(30000);
});

function doFavAction(league_img_id, user_id) {
    var fav_action = $('#like_status').val();
    $.ajax({
        type: "POST",
        url: "home/doImageFavAction",
        data: "league_img_id=" + league_img_id + "&user_id=" + user_id + "&image_action=" + fav_action,
        success: function (result) {
            if (result == 'notfav') {
                $('#favornot' + league_img_id).attr("src", "assets/img/addfavourite.png");
            } else {
                $('#favornot' + league_img_id).attr("src", "assets/img/addfavourite_hover.png");
            }
        }
    });
    return false;
}

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

//function delete_league(league_id) {
//    $.ajax({
//        type: "POST",
//        url: base_url + "home/deleteleague_img",
//        data: {league_img_id: league_id},
//        cache: false,
//        dataType: 'html',
//        success: function (data) {
//            location.reload();
//        }
//    });
//} 

function add_comment(league_id) {
    var comments = $("[name=comments" + league_id + "]").val(); //alert(comments);
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

$(document).ready(function () {
    $("#comment_toggle_view").hide();
    $("#comment_toggle").click(function () {
        $("#comment_toggle_view").toggle(1000);
    });
});


window.fbAsyncInit = function () {
    // init the FB JS SDK
    FB.init({
        appId: '672394479542301', // App ID from the app dashboard
        status: true, // Check Facebook Login status
        xfbml: true  // Look for social plugins on the page
    });
    // Additional initialization code such as adding Event Listeners goes here
};

// Load the SDK asynchronously
(function () {
    // If we've already installed the SDK, we're done
    if (document.getElementById('facebook-jssdk')) {
        return;
    }

    // Get the first script element, which we'll use to find the parent node
    var firstScriptElement = document.getElementsByTagName('script')[0];

    // Create a new script element and set its id
    var facebookJS = document.createElement('script');
    facebookJS.id = 'facebook-jssdk';

    // Set the new script's source to the source of the Facebook JS SDK
    facebookJS.src = '//connect.facebook.net/it_IT/all.js';

    // Insert the Facebook JS SDK into the DOM
    firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
}());

$('#close').click(function () {
    $('#popup').hide();
    $('.popup_outer').css('display', 'none');
});

function pop_share(league_id) {
    $("#pop" + league_id).fadeToggle("slow");
}