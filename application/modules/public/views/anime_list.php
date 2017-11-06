
 
<?php foreach ($anime_list as $value) {
    ?>
    <a class="item" href="<?php echo base_url(); ?>anime-list-album/<?php echo $value['anime_id']; ?>">
        <img src="<?php echo base_url(); ?>uploads/anime/<?php echo $value['anime_jpg']; ?>" alt="cover">
        <div class="overlay">
            <div class="actions">
                <?php
                if (isset($user_id)) {

                    if (isset($value['user_id'])) {
                        ?>

                        <span id="fav_<?php echo $value['anime_id']; ?>" data-toggle="queue" data-id="<?php echo $value['anime_id']; ?>" class="fav blue action"><i class="fa fa-star" style="color: #ECB73B" title="Already Added!"></i></span>

                    <?php } else {
                        ?>
                        <span id="fav_<?php echo $value['anime_id']; ?>" data-toggle="queue" data-id="<?php echo $value['anime_id']; ?>" class="fav blue action"><i class="fa fa-star" title="Add To Favourite"></i></span>
                        <?php
                    }
                } else {
                    ?>
                    <span  data-toggle="queue"   class="blue action"></span>  
                <?php } ?>
            </div>
        </div>
        <div class="episode-image">
            <span>Episode 20</span>

        </div>
        <div class="title-image">
            <div class="limit"> <?php echo $value['anime_name']; ?></div>
        </div>
    </a>
    <?php
}
?>
<script>

    $(".fav").click(function (event) {
        event.preventDefault();
        var str = $(this).attr('id');
        var id = str.split("_");
        var anime_id = id[1];
        $.ajax({
            type: 'POST',
            url: base_url + 'public/animelist/add_favorite',
            dataType: 'json',
            data: {anime_id: anime_id},
            success: function (data) {
                if (data.status == "false") {
//                location.href = base_url + "user/login";
//                  $('#login_modal').trigger('click');
                    var html = '<div id="modal_backdrop" class="modal-backdrop fade in"></div>';
                    $('#body_id').append(html);
                    $('#login').addClass('in');
                    $('#login').show();
                } else if (data.status === "delete") {
                    $('#' + str).html('<i class="fa fa-star" style="color:white" title="Add to Favourite"></i>');
                } else if (data.status === "insert") {
                    $('#' + str).html('<i class="fa fa-star" style="color: #ECB73B" title="Already Added!"></i>');

                } else {
                    location.reload();
                }

            }
        });

    });
    $(document).ready(function () {
        $('#login_close').click(function () {

            $('#login').removeClass('in');
            $('#login').hide();
            $('#modal_backdrop').remove();
        });
    });
</script>