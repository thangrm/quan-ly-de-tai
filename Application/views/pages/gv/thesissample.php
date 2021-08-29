<div class="col-10 content">
    <div class="content-wrapper">
        <div class="heading">
            <h1 class="display-4">Đề tài mẫu</h1>
        </div>
        <div class="main-content">
            <div class="wrapper text-end">
                <div class="input-group rounded d-inline-flex mb-3">
                    <input type="search" id="searchThesis" class="form-control rounded" placeholder="Tìm kiếm đề tài..." aria-label="Search"
                        aria-describedby="search-addon" />
                    <button onclick="setListExampleThesis();" class="input-group-text border-0 search-btn" id="search-addon">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="wrapper text-end">
                <select class="form-select w-40 d-inline-flex mb-3" aria-label="Default select example"  id="selectListCategory">
                    <option value="0" selected>--Chọn mảng đề tài--</option>
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
                                            <label for="registerTitle" class="form-label required">Tên đề tài</label>
                                            <input type="text" id="registerTitle" class="form-control" placeholder="Ghi rõ ràng và đầy đủ tên đề tài...">
                                        </div>
                                        <div class="mb-3">
                                            <label for="selectCategoryRegister" class="form-label required">Mảng đề tài</label>
                                            <select id="selectCategoryRegister" class="form-select">
                                                    <option value="0" selected>--Chọn mảng đề tài--</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="registerDes" class="form-label">Mô tả vắn tắt</label>
                                            <textarea class="form-control" id="registerDes" rows="3" placeholder="Mô tả vắn tắt đề tài..."></textarea>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                <button type="button" onclick="registerExampleThesis();" class="btn btn-primary btn-warning">Lưu</button>
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
                <tbody id="tbExampleList">
                </tbody>
                <!-- Modal Sửa -->
                <div class="modal fade" id="update-thesis" tabindex="-1" aria-labelledby="update-thesis-Label" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Sửa đề tài mẫu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <fieldset >
                                        <div class="mb-3">
                                            <label for="thesisName" class="form-label required">Tên đề tài</label>
                                            <input type="text" id="thesisName" class="form-control" value="Xây dựng website bán hàng sử dụng ngôn ngữ PHP">
                                        </div>
                                        <div class="mb-3">
                                            <label for="thesis-field" class="form-label required">Mảng đề tài</label>
                                            <select id="selectCategoryFix" class="form-select">
                                                <option value="0" selected>--Chọn mảng đề tài--</option>
                                            </select>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                <button type="button" onclick="updateExampleThesis();" class="btn btn-primary btn-warning">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Xóa-->
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
                                <button type="button" onclick="removeExampleThesis();" data-bs-dismiss="modal" class="btn btn-primary btn-warning">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </table>
        </div>
    </div>
</div>