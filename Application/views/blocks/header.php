<header>
    <div class="header container-fluid">
        <div class="header-brand">
            <div class="header-brand__img">
                <img src="<?php echo getPathImg('fit.png'); ?>" alt="">
            </div>
            <h3>Hệ thống đăng ký đề tài tốt nghiệp khoa CNTT</h3>
        </div>
        <div class="header-account dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="header-account__avatar">
                <img src="<?php echo getPathImg('user.png'); ?>" id="avatarUser" alt="">
            </div>
            <div class="header-account__name">
                <p id="nameUser"></p>
            </div>
        </div>
        <ul class="dropdown-menu">
            <li><a href="<?php echo getUrl('logout'); ?>" class="dropdown-item">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a></li>
        </ul>
    </div>
</header>