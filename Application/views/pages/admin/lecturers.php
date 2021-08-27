<div class="admin-main">
    <div class="heading">
        <h1 class="display-4">Quản lý giảng viên</h1>
    </div>
    <div class="admin-main-content">
        <!-- Add lecturers -->
        <div class="text-center">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add-student"><i class="fas fa-plus-circle pd-4" ></i>Thêm giảng viên</button>
        </div>
        <div class="modal fade" id="add-student" tabindex="-1" aria-labelledby="add-student-Label" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Thêm giảng viên</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <fieldset >
                                <div class="mb-3">
                                    <label for="" class="form-label required">Họ và tên</label>
                                    <input type="text" id="" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label required">Số lượng SV hướng dẫn</label>
                                    <input type="text" id="" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="assignment-title" class="form-label pd-20 required">Ngày sinh</label>
                                    <input type="date" id="start" name="trip-start" value="" min="1965-01-01" max="1995-12-31">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label ">Số điện thoại</label>
                                    <input type="text" id="" class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label ">Email</label>
                                    <input type="text" id="" class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label required">Địa chỉ</label>
                                    <input type="text" id="" class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label ">Ảnh</label>
                                    <input type="file" id="" class="form-control">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-info">Thêm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="wrapper text-center">
            <div class="input-group rounded d-inline-flex mt-3 w-75">
                <input type="search" class="form-control rounded" placeholder="Tìm kiếm..." aria-label="Search"
                    aria-describedby="search-addon" />
                <button class="input-group-text border-0 search-btn" id="search-addon">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Lecturers list -->
        <div class="student-list">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã GV</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Số lượng SV hướng dẫn</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Email</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col" class="w-15">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>GV001002</td>
                        <td>Trần Phương Nhung</td>
                        <td>20</td>
                        <td>0734566542</td>
                        <td>email@gmail.com</td>
                        <td>Hà Nội</td>
                        <td class="text-center"><img style="width: 30px;" src="<?php echo getPathImg('user.png'); ?>"></td>
                        <td>
                            <!-- Edit lecturer info -->
                            <button type="button" class="btn btn-secondary thesis-action-btn" data-bs-toggle="modal" data-bs-target="#update-lecturer-info"><i class="far fa-edit pd-4"></i>Sửa</button>
                            <div class="modal fade" id="update-lecturer-info" tabindex="-1" aria-labelledby="update-lecturer-info-Label" aria-hidden="true">
                            <div class="modal-dialog modal-xl mt-0">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Sửa thông tin giảng viên</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <fieldset >
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Họ và tên</label>
                                                    <input type="text" id="" class="form-control" value="Trần Phương Nhung">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Số lượng SV hướng dẫn</label>
                                                    <input type="text" id="" class="form-control" value="20">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="assignment-title" class="form-label pd-20">Ngày sinh</label>
                                                    <input type="date" id="start" name="trip-start" value="" min="1965-01-01" max="1995-12-31">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label ">Số điện thoại</label>
                                                    <input type="text" id="" class="form-control" value="0734566542">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label ">Email</label>
                                                    <input type="text" id="" class="form-control" value="email@gmail.com">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Địa chỉ</label>
                                                    <input type="text" id="" class="form-control" value="Hà Nội">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label ">Ảnh</label>
                                                    <input type="file" id="" class="form-control">
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-info">Sửa</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- Delete lecturer -->
                            <button type="button" class="btn btn-danger table-btn" data-bs-toggle="modal" data-bs-target="#delete-student"><i class="far fa-trash-alt pd-4"></i>Xóa</button>
                            <div class="modal fade" id="delete-student" tabindex="-1" aria-labelledby="delete-student-Label" aria-hidden="true">
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
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn-info">Xóa</button>
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