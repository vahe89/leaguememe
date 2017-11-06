$(document).ready(function() {
    CKEDITOR.replace('rules_editor');
    $('#add_rules_template').validate({
        rules: {
            page_name: {
                required: true,
            },
            rules_editor: {
                required: true,
            }
        },
        messages: {
            page_name: {
                required: "Page Name field is reqiured.",
            },
            rules_editor: {
                required: "Rules Template field is reqiured.",
            }
        }
    });
});

$(document).on('click', '#add_rules_btn', function() {
    var p_name = $('#page_name').val();
    if (p_name != '') {
        $.ajax({
            type: "POST",
            url: base_url + "admin/rules_template/check_page_name",
            data: {
                'pg_name': p_name
            },
            success: function(msg) {
                if (msg != "false"){
                    $('#add_rules_template').submit();
                }   
            }
        });
    }
});
$(document).on('blur', '#page_name', function() {
    var p_name = $(this).val();
    if (p_name != '') {
        $.ajax({
            type: "POST",
            url: base_url + "admin/rules_template/check_page_name",
            data: {
                'pg_name': p_name
            },
            success: function(msg) {
                if (msg == "false"){
                    $('.page_name_error').html('Already available');
                }   
            }
        });
    }
//    
});
