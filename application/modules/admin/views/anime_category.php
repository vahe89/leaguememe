
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo isset($content_header) ? $content_header : "Leaguememe"; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo isset($left) ? $left : "leaguememe"; ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php
        $message = $this->session->flashdata('message');
        if ($message != '') {
            ?>
            <center>
                <div class="alert alert-success alert-dismissable" style="width: 40%">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>
                        <?php echo $message; ?>
                    </strong> 
                </div> 
            </center> 
        <?php } ?> 

        <div class="row">
            <div class="col-lg-12"> 
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Anime Category</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table style="width: 100%" class="table table-bordered table-hover" id="list_all_animecategory">
                            <thead>
                                <tr>
                                    <th style="width: 8%">Sl.No</th>
                                    <th style="width: 15%">Anime Name</th>
                                    <th style="width: 15%">Anime image</th>                                   
                                    <th style="width: 5%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- Modal -->
<div id="changeImage" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Anime Image</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url(); ?>admin/animecategory/change_category_photo" id="add_anime_category_form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="required">Anime Photo:</label>
                        <input type="file" name="anime_category_photo" id="anime_category_photo"/>	
                        <span class="error"><?php echo form_error('anime_category_photo'); ?></span>
                    </div>
                    <input type="hidden" name="aniId" id="aniId" value=""/>
                    <input type="submit" class="btn btn-default" value="Change">
                </form>
            </div>
             
        </div>

    </div>
</div>
<div id="episodetime" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Episode & Manga time</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <form role="form" action="<?php echo base_url(); ?>admin/animecategory/changeanime_episode_time" method="post" id="add_anime_category_form">
                            <div class="form-group">
                                <label for="required">Episode Time:</label>
                                <input type="text" name="anime_episode_time" id="anime_episode_time" placeholder="Friday 09:00pm"/>	
                            </div>
                            <input type="hidden" name="aniEpId" id="aniEpId" value=""/>
                            <input type="submit" class="btn btn-default" value="Change Episode time">
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form role="form" action="<?php echo base_url(); ?>admin/animecategory/changeanime_manga_time" method="post" id="add_anime_category_form">
                            <div class="form-group">
                                <label for="required">Manga Time:</label>
                                <input type="text" name="anime_manga_time" id="anime_manga_time" placeholder="Friday 09:00pm"/>	
                            </div>
                            <input type="hidden" name="animgId" id="animgId" value=""/>
                            <input type="submit"  class="btn btn-default" value="Change Manga time">
                        </form>
                    </div>
                </div>


            </div>
             
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var league_report = $('#list_all_animecategory').DataTable({
            "stateSave": true,
            "ordering": true,
            "bLengthChange": false,
            "info": true,
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayStart": 0,
            'sPaginationType': 'full_numbers',
            "bFilter": true,
            "sAjaxSource": base_url + "admin/animecategory/anime_category_list",
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [2]},
                {"bSortable": false, "aTargets": [3]}

            ],
        });

    });
</script>
<script src="<?php echo base_url(); ?>assets/admin/js/anime_category.js" type="text/javascript"></script>
