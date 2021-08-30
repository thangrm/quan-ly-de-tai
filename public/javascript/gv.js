var listCategory;
var listExample;
var exampleID;
var listThesis;

var listGroup
var nameActiveGroup;
var assignmentID;

var listAssignment;
var detailAssignmentlID;

var listMember;
var listAddMember;
var idMember;

var listDetailAssignment;
var idDetailAssignment;

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

    if ($("#groupContent").length > 0) {
        setListAssignment();
    }

    if ($("#listMember").length > 0) {
        setListMember();
    }

    if ($("#listAddMember").length > 0) {
        setListAddMember();
    }

    if ($("#detailAssisnment").length > 0) {
        setDetailAssignment();
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
    $("#nameGroupFix").val(nameActiveGroup);
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
    let gid = url.searchParams.get("gid");

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

                html += '<li class="sidebar-child__item">';
                html += '<a href="' + getBaseUrl("gv/group/addgroup") + '" class="sidebar-child__link '
                if ($("#groupNameCreate").length > 0) {
                    html += 'active';
                }
                html += '">';
                html += '<i class="fas fa-chevron-right"></i>';
                html += 'Tạo nhóm';
                html += '</a>';
                html += '</li>'

                response.forEach(function(element) {
                    let groupUrl = 'gv/group/show?gid=' + element['g_id'];

                    html += '<li class="sidebar-child__item">';
                    html += '<a href="' + getBaseUrl(groupUrl) + '" class="sidebar-child__link ';
                    if (element['g_id'] == gid) {
                        nameActiveGroup = element['name'];
                        $("#nameGroupFix").val(nameActiveGroup);
                        $("#nameGroup").text(nameActiveGroup);
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

function createGroup() {
    let name = $("#groupNameCreate").val().trim();

    if (name == "") {
        alert("Không được để trống tên nhóm");
        return false;
    }

    //Cập nhật tên nhóm
    $.ajax({
        async: false,
        url: getAPIUrl("group/new/"),
        method: "POST",
        data: { name: name },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['success'] == true) {
                    alert("Tạo nhóm thành công");
                    setListGroup();
                } else {
                    alert("Vui lòng thử lại");
                }
                return false;
            }
        }
    });
}

function renameGroup() {
    let url = new URL(window.location.href);
    let gid = url.searchParams.get("gid");
    let name = $("#nameGroupFix").val().trim();

    if (name == "") {
        alert("Không được để trống tên nhóm");
        return false;
    }

    //Cập nhật tên nhóm
    $.ajax({
        async: false,
        url: getAPIUrl("group/update/" + gid),
        method: "POST",
        data: { name: name },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['update'] == true) {
                    alert("Đã đổi tên nhóm thành công");
                    setListGroup();
                } else {
                    alert("Vui lòng thử lại");
                }
                return false;
            }
        }
    });
}

function deleteGroup() {
    let url = new URL(window.location.href);
    let gid = url.searchParams.get("gid");

    //Xóa nhóm
    $.ajax({
        async: false,
        url: getAPIUrl("group/remove/" + gid),
        method: "DELETE",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                if (response['delete'] == true) {
                    alert("Xóa nhóm thành công");
                    location.href = getBaseUrl("gv/group/show");
                } else {
                    alert("Vui lòng thử lại");
                }
                return false;
            }
        }
    });
}


/*              */
/* MEMBER       */
/*              */

function setListMember() {
    let url = new URL(window.location.href);
    let gid = url.searchParams.get("gid");
    if (gid == null) {
        return false;
    }

    //Lấy thông tin thành viên nhóm
    $.ajax({
        async: false,
        url: getAPIUrl("group/member/") + gid,
        method: "GET",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                listMember = response;
                let html = "";
                let i = 0;
                response.forEach(function(element) {
                    i++;
                    html += '<tr>';
                    html += '<th scope="row">' + i + '</th>';
                    html += '<td>' + element['id'] + '</td>';
                    html += '<td>' + element['name'] + '</td>';
                    html += '<td>' + element['majors']['majors_name'] + '</td>';
                    html += '<td>' + element['thesis'] + '</td>';
                    html += '<td>'
                    html += '<button type="button" onclick="markMember(\'' + element['id'] + '\');" class="btn btn-danger table-btn" data-bs-toggle="modal" data-bs-target="#delete-group-member">Xóa</button>';
                    html += '</td>';
                    html += '</tr>'

                });
                $("#listMember").html(html);
            }
        }
    });
}

