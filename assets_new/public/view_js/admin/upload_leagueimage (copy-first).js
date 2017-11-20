$(document).ready(function () {
    var upData ={
        num         :   1,
        plus        :   "#legPlus_",
        minus       :   "#legMinus_",
        dataDiv     :   "#legimgDataId",
    };
    
     $("#category_list").change(function () {
        $category = $(this).val();
       for(i=1;i<=upData.num;i++){ 
            if ($category == "6") {
                $("#fileupload"+i).hide();
                $("#videoupload"+i).show();
            } else if ($category != "6") {
                $("#fileupload"+i).show();
                $("#videoupload"+i).hide();
            }
        }// "total"--for loop over 
       }); 
       
       
       
       
       
    $(upData.plus+upData.num).bind('click',function(evt){
       $(upData.plus+upData.num).hide();
       upData.num = upData.num+1;
       if(upData.num == 1)
       {
           $(upData.plus+upData.num).show();
       }
       else{
         var html = '<div id="lgdata_'+upData.num+'">'+
                     '<div class="grid-24">'+
                        '<div class="grid-5">'+
                          '<div class="field-group">'+
                            '<label for="required">Meme Name:</label>'+
                            '<div class="field">'+
                              '<input type="text" name="league_img_name2" id="league_img_name2" class="validate[required]"/>'+
                            '</div>'+
                        '</div>'+
                       '</div>'+
                        '<div class="grid-5">'+
                            '<div class="field-group"  >'+
                             '<label for="required">Credits/Source:</label>'+
                             '<div>'+
                               '<input type="text" name="league_img_credits2" id="league_img_credits2" class="validate[required]"/>'+
                             '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="grid-5">'+
                            '<div class="field-group"  id="fileupload2">'+
                              '<label for="required">Meme Image:</label>'+
                                '<div>'+
                                  //'<input type="file" name="league_img2" id="league_img2" class="validate[required]"/>'+
                                  '<span id="img2"></span>	'+
                                 '</div>'+
                            '</div>'+
                            '<div class="field-group" id="videoupload2" style="display:none">'+
                              '<label for="required">Video Link:</label>'+
                                '<div class="field">'+
                                  '<textarea name="videolink2" class="validate[required]"></textarea>'+
                                 '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="grid-4">'+
                          '<div class="field-group">'+
                           '<label for="required">Tags : </label>'+
                            '<div class="field">'+
                                '<input type="text"  name="league_tags2" id="league_tags2" value="" class="validate[required]">'+
                                '<div id="league_tags1" style="display:none;color: #F00; font-size: 13px;" class="alert_style">Please Enter valid tag.(Remove white spaces) .</div>'+
                            '</div>'+ 
                          '</div>'+
                        '</div>'+                         
                        '<div class="grid-5">'+
                         '<div class="field-group">'+
                           '<label for="required">Content is not safe for work: </label>'+
                            '<div class="field">'+
                              '<input type="checkbox" name="league_access2" id="league_access2" value="1" >'+
                            '</div>'+
                         '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+                    
                    '<div>'+
                       '<button class="btn btn-success btn-circle" type="button" name="plus_'+upData.num+'" id="legPlus_'+upData.num+'"><i class="fa fa-plus"></i>plus</button>'+
                       '<button class="btn btn-danger btn-circle" type="button" name="minus_'+upData.num+'" id="legMinus_'+upData.num+'"><i class="fa fa-minus fa-4 "></i>Minus</button>'+
                    '</div>';
          $(upData.dataDiv).append(html);  
          $(upData.plus+upData.num).show();
          $(upData.minus+upData.num).show();
       }
       $(upData.minus+upData.num).bind('click',function(evt){
          //$("#lgdata_"+upData.num).hide();
          $("#lgdata_2").hide();
          $(upData.plus+upData.num).hide('slow');
          $(upData.minus+upData.num).hide('slow');
          upData.num = upData.num - 1;
          if(upData.num == 1){
              $(upData.plus+upData.num).show();
          }else{
             $(upData.plus+upData.num).show();
             $(upData.minus+upData.num).show();
          } 
       });
    });
    for(i=1;i<=upData.num;i++){ 
        $("#league_img"+i).bind('change',{id:i},function(evt){
            //console.log("evt="+evt.data.id);
          var iVal = evt.data.id;
          var filee = $("#league_img"+iVal).val();
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
});  
     
