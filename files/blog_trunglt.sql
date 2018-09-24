-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 24, 2018 lúc 08:45 AM
-- Phiên bản máy phục vụ: 10.1.31-MariaDB
-- Phiên bản PHP: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `blog_trunglt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `username`, `name`, `avatar`, `intro`, `background`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'admin1', 'upload/admins/avatar.JPG', NULL, NULL, 'lamthanhtrung706@gmail.com', NULL, '$2y$10$P7w1M6gI9zn9Gpp8BFlBguRsyezncFpvEa/p2i81BlgfAVwC9VTMC', 0, 'kmbcJX6Z4PyBbcLjBvvkys0GrZcEwc2ucowSunHn4yfyNcbEJqIwDp93a2Yf', '2018-09-21 03:05:52', '2018-09-23 14:26:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baiviets`
--

CREATE TABLE `baiviets` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `important` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baiviets`
--

INSERT INTO `baiviets` (`id`, `id_danhmuc`, `username`, `slug`, `name`, `intro`, `background`, `content`, `thumn`, `view`, `like`, `status`, `keyword`, `important`, `created_at`, `updated_at`, `rating`) VALUES
(1, 1, 'admin1', 'bai-viet-1', 'There are many variations of passages of Lorem Ipsum available, but the majority have', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'upload/baiviets/1.JPG', 57, 0, 1, 'news 1; Trunglt; my blog', 0, '2018-09-21 03:05:52', '2018-09-24 04:49:19', 3),
(2, 1, 'admin1', 'bai-viet-2', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'upload/baiviets/2.JPG', 11, 1, 1, 'news 2', 0, '2018-09-21 03:05:52', '2018-09-22 15:25:48', 5),
(3, 2, 'admin1', 'bai-viet-3', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'upload/baiviets/3.JPG', 30, 0, 1, 'news 3', 0, '2018-09-21 03:05:52', '2018-09-24 04:49:41', 4),
(4, 2, 'admin1', 'bai-viet-4', 'It is a long established fact that a reader will be distracted by the readable', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'upload/baiviets/4.JPG', 2, 0, 1, 'news 4', 0, '2018-09-21 03:05:52', '2018-09-22 04:20:52', 3),
(5, 3, 'admin1', 'bai-viet-5', 'Replication For Dummies 4 Easy Steps To Professional DVD', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'upload/baiviets/5.JPG', 4, 0, 1, 'news 5', 0, '2018-09-21 03:05:52', '2018-09-22 08:41:15', 3),
(6, 4, 'admin1', 'bai-viet-6', 'Health & Fitness Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', 'upload/baiviets/6.JPG', 3, 0, 1, 'news 6', 1, '2018-09-21 03:05:52', '2018-09-22 08:50:29', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cauhinhchungs`
--

CREATE TABLE `cauhinhchungs` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cauhinhchungs`
--

INSERT INTO `cauhinhchungs` (`id`, `slug`, `name`, `intro`, `value`, `created_at`, `updated_at`) VALUES
(1, 'ten-website', 'Tên website', 'Tên hiển thị của website', 'TrungLT706 - My Blog', '2018-09-21 03:05:52', NULL),
(2, 'tagline-website', 'Tagline website', 'Tagline hiển thị của website', 'Tâm sự đời tôi', '2018-09-21 03:05:52', NULL),
(3, 'logo-website', 'Logo website', 'Logo hiển thị của website', 'image/system/my-logo.png', '2018-09-21 03:05:52', NULL),
(4, 'keyword-website', 'SEO keyword', 'SEO keyword', 'TrungLT, TrungLT706, Vlog, My Blog, đời tôi', '2018-09-21 03:05:52', NULL),
(5, 'intro-website', 'SEO intro', 'SEO intro', 'Website giới thiệu về cuộc đời tôi', '2018-09-21 03:05:52', NULL),
(6, 'link-facebook', 'Link Facebook', 'Link Facebook', 'https://fb.com/trunglt706', '2018-09-21 03:05:52', NULL),
(7, 'email-website', 'Email website', 'Email hiển thị của website', 'lamthanhtrung706@gmail.com', '2018-09-21 03:05:52', NULL),
(8, 'link-youtube', 'Link Youtube', 'Link Youtube', '', '2018-09-21 03:05:52', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmucbaiviets`
--

