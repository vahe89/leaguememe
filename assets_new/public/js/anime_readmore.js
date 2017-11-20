$(document).ready(function () {
    $('#login_close').click(function () {

        $('#login').removeClass('in');
        $('#login').hide();
        $('#modal_backdrop').remove();
    });
});
$(document).ready(function () {
    var widgetId1 = anime_single_id;
    $('.animation_image').show();
    $.ajax({
        type: "POST",
        url: base_url + "public/animelist/getReviewCommentData",
        dataType: 'html',
        data: {cmtDATAid: widgetId1},
        success: function (html) {

            $("#reviewcmt_" + widgetId1).html(html);
            $("#review_id" + widgetId1).val('');
            $('.animation_image').hide();
        }
    });
    $('#addReviewCommentBox' + widgetId1).keyup(function () {
        var text_length = $('#addReviewCommentBox' + widgetId1).val().length;
        //        alert(text_length);
        var limit = 1000;
        text_remaining = limit - text_length;
        if (text_remaining == 1000) {
            $("#wordcount" + widgetId1).html('<p id=wordcount' + widgetId1 + '>1000</p>');
        } else {
            if (text_remaining >= 0)
                $("#wordcount" + widgetId1).html('<p id=wordcount' + widgetId1 + '>' + text_remaining + '</p>');
            else if (text_remaining < 0) {

                $("#wordcount" + widgetId1).html('<p id=wordcount' + widgetId1 + '><font color=red>' + text_remaining + '</font></p>');
            }
        }
    });
})
$(document).on("click", "li.parentcmtrpl", function () {
    var id = $(this).attr('id');
    var parentid = $(this).parent().attr('id');
    $("#fullReplyBox-" + parentid).show();
    $("#rplycmtbox-" + parentid).slideToggle('slow');
    $("#addrplCommentBox" + parentid).val('');
    var username = $('.prtgetusername__' + parentid).text();
    $("#addrplCommentBox" + parentid).val('@' + username);
    $("#addrplCommentBox" + parentid).focus();
    $('html, body').animate({scrollTop: Number($("#addrplCommentBox" + parentid).offset().top) - 90}, "slow");
});
$(document).on("click", "button.commentrplPostBtn", function () {
    var widgetId1 = anime_single_id;

    //$('.commentrplPostBtn').bind('click', function (e) {
    var id = $(this).attr('id');
    var parentid = $(this).parent().attr('id');
    var word = $("#inerwordcount" + parentid).text();
    if (word >= 0) {
        $("#inerwordcount" + parentid).html('<p id=inerwordcount' + parentid + '>1000</p>');
        $.ajax({
            type: "POST",
            url: base_url + "public/user/checkUserLoginOrNot", dataType: 'html', success: function (data) {
                if (data != "offline") {
                    addNewComment(data, parentid, widgetId1);
                } else {
                    var url = base_url + "public/user/login";
                    $(location).attr("href", url);
                }
            }
        });
        $("#fullReplyBox-" + parentid).show();
        function addNewComment(data, parentid, review_id) {
            var comment = $("#addrplCommentBox" + parentid).val();
            var allData = {
                user_id: data,
                reviewid: review_id,
                cmt: comment,
                parent: parentid,
            };
            if (!comment) {
                $("#addrplCommentBox" + parentid).focus();
                $('html, body').animate({scrollTop: Number($("#addrplCommentBox" + parentid).offset().top) - 90}, "slow");
            }
            else {
                $('.animation_image').show();
                $.ajax({
                    type: "POST",
                    url: base_url + "public/animelist/postcommentreview",
                    data: {cmtData: allData},
                    dataType: 'html',
                    success: function (data) {

                        //console.log(data);
                        $("#addrplCommentBox" + parentid).val('');
                        //getallcomment(leaguid,parentid);
                        $('#fullReplyBox-' + parentid).append(data);
                        $('#rplycmtbox-' + parentid).hide();
                        $('.animation_image').hide();
                    }
                });
            }
        }
    }
    else {
        $("#inerwordcountdiv" + parentid).fadeTo(100, 0.1).fadeTo(200, 1.0);
    }
});
$(document).on("click", "li.childsubcmtrpl", function () {
    var widgetId1 = anime_single_id;
    var id = $(this).attr('id');
    var parentid = $(this).parent().attr('id');
    var parentclass = $(this).parent().parent().attr('class');
    //        alert(parentclass);
    //        $(".childrplycmtbox-" + parentid).slideToggle('slow');
    $(this).toggleClass("trigger_active").next($('#childrplycmtbox-' + parentclass).slideToggle('slow'));
    //        $('#childid_' + parentclass).append($(".childrplycmtbox-" + parentid).slideToggle('slow'));
    $("#childaddrplCommentBox-" + parentid).val('');
    var username = $('.getusername__' + parentclass).text();
    $("#childaddrplCommentBox-" + parentclass).val('@' + username);
    $("#childaddrplCommentBox-" + parentclass).focus();
    $('html, body').animate({scrollTop: Number($("#childaddrplCommentBox-" + parentclass).offset().top) - 90}, "slow");
});
$(document).on("click", "button.childcommentrplPostBtn", function () {         //$('.commentrplPostBtn').bind('click', function (e) {
    var widgetId1 = anime_single_id;

    var id = $(this).attr('id');
    var parentid = $(this).parent().attr('id');
    var word = $("#childinerwordcountdiv" + parentid).text();
    if (word >= 0) {
        $("#childinerwordcountdiv" + parentid).html('<p id=childinerwordcountdiv' + parentid + '>1000</p>');
        $.ajax({
            type: "POST",
            url: base_url + "public/user/checkUserLoginOrNot",
            dataType: 'html', success: function (data) {
                if (data != "offline") {
                    addNewComment(data, parentid, widgetId1);
                } else {
                    var url = base_url + "public/user/login";
                    $(location).attr("href", url);
                }
            }
        });
        $("#fullReplyBox-" + parentid).show();
        function addNewComment(data, parentid, review_id) {
            var comment = $("#childaddrplCommentBox-" + id).val();
            var allData = {
                user_id: data,
                reviewid: review_id,
                cmt: comment,
                parent: parentid,
            };
            if (!comment) {
                $("#childaddrplCommentBox-" + id).focus();
                $('html, body').animate({scrollTop: Number($("#childaddrplCommentBox-" + id).offset().top) - 90}, "slow");
            }
            else {
                $('.animation_image').show();
                $.ajax({
                    type: "POST", url: base_url + "public/animelist/postcommentreview",
                    data: {cmtData: allData},
                    dataType: 'html',
                    success: function (data) {
                        //console.log(data);
                        $("#childaddrplCommentBox-" + parentid).val('');
                        //getallcomment(leaguid,parentid);
                        $('#fullReplyBox-' + parentid).append(data);
                        $('#childaddrplCommentBox-' + id).hide();
                        $('#childinerwordcountdiv' + id).hide();
                        $('.childcommentrplPostBtn' + id).hide();
                        $('.animation_image').hide();
                    }
                });
            }
        }
    }
    else {
        $("#inerwordcountdiv" + parentid).fadeTo(100, 0.1).fadeTo(200, 1.0);
    }
});

