$("#forget").click(function () {
    $(".signin").hide();
    $("#forgot").show();
});

$("#register").validate({
    rules: {
        emailaddress: {
            required: true,
            email: true
        },
        captcha: {
            required: true
        },
        uname: {
            char: true,
            required: true,
            minlength: 4
        },
        pswd: {
            required: true,
            minlength: 5
        }
    },
    messages: {
        emailaddress: {
            required: "Please enter Email Address",
            email: "Please enter a valid email address"
        },
        uname: {
            required: "Please enter Username",
            char: "Please enter characters only"
        },
        captcha: {
            required: "The Security code field is required"
        },
        pswd: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
        },
    }
});

$("#emailaddress").change(function () {
    var email = $("#emailaddress").val();
    $.ajax({
        type: "POST",
        url: base_url + "user/email_check",
        data: {email_id: email},
        cache: false,
        dataType: 'html',
        success: function (data) {
            $('#emailmsg').html(data);
        }
    });
});

$("#uname").change(function () {
    var uname = $("#uname").val();
    $.ajax({
        type: "POST",
        url: base_url + "user/user_check",
        data: {u_name: uname},
        cache: false,
        dataType: 'html',
        success: function (data) {
            $('#usermsg').html(data);
        }
    });
});

$("#cpswd").change(function () {
    var cpswd = $(this).val();
    var pswd = $("#pswd").val();
    if (pswd != cpswd) {
        $('#cpaswd').html("Please enter the same password as above");
    } else {
        $("#cpaswd").hide();
    }
});

$("#repeatemail").change(function () {
    var remail = $(this).val();
    var email = $("#emailaddress").val();
    if (email != remail) {
        $('#remail').html("Please enter the same email as above");
    } else {
        $("#remail").hide();
    }
});

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
    submitHandler: function (form) {
        $('#for_error22').hide();
        $('#change_pass').hide();
        var email = $('#email').val();
        $.ajax({
            type: "POST",
            url: base_url + "user/forgot_password",
            data: "email=" + email,
            success: function (msg) {
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
