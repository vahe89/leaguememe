
function loadMoreReply(parent_id) {

    $.ajax({
        type: "POST",
        url: base_url + "public/animelist/getsubcomment_ajax",
        data: {pid: parent_id},
        success: function (result) {
            $("#more_comment_div_" + parent_id).html(result);
            $(".loadmore_" + parent_id).css("display", "none");
        }
    });
}
function like(user_id, comment_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "public/animelist/discussionCommentLikedislike",
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


            }
        }
    });
}
function delete_Comment(comment_id, key, user_id) {

    var widgetId1 = discussion_id;
    var ans = confirm("Do you want to delete?");
    if (ans == true) {
        $.ajax({
            type: "POST",
            url: base_url + "public/animelist/delete_discusion_comment",
            data: {comment_id: comment_id, u_id: user_id},
            cache: false,
            dataType: 'html',
            success: function (data) {
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
function dislike(user_id, comment_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "public/animelist/discussionCommentLikedislike",
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
function ondiscussionvictory(str) {
    var id = str.split("_");
    var victory = id[1];
    $.ajax({
        type: "POST",
        url: base_url + "public/animelist/anime_victory",
        data: {victory: victory},
        cache: false,
        dataType: 'JSON',
        success: function (data) {

            if (data.status === "false") {

                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#res-dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#res-like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle.png');
                var total_point = parseInt($('#point_' + victory).text()) - 1;
                $('#point_' + victory).text(total_point);
                $('#points_' + victory).text(total_point);
                $('#respoints_' + victory).text(total_point);
            } else if (data.status === "update") {
                $('#dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle-hover.png');
                $('#res-dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#res-like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle-hover.png');
                var total_point = parseInt($('#point_' + victory).text()) + 2;
                $('#point_' + victory).text(total_point);
                $('#points_' + victory).text(total_point);
                $('#respoints_' + victory).text(total_point);

            } else if (data.status === "insert") {
                $('#dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle-hover.png');
                $('#res-dislike_' + victory).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#res-like_' + victory).attr('src', base_url + 'assets/public/img/up-triangle-hover.png');
                var total_point = parseInt($('#point_' + victory).text()) + 1;
                $('#point_' + victory).text(total_point);
                $('#points_' + victory).text(total_point);
                $('#respoints_' + victory).text(total_point);
            } else {
                location.reload();
            }
        }
    });
}
function ondiscussiondefeat(str) {
    var id = str.split("_");
    var defeat = id[1];
    $.ajax({
        type: "POST",
        url: base_url + "public/animelist/anime_defeat",
        data: {defeat: defeat},
        cache: false,
        dataType: 'JSON',
        success: function (data) {
            if (data.status == "false") {

                var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                $('#body_id').append(html);
                $('#login').addClass('in');
                $('#login').show();
            } else if (data.status === "delete") {
                $('#like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle.png');
                $('#res-like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#res-dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle.png');
                var total_point = parseInt($('#point_' + defeat).text()) + 1;
                $('#point_' + defeat).text(total_point);
                $('#points_' + defeat).text(total_point);
                $('#respoints_' + defeat).text(total_point);

            } else if (data.status === "update") {
                $('#like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle-hover.png');
                $('#res-like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#res-dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle-hover.png');
                var total_point = parseInt($('#point_' + defeat).text()) - 2;
                $('#point_' + defeat).text(total_point);
                $('#points_' + defeat).text(total_point);
                $('#respoints_' + defeat).text(total_point);

            } else if (data.status === "insert") {
                $('#like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle-hover.png');
                $('#res-like_' + defeat).attr('src', base_url + 'assets/public/img/up-triangle.png');
                $('#res-dislike_' + defeat).attr('src', base_url + 'assets/public/img/down-triangle-hover.png');
                var total_point = parseInt($('#point_' + defeat).text()) - 1;
                $('#point_' + defeat).text(total_point);
                $('#points_' + defeat).text(total_point);
                $('#respoints_' + defeat).text(total_point);
            } else {
                location.reload();
            }
        }
    });
}
$(document).ready(function () {
    var widgetId1 = discussion_id;

    var limit = 1000;
    var text_remaining;
    var inertext_remaining;

    var widgetId1;
    $('.animation_image').show();
    $.ajax({
        type: "POST",
        url: base_url + "public/animelist/getCommentData",
        data: {cmtDATAid: widgetId1},
        success: function (html) {

            $("#discmt_" + widgetId1).html(html);
            $("#disaddCommentBox" + widgetId1).val('');
            $('.animation_image').hide();
        }
    });
    tinymce.init({
        selector: '#desc-textarea',
        elementpath: false,
        statusbar: false,
        plugins: [
          "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
          //"table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],
        toolbar: 'bold italic underline forecolor backcolor | link blockquote alignleft aligncenter alignright | formatselect table',
        menubar: false,
        paste_data_images: true,
        content_css: 'assets/css/tinymce.css'
        [
          '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700',
          'assets/css/tinymce.css'
        ]
    });
    $(".btn-delete-detail").click(function(){
        if(confirm("Are you sure want to delete the discussion ?")){
            $.ajax({
                type: "POST",
                url: base_url + "public/animelist/deletedescussion",
                data: {
                    id : discussion_id
                },
                type: 'POST',
                dataType: 'JSON',
                success: function (html) {
                    window.location = base_url+"anime-album"
                }
            });
        }
    })
    $(".btn-save-detail").click(function(){
        $("#form-edit-discussion").submit();
    })
    $("#form-edit-discussion").submit(function(e){
        $("#desc-original").html(tinymce.get('desc-textarea').getContent());
        $(".btn-save-detail").hide();
        $(".btn-edit-detail").show();
        $("#edit-desc").toggle();
        $("#desc-original").toggle();
        $.ajax({
            url: base_url +"public/animelist/update_disc_desc",
            data: {
                desc : tinymce.activeEditor.getContent(),
                id : discussion_id
            },
            dataType: 'JSON',
            type: 'POST',
            beforeSend: function(xhr) {
                $(".btn-edit-detail").text("Please wait..");
            },
            success: function(data, textStatus, jqXHR) {
                if(data == 1){
                    $(".btn-edit-detail").text("Edit");
                }
                else{
                    $(".btn-edit-detail").text("Error");
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                
            }
                    
        })
        e.preventDefault();
    })
    $(".btn-edit-detail").click(function(){
        $(this).hide();
        $("#edit-desc").toggle();
        $("#desc-original").toggle();
        $(".btn-save-detail").show();
        
    });
    $(document).on("click","span.disc-credit-show",function(e){
        if($(this).text() == "Credit"){
            $(this).text($(this).data("credit"));
            $(this).next( "a" ).show();
        }
        else{
            $(this).text("Credit");
            $(this).next( "a" ).hide();
        }
    })
    $('#disaddCommentBox' + widgetId1).keyup(function () {
        var text_length = $('#disaddCommentBox' + widgetId1).val().length;

        text_remaining = limit - text_length;
        if (text_remaining == 1000) {
            $("#diswordcount" + widgetId1).html('<p id=wordcount' + widgetId1 + '>1000</p>');
        } else {
            if (text_remaining >= 0)
                $("#diswordcount" + widgetId1).html('<p id=wordcount' + widgetId1 + '>' + text_remaining + '</p>');
            else if (text_remaining < 0) {

                $("#diswordcount" + widgetId1).html('<p id=wordcount' + widgetId1 + '><font color=red>' + text_remaining + '</font></p>');
            }
        }
    });
    $('#fresh1').click(function () {
        widgetId1 = discussion_id;

        $('.animation_image').show();
        $.ajax({
            type: "POST",
            url: base_url + "public/animelist/getCommentFData",
            data: {cmtDATAid: widgetId1},
            success: function (html) {

                $("#disct_" + widgetId1).html(html);
                $("#disaddCommentBox" + widgetId1).val('');
                $('.animation_image').hide();
            }
        });

    });
    $('#login_close').click(function () {

        $('#login').removeClass('in');
        $('#login').hide();
        $('#modal_backdrop').remove();
    });
    $('.discommentPostBtn').click(function (e) {

        var id = $(this).attr('id');
        var word = $("#diswordcount" + id).text();
        var inputtext = $("#disaddCommentBox" + id).val().length;
        if (word > 0 && inputtext > 0) {
            var totalcmt = Number($("#distoggler-" + widgetId1 + "y").text());
            var totalcmt1 = Number($("#distoggler-" + widgetId1 + "yy").text());
            totalcmt = totalcmt + 1;
            totalcmt1 = totalcmt1 + 1;
            $("#distoggler-" + widgetId1 + "y").text(totalcmt);
            $("#distoggler-" + widgetId1 + "yy").text(totalcmt1);
            $("#diswordcount" + id).html('<p id=diswordcount' + id + '>1000</p>');
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
                    }
                }
            });
            function addNewComment(data, id) {

                var comment = $("#disaddCommentBox" + id).val();
                var userfile = $("#discussion_click").val();
                var fname = $("#discussion_click").attr('name');

//                var allData = {
//                    user_id: data,
//                    discuusion_id: id,
//                    cmt: comment,
//                    parent: '0',
//                };

                var fdata = new FormData();
                fdata.append('userfile', $("#discussion_click")[0].files[0]);

                fdata.append('user_id', data);
                fdata.append('discuusion_id', id);
                fdata.append('cmt', comment);
                fdata.append('parent', '0');
                fdata.append('ufile', userfile);
                fdata.append('fname', fname);
                fdata.append('animeuniqueType', 'anime_image_upload');


                if (!comment) {
                    $("#disaddCommentBox" + id).focus();
                    $('html, body').animate({scrollTop: Number($("#disaddCommentBox" + id).offset().top) - 90}, "slow");
                } else {
                    $('.animation_image').show();
                    $.ajax({
                        type: "POST",
                        url: base_url + "public/animelist/addNewComment",
//                        data: {cmtData: allData},
//                        dataType: 'html',
                        processData: false,
                        contentType: false,
                        data: fdata,
                        dataType: 'html',
                        success: function (data) {
                            $.ajax({
                                type: "POST",
                                url: base_url + "public/animelist/getCommentData",
                                data: {cmtDATAid: id},
                                success: function (html) {

                                    $("#discmt_" + id).html(html);
                                    $("#disct_" + id).html(html);
                                    $("#disaddCommentBox" + id).val('');
                                    $('.animation_image').hide();

                                    $('#make_click').val("");
                                    $('.added-image').html("");
                                    $('.textarea-box').removeClass('resize');
                                    $('.textarea-box').next().removeClass('display-post-comment');
                                    $('.textarea-box').next().next().removeClass('value-box-click');

//                                 $('html, body').animate({scrollTop: Number(cmtposition["top"]) + 150}, "slow");
                                }
                            });
                        }
                    });
                }
            }
        }



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
                    discuusion_id: leaguid,
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
                        url: base_url + "public/animelist/addNewComment",
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
        }
        else {
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
            function addNewComment(data, parentid, leaguid) {
                var comment = $("#childaddrplCommentBox-" + id).val();
                var allData = {
                    user_id: data,
                    discuusion_id: leaguid,
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
                        url: base_url + "public/animelist/addNewComment",
                        data: {cmtData: allData},
                        dataType: 'html',
                        success: function (data) {

                            $("#childaddrplCommentBox-" + parentid).val('');
                            $('#fullReplyBox-' + parentid).append(data);
                            $('#childaddrplCommentBox-' + id).hide();
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
});

/* comment */