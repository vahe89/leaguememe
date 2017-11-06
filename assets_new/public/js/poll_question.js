var widgetId1;
var limit = 1000;
$(document).ready(function () {
    widgetId1 = poll_id;
    $.ajax({
        type: "POST",
        url: base_url + "public/poll/getCommentData",
        data: {cmtDATAid: widgetId1},
        success: function (html) {

            $("#cmt_" + widgetId1).html(html);
            $("#addCommentBox" + widgetId1).val('');
            $('.animation_image').hide();
        }
    });
    $('#fresh1').click(function () {
        widgetId1 = poll_id;
        //        alert(widgetId1);
        $('.animation_image').show();
        $.ajax({
            type: "POST",
            url: base_url + "public/poll/getCommentFData",
            data: {cmtDATAid: widgetId1},
            success: function (html) {

                $("#ct_" + widgetId1).html(html);
                $("#addCommentBox" + widgetId1).val('');
                $('.animation_image').hide();
            }
        });

    });

    $('#addCommentBox' + widgetId1).keyup(function () {
        var text_length = $('#addCommentBox' + widgetId1).val().length;
 
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
});
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
    //$('.commentrplPostBtn').bind('click', function (e) {
    var id = $(this).attr('id');
    var parentid = $(this).parent().attr('id');
    var word = $("#inerwordcount" + parentid).text();
    if (word >= 0) {
        $("#inerwordcount" + parentid).html('<p id=inerwordcount' + parentid + '>1000</p>');

        $.ajax({
            type: "POST", url: base_url + "public/user/checkUserLoginOrNot",
            dataType: 'html',
            success: function (data) {
                if (data != "offline") {
                    addNewComment(data, parentid, widgetId1);
                } else {
                    var url = base_url + "public/user/login";
                    $(location).attr("href", url);
                }
            }
        });
        $("#fullReplyBox-" + parentid).show();
        function addNewComment(data, parentid, pollid) {
            var comment = $("#addrplCommentBox" + parentid).val();
            var allData = {
                user_id: data,
                pollid: pollid,
                cmt: comment,
                parent: parentid,
            };
            if (!comment) {
                $("#addrplCommentBox" + parentid).focus();
                $('html, body').animate({scrollTop: Number($("#addrplCommentBox" + parentid).offset().top) - 90}, "slow");
            } else {
                $('.animation_image').show();
                $.ajax({
                    type: "POST",
                    url: base_url + "public/poll/addNewComment",
                    data: {cmtData: allData},
                    dataType: 'html',
                    success: function (data) {
                        $("#addrplCommentBox" + parentid).val('');
                        $('#fullReplyBox-' + parentid).append(data);
                        $('#rplycmtbox-' + parentid).hide();
                        $('.animation_image').hide();
                    }
                });
            }
        }
    } else {
        $("#inerwordcountdiv" + parentid).fadeTo(100, 0.1).fadeTo(200, 1.0);
    }
});
$(document).on("click", "li.childsubcmtrpl", function () {
    var id = $(this).attr('id');
    var parentid = $(this).parent().attr('id');
    var parentclass = $(this).parent().parent().attr('class');
    $(this).toggleClass("trigger_active").next($('#childrplycmtbox-' + parentclass).slideToggle('slow'));
    $("#childaddrplCommentBox-" + parentid).val('');
    var username = $('.getusername__' + parentclass).text();

    $("#childaddrplCommentBox-" + parentclass).val('@' + username);
    $("#childaddrplCommentBox-" + parentclass).focus();
    $('html, body').animate({scrollTop: Number($("#childaddrplCommentBox-" + parentclass).offset().top) - 90}, "slow");
});
$(document).on("click", "button.childcommentrplPostBtn", function () {
    var id = $(this).attr('id');

    var parentid = $(this).parent().attr('id');

    var word = $("#childinerwordcountdiv" + parentid).text();
    if (word >= 0) {
        $("#childinerwordcountdiv" + parentid).html('<p id=childinerwordcountdiv' + parentid + '>1000</p>');

        $.ajax({
            type: "POST",
            url: base_url + "public/user/checkUserLoginOrNot",
            dataType: 'html',
            success: function (data) {
                if (data != "offline") {
                    addNewComment(data, parentid, widgetId1);
                } else {
                    var url = base_url + "public/user/login";
                    $(location).attr("href", url);
                }
            }
        });
        $("#fullReplyBox-" + parentid).show();
        function addNewComment(data, parentid, pollid) {
            var comment = $("#childaddrplCommentBox-" + id).val();
            var allData = {
                user_id: data,
                pollid: pollid,
                cmt: comment,
                parent: parentid,
            };
            if (!comment) {
                $("#childaddrplCommentBox-" + id).focus();
                $('html, body').animate({scrollTop: Number($("#childaddrplCommentBox-" + id).offset().top) - 90}, "slow");
            } else {
                $('.animation_image').show();
                $.ajax({
                    type: "POST",
                    url: base_url + "public/poll/addNewComment",
                    data: {cmtData: allData},
                    dataType: 'html',
                    success: function (data) {

                        $("#childaddrplCommentBox-" + parentid).val('');
                        $('#fullReplyBox-' + parentid).append(data);
                        $('#childaddrplCommentBox-' + id).hide();
                        $('#childinerwordcountdiv' + id).hide();
                        $('.childcommentrplPostBtn' + id).hide();
                        $('.animation_image').hide();
                    }
                });
            }
        }
    } else {
        $("#inerwordcountdiv" + parentid).fadeTo(100, 0.1).fadeTo(200, 1.0);
    }
});

