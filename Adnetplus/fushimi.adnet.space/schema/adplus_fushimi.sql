-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2017 at 09:53 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adplus_fushimi`
--
CREATE DATABASE IF NOT EXISTS `adplus_fushimi` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `adplus_fushimi`;

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
CREATE TABLE `administrators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `delete_flag` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `code`, `password`, `email`, `created_at`, `updated_at`, `delete_flag`) VALUES
(1, 'admin', '123', 'khoiv.adnetplus@gmail.com', '2017-03-14 13:37:10', '2017-03-14 06:37:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ja` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name_cn` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_flag` tinyint(1) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_ja`, `name_en`, `name_cn`, `created_at`, `updated_at`, `delete_flag`) VALUES
(1, 'お知らせ', 'Notice', '通知', '2017-03-14 13:36:35', '2017-03-22 09:10:12', 0),
(2, 'ニュース', 'News', '新聞', '2017-03-14 13:36:39', '2017-03-22 09:10:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `title_ja` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title_cn` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `news_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_flag` tinyint(1) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `category_id`, `title_ja`, `title_en`, `title_cn`, `news_date`, `created_at`, `updated_at`, `delete_flag`) VALUES
(1, 1, 'テストです', 'English title no 1', '中文標題1號', '2017-03-15', '2017-03-14 13:51:24', '2017-03-22 22:27:31', 0),
(2, 2, 'ここにニュース・お知らせ等のタイトルが入ります。', 'English title no 10', '中文標題10號', '2017-03-14', '2017-03-22 13:51:27', '2017-03-22 09:15:50', 0),
(3, 1, 'ここにニュース・お知らせ等のタイトルが入ります。', 'English title no 2', '中文標題2號', '2017-03-13', '2017-03-07 13:51:31', '2017-03-22 09:15:10', 0),
(4, 1, 'ここにニュース・お知らせ等のタイトルが入ります。', 'English title no 3', '中文標題3號', '2017-03-29', '2017-03-14 13:51:36', '2017-03-23 02:38:35', 0),
(5, 1, 'ダミーダミーダミーダミー', 'English title no 4', '中文標題4號', '2017-03-14', '2017-03-10 13:51:40', '2017-03-23 00:08:32', 0),
(8, 1, 'テストです', 'English title no 5', '中文標題5號', '2017-03-26', NULL, '2017-03-23 00:08:26', 0),
(11, 2, 'New New', 'English title no 12', '中文標題12號', '2017-03-15', NULL, '2017-03-22 09:15:57', 0),
(12, 1, 'Test', 'English title no 6', '中文標題6號', '2017-03-07', NULL, '2017-03-22 09:15:31', 0),
(13, 1, 'A new item', 'English title no 7', '中文標題7號', '2017-03-22', NULL, '2017-03-23 02:39:23', 0),
(14, 1, 'why not', 'English title no 8', '中文標題8號', '2017-03-14', NULL, '2017-03-22 09:15:41', 0),
(15, 1, 'sffds', 'English title no 9', '中文標題9號', '2017-03-14', NULL, '2017-03-22 09:15:46', 0),
(16, 1, 'Japanese title 1', 'English title 1', 'Chinese title 1', '2017-02-28', NULL, NULL, 0),
(17, 2, 'Japanese title 2', 'English title 2', 'Chinese title 2', '2017-03-16', '2017-03-23 05:27:52', '2017-03-23 00:19:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `id` int(11) UNSIGNED NOT NULL,
  `title_ja` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_cn` varchar(255) DEFAULT NULL,
  `topic_date` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title_ja`, `title_en`, `title_cn`, `topic_date`, `updated_at`, `created_at`, `delete_flag`) VALUES
(1, 'Ｘ線診断二重造影用発泡剤「バリエース発泡顆粒」自主回収のお知らせとお詫び', 'English title 1', 'Chinese title 1', '2016-09-23', '2017-03-23 07:56:34', NULL, 0),
(2, 'Ｘ線診断二重造影用発泡剤「バリエース発泡顆粒」自主回収終了のお知らせ', 'English title 2', 'Chinese title 2', '2016-11-17', '2017-03-23 07:56:36', '2017-03-23 00:00:00', 0),
(3, 'Ｘ線診断二重造影用発泡剤「バリエース発泡顆粒」自主回収のお知らせとお詫び', 'English title 3', 'Chinese title 3', '2016-09-23', '2017-03-23 07:56:38', NULL, 0),
(4, 'Japanese title 1', 'English title 4', 'Chinese title 4', '2017-03-15', '2017-03-23 02:00:03', '2017-03-23 08:52:59', 0),
(5, '大腸CT用経口造影剤「コロンフォート内用懸濁液２５％」発売のお知らせ', 'English title 5', 'Chinese title 5', '2016-06-07', '2017-03-23 07:57:08', NULL, 0),
(6, '「安定供給体制等に関する情報」を掲載しました', 'English title 6', 'Chinese title 6', '2017-03-13', '2017-03-23 07:57:34', NULL, 0),
(7, '新製剤『硫酸バリウム散99.5％「FSK」』発売のお知らせ', 'English title 7', 'Chinese title 7', '2017-02-22', '2017-03-23 07:57:55', NULL, 0),
(8, 'JANコード削除に伴う表示変更のお知らせ', 'English title 8', 'Chinese title 8', '2017-02-13', '2017-03-23 07:58:19', NULL, 0),
(9, 'X線診断二重造影用発泡剤「バリエース発泡顆粒」新バーコード表示のお知らせ', 'English title 9', 'Chinese title 9', '2017-03-06', '2017-03-23 07:58:47', NULL, 0),
(10, '硫酸バリウム製剤「使用上の注意」等改訂のお知らせ', 'English title 10', 'Chinese title 10', '2017-03-01', '2017-03-23 02:00:23', NULL, 0),
(11, '胃内有泡性粘液除去剤「バリトゲン消泡内用液２％」承認事項一部変更等のお知らせ', 'English title 11', 'Chinese title 11', '2017-03-09', '2017-03-23 02:39:28', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
