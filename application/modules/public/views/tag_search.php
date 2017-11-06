<?php
echo $this->load->view('template/sidebar_list');
?>
<style>
    #index1 {
        display: none;
    }
    .draggable-container {
        display: none;
    }
    .tab-top,.tab-not-login {
        margin-top:0px;
    }
    .right-panel-sec{
        min-height: 600px;
    }
</style>
<div class="right-panel-sec">
    <div class="row">
        <div class="col-md-12 main-content">


            <div id="popContent" class="tab-content">
                <!-- popular-->
                <input type="hidden" name="tag_names" id="tag_names" value="<?php echo $tag_league_name; ?>"/>
                <div role="tabpanel" class="tab-pane fade in active" id="newTab">
                    <div id="league_tag_list">

                    </div>
                    <div class="animation_image" style="display:none;background: #F9FFFF;border: 1px solid #E1FFFF;padding: 10px;width: 500px;margin-right: auto;margin-left: auto;" align="center">
                        <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
                    </div>
                </div>

            </div>


        </div>

        <!--<div class="col-md-5 col-sm-12 ads">-->
            <?php
//            echo $this->load->view('template/right_sidebar');
            ?>

        <!--</div>-->
        <!--end ads-->
    </div>
</div>


<script>
    var tagname = $('#tag_names').val();
    var totalData = <?php echo $total_rows; ?>;
    var track_load = 1; //total loaded record group(s)
    var loading = false; //to prevents multipal ajax loads
    var total_groups = "<?php echo $total_groups ?>"; //total record group(s)
    list_tag_leagues();
    function list_tag_leagues() {
        $.ajax({
            type: "POST",
            url: base_url + 'public/leaguelist/list_tag_leagues',
            data: {
                tags: tagname,
                total_data: totalData
            },
            success: function (msg) {
                if (msg == "home")
                {
                    // window.location.href = "<?php //echo base_url();       ?>home";

                    var html_msg = '<strong><h2><u style="color:red">' + tagname + '</u> Tag Name Not Found</h2></strong>' +
                            '<a href="<?php echo base_url(); ?>home"><button class="btn btn-primary">Go to Home</button></a>';

                    $('#league_tag_list').html(html_msg);
                }
                else {
                    $('#league_tag_list').html(msg);
                }
            }
        });
    }

    $(document).ready(function () {

        $('#search').on('keypress', function (event) {
            if (event.which == 13) {
                $('#search_form_name').submit();
            }
        });

        $(window).scroll(function () { //detect page scroll

            if ($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
            {
                if (track_load <= total_groups - 1 && loading == false) //there's more data to load
                {
                    loading = true; //prevent further ajax loading
                    $('.animation_image').show(); //show loading image
                    $.ajax({
                        type: "POST",
                        url: base_url + 'public/leaguelist/list_tag_scroll',
                        data: {group_no: track_load, tags: tagname},
                        success: function (msg) {
                            $('#league_tag_list').append(msg);
                            $('.animation_image').hide(); //hide loading image once data is received
                            track_load++; //loaded group increment
                            loading = false;
                        }
                    });
                }
            }
        });
    });
</script>
<script src="<?php echo base_url(); ?>assets/public/js/league.js" type="text/javascript"></script>



