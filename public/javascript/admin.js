var listStudent;
var idStudent;

var listTeacher;
var idTeacher;

var listCategory;
var idCategory;

$(document).ready(function() {
    if ($("#listStudent").length > 0) {
        setListStudent();
    }

    if ($("#listTeacher").length > 0) {
        setListTeacher();
    }

    if ($("#listCategory").length > 0) {
        setListCategory();
    }

});

/*           */
/*  STUDENT  */
/*           */

function setListStudent() {
    let name = $("#searchStudent").val();

    //Lấy thông tin đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("users/list"),
        method: "GET",
        data: { role: 'sv', limit: 25, name: name },
        success: function(response) {
            if (typeof response === 'object') {
                listStudent = response;
                let i = 0;
                let html = "";
                response.forEach(function(element) {
                    i++;
                    let urlAvatar;
                    if (element['avatar'] == null) {
                        urlAvatar = getImgUrl("user.png");
                    } else {
                        urlAvatar = getStorageUrl('avatar/' + element['avatar']);
                    }
                    html += '<tr>';
                    html += '<th scope="row">' + i + '</th>';
                    html += '<td>' + element['id'] + '</td>';
                    html += '<td>' + element['name'] + '</td>'
                    html += '<td>' + element['majors']['majors_name'] + '</td>';
                    html += '<td>' + element['kh']['kh_name'] + '</td>';
                    html += '<td>' + dateFormat(element['birthday']) + '</td>';
                    html += '<td>' + element['email'] + '</td>';
                    html += '<td>' + element['phone'] + '</td>';
                    html += '<td>' + element['address'] + '</td>';
                    html += '<td class="text-center"><img style="width: 30px;" src="' + urlAvatar + '"></td>';
                    html += '<td>';
                    html += '<button type="button" onclick="viewStudent(\'' + element['id'] + '\');" class="btn btn-secondary thesis-action-btn me-1" data-bs-toggle="modal" data-bs-target="#update-student-info"><i class="far fa-edit pd-4"></i>Sửa</button>';
                    html += '<button type="button" onclick="markStudent(\'' + element['id'] + '\');" class="btn btn-danger table-btn" data-bs-toggle="modal" data-bs-target="#delete-student"><i class="far fa-trash-alt pd-4"></i>Xóa</button>';
                    html += '</td>';
                    html += '</tr>';
                });
                $("#listStudent").html(html);

            }
        }
    });
}

function markStudent(id) {
    idStudent = id;
}

function viewStudent(id) {
    markStudent(id);
    listStudent.forEach(function(element) {
        if (element['id'] == id) {
            $("#nameStudentFix").val(element['name']);
            $("#phoneStudentFix").val(element['phone']);
            $("#emailStudentFix").val(element['email']);
            $("#birthdayStudentFix").val(dateFormat(element['birthday'], false, 'en'));
            $("#addressStudentFix").val(element['address']);
            $("#selectMajorStudentFix").val(element['majors']['majors_id']);
            $("#selectYearStudentFix").val(element['kh']['kh_id']);
            $("#avatarStudentFix").val(null);
        }
    });
}


function createStudent() {
    let name = $("#nameStudentAdd").val().trim();
    let phone = $("#phoneStudentAdd").val().trim();
    let email = $("#emailStudentAdd").val().trim();
    let address = $("#addressStudentAdd").val().trim();
    let birthday = $("#birthdayStudentAdd").val().trim();
    let majors = $("#selectMajorStudentAdd").val();
    let kh = $("#selectYearStudentAdd").val();

    //Kiểm tra thông tin
    if (name == "") {
        alert("Tên không được để trống");
        return false;
    }

    if (birthday == "") {
        alert("Ngày sinh không được để trống");
        return false;
    }

    if (phone != "") {
        let re = /^[0-9]{10,12}$/;
        if (!re.test(phone)) {
            alert("Số điện thoại không hợp lệ");
            return false;
        }
    }


    let formData = new FormData();
    formData.append("role", "sv");
    formData.append("name", name);
    formData.append("birthday", birthday);
    formData.append("email", email);
    formData.append("phone", phone);
    formData.append("address", address);
    formData.append("majors", majors);
    formData.append("kh", kh);

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("users/new/"),
        method: "POST",
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        data: formData,
        success: function(response) {
            let rs = JSON.parse(response);
            if (rs['register'] == true) {
                let mess = "Tạo tài khoản thành công";
                mess += "\nTài khoản: " + rs['id'];
                mess += "\nMật khẩu: " + rs['pass'];
                alert(mess);
                setListStudent();
            } else {
                alert("Vui lòng thử lại sau");
            }
            return false;
        }
    });
    return false;
}

