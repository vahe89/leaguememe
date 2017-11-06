<div class="footer-msg" id="copy_user_msg" style="display: none">
    Copy to clipboards
</div>



<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<!--<script src="<?php echo base_url(); ?>assets/public/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/jquery.validate.min.js"></script>-->


<script src="<?php echo base_url(); ?>assets/public/js/autosize.min.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/jquery.Jcrop.min.js"></script>

<script src="<?php echo base_url(); ?>assets/public/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/registration.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/reset_password.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/dropzone.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/livestamp.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/scrolltofixed-min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/public/js/profile.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/public/js/cropper.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/chosen.jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/ImageSelect.jquery.js"></script>


<script src="<?php echo base_url(); ?>assets/public/js/trigger.js"></script>

<script src="<?php echo base_url(); ?>assets/public/js/jquery.leanModal.min.js"></script>
<script src="<?php echo base_url(); ?>assets/public/js/pop-up.js"></script>

<script type="text/javascript">
    
    jQuery(function($) {
        $('#target').Jcrop({
            bgfade: true,
            aspectRatio: 1,
            bgOpacity: 0.5,
            minSize: 50,
            boxWidth: 520,
            boxHeight: 400,
//          onSelect: applyCoords,
//          onChange: applyCoords,
            setSelect: [100, 0, 600, 600],
            allowSelect: false,
            onSelect: storeCoords
        });
    });
//    function applyCoords(c){
//      $("#coords").val("X : " + c.x + ", Y : " + c.y + ", X2 : " + c.x2+ ", Y2 : " + c.y2+ ", W : " + c.w+ ", H : " + c.h)
//    }
    function storeCoords(c) {
        jQuery('#X').val(c.x);
        jQuery('#Y').val(c.y);
        jQuery('#W').val(c.w);
        jQuery('#H').val(c.h);
    }



</script>
<script>
    tinymce.init({
        selector: '#discussion_count_desc',
        elementpath: false,
        statusbar: false,
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],
        toolbar: 'bold italic underline forecolor backcolor | link blockquote alignleft aligncenter alignright | formatselect table',
        menubar: false,
        paste_data_images: true,
        content_css: '<?= base_url()?>assets/public/css/tinymce.css'
                [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700',
                        '<?= base_url()?>assets/public/css/tinymce.css'
                ],
        init_instance_callback: function(editor) {
            editor.on('keyup', function(e) {
                var body = tinyMCE.activeEditor.getBody({format: 'raw'}), text = tinymce.trim(body.innerText || body.textContent);
                var text_length = text.length;
                text_remaining = 250 - text_length;
                if (text_remaining == 250) { 
                    document.getElementById("dis_desc_span").style.color = "#727575";
                    document.getElementById('dis_desc_span').innerHTML = '250';
                } else {
                    if (text_remaining >= 0) { 
                        document.getElementById("dis_desc_span").style.color = "#727575";
                        document.getElementById('dis_desc_span').innerHTML = text_remaining;
                    } else if (text_remaining < 0) { 
                        document.getElementById("dis_desc_span").style.color = "red";
                        document.getElementById('dis_desc_span').innerHTML = text_remaining;
                    }
                }
            });
        }
    });
     tinymce.init({
        selector: '#discussion_count_desc1',
        elementpath: false,
        statusbar: false,
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],
        toolbar: 'bold italic underline forecolor backcolor | link blockquote alignleft aligncenter alignright | formatselect table',
        menubar: false,
        paste_data_images: true,
        content_css: '<?= base_url()?>assets/public/css/tinymce.css'
                [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700',
                        '<?= base_url()?>assets/public/css/tinymce.css'
                ],
        init_instance_callback: function(editor) {
            editor.on('keyup', function(e) {
                var body = tinyMCE.activeEditor.getBody({format: 'raw'}), text = tinymce.trim(body.innerText || body.textContent);
                var text_length = text.length;
                text_remaining = 250 - text_length;
                if (text_remaining == 250) { 
                    document.getElementById("dis_desc_span1").style.color = "#727575";
                    document.getElementById('dis_desc_span1').innerHTML = '250';
                } else {
                    if (text_remaining >= 0) { 
                        document.getElementById("dis_desc_span1").style.color = "#727575";
                        document.getElementById('dis_desc_span1').innerHTML = text_remaining;
                    } else if (text_remaining < 0) { 
                        document.getElementById("dis_desc_span1").style.color = "red";
                        document.getElementById('dis_desc_span1').innerHTML = text_remaining;
                    }
                }
            });
        }
    });
    
    tinymce.init({
        selector: '#inline_discussion_count_desc',
        elementpath: false,
        statusbar: false,
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],
        toolbar: 'bold italic underline forecolor backcolor | link blockquote alignleft aligncenter alignright | formatselect table',
        menubar: false,
        paste_data_images: true,
        content_css: '<?= base_url()?>assets/public/css/tinymce.css'
                [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700',
                        '<?= base_url()?>assets/public/css/tinymce.css'
                ],
        init_instance_callback: function(editor) {
            editor.on('keyup', function(e) {
                var body = tinyMCE.activeEditor.getBody({format: 'raw'}), text = tinymce.trim(body.innerText || body.textContent);
                var text_length = text.length;
                text_remaining = 250 - text_length;
                if (text_remaining == 250) { 
                    document.getElementById("inline_dis_desc_span").style.color = "#727575";
                    document.getElementById('inline_dis_desc_span').innerHTML = '250';
                } else {
                    if (text_remaining >= 0) { 
                        document.getElementById("inline_dis_desc_span").style.color = "#727575";
                        document.getElementById('inline_dis_desc_span').innerHTML = text_remaining;
                    } else if (text_remaining < 0) { 
                        document.getElementById("inline_dis_desc_span").style.color = "red";
                        document.getElementById('inline_dis_desc_span').innerHTML = text_remaining;
                    }
                }
            });
        }
    });
