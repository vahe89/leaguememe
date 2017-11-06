function checkLoginOrNot(callback) {
    var status;
    $.ajax({
        type: "POST",
        url: base_url + "public/user/checkUserLoginOrNot",
        dataType: 'html',
        success: function(data) {

            status = data;
            callback(status);
        }
    });

}
$('.onePieceThread').on('click', function() {
    checkLoginOrNot(function(d) {
        if (d != "offline") {
            $('.onePieceThread').hide();
            $('#discussion,#news-outer,#gameChat,#event,#moment').removeClass("active");
            $('#uploadOnePiece').addClass("active");
            $('.onePieceBack').show();
            $('#uploadOnePiece').find('.banner_first').show();
        }
    });

});
$('.onePieceBack').on('click', function() {
    $(this).hide();
    $('.onePieceThread').show();
    $('#discussion,#news-outer,#gameChat,#event,#moment').removeClass("active");
    $('#moment').addClass("active");
    $('#uploadOnePiece').removeClass("active");
});
// Discussion Tab
$('.discussionThread').on('click', function() {
    checkLoginOrNot(function(d) {
        if (d != "offline") {
            $('.discussionThread').hide();
            $('#index1,#news-outer,#gameChat,#event,#moment').removeClass("active");
            $('#upload-discussion-tab').addClass("active");
            $('.discussionBack').show();
            $('#upload-discussion-tab').find('.banner_first').show();
        }
    });
});
$('.discussionBack').on('click', function() {
    $(this).hide();
    $('.discussionThread').show();
    $('#index1,#news-outer,#gameChat,#event,#moment').removeClass("active");
    $('#discussion').addClass("active");
    $('#upload-discussion-tab').removeClass("active");
});
//poll tab 
$('.pollThread').on('click', function() {
    checkLoginOrNot(function(d) {
        if (d != "offline") {
            $('.pollThread').hide();
            $('#index1,#news-outer,#gameChat,#event,#moment', '#poll').removeClass("active");
            $('#upload-poll-tab').addClass("active");
            $('.pollBack').show();
            $('#upload-poll-tab').find('.banner_first').show();
        }
    });

});
$('.pollBack').on('click', function() {
    $(this).hide();
    $('.pollThread').show();
    $('#index1,#news-outer,#gameChat,#event,#moment,#poll').removeClass("active");
    $('#poll').addClass("active");
    $('#upload-poll-tab').removeClass("active");
});
// Gamechat Tab
$('.gamechatThread').on('click', function() {
    checkLoginOrNot(function(d) {
        if (d != "offline") {
            $('.gamechatThread').hide();
            $('#contentGamechat').hide();
            $('#uploadGamechat').show();
            $('.gamechatBack').show();
            $('#uploadGamechat').find('#banner_first').show();
        }
    });

});
$('.gamechatBack').on('click', function() {
    $(this).hide();
    $('.gamechatThread').show();
    $('#contentGamechat').show();
    $('#uploadGamechat').hide();
});
$(document).on("click", "span.disc-credit-shows", function(e) {
    if ($(this).text() == "Credit") {
        $(this).text($(this).data("credit"));
        $(this).next("a").show();
    }
    else {
        $(this).text("Credit");
        $(this).next("a").hide();
    }
})
/***************/
$('#more').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td')
    elem.toggle('slow');
});
$('#more1').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td1')
    elem.toggle('slow');
});
$('#more2').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td2')
    elem.toggle('slow');
});
$('#more3').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td3')
    elem.toggle('slow');
});
$('#more4').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td4')
    elem.toggle('slow');
});
$('#more5').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td5')
    elem.toggle('slow');
});
$('#more6').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td6')
    elem.toggle('slow');
});
$('#more7').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td7')
    elem.toggle('slow');
});
$('#more8').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td8')
    elem.toggle('slow');
});
$('#more9').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td9')
    elem.toggle('slow');
});
$('#more10').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td10')
    elem.toggle('slow');
});
$('#more11').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td11')
    elem.toggle('slow');
});
$('#more12').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td12')
    elem.toggle('slow');
});
$('#more13').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td13')
    elem.toggle('slow');
});
$('#more14').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td14')
    elem.toggle('slow');
});
$('#more15').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td15')
    elem.toggle('slow');
});
$('#more16').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td16')
    elem.toggle('slow');
});
$('#more17').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td17')
    elem.toggle('slow');
});
$('#more18').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).prevAll('.td18')
    elem.toggle('slow');
});
$(document).ready(function() {
// ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
    $('#noti_Counter')
            .css({opacity: 0})
            .text($('#noti_hide_count').val())              // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
            .css({top: '-10px'})
            .animate({top: '-2px', opacity: 1}, 500);
    $('#noti_Button').click(function() {

// TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
        $('#notifications').fadeToggle('fast', 'linear', function() {
            if ($('#notifications').is(':hidden')) {
                $('#noti_Button').css('color', '#E4AC38');
            }
        });
        $.ajax({
            type: "POST",
            url: base_url + 'public/user/noti_modal',
            beforeSend: function() {
                $('#loader_noti').show();
            },
            success: function(data) {
                $('#loader_noti').show();
                $('#notifications').html(data)
            }
        });
        $('#noti_Counter').fadeOut('slow'); // HIDE THE COUNTER.

        return false;
    });
    // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
    $(document).click(function() {
        $('#notifications').hide();
        // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
        if ($('#noti_Counter').is(':hidden')) {
// CHANGE BACKGROUND COLOR OF THE BUTTON.
        }
    });
});
$(document).ready(function() {
// ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
    $('#noti_Counter_res')
            .css({opacity: 0})
            .text($('#noti_hide_count').val())              // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
            .css({top: '-10px'})
            .animate({top: '-2px', opacity: 1}, 500);
    $('#noti_Button_res').click(function() {

// TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
        $('#notifications_res').fadeToggle('fast', 'linear', function() {
            if ($('#notifications_res').is(':hidden')) {
                $('#noti_Button_res').css('color', '#E4AC38');
            }
        });
        $.ajax({
            type: "POST",
            url: base_url + 'public/user/noti_modal',
            beforeSend: function() {
                $('#loader_noti_res').show();
            },
            success: function(data) {
                $('#loader_noti_res').show();
                $('#notifications_res').html(data)
            }
        });
        $('#noti_Counter_res').fadeOut('slow'); // HIDE THE COUNTER.

        return false;
    });
    // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
    $(document).click(function() {
        $('#notifications_res').hide();
        // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
        if ($('#noti_Counter_res').is(':hidden')) {
// CHANGE BACKGROUND COLOR OF THE BUTTON.
        }
    });
});
function changeImage(link, type) {
    window.test = link;
    src = $(link).attr('src');
    $(link).parents('.troll').find('img').first().attr('src', 'assets/img/up-triangle.png');
    $(link).parents('.troll').find('img').last().attr('src', 'assets/img/down-triangle.png');
    if (src == 'assets/img/' + type + '-triangle.png') {
        $(link).attr('src', base_url + 'assets/public/img/' + type + '-triangle-hover.png');
    } else {
        $(link).attr('src', base_url + 'assets/public/img/' + type + '-triangle.png');
    }
}


