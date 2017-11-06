<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header with-border">
        <h1>
            <?php echo isset($content_header) ? $content_header : "Leaguememe"; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo isset($left) ? $left : "leaguememe"; ?></li>
        </ol>
    </section>
    <!--    <hr/> -->
    <section class="content">
          <?php
        $message = $this->session->flashdata('message');
        if ($message != '') {
            ?>
            <center>
                <div class="alert alert-info alert-dismissable" style="width: 40%">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>
                        <?php echo $message; ?>
                    </strong> 
                </div> 
            </center> 
        <?php } ?> 
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Section</h3>
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal">Add new section name</button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add new section name</h4>
                                    </div>
                                    <form method="post" action="<?= base_url() ?>admin/leaguelist/addnewSection">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="text" name="section_name" class="form-control" placeholder="Enter section name">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" >Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url(); ?>addsection" id="add_section_form" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="required">Section:</label>
                                <select name="section_name" id="section_name" class="form-control validate[required]">
                                    <option value="0">Select section </option>
                                    <?php
                                    if (count($getSection) > 0) {
                                        foreach ($getSection as $sectionval) {
                                            ?>
                                            <option value="<?= $sectionval['id'] ?>"> <?= $sectionval['section_name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="error"><?php
                                    echo form_error(''
                                            . '');
                                    ?></span>
                            </div>
                            <div class="form-group">
                                <label for="required">Title:</label>
                                <input type="text" name="title_name" id="title_name" placeholder="Title" class="form-control"/>	
                                <span class="error"><?php echo form_error('title_name'); ?></span>
                            </div><div class="form-group">
                                <label for="required">Link:</label>
                                <input type="text" name="ttile_link" id="ttile_link" placeholder="http://leaguememe.com/" class="form-control"/>	
                                <span class="error"><?php echo form_error('ttile_link'); ?></span>
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>    
            <div class="col-lg-2">
            </div>
        </div>
    </section>
</div>    
<script>
    $(document).ready(function() {
        $('#add_section_form').validate({
            rules: {
                section_name: {
                    selectcheck: true,
                },
                title_name: {
                    required: true,
                },
                ttile_link: {
                    required: true,
                }
            },
            messages: {
//            section_name: {
//                required: "Section Name field is reqiured.",
//            },
                title_name: {
                    required: "Title field is reqiured.",
                },
                ttile_link: {
                    required: "Link  field is reqiured.",
                }
            }
        });
        jQuery.validator.addMethod('selectcheck', function(value) {
            return (value != '0');
        }, "Select field required");
//   
    });
</script>
