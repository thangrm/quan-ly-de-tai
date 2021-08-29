<div class="col-10 content">
    <div class="content-wrapper">
        <div class="heading">
            <h1 class="display-4">Đề tài mẫu</h1>
        </div>
        <div class="main-content">
            <div class="wrapper text-end">
                <select class="form-select w-40 d-inline-flex mb-3" aria-label="Default select example" id="selectListCategory">
                    <option value="0" selected>--Chọn mảng đề tài--</option>
                </select>
            </div>
            <div class="wrapper text-end">
                <div class="input-group rounded d-inline-flex mb-3">
                    <input type="search" class="form-control rounded" placeholder="Tìm kiếm đề tài..." aria-label="Search"
                        aria-describedby="search-addon" id="searchThesis"/>
                    <button class="input-group-text border-0 search-btn" id="search-addon" onclick="setListExampleThesis();">
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
                    </tr>
                </thead>
                <tbody id="tbExampleList">
                </tbody>
            </table>
        </div>
    </div>
</div>