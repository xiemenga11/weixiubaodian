-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 12 月 17 日 05:28
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `weixiubaodian`
--

-- --------------------------------------------------------

--
-- 表的结构 `wx_ads`
--

CREATE TABLE IF NOT EXISTS `wx_ads` (
  `ad_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ad_title` varchar(10) NOT NULL,
  `ad_content` text NOT NULL,
  `ad_position` tinyint(3) unsigned NOT NULL,
  `ad_img` varchar(50) NOT NULL,
  `ad_link` varchar(500) DEFAULT NULL,
  `ad_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ad_expire_time` int(10) unsigned DEFAULT NULL,
  `ad_view` int(10) unsigned NOT NULL DEFAULT '0',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_ads`
--

INSERT INTO `wx_ads` (`ad_id`, `ad_title`, `ad_content`, `ad_position`, `ad_img`, `ad_link`, `ad_time`, `ad_expire_time`, `ad_view`, `is_show`) VALUES
(1, '测试广告', '广告内容', 2, 'leoxie.jpg', 'http://www.baidu.com', '2016-12-13 09:14:53', 4294967295, 220, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wx_article`
--

CREATE TABLE IF NOT EXISTS `wx_article` (
  `art_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `art_title` varchar(20) NOT NULL,
  `art_des` varchar(200) DEFAULT NULL,
  `art_content` text NOT NULL,
  `art_cate` int(10) unsigned NOT NULL,
  `art_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_top` tinyint(1) NOT NULL DEFAULT '0',
  `is_perfect` tinyint(1) NOT NULL DEFAULT '0',
  `is_show` tinyint(1) NOT NULL DEFAULT '0',
  `art_poster_id` int(10) unsigned NOT NULL,
  `art_pay_for_view` int(10) unsigned NOT NULL DEFAULT '0',
  `art_view_amount` int(10) unsigned NOT NULL DEFAULT '0',
  `art_good_amount` int(10) unsigned NOT NULL DEFAULT '0',
  `art_bad_amount` int(10) unsigned NOT NULL DEFAULT '0',
  `art_collected` int(10) unsigned NOT NULL DEFAULT '0',
  `art_get_money` int(10) unsigned NOT NULL DEFAULT '0',
  `art_view` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_article`
--

INSERT INTO `wx_article` (`art_id`, `art_title`, `art_des`, `art_content`, `art_cate`, `art_time`, `is_top`, `is_perfect`, `is_show`, `art_poster_id`, `art_pay_for_view`, `art_view_amount`, `art_good_amount`, `art_bad_amount`, `art_collected`, `art_get_money`, `art_view`) VALUES
(1, 'testTitle', 'test description', 'test content', 1, '2016-12-11 16:00:00', 0, 0, 0, 1, 5, 0, 0, 0, 0, 0, 55);

-- --------------------------------------------------------

--
-- 表的结构 `wx_art_comment`
--

CREATE TABLE IF NOT EXISTS `wx_art_comment` (
  `com_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `com_poster_id` int(10) unsigned NOT NULL,
  `com_art_id` int(10) unsigned NOT NULL,
  `com_content` varchar(500) NOT NULL,
  `com_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `com_recomment_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_art_comment`
--

INSERT INTO `wx_art_comment` (`com_id`, `com_poster_id`, `com_art_id`, `com_content`, `com_time`, `com_recomment_id`) VALUES
(1, 1, 1, 'hahahahahahah', '2016-12-17 03:25:30', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wx_art_img`
--

CREATE TABLE IF NOT EXISTS `wx_art_img` (
  `AI_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `AI_art_id` int(10) unsigned NOT NULL,
  `AI_img_name` varchar(50) NOT NULL,
  `AI_img_des` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`AI_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wx_cate`
--

CREATE TABLE IF NOT EXISTS `wx_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(10) NOT NULL,
  `cate_paren_id` int(10) unsigned DEFAULT NULL,
  `cate_icon` varchar(50) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wx_collection`
--

CREATE TABLE IF NOT EXISTS `wx_collection` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_user_id` int(10) unsigned NOT NULL,
  `c_art_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wx_friend`
--

CREATE TABLE IF NOT EXISTS `wx_friend` (
  `f_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_hoster_id` int(10) unsigned NOT NULL,
  `f_friend_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wx_keepchange`
--

CREATE TABLE IF NOT EXISTS `wx_keepchange` (
  `kc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kc_art_id` int(10) unsigned NOT NULL,
  `kc_pay_user_id` int(10) unsigned NOT NULL,
  `kc_gold_amount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`kc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wx_poster`
--

CREATE TABLE IF NOT EXISTS `wx_poster` (
  `poster_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `poster_title` varchar(10) NOT NULL,
  `poster_content` varchar(500) NOT NULL,
  `poster_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `poster_expire_time` varchar(50) NOT NULL,
  PRIMARY KEY (`poster_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wx_user`
--

CREATE TABLE IF NOT EXISTS `wx_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nickname` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `headimg` varchar(50) NOT NULL,
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `gold` int(10) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `role` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_user`
--

INSERT INTO `wx_user` (`id`, `userid`, `password`, `nickname`, `description`, `phone`, `address`, `mail`, `headimg`, `score`, `gold`, `level`, `role`, `regtime`) VALUES
(1, 'xiemenga11', 'xie13508021258', '无灬念', '这个家伙很懒', '13350809075', NULL, NULL, '', 0, 0, 0, 0, '2016-12-09 06:16:14');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