function reviewSearch() {
    $.ajax({
        type: "POST",
        url: base_url + "public/user/review_search_all",
        data: {"reviewSearchData": $('#reviewSearch').val()},
        cache: false,
        success: function(data) {
            var str = '';
            var newdata = JSON.parse(data);
            if (!jQuery.isEmptyObject(newdata)) {
                $.each(newdata, function(index, value) {

                    str += '<li class="ui-state-default ui-sortable-handle" data-id="' + value.id + '" data-anime="' + value.anime_id + '"><div class="review-anime-panel">' + (value.overall_rate) * 2 + '</div><div class="wrap-text-panel"><div class="title-edit-panel">' + value.anime_name + '</div><a href="javascript:void(0)" class="delete-panelReview"><i class="fa fa-times-circle"></i></a></div></li>';
                });
            } else {
                str += '<li class="errorNoresult">There is no result found, please try to find another way</li>';
            }
            $('#sortable-right').empty();
            $('#sortable-right').append(str);
        }
    });
}

function animSearch() {
    $.ajax({
        type: "POST",
        url: base_url + "public/user/anime_search_all",
        data: {"animeSearchData": $("#animeSearch").val()},
        cache: false,
        success: function(data) {

            var str = '';
            var newdata = JSON.parse(data);
            if (!jQuery.isEmptyObject(newdata)) {
                $.each(newdata, function(index, value) {

                    var chk = '';
                    var favouriteType = "";
                    if ($('#animeSearch').val() != '') {

                        if (value.favourite == 'A') {
                            favouriteType = "A";
                            chk += '<input type="checkbox"  name="checkbox[]" class="commonCheckanim oldCheck" checked>';
                        } else {
                            favouriteType = "UF";
                            chk += '<input type="checkbox" name="checkbox[]" class="commonCheckanim newCheck">';
                        }
                    }

                    str += '<li class="ui-state-default" data-type="' + favouriteType + '" data-aid="' + value.anime_id + '"><div class="img-anime-panel"><img src="' + base_url + "uploads/anime/" + value.anime_jpg + '"  height="50px" width="50px"></div><div class="wrap-text-panel" ><div class="title-edit-panel">' + value.anime_name + '</div><a href="javascript:void(0)" class="delete-panel"><i class="fa fa-times-circle"></i></a></div>' + chk + '</li>';
                });
            } else {
                str += '<li class="errorNoresult">There is no result found, please try to find another way</li>';
            }

            $('#sortable').empty();
            $('#sortable').append(str);
        }

    });
}
/* edit anime and manga panel */
/*$('.comment-status').on('click', function (e) {
 e.preventDefault();
 showCommentForm($(this));
 $(this).parents('li').find('div.edit-comment-status').toggle();
 $(this).toggle();
 });*/

