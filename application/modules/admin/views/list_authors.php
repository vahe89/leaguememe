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
                        <h3 class="box-title">List Authors</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table  style="width: 100%" class="table table-bordered table-hover"  id="list_authors">
                            <thead>
                                <tr> 
                                    <th>Name</th>
                                    <th>Link</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($credit_authors)) {
                                    foreach ($credit_authors as $val) {
                                        ?>
                                        <tr>
                                            <td><?= $val['name'] ?></td>
                                            <td><?= $val['link'] ?></td>
                                            <td><img src="<?= base_url() ?>uploads/author/<?= $val['image'] ?>" style="width: 50px"></td>
                                            <td>
                                                <a href="<?= base_url() ?>edit_author/<?= $val['id'] ?>"  title='Edit' style='cursor: pointer;'><img alt='Edit' src='<?= base_url() ?>assets/images/edit1.png'>  </a> 
                                                <a onclick="delete_author(<?= $val['id'] ?>)"   title='Delete' style='cursor: pointer;'><img alt='Delete' src='<?= base_url() ?>assets/images/btn-close.png'></a></td>
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

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#list_authors').DataTable({
            "ordering": true,
            "bLengthChange": false,
            "info": true,
            "bProcessing": true,
            "iDisplayStart": 0,
            'sPaginationType': 'full_numbers',
            "bFilter": true,
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [2]},
                {"bSortable": false, "aTargets": [3]}
            ],
        });

    });
    function delete_author(id) {
        var r = confirm("Can you confirm this?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: base_url + "admin/leaguelist/delete_author",
                data: "id=" + id,
                success: function(msg) {
                    location.reload();
                }
            });
        }
    }
</script>  