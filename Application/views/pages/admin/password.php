<?php $page = 'password' ?>
<div class="col-10 content account-update" style="margin-left: 0; width: 100%;">
    <div class="content-wrapper">
        <div class="heading">
            <h1 class="display-4">Đổi mật khẩu</h1>
        </div>
        <div class="main-content">
            <form>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label required">Mật khẩu cũ</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="password" id="oldPass">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label required">Mật khẩu mới</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="password" id="newPass">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label required">Nhập lại mật khẩu mới</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="password" id="rePass">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-6">
                        <button type="button" onclick="changePass();" class="btn btn-info">Xác nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>