<div class="inline_upload">
    <h2 class="modal-title-upload mar-t-20" id="myModalLabel">Create event </h2>
    <hr/>
    <p class="grey-color-xs">See people together </p>
    <div id="event-form-msg" style="display: none" class=" alert alert-success ">
        
    </div>

    <div class="col-md-12">
        <form action="<?= "#"// base_url("public/event/create")?>" id="event-form" method="POST" enctype="multipart/form-data" >
            
            <div class="panel panel-default mar-b-40">
                <div class="panel-body-discuss panel-body">
                    <input type="text" name="title" class="title-discuss-input" placeholder="Event title" />
                </div>
            </div>
            <div class="panel panel-default mar-b-40">
                <div class="panel-body-discuss panel-body">
                    <input type="text" name="start_date"  class="title-discuss-input " id="start_date"  placeholder="Event start date"/>
                </div>
            </div>
            <div class="panel panel-default mar-b-40">
                <div class="panel-body-discuss panel-body">
                    <input type="text" name="end_date" class="title-discuss-input" id="end_date" placeholder="Event end date" />
                </div>
            </div>
            <div class="panel panel-default mar-b-40">
                <div class="panel-body-discuss panel-body">
                    <input type="file" name="event_file"  id="event_file" class="title-discuss-input" />
                </div>
            </div>
            <div class="panel panel-default mar-b-0">
                <div class="panel-body-discuss panel-body">
                    <textarea placeholder="Describe your event" style="width: 100%" class="title-discuss-input" name="desc" ></textarea>
                </div>
            </div>
            <div class="wrap-filter-post">
                
                <input type="checkbox" name="private" id="private" style="display: none" value="1" />
                <label for="private"  >
                    <span class="fa-stack">
                        <i class="fa fa-square-o fa-stack-1x"></i>
                        <i class="fa fa-check fa-stack-1x"></i>
                    </span>
                </label> Private Event ?
            </div>
            <div class="panel panel-default mar-b-40" id="pwd-div" style="display: none">
                <div class="panel-body-discuss panel-body">
                    <input type="text" name="password"  id="password" placeholder="Enter event password" class="title-discuss-input" />
                </div>
            </div>
            <div class="col-md-12 wrap-btn-step no-padding">
                <input type="submit" class="btn btn-red pull-right" id="btn-create-event" value="Create Event" />
            </div>
        </form>
    </div>
</div>
<link href="<?=  base_url()?>assets/public/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css"/>
<script src="<?=  base_url()?>assets/public/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
<script>
    $(function () {
        $("input[name=private]").click(function(){
            $("#pwd-div").slideToggle();
        })
        $('#start_date').datetimepicker({
            minDate : new Date(),
            useCurrent: false ,
            format : "DD-MM-YYYY HH:mm:ss" 
        });
        $('#end_date').datetimepicker({
            minDate : new Date(),
            format : "DD-MM-YYYY HH:mm:ss" ,
            useCurrent: false //Important! See issue #1075
        });
        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("dp.change", function (e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });
    });
     
</script>