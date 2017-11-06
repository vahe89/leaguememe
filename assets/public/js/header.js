$(document).ready(function() {
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#uploadform");
    myDropzone.on("addedfile", function(file) {

        var formData = new FormData();
        formData.append('file', file);
        $("#alert").hide();
        $("#img_name").val('');
        $("#video_name").val('');
        $("#tag").val('');
        $("#upload_title").val('');
        $("#author").val('');
        $("#check1").attr('checked', false);
        $("#credit_author").attr('checked', false);
        $(document).ajaxStart(function() {
            $("#wait").css("display", "block");
        });
        $(document).ajaxComplete(function() {
            $("#wait").css("display", "none");
        });
        $("button").click(function() {
            $("#txt").load("demo_ajax_load.asp");
        });
        $.ajax({
            url: base_url + "public/home/upload/",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function(msg) {
                if (msg.result == "success") {
                    $("#alert").hide();
                    $("#wait").hide();
                    $("#txt").hide();
                    $("#img").attr('src', base_url + 'uploads/dump/' + msg.name);
                    $("#img_name").val(msg.name);
                    $("#video_name").val(msg.videoname);
                    $("#modal_upload").hide();
                    $('.img-upload').show();
                    $.ajax({
                        type: "POST",
                        url: base_url + 'public/home/get_image_upload_category',
                        data: {
                            type: 'image'
                        },
                        success: function(msg) {
                            $('#category_list').html(msg);
                        }
                    });
                } else if (msg.result == "error") {
                    $("#upload_alert").show();
                    $("#upload_alert").html('<strong>' + msg.msg + '</strong>');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        this.removeFile(file);
    });

    // img  

    $('#upload_title').keyup(function() {
        var limit = 150;
        var text_remaining;
        var text_length = $('#upload_title').val().length;
        text_remaining = limit - text_length;
        if (text_remaining == 150) {
            $("#anime_count").html('150');
        } else {
            if (text_remaining >= 0)
                $("#anime_count").html(text_remaining);
            else if (text_remaining < 0) {

                $("#anime_count").html(text_remaining);
                $("#anime_count").css('color', 'red');
            }
        }
    });

    // album  

    $('#main_title').keyup(function(event) {
        var alubmlimit = 150;
        var albumtext_remaining;
        var max = 150;
        var alubmlimit = 150;
        var albumtext_remaining;
        var max = 150;
        var text_length = $('#main_title').val().length;
        albumtext_remaining = alubmlimit - text_length;
        if ($('#main_title').val().length == max) {
            event.preventDefault();
        } else if ($('#main_title').val().length > max) {
            // Maximum exceeded
            this.value = this.value.substring(0, max);
        }
        if (albumtext_remaining == 150) {
            $("#albumanime_count").html('150');
        } else {
            if (albumtext_remaining >= 0)
                $("#albumanime_count").html(albumtext_remaining);
            else if (albumtext_remaining === 0) {
                $("#albumanime_count").html(albumtext_remaining);
                $("#albumanime_count").css('color', 'red');
            }
        }
    });


    $(document).on('keyup', '.title_count', function() {
        var limit = 150;
        var text_remaining;
        var str = $(this).attr('id');
        var idd = str.split("_");
        var id = idd[1];
        var text_length = document.getElementById('titl_' + id).value.length;
        text_remaining = limit - text_length;
        if (text_remaining == limit) {
            document.getElementById('tit' + id).innerHTML = limit;
        } else {
            if (text_remaining >= 0) {
                document.getElementById('tit' + id).innerHTML = text_remaining;
            } else if (text_remaining < 0) {
                document.getElementById('tit' + id).innerHTML = text_remaining;
                document.getElementById('tit' + id).style.color = "red";
            }
        }

    });

    $(document).on('keyup', '.desc_count', function() {
        var limit = 250;
        var text_remaining;
        var str = $(this).attr('id');
        var idd = str.split("**");
        var id = idd[1];

        var text_length = document.getElementById('desr**' + id).value.length;
        text_remaining = limit - text_length;
        if (text_remaining == limit) {
            document.getElementById('dese' + id).innerHTML = limit;
        } else {
            if (text_remaining >= 0) {
                document.getElementById('dese' + id).innerHTML = text_remaining;
            } else if (text_remaining < 0) {

                document.getElementById('dese' + id).innerHTML = text_remaining;
            }
        }

    });

    // rating  
    var limit = 250;
    var limitdsc = 350;
    var lim = 150;
    var text_remaining;
    $(document).on('keyup', '#title', function() {


        var text_length = document.getElementById('title').value.length;
        text_remaining = lim - text_length;
        if (text_remaining == 150) {
            document.getElementById('title_count').innerHTML = '<span >150</span>';
        } else {
            if (text_remaining >= 0) {
                document.getElementById('title_count').innerHTML = '<span>' + text_remaining + '</span>';
            } else if (text_remaining < 0) {

                document.getElementById('title_count').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
            }
        }

    });

    $(document).on('keyup', '#discription', function() {


        var text_length = document.getElementById('discription').value.length;
        text_remaining = limitdsc - text_length;
        if (text_remaining == 350) {
            document.getElementById('discription_count').innerHTML = '<span >350</span>';
        } else {
            if (text_remaining >= 0) {
                document.getElementById('discription_count').innerHTML = '<span>' + text_remaining + '</span>';
            } else if (text_remaining < 0) {

                document.getElementById('discription_count').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
            }
        }

    });
    $(document).on('keyup', '#question', function() {

        var text_length = document.getElementById('question').value.length;
        text_remaining = lim - text_length;
        if (text_remaining == 150) {
            document.getElementById('question_count').innerHTML = '<span>150</span>';
        } else {
            if (text_remaining >= 0) {
                document.getElementById('question_count').innerHTML = '<span>' + text_remaining + '</span>';
            } else if (text_remaining < 0) {

                document.getElementById('question_count').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
            }
        }

    });


    $(document).on('keyup', '.option', function() {
        var text_length = $(this).val().length;
        text_remaining = lim - text_length;
        if (text_remaining == 150) {
            $(this).parent().find('.option_count').html('<span >150</span>');
        } else {
            if (text_remaining >= 0) {
                $(this).parent().find('.option_count').html('<span>' + text_remaining + '</span>');
            } else if (text_remaining < 0) {
                $(this).parent().find('.option_count').html('<span><font color=red>' + text_remaining + '</font></span>');
            }
        }

    });


    var limit = 150;
    var limitdsc = 250;
    var text_remaining;
    $(document).on('keyup', '#discussion_count', function() {


        var text_length = document.getElementById('discussion_count').value.length;
        text_remaining = limit - text_length;
        if (text_remaining == 150) {
            document.getElementById('di_count_span').innerHTML = 150;
        } else {
            if (text_remaining >= 0) {
                document.getElementById('di_count_span').innerHTML = text_remaining;
            } else if (text_remaining < 0) {

                document.getElementById('di_count_span').innerHTML = text_remaining;
                document.getElementById('di_count_span').style.color = "red";
            }
        }

    });


    $(document).on('keyup', '#discussion_count1', function() {


        var text_length = document.getElementById('discussion_count1').value.length;
        text_remaining = limit - text_length;
        if (text_remaining == 150) {
            document.getElementById('di_count_span1').innerHTML = '<span >150</span>';
        } else {
            if (text_remaining >= 0) {
                document.getElementById('di_count_span1').innerHTML = '<span>' + text_remaining + '</span>';
            } else if (text_remaining < 0) {

                document.getElementById('di_count_span1').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
            }
        }

    });



    $('#credit_author').change(function() {
        if ($(this).is(':checked')) {
            $(".author").show();
        } else {
            $(".author").hide();
        }
    });
    $(".dz-details").hide();
    $('#image_upload').hide();
    $('#pick_load').hide();
    var flag = 0;

    var myDropzone = new Dropzone("#uploadformdiscussion");
    myDropzone.on("addedfile", function(file) {

        var formData = new FormData();
        formData.append('file', file);
        $.ajax({
            url: base_url + "public/home/discussupload/",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            beforeSend: function() {
                $("#waitdiscussion").show();
            },
            success: function(msg) {
                if (msg.result == "success") {
                    $("#waitdiscussion").hide();
                    $('#discussion_file').val(msg.discussion)
                    $("#modal_upload").hide();
                    $(".discuss-upload").show();
                    $.ajax({
                        type: "POST",
                        url: base_url + 'public/home/get_image_upload_category',
                        data: {
                            type: 'discussion'
                        },
                        success: function(msg) {
                            $('#discuusioncategory_list').html(msg);
                        }
                    });
                } else if (msg.result == "error") {
                    $("#waitdiscussion").hide();
                    $("#discussupload_alert").show();
                    $("#discussupload_alert").html('<strong>' + msg.msg + '</strong>');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        this.removeFile(file);
    });

    var myDropzone_tread = new Dropzone("#uploadformdiscussion1");
    myDropzone_tread.on("addedfile", function(file) {

        var formData = new FormData();
        formData.append('file', file);
        $.ajax({
            url: base_url + "public/home/discussupload/",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            beforeSend: function() {
                $("#waitdiscussion1").show();
            },
            success: function(msg) {
                if (msg.result == "success") {
                    $("#waitdiscussion1").hide();
                    $('#discussion_file1').val(msg.discussion)
                    $("#modal_upload").hide();
                    $(".discuss-upload1").show();
                    var header = $('#header_name').val();
                    var anime_name = $('#anime_name_details').val();
                    //  $("#discussion_count1").val(' ');
                    //   $("#discussion_count_desc1").val(' ');
                    $('#myModalLabel1').html(anime_name + ' > ' + header);
                } else if (msg.result == "error") {
                    $("#waitdiscussion1").hide();
                    $("#discussupload_alert1").show();
                    $("#discussupload_alert1").html('<strong>' + msg.msg + '</strong>');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        this.removeFile(file);
    });
    $("#image_close").click(function() {
        $('#image_url_close').trigger('click');
    });
    $("#regi_model").click(function() {
        // alert("hi");
        $('#login_close_btn').trigger('click');
    });
    $("#urlmodal1").click(function() {
        // alert("hi");
        $('#url_close').trigger('click');
    });
    $("#upmodal").click(function() {
        $('#clsurl').trigger('click');
    });



    $(document).on('keyup', '#discription', function() {


        var text_length = document.getElementById('discription').value.length;
        text_remaining = limitdsc - text_length;
        if (text_remaining == 350) {
            document.getElementById('discription_count').innerHTML = '<span >350</span>';
        } else {
            if (text_remaining >= 0) {
                document.getElementById('discription_count').innerHTML = '<span>' + text_remaining + '</span>';
            } else if (text_remaining < 0) {

                document.getElementById('discription_count').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
            }
        }

    });
    $(document).on('keyup', '#question', function() {

        var text_length = document.getElementById('question').value.length;
        text_remaining = lim - text_length;
        if (text_remaining == 150) {
            document.getElementById('question_count').innerHTML = '<span>150</span>';
        } else {
            if (text_remaining >= 0) {
                document.getElementById('question_count').innerHTML = '<span>' + text_remaining + '</span>';
            } else if (text_remaining < 0) {

                document.getElementById('question_count').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
            }
        }

    });

    $(document).on('keyup', '.option', function() {
        var text_length = $(this).val().length;
        text_remaining = lim - text_length;
        if (text_remaining == 150) {
            $(this).parent().find('.option_count').html('<span >150</span>');
        } else {
            if (text_remaining >= 0) {
                $(this).parent().find('.option_count').html('<span>' + text_remaining + '</span>');
            } else if (text_remaining < 0) {
                $(this).parent().find('.option_count').html('<span><font color=red>' + text_remaining + '</font></span>');
            }
        }

    });




});

// single img upload 
function next_page() {

    var wordd = $("#anime_count").text();
    var category = $(".pic_category:checked").val();
    var anime_category = $(".anime_category:checked").val();
    var select_anime = [];
    $('.anime_category:checked').each(function(i) {
        select_anime[i] = $(this).val();
    });
    var title = $("#upload_title").val();
    var description = $("#upload_description").val();
    var image_name = $("#img_name").val();
    var video_name = $("#video_name").val();
    var tag = $("#tag2").val();
    var author = $("#author").val();
    var credit = $("#credit").val();
    if ($("#check1").is(':checked')) {
        var not_safe = 1;
    } else {
        var not_safe = 0;
    }
    if ($("#check3").is(':checked')) {
        var spoiler = 1;
    } else {
        var spoiler = 0;
    }


    if ($("#check2").is(':checked')) {
        var credit_author = 1;
    } else {
        var credit_author = 0;
    }

    $.ajax({
        url: base_url + 'public/home/upload_image_next',
        type: 'POST',
        data: {
            'title': title,
            'description': description,
            'not_safe': not_safe,
            'credit_author': credit_author,
            'image_name': image_name,
            'video_name': video_name,
            'tag': tag,
            'author': author,
            'credit': credit,
            'category': category,
            'spoiler': spoiler,
            wordd: wordd,
        },
        dataType: 'json',
        success: function(data) {
            if (data.result == "success") {
                $.ajax({
                    type: "POST",
                    url: base_url + 'public/home/last_save_upload_image',
                    dataType: 'json',
                    data: {
                        'title': title,
                        'description': description,
                        'not_safe': not_safe,
                        'credit_author': credit_author,
                        'image_name': image_name,
                        'video_name': video_name,
                        'tag': tag,
                        'author': author,
                        'credit': credit,
                        'category': category,
                        'spoiler': spoiler,
                    },
                    success: function(msg) {

                        if (msg.result == "success") {
                            $(".img-upload").hide();
                            $("#modal_upload").show();
                            $("#anime_alert").hide();
                            $("#close_modal_click").trigger('click');

                        } else {
                            $("#alert").show();
                            $("#alert").html('<strong>' + data.msg + '</strong>');
                        }
                    }
                });
            } else if (data.result == "error") {
                window.parent.scrollTo(0, 0);
                $('.popupContainer').animate({scrollTop: 0}, 'fast');
                $("#alert").show();
                $("#alert").html('<strong>' + data.msg + '</strong>');
            }

        }
    });

}
function handle(e) {
    if (e.which === 32) {
        var x = $('#tag').val();
        if (x != " ") {
            $("#tag1").append('<a class="btn btn-grey" href="javascript:void(0);" role="button" style="margin-left: 5px;">' + x + ' <i class="fa fa-close rem"></i></a>');
            $("#tag").val("");
            $("#tag2").append(x);
        } else {
            $("#tag").val("");
        }

    }
    return false;
}

$('#tag1').on('click', '.rem', function() {
    $(this).parent().remove();
    var variable = $('#tag1').text().replace(/\s\s+/g, ' ');

    $("#tag2").text($.trim(variable));
});


function back_image_load() {
    $('#alert').hide();
    $('#cat_alert').hide();
    $('.pic_category').attr('checked', false);
    $(".upload-category-image").hide();
    $(".img-upload").show();
}




// album
$("#albumform").submit(function(event) {
    event.preventDefault();
    var word = $('#main_title').val();
    var category = $(".pic_category:checked").val();
    var main_title = $("#main_title").val();
    var author = $('#albumauthor').val();
    var credit = $('#albumcredit').val();
    if ($("#albumcheck2").is(':checked')) {
        var credit_author = 1;
    } else {
        var credit_author = 0;
    }
    var notsafe = 0;
    if ($("#album-not-safe").is(':checked')) {
        var notsafe = 1;
    }
    if ($("#albumcheck3").is(':checked')) {
        var spolier = 1;
    } else {
        var spolier = 0;
    }
    $.ajax({type: "POST",
        url: base_url + "public/home/add_albumdata",
        data: {
            data: $(this).serialize(),
            credit_author: credit_author,
            author: author,
            credit: credit,
            main_title: main_title,
            spolier_val: spolier,
            category: category,
            notsafe: notsafe,
            word: word,
        },
        dataType: 'json',
        success: function(data) {
            if (data.result == "success") {
                $.ajax({
                    url: base_url + 'public/home/last_save_album_image',
                    type: 'POST',
                    data: {
                        data: $('#albumform').serialize(),
                        credit_author: credit_author,
                        author: author,
                        credit: credit,
                        main_title: main_title,
                        spolier_val: spolier,
                        category: category,
                        notsafe: notsafe,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == "success") {
                            $(".album-upload").hide();
                            $("#modal_upload").show();
                            $("#close_modal_click").trigger('click');
                            window.location.reload();
                        } else if (data.result == "error") {
                            $("#album_alert").show();
                            $("#album_alert").html('<strong>' + data.msg + '</strong>');
                        }
                    }
                });
            } else if (data.result == "error") {
                window.parent.scrollTo(0, 0);
                $('.popupContainer').animate({scrollTop: 0}, 'fast');
                $("#album_alert").show();
                $("#album_alert").html('<strong>' + data.msg + '</strong>');
            }
        }});
});

$("#choose-album,#add_more_album").click(function() {
    $('#uploadalbum').trigger('click');
//        $(".upload").hide();
//        $(".album-upload").show();
//        return false;
});

$('#uploadalbum').change(function() {
    $("#showalbum").html('');
    var data = new FormData($('#album_form')[0]);
    $.ajax({
        type: "POST",
        url: base_url + "public/home/file_upload",
        mimeType: "multipart/form-data",
        contentType: false,
        data: data,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
            $('.waitalbum').show();
        },
        success: function(data) {
            if (data.result == "success") {

                $('.waitalbum').hide();

                $('#albumarea').show();
                $("#showalbum").hide();
                $("#album_alert").hide();
                $("#album_alert1").hide();
                $("#modal_upload").hide();
                $(".album-upload").show();
                var j = data.firstname;
                var k = j.split(",");
                var m = k.length;
                var l;
                for (l = 0; l < m; l++) {
                    parts = k[l].split(".");
                    loc = parts.pop();
                    if (loc != "" && (loc == "jpg" || loc == "jpeg" || loc == "gif" || loc == "png")) {

                        $('#albumarea').append('<div class="panel panel-default bor-radius-0"  id="rem_' + k[l] + '"  > \n\
                                                    <span class="delete-panel remove_img" id="' + k[l] + '" ><i class="fa fa-times"></i></span>\n\
                                                    <div class="panel-body"> \n\
                                                        <div class="panel-content col-md-12 no-padding">  \n\
                                                            <a href="">  \n\
                                                                <div class="img-panel">  \n\
                                                                <img src="' + base_url + 'uploads/league/' + k[l] + '" style="height:100%"> \n\
                                                                <input type="hidden"  name="img_' + k[l] + '" value="' + k[l] + '" > \n\
                                                                </div>   \n\
                                                            </a> \n\
                                                            <input type="text" placeholder="Give a title here..." class="title_count title-img-upload"  name="' + k[l] + '" maxlength="150"  id="titl_' + k[l] + '"> \n\
                                                            <div class="pull-right count-right" id="tit' + k[l] + '" style="top: 5px;">\n\
                                                                 <span >150</span>  \n\
                                                            </div>\n\
                                                            <textarea placeholder="Describe your post with tags!"  id="album_tag_' + k[l] + '" data-aid="' + k[l] + '" class="txt-area-tags album_tag"></textarea>\n\
                                                            <div class="hastag-view-upload" id="album_tag1_' + k[l] + '"></div>\n\
                                                            <textarea style="display: none" class="form-control desc" name= "album_tag' + k[l] + '" id="album_tag2_' + k[l] + '" rows="2" ></textarea>\n\
                                                        </div> \n\
                                                    </div>\n\
                                                    <div class="wrap-filter-post">\n\
                                                        <input type="text" maxlength="250"  id="desr**' + k[l] + '" name="desc_' + k[l] + '" class="textarea-resize desc_count" placeholder="Describe your post">\n\
                                                        <div class="count-right" >\n\
                                                            <span id="dese' + k[l] + '">250</span>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>  ');
                    } else {
                        $("#showalbum").show();
                        $("#showalbum").append('<strong>Make sure valid file type . Not allowed .' + loc + ' file format</strong>');
                    }
                }
                $.ajax({
                    type: "POST",
                    url: base_url + 'public/home/get_image_upload_category',
                    data: {
                        type: 'album'
                    },
                    success: function(msg) {
                        $('#category_album_list').html(msg);
                    }
                });
            } else if (data.result == "error") {
                $('.waitalbum').hide();
                $("#showalbum").show();
                $("#showalbum").html('<strong>' + data.msg + '</strong>');
                $("#album_alert,#album_alert1").show();
                $("#album_alert,#album_alert1").html('<strong>' + data.msg + '</strong>');
            }
        }
    });
});

$(document).on('keyup', '.album_tag', function(e) {
    if (e.which === 32) {
        var id = $(this).data('aid');
        var x = document.getElementById("album_tag_" + id).value;
        if (x != " ") {
            var div = document.getElementById("album_tag1_" + id);
            div.innerHTML = div.innerHTML + ('<a class="btn btn-grey" href="javascript:void(0);" role="button" style="margin-left: 5px;">' + x + ' <i class="fa fa-close album_rem" data-remid="' + id + '"></i></a>');
            document.getElementById("album_tag_" + id).value = "";
            var tag_val = document.getElementById("album_tag2_" + id);
            tag_val.value = tag_val.value + x;
        } else {
            document.getElementById("album_tag_" + id).value = "";
        }

    }
    return false;
});
$(document).on('click', '.album_rem', function() {
    var id = $(this).data('remid');
    $(this).parent().remove();

    var html = document.getElementById("album_tag1_" + id).innerHTML;
    var variable = document.getElementById("album_tag2_" + id).value = html.replace(/<[^>]*>/g, "");
    var new_variable = variable.replace(/\s\s+/g, " ");
    document.getElementById("album_tag2_" + id).value = (new_variable.trim());
});
$(document).on('click', '.remove_img', function() {
    var id = $(this).attr('id');
    document.getElementById('rem_' + id).remove();
    $(this).remove();
});


// discussion

function discussion_next() {
    var discussion_desc = tinymce.activeEditor.getContent();
    var discussion_title = $('#discussion_count').val();
    var creditcheck_disc = $("#creditcheck_disc").is(':checked');
    var disc_credit = $("#disc_creditor_site").val();
    var disc_author = $("#disc_creditor_author").val();
    var desc_count = $('#dis_desc_span').html();
    var title_count = $('#discussion_count').val();
    var category = $(".pic_category:checked").val();
    var discussion_file = $("#discussion_file").val();
    if ($("#discussioncheck").is(':checked')) {
        var spoiler = 1;
    } else {
        var spoiler = 0;
    }
    if ($("#creditcheck_disc").is(':checked')) {
        disc_credit = $("#disc_creditor_site").val();
        disc_author = $("#disc_creditor_author").val();
    }
    else {
        disc_credit = "";
        disc_author = "";
    }
    $.ajax({
        type: 'POST',
        url: base_url + 'public/home/discussion_next_upload',
        dataType: 'json',
        data: {
            discussion_desc: discussion_desc,
            discussion_title: discussion_title,
            creditcheck_disc: creditcheck_disc,
            disc_credit: disc_credit,
            disc_author: disc_author,
            desc_count: desc_count,
            title_count: title_count,
            category: category,
            discussion_file: discussion_file,
            spoiler: spoiler,
            header_type: 1,
            disc_creditor_site: disc_credit,
            disc_creditor_author: disc_author
        },
        success: function(data) {
            if (data.result === 'success') {
                $(".discuss-upload").hide();
                $("#discussionalert").hide();
                $(".upload-category-discuss").show();

                $.ajax({
                    url: base_url + 'public/home/last_save_discussion',
                    type: 'POST',
                    data: {
                        category: category,
                        title: discussion_title,
                        discussion_file: discussion_file,
                        description: discussion_desc,
                        spoiler: spoiler,
                        header_type: 1,
                        disc_creditor_site: disc_credit,
                        disc_creditor_author: disc_author
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == "success") {
                            $(".discuss-upload").hide();
                            $("#close_modal_click").trigger('click');
                            $("#modal_upload").show();
                            window.location.reload();
                        } else if (data.result == "error") {
                            window.parent.scrollTo(0, 0);
                            $('.popupContainer').animate({scrollTop: 0}, 'fast');
                            $("#discussionalert").show();
                            $("#discussionalert").html('<strong>' + data.msg + '</strong>');
                        }
                    }
                });
            } else if (data.result === 'error') {
                window.parent.scrollTo(0, 0);
                $('.popupContainer').animate({scrollTop: 0}, 'fast');
                $('#discussionalert').show();
                $('#discussionalert').html(data.msg);
            }
        }
    });
}

$("#regi_click").click(function() {
    $('#login_close').trigger('click');
});
$("#login_click").click(function() {
    $('#sign_close').trigger('click');
});
$("#forgetmodal").click(function() {
    $('#login_close').trigger('click');
});


// rating 

$("#choose-rating").click(function() {
    $("#modal_upload").hide();
    $(".rating-upload").show();
    $.ajax({
        type: "POST",
        url: base_url + 'public/home/get_image_upload_category',
        data: {
            type: 'poll'
        },
        success: function(msg) {
            $('#first_poll_list').html(msg);
        }
    });
    return false;
});
function poll_next() {
    var question = $('#question').val();
    var discription = $('#discription').val();
    var title = $('#title').val();
    var category = $(".pic_category:checked").val();

    var answers = [];
    $('.option').each(function(i) {
        answers[i] = $(this).val();
    });

    $.ajax({
        type: 'POST',
        url: base_url + 'public/home/poll_next_upload',
        dataType: 'json',
        data: {
            'title': title,
            'question': question,
            'discription': discription,
            'category': category,
            'answers': answers,
        },
        success: function(data) {
            if (data.success == true) {
                $("#first_poll_alert").hide();
                $(".rating-upload").hide();
                $(".upload-category-rating").show();
                $.ajax({
                    url: base_url + 'public/home/last_anime_save',
                    type: 'POST',
                    data: {
                        'title': title,
                        'question': question,
                        'discription': discription,
                        'category': category,
                        'answers': answers,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == "success") {
                            $("#first_poll_alert").hide();
                            $('.upload').show();
                            $("#close_modal_click").trigger('click');
                            window.location.reload();
                        } else if (data.result == "error") {
                            window.parent.scrollTo(0, 0);
                            $('.popupContainer').animate({scrollTop: 0}, 'fast');
                            $("#first_poll_alert").show();
                            $("#first_poll_alert").html('<strong>' + data.msg + '</strong>');
                        }
                    }
                });
            } else {
                window.parent.scrollTo(0, 0);
                $('.popupContainer').animate({scrollTop: 0}, 'fast');
                $('#error_title').html(data.title);
                $('#error_question').html(data.question);
                $('#error_option').html(data.option);
                $('#error_discription').html(data.discription);
                $("#first_poll_alert").show();
                $("#first_poll_alert").html('<strong>' + data.msg + '</strong>');
            }
        }
    });
}
function anime_discussion_back() {
    $(".discuss-upload1").hide();
    $('.upload').show();
}

// gamechat 
$("#game-dialogue, #add_new_game").click(function() {
    $("#uploadGamechat").click();
});
$("#uploadGamechat").change(function() {
    var data = new FormData($('#gamechat_form')[0]);
    $.ajax({
        type: "POST",
        url: base_url + "public/home/file_upload",
        mimeType: "multipart/form-data",
        contentType: false,
        data: data,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
            $('.waitgamechat').show();
        },
        success: function(data) {
            if (data.result == "success") {
                $("#showgamechat").hide();
                $('.waitgamechat').hide();
                $("#modal_upload").hide();
                $(".gamechat-upload").show();
                var j = data.firstname;
                var k = j.split(",");
                var m = k.length;

                var l;
                for (l = 0; l < m; l++) {
                    parts = k[l].split(".");
                    loc = parts.pop();
                    if (loc != "" && (loc == "jpg" || loc == "jpeg" || loc == "gif" || loc == "png")) {


                        $('#gamechatarea').append('\<a class="remove_gameimg fa fa-remove pull-right" href="javascript:void(0);" data-id="' + k[l] + '" style="margin-top: -8px; margin-right: -5px; color: red;"><a>\n\
                                                <div class="panel-body" id="gameRem_' + k[l] + '"> \n\
                                                    <div class="panel-content col-md-12 no-padding"> \n\
                                                        <input type="hidden"  name="img_' + k[l] + '" value="' + k[l] + '" > \n\
                                                        <a href="javascript:void(0)"> <div class="img-panel"> <img src="' + base_url + 'uploads/league/' + k[l] + '" style="height:100%">  </div> </a> \n\
                                                        <div class="title-dialogue"> \n\
                                                            <select  name="opt_' + k[l] + '" > \n\
                                                                <option value="volvo">Here a title</option> \n\
                                                                <option value="saab">lalalala</option> \n\
                                                                <option value="mercedes">Medusa got a rampage</option> \n\
                                                                <option value="audi">Anti Mage teach</option> \n\
                                                            </select> <hr>  \n\
                                                            <textarea placeholder="Dialogue" class="desc_count" name="desc_' + k[l] + '" maxlength="150" id="desr**' + k[l] + '"></textarea> \n\
                                                        </div>  \n\
                                                        <div class="count-right" id="dese' + k[l] + '"> <span>150</span> </div> \n\
                                                    </div> \n\
                                                </div>');
                    } else {
                        $("#showgamechat").show();
                        $("#showgamechat").append('<strong>Make sure valid file type . Not allowed .' + loc + ' file format</strong>');
                    }
                }

            } else if (data.result == "error") {
                $('.waitgamechat').hide();
                $("#showgamechat").show();
                $("#showgamechat").html('<strong>' + data.msg + '</strong>');
            }
        }
    });

});

$("#gameform").submit(function(event) {
    event.preventDefault();

    $.ajax({type: "POST",
        url: base_url + "public/home/add_albumdata",
        data: {data: $(this).serialize()

        },
        dataType: 'json',
        success: function(data) {
            if (data.result == "success") {
                $.ajax({
                    type: "POST",
                    url: base_url + 'public/home/get_image_upload_category',
                    data: {
                        type: 'game'
                    },
                    success: function(msg) {
                        $('#category_album_list').html(msg);
                    }
                });
                $(".album-upload").hide();
                $(".upload-category-album").show();
            } else if (data.result == "error") {
                $("#album_alert").show();
                $("#album_alert").html('<strong>' + data.msg + '</strong>');
            }
        }});
});
$(document).on('click', '.remove_gameimg', function() {
    var id = $(this).data('id');
    document.getElementById('gameRem_' + id).remove();
    $(this).remove();
});







//search     
function search_anime(id) {
    var idd = $('#' + id).val();
    var divId = $('.' + id).attr('id');
    $.ajax({
        url: base_url + "public/home/search_anime_list/",
        type: "POST",
        data: {id: idd},
        success: function(msg) {
            $('#' + divId).html(msg);
        },
        //                            false
    });
}
function discussion_upload_cate() {
    var category = $(".pic_category:checked").val();
    $.ajax({
        url: base_url + 'public/home/discussion_upload_category',
        type: 'POST',
        data: {
            'category': category,
        },
        dataType: 'json',
        success: function(data) {
            if (data.result == "success") {
                $(".upload-category-discuss").hide();
                $(".anime-category-discuss").show();
                $.ajax({
                    type: "POST",
                    url: base_url + 'public/home/get_image_upload_animecategory',
                    beforeSend: function(xhr) {
                        $("#anime_catagory_discussion_list").html("Please wait....")
                    },
                    success: function(msg) {
                        $('#anime_catagory_discussion_list').html(msg);
                    }
                });
            } else if (data.result == "error") {
                $("#discussion_category").show();
                $("#discussion_category").html('<strong>' + data.msg + '</strong>');
            }
        }
    });
}
function disc_facebook_link()
{
    $("#disc_creditor_author").val("http://www.facebook.com/");
}

function disc_twitter_link()
{
    $("#disc_creditor_site").val("https://www.twitter.com/");
}

function disc_instagram_link()
{
    $("#disc_creditor_site").val("https://www.instagram.com/");
}
function disc_facebook_link1()
{
    $("#disc_creditor_author1").val("http://www.facebook.com/");
}

function disc_twitter_link1()
{
    $("#disc_creditor_site1").val("https://www.twitter.com/");
}

function disc_instagram_link1()
{
    $("#disc_creditor_site1").val("https://www.instagram.com/");
}
/*************/
function facebook_link()
{
    $("#author").val("http://www.facebook.com/");
}

function twitter_link()
{
    $("#author").val("https://www.twitter.com/");
}

function instagram_link()
{
    $("#author").val("https://www.instagram.com/");
}

function albumfacebook_link()
{
    $("#albumcredit").val("http://www.facebook.com/");
}

function albumtwitter_link()
{
    $("#albumcredit").val("https://www.twitter.com/");
}

function albuminstagram_link()
{
    $("#albumcredit").val("https://www.instagram.com/");
}
function urlfacebook_link()
{
    $("#urlcredit").val("http://www.facebook.com/");
}

function urltwitter_link()
{
    $("#urlcredit").val("https://www.twitter.com/");
}

function urlinstagram_link()
{
    $("#urlcredit").val("https://www.instagram.com/");
}

// cropper

function getCoverCanvas(sourceCanvas) {
    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');
    var width = sourceCanvas.width;
    var height = sourceCanvas.height;
    canvas.width = width;
    canvas.height = height;
    context.beginPath();
    context.rect(0, 0, width, height);
    context.strokeStyle = 'rgba(0,0,0,0)';
    context.stroke();
    context.clip();
    context.drawImage(sourceCanvas, 0, 0, width, height);
    return canvas;
}
function getCropCover() {
    //                alert("df");
    var $image = $('#coverimage');
    var $button = $('#coverbutton');
    var $result = $('#coverresult');
    var croppable = false;
    $image.cropper({
//                    aspectRatio: 16 / 9,
//                    aspectRatio: 150 / 200,
//                        dragCrop: false,
//                        dragMode: 'crop',
        setSelect: [0, 0, 1440, 350],
        aspectRatio: 1440 / 350,
        highlight: true,
        minCropBoxWidth: 568,
        minCropBoxHeight: 156,
        minContainerWidth: 568,
        minContainerHeight: 400,
        viewMode: 1,
        built: function() {
            croppable = true;
        }
    });
    $button.on('click', function() {
        var croppedCanvas;
        var coverCanvas;
        if (!croppable) {
            return;
        }

        // Crop
        croppedCanvas = $image.cropper('getCroppedCanvas');
        // Cover
        coverCanvas = getCoverCanvas(croppedCanvas);
        // Show
        $result.html('<img src="' + coverCanvas.toDataURL() + '"><input name="coverimg" type="hidden" value="' + coverCanvas.toDataURL() + '">');
        $('#up_cover').show();
    });
}
function getRoundedCanvas(sourceCanvas) {
    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');
    var width = sourceCanvas.width;
    var height = sourceCanvas.height;
    canvas.width = width;
    canvas.height = height;
    context.beginPath();
    context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI);
    context.strokeStyle = 'rgba(0,0,0,0)';
    context.stroke();
    context.clip();
    context.drawImage(sourceCanvas, 0, 0, width, height);
    return canvas;
}

function getCropImage() {
    var $image = $('#image');
    var $button = $('#button');
    var $result = $('#result');
    var croppable = false;
    $image.cropper({
        aspectRatio: 1, minContainerWidth: 568,
        viewMode: 1,
        built: function() {
            croppable = true;
        }
    });
    $button.on('click', function() {
        var croppedCanvas;
        var roundedCanvas;
        if (!croppable) {
            return;
        }

        // Crop
        croppedCanvas = $image.cropper('getCroppedCanvas');
        // Round
        roundedCanvas = getRoundedCanvas(croppedCanvas);
        // Show
        $result.html('<img src="' + roundedCanvas.toDataURL() + '"><input name="img" type="hidden" value="' + roundedCanvas.toDataURL() + '">');
        $('#up_image').show();
    });
}


$(function() {
    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function() { // set image data as background of div
                $("#imagePreview").html('<img src="' + this.result + '" class="img-responsive" id="image"  alt="jcrop Circle Area Example" style="max-width: 100%; max-height: 100%;"/>');
                getCropImage();
            };
        }
    });
    $("#uploadcover").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader)
            return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function() { // set image data as background of div
                $("#coverImage").html('<img src=" ' + this.result + '" class="img-responsive" id="coverimage"  alt="jcrop Circle Area Example" style="max-width: 100%; max-height: 100%;"/>');
                getCropCover();
            };
        }
    });
}
);