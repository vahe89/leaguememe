
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
                        <h3 class="box-title">League Report</h3>
                        <div>
                            <select name="active_status" id="active_status">
                                <option selected="selected" value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table style="width: 100%" class="table table-bordered table-hover" id="list_league_reports">
                            <thead>
                                <tr>
                                    <th style="width: 8%">Sl.No</th>
                                    <th style="width: 15%">Report Type</th>
                                    <th style="width: 15%">League Name </th>
                                    <th style="width: 15%">Report Category </th>
                                    <th style="width: 15%">Image Link</th>
                                    <th style="width: 15%">Image</th>
                                    <th style="width: 10%">Status</th>
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
<script type="text/javascript">
    $(document).ready(function () {
        var league_report = $('#list_league_reports').DataTable({
            "ordering": true,
            "bLengthChange": false,
            "info": true,
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayStart": 0,
            'sPaginationType': 'full_numbers',
            "bFilter": true,
            "sAjaxSource": base_url + "admin/leaguelist/league_report_ajax",
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [4]},
                {"bSortable": false, "aTargets": [5]},
                {"bSortable": false, "aTargets": [6]},
                {"bSortable": false, "aTargets": [7]}
            ],
            "fnServerParams": function (aoData)
            {
                var status_check = $('#active_status :selected').val();
                aoData.push({"name": "status_check", "value": status_check});
            }

        });
        $('#active_status').on('change', function () {
            league_report.draw();
        });
    });
</script>
<script src="<?php echo base_url(); ?>assets/admin/js/all_anime_report.js" type="text/javascript"></script>