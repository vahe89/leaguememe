
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
                // alert(result);
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
    // alert("click4");
    $('#popup').hide();
    $('.popup_outer').css('display', 'none');
});
 var limit = 1000;
var text_remaining;
var inertext_remaining;
var widgetId;
var widgetId1;
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
//function add_comment(league_id) {
//    alert("hi");
//    var comments = $("[name=comments" + league_id + "]").val();
//    $.ajax({
//        type: "POST",
//        url: base_url + "public/leaguelist/add_comment",
//        data: {league_img_id: league_id, comment: comments},
//        cache: false,
//        dataType: 'html',
//        success: function (data) {
//            location.reload();
//        }
//    });
//}
function delete_Comment(comment_id, key, user_id) {

    var ans = confirm("Do you want to delete?");
    if (ans == true) {
        $.ajax({
            type: "POST",
            url: base_url + "public/leaguelist/delete_comment",
            data: {comment_id: comment_id, u_id: user_id},
            cache: false,
            dataType: 'html',
            success: function (data) {
                //$("#comment_" + key).hide();
                if (key != "off"){
                    $("#comment_" + key).remove();
                    var totalcmt = Number($("#toggler-"+widgetId1+"y span").text());
                    var totalcmt1 = Number($("#toggler-"+widgetId1+"yy span").text());
                    totalcmt = totalcmt - 1;
                      totalcmt1 = totalcmt1 - 1;
                    $("#toggler-"+widgetId1+"y span").text(totalcmt);
                    $("#toggler-"+widgetId1+"yy span").text(totalcmt1);
                }
                else
                    $("#childid_" + comment_id).remove();
            }
        });
    }
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
function like(user_id, comment_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "public/home/likedislike",
        dataType: 'JSON',
        data: {
            "user_id": user_id,
            "comment_id": comment_id,
            "status": "like",
        },
        success: function (data, textStatus, jqXHR) {
            if (data != "false") {


                $('#like_' + comment_id).html(data.icon);
                $('#dislike_' + comment_id).html('<i class="fa fa-arrow-down fa-lg"></i>');
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
        url: base_url + "public/home/likedislike",
        dataType: 'JSON',
        data: {
            "user_id": user_id,
            "comment_id": comment_id,
            "status": "dislike",
        },
        success: function (data, textStatus, jqXHR) {
            if (data != "false") {
                $('#dislike_' + comment_id).html(data.icon);
                $('#like_' + comment_id).html('<i class="fa fa-arrow-up fa-lg"></i>');
                $('#countLike_' + comment_id).html(data.total);
                $('#countDislike_' + comment_id).html(data.total);
                
            }
        }
    });
}

 
 
$(document).ready(function () {
    //alert("dfd");

    $("#toggler").click(function () {
        //alert("click1");
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
        // alert("click2");
        $('.btn-group a').removeClass('active');
        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
    });
    $(".m_r").click(function () {
        // alert("click3");
        $(".txt").fadeOut(500);
    });

});
$(document).ready(function () {
     var id = $(this).attr('id');
   
    widgetId1 = league_single_id;
//    alert("widgetId1="+widgetId1);
    $('.animation_image').show();
    $.ajax({
        type: "POST",
        url: base_url + "public/home/getCommentData",
        data: {cmtDATAid: widgetId1},
        success: function (html) {
             
            $("#cmt_" + widgetId1).html(html);
            $("#addCommentBox" + widgetId1).val('');
            $('.animation_image').hide();
        }
    });
        $('#addCommentBox' + widgetId1).keyup(function () {
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
    $('#fresh1').click(function(){
         widgetId1 = league_single_id;
//        alert(widgetId1);
        $('.animation_image').show();
        $.ajax({
        type: "POST",
        url: base_url + "public/home/getCommentFData",
        data: {cmtDATAid: widgetId1},
        success: function (html) {
             
            $("#ct_" + widgetId1).html(html);
            $("#addCommentBox" + widgetId1).val('');
            $('.animation_image').hide();
        }
    });
    
    });
    $(".defeat1").click(function () {
        var defeat = $(this).attr('rel');
        $.ajax({
            type: "POST",
            url: base_url + "public/leaguelist/league_defeat",
            data: {defeat: defeat},
            cache: false,
            dataType: 'html',
            success: function (data) {
                if (data == "false") {
                    location.href = base_url + "public/user/login";
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


    $(document).on("click", "li.parentcmtrpl", function () {
        var id = $(this).attr('id');
        var parentid = $(this).parent().attr('id');
        $("#fullReplyBox-" + parentid).show();
        $("#rplycmtbox-" + parentid).show();
        $("#addrplCommentBox" + parentid).val('');
        var username = $('.prtgetusername__' + parentid).text();
        $("#addrplCommentBox" + parentid).val('@' + username);

        $("#addrplCommentBox"+parentid).focus();
        $('html, body').animate({scrollTop: Number($("#addrplCommentBox"+parentid).offset().top) - 90}, "slow");
    });

    $(document).on("click", "li.childsubcmtrpl", function () {

        var id = $(this).attr('id');
        var parentid = $(this).closest('div').attr('id');
        //alert(parentid);
        var parentclass =$(this).closest('div').attr('class');
        $("#rplycmtbox-" + parentid).show();
        $("#addrplCommentBox" + parentid).val('');
        var username = $('.getusername__' + parentclass).text();
        $("#addrplCommentBox" + parentid).val('@' + username);

        $("#addrplCommentBox"+parentid).focus();
        $('html, body').animate({scrollTop: Number($("#addrplCommentBox"+parentid).offset().top) - 90}, "slow");
    });

    $(document).on("click", "button.commentrplPostBtn", function () {
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
            function addNewComment(data, parentid, leaguid) {
                var comment = $("#addrplCommentBox" + parentid).val();
                var allData = {
                    user_id: data,
                    leaguid: leaguid,
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
                        url: base_url + "public/user/addNewComment",
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
    $('.closeSlider').click(function () {
        $(this).parent().hide('slow');
        var relatedToggler = 'toggler-' + $(this).parent().attr('id');
        $('#' + relatedToggler).removeClass('sliderExpanded');
    });
});
$(document).on("keyup", "textarea.innercomboBox", function () {
            var id = $(this).parent().attr('id');
            //var replyboxid = id.substring(id.indexOf('-') + 1, id.length);
            var text_length = $(this).val().length;
            inertext_remaining = limit - text_length;
            if (inertext_remaining == 1000) {
                $("#inerwordcountdiv"+id).html('<p id=inerwordcount'+id +'>1000</p>');
            } else {
                if (inertext_remaining >= 0)
                    $("#inerwordcountdiv"+id).html('<p id=inerwordcount'+id + '>' + inertext_remaining + '</p>');
                else if (inertext_remaining < 0) {
                    $("#inerwordcountdiv"+id).html('<p id=inerwordcount'+id+ '><font color=red><b>' + inertext_remaining + '</b></font></p>');
                }
            }
        });
//$('.toggler').click(function (e) {
//    var id = $(this).attr('id');
//    //widgetId = id.substring(id.indexOf('-') + 1, id.length);
//    //widgetId1 = widgetId.slice(0, -1);
//    widgetId1 = league_single_id;
//    alert("widgetId1="+widgetId1);
//    
//    //var newwidgetId = widgetId.slice(0, -1);
//    //$('#' + widgetId).slideToggle();
//    //$(this).toggleClass('sliderExpanded');
//    $.ajax({
//        type: "POST",
//        url: base_url + "home/getCommentData",
//        data: {cmtDATAid: widgetId1},
//        success: function (html) {
//            $("#cmt_" + widgetId1).html(html);
//            $("#addCommentBox" + widgetId1).val('');
//            
//        }
//    });
//    $('#addCommentBox' + newwidgetId).keyup(function () {
//        var text_length = $('#addCommentBox' + newwidgetId).val().length;
//        text_remaining = limit - text_length;
//        if (text_remaining == 1000) {
//            $("#wordcount" + newwidgetId).html('<p id=wordcount' + newwidgetId + '>1000</p>');
//        } else {
//            if (text_remaining >= 0)
//                $("#wordcount" + newwidgetId).html('<p id=wordcount' + newwidgetId + '>' + text_remaining + '</p>');
//            else if (text_remaining < 0) {
//
//                $("#wordcount" + newwidgetId).html('<p id=wordcount' + newwidgetId + '><font color=red>' + text_remaining + '</font></p>');
//            }
//        }
//    });
//    if ($('#cmnt_count_' + id).val() == 0) {
//        $('.content').css("height", "1");
//    } else {
//        $('.content').css("height", "220");
//    }
//});
$('.commentPostBtn').click(function (e) {
    
    var id = $(this).attr('id'); 
    
    var word = $("#wordcount" + id).text(); 
    if (word >= 0) {
        var totalcmt = Number($("#toggler-"+widgetId1+"y span").text());
        var totalcmt1 = Number($("#toggler-"+widgetId1+"yy span").text());
        totalcmt = totalcmt + 1;
        totalcmt1 = totalcmt1 + 1;
        $("#toggler-"+widgetId1+"y span").text(totalcmt);
        $("#toggler-"+widgetId1+"yy span").text(totalcmt1);
        $("#wordcount" + id).html('<p id=wordcount' + id + '>1000</p>');
        var id = $(this).attr('id');
        //ajax call first check user is login or not
        $.ajax({
            type: "POST",
            url: base_url + "public/user/checkUserLoginOrNot",
            dataType: 'html',
            success: function (data) {
                if (data != "offline") {
                    addNewComment(data, id);
                }
                else {
                    var url = base_url + "public/user/login";
//                    $(location).attr("href", url);
                }
            }
        });
        function addNewComment(data, id) {

            var comment = $("#addCommentBox" + id).val();
            var allData = {
                user_id: data,
                leaguid: id,
                cmt: comment,
                parent: '0',
            };
            if (!comment) {
                $("#addCommentBox" + id).focus();
                $('html, body').animate({scrollTop: Number($("#addCommentBox" + id).offset().top) - 90}, "slow");
            }
            else {
                $('.animation_image').show(); 
                $.ajax({
                    type: "POST",
                    url: base_url + "public/user/addNewComment",
                    data: {cmtData: allData},
                    dataType: 'html',
                    success: function (data) {
                        $.ajax({
                            type: "POST",
                            url: base_url + "public/home/getCommentData",
                            data: {cmtDATAid: id},
                            success: function (html) {
                               
                                $("#cmt_" + id).html(html);
                                $("#ct_" + id).html(html);
                                $("#addCommentBox" + id).val('');
                               $('.animation_image').hide(); 
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
