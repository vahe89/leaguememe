function delete_article(article_id) {

    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/articles/delete_article",
            data: "article_id=" + article_id,
            success: function(msg) {
                location.reload();
            }
        });
    }
}

function active_article(article_id, article_status) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/articles/update_status",
            data: "article_id=" + article_id + "&article_status=" + article_status,
            success: function(msg) {
                //alert(msg);
                location.reload();
            }
        });
    }
}

function popular_article(article_id, popular_status) {
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/articles/popular_status",
            data: "article_id=" + article_id + "&popular_status=" + popular_status,
            success: function(msg) {
                //alert(msg);
                location.reload();
            }
        });
    }
}