<div class="col-10 content">
    <div class="content-wrapper">
        <div class="heading">
            <h1 class="display-4">Đăng ký đề tài</h1>
        </div>
        <div class="main-content">
            <form onsubmit="return false;">
                <fieldset >
                    <div class="mb-3">
                        <label for="registerTitle" class="form-label required">Tên đề tài thực hiện</label>
                        <input type="text" id="registerTitle" class="form-control" placeholder="Ghi rõ ràng và đầy đủ tên đề tài...">
                    </div>
                    <div class="mb-3">
                        <label for="lecturer" class="form-label required">Chọn giảng viên hướng dẫn</label>
                        <select id="selectListLecturer" class="form-select">
                            <option value="0" selected>--Chọn giảng viên hướng dẫn--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="selectListCategory" class="form-label required">Chọn mảng đề tài</label>
                        <select class="form-select"  id="selectListCategory">
                            <option value="0" selected>--Chọn mảng đề tài--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="registerDes" class="form-label">Mô tả vắn tắt</label>
                        <textarea class="form-control" id="registerDes" rows="3" placeholder="Mô tả vắn tắt đề tài..."></textarea>
                    </div>
                    <div class="form-action">
                        <button type="button" onclick="registerThesis();" class="btn btn-primary btn-warning w-30">Đăng ký</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>