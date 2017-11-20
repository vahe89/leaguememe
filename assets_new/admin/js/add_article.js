$(document).ready(function() {
    CKEDITOR.replace('editor1');

//    $('#article_img').change(function () {
//        var filee = $("#article_img").val();
//        var dataString = 'filee=' + filee;
//
//        $.ajax({
//            type: "POST",
//            url: base_url + "home/get_file",
//            data: dataString,
//            cache: false,
//            dataType: 'html',
//            success: function (data) {
//                $('#img').html(data);
//            }
//        });
//    });

    $('#article_name').change(function() {
        var str = $('#article_name').val();
        var article_name = str.trim();
        var article_name1 = article_name.split(' ').join('-');
        $('#article_url').val(article_name1);
    });
    $('#add_articles_form').validate({
        rules: {
            article_name: {
                required: true,
            },
            article_url: {
                required: true,
            },
            article_tag: {
                required: true,
            },
            editor1: {
                required: true,
            },
            article_img: {
                required: true,
            },
            meta_keyword: {
                required: true,
            },
            meta_description: {
                required: true,
            }
        },
        messages: {
            article_name: {
                required: "Articles Name field is reqiured.",
            },
            article_url: {
                required: "Articles url field is reqiured.",
            },
            article_tag: {
                required: "Articles tag field is reqiured.",
            },
            editor1: {
                required: "Articles Description field is reqiured.",
            },
            article_img: {
                required: "Articles img field is reqiured.",
            },
            meta_keyword: {
                required: "Meta kwyword field is reqiured.",
            },
            meta_description: {
                required: "Meta description field is reqiured.",
            }
        }
    });
});