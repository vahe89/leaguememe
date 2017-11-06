 
<style>
    .morefun{
        width: 100%; 
        padding: 0px; 
        line-height: 65px;
        height: 62px;
        font-size: 18px;
        margin: 0px;
        box-shadow: none; 
        background-color: rgb(0, 153, 255);
        border-color: rgb(0, 153, 255);
        color:white;
    }
</style>
<?php
echo $this->load->view('template/sidebar_list');
$tab_sidebar = $this->load->view('template/right_sidebar', array(), true);
?>
<?php
$message = $this->session->flashdata('message');
if ($message != '') {

    if ($message === "regis_false") {
        ?>
        <center>
            <div class="alert alert-danger alert-dismissable" style="width: 40%">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>
                <strong>
                    <?php echo "Registration is not successfull"; ?>
                </strong>
            </div>
        </center>
        <?php
    } else {
        ?>
        <center>
            <div class="alert alert-success alert-dismissable" style="width: 40%">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>
                <strong>
                    <?php echo $message; ?>
                </strong>
            </div>
        </center>
        <?php
    }
}
?> 
<?php $this->load->view("middle-uploader"); ?>
<div  role="tabpanel" class="tab-pane right-panel-sec"  id="discussion"> 
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active">
            <div class="col-md-7 outer-discussion"  >
                <ul id="disc-tabs" class="nav pop-tabs" role="tablist" style="margin-top: 10px;">
                    <li role="presentation" class="mar-rm-5" data-name="fav">
                        <a href="#all-discussion" role="tab" data-toggle="tab" aria-controls="pinned"><i class="fa fa-bookmark" style="margin-top:5px"></i></a>
                    </li>
                    <li role="presentation" class="active" data-name="popular">
                        <a href="#all-discussion" role="tab" data-toggle="tab" aria-controls="popular-discussion" aria-expanded="true">Popular</a>
                    </li>
                    <li role="presentation" class="mar-lm-5" data-name="new">
                        <a href="#all-discussion" role="tab" data-toggle="tab" aria-controls="news-disc">News</a>
                    </li>
                </ul>

                <div  id="all-discussion" >
                    <div style="text-align: center; padding-top: 50px">
                        <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" />
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
                <?= $tab_sidebar ?>
            </div>
        </div>

    </div>
</div>
<div  role="tabpanel" class="tab-pane right-panel-sec"  id="news-outer"> 
    News Outer
</div>
<div  role="tabpanel" class="tab-pane right-panel-sec"  id="gameChat">
    <div class="col-md-7 col-xs-12 col-sm-12 main-content">

    </div>
    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $tab_sidebar ?>
    </div>
</div>
<div  role="tabpanel" class="tab-pane right-panel-sec upload-page "  id="event">

    <div class="col-md-7 col-xs-12 col-sm-12 main-content">

    </div>
    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $tab_sidebar ?>
    </div>

</div>
<div  role="tabpanel" class="tab-pane right-panel-sec"  id="poll"> 
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active">
            <div class="col-md-7 outer-discussion"  >


                <div  id="all-poll" >
                    <div style="text-align: center; padding-top: 50px">
                        <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" />
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
                <?= $tab_sidebar ?>
            </div>
        </div>

    </div>
