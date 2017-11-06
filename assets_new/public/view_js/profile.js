$(document).ready(function (e) {
    $('#profile_user').change(function () {
        var filee = $("#profile_user").val();
        var dataString = 'filee=' + filee;
        $.ajax({
            type: "POST",
            url: base_url + "home/get_file",
            data: dataString,
            cache: false,
            dataType: 'html',
            success: function (data) {
                if (data != '') {
                    $('#submit').attr("disabled", true);
                }
                else {
                    $('#submit').attr("disabled", false);
                }
                $('#img').html(data);
            }
        });
    });
    
    $('#form_profile').validate({
       rules : {
           user_email : {
               required : true
           }
       },
       messages : {
           user_email : {
               required : "Enter Email"
           }
       }
    });
    
});