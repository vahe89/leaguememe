$("#modal_trigger").leanModal({
    top: 200,
    overlay: 0.6,
    closeButton: ".modal_close"
});

$(function() {
    $("#choose-link").click(function() {
        $("#modal_upload").hide();
        $(".link-upload").show();
        return false;
    });



    // Upload Image

    $("#back-image").click(function() {
        $(".image-upload").hide();
        $("#modal_upload").show();
    });

    $("#back-anime-image").click(function() {
        $(".anime-category-image").hide();
        $(".upload-category-image").show();
    });

    // Upload Discuss

    $("#back-discuss").click(function() {
        $(".discuss-upload").hide();
        $("#modal_upload").show();
    });

    $("#back-category-discuss").click(function() {
        $(".upload-category-discuss").hide();
        $(".discuss-upload").show();
    });

    $("#back-anime-discuss").click(function() {
        $(".anime-category-discuss").hide();
        $(".upload-category-discuss").show();
    });

    // Upload link

    $("#back-link").click(function() {
        $(".link-upload").hide();
        $("#modal_upload").show();
    });

//    $("#back-category-link").click(function () {
//        $(".upload-category-link").hide();
//        $(".link-upload").show();
//    });

    $("#back-anime-link").click(function() {
        $(".anime-category-link").hide();
        $(".upload-category-link").show();
    });

    $("#back-category-link").click(function() {
        $(".upload-category-link").hide();
        $(".url_title_upload").show();
    });

    // Upload Album

    $("#back-album").click(function() {
        $(".album-upload").hide();
        $("#modal_upload").show();
    });

    $("#back-category-album").click(function() {
        $("#album_category").hide();
        $(".upload-category-album").hide();
        $(".album-upload").show();
    });

    $("#back-anime-album").click(function() {
        $(".anime-category-album").hide();
        $(".upload-category-album").show();
    });

// upload gamechat
    $("#back-gamechat").click(function() {
        $(".gamechat-upload").hide();
        $("#modal_upload").show();
    });

    // Upload Rating

    $("#back-rating").click(function() {
        $(".rating-upload").hide();
        $("#modal_upload").show();
    });

    $("#back-category-rating").click(function() {
        $(".upload-category-rating").hide();
        $(".rating-upload").show();
    });

    $("#back-anime-rating").click(function() {
        $(".anime-category-rating").hide();
        $(".upload-category-rating").show();
    });

    // Going back to Social Forms
    $("#btn-save").click(function() {
        $(".image-upload").hide();
        $("#modal_upload").hide();
        $(".upload-category1").hide();
        $(".upload-category2").hide();
        $(".upload-category3").hide();
        $(".upload-category4").hide();
        $(".upload-category5").hide();
        $(".anime-category").hide();
        $(".discuss-upload").hide();
        return false;
    });

})

$(document).ready(function() {
    $('input[class="only_credit"]').click(function() { 
        if ($(this).attr("value") == "credit") {
            $(".credit").toggle();
        }
    });
});