</div>
<div  role="tabpanel" class="tab-pane right-panel-sec active" id="moment"> 
    <div class="col-md-7 col-xs-12 col-sm-12 main-content">

        <!-- tab -->

        <div class="col-md-8 no-padding">
            <ul id="pop" class="nav pop-tabs" role="tablist" style="margin-top:10px;">
                <li role="presentation" style="margin-left: 0px; margin-right: -5px;" class="tabs">
                    <a href="#bookmarks" id="bookmarks" role="tab" data-toggle="tab" aria-controls="bookmarks">
                        <i class="fa fa-bookmark" style="margin-top:5px;"></i>
                    </a>
                </li>
                <li role="presentation" class="tabs">
                    <a href="#newTab" id="popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
                </li>
                <li role="presentation" class="mar-lm-5 tabs">
                    <a href="#newTab" id="new" role="tab" data-toggle="tab" aria-controls="news">New</a>
                </li>
            </ul>
        </div>

        <div class="col-md-4">
            <div class="trolls" style="margin-top: 20px;">
                <a href="#" class="btn dropdown-toggle" id="allThings" type="button" data-toggle="dropdown">
                    <span class="linky"><b id="freshVal">All The Things</b></span>
                    <span>&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets/public/img/icon/post/dropdown-red.png"></span>
                </a>
                <ul class="dropdown-menu" id="subTabData" role="menu" aria-labelledby="allThings">

                </ul>
            </div>
        </div>

        <div id="popContent" class="tab-content">
            <!-- popular-->
            <div role="tabpanel" class="tab-pane fade in active" id="newTab">
                <div id="animation_image" style="display: none;margin-right: auto;margin-left: auto;" align="center">
                    <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
                </div>
                <div id="league_list_home">

                </div>
                <div id="morefun" style="display: none">
                    <form method="POST" id="morefun1" >
                        <!--<a class="btn morefun" >I want more fun</a>-->
                        <input type="hidden" name="orderid" value="<?php echo isset($orderid) ? $orderid : '0'; ?>" id="orderid">
                        <input type="hidden" value="<?php echo!empty($pagetrackid) ? $pagetrackid + 1 : '1'; ?>" name="pagetrackid" id="pagetrackid">
                        <input type="hidden" value="<?php echo!empty($maintabval) ? $maintabval : 'popular'; ?>" name="mainTabval" id="mainTabval">
                        <input type="hidden" value="<?php echo!empty($subtabval) ? $subtabval : 'All the Things'; ?>" name="subTabval" id="subTabval">
                        <input type="hidden" value="<?php echo!empty($animename1) ? $animename1 : '0'; ?>" name="anime_name" id="anime_name">
                        <button type="submit" class="btn morefun">I want more fun</button>
                    </form>
                </div>
                <div class="animation_image" style="display: none;margin-right: auto;margin-left: auto;" align="center">
                    <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
                </div>
            </div>

        </div>


    </div>

    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $tab_sidebar ?>
    </div>
    <!--end ads--> 
