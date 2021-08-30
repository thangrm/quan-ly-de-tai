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
                        <span id="nameAssingment" class="assingment-detail-heading"></span>
                    </div> 
                    <div class="assingment-time">
                        <span id="postDate"></span>
                    </div>
                </div>
            </div>
            <div class="row view-assign-content">
                <div class="view-assign-infor">
                    <div class="view-assign-infor-wrapper">
                        <div class="assingment-deadline">
                                <span>Hạn nộp: </span>
                                <span id="dateline"></span>
                        </div>
                        <div class="view-assign-description">
                            <span id="desAssingment"></span>
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
                    <tbody id="detailAssisnment">
                        
                    </tbody>
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
                                                <div id="opinionContent" class="assignment-cmt">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="row mark-assignment">
                                                    <label for="" class="col-sm-5 col-form-label">Chấm điểm</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control w-40" id="score">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" onclick="assess();" class="btn btn-primary btn-warning" >Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>