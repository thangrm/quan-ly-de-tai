<div class="admin-main">
    <div class="heading">
        <h1 class="display-4">Quản lý sinh viên</h1>
    </div>
    <div class="admin-main-content">
        <!-- Add student -->
        <div class="text-center">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add-student"><i class="fas fa-plus-circle pd-4" ></i>Thêm sinh viên</button>
        </div>
        <div class="modal fade" id="add-student" tabindex="-1" aria-labelledby="add-student-Label" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Thêm sinh viên</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <fieldset >
                                <div class="mb-3">
                                    <label for="" class="form-label required">Họ và tên</label>
                                    <input type="text" id="nameStudentAdd" class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label required">Ngành</label>
                                    <select id="selectMajorStudentAdd" class="form-select">
                                        <option value="1">Công nghệ thông tin</option>
                                        <option value="2">Kỹ thuật phần mềm</option>
                                        <option value="3">Khoa học máy tính</option>
                                        <option value="4">Hệ thống thông tin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label required">Khóa</label>
                                    <select id="selectYearStudentAdd" class="form-select">
                                        <option value="1">K13</option>
                                        <option value="2">K14</option>
                                        <option value="3">K15</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="assignment-title" class="form-label required pd-20">Ngày sinh</label>
                                    <input type="date" id="birthdayStudentAdd" name="trip-start" value="" min="2000-01-01" max="2003-12-31">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label ">Số điện thoại</label>
                                    <input type="text" id="phoneStudentAdd" class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label ">Email</label>
                                    <input type="text" id="emailStudentAdd" class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label ">Địa chỉ</label>
                                    <input type="text" id="addressStudentAdd" class="form-control" placeholder="">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" onclick="createStudent();" class="btn btn-info">Thêm</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- Search -->
         <div class="wrapper text-center">
            <div class="input-group rounded d-inline-flex mt-3 w-75">
                <input type="search" id="searchStudent" class="form-control rounded" placeholder="Tìm kiếm..." aria-label="Search"
                    aria-describedby="search-addon" />
                <button onclick="setListStudent();" class="input-group-text border-0 search-btn" id="search-addon">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Stdent list -->
        <div class="student-list">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã SV</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Ngành</th>
                        <th scope="col">Khóa</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Email</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Ảnh</th>
                        <th class="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="listStudent">
 
                </tbody>

                 <!-- Form Edit student info -->
                <div class="modal fade" id="update-student-info" tabindex="-1" aria-labelledby="update-student-info-Label" aria-hidden="true">
                    <div class="modal-dialog modal-xl mt-0">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Sửa thông tin sinh viên</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <fieldset >
                                        <div class="mb-3">
                                            <label for="" class="form-label ">Họ và tên</label>
                                            <input type="text" id="nameStudentFix" class="form-control" value="Nguyễn Mộng Mơ">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label ">Ngành</label>
                                            <select id="selectMajorStudentFix" class="form-select">
                                                <option value="1">Công nghệ thông tin</option>
                                                <option value="2">Kỹ thuật phần mềm</option>
                                                <option value="3">Khoa học máy tính</option>
                                                <option value="4">Hệ thống thông tin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label ">Khóa</label>
                                            <select id="selectYearStudentFix" class="form-select">
                                                <option value="1">K13</option>
                                                <option value="2">K14</option>
                                                <option value="3">K15</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="assignment-title" class="form-label  pd-20">Ngày sinh</label>
                                            <input type="date" id="birthdayStudentFix" name="trip-start" value="" min="2000-01-01" max="2003-12-31">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label ">Số điện thoại</label>
                                            <input type="text" id="phoneStudentFix" class="form-control" value="0123456789">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label ">Email</label>
                                            <input type="text" id="emailStudentFix" class="form-control" value="email@gmail.com">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label ">Địa chỉ</label>
                                            <input type="text" id="addressStudentFix" class="form-control" value="Hà Nội">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label ">Ảnh</label>
                                            <input type="file" id="avatarStudentFix" class="form-control">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="button" onclick="updateStudent();" class="btn btn-info">Sửa</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confirm Delete student -->
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
                                <button type="button" onclick="deleteStudent();" class="btn btn-info" data-bs-dismiss="modal">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </table>
        </div>
    </div>
</div>