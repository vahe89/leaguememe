
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

        <div class="row">
            <div class="col-lg-12"> 
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Section</h3>                        
                        <br/>

                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover" id="list_section">
                                <thead>
                                    <tr>
                                        <th>Section Name</th>
                                        <th>Title</th> 
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <?php
                                    if (count($getSectionlink) > 0) {
                                        foreach ($getSectionlink as $sectionval) {
                                            ?>
                                            <tr data-id='<?= $sectionval['idd'] ?>'>
                                                <td><?= $sectionval['section_name'] ?></td>
                                                <td><?= $sectionval['title'] ?></td>
                                                <td><?= $sectionval['link'] ?></td>
                                                <td><a href="javascript:void(0)" onclick="status_change('<?= $sectionval['idd'] ?>', '<?= $sectionval['link_status'] ?>')"><?php if ($sectionval['link_status'] == 1) { ?><img alt='Active' src='<?= base_url() ?>assets/images/active.png'>  <?php } else { ?><img alt='Active' src='<?= base_url() ?>assets/images/inactive.png'> <?php } ?></a>
                                                    <a href="javascript:void(0)" onclick="delete_section('<?= $sectionval['idd'] ?>')"><img title='Delete' alt='Delete' src='<?= base_url() ?>assets/images/btn-close.png'></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
     $(document).ready(function() {
        $('tbody').sortable({
            update: function(event, ui) {
                var temp = {};
                $('table tbody tr').each(function(i) {
                    temp[$(this).attr('data-id')] = i + 1;
                }); 
                $.ajax({
                    type: 'POST',
                    data:{data:temp},
                    url: base_url   + "admin/leaguelist/sortable_sectionlink",
                })
            }
        });
        $('#list_section').DataTable({
            "ordering": true,
            "bLengthChange": false,
            "info": true,
            "bProcessing": true,
            "iDisplayStart": 0,
            'sPaginationType': 'full_numbers',
            "bFilter": true,
            "aoColumnDefs": [
                {"bSortable": true, "aTargets": [0]},
                {"bSortable": true, "aTargets": [1]},
                {"bSortable": true, "aTargets": [2]},
                {"bSortable": false, "aTargets": [3]}
            ]

        });

    });
    function status_change(rule_id, status) {
        var r = confirm("Can you confirm this?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: base_url + "admin/leaguelist/update_status_link",
                data: "id=" + rule_id + "&link_status=" + status,
                success: function(msg) {
                    location.reload();
                }
            });
        }
    }
    function delete_section(id) {

        var r = confirm("Can you confirm this?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: base_url + "admin/leaguelist/delete_sectionlink",
                data: "id=" + id,
                success: function(msg) {
                    location.reload();
                }
            });
        }
    }
</script> 
