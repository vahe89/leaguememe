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