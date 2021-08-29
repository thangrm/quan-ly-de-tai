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
                        <span class="assingment-detail-heading" id="nameAssingment"></span>
                    </div> 
                    <div class="assingment-time">
                        <span id="postDate"></span>
                    </div>
                </div>
            </div>
            <div class="row view-assign-content">
                <div class="col-8 view-assign-infor">
                    <div class="view-assign-infor-wrapper">
                        <div class="assingment-deadline">
                                <span>Hạn nộp: </span>
                                <span id="deadline"></span>
                            </div>
                        <div class="view-assign-description">
                            <span id="desAssingment"></span>
                        </div>
                    </div>

                    <div class="assignment-result d-flex align-items-center mb-20 ">
                        <h4>Điểm</h4>
                        <span class="assignment-mark" id="scoreAssingment"></span>
                    </div>

                    <div class="assignment-cmt" id="opinionContent">                     
                    </div>
                </div>
                <div class="col-4 assingment-action">
                    <div class="assingment-action-title">
                        <span>Nộp bài</span>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="formFileSubmit" >
                        <a href="" download="" id="fileSubmitted" style="margin-left: 10px;"></a>
                        <p id="dateSumitted" style="margin-left: 10px;"></p>
                    </div>
                    <div class="form-action">
                        <button type="submit" onclick="submitAssignment();" class="btn btn-primary btn-warning w-40">Nộp bài</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>