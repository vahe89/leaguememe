$("#forget").click(function() {
    $(".signin").hide();
    $("#forgot").show();
});
$('#register').validate({
   rules: { 
        username: { 
            required: true, 
            remote: {
                url: base_url + "public/user/user_checkmodal",
                type: "POST",
                data: {
                    u_name: function () {
                        return $('#usermsg').val();
                    }
                }
            }
        },
        email: { 
            required: true,
            email: true,
            remote: {
                url: base_url + "public/user/email_checkmodal",
                type: "POST",
                data: {
                    email_id: function () {
                        return $('#emailmsg').val();
                    }
                }
            }
        },password: {
            required: true,
            minlength: 6
        }
    },
    messages: {
        username: { 
            required: "Please enter Username", 
            remote: jQuery.validator.format("{0} is already taken.")
        },
        email: { 
              required: "Please enter Username",
            email: "Enter Valid Email",
            remote: jQuery.validator.format("{0} is already taken.")
        }, password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
        }

    }
});
$('#register1').validate({
   rules: { 
        username: { 
            required: true, 
            remote: {
                url: base_url + "public/user/user_checkmodal",
                type: "POST",
                data: {
                    u_name: function () {
                        return $('#usermsg1').val();
                    }
                }
            }
        },
        email: { 
            required: true,
            email: true,
            remote: {
                url: base_url + "public/user/email_checkmodal",
                type: "POST",
                data: {
                    email_id: function () {
                        return $('#emailmsg1').val();
                    }
                }
            }
        },password: {
            required: true,
            minlength: 6
        }
    },
    messages: {
        username: { 
            required: "Please enter Username", 
            remote: jQuery.validator.format("{0} is already taken.")
        },
        email: { 
              required: "Please enter Username",
            email: "Enter Valid Email",
            remote: jQuery.validator.format("{0} is already taken.")
        }, password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
        }

    }
}) 
$("#passconf").change(function() {
    var cpswd = $(this).val();
    var pswd = $("#password").val();
    if (pswd != cpswd) {
        $('#passconf1').html("Please enter the same password as above");
    } else {
        $("#passconf1").html("");
    }
});
$("#exampleInputPassword2").change(function() {
    var cpswd = $(this).val();
    var pswd = $("#exampleInputPassword").val();
    if (pswd != cpswd) {
        $('#passconf11').html("Please enter the same password as above");
    } else {
        $("#passconf11").html("");
    }
});

//$("#repeatemail").change(function () {
//    var remail = $(this).val();
//    var email = $("#email").val();
//    if (email != remail) {
//        $('#remail').html("Please enter the same email as above");
//    } else {
//        $("#remail").hide();
//    }
//});


$("#user_llogin").validate({
    rules: {
        username: {
            required: true
        },
        password: {
            required: true
        }
    },
    messages: {
        username: {
            required: "Please enter Username"
        },
        password: {
            required: "Please enter Password"
        }
    }
});

$("#forgot_password").validate({
    rules: {
        email: {
            required: true,
        }
    },
    messages: {
        email: {
            required: "Please enter your Email Address"
        }
    },
    submitHandler: function(form) {
        $('#for_error22').hide();
        $('#change_pass').hide();
        var email = $('#forgot_email').val();
        $.ajax({
            type: "POST",
            url: base_url + "user/forgot_password",
            data: "email=" + email,
            success: function(msg) {
                if (msg == 'false') {
                    $('#for_error22').show();
                } else if (msg == "error") {
                    $('#email_error').show();
                } else {
                    $('#change_pass').show();
                }
            }
        });
    }
});

$("#fb_login_form").validate({
    rules: {
        username: {
            required: true,
            minlength: 4
        }
    },
    messages: {
        username: {
            required: "Please enter new username",
            minlength: 'The Username field must be at least 4 characters in length'
        }
    },
    submitHandler: function(form) {
        var uname = $('#username_login_fb').val();
        $.ajax({
            type: "POST",
            url: base_url + "public/user/user_checkk",
            data: {u_name: uname},
            cache: false,
            dataType: 'html',
            success: function(data) {
                if (!$.trim(data)) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "public/loginfacebook/save_session_username",
                        data: {u_name: uname},
                        cache: false,
                        success: function(data) {
//                            window.location.href = base_url + "public/loginfacebook";
                            window.location.href = base_url;
                        }
                    });

                } else {
                    $('#username_login_fb_error').html(data);
                }
            }
        });
    }
});
//function googleData(email){
//    alert("email id="+email);
////        $.ajax({
////            url: base_url + "user/googleLogin",  
////            type:'POST',
////            data: {emailId: email},
////            success:function(data){
////                console.log(data);
////                $("#googleData").html(data);
////            },
////            error:function(){
////               //error msg
////            },
////            complete: function(xhr, textStatus) {
////                //$("").removeAttr('disabled');
////            }
////        });    
//}
