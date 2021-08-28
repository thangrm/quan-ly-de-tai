<?php
  $javascript = ['login.js']; // add file javascript

  $this->view('blocks/headHTML',['css'=>null,
                               'js'=>$javascript
                              ]);
?>
<div class="login-page container-sm">
  <div class="login-heading">
    <div class="login-heading-logo">
      <img src="<?php echo getPathImg('logo-fit.png'); ?>" alt="">
    </div>
    <div class="login-heading-title">
      <h4>Hệ thống đăng ký đề tài tốt nghiệp khoa CNTT</h4>
    </div>
  </div>
  <form id='login'>
    <div class="mb-3">
      <label for="username" class="form-label">Tên đăng nhập</label>
      <input type="text" class="form-control" id="username">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Mật khẩu</label>
      <input type="password" class="form-control" id="password">
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="savepass">
      <label class="form-check-label" for="savepass">Nhớ mật khẩu</label>
    </div>
    <div class="form-action">
      <button type="submit" class="btn btn-primary">Đăng nhập</button>
    </div>
  </form>
</div>