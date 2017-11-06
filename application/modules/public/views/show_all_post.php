<?php
echo $this->load->view('template/sidebar_list');
?>
<div class="right-panel-sec">
    <div class="row">
        <div class="col-md-7 main-content">

            <!-- tab -->
            <div class="col-md-8 no-padding">
                <ul id="pop" class="nav pop-tabs" role="tablist" style="margin-top:10px;">
                    <li role="presentation" class="active">
                        <a href="#popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
                    </li>
                    <li role="presentation" class="mar-lm-5">
                        <a href="#news" role="tab" data-toggle="tab" aria-controls="news">News</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4">
                <div class="trolls" style="margin-top: 20px;">
                    <a href="#" class="btn dropdown-toggle" id="allThings" type="button" data-toggle="dropdown">
                        <span class="linky">All The Things</span>
                        <span>&nbsp;&nbsp;&nbsp;<img src="assets/img/icon/post/dropdown.png"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="allThings">
                        <li><a href="#">Art</a></li>
                        <li><a href="#">Gif</a></li>
                        <li><a href="#">Manga</a></li>
                    </ul>
                </div>
            </div>

            <div id="popContent" class="tab-content">
                <!-- popular-->
                <div role="tabpanel" class="tab-pane fade in active" id="popular">
                    <div classs="row">

                        <div class="col-md-12">

                            
                            <h1>Under Construction !!!!!</h1>
                           

                        </div>
                        <!--end col-md-12-->

                    </div>
                </div>

                <!-- news -->
                <div role="tabpanel" class="tab-pane" id="news">
                    <p>
                        Hello World!
                    </p>
                </div>
            </div>


        </div>

        <div class="col-md-5 col-sm-12 ads ">
            <?php
            echo $this->load->view('template/right_sidebar');
            ?>
        </div>
        <!--end ads-->
    </div>
</div>