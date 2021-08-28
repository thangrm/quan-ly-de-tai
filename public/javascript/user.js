var user = null;
$(document).ready(function() {
    setInforUser();
});

function setInforUser() {
    //Lấy thông tin người dùng
    $.ajax({
        async: false,
        url: getAPIUrl("users/infor"),
        method: "GET",
        data: null,
        success: function(response) {
            user = response;
            if (response.hasOwnProperty('id')) {

                // Hiển thị avatar
                $("#nameUser").text(user['name']);
                if (user["avatar"] != null) {
                    linkAvatar = getStorageUrl("avatar/" + user["avatar"]);
                    linkAvatar = linkAvatar + "?" + new Date().getTime();
                    $("#avatarUser").attr("src", linkAvatar);
                }

                // Hiện thị thông tin người dùng
                $("#infNameUser").val(user['name']);
                $("#infEmailUser").val(user['email']);
                $("#infPhoneUser").val(user['phone']);
                $("#infAddressUser").val(user['address']);
            }
        }
    });
}

// Cập nhật thông tin người dùng
function updateUser() {
    let id = user['id'];
    let email = $("#infEmailUser").val();
    let phone = $("#infPhoneUser").val();
    let file = $("#infAvatarUser").prop('files')[0];
    let address = $("#infAddressUser").val();

    //Kiểm tra thông tin
    if (email == "") {
        alert("Email không được để trống");
        return false;
    }

    if (phone == "") {
        alert("Số điện thoại không được để trống");
        return false;
    }

    if (address == "") {
        alert("Địa chỉ không được để trống");
        return false;
    }

    let formData = new FormData();
    if (file !== undefined)
        formData.append("avatar", file);
    formData.append("email", email);
    formData.append("phone", phone);
    formData.append("address", address);

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("users/update/" + id),
        method: "POST",
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        data: formData,
        success: function(response) {
            let rs = JSON.parse(response);
            if (rs['update'] == true) {
                alert("Cập nhật thông tin người dùng thành công");
                setInforUser();
            } else {
                alert("Vui lòng thử lại sau");
            }
            return false;
        }
    });
    return false;
}

//Đổi mật khẩu người dùng
function changePass() {
    let id = user['id'];
    let oldPass = $("#oldPass").val();
    let newPass = $("#newPass").val();
    let rePass = $("#rePass").val();

    if (newPass != rePass) {
        alert("Nhập lại mật khẩu không khớp. Vui lòng nhập lại")
    }

    //Kiểm tra thông tin
    if (oldPass == "" || newPass == "") {
        alert("Không được để trống thông tin mật khẩu");
        return false;
    }

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("users/pass/" + id),
        method: "POST",
        data: { oldPass: oldPass, newPass: newPass },
        success: function(rs) {
            console.log(rs);
            if (rs['update'] == true) {
                alert("Cập nhật thông tin mật khẩu thành công");
            } else {
                if (rs.hasOwnProperty('message') && rs['message'] != '') {
                    alert(rs['message'])
                } else {
                    alert("Vui lòng thử lại sau");
                }
            }
            return false;
        }
    });
    return false;
}