</script>
<script>
    tinymce.init({
        selector: 'div.tinymce',
        theme: 'inlite',
        plugins: ["image"], //,'image table link paste contextmenu textpattern autolink textcolor',
        //insert_toolbar: 'image',
        selection_toolbar: 'bold italic underline forecolor backcolor | quicklink h2 h3 blockquote alignleft aligncenter alignright',
        inline: true,
        paste_data_images: true,
        content_css: '<?= base_url()?>assets/css/tinymce.css'
                [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700',
                        '<?= base_url()?>assets/css/tinymce.css'
                ]
    });
</script>

<script>
    autosize(document.querySelectorAll('textarea'));
    $('#myTabs a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $('#pop a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            if ($(this).attr("value") == "credit") {
                $(".credit").toggle();
            }
        });
    });
    function changeText(idElement) {
        if ($('#credit' + idElement).text() === 'Credit') {
            $('#credit' + idElement).parent().children().eq(1).removeClass('fb-1');
            $('#credit' + idElement).parent().children().eq(1).addClass('show-social');
            var dd = $('#creditt' + idElement).text();
            $('#credit' + idElement).text(dd);
        } else {
            $('#credit' + idElement).parent().children().eq(1).removeClass('show-social');
            $('#credit' + idElement).parent().children().eq(1).addClass('fb-1');
            $('#credit' + idElement).text('Credit');
        }
    }

</script>

