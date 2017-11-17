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
  .Ad_google{
            position: relative;
    text-align: center;
    overflow: hidden;
    line-height: 0;
    background: transparent;
    height: auto;
    display: block;
    width: 300px;
    margin: 20px  auto;
    }
</style>
<?php
$class = $this->router->fetch_class();
$method = $this->router->fetch_method();
$category = $this->uri->segment(2);
echo $this->load->view('template/sidebar_list',$sub_items);
?>
<?php
$message = $this->session->flashdata('message');
if ($message != '') { ?>
            
    <?php
    if ($message === "regis_false") {
        ?>
         <div class="modal fade in" id="errormessage" role="dialog" style="display: block; padding-right: 17px;">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                          <h2> Registration  Sucessfull </h2>
                      </div>
                    <form method="post" id="error_message_id" novalidate="novalidate">
                        <div class="modal-body">
                            <?php echo "Registration is not successfull"; ?>
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-green" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         <script>
            $(function () {
                $('#errormessage').modal();
             });   
        </script>
    
        <!--<center>
            <div class="alert alert-danger alert-dismissable" style="width: 40%">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>
                <strong>
                    <?php echo "Registration is not successfull"; ?>
                </strong>
            </div>
        </center> -->
        <?php
    } else if ($message === "Acountactive") {  ?>
        <div class="modal fade in" id="account_active" role="dialog" style="display: block; padding-right: 17px;">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                          <h2>Successful activation</h2>
                      </div>
                    <form method="post" id="account_active_id" novalidate="novalidate">
                        <div class="modal-body">
                           <?php echo "Your acount activated Sucessfully."; ?>
    
                        </div>
                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-green" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     <script>
            $(function () {
                $('#account_active').modal();
             
            });   
        </script> <?php
    }  else {
        ?>
        <div class="modal fade in" id="successmessage" role="dialog" style="display: block; padding-right: 17px;">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                          <h2> Registration  Sucessfull </h2>
                      </div>
                    <form method="post" id="success_message_id" novalidate="novalidate">
                        <div class="modal-body">
                           <?php echo $message; ?>
    
                        </div>
                        <div class="modal-footer">
                          
                            <button type="button" class="btn btn-green" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     <script>
            $(function () {
                $('#successmessage').modal();
            });   
        </script>
        <!--
        <center>
            <div class="alert alert-success alert-dismissable" style="width: 40%">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button>
                <strong>
                    <?php echo $message; ?>
                </strong>
            </div>
        </center> -->
        <?php
    }
}else {
?>
   
    <?php
}
?>  
<?php if ($class == "home" || $class == "leaguelist") { ?>
    <div  role="tabpanel" class="tab-pane right-panel-sec pad-left active" id="moment"> 
        <div class="upload-page col-md-7 col-xs-12 col-sm-12 main-content">

            <div id="outer-moment">
                 <?php if ($method == "index") {
                        ?>
                        <div class="col-md-8 no-padding">
                            <ul id="popa" class="nav pop-tabs" role="tablist" style="margin-top:10px;">

                                <li role="presentation" style="margin-left: 0px; margin-right: -5px;" class="<?= $maintabval == "fav" ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>bookmark/<?= !empty($subtabval) ? strtolower($subtabval) : 'all'; ?>"   id="bookmarks"  >
                                        <i class="fa fa-bookmark" style="margin-top:5px;"></i>
                                    </a>
                                </li>
                                <?php if ($subtabval == "Art") { ?>
                                    <li role="presentation" class="mar-lm-5 <?= $maintabval == "new" ? 'active' : '' ?> ">
                                        <a   href="<?= base_url() ?>new/<?= !empty($subtabval) ? strtolower($subtabval) : 'all'; ?>" id="new" >Art/Cosplay</a>
                                    </li>
                                <?php } else if ($subtabval == "gifs" || $subtabval == "Video") {
                                    ?>
                                    <li role="presentation" class="mar-lm-5 <?= $maintabval == "new" ? 'active' : '' ?> ">
                                        <a   href="<?= base_url() ?>new/<?= !empty($subtabval) ? strtolower($subtabval) : 'all'; ?>" id="new" ><?= ucfirst($subtabval) ?></a>
                                    </li>
                                <?php } else if ($subtabval == "random") {
                                    ?>
                                    <li role="presentation" class="<?= $maintabval == "new" ? 'active' : '' ?>" style=" margin-bottom: -26px;overflow: hidden;">
                                        <a   id="popular"  href="<?= base_url() ?>popular/<?= !empty($subtabval) ? strtolower($subtabval) : 'all'; ?>"><span><img src="<?= base_url()?>assets/public/img/dice.gif" class="img-responsive" style="margin-top: -10px; width: 40px; height: 40px;"></span></a>
                                    </li>
                                    <?php
                                } else {
                                    ?>
                                       <li role="presentation" class="<?= $maintabval == "new" ? 'active' : '' ?> ">
                                        <a   href="<?= base_url() ?>new/<?= !empty($subtabval) ? strtolower($subtabval) : 'all'; ?>" id="new" >New</a>
                                    </li>
                                    <li role="presentation" class="mar-lm-5 <?= $maintabval == "popular" ? 'active' : '' ?>">
                                        <a   id="popular"  href="<?= base_url() ?>popular/<?= !empty($subtabval) ? strtolower($subtabval) : 'all'; ?>">Popular</a>
                                    </li>
                                 
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>

                <div id="popContent" class="tab-content">
                    <!-- popular-->
                    <div role="tabpanel" class="tab-pane fade in active" id="newTab">
                        <div id="animation_image" style="display: none;margin-right: auto;margin-left: auto;" align="center">
                            <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
                        </div>
                        <br>
                        <div id="league_list_home">
                            <?php echo $content_content;?>
                        </div>
                        <?php if ($method == "index") {
                            ?>
                            <div id="morefun" style="display: none">
                                <form method="POST" id="morefun1" >
                                    <!--<a class="btn morefun" >I want more fun</a>-->
                                    <input type="hidden" name="orderid" value="<?php echo isset($orderid) ? $orderid : '0'; ?>" id="orderid">
                                    <input type="hidden" value="<?php echo!empty($pagetrackid) ? $pagetrackid + 1 : '1'; ?>" name="pagetrackid" id="pagetrackid">
                                    <input type="hidden" value="<?php echo!empty($maintabval) ? $maintabval : 'popular'; ?>" name="mainTabval" id="mainTabval">
                                    <input type="hidden" value="<?php echo!empty($subtabval) ? $subtabval : 'All'; ?>" name="subTabval" id="subTabval">
                                    <!--<input type="hidden" value="<?php // echo!empty($animename1) ? $animename1 : '0';                                                                               ?>" name="anime_name" id="anime_name">-->
                                    <button type="submit" class="btn morefun">I want more fun</button>
                                </form>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="animation_image" style="display: none;margin-right: auto;margin-left: auto;" align="center">
                            <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
                        </div>
                    </div>

                </div>
            </div>
            <div class="inline_upload" id="inline_upload" style="display: none">
                <?php
                $title = "Pictures & Album";
                if ($category == "video") {
                    $title = "Upload Youtube Video";
                }
                ?>
                <h2 class="modal-title-upload mar-t-20" id="myModalLabel"> <?= $title ?> </h2>
                <hr/>
                <p class="grey-color-xs">Choose how you want to upload</p>
                <div id="inline-upload-error" style="display: none" class="text-center alert alert-danger"></div>
                <div id="inline-upload-success" style="display: none" class="text-center alert alert-success"></div>
                <div class="upload-top">
    <?php if ($category == "video") {
        ?>

                        <a href="javascript:void(0)" class="choose-youtube">
                            <div class="upload-image panel panel-default">
                                <div class="panel-body"> <i class="fa fa-youtube-play fa-4x"></i></div>
                                <div class="panel-title"> <span>Submit Your Youtube Video Link</span> </div>
                            </div>
                        </a> 

                        <?php
                    } else if ($category == "gifs") {
                        ?>
                        <form action="#" id="uploadform-inline" class="dropzone">
                            <a href="javascript:void(0)" class="choose-image">
                                <div class="upload-image panel panel-default">
                                    <div class="panel-body"> <img src="<?php echo base_url(); ?>assets/public/img/upload-image.png"> </div>
                                    <div class="panel-title"> <span>Choose or drag gif here</span> </div>
                                </div>
                            </a>
                        </form>
                        <?php
                    } else {
                        ?>

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
        <?php }
    ?>
                </div>
            </div>


    <?php if ($category == "video") { ?>
                <div class="inline_video_upload image-upload" style="display: none" id="inline_video_upload">
                    <div class="modal-header bor-none">
                        <h2 class="modal-title-upload mar-t-0" id="myModalLabel">Yotube Video </h2>
                        <hr/>
                        <p class="grey-color-xs img-subtitle">Every video must be related or reference to the game  League of Legends</p>
                        <div id="inline_image_upload_error" style="display: none" class="text-center alert alert-danger"></div>
                        <div class="panel panel-default bor-radius-0">
                            <div class="panel-body">
                                <div class="panel-content col-md-12 no-padding">

                                    <input type="text" placeholder="Title" class="title-img-upload" id="inline_upload_title" maxlength="150" style="width:100%">
                                    <div class="pull-right count-right" style="margin-top: -27px;">
                                        <span id="inline_anime_count">150</span>
                                    </div>
                                    <input type="text" name="inline_anime_upload_video" placeholder="Enter youtube url" class="title-img-upload" id="inline_anime_upload_video" style="width:100%"/>
                                    <textarea placeholder="Describe your post with tags!" id="inline_tag" class="txt-area-tags" onkeypress="handle_inline(event);"></textarea>
                                    <p id="inline_tag1" style="margin-top:10px"></p>                                    
                                    <textarea style="display: none" class="form-control desc" id="inline_tag2"  rows="2" ></textarea>
                                </div>
                            </div>
                            <div class="wrap-filter-post">
                                This post is not safe for work
                                <input type="checkbox" name="option" id="inline_check1" style="display: none" />
                                <label for="inline_check1">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="wrap-filter-post">
                                Add spoiler tag
                                <input type="checkbox" name="option" id="inline_check2" style="display: none" />
                                <label for="inline_check2">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="wrap-filter-post">
                                Credit the author
                                <input type="checkbox" name="option" id="author_credit_check" class="only_credit" style="display: none" value="author_credit_check"  />
                                <label for="author_credit_check">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                                </label>
                            </div>

                            <div class="credit author_credit_check" style="display: none">
                                <div class="socmed-credit">
                                    <?php echo "<pre>";print_r($data);?>
                                </div>
                                <div class="name-author">
                                    <input type="text" placeholder="http://" id="inline_author" readonly="">
                                    <input type="text" placeholder="Name of Creditor" id="inline_credit">
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            <span class="catSelection_inimage">Pick a selection</span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu genre" id="inline_category_list" style="margin-top:-60px">

                        </ul>
                        <div class="col-md-12 wrap-btn-step no-padding">
                            <a href="javascript:void(0)" class="btn btn-red pull-right" onclick="inline_next_page()" id="next-image">Next</a>
                            <a href="javascript:void(0)" class="btn btn-back pull-right back-image">Back</a>
                        </div>
                    </div>
                </div> 
                <?php
            } else {
                ?>
                <div class="inline_image_upload image-upload" style="display: none" id="inline_image_upload">
                    <div class="modal-header bor-none">
                        <h2 class="modal-title-upload mar-t-0" id="myModalLabel">Pictures </h2>
                        <hr/>
                        <p class="grey-color-xs img-subtitle">Every picture must be related to League of Legends</p>
                        <div id="inline_image_upload_error" style="display: none" class="text-center alert alert-danger"></div>
                        <div class="panel panel-default bor-radius-0">
                            <div class="panel-body">
                                <div class="panel-content col-md-12 no-padding">
                                    <a href="javascript:void(0)">
                                        <div class="img-panel">
                                            <img id="inline_img" src="" >
                                        </div>
                                    </a>
                                    <input type="text" placeholder="Title" class="title-img-upload" id="inline_upload_title" maxlength="150">
                                    <div class="pull-right count-right">
                                        <span id="inline_anime_count">150</span>
                                    </div>
                                    <input type="hidden" name="inline_anime_upload_video" id="inline_anime_upload_video" />
                                    <textarea placeholder="Describe your post with tags!" id="inline_tag" class="txt-area-tags" onkeypress="handle_inline(event);"></textarea>
                                    <p id="inline_tag1" style="margin-top:10px"></p>                                    
                                    <textarea style="display: none" class="form-control desc" id="inline_tag2"  rows="2" ></textarea>
                                </div>
                            </div>
                            <div class="wrap-filter-post">
                                This post is not safe for work
                                <input type="checkbox" name="option" id="inline_check1" style="display: none" />
                                <label for="inline_check1">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="wrap-filter-post">
                                Add spoiler tag
                                <input type="checkbox" name="option" id="inline_check2" style="display: none" />
                                <label for="inline_check2">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                                </label>
                            </div>
                            <div class="wrap-filter-post">
                                Credit the author
                                <input type="checkbox" name="option" id="author_credit_check" class="only_credit" style="display: none" value="author_credit_check"  />
                                <label for="author_credit_check">
                                    <span class="fa-stack">
                                        <i class="fa fa-square-o fa-stack-1x"></i>
                                        <i class="fa fa-check fa-stack-1x"></i>
                                    </span>
                                </label>
                            </div>

                            <div class="credit author_credit_check" style="display: none">
                                <div class="socmed-credit">

                                </div>
                                <div class="name-author">
                                    <input type="text" placeholder="http://" id="inline_author" readonly="">
                                    <input type="text" placeholder="Name of Creditor" id="inline_credit">
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                            <span class="catSelection_inimage">Pick a selection</span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu genre" id="inline_category_list">

                        </ul>
                        <div class="col-md-12 wrap-btn-step no-padding">
                            <a href="javascript:void(0)" class="btn btn-red pull-right" onclick="inline_next_page()" id="next-image">Next</a>
                            <a href="javascript:void(0)" class="btn btn-back pull-right back-image">Back</a>
                        </div>
                    </div>
                </div> 
                <div class="inline_album_upload image-upload"  id="inline_album_upload" style="display: none">
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
                                    This post is not safe for work
                                    <input type="checkbox"   id="inline_not_safe" value="1"  style="display: none"/>
                                    <label for="inline_not_safe">
                                        <span class="fa-stack">
                                            <i class="fa fa-square-o fa-stack-1x"></i>
                                            <i class="fa fa-check fa-stack-1x"></i>
                                        </span>
                                    </label>
                                </div>
                                <div class="wrap-filter-post">
                                    Add spoiler tag
                                    <input type="checkbox"   id="inline_spoiler" value="1"   style="display: none"/>
                                    <label for="inline_spoiler">
                                        <span class="fa-stack">
                                            <i class="fa fa-square-o fa-stack-1x"></i>
                                            <i class="fa fa-check fa-stack-1x"></i>
                                        </span>
                                    </label>
                                </div>
                                <div class="wrap-filter-post">
                                    Credit the author
                                    <input type="checkbox"  id="inline_credit_check" class="only_credit" value="inline_credit_check"  style="display: none"/>
                                    <label for="inline_credit_check">
                                        <span class="fa-stack">
                                            <i class="fa fa-square-o fa-stack-1x"></i>
                                            <i class="fa fa-check fa-stack-1x"></i>
                                        </span>
                                    </label>
                                </div>

                                <div class="credit inline_credit_check" style="display:none">
                                    <div class="socmed-credit">

                                    </div>
                                    <div class="name-author">
                                        <input type="text" id="inline_album_author" placeholder="http://" readonly="">
                                        <input type="text" id="inline_album_credit" placeholder="Name of Creditor">
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <span class="catSelection_inalbum"> Pick a selection</span><span class="caret"></span>
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
                <?php
            }
            ?>
        </div>

        <div class="col-md-5 col-sm-12  hidden-sm hidden-xs">

    <?= $this->load->view('template/right_sidebar', $right_bar, true); ?>
        </div>
        <!--end ads--> 
    </div>
<?php } ?>

<?php if ($class == "gamechat") { ?>
    <div  role="tabpanel" class="tab-pane right-panel-sec pad-left active"  id="gameChat">
        <div class="upload-page  col-md-7 col-xs-12 col-sm-12 main-content">

            <div id="outer-gameChat">
                <div class="col-md-8 no-padding">
                    <div class="col-md-8 no-padding">
                        <ul id="popa" class="nav pop-tabs" role="tablist" style="margin-top:10px;">
                            <li role="presentation" style="margin-left: 0px; margin-right: -5px;" class="<?= $maintabval == "fav" ? 'active' : '' ?>">
                                <a href="<?= base_url() ?>gamechat/bookmark"   id="bookmarks"  >
                                    <i class="fa fa-bookmark" style="margin-top:5px;"></i>
                                </a>
                            </li>
                            <li role="presentation" class="<?= $maintabval == "popular" ? 'active' : '' ?>">
                                <a   id="popular"  href="<?= base_url() ?>gamechat/popular">Popular</a>
                            </li>
                            <li role="presentation" class="mar-lm-5 <?= $maintabval == "new" ? 'active' : '' ?> ">
                                <a   href="<?= base_url() ?>gamechat/new" id="new" >New</a>
                            </li>
                        </ul>
                    </div>
                </div>


                <div id="popContent" class="tab-content"> 
                    <div role="tabpanel" class="tab-pane fade in active" id="gamenewTab">
                        <div id="animation_image" style="display: none;margin-right: auto;margin-left: auto;" align="center">
                            <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
                        </div>
                        <br>
                        <div id="gameleague_list_home">

                        </div>
    <?php if ($method == "index") {
        ?>
                            <div id="morefun" style="display: none">
                                <form method="POST" id="morefun1" >
                                    <!--<a class="btn morefun" >I want more fun</a>-->
                                    <input type="hidden" name="orderid" value="<?php echo isset($orderid) ? $orderid : '0'; ?>" id="orderid">
                                    <input type="hidden" value="<?php echo!empty($pagetrackid) ? $pagetrackid + 1 : '1'; ?>" name="pagetrackid" id="pagetrackid">
                                    <input type="hidden" value="<?php echo!empty($maintabval) ? $maintabval : 'popular'; ?>" name="mainTabval" id="mainTabval">
                                    <input type="hidden" value="<?php echo!empty($subtabval) ? $subtabval : 'All'; ?>" name="subTabval" id="subTabval">
                                    <!--<input type="hidden" value="<?php // echo!empty($animename1) ? $animename1 : '0';                                                                               ?>" name="anime_name" id="anime_name">-->
                                    <button type="submit" class="btn morefun">I want more fun</button>
                                </form>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="animation_image" style="display: none;margin-right: auto;margin-left: auto;" align="center">
                            <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
                        </div>
                    </div>

                </div>
            </div>
            <div class="dialogue-upload  image-upload" style="display: none;" id="gamedialogue-upload">
                <div class="modal-header bor-none">
                    <h3 class="league-dialogue">
                        LEAGUE DIALOGUE
                    </h3>
                    <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Give your post a Title</h2>
                    <hr/>
                    <p class="grey-color-xs img-subtitle">Had a funny conversation with someone in game? POST IT HERE!</p>
                    <div id="inline_gamechat_alert" style="display: none" class="text-center alert alert-danger"></div>
                    <p id="inline_showgamechat" class="text-danger"></p>
                    <div class="panel panel-default bor-radius-0">
                        <select class="splashart" multiple="multiple" id="inline_splashart_model">
                            <option value="badge1">badge1</option>
                            <option value="badge2">badge2</option>
                            <option value="badge3">badge3</option>
                            <option value="badge4">badge4</option>
                            <option value="badge5">badge5</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <div class="panel-content col-md-12 no-padding">
                            <input type="text" placeholder="Give a Title Here..." class="title-discuss-input" name="title" id="inline_main_title_gamechat" maxlength="150">
                            <span class="pull-right char-length" id="inline_title_count_gamechat">150</span>
                        </div>
                    </div>
                    <form id="inline_gameform" method="post" action="">
                        <div class="panel panel-default bor-radius-0" id="inlinegamechatarea"></div>
                        <div class="col-sm-12">
                            <div class="waitgamechat" style="display:none;width:69px;height:89px;margin-left:43%;margin-top: -118px;"><img
                                    src='<?php echo base_url(); ?>assets/public/img/ajax-loader.gif' width="64"
                                    height="64"/><br><strong class="text">Uploading...</strong></div>
                        </div>



                        <div class="col-md-12 wrap-btn-step">
                            <input type="submit" name="g" class="btn btn-red pull-right" value="Next" id="inline_next-gamechat"> 
                        </div> 
                    </form> 

                </div>
            </div>

        </div>
        <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $this->load->view('template/right_sidebar', $right_bar, true); ?>
        </div>
<?php } ?>
</div>

</div>
<!--end tab panel -->
</div>
<!-- tab content -->
</div>
<!-- end row -->
<script>
   var perpage = 10 ;
     var season_page = 10;
            <?php if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) {
                ?>
               var perpage = 4;
               var season_page = 4;
            <?php
            } ?>
    var offset = 1;
    var scroll_top = 1000;
    $(document).ready(function() {
        //alert("test");
        if ('<?= $class ?>' == "home" && '<?= $category != "video" ?>') {
            Dropzone.autoDiscover = false;  
            if('<?= $category == "gifs" ?>'){
                var myDropzoneInline = new Dropzone(("#uploadform-inline"),{
                    acceptedFiles:'.gif',
                });
            }else{
                var myDropzoneInline = new Dropzone("#uploadform-inline");
            }
            /***************************/
            /* Inline Add Picture start*/
            myDropzoneInline.on("addedfile", function(file) {

                var formData = new FormData();
                formData.append('file', file);
                formData.append('category', '<?= $category ?>');
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
                                    type: 'in_image',
                                    category: '<?= $category ?>'
                                },
                                success: function(msg) {
                                    $('#inline_category_list').html(msg);
                                    var selectedtext = $("#inline_category_list .pic_category:checked").val();
                                    if (selectedtext !== "undefined") {
                                        $('.catSelection_inimage').text(selectedtext);
                                    }
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
        }

        if ('<?= $method ?>' == "index" && '<?= $class ?>' == "home") {

            var subTabValue = $('#subTabval').val();
            var mainTab = $('#mainTabval').val();
            var track_load = 1; //total loaded record group(s)
            var page_track = $('#pagetrackid').val();
            var loading = false; //to prevents multipal ajax loads
            var total_groups; //total record group(s)
            total_groups = $('.total_groups').val();
         //   list_league(mainTab, subTabValue);
        } else if ('<?= $method ?>' == "season_index") {
            season_old();
            var loading = false;
            var season_track_load = 1;
            var season_total_groups;
        } else if ('<?= $method ?>' == "index" && '<?= $class ?>' == "gamechat") {

            var subTabValue = $('#subTabval').val();
            var mainTab = $('#mainTabval').val();
            var track_load = 1; //total loaded record group(s)
            var page_track = $('#pagetrackid').val();
            var loading = false; //to prevents multipal ajax loads
            var total_groups; //total record group(s)
            game_league(mainTab, subTabValue);
        }
        function season_old() {
            $('#league_drop').attr("data-sid", 'season_old');
            $.ajax({
                type: "POST",
                url: base_url + 'public/leaguelist/season_old',
                data:{season_page:season_page},
                beforeSend: function() {
                    $('#animation_image').show();
                },
                success: function(msg) {
                    $('html, body').animate({scrollTop: $("#body_id").offset().top - 90}, "slow");
                    $('#animation_image').hide();
                    $('#moment').find('#pop').hide();
                    $('#league_list_home').html(msg);
                    $('#league_drop').text('Leaguememe (All) > Season 6-1 ');
                }
            });
        }
        function list_league(mainTab, subTabValue) {
            var league = $('#orderid').val();
            if (subTabValue == "Art") {
                var subTabVal = "Art/Cosplay";
            } else {
                var subTabVal = subTabValue;
            }
            $.ajax({
                type: "POST", url: base_url + 'public/leaguelist/list_league/' + league,
                data: {main: mainTab, sub: subTabValue,perpage:perpage},
                beforeSend: function() {
                    $('#animation_image').slideDown();
                },
                success: function(msg) {
                    $('html, body').animate({scrollTop: $("#body_id").offset().top - 90}, "slow");
                    track_load = 1;
                    $('#subfreshVal').text(subTabVal);
                    $('#freshVal').text(subTabVal);
                    $('#animation_image').slideUp();
                    $('#league_list_home').html(msg);
                    total_groups = $('.total_groups').val();
                }
            });
        }
        function game_league(mainTab, subTabValue) {
            var league = $('#orderid').val();
            $.ajax({
                type: "POST", url: base_url + 'public/leaguelist/list_league/' + league,
                data: {main: mainTab, sub: subTabValue, upload_type: "2",perpage:perpage},
                beforeSend: function() {
                    $('#animation_image').slideDown();
                },
                success: function(msg) {
                    $('html, body').animate({scrollTop: $("#body_id").offset().top - 90}, "slow");
                    track_load = 1;

                    $('#animation_image').slideUp();
                    $('#gameleague_list_home').html(msg);
                    total_groups = $('.total_groups').val();
                }
            });
        }

        $(window).scroll(function() { //detect page scroll
            $('.js-textareacopybtn').each(function() {
                var id = $(this).attr('id');
                $('#' + id).bind('click', function() {
                    var leagueid = id.split('_');
                    var selectorid = "#copytext_" + leagueid[1];
                    $(selectorid).show();
                    var copyTextarea = document.querySelector(selectorid);
                    copyTextarea.select();
                    try {
                        var successful = document.execCommand('copy');
                        $('#copy_user_msg').show(1000);
                        $('#copy_user_msg').hide(1000);
                    } catch (err) {
                        //         console.log('Oops, unable to copy');
                    }

                });
            });

    var arr1 = [];
            loading = false;
            if ($(window).scrollTop() >= scroll_top) //user scrolled to bottom of the page?
            {
                if (track_load < total_groups && loading == false && '<?= $method ?>' == "index" && '<?= $class ?>' == "home") //there's more data to load
                {
                     <?php if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) {
                ?> 
                          perpage = "8";
                      <?php } ?>
                    $('.animation_image').show(); //show loading image
                    $.ajax({type: "POST",
                        url: base_url + 'public/leaguelist/list_scroll_data',
                        data: {
                            group_no: page_track,
                            main: mainTab,
                            sub: subTabValue,
                            perpage: perpage,
                            offset: offset
                        },
                        success: function(msg) {
                            loading = true;
                            $('#league_list_home').append(msg);
                            $('.animation_image').hide(); //hide loading image once data is received
                            track_load++; //loaded group increment
                            page_track++;

                           <?php if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) {
                                 ?>
                                      loading = false;
                             <?php } else {
                                 ?>
                                    if (page_track == total_groups) {
                                        loading = true;
                                    } else if (track_load == 2) {
                                        loading = true;

                                        $("#pagetrackid").attr("value", page_track);
                                        $("#mainTabval").attr("value", mainTab);
                                        $("#subTabval").attr("value", subTabValue);
                                        var league = page_track * perpage;
                                        $("#morefun1").attr("action", base_url + mainTab + '/' + subTabValue.toLowerCase() + '/' + league);
                                    }
                                    else {
                                        loading = false;
                                    }
                             <?php }
                             ?>
                        }
                    });
                    offset += 1;
                    scroll_top += 620;
                }
                if (season_track_load <= $('.season_total_groups').val() && loading == false && '<?= $method ?>' == "season_index") //there's more data to load
                {
 <?php if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) {
                ?>
                 
                          season_page = "8";             
                      <?php } ?>
                    loading = true; //prevent further ajax loading
                    $('.animation_image').show(); //show loading image
                    $.ajax({type: "POST",
                        url: base_url + 'public/leaguelist/season_old',
                        data: {group_no: season_track_load,season_page:season_page},
                        beforeSend: function() {
                            $('.animation_image').show();
                        },
                        success: function(data) {
                            $('#league_list_home').append(data);
                            $('.animation_image').hide(); //hide loading image once data is received
                            season_track_load++; //loaded group increment   

                           <?php if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) {
                                 ?> 
                                      loading = false;                       
                             <?php } else {
                                 ?>
                            if (season_track_load == $('.season_total_groups').val()) {
                                loading = true;
                            } else {
                                loading = false;
                            }
                             <?php }
                             ?>
                        }
                    });
                }
                if (track_load < total_groups && loading == false && '<?= $method ?>' == "index" && '<?= $class ?>' == "gamechat") //there's more data to load
                {
                    loading = true; //prevent further ajax loading
                    $('.animation_image').show(); //show loading image
                    $.ajax({type: "POST",
                        url: base_url + 'public/leaguelist/list_scroll_data',
                        data: {group_no: page_track, main: mainTab, sub: subTabValue, upload_type: "2",perpage:perpage},
                        success: function(msg) {
                            $('#league_list_home').append(msg);
                            $('.animation_image').hide(); //hide loading image once data is received
                            track_load++; //loaded group increment  
                            page_track++;

                            if (page_track == total_groups) {
                                loading = true;
                                $("#morefun").hide();
                            } else
                            if (track_load == 2) {
                                loading = true;

                                $("#pagetrackid").attr("value", page_track);
                                $("#mainTabval").attr("value", mainTab);
                                $("#subTabval").attr("value", subTabValue);
                                var league = page_track * perpage;
                                $("#morefun1").attr("action", base_url + 'gamechat/' + mainTab + '/' + league);
                                $("#morefun").show();
                            } else {
                                loading = false;
                            }
                        }
                    });
                }
            }
        });

        function hideBanners() {
            var contentheight = window.innerHeight - 220;
            var bannerHeight = 0;

            $(".right_banner_side .banner_cont").each(function () {
                bannerHeight += $(this).outerHeight();
                if (bannerHeight >= contentheight) {
                    $(this).hide();
                }
                else {
                    $(this).show();
                }
            });
        }

        hideBanners();
        $(window).resize(function () {
            hideBanners();
        });

    });
    if ('<?= $class ?>' == "home") {
        $(".back-image").click(function() {
            $(".inline_upload").slideDown();
            $('.inline_image_upload').slideUp();
        })
        $("#inline_back-album").click(function() {
            $(".inline_album_upload").slideUp();
            $(".inline_upload").slideDown();
        })

        $(".choose-youtube").click(function() {
            $(".inline_upload").slideUp();
            $(".inline_video_upload").slideDown();
            $.ajax({
                type: "POST",
                url: base_url + 'public/home/get_image_upload_category',
                data: {
                    type: 'in_image',
                    category: '<?= $category ?>'
                },
                success: function(msg) {
                    $('#inline_category_list').html(msg);
                    var selectedtext = $("#inline_category_list .pic_category:checked").val();
                    if (selectedtext !== "undefined") {
                        $('.catSelection_inimage').text(selectedtext);
                    }
                }
            });
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
        $('#inline_upload_title').keyup(function(event) {
            var text_length = $('#inline_upload_title').val().length;
            var limit = 150;

            text_remaining = limit - text_length;

            if ($('#inline_upload_title').val().length == 150) {
                event.preventDefault();
            } else if ($('#inline_upload_title').val().length > 150) {
                // Maximum exceeded
                this.value = this.value.substring(0, 150);
            }
            if (text_remaining == 150) {
                $("#inline_anime_count").html('150');
            } else {
                if (text_remaining >= 0)
                    $("#inline_anime_count").html(text_remaining);
                else if (text_remaining === 0) {
                    $("#inline_anime_count").html(text_remaining);
                    $("#inline_anime_count").css('color', 'red');
                }
            }
        });
        $('#inline_tag1').on('click', '.rem', function() {
            $(this).parent().remove();
            var variable = $('#inline_tag1').text().replace(/\s\s+/g, ' ');

            $("#inline_tag2").text($.trim(variable));
        });
        function handle_inline(e) {
            if (e.which === 32) {
                var x = $('#inline_tag').val();
                if (x !== " ") {
                    $("#inline_tag1").append('<a class="btn btn-grey" href="javascript:void(0);" role="button" style="margin-left: 5px;">' + x + ' <i class="fa fa-close rem"></i></a>');
                    $("#inline_tag").val("");
                    $("#inline_tag2").append(x);
                } else {
                    $("#inline_tag").val("");
                }
            }
            return false;
        }
        function inline_next_page() {

            var wordd = $("#inline_anime_count").text();
            var category = $("#inline_category_list li .pic_category:checked").val();

            var title = $("#inline_upload_title").val();
            var description = $("#upload_description").val();
            var image_name = $("#inline_anime_upload_image").val();
            var video_name = $("#inline_anime_upload_video").val();
            var tag = $("#inline_tag2").val();
            var author = $("#inline_author").val();
            var credit = $("#inline_credit").val();
            if ($("#inline_check1").is(':checked')) {
                var not_safe = 1;
            } else {
                var not_safe = 0;
            }
            if ($("#inline_check2").is(':checked')) {
                var spoiler = 1;
            } else {
                var spoiler = 0;
            }
            if ($("#author_credit_check").is(':checked')) {
                var credit_author = 1;
            } else {
                var credit_author = 0;
            }
            if (wordd > 0) {
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
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == "success") {
                            $.ajax({
                                type: "POST",
                                dataType: 'json',
                                url: base_url + 'public/home/last_save_upload_image',
                                data: {
                                    'title': title,
                                    'description': description,
                                    'not_safe': not_safe,
                                    'credit_author': credit_author,
                                    'image_name': data.image_name,
                                    'video_name': video_name,
                                    'tag': tag,
                                    'author': author,
                                    'credit': credit,
                                    'category': category,
                                    'spoiler': spoiler,
                                },
                                success: function(msg) {
                                    if (msg.result == "success") {
                                        $(".inline_image_upload").slideUp();
                                        $(".inline_upload").slideDown();
                                        $("#inline_image_upload_error").hide();
                                        window.location.reload();
                                    } else {
                                        $(document).scrollTop($('#moment').offset().top);
                                        $("#inline_image_upload_error").show();
                                        $("#inline_image_upload_error").html('<strong>' + data.msg + '</strong>');
                                    }
                                }
                            });

                        } else if (data.result == "error") {
                            $(document).scrollTop($('#moment').offset().top);
                            $("#inline_image_upload_error").show();
                            $("#inline_image_upload_error").html('<strong>' + data.msg + '</strong>');
                        }

                    }
                });
            }
        }
        $(".inline_choose-album, #add_more_inline_album").click(function() {
            $("#uploadinlinealbum").click();
        });
        $("#uploadinlinealbum").change(function() {
            var data = new FormData($('#inline_album_form')[0]);
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
                    $('.inline_waitalbum').show();
                },
                success: function(data) {
                    if (data.result == "success") {
                        $(".inline_album_upload").slideDown();
                        $(".inline_upload").slideUp();
                        $("#inline_album_alert").hide();
                        $("#inline-album").hide();
                        $('.inline_waitalbum').hide();

                        var j = data.firstname;
                        var k = j.split(",");
                        var m = k.length;

                        var l;
                        for (l = 0; l < m; l++) {
                            parts = k[l].split(".");
                            loc = parts.pop();
                            if (loc != "" && (loc == "jpg" || loc == "jpeg" || loc == "gif" || loc == "png")) {
                                $('#inline_albumarea').append('<div class="panel panel-default bor-radius-0"  id="inline_rem' + k[l] + '" >' +
                                        '<span class="delete-panel inline_remove_img" style="float:right;cursor: pointer"  id="iar_' + k[l] + '" ><i class="fa fa-times"></i></span>' +
                                        '<div class="panel-body">' +
                                        '<div class="panel-content col-md-12 no-padding">' +
                                        '<a href="">' +
                                        '<div class="img-panel">' +
                                        '<img src="' + base_url + 'uploads/league/' + k[l] + '"> <input type="hidden"  name="img_' + k[l] + '" value="' + k[l] + '" > ' +
                                        '</div>' +
                                        '</a>' +
                                        '<input type="text" placeholder="Title" class="title-img-upload title_count" name="' + k[l] + '" maxlength="150" id="titl_' + k[l] + '">' +
                                        '<div class="pull-right count-right">' +
                                        '<span id="tit' + k[l] + '">139</span>' +
                                        '</div>' +
                                        '<textarea placeholder="Describe your post with tags!"  id="inline_album_tag_' + k[l] + '" data-aid="' + k[l] + '" class="txt-area-tags inline_album_tag"  style="overflow: hidden; overflow-wrap: break-word; height: 48px;"></textarea>' +
                                        '<div class="hastag-view-upload" id="inline_album_tag1_' + k[l] + '"></div>\n\
                                                                                                <textarea style="display: none" class="form-control desc" name= "album_tag' + k[l] + '" id="inline_album_tag2_' + k[l] + '" rows="2" ></textarea>\n\
                                                                                                </div>' +
                                        '</div>' +
                                        '<div class="wrap-filter-post">' +
                                        '<input type="text" maxlength="250" name="desc_' + k[l] + '"  maxlength="150"  id="desr**' + k[l] + '"  class="textarea-resize desc_count" placeholder="Describe your post">' +
                                        '<div class="count-right" >' +
                                        '<span id="dese' + k[l] + '" >250</span>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>');

                            } else {
                                $("#inline_album_alert").show();
                                $("#inline_album_alert").append('<strong>Make sure valid file type . Not allowed .' + loc + ' file format</strong>');
                                $("#inline-album").show();
                                $("#inline-album").html('<strong>' + data.msg + '</strong>');
                            }
                        }
                        $.ajax({type: "POST",
                            url: base_url + 'public/home/get_image_upload_category',
                            data: {
                                type: 'in_album',
                                category: '<?= $category ?>'
                            },
                            success: function(msg) {
                                $('#inline_category_list_album').html(msg);
                                var selectedtext = $("#inline_category_list_album .pic_category:checked").val();
                                if (selectedtext !== "undefined") {
                                    $('.catSelection_inalbum').text(selectedtext);
                                }
                            }});

                    } else if (data.result == "error") {
                        $('.inline_waitalbum').hide();
                        $("#inline_album_alert").show();

                        $("#inline_album_alert").html('<strong>' + data.msg + '</strong>');
                        $("#inline-album").show();
                        $("#inline-album").html('<strong>' + data.msg + '</strong>');
                    }
                }
            });

        });
        $(document).on('keyup', '.inline_album_tag', function(e) {
            if (e.which === 32) {
                var id = $(this).data('aid');
                var x = document.getElementById("inline_album_tag_" + id).value;
                if (x != " ") {
                    var div = document.getElementById("inline_album_tag1_" + id);
                    div.innerHTML = div.innerHTML + ('<a class="btn btn-grey" href="javascript:void(0);" role="button" style="margin-left: 5px;">' + x + ' <i class="fa fa-close inline_album_rem " data-inlineremid="' + id + '"></i></a>');
                    document.getElementById("inline_album_tag_" + id).value = "";
                    var tag_val = document.getElementById("inline_album_tag2_" + id);
                    tag_val.value = tag_val.value + x;
                } else {
                    document.getElementById("inline_album_tag_" + id).value = "";
                }

            }
            return false;
        });
        $(document).on('click', '.inline_album_rem', function() {
            var id = $(this).data('inlineremid');
            $(this).parent().remove();
            var html = document.getElementById("inline_album_tag1_" + id).innerHTML;
            var variable = document.getElementById("inline_album_tag2_" + id).value = html.replace(/<[^>]*>/g, "");
            var new_variable = variable.replace(/\s\s+/g, " ");
            document.getElementById("inline_album_tag2_" + id).value = (new_variable.trim());
        });
        $(document).on('click', '.inline_remove_img', function() {
            var str = $(this).attr('id');
            var id = str.split("_");
            document.getElementById('inline_rem' + id[1]).remove();
            $(this).remove();
        });
        var limit = 150;
        var text_remaining;
        $(document).on('keyup', '.title_count', function() {
            var str = $(this).attr('id');
            var idd = str.split("_");
            var id = idd[1];
            var text_length = document.getElementById('titl_' + id).value.length;
            text_remaining = limit - text_length;
            if (text_remaining == 150) {
                document.getElementById('tit' + id).innerHTML = '<span>150</span>';
            } else {
                if (text_remaining >= 0) {
                    document.getElementById('tit' + id).innerHTML = '<span>' + text_remaining + '</span>';
                } else if (text_remaining < 0) {

                    document.getElementById('tit' + id).innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
                }
            }

        });

        $('#inline_albumtag1').on('click', '.albumrem', function() {
            $(this).parent().remove();
            var variable = $('#inline_albumtag1').text().replace(/\s\s+/g, ' ');
            $("#inline_albumtag2").text($.trim(variable));
        });
        var alubmlimit = 150;
        var albumtext_remaining;
        var max = 150;
        $('#inline_main_title').keyup(function(event) {
            var text_length = $('#inline_main_title').val().length;
            //                            alert(text_length);         albumtext_remaining = alubmlimit - text_length;
            if ($('#inline_main_title').val().length == max) {
                e.preventDefault();
            } else if ($('#inline_main_title').val().length > max) {
                // Maximum exceeded
                this.value = this.value.substring(0, max);
            }
            if (albumtext_remaining == 150) {
                $("#inline_albumanime_count").html('<span>150</span>');
            } else {
                if (albumtext_remaining >= 0)
                    $("#inline_albumanime_count").html('<span>' + albumtext_remaining + '</span>');
                else if (albumtext_remaining === 0) {

                    $("#inline_albumanime_count").html('<span><font color=red>' + albumtext_remaining + '</font></span>');
                }
            }
        });
        $("#inline_albumform").submit(function(event) {
            event.preventDefault();
            var category = $("#inline_category_list_album .pic_category:checked").val();
            var tag = $("#inline_albumtag2").val();
            var main_title = $("#inline_main_title").val();
            var credit = $('#inline_album_author').val();
            var author = $('#inline_album_credit').val();
            var notsafe = 0;
            var spolier = 0;
            var spolier_val = 1;
            if ($("#inline_spoiler").is(':checked'))
                spolier = 1;
            if ($("#inline_not_safe").is(':checked')) {
                notsafe = 1;
            }
            if ($("#inline_credit_check").is(':checked')) {
                var credit_author = 1;
            } else {
                var credit_author = 0;
            }

            $.ajax({type: "POST",
                url: base_url + "public/home/add_albumdata",
                data: {data: $(this).serialize(),
                    credit_author: credit_author,
                    author: author,
                    credit: credit,
                    main_title: main_title,
                    spolier: spolier,
                    spolier_val: spolier_val,
                    'category': category,
                    tag: tag,
                    notsafe: notsafe,
                },
                dataType: 'json',
                success: function(data) {
                    if (data.result == "success") {
                        $.ajax({
                            url: base_url + 'public/home/last_save_album_image',
                            type: 'POST',
                            data: {
                                data: $('#inline_albumform').serialize(),
                                credit_author: credit_author,
                                author: author,
                                credit: credit,
                                main_title: main_title,
                                spolier: spolier,
                                spolier_val: spolier_val,
                                'category': category,
                                tag: tag,
                                notsafe: notsafe,
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.result == "success") {
                                    $("#inline_anime_alert_album").slideUp();
                                    $(".inline_album_upload").slideUp();
                                    $(".inline_upload").slideDown();
                                    $("#inline-upload-success").show().text("Album successfully uploaded.");
                                    $("#inline_album_alert").hide();
                                    window.location.reload();
                                } else if (data.result == "error") {
                                    $(document).scrollTop($('#moment').offset().top);
                                    $("#inline_album_alert").show();
                                    $("#inline_album_alert").html('<strong>' + data.msg + '</strong>');
                                }
                            }
                        });
                    } else if (data.result == "error") {
                        $(document).scrollTop($('#moment').offset().top);
                        $("#inline_album_alert").show();
                        $("#inline_album_alert").html('<strong>' + data.msg + '</strong>');
                    }
                }});
        });
    }

    if ('<?= $class ?>' == "gamechat") {
        function informat(state) {
            if (!state.id) {
                return state.text;
            }
            //            return "<img class='flag' src='<?php echo base_url(); ?>assets/public/img/" + state.id.toLowerCase() + ".png'/>" + state.text;
            var $state = $(
                    '<span><img src="<?php echo base_url(); ?>assets/public/img/' + state.id.toLowerCase() + '.png" class="img-flag" style="width:35px" /> ' + state.text + '</span>'
                    );
            return $state;
        }
        $("select#inline_splashart_model").select2({
            formatResult: informat,
            placeholder: 'Enter Splashart name',
            maximumSelectionSize: 5,
        }).on("select2-selecting", function(e) {
            $('#inlinegamechatarea').append('<div class="panel-body" id="ingameRem_' + e.val + '"> \n\
                       <div class="panel-content col-md-12 no-padding"> \n\
                           <input type="hidden"  name="img_' + e.val + '" value="' + e.val + '.png" > \n\
                           <a href="javascript:void(0)"> <div class="img-panel"> <img src="' + base_url + 'assets/public/img/' + e.val + '.png">  </div> </a> \n\
                           <div class="title-dialogue" style="width:58%"> \n\
                               <select  name="opt_' + e.val + '" > \n\
                                   <option value="volvo">Here a title</option> \n\
                                   <option value="saab">lalalala</option> \n\
                                   <option value="mercedes">Medusa got a rampage</option> \n\
                                   <option value="audi">Anti Mage teach</option> \n\
                               </select> <hr>  \n\
                               <textarea placeholder="Dialogue" class="indesc_count" name="desc_' + e.val + '" maxlength="150" id="indesr**' + e.val + '"></textarea> \n\
                           </div>  \n\
                           <div class="count-right" id="indese' + e.val + '"> <span>150</span> </div> \n\
                       </div> \n\
                   </div>');
        }).on("select2-removed", function(e) {
            document.getElementById('ingameRem_' + e.val).remove();
        })
        $("#inline_gameform").submit(function(event) {
            event.preventDefault();
//    var category = $("#inline_category_gamechat_list .pic_category:checked").val();
            var splashart_model = $("#inline_splashart_model").val();
            var main_title = $("#inline_main_title_gamechat").val();
            $.ajax({type: "POST",
                url: base_url + "public/home/add_gamechatdata",
                data: {data: $(this).serialize(),
//            category: category,
                    splashart_model: splashart_model,
                    main_title: main_title
                },
                dataType: 'json',
                success: function(data) {
                    if (data.result == "success") {
                        $("#inline_gamechat_alert").hide();
                        window.location.reload();
                    } else if (data.result == "error") {
                        $(document).scrollTop($('#gameChat').offset().top);
                        $("#inline_gamechat_alert").show();
                        $("#inline_gamechat_alert").html('<strong>' + data.msg + '</strong>');
                    }
                }});
        });
        var lim = 150;
        var text_remaining;
        $(document).on('keyup', '#inline_main_title_gamechat', function() {


            var text_length = document.getElementById('inline_main_title_gamechat').value.length;
            text_remaining = lim - text_length;
            if (text_remaining == 150) {
                document.getElementById('inline_title_count_gamechat').innerHTML = '<span >150</span>';
            } else {
                if (text_remaining >= 0) {
                    document.getElementById('inline_title_count_gamechat').innerHTML = '<span>' + text_remaining + '</span>';
                } else if (text_remaining < 0) {

                    document.getElementById('inline_title_count_gamechat').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
                }
            }

        });
    }

</script>