function setListAddMember() {
    let id = user['id'];
    let url = new URL(window.location.href);
    let gid = url.searchParams.get("gid");
    if (gid == null) {
        return false;
    }

    //Lấy thông tin thành viên nhóm
    $.ajax({
        async: false,
        url: getAPIUrl("thesis/list"),
        method: "GET",
        data: { uid: id },
        success: function(response) {
            if (typeof response === 'object') {
                listAddMember = response;
                let html = "";
                let i = 0;
                response.forEach(function(element) {
                    if (element['approve'] === 1) {
                        let check = true;
                        listMember.forEach(function(member) {
                            if (element['sv']['sv_id'] == member['id']) {
                                check = false;
                                return;
                            }
                        });

                        if (check) {
                            i++;
                            html += '<tr>';
                            html += '<th scope="row">' + i + '</th>';
                            html += '<td>' + element['sv']['sv_id'] + '</td>';
                            html += '<td>' + element['sv']['name'] + '</td>';
                            html += '<td>' + element['sv']['majors']['majors_name'] + '</td>';
                            html += '<td>' + element['title'] + '</td>';
                            html += '<td>'
                            html += '<button type="button" onclick="addMember(\'' + element['sv']['sv_id'] + '\');" class="btn btn-warning table-btn">Thêm</button>';
                            html += '</td>';
                            html += '</tr>'
                        }
                    }
                });
                $("#listAddMember").html(html);
            }
        }
    });
}

function markMember(id) {
    idMember = id;
}

function deleteMember() {
    let id_member = idMember;
    let url = new URL(window.location.href);
    let gid = url.searchParams.get("gid");
    if (gid == null) {
        return false;
    }

    //Xóa thành viên
    $.ajax({
        async: false,
        url: getAPIUrl("group/member/" + gid + "?sv_id=" + id_member),
        method: "DELETE",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                if (response['success'] == true) {
                    alert("Đã xóa thành viên thành công");
                    setListMember();
                    setListAddMember();
                } else {
                    alert("Vui lòng thử lại sau");
                }
                return false;
            }
        }
    });
}

function addMember(id_member) {
    let url = new URL(window.location.href);
    let gid = url.searchParams.get("gid");
    if (gid == null) {
        return false;
    }

    //Xóa thành viên
    $.ajax({
        async: false,
        url: getAPIUrl("group/member/" + gid),
        method: "POST",
        data: { sv_id: id_member },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['success'] == true) {
                    alert("Đã thêm thành viên thành công");
                    setListMember();
                    setListAddMember();
                } else {
                    alert("Vui lòng thử lại sau");
                }
                return false;
            }
        }
    });
}

/*              */
/* ASSIGNMENT   */
/*              */

function setListAssignment() {
    let url = new URL(window.location.href);
    let gid = url.searchParams.get("gid");
    if (gid == null) {
        return false;
    }

    //Lấy thông tin bài tập
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/list"),
        method: "GET",
        data: { gid: gid },
        success: function(response) {
            if (typeof response === 'object') {
                response = response.reverse();
                listAssignment = response;
                let html = "";
                response.forEach(function(element) {
                    let assignmentUrl = 'gv/group/viewassignment?aid=' + element['id'];

                    html += '<div class="assingment">';
                    html += '<a href="' + getBaseUrl(assignmentUrl) + '" class="assingment-link flex-grow-1">';
                    html += '<div class="d-flex ">';
                    html += '<div class="assingment-icon">';
                    html += '<i class="fas fa-clipboard-list"></i>';
                    html += '</div>';
                    html += '<div class="assingment-info">';
                    html += '<div class="assingment-detail">';
                    html += '<span class="assingment-detail-heading">' + element['title'] + '</span>';
                    html += '</div>';
                    html += '<div class="assingment-time">';
                    html += '<span>' + dateFormat(element['postDate']) + '</span>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</a>';
                    html += '<div class="dropdown-wrapper">'
                    html += '<div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v fs-4 text"></i></div>';
                    html += '<ul class="dropdown-menu">';
                    html += '<li class="dropdown-item" onclick="viewAssignment(' + element['id'] + ');" data-bs-toggle="modal" data-bs-target="#update-assignment">Sửa</li>';
                    html += '<li class="dropdown-item" onclick="markAssignment(' + element['id'] + ');" data-bs-toggle="modal" data-bs-target="#delete-assignment">Xóa</li>';
                    html += '</ul>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                });
                $("#groupContent").html(html);
            }
        }
    });
}

