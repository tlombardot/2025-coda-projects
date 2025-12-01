-- MySQL dump - Lowify Real Data (Large Dataset)
-- Host: localhost    Database: lowify

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE `artist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `biography` mediumtext,
  `cover` mediumtext,
  `monthly_listeners` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `artist` ADD FULLTEXT KEY `name` (`name`);

--
-- Dumping data for table `artist` (10 Artists)
--

LOCK TABLES `artist` WRITE;
INSERT INTO `artist` VALUES 
(1,'The Weeknd','Canadian singer, songwriter, and record producer known for his sonic versatility and dark lyricism.','https://picsum.photos/id/338/800/800',112000000),
(2,'Daft Punk','French electronic music duo formed in 1993 in Paris by Guy-Manuel de Homem-Christo and Thomas Bangalter.','https://picsum.photos/id/534/800/800',35000000),
(3,'Adele','English singer-songwriter known for her mezzo-soprano vocals and sentimental songwriting.','https://picsum.photos/id/64/800/800',65000000),
(4,'Queen','British rock band formed in London in 1970, led by Freddie Mercury.','https://picsum.photos/id/453/800/800',48000000),
(5,'Michael Jackson','The King of Pop, regarded as one of the most significant cultural figures of the 20th century.','https://picsum.photos/id/1062/800/800',42000000),
(6,'Billie Eilish','American singer and songwriter who gained public attention in 2015 with her debut single Ocean Eyes.','https://picsum.photos/id/342/800/800',78000000),
(7,'Drake','Canadian rapper, singer, and songwriter. An influential figure in contemporary popular music.','https://picsum.photos/id/331/800/800',85000000),
(8,'Taylor Swift','American singer-songwriter. Her narrative songwriting, which is often inspired by her personal life, has received widespread media coverage.','https://picsum.photos/id/823/800/800',100000000),
(9,'Coldplay','British rock band formed in London in 1996. They consist of vocalist Chris Martin, guitarist Jonny Buckland, bassist Guy Berryman, and drummer Will Champion.','https://picsum.photos/id/449/800/800',68000000),
(10,'Ed Sheeran','English singer-songwriter. Born in Halifax, West Yorkshire, and raised in Framlingham, Suffolk.','https://picsum.photos/id/1005/800/800',75000000);
UNLOCK TABLES;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `artist_id` int NOT NULL,
  `cover` mediumtext,
  `release_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `artist_id` (`artist_id`),
  CONSTRAINT `album_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `album` ADD FULLTEXT KEY `name` (`name`);

--
-- Dumping data for table `album` (41 Albums)
--

LOCK TABLES `album` WRITE;
INSERT INTO `album` VALUES 
(1,'After Hours',1,'https://picsum.photos/seed/ah/800/800','2020-03-20 00:00:00'),
(2,'Starboy',1,'https://picsum.photos/seed/sb/800/800','2016-11-25 00:00:00'),
(3,'Beauty Behind the Madness',1,'https://picsum.photos/seed/bbtm/800/800','2015-08-28 00:00:00'),
(4,'Dawn FM',1,'https://picsum.photos/seed/dfm/800/800','2022-01-07 00:00:00'),
(5,'Discovery',2,'https://picsum.photos/seed/disc/800/800','2001-03-12 00:00:00'),
(6,'Random Access Memories',2,'https://picsum.photos/seed/ram/800/800','2013-05-17 00:00:00'),
(7,'Homework',2,'https://picsum.photos/seed/hw/800/800','1997-01-20 00:00:00'),
(8,'Human After All',2,'https://picsum.photos/seed/haa/800/800','2005-03-14 00:00:00'),
(9,'19',3,'https://picsum.photos/seed/19/800/800','2008-01-28 00:00:00'),
(10,'21',3,'https://picsum.photos/seed/21/800/800','2011-01-24 00:00:00'),
(11,'25',3,'https://picsum.photos/seed/25/800/800','2015-11-20 00:00:00'),
(12,'30',3,'https://picsum.photos/seed/30/800/800','2021-11-19 00:00:00'),
(13,'A Night at the Opera',4,'https://picsum.photos/seed/ano/800/800','1975-11-21 00:00:00'),
(14,'The Game',4,'https://picsum.photos/seed/tg/800/800','1980-06-30 00:00:00'),
(15,'News of the World',4,'https://picsum.photos/seed/notw/800/800','1977-10-28 00:00:00'),
(16,'Jazz',4,'https://picsum.photos/seed/jazz/800/800','1978-11-10 00:00:00'),
(17,'Thriller',5,'https://picsum.photos/seed/thril/800/800','1982-11-29 00:00:00'),
(18,'Bad',5,'https://picsum.photos/seed/bad/800/800','1987-08-31 00:00:00'),
(19,'Off the Wall',5,'https://picsum.photos/seed/otw/800/800','1979-08-10 00:00:00'),
(20,'Dangerous',5,'https://picsum.photos/seed/dang/800/800','1991-11-26 00:00:00'),
(21,'When We All Fall Asleep',6,'https://picsum.photos/seed/wwafa/800/800','2019-03-29 00:00:00'),
(22,'Happier Than Ever',6,'https://picsum.photos/seed/hte/800/800','2021-07-30 00:00:00'),
(23,'Dont Smile at Me',6,'https://picsum.photos/seed/dsam/800/800','2017-08-11 00:00:00'),
(24,'Scorpion',7,'https://picsum.photos/seed/scorp/800/800','2018-06-29 00:00:00'),
(25,'Views',7,'https://picsum.photos/seed/views/800/800','2016-04-29 00:00:00'),
(26,'Take Care',7,'https://picsum.photos/seed/tc/800/800','2011-11-15 00:00:00'),
(27,'Nothing Was the Same',7,'https://picsum.photos/seed/nwts/800/800','2013-09-24 00:00:00'),
(28,'More Life',7,'https://picsum.photos/seed/ml/800/800','2017-03-18 00:00:00'),
(29,'1989',8,'https://picsum.photos/seed/1989/800/800','2014-10-27 00:00:00'),
(30,'Reputation',8,'https://picsum.photos/seed/rep/800/800','2017-11-10 00:00:00'),
(31,'Lover',8,'https://picsum.photos/seed/lover/800/800','2019-08-23 00:00:00'),
(32,'Folklore',8,'https://picsum.photos/seed/folk/800/800','2020-07-24 00:00:00'),
(33,'Evermore',8,'https://picsum.photos/seed/ever/800/800','2020-12-11 00:00:00'),
(34,'Parachutes',9,'https://picsum.photos/seed/para/800/800','2000-07-10 00:00:00'),
(35,'A Rush of Blood to the Head',9,'https://picsum.photos/seed/arbtth/800/800','2002-08-26 00:00:00'),
(36,'X&Y',9,'https://picsum.photos/seed/xy/800/800','2005-06-06 00:00:00'),
(37,'Viva La Vida',9,'https://picsum.photos/seed/vlv/800/800','2008-06-12 00:00:00'),
(38,'Plus',10,'https://picsum.photos/seed/plus/800/800','2011-09-09 00:00:00'),
(39,'Multiply',10,'https://picsum.photos/seed/mult/800/800','2014-06-23 00:00:00'),
(40,'Divide',10,'https://picsum.photos/seed/div/800/800','2017-03-03 00:00:00'),
(41,'Equals',10,'https://picsum.photos/seed/eq/800/800','2021-10-29 00:00:00');
UNLOCK TABLES;

--
-- Table structure for table `song`
--

DROP TABLE IF EXISTS `song`;
CREATE TABLE `song` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `artist_id` int NOT NULL,
  `album_id` int NOT NULL,
  `duration` int NOT NULL,
  `is_liked` tinyint(1) NOT NULL DEFAULT '0',
  `note` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `album_id` (`album_id`),
  KEY `artist_id` (`artist_id`),
  CONSTRAINT `song_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`),
  CONSTRAINT `song_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=379 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `song` ADD FULLTEXT KEY `name` (`name`);

