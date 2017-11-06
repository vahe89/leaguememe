<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div>
    <div style="width:50%;float:left">
        <h4><span id="count"> </span> member going to event</h4>
    </div>

    <div style="float: right">
        <button class="btn btn-primary" onclick="select_winner(<?= $event_id ?>)"> Select Winner</button>
    </div>
    
    <div style="clear: both"></div>
</div>
<?php
$message = $this->session->flashdata('message');
if ($message != '') {
    ?>
    <center>
        <div class="alert alert-success alert-dismissable" style="width: 40%">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">&times;</button>
            <strong>
                <?php echo $message; ?>
            </strong>
        </div>
    </center>
    <?php
}
?> 
<div> 
    <?php
    $i = 0;
    foreach ($join_user as $join) {
        ?>
        <div style="width:20%;float: left">
            <img src="<?= (isset($join['user_image']) || !empty($join['user_image']) ) ? "" . base_url() . "uploads/users/" . $join['user_image'] : "" . base_url() . "assets/public/img/admin.png" ?>" class="img-circle" alt="<?= (isset($join['user_image']) || !empty($join['user_image']) ) ? $join['user_image'] : 'Admin' ?>" style="width:100px">
            <h4>
                <?php
                if ($join['user_id'] == "0") {
                    $name = "Admin";
                } else if (empty($join['name'])) {
                    $name = $join['user_name'];
                } else {
                    $name = $join['name'];
                }
                if ($join['is_winner'] == 1) {
                    $winner = "(Winner)";
                } else {
                    $winner = "";
                }
                echo $name;
                ?>
                <span style="color:red;font-size: 12px"><?= $winner ?></span>
            </h4>
        </div>
        <?php
        $i++;
    }
    ?>
    
    <div style="clear: both"></div>
</div>
<script>
    function select_winner(id) {
        $.ajax({
            type: "POST",
            url: "<?= '' . base_url() . 'admin/event/claimwinner' ?>",
            data: "event_id=" + id,
            success: function(data) {
                location.reload();
            }
        });
    }
    $(document).ready(function() {
        $('#count').html('<?= $i ?>')
    });
</script>
