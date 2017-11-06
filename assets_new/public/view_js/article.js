$(document).ready(function () {

    $('#comment_toggle').click(function () {
        $('#add_comment').slideToggle(500);
    });

    $('#view_comment').click(function () {
        $('#comment_toggle').scrollView();
    });

    $('#comment_add').on('submit', function (e) {
        e.preventDefault();
        var comment = $('#article_comment').val();
        if (comment == '') {
            return false;
        }
        else {
            var url = $('#comment_add').attr('action');
            $.ajax({
                method: 'POST',
                url: url,
                data: $('#comment_add').serialize(),
                success: function (response) {
                    $('#scroll_wrap').prepend(response);
                    $('#article_comment').val('');
                    var count = parseInt($('.count').text());
                    $('.count').text(count + 1);
                }
            });
        }
    });

});