--
-- Dumping data for table `song` (378 Songs)
--

LOCK TABLES `song` WRITE;
INSERT INTO `song` (id, name, artist_id, album_id, duration, note, is_liked) VALUES 
-- The Weeknd (Albums 1-4)
(1, 'Alone Again', 1, 1, 250, 4.5, 0),
(2, 'Too Late', 1, 1, 239, 4.2, 0),
(3, 'Hardest To Love', 1, 1, 211, 4.0, 0),
(4, 'Scared To Live', 1, 1, 191, 3.9, 0),
(5, 'Snowchild', 1, 1, 247, 4.1, 0),
(6, 'Escape From LA', 1, 1, 355, 4.6, 0),
(7, 'Heartless', 1, 1, 200, 4.8, 1),
(8, 'Faith', 1, 1, 283, 4.7, 0),
(9, 'Blinding Lights', 1, 1, 200, 5.0, 1),
(10, 'In Your Eyes', 1, 1, 237, 4.8, 0),
(11, 'Save Your Tears', 1, 1, 215, 4.9, 1),
(12, 'Starboy', 1, 2, 230, 4.9, 1),
(13, 'Party Monster', 1, 2, 249, 4.3, 0),
(14, 'False Alarm', 1, 2, 220, 3.8, 0),
(15, 'Reminder', 1, 2, 218, 4.5, 0),
(16, 'Rockin', 1, 2, 232, 4.0, 0),
(17, 'Secrets', 1, 2, 205, 4.2, 0),
(18, 'True Colors', 1, 2, 206, 4.1, 0),
(19, 'Stargirl Interlude', 1, 2, 111, 4.4, 0),
(20, 'Sidewalks', 1, 2, 231, 4.5, 0),
(21, 'Six Feet Under', 1, 2, 237, 4.0, 0),
(22, 'Real Life', 1, 3, 223, 4.1, 0),
(23, 'Losers', 1, 3, 281, 3.9, 0),
(24, 'Tell Your Friends', 1, 3, 334, 4.6, 0),
(25, 'Often', 1, 3, 249, 4.7, 1),
(26, 'The Hills', 1, 3, 242, 4.9, 1),
(27, 'Acquainted', 1, 3, 348, 4.5, 0),
(28, 'Cant Feel My Face', 1, 3, 213, 4.8, 1),
(29, 'Shameless', 1, 3, 253, 4.2, 0),
(30, 'Earned It', 1, 3, 277, 4.7, 0),
(31, 'Dawn FM', 1, 4, 136, 4.0, 0),
(32, 'Gasoline', 1, 4, 212, 4.3, 0),
(33, 'How Do I Make You Love Me?', 1, 4, 214, 4.4, 0),
(34, 'Take My Breath', 1, 4, 339, 4.8, 1),
(35, 'Sacrifice', 1, 4, 188, 4.7, 0),
(36, 'A Tale By Quincy', 1, 4, 96, 3.5, 0),
(37, 'Out of Time', 1, 4, 214, 4.9, 1),
(38, 'Here We Go Again', 1, 4, 209, 4.2, 0),
(39, 'Best Friends', 1, 4, 163, 4.1, 0),
(40, 'Is There Someone Else?', 1, 4, 199, 4.6, 0),

