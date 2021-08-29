<div class="col-10 content">
    <div class="content-wrapper">
        <div class="heading">
            <h1 class="display-4">Danh sách đề tài</h1>
        </div>
        <div class="main-content">
            <div class="wrapper text-end">
                <select class="form-select w-40 d-inline-flex mb-3" aria-label="Default select example"  id="selectListCategory">
                    <option value="0" selected>--Chọn mảng đề tài--</option>
                </select>
            </div>
            <div class="wrapper text-end">
                <div class="input-group rounded d-inline-flex mb-3">
                    <input type="search" id="searchThesis" class="form-control rounded" placeholder="Tìm kiếm theo tên đề tài" aria-label="Search"
                        aria-describedby="search-addon" />
                    <button class="input-group-text border-0 search-btn" id="search-addon" onclick="setListThesis();">
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
                <tbody id="tbThesisList">
                </tbody>

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
                                            <label for="thesis-name" class="form-label required" >Tên đề tài</label>
                                            <input type="text" id="thesisName" class="form-control" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="thesis-field" class="form-label required">Mảng đề tài</label>
                                            <input type="text" id="thesisCategory" class="form-control" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="thesis-author" class="form-label required">Sinh viên thực hiện</label>
                                            <input type="text" id="thesisStudent" class="form-control" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="thesis-description" class="form-label">Mô tả vắn tắt</label>
                                            <textarea class="form-control" id="thesisDes" rows="3" disabled></textarea>
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
            </table>
        </div>
    </div>
</div>