</div>
<div class="upload-page right-panel-sec tab-pane" id="uploadOnePiece" >
    <div class="col-md-7 col-xs-12 col-sm-12 main-content">
        <div class="inline_upload">
            <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Pictures & Album </h2>
            <hr/>
            <p class="grey-color-xs">Choose how you want to upload</p>
            <div id="inline-upload-error" style="display: none" class="text-center alert alert-danger"></div>
            <div id="inline-upload-success" style="display: none" class="text-center alert alert-success"></div>
            <div class="upload-top">
                <!--upload image-->
                <form action="#" id="uploadform-inline" class="dropzone">
                    <a href="javascript:void(0)" class="choose-image">
                        <div class="upload-image panel panel-default">
                            <div class="panel-body"> <img src="<?php echo base_url(); ?>assets/public/img/upload-image.png"> </div>
                            <div class="panel-title"> <span>Choose or drag picture here</span> </div>
                        </div>
                    </a>
                </form>
                <div class="col-sm-12">
                    <div id="inline_wait" style="display:none;width:69px;height:89px;margin-left:43%;margin-top: -118px;"><img
                            src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif' width="64"
                            height="64"/><br><strong class="text">Uploading...</strong></div>
                </div>
                <div id="inline-album" style="display: none" class="text-center alert alert-danger"></div>
                <!--upload discussion-->
                <form method="POST"  name="inline_album_form" id="inline_album_form" enctype='multipart/form-data'>
                    <input type="file" class="hidden" id="uploadinlinealbum" name="userfile[]" multiple="" accept="image/*" style="display:none" /> 
                    <a href="javascript:void(0)" class="inline_choose-album">
                        <div class="upload-image panel panel-default">
                            <div class="panel-body"> <img src="<?= base_url() ?>assets/public/img/add-album.png"> </div>
                            <div class="panel-title"> <span>Add Album</span> </div>
                        </div>
                    </a>

                </form>
                <div class="col-sm-12">
                    <div class="inline_waitalbum" style="display:none;width:69px;height:89px;margin-left:43%;margin-top: -118px;"><img
                            src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif' width="64"
                            height="64"/><br><strong class="text">Uploading...</strong></div>
                </div>
            </div>
        </div>

        <div class="inline_image_upload image-upload" style="display: none">
            <div class="modal-header bor-none">
                <h2 class="modal-title-upload mar-t-0" id="myModalLabel">Pictures </h2>
                <hr/>
                <p class="grey-color-xs img-subtitle">Every question asked must be related to One Piece</p>
                <div id="inline_image_upload_error" style="display: none" class="text-center alert alert-danger"></div>
                <div class="panel panel-default bor-radius-0">
                    <div class="panel-body">
                        <div class="panel-content col-md-12 no-padding">
                            <a href="javascript:void(0)">
                                <div class="img-panel">
                                    <img id="inline_img" src="" style="height: 100%;width: 100%">
                                </div>
                            </a>
                            <input type="text" placeholder="Title" class="title-img-upload" id="inline_upload_title" maxlength="150">
                            <div class="pull-right count-right">
                                <span id="inline_anime_count">150</span>
                            </div>
                            <input type="hidden" name="inline_anime_upload_image" id="inline_anime_upload_image" />
                            <textarea placeholder="Describe your post with tags!" id="inline_tag" class="txt-area-tags" onkeypress="handle_inline(event);"></textarea>
                            <p id="inline_tag1" style="margin-top:10px"></p>                                    
                            <textarea style="display: none" class="form-control desc" id="inline_tag2"  rows="2" ></textarea>
                        </div>
                    </div>
                    <div class="wrap-filter-post">
                        This Post Not safe For Work
                        <input type="checkbox" name="option" id="inline_check1" style="display: none" checked/>
                        <label for="inline_check1">
                            <span class="fa-stack">
                                <i class="fa fa-square-o fa-stack-1x"></i>
                                <i class="fa fa-check fa-stack-1x"></i>
                            </span>
                        </label>
                    </div>
                    <div class="wrap-filter-post">
                        Add spoiler tag
                        <input type="checkbox" name="option" id="inline_check2" style="display: none" checked/>
                        <label for="inline_check2">
                            <span class="fa-stack">
                                <i class="fa fa-square-o fa-stack-1x"></i>
                                <i class="fa fa-check fa-stack-1x"></i>
                            </span>
                        </label>
                    </div>
                    <div class="wrap-filter-post">
                        Credit the author
                        <input type="checkbox" name="option" id="author_credit_check" style="display: none" value="credit" checked/>
                        <label for="author_credit_check">
                            <span class="fa-stack">
                                <i class="fa fa-square-o fa-stack-1x"></i>
                                <i class="fa fa-check fa-stack-1x"></i>
                            </span>
                        </label>
                    </div>

                    <div class="credit">
                        <div class="socmed-credit">
                            <img src="<?= base_url() ?>assets/public/img/fb-credit.png" onclick="author_link('fb', 'inline_author')">
                            <img src="<?= base_url() ?>assets/public/img/tt-credit.png" onclick="author_link('tt', 'inline_author')">
                            <img src="<?= base_url() ?>assets/public/img/ig-credit.png" onclick="author_link('ig', 'inline_author')">
                        </div>
                        <div class="name-author">
                            <input type="text" placeholder="Name of Creditor" id="inline_credit">
                            <input type="text" placeholder="http://" id="inline_author">
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                    Pick a selection<span class="caret"></span>
                </a>
                <ul class="dropdown-menu genre" id="inline_category_list">

                </ul>
                <div class="col-md-12 wrap-btn-step no-padding">
                    <a href="javascript:void(0)" class="btn btn-red pull-right" onclick="inline_next_page()" id="next-image">Next</a>
                    <a href="javascript:void(0)" class="btn btn-back pull-right back-image">Back</a>
                </div>
            </div>
        </div> 


        <div class="inline_album_upload image-upload" style="display: none">
            <div class="modal-header bor-none">
                <h2 class="modal-title-upload" id="myModalLabel">Album </h2>
                <hr/>
                <p class="grey-color-xs img-subtitle">Choose how you want to upload</p>
                <div id="inline_album_alert" class="text-center alert alert-danger" style="display: none"></div>

                <form id="inline_albumform" action="#" method="post">
                    <div class="panel panel-default">
                        <div class="panel-body-discuss panel-body">
                            <div class="panel-content col-md-12 no-padding">
                                <input id="inline_main_title"  type="text" placeholder="Give a Title Here..." class="title-discuss-input"> 
                                <span id="inline_albumanime_count" class="pull-right char-length">150</span> </div>
                        </div>
                    </div>

                    <!-- END PANEL -->
                    <div id="inline_albumarea" ></div>

                    <a href="javascript:void(0)" class="wrap-add-album" id="add_more_inline_album">
                        <i class="fa fa-plus-circle" ></i>
                        <span>Add another one (select multiple image by holding CTRL)</span>
                    </a>
                    <div class="col-sm-12">
                        <div class="inline_waitalbum" style="display:none;width:69px;height:89px;margin-left:43%;margin-top: -118px;"><img
                                src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif' width="64"
                                height="64"/><br><strong class="text">Uploading...</strong></div>
                    </div>

                    <br/><br/>

                    <div class="panel panel-default panel-checkbox">
                        <div class="wrap-filter-post">
                            This Post Not safe For Work
                            <input type="checkbox"   id="inline_not_safe" value="1"  checked style="display: none"/>
                            <label for="inline_not_safe">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                            </label>
                        </div>
                        <div class="wrap-filter-post">
                            Add spoiler tag
                            <input type="checkbox"   id="inline_spoiler" value="1" checked style="display: none"/>
                            <label for="inline_spoiler">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                            </label>
                        </div>
                        <div class="wrap-filter-post">
                            Credit the author
                            <input type="checkbox"  id="inline_credit_check" value="credit" checked style="display: none"/>
                            <label for="inline_credit_check">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                            </label>
                        </div>

                        <div class="credit">
                            <div class="socmed-credit">
                                <img src="<?= base_url() ?>assets/public/img/fb-credit.png" onclick="author_link('fb', 'inline_album_author')">
                                <img src="<?= base_url() ?>assets/public/img/tt-credit.png" onclick="author_link('tt', 'inline_album_author')">
                                <img src="<?= base_url() ?>assets/public/img/ig-credit.png" onclick="author_link('ig', 'inline_album_author')">
                            </div>
                            <div class="name-author">
                                <input type="text" id="inline_album_credit" placeholder="Name of Creditor">
                                <input type="text" id="inline_album_author" placeholder="http://">
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        Pick a selection<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu genre" id="inline_category_list_album" style="top:initial">

                    </ul>
                    <div class="col-md-12 wrap-btn-step no-padding">
                        <input type="submit" name="g" class="btn btn-red pull-right" value="Next" id="next-album">
                        <a href="javascript:void(0)" class="btn btn-back pull-right" id="inline_back-album">Back</a>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $tab_sidebar ?>
    </div>
