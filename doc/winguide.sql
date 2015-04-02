-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 04 月 02 日 17:46
-- 服务器版本: 5.5.28-log
-- PHP 版本: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `winguide`
--

-- --------------------------------------------------------

--
-- 表的结构 `wg_administrators`
--

CREATE TABLE IF NOT EXISTS `wg_administrators` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_students`
--

CREATE TABLE IF NOT EXISTS `wg_students` (
  `student_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `course` varchar(32) NOT NULL,
  `purchase_time` int(11) unsigned NOT NULL,
  `start_time` int(11) unsigned NOT NULL,
  `end_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_application`
--

CREATE TABLE IF NOT EXISTS `wg_student_application` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `degree` varchar(128) NOT NULL,
  `major` varchar(256) NOT NULL,
  `entrance_time` date NOT NULL,
  `conutry_region` varchar(256) NOT NULL,
  `expenses_expected` varchar(64) NOT NULL,
  `school_type` varchar(128) NOT NULL,
  `school_requirement` int(11) NOT NULL,
  `school_expected` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='拟申请留学信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_education`
--

CREATE TABLE IF NOT EXISTS `wg_student_education` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `degree` enum('初中','高中','大学','研究院') NOT NULL,
  `school` varchar(128) NOT NULL,
  `profile` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='教育背景' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_family`
--

CREATE TABLE IF NOT EXISTS `wg_student_family` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `parent` enum('dad','mom') NOT NULL,
  `real_name` varchar(64) NOT NULL,
  `cellphone` varchar(32) NOT NULL,
  `company` varchar(128) NOT NULL,
  `position` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='家庭信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_referee`
--

CREATE TABLE IF NOT EXISTS `wg_student_referee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `real_name` int(11) NOT NULL,
  `sex` enum('男','女') NOT NULL,
  `company` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telephone` int(11) NOT NULL,
  `qq_weixin` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `zip_code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='推荐人信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_student_standard`
--

CREATE TABLE IF NOT EXISTS `wg_student_standard` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) unsigned NOT NULL,
  `subject` enum('TOFEL','IELTS','GRE','GMAT','SAT') NOT NULL,
  `profile` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标准化信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wg_users`
--

CREATE TABLE IF NOT EXISTS `wg_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `real_name` varchar(64) NOT NULL,
  `used_name` varchar(64) NOT NULL,
  `birthday` date NOT NULL,
  `sex` enum('男','女') NOT NULL,
  `marriage` enum('未婚','已婚') NOT NULL,
  `born_city` varchar(64) NOT NULL,
  `family_addr` varchar(256) NOT NULL,
  `family_zip_code` varchar(32) NOT NULL,
  `contact_addr` varchar(256) NOT NULL,
  `contact_zip_code` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `cellphone` varchar(32) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `account_type` smallint(5) NOT NULL,
  `status` smallint(5) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
