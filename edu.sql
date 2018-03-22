-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-20 06:01:14
-- 服务器版本： 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edu`
--

-- --------------------------------------------------------

--
-- 表的结构 `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `uploader_id` int(10) UNSIGNED DEFAULT NULL COMMENT '上传者id',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int(10) UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `attachment_post`
--

CREATE TABLE `attachment_post` (
  `attachment_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `creator_id` int(10) UNSIGNED DEFAULT NULL,
  `is_target_blank` tinyint(1) NOT NULL DEFAULT '1' COMMENT '链接是否在新窗口打开',
  `enabled_at` timestamp NULL DEFAULT NULL COMMENT 'banner 启用时间',
  `expired_at` timestamp NULL DEFAULT NULL COMMENT 'banner 过期时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `banners`
--

INSERT INTO `banners` (`id`, `url`, `title`, `image`, `type_name`, `is_visible`, `creator_id`, `is_target_blank`, `enabled_at`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, NULL, '分类1', '793e10291d3b182a9dd115c3d14d18a7.jpeg', 'categorys', 1, 1, 1, NULL, NULL, '2018-03-19 05:23:00', '2018-03-19 05:23:00'),
(2, NULL, '分类2', 'cc37908ea4e00e4165ad5124504d7669.jpeg', 'categorys', 1, 1, 1, NULL, NULL, '2018-03-19 05:23:11', '2018-03-19 05:23:11'),
(3, NULL, '分类3', 'fb57fcd83e3f4b5d8bc4c8c7b2890600.jpeg', 'categorys', 1, 1, 1, NULL, NULL, '2018-03-19 05:23:20', '2018-03-19 05:23:20'),
(4, NULL, '分类4', 'dd0fe8a53107e3dc70b2d86f14a0a6ac.jpeg', 'categorys', 1, 1, 1, NULL, NULL, '2018-03-19 05:23:30', '2018-03-19 05:23:30');

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` char(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类类型 post: 列表栏目 page: 单页栏目 link: 外部链接 channel: 频道封面',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '分类图片',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级id',
  `cate_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名',
  `description` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '分类描述',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '外部链接',
  `is_target_blank` tinyint(1) NOT NULL DEFAULT '1' COMMENT '链接是否在新窗口打开',
  `cate_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_nav` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在导航栏显示',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序字段',
  `page_template` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '单页模板',
  `list_template` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '列表页模板',
  `channel_template` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '频道封面模板',
  `content_template` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '默认内容模板',
  `creator_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`id`, `type`, `image`, `parent_id`, `cate_name`, `description`, `url`, `is_target_blank`, `cate_slug`, `is_nav`, `order`, `page_template`, `list_template`, `channel_template`, `content_template`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'post', NULL, 0, '学科方向', NULL, NULL, 1, 'xue-ke-fang-xiang', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:17:41', '2018-03-19 05:17:41'),
(2, 'post', NULL, 0, '学术队伍', NULL, NULL, 1, 'xue-shu-dui-wu', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:17:51', '2018-03-19 05:17:51'),
(3, 'post', NULL, 0, '科学研究', NULL, NULL, 1, 'ke-xue-yan-jiu', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:18:00', '2018-03-19 05:18:00'),
(4, 'post', NULL, 0, '人才培养', NULL, NULL, 1, 'ren-cai-pei-yang', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:18:10', '2018-03-19 05:18:10'),
(5, 'post', NULL, 0, '学术交流', NULL, NULL, 1, 'xue-shu-jiao-liu', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:18:28', '2018-03-19 05:18:28'),
(6, 'post', NULL, 0, '课程建设', NULL, NULL, 1, 'ke-cheng-jian-she', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:18:40', '2018-03-19 05:18:40'),
(7, 'post', NULL, 0, '支撑条件', NULL, NULL, 1, 'zhi-cheng-tiao-jian', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:18:55', '2018-03-19 05:18:55'),
(8, 'post', NULL, 0, '规章制度', NULL, NULL, 1, 'gui-zhang-zhi-du', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:19:05', '2018-03-19 05:19:05'),
(9, 'post', NULL, 0, '学术动态', NULL, NULL, 1, 'xue-shu-dong-tai', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:19:14', '2018-03-19 05:19:14'),
(10, 'post', NULL, 0, '合作交流', NULL, NULL, 1, 'he-zuo-jiao-liu', 1, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:19:24', '2018-03-19 05:19:24'),
(11, 'post', NULL, 0, '新闻速递', NULL, NULL, 1, 'xin-wen-su-di', 0, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:19:40', '2018-03-19 05:19:40'),
(12, 'post', NULL, 0, '通知通告', NULL, NULL, 1, 'tong-zhi-tong-gao', 0, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:19:48', '2018-03-19 05:19:48'),
(13, 'post', NULL, 0, '资料下载', NULL, NULL, 1, 'zi-liao-xia-zai', 0, 0, NULL, 'default', NULL, 'default', 1, '2018-03-19 05:20:01', '2018-03-19 05:20:07');

-- --------------------------------------------------------

--
-- 表的结构 `links`
--

CREATE TABLE `links` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkman` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人',
  `type_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `creator_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `links`
--

INSERT INTO `links` (`id`, `url`, `name`, `logo`, `linkman`, `type_name`, `is_visible`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'https://baidu.com', '百度', NULL, NULL, 'friendship_links', 1, 1, '2018-03-19 05:24:51', '2018-03-19 05:24:51'),
(2, 'https://github.com', 'github', NULL, NULL, 'friendship_links', 1, 1, '2018-03-19 05:36:06', '2018-03-19 05:36:06');

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_09_062612_create_posts_table', 1),
(4, '2017_03_18_143310_create_categories_table', 1),
(5, '2017_03_19_101014_create_links_table', 1),
(6, '2017_03_20_023548_create_settings_table', 1),
(7, '2017_03_22_164010_create_types_table', 1),
(8, '2017_03_23_034505_create_user_logs_table', 1),
(9, '2017_04_05_204626_create_post_contents_table', 1),
(10, '2017_05_03_204902_create_banners_table', 1),
(11, '2017_08_21_112916_create_permission_tables', 1),
(12, '2017_09_03_223657_create_visitors_table', 1),
(13, '2017_10_01_104315_create_attachments_table', 1),
(14, '2017_10_01_200421_create_tags_table', 1),
(15, '2017_10_02_000413_attachment_post', 1);

-- --------------------------------------------------------

--
-- 表的结构 `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
(1, 1, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `display_name`, `description`, `order`, `created_at`, `updated_at`) VALUES
(1, 'posts.view', 'web', '查看文章', '查看文章', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(2, 'posts.add', 'web', '添加文章', '添加文章', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(3, 'posts.edit', 'web', '编辑文章', '编辑文章', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(4, 'posts.delete', 'web', '删除文章', '删除文章', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(5, 'categories.view', 'web', '查看栏目', '查看栏目', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(6, 'categories.add', 'web', '添加栏目', '添加栏目', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(7, 'categories.edit', 'web', '编辑栏目', '编辑栏目', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(8, 'categories.delete', 'web', '删除栏目', '删除栏目', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(9, 'banners.view', 'web', '查看 banners', '查看 banners', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(10, 'banners.add', 'web', '添加 banners', '添加 banners', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(11, 'banners.edit', 'web', '编辑 banners', '编辑 banners', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(12, 'banners.delete', 'web', '删除 banners', '删除 banners', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(13, 'links.view', 'web', '查看链接', '查看链接', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(14, 'links.add', 'web', '添加链接', '添加链接', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01'),
(15, 'links.edit', 'web', '编辑链接', '编辑链接', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(16, 'links.delete', 'web', '删除链接', '删除链接', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(17, 'settings.view', 'web', '查看设置', '查看设置', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(18, 'settings.add', 'web', '添加设置', '添加设置', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(19, 'settings.edit', 'web', '编辑设置', '编辑设置', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(20, 'settings.delete', 'web', '删除设置', '删除设置', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(21, 'types.view', 'web', '查看分类', '查看分类', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(22, 'types.add', 'web', '添加分类', '添加分类', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(23, 'types.edit', 'web', '编辑分类', '编辑分类', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(24, 'types.delete', 'web', '删除分类', '删除分类', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(25, 'attachments.view', 'web', '查看附件', '查看附件', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(26, 'attachments.add', 'web', '添加附件', '添加附件', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(27, 'attachments.edit', 'web', '编辑附件', '编辑附件', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(28, 'attachments.delete', 'web', '删除附件', '删除附件', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(29, 'tags.view', 'web', '查看标签', '查看标签', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(30, 'tags.add', 'web', '添加标签', '添加标签', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(31, 'tags.edit', 'web', '编辑标签', '编辑标签', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(32, 'tags.delete', 'web', '删除标签', '删除标签', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(33, 'users.view', 'web', '查看用户', '查看用户', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(34, 'users.add', 'web', '添加用户', '添加用户', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(35, 'users.edit', 'web', '编辑用户', '编辑用户', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(36, 'users.delete', 'web', '删除用户', '删除用户', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(37, 'roles.view', 'web', '查看角色', '查看角色', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(38, 'roles.add', 'web', '添加角色', '添加角色', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(39, 'roles.edit', 'web', '编辑角色', '编辑角色', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(40, 'roles.delete', 'web', '删除角色', '删除角色', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(41, 'posts.restore', 'web', '恢复删除的文章', '恢复删除的文章', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(42, 'categories.page.view', 'web', '查看单页', '查看单页', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(43, 'categories.page.edit', 'web', '编辑单页', '编辑单页', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02'),
(44, 'roles.permissions', 'web', '获取角色的权限', '获取角色的权限', 0, '2018-03-19 05:15:02', '2018-03-19 05:15:02');

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文章封面',
  `category_id` int(10) UNSIGNED NOT NULL COMMENT '分类 id',
  `status` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish' COMMENT '文章状态：publish 发布 draft 草稿',
  `type` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post' COMMENT '类型: post: 文章 page: 单页 channel: 频道封面',
  `views_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `top` timestamp NULL DEFAULT NULL,
  `top_expired_at` timestamp NULL DEFAULT NULL COMMENT '置顶过期时间',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序字段',
  `template` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fields` mediumtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `excerpt`, `cover`, `category_id`, `status`, `type`, `views_count`, `top`, `top_expired_at`, `order`, `template`, `fields`, `deleted_at`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Office 下载', 'Office-xia-zai', 'office下载office下载office下载office下载office下载office下载office下载', NULL, 13, 'publish', 'post', 0, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:03:44', '2018-03-19 06:04:10', '2018-03-19 06:04:10'),
(2, 1, '2018年清华大学硕士生入学考试工程物理系复试方案', '2018-nian-qing-hua-da-xue-shuo-shi-sheng-ru-xue-kao-shi-gong-cheng-wu-li-xi-fu-shi-fang-an', '2018年清华大学硕士生入学考试工程物理系复试方案', NULL, 12, 'publish', 'post', 0, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:31:29', '2018-03-19 06:31:51', '2018-03-19 06:31:51'),
(3, 1, '2017年清华大学硕士生入学考试工程物理系复试方案', '2017-nian-qing-hua-da-xue-shuo-shi-sheng-ru-xue-kao-shi-gong-cheng-wu-li-xi-fu-shi-fang-an', '2017年清华大学硕士生入学考试工程物理系复试方案', NULL, 12, 'publish', 'post', 1, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:31:54', '2018-03-19 06:32:16', '2018-03-19 09:50:40'),
(4, 1, '2016年清华大学硕士生入学考试工程物理系复试方案', '2016-nian-qing-hua-da-xue-shuo-shi-sheng-ru-xue-kao-shi-gong-cheng-wu-li-xi-fu-shi-fang-an', '2016年清华大学硕士生入学考试工程物理系复试方案', NULL, 12, 'publish', 'post', 1, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:32:18', '2018-03-19 06:32:31', '2018-03-19 09:50:35'),
(5, 1, '2019年清华大学硕士生入学考试工程物理系复试方案', '2019-nian-qing-hua-da-xue-shuo-shi-sheng-ru-xue-kao-shi-gong-cheng-wu-li-xi-fu-shi-fang-an', '2019年清华大学硕士生入学考试工程物理系复试方案', NULL, 12, 'publish', 'post', 3, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:33:08', '2018-03-19 06:33:20', '2018-03-19 09:50:33'),
(6, 1, '2020年清华大学硕士生入学考试工程物理系复试方案', '2020-nian-qing-hua-da-xue-shuo-shi-sheng-ru-xue-kao-shi-gong-cheng-wu-li-xi-fu-shi-fang-an', '2020年清华大学硕士生入学考试工程物理系复试方案', NULL, 12, 'publish', 'post', 1, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:33:26', '2018-03-19 06:33:46', '2018-03-19 09:50:31'),
(7, 1, '2016 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2016-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '清华大学核电国际硕士项目赴沙特招生宣传圆满结束', NULL, 11, 'publish', 'post', 2, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-18 22:54:52', '2018-03-19 06:55:16', '2018-03-19 08:20:52'),
(8, 1, '2017 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2017-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '清华大学核电国际硕士项目赴沙特招生宣传圆满结束', NULL, 11, 'publish', 'post', 1, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:55:31', '2018-03-19 06:55:56', '2018-03-19 08:21:08'),
(9, 1, '2018 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2018-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '2018清华大学核电国际硕士项目赴沙特招生宣传圆满结束', NULL, 11, 'publish', 'post', 2, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:56:10', '2018-03-19 06:56:25', '2018-03-19 08:23:58'),
(10, 1, '2019 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2019-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '2019清华大学核电国际硕士项目赴沙特招生宣传圆满结束', NULL, 11, 'publish', 'post', 2, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:56:31', '2018-03-19 06:56:42', '2018-03-19 08:23:55'),
(11, 1, '2020 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2020-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '2020清华大学核电国际硕士项目赴沙特招生宣传圆满结束', NULL, 11, 'publish', 'post', 4, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:56:44', '2018-03-19 06:56:59', '2018-03-19 09:17:45'),
(12, 1, '2021 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2021-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '2021清华大学核电国际硕士项目赴沙特招生宣传圆满结束', NULL, 11, 'publish', 'post', 1, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:57:04', '2018-03-19 06:57:17', '2018-03-19 09:17:48'),
(13, 1, '2022 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2022-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '2022清华大学核电国际硕士项目赴沙特招生宣传圆满结束', NULL, 11, 'publish', 'post', 0, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:57:19', '2018-03-19 06:57:32', '2018-03-19 06:57:32'),
(14, 1, '2023 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2023-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '2023清华大学核电国际硕士项目赴沙特招生宣传圆满结束', NULL, 11, 'publish', 'post', 7, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:57:35', '2018-03-19 06:57:46', '2018-03-19 09:50:42'),
(15, 1, '2024 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2024-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '2024清华大学核电国际硕士项目赴沙特招生宣传圆满结束', NULL, 11, 'publish', 'post', 5, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-19 06:57:55', '2018-03-19 06:58:09', '2018-03-19 09:50:43'),
(16, 1, '2025 清华大学核电国际硕士项目赴沙特招生宣传圆满结束', '2025-qing-hua-da-xue-he-dian-guo-ji-shuo-shi-xiang-mu-fu-sha-te-zhao-sheng-xuan-chuan-yuan-man-jie-shu', '1月7-13日，清华大学核电工程与管理国际人才培养专业硕士学位项目（TUNEM）代表团赴土耳其进行招生宣传。', '48ccd175218b8c372b495a39d89e7e98.png', 11, 'publish', 'post', 11, NULL, NULL, 0, 'default', '[]', NULL, '2018-03-18 22:58:14', '2018-03-19 06:58:34', '2018-03-19 09:50:47');

-- --------------------------------------------------------

--
-- 表的结构 `post_contents`
--

CREATE TABLE `post_contents` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `post_contents`
--

INSERT INTO `post_contents` (`post_id`, `content`, `created_at`, `updated_at`) VALUES
(1, '<p>office下载office下载office下载office下载office下载office下载office下载</p>', '2018-03-19 06:04:10', '2018-03-19 06:04:10'),
(2, '<p><a>2018年清华大学硕士生入学考试工程物理系复试方案</a></p>', '2018-03-19 06:31:51', '2018-03-19 06:31:51'),
(3, '<p><a>2017年清华大学硕士生入学考试工程物理系复试方案</a></p>', '2018-03-19 06:32:16', '2018-03-19 06:32:16'),
(4, '<p><a>2016年清华大学硕士生入学考试工程物理系复试方案</a></p>', '2018-03-19 06:32:31', '2018-03-19 06:32:31'),
(5, '<p><a>2019年清华大学硕士生入学考试工程物理系复试方案</a></p>', '2018-03-19 06:33:20', '2018-03-19 06:33:20'),
(6, '<p><a>2020年清华大学硕士生入学考试工程物理系复试方案</a></p>', '2018-03-19 06:33:46', '2018-03-19 06:33:46'),
(7, '<p><a></a></p><h2 style=\"margin:0px;padding:0px;font-size:16px;color:rgb(12,158,201);overflow:hidden;\"><a>清华大学核电国际硕士项目赴沙特招生宣传圆满结束</a></h2><p><br></p>', '2018-03-19 06:55:16', '2018-03-19 06:56:06'),
(8, '<p><a></a></p><h2 style=\"margin:0px;padding:0px;font-size:16px;color:rgb(12,158,201);overflow:hidden;\"><a>清华大学核电国际硕士项目赴沙特招生宣传圆满结束</a></h2><p></p>', '2018-03-19 06:55:56', '2018-03-19 06:55:56'),
(9, '<p>2018清华大学核电国际硕士项目赴沙特招生宣传圆满结束</p>', '2018-03-19 06:56:25', '2018-03-19 06:56:25'),
(10, '<p>2019清华大学核电国际硕士项目赴沙特招生宣传圆满结束</p>', '2018-03-19 06:56:42', '2018-03-19 06:56:42'),
(11, '<p>2020清华大学核电国际硕士项目赴沙特招生宣传圆满结束</p>', '2018-03-19 06:56:59', '2018-03-19 06:56:59'),
(12, '<p>2021清华大学核电国际硕士项目赴沙特招生宣传圆满结束</p>', '2018-03-19 06:57:17', '2018-03-19 06:57:17'),
(13, '<p>2022清华大学核电国际硕士项目赴沙特招生宣传圆满结束</p>', '2018-03-19 06:57:32', '2018-03-19 06:57:32'),
(14, '<p>2023清华大学核电国际硕士项目赴沙特招生宣传圆满结束</p>', '2018-03-19 06:57:46', '2018-03-19 06:57:46'),
(15, '<p>2024清华大学核电国际硕士项目赴沙特招生宣传圆满结束</p>', '2018-03-19 06:58:09', '2018-03-19 06:58:09'),
(16, '<p><a></a></p><p style=\"margin-top:15px;margin-bottom:0px;padding:0px;font-size:14px;color:rgb(102,102,102);overflow:hidden;\"><a>1月7-13日，清华大学核电工程与管理国际人才培养专业硕士学位项目（TUNEM）代表团赴土耳其进行招生宣传。</a></p><a></a>', '2018-03-19 06:58:34', '2018-03-19 06:59:01');

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `display_name`, `description`, `order`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '管理员', '管理员拥有所有权限', 0, '2018-03-19 05:15:01', '2018-03-19 05:15:01');

-- --------------------------------------------------------

--
-- 表的结构 `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1);

-- --------------------------------------------------------

--
-- 表的结构 `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为系统配置',
  `creator_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `description`, `type_name`, `is_system`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'address', '安徽省淮南市洞山西路', NULL, 'system', 0, 1, '2018-03-19 05:25:29', '2018-03-19 05:25:29'),
(2, 'zip_code', '232038', NULL, 'system', 0, 1, '2018-03-19 05:26:13', '2018-03-19 05:26:13'),
(3, 'phone', '0554-6863832', NULL, 'system', 0, 1, '2018-03-19 05:26:28', '2018-03-19 05:26:28'),
(4, 'copyright', '淮南师范学院教育学院', NULL, 'system', 0, 1, '2018-03-19 05:26:48', '2018-03-19 05:26:48'),
(5, 'support', 'E8团队', NULL, 'system', 0, 1, '2018-03-19 05:27:22', '2018-03-19 05:27:32');

-- --------------------------------------------------------

--
-- 表的结构 `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` int(10) UNSIGNED NOT NULL,
  `taggable_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类型描述',
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `types`
--

INSERT INTO `types` (`id`, `name`, `display_name`, `description`, `model_name`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'system', '系统配置', '系统配置', 'App\\Models\\Setting', NULL, NULL, NULL),
(2, 'categorys', '学术队伍', NULL, 'App\\Models\\Banner', 1, '2018-03-19 05:22:40', '2018-03-19 05:22:40'),
(3, 'friendship_links', '友情链接', NULL, 'App\\Models\\Link', 1, '2018-03-19 05:24:20', '2018-03-19 05:24:20');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locked_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `user_name`, `nick_name`, `email`, `avatar`, `password`, `locked_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'tiny', 'tiny', 'tiny@test.com', 'fb1568a03f24ff69531da4b50a8d698d.jpeg', '$2y$10$Hj8DflsbJ7sym7d7bZM9DuWVM6dXGrmfIpzb6dtmAr3KFsjDpqYYW', NULL, '5sfDemxJpp', '2018-03-19 05:15:00', '2018-03-19 05:22:02');

-- --------------------------------------------------------

--
-- 表的结构 `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL COMMENT '用户 ID',
  `action_id` int(10) UNSIGNED NOT NULL COMMENT '操作 ID',
  `action_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作类型',
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作',
  `changes` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作变化',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(10) UNSIGNED NOT NULL COMMENT '访问量',
  `referring_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `visitors`
--

INSERT INTO `visitors` (`id`, `ip`, `views`, `referring_site`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 364, NULL, '2018-03-19 05:33:39', '2018-03-19 09:50:47'),
(2, '127.0.0.2', 59, NULL, '2018-03-19 05:33:39', '2018-03-19 07:14:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_uploader_id_foreign` (`uploader_id`);

--
-- Indexes for table `attachment_post`
--
ALTER TABLE `attachment_post`
  ADD PRIMARY KEY (`attachment_id`,`post_id`),
  ADD KEY `attachment_post_post_id_foreign` (`post_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_creator_id_foreign` (`creator_id`),
  ADD KEY `banners_type_name_index` (`type_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_cate_name_unique` (`cate_name`),
  ADD UNIQUE KEY `categories_cate_slug_unique` (`cate_slug`),
  ADD KEY `categories_creator_id_foreign` (`creator_id`),
  ADD KEY `categories_order_index` (`order`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `links_creator_id_foreign` (`creator_id`),
  ADD KEY `links_type_name_index` (`type_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD KEY `permissions_order_index` (`order`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_index` (`user_id`),
  ADD KEY `posts_category_id_index` (`category_id`),
  ADD KEY `posts_views_count_index` (`views_count`),
  ADD KEY `posts_top_index` (`top`),
  ADD KEY `posts_order_index` (`order`);

--
-- Indexes for table `post_contents`
--
ALTER TABLE `post_contents`
  ADD UNIQUE KEY `post_contents_post_id_unique` (`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD KEY `roles_order_index` (`order`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_unique` (`name`),
  ADD KEY `settings_creator_id_foreign` (`creator_id`),
  ADD KEY `settings_type_name_index` (`type_name`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD KEY `taggables_taggable_id_taggable_type_index` (`taggable_id`,`taggable_type`),
  ADD KEY `taggables_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`),
  ADD KEY `tags_creator_id_foreign` (`creator_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `types_name_model_name_unique` (`name`,`model_name`),
  ADD KEY `types_creator_id_foreign` (`creator_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 使用表AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 限制导出的表
--

--
-- 限制表 `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_uploader_id_foreign` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `attachment_post`
--
ALTER TABLE `attachment_post`
  ADD CONSTRAINT `attachment_post_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attachment_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- 限制表 `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- 限制表 `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- 限制表 `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `types_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
