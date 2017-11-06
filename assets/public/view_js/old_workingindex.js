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

function toggleSlides() {
    $('.toggler').click(function (e) {
        var id = $(this).attr('id');

        var widgetId = id.substring(id.indexOf('-') + 1, id.length);
        var widgetId1 = widgetId.slice(0, -1);
        //$("#loader").show();
        getcomment(widgetId1);

        alert("here");
        $('.parentcmtrpl').on('click', function (e) {

            alert("here11");
            var id = $(this).attr('id');
            var parentid = $(this).parent().attr('id');
            //alert(parentid);

            $("#fullReplyBox-" + parentid).show();

            $("#rplycmtbox-" + parentid).show();
            $("#addrplCommentBox" + parentid).val('');
            var username = $('.prtgetusername__' + parentid).text();
            $("#addrplCommentBox" + parentid).val('@' + username);
        });
        $('.childsubcmtrpl').on('click', function (e) {
            alert("inner click");
            var id = $(this).attr('id');
            var parentid = $(this).parent().attr('id');
            var parentclass = $(this).parent().attr('class');
            //alert(parentid);
            //$("#fullReplyBox-"+parentid).show();
            $("#rplycmtbox-" + parentid).show();
            $("#addrplCommentBox" + parentid).val('');
            var username = $('.getusername__' + parentclass).text();
            $("#addrplCommentBox" + parentid).val('@' + username);
        });

        $('.commentrplPostBtn').bind('click', function (e) {
            var id = $(this).attr('id');
            var parentid = $(this).parent().attr('id');

            alert(parentid);
            $.ajax({
                type: "POST",
                url: base_url + "user/checkUserLoginOrNot",
                dataType: 'html',
                success: function (data) {
                    if (data != "offline") {
                        addNewComment(data, parentid, widgetId1);

//                        $('.parentcmtrpl').bind('click', function (e) {
//
//                            //alert("here11");
//                            var id = $(this).attr('id');
//                            var parentid = $(this).parent().attr('id');
//                            //alert(parentid);
//
//                            $("#fullReplyBox-" + parentid).show();
//
//                            $("#rplycmtbox-" + parentid).show();
//                            $("#addrplCommentBox" + parentid).val('');
//                            var username = $('.prtgetusername__' + parentid).text();
//                            $("#addrplCommentBox" + parentid).val('@' + username);
//                        });
                        //$('.childsubcmtrpl').bind('click', function () {
                        $("#childsubcmtrpl_"+parentid).bind('click', function () {    
                            alert("reply clicked");
                            var parentid = $(this).parent().attr('id');

                            var parentclass = $(this).parent().attr('class');
                            //alert('i m clicked');
                            $("#rplycmtbox-" + parentid).show();
                            $("#addrplCommentBox" + parentid).val('');
                            var username = $('.getusername__' + parentid).text();
                            //alert(username);
                            $("#addrplCommentBox" + parentid).val('@' + username);
                            //alert(username);
                        });
                    } else {
                        var url = base_url + "user/login";
                        $(location).attr("href", url);
                    }
                }
            });
            //alert(parentid);
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
                    $.ajax({
                        type: "POST",
                        url: base_url + "user/addNewComment",
                        data: {cmtData: allData},
                        dataType: 'html',
                        success: function (data) {

                            //console.log(data);
                            $("#addrplCommentBox" + parentid).val('');
                            //getallcomment(leaguid,parentid);
                            $('#fullReplyBox-' + parentid).append(data);
                            $('#rplycmtbox-' + parentid).hide();
                        }
                    });
                }
            }
            $('.parentcmtrpl').bind('click', function (e) {
                //alert("here11232");
                var id = $(this).attr('id');
                var parentid = $(this).parent().attr('id');
                //alert(parentid);

                $("#fullReplyBox-" + parentid).show();

                $("#rplycmtbox-" + parentid).show();
                $("#addrplCommentBox" + parentid).val('');
                var username = $('.prtgetusername__' + parentid).text();
                $("#addrplCommentBox" + parentid).val('@' + username);
            });
        });
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
    function getcomment(id) {
        // alert(id);
        $.ajax({
            type: "POST",
            url: base_url + "home/getCommentData",
            data: {cmtDATAid: id},
            success: function (html) {
                //alert(html);
                $("#loader").html('');
                $("#cmt_" + id).html(html);
            }
        });
    }
}

$('.commentPostBtn').click(function (e) {
    var id = $(this).attr('id');
    //ajax call first check user is login or not
    $.ajax({
        type: "POST",
        url: base_url + "user/checkUserLoginOrNot",
        dataType: 'html',
        success: function (data) {
            if (data != "offline") {
                addNewComment(data, id);
            }
            else {
                var url = base_url + "user/login";
                $(location).attr("href", url);
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
            $.ajax({
                type: "POST",
                url: base_url + "user/addNewComment",
                data: {cmtData: allData},
                dataType: 'html',
                success: function (data) {
                    //alert(data);
                    getcomment(id);

                }
            });
        }

    }
    function getcomment(id) {
        $.ajax({
            type: "POST",
            url: base_url + "home/getCommentData",
            data: {cmtDATAid: id},
            success: function (html) {
                //alert(html);
                $("#cmt_" + id).html(html);
                $("#addCommentBox" + id).val('');

                //$(".mCustomScrollBox").animate({ scrollBottom: 1000 }, 200);
                //showcmt(data,id);
            }
        });
    }

//        $('.commentrplPostBtn').bind('click',function (e) {
//            var id = $(this).attr('id');
//            var parentid = $(this).parent().attr('id');
//            alert(parentid);
//        });
});

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

function delete_Comment(comment_id, key, user_id) {

    var ans = confirm("Do you want to delete?");
    if (ans == true) {
        $.ajax({
            type: "POST",
            url: base_url + "leaguelist/delete_comment",
            data: {comment_id: comment_id, u_id: user_id},
            cache: false,
            dataType: 'html',
            success: function (data) {
                //$("#comment_" + key).hide();
                if (key != "off")
                    $("#comment_" + key).remove();
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
        url: base_url + "home/like",
        dataType: 'JSON',
        data: {
            "user_id": user_id,
            "comment_id": comment_id
        },
        success: function (data, textStatus, jqXHR) {
            if (data != "false") {
//                alert(data.like);
//                alert('#countLike_' + comment_id);
                $('#like_' + comment_id).html(data.icon);
                $('#dislike_' + comment_id).html('<i class="fa fa-thumbs-o-down"></i>');
                $('#countLike_' + comment_id).text(data.like);
                $('#countDislike_' + comment_id).text(data.dislike);
            }
        }
    });
}

function dislike(user_id, comment_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "home/dislike",
        dataType: 'JSON',
        data: {
            "user_id": user_id,
            "comment_id": comment_id
        },
        success: function (data, textStatus, jqXHR) {
            if (data != "false") {
                $('#dislike_' + comment_id).html(data.icon);
                $('#like_' + comment_id).html('<i class="fa fa-thumbs-o-up"></i>');
                $('#countLike_' + comment_id).text(data.like);
                $('#countDislike_' + comment_id).text(data.dislike);
            }
        }
    });
}