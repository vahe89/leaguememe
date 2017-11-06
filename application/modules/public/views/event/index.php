<?php
echo $this->load->view('template/sidebar_list');
?>


<div  role="tabpanel" class="tab-pane right-panel-sec pad-left active"  id="event">

    <div class="col-md-7 col-xs-12 col-sm-12 main-content">
        <ul class="nav pop-tabs" role="tablist" style="margin-top: 10px;">

            <li role="presentation" class="active" style="margin-left: 0px; margin-right: -5px; " data-name="new">
                <a href="<?= base_url() ?>event" >Event</a>
            </li>
        </ul>
        <br>
        <div id="event_data"></div>
        <input type="hidden" value="<?php echo!empty($eventtrack) ? $eventtrack + 1 : '1'; ?>" name="eventtrack" id="eventtrack">
        <input type="hidden" name="total_groups" class="total_groups" value="<?php echo isset($total_groups) ? $total_groups : 1; ?>"/>
    </div>
    <div class="col-md-5 col-sm-12 ads hidden-sm hidden-xs">
        <?= $this->load->view('template/right_sidebar', array(), true); ?>
    </div>

</div>

<script>

    $(document).ready(function() {

        var total_groups;
        loadEvent();
        var event_track = $('#eventtrack').val();
        var track_load = 1;
        var loading = false;

        function loadEvent(action) {
            $.ajax({
                url: base_url + 'public/event',
                success: function(data, textStatus, jqXHR) {
                    $("#event #event_data").html(data);
                    total_groups = $('.total_groups').val();
                }
            })
        }

        $(window).scroll(function() { //detect page scroll
            if ($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
            {
                if (track_load <= total_groups && loading == false) //there's more data to load
                {
                    loading = true; //prevent further ajax loading
                    $('.animation_image').show(); //show loading image
                    $.ajax({
                        type: "POST",
                        url: base_url + 'public/event/event_scroll_data',
                        data: {
                            group_no: event_track,
                        },
                        success: function(data) {
                            $("#event #event_data").append(data);
                            $('.animation_image').hide(); //hide loading image once data is received
                            track_load++; //loaded group increment  
                            event_track++;
                            if (event_track == total_groups) {
                                loading = true;
                            } else
                            if (track_load == 8) {
                                loading = true;
                                $("#eventtrack").attr("value", event_track);
                            } else {
                                loading = false;
                            }
                        }
                    });
                }
            }
        });

    });

</script>

