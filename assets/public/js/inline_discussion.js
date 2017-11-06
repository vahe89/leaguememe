$(document).ready(function() {
    var myDropzone = new Dropzone("#inline_upload_discussion");
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
                $("#inline_wait_discussion").show();
            },
            success: function(msg) {
                if (msg.result == "success") {
                    $("#inline_wait_discussion").hide();
                    $('#inline_discussion_file').val(msg.discussion);
                    $(".create-disc-cont").hide();
                    $(".inline-discuss-upload").show();
                    $.ajax({
                        type: "POST",
                        url: base_url + 'public/home/get_image_upload_category',
                        data: {
                            type: 'in_discussion'
                        },
                        success: function(msg) {
                            $('#inline_discuusioncategory_list').html(msg);
                        }
                    });
                } else if (msg.result == "error") {
                    $("#inline_wait_discussion").hide();
                    $("#inline_discussupload_alert").show();
                    $("#inline_discussupload_alert").html('<strong>' + msg.msg + '</strong>');
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        this.removeFile(file);
    });
    $("#inline_back-discuss").click(function() {
        $(".inline-discuss-upload").slideUp();
        $(".create-disc-cont").slideDown();
    })
    $("#inline-back-category-discuss").click(function() {
        $(".inline-upload-category-discuss").slideUp();
        $(".inline-discuss-upload").slideDown();
    })
    $("#inline-back-anime-discuss").click(function() {
        $(".inline-upload-anime-discuss").slideUp();
        $(".inline-upload-category-discuss").slideDown();
    })
    $("#inline-back-category-poll").click(function() {
        $(".inline-upload-category-poll").slideUp();
        $(".inline-poll-upload").slideDown();
    })

    $("#back-poll-form").click(function() {
        $(".create-disc-cont").slideDown();
        $(".inline-poll-upload").slideUp();
    })
    $("#inline-back-anime-poll").click(function() {
        $(".inline-upload-anime-poll").slideUp();
        $(".inline-upload-category-poll").slideDown();

    })
    $(document).on('keyup', '#inline_discussion_count', function() {
        var limit = 150;
        var text_remaining;
        var text_length = document.getElementById('inline_discussion_count').value.length;
        text_remaining = limit - text_length;
        if (text_remaining == 150) {
            document.getElementById('inline_di_count_span').innerHTML = '<span >150</span>';
        } else {
            if (text_remaining >= 0) {
                document.getElementById('inline_di_count_span').innerHTML = '<span>' + text_remaining + '</span>';
            } else if (text_remaining < 0) {

                document.getElementById('inline_di_count_span').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
            }
        }

    });


    $(".choose-rating").click(function() {

        $(".create-disc-cont").slideUp();
        $(".inline-poll-upload").slideDown();
        $.ajax({
            type: "POST",
            url: base_url + 'public/home/get_image_upload_category',
            data: {
                type: 'in_poll'
            },
            success: function(msg) {
                $('#poll_cat_list').html(msg);
            }
        });
    })

    var count = 1;
    $("#inline_add_more").click(function() {
        count++;
        $("#inline_more_option").append('<a class="remove_img fa fa-remove pull-right" href="javascript:void(0);" id="' + count + '" style="margin-top: -8px; margin-right: -5px; color: red;"><a><div class="panel panel-default mar-b-10" id="rem_' + count + '"><div class="panel-body-discuss panel-body"><div class="panel-content col-md-12 no-padding"><input type="text" placeholder="Enter poll option..." class="inline_option title-discuss-input" name="option" id="option"><span class="inline_option_count pull-right char-length" id="inline_option_count">150</span></div></div></div>');

    });
})
function inline_discussion_next() {
    var discussion_desc = tinymce.activeEditor.getContent();
    var discussion_title = $('#inline_discussion_count').val();
    var creditcheck_disc = $("#inline_creditcheck_disc").is(':checked');
    var disc_credit = $("#inline_disc_creditor_site").val();
    var disc_author = $("#inline_disc_creditor_author").val();
    var category = $("#inline_discuusioncategory_list .pic_category:checked").val();
    var discussion_file = $("#inline_discussion_file").val();
    var word = $('#inline_dis_desc_span').html();
    if ($("#inline_discussioncheck").is(':checked')) {
        var spoiler = 1;
    } else {
        var spoiler = 0;
    }

    if ($("#inline_creditcheck_disc").is(':checked')) {
        disc_credit = $("#inline_disc_creditor_site").val();
        disc_author = $("#inline_disc_creditor_author").val();
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
            category: category,
            desc_count: word
        },
        success: function(data) {
            if (data.result === 'success') {
                $('#inline_discussionalert').hide();
                $(".inline-discuss-upload").slideUp();
                $(".inline-upload-category-discuss").slideDown();
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
                            $("#inline_discussionanimealert").hide();
                            $(".inline-discuss-upload").slideUp();
                            $(".create-disc-cont").slideDown();
                            $("#inline_discussupload_alert_success").show();
                            $("#inline_discussupload_alert_success").html('<strong> Discussion successfully uploaded.</strong>');
                        } else if (data.result == "error") {
                            window.parent.scrollTo(0, 0);
                            $('#upload-discussion-tab').animate({scrollTop: 0}, 'fast');
                            $("#inline_discussionalert").show();
                            $("#inline_discussionalert").html('<strong>' + data.msg + '</strong>');
                        }
                    }
                });
            } else if (data.result === 'error') {
                window.parent.scrollTo(0, 0);
                $('#upload-discussion-tab').animate({scrollTop: 0}, 'fast');
                $('#inline_discussionalert').show();
                $('#inline_discussionalert').html(data.msg);
            }
        }
    });
}