// Cập nhật thông tin sinh viên
function updateStudent() {
    let id = idStudent;
    let name = $("#nameStudentFix").val().trim();
    let phone = $("#phoneStudentFix").val().trim();
    let email = $("#emailStudentFix").val().trim();
    let address = $("#addressStudentFix").val().trim();
    let birthday = $("#birthdayStudentFix").val().trim();
    let file = $("#avatarStudentFix").prop('files')[0];

    let majors = $("#selectMajorStudentFix").val();
    let kh = $("#selectYearStudentFix").val();

    //Kiểm tra thông tin
    if (name == "") {
        alert("Tên không được để trống");
        return false;
    }

    if (phone != "") {
        let re = /^[0-9]{10,12}$/;
        if (!re.test(phone)) {
            alert("Số điện thoại không hợp lệ");
            return false;
        }
    }

    let formData = new FormData();
    if (file !== undefined)
        formData.append("avatar", file);
    formData.append("name", name);
    formData.append("birthday", birthday);
    formData.append("email", email);
    formData.append("phone", phone);
    formData.append("address", address);
    formData.append("majors", majors);
    formData.append("kh", kh);

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
                setListStudent();
            } else {
                if (response['message'] != "") {
                    alert(response['message']);
                } else {
                    alert("Vui lòng thử lại sau");
                }
            }
            return false;
        }
    });
    return false;
}

//Xóa sinh viên
function deleteStudent() {
    let id = idStudent;

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("users/remove/" + id),
        method: "DELETE",
        data: null,
        success: function(response) {
            if (response['delete'] == true) {
                alert("Đã xóa tài khoản sinh viên thành công");
                setListStudent();
            } else {
                if (response['message'] != "") {
                    alert(response['message']);
                } else {
                    alert("Vui lòng thử lại sau");
                }
            }
            return false;
        }
    });
    return false;
}

/*           */
/*  TEACHER  */
/*           */

function setListTeacher() {
    let name = $("#searchTeacher").val();

    //Lấy thông tin đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("users/list"),
        method: "GET",
        data: { role: 'gv', limit: 25, name: name },
        success: function(response) {
            if (typeof response === 'object') {
                listTeacher = response;
                let i = 0;
                let html = "";
                response.forEach(function(element) {
                    i++;
                    let urlAvatar;
                    if (element['avatar'] == null) {
                        urlAvatar = getImgUrl("user.png");
                    } else {
                        urlAvatar = getStorageUrl('avatar/' + element['avatar']);
                    }

                    html += '<tr>';
                    html += '<th scope="row">' + i + '</th>';
                    html += '<td>' + element['id'] + '</td>';
                    html += '<td>' + element['name'] + '</td>'
                    html += '<td>' + element['ns'] + '</td>';
                    html += '<td>' + element['phone'] + '</td>';
                    html += '<td>' + element['email'] + '</td>';
                    html += '<td>' + element['address'] + '</td>';
                    html += '<td class="text-center"><img style="width: 30px;" src="' + urlAvatar + '"></td>';
                    html += '<td>';
                    html += '<button type="button" onclick="viewTeacher(\'' + element['id'] + '\');" class="btn btn-secondary thesis-action-btn me-1" data-bs-toggle="modal" data-bs-target="#update-lecturer-info"><i class="far fa-edit pd-4"></i>Sửa</button>';
                    html += '<button type="button" onclick="markTeacher(\'' + element['id'] + '\');" class="btn btn-danger table-btn" data-bs-toggle="modal" data-bs-target="#delete-student"><i class="far fa-trash-alt pd-4"></i>Xóa</button>';
                    html += '</td>';
                    html += '</tr>';
                });
                $("#listTeacher").html(html);

            }
        }
    });
}

