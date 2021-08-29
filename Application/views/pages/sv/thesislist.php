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
                    <input type="search" class="form-control rounded" placeholder="Tìm kiếm theo tên đề tài" aria-label="Search"
                        aria-describedby="search-addon" id="searchThesis"/>
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
                        <th scope="col">GV hướng dẫn</th>
                        <th scope="col">Trạng thái</th>
                    </tr>
                </thead>
                <tbody id="tbThesisList">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>