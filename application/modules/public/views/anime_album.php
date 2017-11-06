 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/public/css/img-hover.css">
<?php
if (empty($username)) {
    ?>
    <div class="col-md-12 tab-not-login  no-padding">

        <?php
    } else {
        ?>
        <div class="col-md-12 tab-top no-padding">
            <?php
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="draggable-container">
                    <ul class="nav nav-tabs draggable draggable-center" role="tablist">
                        <li role="presentation" class="active"><a href="#anime" aria-controls="anime" role="tab" data-toggle="tab">Anime</a></li>
                        <li role="presentation"><a href="#manga" aria-controls="manga" role="tab" data-toggle="tab">Manga</a></li>
                        <li role="presentation"><a href="#favorite" aria-controls="favorite" role="tab" data-toggle="tab">Favorite</a></li>
                        <li class="dropdown hide-dropdown-res pull-right" style="margin-right: 3px;">
                            <a href="#" class="dropdown-toggle dropdown-nav" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Anime Status
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-anime">
                                <li><a href="#">Available</a></li>
                                <li><a href="#">Available</a></li>
                                <li><a href="#">Available</a></li>
                            </ul>
                        </li>
                        <li class="dropdown hide-dropdown-res pull-right" style="margin-right: 3px;">
                            <a data-toggle="dropdown" class="btn dropdown-toggle dropdown-nav dropdown-genre">Genre <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-list">
                                <li>
                                    <input type="checkbox" id="ex2_1" name="ex2" value="1">
                                    <label for="ex2_1">Option1</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="ex2_2" name="ex2" value="2">
                                    <label for="ex2_2">Option2</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="ex2_3" name="ex2" value="3">
                                    <label for="ex2_3">Option3</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="ex2_4" name="ex2" value="4">
                                    <label for="ex2_4">Option4</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="ex2_5" name="ex2" value="5">
                                    <label for="ex2_5">Option5</label>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="anime">
                        <div class="">
                            <div class="container container-category">
                                <div class="single-panel">
                                    <div class="row alphabet-nav">
                                        <a href="javascript:void(0);" class="subTab" id="allanime"> # </a>
                                        <?php
                                        foreach (range('A', 'Z') as $column) {
                                            ?>
                                            <a href="javascript:void(0);" class="subTab" id="<?php echo $column; ?>" > <?php echo $column; ?></a>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="col-sm-12 right-inner-addon inner-res pull-right no-padding">
                                        <i class="fa fa-search" style="color: #b83c54;"></i>
                                        <input type="input" class="form-control" name="find-anime" placeholder="Find your anime" id="searchanimeres" />
                                    </div>
                                    <div class="search-bar col-md-12 col-sm-12">
                                        <div class="col-md-6 col-sm-6 wrap-pop no-padding">
                                            <ul id="pop" class="nav pop-tabs-category" role="tablist">
                                                <li role="presentation" class="active tabs">
                                                    <a href="#anime" id="popular" role="tab" data-toggle="tab" aria-controls="popular" aria-expanded="true">Popular</a>
                                                </li>
                                                <li role="presentation" class="mar-lm-5 tabs">
                                                    <a href="#anime" id="all" role="tab" data-toggle="tab" aria-controls="news">All</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-sm-6 right-inner-addon pull-right no-padding">
                                            <i class="fa fa-search" style="color: #b83c54;"></i>
                                            <input type="input" class="form-control" name="find-anime" placeholder="Find your anime" id="searchanime"/>
                                        </div>
                                        <div class="dropdown col-sm-6 alphabet-res">
                                            <button class="btn btn-trans dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><span id="freshVal">A - Z</span>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                <li role="presentation" class="subTabRes"><a role="menuitem" tabindex="-1"  href="javascript:void(0);" id="allanimeall" >All</a></li>
                                                <?php
                                                foreach (range('A', 'Z') as $column) {
                                                    ?>
                                                    <li role="presentation" class="subTabRes"> <a href="javascript:void(0);"  id="res_<?php echo $column; ?>" > <?php echo $column; ?></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tab-content">
                                        <div role="tabpanel" class="content-wrap no-padding tab-pane active" id="anime">
                                            <div id="loader" style="margin-left: 50%">
                                                <img src="<?php echo base_url(); ?>assets/public/img/ajax-loader.gif">
                                            </div>
                                            <div class="wrap-item" id="anime_id">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="manga">
                        <div class="h-600">Manga tab</div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="favorite">
                        <div class="h-600">Favorite tab</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/public/js/anime.js" type="text/javascript"></script>