-- Daft Punk (Albums 5-8)
(41, 'One More Time', 2, 5, 320, 5.0, 1),
(42, 'Aerodynamic', 2, 5, 207, 4.7, 0),
(43, 'Digital Love', 2, 5, 298, 4.8, 1),
(44, 'Harder, Better, Faster, Stronger', 2, 5, 224, 4.9, 1),
(45, 'Crescendolls', 2, 5, 211, 4.2, 0),
(46, 'Nightvision', 2, 5, 104, 3.8, 0),
(47, 'Superheroes', 2, 5, 237, 4.3, 0),
(48, 'High Life', 2, 5, 202, 4.1, 0),
(49, 'Something About Us', 2, 5, 231, 4.9, 1),
(50, 'Voyager', 2, 5, 227, 4.5, 0),
(51, 'Give Life Back to Music', 2, 6, 274, 4.6, 0),
(52, 'The Game of Love', 2, 6, 321, 4.2, 0),
(53, 'Giorgio by Moroder', 2, 6, 544, 4.8, 1),
(54, 'Within', 2, 6, 228, 4.1, 0),
(55, 'Instant Crush', 2, 6, 337, 4.9, 1),
(56, 'Lose Yourself to Dance', 2, 6, 353, 4.7, 0),
(57, 'Touch', 2, 6, 498, 4.5, 0),
(58, 'Get Lucky', 2, 6, 369, 5.0, 1),
(59, 'Beyond', 2, 6, 290, 4.0, 0),
(60, 'Motherboard', 2, 6, 341, 3.9, 0),
(61, 'Daftendirekt', 2, 7, 164, 4.1, 0),
(62, 'WDPK 83.7 FM', 2, 7, 28, 3.5, 0),
(63, 'Revolution 909', 2, 7, 326, 4.3, 0),
(64, 'Da Funk', 2, 7, 328, 4.8, 1),
(65, 'Phoenix', 2, 7, 275, 4.0, 0),
(66, 'Fresh', 2, 7, 243, 3.9, 0),
(67, 'Around the World', 2, 7, 429, 4.9, 1),
(68, 'Rollin & Scratchin', 2, 7, 446, 4.2, 0),
(69, 'Teachers', 2, 7, 172, 3.8, 0),
(70, 'High Fidelity', 2, 7, 360, 4.0, 0),
(71, 'Human After All', 2, 8, 319, 4.4, 0),
(72, 'The Prime Time of Your Life', 2, 8, 263, 4.2, 0),
(73, 'Robot Rock', 2, 8, 287, 4.6, 1),
(74, 'Steam Machine', 2, 8, 322, 3.7, 0),
(75, 'Make Love', 2, 8, 288, 4.5, 0),
(76, 'The Brainwasher', 2, 8, 248, 3.6, 0),
(77, 'On/Off', 2, 8, 19, 3.0, 0),
(78, 'Television Rules the Nation', 2, 8, 287, 4.3, 0),
(79, 'Technologic', 2, 8, 284, 4.7, 1),
(80, 'Emotion', 2, 8, 394, 4.1, 0),

