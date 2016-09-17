-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-09-17 14:31:50
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
-- 表的结构 `bs_dictionaryitems`
--

DROP TABLE IF EXISTS `bs_dictionaryitems`;
CREATE TABLE IF NOT EXISTS `bs_dictionaryitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dictionary_id` int(11) NOT NULL COMMENT 'logical dictionary id',
  `dictionary_type_id` int(11) NOT NULL COMMENT 'dictionary type id',
  `dictionary_value` varchar(100) NOT NULL COMMENT 'dictionary item value',
  `itemorder` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dictionary_type_id` (`dictionary_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `bs_dictionaryitems`
--

INSERT INTO `bs_dictionaryitems` (`id`, `dictionary_id`, `dictionary_type_id`, `dictionary_value`, `itemorder`) VALUES(1, 1, 1, 'Easy', 1);
INSERT INTO `bs_dictionaryitems` (`id`, `dictionary_id`, `dictionary_type_id`, `dictionary_value`, `itemorder`) VALUES(2, 2, 1, 'Hard', 2);

-- --------------------------------------------------------

--
-- 表的结构 `bs_dictionarytypes`
--

DROP TABLE IF EXISTS `bs_dictionarytypes`;
CREATE TABLE IF NOT EXISTS `bs_dictionarytypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'dictionary type id',
  `dictionary_type` varchar(100) NOT NULL COMMENT 'dictionary type',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `bs_dictionarytypes`
--

INSERT INTO `bs_dictionarytypes` (`id`, `dictionary_type`) VALUES(1, 'DifficultyLevel');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `tk_courses`
--

INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(5, 'PHP programming', 'yan cai rong');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(6, 'Cloud computering', '');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(7, 'Java ', 'yan  cairong');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(8, 'Linux ', 'cai');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(9, 'Database principles', 'teached by Yancairong ');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(10, 'operation system', 'caicai');
INSERT INTO `tk_courses` (`course_id`, `coursename`, `description`) VALUES(12, 'java ', '123');

-- --------------------------------------------------------

--
-- 表的结构 `tk_questions`
--

DROP TABLE IF EXISTS `tk_questions`;
CREATE TABLE IF NOT EXISTS `tk_questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_body` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `point` int(11) NOT NULL,
  `difficultylevel_id` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `createdBy` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `difficultylevel_id` (`difficultylevel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tk_subjects`
--

DROP TABLE IF EXISTS `tk_subjects`;
CREATE TABLE IF NOT EXISTS `tk_subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'subject name',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='subject' AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `tk_subjects`
--

INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(11, 'ff');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(23, 'werw');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(26, 'pp');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(27, 'ss2');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(30, 'w2');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(31, 'w1');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(32, 'w3');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(34, 'w34');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(35, 'f5');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(36, 'k9');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(37, 'g6');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(38, 'b5');
INSERT INTO `tk_subjects` (`subject_id`, `subjectName`) VALUES(39, 'h6');

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
-- 转存表中的数据 `tk_users`
--

INSERT INTO `tk_users` (`uid`, `username`, `password`, `role`) VALUES(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrator');

-- --------------------------------------------------------

--
-- 替换视图以便查看 `vw_difficultylevels`
--
DROP VIEW IF EXISTS `vw_difficultylevels`;
CREATE TABLE IF NOT EXISTS `vw_difficultylevels` (
`dictionary_id` int(11)
,`dictionary_type_id` int(11)
,`dictionary_value` varchar(100)
,`itemorder` int(11)
,`dictionary_type` varchar(100)
);
-- --------------------------------------------------------

--
-- 视图结构 `vw_difficultylevels`
--
DROP TABLE IF EXISTS `vw_difficultylevels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_difficultylevels` AS select `bs_dictionaryitems`.`dictionary_id` AS `dictionary_id`,`bs_dictionaryitems`.`dictionary_type_id` AS `dictionary_type_id`,`bs_dictionaryitems`.`dictionary_value` AS `dictionary_value`,`bs_dictionaryitems`.`itemorder` AS `itemorder`,`bs_dictionarytypes`.`dictionary_type` AS `dictionary_type` from (`bs_dictionaryitems` left join `bs_dictionarytypes` on((`bs_dictionaryitems`.`dictionary_type_id` = `bs_dictionarytypes`.`id`))) where (`bs_dictionarytypes`.`id` = 1);

--
-- 限制导出的表
--

--
-- 限制表 `bs_dictionaryitems`
--
ALTER TABLE `bs_dictionaryitems`
  ADD CONSTRAINT `diction_type_id` FOREIGN KEY (`dictionary_type_id`) REFERENCES `bs_dictionarytypes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- 限制表 `tk_questions`
--
ALTER TABLE `tk_questions`
  ADD CONSTRAINT `fk_difficultylevel_id` FOREIGN KEY (`difficultylevel_id`) REFERENCES `bs_dictionaryitems` (`id`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
