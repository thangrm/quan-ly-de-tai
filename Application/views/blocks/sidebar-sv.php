<?php 
    $currentPage = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>

<div class="col-2 sidebar scrollbar">
    <ul class="sidebar-list">
        <li class="sidebar-item">
            <a href="<?php echo getBaseUrl()?>" class="sidebar-link <?php  if($currentPage == getBaseUrl()) echo "active "?>">
                <i class="fas fa-home"></i>
                Trang chủ
            </a>
        </li>
        <li class="sidebar-item">
            <a href="" class="sidebar-link">
            <i class="fas fa-user-graduate"></i>
                Thông tin cá nhân
            </a>
            <ul class="sidebar-child">
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."sv/account/profile";?>" class="sidebar-child__link <?php  if($currentPage == getBaseUrl()."sv/account/profile") echo "active "?>">
                        <i class="fas fa-chevron-right"></i>
                        Cập nhật thông tin
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."sv/account/password";?>" class="sidebar-child__link <?php  if($currentPage == getBaseUrl()."sv/account/password") echo "active "?>">
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
                    <a href="<?php echo getBaseUrl()."sv/thesis/thesissample";?>" class="sidebar-child__link <?php  if($currentPage == getBaseUrl()."sv/thesis/thesissample") echo "active "?>">
                        <i class="fas fa-chevron-right"></i>
                        Đề tài mẫu
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."sv/thesis/thesislist";?>" class="sidebar-child__link <?php  if($currentPage == getBaseUrl()."sv/thesis/thesislist") echo "active "?>">
                        <i class="fas fa-chevron-right"></i>
                        Danh sách đề tài
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."sv/thesis/thesisregister";?>" class="sidebar-child__link <?php  if($currentPage == getBaseUrl()."sv/thesis/thesisregister") echo "active "?>">
                        <i class="fas fa-chevron-right"></i>
                        Đăng ký đề tài
                    </a>
                </li>
                <li class="sidebar-child__item">
                    <a href="<?php echo getBaseUrl()."sv/thesis/thesistracking";?>" class="sidebar-child__link <?php  if($currentPage == getBaseUrl()."sv/thesis/thesistracking") echo "active "?>">
                        <i class="fas fa-chevron-right"></i>
                        Theo dõi đề tài
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="" class="sidebar-link">
                <i class="fas fa-users"></i>
                Nhóm hướng dẫn
            </a>
            <ul class="sidebar-child" id="listGroup">
            </ul>
        </li>
    </ul>

    <div class="copyright">
        <p>Made by Team 23 <i class="fas fa-heart"></i></p>
        <p>&copy 2021, HaUI</p>
    </div>
</div> 
