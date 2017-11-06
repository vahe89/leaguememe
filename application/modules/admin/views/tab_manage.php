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

                    <div class="box-body">
                        <div class="col-md-12">
                            <p class="text-danger"> Note : You are not able to change position and hide/show of first tab (Leaguememe)  </p>
                            <ul class="list-group" style="margin-bottom: 0px">
                                <li  class="list-group-item" style="border-bottom: 0px; border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;"> 
                                    <div class="col-md-3"><span class="text-capitalize text-bold " >Tab Name</span></div>
                                    <span class="text-capitalize text-bold " >Show</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12 table-responsive">
                            
                            
                            <ul id="sortable" class="list-group">
                                <?php
                                $i = 0;
                                foreach ($tabposition as $val) {
                                    if ($val->tab_name == "leaguememe") {
                                        ?>

                                        <?php
                                    } else {
                                        ?>
                                <li class="list-group-item" id="position_<?= $val->id ?>" style="border-top-left-radius: 0px;border-top-right-radius: 0px;cursor: move"> 
                                            <div class="col-md-3"><span class="text-capitalize text-bold " ><?= $val->tab_name ?> </span>  </div>
                                            <input onclick="display_tab(this)" type="checkbox"  <?= ($val->display == "1") ? 'checked="checked"' : '' ?> value="1" id="display_<?= $val->id ?>">  
                                        </li>
                                    <?php
                                    }
                                }
                                ?>
                            </ul>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $('#sortable').sortable({
        update: function(event, ui) {
            var data = $(this).sortable('serialize');
            $.ajax({
                data: data,
                type: 'POST',
                url: base_url + "admin/leaguelist/edit_tab",
            });

        }
    });
    function display_tab(obj) {
       var ids = $(obj).attr('id').split("_");
       var id = ids[1];
        var display = 1;
        if ($(obj).is(':checked')) {
            display = 1;
        } else {
            display = 0;
        }
        $.ajax({
            data: {display:display,id:id},
            type: 'POST',
            url: base_url + "admin/leaguelist/edit_display_tab",
        });
    }
</script>