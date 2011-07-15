-- phpMyAdmin SQL Dump
-- version 3.4.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2011 at 05:45 PM
-- Server version: 5.5.9
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nkc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(2, 'jeppe', '363b122c528f54df4a0446b6bab05515'),
(3, 'freja', '8f7baf824a4f0ad199dcdf0f2f9f648a');

-- --------------------------------------------------------

--
-- Table structure for table `board_of_directors`
--

CREATE TABLE IF NOT EXISTS `board_of_directors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `title` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `board_of_directors`
--

INSERT INTO `board_of_directors` (`id`, `rank`, `name`, `title`) VALUES
(1, 1, 'Lars Besand', 'Formand'),
(2, 2, 'Jeppe Vestergaard Boelsmand', 'Næstformand'),
(3, 3, 'Páll Jóhannesson', 'Kasserer'),
(4, 4, 'Thomas Skov', 'Bestyrelsesmedlem'),
(5, 4, 'Vibeke Dorf', 'Bestyrelsesmedlem'),
(6, 5, 'Jonas Vestergaard', '1. Suppleant'),
(7, 6, 'Charlotte Hejlesen-Schacht', '2. Suppleant');

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE IF NOT EXISTS `coaches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`id`, `name`) VALUES
(1, 'Lars Besand'),
(2, 'Peter Jensen'),
(3, 'Rene Bols'),
(4, 'Robert Fladstrand'),
(5, 'Jonas Vestergaard'),
(6, 'Kenneth Gjerulff');

-- --------------------------------------------------------

--
-- Table structure for table `coaches_styles`
--

CREATE TABLE IF NOT EXISTS `coaches_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coach_id` int(10) unsigned NOT NULL,
  `style_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `coaches_styles`
--

INSERT INTO `coaches_styles` (`id`, `coach_id`, `style_id`) VALUES
(1, 5, 4),
(2, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `meta_desc` varchar(155) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE IF NOT EXISTS `styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `meta_desc` varchar(155) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `head_coach_id` int(10) unsigned NOT NULL,
  `email` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `name`, `meta_desc`, `description`, `head_coach_id`, `email`) VALUES
