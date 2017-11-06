    $(document).ready(function(){
        //Скрыть PopUp при загрузке страницы    
        PopUpHide();
    });
    //Функция отображения PopUp
    function PopUpShow(){
        $("#popup1").show();
    }
    //Функция скрытия PopUp
    function PopUpHide(){
        $("#popup1").hide();
 }
   var m=0;
var i=0;
function loginShow(id) {
     $("#"+id).show().delay();
     $("html,body").css("overflow","hidden");
 }
 //Функция скрытия PopUp
 function HidePopup(id) {
     $("#"+id).hide();
     $("html,body").css("overflow","auto");
 }
function FileHover(id){
    $("#"+id).addClass('hoverr');
}
function FileHoverRemove(id){
    $("#"+id).removeClass('hoverr');
}
 function LinkShow() {

     m=m+1;
     if(m==1)
    {
         $("#safe").show().delay();
        
    }
   if(m==2)
    {
         $("#safe").hide().delay();
        m=0;
    }
 }

function TitleBack() {
if(i==0)
    {
   $("#upload-url-popup").show().delay(); 
        
    }
    if(i==1)
        {
          $("#upload-popup").show().delay();  
            i=0;
        }
}
function Titleshow() {
      $("#upload-title-popup").show().delay();
   i=1;
 }
 //Функция скрытия PopUp