-- Adele (Albums 9-12)
(81, 'Daydreamer', 3, 9, 221, 4.2, 0),
(82, 'Best for Last', 3, 9, 259, 4.1, 0),
(83, 'Chasing Pavements', 3, 9, 211, 4.8, 1),
(84, 'Cold Shoulder', 3, 9, 192, 4.3, 0),
(85, 'Crazy for You', 3, 9, 208, 4.0, 0),
(86, 'Melt My Heart to Stone', 3, 9, 204, 4.4, 0),
(87, 'First Love', 3, 9, 190, 3.9, 0),
(88, 'Right as Rain', 3, 9, 197, 4.2, 0),
(89, 'Make You Feel My Love', 3, 9, 212, 4.9, 1),
(90, 'Hometown Glory', 3, 9, 271, 4.7, 0),
(91, 'Rolling in the Deep', 3, 10, 228, 5.0, 1),
(92, 'Rumour Has It', 3, 10, 223, 4.6, 0),
(93, 'Turning Tables', 3, 10, 250, 4.7, 0),
(94, 'Dont You Remember', 3, 10, 243, 4.5, 0),
(95, 'Set Fire to the Rain', 3, 10, 242, 4.9, 1),
(96, 'He Wont Go', 3, 10, 278, 4.2, 0),
(97, 'Take It All', 3, 10, 228, 4.1, 0),
(98, 'Ill Be Waiting', 3, 10, 241, 4.3, 0),
(99, 'One and Only', 3, 10, 348, 4.4, 0),
(100, 'Lovesong', 3, 10, 316, 4.3, 0),
(101, 'Hello', 3, 11, 295, 5.0, 1),
(102, 'Send My Love', 3, 11, 223, 4.6, 0),
(103, 'I Miss You', 3, 11, 348, 4.3, 0),
(104, 'When We Were Young', 3, 11, 290, 4.8, 1),
(105, 'Remedy', 3, 11, 245, 4.2, 0),
(106, 'Water Under the Bridge', 3, 11, 240, 4.7, 0),
(107, 'River Lea', 3, 11, 205, 4.1, 0),
(108, 'Love in the Dark', 3, 11, 286, 4.5, 0),
(109, 'Million Years Ago', 3, 11, 227, 4.4, 0),
(110, 'All I Ask', 3, 11, 272, 4.8, 1),
(111, 'Strangers by Nature', 3, 12, 182, 4.0, 0),
(112, 'Easy on Me', 3, 12, 224, 4.9, 1),
(113, 'My Little Love', 3, 12, 389, 4.3, 0),
(114, 'Cry Your Heart Out', 3, 12, 255, 4.2, 0),
(115, 'Oh My God', 3, 12, 225, 4.7, 0),
(116, 'Can I Get It', 3, 12, 210, 4.4, 0),
(117, 'I Drink Wine', 3, 12, 376, 4.8, 1),
(118, 'All Night Parking', 3, 12, 161, 4.1, 0),
(119, 'Woman Like Me', 3, 12, 300, 4.2, 0),
(120, 'Hold On', 3, 12, 366, 4.5, 0),

-- Queen (Albums 13-16)
(121, 'Death on Two Legs', 4, 13, 223, 4.3, 0),
(122, 'Lazing on a Sunday Afternoon', 4, 13, 67, 4.0, 0),
(123, 'Im in Love with My Car', 4, 13, 185, 4.1, 0),
(124, 'Youre My Best Friend', 4, 13, 172, 4.7, 1),
(125, '39', 4, 13, 211, 4.2, 0),
(126, 'Sweet Lady', 4, 13, 243, 3.9, 0),
(127, 'Seaside Rendezvous', 4, 13, 135, 4.0, 0),
(128, 'The Prophets Song', 4, 13, 501, 4.5, 0),
(129, 'Love of My Life', 4, 13, 219, 4.8, 1),
(130, 'Bohemian Rhapsody', 4, 13, 354, 5.0, 1),
(131, 'Play the Game', 4, 14, 210, 4.4, 0),
(132, 'Dragon Attack', 4, 14, 258, 4.2, 0),
(133, 'Another One Bites the Dust', 4, 14, 215, 4.9, 1),
(134, 'Need Your Loving Tonight', 4, 14, 168, 4.0, 0),
(135, 'Crazy Little Thing Called Love', 4, 14, 164, 4.8, 1),
(136, 'Rock It (Prime Jive)', 4, 14, 273, 4.1, 0),
(137, 'Dont Try Suicide', 4, 14, 232, 3.8, 0),
(138, 'Sail Away Sweet Sister', 4, 14, 213, 4.3, 0),
(139, 'Coming Soon', 4, 14, 171, 3.9, 0),
(140, 'Save Me', 4, 14, 228, 4.5, 0),
(141, 'We Will Rock You', 4, 15, 121, 5.0, 1),
(142, 'We Are the Champions', 4, 15, 179, 5.0, 1),
(143, 'Sheer Heart Attack', 4, 15, 206, 4.3, 0),
(144, 'All Dead, All Dead', 4, 15, 191, 4.1, 0),
(145, 'Spread Your Wings', 4, 15, 274, 4.6, 0),
(146, 'Fight from the Inside', 4, 15, 183, 4.0, 0),
(147, 'Get Down, Make Love', 4, 15, 231, 3.9, 0),
(148, 'Sleeping on the Sidewalk', 4, 15, 188, 4.2, 0),
(149, 'Who Needs You', 4, 15, 185, 4.0, 0),
(150, 'It s Late', 4, 15, 386, 4.5, 0),
(151, 'Mustapha', 4, 16, 181, 3.8, 0),
(152, 'Fat Bottomed Girls', 4, 16, 255, 4.7, 1),
(153, 'Jealousy', 4, 16, 193, 4.1, 0),
(154, 'Bicycle Race', 4, 16, 181, 4.6, 0),
(155, 'If You Cant Beat Them', 4, 16, 255, 4.0, 0),
(156, 'Let Me Entertain You', 4, 16, 181, 4.2, 0),
(157, 'Dead on Time', 4, 16, 203, 3.9, 0),
(158, 'In Only Seven Days', 4, 16, 150, 4.0, 0),
(159, 'Dreamers Ball', 4, 16, 210, 4.1, 0),
(160, 'Fun It', 4, 16, 209, 3.7, 0),