(2, 'Aikido', 'I Aikido er engagement og ansvarlighed noget vi i aalborg lægger særlig vægt på. På den måde søger man at højne udbyttet af træningen.', '<p>Aikido er en forholdsvis ny disciplin inden for <b>kampsport</b>, men har dybe rødder i traditionel japansk kampkunst. Det mest markante kendetegn i Aikido er, at man aldrig går imod angriberens energi, hvilket gør aikido til en meget bevægelig forsvarskunst. I Aikido vælger man nemlig at flytte sig og derefter bevæge sig med angriberens <b>energi</b> for at udnytte den til at tage kontrollen. På den måde kan man sige, at målet med Aikido ikke er at lære at slås, men derimod at lære at lade være.</p>\r\n\r\n<p>Selv ordet aikido består af tre elementer; nemlig <b>ai</b>, <b>ki</b> og <b>do</b>. Ai betyder harmoni eller kærlighed, mens ki, der også kendes fra det kinesiske chi i for eksempel tai chi og chi gong, kan oversættes til energi. Do betyder vejen eller metoden og på den måde kan Aikido altså oversættes til Vejen til at harmonisere energi.</p>\r\n\r\n<p>I Aikido lægger man stor vægt på kvaliteter som for eksempel engagement og <b>ansvarlighed</b> - ikke kun hos trænerne, men hos alle deltagere. På den måde søger man at højne udbyttet af træningen.</p>\r\n\r\n<p>Vi træner både teknikker uden våben, og med <b>bokken</b> og <b>jo</b></p>\r\n\r\n<p>Den daglige træning i Aikido under Nordjysk Kampsportscenter varetages på skift af to dygtige instruktører.</p><p>\r\n\r\nLæs mere om <b>Aikido</b> på <a href="http://www.aikido-dojo-aalborg.dk">aikidos egen hjemmeside</a>.</p>\r\n', 3, 'aikido@nordjyskkampsport.dk'),
(3, 'Jiu-jitsu', 'Jiu-jitsu udvikler din selvkontrol - Lær at reagere hensigtsmæssigt i pressede situationer. Jiu-jitsu giver god motion, selvtillid og psykisk overskud', '<p>Jiu-jitsu udvikler din selvkontrol - både fysisk og psykisk - Og du lærer at reagere hensigtsmæssigt i pressede situationer. Jiu-jitsu giver god motion, selvtillid og psykisk overskud. Jiu-jitsu er et teknisk præget system. dvs. at man skal begynde på dette hold hvis man vil videreudvikle sin muskel kontrol, balance, koordinering og motorik.</p>\r\n\r\n<p>Jiu-jitsugrenen er delt op i begynder, senior og juniorhold. Hvis du er fyldt 10 år kan du starte på juniorholdet og er du 15 år kan du træne med seniorerne. Læs mere på <a href="http://www.budokwai.dk">budokwai.dk</a>.</p>', 2, 'jiujitsu@nordjyskkampsport.dk'),
(4, 'Mixed Martial Arts', 'MMA kombinerer den stående kamp med brydningen med gulvkampen. I Aalborg lægger vi fokus på at have et bredt game.', '<p>MMA er et kært barn med mange navne: Ultimate Fighting, Shootfighting, Submission Fighting, Vale Tudo, Kakutogi. Fælles for alle disse betegnelser er, at det er kamp som kombinerer den stående kamp med brydningen med gulvkampen, vel at mærke, uden kunstige distinktioner. Man kan altså kæmpe stående, med slag og spark; man kan kæmpe i clinch, med kast og knæ og nedtagninger; og man kan kæmpe på gulvet, med låse, stranguleringer og med/uden slag.</p>\r\n\r\n				<p>I MMA skal man kunne det hele: Man skal kunne slå, man skal kunne sparke, man skal kunne bryde, man skal kunne kaste, man skal kunne kæmpe på gulvet, man skal kunne submitte, og man skal kunne forsvare sig mod alle disse ting. Dermed sagt, at hvis du er interesseret i at træne våbenløs, realistisk kamp, i en meget kreativ og åben kontekst, så skal du træne MMA med os. Prøv det!</p>\r\n\r\n				<p>MMA grenen er delt op i begyndere og mere øvede. Samtidigt er der også fællestræning. Vi har også et juniorhold for børn og unge. </p>\r\n', 1, 'mma@nordjyskkampsport.dk'),
(5, 'Muay Thai', 'Muay Thai er for alle der har interesse i slag og spark. Uanset om du er begynder eller rutineret kan du få noget ud af at træne thaiboxing.', '<p>Muay Thai - også kaldet Thaiboxing - er et traditionsrigt og effektivt kampsystem. Regelsættet er meget åbent og tillader at man træffer sin modstander over hele kroppen med både slag, spark, knæ og albuer.</p> \r\n\r\n<p>Muay Thai er for alle der har interesse i slag og spark. Uanset om du er begynder eller rutineret kan du få noget ud af at træne thaiboxing, fordi vi altid arbejder med basiselementer som for eksempel fodarbejde, holdning og motorik.</p>\r\n\r\n<p>Vi har både begyndere og øvede, og vi har fællestræning. På <a href="http://www.x-gym.dk/information.php#kickbox">X-Gym</a> kan du læse mere om Muay Thai.</p>\r\n', 4, 'muaythai@nordjyskkampsport.dk');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_signups`
--

CREATE TABLE IF NOT EXISTS `waiting_signups` (
  `firstname` varchar(128) CHARACTER SET utf8 NOT NULL,
  `middlename` varchar(128) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(128) CHARACTER SET utf8 NOT NULL,
  `address` varchar(256) CHARACTER SET utf8 NOT NULL,
  `zip` varchar(10) CHARACTER SET utf8 NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `mobile` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `dob` varchar(10) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `comment` varchar(256) CHARACTER SET utf8 NOT NULL,
  `emailnotice` varchar(32) CHARACTER SET utf8 NOT NULL,
  `smsnotice` varchar(32) CHARACTER SET utf8 NOT NULL,
  `accepturl` varchar(128) CHARACTER SET utf8 NOT NULL,
  `declineurl` varchar(128) CHARACTER SET utf8 NOT NULL,
  `foadacc` varchar(256) CHARACTER SET utf8 NOT NULL,
  `foadcos` varchar(256) CHARACTER SET utf8 NOT NULL,
  `foadsec` varchar(256) CHARACTER SET utf8 NOT NULL,
  `foadnotsec` varchar(256) CHARACTER SET utf8 NOT NULL,
  `foadelm` varchar(256) CHARACTER SET utf8 NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `urlhash` varchar(128) CHARACTER SET utf8 NOT NULL DEFAULT 'not_set',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `waiting_signups`
--