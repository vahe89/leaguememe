<?php
$class = $this->router->fetch_class();
$method = $this->router->fetch_method();
echo $this->load->view('template/sidebar_list');
?>

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/public/css/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/public/css/slick-theme.css"/>
<div  role="tabpanel" class="tab-pane right-panel-sec pad-left active"  id="patch-outer"> 
    <div class="col-md-7 col-xs-12 col-sm-12 main-content ">
        <ul id="news-tabs" class="nav pop-tabs" role="tablist" style="margin-top: 10px;">
            <li role="presentation" style="margin-left: 0px; margin-right: -5px;" data-name="fav" class="<?= $maintabval == "fav" ? 'active' : '' ?>">
                <a href="<?= base_url() ?>patch-note/bookmark"><i class="fa fa-bookmark" style="margin-top:5px"></i></a>
            </li> 
            <li role="presentation"  data-name="new" class="<?= $maintabval == "new" ? 'active' : '' ?>">
                <a  href="<?= base_url() ?>patch-note/new">Patch Note</a>
            </li>
        </ul> 
        <div  id="patch_notes_list">
            <div style="text-align: center; padding-top: 50px">
                <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" />
            </div>
            <br>
            <div class="text-center col-md-12 mar-t-15">
                <span class="load-more-patchlist btn btn-red" style="width:70%;display: none" id="load-more-patchlist">Load More</span>
            </div>
            <input type="hidden" id="patch_status" value="new">
            <input type="hidden" id="patch_row" value="0">


        </div>
        <br>
        <div class="text-center col-md-12 mar-t-15">
            <span class="load-more-patch_notelist btn btn-red" style="width:70%;display: none" id="load-more-patch_notelist">Load More</span>
        </div>
        <input type="hidden" id="patch_note_status" value="new">
        <input type="hidden" id="patch_note_row" value="0">
    </div>

    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $this->load->view('template/right_sidebar', array(), true); ?>
    </div>
</div>
</div>

</div>
<!--end tab panel -->
</div>
<!-- tab content -->
</div>

<script>
    $(document).ready(function() {
        var lastActiveTab = '<?= $maintabval ?>';
        loadpatch(lastActiveTab);
    })
    var slickOpts  = {
        loop: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            dots: true,
            infinite: true,
            speed: 500,
            cssEase: 'linear',
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: false,
                    }
                }
            ]
    }; 
    function loadpatch(tab) {

        $.ajax({
            url: base_url + 'public/patch_note/list_patch',
            data: {
                row: 0, rowperpage: 5,
                main: tab
            },
            type: 'POST',
            dataType: 'HTML',
            beforeSend: function(xhr) {
                $("#patch_notes_list").html('<div style="text-align: center; padding-top: 80px"><img src="' + base_url + 'assets/public/img/ajax-loader.gif" /></div>');
            },
            success: function(data, textStatus, jqXHR) {
                $("#patch-outer #patch_notes_list").html(data);
                var allcount = Number($('#patch_total_groups').val());
                if (5 >= allcount) {
                    // Change the text and background
                    $('.load-more-patch_notelist').hide();
                } else {
                    $('.load-more-patch_notelist').show();
                    $(".load-more-patch_notelist").text("Load More");
                }
                 //$(data).find('.patch_slider').each(function(i, v) { 
                        //var id = $(this).attr('id');
                        //$('#' + id).slick(slickOpts);
                    //}); 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#patch_notes_list").html('<div style="text-align: center; padding-top: 80px">Error while loading Patch Notes.</div>');
            }
        })
    }
    $('.load-more-patch_notelist').click(function() {
        var row = Number($('#patch_note_row').val());
        var allcount = Number($('#patch_total_groups').val());
        var patch_tab = $('#patch_note_status').val();
        var rowperpage = 5;
        row = row + rowperpage;

        if (row <= allcount) {
            $("#patch_note_row").val(row);

            $.ajax({
                url: base_url + 'public/patch_note/list_patch',
                type: 'post',
                data: {row: row, rowperpage: rowperpage, main: patch_tab},
                beforeSend: function() {
                    $(".load-more-patch_notelist").text("Loading...");
                },
                success: function(response) {

                    $(".patch_notes_list:last").after(response).show().fadeIn("slow");
                    var rowno = row + rowperpage;
                    if (rowno > allcount) {

                        $('.load-more-patch_notelist').hide();
                    } else {
                        $('.load-more-patch_notelist').show();
                        $(".load-more-patch_notelist").text("Load more");

                    }
                   // $(response).find('.patch_slider').each(function(i, v) { 
                       // var id = $(this).attr('id'); 
                       // $('#' + id).slick(slickOpts);
                    //}); 

                }
            });
        } else {
            $('.load-more-patch_notelist').show();
            $('.load-more-patch_notelist').text("Loading...");

            $("#patch_note_row").val(0);

            $('.load-more-patch_notelist').text("Load more");



        }

    });
 
</script>
<script>
    $('.popup').click(function(event) {
        var width = 575,
                height = 400,
                left = ($(window).width() - width) / 2,
                top = ($(window).height() - height) / 2,
                url = this.href,
                opts = 'status=1' +
                ',width=' + width +
                ',height=' + height +
                ',top=' + top +
                ',left=' + left;

        window.open(url, 'twitter', opts);

        return false;
    });
</script>
<script>
    function fbs_click(id) {
        u = location.href + '-detail/' + id;
        console.log(u);
        t = document.title;
        window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
        return false;
    }
</script>
<script type="text/javascript" src="<?= base_url() ?>assets/public/js/slick.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/public/js/patch.js"></script>

