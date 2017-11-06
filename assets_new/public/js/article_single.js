
function loadMoreReply(parent_id) {

    $.ajax({
        type: "POST",
        url: base_url + "public/news/getsubcomment_ajax",
        data: {pid: parent_id},
        success: function(result) {
            $("#more_comment_div_" + parent_id).html(result);
            $(".loadmore_" + parent_id).css("display", "none");
        }
    });
}
function like(user_id, comment_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "public/news/CommentLikedislike",
        dataType: 'JSON',
        data: {
            "user_id": user_id,
            "comment_id": comment_id,
            "status": "like",
        },
        success: function(data, textStatus, jqXHR) {
            if (data != "false") {


                $('#like_' + comment_id).html(data.icon);
                $('#dislike_' + comment_id).html('<img src=" ' + base_url + 'assets/public/img/down-reply.png" onmouseover="this.src =' + base_url + 'assets/public/img/down-reply-hover.png">');
                $('#countLike_' + comment_id).html(data.total);
                $('#countDislike_' + comment_id).html(data.total);


            }
        }
    });
}
function dislike(user_id, comment_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "public/news/CommentLikedislike",
        dataType: 'JSON',
        data: {
            "user_id": user_id,
            "comment_id": comment_id,
            "status": "dislike",
        },
        success: function(data, textStatus, jqXHR) {
            if (data != "false") {
                $('#dislike_' + comment_id).html(data.icon);
                $('#like_' + comment_id).html('<img src="' + base_url + 'assets/public/img/up-reply.png" onmouseover=\'this.src ="' + base_url + 'assets/public/img/up-reply-hover.png"\'>');
                $('#countLike_' + comment_id).html(data.total);
                $('#countDislike_' + comment_id).html(data.total);

            }
        }
    });
}
function delete_Comment(comment_id, key, user_id) {

    var widgetId1 = article_single_id;
    var ans = confirm("Do you want to delete?");
    if (ans == true) {
        $.ajax({
            type: "POST",
            url: base_url + "public/news/delete_comment",
            data: {comment_id: comment_id, u_id: user_id},
            cache: false,
            dataType: 'html',
            success: function(data) {
                //$("#comment_" + key).hide();
                if (key != "off") {
                    $("#comment_" + key).remove();
                    var totalcmt = Number($("#distoggler-" + widgetId1 + "y").text());
                    var totalcmt1 = Number($("#distoggler-" + widgetId1 + "yy").text());
                    totalcmt = totalcmt - 1;

                    totalcmt1 = totalcmt1 - 1;
                    $("#distoggler-" + widgetId1 + "y").text(totalcmt);
                    $("#distoggler-" + widgetId1 + "yy").text(totalcmt1);
                }
                else
                    $("#childid_" + comment_id).remove();
            }
        });
    }
}