<script>
    // calculate and set .draggable width

    $.fn.draggable_nav_calc = function(options) {
        return this.each(function(i) {
            var $element = $(this);
            if ($element.is(":visible")) {
                // x or y
                if (options.axis === "x") {
                    // calculate
                    var navWidth = 1;
                    $element.find("> *").each(function(i) {
                        navWidth += $(this).outerWidth(true);
                    });
                    // set width
                    var parentWidth = $element.parent().width();
                    if (navWidth > parentWidth) {
                        $element.css("width", navWidth);
                    } else {
                        $element.css("width", parentWidth);
                    }
                } else if (options.axis === "y") {
                    // calculate
                    var navHeight = 1;
                    $element.find("> *").each(function(i) {
                        navHeight += $(this).outerHeight(true);
                    });
                    // set height
                    var parentHeight = $element.parent().width();
                    if (navHeight > parentHeight) {
                        $element.css("height", navHeight);
                    } else {
                        $element.css("height", parentHeight);
                    }
                }
            }
        }
        );
    };
    // check inside bounds

    $.fn.draggable_nav_check = function() {
        return this.each(function(i) {
            var $element = $(this);
            // calculate
            var w = $element.width();
            var pw = $element.parent().width();
            var maxPosLeft = 0;
            if (w > pw) {
                maxPosLeft = -(w - pw);
            }
            var h = $element.height();
            var ph = $element.parent().height();
            var maxPosTop = 0;
            if (h > ph) {
                maxPosTop = h - ph;
            }
            // horizontal
            var left = parseInt($element[0].style.left);
            if (left > 0) {
                $element.css("left", 0);
            } else if (left < maxPosLeft) {
                $element.css("left", maxPosLeft);
            }
            // vertical
            var top = parseInt($element[0].style.top);
            if (top > 0) {
                $element.css("top", 0);
            } else if (top < maxPosTop) {
                $element.css("top", maxPosTop);
            }
        });
    };
    // init draggable nav

    $.fn.draggable_nav = function(options) {
        return this.each(function(i) {
            var $element = $(this);
            // calculate first time, after delay to fix resize bugs
            window.setTimeout(function(e) {
                $element.draggable_nav_calc(options);
            }, 100);
            // on shown tabs recalculate
            $element.find('[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $element.draggable_nav_calc(options);
            });
            // on resize recalculate
            function draggable_nav_resize_after() {
                clearTimeout($element.data("draggable_nav_timeout"));
                var timeout = window.setTimeout(function(e) {
                    $element.draggable_nav_calc(options);
                    $element.draggable_nav_check();
                }, 0);
                $element.data("draggable_nav_timeout", timeout);
            }
            $(window).on('resize', draggable_nav_resize_after);
            $(window).on('scroll', draggable_nav_resize_after);
            // center clicked element
            if ($element.hasClass("draggable-center")) {
                $element.find('li a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
                    var $container = $(this).parents(".draggable-container");
                    var $li = $(this).parents("li");
                    if (options.axis === "x") {
                        var left = -$li.position().left + $container.outerWidth() / 2 - $li.outerWidth() / 2;
                        $element.css("left", left);
                    } else if (options.axis === "y") {
                        var top = -$li.position().top + $container.outerWidth() / 2 - $li.outerWidth() / 2;
                        $element.css("top", top);
                    }
                    // put inside bounds
                    $element.draggable_nav_check();
                });
            }
        });
    };
    $(".draggable").draggable_nav({
        axis: 'x' // only horizontally
    });
    // jquery ui draggable

    $(".draggable").draggable({
        axis: 'x', // only horizontally
        drag: function(e, ui) {
            var $element = ui.helper;
            // calculate
            var w = $element.width();
            var pw = $element.parent().width();
            var maxPosLeft = 0;
            if (w > pw) {
                maxPosLeft = -(w - pw);
            }
            var h = $element.height();
            var ph = $element.parent().height();
            var maxPosTop = 0;
            if (h > ph) {
                maxPosTop = h - ph;
            }
            // horizontal
            if (ui.position.left > 0) {
                ui.position.left = 0;
            } else if (ui.position.left < maxPosLeft) {
                ui.position.left = maxPosLeft;
            }
            // vertical
            if (ui.position.top > 0) {
                ui.position.top = 0;
            } else if (ui.position.top < maxPosTop) {
                ui.position.top = maxPosTop;
            }
        }
    });
    // jquey draggable also on touch devices
    // http://stackoverflow.com/questions/5186441/javascript-drag-and-drop-for-touch-devices

    function touchHandler(e) {
        var touch = e.originalEvent.changedTouches[0];
        var simulatedEvent = document.createEvent("MouseEvent");
        simulatedEvent.initMouseEvent({
            touchstart: "mousedown",
            touchmove: "mousemove",
            touchend: "mouseup"
        }[e.type], true, true, window, 1,
                touch.screenX, touch.screenY,
                touch.clientX, touch.clientY, false,
                false, false, false, 0, null);
        touch.target.dispatchEvent(simulatedEvent);
    }

    function preventPageScroll(e) {
        e.preventDefault();
    }

    function initTouchHandler($element) {
        $element.on("touchstart touchmove touchend touchcancel", touchHandler);
        $element.on("touchmove", preventPageScroll);
    }
    initTouchHandler($(".draggable"));</script>

<script>
    function toggler(divId) {
        $("#" + divId).toggle();
    }
</script>
<script>
    $(function() {
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });
</script>
<script>
    $(function() {
        $("#sortable-right").sortable();
        $("#sortable-right").disableSelection();
    });
</script>
<script>
    autosize(document.querySelectorAll('textarea'));
    $('#reviewTab a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            if ($(this).attr("value") == "credit") {
                $(".credit").toggle();
            }
        });
        $('#search').on('keypress', function(event) {
            if (event.which == 13) {
                $('#search_form_name').submit();
            }
        });
    });

</script>


</body>

</html>