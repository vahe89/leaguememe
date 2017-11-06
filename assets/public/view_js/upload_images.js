$(document).ready(function () {
    $("#category_list").change(function () {
        $category = $(this).val();
        if ($category == "6") {
            $("#fileupload").hide();
            $("#videoupload").show();
        }
        else if ($category != "6") {
            $("#fileupload").show();
            $("#videoupload").hide();
        }
    });

    $("#upload_meme").validate({
        rules: {
            league_img_name: {
                required: true
            },
            category_list: {
                required: true
            },
            league_img_credits: {
                required: true
            },
            league_tags: {
                required: true
            }
        },
        messages: {
            league_img_name: {
                required: "Enter League Image Name"
            },
            category_list: {
                required: "Select League Category"
            },
            league_img_credits: {
                required: "Enter League Image Credit"
            },
            league_tags: {
                required: "Enter League Tags"
            }
        }
    });

    $('#league_img').change(function () {
        var filee = $("#league_img").val();
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
                } else {
                    $('#submit').attr("disabled", false);
                }
                $('#img').html(data);
            }
        });
    });

});