function markTeacher(id) {
    idTeacher = id;
}

function viewTeacher(id) {
    markTeacher(id);
    listTeacher.forEach(function(element) {
        if (element['id'] == id) {
            $("#nameTeacherFix").val(element['name']);
            $("#phoneTeacherFix").val(element['phone']);
            $("#emailTeacherFix").val(element['email']);
            $("#birthdayTeacherFix").val(dateFormat(element['birthday'], false, 'en'));
            $("#addressTeacherFix").val(element['address']);
            $("#nsTeacherFix").val(element['ns']);
            $("#avatarTeacherFix").val(null);
        }
    });
}


function createTeacher() {
    let name = $("#nameTeacherAdd").val().trim();
    let phone = $("#phoneTeacherAdd").val().trim();
    let email = $("#emailTeacherAdd").val().trim();
    let birthday = $("#birthdayTeacherAdd").val().trim();
    let address = $("#addressTeacherAdd").val().trim();
    let ns = $("#nsTeacherAdd").val().trim();

    //Kiểm tra thông tin
    if (name == "") {
        alert("Tên không được để trống");
        return false;
    }

    if (birthday == "") {
        alert("Ngày sinh không được để trống");
        return false;
    }

    if (ns == "") {
        alert("Số lượng sinh viên không được để trống");
        return false;
    } else {
        let re = /^[0-9]*$/;
        if (!re.test(ns)) {
            alert("Số lượng sinh viên phải là một số");
            return false;
        }
    }

    if (phone != "") {
        let re = /^[0-9]{10,12}$/;
        if (!re.test(phone)) {
            alert("Số điện thoại không hợp lệ");
            return false;
        }
    }

    let formData = new FormData();
    formData.append("role", "gv");
    formData.append("name", name);
    formData.append("birthday", birthday);
    formData.append("email", email);
    formData.append("phone", phone);
    formData.append("address", address);
    formData.append("ns", ns);

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("users/new/"),
        method: "POST",
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        data: formData,
        success: function(response) {
            let rs = JSON.parse(response);
            if (rs['register'] == true) {
                let mess = "Tạo tài khoản thành công";
                mess += "\nTài khoản: " + rs['id'];
                mess += "\nMật khẩu: " + rs['pass'];
                alert(mess);
                setListTeacher();
            } else {
                alert("Vui lòng thử lại sau");
            }
            return false;
        }
    });
    return false;
}

// Cập nhật thông tin giáo viên
function updateTeacher() {
    let id = idTeacher;

    let name = $("#nameTeacherFix").val().trim();
    let phone = $("#phoneTeacherFix").val().trim();
    let email = $("#emailTeacherFix").val().trim();
    let birthday = $("#birthdayTeacherFix").val().trim();
    let address = $("#addressTeacherFix").val().trim();
    let ns = $("#nsTeacherFix").val().trim();
    let file = $("#avatarTeacherFix").prop('files')[0];

    //Kiểm tra thông tin
    if (name == "") {
        alert("Tên không được để trống");
        return false;
    }

    if (birthday == "") {
        alert("Ngày sinh không được để trống");
        return false;
    }

    if (ns == "") {
        alert("Số lượng sinh viên không được để trống");
        return false;
    } else {
        let re = /^[0-9]*$/;
        if (!re.test(ns)) {
            alert("Số lượng sinh viên phải là một số");
            return false;
        }
    }

    if (phone != "") {
        let re = /^[0-9]{10,12}$/;
        if (!re.test(phone)) {
            alert("Số điện thoại không hợp lệ");
            return false;
        }
    }

    let formData = new FormData();
    if (file !== undefined)
        formData.append("avatar", file);
    formData.append("name", name);
    formData.append("birthday", birthday);
    formData.append("email", email);
    formData.append("phone", phone);
    formData.append("address", address);
    formData.append("ns", ns);

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
                setListTeacher();
            } else {
                if (response['message'] != "") {
                    alert(response['message']);
                } else {
                    alert("Vui lòng thử lại sau");
                }
            }
            return false;
        }
    });
    return false;
}