-- Michael Jackson (Albums 17-20)
(161, 'Wanna Be Startin Somethin', 5, 17, 363, 4.6, 0),
(162, 'Baby Be Mine', 5, 17, 260, 4.2, 0),
(163, 'The Girl Is Mine', 5, 17, 221, 4.3, 0),
(164, 'Thriller', 5, 17, 357, 5.0, 1),
(165, 'Beat It', 5, 17, 258, 4.9, 1),
(166, 'Billie Jean', 5, 17, 294, 5.0, 1),
(167, 'Human Nature', 5, 17, 246, 4.7, 0),
(168, 'PYT (Pretty Young Thing)', 5, 17, 238, 4.6, 0),
(169, 'The Lady in My Life', 5, 17, 299, 4.4, 0),
(170, 'Bad', 5, 18, 247, 4.8, 1),
(171, 'The Way You Make Me Feel', 5, 18, 299, 4.7, 0),
(172, 'Speed Demon', 5, 18, 241, 4.1, 0),
(173, 'Liberian Girl', 5, 18, 233, 4.3, 0),
(174, 'Just Good Friends', 5, 18, 246, 4.0, 0),
(175, 'Another Part of Me', 5, 18, 234, 4.2, 0),
(176, 'Man in the Mirror', 5, 18, 319, 4.9, 1),
(177, 'I Just Cant Stop Loving You', 5, 18, 251, 4.5, 0),
(178, 'Dirty Diana', 5, 18, 281, 4.6, 0),
(179, 'Smooth Criminal', 5, 18, 257, 5.0, 1),
(180, 'Dont Stop Til You Get Enough', 5, 19, 365, 4.9, 1),
(181, 'Rock with You', 5, 19, 220, 4.8, 1),
(182, 'Working Day and Night', 5, 19, 314, 4.4, 0),
(183, 'Get on the Floor', 5, 19, 279, 4.2, 0),
(184, 'Off the Wall', 5, 19, 246, 4.5, 0),
(185, 'Girlfriend', 5, 19, 185, 4.0, 0),
(186, 'Shes Out of My Life', 5, 19, 218, 4.3, 0),
(187, 'I Cant Help It', 5, 19, 268, 4.1, 0),
(188, 'Its the Falling in Love', 5, 19, 228, 3.9, 0),
(189, 'Burn This Disco Out', 5, 19, 220, 4.0, 0),
(190, 'Jam', 5, 20, 339, 4.4, 0),
(191, 'Why You Wanna Trip on Me', 5, 20, 324, 4.1, 0),
(192, 'In the Closet', 5, 20, 391, 4.3, 0),
(193, 'She Drives Me Wild', 5, 20, 221, 4.0, 0),
(194, 'Remember the Time', 5, 20, 240, 4.7, 1),
(195, 'Cant Let Her Get Away', 5, 20, 298, 4.1, 0),
(196, 'Heal the World', 5, 20, 384, 4.6, 0),
(197, 'Black or White', 5, 20, 255, 4.9, 1),
(198, 'Who Is It', 5, 20, 394, 4.5, 0),
(199, 'Give In to Me', 5, 20, 329, 4.4, 0),

