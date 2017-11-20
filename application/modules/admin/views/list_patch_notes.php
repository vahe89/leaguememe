 
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
                        <h3 class="box-title">List Patch Notes</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table  style="width: 100%" class="table table-bordered table-hover"  id="list_patch_notes">
                            <thead>
                                <tr> 
                                    <th>Patch Note Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#list_patch_notes').DataTable({
            "ordering": true,
            "bLengthChange": false,
            "info": true,
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayStart": 0,
            'sPaginationType': 'full_numbers',
            "bFilter": true,
            "sAjaxSource": base_url + "admin/patch_note/list_patchnotes_ajax",
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [1]},
            ],
            "createdRow": function(row, data, index)
            {
                $(row).attr('id', data.id);

            }
        });
    });
</script> 
<script src="<?php echo base_url(); ?>assets/admin/js/patch_notes.js" type="text/javascript"></script>