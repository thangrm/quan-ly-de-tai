$(document).ready(function() {
    //xử lý đăng nhập
    $("#login").submit(function(evt) {
        evt.preventDefault();
        let username = $("#username").val();
        let password = $("#password").val();

        //check xem tài khoản và mật khẩu trống không
        if (username == "") {
            alert("Tên đăng nhập không được để trống");
            return false;
        }
        if (password == "") {
            alert("Mật khẩu không được để trống");
            return false;
        }

        //gọi Ajax
        $.ajax({
            async: false,
            url: getAPIUrl("users/login"),
            method: "POST",
            data: { username: username, password: password },
            success: function(response) {
                if (response['login']) {
                    window.location = getBaseUrl('home');
                } else {
                    alert("Tài khoản mật khẩu không chính xác");
                    return false;
                }
            }
        });
    });
});