-- Billie Eilish (Albums 21-23)
(200, 'Bad Guy', 6, 21, 194, 4.9, 1),
(201, 'Xanny', 6, 21, 243, 4.3, 0),
(202, 'You Should See Me in a Crown', 6, 21, 180, 4.6, 0),
(203, 'All the Good Girls Go to Hell', 6, 21, 168, 4.4, 0),
(204, 'Wish You Were Gay', 6, 21, 221, 4.5, 0),
(205, 'When the Partys Over', 6, 21, 196, 4.8, 1),
(206, '8', 6, 21, 173, 4.0, 0),
(207, 'My Strange Addiction', 6, 21, 179, 4.2, 0),
(208, 'Bury a Friend', 6, 21, 193, 4.7, 0),
(209, 'Ilomilo', 6, 21, 156, 4.1, 0),
(210, 'Getting Older', 6, 22, 244, 4.2, 0),
(211, 'I Didnt Change My Number', 6, 22, 158, 4.1, 0),
(212, 'Billie Bossa Nova', 6, 22, 196, 4.3, 0),
(213, 'My Future', 6, 22, 210, 4.6, 0),
(214, 'Oxytocin', 6, 22, 210, 4.4, 0),
(215, 'Goldwing', 6, 22, 151, 4.0, 0),
(216, 'Lost Cause', 6, 22, 212, 4.5, 0),
(217, 'Halleys Comet', 6, 22, 234, 4.3, 0),
(218, 'Not My Responsibility', 6, 22, 227, 4.1, 0),
(219, 'Happier Than Ever', 6, 22, 298, 5.0, 1),
(220, 'Copycat', 6, 23, 193, 4.4, 0),
(221, 'Idontwannabeyouanymore', 6, 23, 203, 4.7, 1),
(222, 'My Boy', 6, 23, 170, 4.3, 0),
(223, 'Watch', 6, 23, 178, 4.2, 0),
(224, 'Party Favor', 6, 23, 204, 4.1, 0),
(225, 'Bellyache', 6, 23, 179, 4.6, 0),
(226, 'Ocean Eyes', 6, 23, 200, 4.9, 1),
(227, 'Hostage', 6, 23, 229, 4.2, 0),
(228, 'Burn', 6, 23, 210, 4.0, 0),
(229, 'Lovely', 6, 23, 200, 4.8, 1),

-- Drake (Albums 24-28)
(230, 'Survival', 7, 24, 136, 4.0, 0),
(231, 'Nonstop', 7, 24, 238, 4.5, 0),
(232, 'Elevate', 7, 24, 184, 4.2, 0),
(233, 'Emotionless', 7, 24, 302, 4.3, 0),
(234, 'Gods Plan', 7, 24, 198, 4.9, 1),
(235, 'Im Upset', 7, 24, 214, 4.1, 0),
(236, '8 Out of 10', 7, 24, 195, 4.0, 0),
(237, 'Mob Ties', 7, 24, 205, 4.2, 0),
(238, 'Sandra s Rose', 7, 24, 216, 4.3, 0),
(239, 'Nice for What', 7, 24, 210, 4.8, 1),
(240, 'Keep the Family Close', 7, 25, 328, 4.1, 0),
(241, '9', 7, 25, 255, 4.0, 0),
(242, 'U With Me?', 7, 25, 297, 4.2, 0),
(243, 'Feel No Ways', 7, 25, 293, 4.3, 0),
(244, 'Hype', 7, 25, 209, 4.1, 0),
(245, 'Weston Road Flows', 7, 25, 253, 4.4, 0),
(246, 'Redemption', 7, 25, 333, 4.0, 0),
(247, 'Controlla', 7, 25, 245, 4.6, 0),
(248, 'One Dance', 7, 25, 173, 4.9, 1),
(249, 'Hotline Bling', 7, 25, 267, 4.8, 1),
(250, 'Over My Dead Body', 7, 26, 273, 4.2, 0),
(251, 'Shot for Me', 7, 26, 224, 4.3, 0),
(252, 'Headlines', 7, 26, 235, 4.7, 1),
(253, 'Crew Love', 7, 26, 208, 4.5, 0),
(254, 'Take Care', 7, 26, 277, 4.8, 1),
(255, 'Marvins Room', 7, 26, 347, 4.9, 1),
(256, 'Buried Alive Interlude', 7, 26, 151, 4.0, 0),
(257, 'Under Ground Kings', 7, 26, 212, 4.1, 0),
(258, 'We ll Be Fine', 7, 26, 248, 4.0, 0),
(259, 'Make Me Proud', 7, 26, 213, 4.4, 0),
(260, 'Tuscan Leather', 7, 27, 366, 4.5, 0),
(261, 'Furthest Thing', 7, 27, 267, 4.3, 0),
(262, 'Started From the Bottom', 7, 27, 173, 4.7, 1),
(263, 'Wu-Tang Forever', 7, 27, 217, 4.1, 0),
(264, 'Own It', 7, 27, 251, 4.0, 0),
(265, 'Worst Behavior', 7, 27, 270, 4.4, 0),
(266, 'From Time', 7, 27, 322, 4.5, 0),
(267, 'Hold On, We re Going Home', 7, 27, 231, 4.9, 1),
(268, 'Connect', 7, 27, 296, 4.2, 0),
(269, 'The Language', 7, 27, 224, 4.1, 0),
(270, 'Free Smoke', 7, 28, 218, 4.2, 0),
(271, 'No Long Talk', 7, 28, 149, 4.0, 0),
(272, 'Passionfruit', 7, 28, 298, 4.8, 1),
(273, 'Jorja Interlude', 7, 28, 107, 3.9, 0),
(274, 'Get It Together', 7, 28, 250, 4.3, 0),
(275, 'Madiba Riddim', 7, 28, 205, 4.1, 0),
(276, 'Blem', 7, 28, 216, 4.2, 0),
(277, '4422', 7, 28, 186, 4.0, 0),
(278, 'Gyalchester', 7, 28, 189, 4.4, 0),
(279, 'Portland', 7, 28, 237, 4.5, 0),

