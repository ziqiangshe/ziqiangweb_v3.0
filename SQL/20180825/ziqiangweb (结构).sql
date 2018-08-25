-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-08-25 10:25:18
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ziqiangweb`
--
CREATE DATABASE IF NOT EXISTS `ziqiangweb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ziqiangweb`;

-- --------------------------------------------------------

--
-- 表的结构 `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `image` varchar(300) NOT NULL,
  `introduction` text CHARACTER SET utf8mb4 NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `activity_sign`
--

CREATE TABLE IF NOT EXISTS `activity_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `cardno` int(20) NOT NULL COMMENT '卡号（部分同学是长卡号）',
  `name` varchar(30) NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-男 2-女',
  `session` int(11) NOT NULL COMMENT '届数',
  `major` varchar(100) NOT NULL COMMENT '所在学院',
  `class` varchar(20) NOT NULL DEFAULT '',
  `dorm` varchar(30) NOT NULL COMMENT '宿舍',
  `tel` varchar(30) NOT NULL DEFAULT '',
  `qq` varchar(30) NOT NULL DEFAULT '',
  `content` text NOT NULL COMMENT '报名提交内容',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='活动报名表' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `pageview` int(11) DEFAULT '0' COMMENT '浏览量',
  `authorid` int(11) NOT NULL COMMENT '作者用户id',
  `tagid` varchar(30) DEFAULT NULL COMMENT '博客类型',
  `summary` text COMMENT '摘要',
  `content` text,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog_tag`
--

CREATE TABLE IF NOT EXISTS `blog_tag` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` char(10) CHARACTER SET utf8 NOT NULL COMMENT '博客类型具体名称',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sign`
--

CREATE TABLE IF NOT EXISTS `sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `cardno` varchar(20) NOT NULL COMMENT '卡号',
  `dept1` varchar(30) NOT NULL COMMENT '第一志愿',
  `dept2` varchar(30) DEFAULT NULL COMMENT '第二志愿',
  `class` varchar(30) NOT NULL,
  `date` date DEFAULT NULL,
  `qq` varchar(30) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `dorm` varchar(30) DEFAULT NULL COMMENT '宿舍',
  `status` int(10) DEFAULT NULL,
  `content` text COMMENT '介绍',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `realname` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '头像url',
  `introduce` text COMMENT '介绍',
  `message` text CHARACTER SET utf8 COMMENT '寄语',
  `birthday` datetime DEFAULT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-未知1-男2-女',
  `class` varchar(40) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `session` tinyint(11) unsigned DEFAULT NULL COMMENT '届数',
  `department` varchar(40) NOT NULL COMMENT '所属部门',
  `position` varchar(50) DEFAULT NULL COMMENT '职务',
  `role` varchar(20) NOT NULL DEFAULT '0' COMMENT '0-访客1-管理2-超级管理',
  `status` char(20) CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '0-下架1-上架',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='社员表' AUTO_INCREMENT=26 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
