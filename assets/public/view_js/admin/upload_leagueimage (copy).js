$(document).ready(function () {
   var categoryId = 0;
   var imageData = [];
   //getCategoryId();
//   function getCategoryId(){
//    var dataVal = "video";   
//      $.ajax({
//        type: "POST",
//        url: base_url + "home/getCategoryId",
//        data : dataVal,
//        dataType: 'html',
//        success: function (data) {
//               
//        }
//      });  
//   }
    function initializeAddForm(){
        $(upData.plus+1).unbind();
        $(upData.plus+1).click(function(evt){
                $(upData.plus+1).hide();
                evt.preventDefault();
                evt.stopPropagation();
                bulitMultipleForm();
        });
    }
    function bulitMultipleForm(){
            upData.num++;
            var html = '<div id="lgdata_'+upData.num+'">'+
                     '<div class="grid-24">'+
                        '<div class="grid-5">'+
                          '<div class="field-group">'+
                            '<label for="required">Meme Name:</label>'+
                            '<div class="field">'+
                              '<input type="text" name="league_img_name_'+upData.num+'" id="league_img_name_'+upData.num+'" class="validate[required]"/>'+
                              '<p id="nmMsg_'+upData.num+'"></p>'+ 
                           '</div>'+
                        '</div>'+
                       '</div>'+
                        '<div class="grid-5">'+
                            '<div class="field-group"  >'+
                             '<label for="required">Credits/Source:</label>'+
                             '<div>'+
                               '<input type="text" name="league_img_credits_'+upData.num+'" id="league_img_credits_'+upData.num+'"/>'+
                               '<p id="cditsMsg_'+upData.num+'"></p>'+
                              '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="grid-5">'+
                            '<div class="field-group"  id="fileupload'+upData.num+'">'+
                              '<label for="required">Meme Image:</label>'+
                                '<div>'+
                                  '<input type="file" name="league_img_'+upData.num+'" id="league_img_'+upData.num+'" class="validate[required]"/>'+
                                  '<span id="img'+upData.num+'"></span>'+
                                 '</div>'+
                            '</div>'+
                            '<div class="field-group" id="videoupload'+upData.num+'" style="display:none">'+
                              '<label for="required">Video Link:</label>'+
                                '<div class="field">'+
                                  '<textarea name="videolink_'+upData.num+'" id="videolink_'+upData.num+'" class="validate[required]"></textarea>'+
                                  '<p id="videoMsg_'+upData.num+'"></p>'+  
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="grid-4">'+
                          '<div class="field-group">'+
                           '<label for="required">Tags : </label>'+
                            '<div class="field">'+
                                '<input type="text"  name="league_tags_'+upData.num+'" id="league_tags_'+upData.num+'">'+
                                '<p id="tagMsg_'+upData.num+'"></p>'+ 
                            '</div>'+ 
                          '</div>'+
                        '</div>'+                         
                        '<div class="grid-5">'+
                         '<div class="field-group">'+
                           '<label for="required">Content is not safe for work: </label>'+
                            '<div class="field">'+
                              '<input type="checkbox" name="league_access_'+upData.num+'" id="league_access_'+upData.num+'" value="1" >'+
                            '</div>'+
                         '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+                    
                    '<div>'+
                       '<button class="btn btn-success btn-circle" type="button" name="plus_'+upData.num+'" id="legPlus_'+upData.num+'"><i class="fa fa-plus"></i><img src="'+base_url+'assets/images/add-plus.ico"/></button>'+
                       '<button class="btn btn-danger btn-circle" type="button" name="minus_'+upData.num+'" id="legMinus_'+upData.num+'"><i class="fa fa-minus fa-4 "></i><img src="'+base_url+'assets/images/remove-minus.ico"/></button>'+
                    '</div>';
          $("#legimgDataId2").append(html);
          window.setTimeout(function(){
                $(upData.minus+upData.num).click(function(evt){
                        evt.preventDefault();
                        evt.stopPropagation();
                        $("#lgdata_"+upData.num).remove();
                        //$(document.getElementById(em.msgDiv+em.num)).remove();
                        $(upData.plus+upData.num).remove();
                        $(upData.minus+upData.num).remove();
                        upData.num--;
                        if(upData.num == 1){
                                $(upData.plus).show();
                                $("legimgDataId2").html('');
                        }
                        else{
                                $(upData.plus+upData.num).show();
                                $(upData.minus+upData.num).show();
                        }
                        if(upData.num == 1){
                                $(upData.plus+upData.num).show();
                        }
                });
                $(upData.plus+upData.num).click(function(evt){
                        evt.preventDefault();
                        evt.stopPropagation();
                        $(upData.plus+upData.num).hide();
                        $(upData.minus+upData.num).hide();
                        bulitMultipleForm();
                });
	    },200);            
        }
    var upData ={
        num         :   1,
        plus        :   "#legPlus_",
        minus       :   "#legMinus_",
        dataDiv     :   "#legimgDataId",
        memeNm      :   "#league_img_name_",
        credit      :   "#league_img_credits_",
        img         :   "#league_img_",
        video       :   "#videolink_",
        tags        :   "#league_tags_",
        sfw         :   "#league_access_",
        nmMsg       :   "#nmMsg_",
        cditMsg     :   "#cditsMsg_",
        imgMsg      :   "#img",
        videoMsg    :   "#videoMsg_",
        tagMsg      :   "#tagMsg_"
        
    };
     $("#category_list").change(function () {
        categoryId = $(this).val();
      
       for(i=1;i<=upData.num;i++){ 
            if (categoryId == "6") {
                $("#fileupload"+i).hide();
                $("#videoupload"+i).show();
            } else if (categoryId != "6") {
                $("#fileupload"+i).show();
                $("#videoupload"+i).hide();
            }
        }// "total"--for loop over 
       }); 
      initializeAddForm();  
      for(i=1;i<=upData.num;i++){ 
        $("#league_img_"+i).bind('change',{id:i},function(evt){
          var iVal = evt.data.id;
          var filee = $("#league_img_"+iVal).val();
          var dataString = 'filee=' + filee;
            $.ajax({
            type: "POST",
            url: base_url + "home/get_file",
            data: dataString,
            cache: false,
            dataType: 'html',
            success: function (data) {
               if(data === "true"){ 
                  $('#img'+iVal).html("");
                  //return data;
               } 
               else{
                    $("#img"+iVal).html("<p><font color=red>upload only .jpeg/.jpg and .png files</font></p>");
                  //return data;
               }
            }
         });
      });
   }
   $("#imgSubmit").click(function(){
        //alert($("#league_img_name1").val());
      var loading = '<img src="'+base_url+'assets/images/loading.gif"/>';  
      $("#loader").show();
       $("#loader").html(loading);
      var check = checkValidateForm();
       if(check){
          $.ajax({
            type: "POST",
            url: base_url + "home/addleague_image", 
            data: {allIgData:check,total:upData.num},
            cache: false,
            dataType: 'html',
            success: function (data) {
                $("#loader").hide();
                alert("success");
            }
         });  
       }
    });
    function checkValidateForm(){
        var flag = true;
        //return true;
        var nmREG = /^[a-zA-Z\s-_ ]+$/;
        if(categoryId == 0){
            //validation for category id       
        }
        for(i=1;i<=upData.num;i++){
          // validation for name  
             
          if($(upData.memeNm+i).val().match(nmREG)){
                
                flag = true;
                $(upData.nmMsg+i).html(VALIDNOT);
                $(upData.nmMsg+i).hide(10000);
            }
            else{
                
                    flag = false;
                    $(upData.nmMsg+i).show();
                    $(upData.nmMsg+i).html(INVALIDNOT);
                    $('html, body').animate({scrollTop: Number($(upData.nmMsg+i).offset().top)-110}, "slow");
                    $(upData.memeNm+i).focus();
                    return flag;
            }
            // validation for credits  
            if($(upData.credit+i).val().match(nmREG)){
                
                flag = true;
                $(upData.cditMsg+i).html(VALIDNOT);
                $(upData.cditMsg+i).hide(10000);
            }
            else{
                
                    flag = false;
                    $(upData.cditMsg+i).show();
                    $(upData.cditMsg+i).html(INVALIDNOT);
                    $('html, body').animate({scrollTop: Number($(upData.cditMsg+i).offset().top)-120}, "slow");
                    $(upData.credit+i).focus();
                    return flag;
            }
            
            // validation for image  
//            if($(upData.img+i).val() != " "){
//                alert("true");
//                flag = true;
//                //$(upData.nmsg).html(VALIDNOT);
//            }
//            else{
//                    alert("false");
//                    flag = false;
//                    //$(nmsg).html(INVALIDNOT);
//                    $('html, body').animate({scrollTop: Number($(add.nmsg).offset().top)-95}, "slow");
//                    //$(name).focus();
//                    return;
//            }
//           if(categoryId != 0){
//             // check for video and img    
//           }            
            // validation for tag  
            
            if($(upData.tags+i).val() !== ""){
                flag = true;
                $(upData.tagMsg+i).html(VALIDNOT);
                $(upData.tagMsg+i).hide(10000);
            }
            else{
                    
                    flag = false;
                    $(upData.tagMsg+i).show();
                    $(upData.tagMsg+i).html(INVALIDNOT);
                    $('html, body').animate({scrollTop: Number($(upData.tagMsg+i).offset().top)-110}, "slow");
                    $(upData.tags+i).focus();
                    return flag;
            }
            // validation for sfw
//            if($(upData.sfw+i).val() != " "){
//                
//                flag = true;
//                //$(upData.nmsg).html(VALIDNOT);
//            }
//            else{
//                    
//                    flag = false;
//                    //$(nmsg).html(INVALIDNOT);
//                   // $('html, body').animate({scrollTop: Number($(add.nmsg).offset().top)-95}, "slow");
//                    //$(name).focus();
//                    return flag;
//            }
        }//end for loop
        //$("#category_list;
        
        var allMemeData = [];
        for(i=1;i<=upData.num;i++){
            allMemeData[i] = {
               category      : categoryId,
               memeNmData    : $(upData.memeNm+i).val(),
               creditData    : $(upData.credit+i).val(),
               imgData       : $(upData.img+i).val(),
               videoData     : $(upData.video+i).val(),
               tagsData      : $(upData.tags+i).val(),
               sfwData       : $(upData.sfw+i).val()
              }
          }
       console.log(allMemeData);
        if(flag == false)
        {
            return flag;
        }
        else{
          return allMemeData;    
        }  
       
    }
});  
     
