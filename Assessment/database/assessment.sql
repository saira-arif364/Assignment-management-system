-- MySQL dump 10.10
--
-- Host: localhost    Database: assessment
-- ------------------------------------------------------
-- Server version	5.0.22-community-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assessment`
--

DROP TABLE IF EXISTS `assessment`;
CREATE TABLE `assessment` (
  `assessment_code` int(9) NOT NULL auto_increment,
  `module_code` varchar(15) NOT NULL,
  `name` varchar(250) NOT NULL,
  `number_markers` varchar(9) NOT NULL,
  `marking_scheme` varchar(9) NOT NULL,
  `weighs` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `deadline` varchar(15) NOT NULL,
  `markers` varchar(250) NOT NULL,
  `sub_assessment` varchar(250) NOT NULL,
  `sub_assessment_description` varchar(250) NOT NULL,
  `sub_assessment_weight` varchar(250) NOT NULL,
  `sub_assessment_marking_scheme` varchar(25) NOT NULL,
  `sub_assessment_deadline` varchar(15) NOT NULL,
  PRIMARY KEY  (`assessment_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment`
--


/*!40000 ALTER TABLE `assessment` DISABLE KEYS */;
LOCK TABLES `assessment` WRITE;
INSERT INTO `assessment` VALUES (22,'CN5103','lab work','2','yes','25%','weekly tutorials','2017-09-03','All Lecturers',' ',' ',' ',' ',' '),(18,'CN5103','exam','2','no','75%','two exams','2017-09-03','All Lecturers','january exam','january','50%','','2017-09-03');
UNLOCK TABLES;
/*!40000 ALTER TABLE `assessment` ENABLE KEYS */;

--
-- Table structure for table `lecturers`
--

DROP TABLE IF EXISTS `lecturers`;
CREATE TABLE `lecturers` (
  `id` int(5) NOT NULL auto_increment,
  `lecturer_id` varchar(9) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `module_code` varchar(9) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--


/*!40000 ALTER TABLE `lecturers` DISABLE KEYS */;
LOCK TABLES `lecturers` WRITE;
INSERT INTO `lecturers` VALUES (1,'s1','u1407170','CN5101','Database'),(7,'s','u1309254','CN5103','Operating Systems'),(8,'s','u1407170','CN5103','Operating Systems');
UNLOCK TABLES;
/*!40000 ALTER TABLE `lecturers` ENABLE KEYS */;

--
-- Table structure for table `marking_scheme`
--

DROP TABLE IF EXISTS `marking_scheme`;
CREATE TABLE `marking_scheme` (
  `id` int(9) NOT NULL auto_increment,
  `module_code` varchar(9) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `assessment_code` varchar(9) NOT NULL,
  `criteria` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `percentage` int(9) NOT NULL,
  `range_type` varchar(50) NOT NULL,
  `marks_range` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marking_scheme`
--


/*!40000 ALTER TABLE `marking_scheme` DISABLE KEYS */;
LOCK TABLES `marking_scheme` WRITE;
INSERT INTO `marking_scheme` VALUES (26,'CN5103','Operating Systems','22','Project Plan and Proposed Solution','Relation being theory and practical work produced',40,'Yes','5'),(25,'CN5103','Operating Systems','22','Problem Definition and Literature Review','Understanding of topic area',20,'Yes','3'),(24,'CN5103','Operating Systems','22','Problem Definition and Literature Review','How well does the report identify the problem being invested?',40,'No','3');
UNLOCK TABLES;
/*!40000 ALTER TABLE `marking_scheme` ENABLE KEYS */;

--
-- Table structure for table `marking_scheme_marks`
--

DROP TABLE IF EXISTS `marking_scheme_marks`;
CREATE TABLE `marking_scheme_marks` (
  `id` int(9) NOT NULL auto_increment,
  `student_id` varchar(10) NOT NULL,
  `module_code` varchar(10) NOT NULL,
  `assessment_code` varchar(10) NOT NULL,
  `marker` varchar(250) NOT NULL,
  `mark_given` int(5) NOT NULL,
  `total_marks` int(5) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marking_scheme_marks`
--


/*!40000 ALTER TABLE `marking_scheme_marks` DISABLE KEYS */;
LOCK TABLES `marking_scheme_marks` WRITE;
INSERT INTO `marking_scheme_marks` VALUES (39,'u1407170','CN5103','22','s1',1,6,'Good effort'),(40,'u1407170','CN5103','22','s1',2,6,'Good effort'),(41,'u1407170','CN5103','22','s1',3,6,'Good effort');
UNLOCK TABLES;
/*!40000 ALTER TABLE `marking_scheme_marks` ENABLE KEYS */;

--
-- Table structure for table `marks`
--

DROP TABLE IF EXISTS `marks`;
CREATE TABLE `marks` (
  `mark_id` int(9) NOT NULL auto_increment,
  `module_code` varchar(9) NOT NULL,
  `assessment_code` varchar(9) NOT NULL,
  `sub_assessment` varchar(50) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `mark1` int(5) NOT NULL,
  `mark2` int(5) NOT NULL,
  `mark3` int(5) NOT NULL,
  `final_mark` int(5) NOT NULL,
  `engagement` varchar(25) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  PRIMARY KEY  (`mark_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--


/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
LOCK TABLES `marks` WRITE;
INSERT INTO `marks` VALUES (66,'CN5103','18','exam','u1407170',45,0,0,45,'Ok','Good attempt');
UNLOCK TABLES;
/*!40000 ALTER TABLE `marks` ENABLE KEYS */;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id` int(9) NOT NULL auto_increment,
  `module_code` varchar(7) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `module_leader` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `level` varchar(25) NOT NULL,
  `assessment1` varchar(50) NOT NULL,
  `assessment2` varchar(50) NOT NULL,
  `assessment3` varchar(50) NOT NULL,
  `lecturers_linked` varchar(250) NOT NULL,
  `engagement_points` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--


/*!40000 ALTER TABLE `module` DISABLE KEYS */;
LOCK TABLES `module` WRITE;
INSERT INTO `module` VALUES (1,'CN5102','Software','a1','Advanced software module to help students improve java skills further before final year.','4','','','','',''),(2,'CN5103','Operating Systems','s1','Scripting','5','18','22','','All Lecturers',''),(3,'CN5101','Database','s1','Database SQL tutorials','5','22','','','',''),(15,'CN5122','Data Comuncations','s1','IP Addressing','5',' ',' ',' ','Supervisor','');
UNLOCK TABLES;
/*!40000 ALTER TABLE `module` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` varchar(8) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `rank` varchar(15) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--


/*!40000 ALTER TABLE `users` DISABLE KEYS */;
LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES ('u1309254','Student','Example','student@example.com','student','pass','Student',5),('u1407156','Admin','Example','admin@example.co.uk','admin','Pass','Admin',0),('u1407170','Supervisor','Example','super@example.com','super','Pass','Lecturer',0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

