$('#my-form button').click(function (e) {
    e.preventDefault();

    var old = document.getElementById("old").value;
    if (old != "") {
        $.post("admin/check_oldpassword", $.param({'password': old}), function (responce) {

            if (responce == "0") {
                document.getElementById('old_pass').style.display = 'block';
                return false;
            } else {
                var password = document.getElementById("password").value;
                var confPass = document.getElementById("con_pass").value;
                if (password != confPass) {
                    document.getElementById('old_pass').style.display = 'none';
                    document.getElementById('error_list').style.display = 'block';
                    return false;
                } else
                    $('form#my-form').submit();
            }
        });
    } else {
        $('form#my-form').submit();
        return true;
    }
});