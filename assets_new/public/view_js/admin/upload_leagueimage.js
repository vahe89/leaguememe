$(document).ready(function () {
   var categoryId;
   var catText = "Art";
   var videoCategory;
   var imageData = [];
   var oldNum;
   var remainingbtn = 0;
   var upData ={
        num         :   0,
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
        tagMsg      :   "#tagMsg_",
        grid24      :   "grid-24",
        grid5       :   "grid-5",
        grid4       :   "grid-4",
        grid1       :   "grid-1",
        goBtn       :   "#goBtn",
        nofmeme     :   "#league_img_number"
    };
    if(upData.num == 0){
        $("#imgSubmit").hide();
    }
    $("#goBtn").bind('click',function(){
       var numreg = /^[0-9]+$/;
       if($(upData.nofmeme).val().match(numreg) && $(upData.nofmeme).val() != 0)
       {   
           $("#imgSubmit").show();
           $("#nofmeme").hide();
            oldNum = upData.num;
            var newIndex = oldNum+1; 
            var newInsert = parseInt($(upData.nofmeme).val());
            upData.num += parseInt($(upData.nofmeme).val());
            
            $("#totalnum").html('<input type="text" style="disply:none" name="league_img_total" value="'+upData.num+'" id="league_img_total" />');
            remainingbtn += newInsert; 
             for(i=1;i<=newInsert;i++){
                 bulitMultipleForm(newIndex);            
                 $("#deleteBtn"+newIndex).bind('click',{indexVal:newIndex},function(evt){
                     remainingbtn--;
                     var index = evt.data.indexVal;
                     //var val= $("#deleteBtn"+index).val();
                     $("#lgdata_"+index).remove();
                     if(remainingbtn == 0){
                         $("#imgSubmit").hide();
                     }
                 });  
             newIndex++;
        }
        $(upData.nofmeme).val('');
       }
       else{
           $("#nofmeme").show();
           $("#nofmeme").html("<strong><font color=red>Enter Proper Number</font></strong>");
       }
    });
    $("#category_list").change(function () {
        categoryId = $("#category_list :selected").val();
        catText = $("#category_list :selected").text();
        if (categoryId == videoCategory) {
          for(i=1;i<=upData.num;i++){ 
            $("#fileupload"+i).hide();
            $("#videoupload"+i).show();
          } 
        }
        else if (categoryId != videoCategory) {
           for(i=1;i<=upData.num;i++){  
            $("#fileupload"+i).show();
            $("#videoupload"+i).hide();
          } 
        }
    });
   getCategoryId();
//   initializeAddForm();
   
   function getCategoryId(){
    var dataVal = "video";   
      $.ajax({
        type: "POST",
        url: base_url + "leaguelist/getCategoryId",
        data : {check : dataVal},
        dataType: 'html',
        success: function (data) {
            videoCategory = data;
           //alert("videoCat="+videoCategory);
        }
      });  
   }
//   function initializeAddForm(){
//        $(upData.plus+1).unbind();
//        $(upData.plus+1).click(function(evt){
//                $(upData.plus+1).hide();
//                evt.preventDefault();
//                evt.stopPropagation();
//                bulitMultipleForm();
//        });
//    }
    function bulitMultipleForm(newIndex){
            var html = '';            
            html = html +'<div id="lgdata_'+newIndex+'">'+
                     '<div class="'+upData.grid24+'">'+
                        '<div class="'+upData.grid5+'">'+
                          '<div class="field-group">'+
                            '<label for="required">Meme Name:</label>'+
                            '<div>'+
                              '<input type="text" name="league_img_name['+newIndex+'][name]" id="league_img_name_'+newIndex+'" class="validate[required]"/>'+
                           '</div>'+
                        '</div>'+
                       '</div>'+
                        '<div class="'+upData.grid4+'">'+
                            '<div class="field-group"  >'+
                             '<label for="required">Credits/Source:</label>'+
                             '<div>'+
                               '<input type="text" name="league_img_name['+newIndex+'][credit]" id="league_img_credits_'+newIndex+'" />'+
                             '</div>'+
                            '</div>'+
                        '</div>';
                    if($.trim(catText) !== "Video" && $.trim(catText) !== "video"){
                      html= html+'<div class="'+upData.grid5+'">'+
                            '<div class="field-group"  id="fileupload'+newIndex+'" style="margin-left:8px;">'+
                              '<label for="required">Meme Image:</label>'+
                                '<div class="uploader">'+
                                  '<input type="file" style="opacity: 1;" multiple name="league_img['+newIndex+']" id="league_img_'+newIndex+'" class="validate[required]"/>'+
                              '</div>'+
                            '</div>'+
                            '<div class="field-group" id="videoupload'+newIndex+'" style="display:none">'+
                              '<label for="required">Video Link:</label>'+
                                '<div>'+
                                  '<textarea name="league_img_name['+newIndex+'][video]"  style="resize:none" rows="2" id="videolink_'+newIndex+'" class="validate[required]"></textarea>'+
                                '</div>'+
                            '</div>';
                     }else{
                        html = html+'<div class="'+upData.grid5+'">'+
                            '<div class="field-group"  id="fileupload'+newIndex+'" style="display:none">'+
                              '<label for="required">Meme Image:</label>'+
                                '<div class="uploader">'+
                                  '<input type="file" name="league_img['+newIndex+']" multiple id="league_img_'+newIndex+'" class="validate[required]"/>'+
                                  '<span class="filename">No file Selected</span>'+
                                  '<span class="action">Choose File</span>'+
                               '</div>'+
                            '</div>'+
                            '<div class="field-group" id="videoupload'+newIndex+'">'+
                              '<label for="required">Video Link:</label>'+
                                '<div>'+
                                  '<textarea name="league_img_name['+newIndex+'][video]"  style="resize:none" rows="2" id="videolink_'+newIndex+'" class="validate[required]"></textarea>'+
                                '</div>'+
                            '</div>';
                     }
                       html = html+'</div>'+
                        '<div class="'+upData.grid4+'">'+
                          '<div class="field-group">'+
                           '<label for="required">Tags : </label>'+
                            '<div>'+
                                '<input type="text"  name="league_img_name['+newIndex+'][tag]" id="league_tags_'+newIndex+'" class="validate[required]"/>'+
                            '</div>'+ 
                          '</div>'+
                        '</div>'+                         
                        '<div class="'+upData.grid5+'">'+
                         '<div class="field-group">'+
                           '<label for="required">Content is not safe for work: </label>'+
                            '<div style="margin-left: 20px;">'+
                              '<input type="checkbox" name="league_img_name['+newIndex+'][swf]" id="league_access_'+newIndex+'" value="1" />'+
                            '</div>'+
                         '</div>'+                         
                        '</div>'+
                        '<div class="'+upData.grid1+'">'+
                         '<div class="field-group">'+
                           '<button type="button" class="btn btn-danger btn-circle" value="'+newIndex+'" style="height:40px;" id="deleteBtn'+newIndex+'" ><img alt="delete" src="'+base_url+'assets/images/btn-close.png"></button>'+        
                         '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>';
          $("#legimgDataId2").append(html);            
//          '+                    
//                    '<div>'+
//                       '<button class="btn btn-success btn-circle" type="button" name="plus_'+newIndex+'" id="legPlus_'+newIndex+'"><i class="fa fa-plus"></i><img height="20" width="20" src="'+base_url+'assets/images/add-plus.ico"/></button>'+
//                       '<button class="btn btn-danger btn-circle" type="button" name="minus_'+newIndex+'" id="legMinus_'+newIndex+'"><i class="fa fa-minus fa-4 "></i><img height="20" width="20" src="'+base_url+'assets/images/remove-minus.ico"/></button>'+
//                    '</div>
        }
   function bulitMultipleForm1(){
            var html = '';   
            upData.num++;
            html = html +'<div id="lgdata_'+upData.num+'">'+
                     '<div class="'+upData.grid24+'">'+
                        '<div class="'+upData.grid5+'">'+
                          '<div class="field-group">'+
                            '<label for="required">Meme Name:</label>'+
                            '<div>'+
                              '<input type="text" name="league_img_name['+upData.num+'][name]" id="league_img_name_'+upData.num+'" class="validate[required]"/>'+
                           '</div>'+
                        '</div>'+
                       '</div>'+
                        '<div class="'+upData.grid5+'">'+
                            '<div class="field-group"  >'+
                             '<label for="required">Credits/Source:</label>'+
                             '<div>'+
                               '<input type="text" name="league_img_name['+upData.num+'][credit]" id="league_img_credits_'+upData.num+'" class="validate[required]"/>'+
                             '</div>'+
                            '</div>'+
                        '</div>';
                    if($.trim(catText) !== "Video"){
                      html= html+'<div class="'+upData.grid5+'">'+
                            '<div class="field-group"  id="fileupload'+upData.num+'">'+
                              '<label for="required">Meme Image:</label>'+
                                '<div class="uploader">'+
                                  '<input type="file" size="19" style="opacity: 0;" name="league_img['+upData.num+']" id="league_img_'+upData.num+'" class="validate[required]"/>'+
                                  '<span class="filename" style="-moz-user-select:none;">No file Selected</span>'+
                                  '<span class="action" style="-moz-user-select:none;">Choose File</span>'+
                              '</div>'+
                            '</div>'+
                            '<div class="field-group" id="videoupload'+upData.num+'" style="display:none">'+
                              '<label for="required">Video Link1:</label>'+
                                '<div>'+
                                  '<textarea name="league_img_name['+upData.num+'][video]"  style="resize:none" rows="2" id="videolink_'+upData.num+'" class="validate[required]"></textarea>'+
                                '</div>'+
                            '</div>';
                     }else{
                        html = html+'<div class="'+upData.grid5+'">'+
                            '<div class="field-group"  id="fileupload'+upData.num+'" style="display:none">'+
                              '<label for="required">Meme Image:</label>'+
                                '<div class="uploader">'+
                                  '<input type="file" name="league_img['+upData.num+']" id="league_img_'+upData.num+'" class="validate[required]"/>'+
                                  '<span class="filename" style="-moz-user-select:none;">No file Selected</span>'+
                                  '<span class="action" style="-moz-user-select:none;">Choose File</span>'+
                               '</div>'+
                            '</div>'+
                            '<div class="field-group" id="videoupload'+upData.num+'">'+
                              '<label for="required">Video Link2:</label>'+
                                '<div>'+
                                  '<textarea name="league_img_name['+upData.num+'][video]"  style="resize:none" rows="2" id="videolink_'+upData.num+'" class="validate[required]"></textarea>'+
                                '</div>'+
                            '</div>';
                     }
                       html = html+'</div>'+
                        '<div class="'+upData.grid5+'">'+
                          '<div class="field-group">'+
                           '<label for="required">Tags : </label>'+
                            '<div>'+
                                '<input type="text"  name="league_img_name['+upData.num+'][tag]" id="league_tags_'+upData.num+'" class="validate[required]"/>'+
                            '</div>'+ 
                          '</div>'+
                        '</div>'+                         
                        '<div class="'+upData.grid55+'">'+
                         '<div class="field-group">'+
                           '<label for="required">Content is not safe for work: </label>'+
                            '<div>'+
                              '<input type="checkbox" name="league_img_name['+upData.num+'][swf]" id="league_access_'+upData.num+'" value="1" />'+
                            '</div>'+
                         '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+                    
                    '<div>'+
                       '<button class="btn btn-success btn-circle" type="button" name="plus_'+upData.num+'" id="legPlus_'+upData.num+'"><i class="fa fa-plus"></i><img height="20" width="20" src="'+base_url+'assets/images/add-plus.ico"/></button>'+
                       '<button class="btn btn-danger btn-circle" type="button" name="minus_'+upData.num+'" id="legMinus_'+upData.num+'"><i class="fa fa-minus fa-4 "></i><img height="20" width="20" src="'+base_url+'assets/images/remove-minus.ico"/></button>'+
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
  // $("#imgSubmit").click(function(){
        //alert($("#league_img_name1").val());
//      var loading = '<img src="'+base_url+'assets/images/loading.gif"/>';  
//      $("#loader").show();
//       $("#loader").html(loading);
//      var check = checkValidateForm();
//       if(check){
//          $.ajax({
//            type: "POST",
//            url: base_url + "home/addleague_image", 
//            data: {allIgData:check,total:upData.num},
//            contentType: 'multipart/form-data',
//            cache: false,
//            success: function (data) {
//                $("#loader").hide();
//                alert("success");
//            }
//         });  
//       }
   // });
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
     
