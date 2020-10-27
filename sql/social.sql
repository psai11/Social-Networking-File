-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2020 at 01:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `ID` int(11) NOT NULL,
  `USER_TO` varchar(50) NOT NULL,
  `USER_FROM` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `ID` int(11) NOT NULL,
  `BODY` text NOT NULL,
  `ADDED_BY` varchar(60) NOT NULL,
  `USER_TO` varchar(60) NOT NULL,
  `DATE_ADDED` datetime NOT NULL,
  `DELETED` varchar(3) NOT NULL,
  `LIKES` int(11) NOT NULL,
  `IMAGE` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`ID`, `BODY`, `ADDED_BY`, `USER_TO`, `DATE_ADDED`, `DELETED`, `LIKES`, `IMAGE`) VALUES
(5, 'heyyyyy!!!!!', 'karboi27', 'none', '2020-09-29 03:15:55', 'no', 0, ''),
(6, 'wassup bruh!!', 'Albus', 'none', '2020-09-30 01:10:06', 'no', 0, ''),
(7, 'hey there!!', 'sat1402', 'none', '2020-09-30 01:11:08', 'no', 0, ''),
(8, 'How are you?\n', 'sat1402', 'none', '2020-09-30 01:39:35', 'no', 0, ''),
(9, 'hello mummy!!\n', 'karboi27', 'none', '2020-09-30 01:47:26', 'no', 0, ''),
(10, 'hollaa!!!\n\namigos!!', 'karboi27', 'none', '2020-09-30 03:19:14', 'no', 1, ''),
(11, 'What you doin mannn!!', 'karboi27', 'none', '2020-09-30 03:19:24', 'no', 0, ''),
(12, 'Yo yo yo its pj. Talk after the beep!!', 'karboi27', 'none', '2020-09-30 03:19:51', 'no', 0, ''),
(13, 'Hey broo, take a chill pill boiii!', 'Albus', 'none', '2020-09-30 03:20:26', 'no', 0, ''),
(14, 'you bro is finally here!!', 'Albus', 'none', '2020-09-30 03:20:35', 'no', 0, ''),
(15, 'lets get the party started!!', 'Albus', 'none', '2020-09-30 03:20:44', 'no', 0, ''),
(16, 'hey hey hey!!!', 'Albus', 'none', '2020-09-30 04:22:22', 'no', 0, ''),
(17, 'Scroll not workin!!', 'Albus', 'none', '2020-09-30 04:22:31', 'no', 1, ''),
(19, 'helloooo', 'sat1402', 'none', '2020-10-02 05:41:56', 'no', 0, ''),
(20, 'is it working??', 'sat1402', 'none', '2020-10-02 05:50:38', 'no', 0, ''),
(21, 'hello', 'pvn', 'none', '2020-10-02 07:56:26', 'no', 0, ''),
(22, 'i am back', 'Albus', 'none', '2020-10-02 07:57:50', 'no', 4, ''),
(23, 'Its working!!!', 'Albus', 'none', '2020-10-08 08:47:32', 'yes', 2, ''),
(24, 'Amaziingg!!\n', 'Albus', 'none', '2020-10-08 08:47:42', 'yes', 1, ''),
(25, 'nice one boiii!!\n', 'karboi27', 'none', '2020-10-08 08:47:57', 'no', 0, ''),
(26, 'good to see it works!', 'karboi27', 'none', '2020-10-08 08:48:09', 'no', 0, ''),
(27, 'yeassj\n', 'karboi27', 'none', '2020-10-08 08:48:48', 'no', 0, ''),
(28, 'breaking bad op!!\n', 'karboi27', 'none', '2020-10-08 08:49:00', 'no', 1, ''),
(29, 'enter pe post kyu nhi hota', 'karboi27', 'none', '2020-10-08 08:49:19', 'no', 1, ''),
(30, 'karboi pg 13 laghu hai', 'sat1402', 'none', '2020-10-08 08:49:38', 'no', 2, ''),
(31, 'heey guys!!\n', 'shiv', 'none', '2020-10-08 14:02:00', 'no', 0, ''),
(32, 'my post are gonna be invisible in a minute!', 'shiv', 'none', '2020-10-08 14:02:23', 'no', 0, ''),
(33, 'New Comment Section Available on Click!! ', 'Albus', 'none', '2020-10-08 15:42:24', 'no', 3, ''),
(34, 'hey kid!!', 'sat1402', 'Albus', '2020-10-12 14:08:12', 'no', 2, ''),
(35, 'Posted to own!', 'sat1402', 'none', '2020-10-12 14:13:19', 'no', 0, ''),
(36, 'Yo broo wasssup!!?', 'karboi27', 'Albus', '2020-10-12 14:14:46', 'no', 1, ''),
(37, 'Hey from swams!!', 'Swams', 'Albus', '2020-10-22 00:33:14', 'no', 1, ''),
(38, 'lets try again..', 'Swams', 'Albus', '2020-10-22 00:38:13', 'no', 1, ''),
(39, 'helo', 'Albus', 'Swams', '2020-10-22 00:40:26', 'no', 1, ''),
(40, 'Post to self', 'Albus', 'none', '2020-10-22 00:55:39', 'no', 2, ''),
(41, 'hello', 'sat1402', 'Albus', '2020-10-22 01:25:44', 'yes', 1, ''),
(42, 'hiii', 'fire01', 'aniruu', '2020-10-22 02:25:01', 'no', 3, ''),
(43, 'Hi everyone! How are you today?\n', 'sat1402', 'none', '2020-10-23 09:47:37', 'no', 0, ''),
(44, 'Had your breakfast?\n', 'sat1402', 'Albus', '2020-10-23 09:54:51', 'no', 0, ''),
(45, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/JobqtKFMzDg\'></iframe><br>', 'Albus', 'none', '2020-10-23 13:17:12', 'yes', 0, ''),
(46, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/R2h6KIpBums\'></iframe><br>', 'Albus', 'none', '2020-10-23 13:21:15', 'yes', 0, ''),
(47, 'umm okay..', 'Albus', 'none', '2020-10-23 13:37:50', 'no', 1, ''),
(48, 'guys check this <br><iframe width=\'420\' height=\'315\' src=\'out...\n\nhttps://www.youtube.com/embed/R2h6KIpBums\'></comment_iframe><br>', 'Albus', 'none', '2020-10-23 13:43:40', 'yes', 0, ''),
(49, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/R2h6KIpBums\'></comment_iframe><br>', 'Albus', 'none', '2020-10-23 13:43:59', 'yes', 0, ''),
(50, 'Guys check this out this is awesome <br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/R2h6KIpBums\'></comment_iframe><br>', 'Albus', 'none', '2020-10-23 13:44:26', 'yes', 0, ''),
(51, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/R2h6KIpBums\'></iframe><br>', 'Albus', 'none', '2020-10-23 13:50:49', 'no', 1, ''),
(52, 'Check this out very good video, <br><iframe width=\'620\' height=\'515\' src=\'https://www.youtube.com/embed/R2h6KIpBums\'></iframe><br>', 'Albus', 'none', '2020-10-23 20:54:13', 'yes', 0, ''),
(53, 'hello <br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/9_oybCt0RTI\'></iframe><br>', 'Albus', 'none', '2020-10-23 21:03:33', 'no', 1, ''),
(54, 'This is very nice', 'pvn', 'none', '2020-10-23 21:07:10', 'no', 0, ''),
(55, 'Hi Chaitanya', 'pvn', 'Albus', '2020-10-23 21:14:07', 'no', 0, ''),
(56, 'Hey guys, isn\'t this IPL season amazing!!', 'Albus', 'none', '2020-10-25 13:50:39', 'yes', 0, ''),
(57, 'Hey guys, isn\'t this IPL season amazing!!', 'Albus', 'none', '2020-10-25 13:53:36', 'no', 0, ''),
(58, 'sushant singh Rajput was a great actor', 'Albus', 'none', '2020-10-25 14:05:42', 'no', 0, ''),
(59, 'Upload Image section..', 'Albus', 'none', '2020-10-25 14:39:04', 'no', 0, 'assets/images/posts5f9540b0a49f2IMG_20191208_082425.jpeg'),
(60, 'again..', 'Albus', 'none', '2020-10-25 14:42:56', 'yes', 0, 'assets/images/posts5f954198393d8IMG_20191208_100230.jpeg'),
(61, 'again..', 'Albus', 'none', '2020-10-25 14:42:56', 'yes', 0, 'assets/images/posts5f954198393d8IMG_20191208_100230.jpeg'),
(62, 'hmm', 'Albus', 'none', '2020-10-25 14:43:33', 'yes', 0, 'assets/images/posts5f9541bd610edIMG_20191208_100213.jpeg'),
(63, 'hmm', 'Albus', 'none', '2020-10-25 14:43:33', 'yes', 0, 'assets/images/posts5f9541bd610edIMG_20191208_100213.jpeg'),
(64, 'again', 'Albus', 'none', '2020-10-25 14:48:39', 'yes', 0, 'assets/images/posts5f9542ef54d9aIMG_20191208_100213.jpeg'),
(65, 'mo and po', 'Albus', 'none', '2020-10-25 14:49:02', 'yes', 0, 'assets/images/posts5f95430690889IMG-20200202-WA0003.jpg'),
(66, 'new img', 'Albus', 'none', '2020-10-25 14:51:47', 'yes', 0, 'assets/images/posts5f9543ab9cb2eIMG_20191208_082452.jpeg'),
(67, 'See this', 'Albus', 'none', '2020-10-25 15:06:13', 'no', 0, 'assets/images/posts5f95470d762cfIMG_20191208_100213.jpeg'),
(68, 'new image upload feature given', 'Albus', 'none', '2020-10-25 15:08:41', 'no', 0, ''),
(69, 'new image upload feature given', 'Albus', 'none', '2020-10-25 15:08:53', 'yes', 0, ''),
(70, 'new image upload feature given', 'Albus', 'none', '2020-10-25 15:08:57', 'yes', 0, ''),
(71, 'new image upload feature given', 'Albus', 'none', '2020-10-25 15:09:06', 'yes', 0, ''),
(72, 'hi', 'Albus', 'none', '2020-10-25 15:09:20', 'no', 0, ''),
(73, 'working?', 'Albus', 'pvn', '2020-10-25 15:19:51', 'yes', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `media_comments`
--

CREATE TABLE `media_comments` (
  `ID` int(11) NOT NULL,
  `POST_BODY` text NOT NULL,
  `POSTED_BY` varchar(60) NOT NULL,
  `POSTED_TO` varchar(60) NOT NULL,
  `DATE_ADDED` datetime NOT NULL,
  `REMOVED` varchar(3) NOT NULL,
  `POST_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media_comments`
--

INSERT INTO `media_comments` (`ID`, `POST_BODY`, `POSTED_BY`, `POSTED_TO`, `DATE_ADDED`, `REMOVED`, `POST_ID`) VALUES
(1, 'yeahhh!!', 'karboi27', 'Albus', '2020-10-08 15:42:41', 'no', 33),
(2, 'ikr!!!', 'karboi27', 'Albus', '2020-10-08 15:46:13', 'no', 24),
(3, 'post no 33?', 'sat1402', 'Albus', '2020-10-08 16:27:26', 'no', 33),
(4, 'new comments, ig not showing!', 'sat1402', 'Albus', '2020-10-08 16:41:03', 'no', 33),
(5, 'well now they are!', 'sat1402', 'Albus', '2020-10-08 16:43:28', 'no', 33),
(7, 'Hello boiii!!', 'Albus', 'karboi27', '2020-10-12 14:15:24', 'no', 36),
(8, 'Me no kidd!!', 'Albus', 'sat1402', '2020-10-12 14:15:36', 'no', 34),
(9, 'hey, i can comment from profile page too!', 'Albus', 'karboi27', '2020-10-12 16:45:26', 'no', 36),
(10, 'yeah okay', 'Albus', 'Albus', '2020-10-22 00:44:19', 'no', 33),
(11, 'noiiceee', 'Albus', 'sat1402', '2020-10-22 00:45:04', 'no', 35),
(12, 'helo', 'Albus', 'Swams', '2020-10-22 00:45:41', 'no', 37),
(13, 'hii', 'sat1402', 'karboi27', '2020-10-22 01:25:54', 'no', 36),
(14, 'hello boisss!', 'Albus', 'fire01', '2020-10-23 04:35:44', 'no', 42),
(15, 'noice', 'Albus', 'Albus', '2020-10-23 13:33:32', 'no', 45),
(16, 'Good !!!', 'pvn', 'Albus', '2020-10-23 21:08:00', 'no', 53),
(17, 'hello', 'pvn', 'sat1402', '2020-10-23 21:08:57', 'no', 44),
(18, 'hey papa', 'Albus', 'pvn', '2020-10-23 21:43:03', 'no', 55);

-- --------------------------------------------------------

--
-- Table structure for table `media_likes`
--

CREATE TABLE `media_likes` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(60) NOT NULL,
  `POST_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media_likes`
--

INSERT INTO `media_likes` (`ID`, `USERNAME`, `POST_ID`) VALUES
(6, 'Albus', 33),
(7, 'Albus', 30),
(8, 'Albus', 29),
(9, 'Albus', 28),
(10, 'Albus', 23),
(11, 'Albus', 22),
(12, 'Albus', 10),
(14, 'sat1402', 30),
(15, 'sat1402', 24),
(16, 'sat1402', 33),
(17, 'sat1402', 22),
(19, 'sat1402', 23),
(25, 'sat1402', 34),
(26, 'Albus', 36),
(27, 'Albus', 34),
(28, 'Swams', 33),
(29, 'Swams', 22),
(30, 'sat1402', 40),
(31, 'Albus', 41),
(32, 'Albus', 38),
(33, 'Albus', 37),
(34, 'aniruu', 42),
(35, 'fire01', 42),
(36, 'fire01', 40),
(37, 'fire01', 39),
(38, 'fire01', 22),
(39, 'fire01', 17),
(40, 'Albus', 42),
(41, 'Albus', 51),
(42, 'pvn', 53),
(43, 'pvn', 47);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `USER_TO` varchar(50) NOT NULL,
  `USER_FROM` varchar(50) NOT NULL,
  `BODY` text NOT NULL,
  `DATE` datetime NOT NULL,
  `OPENED` varchar(3) NOT NULL,
  `VIEWED` varchar(3) NOT NULL,
  `DELETED` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `USER_TO`, `USER_FROM`, `BODY`, `DATE`, `OPENED`, `VIEWED`, `DELETED`) VALUES
(1, 'karboi27', 'Albus', 'hey broo!!', '2020-10-13 20:00:50', 'yes', 'yes', 'no'),
(2, 'karboi27', 'Albus', 'trial messaes', '2020-10-13 20:02:11', 'yes', 'yes', 'no'),
(3, 'karboi27', 'Albus', 'message spamm', '2020-10-13 20:02:16', 'yes', 'yes', 'no'),
(4, 'karboi27', 'Albus', 'here we gooo', '2020-10-13 20:02:20', 'yes', 'yes', 'no'),
(5, 'karboi27', 'Albus', 'here we gooo', '2020-10-13 20:02:20', 'yes', 'yes', 'no'),
(6, 'karboi27', 'Albus', 'yeayyy', '2020-10-13 20:02:24', 'yes', 'yes', 'no'),
(7, 'karboi27', 'Albus', 'again and again', '2020-10-13 20:02:54', 'yes', 'yes', 'no'),
(8, 'karboi27', 'Albus', 'twice how?\r\n', '2020-10-13 20:03:31', 'yes', 'yes', 'no'),
(9, 'Albus', 'karboi27', 'wth broo!!', '2020-10-13 20:04:51', 'yes', 'yes', 'no'),
(10, 'Albus', 'karboi27', 'stop spamming', '2020-10-13 20:04:56', 'yes', 'yes', 'no'),
(11, 'Albus', 'karboi27', 'what if  database exceeds!!', '2020-10-13 20:05:12', 'yes', 'yes', 'no'),
(12, 'Albus', 'karboi27', 'we can get a problem!!', '2020-10-13 20:05:19', 'yes', 'yes', 'no'),
(13, 'Albus', 'karboi27', 'so stop!!!', '2020-10-13 20:05:23', 'yes', 'yes', 'no'),
(14, 'karboi27', 'Albus', 'Does it work?', '2020-10-14 00:00:31', 'yes', 'yes', 'no'),
(15, 'Albus', 'karboi27', 'yeaayyyy!', '2020-10-14 00:00:59', 'yes', 'yes', 'no'),
(18, 'Albus', 'karboi27', 'so goes to top huh?', '2020-10-14 00:12:18', 'yes', 'yes', 'no'),
(19, 'Albus', 'karboi27', 'shift enter?', '2020-10-14 00:12:38', 'yes', 'yes', 'no'),
(20, 'Albus', 'karboi27', 'so hey!!', '2020-10-14 00:15:36', 'yes', 'yes', 'no'),
(21, 'karboi27', 'sat1402', 'hey bachha!!', '2020-10-14 00:59:28', 'yes', 'yes', 'no'),
(22, 'sat1402', 'karboi27', 'hi mumma, how are you?', '2020-10-14 01:00:14', 'yes', 'yes', 'no'),
(23, 'Albus', 'karboi27', 'hi kiddo', '2020-10-14 01:03:26', 'yes', 'yes', 'no'),
(24, 'sat1402', 'Albus', 'yo moose!! wasssup?\r\n', '2020-10-14 01:20:20', 'yes', 'yes', 'no'),
(25, 'sat1402', 'Albus', 'hehe!', '2020-10-14 01:20:31', 'yes', 'yes', 'no'),
(26, 'pvn', 'Albus', 'hello pops!', '2020-10-14 01:21:03', 'yes', 'yes', 'no'),
(27, 'karboi27', 'Albus', 'yes yes i am here.', '2020-10-14 01:21:38', 'yes', 'yes', 'no'),
(28, 'karboi27', 'pvn', 'testing..', '2020-10-14 23:42:58', 'yes', 'yes', 'no'),
(29, 'Albus', 'pvn', 'good website boiii!!', '2020-10-14 23:43:12', 'yes', 'yes', 'no'),
(30, 'sat1402', 'Albus', 'From profile page?', '2020-10-15 00:33:02', 'yes', 'yes', 'no'),
(31, 'sat1402', 'Albus', 'lets see if it goes back?', '2020-10-15 00:38:51', 'yes', 'yes', 'no'),
(32, 'sat1402', 'Albus', 'noice', '2020-10-15 00:38:56', 'yes', 'yes', 'no'),
(35, 'Albus', 'shiv', 'hii i am your friend!!!', '2020-10-16 01:02:53', 'yes', 'yes', 'no'),
(36, 'Albus', 'shiv', 'hola', '2020-10-16 01:02:59', 'yes', 'yes', 'no'),
(37, 'shiv', 'Albus', 'hey buddy, whatsupp', '2020-10-16 01:03:30', 'no', 'no', 'no'),
(38, 'chiru03', 'AB101', 'hey', '2020-10-16 01:05:33', 'yes', 'yes', 'no'),
(39, 'Albus', 'AB101', 'hey..', '2020-10-16 01:05:49', 'yes', 'yes', 'no'),
(40, 'chiru03', 'Albus', 'holla brooo!!', '2020-10-16 01:06:56', 'yes', 'yes', 'no'),
(42, 'TVmax', 'Albus', 'hey wassup?', '2020-10-16 01:10:27', 'yes', 'yes', 'no'),
(43, 'Albus', 'Albus', 'hey buddy, enjoy!!', '2020-10-16 01:28:25', 'yes', 'yes', 'no'),
(44, 'TVmax', 'Albus', 'so working!!', '2020-10-16 01:30:00', 'yes', 'yes', 'no'),
(45, 'Albus', 'Swams', 'hey..', '2020-10-16 01:56:31', 'yes', 'yes', 'no'),
(46, 'Albus', 'fire01', 'hiiii', '2020-10-16 01:59:47', 'yes', 'yes', 'no'),
(47, 'Albus', 'aniruu', 'chotuu!!', '2020-10-16 02:01:42', 'yes', 'yes', 'no'),
(48, 'karboi27', 'Albus', 'testing chats\r\n', '2020-10-21 18:54:47', 'yes', 'yes', 'no'),
(49, 'karboi27', 'Albus', 'helo', '2020-10-21 18:54:57', 'yes', 'yes', 'no'),
(50, 'Albus', 'Swams', 'Testing..', '2020-10-21 18:56:50', 'yes', 'yes', 'no'),
(51, 'Swams', 'Albus', 'helo', '2020-10-21 18:57:07', 'yes', 'yes', 'no'),
(52, 'aniruu', 'fire01', 'hello', '2020-10-22 02:24:53', 'yes', 'yes', 'no'),
(53, 'aniruu', 'fire01', 'hello', '2020-10-22 02:25:01', 'yes', 'yes', 'no'),
(54, 'pvn', 'sat1402', 'Breakfast achcha lagaa kya?\r\n', '2020-10-23 09:58:09', 'yes', 'yes', 'no'),
(55, 'sat1402', 'pvn', 'Bahut Achha lagaa', '2020-10-23 21:06:12', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(11) NOT NULL,
  `USER_TO` varchar(50) NOT NULL,
  `USER_FROM` varchar(50) NOT NULL,
  `MESSAGE` text NOT NULL,
  `LINK` varchar(100) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `OPENED` varchar(3) NOT NULL,
  `VIEWED` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ID`, `USER_TO`, `USER_FROM`, `MESSAGE`, `LINK`, `DATETIME`, `OPENED`, `VIEWED`) VALUES
(2, 'Albus', 'Swams', 'Swamita Gupta liked your post', 'post.php?id=22', '2020-10-22 00:37:57', 'yes', 'yes'),
(3, 'Albus', 'Swams', 'Swamita Gupta posted on your profile', 'post.php?id=38', '2020-10-22 00:38:14', 'yes', 'yes'),
(4, 'Swams', 'Albus', 'SAI CHAITANYA posted on your profile', 'post.php?id=39', '2020-10-22 00:40:27', 'yes', 'yes'),
(5, 'karboi27', 'Albus', 'SAI CHAITANYA commented on a post you commented on', 'post.php?id=33', '2020-10-22 00:44:19', 'no', 'yes'),
(6, 'sat1402', 'Albus', 'SAI CHAITANYA commented on a post you commented on', 'post.php?id=33', '2020-10-22 00:44:20', 'no', 'yes'),
(7, 'sat1402', 'Albus', 'SAI CHAITANYA commented on your post', 'post.php?id=35', '2020-10-22 00:45:04', 'no', 'yes'),
(8, 'Swams', 'Albus', 'SAI CHAITANYA commented on your post', 'post.php?id=37', '2020-10-22 00:45:41', 'yes', 'yes'),
(9, 'Albus', 'sat1402', 'Satyavathi liked your post', 'post.php?id=40', '2020-10-22 01:25:35', 'yes', 'yes'),
(10, 'Albus', 'sat1402', 'Satyavathi posted on your profile', 'post.php?id=41', '2020-10-22 01:25:44', 'yes', 'yes'),
(11, 'karboi27', 'sat1402', 'Satyavathi commented on your post', 'post.php?id=36', '2020-10-22 01:25:54', 'no', 'no'),
(12, 'Albus', 'sat1402', 'Satyavathi commented on your profile post', 'post.php?id=36', '2020-10-22 01:25:54', 'yes', 'yes'),
(13, 'sat1402', 'Albus', 'SAI CHAITANYA liked your post', 'post.php?id=41', '2020-10-22 02:12:04', 'yes', 'yes'),
(14, 'Swams', 'Albus', 'SAI CHAITANYA liked your post', 'post.php?id=38', '2020-10-22 02:12:19', 'yes', 'yes'),
(15, 'Swams', 'Albus', 'SAI CHAITANYA liked your post', 'post.php?id=37', '2020-10-22 02:12:20', 'yes', 'yes'),
(16, 'aniruu', 'fire01', 'Agniva Basak posted on your profile', 'post.php?id=42', '2020-10-22 02:25:01', 'yes', 'yes'),
(17, 'fire01', 'aniruu', 'Anirudh Mishra liked your post', 'post.php?id=42', '2020-10-22 02:27:58', 'yes', 'yes'),
(18, 'Albus', 'fire01', 'Agniva Basak liked your post', 'post.php?id=40', '2020-10-22 02:28:55', 'yes', 'yes'),
(19, 'Albus', 'fire01', 'Agniva Basak liked your post', 'post.php?id=39', '2020-10-22 02:28:56', 'yes', 'yes'),
(20, 'Albus', 'fire01', 'Agniva Basak liked your post', 'post.php?id=22', '2020-10-22 02:28:59', 'yes', 'yes'),
(21, 'Albus', 'fire01', 'Agniva Basak liked your post', 'post.php?id=17', '2020-10-22 02:29:00', 'yes', 'yes'),
(22, 'fire01', 'Albus', 'SAI CHAITANYA liked your post', 'post.php?id=42', '2020-10-22 19:39:15', 'yes', 'yes'),
(23, 'fire01', 'Albus', 'SAI CHAITANYA commented on your post', 'post.php?id=42', '2020-10-23 04:35:44', 'no', 'no'),
(24, 'aniruu', 'Albus', 'SAI CHAITANYA commented on your profile post', 'post.php?id=42', '2020-10-23 04:35:44', 'no', 'no'),
(25, 'Albus', 'sat1402', 'Satyavathi posted on your profile', 'post.php?id=44', '2020-10-23 09:54:51', 'yes', 'yes'),
(26, 'Albus', 'pvn', 'Nath commented on your post', 'post.php?id=53', '2020-10-23 21:08:00', 'yes', 'yes'),
(27, 'Albus', 'pvn', 'Nath liked your post', 'post.php?id=53', '2020-10-23 21:08:13', 'yes', 'yes'),
(28, 'sat1402', 'pvn', 'Nath commented on your post', 'post.php?id=44', '2020-10-23 21:08:57', 'no', 'no'),
(29, 'Albus', 'pvn', 'Nath commented on your profile post', 'post.php?id=44', '2020-10-23 21:08:57', 'yes', 'yes'),
(30, 'Albus', 'pvn', 'Nath liked your post', 'post.php?id=47', '2020-10-23 21:09:45', 'yes', 'yes'),
(31, 'Albus', 'pvn', 'Nath posted on your profile', 'post.php?id=55', '2020-10-23 21:14:07', 'yes', 'yes'),
(32, 'pvn', 'Albus', 'SAI CHAITANYA commented on your post', 'post.php?id=55', '2020-10-23 21:43:03', 'no', 'no'),
(33, 'pvn', 'Albus', 'SAI CHAITANYA posted on your profile', 'post.php?id=73', '2020-10-25 15:19:51', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `TITLE` varchar(50) NOT NULL,
  `HITS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trends`
--

INSERT INTO `trends` (`TITLE`, `HITS`) VALUES
('IPL', 1),
('Sushant', 1),
('Singh', 1),
('Rajput', 1),
('Actor', 1),
('Upload', 5),
('Image', 5),
('Section', 1),
('Hmm', 2),
('Mo', 1),
('Po', 1),
('Img', 1),
('Feature', 4),
('Hi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(11) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `GENDER` varchar(1) NOT NULL,
  `SIGNUP_DATE` date NOT NULL,
  `PROFILE_PIC` varchar(255) NOT NULL,
  `FRIEND_ARRAY` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `USERNAME`, `PASSWORD`, `NAME`, `GENDER`, `SIGNUP_DATE`, `PROFILE_PIC`, `FRIEND_ARRAY`) VALUES
(2, 'pvn', '900150983cd24fb0d6963f7d28e17f72', 'Nath', 'M', '0000-00-00', 'assets/images/profile_pics/pvnbc61d3228ac5fac0404394279202a75an.jpeg', ',Albus,karboi27,sat1402,'),
(4, 'karboi27', '900150983cd24fb0d6963f7d28e17f72', 'Sai Karthikey', 'M', '0000-00-00', 'assets/images/profile_pics/karboi2797fe6c01b5d4ea754ab38d8378b37683n.jpeg', ',Albus,pvn,sat1402,'),
(5, 'sat1402', '7fc4c05e401c6a7355dcedc978f839d9', 'Satyavathi', 'F', '0000-00-00', 'assets/images/profile_pics/sat1402e3e90e59d3c256435c3e32f2b7eddc94n.jpeg', ',Albus,karboi27,pvn,'),
(22, 'shiv', '5f4dcc3b5aa765d61d8327deb882cf99', 'Shiva', 'M', '0000-00-00', 'assets/images/profile_pics/default/head_turqoise.png', ',Albus,'),
(23, 'Albus', '5f4dcc3b5aa765d61d8327deb882cf99', 'SAI CHAITANYA', 'M', '0000-00-00', 'assets/images/profile_pics/Albus2f2b27a11af18d653c9a5f07aa8e3939n.jpeg', ',pvn,sat1402,karboi27,shiv,chiru03,AB101,TVmax,fire01,aniruu,Swams,'),
(24, 'chiru03', '5f4dcc3b5aa765d61d8327deb882cf99', 'Chirag Hegde', 'M', '2020-10-16', 'assets/images/profile_pics/default/head_nephritis.png', ',Albus,AB101,TVmax,'),
(25, 'AB101', '5f4dcc3b5aa765d61d8327deb882cf99', 'Aditya Bharadwaj', 'M', '2020-10-16', 'assets/images/profile_pics/default/head_wet_asphalt.png', ',chiru03,Albus,TVmax,'),
(26, 'TVmax', '5f4dcc3b5aa765d61d8327deb882cf99', 'Tirtha Vinchurkar', 'F', '2020-10-16', 'assets/images/profile_pics/default/head_pomegranate.png', ',Albus,chiru03,AB101,'),
(27, 'Swams', '5f4dcc3b5aa765d61d8327deb882cf99', 'Swamita Gupta', 'F', '2020-10-16', 'assets/images/profile_pics/default/head_wisteria.png', ',fire01,Albus,'),
(28, 'fire01', '5f4dcc3b5aa765d61d8327deb882cf99', 'Agniva Basak', 'M', '2020-10-16', 'assets/images/profile_pics/default/head_green_sea.png', ',Albus,aniruu,Swams,'),
(29, 'aniruu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Anirudh Mishra', 'M', '2020-10-16', 'assets/images/profile_pics/default/head_belize_hole.png', ',Albus,fire01,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `media_comments`
--
ALTER TABLE `media_comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `media_likes`
--
ALTER TABLE `media_likes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `media_comments`
--
ALTER TABLE `media_comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `media_likes`
--
ALTER TABLE `media_likes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
