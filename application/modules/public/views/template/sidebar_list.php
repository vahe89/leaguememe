<?php
$method = $this->router->fetch_method();
$category = $this->uri->segment(2);
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
                    <ul class="nav nav-tabs draggable draggable-center" id="index-main-tab" role="tablist">

                        <li class="dropdown <?= (isset($active_menu) && !empty($active_menu) && $active_menu == "leaguememe") ? 'active' : '' ?>"  role="presentation" >
                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown" id="league_drop" data-id="league_drop"  >Leaguememe (<span id="freshVal" style="text-transform: capitalize">All</span>) <span class="caret"></span></a>
                            <ul class="dropdown-menu" style="width:100%">

                                <li class="dropdown dropdown-submenu <?= (isset($method) && !empty($method) && $method == "index") ? 'active' : '' ?>" >
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Season 7 (<span id="subfreshVal" style="text-transform: capitalize">All</span>) &nbsp;&nbsp;&nbsp;&nbsp;</a>
                                    <ul class="dropdown-menu" id="subTabData" role="menu">
                                        <?php echo $sub_items; ?>
                                    </ul>
                                </li>
                                <li class="<?= (isset($method) && !empty($method) && $method == "season_index") ? 'active' : '' ?>">
                                    <a href="<?= base_url() ?>season-old">Season 6-1</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                        $sorting = array();
                        $sorting['discussion'] = '<li role="presentation" class="' . ((isset($active_menu) && !empty($active_menu) && $active_menu == 'discussion') ? 'active' : '') . '" id="tab-disc">
                            <a href="' . base_url() . 'discussion">Discussion</a>
                        </li>';

                        $sorting['news'] = '<li role="presentation"  class="' . ((isset($active_menu) && !empty($active_menu) && $active_menu == "news-tab") ? 'active' : '') . '">
                            <a href="' . base_url() . 'news-list" >News</a>
                        </li>';
                        $sorting['gamechat'] = '<li role="presentation"   class="' . ((isset($active_menu) && !empty($active_menu) && $active_menu == "gamechat") ? 'active' : '') . '">
                            <a href="' . base_url() . 'gamechat" >Gamechat</a>
                        </li>';
                        $sorting['event'] = '<li role="presentation"   class="' . ((isset($active_menu) && !empty($active_menu) && $active_menu == "event") ? 'active' : '') . '">
                            <a href="' . base_url() . 'event" >Event</a>
                        </li>';
                        $sorting['poll'] = '<li role="presentation"   class="' . ((isset($active_menu) && !empty($active_menu) && $active_menu == "poll") ? 'active' : '') . '">
                            <a href="' . base_url() . 'poll" >Poll</a>
                        </li>';
                        $sorting['patchnote'] = '<li role="presentation"   class="' . ((isset($active_menu) && !empty($active_menu) && $active_menu == "patch_note") ? 'active' : '') . '">
                            <a href="' . base_url() . 'patch-note" >Patch Note</a>
                        </li>';
                        $reorder = array();
                        if (!empty($getTabposition) || isset($getTabposition)) {
                            foreach ($getTabposition as $tabs) {
                                if (!empty($tabs->display) || $tabs->display == "1") {
                                    $reorder[$tabs->position] = $sorting[$tabs->tab_name];
                                }
                            }
                            foreach ($reorder as $val) {
                                echo $val;
                            }
                        }
                        ?>
