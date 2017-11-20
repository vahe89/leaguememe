<style>
    div.background-cover {
        display: none;
    } 
    body {
        background-color:#eee;
    } 
</style>
<!--content section-->
<div class="container no-padding">
    <div class="single-panel single-panel-view" style="margin-top: 70px;">
        <div class="col-md-8 mar-t-20" style="padding-right: 5px;">
            <h4 class="block-title"><span>Trending Now</span></h4>
            <div class="outer-thumb">
                <div class="wrap-trending-articel" id="trending_articles">
                </div>
                <div class="text-center">
                    <span class="load-more-trending-articles btn btn-red" style="width:50%" id="load-more-trending-articles">Load More</span>
                </div>

                <input type="hidden" id="trending_row" value="0">
                <input type="hidden" id="trending_all" value="<?php echo $allcount; ?>">
            </div>

            <div class="outer-last">
                <div class="block-title"><span>Latest Article</span></div>
                <div class="wrap-latest-articel">
                    <div class="col-md-12 wrap-news-articel " id="latest_article">

                    </div>
                    <div class="text-center">
                        <span class="load-more-articles btn btn-red" style="width:50%" id="load-more-articles">Load More</span>
                    </div>

                    <input type="hidden" id="row" value="0">
                    <input type="hidden" id="all" value="<?php echo $allcount; ?>">
                </div>
            </div>
        </div>

         <?php echo $this->load->view('articles_right_sidebar')?>

    </div>
</div>
<script>
    $(document).ready(function() {
        var allcount = Number($('#all').val());
        var trendingallcount = Number($('#trending_all').val());
        $.ajax({
            url: base_url + 'public/news/getAjaxArticles',
            type: 'post',
            data: {row: 0, rowperpage: 5,action : 1},
            beforeSend: function() {
                $("#latest_article").html("<div class='text-center'><img src='<?= base_url() ?>assets/public/img/ajax-loader.gif'></div>");
                $(".load-more-articles").text("Loading...");
                $('.load-more-articles').hide();
            },
            success: function(response) {

                $('#latest_article').html(response);
                if (5 >= allcount) {

                    // Change the text and background
                    $('.load-more-articles').remove();
                } else {
                    $(".load-more-articles").text("Load More");
                    $('.load-more-articles').show();
                }


            }
        });
        $.ajax({
            url: base_url + 'public/news/getAjaxTrendingArticles',
            type: 'post',
            data: {row: 0, rowperpage: 6,action : 1},
            beforeSend: function() {
                $("#trending_articles").html("<div class='text-center'><img src='<?= base_url() ?>assets/public/img/ajax-loader.gif'></div>");
                $(".load-more-trending-articles").text("Loading...");
                $('.load-more-trending-articles').hide();
            },
            success: function(response) {

                $('#trending_articles').html(response);
                if (6 >= trendingallcount) {

                    // Change the text and background
                    $('.load-more-trending-articles').remove();
                } else {
                    $(".load-more-trending-articles").text("Load More");
                    $('.load-more-trending-articles').show();
                }


            }
        });
      
        // Load more data
        $('.load-more-articles').click(function() {
            var row = Number($('#row').val());
            var allcount = Number($('#all').val());
            var rowperpage = 5;
            row = row + rowperpage;

            if (row <= allcount) {
                $("#row").val(row);

                $.ajax({
                    url: base_url + 'public/news/getAjaxArticles',
                    type: 'post',
                    data: {row: row, rowperpage: rowperpage},
                    beforeSend: function() {
                        $(".load-more-articles").text("Loading...");
                    },
                    success: function(response) {

//                        setTimeout(function() {
                        $(".latest_article:last").after(response).show().fadeIn("slow");

                        var rowno = row + rowperpage;

                        // checking row value is greater than allcount or not
                        if (rowno > allcount) {

                            // Change the text and background
                            $('.load-more-articles').text("Hide All(Except First " + rowperpage + " Articles)");
//                            $('.load-more-articles').css("background", "darkorchid");
                        } else {
                            $(".load-more-articles").text("Load more");
                        }
//                        }, 2000);
 
                    }
                });
            } else {
                $('.load-more-articles').text("Loading...");

//                setTimeout(function() {

                // When row is greater than allcount then remove all class='post' element after 3 element
                $('.latest_article:nth-child(' + rowperpage + ')').nextAll('.latest_article').remove();

                // Reset the value of row
                $("#row").val(0);

                // Change the text and background
                $('.load-more-articles').text("Load more");
//                $('.load-more-articles').css("background", "#15a9ce");

//                }, 2000);


            }

        });

        $('.load-more-trending-articles').click(function() {
            var row = Number($('#trending_row').val());
            var allcount = Number($('#trending_all').val());
            var rowperpage = 6;
            row = row + rowperpage;

            if (row <= allcount) {
                $("#trending_row").val(row);

                $.ajax({
                    url: base_url + 'public/news/getAjaxTrendingArticles',
                    type: 'post',
                    data: {row: row, rowperpage: rowperpage},
                    beforeSend: function() {
                        $(".load-more-trending-articles").text("Loading...");
                    },
                    success: function(response) {

//                        setTimeout(function() {
                        // appending posts after last post with class="post"
                        $(".trending_articles:last").after(response).show().fadeIn("slow");

                        var rowno = row + rowperpage;

                        // checking row value is greater than allcount or not
                        if (rowno > allcount) {

                            // Change the text and background
                            $('.load-more-trending-articles').text("Hide All(Except First " + rowperpage + " Articles)");
//                            $('.load-more-trending-articles').css("background", "darkorchid");
                        } else {
                            $(".load-more-trending-articles").text("Load more");
                        }
//                        }, 2000);


                    }
                });
            } else {
                $('.load-more-trending-articles').text("Loading...");

                // Setting little delay while removing contents
//                setTimeout(function() {

                // When row is greater than allcount then remove all class='post' element after 3 element
                $('.trending_articles:nth-child(' + rowperpage + ')').nextAll('.trending_articles').remove();

                // Reset the value of row
                $("#trending_row").val(0);

                // Change the text and background
                $('.load-more-trending-articles').text("Load more");
//                $('.load-more-trending-articles').css("background", "#15a9ce");

//                }, 2000);


            }

        });

    });
</script>
