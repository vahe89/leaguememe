 
<?php
$class = $this->router->fetch_class();
$method = $this->router->fetch_method();
echo $this->load->view('template/sidebar_list');
?>


<div  role="tabpanel" class="tab-pane right-panel-sec pad-left active"  id="news-outer"> 
    <div class="col-md-7 col-xs-12 col-sm-12 main-content ">
        <ul id="news-tabs" class="nav pop-tabs" role="tablist" style="margin-top: 10px;">
            <li role="presentation" style="margin-left: 0px; margin-right: -5px;" data-name="fav" class="<?= $maintabval == "fav" ? 'active' : '' ?>">
                <a href="<?= base_url() ?>news-list/bookmark"><i class="fa fa-bookmark" style="margin-top:5px"></i></a>
            </li> 
            <li role="presentation"  data-name="new" class="<?= $maintabval == "new" ? 'active' : '' ?>">
                <a  href="<?= base_url() ?>news-list/news">News</a>
            </li>
        </ul>
        <div  id="popular-news">
            <div style="text-align: center; padding-top: 50px">
                <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif" />
            </div>
        </div>
        <br>
        <div class="text-center col-md-12 mar-t-15">
            <span class="load-more-articleslist btn btn-red" style="width:70%;display: none" id="load-more-articleslist">Load More</span>
        </div>
        <input type="hidden" id="article_status" value="new">
        <input type="hidden" id="article_row" value="0">
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
<!-- end row -->  
<script>
    $(document).ready(function() {
        var lastActiveTab = '<?= $maintabval ?>';
        loadNews(lastActiveTab);
    })
    function loadNews(tab) {

        $.ajax({
            url: base_url + 'public/news/newsList',
            data: {
                row: 0, rowperpage: 5,
                main: tab
            },
            type: 'POST',
            dataType: 'HTML',
            beforeSend: function(xhr) {
                $("#popular-news").html('<div style="text-align: center; padding-top: 80px"><img src="' + base_url + 'assets/public/img/ajax-loader.gif" /></div>');
            },
            success: function(data, textStatus, jqXHR) {
                $("#news-outer #popular-news").html(data);
                var allcount = Number($('#article_total_groups').val());
                if (5 >= allcount) {
                    // Change the text and background
                    $('.load-more-articleslist').hide();
                } else {
                    $('.load-more-articleslist').show();
                    $(".load-more-articleslist").text("Load More");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#popular-news").html('<div style="text-align: center; padding-top: 80px">Error while loading News.</div>');
            }
        })
    }
    $('.load-more-articleslist').click(function() {
        var row = Number($('#article_row').val());
        var allcount = Number($('#article_total_groups').val());
        var article_tab = $('#article_status').val();
        var rowperpage = 5;
        row = row + rowperpage;

        if (row <= allcount) {
            $("#article_row").val(row);

            $.ajax({
                url: base_url + 'public/news/newsList',
                type: 'post',
                data: {row: row, rowperpage: rowperpage, main: article_tab},
                beforeSend: function() {
                    $(".load-more-articleslist").text("Loading...");
                },
                success: function(response) {

                    $(".popular-news:last").after(response).show().fadeIn("slow");
                    var rowno = row + rowperpage;
                    if (rowno > allcount) {

                        $('.load-more-articleslist').hide();
                    } else {
                        $('.load-more-articleslist').show();
                        $(".load-more-articleslist").text("Load more");

                    }

                }
            });
        } else {
            $('.load-more-articleslist').show();
            $('.load-more-articleslist').text("Loading...");

            $("#article_row").val(0);

            $('.load-more-articleslist').text("Load more");



        }

    });
</script>
<script async="" src="<?php echo base_url(); ?>assets/public/js/news.js" type="text/javascript"></script>