</div>
<div class="upload-page right-panel-sec tab-pane " id="upload-discussion-tab" >

    <div class="col-md-7 col-xs-12 col-sm-12 main-content">

        <div class="inline_upload  create-disc-cont">
            <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Discussion Board</h2>
            <hr>
            <p class="grey-color-xs">Everything discussed must be related to One Piece</p>
            <div id="inline_discussupload_alert" style="display: none" class="text-center alert alert-danger"></div>
            <div id="inline_discussupload_alert_success" style="display: none" class="text-center alert alert-success"></div>
            <div class="upload-top">
                <!--upload image-->
                <form action="#" id="inline_upload_discussion" class="dropzone">
                    <a href="#" class="choose-discuss">
                        <div class="upload-image panel panel-default">
                            <div class="panel-body"> <img src="<?= base_url() ?>assets/public/img/upload-discussion.png"> </div>
                            <div class="panel-title"> <span>Choose or drag files discussion here</span> </div>
                        </div>
                    </a>
                </form>
                <div class="col-sm-12">
                    <div id="inline_wait_discussion" style="display:none;width:69px;height:89px;margin-left:43%;margin-top: -118px;">
                        <img  src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif' width="64" height="64"/><br><strong class="text">Uploading...</strong>
                    </div>
                </div>

            </div>
        </div>

        <div class="inline-discuss-upload image-upload" style="display: none">
            <div class="modal-header bor-none">
                <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Create a discussion thread</h2>
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
                        <input name="option"  style="display: none;" id="inline_discussioncheck"checked="" type="checkbox">
                        <label for="inline_discussioncheck">
                            <span class="fa-stack">
                                <i class="fa fa-square-o fa-stack-1x"></i>
                                <i class="fa fa-check fa-stack-1x"></i>
                            </span>
                        </label>
                    </div>
                    <div class="wrap-filter-post">
                        Credit the author
                        <input name="option" style="display: none;" id="inline_creditcheck_disc" value="credit" checked="" type="checkbox">
                        <label for="inline_creditcheck_disc">
                            <span class="fa-stack">
                                <i class="fa fa-square-o fa-stack-1x"></i>
                                <i class="fa fa-check fa-stack-1x"></i>
                            </span>
                        </label>
                    </div>

                    <div class="credit">
                        <div class="socmed-credit">
                            <img src="<?php echo base_url(); ?>assets/public/img/fb-credit.png" onclick="author_link('fb', 'inline_disc_creditor_site')">
                            <img src="<?php echo base_url(); ?>assets/public/img/tt-credit.png" onclick="author_link('tt', 'inline_disc_creditor_site')">
                            <img src="<?php echo base_url(); ?>assets/public/img/ig-credit.png" onclick="author_link('ig', 'inline_disc_creditor_site')">
                        </div>
                        <div class="name-author">
                            <input type="text" placeholder="Name of Creditor" id="inline_disc_creditor_author" >
                            <input type="text" placeholder="http://" id="inline_disc_creditor_site"  name="author" >
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                    Pick a selection<span class="caret"></span>
                </a>
                <ul class="dropdown-menu genre" id="inline_discuusioncategory_list">

                </ul>
                <div class="col-md-12 wrap-btn-step">
                    <a href="javascript:void(0);" class="btn btn-red pull-right" onclick="inline_discussion_next();">Next</a>
                    <a href="javascript:void(0);" class="btn btn-back pull-right" id="inline_back-discuss">Back</a>
                </div>
            </div>
        </div> 




    </div>

    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $tab_sidebar ?>
    </div>

