<?php 
    $currentPage = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<div class="col-10 content">
    <div class="content-wrapper">
        <div class="group-heading">
            <div class="group-banner">
                <img src="<?php echo getPathImg('banner02.jpg'); ?>" alt="">
            </div>
            <div class="group-name">
                <h4 id="nameGroup"></h4>
                <i class="dropdown-toggle far fa-edit fs-4 text" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu">
                    <li class="dropdown-item" data-bs-toggle="modal" data-bs-target="#update-group-name">Đổi tên nhóm</li>
                    <li class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-group">Xóa nhóm</li>
                </ul>
            </div>
             <!-- Form đổi tên nhóm -->
            <div class="modal fade" id="update-group-name" tabindex="-1" aria-labelledby="update-group-name-Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Đổi tên nhóm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Tên nhóm</label>
                                <input id="nameGroupFix" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-fix" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" onclick="renameGroup();" class="btn btn-primary btn-warning" data-bs-dismiss="modal">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form xác nhận xóa nhóm -->
            <div class="modal fade" id="delete-group" tabindex="-1" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc chắn muốn xóa hay không?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-fix" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" onclick="deleteGroup();" class="btn btn-primary btn-warning" data-bs-dismiss="modal">Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="group-action d-flex justify-content-center">
            <!-- Giao bài tập -->
            <div class="add-assingment">
                <div class="text-center">
                    <button type="button" class="btn btn-primary btn-warning mg-20" data-bs-toggle="modal" data-bs-target="#add-assignment"><i class="fas fa-tasks pd-4"></i>Giao bài tập</button>
                </div>
                <div class="modal fade" id="add-assignment" tabindex="-1" aria-labelledby="add-assignment-Label" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Giao bài tập</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <fieldset >
                                        <div class="mb-3">
                                            <label for="assignmentTitleAdd" class="form-label">Tiêu đề</label>
                                            <input type="text" id="assignmentTitleAdd" class="form-control" placeholder="Tiêu đề...">
                                        </div>
                                        <div class="mb-3">
                                            <label for="assignmentDesAdd" class="form-label">Hướng dẫn</label>
                                            <textarea id="assignmentDesAdd" class="form-control" id="" rows="5" placeholder=""></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="assignmentDeadlineAdd" class="form-label">Hạn nộp</label>
                                            <input type="date" id="assignmentDeadlineAdd" name="trip-start" value="" min="2020-01-01" max="2022-12-31">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                <button type="button" onclick="addAssignment();" data-bs-dismiss="modal" class="btn btn-primary btn-warning">Giao bài</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Danh sách thành viên -->
            <div class="group-member-list">
                <div class="text-center">
                    <button type="button" class="btn btn-primary btn-warning mg-20" data-bs-toggle="modal" data-bs-target="#group-member-list"><i class="fas fa-th-list pd-4"></i>Danh sách thành viên</button>
                </div>
                <div class="modal fade" id="group-member-list" tabindex="-1" aria-labelledby="group-member-list-Label" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Danh sách thành viên</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã sinh viên</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Lớp</th>
                                        <th scope="col">Tên đề tài</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="listMember">

                                </tbody>
                            </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form xác nhận xóa thành viên khỏi nhóm -->
                <div class="modal fade" id="delete-group-member" tabindex="-1" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Bạn có chắc chắn muốn xóa hay không?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-fix" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" onclick="deleteMember();" class="btn btn-primary btn-warning" data-bs-dismiss="modal">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Thêm sinh viên -->
            <div class="add-students">
                <div class="text-center">
                    <button type="button" class="btn btn-primary btn-warning mg-20" data-bs-toggle="modal" data-bs-target="#add-students" data-bs-dismiss="modal">
                        <i class="fas fa-user-plus pd-4"></i>Thêm thành viên
                    </button>
                </div>
                <div class="modal fade" id="add-students" tabindex="-1" aria-labelledby="add-students-Label" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Thêm thành viên</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã SV</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Lớp</th>
                                        <th scope="col">Tên đề tài</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="listAddMember">

                                </tbody>
                            </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="groupContent" class="group-content">
        </div>

        <!-- Form cập nhật assignment -->
        <div class="modal fade" id="update-assignment" tabindex="-1" aria-labelledby="update-assignment-Label" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Sửa bài tập</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="assignmentTitle" class="form-label">Tiêu đề</label>
                                <input id="assignmentTitleFix" type="text" class="form-control" value="Nộp báo cáo tiến độ tuần 1">
                            </div>
                            <div class="mb-3">
                                <label for="assignmentDesFix" class="form-label">Hướng dẫn</label>
                                <textarea id="assignmentDesFix" class="form-control" rows="5">Lorem lipsum</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="assignmentDeadlineFix" class="form-label">Hạn nộp</label>
                                <input type="date" id="assignmentDeadlineFix" name="trip-start" value="" min="2020-01-01" max="2022-12-31">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                        <button type="button" onclick="updateAssignment();" data-bs-dismiss="modal" class="btn btn-primary btn-warning">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form xác nhận xóa -->
        <div class="modal fade" id="delete-assignment" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn xóa hay không?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-fix" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" onclick="removeAssignment();" data-bs-dismiss="modal" class="btn btn-primary btn-warning">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
