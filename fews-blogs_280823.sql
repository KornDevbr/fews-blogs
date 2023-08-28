-- MariaDB dump 10.19  Distrib 10.9.6-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: fews-blogs
-- ------------------------------------------------------
-- Server version	10.9.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `edit_datetime` datetime DEFAULT NULL,
  `public` varchar(5) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES
(37,'The Art of Stargazing','Stargazing is a mesmerizing hobby that allows us to connect with the vast cosmos above. On a clear night, step outside, lay back, and let the wonders of the universe unfold before your eyes. Whether you\'re a seasoned astronomer or a beginner, there\'s always something new to discover in the night sky.\r\n','CosmicExplorer92','2023-08-28 17:54:00',NULL,'yes'),
(38,'The Joys of Spontaneous Travel','While planned vacations are great, there\'s something exhilarating about packing a bag on a whim and hitting the road. Spontaneous travel allows you to embrace the unexpected, explore new places, and create unforgettable memories that are often the most cherished.','SerendipityDreamer','2023-08-28 17:59:13','2023-08-28 18:00:56','yes'),
(39,'The Magic of Local Farmers Markets','Farmers\' markets are more than just places to buy fresh produce; they\'re vibrant hubs of community and sustainability. Supporting local farmers not only benefits your health but also helps strengthen the local economy and reduce carbon emissions from food transportation.\r\n','TechNinja21','2023-08-28 18:00:21','2023-08-28 18:21:49','yes'),
(40,'The Beauty of Random Acts of Kindness','Small acts of kindness can have a profound impact on both the giver and the recipient. From holding the door for someone to buying a coffee for the person in line behind you, these gestures can brighten someone\'s day and create a ripple effect of positivity.\r\n','StarryWanderlust','2023-08-28 18:02:23',NULL,'yes'),
(41,'The Joy of Rediscovering Classic Literature','Classic literature has endured the test of time for a reason. Whether it\'s Shakespearean sonnets or Victorian novels, these timeless works offer a glimpse into different eras and cultures. Revisiting or discovering classic literature can be a rewarding journey of literary exploration.\r\n','VelvetVoyager47','2023-08-28 18:03:29',NULL,'yes'),
(42,'The Magic of Music: Connecting Hearts and Cultures','Music is a universal language that transcends borders and speaks to the soul. It has the power to convey emotions, create unity, and bridge cultural divides.\r\nMusic touches our hearts in unique ways. From joyous melodies to soulful ballads, it has the ability to evoke powerful emotions and stir memories.\r\nThroughout history, music has been a constant companion, reflecting our joys, sorrows, and societal changes. It\'s a universal thread that binds humanity together.\r\nMusic knows no language barriers. It unites people of diverse backgrounds at concerts and festivals, fostering connections that go beyond words.\r\nArtists use music to express themselves, while listeners find solace and healing in its melodies. Music therapy is a recognized tool for emotional and physical well-being.\r\nIn today\'s digital age, music is more accessible than ever. Streaming services and the internet have transformed the industry, empowering independent artists and listeners alike.\r\nIn conclusion, music is a timeless art form that connects us on a profound level. Its magic lies in its ability to unite, inspire, and resonate with the human spirit. Whether you create, appreciate, or simply listen, remember that in the world of music, there\'s a place for everyone.','StarryWanderlust','2023-08-28 18:41:39',NULL,'yes');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `create_datetime` datetime NOT NULL,
  `edit_datetime` datetime DEFAULT NULL,
  `article_id` int(11) NOT NULL,
  `article_topic` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `username_id` int(11) NOT NULL,
  `username_email` varchar(50) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES
