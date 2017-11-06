 
<?php
$class = $this->router->fetch_class();
$method = $this->router->fetch_method();
echo $this->load->view('template/sidebar_list');
?> 

<div  role="tabpanel" class="tab-pane right-panel-sec pad-left active"  id="poll"> 

    <div class="col-md-7 col-xs-12 col-sm-12 main-content" >
        <div id='outer-poll'>
            <ul  class="nav pop-tabs" role="tablist" style="margin-top: 10px;">

                <li role="presentation" class="active" style="margin-left: 0px; margin-right: -5px;" data-name="new">
                    <a href="javascript:void(0)" role="tab" data-toggle="tab" aria-controls="">Poll</a>
                </li>
            </ul>

            <div  id="all-poll" >
                <div style="text-align: center; padding-top: 50px">
                    <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" />
                </div>
            </div> 
             <br>
        <div class="text-center col-md-12 mar-t-15">
            <span class="load-more-poll btn btn-red" style="width:70%;display: none" id="load-more-poll">Load More Poll</span>
        </div>
            <input type="hidden" id="row" value="0">
        </div>
        <div class="upload create-disc-cont" id='poll-upload' style="display: none">
            <h1 class="modal-title-upload mar-t-20" id="myModalLabel" style="font-size: 20px">Poll</h1>
            <hr>
            <p class="grey-color-xs">Every created poll must be related to One Piece</p>

            <div class="upload-top">  
                <a href="javascript:void(0)" class="choose-rating">
                    <div class="upload-image panel panel-default">
                        <div class="panel-body"> <img src="<?= base_url() ?>assets/public/img/rating.png"> </div>
                        <div class="panel-title"> <span>Make a poll</span> </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="inline-poll-upload image-upload" style="display: none" id='inline-poll-upload'>
            <div class="modal-header bor-none">
                <h1 class="modal-title-upload mar-t-20" id="myModalLabel" style="font-size: 20px">Poll</h1>
                <hr/>
                <p class="grey-color-xs img-subtitle">Every question asked must be related to One Piece</p>
                <div id="inline_first_poll_alert" style="display: none" class="text-center alert alert-danger"></div>
                <form id="inline_poll_form" method="post" action="">
                    <div class="panel panel-default mar-b-40">
                        <div class="panel-body-discuss panel-body">
                            <div class="panel-content col-md-12 no-padding">
                                <input type="text" placeholder="Give a Title Here..." class="title-discuss-input" name="title" id="inline_title">
                                <span class="pull-right char-length" id="inline_title_count">150</span>
                            </div>
                        </div>
                    </div>
                    <span id="inline_error_title" class="help-inline error-red" ></span>&nbsp;
                    <div class="panel panel-default mar-b-40">
                        <div class="panel-body-discuss panel-body">
                            <div class="panel-content col-md-12 no-padding">
                                <input type="text" placeholder="Type your question..." name="question" class="title-discuss-input" id="inline_question">
                                <span class="pull-right char-length" id="inline_question_count">150</span>
                            </div>
                        </div>
                    </div>
                    <span id="inline_error_question" class="help-inline error-red"></span>&nbsp;     

                    <div class="panel panel-default mar-b-10">
                        <div class="panel-body-discuss panel-body">
                            <div class="panel-content col-md-12 no-padding">
                                <input type="text" placeholder="Enter poll option..." class="inline_option title-discuss-input" name="poll_answer" id="poll_answer">
                                <span class="inline_option_count pull-right char-length" id="inline_option_count">150</span>     

                            </div>
                        </div>
                    </div>
                    <div id="inline_more_option" name="optionm" id="optionm">

                    </div>
                    <span id="inline_error_option" class="help-inline error-red"></span>&nbsp;
                    <div class="wrap-filter-post no-padding mar-b-20" id="inline_add_more">
                        <a href="javascript:void(0);"><i class="fa fa-plus-circle" style="color: #17ae97; margin-right: 10px;"></i>Add another one</a>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body-discuss panel-body">
                            <textarea placeholder="Describe your post" class="title-polling-upload" id="inline_discription" name="discription"></textarea>
                            <span class="pull-right char-length-polling" id="inline_discription_count">350</span>                                    
                        </div>
                    </div>
                    <span id="inline_error_discription" class="help-inline error-red" style="margin-top: -5px;"></span>


                    <div class="panel panel-default panel-discuss-check">
                        <div class="wrap-filter-post">
                            Add spoiler tag
                            <input type="checkbox" name="inlne_poll_spoiler" style="display: none" id="inlne_poll_spoiler" />
                            <label for="inlne_poll_spoiler">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                            </label>
                        </div>
                        <div class="wrap-filter-post">
                            Credit the author
                            <input type="checkbox" name="credit_author" class="only_credit" style="display: none" id="credit_author" value="credit_author" />
                            <label for="credit_author">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                            </label>
                        </div>

                        <div class="credit credit_author" style="display: none">
                            <div class="socmed-credit">
                                
                            </div>
                            <div class="name-author">
                                <input type="text" id="inline_poll_credit" name="credit" placeholder="http://" readonly="">
                                <input type="text" id="inline_poll_author" name="author" placeholder="Name of Creditor">
                            </div>
                        </div>
                        <span id="inline_error_credit" class="help-inline error-red" style="margin-top: -5px;"></span>
                    </div>

                    <div class="col-md-12 mar-t-20 wrap-btn-step">
                        <a href="javascript:void(0)" class="btn btn-red pull-right next-rating" id="next-rating" onclick="inline_poll_next();">Next</a>
                        <a href="javascript:void(0)" class="btn btn-back pull-right back-rating" id="back-poll-form">Back</a> 
                    </div>
                </form>
            </div>
        </div> 

    </div>
    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $this->load->view('template/right_sidebar', $right_bar, true); ?>
    </div>