$('.delete-panelReview').click(function() {

    var confirmation = confirm("Are you sure want to remove Review from your anime review list");
    if (confirmation) {
        var data = {'reviewId': $(this).parents('li.ui-sortable-handle').attr('data-id'), 'anime_id': $(this).parents('li.ui-sortable-handle').attr('data-anime')};
        $.ajax({
            type: "POST",
            url: base_url + "public/user/review_search_delete",
            data: {"deleteReviewData": data},
            cache: false,
            success: function(data) {
                console.log(data);
            }
        });
        reviewSearch();
    }
    else {

        return false;
    }

});
$("#reviewSearch").keyup(function() {

    reviewSearch();
});
$('.delete-panel').click(function() {

    var confirmation = confirm("Are you sure want to remove anime item from your Favourite list");
    if (confirmation) {
        var data = {'anime_fav_id': $(this).parents('li.ui-sortable-handle').attr('data-anime_fav_id')};
        $.ajax({
            type: "POST",
            url: base_url + "public/user/anime_search_delete",
            data: {"unfaverioutData": data},
            cache: false,
            success: function(data) {
                console.log(data);
            }
        });
        animSearch();
    } else {
        return false;
    }

});
$("#animeSearch").keyup(function() {
    animSearch();
});
$(".commentSavebtn").click(function() {

    var checkUnCheck = [];
    $('#sortable li').each(function(index) {
        var newindex = index + 1;
        var queryType = '';
        var favourites = '';
        console.log($(this));
        if ($(this).find('.commonCheckanim')) {
            if ($(this).find('.commonCheckanim').hasClass('oldCheck')) {

                queryType = 'update';
            } else {

                queryType = 'insert';
            }

            if ($(this).find('.commonCheckanim').is(':checked')) {
                favourites = "A";
            } else {
                favourites = "UF";
            }

            checkUnCheck[index] = {"aid": $(this).attr('data-aid'), "order": newindex, 'query': queryType, "favourites": favourites}
        }


    });
    $.ajax({
        type: "POST",
        url: base_url + "public/user/random_order_anim_update",
        data: {"checkUnCheck": checkUnCheck},
        cache: false,
        success: function(data) {
            console.log(data)
        }
    });
});
/* end edit anime and manga panel */

/*  edit profile picture */
$('#change_profpict').on('click', function() {
    $('.overlay-edit').slideToggle('slow');
    $('.trigger-edit-cover').slideToggle('slow');
});
/* end edit profile picture */


$('.trigger-edit-cover').on('click', function() {
    $('#crop-cover').modal('show')
});
$('.overlay-edit').on('click', function() {
    $('#edit-profile-picture').modal('show')
});
$('.textarea-box').focus(function() {

    $(this).addClass('resize');
    $(this).next().addClass('display-post-comment');
    $(this).next().next().addClass('value-box-click');
});
$(document).click(function(event) {
    if ($(event.target).closest('.input-text-comment').length == 0) {
        $('.textarea-box').removeClass('resize');
        $('.textarea-box').next().removeClass('display-post-comment');
        $('.textarea-box').next().next().removeClass('value-box-click');
    }
});
$('.disable-comment').on('click', function() {
    $(this).parent().find('.display-comment').show();
    $(this).hide();
    $(this).parents().find('.user-comment.mar-t-20').find('.info-avatar').hide();
    $(this).parents().find('.user-comment.mar-t-20').find('.wrap-comment-field').hide();
    $(this).parents().find('.user-comment.mar-t-20').find('.noactive-comment').show();
});
$('.display-comment').on('click', function() {
    $(this).parent().find('.disable-comment').show();
    $(this).hide();
    $(this).parents().find('.user-comment.mar-t-20').find('.info-avatar').show();
    $(this).parents().find('.user-comment.mar-t-20').find('.wrap-comment-field').show();
    $(this).parents().find('.user-comment.mar-t-20').find('.noactive-comment').hide();
});
$('#manage-fav').on('click', function() {
    $(this).hide();
    $('.fav-anime-modal').show();
});
$('#close-manage').on('click', function() {
    $('#manage-fav').show();
    $('.fav-anime-modal').hide();
});