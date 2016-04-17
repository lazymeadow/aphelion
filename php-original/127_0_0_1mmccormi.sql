-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2014 at 07:29 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aphelion`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment_text` varchar(512) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_id`, `type`) VALUES
(1, 'img'),
(2, 'img'),
(3, 'img'),
(4, 'img'),
(5, 'page'),
(6, 'page'),
(7, 'page'),
(8, 'page'),
(9, 'page'),
(10, 'page'),
(11, 'page'),
(12, 'page'),
(13, 'page'),
(14, 'page'),
(15, 'page'),
(16, 'page'),
(17, 'page'),
(18, 'page'),
(19, 'page'),
(20, 'page'),
(21, 'page'),
(22, 'page'),
(23, 'page'),
(24, 'page'),
(25, 'page');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `path` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`path`, `type`) VALUES
('kitten3.jpg', 'image/jpeg'),
('back_in_the_groove.svg', 'image/svg+xml');

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `catname` varchar(255) NOT NULL,
  `catdesc` varchar(255) NOT NULL,
  PRIMARY KEY (`catname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`catname`, `catdesc`) VALUES
('apple', 'orchard			'),
('banana', 'boat			'),
('pickle', 'all about pickles			'),
('potato', 'farm			'),
('Princess', 'Aurora			'),
('tomato', 'soup			'),
('watermelon', 'bacon			');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `topic` int(11) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `topic` (`topic`),
  KEY `author` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`id`, `content`, `date`, `topic`, `author`) VALUES
(1, 'delicious	', '0000-00-00 00:00:00', 1, 'audreymccormick@outlook.com'),
(2, 'delicious	', '0000-00-00 00:00:00', 2, 'audreymccormick@outlook.com'),
(3, 'Aurora	', '0000-00-00 00:00:00', 3, 'audreymccormick@outlook.com'),
(4, 'Pocahontas	', '0000-00-00 00:00:00', 4, 'audreymccormick@outlook.com'),
(12, 'delicious	', '0000-00-00 00:00:00', 5, 'audreymccormick@outlook.com'),
(15, 'with milk	', '0000-00-00 00:00:00', 6, 'audreymccormick@outlook.com'),
(22, 'yum yum', '0000-00-00 00:00:00', 6, 'audreymccormick@outlook.com'),
(23, 'so good', '0000-00-00 00:00:00', 6, 'audreymccormick@outlook.com'),
(25, 'fry em	', '0000-00-00 00:00:00', 7, 'audreymccormick@outlook.com'),
(33, '	boil em', '0000-00-00 00:00:00', 7, 'audreymccormick@outlook.com'),
(34, '	mash em', '0000-00-00 00:00:00', 7, 'audreymccormick@outlook.com'),
(35, '	put em in a stew', '0000-00-00 00:00:00', 7, 'audreymccormick@outlook.com'),
(36, '	potatoes', '0000-00-00 00:00:00', 7, 'audreymccormick@outlook.com'),
(37, 'nutritious', '0000-00-00 00:00:00', 1, 'audreymccormick@outlook.com'),
(38, 'Elsa', '0000-00-00 00:00:00', 4, 'audreymccormick@outlook.com'),
(39, '	Belle', '0000-00-00 00:00:00', 3, 'audreymccormick@outlook.com'),
(40, '	Anna', '0000-00-00 00:00:00', 4, 'audreymccormick@outlook.com'),
(41, '	Rapunzel', '0000-00-00 00:00:00', 4, 'audreymccormick@outlook.com'),
(42, 'also have seeds	', '0000-00-00 00:00:00', 8, 'audreymccormick@outlook.com'),
(43, '	This is true.', '0000-00-00 00:00:00', 8, 'banana');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `subject` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `cat` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `cat` (`cat`),
  KEY `author` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`subject`, `date`, `cat`, `author`, `id`) VALUES
('Green', '0000-00-00 00:00:00', 'pickle', 'audreymccormick@outlook.com', 1),
('Green', '0000-00-00 00:00:00', 'pickle', 'audreymccormick@outlook.com', 2),
('Dimwits', '0000-00-00 00:00:00', 'Princess', 'audreymccormick@outlook.com', 3),
('Less Dim', '0000-00-00 00:00:00', 'Princess', 'audreymccormick@outlook.com', 4),
('red', '0000-00-00 00:00:00', 'apple', 'audreymccormick@outlook.com', 5),
('creamy', '0000-00-00 00:00:00', 'tomato', 'audreymccormick@outlook.com', 6),
('brown', '0000-00-00 00:00:00', 'potato', 'audreymccormick@outlook.com', 7),
('tomatoes', '0000-00-00 00:00:00', 'watermelon', 'audreymccormick@outlook.com', 8);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `content_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `caption` varchar(512) DEFAULT NULL,
  `content_path` varchar(64) NOT NULL,
  `thumb_path` varchar(64) NOT NULL,
  `public` tinyint(1) NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`content_id`, `name`, `caption`, `content_path`, `thumb_path`, `public`) VALUES
(1, 'winkerz', 'winky cat', 'images/kitten1.jpg', 'images/kitten1_thumb.jpg', 1),
(2, 'scratcherz', 'scratchy cat', 'images/kitten2.jpg', 'images/kitten2_thumb.jpg', 1),
(3, 'meowzerz', 'meowy cat', 'images/kitten3.jpg', 'images/kitten3_thumb.jpg', 1),
(4, 'whinerz', 'whiny cat', 'images/kitten4.jpg', 'images/kitten4_thumb.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `content_id` int(11) NOT NULL,
  `path` varchar(64) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`content_id`, `path`, `title`) VALUES
(6, 'universe/story', 'STORY'),
(7, 'universe/focus', 'FOCUS'),
(8, 'universe/community', 'COMMUNITY'),
(9, 'universe/space', 'SPACE'),
(11, 'features/housing', 'HOUSING'),
(12, 'features/professions', 'PROFESSIONS'),
(13, 'features/combat', 'COMBAT'),
(14, 'features/transport', 'TRANSPORTATION'),
(15, 'features/custom', 'CUSTOMIZATION'),
(16, 'features/hobbies', 'HOBBIES'),
(17, 'features/dailynews', 'NEWS');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(256) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `avatarpath` varchar(128) DEFAULT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `password`, `avatarpath`, `level`) VALUES
('audreymccormick@outlook.com', 'Audrey', 'pickle', 'audrey.png', 1),
('banana', 'name', 'squirrel', 'name.png', 0),
('conradkennington@boisestate.edu', 'conrad', 'password', NULL, 1),
('marissaschmidt@boisestate.edu', 'marissa', 'password', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `vote` tinyint(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`topic`) REFERENCES `forum_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_posts_ibfk_2` FOREIGN KEY (`author`) REFERENCES `user` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD CONSTRAINT `forum_topics_ibfk_1` FOREIGN KEY (`cat`) REFERENCES `forum_categories` (`catname`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_topics_ibfk_3` FOREIGN KEY (`author`) REFERENCES `user` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