-- Taylor Swift (Albums 29-33)
(280, 'Welcome to New York', 8, 29, 212, 4.2, 0),
(281, 'Blank Space', 8, 29, 231, 4.9, 1),
(282, 'Style', 8, 29, 231, 4.8, 1),
(283, 'Out of the Woods', 8, 29, 235, 4.5, 0),
(284, 'All You Had to Do Was Stay', 8, 29, 193, 4.1, 0),
(285, 'Shake It Off', 8, 29, 219, 4.7, 0),
(286, 'I Wish You Would', 8, 29, 207, 4.2, 0),
(287, 'Bad Blood', 8, 29, 211, 4.4, 0),
(288, 'Wildest Dreams', 8, 29, 220, 4.8, 1),
(289, 'How You Get the Girl', 8, 29, 247, 4.3, 0),
(290, 'Ready for It?', 8, 30, 208, 4.5, 0),
(291, 'End Game', 8, 30, 244, 4.2, 0),
(292, 'I Did Something Bad', 8, 30, 238, 4.4, 0),
(293, 'Dont Blame Me', 8, 30, 236, 4.7, 1),
(294, 'Delicate', 8, 30, 232, 4.8, 1),
(295, 'Look What You Made Me Do', 8, 30, 211, 4.3, 0),
(296, 'So It Goes...', 8, 30, 227, 4.0, 0),
(297, 'Gorgeous', 8, 30, 209, 4.2, 0),
(298, 'Getaway Car', 8, 30, 233, 4.6, 0),
(299, 'King of My Heart', 8, 30, 214, 4.1, 0),
(300, 'I Forgot That You Existed', 8, 31, 170, 4.1, 0),
(301, 'Cruel Summer', 8, 31, 178, 4.8, 1),
(302, 'Lover', 8, 31, 221, 4.7, 1),
(303, 'The Man', 8, 31, 190, 4.4, 0),
(304, 'The Archer', 8, 31, 211, 4.3, 0),
(305, 'I Think He Knows', 8, 31, 173, 4.2, 0),
(306, 'Miss Americana', 8, 31, 234, 4.1, 0),
(307, 'Paper Rings', 8, 31, 222, 4.5, 0),
(308, 'Cornelia Street', 8, 31, 287, 4.6, 0),
(309, 'Death by a Thousand Cuts', 8, 31, 198, 4.3, 0),
(310, 'The 1', 8, 32, 210, 4.5, 0),
(311, 'Cardigan', 8, 32, 239, 4.8, 1),
(312, 'The Last Great American Dynasty', 8, 32, 231, 4.6, 0),
(313, 'Exile', 8, 32, 285, 4.9, 1),
(314, 'My Tears Ricochet', 8, 32, 255, 4.7, 0),
(315, 'Mirrorball', 8, 32, 209, 4.4, 0),
(316, 'Seven', 8, 32, 208, 4.3, 0),
(317, 'August', 8, 32, 261, 4.8, 1),
(318, 'This Is Me Trying', 8, 32, 195, 4.2, 0),
(319, 'Illicit Affairs', 8, 32, 190, 4.3, 0),
(320, 'Willow', 8, 33, 214, 4.7, 1),
(321, 'Champagne Problems', 8, 33, 244, 4.8, 1),
(322, 'Gold Rush', 8, 33, 185, 4.3, 0),
(323, 'Tis the Damn Season', 8, 33, 229, 4.4, 0),
(324, 'Tolerate It', 8, 33, 245, 4.5, 0),
(325, 'No Body, No Crime', 8, 33, 215, 4.6, 0),
(326, 'Happiness', 8, 33, 315, 4.2, 0),
(327, 'Dorothea', 8, 33, 225, 4.1, 0),
(328, 'Coney Island', 8, 33, 275, 4.3, 0),
(329, 'Ivy', 8, 33, 260, 4.4, 0),

