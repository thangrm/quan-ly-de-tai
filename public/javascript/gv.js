var listCategory;
var listExample;
var exampleID;
var listThesis;

var listGroup
var nameActiveGroup;
var listAssignment;
var detailAssignmentlID;

$(document).ready(function() {
    setListGroup();
    if ($("#selectListCategory").length > 0) {
        setCategoryThesis();
    }

    if ($("#tbThesisList").length > 0) {
        setListThesis();
    }

    if ($("#tbExampleList").length > 0) {
        setListExampleThesis();
    }
});

function setCategoryThesis() {
    //Lấy thông tin mảng đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("category/list"),
        method: "GET",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                listCategory = response;
                response.forEach(function(element) {
                    let o1 = new Option(element['name'], element['category_id']);
                    $(o1).html(element['name']);
                    let o2 = new Option(element['name'], element['category_id']);
                    $(o2).html(element['name']);
                    let o3 = new Option(element['name'], element['category_id']);
                    $(o3).html(element['name']);
                    $("#selectListCategory").append(o1);
                    $("#selectCategoryFix").append(o2);
                    $("#selectCategoryRegister").append(o3);
                });
            }
        }
    });
}

function setListThesis() {
    let id = user['id'];
    let category = $("#selectListCategory").val();
    if (category == 0) {
        category = -1;
    }
    let title = $("#searchThesis").val();

    //Lấy thông tin đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("thesis/list"),
        method: "GET",
        data: { page: 1, limit: 25, uid: id, cat_id: category, title: title },
        success: function(response) {
            if (typeof response === 'object') {
                response.sort((a, b) => (a.approve < b.approve) ? 1 : -1);
                listThesis = response;
                let html = "";
                let i = 0;
                response.forEach(function(element) {
                    i++;
                    let approve;
                    if (element['approve'] == 0) {
                        approve = '<span class="status waiting">Chờ duyệt</span>';
                    } else if (element['approve'] == 1) {
                        approve = '<span class="status approved">Đã duyệt</span>';
                    }
                    html += '<tr>';
                    html += '<th scope="row">' + i + '</th>';
                    html += '<td>' + element['title'] + '</td>';
                    html += '<td>' + element['cat']['name'] + '</td>';
                    html += '<td>' + element['sv']['name'] + '</td>';
                    html += '<td>';
                    html += approve;
                    html += '</td>';
                    html += '<td class="thesis-action">';
                    html += '<!-- Xem chi tiết đề tài -->';
                    html += '<button type="button" onclick="viewThesis(' + element['thesis_id'] + ');" class="btn btn-secondary thesis-action-btn" data-bs-toggle="modal" data-bs-target="#view-thesis">Xem</button>';
                    html += '<!-- Duyệt đề tài -->';
                    if (element['approve'] == 0) {
                        html += '<button type="button" onclick="approveThesis(' + element['thesis_id'] + ');" class="btn btn-success thesis-action-btn" id="confirm-thesis">Duyệt</button>';
                    }
                    html += '</td>';
                    html += '</tr>';
                });
                $("#tbThesisList").html(html);
            }
        }
    });
}

function viewThesis(id) {
    listThesis.forEach(function(element) {
        if (element['thesis_id'] == id) {
            $("#thesisName").val(element['title']);
            $("#thesisCategory").val(element['cat']['name']);
            $("#thesisStudent").val(element['sv']['name']);
            $("#thesisDes").text(element['des']);
        }
    });
}

function approveThesis(idThesis) {
    //Duyệt đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("thesis/update/" + idThesis),
        method: "POST",
        data: { approve: 1 },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['update'] == true) {
                    alert("Đã duyệt thành công");
                    setListThesis();
                } else {
                    if (response['message'] != "") {
                        alert(response['message']);
                    } else {
                        alert("Vui lòng thử lại sau");
                    }
                }
                return false;
            }
        }
    });
}

/*                   */
/* Example Thesis    */
/*                   */

