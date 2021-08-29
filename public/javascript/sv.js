var listCategory;
var listLecturer;
var listExample;
var listThesis;
var trackingThesis;

var listGroup
var nameActiveGroup;
var listAssignment;
var detailAssignmentlID;

$(document).ready(function() {
    setListGroup();
    if ($("#selectListCategory").length > 0) {
        setCategoryThesis();
    }

    if ($("#selectListLecturer").length > 0) {
        setListLecturer();
    }

    if ($("#tbExampleList").length > 0) {
        setListExampleThesis();
    }

    if ($("#tbThesisList").length > 0) {
        setListThesis();
    }

    if ($("#tbThesisTracking").length > 0) {
        setTrackingThesis();
    }

    if ($("#groupContent").length > 0) {
        setListAssignment();
    }

    if ($("#nameAssingment").length > 0) {
        setDetailAssignment();
        setOpinion();
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
                    let o = new Option(element['name'], element['category_id']);
                    $(o).html(element['name']);
                    $("#selectListCategory").append(o);
                });
            }
        }
    });
}

function setListLecturer() {
    //Lấy thông tin mảng đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("users/list"),
        method: "GET",
        data: { role: 'gv' },
        success: function(response) {
            listLecturer = response;
            if (typeof response === 'object') {
                response.forEach(function(element) {
                    let name = element['name'] + ' - ' + element['id'];
                    let o = new Option(name, element['id']);
                    $(o).html(name);
                    $("#selectListLecturer").append(o);
                });
            }
        }
    });
}

function setListExampleThesis() {
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
        data: { page: 1, limit: 25, cat_id: category, title: title },
        success: function(response) {
            if (typeof response === 'object') {
                listExample = response;
                let i = 0;
                let html = "";
                $("#tbExampleList").html(html);
                response.forEach(function(element) {
                    i++;
                    html += '<tr>';
                    html += '<th scope="row">' + i + '</th>';
                    html += '<td>' + element['title'] + '</td>';
                    html += '<td>' + element['cat']['name'] + '</td>';
                    html += '</tr>';
                });
                $("#tbExampleList").html(html);
            }
        }
    });
}

function setListThesis() {
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
        data: { page: 1, limit: 25, cat_id: category, title: title },
        success: function(response) {
            if (typeof response === 'object') {
                listThesis = response;
                let i = 0;
                let html = "";
                $("#tbThesisList").html(html);
                response.forEach(function(element) {
                    i++;
                    if (element['approve'] == 1) {
                        approve = '<span class="status waiting">Chờ duyệt</span>';
                    } else if (element['approve'] == 0) {
                        approve = '<span class="status approved">Đã duyệt</span>';
                    }
                    html += '<tr>';
                    html += '<th scope="row">' + i + '</th>';
                    html += '<td>' + element['title'] + '</td>';
                    html += '<td>' + element['cat']['name'] + '</td>';
                    html += '<td>' + element['sv']['name'] + '</td>';
                    html += '<td>' + element['gv']['name'] + '</td>';
                    html += '<td>';
                    html += approve;
                    html += '</td>';
                    html += '</tr>';
                });
                $("#tbThesisList").html(html);

            }
        }
    });
}

function setTrackingThesis() {
    let id = user['id'];

    //Lấy thông tin đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("thesis/list"),
        method: "GET",
        data: { page: 1, limit: 25, uid: id },
        success: function(response) {
            if (typeof response === 'object') {
                if (response.length < 1) {
                    $("#thBtnThesis").hide();
                    $("#btnThesis").hide();
                    $("#titleThesis").text("");
                    $("#categoryThesis").text("");
                    $("#lecturerThesis").text("");
                    $("#approveThesis").text("");
                    $("#approveThesis").removeClass("waiting");

                    return;
                }

                trackingThesis = response[0];
                $("#titleThesis").text(trackingThesis['title']);
                $("#categoryThesis").text(trackingThesis['cat']['name']);
                $("#lecturerThesis").text(trackingThesis['gv']['name']);
                if (trackingThesis['approve'] == 0) {
                    $("#approveThesis").text("Chờ duyệt");
                    $("#approveThesis").addClass('waiting');

                    $("#fixTitleThesis").val(trackingThesis['title']);
                    $("#fixDesThesis").val(trackingThesis['des']);
                    $("#selectListCategory").val(trackingThesis['cat']['cat_id']);
                    $("#selectListLecturer").val(trackingThesis['gv']['gv_id']);

                    $("#thBtnThesis").show();
                    $("#btnThesis").show();

                } else if (trackingThesis['approve'] == 1) {
                    $("#approveThesis").text("Đã duyệt");
                    $("#approveThesis").addClass('approved');
                    $("#thBtnThesis").hide();
                    $("#btnThesis").hide();
                }
            }
        }
    });
}

function registerThesis() {
    let id = user['id'];
    let title = $("#registerTitle").val().trim();
    let des = $("#registerDes").val().trim();
    let category = $("#selectListCategory").val();
    let lecturer = $("#selectListLecturer").val();

    if (title == "") {
        alert("Không được để trống tiêu đề");
        return false;
    }

    if (lecturer == 0) {
        alert("Vui lòng chọn giáo viên hướng dẫn");
        return false;
    }

    if (category == 0) {
        alert("Vui lòng chọn thể loại đề tài");
        return false;
    }

    //Đăng ký đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("thesis/new"),
        method: "POST",
        data: { cat_id: category, sv_id: id, gv_id: lecturer, title: title, des: des },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['success'] == true) {
                    alert("Đã gửi yêu cầu đăng ký tài thành công");
                } else {
                    alert("Bạn đã đăng ký đề tài rồi");
                }
                return false;
            }
        }
    });
}