//Xóa giáo viên
function deleteTeacher() {
    let id = idTeacher;

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("users/remove/" + id),
        method: "DELETE",
        data: null,
        success: function(response) {
            if (response['delete'] == true) {
                alert("Đã xóa tài khoản sinh viên thành công");
                setListTeacher();
            } else {
                if (response['message'] != "") {
                    alert(response['message']);
                } else {
                    alert("Vui lòng thử lại sau");
                }
            }
            return false;
        }
    });
    return false;
}


/*            */
/*  CATEGORY  */
/*            */

function setListCategory() {
    //Lấy thông tin mảng đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("category/list"),
        method: "GET",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                listCategory = response;
                let html = "";
                let i = 0;
                response.forEach(function(element) {
                    i++;
                    html += '<tr>';
                    html += '<td>' + element['category_id'] + '</td>';
                    html += '<td>' + element['name'] + '</td>'
                    html += '<td>'
                    html += '<button type="button" onclick="viewCategory(\'' + element['category_id'] + '\');" class="btn btn-secondary thesis-action-btn me-1" data-bs-toggle="modal" data-bs-target="#update-thesis-topic"><i class="far fa-edit pd-4"></i>Sửa</button>';
                    html += '<button type="button" onclick="markCategory(\'' + element['category_id'] + '\');" class="btn btn-danger table-btn" data-bs-toggle="modal" data-bs-target="#delete-thesis-topic"><i class="far fa-trash-alt pd-4"></i>Xóa</button>';
                    html += '</td>';
                    html += '</tr>';
                });
                $("#listCategory").html(html);
            }
        }
    });
}

function markCategory(id) {
    idCategory = id;
}

function viewCategory(id) {
    markCategory(id);
    listCategory.forEach(function(element) {
        if (element['category_id'] == id) {
            $("#nameCategoryFix").val(element['name']);
        }
    });
}

function createCategory() {
    let name = $("#nameCategoryAdd").val().trim();
    if (name == '') {
        alert("Không được để trống tên mảng đề tài");
        return false;
    }

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("category/new/"),
        method: "POST",
        data: { name: name },
        success: function(response) {
            if (response['success'] == true) {
                alert("Thêm mảng đề tài thành công");
                setListCategory();
            } else {
                if (response['message'] != "") {
                    alert(response['message']);
                } else {
                    alert("Vui lòng thử lại sau");
                }
            }
            return false;
        }
    });
    return false;
}

function updateCategory() {
    let id = idCategory;
    let name = $("#nameCategoryFix").val().trim();
    if (name == '') {
        alert("Không được để trống tên mảng đề tài");
        return false;
    }

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("category/update/" + id),
        method: "POST",
        data: { name: name },
        success: function(response) {
            if (response['update'] == true) {
                alert("Cập nhập thông tin mảng đề tài thành công");
                setListCategory();
            } else {
                if (response['message'] != "") {
                    alert(response['message']);
                } else {
                    alert("Vui lòng thử lại sau");
                }
            }
            return false;
        }
    });
    return false;
}

function deleteCategory() {
    let id = idCategory;

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("category/remove/" + id),
        method: "DELETE",
        data: null,
        success: function(response) {
            if (response['delete'] == true) {
                alert("Xóa mảng đề tài thành công");
                setListCategory();
            } else {
                if (response['message'] != "") {
                    alert(response['message']);
                } else {
                    alert("Vui lòng thử lại sau");
                }
            }
            return false;
        }
    });
    return false;
}