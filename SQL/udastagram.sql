-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2021 年 6 月 16 日 01:28
-- サーバのバージョン： 5.7.32
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `udastagram`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `comment_reply`
--

CREATE TABLE `comment_reply` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `good`
--

CREATE TABLE `good` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `click_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `good`
--

INSERT INTO `good` (`id`, `post_id`, `user_id`, `click_at`) VALUES
(160, 58, 33, '2021-06-10 02:03:18');

-- --------------------------------------------------------

--
-- テーブルの構造 `post_data`
--

CREATE TABLE `post_data` (
  `id` int(11) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide0` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slide2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slide3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slide4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slide5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slide6` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slide7` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `movie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `post_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `publish_status` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `post_address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `post_data`
--

INSERT INTO `post_data` (`id`, `title`, `slide0`, `slide1`, `slide2`, `slide3`, `slide4`, `slide5`, `slide6`, `slide7`, `movie`, `content`, `category`, `post_at`, `publish_status`, `user_id`, `post_address`) VALUES
(58, 'test', '../images/202106100157230.jpg', '../images/202106100157231.jpg', '../images/202106100157232.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', 4, '2021-06-14 13:29:15', 1, 33, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `top_image`, `email`, `password`, `post_id`) VALUES
(33, 'テスト太郎', '../images/20210610015325.jpg', 'test@test.com', '$2y$10$5Qy41k31pmasP9.iShDV3e.4XIDjd22tGvBsprPlYQL.UJX4iDm7C', NULL),
(34, 'test-jiro', '../images/20210610015325.jpg', 'test2@test.com', '$2y$10$MQSVAOklUjN.WSZ.NvSuT.m1mkd3EdDIu.4rWUoseoSpazC22OTeO', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `comment_reply`
--
ALTER TABLE `comment_reply`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `good`
--
ALTER TABLE `good`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `post_data`
--
ALTER TABLE `post_data`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `comment_reply`
--
ALTER TABLE `comment_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `good`
--
ALTER TABLE `good`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- テーブルの AUTO_INCREMENT `post_data`
--
ALTER TABLE `post_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
