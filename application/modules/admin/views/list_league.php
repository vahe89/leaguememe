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
                        <h3 class="box-title">List All League</h3>
                    </div><!-- /.box-header -->
                     <div>
                        <button class="setPop btn btn-warning">Set popular</button>
                        <button class="delLeague btn btn-danger">Delete league</button>
                    </div>
                    <div class="box-body">
                        <table style="width: 100%" class="table table-bordered table-hover" id="list_league_records">
                            <thead>
                                <tr>
                                    <th style="width: 3%" ><input type="checkbox" class="chkAllleague" value=""/>
                                    </th>
                                    <th style="width: 7%">League Id</th>
                                    <th style="width: 15%">League Name </th>
                                    <th style="width: 20%">Category Name</th>
                                    <th style="width: 15%">Credit</th>
                                    <th style="width: 25%">League</th>
                                    <th style="width: 15%">Action</th>
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
        $('#list_league_records').DataTable({
            "ordering": true,
            "bLengthChange": false,
            "info": true,
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayStart": 0,
            'sPaginationType': 'full_numbers',
            "bFilter": true,
            "sAjaxSource": base_url + "admin/leaguelist/league_list_ajax",
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [0]},
                {"bSortable": false, "aTargets": [5]},
                {"bSortable": false, "aTargets": [6]}
            ]
        });
    });
    
    $(document).on("click", ".chkAllleague", function () {
        if ($(".chkAllleague").is(':checked')) {
            $('.chkLeague').prop('checked', true);
        } else {
            $('.chkLeague').prop('checked', false);
        }
    });

    $(document).on("click", ".setPop", function () {
        var alldata = [];
        $('.chkLeague').each(function () {
            if ($(this).is(':checked')) {
                var get_id = $(this).attr('id').split("_");
                alldata.push(get_id[1]);
            }
        });
        if (alldata != '') {
            if(confirm("Are you sure you want to set this leagues to popular?") == true){
            $.ajax({
                method: "POST",
                url: base_url + "admin/leaguelist/set_multiple_popular_status",
                data: {
                    alldata: alldata,
                },
                success: function () {
                    location.reload();
                }
            });
        }
      }

    });

    $(document).on("click", ".delLeague", function () {
        var alldata = [];
        $('.chkLeague').each(function () {
            if ($(this).is(':checked')) {
                var get_id = $(this).attr('id').split("_");
                alldata.push(get_id[1]);
            }
        });
        if (alldata != '') {
            if(confirm("Are you sure you want to delete?") == true){
            $.ajax({
                method: "POST",
                url: base_url + "admin/leaguelist/delete_multiple_leagueImg",
                data: {
                    alldata: alldata,
                },
                success: function () {
                    location.reload();
                }
            });
        }
      }

    });
</script>
<script src="<?php echo base_url(); ?>assets/admin/js/league_list.js" type="text/javascript"></script>