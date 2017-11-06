<div class="col-sm-3 col-lg-2">
                    <div class="left-sidebar hidden-xs">
                        <div class="single-sidebar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="section-heading">Profile</h4>
                                </div>
                                <div class="col-sm-5">
                                    <a href="#"><img class="pro-pic" src="<?php echo base_url(); ?>assets/public/img/pro-pic.png" alt="profile pic"></a>
                                </div>
                                <div class="col-sm-7">
                                    <a href="#"><h5 class="section-title text-uppercase font-play">
                                     <?php
                                      if(isset($username) && !empty($username)){
                                          echo $username;
                                      }
                                      else{
                                          echo "ogwing";
                                      }
                                     ?>
                                        </h5></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 font-play">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Achievements</a></li>
                                        <li><a href="#">Post</a></li>
                                        <li><a href="#">Favorites</a></li>
                                        <li><a href="#">Discussions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single-sidebar find-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="section-heading">Group</h4>
                                </div>
                                <div class="col-sm-8 col-sm-offset-4">
                                    <a href="#"><h5 class="section-title text-uppercase font-play">find group</h5></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 font-play">
                                    <ul class="list-unstyled">
                                        <li><a href="#">One Pience</a></li>
                                        <li><a href="#">Naruto</a></li>
                                        <li><a href="#">Dragon Ball Z</a></li>
                                        <li><a href="#">Danmachi</a></li>
                                        <li><a href="#">Tokyou Ghoul</a></li>
                                        <li><a href="#">Ippo</a></li>
                                        <li><a href="#">Shokugeki</a></li>
                                        <li><a href="#">Arslan</a></li>
                                        <li><a href="#">Mosnterball</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single-sidebar find-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="section-heading">Leaguememes</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 font-play">
                                    <ul class="list-unstyled">
                                        <li><a href="#">Advertise</a></li>
                                        <li><a href="#">Contact</a></li>
                                        <li><a href="#">Privacy</a></li>
                                        <li><a href="#">Terms</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <p class="copyright">Copyright &copy; All Rights Reserved</p>
                    </div>
                </div>