CREATE TABLE `danhmucbaiviets` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmucbaiviets`
--

INSERT INTO `danhmucbaiviets` (`id`, `slug`, `name`, `intro`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tam-su-cua-toi', 'Tâm sự của tôi', 'Các bài viết về tâm sự của tôi', 1, '2018-09-21 03:05:52', NULL),
(2, 'am-thuc', 'Ẩm thực cùng tôi', 'Các bài viết về ẩm thực của tôi', 1, '2018-09-21 03:05:52', NULL),
(3, 'am-nhac', 'Âm nhạc của tôi', 'Các bài viết về âm nhạc của tôi', 1, '2018-09-21 03:05:52', NULL),
(4, 'du-lich', 'Du lịch cùng tôi', 'Các bài viết về các chuyến du lịch của tôi', 1, '2018-09-21 03:05:52', NULL),
(5, 'tinh-yeu', 'Tình yêu của tôi', 'Các bài viết về tình yêu của tôi', 1, '2018-09-21 03:05:52', NULL),
(6, 'hoc-tap', 'Học vấn của tôi', 'Các bài viết về học vấn của tôi', 1, '2018-09-21 03:05:52', NULL),
(7, 'goc-thien-nguyen', 'Góc thiện nguyện', 'Tổng hợp các bài viết về các hoạt động thiện nguyện', 1, '2018-09-21 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gopys`
--

CREATE TABLE `gopys` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoidaps`
--

CREATE TABLE `hoidaps` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoidaps`
--

