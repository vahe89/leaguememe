
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

        <!-- Small boxes (Stat box) -->
        <!--        <div class="row pull-right">
                    <div class="col-lg-12">
                        <button class="btn btn-block btn-primary" onclick="javascript:window.open('add_article', '_self')">Add New</button>
                    </div>
                </div> /.row   -->
        <div class="row">
            <div class="col-lg-12"> 
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Articles</h3>                        
                        <br/>

                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row pull-left">
                            <div class="col-lg-12">
                                <input type="number" name="limit" id="limit" value="1" min="1" pattern="/[0-9]*/" /><br/>
                                <span>(Enter No of report)</span>
                                <!--<button type="button" id="redraw" class="btn btn-primary" name="redraw" value="GO">GO</button>-->
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table style="width: 100%" class="table table-bordered table-hover" id="list_anime_records">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">Sl.No</th>
                                        <th style="width: 30%">League Name</th>
                                        <th style="width: 20%">Category Name</th>
                                        <th style="width: 20%">League Image</th>
                                        <th style="width: 5%">Total Views</th>
                                        <th style="width: 5%">No of reports</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var anime_report = $('#list_anime_records').DataTable({
            "ordering": true,
            "bLengthChange": false,
            "info": true,
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayStart": 0,
            'sPaginationType': 'full_numbers',
            "bFilter": true,
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [3]},
                {"bSortable": false, "aTargets": [4]},
                {"bSortable": false, "aTargets": [5]},
                {"bSortable": false, "aTargets": [6]}
            ],
            "sAjaxSource": base_url + "admin/leaguelist/list_anime_report",
            "fnServerParams": function (aoData)
            {
                var min_limit = $('#limit').val();
                aoData.push({"name": "min_limit", "value": min_limit});
            }
        });
        $('#limit').keypress(function (e) {
            if (e.which == 13) {
                anime_report.draw();
            }
        });
    });

</script>
<script src="<?php echo base_url(); ?>assets/admin/js/league_list.js" type="text/javascript"></script>