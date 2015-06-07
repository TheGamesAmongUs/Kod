-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql112.000a.biz
-- Generation Time: Jun 07, 2015 at 03:38 PM
-- Server version: 5.6.22-71.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a000b_16095898_tgas`
--

-- --------------------------------------------------------

--
-- Table structure for table `ARTYKULY`
--

CREATE TABLE IF NOT EXISTS `ARTYKULY` (
  `ID_ARTYKUL` int(11) NOT NULL AUTO_INCREMENT,
  `ID_OCENA_ART` int(11) NOT NULL,
  `ID_GRY` int(11) NOT NULL,
  `TYTUL_ART` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `TRESC_ART` text COLLATE utf8_polish_ci,
  `RODZAJ` int(11) NOT NULL,
  `AUTOR_ART_ID` int(11) NOT NULL,
  `VIEWED` int(11) NOT NULL,
  `COVER` text COLLATE utf8_polish_ci NOT NULL,
  `BACKGROUND` text COLLATE utf8_polish_ci NOT NULL,
  `ACCEPT` int(1) NOT NULL,
  PRIMARY KEY (`ID_ARTYKUL`),
  KEY `FK_ARTYKUL_GRY` (`ID_GRY`),
  KEY `FK_OCENA_ARTYKULU` (`ID_OCENA_ART`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=100 ;

-- --------------------------------------------------------

--
-- Table structure for table `GRACZ`
--

CREATE TABLE IF NOT EXISTS `GRACZ` (
  `ID_GRACZ` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(20) DEFAULT NULL,
  `HASLO` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PLEC` tinyint(1) DEFAULT NULL,
  `IMIE` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `NAZWISKO` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `DATA_UR` date DEFAULT NULL,
  `ADMIN` tinyint(1) DEFAULT '0',
  `MOD` tinyint(1) DEFAULT '0',
  `AVATAR` text NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  `ACT_CODE` text NOT NULL,
  `REG_DATE` date NOT NULL,
  `DESCRIPT` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`ID_GRACZ`),
  FULLTEXT KEY `EMAIL` (`EMAIL`),
  FULLTEXT KEY `LOGIN` (`LOGIN`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

-- --------------------------------------------------------

--
-- Table structure for table `GRY`
--

CREATE TABLE IF NOT EXISTS `GRY` (
  `ID_GRY` int(11) NOT NULL AUTO_INCREMENT,
  `ACCEPT` tinyint(1) DEFAULT NULL,
  `ID_WYDAWCA` int(11) NOT NULL,
  `ID_PRODUCENT` int(11) NOT NULL,
  `NAZWA_GRY` varchar(255) DEFAULT NULL,
  `ROK_GRY` int(11) DEFAULT NULL,
  `OCENA_GRY` float DEFAULT NULL,
  PRIMARY KEY (`ID_GRY`),
  KEY `FK_PRODUCENT_GRY` (`ID_PRODUCENT`),
  KEY `FK_WYDAWCA_GRY` (`ID_WYDAWCA`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

-- --------------------------------------------------------

--
-- Table structure for table `KOMENTARZE_ART`
--

CREATE TABLE IF NOT EXISTS `KOMENTARZE_ART` (
  `ID_KOM_ART` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ARTYKUL` int(11) NOT NULL,
  `ID_GRACZ` int(11) NOT NULL,
  `KOM_ART` varchar(255) DEFAULT NULL,
  `DATE` date NOT NULL,
  `TIME` time NOT NULL,
  PRIMARY KEY (`ID_KOM_ART`),
  KEY `FK_KOMENTARZE_ARTYKULU` (`ID_ARTYKUL`),
  KEY `FK_KOMENTARZE_GRACZA` (`ID_GRACZ`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

-- --------------------------------------------------------

--
-- Table structure for table `LISTA_ZYCZEN`
--

CREATE TABLE IF NOT EXISTS `LISTA_ZYCZEN` (
  `ID_LISTA_ZYCZEN` int(11) NOT NULL,
  `ID_GRACZ` int(11) NOT NULL,
  `ID_GRY` int(11) NOT NULL,
  `PRIORYTETY` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_LISTA_ZYCZEN`),
  KEY `FK_LISTA_ZYCZEN_GRACZA` (`ID_GRACZ`),
  KEY `FK_LISTA_ZYCZEN_GRY` (`ID_GRY`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `NEWSLETTER`
--

CREATE TABLE IF NOT EXISTS `NEWSLETTER` (
  `ID_NEWSLETTER` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` text NOT NULL,
  PRIMARY KEY (`ID_NEWSLETTER`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `OCENA_ART`
--

CREATE TABLE IF NOT EXISTS `OCENA_ART` (
  `ID_OCENA_ART` int(11) NOT NULL AUTO_INCREMENT,
  `ID_GRACZ` int(11) NOT NULL,
  `OCENA_ART` float DEFAULT NULL,
  `ID_ART` int(11) NOT NULL,
  PRIMARY KEY (`ID_OCENA_ART`),
  KEY `FK_OCENA_ART_GRACZA` (`ID_GRACZ`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `PLAY`
--

CREATE TABLE IF NOT EXISTS `PLAY` (
  `ID_PLAY` int(11) NOT NULL,
  `ID_GRY` int(11) NOT NULL,
  `ID_GRACZ` int(11) NOT NULL,
  `PLAY` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCENT`
--

CREATE TABLE IF NOT EXISTS `PRODUCENT` (
  `ID_PRODUCENT` int(11) NOT NULL AUTO_INCREMENT,
  `NAZWA_PROD` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_PRODUCENT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ULUBIONE`
--

CREATE TABLE IF NOT EXISTS `ULUBIONE` (
  `ID_ULUB` int(11) NOT NULL AUTO_INCREMENT,
  `ID_GRY` int(11) NOT NULL,
  `ID_GRACZ` int(11) NOT NULL,
  PRIMARY KEY (`ID_ULUB`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `WYDAWCA`
--

CREATE TABLE IF NOT EXISTS `WYDAWCA` (
  `ID_WYDAWCA` int(11) NOT NULL AUTO_INCREMENT,
  `NAZWA_WYDAWCY` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_WYDAWCA`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
