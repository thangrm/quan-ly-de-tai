<?php 
    $currentPage = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<div class="admin-sidebar scrollbar">
    <div class="admin-sidebar-header">
        <div class="admin-logo">
            <img src="<?php echo getPathImg('admin.png') ?>" alt="">
        </div>
        <h3>Admin</h3>
    </div>
    <ul class="admin-sidebar-list">
        <li class="admin-sidebar-item">
            <a href="<?php echo getBaseUrl()."admin"?>" class="admin-sidebar-link <?php  if($currentPage == getBaseUrl()."admin") echo "active "?>">
                <i class="fas fa-home"></i>
                Trang chủ
            </a>
        </li>
        <li class="admin-sidebar-item">
            <a href="" class="admin-sidebar-link">
            <i class="fas fa-user-graduate"></i>
                Thông tin cá nhân
            </a>
            <ul class="sidebar-child">
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."admin/account/profile";?>" class="admin-sidebar-link <?php  if($currentPage == getBaseUrl()."admin/account/profile") echo "active "?>">
                        <i class="fas fa-chevron-right"></i>
                        Cập nhật thông tin
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."admin/account/password";?>" class="admin-sidebar-link <?php  if($currentPage == getBaseUrl()."admin/account/password") echo "active "?>">
                        <i class="fas fa-chevron-right"></i>
                        Đổi mật khẩu
                    </a>
                </li>
            </ul>
        </li>
        <li class="admin-sidebar-item">
            <a href="<?php echo getBaseUrl()."admin/students"?>" class="admin-sidebar-link <?php  if($currentPage == getBaseUrl()."admin/students") echo "active "?>">
                <i class="fas fa-user-friends"></i>
                Quản lý sinh viên
            </a>
        </li>
        <li class="admin-sidebar-item">
            <a href="<?php echo getBaseUrl()."admin/lecturers"?>" class="admin-sidebar-link <?php  if($currentPage == getBaseUrl()."admin/lecturers") echo "active "?>">
                <i class="fas fa-chalkboard-teacher"></i>
                Quản lý giảng viên
            </a>
        </li>
        <!-- <li class="admin-sidebar-item">
            <a href="" class="admin-sidebar-link">
                <i class="fas fa-history"></i>
                Quản lý đợt bảo vệ
            </a>
            <ul class="admin-sidebar-child">
                <li class="admin-sidebar-child__item">
                    <a href="<?php echo getBaseUrl();?>" class="admin-sidebar-child__link <?php  if($currentPage == getBaseUrl()) echo "active "?>">
                        <i class="fas fa-chevron-right"></i>
                        Lorem ipsum dolor sit 
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."sv/account/password";?>" class="admin-sidebar-child__link <?php  if($currentPage == getBaseUrl()."sv/account/password") echo "active "?>">
                        <i class="fas fa-chevron-right"></i>
                        Lorem ipsum dolor sit 
                    </a>
                </li>
            </ul>
        </li> -->
        <li class="admin-sidebar-item">
            <a href="<?php echo getBaseUrl()."admin/thesistopic"?>" class="admin-sidebar-link <?php  if($currentPage == getBaseUrl()."admin/thesistopic") echo "active "?>">
                <i class="fas fa-book"></i>
                Quản lý mảng đề tài
            </a>
        </li>
        
    </ul>

    <div class="copyright">
        <p>Made by Team 23 <i class="fas fa-heart"></i></p>
        <p>&copy 2021, HaUI</p>
    </div>
</div>