<div class="col-10 content">
    <div class="content-wrapper">
        <div class="heading">
            <h1 class="display-4">Danh sách đề tài</h1>
        </div>
        <div class="main-content">
            <div class="wrapper text-end">
                <select class="form-select w-40 d-inline-flex mb-3" aria-label="Default select example">
                    <option selected>--Chọn mảng đề tài--</option>
                    <option>Website</option>
                    <option>An toàn bảo mật thông tin</option>
                    <option>Trí tuệ nhân tạo</option>
                </select>
            </div>
            <div class="wrapper text-end">
                <div class="input-group rounded d-inline-flex mb-3">
                    <input type="search" class="form-control rounded" placeholder="Tìm kiếm theo tên đề tài hoặc tên sinh viên..." aria-label="Search"
                        aria-describedby="search-addon" />
                    <button class="input-group-text border-0 search-btn" id="search-addon">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên đề tài</th>
                        <th scope="col">Mảng đề tài</th>
                        <th scope="col">SV thực hiện</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Xây dựng website bán hàng sử dụng ngôn ngữ PHP</td>
                        <td>Website</td>
                        <td>Nguyễn Mộng Mơ</td>
                        <td>
                            <span class="status waiting">Chờ duyệt</span>
                        </td>
                        <td class="thesis-action">
                            <!-- Xem chi tiết đề tài -->
                            <button type="button" class="btn btn-secondary thesis-action-btn" data-bs-toggle="modal" data-bs-target="#view-thesis">Xem</button>
                            <div class="modal fade" id="view-thesis" tabindex="-1" aria-labelledby="view-thesis-Label" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Thông tin chi tiết</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <fieldset >
                                                    <div class="mb-3">
                                                        <label for="thesis-name" class="form-label required">Tên đề tài</label>
                                                        <input type="text" id="thesis-name" class="form-control" value="Xây dựng website bán hàng sử dụng ngôn ngữ PHP" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="thesis-field" class="form-label required">Mảng đề tài</label>
                                                        <input type="text" id="thesis-field" class="form-control" value="Website" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="thesis-author" class="form-label required">Sinh viên thực hiện</label>
                                                        <input type="text" id="thesis-author" class="form-control" value="Nguyễn Mộng Mơ" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="thesis-description" class="form-label">Mô tả vắn tắt</label>
                                                        <textarea class="form-control" id="thesis-description" rows="3" disabled>Website bán đồ ăn nhanh bao gồm 1 số chức năng chính: Xem sản phẩm, Mua hàng, Thêm, Sửa, Xóa...</textarea>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Duyệt đề tài -->
                            <button type="button" class="btn btn-success thesis-action-btn" id="confirm-thesis">Duyệt</button>

                            <!-- Xóa đề tài -->
                            <button type="button" class="btn btn-danger thesis-action-btn" data-bs-toggle="modal" data-bs-target="#delete-thesis">Xóa</button>
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
                                            <button type="button" class="btn btn-primary btn-warning">Xóa</button>
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