function setListExampleThesis() {
    let id = user['id'];
    let category = $("#selectListCategory").val();
    if (category == 0) {
        category = -1;
    }
    let title = $("#searchThesis").val();

    //Lấy thông tin đề tài mẫu
    $.ajax({
        async: false,
        url: getAPIUrl("example/list"),
        method: "GET",
        data: { page: 1, limit: 25, uid: id, cat_id: category, title: title },
        success: function(response) {
            if (typeof response === 'object') {
                listExample = response;
                let i = 0;
                let html = "";
                $("#tbExampleList").html(html);
                response.forEach(function(element) {
                    i++;
                    html += '<tr>'
                    html += '<th scope="row">' + i + '</th>';
                    html += '<td>' + element['title'] + '</td>';
                    html += '<td>' + element['cat']['name'] + '</td>';
                    html += '<td>'
                    html += '<!-- Button trigger modal -->'
                    html += '<button type="button" onclick="viewExampleThesis(' + element['example_id'] + ');" class="btn btn-secondary thesis-action-btn" data-bs-toggle="modal" data-bs-target="#update-thesis">Sửa</button>'

                    html += '<!-- Button trigger modal -->'
                    html += '<button type="button" onclick="markExampleThesis(' + element['example_id'] + ');" class="btn btn-danger thesis-action-btn" data-bs-toggle="modal" data-bs-target="#delete-thesis">Xóa</button>'

                    html += '</td>'
                    html += '</tr>'
                });
                $("#tbExampleList").html(html);
            }
        }
    });
}


function markExampleThesis(id) {
    exampleID = id;
}

function viewExampleThesis(id) {
    markExampleThesis(id);
    listExample.forEach(function(element) {
        if (element['example_id'] == id) {
            $("#thesisName").val(element['title']);
            $("#selectCategoryFix").val(element['cat']['cat_id']);
        }
    });
}

function registerExampleThesis() {
    let title = $("#registerTitle").val().trim();
    let category = $("#selectCategoryRegister").val();
    let des = $("#registerDes").val().trim();

    if (title == "") {
        alert("Không được để trống tiêu đề");
        return false;
    }

    if (category == 0) {
        alert("Vui lòng chọn thể loại đề tài");
        return false;
    }

    //Đăng ký đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("example/new"),
        method: "POST",
        data: { cat_id: category, title: title, des: des },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['success'] == true) {
                    alert("Đã tạo đề tài mẫu thành công");
                    setListExampleThesis();
                } else {
                    alert("Vui lòng thử lại");
                }
                return false;
            }
        }
    });
}

function updateExampleThesis() {
    let id = exampleID;
    let title = $("#thesisName").val().trim();
    let category = $("#selectCategoryFix").val();

    if (title == "") {
        alert("Không được để trống tiêu đề");
        return false;
    }

    if (category == 0) {
        alert("Vui lòng chọn thể loại đề tài");
        return false;
    }

    //Cập nhật thông tin đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("example/update/" + id),
        method: "POST",
        data: { cat_id: category, title: title },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['update'] == true) {
                    alert("Đã cập nhật thông tin đề tài mẫu thành công");
                    setListExampleThesis();
                } else {
                    if (response['message'] != "") {
                        alert(response['message']);
                    } else {
                        alert("Vui lòng thử lại sau");
                    }
                }
                return false;
            }
        }
    });
}

function removeExampleThesis() {
    let id = exampleID;

    //Xóa đề tài mẫu
    $.ajax({
        async: false,
        url: getAPIUrl("example/remove/" + id),
        method: "DELETE",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                if (response['delete'] == true) {
                    alert("Đã xóa đề tài mẫu thành công");
                    setListExampleThesis();
                } else {
                    if (response['message'] != "") {
                        alert(response['message']);
                    } else {
                        alert("Vui lòng thử lại sau");
                    }
                }
                return false;
            }
        }
    });
}

/*          */
/* GROUP    */
/*          */
function setListGroup() {
    let id = user['id'];
    let url = new URL(window.location.href);
    var gid = url.searchParams.get("gid");

    //Lấy thông tin nhóm
    $.ajax({
        async: false,
        url: getAPIUrl("group/list"),
        method: "GET",
        data: { uid: id },
        success: function(response) {
            if (typeof response === 'object') {
                listGroup = response;
                let html = "";
                response.forEach(function(element) {
                    let groupUrl = 'gv/group/show?gid=' + element['g_id'];

                    html += '<li class="sidebar-child__item">';
                    html += '<a href="' + getBaseUrl(groupUrl) + '" class="sidebar-child__link ';
                    if (element['g_id'] == gid) {
                        nameActiveGroup = element['name'];
                        html += ' active ';
                    }
                    html += ' ">';
                    html += '<i class="fas fa-chevron-right"></i>';
                    html += element['name'];
                    html += '</a>';
                    html += '</li>'
                });
                $("#listGroup").html(html);
            }
        }
    });
}