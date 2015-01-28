-- phpMyAdmin SQL Dump
-- version 4.3.0
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2015 年 01 月 20 日 20:33
-- 伺服器版本: 5.5.39-MariaDB
-- PHP 版本： 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `main`
--

-- --------------------------------------------------------

--
-- 資料表結構 `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
`id` int(11) NOT NULL,
  `author` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `board`
--

CREATE TABLE IF NOT EXISTS `board` (
`id` int(11) NOT NULL,
  `class` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `relation` int(11) NOT NULL,
  `floors` int(11) NOT NULL,
  `title` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `author` int(32) NOT NULL,
  `author_per` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`id` int(32) NOT NULL,
  `grade` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `curriculum` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `communication`
--

CREATE TABLE IF NOT EXISTS `communication` (
`id` int(11) NOT NULL,
  `class` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `homework`
--

CREATE TABLE IF NOT EXISTS `homework` (
`id` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `class` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `homework_upload`
--

CREATE TABLE IF NOT EXISTS `homework_upload` (
`id` int(11) NOT NULL,
  `filename` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `homework_id` int(11) NOT NULL,
  `realpath` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `upload_student` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `scoredata`
--

CREATE TABLE IF NOT EXISTS `scoredata` (
`id` int(11) NOT NULL,
  `testid` varchar(128) NOT NULL,
  `studentid` varchar(128) NOT NULL,
  `score` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `scoresheet`
--

CREATE TABLE IF NOT EXISTS `scoresheet` (
`id` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `classid` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `testid` varchar(128) NOT NULL,
  `owner` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `seat`
--

CREATE TABLE IF NOT EXISTS `seat` (
`id` int(11) NOT NULL,
  `class` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `height` int(32) NOT NULL,
  `width` int(32) NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `number` int(32) NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `personalid` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `academic_year` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `incentive` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `leave` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `personalid` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `teacher_share`
--

CREATE TABLE IF NOT EXISTS `teacher_share` (
`id` int(11) NOT NULL,
  `filename` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `realpath` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `upload_teacher` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `view_permission` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_staff` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `test`
--

CREATE TABLE IF NOT EXISTS `test` (
`id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `standard_deviation` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `average` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `announcement`
--
ALTER TABLE `announcement`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- 資料表索引 `board`
--
ALTER TABLE `board`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `communication`
--
ALTER TABLE `communication`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `homework`
--
ALTER TABLE `homework`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `homework_upload`
--
ALTER TABLE `homework_upload`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scoredata`
--
ALTER TABLE `scoredata`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `scoresheet`
--
ALTER TABLE `scoresheet`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `seat`
--
ALTER TABLE `seat`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `setting`
--
ALTER TABLE `setting`
 ADD PRIMARY KEY (`name`);

--
-- 資料表索引 `staff`
--
ALTER TABLE `staff`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `teacher_share`
--
ALTER TABLE `teacher_share`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `test`
--
ALTER TABLE `test`
 ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `announcement`
--
ALTER TABLE `announcement`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- 使用資料表 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- 使用資料表 AUTO_INCREMENT `class`
--
ALTER TABLE `class`
MODIFY `id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- 使用資料表 AUTO_INCREMENT `communication`
--
ALTER TABLE `communication`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- 使用資料表 AUTO_INCREMENT `homework`
--
ALTER TABLE `homework`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- 使用資料表 AUTO_INCREMENT `homework_upload`
--
ALTER TABLE `homework_upload`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- 使用資料表 AUTO_INCREMENT `scoredata`
--
ALTER TABLE `scoredata`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- 使用資料表 AUTO_INCREMENT `scoresheet`
--
ALTER TABLE `scoresheet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- 使用資料表 AUTO_INCREMENT `seat`
--
ALTER TABLE `seat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `teacher_share`
--
ALTER TABLE `teacher_share`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- 使用資料表 AUTO_INCREMENT `test`
--
ALTER TABLE `test`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
