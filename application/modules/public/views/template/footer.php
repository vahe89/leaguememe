<?php $new_url = "http://static.leaguememe.com/"; ?>
<div class="footer-msg" id="copy_user_msg" style="display: none">
    Copy to clipboards
</div>
<input type="hidden" data-baseurl="<?php echo base_url(); ?>">
<?php  if (stristr($_SERVER['HTTP_USER_AGENT'], "Mobile")) {
    ?>
<div id="adbox" class="text-center col-md-12" >
    <div class="close_ad_btn"><i class="fa fa-close"></i></div>
    <div class="ad_box">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- LM Footer AD Code -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:50px"
     data-ad-client="ca-pub-9746555787553362"
     data-ad-slot="1674026366"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
    </div>

</div>
<style>
    #adbox {
    position: fixed;
    bottom: 1;
    width: 95%;
    z-index: 9999;
    margin-left:10px;
   // height:70px;
}

.ad_box{
    height:53px;
    border: 2px solid #2d4385;
    background: white;
}
.close_ad_btn{
   background: black;
    border-radius: 15px;
    position: absolute;
    /* width: 25px; */
    /* height: 25px; */
    /* bottom: 0px; */
    color: white;
    /* float: right; */
    padding: 3px;
    font-size: 25px;
    /* left: 0px; */
    right: 0px;
    margin-right: 4px;
    margin-top: -15px;
    z-index: 1;
    cursor: pointer

}

    /*    .fixed {
            position: fixed;
            top: 0;
            height: 70px;
            z-index: 1;
        }*/
</style>
<script>
$('body').on('click','.close_ad_btn',function(){
    $("#adbox").slideUp("slow");
    $("#adbox").remove();
})
</script>
<?php
}?>
<style>
    /*    .fixed {
            position: fixed; 
            top: 0; 
            height: 70px; 
            z-index: 1;
        }*/
</style>


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" async></script>
<script src="<?php echo $new_url; ?>assets_new/public/js/chosen.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
<script src="<?php echo $new_url; ?>assets_new/public/js/components.js" async></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    var new_url = "<?php echo $new_url; ?>";

    $.getScript(new_url+'assets_new/public/js/footer_scripts.js');
    $.getScript('//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js');

    function change_on_hover(id, type) {
        if (type == "1") {
            $('.league_side_id_' + id).css('color', '#b83c54');
        } else {
            $('.league_side_id_' + id).css('color', 'black');
        }

    }
    $(document).ready(function () {

        var mainTabs = $('#mainTabval').val();

        var subTabValue = $('#subTabval').val();
        var getPage = $('#getPage').val();
//        $.ajax({
//            type: "POST",
//            url: base_url + 'public/home/get_sub_tab_data',
//            data: {
//                mainTabs: mainTabs, subTabValue: subTabValue
//            },
//            success: function (msg) {
//                $('#subTabData').html(msg);
//            }
//        });
//        $.ajax({
//            url: base_url + "public/home/right_sidebar",
//            type: 'POST',
//            data: {
//                mainTabval: mainTabs,
//                getPage: getPage,
//            },
//            beforeSend: function (xhr) {
//
//                $('.right_banner_side').html("<img src='" + new_base_url + "assets_new/public/img/ajax-loader.gif' >");
//                $('.right_banner_side').addClass("text-center");
//            },
//            success: function (data, textStatus, jqXHR) {
//                $('.right_banner_side').removeClass("text-center");
//                $('.right_banner_side').html(data);
//                var right_side = $(".right_banner_side").outerHeight(true);
//                // if (left_side >= right_side) {
//                $(".sidebar").affix({offset: {top: right_side}});
//                //}
//            }, error: function (jqXHR, textStatus, errorThrown) {
//
//            }
//        });

        $(document).on("click", "span.disc-credit-show", function (e) {
            if ($(this).text() == "Credit") {
                $(this).text($(this).data("credit"));
                $(this).next("a").show();
            }
            else {
                $(this).text("Credit");
                $(this).next("a").hide();
            }
        })
        $(document).keyup(function (e) {

            if (e.which === 27) { // escape key maps to keycode `27`
                $(".cpylink").hide();
            }
        });
    });
    $(document).ready(function () {


        $('.right_banner_side').removeClass("text-center");
        var right_side = $(".right_banner_side").outerHeight(true);
        // if (left_side >= right_side) {
        $(".sidebar").affix({offset: {top: right_side}});


        $(document).on("click", "span.disc-credit-show", function (e) {
            if ($(this).text() == "Credit") {
                $(this).text($(this).data("credit"));
                $(this).next("a").show();
            }
            else {
                $(this).text("Credit");
                $(this).next("a").hide();
            }
        })
        $(document).keyup(function (e) {

            if (e.which === 27) { // escape key maps to keycode `27`
                $(".cpylink").hide();
            }
        });
    });

</script>
</body>

</html>