function markAssignment(id) {
    assignmentID = id;
}

function viewAssignment(id) {
    markAssignment(id);
    listAssignment.forEach(function(element) {
        if (element['id'] == id) {
            $("#assignmentTitleFix").val(element['title']);
            $("#assignmentDesFix").val(element['content']);
            $("#assignmentDeadlineFix").val(dateFormat(element['deadline'], false, 'en'));
        }
    });
}

function addAssignment() {
    let url = new URL(window.location.href);
    let gid = url.searchParams.get("gid");
    if (gid == null) {
        return false;
    }
    let title = $("#assignmentTitleAdd").val().trim();
    let des = $("#assignmentDesAdd").val().trim();
    let deadline = $("#assignmentDeadlineAdd").val();

    if (title == "") {
        alert("Không được để trống tiêu đề");
        return false;
    }

    if (deadline == "") {
        dataForm = { gid: gid, title: title, content: des };
    } else {
        dataForm = { gid: gid, title: title, content: des, deadline: deadline };
    }

    //Giao bài tập
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/new"),
        method: "POST",
        data: dataForm,
        success: function(response) {
            if (typeof response === 'object') {
                if (response['success'] == true) {
                    alert("Đã giao bài tập thành công");
                    setListAssignment();
                } else {
                    alert("Vui lòng thử lại");
                }
                return false;
            }
        }
    });
}

function updateAssignment() {
    let id = assignmentID;
    let title = $("#assignmentTitleFix").val().trim();
    let des = $("#assignmentDesFix").val().trim();
    let deadline = $("#assignmentDeadlineFix").val();

    if (title == "") {
        alert("Không được để trống tiêu đề");
        return false;
    }

    //Cập nhật thông tin bài tập
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/update/" + id),
        method: "POST",
        data: { title: title, content: des, deadline: deadline },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['update'] == true) {
                    alert("Đã cập nhật thông tin bài tập thành công");
                    setListAssignment();
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

function removeAssignment() {
    let id = assignmentID;

    //Xóa bài tập
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/remove/" + id),
        method: "DELETE",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                if (response['delete'] == true) {
                    alert("Đã xóa bài tập thành công");
                    setListAssignment();
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
/* DETAIL ASSIGNMENT */
/*                   */

function setDetailAssignment() {
    let url = new URL(window.location.href);
    var aid = url.searchParams.get("aid");
    if (aid == null) {
        return false;
    }

    //Lấy thông tin chi tiết bài tập
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/infor/" + aid),
        method: "GET",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                listDetailAssignment = response;
                $("#nameAssingment").text(response['title']);
                $("#desAssingment").text(response['content']);
                $("#postDate").text(dateFormat(response['postDate']));
                $("#dateline").text(dateFormat(response['deadline']));
                let html = "";
                let i = 0;
                response['detail'].forEach(function(element) {
                    i++;
                    let file = '<a href=""></a>';
                    let score = '<span class="status waiting">Chưa chấm điểm</span>';

                    if (element['file'] != null) {
                        let gid = response['gid'];
                        let assignmentID = response['id'];
                        let detailID = element['d_id'];
                        let nameFile = element['file'];
                        let urlDownload = 'group/' + gid + '/' + assignmentID + '/' + detailID + '/' + nameFile;
                        file = '<a href="' + getStorageUrl(urlDownload) + '" download="' + nameFile + '">' + nameFile + '</a>';
                    }

                    if (element['score'] != null) {
                        score = '<span class="status approved">Đã chấm điểm</span>';
                    }

                    html += '<tr>';
                    html += '<th scope="row">' + i + '</th>';
                    html += '<td>' + element['name'] + '</td>';
                    html += '<td>';
                    html += file;
                    html += '</td>';
                    html += '<td>';
                    html += score;
                    html += '</td>'
                    html += '<td class="assign-action">'
                    html += '<div class="text-center">'
                    html += '<button type="button" onclick="viewAssess(' + element['d_id'] + ');" class="btn btn-secondary table-btn w-100" data-bs-toggle="modal" data-bs-target="#grade-assign">Đánh giá</button>'
                    html += '</div>'
                    html += '</td>'
                    html += '</tr>'
                });
                $("#detailAssisnment").html(html);
            }
        }
    });
}

