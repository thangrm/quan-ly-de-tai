<div class="col-10 content">
    <div class="content-wrapper">
        <div class="view-assign">
            <div class="view-assign-heading">
                <div class="assingment-icon-wrapper">
                    <div class="assingment-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                </div>
                <div class="assingment-info">
                    <div class="assingment-detail">
                        <span class="assingment-detail-heading">Nộp báo cáo tiến độ tuần 1</span>
                    </div> 
                    <div class="assingment-time">
                        <span>28/07/2021</span>
                    </div>
                </div>
            </div>
            <div class="row view-assign-content">
                <div class="view-assign-infor">
                    <div class="view-assign-infor-wrapper">
                        <div class="assingment-deadline">
                                <span>Hạn nộp: </span>
                                <span>02/08/2021</span>
                            </div>
                        <div class="view-assign-description">
                            <span>Các nhóm nộp lại cho cô BM02 phân công nội dung công việc của các thành viên trong nhóm vào file word đặt tên như sau: Nhóm_BM02( Ví dụ với nhóm 1 đặt tên file như sau: 1_BM02)</span>
                        </div>
                    </div>

                    
                </div>

                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Bài nộp</th>
                        <th scope="col" style="width: 12%;">Trạng thái</th>
                        <th scope="col" style="width: 8%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Nguyễn Mộng Mơ</td>
                        <td>
                            <a href="">BaoCaoTienDoTuan1.doc</a>
                        </td>
                        <td>
                            <span class="status waiting">Chưa chấm điểm</span>
                        </td>
                        <td class="assign-action">
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary table-btn w-100" data-bs-toggle="modal" data-bs-target="#grade-assign">Đánh giá</button>
                            </div>
                            <div class="modal fade" id="grade-assign" tabindex="-1" aria-labelledby="grade-assignt-Label" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Đánh giá</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body container">
                                            <form>
                                                <div class="row mg--10">
                                                    <div class="col-9 ">
                                                        <div class="assignment-cmt">
                                                            <label for=""  class="form-label">
                                                                <i class="far fa-comment-alt"></i>    
                                                                Nhận xét
                                                            </label>
                                                            <div class="comment-wrapper"> 
                                                                <div class="d-flex align-items-center">
                                                                    <div class="cmt-avatar">
                                                                        <img src="<?php echo getPathImg('user.png'); ?>" alt="" class="rounded-circle">
                                                                    </div>
                                                                    <h5 class="cmt-user-name mg-0">Nguyễn Mộng Mơ</h5> 
                                                                    <span class="cmt-time">- 16:10, 30/07/2021</span>
                                                                </div>
                                                                <p class="cmt-content mg-0">Lorem ipsum dolor</p>
                                                            </div>

                                                            <div class="comment-add">
                                                                <label for="" class="form-label">
                                                                    <i class="fas fa-comment-medical"></i>
                                                                    Thêm nhận xét
                                                                </label>
                                                                <textarea class="form-control" id="" rows="3"></textarea>
                                                                <button type="button" class="btn btn-secondary mt-3">Gửi</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row mark-assignment">
                                                            <label for="" class="col-sm-5 col-form-label">Chấm điểm</label>
                                                            <div class="col-sm-7">
                                                                <input type="text" class="form-control w-40" id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" class="btn btn-primary btn-warning">Lưu</button>
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
</div>