</div>
<div class="upload-page right-panel-sec tab-pane" id="uploadGamechat" >
    <div class="col-md-7 main-content">
        <!-- dialogue-upload -->
        <div class="dialogue-upload" style="display: block;">
            <div class="modal-header bor-none">
                <h3 class="league-dialogue">
                    LEAGUE DIALOGUE
                </h3>
                <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Give your post a Title</h2>
                <hr/>
                <p class="grey-color-xs img-subtitle">Had a funny conversation with someone in game? POST IT HERE!</p>

                <!--                <div class="panel panel-default bor-radius-0">
                                    <div class="panel-body">
                                        <div class="panel-content col-md-12 no-padding">
                                            <a href="">
                                                <div class="img-panel">
                                                    <img src="assets/img/luffy.png">
                                                </div>
                                            </a>
                                            <div class="title-dialogue">
                                                <select>
                                                    <option value="volvo">Here a title</option>
                                                    <option value="saab">lalalala</option>
                                                    <option value="mercedes">Medusa got a rampage</option>
                                                    <option value="audi">Anti Mage teach</option>
                                                </select>
                                                <hr>
                                                <textarea placeholder="Dialogue" maxlength="150">Dialogue</textarea>
                                            </div>
                                            <div class="count-right">
                                                <span>150</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="panel-content col-md-12 no-padding">
                                            <a href="">
                                                <div class="img-panel">
                                                    <img src="assets/img/luffy.png">
                                                </div>
                                            </a>
                                            <div class="title-dialogue">
                                                <select>
                                                    <option value="volvo">Here a title</option>
                                                    <option value="saab">lalalala</option>
                                                    <option value="mercedes">Medusa got a rampage</option>
                                                    <option value="audi">Anti Mage teach</option>
                                                </select>
                                                <hr>
                                                <textarea placeholder="Dialogue" maxlength="150">Dialogue</textarea>
                                            </div>
                                            <div class="count-right">
                                                <span>150</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="panel-content col-md-12 no-padding">
                                            <a href="">
                                                <div class="img-panel">
                                                    <img src="assets/img/luffy.png">
                                                </div>
                                            </a>
                                            <div class="title-dialogue">
                                                <select>
                                                    <option value="volvo">Here a title</option>
                                                    <option value="saab">lalalala</option>
                                                    <option value="mercedes">Medusa got a rampage</option>
                                                    <option value="audi">Anti Mage teach</option>
                                                </select>
                                                <hr>
                                                <textarea placeholder="Dialogue" maxlength="150">Dialogue</textarea>
                                            </div>
                                            <div class="count-right">
                                                <span>150</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                <!--end panel -->
                <div class="wrap-filter-post">
                    <a href="javascript:void(0)"> <i class="fa fa-plus-circle"></i> &nbsp; Add another one</a>
                </div>
                <div class="col-md-12 wrap-btn-step">
                    <a href="javascript:void(0)" class="btn btn-red pull-right" id="next-image">Next</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $tab_sidebar ?>
    </div>