(26,'For anyone hesitant about reading classics, start with something that intrigues you. You might be surprised by how much you enjoy it. I know I was!','2023-08-28 18:04:01',NULL,41,'The Joy of Rediscovering Classic Literature','VelvetVoyager47',42,'VelvetVoyager47@example.com'),
(27,'Random acts of kindness don\'t have to cost a thing. Sometimes, a genuine smile or a few kind words can make all the difference.','2023-08-28 18:04:25',NULL,40,'The Beauty of Random Acts of Kindness','VelvetVoyager47',42,'VelvetVoyager47@example.com'),
(29,'It\'s heartwarming to know that by shopping at farmers\' markets, I\'m supporting local farmers and sustainable agriculture practices. It\'s a win-win.','2023-08-28 18:22:50',NULL,39,'The Magic of Local Farmers Markets','VelvetVoyager47',42,'VelvetVoyager47@example.com'),
(30,'One tip for spontaneous travel: always keep a small bag packed with essentials. That way, you\'re always ready for an adventure at a moment\'s notice.','2023-08-28 18:23:10',NULL,38,'The Joys of Spontaneous Travel','VelvetVoyager47',42,'VelvetVoyager47@example.com'),
(31,'If you\'re new to stargazing, there are some great stargazing apps that can help you identify constellations and planets. It makes the hobby even more accessible.\r\n','2023-08-28 18:23:26',NULL,37,'The Art of Stargazing','VelvetVoyager47',42,'VelvetVoyager47@example.com'),
(32,'I\'ve recently taken up stargazing, and it\'s been a surreal experience. There\'s nothing quite like gazing at the stars to put life into perspective.','2023-08-28 18:24:15',NULL,37,'The Art of Stargazing','CosmicExplorer92',38,'CosmicExplorer92@example.com'),
(33,'Spontaneous travel is all about embracing the unknown. Some of my best travel stories come from last-minute adventures.','2023-08-28 18:29:51',NULL,38,'The Joys of Spontaneous Travel','CosmicExplorer92',38,'CosmicExplorer92@example.com'),
(34,'I make it a point to visit my local farmers\' market every weekend. The taste of fresh, locally-grown produce is unbeatable.','2023-08-28 18:30:11',NULL,39,'The Magic of Local Farmers Markets','CosmicExplorer92',38,'CosmicExplorer92@example.com'),
(35,'I try to do at least one random act of kindness every day. It\'s amazing how a small gesture can turn someone\'s entire day around.','2023-08-28 18:30:27',NULL,40,'The Beauty of Random Acts of Kindness','CosmicExplorer92',38,'CosmicExplorer92@example.com'),
(36,'I recently picked up \'Pride and Prejudice\' for the first time since high school, and I\'m amazed at how much I appreciate it now. There\'s so much depth to the characters.','2023-08-28 18:30:39','2023-08-28 18:59:49',41,'The Joy of Rediscovering Classic Literature','CosmicExplorer92',38,'CosmicExplorer92@example.com'),
(37,'I\'ve invested in a good telescope, and it\'s opened up a whole new world of celestial wonders. Saturn\'s rings and Jupiter\'s moons are simply breathtaking.','2023-08-28 18:31:32','2023-08-28 18:33:03',37,'The Art of Stargazing','TechNinja21',40,'TechNinja21@example.com'),
(38,'Spontaneous travel has a way of rejuvenating the soul. It\'s a break from routine and a chance to live in the moment.','2023-08-28 18:31:58',NULL,38,'The Joys of Spontaneous Travel','TechNinja21',40,'TechNinja21@example.com'),
(39,'I\'ve noticed that shopping at farmers\' markets has reduced my food waste. I buy what I need and love trying new fruits and veggies in season.','2023-08-28 18:33:21',NULL,39,'The Magic of Local Farmers Markets','TechNinja21',40,'TechNinja21@example.com'),
(40,'During tough times, acts of kindness remind us that there\'s still goodness in the world. They restore our faith in humanity.','2023-08-28 18:33:42',NULL,40,'The Beauty of Random Acts of Kindness','TechNinja21',40,'TechNinja21@example.com'),
(41,'It\'s incredible how themes from classic literature still resonate with us today. The human experience doesn\'t change all that much.','2023-08-28 18:33:57',NULL,41,'The Joy of Rediscovering Classic Literature','TechNinja21',40,'TechNinja21@example.com'),
(42,'I love watching meteor showers. It\'s like nature\'s own fireworks display. Stargazing has become a family tradition for us.','2023-08-28 18:34:58',NULL,37,'The Art of Stargazing','SerendipityDreamer',39,'SerendipityDreamer@example.com'),
(43,'I once decided to take a road trip with no set destination, and I stumbled upon the most charming little town I\'d ever seen. It\'s now my go-to weekend getaway.','2023-08-28 18:35:11',NULL,38,'The Joys of Spontaneous Travel','SerendipityDreamer',39,'SerendipityDreamer@example.com'),
(44,'The sense of community at farmers\' markets is incredible. It\'s a place where you can chat with the people who grow your food and learn about their farming practices.','2023-08-28 18:35:25',NULL,39,'The Magic of Local Farmers Markets','SerendipityDreamer',39,'SerendipityDreamer@example.com'),
(45,'The beauty of random acts of kindness is that they often come back to you when you least expect it. It\'s like the universe repaying your kindness.','2023-08-28 18:35:39',NULL,40,'The Beauty of Random Acts of Kindness','SerendipityDreamer',39,'SerendipityDreamer@example.com'),
(46,'I love reading classics because it\'s like traveling through time. You get a sense of the values and challenges of different generations.','2023-08-28 18:35:54',NULL,41,'The Joy of Rediscovering Classic Literature','SerendipityDreamer',39,'SerendipityDreamer@example.com'),
(47,'Stargazing is a beautiful reminder of the vastness of the universe and how we\'re just a tiny part of it. It\'s both humbling and inspiring.','2023-08-28 18:36:26',NULL,37,'The Art of Stargazing','StarryWanderlust',41,'StarryWanderlust@example.com'),
(48,'I\'m a planner by nature, but I\'ve learned that sometimes the best experiences happen when you let go of the itinerary and see where the journey takes you.','2023-08-28 18:36:41',NULL,38,'The Joys of Spontaneous Travel','StarryWanderlust',41,'StarryWanderlust@example.com'),
(49,'Farmers\' markets are also great for finding unique artisanal products. I\'ve discovered some amazing homemade jams, cheeses, and crafts there.','2023-08-28 18:36:56',NULL,39,'The Magic of Local Farmers Markets','StarryWanderlust',41,'StarryWanderlust@example.com'),
(50,'I once received a handwritten note from a stranger, and it made my week. It\'s the little things that often mean the most.','2023-08-28 18:37:13',NULL,40,'The Beauty of Random Acts of Kindness','StarryWanderlust',41,'StarryWanderlust@example.com'),
(51,'I\'ve started a classic book club with my friends, and it\'s been a fantastic way to rediscover these timeless works and have meaningful discussions about them.','2023-08-28 18:37:25',NULL,41,'The Joy of Rediscovering Classic Literature','StarryWanderlust',41,'StarryWanderlust@example.com'),
(52,'Absolutely agree with this article. Music is a universal language that has the power to touch our souls. It\'s incredible how a single song can bring people from different backgrounds together, sharing a moment of pure connection.','2023-08-28 18:43:20',NULL,42,'The Magic of Music: Connecting Hearts and Cultures','VelvetVoyager47',42,'VelvetVoyager47@example.com'),
(53,'I\'ve always found solace in music during tough times. It\'s like a trusted friend who understands exactly what you\'re going through. This article beautifully captures the essence of how music can heal and unite us.','2023-08-28 18:45:39',NULL,42,'The Magic of Music: Connecting Hearts and Cultures','TechNinja21',40,'TechNinja21@example.com'),
(54,'Music\'s ability to bridge cultural gaps is truly remarkable. I\'ve had the privilege of attending concerts in different countries, not understanding the lyrics, but feeling the emotions conveyed through the melodies. It\'s a testament to the universality of music.','2023-08-28 18:46:13',NULL,42,'The Magic of Music: Connecting Hearts and Cultures','SerendipityDreamer',39,'SerendipityDreamer@example.com');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `gender` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(36,'user','','81dc9bdb52d04dc20036dbd8313ed055','2023-06-05 19:28:31','Yes, please.','I am just a user for testing the website.'),
(37,'test_user','test@email.test','81dc9bdb52d04dc20036dbd8313ed055','2023-06-17 17:31:52','cat','I am another testing user.'),
(38,'CosmicExplorer92','CosmicExplorer92@example.com','654d3884cc2d3b10627704447ae477bb','2023-08-27 20:29:42','Female','🚀 Space enthusiast on a journey to uncover the mysteries of the cosmos. Believer in infinite possibilities. Let\'s explore the universe together! 🌌'),
(39,'SerendipityDreamer','SerendipityDreamer@example.com','654d3884cc2d3b10627704447ae477bb','2023-08-27 20:41:35','Male','✨ Embracing life\'s unexpected adventures, one day at a time. A dreamer, a wanderer, and a collector of serendipitous moments. 🌟'),
(40,'TechNinja21','TechNinja21@example.com','654d3884cc2d3b10627704447ae477bb','2023-08-27 20:42:40','Cat','💻 Coding by day, gaming by night. A digital ninja with a passion for all things tech. On a quest for the perfect lines of code and high scores. 🎮'),
(41,'StarryWanderlust','StarryWanderlust@example.com','654d3884cc2d3b10627704447ae477bb','2023-08-27 20:44:59','Yes, please.','🌠 Chasing stars and stories around the world. A free spirit with a love for new horizons. Let\'s get lost in the beauty of our planet! 🌍'),
(42,'VelvetVoyager47','VelvetVoyager47@example.com','654d3884cc2d3b10627704447ae477bb','2023-08-27 20:46:21','Other','🌙 Drifting through the realms of music, art, and literature. A nocturnal explorer of creativity and culture. Unveiling the secrets of the night. 🌃');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-28 19:05:54
