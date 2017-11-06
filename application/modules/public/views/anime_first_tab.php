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
<!-- tab -->
<div class="row">

    <div class="col-md-8 col-sm-5" style="display: inline-block; float: left; padding-right: 0px;">
        <ul id="pop" class="nav pop-tabs" role="tablist" style="margin-top:10px;">
            <li role="presentation" style="margin-left: 0px; margin-right: -5px;" class="tabs">
                <a href="#bookmarks" id="bookmarks" role="tab" data-toggle="tab" aria-controls="bookmarks">
                    <i class="fa fa-bookmark" style="margin-top:5px;"></i>
                </a>
            </li>
            <li role="presentation" class="active tabs">
                <a href="#newTab" id="popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
            </li>
            <li role="presentation" class="mar-lm-5 tabs">
                <a href="#newTab" id="new" role="tab" data-toggle="tab" aria-controls="news">New</a>
            </li>
        </ul>
    </div>

    <div class="col-md-4 col-sm-4 no-padding" style="display: inline-block; padding-top: 16px;">
        <div class="trolls" style="margin-top: 10px;">
            <a href="#" class="btn dropdown-toggle" id="allThings" type="button" data-toggle="dropdown">
                <span class="linky"><b id="freshVal">All The Things</b></span>
                <span>&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url(); ?>assets/public/img/icon/post/dropdown-red.png"></span>
            </a>
            <ul class="dropdown-menu" id="subTabData" role="menu" aria-labelledby="allThings">

            </ul>
        </div>
    </div>
</div>

<div id="popContent" class="tab-content">
    <!-- popular-->
    <div role="tabpanel" class="tab-pane fade in active" id="newTab">
        <div id="league_list_home">
        </div>
        <div id="morefun" style="display: none">
            <form method="POST" id="morefun1" >
                <!--<a class="btn morefun" >I want more fun</a>-->
                <input type="hidden" name="orderid" value="<?php echo isset($orderid) ? $orderid : '0'; ?>" id="orderid">
                <input type="hidden" value="<?php echo!empty($pagetrackid) ? $pagetrackid + 1 : '1'; ?>" name="pagetrackid" id="pagetrackid">
                <input type="hidden" value="<?php echo!empty($maintabval) ? $maintabval : 'popular'; ?>" name="mainTabval" id="mainTabval">
                <input type="hidden" value="<?php echo!empty($subtabval) ? $subtabval : 'All the Things'; ?>" name="subTabval" id="subTabval">
                <input type="hidden" value="<?php echo!empty($animename1) ? $animename1 : '0'; ?>" name="anime_name" id="anime_name1">
                <button type="submit" class="btn morefun">I want more fun</button>
            </form>
        </div>
        <div class="animation_image" style="display:none;margin-right: auto;margin-left: auto;" align="center">
            <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
        </div>
    </div>

    <!-- news -->

</div>
<script src="<?php echo base_url(); ?>assets/public/js/index.js"></script>