function updateTrackingThesis() {
    let idThesis = trackingThesis['thesis_id'];

    let title = $("#fixTitleThesis").val().trim();
    let des = $("#fixDesThesis").val().trim();
    let category = $("#selectListCategory").val();
    let lecturer = $("#selectListLecturer").val();

    if (title == "") {
        alert("Không được để trống tiêu đề");
        return false;
    }

    if (lecturer == 0) {
        alert("Vui lòng chọn giáo viên hướng dẫn");
        return false;
    }

    if (category == 0) {
        alert("Vui lòng chọn thể loại đề tài");
        return false;
    }

    //Cập nhật thông tin đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("thesis/update/" + idThesis),
        method: "POST",
        data: { cat_id: category, gv_id: lecturer, title: title, des: des },
        success: function(response) {
            if (typeof response === 'object') {
                if (response['update'] == true) {
                    alert("Đã cập nhật thông tin đề tài thành công");
                    setTrackingThesis();
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

function removeTrackingThesis() {
    let idThesis = trackingThesis['thesis_id'];

    //Xóa đề tài
    $.ajax({
        async: false,
        url: getAPIUrl("thesis/remove/" + idThesis),
        method: "DELETE",
        data: null,
        success: function(response) {
            if (typeof response === 'object') {
                if (response['delete'] == true) {
                    alert("Đã xóa đề tài thành công");
                    setTrackingThesis();
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
                    let groupUrl = 'sv/group/show?gid=' + element['g_id'];

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

function setListAssignment() {
    let url = new URL(window.location.href);
    var gid = url.searchParams.get("gid");
    if (gid == null) {
        return false;
    }
    $("#groupName").text(nameActiveGroup);

    //Lấy thông tin bài tập
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/list"),
        method: "GET",
        data: { gid: gid },
        success: function(response) {
            if (typeof response === 'object') {
                listGroup = response;
                let html = "";
                response.forEach(function(element) {
                    let assignmentUrl = 'sv/group/viewassignment?aid=' + element['id'];

                    html += '<a href="' + getBaseUrl(assignmentUrl) + '" class="assingment-link">';
                    html += '<div class="assingment">';
                    html += '<div class="assingment-icon">';
                    html += '<i class="fas fa-clipboard-list"></i>';
                    html += '</div>';
                    html += '<div class="assingment-info">';
                    html += '<div class="assingment-detail">';
                    html += '<span class="assingment-detail-heading">' + element['title'] + '</span>';
                    html += '</div> ';
                    html += '<div class="assingment-time">';
                    html += '<span>' + dateFormat(element['postDate']) + '</span>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</a>';
                });
                $("#groupContent").html(html);
            }
        }
    });
}

function setDetailAssignment() {
    let id = user['id'];
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
                $("#nameAssingment").text(response['title']);
                $("#desAssingment").text(response['content']);
                $("#postDate").text(dateFormat(response['postDate']));
                $("#dateline").text(dateFormat(response['deadline']));

                response['detail'].forEach(function(element) {
                    if (element['sv_id'] == id) {
                        $("#scoreAssingment").text(element['score']);
                        detailAssignmentlID = element['d_id'];
                        if (element['file'] != null) {
                            let gid = response['gid'];
                            let assignmentID = response['id'];
                            let detailID = element['d_id'];
                            let nameFile = element['file'];
                            let urlDownload = 'group/' + gid + '/' + assignmentID + '/' + detailID + '/' + nameFile;

                            $("#fileSubmitted").text(nameFile);
                            $("#fileSubmitted").attr("href", getStorageUrl(urlDownload));
                            $("#fileSubmitted").attr("download", nameFile);
                            console.log(element['dateSubmit']);
                            $("#dateSumitted").text("Đã nộp: " + dateFormat(element['dateSubmit'], true));
                        }
                    }

                });
            }
        }
    });
}

function submitAssignment() {
    let url = new URL(window.location.href);
    var aid = url.searchParams.get("aid");
    if (aid == null) {
        return false;
    }

    let file = $("#formFileSubmit").prop('files')[0];
    if (file === undefined) {
        alert("Vui lòng chọn file")
        return false;
    }

    let formData = new FormData();
    formData.append("fileSubmit", file);

    //gọi Ajax
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/submit/" + aid),
        method: "POST",
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        data: formData,
        success: function(response) {
            let rs = JSON.parse(response);
            if (rs['submit'] == true) {
                alert("Đã gửi bài thành công");
                setDetailAssignment();
            } else {
                alert("Vui lòng thử lại sau");
            }
            return false;
        }
    });
    return false;
}

function setOpinion() {
    if (detailAssignmentlID == null) {
        return false;
    }

    //Lấy thông tin ý kiến
    $.ajax({
        async: false,
        url: getAPIUrl("assignment/opinion/" + detailAssignmentlID),
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
    if (detailAssignmentlID == null) {
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
        url: getAPIUrl("assignment/opinion/" + detailAssignmentlID),
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