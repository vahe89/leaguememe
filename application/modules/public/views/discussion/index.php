
<?php
$class = $this->router->fetch_class();
$method = $this->router->fetch_method();
echo $this->load->view('template/sidebar_list'); 
?>  

<div  role="tabpanel" class="tab-pane right-panel-sec pad-left active"  id="discussion">  
    <div class="col-md-7 col-xs-12 col-sm-12 main-content outer-discussion"  >
        <div id="outer-discussion">
            <ul id="disc-tabs" class="nav pop-tabs" role="tablist" style="margin-top: 10px;">
                <li role="presentation"  style="margin-left: 0px; margin-right: -5px;" class="<?= $method == "fav" ? 'active' : '' ?>"  >
                    <a href="<?= base_url() ?>discussion/fav"><i class="fa fa-bookmark" style="margin-top:5px"></i></a>
                </li> 
                <li role="presentation" class="<?= $method == "index" ? 'active' : '' ?>" >
                    <a href="<?= base_url() ?>discussion">Discussion</a>
                </li>
            </ul>

            <div  id="popular-discussion" >
                <?php echo $content_content;?>
                <div style="text-align: center; padding-top: 50px; display:none;">
                    <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" />
                </div>
            </div>
            <div class="text-center">
                <?php if($existing_count > 10){?>
                <span class="load-more-discussion btn btn-red" style="width:50%;" id="load-more-discussion">Load More Discussion</span>
<?php } ?>
            </div>
            <input type="hidden" id="discussion_row" value="<?php echo $row ?>">
        </div>
        <div class="inline_upload  create-disc-cont" id="upload-discussion-tab" style="display: none">
            <h1 class="modal-title-upload mar-t-20" style="font-size:20px">Discussion Board</h1>
            <hr>
            <p class="grey-color-xs">Everything discussed must be related to One Piece</p>
            <div id="inline_discussupload_alert" style="display: none" class="text-center alert alert-danger"></div>
            <div id="inline_discussupload_alert_success" style="display: none" class="text-center alert alert-success"></div>
            <div class="upload-top"> 
                <a href="javascript:void(0)" class="choose-discuss">
                    <div class="upload-image panel panel-default">
                        <div class="panel-body"> <img src="<?= base_url() ?>assets/public/img/upload-discussion.png"> </div>
                        <div class="panel-title"> <span>Choose or drag files discussion here</span> </div>
                    </div>
                </a>
                <div class="col-sm-12">
                    <div id="inline_wait_discussion" style="display:none;width:69px;height:89px;margin-left:43%;margin-top: -118px;">
                        <img  src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif' width="64" height="64"/><br><strong class="text">Uploading...</strong>
                    </div>
                </div>

            </div>
        </div>
        <div class="inline-discuss-upload image-upload" style="display: none; margin-left: -20px; margin-top: -20px;" id="inline-discuss-upload">
            <div class="modal-header bor-none">
                <h1 class="modal-title-upload mar-t-20" id="myModalLabel" style="font-size: 20px">Create a discussion thread</h1>
                <hr>
                <p class="grey-color-xs">Have a question or anything you want to discuss?</p>
                <div id="inline_discussionalert" style="display: none" class="text-center alert alert-danger"></div>
                <div class="panel panel-default">
                    <div class="panel-body-discuss panel-body">
                        <div class="panel-content col-md-12 no-padding">
                            <input placeholder="Give Title Here..." class="title-discuss-input" type="text"  id="inline_discussion_count">
                            <span class="pull-right char-length" id="inline_di_count_span">150</span> </div>
                    </div>
                </div>
                <!--end panel -->
                <input type="hidden" id="inline_discussion_file">
                <div class="panel panel-default panel-discuss-editor">
                    <textarea id="inline_discussion_count_desc"  placeholder="Describe your post" class="title-discuss-upload"></textarea>
                    <span id="inline_dis_desc_span" class="char-length-editor">250</span>
                </div>
                <!--end panel -->

                <div class="panel panel-default panel-discuss-check">
                    <div class="wrap-filter-post">
                        Add spoiler tag
                        <input name="option"  style="display: none;" id="inline_discussioncheck"  type="checkbox">
                        <label for="inline_discussioncheck">
                            <span class="fa-stack">
                                <i class="fa fa-square-o fa-stack-1x"></i>
                                <i class="fa fa-check fa-stack-1x"></i>
                            </span>
                        </label>
                    </div>
                    <div class="wrap-filter-post">
                        Credit the author
                        <input name="option" style="display: none;" id="inline_creditcheck_disc" class="only_credit" value="inline_creditcheck_disc"  type="checkbox">
                        <label for="inline_creditcheck_disc">
                            <span class="fa-stack">
                                <i class="fa fa-square-o fa-stack-1x"></i>
                                <i class="fa fa-check fa-stack-1x"></i>
                            </span>
                        </label>
                    </div>

                    <div class="credit inline_creditcheck_disc" style="display:none">
                        <div class="socmed-credit">
                            
                        </div>
                        <div class="name-author">
                            <input type="text" placeholder="http://" id="inline_disc_creditor_site"  name="author" readonly="" >
                            <input type="text" placeholder="Name of Creditor" id="inline_disc_creditor_author" >
                        </div>
                    </div>
                </div> 
                <div class="col-md-12 wrap-btn-step">
                    <a href="javascript:void(0);" class="btn btn-red pull-right" onclick="inline_discussion_next();">Next</a>
                    <a href="javascript:void(0);" class="btn btn-back pull-right" id="inline_back-discuss">Back</a>
                </div>
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
    $(function() {
        var lastActivedisctab = "<?= $method ?>";

        if (lastActivedisctab == "index") {
            lastActivedisctab = "new";
        } else {
            lastActivedisctab = lastActivedisctab;
        }
//   loadDisc(lastActivedisctab);
    })
    function loadDisc($tab) {

        $.ajax({
            url: base_url + "public/discussion/discussion_list",
            data: {
                row: 0, rowperpage: 10,
                main: $tab
            },
            type: 'POST',
            dataType: 'HTML',
            beforeSend: function(xhr) {
                $("#popular-discussion").html('<div style="text-align: center; padding-top: 80px"><img src="' + base_url + 'assets/public/img/ajax-loader.gif" /></div>');
            },
            success: function(data, textStatus, jqXHR) {
                $("#popular-discussion").html(data);
                var allcount = Number($('#discussion_total_groups').val());
                if (10 >= allcount) {
                    // Change the text and background
                    $('.load-more-discussion').hide();
                    $('.load-more-discussion').removeAttr("id");
                } else {
                    $('.load-more-discussion').show();
                    $(".load-more-discussion").text("Load More Discussion");
                    $('.load-more-discussion').attr("id", "load-more-discussion");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#popular-discussion").html('<div style="text-align: center; padding-top: 80px">Error while loading discussion.</div>');
            }
        })
    }
    $('#load-more-discussion').click(function() {

        var lastActivedisctab = "<?= $method ?>";
        if (lastActivedisctab == "index") {
            lastActivedisctab = "new";
        } else {
            lastActivedisctab = lastActivedisctab;
        }
        var row = Number($('#discussion_row').val());
        var allcount = Number($('#discussion_total_groups').val());
        var discussion_tab = lastActivedisctab;
        var rowperpage = 10;
        row = row + rowperpage;

        if (row <= allcount) {
            $("#discussion_row").val(row);

            $.ajax({
                url: base_url + "public/discussion/discussion_list",
                type: 'post',
                data: {row: row, rowperpage: rowperpage, main: discussion_tab},
                beforeSend: function() {
                    $(".load-more-discussion").text("Loading...");
                },
                success: function(response) {

                    $(".popular-discussion:last").after(response).show().fadeIn("slow");
                    var rowno = row + rowperpage;
                    if (rowno > allcount) {

                        $('.load-more-discussion').hide();
                        $('.load-more-discussion').removeAttr("id");
                    } else {
                        $('.load-more-discussion').show();
                        $(".load-more-discussion").text("Load More Discussion");
                        $('.load-more-discussion').attr("id", "load-more-discussion");

                    }

                }
            });
        } else {
            $('.load-more-discussion').show();
            $('.load-more-discussion').text("Loading...");
            $('.load-more-discussion').attr("id", "load-more-discussion");

            $("#discussion_row").val(0);

            $('.load-more-discussion').text("Load More Discussion");



        }

    });
    $(".choose-discuss").click(function() {
        $(".create-disc-cont").hide();
        $(".inline-discuss-upload").show();
    })
    function inline_discussion_next() {
        var discussion_desc = tinymce.activeEditor.getContent();
        var discussion_title = $('#inline_discussion_count').val();
        var creditcheck_disc = $("#inline_creditcheck_disc").is(':checked');
        var disc_credit = $("#inline_disc_creditor_site").val();
        var disc_author = $("#inline_disc_creditor_author").val();
//    var category = $("#inline_discuusioncategory_list .pic_category:checked").val();
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
//            category: category,
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
//                        category: category,
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
                                window.location.href = base_url + "discussion";
                            } else if (data.result == "error") {
                                $(document).scrollTop($('#discussion').offset().top);
                                $("#inline_discussionalert").show();
                                $("#inline_discussionalert").html('<strong>' + data.msg + '</strong>');
                            }
                        }
                    });
                } else if (data.result === 'error') {
                    $(document).scrollTop($('#discussion').offset().top);
                    $('#inline_discussionalert').show();
                    $('#inline_discussionalert').html(data.msg);
                }
            }
        });
    }
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
    $("#inline_back-discuss").click(function() {
        $(".inline-discuss-upload").slideUp();
        $(".create-disc-cont").slideDown();
    })
</script>
<!--<script async="" src="<?php echo base_url(); ?>assets/public/js/league.js" type="text/javascript"></script>
<script async="" src="<?php echo base_url(); ?>assets/public/js/news.js" type="text/javascript"></script>-->

<!--<script async="" src="<?php echo base_url(); ?>assets/public/js/index.js" type="text/javascript"></script>-->
<!--<script async="" src="<?php echo base_url(); ?>assets/public/js/inline_discussion.js" type="text/javascript"></script>-->