function markDetailAssignment(d_id) {
    idDetailAssignment = d_id;
}

function viewAssess(d_id) {
    markDetailAssignment(d_id);
    listDetailAssignment['detail'].forEach(function(element) {
        if (element['d_id'] == d_id) {
            $("#score").val(element['score']);
        }
    });
    setOpinion();
}

function assess() {
    if (idDetailAssignment == null) {
        return false;
    }

    let d_id = idDetailAssignment;
    let score = $("#score").val().trim();
    let re = /^[0-9]*$/;

    if (score == "") {
        alert("Điểm không được bỏ trống");
        return false;
    }

    if (!re.test(score)) {
        alert("Điểm phải là số từ 0 - 100");
        return false;
    }

    score = parseInt(score);
    if (score < 0 || score > 100) {
        alert("Điểm phải là số từ 0 - 100");
        return false;
    }

    //Chấm điểm cho sinh viên
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/assess/" + d_id),
        method: "POST",
        data: { score: score },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['assess'] == true) {
                    alert("Đã chấm điểm thành công");
                    setDetailAssignment();
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

function setOpinion() {
    if (idDetailAssignment == null) {
        return false;
    }

    //Lấy thông tin ý kiến
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/opinion/" + idDetailAssignment),
        method: "GET",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                let html = "";
                html += '<label for=""  class="form-label">'
                html += '<i class="far fa-comment-alt"></i>';
                html += 'Nhận xét';
                html += '</label>';

                response.forEach(function(element) {
                    let urlAvatar;
                    if (element['avatar'] == null) {
                        urlAvatar = getImgUrl('user.png');
                    } else {
                        urlAvatar = getStorageUrl('avatar/' + element['avatar']);
                    }

                    html += '<div class="comment-wrapper"> ';
                    html += '<div class="d-flex align-items-center">'
                    html += '<div class="cmt-avatar">'
                    html += '<img src="' + urlAvatar + '" alt="" class="rounded-circle">';
                    html += '</div>';
                    html += '<h5 class="cmt-user-name mg-0">' + element['name'] + '</h5>';
                    html += '<span class="cmt-time">' + dateFormat(element['time'], true) + '</span>';
                    html += '</div>';
                    html += '<p class="cmt-content mg-0">' + element['content'] + '</p>';
                    html += '</div>';
                });

                html += '<div class="comment-add">';
                html += '<label for="" class="form-label">';
                html += '<i class="fas fa-comment-medical"></i>';
                html += 'Thêm nhận xét';
                html += '</label>';
                html += '<textarea class="form-control" id="formAddOpinion" rows="3"></textarea>';
                html += '<button type="button" onclick="addOpinion();" class="btn btn-secondary mt-3">Gửi</button>';
                html += '</div>'
                $("#opinionContent").html(html);
            }
        }
    });
}

function addOpinion() {
    if (idDetailAssignment == null) {
        return false;
    }
    let content = $("#formAddOpinion").val().trim();
    if (content == "") {
        alert("Nội dung ý kiến không được để trống");
        return false;
    }

    //Lấy thông tin ý kiến
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/opinion/" + idDetailAssignment),
        method: "POST",
        data: { content: content },
        success: function(response) {
            if (response['opinion'] == true) {
                setOpinion();
            } else {
                alert("Vui lòng thử lại sau");
            }
            return false;
        }
    });
}