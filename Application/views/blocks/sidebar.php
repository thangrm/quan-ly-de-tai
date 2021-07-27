<div class="col-2 sidebar">
    <ul class="sidebar-list">
        <li class="sidebar-item">
            <a href="<?php echo getBaseUrl()?>" class="sidebar-link active">
                <i class="fas fa-home"></i>
                Trang chủ
            </a>
        </li>
        <li class="sidebar-item">
            <a href="" class="sidebar-link">
                <i class="fas fa-user"></i>
                Thông tin cá nhân
            </a>
            <ul class="sidebar-child">
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."account/profile";?>" class="sidebar-child__link">
                        <i class="fas fa-chevron-right"></i>
                        Cập nhật thông tin
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."account/password";?>" class="sidebar-child__link">
                        <i class="fas fa-chevron-right"></i>
                        Đổi mật khẩu
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="" class="sidebar-link">
                <i class="fas fa-edit"></i>
                Đăng ký đề tài
            </a>
            <ul class="sidebar-child">
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."thesis/thesislist";?>" class="sidebar-child__link">
                        <i class="fas fa-chevron-right"></i>
                        Danh sách đề tài
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."thesis/thesisregister";?>" class="sidebar-child__link">
                        <i class="fas fa-chevron-right"></i>
                        Đăng ký đề tài
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="" class="sidebar-link">
                <i class="fas fa-users"></i>
                Danh sách nhóm
            </a>
            <ul class="sidebar-child">
                <li class="sidebar-child__item">
                    <a href="" class="sidebar-child__link">
                        <i class="fas fa-chevron-right"></i>
                        N01-KTPM01K13
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="" class="sidebar-child__link">
                        <i class="fas fa-chevron-right"></i>
                        N02-KTPM02K13
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="" class="sidebar-child__link">
                        <i class="fas fa-chevron-right"></i>
                        N04-KTPM03K13
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="copyright">
        <p>Made by Team 23 <i class="fas fa-heart"></i></p>
        <p>&copy 2021, HaUI</p>
    </div>
</div> 
