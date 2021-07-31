<div class="admin-main">
    <div class="heading">
        <h1 class="display-4">Quản lý mảng đề tài</h1>
    </div>
    <div class="admin-main-content">
        <!-- Add lecturers -->
        <div class="text-center">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add-thesis-topic"><i class="fas fa-plus-circle pd-4" ></i>Thêm mảng đề tài</button>
        </div>
        <div class="modal fade" id="add-thesis-topic" tabindex="-1" aria-labelledby="add-thesis-topic-Label" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Thêm mảng đề tài</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <fieldset >
                                <div class="mb-3">
                                    <label for="" class="form-label ">Tên mảng đề tài</label>
                                    <input type="text" id="" class="form-control">
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

        <!-- Thesis topic list -->
        <div class="student-list">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="w-15">STT</th>
                        <th scope="col">Mã số</th>
                        <th scope="col">Tên mảng đề tài</th>
                        <th scope="col" class="w-15">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                        <td>TT001</td>
                        <td>Trí tuệ nhân tạo</td>
                        <td>
                            <!-- Edit thesis topic info -->
                            <button type="button" class="btn btn-secondary thesis-action-btn" data-bs-toggle="modal" data-bs-target="#update-thesis-topic"><i class="far fa-edit pd-4"></i>Sửa</button>
                            <div class="modal fade" id="update-thesis-topic" tabindex="-1" aria-labelledby="update-thesis-topic-Label" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Sửa mảng đề tài</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <fieldset >
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Tên mảng đề tài</label>
                                                    <input type="text" id="" class="form-control" value="Trí tuệ nhân tạo">
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
                            <!-- Delete thesis topic -->
                            <button type="button" class="btn btn-danger table-btn" data-bs-toggle="modal" data-bs-target="#delete-thesis-topic"><i class="far fa-trash-alt pd-4"></i>Xóa</button>
                            <div class="modal fade" id="delete-thesis-topic" tabindex="-1" aria-labelledby="delete-thesis-topic-Label" aria-hidden="true">
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