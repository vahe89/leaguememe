$(document).ready(function () {

    $('#add_anime_category_form').validate({
        rules: {
            anime_category_name: {
                required: true,
            },
            anime_category_photo: {
                required: true,
            },
            anime_sub_cate: {
                required: true,
            },
            anime_episode: {
                required: true,
            },
            anime_episode_time: {
                required: true,
            },
            anime_manga: {
                required: true,
            },
            anime_manga_time: {
                required: true,
            }
        },
        messages: {
            anime_category_name: {
                required: "Category Name field is reqiured.",
            },
            anime_category_photo: {
                required: "Category photo is reqiured.",
            },
            anime_sub_cate: {
                required: "Select Sub Category",
            },
            anime_episode: {
                required: "Enter Episode",
            },
            anime_episode_time: {
                required: "Enter Episode time",
            },
            anime_manga: {
                required: "Enter Manga",
            },
            anime_manga_time: {
                required: "Enter Manga time",
            }
        }
    });
});
function delete_anime(category_id) {
    var cate = category_id.split("_");
    var r = confirm("Can you confirm this?");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/animecategory/delete_animecategory",
            data: "category_id=" + cate[1],
            success: function (msg) {
                location.reload();
            }
        });
    }
}

function change_image(id) {
    var cate = id.split("_");
    $(".modal-body #aniId").val(cate[1]);
}
$(document).on('click', '#send_cate', function () {
    var anime_sub_cate = [];
    $('.anime_cate:checked').each(function (i) {
        anime_sub_cate[i] = $(this).val();
    });
    var anime_id_ajax = $('#anime_id_ajax').val();

    $.ajax({
        type: 'POST',
        url: base_url + 'admin/animecategory/edit_categorySub/' + anime_id_ajax,
        dataType: 'html',
        data: {anime_sub_cate: anime_sub_cate
        },
        success: function () {
            window.location.reload();
        }
    });
});
function episode_time(id) {
    var cate = id.split("_");
    $(".modal-body #aniEpId").val(cate[1]);
    $(".modal-body #animgId").val(cate[1]);
    $(".modal-body #anime_episode_time").val(cate[2]);
    $(".modal-body #anime_manga_time").val(cate[3]);
}


function popular_anime(anime_id, anime_popular) {
    var r = confirm("Can you confirm this?")
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "admin/animecategory/popular_status",
            data: "anime_id=" + anime_id + "&anime_popular=" + anime_popular,
            success: function (msg) {
                location.reload();
            }
        });
    }
}