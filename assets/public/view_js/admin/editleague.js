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
   function getCategoryId(){
    var dataVal = "video";   
      $.ajax({
        type: "POST",
        url: base_url + "leaguelist/getCategoryId",
        data : {check : dataVal},
        dataType: 'html',
        success: function (data) {
            videoCategory = data;
        }
      });  
   }
});