$(document).ready(function() {

    var id = $(this).attr('id');
    var widgetId1 = article_single_id;

    var limit = 1000;
    var text_remaining;
    var inertext_remaining;

    var widgetId1;
    $('.animation_image').show();
    $.ajax({
        type: "POST",
        url: base_url + "public/news/getCommentData",
        data: {cmtDATAid: widgetId1},
        success: function(html) {

            $("#cmt_" + widgetId1).html(html);
            $("#addCommentBox" + widgetId1).val('');
            $('.animation_image').hide();
        }
    });
    $('#addCommentBox' + widgetId1).keyup(function() {
        var text_length = $('#addCommentBox' + widgetId1).val().length;
//        alert(text_length);
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
    if ($('#cmnt_count_' + id).val() == 0) {
        $('.content').css("height", "1");
    } else {
        $('.content').css("height", "220");
    }
    $('#fresh1').click(function() {
        widgetId1 = article_single_id;
//        alert(widgetId1);
        $('.animation_image').show();
        $.ajax({
            type: "POST",
            url: base_url + "public/news/getCommentFData",
            data: {cmtDATAid: widgetId1},
            success: function(html) {

                $("#ct_" + widgetId1).html(html);
                $("#addCommentBox" + widgetId1).val('');
                $('.animation_image').hide();
            }
        });

    });

    $(document).on("click", "li.parentcmtrpl", function() {
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


    $(document).on("click", "button.commentrplPostBtn", function() {
        //$('.commentrplPostBtn').bind('click', function (e) {
        var id = $(this).attr('id');
        var parentid = $(this).parent().attr('id');
        var word = $("#inerwordcount" + parentid).text();
        if (word >= 0) {
            $("#inerwordcount" + parentid).html('<p id=inerwordcount' + parentid + '>1000</p>');

            $.ajax({
                type: "POST",
                url: base_url + "public/user/checkUserLoginOrNot",
                dataType: 'html',
                success: function(data) {
                    if (data != "offline") {
                        addNewComment(data, parentid, widgetId1);
                    } else {
                        var url = base_url + "public/user/login";
                        $(location).attr("href", url);
                    }
                }
            });
            $("#fullReplyBox-" + parentid).show();
            function addNewComment(data, parentid, article_id) {
                var comment = $("#addrplCommentBox" + parentid).val();
                var allData = {
                    user_id: data,
                    article_id: article_id,
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
                        url: base_url + "public/news/addNewComment",
                        data: {cmtData: allData},
                        dataType: 'html',
                        success: function(data) {

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
    $(document).on("click", "li.childsubcmtrpl", function() {
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
    $(document).on("click", "button.childcommentrplPostBtn", function() {
        //$('.commentrplPostBtn').bind('click', function (e) {
        var id = $(this).attr('id');

        var parentid = $(this).parent().attr('id');

        var word = $("#childinerwordcountdiv" + parentid).text();
        if (word >= 0) {
            $("#childinerwordcountdiv" + parentid).html('<p id=childinerwordcountdiv' + parentid + '>1000</p>');

            $.ajax({
                type: "POST",
                url: base_url + "public/user/checkUserLoginOrNot",
                dataType: 'html',
                success: function(data) {
                    if (data != "offline") {
                        addNewComment(data, parentid, widgetId1);
                    } else {
                        var url = base_url + "public/user/login";
                        $(location).attr("href", url);
                    }
                }
            });
            $("#fullReplyBox-" + parentid).show();
            function addNewComment(data, parentid, article_id) {
                var comment = $("#childaddrplCommentBox-" + id).val();
                var allData = {
                    user_id: data,
                    article_id: article_id,
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
                        type: "POST",
                        url: base_url + "public/news/addNewComment",
                        data: {cmtData: allData},
                        dataType: 'html',
                        success: function(data) {

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

    $('.closeSlider').click(function() {
        $(this).parent().hide('slow');
        var relatedToggler = 'toggler-' + $(this).parent().attr('id');
        $('#' + relatedToggler).removeClass('sliderExpanded');
    });
    $(document).on("keyup", "textarea.innercomboBox", function() {
        var id = $(this).parent().attr('id');

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
    $(document).on("keyup", "textarea.childinnercomboBox", function() {
        var idd = $(this).attr('id').split("-");
        var id = idd[1];
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

    $('.commentPostBtn').click(function(e) { 
        var id = $(this).attr('id');
        var word = $("#wordcount" + id).text();
//    var inputtext = $("#addCommentBox" + id).text('hello');
        var inputtext = $("#addCommentBox" + id).val().length;
        if (word > 0 && inputtext > 0) {
            var totalcmt = Number($("#toggler-" + widgetId1 + "y span").text());
            var totalcmt1 = Number($("#toggler-" + widgetId1 + "yy span").text());
            totalcmt = totalcmt + 1;
            totalcmt1 = totalcmt1 + 1;
            $("#toggler-" + widgetId1 + "y span").text(totalcmt);
            $("#toggler-" + widgetId1 + "yy span").text(totalcmt1);
            $("#wordcount" + id).html('<p id=wordcount' + id + '>1000</p>');
            var id = $(this).attr('id');
            //ajax call first check user is login or not
            $.ajax({
                type: "POST",
                url: base_url + "public/user/checkUserLoginOrNot",
                dataType: 'html',
                success: function(data) {
                    if (data != "offline") {
                        addNewComment(data, id);
                    }
                    else {
                        var url = base_url + "public/user/login"; 
                    }
                }
            });
            function addNewComment(data, id) { 
                var filename = $("#make_click").val();
                var comment = $("#addCommentBox" + id).val();
                var userfile = $("#make_click").val();
                var fname = $("#make_click").attr('name');


                var fdata = new FormData();
                fdata.append('userfile', $("#make_click")[0].files[0]);

                fdata.append('user_id', data);
                fdata.append('article_id', id);
                fdata.append('cmt', comment);
                fdata.append('parent', '0');
                fdata.append('ufile', userfile);
                fdata.append('fname', fname);
                fdata.append('ftypeunique', 'image_upload');
//  
                if (!comment) {
                    $("#addCommentBox" + id).focus();
                    $('html, body').animate({scrollTop: Number($("#addCommentBox" + id).offset().top) - 90}, "slow");
                } else {
                    $('.animation_image').show();
                    $.ajax({
                        type: "POST",
                        url: base_url + "public/news/addNewComment",
                        processData: false,
                        contentType: false,
                        data: fdata,
                        dataType: 'html',
                        success: function(data) {
                            $.ajax({
                                type: "POST",
                                url: base_url + "public/news/getCommentData",
                                data: {cmtDATAid: id},
                                success: function(html) {

                                    $("#cmt_" + id).html(html);
                                    $("#ct_" + id).html(html);
                                    $("#addCommentBox" + id).val('');
                                    $('.animation_image').hide();

                                    $('#make_click').val("");
                                    $('.added-image').html("");
                                    $('.textarea-box').removeClass('resize');
                                    $('.textarea-box').next().removeClass('display-post-comment');
                                    $('.textarea-box').next().next().removeClass('value-box-click');
//                                $('.input-text-comment').hide();
//                                var cmtposition = $("#comment_236").offset();
//                                console.log(Number(cmtposition["top"]));
//                                 $('html, body').animate({scrollTop: Number(cmtposition["top"]) + 150}, "slow");
                                }
                            });
                        }
                    });
                }
            }
        }


// $("#parentcmtrpl").focus();
// $('html, body').animate({scrollTop: Number($("#parentcmtrpl").offset().top) - 90}, "slow");

    });
});


/* comment */