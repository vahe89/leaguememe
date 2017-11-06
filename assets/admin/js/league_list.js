function credit_status(credit_id, credit_status) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/leaguelist/active_credit",
            data: "credit_id=" + credit_id + "&credit_status=" + credit_status,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function active_league(league_id, league_status) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/leaguelist/update_league_status",
            data: "league_id=" + league_id + "&league_status=" + league_status,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function popular_league(league_id, league_popular_status) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/leaguelist/popular_status",
            data: "league_id=" + league_id + "&popular_status=" + league_popular_status,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function sidebar_status(league_id, sidebar_status) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/leaguelist/sidebar_status",
            data: "league_id=" + league_id + "&is_sidebar=" + sidebar_status,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function delete_league_img(league_img_id) {

    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/leaguelist/deleteleague_img",
            data: "league_img_id=" + league_img_id,
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function remove_sidebar_img(league_img_id) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/leaguelist/remove_sidebar_img",
            data: "league_img_id=" + league_img_id,
            success: function (msg) {
                location.reload();
            }
        });
    }
}
$(document).ready(function () {
    var videoCategory;
    var categoryId;

    getCategoryId();

    $("#category_list").change(function () {
        // $category = $(this).val();
        categoryId = $("#category_list :selected").val();
        if (categoryId == videoCategory) {
            $("#fileupload").hide();
            $("#videoupload").show();
        } else if (categoryId != videoCategory) {
            $("#fileupload").show();
            $("#videoupload").hide();
        }
    });
    function getCategoryId() {
        var dataVal = "video";
        $.ajax({
            type: "POST",
            url: base_url + "admin/leaguelist/getCategoryId",
            data: {category: dataVal},
            dataType: 'html',
            success: function (data) {
                videoCategory = data;
            }
        });
    }
});