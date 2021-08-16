-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th8 16, 2021 lúc 09:32 PM
-- Phiên bản máy phục vụ: 8.0.26-0ubuntu0.20.04.2
-- Phiên bản PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlydetai`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baitap`
--

CREATE TABLE `baitap` (
  `ma_baitap` int NOT NULL,
  `ma_nhom` int NOT NULL,
  `tieude` varchar(256) NOT NULL,
  `noidung` varchar(10000) DEFAULT NULL,
  `ngaydang` datetime DEFAULT CURRENT_TIMESTAMP,
  `hannop` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `baitap`
--

INSERT INTO `baitap` (`ma_baitap`, `ma_nhom`, `tieude`, `noidung`, `ngaydang`, `hannop`) VALUES
(1, 1, 'Nộp báo cáo tiến độ tuần 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi convallis vulputate ligula, ac convallis velit luctus et. Proin eleifend ex sem, eget ornare ipsum imperdiet a.', '2021-08-13 14:09:34', NULL),
(2, 1, 'Nộp báo cáo tiến độ tuần 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi convallis vulputate ligula, ac convallis velit luctus et. Proin eleifend ex sem, eget ornare ipsum imperdiet a.', '2021-08-13 14:09:34', NULL),
(3, 1, 'Nộp báo cáo tiến độ tuần 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi convallis vulputate ligula, ac convallis velit luctus et. Proin eleifend ex sem, eget ornare ipsum imperdiet a.', '2021-08-13 14:09:34', NULL),
(4, 2, 'Tiến độ tuần 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi convallis vulputate ligula, ac convallis velit luctus et. Proin eleifend ex sem, eget ornare ipsum imperdiet a.', '2021-08-13 14:09:34', NULL),
(5, 2, 'Tiến độ tuần 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi convallis vulputate ligula, ac convallis velit luctus et. Proin eleifend ex sem, eget ornare ipsum imperdiet a.', '2021-08-13 14:09:34', NULL),
(6, 4, 'Consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi convallis vulputate ligula, ac convallis velit luctus et. Proin eleifend ex sem, eget ornare ipsum imperdiet a.', '2021-08-13 14:09:34', NULL),
(7, 5, ' Morbi convallis vulputate ligula', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi convallis vulputate ligula, ac convallis velit luctus et. Proin eleifend ex sem, eget ornare ipsum imperdiet a.', '2021-08-13 14:09:34', NULL),
(8, 3, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi convallis vulputate ligula, ac convallis velit luctus et. Proin eleifend ex sem, eget ornare ipsum imperdiet a.', '2021-08-13 14:09:34', NULL);

--
-- Bẫy `baitap`
--
DELIMITER $$
CREATE TRIGGER `tg_baitap_chitietbaitap` AFTER INSERT ON `baitap` FOR EACH ROW INSERT INTO `chitietbaitap`(`ma_baitap`,`ma_sv`) 
SELECT NEW.ma_baitap, ma_sv 
from chitietnhom 
WHERE ma_nhom = NEW.ma_nhom
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietbaitap`
--

CREATE TABLE `chitietbaitap` (
  `ma_chitietbaitap` int NOT NULL,
  `ma_baitap` int NOT NULL,
  `ma_sv` varchar(12) NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `diem` smallint DEFAULT NULL,
  `thoigiannop` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `chitietbaitap`
--

INSERT INTO `chitietbaitap` (`ma_chitietbaitap`, `ma_baitap`, `ma_sv`, `file`, `diem`, `thoigiannop`) VALUES
(1, 1, 'SV2018601856', NULL, NULL, NULL),
(2, 1, 'SV2018603659', NULL, NULL, NULL),
(3, 1, 'SV2018604249', NULL, NULL, NULL),
(4, 2, 'SV2018601856', NULL, NULL, NULL),
(5, 2, 'SV2018603659', NULL, NULL, NULL),
(6, 2, 'SV2018604249', NULL, NULL, NULL),
(7, 3, 'SV2018601856', NULL, NULL, NULL),
(8, 3, 'SV2018603659', NULL, NULL, NULL),
(9, 3, 'SV2018604249', NULL, NULL, NULL),
(10, 4, 'SV2020000123', NULL, NULL, NULL),
(11, 5, 'SV2020000123', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietnhom`
--

CREATE TABLE `chitietnhom` (
  `ma_nhom` int NOT NULL,
  `ma_sv` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `chitietnhom`
--

INSERT INTO `chitietnhom` (`ma_nhom`, `ma_sv`) VALUES
(1, 'SV2018601856'),
(1, 'SV2018603659'),
(1, 'SV2018604249'),
(2, 'SV2020000123');

--
-- Bẫy `chitietnhom`
--
DELIMITER $$
CREATE TRIGGER `tg_chitietnhom_chitietbaitap` AFTER INSERT ON `chitietnhom` FOR EACH ROW INSERT INTO `chitietbaitap`(`ma_baitap`,`ma_sv`) 
SELECT ma_baitap, NEW.ma_sv 
from baitap
WHERE ma_nhom = NEW.ma_nhom
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detai`
--

CREATE TABLE `detai` (
  `ma_detai` int NOT NULL,
  `ma_theloai` int NOT NULL,
  `ma_gv` varchar(12) NOT NULL,
  `ma_sv` varchar(12) NOT NULL,
  `tendetai` varchar(100) DEFAULT NULL,
  `mota` varchar(10000) DEFAULT NULL,
  `hoanthanh` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `detai`
--

INSERT INTO `detai` (`ma_detai`, `ma_theloai`, `ma_gv`, `ma_sv`, `tendetai`, `mota`, `hoanthanh`) VALUES
(1, 8, 'GV2021080010', 'SV2018601856', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Fusce aliquet vitae nunc nec eleifend. Mauris eget orci at urna vestibulum congue. Donec dapibus imperdiet mauris id pulvinar. Aliquam quis dignissim turpis. Nullam ut tincidunt massa. Aliquam tristique tincidunt lobortis.', 0),
(2, 8, 'GV2021080010', 'SV2018603659', 'Morbi convallis vulputate ligula, ac convallis velit luctus et.', 'Phasellus pulvinar rutrum odio accumsan cursus. Etiam quis magna et orci laoreet rutrum ac quis risus. Sed pulvinar, erat at ornare tristique, velit sem rhoncus velit, sed gravida tortor metus non velit.', 0),
(3, 9, 'GV2021080010', 'SV2018604249', 'Proin eleifend ex sem, eget ornare ipsum imperdiet a.', 'Integer in tempus libero, sit amet tincidunt tellus. Integer lacinia vestibulum vulputate. Maecenas cursus leo ut vehicula volutpat. Pellentesque fringilla tortor sit amet neque porttitor, vitae aliquam elit viverra. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent vehicula lectus nec risus laoreet aliquam.', 0),
(4, 4, 'GV2021080011', 'SV2020000123', 'Etiam pulvinar finibus leo ut pharetra. ', 'Donec eu ligula dapibus, rutrum quam vel, finibus diam. Ut ipsum turpis, fermentum non porta feugiat', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaovien`
--

CREATE TABLE `giaovien` (
  `ma_gv` varchar(12) NOT NULL,
  `gioihansinhvien` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `giaovien`
--

INSERT INTO `giaovien` (`ma_gv`, `gioihansinhvien`) VALUES
('GV2021080010', 10),
('GV2021080011', 15),
('GV2021080012', 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoahoc`
--

CREATE TABLE `khoahoc` (
  `ma_khoahoc` int NOT NULL,
  `tenkhoahoc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `khoahoc`
--

INSERT INTO `khoahoc` (`ma_khoahoc`, `tenkhoahoc`) VALUES
(1, 'K13'),
(2, 'K14'),
(3, 'K15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh`
--

CREATE TABLE `nganh` (
  `ma_nganh` int NOT NULL,
  `tennganh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `nganh`
--

INSERT INTO `nganh` (`ma_nganh`, `tennganh`) VALUES
(1, 'Công nghệ thông tin'),
(2, 'Kỹ thuật phần mềm'),
(3, 'Khoa học máy tính'),
(4, 'Hệ thống thông tin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom`
--

CREATE TABLE `nhom` (
  `ma_nhom` int NOT NULL,
  `ma_gv` varchar(12) NOT NULL,
  `tennhom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `nhom`
--

INSERT INTO `nhom` (`ma_nhom`, `ma_gv`, `tennhom`) VALUES
(1, 'GV2021080010', 'N01-KTPM01K13'),
(2, 'GV2021080011', 'N02-KTPM01K13'),
(3, 'GV2021080012', 'N03-KTPM01K13'),
(4, 'GV2021080010', 'N02-KTPM01K13'),
(5, 'GV2021080011', 'N01-KTPM01K15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `ma_sv` varchar(12) NOT NULL,
  `ma_nganh` int NOT NULL,
  `ma_khoahoc` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`ma_sv`, `ma_nganh`, `ma_khoahoc`) VALUES
('SV2018601856', 2, 1),
('SV2018603659', 2, 1),
('SV2018604249', 2, 1),
('SV2020000123', 1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `ma_taikhoan` varchar(12) NOT NULL,
  `matkhau` varchar(256) NOT NULL,
  `loaitaikhoan` tinyint NOT NULL,
  `hoten` varchar(128) NOT NULL,
  `hoatdong` tinyint(1) DEFAULT '1',
  `ngaysinh` date DEFAULT NULL,
  `anh` varchar(100) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `diachi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`ma_taikhoan`, `matkhau`, `loaitaikhoan`, `hoten`, `hoatdong`, `ngaysinh`, `anh`, `email`, `sdt`, `diachi`) VALUES
('AD2021000123', '$2y$10$KD1d9FiZbxVv7HtgcD9ALeRov8PwqCj4xwCi.xGi36RvGLHt9OhGK', 1, 'Admin', 1, '2000-11-18', NULL, 'admin@email.com', '099998888', 'Đại học công nghiệp Hà Nội'),
('GV2021080010', '$2y$10$a36SHIau8hk9aqQuvYwtzuIvmXfkQ/Rxfxiu0vOJMHThT.ARq794S', 2, 'Nguyễn Thu Ngân', 1, NULL, NULL, 'ngan@email.com', '0811112222', 'Bắc Từ Liêm, Hà Nội'),
('GV2021080011', '$2y$10$a36SHIau8hk9aqQuvYwtzuIvmXfkQ/Rxfxiu0vOJMHThT.ARq794S', 2, 'Doãn Hải Giang', 1, NULL, NULL, 'haigiang@email.com', '0922223333', 'Cầu Giấy, Hà Nội'),
('GV2021080012', '$2y$10$wSGaqAdi4xIaUay/5CwXX.8Sm2ZpnnwU.DAVfx54CxnYTVRLUE8S6', 2, 'Nguyễn Văn An', 1, '2000-01-01', NULL, 'a@email.com', '0123456789', 'Hải Dương'),
('SV2018601856', '$2y$10$a36SHIau8hk9aqQuvYwtzuIvmXfkQ/Rxfxiu0vOJMHThT.ARq794S', 3, 'Hoàng Văn Thắng', 1, '2000-11-18', NULL, 'hoangthang@email.com', '099998888', 'Thường Tín, Hà Nội'),
('SV2018603659', '$2y$10$a36SHIau8hk9aqQuvYwtzuIvmXfkQ/Rxfxiu0vOJMHThT.ARq794S', 3, 'Nguyễn Phương Thảo', 1, '2000-01-25', NULL, 'nguyenthao@email.com', '0123456789', 'Đông Anh, Hà Nội'),
('SV2018604249', '$2y$10$a36SHIau8hk9aqQuvYwtzuIvmXfkQ/Rxfxiu0vOJMHThT.ARq794S', 3, 'An Thị Thanh Thảo', 1, '2000-01-01', NULL, 'anthao@email.com', '0912345678', 'Hải Dương'),
('SV2020000123', '$2y$10$wSGaqAdi4xIaUay/5CwXX.8Sm2ZpnnwU.DAVfx54CxnYTVRLUE8S6', 3, 'Nguyễn Thị Bình', 1, '2000-02-02', NULL, 'b@email.com', '0987654321', 'Bắc Ninh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `ma_theloai` int NOT NULL,
  `tentheloai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`ma_theloai`, `tentheloai`) VALUES
(1, 'Khác'),
(3, 'An toàn bảo mật thông tin'),
(4, 'Trí tuệ nhân tạo'),
(5, 'Thiết kế game'),
(6, 'Kiểm thử'),
(7, 'Điện toán đám mây'),
(8, 'Website'),
(9, 'Ứng dụng di động/ máy tính'),
(10, 'Big data');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ykien`
--

CREATE TABLE `ykien` (
  `ma_ykien` int NOT NULL,
  `ma_chitietbaitap` int NOT NULL,
  `ma_taikhoan` varchar(12) NOT NULL,
  `noidung_ykien` varchar(10000) DEFAULT NULL,
  `thoigian_ykien` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `ykien`
--

INSERT INTO `ykien` (`ma_ykien`, `ma_chitietbaitap`, `ma_taikhoan`, `noidung_ykien`, `thoigian_ykien`) VALUES
(1, 1, 'GV2021080010', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', '2021-08-13 15:27:21'),
(2, 1, 'SV2018601856', 'Pellentesque aliquet dolor id velit tincidunt, a luctus odio posuere', '2021-08-13 15:27:57'),
(3, 1, 'GV2021080010', 'Donec vitae nulla sed leo luctus placerat eget eu velit', '2021-08-13 15:28:27'),
(4, 2, 'GV2021080010', 'Vestibulum congue nisi in ligula pretium, eget sodales dui vulputate. ', '2021-08-13 15:29:03'),
(5, 2, 'SV2018603659', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. ', '2021-08-13 15:29:25');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baitap`
--
ALTER TABLE `baitap`
  ADD PRIMARY KEY (`ma_baitap`),
  ADD KEY `fk_baitap_nhom` (`ma_nhom`);

--
-- Chỉ mục cho bảng `chitietbaitap`
--
ALTER TABLE `chitietbaitap`
  ADD PRIMARY KEY (`ma_chitietbaitap`),
  ADD UNIQUE KEY `ma_baitap` (`ma_baitap`,`ma_sv`),
  ADD KEY `fk_chitietbaitap_baitap` (`ma_baitap`),
  ADD KEY `fk_chitietbaitap_sinhvien` (`ma_sv`);

--
-- Chỉ mục cho bảng `chitietnhom`
--
ALTER TABLE `chitietnhom`
  ADD PRIMARY KEY (`ma_nhom`,`ma_sv`),
  ADD KEY `fk_chitietnhom_sinhvien` (`ma_sv`);

--
-- Chỉ mục cho bảng `detai`
--
ALTER TABLE `detai`
  ADD PRIMARY KEY (`ma_detai`),
  ADD KEY `fk_detai_theloai` (`ma_theloai`),
  ADD KEY `fk_detai_giaovien` (`ma_gv`),
  ADD KEY `fk_detai_sinhvien` (`ma_sv`);

--
-- Chỉ mục cho bảng `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`ma_gv`);

--
-- Chỉ mục cho bảng `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`ma_khoahoc`);

--
-- Chỉ mục cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`ma_nganh`);

--
-- Chỉ mục cho bảng `nhom`
--
ALTER TABLE `nhom`
  ADD PRIMARY KEY (`ma_nhom`),
  ADD KEY `fk_nhom_giaovien` (`ma_gv`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`ma_sv`),
  ADD KEY `fk_sinhvien_nganh` (`ma_nganh`),
  ADD KEY `fk_sinhvien_khoahoc` (`ma_khoahoc`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`ma_taikhoan`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`ma_theloai`);

--
-- Chỉ mục cho bảng `ykien`
--
ALTER TABLE `ykien`
  ADD PRIMARY KEY (`ma_ykien`),
  ADD KEY `fk_ykien_baitap` (`ma_chitietbaitap`),
  ADD KEY `fk_ykien_taikhoan` (`ma_taikhoan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baitap`
--
ALTER TABLE `baitap`
  MODIFY `ma_baitap` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `chitietbaitap`
--
ALTER TABLE `chitietbaitap`
  MODIFY `ma_chitietbaitap` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `detai`
--
ALTER TABLE `detai`
  MODIFY `ma_detai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `khoahoc`
--
ALTER TABLE `khoahoc`
  MODIFY `ma_khoahoc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nganh`
--
ALTER TABLE `nganh`
  MODIFY `ma_nganh` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nhom`
--
ALTER TABLE `nhom`
  MODIFY `ma_nhom` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `ma_theloai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `ykien`
--
ALTER TABLE `ykien`
  MODIFY `ma_ykien` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `baitap`
--
ALTER TABLE `baitap`
  ADD CONSTRAINT `fk_baitap_nhom` FOREIGN KEY (`ma_nhom`) REFERENCES `nhom` (`ma_nhom`);

--
-- Các ràng buộc cho bảng `chitietbaitap`
--
ALTER TABLE `chitietbaitap`
  ADD CONSTRAINT `fk_chitietbaitap_baitap` FOREIGN KEY (`ma_baitap`) REFERENCES `baitap` (`ma_baitap`),
  ADD CONSTRAINT `fk_chitietbaitap_sinhvien` FOREIGN KEY (`ma_sv`) REFERENCES `sinhvien` (`ma_sv`);

--
-- Các ràng buộc cho bảng `chitietnhom`
--
ALTER TABLE `chitietnhom`
  ADD CONSTRAINT `fk_chitietnhom_nhom` FOREIGN KEY (`ma_nhom`) REFERENCES `nhom` (`ma_nhom`),
  ADD CONSTRAINT `fk_chitietnhom_sinhvien` FOREIGN KEY (`ma_sv`) REFERENCES `sinhvien` (`ma_sv`);

--
-- Các ràng buộc cho bảng `detai`
--
ALTER TABLE `detai`
  ADD CONSTRAINT `fk_detai_giaovien` FOREIGN KEY (`ma_gv`) REFERENCES `giaovien` (`ma_gv`),
  ADD CONSTRAINT `fk_detai_sinhvien` FOREIGN KEY (`ma_sv`) REFERENCES `sinhvien` (`ma_sv`),
  ADD CONSTRAINT `fk_detai_theloai` FOREIGN KEY (`ma_theloai`) REFERENCES `theloai` (`ma_theloai`);

--
-- Các ràng buộc cho bảng `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `fk_giaovien_taikhoan` FOREIGN KEY (`ma_gv`) REFERENCES `taikhoan` (`ma_taikhoan`);

--
-- Các ràng buộc cho bảng `nhom`
--
ALTER TABLE `nhom`
  ADD CONSTRAINT `fk_nhom_giaovien` FOREIGN KEY (`ma_gv`) REFERENCES `giaovien` (`ma_gv`);

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `fk_sinhvien_khoahoc` FOREIGN KEY (`ma_khoahoc`) REFERENCES `khoahoc` (`ma_khoahoc`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_sinhvien_nganh` FOREIGN KEY (`ma_nganh`) REFERENCES `nganh` (`ma_nganh`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_sinhvien_taikhoan` FOREIGN KEY (`ma_sv`) REFERENCES `taikhoan` (`ma_taikhoan`);

--
-- Các ràng buộc cho bảng `ykien`
--
ALTER TABLE `ykien`
  ADD CONSTRAINT `fk_ykien_baitap` FOREIGN KEY (`ma_chitietbaitap`) REFERENCES `chitietbaitap` (`ma_chitietbaitap`),
  ADD CONSTRAINT `fk_ykien_taikhoan` FOREIGN KEY (`ma_taikhoan`) REFERENCES `taikhoan` (`ma_taikhoan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
