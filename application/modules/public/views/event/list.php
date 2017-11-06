<!--wrapper avatar-->
<?php
if (count($events) > 0 && !empty($events)) {
    foreach ($events as $key => $event) {
        $users = explode(",", $event->users);
        $classForLink = "";
        $classForJoin = "";

        if ($event->private) {
            if ($auth_events == false OR ! in_array($event->event_id, $auth_events)) {
                $classForLink = "private go-to-info";
                $classForJoin = "private";
            }
        }
        ?>
        <div class="wrapper-avatar">
            <h3>
                <a href="<?= base_url("event/event-info/" . $event->event_id) ?>" class="<?= $classForLink ?>" data-ei="<?= $event->event_id ?>" id="link-<?= $event->event_id ?>" >
                    <?= $event->title ?>
                </a>
            </h3>
            <a href="<?= base_url("event/event-info/" . $event->event_id) ?>"  class="<?= $classForLink ?>" data-ei="<?= $event->event_id ?>" id="img-<?= $event->event_id ?>">
                <img src="<?= base_url("uploads/event/" . $event->image) ?>" alt="" class="img-responsive meme-big">
            </a>
            <?php
            if ($loginUser !== false AND in_array($loginUser, $users)) {
                $text = "Already Joined";
                $class = "";
            } else {
                $text = "JOIN";
                $class = "btn-join-event";
            }
            ?>
            <a <?= ($loginUser == false) ? 'data-target="#login" data-toggle="modal" ' : '' ?> href="javascript:void(0)"  eventid = "<?= $event->event_id ?>" eventuser ="<?= count($users) ?>" eventlimit="<?= $event->join_limit ?>" class="wrap-btn-join <?= $class ?> <?= $classForJoin ?>">
                <?= $text ?>
                <span class="member-event">
                    <i class="fa fa-users"></i>
                    <?= count($users) ?>/ <?= (!empty($event->join_limit) && isset($event->join_limit)) ? $event->join_limit : "100"; ?>
                </span>
            </a>

        </div>
    <?php } ?> 
    <div class="modal fade" id="modal-event-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow: auto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" id="login_close" class="close" data-dismiss="modal" aria-label="Close">&times;
                </button>
                <div class="modal-header bor-none">
                    <h2 class="modal-title mar-t-40" id="myModalLabel"  style="text-align: center;">This is private event </h2>
                    <p class="grey-color-xs"  style="text-align: center;">If you want to go detail please provide a password.</p>
                </div>
                <!-- end modal header-->
                <div class="modal-footer">
                    <form action="#" method="post" id="event-login">
                        <div class="form-group text-left">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="pwd"  class="form-control" id="pwd" placeholder="password">
                            <label class="error" id="err" for="pwd" generated="true"> </label>
                        </div>
                        <input type="hidden" name="ei" value="" />
                        <button type="submit" class="btn btn-login-green pull-left">Access now</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div> 
        <div class="alert alert-danger">
            <strong>Oops!</strong> No Event found  
        </div>
    </div>
    <?php
}
?> 
<script>
    function auth(formData, type, $this) {
        $.ajax({
            url: "<?= base_url("public/event/auth") ?>",
            type: 'POST',
            dataType: 'JSON',
            data: formData,
            success: function(data, textStatus, jqXHR) {
                if (type == "auth") {
                    if (data.status) {
                        window.location = "<?= base_url() ?>event/event-info/" + $this.data("ei")
                    }
                    else {
                        $("#err").show().text(data.msg)
                    }
                }
                else {
                    if (data.status) {
                        $("#modal-event-login").modal("hide");
                        $.ajax({
                            url: "<?= base_url("public/event/join") ?>",
                            type: 'POST',
                            data: {
                                id: $this.attr("eventid")
                            },
                            dataType: 'JSON',
                            beforeSend: function(xhr) {
                                $this.text("Please wait..");
                            },
                            success: function(data, textStatus, jqXHR) {
                                if (data.status) {
                                    $this.attr("disabled", "disabled");
                                    $this.text("Now Joined ");
                                    $this.removeClass("private");

                                    $("#link-" + $this.attr("eventid")).removeClass("go-to-info");
                                    $("#img-" + $this.attr("eventid")).removeClass("go-to-info");
                                }
                                else {
                                    $this.text(data.msg);
                                }
                            }
                        })
                    }
                    else {
                        $("#err").show().text(data.msg)
                    }
                }
            }
        })
    }
    $(document).ready(function() {
        var type;
        var $this;
        $("#event-login").submit(function(e) {
            e.preventDefault();
            auth($("#event-login").serialize(), type, $this);
        })
        $(document).on("click", "a.go-to-info", function(e) {
            e.preventDefault();
            $this = $(this);
            $.ajax({
                type: "POST",
                url: base_url + "public/user/checkUserLoginOrNot",
                cache: false, dataType: 'html',
                success: function(data) {
                    if (data != "offline") {
                        if ($this.hasClass("private")) {
                            type = "auth";
                            $("#err").hide();
                            $('input[type="password"]').val("");
                            $("#modal-event-login").modal("show");
                            $("input[name=ei]").val($this.data("ei"));
                        }
                    }
                }
            });
        });

        $(".btn-join-event").click(function() {
            $this = $(this);
            if ($this.attr("eventlimit") == $this.attr("eventuser")) {
                $this.text("Oops! Event join limit is over better luck next time");
            }
            else if ($this.hasClass("private")) {
                $.ajax({
                    type: "POST",
                    url: base_url + "public/user/checkUserLoginOrNot",
                    cache: false, dataType: 'html',
                    success: function(data) {
                        if (data != "offline") {
                            type = "join";
                            $("#modal-event-login").modal("show");
                            $("#err").hide();
                            $("input[name=ei]").val($this.attr('eventid'));
                            $('input[type="password"]').val("");
                        }
                    }
                });
            }
            else {
                $.ajax({
                    url: "<?= base_url("public/event/join") ?>",
                    type: 'POST',
                    data: {
                        id: $this.attr("eventid")
                    },
                    dataType: 'JSON',
                    beforeSend: function(xhr) {
                        $this.text("Please wait..");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    },
                    success: function(data, textStatus, jqXHR) {
                        if (data.status) {
                            $this.attr("disabled", "disabled");
                            $this.text("Now Joined ");
                        }
                        else {
                            $this.text(data.msg);
                        }

                    }
                })
            }

        })
    })
</script>
