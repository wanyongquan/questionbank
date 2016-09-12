-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-09-12 08:28:28
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `questionbank`
--
CREATE DATABASE IF NOT EXISTS `questionbank` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `questionbank`;

-- --------------------------------------------------------

--
-- 表的结构 `tk_courses`
--

DROP TABLE IF EXISTS `tk_courses`;
CREATE TABLE IF NOT EXISTS `tk_courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `coursename` varchar(100) NOT NULL COMMENT '课程名称',
  `description` varchar(400) NOT NULL COMMENT '课程简介',
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 插入之前先把表清空（truncate） `tk_courses`
--

TRUNCATE TABLE `tk_courses`;
--
-- 转存表中的数据 `tk_courses`
--

INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(5, 'PHP programming', 'yan cai');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(6, 'Cloud computing', 'yan caaaaa');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(7, 'Java ', 'yan ');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(8, 'Linux ', 'cai');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(9, 'Database principles', 'teached by Yancairong ');

-- --------------------------------------------------------

--
-- 表的结构 `tk_knowledges`
--

DROP TABLE IF EXISTS `tk_knowledges`;
CREATE TABLE IF NOT EXISTS `tk_knowledges` (
  `knowledge_id` int(11) NOT NULL AUTO_INCREMENT,
  `knowledgeName` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'knowledge name',
  PRIMARY KEY (`knowledge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='key knowledge' AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `tk_knowledges`
--

TRUNCATE TABLE `tk_knowledges`;
-- --------------------------------------------------------

--
-- 表的结构 `tk_users`
--

DROP TABLE IF EXISTS `tk_users`;
CREATE TABLE IF NOT EXISTS `tk_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `role` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 插入之前先把表清空（truncate） `tk_users`
--

TRUNCATE TABLE `tk_users`;
--
-- 转存表中的数据 `tk_users`
--

INSERT INTO `tk_users` (`uid`, `username`, `password`, `role`) VALUES(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