function inline_poll_next() {
    var question = $('#inline_question').val();
    var discription = $('#inline_discription').val();
    var title = $('#inline_title').val();
    var category = $("#poll_cat_list .pic_category:checked").val();
    var answers = [];
    $('#inline_poll_form .inline_option').each(function(i) {
        answers[i] = $(this).val();
    });
    if ($("#inlne_poll_spoiler").is(':checked')) {
        var spoiler = 1;
    } else {
        var spoiler = 0;
    }
    var creditChk = $("#credit_author").is(':checked');
    if ($("#credit_author").is(':checked')) {
        var credit = $("#inline_poll_credit").val();
        var author = $("#inline_poll_author").val();
    } else {
        var credit = "";
        var author = "";
    }

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
            'creditChk': creditChk,
            'credit': credit,
            'author': author,
            'spoiler': spoiler
        },
        success: function(data) {
            if (data.success == true) {
                $('#inline_first_poll_alert').hide();
                $(".inline-poll-upload").slideUp();
                $(".inline-upload-category-poll").slideDown();
                $.ajax({
                    url: base_url + 'public/home/last_anime_save',
                    type: 'POST',
                    data: {
                        'title': title,
                        'question': question,
                        'discription': discription,
                        'category': category,
                        'answers': answers,
                        'creditChk': creditChk,
                        'credit': credit,
                        'author': author,
                        'spoiler': spoiler
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == "success") {
                            $("#inline_poll_animerror").hide();
                            $("#inline_discussupload_alert_success").show();
                            $("#inline_discussupload_alert_success").html('<strong> Poll successfully uploaded.</strong>');
                            $(".inline-poll-upload").slideUp();
                            $(".create-disc-cont").slideDown();

                        } else if (data.result == "error") {
                            window.parent.scrollTo(0, 0);
                            $('#inline_first_poll_alert').show();
                            $('#inline_first_poll_alert').html('<strong>' + data.msg + '</strong>');
                        }
                    }
                });

            } else {
                window.parent.scrollTo(0, 0);
                $('#inline_error_title').html(data.title);
                $('#inline_error_question').html(data.question);
                $('#inline_error_option').html(data.option);
                $('#inline_error_discription').html(data.discription);
                $('#inline_error_credit').html(data.author);
                $('#inline_error_credit').html(data.credit);
                $('#inline_first_poll_alert').show();
                $('#inline_first_poll_alert').html('<strong>' + data.msg + '</strong>');

            }
        },
        beforeSend: function() {
            $('#inline_error_title, #inline_error_question, #inline_error_option, #inline_error_discription, #inline_error_credit').html("");
        }
    });
}

$(document).on('keyup', '#inline_title', function() {
    var text_length = document.getElementById('inline_title').value.length;
    text_remaining = 150 - text_length;
    if (text_remaining == 150) {
        document.getElementById('inline_title_count').innerHTML = '150';
    } else {
        if (text_remaining >= 0) {
            document.getElementById('inline_title_count').innerHTML = text_remaining;
        } else if (text_remaining < 0) {

            document.getElementById('inline_title_count').innerHTML = '<font color=red>' + text_remaining + '</span>';
        }
    }

});
$(document).on('keyup', '#inline_question', function() {

    var text_length = document.getElementById('inline_question').value.length;
    text_remaining = 150 - text_length;
    if (text_remaining == 150) {
        document.getElementById('inline_question_count').innerHTML = '150';
    } else {
        if (text_remaining >= 0) {
            document.getElementById('inline_question_count').innerHTML = text_remaining;
        } else if (text_remaining < 0) {

            document.getElementById('inline_question_count').innerHTML = '<font color=red>' + text_remaining + '</font>';
        }
    }

});

$(document).on('keyup', '.inline_option', function() {
    var text_length = $(this).val().length;
    text_remaining = 150 - text_length;
    if (text_remaining == 150) {
        $(this).parent().find('.inline_option_count').html('150');
    } else {
        if (text_remaining >= 0) {
            $(this).parent().find('.inline_option_count').html(text_remaining);
        } else if (text_remaining < 0) {
            $(this).parent().find('.inline_option_count').html('<font color=red>' + text_remaining + '</font>');
        }
    }

});

$(document).on('keyup', '#inline_discription', function() {


    var text_length = document.getElementById('inline_discription').value.length;
    text_remaining = 350 - text_length;
    if (text_remaining == 350) {
        document.getElementById('inline_discription_count').innerHTML = '350';
    } else {
        if (text_remaining >= 0) {
            document.getElementById('inline_discription_count').innerHTML = text_remaining;
        } else if (text_remaining < 0) {

            document.getElementById('inline_discription_count').innerHTML = '<font color=red>' + text_remaining + '</font>';
        }
    }

});
