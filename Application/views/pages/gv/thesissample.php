<div class="col-10 content">
    <div class="content-wrapper">
        <div class="heading">
            <h1 class="display-4">Đề tài mẫu</h1>
        </div>
        <div class="main-content">
            <div class="wrapper text-end">
                <div class="input-group rounded d-inline-flex mb-3">
                    <input type="search" class="form-control rounded" placeholder="Tìm kiếm đề tài..." aria-label="Search"
                        aria-describedby="search-addon" />
                    <button class="input-group-text border-0 search-btn" id="search-addon">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="wrapper text-end">
                <select class="form-select w-30 d-inline-flex mb-3" aria-label="Default select example">
                    <option selected>--Chọn mảng đề tài--</option>
                    <option>Website</option>
                    <option>An toàn bảo mật thông tin</option>
                    <option>Trí tuệ nhân tạo</option>
                </select>
            </div>

            <div class="thesis-sample-add mb-20 ">
                <!-- Button trigger modal -->
                <div class="text-center">
                    <button type="button" class="btn btn-primary btn-warning w-15" data-bs-toggle="modal" data-bs-target="#add-thesis-sample"><i class="fas fa-plus-circle pd-4"></i>Thêm mới</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="add-thesis-sample" tabindex="-1" aria-labelledby="add-thesis-sample-Label" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Thêm đề tài mẫu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <fieldset >
                                        <div class="mb-3">
                                            <label for="thesis-name" class="form-label required">Tên đề tài</label>
                                            <input type="text" id="thesis-name" class="form-control" placeholder="Ghi rõ ràng và đầy đủ tên đề tài...">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lecturer" class="form-label required">Mảng đề tài</label>
                                            <select id="lecturer" class="form-select">
                                                <option>--Chọn mảng đề tài--</option>
                                                <option>Website</option>
                                                <option>An toàn bảo mật thông tin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Mô tả vắn tắt</label>
                                            <textarea class="form-control" id="description" rows="3" placeholder="Mô tả vắn tắt đề tài..."></textarea>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary btn-warning">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên đề tài</th>
                        <th scope="col">Mảng đề tài</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">3</th>
                        <td>Ứng dụng trí tuệ nhân tạo để phát hiện gian lận thi cử</td>
                        <td>Trí tuệ nhân tạo</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary thesis-action-btn" data-bs-toggle="modal" data-bs-target="#update-thesis">Sửa</button>
                            <!-- Modal -->
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
                                                        <input type="text" id="thesis-name" class="form-control" value="Xây dựng website bán hàng sử dụng ngôn ngữ PHP">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="thesis-field" class="form-label required">Mảng đề tài</label>
                                                        <input type="text" id="thesis-field" class="form-control" value="Website">
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn-primary btn-warning">Lưu</button>
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
                                            <button type="button" class="btn btn-primary btn-warning">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Tìm hiểu chuẩn mã dữ liệu DES và ứng dụng vào thi tuyển đại học</td>
                        <td>An toàn bảo mật thông tin</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary thesis-action-btn" data-bs-toggle="modal" data-bs-target="#update-thesis">Sửa</button>
                            <!-- Modal -->
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
                                                        <input type="text" id="thesis-name" class="form-control" value="Xây dựng website bán hàng sử dụng ngôn ngữ PHP">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="thesis-field" class="form-label required">Mảng đề tài</label>
                                                        <input type="text" id="thesis-field" class="form-control" value="Website">
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn-primary btn-warning">Lưu</button>
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