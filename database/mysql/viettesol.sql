-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 14, 2019 lúc 07:13 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `viettesol`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `conference_id` int(11) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text CHARACTER SET utf8,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `affiliation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `middle_name`, `last_name`, `affiliation`, `site_url`, `email`, `country`, `created_at`, `updated_at`) VALUES
(2, 'Thang1', NULL, 'Nguyễn', 'HUST', NULL, 'thang111@gmail.com', 'Viet Nam', '2019-03-19 07:10:23', '2019-03-19 07:10:23'),
(4, 'Trang', 'Thi', 'Vu', 'HVTC', 'https://www.facebook.com/hvtc.trangvu98', 'hvtc.trangvu98@gmail.com', 'Viet Nam', '2019-04-01 06:56:41', '2019-04-02 06:44:52'),
(5, 'Phu', 'Van', 'Doan', 'HUST', 'https://www.facebook.com/doanphua4', 'doanphua4@gmail.com', 'Argentina', '2019-04-02 04:42:07', '2019-04-02 06:49:49'),
(6, 'Thang', 'Van', 'Nguyen', 'HUST', NULL, 'doanphua45@gmail.com', 'Vanuatu', '2019-04-02 04:50:22', '2019-04-02 07:01:42'),
(8, 'ddd', 'ddd', 'ddd', 'ddd', 'dd', 'dd@gmail', 'Afghanistan', '2019-04-04 08:47:08', '2019-04-04 08:47:08'),
(9, 'Cong', 'Minh', 'Nguyen', 'HUST', 'https://www.facebook.com/doanphua4', 'doanphua4@gmail.com', 'Viet Nam', '2019-04-04 08:55:53', '2019-04-04 08:55:53'),
(10, 'Thang', 'Van', 'Nguyen', 'HUST', NULL, 'admin@gmail.com', 'Viet Nam', '2019-04-06 06:31:16', '2019-04-06 06:31:16'),
(11, 'director', 'director', 'director', 'HUST', NULL, 'trackdirector01@gmail.com', NULL, '2019-04-22 03:39:37', '2019-04-22 03:39:37'),
(12, 'Author', 'Author', 'Author', 'HUST', NULL, 'author@gmail.com', 'Viet Nam', '2019-05-19 11:58:31', '2019-05-19 11:58:31'),
(13, 'Tác giả 1', 'Author', 'Author', 'HUST', NULL, 'tacgiahoithao@gmail.com', 'Afghanistan', '2019-05-19 12:11:25', '2019-05-19 12:11:25'),
(14, 'author', NULL, '002', 'HUST', NULL, 'author02@gmail.com', NULL, '2019-05-19 13:29:20', '2019-05-19 13:29:20'),
(15, 'Thang', 'nguyen', 'than', 'GG', 'GGG', 'thang@gmail.com', 'Viet Nam', '2019-05-27 08:47:28', '2019-05-27 08:47:28'),
(16, 'NGuyen', 'Van', 'A', 'HUST', 'vana', 'vana@gmail.com', 'Viet Nam', '2019-05-30 11:10:39', '2019-05-30 11:10:39'),
(17, 'Thang', 'NGuyen', 'Van', 'HUST', NULL, 'thang123@gmail.com', 'Viet Nam', '2019-05-30 11:13:39', '2019-05-30 11:13:39'),
(18, 'BB', 'BB', 'BBB', 'BBB', 'BB', 'BB@gmail.com', 'Afghanistan', '2019-06-05 07:55:36', '2019-06-05 07:55:36'),
(19, 'user', NULL, '001', 'HUST', NULL, 'user001@gmail.com', NULL, '2019-06-05 08:01:44', '2019-06-05 08:01:44'),
(20, 'user', NULL, '002', 'HUSST', NULL, 'user123444@gmail.com', 'Bosnia and Herzegovina', '2019-06-05 08:02:36', '2019-06-05 08:02:36'),
(21, 'User', '00', '2', 'HUST', NULL, 'user002@gmail.com', 'Viet Nam', '2019-06-11 07:07:16', '2019-06-11 07:07:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `title`, `url`, `created_at`, `updated_at`) VALUES
(1, 'VV', 'http://viettesol-dev.local/upload/banner\\347519313-1553408625211-logo_hust.png', '2019-05-02 05:03:24', '2019-05-02 05:03:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `abbrev` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `conference_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `description`, `abbrev`, `conference_id`, `updated_at`, `created_at`) VALUES
(1, 'B1', 'Tòa B1', 'B1', 6, '2019-05-18 11:31:22', '2019-03-20 07:23:15'),
(2, 'BBB', 'BBB', 'BBB', 5, '2019-03-20 15:41:11', '2019-03-20 15:41:11'),
(3, 'B', 'B', 'B', 1, '2019-05-02 06:18:55', '2019-05-02 06:18:55'),
(4, 'B1', 'G', 'B1', 1, '2019-05-14 04:50:02', '2019-05-14 04:50:02'),
(5, 'A1', 'Tòa A1', 'A1', 6, '2019-05-18 11:31:14', '2019-05-18 11:31:06'),
(6, 'B2', NULL, 'B2', 6, '2019-05-18 11:34:57', '2019-05-18 11:34:57'),
(7, 'B5', NULL, 'B5', 6, '2019-05-18 11:39:00', '2019-05-18 11:39:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `new_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conferences`
--

CREATE TABLE `conferences` (
  `id` int(11) NOT NULL,
  `slogan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `venue` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `attach_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `review_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'double_blind',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conference_gallery`
--

CREATE TABLE `conference_gallery` (
  `id` int(11) NOT NULL,
  `conference_id` int(11) NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `conference_gallery`
--

INSERT INTO `conference_gallery` (`id`, `conference_id`, `image_url`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 1, 'conference_gallery/GCjBVGwHSy4HeqA0xaQu17noDAzdNCHcR3dCGNwR.png', 5, '2019-03-30 07:32:35', '2019-03-30 07:32:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conference_partners_sponsers`
--

CREATE TABLE `conference_partners_sponsers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET armscii8 NOT NULL,
  `description` text CHARACTER SET armscii8,
  `logo` text CHARACTER SET armscii8 NOT NULL,
  `type` varchar(45) CHARACTER SET armscii8 NOT NULL,
  `conference_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conference_permissions`
--

CREATE TABLE `conference_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `conference_permissions`
--

INSERT INTO `conference_permissions` (`id`, `name`, `description`) VALUES
(6, 'update-track', NULL),
(7, 'create-track', NULL),
(8, 'delete-track', NULL),
(9, 'view-track', NULL),
(10, 'view-session-type', NULL),
(11, 'create-session-type', NULL),
(12, 'update-session-type', NULL),
(13, 'delete-session-type', NULL),
(14, 'send-paper', NULL),
(15, 'view-conference-timeline', 'Quyền xem conference time line'),
(16, 'update-conference-timeline', 'Cập nhật thông tin timeline'),
(17, 'create-conference-timeline', 'Tạo Conference Time Line'),
(18, 'view-announcement', NULL),
(19, 'create-announcement', 'tạo thông cáo cho hội thảo'),
(20, 'update-announcement', NULL),
(21, 'delete-announcement', NULL),
(22, 'view-review-form', NULL),
(23, 'create-review-form', NULL),
(24, 'update-review-form', NULL),
(25, 'delete-review-form', NULL),
(26, 'view-conference-partner-sponser', NULL),
(27, 'create-conference-partner-sponser', NULL),
(28, 'update-conference-partner-sponser', NULL),
(29, 'delete-conference-partner-sponser', NULL),
(30, 'view-paper-file', NULL),
(31, 'view-conference-gallery', NULL),
(32, 'create-conference-gallery', NULL),
(33, 'delete-conference-gallery', NULL),
(34, 'view-time-block', 'quyền xem danh sách và chi tiết'),
(35, 'create-time-block', NULL),
(36, 'update-time-block', NULL),
(37, 'delete-time-block', NULL),
(38, 'view-fee', NULL),
(39, 'create-fee', NULL),
(40, 'update-fee', NULL),
(41, 'delete-fee', NULL),
(42, 'view-prepair-email', NULL),
(43, 'send-prepair-email', NULL),
(44, 'view-paper', NULL),
(45, 'view-paper-author', NULL),
(46, 'view-schedule', NULL),
(47, 'create-schedule', NULL),
(48, 'delete-schedule', NULL),
(49, 'view-building', NULL),
(50, 'create-building', NULL),
(51, 'update-building', NULL),
(52, 'delete-building', NULL),
(53, 'view-room', NULL),
(54, 'create-room', NULL),
(55, 'update-room', NULL),
(56, 'delete-room', NULL),
(57, 'view-special-event', NULL),
(58, 'create-special-event', NULL),
(59, 'update-special-event', NULL),
(60, 'delete-special-event', NULL),
(61, 'view-calendar-for-paper', NULL),
(62, 'view-calendar-for-conference', NULL),
(63, 'view-conference-role', NULL),
(64, 'create-conference-role', NULL),
(65, 'update-conference-role', NULL),
(66, 'delete-conference-role', NULL),
(67, 'view-user-conference-role', NULL),
(68, 'update-user-conference-role', NULL),
(69, 'view-conference-permission', NULL),
(70, 'create-conference-permission', NULL),
(71, 'update-conference-permission', NULL),
(72, 'view-set-up-conference-permission', NULL),
(73, 'set-up-conference-permission', NULL),
(74, 'view-register-conference', NULL),
(75, 'update-register-conference', NULL),
(76, 'view-reviewer-criterial', NULL),
(77, 'view-reviewer', NULL),
(78, 'view-paper-un-schedule', NULL),
(79, 'update-paper', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conference_roles`
--

CREATE TABLE `conference_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conference_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conference_roles_permissions`
--

CREATE TABLE `conference_roles_permissions` (
  `id` int(11) NOT NULL,
  `conference_role_id` int(11) NOT NULL,
  `conference_permission_id` int(11) NOT NULL,
  `allowed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `conference_timeline`
--

CREATE TABLE `conference_timeline` (
  `id` int(11) NOT NULL,
  `conference_id` int(11) NOT NULL,
  `author_registration_opened` date NOT NULL,
  `author_registration_closed` date NOT NULL,
  `submission_accepted` date NOT NULL,
  `submission_closed` date NOT NULL,
  `reviewer_registration_opened` date NOT NULL,
  `reviewer_registration_closed` date NOT NULL,
  `review_deadline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `first_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organize_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `type_id`, `first_name`, `last_name`, `middle_name`, `organize_name`, `address`, `email`, `phone`, `fax`, `country`, `website`, `note`, `updated_at`, `created_at`) VALUES
(1, 1, 'Alejd', 'adf', 'adf', NULL, 'adkjfjk', 'nguyenvanthang@gmail.com', '02020212', NULL, 'viet nam', NULL, NULL, '2019-03-11 21:27:19', '2019-03-11 21:27:19'),
(10, 1, 'Nam', 'Tống', 'Hoàng', NULL, 'Hanoi', 'nam.th.200698@gmail.com', '0968319013', NULL, 'Viet Nam', NULL, NULL, '2019-06-01 10:26:04', '2019-06-01 10:26:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_type`
--

CREATE TABLE `contact_type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_type`
--

INSERT INTO `contact_type` (`id`, `name`, `description`, `updated_at`, `created_at`) VALUES
(1, 'Individual', 'A person.', '2019-03-11 21:26:20', '2019-03-11 21:26:20'),
(2, 'Organization', '', '2019-03-11 21:26:33', '2019-03-11 21:26:33'),
(3, 'Group', '', '2019-04-22 23:41:40', '2019-04-22 23:41:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contributions`
--

CREATE TABLE `contributions` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `unit` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `received` datetime NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `criteria_review`
--

CREATE TABLE `criteria_review` (
  `id` int(11) NOT NULL,
  `review_form_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `possible_values` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `venue` text COLLATE utf8_unicode_ci NOT NULL,
  `trainer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fee` float NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `short_content` text COLLATE utf8_unicode_ci,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `last_updated_by` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `event_categories`
--

CREATE TABLE `event_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `event_category_links`
--

CREATE TABLE `event_category_links` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `event_registation`
--

CREATE TABLE `event_registation` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `affiliation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `highest_degree` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_notify` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  `extra` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `event_registration_form_criteria`
--

CREATE TABLE `event_registration_form_criteria` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `possible_values` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `category` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `time` date NOT NULL,
  `price_before_time` int(11) NOT NULL,
  `price_after_time` int(11) NOT NULL,
  `conference_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `mscode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_paid` int(11) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `membership`
--

INSERT INTO `membership` (`id`, `contact_id`, `type_id`, `mscode`, `start_date`, `end_date`, `is_paid`, `updated_at`, `created_at`) VALUES
(1, 1, 2, 'VTSM6VMM82', '2019-04-28', '2019-04-30', 0, '2019-04-13 08:41:01', '2019-04-13 08:41:01'),
(8, 10, 1, 'VTSYM0FGBI', '2019-06-02', '2019-07-06', 0, '2019-06-01 10:26:05', '2019-06-01 10:26:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `membership_types`
--

CREATE TABLE `membership_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `fee` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `membership_types`
--

INSERT INTO `membership_types` (`id`, `name`, `description`, `fee`, `created_at`, `updated_at`) VALUES
(1, 'Normal', NULL, 100000, '2019-06-02 01:32:59', '0000-00-00 00:00:00'),
(2, 'Premium', NULL, 250000, '2019-06-02 01:33:07', '0000-00-00 00:00:00'),
(3, 'Elite', NULL, 500000, '2019-06-02 01:33:26', '2019-04-13 10:44:07'),
(4, 'Golden', NULL, 150000, '2019-06-02 01:33:32', '2019-05-28 02:09:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `member_payment`
--

CREATE TABLE `member_payment` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `unit` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `received` datetime NOT NULL,
  `paied_for` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method_id` int(11) NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `parent_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `name`, `url`, `description`, `created_by`, `parent_id`, `updated_at`, `created_at`) VALUES
(2, 'SOICT 2019 Conference', 'http://viettesol-dev.test/conference/soict2019/home', 'SOICT', 1, NULL, '2019-06-05 05:53:30', '2019-06-05 05:51:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `last_updated_by` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft' COMMENT 'Mặc định là draft, khi trạng thái là published thì sẽ hiển thị ra cho người dùng nhìn thấy.',
  `short_content` text COLLATE utf8_unicode_ci,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `body`, `slug`, `tags`, `last_updated_by`, `created_by`, `status`, `short_content`, `updated_at`, `created_at`) VALUES
(5, 'VietTESOL hosts workshop to encourage teachers to present at conferences', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\">To help teachers successfully write abstract proposals for VietTESOL Convention and other conferences, on July 12th, 2018, Hanoi University of Industry hosted a workshop entitled <em>“Writing an abstract proposal for VietTESOL Convention and other conferences”.</em> The workshop was conducted by Dr. Hoang Thi Hanh from the University of Languages and International Studies, VNU Hanoi.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><img src=\"https://viettesolassociation.org/images/14.7.1.1.gif\" width=\"457\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-left: auto; margin-right: auto; margin-top: 5px !important;\"></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\">The purpose of the workshop was to bring together teachers of English to overcome difficulties in writing an abstract for VietTESOL Convention and other conferences. Dr. Hoang Thi Hanh presented the importance of writing abstract with great emphasis on the types, structures and the guiding components for writing abstracts. The 52 workshop participants, who came from different organizations, institutions, and universities, were equipped with <em>learning about and identifying opportunities for</em><em>reviewing</em><em>, improving and implementing basic</em><em> components for</em><em> abstract writing</em><em> skills then submitting successfully</em><em> their</em><em>conference abstracts as well as research papers</em>.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><img src=\"https://viettesolassociation.org/images/anh-14.7.2.jpg\" alt=\"\" width=\"457\" height=\"304\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-left: auto; margin-right: auto; margin-top: 5px !important;\"></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\">The balance of the day consisted of interactive small groups and plenary discussions which focused on 1) identifying Descriptive and Informative conference abstracts; 2) analyzing structures and basic components of abstracts, and 3) writing Descriptive and Informative conference abstracts basing on guiding questions and basic components.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><img src=\"https://viettesolassociation.org/images/anh-14.7.3.jpg\" alt=\"\" width=\"488\" height=\"325\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-left: auto; margin-right: auto; margin-top: 5px !important;\"></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\">Dr. Hanh also guided the basic practice on abstracts based on what has been presented and asked the participants to divide themselves into small groups, with each group then peered and commented on the written abstract of the others’, and discussed whether or not the abstracts matched the criteria that she mentioned. Participants then shared their own of abstracts, asked and reviewed from the comments and guidance contributed by Dr. Hanh and other participants.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><img src=\"https://viettesolassociation.org/images/anh-14.7.4.4.jpg\" alt=\"\" width=\"542\" height=\"361\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-left: auto; margin-right: auto; margin-top: 5px !important;\"></p>', 'viettesol-hosts-workshop-to-encourage-teachers-to-present-at-conferences', '[\"About VTA\",\"news\"]', 2, 2, 'published', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\">To help teachers successfully write abstract proposals for VietTESOL Convention and other conferences, on July 12th, 2018, Hanoi University of Industry hosted a workshop entitled <em>“Writing an abstract proposal for VietTESOL Convention and other conferences”.</em> The workshop was conducted by Dr. Hoang Thi Hanh from the University of Languages and International Studies, VNU Hanoi.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><img src=\"https://viettesolassociation.org/images/14.7.1.1.gif\" width=\"457\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-left: auto; margin-right: auto; margin-top: 5px !important;\"></p>', '2019-03-08 16:14:32', '2019-03-08 15:33:19'),
(6, 'VietTESOL Association Officially Launched', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"><span style=\"font-family: Arial, serif;\"><b>Vietnam Association of English Language Teaching and Research (also known as VieTESOL Association) was officially launched on July 11, 2018 at a ceremony hosted by the</b></span><span style=\"font-family: Arial, serif;\"><b> University of Language and International Studies, Vietnam National University, Hanoi (ULIS – VNU).</b></span></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> <img src=\"https://viettesolassociation.org/images/anhchihanh.gif\" alt=\"\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-left: auto; margin-right: auto; margin-top: 5px !important;\"></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: center;\"><span style=\"font-family: Arial, serif;\"><i>VietTESOL Board of Directors and members</i></span></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"><span style=\"font-family: Arial, serif;\">VieTESOL Association, an affiliation of The Linguistics Society of Vietnam, is an professional social organization to support all English teachers at all levels, from primary school to higher educations in all around Vietnam, for the domestic and international researchers and experts in language teaching field.</span></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"><span style=\"font-family: Arial, serif;\">VieTESOL Association was established based on the knowledgeable foundation and reliable expertise in teaching and researching the English language in Vietnam with its professional operations to create more opportunities for members’ continuing education as well as to build a diverse, inclusive and equal TESOL community of practice for members in English language teaching and research in Vietnam.</span></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"><span style=\"font-family: Arial, serif;\">Moreover, all the members of the temporary Board of Directors of VieTESOL Association, who are currently the managers and experts from 15 prestigious institutions in the whole country, will represent for the association members in Vietnam and abroad until the association has enough numbers of members to organize the Association Congress and vote for the official Board of Directors.</span></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"><span style=\"font-family: Arial, serif;\">Speaking on behalf of the temporary Board of Directors of VieTESOL Association, Prof. Dr. Nguyen Hoa – The Chief Executive has pledged to collaborate with 14 other members in the Board of Directors to develop the association to become the representative organization for researchers, English teachers and organizations in organizing and implementing all the activities related to English teaching and learning nationwide.</span></p>', 'viettesol-association-officially-launched', '[\"workshop\",\"news\",\"About VTA\"]', 2, 2, 'draft', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"><span style=\"font-family: Arial, serif;\"><b>Vietnam Association of English Language Teaching and Research (also known as VieTESOL Association) was officially launched on July 11, 2018 at a ceremony hosted by the</b></span><span style=\"font-family: Arial, serif;\"><b> University of Language and International Studies, Vietnam National University, Hanoi (ULIS – VNU).</b></span></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> <img src=\"https://viettesolassociation.org/images/anhchihanh.gif\" alt=\"\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-left: auto; margin-right: auto; margin-top: 5px !important;\"></p>', '2019-03-11 11:55:14', '2019-03-08 15:34:53'),
(7, 'VTA-RELO Teacher Development Workshops March 2019: How to adapt pronunciation and speaking activities for students with different English levels', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">There is a limit of <strong>35</strong> participants in this workshop, and slots are available first comes, first served. Please register here: <u><a href=\"https://tinyurl.com/VietTESOLworkshops2019\" style=\"color: rgb(44, 121, 179);\">https://tinyurl.com/VietTESOLworkshops2019</a></u> no later than Friday<strong>, March 15 2019</strong>.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>DATES: Saturday, March 23, 2019</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>TIME: 9:00 a.m – 12:00 p.m</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>VENUE: Wellspring International Bilingual School, 95 Ai Mo, Bo De Ward, Long Bien District, Hanoi.</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><em>Abstract</em></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">The workshop will focus on a variety of techniques that teachers can use to help develop and implement lessons for classes with students of different levels and learning styles.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">During the first part of the workshop, we will focus on a variety of pronunciation activities that promote student participation and kinesthetic learning techniques. Participants will look at some very basic activities that can be used to help students overcome difficulties with stress and pronunciation.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">After a short break, we will then turn our attention to speaking activities. It’s important for students to practice speaking as much as possible in the classroom. Participants will look at and analyze several different speaking activities to determine which are best for their students. They will also look at ways they can create more opportunities for their students to speak in class.</p><p style=\"text-align: center; color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><img src=\"data:image/png;base64,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\" data-filename=\"logo-5.png\" style=\"width: 225px;\"><br></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> <em>Speaker biography</em></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Mr. Kevin Gilman (M.A. ESL) has taught English to students in the USA, Argentina, Malawi, Malaysia, Thailand, and Vietnam. He is currently an US. English Language Fellow  teaching at Hanoi Metropolitan University, Vietnam.</p>', 'vta-relo-teacher-development-workshops-march-2019-how-to-adapt-pronunciation-and-speaking-activities-for-students-with-different-english-levels', '[\"workshop\",\"conference\"]', 2, 2, 'published', '<p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">VietTESOL Association, the Regional English Language  Office, U.S. Embassy in Vietnam and Wellspring International Bilingual School would like to invite you to participate in a workshop for K-12 English teachers (preferably high school teachers in Gia Lam, Long Bien District of Hanoi, Hung Yen and Bac Ninh provinces). The workshop will be conducted by Mr. Kevin Gilman (M.A. ESL) – US. English Language Fellow, Department of State.</span><br></p>', '2019-03-11 11:43:34', '2019-03-11 09:15:42'),
(8, 'FULL PAPER SUBMISSION EXTENSION - VIC HaUI 2018', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: center;\">&nbsp;</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: center;\"><img src=\"http://viettesolassociation.org/images/EX5.png\" alt=\"\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-top: 5px !important;\">&nbsp;</p><h3 style=\"font-family: Roboto, Helvetica, Arial, sans-serif; color: rgb(51, 51, 51); text-align: center;\">http://proceedings.viettesol.org</h3><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">&nbsp;</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Dear valued presenters,</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Thank you for your interest in submitting your full paper to the Proceedings of VietTESOL International Convention 2018. From your feedback, we understand that you have difficulties completing your papers due to your increased end-year workload. In order to facilitate your submission, the Organizing Committee has decided to extend the full paper submission deadline to&nbsp;<strong>15th February, 2019</strong>. Please note that this is the final extension of the deadline since we will need to have the Convention Proceedings published in June 2019. Therefore, if you would like to submit your full paper, please do it by&nbsp;<strong>11.59 pm February 15th 2019.</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Please be mindful of the&nbsp;<a href=\"https://drive.google.com/file/d/1MhbzhdsF8P49krWzzP2COmMXUuVBRCNO/view?usp=sharing\" style=\"color: rgb(44, 121, 179);\">GUIDELINES AND TEMPLATE</a>&nbsp;for paper preparation and remember to submit your paper via our OJS at&nbsp;<a href=\"http://proceedings.viettesol.org/\" style=\"color: rgb(44, 121, 179);\">http://proceedings.viettesol.org</a></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">If you have any questions, please contact us at&nbsp;<span id=\"cloaka8b5559b8b8869cb1ac3d2b46a295f14\"><a href=\"mailto:viettesolassociation@gmail.com\" style=\"color: rgb(44, 121, 179);\">viettesolassociation@gmail.com</a></span>.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">We are looking forward to your submission.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Best regards,</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">The Organizing Committee.</p>', 'full-paper-submission-extension-vic-haui-2018', '[\"convention 2018\"]', 2, 2, 'published', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: center;\">&nbsp;</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: center;\"><img src=\"http://viettesolassociation.org/images/EX5.png\" alt=\"\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-top: 5px !important;\"></p><div><br></div>', '2019-03-12 14:48:15', '2019-03-12 14:48:15'),
(9, 'How to adapt pronunciation and speaking activities for students with different English levels', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">There is a limit of&nbsp;<strong>35</strong>&nbsp;participants in this workshop, and slots are available first comes, first served. Please register here:&nbsp;<u><a href=\"https://tinyurl.com/VietTESOLworkshops2019\" style=\"color: rgb(44, 121, 179);\">https://tinyurl.com/VietTESOLworkshops2019</a></u>&nbsp;no later than Friday<strong>, March 15 2019</strong>.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>DATES: Saturday, March 23, 2019</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>TIME: 9:00 a.m – 12:00 p.m</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>VENUE: Wellspring International Bilingual School, 95 Ai Mo, Bo De Ward, Long Bien District, Hanoi.</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><em>Abstract</em></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">The workshop will focus on a variety of techniques that teachers can use to help develop and implement lessons for classes with students of different levels and learning styles.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">During the first part of the workshop, we will focus on a variety of pronunciation activities that promote student participation and kinesthetic learning techniques. Participants will look at some very basic activities that can be used to help students overcome difficulties with stress and pronunciation.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">After a short break, we will then turn our attention to speaking activities. It’s important for students to practice speaking as much as possible in the classroom. Participants will look at and analyze several different speaking activities to determine which are best for their students. They will also look at ways they can create more opportunities for their students to speak in class.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">&nbsp;<em>Speaker biography</em></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Mr. Kevin Gilman (M.A. ESL) has taught English to students in the USA, Argentina, Malawi, Malaysia, Thailand, and Vietnam. He is currently an US. English Language Fellow &nbsp;teaching at Hanoi Metropolitan University, Vietnam.</p>', 'how-to-adapt-pronunciation-and-speaking-activities-for-students-with-different-english-levels', '[\"professional development\"]', 2, 2, 'published', '<p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">VietTESOL Association, the Regional English Language&nbsp; Office, U.S. Embassy in Vietnam and Wellspring International Bilingual School would like to invite you to participate in a workshop for K-12 English teachers (preferably high school teachers in Gia Lam, Long Bien District of Hanoi, Hung Yen and Bac Ninh provinces). The workshop will be conducted by Mr. Kevin Gilman (M.A. ESL) – US. English Language Fellow, Department of State.</span><br></p>', '2019-03-15 16:56:49', '2019-03-15 16:56:49');
INSERT INTO `news` (`id`, `title`, `body`, `slug`, `tags`, `last_updated_by`, `created_by`, `status`, `short_content`, `updated_at`, `created_at`) VALUES
(10, 'Workshop series for university and school teachers by Mr. Joe McVeigh', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">he Regional English Language Office, U.S. Embassy in Vietnam and VietTESOL Association are pleased to invite you to participate in two series of workshops, one for university-level English teachers and the other for K-12 English teachers. The workshops will be conducted by Mr. Joe McVeigh, a U.S. Department of State English Language Specialist, who is giving a keynote presentation at CamTESOL 2019 this weekend.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">There is a maximum of <strong>35</strong> participants in each series and slots are available first comes, first served. Please register here: <a href=\"https://tinyurl.com/VietTESOLworkshops2019\" data-saferedirecturl=\"https://www.google.com/url?q=https://tinyurl.com/VietTESOLworkshops2019&source=gmail&ust=1550154948196000&usg=AFQjCNETxA-dAyRYBqaldi85AdfjN-sBwg\" style=\"color: rgb(44, 121, 179);\">https://tinyurl.com/VietTESOLworkshops2019</a> no later than Tuesday<strong>, February 19</strong>.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Please find below the trainer’s bio and workshop descriptions.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Joe McVeigh is a teacher, teacher trainer, and independent educational consultant based in Middlebury, Vermont in the northeastern United States. He has taught previously at California State University Los Angeles, the California Institute of Technology, and the University of Southern California. He teaches courses in TESOL methodology at Middlebury College, and courses in second language acquisition at Saint Michael’s College, both in Vermont. He serves on the Board of Directors of the TESOL International Association and has traveled as an English language specialist for the U.S. Department of State, giving workshops and conference presentations in a variety of countries as well as online webinar presentations. He is the co-author of two textbooks in the Q: Skills for Success series from Oxford University Press and co-author of Tips for Teaching Culture from Pearson. In addition to giving plenary talks and workshops at professional conferences, Joe contributes to the field through his website, which contains videos, resources, and presentation slides and handouts at <a href=\"http://www.joemcveigh.org/\" data-saferedirecturl=\"https://www.google.com/url?q=http://www.joemcveigh.org&source=gmail&ust=1550154948196000&usg=AFQjCNHbT_tOp0JKl8_969Eds6cOd63agw\" style=\"color: rgb(44, 121, 179);\">www.joemcveigh.org</a>.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>Workshops for University Teachers</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>Venue: Hanoi University, Km9 Nguyễn Trãi, Thanh Xuân, Hà Nội</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>Dates: February 20-22, 2019, 9:30 - 16:00 (three days, two workshops per day)</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>WS1: Principles to Practice in Teaching Reading and Vocabulary</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Reading is a complex skill that is critical to English learners’ language development.  In this interactive presentation, we will start with a brief overview of current theories about how students learn to read. Then we will examine how these principles can be applied effectively in practical reading and vocabulary activities. At the conclusion, participants will leave with a menu of practical reading and vocabulary activities and knowledge of current principles in reading and vocabulary instruction.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>WS2: Empowering Students with Media Literacy</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Each day English language students absorb messages from newspapers, magazines, television, radio, and many forms of social media. Just as we help our students to read, listen to, and understand English, we also want to help them develop critical thinking skills to understand and assess the information they obtain through different forms of media. In this session, we will present activities to help students ask key questions about the messages found in news and social media. We will examine specific media texts and engage in hands-on evaluation techniques that can be used in class with students.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><strong>WS3: Writing Effective Student Learning Outcomes</strong></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">Many teachers and curriculum coordinators need to write student learning outcomes for course development. How can these teachers write outcomes that are clearer and more effective?  In this session, the presenter describes characteristics of model learner outcomes, guides participants in critiquing examples, and helps them practice writing their own outcomes.</p>', 'workshop-series-for-university-and-school-teachers-by-mr-joe-mcveigh', '[\"professional development\"]', 1, 2, 'draft', '<p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\">The Regional English Language Office, U.S. Embassy in Vietnam and VietTESOL Association are pleased to invite you to participate in two series of workshops, one for university-level English teachers and the other for K-12 English teachers. The workshops will be conducted by Mr. Joe McVeigh, a U.S. Department of State English Language Specialist, who is giving a keynote presentation at CamTESOL 2019 this weekend.</span><br></p>', '2019-06-13 22:55:55', '2019-03-15 16:58:18'),
(14, 'Thang NGuyen', '<p>asdfadf</p>', 'hihi', '[\"ddd\"]', 1, 1, 'draft', '<p>ajskdjfk    jaklsdjfkl</p>', '2019-03-03 18:01:22', '2019-03-03 14:42:29'),
(18, 'lll', '<p>jkhjkh</p>', 'll', '[\"kk\",\"ik\",\"ol\",\"uio\"]', 1, 1, 'draft', '<p>jkjhjhk</p>', '2019-03-03 17:10:56', '2019-03-03 15:03:02'),
(19, 'tttt', '<p>asdf</p>', 'thang', 'null', 1, 1, 'draft', '<p>ds</p>', '2019-03-04 06:24:53', '2019-03-04 06:24:53'),
(20, 'Call for Proposals: Host of VietTESOL International Convention 2020', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\">VietTESOL International Convention (VIC) brings together teachers, practitioners, researchers and research scholars in the field of English language teaching all over the world to exchange ideas and research results in all aspects of English language education.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><img src=\"http://viettesolassociation.org/images/WhatsApp_Image_2019-05-23_at_81552_PM.jpg\" alt=\"\" width=\"426\" height=\"602\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-left: auto; margin-right: auto; margin-top: 5px !important;\"></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\">VIC is now accepting proposals for hosting VIC 2020. We therefore invite universities and organizations to submit their proposals to the organizing committee. The host institution will co-organize the 6th VietTESOL International Convention with VietTESOL Association and National Foreign Languages Project, which will be held on October 16-17, 2020.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><span style=\"text-decoration-line: underline;\"><strong>Convention venue requirement:</strong> </span><br>Lecture halls for 400 to 450 participants attending:<br>- Pre-convention workshops<br>- Plenary sessions <br>- 12-15 parallel sessions.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><span style=\"text-decoration-line: underline;\"><strong>Deadlines:</strong> </span><br>The proposal could be submitted at <a href=\"https://www.viettesol.org/host-call\" style=\"color: rgb(44, 121, 179);\">viettesol.org/host-call</a> no later than July 08, 2019.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"><span style=\"text-decoration-line: underline;\"><strong>Contact:</strong> </span><br>For questions or additional information, please contact <span id=\"cloak045b92a647057bb1f94658255d131a07\"><a href=\"mailto:contact@viettesol.org\" style=\"color: rgb(44, 121, 179);\">contact@viettesol.org</a></span>.</p>', 'call-for-proposals-host-of-viettesol-international-convention-2020', 'null', 1, 1, 'published', '<p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\">VietTESOL International Convention (VIC) brings together teachers, practitioners, researchers and research scholars in the field of English language teaching all over the world to exchange ideas and research results in all aspects of English language education.</p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif;\"><img src=\"http://viettesolassociation.org/images/WhatsApp_Image_2019-05-23_at_81552_PM.jpg\" alt=\"\" width=\"426\" height=\"602\" style=\"border-width: 1px; border-style: solid; border-color: rgb(231, 232, 230); max-width: 100%; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px; display: block; height: auto; margin-left: auto; margin-right: auto; margin-top: 5px !important;\"></p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\"> </p><p style=\"color: rgb(51, 51, 51); font-family: Roboto, Helvetica, Arial, sans-serif; text-align: justify;\">VIC is now accepting proposals for hosting VIC 2020. We therefore invite universities and organizations to submit their proposals to the organizing committee. The host institution will co-organize t</p>', '2019-06-13 22:55:12', '2019-06-05 12:56:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `new_categories`
--

CREATE TABLE `new_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `new_categories`
--

INSERT INTO `new_categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(14, 'Professional Development', 'professional-development', NULL, '2019-03-02 02:00:30', '2019-03-02 02:00:30'),
(16, 'Last-News', 'last-news', NULL, '2019-03-02 02:21:14', '2019-03-02 02:21:14'),
(22, 'Training Opportunities', 'training', NULL, '2019-03-03 13:27:06', '2019-03-03 13:27:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `new_category_links`
--

CREATE TABLE `new_category_links` (
  `id` int(11) NOT NULL,
  `new_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `new_category_links`
--

INSERT INTO `new_category_links` (`id`, `new_id`, `category_id`, `created_at`, `updated_at`) VALUES
(33, 18, 22, '2019-03-03 11:00:59', '2019-03-03 11:00:59'),
(35, 14, 16, '2019-03-03 11:01:23', '2019-03-03 11:01:23'),
(36, 14, 22, '2019-03-03 11:01:38', '2019-03-03 11:01:38'),
(37, 19, 14, '2019-03-03 23:24:53', '2019-03-03 23:24:53'),
(38, 19, 16, '2019-03-03 23:24:53', '2019-03-03 23:24:53'),
(39, 20, 16, '2019-06-05 05:56:01', '2019-06-05 05:56:01'),
(40, 10, 14, '2019-06-13 15:55:55', '2019-06-13 15:55:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `sender_id` int(11) NOT NULL,
  `user_id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `papal_transactions`
--

CREATE TABLE `papal_transactions` (
  `id` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `txn_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_email` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver_email` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_number` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_date` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_id` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver_id` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `papers`
--

CREATE TABLE `papers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `full_paper` text COLLATE utf8_unicode_ci,
  `file_id` int(11) DEFAULT NULL,
  `track_id` int(11) NOT NULL,
  `session_type_id` int(11) NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `save` tinyint(4) DEFAULT '1',
  `submission_progress` tinyint(4) DEFAULT NULL,
  `submission_by` int(11) NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_to_archive` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paper_author`
--

CREATE TABLE `paper_author` (
  `id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `paper_author`
--

INSERT INTO `paper_author` (`id`, `paper_id`, `author_id`, `seq`, `created_at`, `updated_at`) VALUES
(36, 35, 10, 1, NULL, NULL),
(37, 37, 11, 0, NULL, NULL),
(38, 42, 11, 0, NULL, NULL),
(39, 59, 11, 0, NULL, NULL),
(40, 60, 10, 0, '2019-05-02 06:15:53', '2019-05-02 06:15:53'),
(41, 61, 10, 0, NULL, NULL),
(42, 62, 12, 0, NULL, NULL),
(43, 63, 13, 0, NULL, NULL),
(44, 64, 14, 0, NULL, NULL),
(45, 65, 14, 0, NULL, NULL),
(46, 66, 12, 0, NULL, NULL),
(47, 67, 12, 0, NULL, NULL),
(48, 67, 15, 1, NULL, NULL),
(49, 68, 12, 0, NULL, NULL),
(50, 67, 16, 1, NULL, NULL),
(51, 68, 17, 1, NULL, NULL),
(52, 69, 12, 0, NULL, NULL),
(53, 70, 12, 0, NULL, NULL),
(54, 63, 18, 1, NULL, NULL),
(55, 71, 12, 0, NULL, NULL),
(56, 72, 19, 0, NULL, NULL),
(57, 72, 20, 1, NULL, NULL),
(58, 73, 19, 0, NULL, NULL),
(59, 73, 21, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paper_event_log`
--

CREATE TABLE `paper_event_log` (
  `id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Cấu trúc bảng cho bảng `paper_files`
--

CREATE TABLE `paper_files` (
  `id` int(11) NOT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `revision` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_size` bigint(20) DEFAULT NULL,
  `original_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `partners_sponsors`
--

CREATE TABLE `partners_sponsors` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `logo` text COLLATE utf8_unicode_ci,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prepared_emails`
--

CREATE TABLE `prepared_emails` (
  `id` int(11) NOT NULL,
  `email_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `prepared_emails`
--

INSERT INTO `prepared_emails` (`id`, `email_key`, `subject`, `body`, `description`, `updated_at`, `created_at`) VALUES
(1, 'SUBMISSION_ACK', 'Submission Acknowledgement', '{$authorName}:\r\n\r\nThank you for your submission, \"{$paperTitle}\" to {$conferenceName}. With the online conference management system that we are using, you will be able to track its progress through the editorial process by logging in to the conference web site:\r\n\r\nSubmission URL: {$submissionUrl}\r\nUsername: {$authorUsername}\r\n\r\nIf you have any questions, please contact me. Thank you for considering this conference as a venue for your work.\r\n\r\n{$editorialContactSignature}', NULL, NULL, '2019-05-22 05:37:32'),
(2, 'MANUAL_PAYMENT_NOTIFICATION', 'Manual Payment Notification', 'A manual payment needs to be processed for the conference {$schedConfName} and the user {$userFullName} (username \"{$userName}\").\r\n\r\nThe item being paid for is \"{$itemName}\".\r\nThe cost is {$itemCost} ({$itemCurrencyCode}).\r\n\r\nThis email was generated by Open Conference Systems\' Manual Payment plugin.', NULL, NULL, '2019-05-22 05:37:32'),
(3, 'REVIEW_REQUEST', 'Paper Review Request', '{$reviewerName}:\r\n\r\nI believe that you would serve as an excellent reviewer of the proposal, \"{$paperTitle},\" which has been submitted to {$conferenceName}. The submission\'s extract is inserted below, and I hope that you will consider undertaking this important task for us.\r\n\r\nPlease log into the conference web site by {$reviewerOpened} to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation. The web site is {$conferenceUrl}\r\n\r\nThe review itself is due {$reviewDeadline}.\r\n\r\nIf you do not have your username and password for the conference\'s web site, you can use this link to reset your password (which will then be emailed to you along with your username). {$passwordResetUrl}\r\n\r\nSubmission URL: {$submissionReviewUrl}\r\n\r\nThank you for considering this request.\r\n\r\n\r\n\"{$paperTitle}\"\r\n\r\nAbstract\r\n{$paperAbstract}', NULL, '2019-05-29 04:33:43', '2019-05-22 05:37:32'),
(4, 'REVIEW_REQUEST_ONECLICK', 'Paper Review Request', '{$reviewerName}:\r\n\r\nI believe that you would serve as an excellent reviewer of the submission, \"{$paperTitle},\" which has been submitted to {$conferenceName}. The submission\'s extract is inserted below, and I hope that you will consider undertaking this important task for us.\r\n\r\nPlease log into the conference web site by {$weekLaterDate} to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation.\r\n\r\nThe review itself is due 2018-08-05.\r\n\r\nSubmission URL: {$submissionReviewUrl}\r\n\r\nThank you for considering this request.\r\n\r\n{$editorialContactSignature}\r\n\r\n\r\n\r\n\"{$paperTitle}\"\r\n\r\nAbstract\r\n{$paperAbstract}', NULL, NULL, '2019-05-22 05:37:32'),
(5, 'SUBMISSION_ABSTRACT_ACCEPT', 'Editorial Decision on Abstract', 'Dear {$authorName},\r\n\r\nOn behalf of the Organizing Committee, we are pleased to inform you that your proposal titled \"{$paperTitle}\" has been accepted for inclusion in the conference program after a rigorous blind review process. The VietESOL Convention 2018 will be held on 12th-13th October, 2018 at Hanoi University of Industry, Hanoi, Vietnam. Congratulations on your successful proposal!\r\n\r\nTo better plan for the main convention day, please follow these guidelines:\r\n\r\n1. Session Type and Length: Your proposal has been accepted for an Oral Presentation.  For a detailed description of the session type and other useful presentation suggestion please check this link: http://viettesol.org/index.php/submission-guidelines\r\n\r\n2. Confirmation and Convention Registration: There is no need to reply to this email to confirm that you will present at the Convention. Instead, please kindly register as Presenter at http://viettesol.org/index.php/convention-2018-registration and complete the registration process as advised in the registration notification email no later than 30th August 2018.\r\n\r\n3. Submission of required details and abstract revision: If you have not provided all the required information including your country, bio statement when you submitted your proposals, please log in the system, go to Edit Profile to fill in all the information. The information you provide will be included in the Convention booklet together with your abstract.\r\n\r\n4. Conference proceedings: If you wish your work to be published in the conference proceedings (a special issue of Language and life Journal), please send us your full paper before 30th November 2018. The paper will then undergo a rigorous peer-reviewed process. Details about the full paper format and submission system will be informed soon. \r\n\r\nIf you have any questions or concerns regarding your presentation or any issues related to the Convention, please do not hesitate to contact us via email viettesolassociation@gmail.com or call us on (+84) 919.520.468\r\n\r\nWe are looking forward to your presentation at VietTESOL Convention 2018.\r\nSincerely,\r\n\r\n__________\r\nThe VietTESOL Convention 2018 Review Board', NULL, NULL, '2019-05-22 05:37:32'),
(7, 'NOTIFICATION', 'New notification from {$siteTitle}', 'You have a new notification from {$siteTitle}:\n\n{$notificationContents}\n\nLink: {$url}\n\n{$principalContactSignature}', 'The email is sent to registered users that have selected to have this type of notification emailed to them.', NULL, '2019-05-29 03:38:20'),
(8, 'NOTIFICATION_MAILLIST', 'New notification from {$siteTitle}', 'You have a new notification from {$siteTitle}:\n--\n{$notificationContents}\n\nLink: {$url}\n--\n\nIf you wish to stop receiving notification emails, please go to {$unsubscribeLink} and enter your email address and password.\n\n{$principalContactSignature}', 'This email is sent to unregistered users on the notification mailing list.', NULL, '2019-05-29 03:38:20'),
(9, 'NOTIFICATION_MAILLIST_WELCOME', 'Welcome to the the {$siteTitle} mailing list!', 'You have signed up to receive notifications from {$siteTitle}.\n			\nPlease click on this link to confirm your request and add your email address to the mailing list: {$confirmLink}\n\nIf you wish to stop receiving notification emails, please go to {$unsubscribeLink} and enter your email address and password.\n\nYour password for disabling notification emails is: {$password}\n\n{$principalContactSignature}', 'This email is sent to an unregistered user who just registered with the notification mailing list.', NULL, '2019-05-29 03:38:20'),
(10, 'NOTIFICATION_MAILLIST_PASSWORD', 'Your notification mailing list information for {$siteTitle}', 'Your new password for disabling notification emails is: {$password}\n\nIf you wish to stop receiving notification emails, please go to {$unsubscribeLink} and enter your email address and password.\n\n{$principalContactSignature}', 'This email is sent to an unregistered user on the notification mailing list when they indicate that they have forgotten their password or are unable to login. It provides a URL they can follow to reset their password.', NULL, '2019-05-29 03:38:20'),
(11, 'PASSWORD_RESET_CONFIRM', 'Password Reset Confirmation', 'We have received a request to reset your password for the {$siteTitle} web site.\n\nIf you did not make this request, please ignore this email and your password will not be changed. If you wish to reset your password, click on the below URL.\n\nReset my password: {$url}\n\n{$principalContactSignature}', 'This email is sent to a registered user when they indicate that they have forgotten their password or are unable to login. It provides a URL they can follow to reset their password.', NULL, '2019-05-29 03:38:20'),
(12, 'PASSWORD_RESET', 'Password Reset', 'Your password has been successfully reset for use with the {$siteTitle} web site. Please retain this username and password, as it is necessary for all work with the conference.\n\nYour username: {$username}\nYour new password: {$password}\n\n{$principalContactSignature}', 'This email is sent to a registered user when they have successfully reset their password following the process described in the PASSWORD_RESET_CONFIRM email.', NULL, '2019-05-29 03:38:20'),
(13, 'USER_REGISTER', 'New User Registration', 'Thank you for registering as a user with {$conferenceName}. Please keep track of your username and password, which are needed for all work with this conference.\n\nUsername: {$username}\nPassword: {$password}\n\nThank you,\n{$principalContactSignature}', 'This email is sent to a newly registered user to welcome them to the system and provide them with a record of their username and password.', NULL, '2019-05-29 03:38:20'),
(14, 'USER_VALIDATE', 'Validate Your Account', '{$userFullName}\n\nYou have created an account with {$conferenceName}, but before you can start using it, you need to validate your email account. To do this, simply follow the link below:\n\n{$activateUrl}\n\nThank you,\n{$principalContactSignature}', 'This email is sent to a newly created user to welcome them to the system and provide them with a record of their username and password.', NULL, '2019-05-29 03:38:20'),
(15, 'SUBMISSION_ACK', 'Submission Acknowledgement', '{$authorName}:\n\nThank you for your submission, \"{$paperTitle}\" to {$conferenceName}. With the online conference management system that we are using, you will be able to track its progress through the editorial process by logging in to the conference web site:\n\nSubmission URL: {$submissionUrl}\nUsername: {$authorUsername}\n\nIf you have any questions, please contact me. Thank you for considering this conference as a venue for your work.\n\n{$editorialContactSignature}', 'This email, when enabled, is automatically sent to a author when he or she completes the process of submitting a paper or abstract to the conference. It provides information about tracking the submission through the process and thanks the author for the submission.', NULL, '2019-05-29 03:38:20'),
(16, 'SUBMISSION_UPLOAD_ACK', 'Submission Upload Acknowledgement', '{$authorName}:\n\nThank you for uploading your presentation, \"{$paperTitle}\" to {$conferenceName}. With the online conference management system that we are using, you will be able to track its progress through the editorial process by logging in to the conference web site:\n\nSubmission URL: {$submissionUrl}\nUsername: {$authorUsername}\n\nIf you have any questions, please contact me. Thank you for considering this conference as a venue for your work.\n\n{$editorialContactSignature}', 'This email, when enabled, is automatically sent to a author when he or she completes the process of submitting a paper or abstract to the conference. It provides information about tracking the submission through the process and thanks the author for the submission.', NULL, '2019-05-29 03:38:20'),
(17, 'SUBMISSION_UNSUITABLE', 'Unsuitable Submission', '{$authorName}:\n\nAn initial review of \"{$paperTitle}\" has made it clear that this submission does not fit within the scope and focus of {$conferenceName}. I recommend that you consult the description of this conference under About, as well as any previous scheduled conferences, to learn more about the work that we accept. You might also consider submitting this paper or abstract to another, more suitable conference.\n\n{$editorialContactSignature}', '', NULL, '2019-05-29 03:38:20'),
(18, 'SUBMISSION_COMMENT', 'Submission Comment', '{$name}:\n\n{$commentName} has added a comment to the submission, \"{$paperTitle}\" in {$conferenceName}:\n\n{$comments}', 'This email notifies the various people involved in a submission\'s editing process that a new comment has been posted.', NULL, '2019-05-29 03:38:20'),
(19, 'SUBMISSION_DECISION_REVIEWERS', 'Decision on \"{$paperTitle}\"', 'As one of the reviewers for the submission, \"{$paperTitle},\" to {$conferenceName}, I am sending you the reviews and editorial decision sent to the author of this piece. Thank you again for your important contribution to this process.\n \n{$editorialContactSignature}\n\n{$comments}', 'This email notifies the reviewers of a submission that the review process has been completed. It includes information about the paper and the decision reached, and thanks the reviewers for their contributions.', NULL, '2019-05-29 03:38:20'),
(20, 'DIRECTOR_ASSIGN', 'Director Assignment', 'The submission, {$conferenceName} has been assigned to you to see through the editorial process in your role as Track Director for {$trackName}.  \r\n\r\nSubmission URL: {$submissionUrl}\r\n\r\nThank you.', 'This email notifies a Track Director that the Director has assigned them the task of overseeing a submission through the editing process. It provides information about the submission and how to access the conference site.', '2019-06-03 10:00:15', '2019-05-29 03:38:20'),
(21, 'REVIEW_REQUEST', 'Paper Review Request', '{$reviewerName}:\n\nI believe that you would serve as an excellent reviewer of the proposal, \"{$paperTitle},\" which has been submitted to {$conferenceName}. The submission\'s extract is inserted below, and I hope that you will consider undertaking this important task for us.\n\nPlease log into the conference web site by {$weekLaterDate} to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation. The web site is {$conferenceUrl}\n\nThe review itself is due {$reviewDueDate}.\n\nIf you do not have your username and password for the conference\'s web site, you can use this link to reset your password (which will then be emailed to you along with your username). {$passwordResetUrl}\n\nSubmission URL: {$submissionReviewUrl}\n\nThank you for considering this request.\n\n{$editorialContactSignature}\n\n\n\n\"{$paperTitle}\"\n\nAbstract\n{$paperAbstract}', 'This email from the Track Director to a Reviewer requests that the reviewer accept or decline the task of reviewing a submission. It provides information about the submission such as the title and abstract, a review due date, and how to access the submission itself.', NULL, '2019-05-29 03:38:20'),
(22, 'REVIEW_REQUEST_ONECLICK', 'Paper Review Request', '{$reviewerName}:\n\nI believe that you would serve as an excellent reviewer of the submission, \"{$paperTitle},\" which has been submitted to {$conferenceName}. The submission\'s extract is inserted below, and I hope that you will consider undertaking this important task for us.\n\nPlease log into the conference web site by {$weekLaterDate} to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation.\n\nThe review itself is due {$reviewDueDate}.\n\nSubmission URL: {$submissionReviewUrl}\n\nThank you for considering this request.\n\n{$editorialContactSignature}\n\n\n\n\"{$paperTitle}\"\n\nAbstract\n{$paperAbstract}', 'This email from the Track Director to a Reviewer requests that the reviewer accept or decline the task of reviewing a submission. It provides information about the submission such as the title and abstract, a review due date, and how to access the submission itself. This message is used when the Standard Review Process is selected in Conference Setup, Step 2, and one-click reviewer access is enabled.', NULL, '2019-05-29 03:38:20'),
(23, 'REVIEW_CANCEL', 'Request for Review Cancelled', '{$reviewerName}:\n\nWe have decided at this point to cancel our request for you to review the submission, \"{$paperTitle},\" for {$conferenceName}. We apologize for any inconvenience this may cause you and hope that we will be able to call on you to assist with this conference\'s review process in the future.\n\nIf you have any questions, please contact me.\n\n{$editorialContactSignature}', 'This email is sent by the Track Director to a Reviewer who has a submission review in progress to notify them that the review has been cancelled.', NULL, '2019-05-29 03:38:20'),
(24, 'REVIEW_CONFIRM', 'Able to Review', '{$editorialContactName}:\n\nI am able and willing to review the submission, \"{$paperTitle},\" for {$conferenceName}. Thank you for thinking of me, and I plan to have the review completed by its due date, {$reviewDueDate}, if not before.\n\n{$reviewerName}', 'This email is sent by a Reviewer to the Track Director in response to a review request to notify the Track Director that the review request has been accepted and will be completed by the specified date.', NULL, '2019-05-29 03:38:20'),
(25, 'REVIEW_CONFIRM_ACK', 'Review Underway Acknowledgement', '{$reviewerName}:\n\nThank you for agreeing to review the submission \"{$paperTitle}\" for {$conferenceName} by {$reviewDueDate}.\n\n{$editorialContactSignature}', 'This email is sent from the Track Director to the Reviewer to acknowledge their acceptance of a review or encourage them to complete the review.', NULL, '2019-05-29 03:38:20'),
(26, 'REVIEW_DECLINE', 'Unable to Review', '{$editorialContactName}:\n\nI am afraid that at this time I am unable to review the submission, \"{$paperTitle},\" for {$conferenceName}. Thank you for thinking of me, and another time feel free to call on me.\n\n{$reviewerName}', 'This email is sent by a Reviewer to the Track Director in response to a review request to notify the Track Director that the review request has been declined.', NULL, '2019-05-29 03:38:20'),
(27, 'REVIEW_COMPLETE', 'Paper Review Completed', '{$editorialContactName}:\n\nI have now completed my review of \"{$paperTitle}\" for {$conferenceName}, and submitted my recommendation, \"{$recommendation}.\"\n\n{$reviewerName}', 'This email is sent by a Reviewer to the Track Director to notify them that a review has been completed and the comments and recommendations have been recorded on the conference web site.', NULL, '2019-05-29 03:38:20'),
(28, 'REVIEW_ACK', 'Paper Review Acknowledgement', '{$reviewerName}:\n\nThank you for completing the review of the submission, \"{$paperTitle},\" for {$conferenceName}. We appreciate your contribution to the quality of the work that we produce.\n\n{$editorialContactSignature}', 'This email is sent by a Track Director to confirm receipt of a completed review and thank the reviewer for their contributions.', NULL, '2019-05-29 03:38:20'),
(29, 'REVIEW_REMIND', 'Submission Review Reminder', '{$reviewerName}:\r\n\r\nJust a gentle reminder of our request for your review of the submission, \"{$paperTitle},\" for {$conferenceName}. We were hoping to have this review by  {$reviewDeadline}, and would be pleased to receive it as soon as you are able to prepare it.\r\n\r\nSubmission URL: {$submissionReviewUrl}\r\n\r\nPlease confirm your ability to complete this vital contribution to the work of the conference. I look forward to hearing from you.', 'This email is sent by a Track Director to remind a reviewer that their review is due.', '2019-05-29 04:33:39', '2019-05-29 03:38:20'),
(30, 'REVIEW_REMIND_ONECLICK', 'Submission Review Reminder', '{$reviewerName}:\n\nJust a gentle reminder of our request for your review of the submission, \"{$paperTitle},\" for {$conferenceName}. We were hoping to have this review by {$reviewDueDate}, and would be pleased to receive it as soon as you are able to prepare it.\n\nSubmission URL: {$submissionReviewUrl}\n\nPlease confirm your ability to complete this vital contribution to the work of the conference. I look forward to hearing from you.\n\n{$editorialContactSignature}', 'This email is sent by a Track Director to remind a reviewer that their review is due.', NULL, '2019-05-29 03:38:20'),
(31, 'REVIEW_REMIND_AUTO', 'Automated Submission Review Reminder', '{$reviewerName}:\n\nJust a gentle reminder of our request for your review of the submission, \"{$paperTitle},\" for {$conferenceName}. We were hoping to have this review by {$reviewDueDate}, and this email has been automatically generated and sent with the passing of that date. We would still be pleased to receive it as soon as you are able to prepare it.\n\nIf you do not have your username and password for the conference\'s web site, you can use this link to reset your password (which will then be emailed to you along with your username). {$passwordResetUrl}\n\nSubmission URL: {$submissionReviewUrl}\n\nPlease confirm your ability to complete this vital contribution to the work of the conference. I look forward to hearing from you.\n\n{$editorialContactSignature}', 'This email is automatically sent when a reviewer\'s due date elapses (see Review Options under Conference Setup, Step 2) and one-click reviewer access is disabled. Scheduled tasks must be enabled and configured (see the site configuration file).', NULL, '2019-05-29 03:38:20'),
(32, 'REVIEW_REMIND_AUTO_ONECLICK', 'Automated Submission Review Reminder', '{$reviewerName}:\n\nJust a gentle reminder of our request for your review of the submission, \"{$paperTitle},\" for {$conferenceName}. We were hoping to have this review by {$reviewDueDate}, and this email has been automatically generated and sent with the passing of that date. We would still be pleased to receive it as soon as you are able to prepare it.\n\nSubmission URL: {$submissionReviewUrl}\n\nPlease confirm your ability to complete this vital contribution to the work of the conference. I look forward to hearing from you.\n\n{$editorialContactSignature}', 'This email is automatically sent when a reviewer\'s due date elapses (see Review Options under Conference Setup, Step 2) and one-click reviewer access is enabled. Scheduled tasks must be enabled and configured (see the site configuration file).', NULL, '2019-05-29 03:38:20'),
(33, 'SUBMISSION_ABSTRACT_ACCEPT', 'Editorial Decision on Abstract', '{$authorName}:\n\nCongratulations, your abstract {$paperTitle} has been accepted for presentation at {$conferenceTitle} which is being held {$conferenceDate} at {$locationCity}. \n\nThank you and looking forward to your participation in this event.\n{$editorialContactSignature}', 'This email is sent by a Track Director to a submission\'s Author to notify them that a decision has been reached in regard to a submission.', NULL, '2019-05-29 03:38:20'),
(34, 'SUBMISSION_ABSTRACT_DECLINE', 'Editorial Decision on Paper', '{$authorName}:\r\n\r\nWe have now completed the review of your submission \"{$paperTitle}.\" As a result...', 'This email is sent by a Track Director to a submission\'s Author to notify them that a decision has been reached in regard to a submission.', '2019-05-29 08:20:19', '2019-05-29 03:38:20'),
(35, 'SUBMISSION_ABSTRACT_REVISE', 'Editorial Decision on Paper', '{$authorName}:\n\nAfter a careful review of your submission, \"{$paperTitle}\" will be considered for presentation at {$conferenceTitle} if the following revisions are successfully implemented.\n\nThank you and looking forward to your participation in this event.\n\n{$editorialContactSignature}', 'This email is sent by a Track Director to a submission\'s Author to notify them that a decision has been reached in regard to a submission.', NULL, '2019-05-29 03:38:20'),
(36, 'SUBMISSION_PAPER_ACCEPT', 'Editorial Decision on Paper', 'Dear {$authorName},\r\n\r\nOn behalf of the Organizing Committee, we are pleased to inform you that your proposal titled \"{$paperTitle}\" has been accepted for inclusion in the conference program after a rigorous blind review process. {$conferenceName} will be held on {$conferenceStartTime} - {$conferenceEndTime} at {$conferenceVenue}. Congratulations on your successful proposal!\r\n\r\nTo better plan for the main convention day, please follow these guidelines:\r\n\r\n+ Session Type and Length: Your proposal has been accepted for an Oral Presentation. For a detailed description of the session type and other useful presentation suggestion please check this link\r\n\r\n+ Confirmation and Convention Registration: There is no need to reply to this email to confirm that you will present at the Convention. Instead, please kindly register as Presenter at http://viettesol.org/index.php/convention-2018-registration and complete the registration process as advised in the registration notification email no later than 30th August 2018.\r\n\r\n+ Submission of required details and abstract revision: If you have not provided all the required information including your country, bio statement when you submitted your proposals, please log in the system, go to Edit Profile to fill in all the information. The information you provide will be included in the Convention booklet together with your abstracts.\r\n\r\n+ Conference proceedings: If you wish your work to be published in the conference proceedings (a special issue of Language and life Journal), please send us your full paper before November 30, 2018. The paper will then undergo a rigorous peer-reviewed process. Details about the full paper format and submission system will be informed soon. \r\n\r\nIf you have any questions regarding your presentation, please do not hesitate to contact me.\r\n\r\nIf you have any questions regarding your presentation, please do not hesitate to contact us via email Viettesolassociation@gmail.com or cell phone \r\n(+84) 919 520 468.\r\n\r\nWe are looking forward to your presentation at {$conferenceName}.\r\n\r\nSincerely,\r\nThe Review Board', 'This email is sent by a Track Director to a submission\'s Author to notify them that a decision has been reached in regard to a submission.', NULL, '2019-05-29 03:38:20'),
(37, 'SUBMISSION_PAPER_DECLINE', 'Editorial Decision on Paper', '{$authorName}:\n\nWe have now completed the review of your submission \"{$paperTitle}.\" As a result...\n\n{$editorialContactSignature}', 'This email is sent by a Track Director to a submission\'s Author to notify them that a decision has been reached in regard to a submission.', NULL, '2019-05-29 03:38:20'),
(38, 'SUBMISSION_PAPER_REVISE', 'Editorial Decision on Paper', '{$authorName}:\r\n\r\nAfter a careful review of your submission, \"{$paperTitle}\" will be considered for presentation at {$conferenceTitle} if the following revisions are successfully implemented.\r\n\r\nThank you and looking forward to your participation in this event.', 'This email is sent by a Track Director to a submission\'s Author to notify them that a decision has been reached in regard to a submission.', '2019-05-29 08:22:58', '2019-05-29 03:38:20'),
(39, 'SUBMISSION_PAPER_INVITE', 'Editorial Decision on Abstract', '{$authorName}:\n\nCongratulations, your abstract {$paperTitle} has been accepted for presentation at {$conferenceTitle} which is being held {$conferenceDate} at {$locationCity}. You may now submit your paper for further review.\n\nThank you and looking forward to your participation in this event.\n{$editorialContactSignature}', 'This email is sent by a Track Director to a submission\'s Author to notify them that a decision has been reached in regard to an abstract and invite them to submit a paper for subsequent review.', NULL, '2019-05-29 03:38:20'),
(40, 'REGISTRATION_NOTIFY', 'Registration Notification', '{$registrantName}:\n\nYou have now been registered as a registrant in our online conference management system for {$conferenceName}, with the following registration:\n\n{$registrationType}\n\nTo access content that is available only to registrants, simply log in to the system with your username, \"{$username}\".\n\nOnce you have logged in to the system you can change your profile details and password at any point.\n\nPlease note that if you have an institutional registration, there is no need for users at your institution to log in, since requests for registration content will be automatically authenticated by the system.\n\nIf you have any questions, please feel free to contact me.\n\n{$registrationContactSignature}', 'This email notifies a registered reader that the Manager has created a registration for them. It provides the conference\'s URL along with instructions for access.', NULL, '2019-05-29 03:38:20'),
(41, 'OPEN_ACCESS_NOTIFY', 'Issue Now Open Access', 'Readers:\n\n{$conferenceName} has just made available in an open access format the following issue. We invite you to review the Table of Contents here and then visit our web site ({$conferenceUrl}) to review papers and items of interest.\n\nThanks for the continuing interest in our work,\n{$editorialContactSignature}', 'This email is sent to registered readers who have requested to receive a notification email when an issue becomes open access.', NULL, '2019-05-29 03:38:20'),
(42, 'MANUAL_PAYMENT_RECEIVED', 'Your payment for {$conferenceName} has been received', '{$registrantName}:\n\nYour payment for {$conferenceName} has been received and recorded in your account.\n\nIf you have any questions, please feel free to contact me.\n\n{$registrationContactSignature}', 'This email notifies a registered reader that the Manager has created a registration for them. It provides the conference\'s URL along with instructions for access.', NULL, '2019-05-29 03:38:20'),
(43, 'MANUAL_PAYMENT_NOTIFICATION', 'Manual Payment Notification', 'A manual payment needs to be processed for the conference {$schedConfName} and the user {$userFullName} (username \"{$userName}\").\n\nThe item being paid for is \"{$itemName}\".\nThe cost is {$itemCost} ({$itemCurrencyCode}).\n\nThis email was generated by Open Conference Systems\' Manual Payment plugin.', 'This email template is used to notify a conference\'s registration contact that a manual payment was requested.', NULL, '2019-05-29 03:38:20'),
(44, 'PAYPAL_INVESTIGATE_PAYMENT', 'Unusual PayPal Activity', 'Open Conference Systems has encountered unusual activity relating to PayPal payment support for the conference {$schedConfName}. This activity may need further investigation or manual intervention.\n			\nThis email was generated by Open Conference Systems\' PayPal plugin.\n\nFull post information for the request:\n{$postInfo}\n\nAdditional information (if supplied):\n{$additionalInfo}\n\nServer vars:\n{$serverVars}\n', 'This email template is used to notify a conference\'s primary contact that suspicious activity or activity requiring manual intervention was encountered by the PayPal plugin.', NULL, '2019-05-29 03:38:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `payment_file_id` text COLLATE utf8_unicode_ci NOT NULL,
  `affiliation` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `conference_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviewer_criteria`
--

CREATE TABLE `reviewer_criteria` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `conference_id` int(11) DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review_assignments`
--

CREATE TABLE `review_assignments` (
  `id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `recommendation` tinyint(4) DEFAULT NULL,
  `date_assigned` datetime DEFAULT NULL,
  `date_notified` datetime DEFAULT NULL,
  `date_confirmed` datetime DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `date_acknowledged` datetime DEFAULT NULL,
  `date_due` datetime DEFAULT NULL,
  `review_file_id` int(11) DEFAULT NULL,
  `declined` tinyint(4) NOT NULL DEFAULT '0',
  `replaced` tinyint(4) NOT NULL DEFAULT '0',
  `cancelled` tinyint(4) NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8_unicode_ci,
  `total` float DEFAULT NULL,
  `reviewer_response` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review_form`
--

CREATE TABLE `review_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attach_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_resource`
--

CREATE TABLE `role_resource` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `action` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `allow` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `building_id` int(11) NOT NULL,
  `abbrev` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `time_block_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `conference_id` int(11) NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `session_types`
--

CREATE TABLE `session_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `length` int(11) DEFAULT NULL,
  `abstract_length` int(11) DEFAULT NULL,
  `conference_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `speakers`
--

CREATE TABLE `speakers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `affiliate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `biography` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abstract` text COLLATE utf8_unicode_ci,
  `attach_file` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `conference_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `special_events`
--

CREATE TABLE `special_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `conference_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `time_block`
--

CREATE TABLE `time_block` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `conference_id` int(11) NOT NULL,
  `color` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `conference_id` int(11) NOT NULL,
  `review_form_id` int(11) DEFAULT NULL,
  `abbrev` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `policy` text COLLATE utf8_unicode_ci,
  `keywords` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `track_decisions`
--

CREATE TABLE `track_decisions` (
  `id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `track_director_id` int(11) NOT NULL,
  `decision` int(11) NOT NULL COMMENT ' ''ACCEPTED'' => 0, ''REVISION'' => 1, ''REJECTED'' => 2,',
  `date_decided` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `track_director`
--

CREATE TABLE `track_director` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affiliation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initals` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `role_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disable` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `disable_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `user_name`, `first_name`, `middle_name`, `last_name`, `affiliation`, `gender`, `initals`, `is_admin`, `role_id`, `phone`, `country`, `image`, `disable`, `disable_reason`, `fax`, `email`, `email_verified_at`, `password`, `remember_token`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'thangbk111', 'Thắng', NULL, 'Nguyễn', 'HUST', 'male', NULL, 1, NULL, NULL, 'Viet Nam', 'avatar_default/user_default.jpg', '0', NULL, NULL, 'admin@gmail.com', NULL, '$2y$10$YKIU1hlVrSuRYXYK2XYuteVb69Czbgg9aDTSxmjoF9gcEyGdft8qu', 'XFD71KdHG90jQO72MtM9Nebv3bbQlm3Y0nn6Gd5gt9CSj5onJ0eyJ93a7Su7', '2019-06-12 15:20:19', '2019-02-28 02:30:26', '2019-06-12 15:20:19', NULL),
(2, 'dana35', 'Mavis', 'ashields', 'Connelly', 'Shields-Wisoky', NULL, 'bryana01', 1, NULL, '+5248218304144', 'Kyrgyz Republic', 'avatar_default/user_default.jpg', '1', '0', '(908) 592-0635', 'upadberg@hotmail.com', '1972-05-21 03:38:45', '$2y$10$NotkgGu7LWiMpujerEwyLeCuOMXBgG9NlZQxjj4dNKdi9t.Vo/UM2', 'kohler.mikel', NULL, NULL, '2019-03-12 08:03:41', NULL),
(3, 'kub.russ', 'Theodore', 'nader.whitney', 'Gutmann', 'Dooley, Upton and Hansen', NULL, 'demarcus29', 1, NULL, '+7249041069398', 'Gambia', 'avatar_default/user_default.jpg', '0', '0', '454.833.6113 x4473', 'jamar65@yahoo.com', '2005-05-26 04:58:07', '$2y$10$maMDEZ0ypCT9FaH.xr9zc.k/EJJDR0d5HZklwzr2KVXwGSWo15QPe', 'hayes.adriel', NULL, NULL, '2019-03-12 08:03:53', '2019-03-12 08:03:53'),
(4, 'fasdf', 'fsdafdas', 'fdsfas', 'dfsfasd', 'fdasfdas', 'none', NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'fdafdsdfa@gm.c', NULL, '$2y$10$9p1Sjv.njy42Wops1QvE/OVO0Q1.tWbUjcG.aOOnRgPMos07j544K', NULL, '2019-04-12 09:16:23', '2019-03-12 08:03:18', '2019-04-12 09:16:23', NULL),
(5, 'DoanPhu', 'Phu', 'Van', 'Doan', 'HUST', NULL, NULL, 1, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'doanphua4@gmail.com', NULL, '$2y$10$KCk0F9afSND04K4y5T8aiO65qk.Xa0VoKy3dgmn.ddvGmmHAnORDK', 'f4E79q33LAlW45IbMyOw8rDfKYYvRZMEu63XkqbQOiCc0rvwDxl58FnOiiom', '2019-04-05 08:28:40', '2019-03-28 07:55:48', '2019-04-05 08:28:40', NULL),
(6, 'Reviewer01', 'Review01', '000', '01', 'HUST', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'reviewer01@gmail.com', NULL, '$2y$10$Gdg64aAP4lvL51/DzL.puecqNvy13VxlzYB.sh8kpF.3mvw06RzTa', 'rtGBGyhMInsrw7KuRCPidR90vxobjeEFjTtf9i0kxh3T2iD1BzOsstCE9Fkl', '2019-06-11 07:25:01', '2019-03-26 07:06:56', '2019-06-11 07:25:01', NULL),
(7, 'VuTrang', 'Trang', 'Thi', 'Vu', 'HVTC', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'hvtc.trangvu98@gmail.com', NULL, '$2y$10$YKIU1hlVrSuRYXYK2XYuteVb69Czbgg9aDTSxmjoF9gcEyGdft8qu', 'S9nRePiXCRXcnvdbmtULs2WlDl2kaCKEsSLHbMNNZC9XastzFiDbgMAAU1bf', '2019-04-12 09:17:46', '2019-04-01 04:04:23', '2019-04-12 09:17:46', NULL),
(8, 'trackdirector01@gmail.com', 'director', 'director', 'director', 'HUST', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'trackdirector01@gmail.com', NULL, '$2y$10$LRm09c7TW7RyG.SIvyRXq.Bz3k9uL7gGwjB9uMRSxjXXprV0GJKXq', 'Z1MeOIG8HtXB94aoEn9CDunAxcYnoigSkHpuLPqtDcZtpyZaUXQ5oCgXRjuA', '2019-06-11 07:20:19', '2019-04-22 03:08:52', '2019-06-11 07:20:19', NULL),
(9, 'author@gmail.com', 'Author', 'Author', 'Author', 'HUST', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'author@gmail.com', NULL, '$2y$10$7N0Tfp8h6dtfFTon5VKJT.5S9.W98VEJFcJxTVN3ha1r7AcduWGPm', 'M8BizDCJw5h1YBcZH6BVr1amtqC7ExUCTC9uRrnEaxm5aKbkTNMuAahR5gDJ', '2019-06-05 07:34:54', '2019-05-19 11:18:37', '2019-06-05 07:34:54', NULL),
(10, 'trackdirector02@gmail.com', 'Track', NULL, 'Director', 'HUST', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'trackdirector@gmail.com', NULL, '$2y$10$NMp0dLEPg9CYqmPpWsH4tev16kcmFS0LOOCCA/wOzbNT2obYH7xFu', 'guipUrE3o9zlRx2kikOoRmUKzelJdY8OEk34Looaa0AD7yk6j0OJus0r21NS', '2019-05-31 08:27:56', '2019-05-19 12:19:29', '2019-05-31 08:27:56', NULL),
(11, 'author 2', 'author', NULL, '002', 'HUST', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'author02@gmail.com', NULL, '$2y$10$1Ch5om0K4r1SMLQtfzq.heA534fCkFciYdrQIE0xEEkqJEKreDBai', NULL, NULL, '2019-05-19 13:24:10', '2019-05-19 13:24:10', NULL),
(12, 'reviewer002', 'Reviewer', '0', '2', 'Hust', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'reviewer002@gmail.com', NULL, '$2y$10$mYaXk9Oug81brIE17xFNNuKmMmrkrQ/LmE8G6X8Mu897E/ITkw5ci', '2cxmdsuqFPPIkrwiJ5wVIy8xzhrFJaXRSME5Yr9u3CV4HrqvJ8Qhx1S6sVuf', '2019-06-05 08:37:54', '2019-05-24 00:34:28', '2019-06-05 08:37:54', NULL),
(14, 'reviewer003', 'Reviewer', '0', '3', 'Hust', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'reviewer003@gmail.com', NULL, '$2y$10$mYaXk9Oug81brIE17xFNNuKmMmrkrQ/LmE8G6X8Mu897E/ITkw5ci', 'PbkjQG0zH9dywB5ePdpGhJAjGSj75QKz6RSYryg4VtyzOog20cskBmVu1Qom', '2019-06-11 07:30:56', '2019-05-24 00:34:28', '2019-06-11 07:30:56', NULL),
(15, 'reviewer004', 'Reviewer', '0', '4', 'Hust', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'reviewer004@gmail.com', NULL, '$2y$10$mYaXk9Oug81brIE17xFNNuKmMmrkrQ/LmE8G6X8Mu897E/ITkw5ci', 'cfGJdaK6B04pioGZP1fMUEOR1941EvrmxyYXNqbLj1bpxGqvPMVPBQvEfbEx', '2019-06-05 08:39:17', '2019-05-24 00:34:28', '2019-06-05 08:39:17', NULL),
(16, 'reviewer005', 'Reviewer', '0', '5', 'Hust', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'reviewer005@gmail.com', NULL, '$2y$10$mYaXk9Oug81brIE17xFNNuKmMmrkrQ/LmE8G6X8Mu897E/ITkw5ci', 'HRmLaxTFRVK9wzutUgdAPVt9nVsE6yAHr54WVETjclDx5U6kBHIgn3tN44g2', '2019-06-05 08:40:24', '2019-05-24 00:34:28', '2019-06-05 08:40:24', NULL),
(17, 'reviewer006', 'Reviewer', '0', '6', 'Hust', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'reviewer006@gmail.com', NULL, '$2y$10$mYaXk9Oug81brIE17xFNNuKmMmrkrQ/LmE8G6X8Mu897E/ITkw5ci', 'tA3XDWY8bsSBpWcN4akJwa3JBcSslVSUewgFXwO74PJab3f7I2bnV6TLSr8h', '2019-06-05 08:41:27', '2019-05-24 00:34:28', '2019-06-05 08:41:27', NULL),
(18, 'reviewer007', 'Reviewer', '0', '7', 'Hust', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'reviewer007@gmail.com', NULL, '$2y$10$mYaXk9Oug81brIE17xFNNuKmMmrkrQ/LmE8G6X8Mu897E/ITkw5ci', 'WmVBLJNx0zPA4ejOjMFoXnCgHLVa6w1Cm7ZyWrTZMnrivQ5B9eI88KltRGpq', '2019-06-05 08:42:18', '2019-05-24 00:34:28', '2019-06-05 08:42:18', NULL),
(19, '20144225', 'Thang', 'NGuyen', 'THnag', 'HUST', 'none', 'HHH', 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, '20144225@student.hust.edu.vn', NULL, '$2y$10$5aShqqRf3/0ZAfceV4LxMur1cB.uG7ewmWuflHLR3IeMKZYXyqJqS', NULL, NULL, '2019-05-29 11:34:56', '2019-05-29 11:34:56', NULL),
(20, 'luyen', 'Luyen', 'Thi', 'Nguyen', 'TUMP', 'female', 'LN', 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'luyentiachop@gmail.com', NULL, '$2y$10$F1mjQt74.2dq9tkAEQ5jRObAgCtGZzuj9QfqgeF3DAZtvKM8JicQO', NULL, NULL, '2019-05-29 11:35:37', '2019-05-29 11:35:37', NULL),
(21, 'user001', 'user', NULL, '001', 'HUST', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'user001@gmail.com', NULL, '$2y$10$4SmBE614DdYd8VHDkYmNi.L8BCSDVQLFVJGB4FLa6YTXeIKSrIJbm', '05ixiBKeu9OOGla9L4wEKUW95Einc5AzsH8sI6sx4PCpkgN1GjkoFozTYWYb', '2019-06-11 06:53:01', '2019-06-05 05:50:12', '2019-06-11 06:53:01', NULL),
(22, 'director', 'Director', NULL, '001', 'HUST', NULL, NULL, 0, NULL, NULL, NULL, 'avatar_default/user_default.jpg', '0', NULL, NULL, 'director001@gmail.com', NULL, '$2y$10$JduI.LWLY3wSwZSj0iDMVOIc3DtfrNccXypU5wkORiFBu1Kzy8Osi', 'ySK5KKWJu7pUJnONiF7JQvZq8qxRCwrSNUE5ZSTVeZySfdqKtNOtWqZ4M4jV', '2019-06-11 07:54:48', '2019-06-05 08:13:03', '2019-06-11 07:54:48', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_conference_roles`
--

CREATE TABLE `user_conference_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `conference_role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_history`
--

CREATE TABLE `user_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_history`
--

INSERT INTO `user_history` (`id`, `user_id`, `ip`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', '2019-03-26 09:01:01', '2019-03-26 09:01:01'),
(2, 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-03-27 03:16:31', '2019-03-27 03:16:31'),
(3, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-03-27 06:43:24', '2019-03-27 06:43:24'),
(4, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-03-27 10:01:13', '2019-03-27 10:01:13'),
(5, 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-03-27 14:36:33', '2019-03-27 14:36:33'),
(6, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-03-27 14:37:15', '2019-03-27 14:37:15'),
(7, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-03-27 14:38:55', '2019-03-27 14:38:55'),
(8, 5, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-03-28 07:56:24', '2019-03-28 07:56:24'),
(9, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-01 06:30:57', '2019-04-01 06:30:57'),
(10, 5, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-01 06:31:31', '2019-04-01 06:31:31'),
(11, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-01 06:33:03', '2019-04-01 06:33:03'),
(12, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-01 15:15:59', '2019-04-01 15:15:59'),
(13, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-02 01:41:28', '2019-04-02 01:41:28'),
(14, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-02 07:04:19', '2019-04-02 07:04:19'),
(15, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-02 13:16:06', '2019-04-02 13:16:06'),
(16, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-03 01:10:59', '2019-04-03 01:10:59'),
(17, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-03 01:34:33', '2019-04-03 01:34:33'),
(18, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-03 01:36:02', '2019-04-03 01:36:02'),
(19, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-03 01:38:22', '2019-04-03 01:38:22'),
(20, 5, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-03 03:03:35', '2019-04-03 03:03:35'),
(21, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-03 03:48:28', '2019-04-03 03:48:28'),
(22, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', '2019-04-03 04:22:58', '2019-04-03 04:22:58'),
(23, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-03 04:36:22', '2019-04-03 04:36:22'),
(24, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-03 04:48:08', '2019-04-03 04:48:08'),
(25, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-03 07:33:19', '2019-04-03 07:33:19'),
(26, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-04 06:51:01', '2019-04-04 06:51:01'),
(27, 7, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-05 03:15:53', '2019-04-05 03:15:53'),
(28, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-05 08:24:19', '2019-04-05 08:24:19'),
(29, 5, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-05 08:28:40', '2019-04-05 08:28:40'),
(30, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-05 08:32:05', '2019-04-05 08:32:05'),
(31, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-05 12:54:02', '2019-04-05 12:54:02'),
(32, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-06 06:21:09', '2019-04-06 06:21:09'),
(33, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-07 02:32:12', '2019-04-07 02:32:12'),
(34, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-08 06:14:03', '2019-04-08 06:14:03'),
(35, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-08 10:09:59', '2019-04-08 10:09:59'),
(36, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-08 14:17:07', '2019-04-08 14:17:07'),
(37, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-09 00:53:10', '2019-04-09 00:53:10'),
(38, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-09 04:38:49', '2019-04-09 04:38:49'),
(39, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-09 09:37:38', '2019-04-09 09:37:38'),
(40, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-09 13:07:13', '2019-04-09 13:07:13'),
(41, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-10 06:34:42', '2019-04-10 06:34:42'),
(42, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', '2019-04-10 10:16:15', '2019-04-10 10:16:15'),
(43, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-12 01:22:21', '2019-04-12 01:22:21'),
(44, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-12 02:49:41', '2019-04-12 02:49:41'),
(45, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-12 09:11:42', '2019-04-12 09:11:42'),
(46, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-12 09:14:58', '2019-04-12 09:14:58'),
(47, 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-12 09:16:23', '2019-04-12 09:16:23'),
(48, 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-12 09:17:46', '2019-04-12 09:17:46'),
(49, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-19 06:30:40', '2019-04-19 06:30:40'),
(50, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-20 05:45:14', '2019-04-20 05:45:14'),
(51, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-21 10:39:31', '2019-04-21 10:39:31'),
(52, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-21 14:40:29', '2019-04-21 14:40:29'),
(53, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-22 02:29:05', '2019-04-22 02:29:05'),
(54, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-22 03:09:51', '2019-04-22 03:09:51'),
(55, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-22 08:44:38', '2019-04-22 08:44:38'),
(56, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-22 09:07:32', '2019-04-22 09:07:32'),
(57, 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-22 09:08:18', '2019-04-22 09:08:18'),
(58, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-22 15:34:04', '2019-04-22 15:34:04'),
(59, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-22 15:35:16', '2019-04-22 15:35:16'),
(60, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-22 15:37:28', '2019-04-22 15:37:28'),
(61, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-04-23 05:25:55', '2019-04-23 05:25:55'),
(62, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36', '2019-05-02 02:51:07', '2019-05-02 02:51:07'),
(63, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '2019-05-14 04:49:28', '2019-05-14 04:49:28'),
(64, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '2019-05-14 15:12:30', '2019-05-14 15:12:30'),
(65, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '2019-05-15 02:56:34', '2019-05-15 02:56:34'),
(66, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '2019-05-15 07:59:19', '2019-05-15 07:59:19'),
(67, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36', '2019-05-15 15:32:36', '2019-05-15 15:32:36'),
(68, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', '2019-05-16 02:50:31', '2019-05-16 02:50:31'),
(69, 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', '2019-05-16 04:04:06', '2019-05-16 04:04:06'),
(70, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', '2019-05-16 05:11:08', '2019-05-16 05:11:08'),
(71, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', '2019-05-18 11:26:13', '2019-05-18 11:26:13'),
(72, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', '2019-05-19 02:34:58', '2019-05-19 02:34:58'),
(73, 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', '2019-05-19 04:18:55', '2019-05-19 04:18:55'),
(74, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', '2019-05-19 08:24:38', '2019-05-19 08:24:38'),
(75, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', '2019-05-20 06:51:40', '2019-05-20 06:51:40'),
(76, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', '2019-05-20 07:30:25', '2019-05-20 07:30:25'),
(77, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36', '2019-05-21 07:46:00', '2019-05-21 07:46:00'),
(78, 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', '2019-05-22 07:43:08', '2019-05-22 07:43:08'),
(79, 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', '2019-05-22 10:45:49', '2019-05-22 10:45:49'),
(80, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', '2019-05-24 11:03:46', '2019-05-24 11:03:46'),
(81, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', '2019-05-25 15:31:22', '2019-05-25 15:31:22'),
(82, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', '2019-05-26 02:43:52', '2019-05-26 02:43:52'),
(83, 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', '2019-05-26 02:45:17', '2019-05-26 02:45:17'),
(84, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', '2019-05-26 04:04:49', '2019-05-26 04:04:49'),
(85, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', '2019-05-26 07:15:04', '2019-05-26 07:15:04'),
(86, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', '2019-05-26 09:35:48', '2019-05-26 09:35:48'),
(87, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', '2019-05-26 10:08:54', '2019-05-26 10:08:54'),
(88, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', '2019-05-27 04:55:30', '2019-05-27 04:55:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expired_time` int(11) NOT NULL DEFAULT '15',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conferences`
--
ALTER TABLE `conferences`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conference_gallery`
--
ALTER TABLE `conference_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conference_partners_sponsers`
--
ALTER TABLE `conference_partners_sponsers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conference_permissions`
--
ALTER TABLE `conference_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `conference_roles`
--
ALTER TABLE `conference_roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conference_roles_permissions`
--
ALTER TABLE `conference_roles_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `conference_timeline`
--
ALTER TABLE `conference_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact_type`
--
ALTER TABLE `contact_type`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `criteria_review`
--
ALTER TABLE `criteria_review`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `event_category_links`
--
ALTER TABLE `event_category_links`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `event_registation`
--
ALTER TABLE `event_registation`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `event_registration_form_criteria`
--
ALTER TABLE `event_registration_form_criteria`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `membership_types`
--
ALTER TABLE `membership_types`
  ADD PRIMARY KEY (`id`,`name`);

--
-- Chỉ mục cho bảng `member_payment`
--
ALTER TABLE `member_payment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `new_categories`
--
ALTER TABLE `new_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `new_category_links`
--
ALTER TABLE `new_category_links`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `paper_author`
--
ALTER TABLE `paper_author`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `paper_event_log`
--
ALTER TABLE `paper_event_log`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `paper_files`
--
ALTER TABLE `paper_files`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `partners_sponsors`
--
ALTER TABLE `partners_sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `prepared_emails`
--
ALTER TABLE `prepared_emails`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reviewer_criteria`
--
ALTER TABLE `reviewer_criteria`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `review_assignments`
--
ALTER TABLE `review_assignments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `review_form`
--
ALTER TABLE `review_form`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_resource`
--
ALTER TABLE `role_resource`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `session_types`
--
ALTER TABLE `session_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Chỉ mục cho bảng `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `special_events`
--
ALTER TABLE `special_events`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `time_block`
--
ALTER TABLE `time_block`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `track_decisions`
--
ALTER TABLE `track_decisions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `track_director`
--
ALTER TABLE `track_director`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_conference_roles`
--
ALTER TABLE `user_conference_roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `conferences`
--
ALTER TABLE `conferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `conference_gallery`
--
ALTER TABLE `conference_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `conference_partners_sponsers`
--
ALTER TABLE `conference_partners_sponsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `conference_permissions`
--
ALTER TABLE `conference_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `conference_roles`
--
ALTER TABLE `conference_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `conference_roles_permissions`
--
ALTER TABLE `conference_roles_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1310;

--
-- AUTO_INCREMENT cho bảng `conference_timeline`
--
ALTER TABLE `conference_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `criteria_review`
--
ALTER TABLE `criteria_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `event_category_links`
--
ALTER TABLE `event_category_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `event_registation`
--
ALTER TABLE `event_registation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `event_registration_form_criteria`
--
ALTER TABLE `event_registration_form_criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `new_categories`
--
ALTER TABLE `new_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `new_category_links`
--
ALTER TABLE `new_category_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `papers`
--
ALTER TABLE `papers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `paper_author`
--
ALTER TABLE `paper_author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `paper_event_log`
--
ALTER TABLE `paper_event_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT cho bảng `paper_files`
--
ALTER TABLE `paper_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `partners_sponsors`
--
ALTER TABLE `partners_sponsors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `prepared_emails`
--
ALTER TABLE `prepared_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviewer_criteria`
--
ALTER TABLE `reviewer_criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `review_assignments`
--
ALTER TABLE `review_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `review_form`
--
ALTER TABLE `review_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `role_resource`
--
ALTER TABLE `role_resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `session_types`
--
ALTER TABLE `session_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `special_events`
--
ALTER TABLE `special_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `time_block`
--
ALTER TABLE `time_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `track_decisions`
--
ALTER TABLE `track_decisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `track_director`
--
ALTER TABLE `track_director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `user_conference_roles`
--
ALTER TABLE `user_conference_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT cho bảng `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
