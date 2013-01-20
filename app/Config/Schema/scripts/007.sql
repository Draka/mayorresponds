USE `mayorresponds`;

-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-01-2013 a las 01:53:38
-- Versión del servidor: 5.5.28-0ubuntu0.12.10.2
-- Versión de PHP: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `mayorresponds`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `comment` text NOT NULL,
  `url` text NOT NULL,
  `vote_plus` int(11) NOT NULL DEFAULT '0',
  `vote_minus` int(11) NOT NULL DEFAULT '0',
  `vote_abuse` int(11) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `key_confirm` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `name` varchar(100) NOT NULL,
  `fcode` varchar(10) NOT NULL,
  `geoname_id` int(10) unsigned NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `population` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mayors`
--

DROP TABLE IF EXISTS `mayors`;
CREATE TABLE IF NOT EXISTS `mayors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(200) NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `vote_plus` int(10) unsigned NOT NULL DEFAULT '0',
  `vote_minus` int(10) unsigned NOT NULL DEFAULT '0',
  `vote_abuse` int(10) unsigned NOT NULL DEFAULT '0',
  `trusted` tinyint(1) NOT NULL DEFAULT '0',
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `start` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `question` text NOT NULL,
  `vote_plus` int(10) unsigned NOT NULL,
  `vote_minus` int(10) unsigned NOT NULL,
  `vote_abuse` int(10) unsigned NOT NULL,
  `trusted` tinyint(1) NOT NULL DEFAULT '0',
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `key_confirm` varchar(16) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `key_confirm` (`key_confirm`),
  KEY `user_id` (`user_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supports`
--

DROP TABLE IF EXISTS `supports`;
CREATE TABLE IF NOT EXISTS `supports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `key_confirm` varchar(16) DEFAULT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `browser_name` varchar(60) DEFAULT NULL,
  `browser_version` varchar(60) DEFAULT NULL,
  `os_name` varchar(60) DEFAULT NULL,
  `os_version` varchar(60) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key_confirm` (`key_confirm`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `facebook_id` varchar(20) DEFAULT NULL,
  `twitter_user` varchar(50) DEFAULT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `key_confirm` varchar(16) DEFAULT NULL,
  `trusted` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `facebook_id` (`facebook_id`),
  KEY `twitter_user` (`twitter_user`),
  KEY `key_confirm` (`key_confirm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `key_confirm` varchar(16) DEFAULT NULL,
  `vote_plus` tinyint(1) NOT NULL DEFAULT '0',
  `vote_minus` tinyint(1) NOT NULL DEFAULT '0',
  `vote_abuse` int(11) NOT NULL DEFAULT '0',
  `anonymous` tinyint(1) NOT NULL,
  `browser_name` varchar(60) DEFAULT NULL,
  `browser_version` varchar(60) DEFAULT NULL,
  `os_name` varchar(60) DEFAULT NULL,
  `os_version` varchar(60) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key_confirm` (`key_confirm`),
  KEY `user_id` (`user_id`),
  KEY `answer_id` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
