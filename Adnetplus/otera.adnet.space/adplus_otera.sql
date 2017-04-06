-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2017 at 04:26 PM
-- Server version: 5.5.45-log
-- PHP Version: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annivers_haken`
--

-- --------------------------------------------------------

--
-- Table structure for table `classification_request`
--

CREATE TABLE IF NOT EXISTS `classification_request` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT '担当区分',
  `count_nin` int(11) NOT NULL COMMENT '人数',
  `time_start` varchar(5) DEFAULT NULL,
  `time_end` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classification_request`
--

INSERT INTO `classification_request` (`id`, `request_id`, `type_id`, `count_nin`, `time_start`, `time_end`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '13 午後', '15 午後', '2016-11-01 17:42:31', '2016-11-01 17:42:31'),
(2, 1, 2, 0, '', '', '2016-11-01 17:42:31', '2016-11-01 17:42:31'),
(3, 1, 3, 0, '', '', '2016-11-01 17:42:31', '2016-11-01 17:42:31'),
(4, 1, 3, 0, '', '', '2016-11-01 17:42:31', '2016-11-01 17:42:31'),
(5, 2, 1, 1, '12 午後', '13 午後', '2016-11-01 18:07:36', '2016-11-01 18:07:36'),
(6, 2, 2, 0, '', '', '2016-11-01 18:07:36', '2016-11-01 18:07:36'),
(7, 2, 3, 0, '', '', '2016-11-01 18:07:36', '2016-11-01 18:07:36'),
(8, 2, 3, 0, '', '', '2016-11-01 18:07:36', '2016-11-01 18:07:36'),
(9, 3, 1, 2, '09 午前', '15 午後', '2016-11-03 21:55:45', '2016-11-03 21:55:45'),
(10, 3, 2, 2, '13 午後', '15 午後', '2016-11-03 21:55:45', '2016-11-03 21:55:45'),
(11, 3, 3, 2, '11 午前', '15 午後', '2016-11-03 21:55:45', '2016-11-03 21:55:45'),
(12, 3, 3, 0, '', '', '2016-11-03 21:55:45', '2016-11-03 21:55:45'),
(13, 4, 1, 2, '14 午後', '16 午後', '2016-11-03 22:12:39', '2016-11-03 22:12:39'),
(14, 4, 2, 2, '14 午後', '16 午後', '2016-11-03 22:12:39', '2016-11-03 22:12:39'),
(15, 4, 3, 2, '11 午前', '15 午後', '2016-11-03 22:12:39', '2016-11-03 22:12:39'),
(16, 4, 3, 0, '', '', '2016-11-03 22:12:39', '2016-11-03 22:12:39'),
(17, 5, 1, 0, '', '', '2016-12-18 15:41:34', '2016-12-18 15:41:34'),
(18, 5, 2, 1, '15 午後', '17 午後', '2016-12-18 15:41:34', '2016-12-18 15:41:34'),
(19, 5, 3, 1, '14 午後', '18 午後', '2016-12-18 15:41:34', '2016-12-18 15:41:34'),
(20, 5, 3, 0, '', '', '2016-12-18 15:41:34', '2016-12-18 15:41:34'),
(21, 6, 1, 0, '', '', '2016-12-22 00:23:12', '2016-12-22 00:23:12'),
(22, 6, 2, 1, '12 午後', '14 午後', '2016-12-22 00:23:12', '2016-12-22 00:23:12'),
(23, 6, 3, 1, '12 午後', '16 午後', '2016-12-22 00:23:12', '2016-12-22 00:23:12'),
(24, 6, 3, 0, '', '', '2016-12-22 00:23:12', '2016-12-22 00:23:12'),
(25, 7, 1, 0, '', '', '2016-12-22 00:32:48', '2016-12-22 00:32:48'),
(26, 7, 2, 1, '15 午後', '17 午後', '2016-12-22 00:32:48', '2016-12-22 00:32:48'),
(27, 7, 3, 1, '14 午後', '18 午後', '2016-12-22 00:32:48', '2016-12-22 00:32:48'),
(28, 7, 3, 0, '', '', '2016-12-22 00:32:48', '2016-12-22 00:32:48'),
(29, 8, 1, 0, '', '', '2016-12-22 00:49:43', '2016-12-22 00:49:43'),
(30, 8, 2, 1, '10 午前', '12 午後', '2016-12-22 00:49:43', '2016-12-22 00:49:43'),
(31, 8, 3, 1, '09 午前', '13 午後', '2016-12-22 00:49:43', '2016-12-22 00:49:43'),
(32, 8, 3, 0, '', '', '2016-12-22 00:49:43', '2016-12-22 00:49:43'),
(33, 9, 1, 0, '', '', '2016-12-22 00:55:30', '2016-12-22 00:55:30'),
(34, 9, 2, 1, '16 午後', '18 午後', '2016-12-22 00:55:30', '2016-12-22 00:55:30'),
(35, 9, 3, 1, '15 午後', '19 午後', '2016-12-22 00:55:30', '2016-12-22 00:55:30'),
(36, 9, 3, 0, '', '', '2016-12-22 00:55:30', '2016-12-22 00:55:30'),
(37, 10, 1, 0, '', '', '2017-01-18 17:39:33', '2017-01-18 17:39:33'),
(38, 10, 2, 1, '10 午前', '12 午後', '2017-01-18 17:39:33', '2017-01-18 17:39:33'),
(39, 10, 3, 2, '09 午前', '13 午後', '2017-01-18 17:39:33', '2017-01-18 17:39:33'),
(40, 10, 3, 0, '', '', '2017-01-18 17:39:33', '2017-01-18 17:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `funeral`
--

CREATE TABLE IF NOT EXISTS `funeral` (
  `id` int(11) NOT NULL,
  `funeral_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funeral`
--

INSERT INTO `funeral` (`id`, `funeral_name`) VALUES
(1, '葬儀式'),
(3, '法要');

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE IF NOT EXISTS `reason` (
  `id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reason`
--

INSERT INTO `reason` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '別の葬儀がある。', '2016-10-10 00:00:00', '2016-10-10 00:00:00'),
(2, '専門の宗派ではない。', '2016-10-10 00:00:00', '2016-10-10 00:00:00'),
(3, '自己都合。', '2016-10-10 00:00:00', '2016-10-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL,
  `funeral_id` int(11) DEFAULT NULL,
  `undertaker_id` int(11) NOT NULL,
  `funeral_name` varchar(32) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `chief_name` varchar(32) DEFAULT NULL,
  `religious` varchar(16) NOT NULL COMMENT '宗',
  `faction` varchar(16) NOT NULL COMMENT '派',
  `otera_name` varchar(64) NOT NULL COMMENT '寺院名',
  `venue` varchar(64) NOT NULL COMMENT '会場名',
  `venue_address` varchar(128) NOT NULL COMMENT '会場住所',
  `times_funeral` int(11) DEFAULT NULL COMMENT '回葬予想人数',
  `contact_matter` text NOT NULL COMMENT '連絡事項',
  `type_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: active; 1: Done and close request',
  `delflag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: deleted',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `funeral_id`, `undertaker_id`, `funeral_name`, `start_time`, `chief_name`, `religious`, `faction`, `otera_name`, `venue`, `venue_address`, `times_funeral`, `contact_matter`, `type_id`, `status`, `delflag`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '島田てる子', '2016-11-17 00:00:00', '島田貞治', '浄土真宗', '真宗大谷', '高徳寺', '〇〇セレモニー会館', '香川県高松市川島東町280-1', 15, '連絡事項です。', NULL, 1, 1, '2016-11-02 02:42:31', '2016-11-02 03:13:03'),
(2, 1, 1, '島田てる子', '2016-10-28 14:00:00', '島田貞治', '浄土真宗', '真宗大谷', '高徳寺', '〇〇セレモニー会館', '香川県高松市川島東町280-1', 15, '連絡事項です。', NULL, 0, 1, '2016-11-02 03:07:36', '2016-11-02 03:13:15'),
(3, 1, 1, '島田てる子', '2016-11-16 06:00:00', '島田貞治', '浄土真宗', '真宗大谷', '高徳寺', '〇〇セレモニー会館', '香川県高松市川島東町280-1', 15, '依頼をしたときのメール送信テストを目的とした依頼です。\r\n', NULL, 0, 1, '2016-11-04 06:55:45', '2016-11-04 07:25:54'),
(4, 1, 1, '島田てる子', '2016-11-23 14:00:00', '島田貞治', '浄土真宗', '真宗大谷', '高徳寺', '〇〇セレモニー会館', '香川県高松市川島東町280-1', 15, '依頼送信時のメール確認用の依頼になります。', NULL, 0, 1, '2016-11-04 07:12:39', '2016-11-04 07:25:51'),
(5, 1, 1, '島田てる子', '2016-12-21 15:00:00', '島田貞治', '浄土真宗', '真宗大谷', '高徳寺', '会館', '〇〇セレモニー会館　〇〇店', 10, 'お世話になっております。\r\nアドネットです。\r\nこちらは模擬形式の葬儀の依頼になります。\r\nよろしくお願いいたします。', NULL, 0, 0, '2016-12-19 00:41:34', '2016-12-19 00:41:34'),
(6, 1, 1, '島岡　幸子', '2016-12-24 12:00:00', '島岡　大輔', '浄土真宗', '真宗大谷', '高徳寺', '自宅', '香川県高松市川島東町280-1', 1, 'お世話になっております。\r\nアドネットです。\r\n\r\n依頼のテストをこれより2度程行います。\r\nよろしくお願いいたします。\r\n', NULL, 0, 0, '2016-12-22 09:23:12', '2016-12-22 09:23:12'),
(7, 1, 1, '島田　南', '2016-12-24 15:00:00', '島田　奈津美', '浄土真宗', '真宗大谷', '高徳寺', '会館', '〇〇セレモニー会館　〇〇店', 1, 'お世話になっております。\r\nアドネットです。\r\n\r\nこちらは2度目のメールテストになります。\r\nこちらで、普通の受信Boxに入ると思われます。\r\n\r\nよろしくお願いいたします。', NULL, 0, 0, '2016-12-22 09:32:48', '2016-12-22 09:32:48'),
(8, 1, 1, '島崎　和歌子', '2016-12-24 10:00:00', '島崎　春香', '浄土真宗', '真宗大谷', '高徳寺', '会館', '〇〇セレモニー会館　〇〇店', 1, 'お世話になっております。\r\nアドネットです。\r\n\r\nたびたびメール失礼いたします。\r\n迷惑メールから表示されないように設定したあとのテスト依頼になります。\r\n\r\nよろしくお願いいたします。\r\n', NULL, 0, 0, '2016-12-22 09:49:43', '2016-12-22 09:49:43'),
(9, 1, 1, '島川　敏夫', '2016-12-25 16:00:00', '島川　秀介', '浄土真宗', '真宗大谷', '高徳寺', '会館', '〇〇セレモニー会館　〇〇店', 1, 'お世話になっております。\r\nアドネットです。\r\n\r\nこちら、携帯電話の方への転送を確認するためのテスト依頼です。\r\n\r\nよろしくお願いいたします。', NULL, 0, 0, '2016-12-22 09:55:30', '2016-12-22 09:55:30'),
(10, 1, 1, 'まごころ家', '2017-01-20 11:00:00', '　ｘｘｘｘｘｘ', '真言宗', '善通寺', '瑞雲寺', '会館', '', 100, '', NULL, 0, 0, '2017-01-19 02:39:33', '2017-01-19 02:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `request_user`
--

CREATE TABLE IF NOT EXISTS `request_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request_user`
--

INSERT INTO `request_user` (`id`, `user_id`, `request_id`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2016-11-02 03:10:05', '2016-11-02 03:10:05'),
(2, 4, 3, '2016-11-04 07:22:40', '2016-11-04 07:22:40'),
(3, 5, 10, '2017-01-19 10:26:54', '2017-01-19 10:26:54'),
(4, 9, 10, '2017-01-19 13:21:15', '2017-01-19 13:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `type_work`
--

CREATE TABLE IF NOT EXISTS `type_work` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_work`
--

INSERT INTO `type_work` (`id`, `name`) VALUES
(2, '司会・進行'),
(3, 'アシスタント');

-- --------------------------------------------------------

--
-- Table structure for table `undertaker`
--

CREATE TABLE IF NOT EXISTS `undertaker` (
  `id` int(11) NOT NULL,
  `account_id` varchar(32) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `encrypt_pass` varchar(255) CHARACTER SET utf8 NOT NULL,
  `undertaker_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `other_name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `address` varchar(32) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(16) CHARACTER SET utf8 NOT NULL,
  `emails` varchar(256) CHARACTER SET utf8 NOT NULL,
  `delflag` tinyint(1) DEFAULT '0' COMMENT '1: deleted',
  `remember_token` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `undertaker`
--

INSERT INTO `undertaker` (`id`, `account_id`, `password`, `encrypt_pass`, `undertaker_name`, `other_name`, `address`, `phone`, `emails`, `delflag`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ABC2604', '$2y$10$xH3SYTElIhCJ97ADqQhxAO/WbGfLMnqiGCG6jvW378E83wrhvHLa6', 'ohz0IHPvHD5NbKXX/TYVyDD5lw35oaD8y8X6wA6stHs=', 'まごころ会館', 'まごころ会館', '観音寺市植田町１０３６ー１', '0875-23-1139', 'adnetinokihara@gmail.com', 0, 'h4QTPeLkX5HfWlXmdUo0jQNxZYGVf5bP8FxIK1nt7viKra9d8a9EYohKVm0R', '2016-11-02 01:17:23', '2017-01-19 10:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `account_id` varchar(32) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `encrypt_pass` varchar(255) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `religion` text NOT NULL COMMENT '宗派',
  `birthday` datetime DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `address` varchar(32) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `emails` varchar(256) NOT NULL,
  `answer` tinyint(4) DEFAULT NULL,
  `detail` text NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `mail_send` datetime DEFAULT NULL,
  `delflag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: deleted',
  `remember_token` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_id`, `password`, `encrypt_pass`, `name`, `religion`, `birthday`, `type_id`, `address`, `phone`, `emails`, `answer`, `detail`, `role`, `mail_send`, `delflag`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'adminadplus', '$2y$10$QASRAi5WXnIHbGTRtZLdA.pNtbriK7KlOMrYlkw2CQA3qrGKabcBa', NULL, 'admin', '', NULL, NULL, '', '', '', NULL, '', 1, NULL, 0, '1ychFQ4AYC8Wo0K91Mki3wbo1kncwZI9jywZtU2Ah9FUR7B1udFVNg2i2yFE', '0000-00-00 00:00:00', '2017-01-20 01:25:50'),
(5, 'ABC8267', '$2y$10$8emMv8eSLk5hUdu.5tJ1OOicICRTmmYevij7nj0t6FbwE8vpvyCaK', 'CWimcD39hrjaTdM9JJuEFsXKK/pzak5jUDlNVIeJFKg=', '林  理栄子', 'xx', '1971-07-07 00:00:00', 3, '観音寺市豊浜町和田浜１３５－８', '090-4975-2071', 'rio.rise.rituki3@i.softbank.jp', NULL, '', 0, NULL, 0, 'LoY0I4weo6YdcsKnhNMQojHN95mP1AD1PEWTGExLio5DFX80MmDxDgJFne20', '2016-11-17 06:41:01', '2017-01-19 10:19:33'),
(6, 'ABC6981', '$2y$10$k0co9yVIpPzhVVrVX3Vc2.GSPgXubeI4Ga.nBYkMlfl0zVgXmZCbe', 'qg8/Hd3Fyu6KIb+wtj99P9qGsLbs96/EYtYK5OBJde0=', '内田 稔子', '仏教', '1975-10-29 00:00:00', 3, '三豊市山本町大野２４２５－１', '090-3789-9275', 'toshiko1029@i.softbank.jp', NULL, '', 0, NULL, 0, '', '2016-11-17 06:46:10', '2017-01-19 11:07:53'),
(7, 'ABC1869', '$2y$10$Yr1zFyCYfnnwRhTsifIUieHPpKjASVqSAuy3JEq4QCrGM472CfFFC', 'uC+F1ARzBOsJm+aKTWnNmoS8zdUiu4mDyhC/YxVjDAg=', '高橋 美紀', '', '1971-07-07 00:00:00', 2, '丸亀市垂水町３４６ー１６', '080-3167-6353', 'pikachupikapika@s.vodafone.ne.jp', NULL, '', 0, NULL, 0, '', '2017-01-19 10:57:08', '2017-01-19 11:07:36'),
(8, 'ABC4361', '$2y$10$Za4N8/nMZW/JiVco5tzXWOTurCLoHPsLcIFgj9XI7N/dDSVPbZnYC', 'IWAhhZYQte8k84UlUEgFPIXfx+m5b5fqb0wxFG8UQmg=', '広瀬 久美子', '', '1971-07-07 00:00:00', 3, '丸亀市飯野町東二甲２４４ー７', '080-3923-5143', 'may@s.vodafone.ne.jp', NULL, '', 0, NULL, 0, '', '2017-01-19 11:07:11', '2017-01-19 11:07:11'),
(9, 'ABC5732', '$2y$10$gdZtkKdTDu4dd4nb5mC36Oj4ONDA5JM4FDY1VS5DCqOSmJjb4Hc9K', 'gJfXxQhd5lUsCcmR90ujF/zTbeXzbNXt9OobMlyOx38=', '源 景子', '', '1971-07-07 00:00:00', 3, '高松市木太町１１５３ー１  労住協第９マンション ３０４号', '080-6399-1962', 'Keimina1211@gmail.com', NULL, '', 0, NULL, 0, '', '2017-01-19 12:10:47', '2017-01-19 12:10:47'),
(10, 'ABC3281', '$2y$10$0CGSzgd5tvPrMeq7CTM9AutDfZ4kn4vtRzen5HpKd5AMg4O38JxZ.', 'vwyQ2AQB+DI39TiMkB9TiW/PE/OgvYdlTYOMLGXxMeE=', '梅田 里実', '', '1971-07-07 00:00:00', 3, '三豊市高瀬町下勝間２１２５  神原団地Ｄー３０３号', '090-8696-6204', 'umeda.ayh.512@gmail.com', NULL, '', 0, NULL, 0, '', '2017-01-19 12:24:39', '2017-01-19 12:24:39'),
(11, 'ABC8675', '$2y$10$KQViZZimApfwlQstkA9Y3eWKS.s4qfBr1.c7lblZkqHq7r3rBGv1C', 'KTZCvF/aTg6QUuvhY5wozYvHnO98nccaDZxmsJ0MuPU=', '大久保 一恵', '', '1971-07-07 00:00:00', 3, '観音寺市大野原町萩原１６９２ー３', '080-6390-2520', 'o-ka8.i10.ki12-o-ky-@ezweb.ne.jp', NULL, '', 0, NULL, 0, '', '2017-01-19 12:31:22', '2017-01-19 12:31:22'),
(12, 'ABC6541', '$2y$10$CDQ3ANIlKI7.O86ScysyHOyBOt2Ffn23463Bfv3f9Y8GmRsdXemzu', '4E8DopuhfWwHAt29dFt7Tu6wpIbS/JpqzXqAm48gk2A=', '藤田 夏実', '', '1971-07-07 00:00:00', 3, '三豊市高瀬町上高瀬１２６６ー８', '090-5143-9373', 'tk310ww@docomo.ne.jp', NULL, '', 0, NULL, 0, '', '2017-01-19 12:35:04', '2017-01-19 12:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_confirmed`
--

CREATE TABLE IF NOT EXISTS `user_confirmed` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `type_confirm` tinyint(1) NOT NULL DEFAULT '0' COMMENT '2: 断る; 1: 受ける',
  `content` text,
  `reason_id` int(11) DEFAULT '0',
  `delflag` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: deleted (しない)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_confirmed`
--

INSERT INTO `user_confirmed` (`id`, `user_id`, `request_id`, `type_confirm`, `content`, `reason_id`, `delflag`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 1, '', 0, 0, '2016-11-02 03:10:24', '2016-11-02 03:10:24'),
(2, 4, 3, 1, '', 0, 0, '2016-11-04 07:23:23', '2016-11-04 07:23:23'),
(3, 9, 10, 1, '', 0, 0, '2017-01-19 13:24:10', '2017-01-19 13:24:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classification_request`
--
ALTER TABLE `classification_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funeral`
--
ALTER TABLE `funeral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_user`
--
ALTER TABLE `request_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_work`
--
ALTER TABLE `type_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `undertaker`
--
ALTER TABLE `undertaker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_confirmed`
--
ALTER TABLE `user_confirmed`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classification_request`
--
ALTER TABLE `classification_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `funeral`
--
ALTER TABLE `funeral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reason`
--
ALTER TABLE `reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `request_user`
--
ALTER TABLE `request_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `type_work`
--
ALTER TABLE `type_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `undertaker`
--
ALTER TABLE `undertaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_confirmed`
--
ALTER TABLE `user_confirmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