</div>
<div class="upload-page right-panel-sec tab-pane " id="upload-poll-tab" >

    <div class="col-md-7 col-xs-12 col-sm-12 main-content">
        <div class="upload create-disc-cont">
            <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Poll</h2>
            <hr>
            <p class="grey-color-xs">Every created poll must be related to One Piece</p>

            <div class="upload-top"> 

                <!--upload discussion-->
                <a href="javascript:void(0)" class="choose-rating">
                    <div class="upload-image panel panel-default">
                        <div class="panel-body"> <img src="<?= base_url() ?>assets/public/img/rating.png"> </div>
                        <div class="panel-title"> <span>Make a poll</span> </div>
                    </div>
                </a>
            </div>
        </div>




        <div class="inline-poll-upload image-upload" style="display: none">
            <div class="modal-header bor-none">
                <h2 class="modal-title-upload" id="myModalLabel"> Poll > One Piece</h2>
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
                            <input type="checkbox" name="inlne_poll_spoiler" style="display: none" id="inlne_poll_spoiler" checked/>
                            <label for="inlne_poll_spoiler">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                            </label>
                        </div>
                        <div class="wrap-filter-post">
                            Credit the author
                            <input type="checkbox" name="credit_author" style="display: none" id="credit_author" value="credit" checked/>
                            <label for="credit_author">
                                <span class="fa-stack">
                                    <i class="fa fa-square-o fa-stack-1x"></i>
                                    <i class="fa fa-check fa-stack-1x"></i>
                                </span>
                            </label>
                        </div>

                        <div class="credit">
                            <div class="socmed-credit">
                                <img src="<?= base_url() ?>assets/public/img/fb-credit.png" onclick="author_link('fb', 'inline_poll_author')">
                                <img src="<?= base_url() ?>assets/public/img/tt-credit.png" onclick="author_link('tt', 'inline_poll_author')">
                                <img src="<?= base_url() ?>assets/public/img/ig-credit.png" onclick="author_link('ig', 'inline_poll_author')">
                            </div>
                            <div class="name-author">
                                <input type="text" id="inline_poll_credit" name="author" placeholder="Name of Creditor">
                                <input type="text" id="inline_poll_author" name="credit" placeholder="http://">
                            </div>
                        </div>
                        <span id="inline_error_credit" class="help-inline error-red" style="margin-top: -5px;"></span>
                    </div>
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        Pick a selection<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu genre" id="poll_cat_list">

                    </ul>
                    <div class="col-md-12 mar-t-20 wrap-btn-step">
                        <a href="javascript:void(0)" class="btn btn-red pull-right next-rating" id="next-rating" onclick="inline_poll_next();">Next</a>
                        <a href="javascript:void(0)" class="btn btn-back pull-right back-rating" id="back-poll-form">Back</a> 
                    </div>
                </form>
            </div>
        </div> 

    </div>

    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $tab_sidebar ?>
    </div>

