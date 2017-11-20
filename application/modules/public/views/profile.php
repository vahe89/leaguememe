<?php
$sidebar = $this->router->fetch_method();
$base_url = site_url() . $sidebar;
$user = $this->uri->segment(2);
$base_user_url = $base_url . '/' . $user;
if ($user != $username) {
    ?>
    <script>
        $(document).ready(function() {
            $("div").remove(".comment-status");
            $("div").remove(".comment-status-note");
        });
    </script>
    <?php
}
?>  

<!--- Modal notes --->
<div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i>
    </button>
    <div class="modal-dialog" role="document" style="width: 50%">
        <div class="modal-content">
            <div class="rounded"></div>

            <div class="editor-place">
                <div class="wrap-texteditor">
                    <div class="tinymce"> 
                        <?php
                        if (isset($userdetail['bio']) && !empty($userdetail['bio'])) {
                            echo $userdetail['bio'];
                             
                        } else { 
                            echo "";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="wrap-action-note">
                <div class="wrap-rule-note">
                    <div class="rule-note">
                        * To add photos/table please push enter on the keyboard after your paragraph is completed. Double-click to align your photo/table
                    </div>
                    <div class="rule-note">
                        * Double click on your paragraph to use features available in this editor
                    </div>
                </div>
                <div class="btn btn-red" onclick="bioupdate();" >
                    Save
                </div>
            </div>
            <!-- end modal header-->
        </div>
    </div>
</div>
<div class="col-md-12 tab-top-profile no-padding">
    <div class="container">
        <div class="row">
            <div class="wrap-profile">
                <div class="img-profile"> 
                    <?php
                    if (isset($userdetail['user_image']) && !empty($userdetail['user_image'])) {
                        ?> 
                        <img   src="<?php echo base_url(); ?>uploads/users/<?php echo $userdetail['user_image']; ?>" alt="">

                        <?php
                    } else {
                        ?>
                        <img  src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="profile pic">
                        <?php
                    }
                    ?>

                </div>
                <div class="overlay-edit hide-cover">
                    <a href="#" class="wrap-edit-avatar">	
                        Edit Avatar
                        <div class="icon-edit-overlay">
                            <i class="fa fa-camera"></i>
                        </div>
                    </a>
                </div>
                <div class="info-account">
                    <div class="name-user"> <?php echo empty($userdetail['name']) ? $userdetail['user_name'] : $userdetail['name']; ?>
                        <a href="#" class="btn dropdown-toggle detail-dropdown" id="user-detail" type="button" data-toggle="dropdown"> <span class="dropdown-info"><img src="<?php echo base_url(); ?>assets/public/img/arrow-down.png"></span> </a>
                        <div class="content-panel dropdown-menu position-detail" role="menu" aria-labelledby="user-detail">
                            <table class="table info-table">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td><?php echo empty($userdetail['name']) ? $userdetail['user_name'] : $userdetail['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Last online</td>
                                        <td>:</td>
                                        <?php if ($userdetail['online_status'] === 'offline') {
                                            ?>
                                            <td data-livestamp="<?php echo strtotime($userdetail['user_timestamp']); ?>"><?php echo strtotime($userdetail['user_timestamp']); ?></td>
                                            <?php
                                        } else {
                                            ?>
                                            <td><?php echo $userdetail['online_status']; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>:</td>
                                        <td><?php echo $userdetail['gender']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Birthday</td>
                                        <td>:</td>
                                        <td><?php echo $userdetail['dob']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td>:</td>
                                        <td><?php echo $userdetail['user_region']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Join Date</td>
                                        <td>:</td>
                                        <td><?php
                                        $date = explode(" ", $userdetail['user_timestamp']);
                                        echo $date[0];
                                        ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="draggable-container">
                <ul class="nav nav-tabs draggable draggable-center" role="tablist">
                    <li role="presentation" class="active"><a href="#profile" aria-controls="anime" role="tab" data-toggle="tab">Profile</a></li>
                    <?php
                    if ($user === $username) {
                        ?>
                        <li role="presentation"><a href="#edit-profile" aria-controls="edit-profile" role="tab" data-toggle="tab">Edit Profile</a></li>
                        <li role="presentation"><a href="#favorite-profile" aria-controls="favorite" role="tab" data-toggle="tab">Favorite</a></li>
                        <!--<li role="presentation"><a href="#logout" aria-controls="manga" role="tab" data-toggle="tab">Logout</a></li>-->                       
                        <?php
                    } else {
                        ?> 
                        <input type="hidden"   id="about_id" value="<?= $userdetail['user_name'] ?>">
                        <li role="presentation"><a href="#edit-profile" aria-controls="edit-profile" role="tab" data-toggle="tab" onclick="aboutProfile()">About Profile</a></li>
                        <?php
                    }
                    ?>

                </ul>
            </div>

            <?php
            $message = $this->session->flashdata('request');
            if ($message != '') {

                if ($message === "error") {
                    ?>
                    <center>
                        <div class="alert alert-danger alert-dismissable" style="width: 40%">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                            <strong>
                                <?php echo "Make sure your image is valid !!"; ?>
                            </strong>
                        </div>
                    </center>
                    <?php
                } else {
                    ?>
                    <center>
                        <div class="alert alert-success alert-dismissable" style="width: 40%">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                            <strong>
                                <?php echo $message; ?>
                            </strong>
                        </div>
                    </center>
                    <?php
                }
            }
            ?>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="profile">
                    <!--<a href="javascript:void(0);" class="btn btn-more-detail" onclick="toggler('leftProfile');"> More info </a>-->
                    <div class="">
                        <div class="right-panel-sec right-res-profile panel-edit-profile">
                            <div class="row">
                                <div id="profile_content">
                                    <div class="col-md-12 main-content" id='timelineaqEWrdgf'>
                                        <h4 class="aboutme">  About <?php echo empty($userdetail['name']) ? $userdetail['user_name'] : $userdetail['name']; ?>
                                        </h4>
                                        <div class="comment-status-note"> 
                                            <a data-toggle="modal" href="#" data-target="#modal-note">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a> 
                                        </div>
                                        <hr style="margin-top: 5px !important"/>
                                        <?php echo $userdetail['bio']; ?> 
                                        <br>
                                        <div class="col-md-6 col-xs-12" id="comment_left">
                                            <div class="tab-comment">
                                                <ul id="pop" class="nav pop-tabs pop-view" role="tablist">
                                                    <li role="presentation" class="active">
                                                        <a href="#summoner" role="tab" data-toggle="tab" aria-controls="summoner" aria-expanded="true">Summoner info</a>
                                                    </li>
                                                    <li style="float:right;">
                                                        <div class="comment-status" id="btn-edit-summoner">
                                                            <a href="javascript:void(0)" >
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                        </div>

                                                        <div class="edit-comment-status" style="display: none" id="btn-save-summoner">
                                                            <a href="javascript:void(0)">
                                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            </a>
                                                            <div class="btn-save-edit">Save</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <hr/>
                                                <div class="tab-content tab-review-panel">
                                                    <!-- popular-->
                                                    <div role="tabpanel" class="tab-pane active" id="summoner">
                                                        <div class="show-anime-review" id="show-summoner-info">
                                                            <div class="wrapper-badge">
                                                                <img src="<?= base_url() ?>assets/public/img/<?= (isset($summoner->sum_img) && !empty($summoner->sum_img)) ? $summoner->sum_img : 'badge1.png' ?>">
                                                            </div>
                                                            <div class="right-side">
                                                                <ul class="info">
                                                                    <li class="list-info">
                                                                        <span>Summoner</span>
                                                                        <span>:</span>
                                                                        <span><?= (isset($summoner->name) && !empty($summoner->name)) ? $summoner->name : "N/A" ?></span>
                                                                    </li>
                                                                    <li class="list-info">
                                                                        <span>Server</span>
                                                                        <span>:</span>
                                                                        <span><?= (isset($summoner->server) && !empty($summoner->server)) ? $summoner->server : "N/A" ?></span>
                                                                    </li>
                                                                    <li class="list-info">
                                                                        <span>Level</span>
                                                                        <span>:</span>
                                                                        <span><?= (isset($summoner->level) && !empty($summoner->level)) ? $summoner->level : "N/A" ?></span>
                                                                    </li>
                                                                    <li class="list-info">
                                                                        <span>Tier</span>
                                                                        <span>:</span>
                                                                        <span><?= (isset($summoner->tier) && !empty($summoner->tier)) ? $summoner->tier : "N/A" ?></span>
                                                                    </li>
                                                                    <li class="list-info">
                                                                        <span>Division</span>
                                                                        <span>:</span>
                                                                        <span><?= (isset($summoner->div) && !empty($summoner->div)) ? $summoner->div : "N/A" ?></span>
                                                                    </li>
                                                                    <li class="list-info">
                                                                        <span>Fav Champ (s)</span>
                                                                        <span>:</span>
                                                                        <span><?= (isset($summoner->fav_champ) && !empty($summoner->fav_champ)) ? $summoner->fav_champ : "N/A" ?></span>
                                                                    </li>
                                                                    <li class="list-info">
                                                                        <span>Fav Role (s)</span>
                                                                        <span>:</span>
                                                                        <span><?= (isset($summoner->role) && !empty($summoner->role)) ? $summoner->role : "N/A" ?> </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <form name="summoner-form" method="POST" action="<?= base_url("public/user/save_summoner") ?>">
                                                            <div class="edit-anime-review" id="edit-summoner-container" style="display: none">
                                                                <div class="wrapper-badge">
                                                                    <?php
                                                                    $sum_img = (isset($summoner->sum_img) && !empty($summoner->sum_img)) ? $summoner->sum_img : "badge1.png";
                                                                    ?>
                                                                    <select class="my-select" name="summoner-image">
                                                                        <option data-img-src="<?= base_url() ?>assets/public/img/badge6.png" <?= ($sum_img == "badge6.png" ) ? "selected='selected'" : "" ?> value="badge6.png" >&nbsp;</option>
                                                                        <option data-img-src="<?= base_url() ?>assets/public/img/badge5.png" <?= ($sum_img == "badge5.png" ) ? "selected='selected'" : "" ?> value="badge5.png">&nbsp;</option>
                                                                        <option data-img-src="<?= base_url() ?>assets/public/img/badge4.png" <?= ($sum_img == "badge4.png" ) ? "selected='selected'" : "" ?> value="badge4.png">&nbsp;</option>
                                                                        <option data-img-src="<?= base_url() ?>assets/public/img/badge3.png" <?= ($sum_img == "badge3.png" ) ? "selected='selected'" : "" ?> value="badge3.png">&nbsp;</option>
                                                                        <option data-img-src="<?= base_url() ?>assets/public/img/badge2.png" <?= ($sum_img == "badge2.png" ) ? "selected='selected'" : "" ?> value="badge2.png">&nbsp;</option>
                                                                        <option data-img-src="<?= base_url() ?>assets/public/img/badge1.png" <?= ($sum_img == "badge1.png" ) ? "selected='selected'" : "" ?> value="badge1.png">&nbsp;</option>
                                                                    </select>
                                                                </div>
                                                                <div class="right-side">

                                                                    <ul class="info">
                                                                        <li class="list-info">
                                                                            <label for="summoner">
                                                                            <span>Summoner</span>
                                                                            <span>:</span>
                                                                            </label>
                                                                            <span><input type="type" name="name" value="<?= isset($summoner->name) ? $summoner->name : "" ?>" placeholder="summonner" autocomplete="off"></span>
                                                                        </li>
                                                                        <li class="list-info">
                                                                            <label for="sel1">
                                                                                <span>Server</span>
                                                                                <span>:</span>
                                                                            </label>
                                                                            <?php
                                                                            $server = isset($summoner->server) ? $summoner->server : "";
                                                                            ?>
                                                                            <select class="form-control" id="sel1" name="server">
                                                                                <option <?= ($server == "NA" ) ? "selected='selected'" : "" ?>>NA</option>
                                                                                <option <?= ($server == "EUW" ) ? "selected='selected'" : "" ?>>EUW</option>
                                                                                <option <?= ($server == "EUNE" ) ? "selected='selected'" : "" ?>>EUNE</option>
                                                                                <option <?= ($server == "OCE" ) ? "selected='selected'" : "" ?>>OCE</option>
                                                                                <option <?= ($server == "RU" ) ? "selected='selected'" : "" ?>>RU</option>
                                                                                <option <?= ($server == "TR" ) ? "selected='selected'" : "" ?>>TR</option>
                                                                                <option <?= ($server == "BR" ) ? "selected='selected'" : "" ?>>BR</option>
                                                                                <option <?= ($server == "LAS" ) ? "selected='selected'" : "" ?>>LAS</option>
                                                                                <option <?= ($server == "LAN" ) ? "selected='selected'" : "" ?>>LAN</option>
                                                                            </select>
                                                                        </li>
                                                                        <li class="list-info">
                                                                            <label for="sel2">
                                                                                <span>Label</span>
                                                                                <span>:</span>
                                                                            </label>
                                                                            <?php
                                                                            $server = isset($summoner->level) ? $summoner->level : "";
                                                                            ?>
                                                                            <select class="form-control" id="sel2" name="label">
                                                                                <option <?= ($server == "1" ) ? "selected='selected'" : "" ?>>1</option>
                                                                                <option <?= ($server == "2" ) ? "selected='selected'" : "" ?>>2</option>
                                                                                <option <?= ($server == "3" ) ? "selected='selected'" : "" ?>>3</option>
                                                                                <option <?= ($server == "4" ) ? "selected='selected'" : "" ?>>4</option>
                                                                                <option <?= ($server == "5" ) ? "selected='selected'" : "" ?>>5</option>
                                                                                <option <?= ($server == "6" ) ? "selected='selected'" : "" ?>>6</option>
                                                                                <option <?= ($server == "7" ) ? "selected='selected'" : "" ?>>7</option>
                                                                                <option <?= ($server == "8" ) ? "selected='selected'" : "" ?>>8</option>
                                                                                <option <?= ($server == "9" ) ? "selected='selected'" : "" ?>>9</option>
                                                                                <option <?= ($server == "10" ) ? "selected='selected'" : "" ?>>10</option>
                                                                                <option <?= ($server == "11" ) ? "selected='selected'" : "" ?>>11</option>
                                                                                <option <?= ($server == "12" ) ? "selected='selected'" : "" ?>>12</option>
                                                                                <option <?= ($server == "13" ) ? "selected='selected'" : "" ?>>13</option>
                                                                                <option <?= ($server == "14" ) ? "selected='selected'" : "" ?>>14</option>
                                                                                <option <?= ($server == "15" ) ? "selected='selected'" : "" ?>>15</option>
                                                                                <option <?= ($server == "16" ) ? "selected='selected'" : "" ?>>16</option>
                                                                                <option <?= ($server == "17" ) ? "selected='selected'" : "" ?>>17</option>
                                                                                <option <?= ($server == "18" ) ? "selected='selected'" : "" ?>>18</option>
                                                                                <option <?= ($server == "19" ) ? "selected='selected'" : "" ?>>19</option>
                                                                                <option <?= ($server == "20" ) ? "selected='selected'" : "" ?>>20</option>
                                                                                <option <?= ($server == "21" ) ? "selected='selected'" : "" ?>>21</option>
                                                                                <option <?= ($server == "22" ) ? "selected='selected'" : "" ?>>22</option>
                                                                                <option <?= ($server == "23" ) ? "selected='selected'" : "" ?>>23</option>
                                                                                <option <?= ($server == "24" ) ? "selected='selected'" : "" ?>>24</option>
                                                                                <option <?= ($server == "25" ) ? "selected='selected'" : "" ?>>25</option>
                                                                                <option <?= ($server == "26" ) ? "selected='selected'" : "" ?>>26</option>
                                                                                <option <?= ($server == "27" ) ? "selected='selected'" : "" ?>>27</option>
                                                                                <option <?= ($server == "28" ) ? "selected='selected'" : "" ?>>28</option>
                                                                                <option <?= ($server == "29" ) ? "selected='selected'" : "" ?>>29</option>
                                                                                <option <?= ($server == "30" ) ? "selected='selected'" : "" ?>>30</option>
                                                                            </select>
                                                                        </li>
                                                                        <li class="list-info">
                                                                            <label for="sel3">
                                                                                <span>Tier</span>
                                                                                <span>:</span>
                                                                            </label>
                                                                            <?php
                                                                            $server = isset($summoner->tier) ? $summoner->tier : "";
                                                                            ?>
                                                                            <select class="form-control" id="sel3" name="tier">
                                                                                <option <?= ($server == "Bronze" ) ? "selected='selected'" : "" ?>>Bronze</option>
                                                                                <option <?= ($server == "Silver" ) ? "selected='selected'" : "" ?>>Silver</option>
                                                                                <option <?= ($server == "Gold" ) ? "selected='selected'" : "" ?>>Gold</option>
                                                                                <option <?= ($server == "Platinum" ) ? "selected='selected'" : "" ?>>Platinum</option>
                                                                                <option <?= ($server == "Diamond" ) ? "selected='selected'" : "" ?>>Diamond</option>
                                                                                <option <?= ($server == "Master" ) ? "selected='selected'" : "" ?>>Master</option>
                                                                                <option <?= ($server == "Challenger" ) ? "selected='selected'" : "" ?>>Challenger</option>
                                                                            </select>
                                                                        </li>
                                                                        <li class="list-info">
                                                                            <label for="sel4">
                                                                                <span>Division</span>
                                                                                <span>:</span>
                                                                            </label>
                                                                            <?php
                                                                            $server = isset($summoner->div) ? $summoner->div : "";
                                                                            ?>
                                                                            <select class="form-control" id="sel4" name="division">
                                                                                <option <?= ($server == "I" ) ? "selected='selected'" : "" ?>>I</option>
                                                                                <option <?= ($server == "II" ) ? "selected='selected'" : "" ?>>II</option>
                                                                                <option <?= ($server == "III" ) ? "selected='selected'" : "" ?>>III</option>
                                                                                <option <?= ($server == "IV" ) ? "selected='selected'" : "" ?>>IV</option>
                                                                                <option <?= ($server == "V" ) ? "selected='selected'" : "" ?>>V</option>
                                                                            </select>
                                                                        </li>
                                                                        <li class="list-info">
                                                                            <label for="Champs">
                                                                            <span>Fav Champs (s)</span>
                                                                            <span>:</span>
                                                                            </label>
                                                                            <span style="width: 135px;">
                                                                                <!--<input type="type" name="fav_champ" value="<?php echo isset($summoner->fav_champ) ? $summoner->fav_champ : ""; ?>" placeholder="fav champs" autocomplete="on" >-->
                                                                                <select id="champ_select"  multiple="multiple" name='fav_champ[]'>
                                                                                    <?php 
                                                                                    $valArray = explode(",", $summoner->fav_champ);
                                                                                     $vall = array();
                                                                                    foreach ($valArray as $val){
                                                                                        $vall[] = trim($val);
                                                                                    }
                                                                                    foreach ($champs as $cmp){
                                                                                        if(in_array(trim($cmp['champ_name']),$vall)){
                                                                                            ?>
                                                                                    <option value="<?= $cmp ['champ_name']?>" selected=""> <?= $cmp ['champ_name']?></option>
                                                                                    <?php
                                                                                        }else{
                                                                                         ?>
                                                                                    <option value="<?= $cmp ['champ_name']?>"> <?= $cmp ['champ_name']?></option>
                                                                                    <?php
                                                                                        }
                                                                                    } ?>
                                                                                    <option></option>  
                                                                                </select>
                                                                            </span>
                                                                            
                                                                        </li>
                                                                        <li class="list-info">
                                                                            <span>Fav Role (s)</span>
                                                                            <span>:</span>
                                                                            <?php
                                                                            $server = isset($summoner->role) ? $summoner->role : "";
                                                                            $role = explode(",", $server);
                                                                            ?>
                                                                            <div class="dropdown">
                                                                                <a data-toggle="dropdown" class="btn dropdown-toggle dropdown-nav dropdown-genre" id="dropdown-menu2"> <?= !empty($server) ? $server : "Role" ?></a>
                                                                                <ul class="dropdown-menu dropdown-menu-list noclose" aria-labelledby="dropdown-menu2">
                                                                                    <li>
                                                                                        <input <?= (in_array("Top", $role)) ? "checked" : "" ?> type="checkbox" id="ex1_4" name="fav_role[]" value="Top">
                                                                                        <label for="ex1_4">Top</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input <?= (in_array("Junggle", $role)) ? "checked" : "" ?> type="checkbox" id="ex1_3" name="fav_role[]" value="Junggle">
                                                                                        <label for="ex1_3">Junggle</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input <?= (in_array("Middle", $role)) ? "checked" : "" ?> type="checkbox" id="ex1_2" name="fav_role[]" value="Middle">
                                                                                        <label for="ex1_2">Middle</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input <?= (in_array("ADC", $role)) ? "checked" : "" ?> type="checkbox" id="ex1_5" name="fav_role[]" value="ADC">
                                                                                        <label for="ex1_5">ADC</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input <?= (in_array("Support", $role)) ? "checked" : "" ?> type="checkbox" id="ex1_6" name="fav_role[]" value="Support">
                                                                                        <label for="ex1_6">Support</label>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- tab panel -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12" id="comment_right">
                                            <div class="tab-comment">
                                                <ul id="pop" class="nav pop-tabs pop-view" role="tablist">
                                                    <li role="presentation" class="active">
                                                        <a href="#anime-popular" role="tab" data-toggle="tab" aria-controls="anime-popular" aria-expanded="true">Fav. Champ</a>
                                                    </li>
                                                    <li role="presentation" class="mar-lm-5">
                                                        <a href="#anime-news" role="tab" data-toggle="tab" aria-controls="anime-news">Fav. Skins</a>
                                                    </li>
                                                    <li style="float:right;">
                                                        <div class="comment-status" id="btn_edit_anime" data-type="comment_left">
                                                            <a href="javascript:void(0)">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                        </div>

                                                        <div class="edit-comment-status" style="display: none">
                                                            <a id="modal-add-list" class="modal-panel" href="#modal-edit-panel">
                                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                            </a>
                                                            <div class="btn-save-edit">Save</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <hr/>
                                                <div class="tab-content tab-review-panel">
                                                    <!-- popular-->
                                                    <div role="tabpanel" class="tab-pane active" id="anime-popular">
                                                        <div class="empty-anime-list"  style="display: none;">
                                                            <div class="btn btn-empty">
                                                                Add Favourite anime to list
                                                            </div>
                                                        </div>
                                                        <div class="show-anime">
                                                            <div class="ui half-hidden-covers list">
                                                                <a class="item" data-toggle="popup" href="#" data-content="anime1">
                                                                    <div class="half"> <img src="<?= base_url() ?>assets/public/img/anime1.jpg"> </div>
                                                                </a>
                                                                <a class="item" data-toggle="popup" href="#" data-content="anime2">
                                                                    <div class="half"> <img src="<?= base_url() ?>assets/public/img/anime2.jpg"> </div>
                                                                </a>
                                                                <a class="item" data-toggle="popup" href="#" data-content="anime3">
                                                                    <div class="half"> <img src="<?= base_url() ?>assets/public/img/anime3.jpg"> </div>
                                                                </a>
                                                                <a class="item" data-toggle="popup" href="#" data-content="anime4">
                                                                    <div class="half"> <img src="<?= base_url() ?>assets/public/img/anime4.jpg"> </div>
                                                                </a>
                                                                <a class="item" data-toggle="popup" href="#" data-content="anime5">
                                                                    <div class="half"> <img src="<?= base_url() ?>assets/public/img/anime5.jpg"> </div>
                                                                </a>
                                                                <a class="item" data-toggle="popup" href="#" data-content="anime4">
                                                                    <div class="half"> <img src="<?= base_url() ?>assets/public/img/anime4.jpg"> </div>
                                                                </a>
                                                            </div>
                                                            <div class="more-panel"><a href="#"> More...</a></div>
                                                        </div>
                                                        <div class="edit-anime" style="display: none;">
                                                            <div class="search-anime-panel">
                                                                <input type="text" class="form-control" placeholder="Search for...">
                                                                <ul id="sortable">
                                                                    <li class="ui-state-default">
                                                                        <div class="img-anime-panel">
                                                                            <img src="<?= base_url() ?>assets/public/img/Anime-list.jpg">
                                                                        </div>
                                                                        <div class="wrap-text-panel">
                                                                            <div class="title-edit-panel">
                                                                                One piece the little heaven
                                                                            </div>
                                                                            <a href="#" class="delete-panel">
                                                                                <i class="fa fa-times-circle"></i>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                    <li class="ui-state-default">
                                                                        <div class="img-anime-panel">
                                                                            <img src="<?= base_url() ?>assets/public/img/Anime-list.jpg">
                                                                        </div>
                                                                        <div class="wrap-text-panel">
                                                                            <div class="title-edit-panel">
                                                                                two piece the little heaven
                                                                            </div>
                                                                            <a href="#" class="delete-panel">
                                                                                <i class="fa fa-times-circle"></i>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                    <li class="ui-state-default">
                                                                        <div class="img-anime-panel">
                                                                            <img src="<?= base_url() ?>assets/public/img/Anime-list.jpg">
                                                                        </div>
                                                                        <div class="wrap-text-panel">
                                                                            <div class="title-edit-panel">
                                                                                three piece the little heaven
                                                                            </div>
                                                                            <a href="#" class="delete-panel">
                                                                                <i class="fa fa-times-circle"></i>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                    <li class="ui-state-default">
                                                                        <div class="img-anime-panel">
                                                                            <img src="<?= base_url() ?>assets/public/img/Anime-list.jpg">
                                                                        </div>
                                                                        <div class="wrap-text-panel">
                                                                            <div class="title-edit-panel">
                                                                                four piece the little heaven
                                                                            </div>
                                                                            <a href="#" class="delete-panel">
                                                                                <i class="fa fa-times-circle"></i>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                    <li class="ui-state-default">
                                                                        <div class="img-anime-panel">
                                                                            <img src="<?= base_url() ?>assets/public/img/Anime-list.jpg">
                                                                        </div>
                                                                        <div class="wrap-text-panel">
                                                                            <div class="title-edit-panel">
                                                                                five piece the little heaven
                                                                            </div>
                                                                            <a href="#" class="delete-panel">
                                                                                <i class="fa fa-times-circle"></i>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                    <li class="ui-state-default">
                                                                        <div class="img-anime-panel">
                                                                            <img src="<?= base_url() ?>assets/public/img/Anime-list.jpg">
                                                                        </div>
                                                                        <div class="wrap-text-panel">
                                                                            <div class="title-edit-panel">
                                                                                six piece the little heaven
                                                                            </div>
                                                                            <a href="#" class="delete-panel">
                                                                                <i class="fa fa-times-circle"></i>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- News -->
                                                    <div role="tabpanel" class="tab-pane" id="anime-news">
                                                        <div class="empty-anime-list">
                                                            <a class="btn btn-empty" id="manage-fav" href="javascript:void(0)">
                                                                Add Favourite manga to list
                                                            </a>

                                                            <div class="fav-anime-modal" style="display: none;">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading addlist-title">
                                                                        Add Favorite Anime
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <input type="text" class="input-panelAdd" placeholder="search for...">
                                                                        <ul class="content-panelAdd">
                                                                            <li>
                                                                                <div class="img-anime-panel">
                                                                                    <a href="#">
                                                                                        <img src="<?= base_url() ?>assets/public/img/avatar-panelAdd.png">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="wrap-text-panelAdd">
                                                                                    <div class="name-panelAdd">
                                                                                        One piece the little heaven
                                                                                    </div>
                                                                                    <a href="#" class="delete-panel plus-panelAdd">
                                                                                        <i class="fa fa-plus-circle"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="col-md-12 mar-t-20 wrap-btn-step">
                                                                            <a href="javascript:void(0)" class="btn btn-red pull-right" >Save</a>
                                                                            <a href="javascript:void(0)" class="btn btn-back pull-right" id="close-manage">Back</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end panel -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="head-title mar-t-30">
                                            <div class="pull-left">
                                                <h4 class="aboutme"><?php echo empty($userdetail['name']) ? $userdetail['user_name'] : $userdetail['name']; ?>'S COMMENT</h4>
                                            </div>
                                            <div class="pull-right">
                                                <span><?php echo $total_rows->total_comment_id; ?> Comments</span>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <nav>
                                                <?php echo $pagination; ?>
                                            </nav>
                                        </div>

                                        <div class="content-list">
                                            <?php
                                            if (count($comment_detail) > 0) {
                                                foreach ($comment_detail as $value) {
                                                    ?>
                                                    <div class="wrapper-avatar w-100 bor-none">
                                                        <div class="media info-avatar">
                                                            <div class="media-left media-profile">
                                                                <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $value['user_name'] ?>" title="<?php echo $value['user_name']; ?>">
                                                                    <?php
                                                                    if (!empty($value['user_image'])) {
                                                                        ?>
                                                                        <img class="media-object avatar-profile img-circle" src="<?php echo base_url(); ?>uploads/users/<?php echo $value['user_image']; ?>" alt="<?php echo $value['user_name']; ?>">
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <img class="media-object avatar-profile img-circle" src="<?php echo base_url(); ?>assets/public/img/default_profile.jpeg" alt="No available">
                                                                    <?php } ?>

                                                                </a>
                                                            </div>
                                                            <div class="media-body w-100">
                                                                <a href="<?php echo base_url(); ?>leaguememe_profile/<?php echo $value['user_name'] ?>" title="<?php echo $value['user_name']; ?>">
                                                                    <h5 class="navy-col"><?php
                                                                    if (empty($value['name'])) {
                                                                        echo $value['user_name'];
                                                                    } else {
                                                                        echo $value['name'];
                                                                    }
                                                                    ?>
                                                                    </h5>
                                                                </a>
                                                                <a href="javascript:void(0);">
                                                                    <div class="date"><?php
                                                                $data = $value['comment_timestamp'];
                                                                echo date(" F d, Y h:i A", strtotime($data));
                                                                    ?>
                                                                    </div>
                                                                </a>
                                                                <p class="mar-lm-10 dis-cap">
                                                                    <?php echo $value['comment'] ?>
                                                                </p>


                                                                <div class="media-left media-profile">
                                                                    <?php
                                                                    if (!empty($value['comment_image'])) {
                                                                        ?>
                                                                        <img class="media-object comment-picture img-responsive" src="<?php echo base_url(); ?>uploads/comment_picture/<?php echo $value['comment_image']; ?>" width="120px;" height="120px;"   alt="<?php echo $userdetail['user_name']; ?>">
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                    <?php } ?>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="wrapper-avatar w-100 bor-none">
                                                    <h4 class="alert-danger">Oops! no timeline comment found here.</h4>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <!-- content list -->
                                        <div class="col-md-12 col-md-offset-2">
                                            <form class="" method="post" action="<?php echo base_url(); ?>public/user/timeline_comment" id="upload_form" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?php echo $userdetail['user_id']; ?>">
                                                <input type="hidden" name="name" value="<?php echo $userdetail['user_name']; ?>">
                                                <div class="input-text-comment">

                                                    <div class="show-upload" style="display: none">
                                                        <input type="file"  name="userfile" size="20" id="make_click" onchange="readURL(this)"/>
                                                    </div>


                                                    <div class="preview_image" style="display: none">
                                                        <div id="rem_1">
                                                            <img id="show" src="" alt="" width="120px;" height="120px;" style="margin-bottom: 5px; margin-top: 5px;" />
                                                            <i class="fa fa-remove remove" href="javascript:void(0);" style="margin-top: -72px; margin-right: 0px; margin-left: -4px; color: red; cursor: pointer; cursor: hand;"></i>
                                                        </div>
                                                    </div>


                                                    <textarea class="form-control form-comment textarea-box" id="textcomment" name="comment" rows="3" placeholder="What's on your mind"></textarea>

                                                    <div class="post-comment">

                                                        <div class="added-image"></div>

                                                        <div class="another-post">
                                                            <a href="#" class="photo"> 
                                                                <i class="fa fa-picture-o image_upload"></i> 
                                                            </a> 
                                                            <button type="submit" class="btn pull-right small-btn green-bg comment-btn">
                                                                Comment
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span id="comment_count" class="value-box">1000</span>

                                                </div>

                                                <div class="errorTxt" style="margin-left: 10px;"></div>
                                            </form>
                                        </div>


                                    </div>

                                </div>


                            </div>
                            <!--end ads-->
                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="edit-profile" >


                </div>
                <div role="tabpanel" class="tab-pane" id="favorite-profile">
                    <div class="h-600">Favorite</div>
                </div>

                <div role="tabpanel" class="tab-pane" id="logout">
                    <div class="h-600">Logout</div>
                    <div>
                        <form action="<?php echo base_url() ?>user/logout">
                            <button type="submit"> Logout </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end row -->
</div>
<script>
    $(document).ready(function() {
        $(".image_upload").click(function(e) {
            e.preventDefault();
            $('#make_click').click();

        });
        $("#champ_select").select2();
        
    });

</script>

<script>
    function readURL(input) {
        abc = '';
        if (input.files && input.files[0]) {

            abc += 1;

            var reader = new FileReader();

            $('.added-image').html("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src='' width='120px;' height='120px;' style='margin-bottom: 8px; margin-top: 8px; margin-left: 8px; display: inline;'/></div>");

            reader.onload = imageIsLoaded;
            reader.readAsDataURL(input.files[0]);
            $("#abcd" + abc).append($('<i class="fa fa-remove remove" style="margin-top: -75px; margin-right: 0px; margin-left: -2px; color: red; cursor: pointer; cursor: hand;"></i>').click(function() {
                $("#abcd" + abc).remove();
                $("#previewimg" + abc).val("");
                $('#make_click').val("");
            })
                    );
        }
    }

    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    }


</script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $(function() {
        $("#upload_form").validate({
            rules: {
                comment: "required",
            },
            messages: {
                comment: "Please enter comment",
            },
            errorElement: 'div',
            errorLabelContainer: '.errorTxt'
        });
    });</script>

<script>

    $(document).on('keyup', '#textcomment', function() {
        var limitdsc = 1000;
        var text_remaining;
        var text_length = document.getElementById('textcomment').value.length;
        text_remaining = limitdsc - text_length;
        if (text_remaining == 1000) {
            document.getElementById('comment_count').innerHTML = '<span >1000</span>';
        } else {
            if (text_remaining >= 0) {
                document.getElementById('comment_count').innerHTML = '<span>' + text_remaining + '</span>';
            } else if (text_remaining < 0) {

                document.getElementById('comment_count').innerHTML = '<span><font color=red>' + text_remaining + '</font></span>';
            }
        }

    });
</script>
<!--<script src="<?php echo base_url() ?>assets/public/js/profile.js"></script>-->

