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
                        <h3 class="box-title">List All Event</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table style="width: 100%" class="table table-bordered table-hover" id="list_event_records">
                            <thead>
                                <tr>
                                    <th>Event Id</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Private</th>
                                    <th>Uploaded by</th>
                                    <th>Total Join</th>
                                    <th>End Date</th>
                                    <th>Action</th>
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
<div id="omCode" class="modal fade"  role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Winner for <strong><span id="omTitle"></span></strong></h4>
            </div>
            <div class="modal-body" id="omModalBody" >
                
                <iframe id="omFrame"  frameborder="0"  width="100%" height="500"></iframe>
            </div>
             
        </div>
    </div>
</div>
<!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#list_event_records').DataTable({
            "sServerMethod": "POST",
            "ordering": true,
            "bLengthChange": false,
            "info": true,
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayStart": 0,
            'sPaginationType': 'full_numbers',
            "bFilter": true,
            "sAjaxSource": base_url + "admin/event/event_list_ajax",
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [3]},
                {"bSortable": false, "aTargets": [8]}
            ]
        });
    });
    function delete_event(event_id) {
        var r = confirm("Can you confirm this?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: base_url + "admin/event/delete_event",
                data: "event_id=" + event_id,
                success: function(msg) {
                    location.reload();
                }
            });
        }
    }
    function openModal(url,title) {
        $('#omFrame').attr("src", url);
        $('#omTitle').html(title)
        $('#omCode').modal();
    }
</script> 