$(document).on("keyup", "textarea.innercomboBox", function () {
    var id = $(this).parent().attr('id');
    var limit = 1000;

    //var replyboxid = id.substring(id.indexOf('-') + 1, id.length);
    var text_length = $(this).val().length;
    inertext_remaining = limit - text_length;
    if (inertext_remaining == 1000) {
        $("#inerwordcountdiv" + id).html('<p id=inerwordcount' + id + '>1000</p>');
    } else {
        if (inertext_remaining >= 0)
            $("#inerwordcountdiv" + id).html('<p id=inerwordcount' + id + '>' + inertext_remaining + '</p>');
        else if (inertext_remaining < 0) {
            $("#inerwordcountdiv" + id).html('<p id=inerwordcount' + id + '><font color=red><b>' + inertext_remaining + '</b></font></p>');
        }
    }
});
$(document).on("keyup", "textarea.childinnercomboBox", function () {
    var idd = $(this).attr('id').split("-");
    var id = idd[1];
    var limit = 1000;
    //var replyboxid = id.substring(id.indexOf('-') + 1, id.length);
    var text_length = $(this).val().length;
    inertext_remaining = limit - text_length;
    if (inertext_remaining == 1000) {
        $("#childinerwordcountdiv" + id).html('<p id=childinerwordcount' + id + '>1000</p>');
    } else {
        if (inertext_remaining >= 0)
            $("#childinerwordcountdiv" + id).html('<p id=childinerwordcount' + id + '>' + inertext_remaining + '</p>');
        else if (inertext_remaining < 0) {
            $("#childinerwordcountdiv" + id).html('<p id=childinerwordcount' + id + '><font color=red><b>' + inertext_remaining + '</b></font></p>');
        }
    }
});
function postcommentReview() {
    var review_id = $('#review_commentid').val();
    $.ajax({
        type: 'POST',
        url: base_url + 'public/user/checkUserLoginOrNot',
        dataType: 'html',
        beforeSend: function () {
            $('.animation_image').show();
        },
        success: function (data)
        {
            if (data != "offline") {
                addreviewcomment(data, review_id);
                $('.animation_image').hide();
            }
            else {
                var url = base_url + "public/user/login";
                //                    $(location).attr("href", url);
            }
        }
    });
}
function addreviewcomment(data, review_id) {

    var comment = $("#addReviewCommentBox" + review_id).val();
    var allData = {
        user_id: data,
        reviewid: review_id,
        cmt: comment,
        parent: '0',
    };

    var fdata = new FormData();
    fdata.append('userfile', $("#animeReview_click")[0].files[0]);

    fdata.append('user_id', data);
    fdata.append('reviewid', review_id);
    fdata.append('cmt', comment);
    fdata.append('parent', '0');
    fdata.append('rewTypeUnique', 'review_img_upload');



    if (!comment) {
        $("#addReviewCommentBox" + review_id).focus();
        $('html, body').animate({scrollTop: Number($("#addReviewCommentBox" + review_id).offset().top) - 90}, "slow");
    } else {
        $('.animation_image').show();
        $.ajax({
            type: "POST",
            url: base_url + "public/animelist/postcommentreview",
//            data: {cmtData: allData},
            processData: false,
            contentType: false,
            data: fdata,
            dataType: 'html',
            success: function (data) {
                $.ajax({
                    type: "POST",
                    url: base_url + "public/animelist/getReviewCommentData",
                    data: {cmtDATAid: review_id},
                    success: function (html) {

                        $("#reviewcmt_" + review_id).html(html);
                        $("#review_id" + review_id).val('');
                        $('.animation_image').hide();
                        $("#addReviewCommentBox" + review_id).val('');

                        $('#make_click').val("");
                        $('.added-image').html("");
                        $('.textarea-box').removeClass('resize');
                        $('.textarea-box').next().removeClass('display-post-comment');
                        $('.textarea-box').next().next().removeClass('value-box-click');

                        //                                var cmtposition = $("#comment_236").offset();
                        //                                console.log(Number(cmtposition["top"]));
                        //                                 $('html, body').animate({scrollTop: Number(cmtposition["top"]) + 150}, "slow");
                    }
                });
            }
        });
    }

}