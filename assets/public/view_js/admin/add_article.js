$(document).ready(function () {
    CKEDITOR.replace('editor1');

    $('#article_img').change(function () {
        var filee = $("#article_img").val();
        var dataString = 'filee=' + filee;

        $.ajax({
            type: "POST",
            url: base_url + "home/get_file",
            data: dataString,
            cache: false,
            dataType: 'html',
            success: function (data) {
                $('#img').html(data);
            }
        });
    });

    $('#article_name').change(function () {
        var str = $('#article_name').val();
        var article_name = str.trim();
        var article_name1 = article_name.split(' ').join('-');
        $('#article_url').val(article_name1);
    });

});