<!--                        <li role="presentation" class="<?= (isset($active_menu) && !empty($active_menu) && $active_menu == "discussion") ? 'active' : '' ?>" id="tab-disc">
                            <a href="<?= base_url() ?>discussion">Discussion</a>
                        </li>
                        <li class="<?= (isset($active_menu) && !empty($active_menu) && $active_menu == "news-tab") ? 'active' : '' ?>" role="presentation">
                            <a href="<?= base_url() ?>news-list">News</a>
                        </li>
                        <li class="<?= (isset($active_menu) && !empty($active_menu) && $active_menu == "gamechat") ? 'active' : '' ?>" role="presentation">
                            <a href="<?= base_url() ?>gamechat">Gamechat</a>
                        </li>
                        <li role="presentation" class="<?= (isset($active_menu) && !empty($active_menu) && $active_menu == "event") ? 'active' : '' ?>">
                            <a  href="<?php echo base_url(); ?>event">Event</a>
                        </li>
                        <li role="presentation" class="<?= (isset($active_menu) && !empty($active_menu) && $active_menu == "poll") ? 'active' : '' ?>">
                            <a href="<?= base_url() ?>poll"  >Poll</a>
                        </li>-->

                    </ul>
                </div>
                <div class="tab-content">
                    <div class="visible-xs" style="padding-top: 30px">
                        <?php
                        if (empty($category)) {
                            $type = "Pics";
                        } else if ($category == "art") {
                            $type = "Art/Cosplay";
                        } else {
                            $type = ucfirst($category);
                        }
                        if (isset($active_menu) && !empty($active_menu)) {
                            if ($active_menu == "leaguememe") {
                                ?>
                                <div class="inline-league-btn">
                                    <?php
                                    if (isset($method) && !empty($method) && trim($method) == "season_index") {
                                        // do nothing
                                    } else {
                                        ?>
                                        <a href="javascript:void(0)" <?= (isset($username) && !empty($username)) ? "" : 'data-target="#login" data-toggle="modal"' ?>  class="btn btn-new-thread <?= (isset($username) && !empty($username)) ? "onePieceThread" : "" ?> " >
                                            <i class="fa fa-plus-circle"> </i> Upload <?= $type ?>
                                        </a>
                                        <?php
                                    }
                                    ?>

                                    <a href="javascript:void(0)" class="btn btn-back-thread onePieceBack" style="display: none;" >
                                        Back
                                    </a>
                                </div>
                                <?php
                            } else if ($active_menu == "discussion") {
                                ?>
                                <div class="inline-disc-btn">
                                    <a class="btn btn-new-thread discussionThread" <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#upload-discussion-tab"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)" ' ?> >
                                        <i class="fa fa-plus-circle"></i>
                                        Create Discussion
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-back-thread discussionBack" style="display: none;">
                                        Back
                                    </a>
                                </div>
                                <?php
                            } else if ($active_menu == "gamechat") {
                                ?>
                                <div class="inline-gamechat-btn">
                                    <a class="btn btn-new-thread gamechatThread" <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#uploadGamechat"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)"  ' ?>>
                                        <i class="fa fa-plus-circle"> </i> Gamechat
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-back-thread gamechatBack" style="display: none;">
                                        Back
                                    </a>
                                </div>
                                <?php
                            } else if ($active_menu == "poll") {
                                ?>
                                <div class="inline-poll-btn">
                                    <a <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#upload-poll-tab"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)"' ?> class="btn btn-new-thread pollThread" >
                                        <i class="fa fa-plus-circle"></i>
                                        Create Poll
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-back-thread pollBack" style="display: none;">
                                        Back
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>


                        <!-- <div class="inline-event-btn" style="display: none">
                                <a class="btn btn-new-thread  " <?= (isset($username) && !empty($username)) ? ' onclick="loadEvent(\'form\')" ' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)" ' ?> >
                                    <i class="fa fa-plus-circle"></i>
                                    Create Event
                                </a>
                            </div>-->

                        <a href="javascript:void(0);" class="btn btn-more-detail" onclick="toggler('index1');"> More info </a>
                    </div>
                    <div class="left-panel-sec  " id="index1">
                        <div class="hidden-xs">
                            <?php
                            if (isset($active_menu) && !empty($active_menu)) {
                                if ($active_menu == "leaguememe") {
                                    ?>
                                    <div class="inline-league-btn">
                                        <?php
                                        if (isset($method) && !empty($method) && trim($method) == "season_index") {
                                            // do nothing
                                        } else {
                                            ?>
                                            <a href="javascript:void(0)" <?= (isset($username) && !empty($username)) ? "" : 'data-target="#login" onclick="$(\'#login\').modal()"' ?>  class="btn btn-new-thread <?= (isset($username) && !empty($username)) ? "onePieceThread" : "" ?> " >
                                                <i class="fa fa-plus-circle"> </i> Upload <?= $type ?>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                        <a href="javascript:void(0)" class="btn btn-back-thread onePieceBack" style="display: none;" >
                                            Back
                                        </a>
                                    </div>
                                    <?php
                                } else if ($active_menu == "discussion") {
                                    ?>
                                    <div class="inline-disc-btn" >
                                        <a class="btn btn-new-thread discussionThread" <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#upload-discussion-tab"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)" ' ?> >
                                            <i class="fa fa-plus-circle"></i>
                                            Create Discussion
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-back-thread discussionBack" style="display: none;">
                                            Back
                                        </a>
                                    </div>
                                    <?php
                                } else if ($active_menu == "gamechat") {
                                    ?>
                                    <div class="inline-gamechat-btn "  >
                                        <a   <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#uploadGamechat"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)"' ?>class="btn btn-new-thread gamechatThread">
                                            <i class="fa fa-plus-circle"> </i> Gamechat
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-back-thread gamechatBack" style="display: none;">
                                            Back
                                        </a>
                                    </div>
                                    <?php
                                } else if ($active_menu == "poll") {
                                    ?>
                                    <div class="inline-poll-btn">
                                        <a <?= (isset($username) && !empty($username)) ? 'data-toggle="tab" role="tab"  href="#upload-poll-tab"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)"' ?> class="btn btn-new-thread pollThread" >
                                            <i class="fa fa-plus-circle"></i>
                                            Create Poll
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-back-thread pollBack" style="display: none;">
                                            Back
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                            ?>



                            <!--   <div class="inline-event-btn" style="display: none">
                                        <a class="btn btn-new-thread  " <?= (isset($username) && !empty($username)) ? 'onclick="loadEvent(\'form\')"' : 'data-target="#login" data-toggle="modal"  href="javascript:void(0)" ' ?> >
                                            <i class="fa fa-plus-circle"></i>
                                            Create Event
                                        </a>
                                    </div>-->

                        </div>
                        <?php
                        if (count($new_post) > 0) {
                            foreach ($new_post as $key => $data) {
                                if($key == 0){
                                    $border = "border-bottom: medium none";
                                }else{
                                   $border = ""; 
                                }
                                ?>
                        <div class="wrap-panel" style="<?= $border ?>">
                                    <div class="title">
                                        <p><?= $data['section_name'] ?></p>
                                    </div>
                                    <div class="content-panel">
                                        <ul class="list-unstyled">
                                            <?php
                                            $title = explode("^^%%^^", $data['title']);
                                            $link = explode("^^%%^^", $data['link']);
                                            $position = explode("^^%%^^", $data['position']);
                                            $sidearray = array();
                                            foreach ($title as $key => $tit) {
                                                $sidearray[$key]['title'] = trim($tit, ",");
                                                $sidearray[$key]['link'] = trim($link[$key], ",");
                                                $sidearray[$key]['position'] = trim($position[$key], ",");
                                            }
                                            usort($sidearray, function($a, $b) {
                                                if ($a['position'] === $b['position'])
                                                    return 0;
                                                
                                                return ($a['position'] < $b['position']) ? -1 : 1;
                                            }); 
                                            ?>
                                            <?php
                                            foreach ($sidearray as $val) {
                                                if (!empty($val)) {
                                                    $urlStr = $val['link'];
                                                    $parsed = parse_url($urlStr);
                                                    if (empty($parsed['scheme'])) {
                                                        $urlStr = 'http://' . ltrim($val['link'], '/');
                                                    }
                                                    ?>
                                                    <li style="text-transform:uppercase"><a target="_blank" href="<?php echo $urlStr; ?>"><?php echo $val['title']; ?></a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="wrap-panel">
                                <div class="title">
                                    <p>NEWS</p>
                                </div>
                                <div class="content-panel">
                                    <ul class="list-unstyled"> 
                                        <li style="text-transform:uppercase"><a target="_blank" href="">No data found</a>
                                        </li> 
                                    </ul>
                                </div>
                            </div>
                        <?php }
                        ?>



                        <!-- end wrap-panel-->

                        <div class="wrap-panel uns-list" style="display: none">
                            <div class="title">
                                <p>GROUP</p>
                            </div>
                            <div class="content-panel">
                                <ul class="list-unstyled">
                                    <li><a href="">ONE PIECE</a>
                                    </li>
                                    <li><a href="">NARUTO</a>
                                    </li>
                                    <li><a href="">DORAEMON</a>
                                    </li>
                                    <li><a href="">BLEACH</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end wrap-panel-->
                    </div>






