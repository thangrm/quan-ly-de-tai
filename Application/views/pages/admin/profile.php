<div class="col-10 content account-update" style="margin-left: 0; width: 100%;">
    <div class="content-wrapper">
        <div class="heading">
            <h1 class="display-4">Cập nhật thông tin cá nhân</h1>
        </div>
        <div class="main-content">
            <form method="post">
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label" >Họ tên</label>
                    <div class="col-sm-6">
                        <input type="text" readonly class="form-control-plaintext" id="infNameUser" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Mật khẩu</label>
                    <div class="col-sm-6 d-flex align-items-center">
                    <a href="<?php echo getUrl("admin/account/password");?>">Đổi mật khẩu</a>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label" >Ảnh</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="file" accept="image/x-png,image/gif,image/jpeg" id="infAvatarUser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id="infEmailUser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Số điện thoại</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="infPhoneUser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Địa chỉ</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="infAddressUser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-6">
                        <button type="button" onclick="updateUser();" class="btn btn-info" id="btnSubmitInfor">Lưu thay đổi</button>
                    </div>
                </div>
                </form>
        </div>
    </div>
</div>
    