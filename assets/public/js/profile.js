$(document).ready(function() {
    if($("#edit-profile").length > 0){
        $.ajax({
            type: "POST",
            url: base_url + "public/user/edit_profile_page",
            cache: false,
            success: function(data) {
                $("#edit-profile").html(data);
            }
        });
    }
    $(".my-select").chosen();
    $('#btn-edit-summoner').on('click', function(e) {
        $("#edit-summoner-container").show();
        $("#show-summoner-info").hide();
        $(this).hide();
        $("#btn-save-summoner").show();
        e.preventDefault();
    })

    $('#btn-save-summoner').bind('click', function(e) {
        $("#btn-save-summoner").hide();
        $("#edit-summoner-container").hide();
        $("#show-summoner-info").show();
        $("#btn-edit-summoner").show();
        
        $formData = $("form[name=summoner-form]").serialize();
        url = $("form[name=summoner-form]").attr('action');
        
        $.ajax({
            type: "POST",
            url: url,
            data: $formData ,
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                window.location.reload();
            }
        });
    });
    $('input[name="fav_champ[]"]').click(function(){
        $all = "";
        $('input[name="fav_champ[]"]').each(function(){
            if($(this).is(':checked')){
                $all+=$(this).val()+", ";
            }
        })
        $("#dropdown-menu1").text($all);
    })
    $('input[name="fav_role[]"]').click(function(){
        $all = "";
        $('input[name="fav_role[]"]').each(function(){
            if($(this).is(':checked')){
                $all+=$(this).val()+", ";
            }
        })
        $("#dropdown-menu2").text($all);
    })
})

/* 
 * action edit comment status
 */
function showCommentForm(selector) {
    selector.parents('div#comment_left').find('.show-anime').slideToggle('slow');
    selector.parents('div#comment_left').find('.edit-anime').slideToggle('slow');
    selector.parents('div#comment_right').find('.show-anime-review').slideToggle('slow');
    selector.parents('div#comment_right').find('.edit-anime-review').slideToggle('slow');
}
function bioupdate() {
    var title = $('.title-note').val();
    var description = tinymce.activeEditor.getContent();
    $.ajax({
        type: "POST",
        url: base_url + "public/user/update_biodata",
        data: {
            description: description
        },
        success: function(data) {
            window.location.reload();
        }
    });
}
function editProfile() {
    $("#edit_profile").css("color", "#17ae97");
    $("#setting_profile").css("color", "#cdcece");
    $.ajax({
        type: "POST",
        url: base_url + "public/user/edit_profile_page",
        cache: false,
        success: function(data) {
            $("#profile_content").html(data);
        }
    });
}
function settingProfile() {
    $("#setting_profile").css("color", "#17ae97");
    $("#edit_profile").css("color", "#cdcece");
    $.ajax({
        type: "POST",
        url: base_url + "public/user/setting_profile_page",
        cache: false,
        success: function(data) {
            $("#profile_content").html(data);
        }
    });
}
function aboutProfile() {
    $("#about_profile").css("color", "#17ae97");
    var id = $('#about_id').val();
    $.ajax({
        type: "POST",
        url: base_url + "public/user/about_profile_page",
        data: {id: id},
        cache: false,
        success: function(data) {
//            $("#profile_content").html(data);
  $("#edit-profile").html(data);
        }
    });
}