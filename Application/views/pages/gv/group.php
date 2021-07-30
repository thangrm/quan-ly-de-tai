<?php 
    $currentPage = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<div class="col-10 content">
    <div class="content-wrapper">
        
        <div class="group-heading">
            <div class="group-banner">
                <img src="<?php echo getPathImg('banner02.jpg'); ?>" alt="">
            </div>
            <div class="group-name">
                <h4>N01-KTPM01K13</h4>
            </div>
        </div>

        <div class="group-action d-flex justify-content-center">
            <div class="add-assingment">
                <!-- Giao bài tập -->
                <div class="text-center">
                    <button type="button" class="btn btn-primary btn-warning mg-20" data-bs-toggle="modal" data-bs-target="#add-assignment"><i class="fas fa-tasks pd-4"></i>Giao bài tập</button>
                </div>
                <div class="modal fade" id="add-assignment" tabindex="-1" aria-labelledby="add-assignment-Label" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Giao bài tập</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <fieldset >
                                        <div class="mb-3">
                                            <label for="assignment-title" class="form-label">Tiêu đề</label>
                                            <input type="text" id="assignment-title" class="form-control" placeholder="Tiêu đề...">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Hướng dẫn</label>
                                            <textarea class="form-control" id="" rows="5" placeholder=""></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="assignment-title" class="form-label">Hạn nộp</label>
                                            <input type="date" id="start" name="trip-start" value="" min="2020-01-01" max="2022-12-31">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary btn-warning">Giao bài</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-students">
                <!-- Thêm sinh viên -->
                <div class="text-center">
                    <button type="button" class="btn btn-primary btn-warning mg-20" data-bs-toggle="modal" data-bs-target="#add-students"><i class="fas fa-user-plus pd-4"></i>Thêm thành viên</button>
                </div>
                <div class="modal fade" id="add-students" tabindex="-1" aria-labelledby="add-students-Label" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Thêm thành viên</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Lớp</th>
                                        <th scope="col">Tên đề tài</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Nguyễn Mộng Mơ</td>
                                        <td>KTPM02K13</td>
                                        <td>Lorem ipsum dolor</td>
                                        <td>
                                            <button type="button" class="btn btn-warning table-btn">Thêm</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Nguyễn Mộng Mơ</td>
                                        <td>KTPM02K13</td>
                                        <td>Lorem ipsum dolor</td>
                                        <td>
                                            <button type="button" class="btn btn-warning table-btn">Thêm</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-fix " data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="group-content">
            <a href="<?php echo getBaseUrl()."gv/group/viewassignment";?>" class="assingment-link">
                <div class="assingment">
                    <div class="assingment-icon">
                        <i class="fas fa-clipboard-list"></i>
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
            </a>
            <a href="<?php echo getBaseUrl()."gv/group/viewassignment";?>" class="assingment-link">
                <div class="assingment">
                    <div class="assingment-icon">
                        <i class="fas fa-clipboard-list"></i>
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
            </a>
            <a href="<?php echo getBaseUrl()."gv/group/viewassignment";?>" class="assingment-link">
                <div class="assingment">
                    <div class="assingment-icon">
                        <i class="fas fa-clipboard-list"></i>
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
            </a>
        </div>
    </div>
</div>
