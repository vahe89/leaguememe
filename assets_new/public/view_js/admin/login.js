$('#button_click').click(function (e) {
    e.preventDefault();
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if ((username != "") && (password != "")) {
        $.post("admin/check_login", $.param({'username': username, 'password': password}), function (responce) {
            if (responce == 0) {
                document.getElementById('error_list').style.display = 'block';
                document.getElementById('error_list1').style.display = 'none';
                document.getElementById('error_list2').style.display = 'none';
                return false;
            } else if (responce == 2) {
                document.getElementById('error_list2').style.display = 'block';
            } else {
                window.location.href = "dashboard";
            }
        });
    } else {
        document.getElementById('error_list1').style.display = 'block';
    }
});