$(document).on("keyup", "textarea.innercomboBox", function () {
    var id = $(this).parent().attr('id');

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
$('.commentPostBtn').click(function (e) {
    var id = $(this).attr('id');
    var word = $("#wordcount" + id).text();

    var inputtext = $("#addCommentBox" + id).val().length;
    if (word > 0 && inputtext > 0) {
        var totalcmt = Number($("#polltoggler-" + widgetId1 + "y span").text());
        var totalcmt1 = Number($("#polltoggler-" + widgetId1 + "yy ").text());
        totalcmt = totalcmt + 1;
        totalcmt1 = totalcmt1 + 1;
        $("#polltoggler-" + widgetId1 + "y span").text(totalcmt);
        $("#polltoggler-" + widgetId1 + "yy ").text(totalcmt1);
        $("#wordcount" + id).html('<p id=wordcount' + id + '>1000</p>');
        var id = $(this).attr('id');
        //ajax call first check user is login or not
        $.ajax({
            type: "POST",
            url: base_url + "public/user/checkUserLoginOrNot",
            dataType: 'html', success: function (data) {
                if (data != "offline") {
                    addNewComment(data, id);
                } else {
                    var url = base_url + "public/user/login"; //                    $(location).attr("href", url);
                }
            }
        });
        function addNewComment(data, id) {
            var comment = $("#addCommentBox" + id).val();
            var allData = {
                user_id: data,
                pollid: id,
                cmt: comment, parent: '0',
            };
            if (!comment) {
                $("#addCommentBox" + id).focus();
                $('html, body').animate({scrollTop: Number($("#addCommentBox" + id).offset().top) - 90}, "slow");
            } else {
                $('.animation_image').show();
                $.ajax({
                    type: "POST",
                    url: base_url + "public/poll/addNewComment",
                    data: {cmtData: allData},
                    dataType: 'html',
                    success: function (data) {
                        $.ajax({
                            type: "POST",
                            url: base_url + "public/poll/getCommentData",
                            data: {cmtDATAid: id},
                            success: function (html) {

                                $("#cmt_" + id).html(html);
                                $("#ct_" + id).html(html);
                                $("#addCommentBox" + id).val('');
                                $('.animation_image').hide();
                            }
                        });
                    }
                });
            }
        }
    }



});

function delete_Comment(comment_id, key, user_id) {

    var ans = confirm("Do you want to delete?");
    if (ans == true) {
        $.ajax({
            type: "POST",
            url: base_url + "public/poll/delete_pollComment",
            data: {comment_id: comment_id, u_id: user_id},
            cache: false,
            dataType: 'html',
            success: function (data) {
                //$("#comment_" + key).hide();
                if (key != "off") {
                    $("#comment_" + key).remove();
                    var totalcmt = Number($("#polltoggler-" + widgetId1 + "y span").text());
                    var totalcmt1 = Number($("#polltoggler-" + widgetId1 + "yy ").text());
                    totalcmt = totalcmt - 1;
                    totalcmt1 = totalcmt1 - 1;
                    $("#polltoggler-" + widgetId1 + "y span").text(totalcmt);
                    $("#polltoggler-" + widgetId1 + "yy ").text(totalcmt1);
                } else
                    $("#childid_" + comment_id).remove();
            }
        });
    }
}

function like(user_id, comment_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "public/poll/pollcommentlikedislike",
        dataType: 'JSON',
        data: {
            "user_id": user_id,
            "comment_id": comment_id,
            "status": "like",
        },
        success: function (data, textStatus, jqXHR) {
            if (data != "false") {


                $('#like_' + comment_id).html(data.icon);
                $('#dislike_' + comment_id).html('<img src=" ' + base_url + 'assets/public/img/down-reply.png" onmouseover="this.src =' + base_url + 'assets/public/img/down-reply-hover.png">');
                $('#countLike_' + comment_id).html(data.total);
                $('#countDislike_' + comment_id).html(data.total);
                //                var total_cmtpoint = parseInt($('#countLike_' + comment_id).text()) - 1;
                //                 $('#countLike_' + comment_id).text(total_cmtpoint);

            }
        }
    });
}
function dislike(user_id, comment_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "public/poll/pollcommentlikedislike",
        dataType: 'JSON',
        data: {
            "user_id": user_id,
            "comment_id": comment_id,
            "status": "dislike",
        },
        success: function (data, textStatus, jqXHR) {
            if (data != "false") {
                $('#dislike_' + comment_id).html(data.icon);
                $('#like_' + comment_id).html('<img src="' + base_url + 'assets/public/img/up-reply.png" onmouseover=\'this.src ="' + base_url + 'assets/public/img/up-reply-hover.png"\'>');
                $('#countLike_' + comment_id).html(data.total);
                $('#countDislike_' + comment_id).html(data.total);

            }
        }
    });
}
function pollvictory(str) {
    var id = str.split("_");
    var victory = id[1];
    $.ajax({
        type: "POST",
        url: base_url + "public/poll/poll_victory",
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
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle.png');
                var total_point = parseInt($('#point_' + victory).text()) - 1;
                $('#point_' + victory).text(total_point);
                $('#points_' + victory).text(total_point);

            } else if (data.status === "update") {
                $('#dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle-hover.png');
                var total_point = parseInt($('#point_' + victory).text()) + 2;
                $('#point_' + victory).text(total_point);
                $('#points_' + victory).text(total_point);


            } else if (data.status === "insert") {
                $('#dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle-hover.png');
                var total_point = parseInt($('#point_' + victory).text()) + 1;
                $('#point_' + victory).text(total_point);
                $('#points_' + victory).text(total_point);

            } else {
                location.reload();
            }
        }
    });
}
function polldefeat(str) {
    var id = str.split("_");
    var defeat = id[1];
    $.ajax({
        type: "POST",
        url: base_url + "public/poll/poll_defeat",
        data: {defeat: defeat},
        cache: false,
        dataType: 'JSON',
        success: function (data) {
            if (data.status == "false") {
                //                location.href = base_url + "user/login";
                //                  $('#login_modal').trigger('click');
                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle.png');
                var total_point = parseInt($('#point_' + defeat).text()) + 1;
                $('#point_' + defeat).text(total_point);
                $('#points_' + defeat).text(total_point);


            } else if (data.status === "update") {
                $('#like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle-hover.png');
                var total_point = parseInt($('#point_' + defeat).text()) - 2;
                $('#point_' + defeat).text(total_point);
                $('#points_' + defeat).text(total_point);


            } else if (data.status === "insert") {
                $('#like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle-hover.png');
                var total_point = parseInt($('#point_' + defeat).text()) - 1;
                $('#point_' + defeat).text(total_point);
                $('#points_' + defeat).text(total_point);

            } else {
                location.reload();
            }
        }
    });
}


$(document).on('click', '#givevote', function () {
    var answer = $('.answerlist:checked').val();
    $.ajax({
        type: 'POST',
        url: base_url + 'public/poll/vote_result',
        data: {answer: answer, poll_id: poll_id},
        dataType: 'json',
        beforeSend: function (xhr) {
        },
        success: function (data) {
            if (data.status == "false") {
                alert("please select any one answer");
            } else {
                window.location.href = base_url + 'result-voting/' + data.poll_id
            }
        }
    });
});

$(document).on('click', '#results', function () {
    var answer = $('.answerlist:checked').val();
    $.ajax({
        type: 'POST',
        url: base_url + 'public/poll/vote_result',
        data: {answer: answer, poll_id: poll_id},
        dataType: 'json',
        success: function (data) {
            window.location.href = base_url + 'result-voting/' + poll_id;
        }
    });
});
$(document).on('click', '#backtoPoll', function () {
    window.location.href = base_url ;
});