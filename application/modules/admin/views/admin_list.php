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
<!--        <div class="row">-->
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
                            <h3 class="box-title">List All Admin</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table style="width: 100%" class="table table-bordered table-hover" id="list_admin_records">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">Sl.No</th>
                                        <th style="width: 20%">Web Title </th>
                                        <th style="width: 25%">Email</th>
                                        <th style="width: 20%">UsernName</th>
                                        <th style="width: 25%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!--</div>-->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#list_admin_records').DataTable({
            "ordering": true,
            "bLengthChange": false,
            "info": true,
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayStart": 0,
            'sPaginationType': 'full_numbers',
            "bFilter": true,
            "sAjaxSource": base_url + "admin/admin/admin_list_ajax",
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [4]}
            ]
        });
    });
</script>
<script src="<?php echo base_url(); ?>assets/admin/js/admin_list.js" type="text/javascript"></script>