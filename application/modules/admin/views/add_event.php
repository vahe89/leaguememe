<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header with-border">
        <h1>
            <?php echo isset($content_header) ? $content_header : "Leaguememe"; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo isset($left) ? $left : "Leaguememe"; ?></li>
        </ol>
    </section>
    <!--    <hr/> -->
    <section class="content">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= isset($event_data) ? 'Edit Event' : 'Add Event' ?></h3>
                    </div><!-- /.box-header -->
                    <div id="event-form-msg" style="display: none" class=" alert alert-success ">

                    </div>
                    <!-- form start -->  
                    <form role="form uniformForm validateForm" action="<?php // echo base_url();          ?>add_event" id="add_event_form" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" value="<?= isset($event_data) ? $event_data->id : '0' ?>" name="type">
                            <div class="form-group">
                                <input type="text" placeholder="Event title" name="title" value="<?= (isset($event_data->title) || !empty($event_data->title)) ? $event_data->title : "" ?>" class="form-control input-lg">  
                            </div>
                            <div class="form-group"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="start_date"  class="form-control input-lg" <?= (!isset($event_data->start_date) || empty($event_data->start_date)) ? 'id="start_date"' : '' ?> value="<?= (isset($event_data->start_date) || !empty($event_data->start_date)) ? date('Y-m-d h:i:s', $event_data->start_date) : "" ?>"  placeholder="Event start date"/>	 
                                    </div>
                                    <div class="col-md-6"> 
                                        <input type="text" name="end_date" class="form-control input-lg" <?= (!isset($event_data->end_date) || empty($event_data->end_date)) ? 'id="end_date"' : '' ?> value="<?= (isset($event_data->end_date) || !empty($event_data->end_date)) ? date('Y-m-d h:i:s', $event_data->end_date) : "" ?>" placeholder="Event end date" /> 
                                    </div> 
                                </div>
                            </div>

                            <div class="form-group"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if (isset($event_data)) {
                                            ?> 
                                            <input type="hidden" name="event_file"  id="event_file" value="<?= empty($event_data->image) ? "" : $event_data->image ?>"  />	
                                            <img src="<?= base_url(); ?>uploads/event/<?= empty($event_data->image) ? "" : $event_data->image ?>" alt="<?= empty($event_data->image) ? "Not availabel" : $event_data->image ?>" style="width: 200px">

                                        <?php } else { ?> 

                                            <input type="file" name="event_file"  id="event_file" class=" " />	

                                        <?php }
                                        ?>
                                    </div>
                                    <div class="col-md-6"> 
                                        <input type="text" name="join_limit" class="form-control input-lg" <?= (!isset($event_data->join_limit) || empty($event_data->join_limit)) ? 'id="join_limit"' : '' ?> value="<?= (isset($event_data->join_limit) || !empty($event_data->join_limit)) ? $event_data->join_limit  : "" ?>" placeholder="Join limit" /> 
                                    </div> 
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea placeholder="Describe your event"  rows="5" class="form-control input-lg" name="desc" > <?= (isset($event_data->descr) || !empty($event_data->descr)) ? $event_data->descr : "" ?> </textarea>	
                            </div>
                            <div class="form-group">
                                <label for="private"  >
                                    <input type="checkbox" name="private" id="private"  value="1" <?= (isset($event_data->private) && $event_data->private == "1") ? "checked" : "" ?> /> 
                                </label> Private Event ?
                            </div> 
                            <div class="form-group " id="pwd-div" style="display: none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="password"  id="password" placeholder="Enter event password" value="<?= (isset($event_data->password) || !empty($event_data->password)) ? $event_data->password : "" ?>" class="form-control input-lg" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" id="btn-create-event" class="btn btn-primary">Create Event</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-2">
            </div>
        </div>
    </section> 
</div>

<link href="<?= base_url() ?>assets/public/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>
<script src="<?= base_url() ?>assets/public/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script>
    $(function() {
<?php if (isset($event_data->private) && $event_data->private == "1") {
    ?>
            $("#pwd-div").show();
<?php }
?>
        $("input[name=private]").click(function() {
            $("#pwd-div").slideToggle();
        })
        $('#start_date').datetimepicker({
            minDate: new Date(),
            useCurrent: false,
            format: "DD-MM-YYYY HH:mm:ss",
        });
        $('#end_date').datetimepicker({
            minDate: new Date(),
            format: "DD-MM-YYYY HH:mm:ss",
            useCurrent: false //Important! See issue #1075
        });
        $("#start_date").on("dp.change", function(e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("dp.change", function(e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });
    });
    $(document).on("submit", "form#add_event_form", function(event) {
        event.preventDefault();
        input = document.getElementById('event_file');
        var data = new FormData($("form#add_event_form")[0]);
        $.ajax({
            url: base_url + "admin/event/create_event",
            type: 'POST',
            dataType: 'JSON',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function(xhr) {
                $("#event-form-msg").hide();
                $("#event-form-msg").removeClass("alert-success");
                $("#event-form-msg").removeClass("alert-danger");
            },
            success: function(data, textStatus, jqXHR) {
                $("#event-form-msg").slideDown('slow');
                if (data.status) {
                    $("#event-form-msg").addClass("alert-success");
                    $("#event-form-msg").html("Event successfully created.");
                }
                else {
                    $("#event-form-msg").addClass("alert-danger");
                    $("#event-form-msg").html(data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#event-form-msg").addClass("alert-danger");
            }
        })

    })
</script>
