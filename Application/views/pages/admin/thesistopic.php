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
                                    <label for="nameCategoryAdd" class="form-label ">Tên mảng đề tài</label>
                                    <input type="text" id="nameCategoryAdd" class="form-control">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" onclick="createCategory();" class="btn btn-info">Thêm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thesis topic list -->
        <div class="student-list">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Mã số</th>
                        <th scope="col">Tên mảng đề tài</th>
                        <th scope="col" class="w-15">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="listCategory">

                </tbody>

                 <!-- Edit thesis topic info -->
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
                                            <label for="nameCategory" class="form-label">Tên mảng đề tài</label>
                                            <input type="text" id="nameCategoryFix" class="form-control" value="Trí tuệ nhân tạo">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" onclick="updateCategory();" class="btn btn-info">Sửa</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete thesis topic -->
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
                                <button type="button" onclick="deleteCategory();" class="btn btn-info" data-bs-dismiss="modal">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </table>
        </div>
    </div>
</div>