INSERT INTO `hoidaps` (`id`, `name`, `intro`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Frequently Asked Question #1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '1', '2018-09-21 03:59:20', NULL),
(2, 'Frequently Asked Question #2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, '1', '2018-09-21 03:59:20', NULL),
(3, 'Frequently Asked Question #3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, '1', '2018-09-21 03:59:20', NULL),
(4, 'Frequently Asked Question #4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 4, '1', '2018-09-21 03:59:20', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhes`
--

CREATE TABLE `lienhes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhes`
--

INSERT INTO `lienhes` (`id`, `name`, `email`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Thành Trung', 'trunglt@kdata.vn', 'Test', 0, '2018-09-22 08:24:35', '2018-09-22 08:24:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaithanhviens`
--

CREATE TABLE `loaithanhviens` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `mark` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaithanhviens`
--

INSERT INTO `loaithanhviens` (`id`, `slug`, `name`, `intro`, `mark`, `status`, `created_at`, `updated_at`, `logo`) VALUES
(1, 'member-vang', 'Thành viên vàng', 'Thành viên vàng', 0, 1, '2018-09-21 03:05:52', NULL, NULL),
(2, 'member-bac', 'Thành viên bạc', 'Thành viên bạc', 0, 1, '2018-09-21 03:05:52', NULL, NULL),
(3, 'member-dong', 'Thành viên đồng', 'Thành viên đồng', 0, 1, '2018-09-21 03:05:52', NULL, NULL),
(4, 'member-chuan', 'Thành viên chuẩn', 'Thành viên chuẩn', 0, 1, '2018-09-21 03:05:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(78, '2014_10_12_000000_create_users_table', 1),
(79, '2014_10_12_100000_create_password_resets_table', 1),
(80, '2018_09_17_113741_table_danhmucbaiviet', 1),
(81, '2018_09_17_113823_table_baiviet', 1),
(82, '2018_09_17_113837_table_admin', 1),
(83, '2018_09_17_113851_table_loaithanhvien', 1),
(84, '2018_09_17_113906_table_research', 1),
(85, '2018_09_17_113919_table_phanhoi', 1),
(86, '2018_09_17_113932_table_gopy', 1),
(87, '2018_09_17_113946_table_nhanbaiviet', 1),
(88, '2018_09_17_114000_table_cauhinhchung', 1),
(89, '2018_09_17_114017_table_visitors', 1),
(90, '2018_09_18_114230_add_column_active_code_user', 1),
(91, '2018_09_18_114414_add_column_logo_loai_thanh_vien', 1),
(93, '2018_09_21_094457_table_advs', 2),
(95, '2018_09_21_105356_table_hoidap', 3),
(97, '2018_09_21_232717_table_lien_he', 4),
(98, '2018_09_22_093122_add_column_rating_bai_viet', 5),
(100, '2018_09_22_101231_add_column_name_phan_hoi', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanbaiviets`
--

CREATE TABLE `nhanbaiviets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanhois`
--

CREATE TABLE `phanhois` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_baiviet` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phanhois`
--

INSERT INTO `phanhois` (`id`, `id_baiviet`, `email`, `content`, `created_at`, `updated_at`, `name`, `status`) VALUES
(1, 3, 'demo@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?', '2018-09-21 17:00:00', NULL, 'MOZAMMEL HOQUE', 1),
(2, 3, 'demo1@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?', '2018-09-23 17:00:00', NULL, 'TAHMINA AKTHR', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quangcaos`
--

CREATE TABLE `quangcaos` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quangcaos`
--

INSERT INTO `quangcaos` (`id`, `slug`, `name`, `intro`, `photo`, `link`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'advs-1', 'Quảng cáo 1', 'Quảng cáo 1', 'upload/quangcaos/1.JPG', '', 1, '1', '2018-09-21 03:05:52', NULL),
(2, 'advs-2', 'Quảng cáo 2', 'Quảng cáo 2', 'upload/quangcaos/2.JPG', '', 2, '1', '2018-09-21 03:05:52', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `researchs`
--

CREATE TABLE `researchs` (
  `id` int(10) UNSIGNED NOT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_loaithanhvien` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_code` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `id_loaithanhvien`, `username`, `name`, `avatar`, `intro`, `background`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `active_code`) VALUES
(1, 1, 'user1', 'user1', NULL, NULL, NULL, 'lamthanhtrung706@gmail.com', NULL, '$2y$10$sRuDDKMB/jylq6MRskqfhODgBInP6EXi71ZgCILbGLayClGX4KY/q', 0, NULL, '2018-09-21 03:05:52', '2018-09-21 03:05:52', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_time_activation` datetime DEFAULT NULL,
  `accessing_count` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `last_time_accessing` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `visitors`
--

INSERT INTO `visitors` (`id`, `ip`, `device`, `last_time_activation`, `accessing_count`, `last_time_accessing`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/72.4.208 Chrome/66.4.3359.208 Safari/537.36', NULL, '0', '2018-09-20 02:55:24', NULL, NULL),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', NULL, '0', '2018-09-22 06:53:48', NULL, NULL),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/72.4.208 Chrome/66.4.3359.208 Safari/537.36', NULL, '0', '2018-09-24 06:40:26', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Chỉ mục cho bảng `baiviets`
--
ALTER TABLE `baiviets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `baiviets_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `cauhinhchungs`
--
ALTER TABLE `cauhinhchungs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cauhinhchungs_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `danhmucbaiviets`
--
ALTER TABLE `danhmucbaiviets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `danhmucbaiviets_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `gopys`
--
ALTER TABLE `gopys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hoidaps`
--
ALTER TABLE `hoidaps`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lienhes`
--
ALTER TABLE `lienhes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loaithanhviens`
--
ALTER TABLE `loaithanhviens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loaithanhviens_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhanbaiviets`
--
ALTER TABLE `nhanbaiviets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `phanhois`
--
ALTER TABLE `phanhois`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `quangcaos`
--
ALTER TABLE `quangcaos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quangcaos_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `researchs`
--
ALTER TABLE `researchs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `baiviets`
--
ALTER TABLE `baiviets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cauhinhchungs`
--
ALTER TABLE `cauhinhchungs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `danhmucbaiviets`
--
ALTER TABLE `danhmucbaiviets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `gopys`
--
ALTER TABLE `gopys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoidaps`
--
ALTER TABLE `hoidaps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `lienhes`
--
ALTER TABLE `lienhes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `loaithanhviens`
--
ALTER TABLE `loaithanhviens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT cho bảng `nhanbaiviets`
--
ALTER TABLE `nhanbaiviets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phanhois`
--
ALTER TABLE `phanhois`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `quangcaos`
--
ALTER TABLE `quangcaos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `researchs`
--
ALTER TABLE `researchs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