</div>


</div>

</div>
<!--end tab panel -->
</div>
<!-- tab content -->
</div>
<!-- end row -->

<script>
    $(document).ready(function() {
        loadpoll();
        var count = 1;
        $("#inline_add_more").click(function() {
            count++;
            $("#inline_more_option").append('<a class="remove_img fa fa-remove pull-right" href="javascript:void(0);" id="' + count + '" style="margin-top: -8px; margin-right: -5px; color: red;"><a><div class="panel panel-default mar-b-10" id="rem_' + count + '"><div class="panel-body-discuss panel-body"><div class="panel-content col-md-12 no-padding"><input type="text" placeholder="Enter poll option..." class="inline_option title-discuss-input" name="option" id="option"><span class="inline_option_count pull-right char-length" id="inline_option_count">150</span></div></div></div>');
        });
    });
    function loadpoll() {
        $.ajax({
            url: base_url + "public/poll/poll-listing",
            data: {
                row: 0, rowperpage: 5,
            },
            type: 'POST',
            dataType: 'HTML',
            beforeSend: function(xhr) {
                $("#all-poll").html('<div style="text-align: center; padding-top: 80px"><img src="' + base_url + 'assets/public/img/ajax-loader.gif" /></div>');
            },
            success: function(data, textStatus, jqXHR) {
                $("#all-poll").html(data);
                var allcount = Number($('#total_groups').val());
                if (5 >= allcount) {
                    // Change the text and background
                    $('.load-more-poll').hide();
                } else {
                    $('.load-more-poll').show();
                    $(".load-more-poll").text("Load More Poll");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#all-poll").html('<div style="text-align: center; padding-top: 80px">Error while loading Poll list.</div>');
            }
        })
    }
    $('.load-more-poll').click(function() { 
        var row = Number($('#row').val());
        var allcount = Number($('#total_groups').val());
        var rowperpage = 5;
        row = row + rowperpage;

        if (row <= allcount) {
            $("#row").val(row);

            $.ajax({
                url: base_url + "public/poll/poll-listing",
                type: 'post',
                data: {row: row, rowperpage: rowperpage},
                beforeSend: function() {
                    $(".load-more-poll").text("Loading...");
                },
                success: function(response) {

                    $(".all-poll:last").after(response).show().fadeIn("slow");
                    var rowno = row + rowperpage;
                    if (rowno > allcount) {

                        $('.load-more-poll').hide();
                    } else {
                        $('.load-more-poll').show();
                        $(".load-more-poll").text("Load More Poll");

                    }

                }
            });
        } else {
            $('.load-more-poll').show();
            $('.load-more-poll').text("Loading...");

            $("#row").val(0);

            $('.load-more-poll').text("Load More Poll");



        }

    });
    function author_link($lnk, $txtbox) {
        if ($lnk == "fb") {
            document.getElementById($txtbox).value = "http://facebook.com/";
        }
        if ($lnk == "tt") {
            document.getElementById($txtbox).value = "https://twitter.com/";
        }
        if ($lnk == "ig") {
            document.getElementById($txtbox).value = "https://www.instagram.com";
        }
    }
    $(".choose-rating").click(function() {

        $(".create-disc-cont").slideUp();
        $(".inline-poll-upload").slideDown();
    })


    function inline_poll_next() {
        var question = $('#inline_question').val();
        var discription = $('#inline_discription').val();
        var title = $('#inline_title').val();
//    var category = $("#poll_cat_list .pic_category:checked").val();
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
//            'category': category,
                'answers': answers,
                'creditChk': creditChk,
                'credit': credit,
                'author': author,
                'spoiler': spoiler
            },
            success: function(data) {
                if (data.success == true) {
//                $('#inline_first_poll_alert').hide();
                    $(".inline-poll-upload").slideUp();
                    $(".inline-upload-category-poll").slideDown();
                    $.ajax({
                        url: base_url + 'public/home/last_anime_save',
                        type: 'POST',
                        data: {
                            'title': title,
                            'question': question,
                            'discription': discription,
//                        'category': category,
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
                                var text = '<a href="' + base_url + 'poll" class="text-success"> click here</a>';
                                new PNotify({
                                    title: 'Poll Upload',
                                    text: 'Poll Upload Successfully. For show ' + text,
                                    type: 'success'
                                });
                            } else if (data.result == "error") {
                                $(document).scrollTop($('#poll').offset().top);
//                            $('#inline_first_poll_alert').show();
//                            $('#inline_first_poll_alert').html('<strong>' + data.msg + '</strong>');
                            }
                        }
                    });
                } else {
                    $(document).scrollTop($('#poll').offset().top);
                    $('#inline_error_title').html(data.title);
                    $('#inline_error_question').html(data.question);
                    $('#inline_error_option').html(data.option);
                    $('#inline_error_discription').html(data.discription);
                    $('#inline_error_credit').html(data.author);
                    $('#inline_error_credit').html(data.credit);
//                $('#inline_first_poll_alert').show();
//                $('#inline_first_poll_alert').html('<strong>' + data.msg + '</strong>');

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
    $("#back-poll-form").click(function() {
        $(".create-disc-cont").slideDown();
        $(".inline-poll-upload").slideUp();
    })
</script>