</div>
</div>

</div>
<!--end tab panel -->
</div>
<!-- tab content -->
</div>
<!-- end row -->

<script src="<?php echo base_url(); ?>assets/public/js/league.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/public/js/index.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/inline_discussion.js" type="text/javascript"></script>
<script>
                            $(document).ready(function() {
                                var myDropzoneInline = new Dropzone("#uploadform-inline");
                                /***************************/
                                /* Inline Add Picture start*/
                                myDropzoneInline.on("addedfile", function(file) {

                                    var formData = new FormData();
                                    formData.append('file', file);
                                    $("#inline-upload-error").hide();
                                    $("#inline_anime_upload_image").val('');
                                    $("#inline_tag").val('');
                                    $("#inline_upload_title").val('');
                                    $("#inline_credit").val('');
                                    $("#inline_author").val('');
                                    $("#inline_check1").attr('checked', false);
                                    $("#inline_check2").attr('checked', false);
                                    $("#author_check").attr('checked', false);
                                    $(document).ajaxStart(function() {
                                        $("#inline_wait").css("display", "block");
                                    });
                                    $(document).ajaxComplete(function() {
                                        $("#inline_wait").css("display", "none");
                                    });

                                    $.ajax({
                                        url: base_url + "public/home/upload/",
                                        type: "POST",
                                        data: formData,
                                        async: false,
                                        dataType: 'json',
                                        success: function(msg) {
                                            if (msg.result == "success") {

                                                $("#inline_wait").slideUp();
                                                $("#inline_img").attr('src', base_url + 'uploads/dump/' + msg.name);
                                                $("#inline_anime_upload_image").val(msg.name);
                                                $(".inline_upload").slideUp();
                                                $('.inline_image_upload').slideDown();
                                                $.ajax({
                                                    type: "POST",
                                                    url: base_url + 'public/home/get_image_upload_category',
                                                    data: {
                                                        type: 'in_image'
                                                    },
                                                    success: function(msg) {
                                                        $('#inline_category_list').html(msg);
                                                    }
                                                });
                                            } else if (msg.result == "error") {
                                                $("#inline-upload-error").show();
                                                $("#inline-upload-error").html('<strong>' + msg.msg + '</strong>');
                                            }
                                        },
                                        cache: false,
                                        contentType: false,
                                        processData: false
                                    });
                                    this.removeFile(file);
                                });
                            });

</script>


