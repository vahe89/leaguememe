if($('#back-to-top').length){var scrollTrigger=100,backToTop=function(){var scrollTop=$(window).scrollTop();if(scrollTop>scrollTrigger){$('#back-to-top').addClass('show');}else{$('#back-to-top').removeClass('show');}};backToTop();$(window).on('scroll',function(){backToTop();});$('#back-to-top').on('click',function(e){e.preventDefault();$('html,body').animate({scrollTop:0},700);});}jQuery(function($){$('#target').Jcrop({bgfade:true,aspectRatio:1,bgOpacity:0.5,minSize:50,boxWidth:520,boxHeight:400,setSelect:[100,0,600,600],allowSelect:false,onSelect:storeCoords});});function storeCoords(c){jQuery('#X').val(c.x);jQuery('#Y').val(c.y);jQuery('#W').val(c.w);jQuery('#H').val(c.h);}window.onload=function(){setTimeout(function(){var basepath=$('input[data-baseurl]').attr('data-baseurl');console.log($('input[data-baseurl]').attr('data-baseurl'));$.getScript('https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.4.1/tinymce.min.js',function(){tinymce.init({selector:'#discussion_count_desc',elementpath:false,statusbar:false,plugins:["advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"],toolbar:'bold italic underline forecolor backcolor | link blockquote alignleft aligncenter alignright | formatselect table',menubar:false,paste_data_images:true,content_css:'<?= base_url() ?>assets/public/css/tinymce.css'
['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700','<?= base_url() ?>assets/public/css/tinymce.css'],init_instance_callback:function(editor){editor.on('keyup',function(e){var body=tinyMCE.activeEditor.getBody({format:'raw'}),text=tinymce.trim(body.innerText||body.textContent);var text_length=text.length;text_remaining=250-text_length;if(text_remaining==250){document.getElementById("dis_desc_span").style.color="#727575";document.getElementById('dis_desc_span').innerHTML='250';}else{if(text_remaining>=0){document.getElementById("dis_desc_span").style.color="#727575";document.getElementById('dis_desc_span').innerHTML=text_remaining;}else if(text_remaining<0){document.getElementById("dis_desc_span").style.color="red";document.getElementById('dis_desc_span').innerHTML=text_remaining;}}});}});tinymce.init({selector:'#discussion_count_desc1',elementpath:false,statusbar:false,plugins:["advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"],toolbar:'bold italic underline forecolor backcolor | link blockquote alignleft aligncenter alignright | formatselect table',menubar:false,paste_data_images:true,content_css:'<?= base_url() ?>assets/public/css/tinymce.css'
['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700','<?= base_url() ?>assets/public/css/tinymce.css'],init_instance_callback:function(editor){editor.on('keyup',function(e){var body=tinyMCE.activeEditor.getBody({format:'raw'}),text=tinymce.trim(body.innerText||body.textContent);var text_length=text.length;text_remaining=250-text_length;if(text_remaining==250){document.getElementById("dis_desc_span1").style.color="#727575";document.getElementById('dis_desc_span1').innerHTML='250';}else{if(text_remaining>=0){document.getElementById("dis_desc_span1").style.color="#727575";document.getElementById('dis_desc_span1').innerHTML=text_remaining;}else if(text_remaining<0){document.getElementById("dis_desc_span1").style.color="red";document.getElementById('dis_desc_span1').innerHTML=text_remaining;}}});}});tinymce.init({selector:'#inline_discussion_count_desc',elementpath:false,statusbar:false,plugins:["advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"],toolbar:'bold italic underline forecolor backcolor | link blockquote alignleft aligncenter alignright | formatselect table',menubar:false,paste_data_images:true,content_css:'<?= base_url() ?>assets/public/css/tinymce.css'
['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700','<?= base_url() ?>assets/public/css/tinymce.css'],init_instance_callback:function(editor){editor.on('keyup',function(e){var body=tinyMCE.activeEditor.getBody({format:'raw'}),text=tinymce.trim(body.innerText||body.textContent);var text_length=text.length;text_remaining=250-text_length;if(text_remaining==250){document.getElementById("inline_dis_desc_span").style.color="#727575";document.getElementById('inline_dis_desc_span').innerHTML='250';}else{if(text_remaining>=0){document.getElementById("inline_dis_desc_span").style.color="#727575";document.getElementById('inline_dis_desc_span').innerHTML=text_remaining;}else if(text_remaining<0){document.getElementById("inline_dis_desc_span").style.color="red";document.getElementById('inline_dis_desc_span').innerHTML=text_remaining;}}});}});tinymce.init({selector:'div.tinymce',theme:'inlite',plugins:["image"],selection_toolbar:'bold italic underline forecolor backcolor | quicklink h2 h3 blockquote alignleft aligncenter alignright',inline:true,paste_data_images:true,images_upload_handler:function(blobInfo,success,failure){var xhr,formData;xhr=new XMLHttpRequest();xhr.withCredentials=false;xhr.open('POST','<?= base_url() ?>public/user/uploadBioImg');xhr.onload=function(){var json;if(xhr.status!=200){failure('HTTP Error: '+xhr.status);return;}json=JSON.parse(xhr.responseText);if(!json||typeof json.location!='string'){failure('Invalid JSON: '+xhr.responseText);return;}success(json.location);};formData=new FormData();formData.append('file',blobInfo.blob(),blobInfo.filename());xhr.send(formData);},content_css:'<?= base_url() ?>assets/css/tinymce.css'
['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700','<?= base_url() ?>assets/css/tinymce.css']});},500)})};autosize(document.querySelectorAll('textarea'));$('#myTabs a').click(function(e){e.preventDefault()
$(this).tab('show')})
$('#pop a').click(function(e){e.preventDefault()
$(this).tab('show')})
$(document).ready(function(){$('input[class="only_credit"]').click(function(){var id=$(this).attr("id");if($(this).attr("value")==id){$("."+id).toggle();}else{$(".credit").toggle();}});});function changeText(idElement){if($('#credit'+idElement).text()==='Credit'){$('#credit'+idElement).parent().children().eq(1).removeClass('fb-1');$('#credit'+idElement).parent().children().eq(1).addClass('show-social');var dd=$('#creditt'+idElement).text();$('#credit'+idElement).text(dd);}else{$('#credit'+idElement).parent().children().eq(1).removeClass('show-social');$('#credit'+idElement).parent().children().eq(1).addClass('fb-1');$('#credit'+idElement).text('Credit');}}$.fn.draggable_nav_calc=function(options){return this.each(function(i){var $element=$(this);if($element.is(":visible")){if(options.axis==="x"){var navWidth=1;$element.find("> *").each(function(i){navWidth+=$(this).outerWidth(true);});var parentWidth=$element.parent().width();if(navWidth>parentWidth){$element.css("width",navWidth);}else{$element.css("width",parentWidth);}}else if(options.axis==="y"){var navHeight=1;$element.find("> *").each(function(i){navHeight+=$(this).outerHeight(true);});var parentHeight=$element.parent().width();if(navHeight>parentHeight){$element.css("height",navHeight);}else{$element.css("height",parentHeight);}}}});};$.fn.draggable_nav_check=function(){return this.each(function(i){var $element=$(this);var w=$element.width();var pw=$element.parent().width();var maxPosLeft=0;if(w>pw){maxPosLeft=-(w-pw);}var h=$element.height();var ph=$element.parent().height();var maxPosTop=0;if(h>ph){maxPosTop=h-ph;}var left=parseInt($element[0].style.left);if(left>0){$element.css("left",0);}else if(left<maxPosLeft){$element.css("left",maxPosLeft);}var top=parseInt($element[0].style.top);if(top>0){$element.css("top",0);}else if(top<maxPosTop){$element.css("top",maxPosTop);}});};$.fn.draggable_nav=function(options){return this.each(function(i){var $element=$(this);window.setTimeout(function(e){$element.draggable_nav_calc(options);},100);$element.find('[data-toggle="tab"]').on('shown.bs.tab',function(e){$element.draggable_nav_calc(options);});function draggable_nav_resize_after(){clearTimeout($element.data("draggable_nav_timeout"));var timeout=window.setTimeout(function(e){$element.draggable_nav_calc(options);$element.draggable_nav_check();},0);$element.data("draggable_nav_timeout",timeout);}$(window).on('resize',draggable_nav_resize_after);$(window).on('scroll',draggable_nav_resize_after);if($element.hasClass("draggable-center")){$element.find('li a[data-toggle="tab"]').on("shown.bs.tab",function(e){var $container=$(this).parents(".draggable-container");var $li=$(this).parents("li");if(options.axis==="x"){var left=-$li.position().left+$container.outerWidth()/2-$li.outerWidth()/2;$element.css("left",left);}else if(options.axis==="y"){var top=-$li.position().top+$container.outerWidth()/2-$li.outerWidth()/2;$element.css("top",top);}$element.draggable_nav_check();});}});};$(".draggable").draggable_nav({axis:'x'});$(".draggable").draggable({axis:'x',drag:function(e,ui){var $element=ui.helper;var w=$element.width();var pw=$element.parent().width();var maxPosLeft=0;if(w>pw){maxPosLeft=-(w-pw);}var h=$element.height();var ph=$element.parent().height();var maxPosTop=0;if(h>ph){maxPosTop=h-ph;}if(ui.position.left>0){ui.position.left=0;}else if(ui.position.left<maxPosLeft){ui.position.left=maxPosLeft;}if(ui.position.top>0){ui.position.top=0;}else if(ui.position.top<maxPosTop){ui.position.top=maxPosTop;}}});function touchHandler(e){var touch=e.originalEvent.changedTouches[0];var simulatedEvent=document.createEvent("MouseEvent");simulatedEvent.initMouseEvent({touchstart:"mousedown",touchmove:"mousemove",touchend:"mouseup"}[e.type],true,true,window,1,touch.screenX,touch.screenY,touch.clientX,touch.clientY,false,false,false,false,0,null);touch.target.dispatchEvent(simulatedEvent);}function preventPageScroll(e){e.preventDefault();}function initTouchHandler($element){$element.on("touchstart touchmove touchend touchcancel",touchHandler);$element.on("touchmove",preventPageScroll);}initTouchHandler($(".draggable"));function toggler(divId){$("#"+divId).toggle();}$(function(){$("#sortable").sortable();$("#sortable").disableSelection();});$(function(){$("#sortable-right").sortable();$("#sortable-right").disableSelection();});autosize(document.querySelectorAll('textarea'));$('#reviewTab a').click(function(e){e.preventDefault()
$(this).tab('show')})
$(document).ready(function(){$('input[class="only_credit"]').click(function(){if($(this).attr("value")=="credit"){$(".credit").toggle();}});$('#search').on('keypress',function(event){if(event.which==13){$('#search_form_name').submit();}});$('.select2-container').css("width",'100%');});