-- Coldplay (Albums 34-37)
(330, 'Don t Panic', 9, 34, 137, 4.4, 0),
(331, 'Shiver', 9, 34, 299, 4.5, 0),
(332, 'Spies', 9, 34, 318, 4.2, 0),
(333, 'Sparks', 9, 34, 227, 4.6, 0),
(334, 'Yellow', 9, 34, 269, 5.0, 1),
(335, 'Trouble', 9, 34, 270, 4.7, 0),
(336, 'Parachutes', 9, 34, 46, 3.8, 0),
(337, 'High Speed', 9, 34, 254, 4.0, 0),
(338, 'We Never Change', 9, 34, 249, 4.1, 0),
(339, 'Everything s Not Lost', 9, 34, 436, 4.3, 0),
(340, 'Politik', 9, 35, 318, 4.4, 0),
(341, 'In My Place', 9, 35, 228, 4.6, 0),
(342, 'God Put a Smile upon Your Face', 9, 35, 297, 4.5, 0),
(343, 'The Scientist', 9, 35, 309, 5.0, 1),
(344, 'Clocks', 9, 35, 307, 4.9, 1),
(345, 'Daylight', 9, 35, 327, 4.1, 0),
(346, 'Green Eyes', 9, 35, 223, 4.3, 0),
(347, 'Warning Sign', 9, 35, 331, 4.4, 0),
(348, 'A Whisper', 9, 35, 238, 3.9, 0),
(349, 'A Rush of Blood to the Head', 9, 35, 351, 4.5, 0),
(350, 'Square One', 9, 36, 287, 4.2, 0),
(351, 'What If', 9, 36, 297, 4.3, 0),
(352, 'White Shadows', 9, 36, 328, 4.4, 0),
(353, 'Fix You', 9, 36, 294, 5.0, 1),
(354, 'Talk', 9, 36, 311, 4.6, 0),
(355, 'X&Y', 9, 36, 274, 4.1, 0),
(356, 'Speed of Sound', 9, 36, 288, 4.7, 0),
(357, 'A Message', 9, 36, 285, 4.2, 0),
(358, 'Low', 9, 36, 332, 4.0, 0),
(359, 'The Hardest Part', 9, 36, 265, 4.3, 0),
(360, 'Life in Technicolor', 9, 37, 149, 4.2, 0),
(361, 'Cemeteries of London', 9, 37, 201, 4.1, 0),
(362, 'Lost!', 9, 37, 235, 4.4, 0),
(363, '42', 9, 37, 237, 4.0, 0),
(364, 'Lovers in Japan', 9, 37, 411, 4.5, 0),
(365, 'Yes', 9, 37, 426, 4.2, 0),
(366, 'Viva La Vida', 9, 37, 242, 5.0, 1),
(367, 'Violet Hill', 9, 37, 222, 4.6, 0),
(368, 'Strawberry Swing', 9, 37, 249, 4.5, 0),
(369, 'Death and All His Friends', 9, 37, 378, 4.3, 0),

-- Ed Sheeran (Albums 38-41)
(370, 'The A Team', 10, 38, 258, 4.7, 1),
(371, 'Drunk', 10, 38, 200, 4.3, 0),
(372, 'Lego House', 10, 38, 185, 4.6, 0),
(373, 'Sing', 10, 39, 235, 4.5, 0),
(374, 'Dont', 10, 39, 219, 4.4, 0),
(375, 'Thinking Out Loud', 10, 39, 281, 4.9, 1),
(376, 'Shape of You', 10, 40, 233, 4.8, 1),
(377, 'Castle on the Hill', 10, 40, 261, 4.7, 0),
(378, 'Bad Habits', 10, 41, 231, 4.5, 0);
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40000 ALTER TABLE `song` ENABLE KEYS */
;
UNLOCK TABLES;


ALTER TABLE `song`
    ADD COLUMN `is_liked` tinyint(1) NOT NULL DEFAULT 0
    AFTER `duration`;

DROP TABLE IF EXISTS `playlist`;
DROP TABLE IF EXISTS `x_playlist_song`;

CREATE TABLE `playlist` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `duration` int NOT NULL DEFAULT 0,
    `nb_song` int NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 379 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `x_playlist_song` (
    `id` int NOT NULL AUTO_INCREMENT,
    `song_id` int NOT NULL,
    `playlist_id` int NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id` (`id`),
    KEY `song_id` (`song_id`),
    KEY `playlist_id` (`playlist_id`),
    CONSTRAINT `xps_fk_1` FOREIGN KEY (`song_id`) REFERENCES `song` (`id`),
    CONSTRAINT `xps_fk2` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 379 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;

-- Dump completed on 2025-11-09 10:44:30