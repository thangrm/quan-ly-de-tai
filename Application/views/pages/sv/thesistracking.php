<div class="col-10 content">
    <div class="content-wrapper">
        <div class="heading">
            <h1 class="display-4">Đề tài của tôi</h1>
        </div>
        <div class="main-content">
            <table id="tbThesisTracking" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên đề tài</th>
                        <th scope="col">Mảng đề tài</th>
                        <th scope="col">GV hướng dẫn</th>
                        <th scope="col">Trạng thái</th>
                        <th id="thBtnThesis"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td id="titleThesis"></td>
                        <td id="categoryThesis"></td>
                        <td id="lecturerThesis"></td>
                        <td>
                            <span id="approveThesis" class="status"></span>
                        </td>
                        <td id="btnThesis">
                            <button type="button" class="btn btn-warning thesis-action-btn" data-bs-toggle="modal" data-bs-target="#update-thesis" data-bs-whatever="">Sửa</button>
                            <div class="modal fade" id="update-thesis" tabindex="-1" aria-labelledby="update-thesis-Label" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Sửa đề tài</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <fieldset >
                                                    <div class="mb-3">
                                                        <label for="thesis-name" class="form-label required">Tên đề tài</label>
                                                        <input type="text" id="fixTitleThesis" class="form-control" value="a">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lecturer" class="form-label required">Giáo viên hướng dẫn</label>
                                                        <select id="selectListLecturer" class="form-select">
                                                            <option value="0" selected>--Chọn giảng viên hướng dẫn--</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label required">Mảng đề tài</label>
                                                        <select class="form-select"  id="selectListCategory">
                                                            <option value="0" selected>--Chọn mảng đề tài--</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="thesis-description" class="form-label" >Mô tả vắn tắt</label>
                                                        <textarea class="form-control" id="fixDesThesis" rows="3"></textarea>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" onclick="updateTrackingThesis();" class="btn btn-primary btn-warning">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger thesis-action-btn" data-bs-toggle="modal" data-bs-target="#delete-thesis">Xóa</button>
                            <!-- Modal -->
                            <div class="modal fade" id="delete-thesis" tabindex="-1" aria-labelledby="delete-thesis-Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Xác nhận xóa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn muốn xóa hay không?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" onclick="removeTrackingThesis();" class="btn btn-primary btn-warning" data-bs-dismiss="modal">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>   
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>