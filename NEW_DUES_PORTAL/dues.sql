-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: dues_portal
-- ------------------------------------------------------
-- Server version	5.5.62

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `address` (
  `roll_no` varchar(20) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `addr` varchar(250) DEFAULT NULL,
  `pin_code` varchar(10) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES ('b160865cs','ALLU SAI PRUDHVI','ARYAVATAM, NEAR ELECTRICUTY OFFICE','533468','9533244333'),('b160230cs','ABHIJITH S','KEARALA','765432','23456789000'),('b160087cs','rjgdhddwhe','dcsygcd','503009','7994322397');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `user_name` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(100) DEFAULT NULL,
  `uploaded` tinyint(1) DEFAULT '0',
  `due_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES ('sac','b065dff10cc9c2443f8902f430d8ef8af1027ce1',1,'2020-01-01 16:04:49');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department` (
  `dp_name` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `uploaded` tinyint(1) DEFAULT '0',
  `due_updated` datetime DEFAULT NULL,
  `bill_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`dp_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES ('civil','b59cdc8a5eed8189a9564d10ebaa6895dc20827c','Civil Engineering',0,NULL,NULL),('cse','e0a13ad4498b3fc22c91f8d58af84533430af03e','Computer Science and Engineering',1,'2019-11-03 10:36:28',NULL),('ece','9449941fc421ca8dd52fb71866015807cb5dd946','Electronics and Communication Engineering',1,'2019-10-26 21:48:26',NULL),('eee','9203b8805dfb321c86579034123b6dc5e41b42c1','Electrical and Electronics Engineering',1,'2019-10-26 21:43:59',NULL),('hostel','1aaaf38330c4140537a5f5c9fe8aec3050689d1b','Hostel Office',1,'2019-10-26 16:39:51','2020-01-01 17:00:42'),('mech','d5375d973c3b5036014a8121928b0f44db57c905','Mechanical Engineering',0,NULL,NULL),('tnp','4981b73f9d76e323c7a4418b171c6e1f02561300','Training and Placement',1,'2019-10-26 17:21:51',NULL);
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone_number`
--

DROP TABLE IF EXISTS `phone_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phone_number` (
  `roll_no` varchar(20) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone_number`
--

LOCK TABLES `phone_number` WRITE;
/*!40000 ALTER TABLE `phone_number` DISABLE KEYS */;
INSERT INTO `phone_number` VALUES ('b160865cs','9533244333'),('b160865cs','8639290644'),('b160865cs','9533244333'),('b160865cs','8639290644'),('b160230cs','987654567'),('b160230cs','987670234'),('b160087cs','7994322397'),('b160087cs','7013839183');
/*!40000 ALTER TABLE `phone_number` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stu_dpt_dues`
--

DROP TABLE IF EXISTS `stu_dpt_dues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stu_dpt_dues` (
  `roll_no` varchar(20) DEFAULT NULL,
  `dp_name` varchar(20) DEFAULT NULL,
  `dues` int(11) DEFAULT '0',
  `approve` tinyint(1) DEFAULT '0',
  KEY `roll_no` (`roll_no`),
  KEY `dp_name` (`dp_name`),
  CONSTRAINT `stu_dpt_dues_ibfk_1` FOREIGN KEY (`roll_no`) REFERENCES `student` (`roll_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stu_dpt_dues_ibfk_2` FOREIGN KEY (`dp_name`) REFERENCES `department` (`dp_name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stu_dpt_dues`
--

LOCK TABLES `stu_dpt_dues` WRITE;
/*!40000 ALTER TABLE `stu_dpt_dues` DISABLE KEYS */;
INSERT INTO `stu_dpt_dues` VALUES ('B160230CS','cse',0,1),('B160275CS','cse',2200,0),('B160356CS','cse',6300,0),('B160470CS','cse',5400,0),('b160865cs','cse',0,1),('B160087CS','cse',200,0),('B160581CS','cse',300,0),('B160376CS','cse',400,0),('B160116CS','cse',500,0),('B160139CS','cse',100,0),('B160253CS','cse',200,0),('B160642CS','cse',300,0),('B160606CS','cse',0,1),('B160547CS','cse',100,0),('B160555CS','cse',200,0),('B160230CS','Hostel',-200,1),('B160275CS','Hostel',-200,1),('B160356CS','Hostel',200,0),('B160470CS','Hostel',200,0),('b160865cs','Hostel',200,1),('B160087CS','Hostel',200,0),('B160581CS','Hostel',200,0),('B160376CS','Hostel',200,0),('B160116CS','Hostel',200,0),('B160139CS','Hostel',200,0),('B160253CS','Hostel',200,0),('B160642CS','Hostel',200,0),('B160606CS','Hostel',200,0),('B160547CS','Hostel',200,0),('B160555CS','Hostel',200,0),('B160230CS','tnp',2000,0),('B160275CS','tnp',1000,0),('B160356CS','tnp',3000,0),('B160470CS','tnp',2500,0),('b160865cs','tnp',0,1),('B160230CS','eee',2000,0),('B160275CS','eee',1000,0),('B160356CS','eee',3000,0),('B160470CS','eee',2500,0),('b160865cs','eee',1500,0),('B160230CS','ece',2000,0),('B160275CS','ece',1000,0),('B160356CS','ece',3000,0),('B160470CS','ece',2500,0),('b160865cs','ece',0,1);
/*!40000 ALTER TABLE `stu_dpt_dues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `roll_no` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `is_visited` tinyint(1) DEFAULT NULL,
  `email_id` varchar(40) DEFAULT NULL,
  `pgm` varchar(15) DEFAULT NULL,
  `pg_specification` varchar(30) DEFAULT NULL,
  `bank_name` varchar(30) DEFAULT NULL,
  `bank_branch` varchar(50) DEFAULT NULL,
  `account_no` varchar(30) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `place` varchar(20) DEFAULT NULL,
  `ref_no` varchar(30) DEFAULT NULL,
  `branch` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`roll_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('B130290CS [P]','BHAGATH RAJ PONNAPPAN','e18fb59af20b408ef240cb60dcd88aeb64ae8859',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B140274CS [R]','JAVED HASSAN K','aae639749c80938c87f01299024594e53398aecb',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B150091CS [P]','FASIL IBRAHIM K','8e1b5b288b858cc98fb321623c27d33aa5023602',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160038CS','ROSHAN ANTONY BHANU XAVIER PAUL','e672f7aa89c262fc93b94743c01428cb53108aba',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160046CS','THOMAS MANAKALATHIL PHILIP','c8cdb72a23de186d8ac6b204dbcbf5557aa22feb',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160057CS','RAHUL MENON','5596b4d6cde71ee3e3b02196f4e375255607dae5',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160072CS','JOSSY JOSEPH','fedd0b57663d48ac6f18d5398f3b3957870fb0d7',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160083CS','SANJU ALEX JACOB','d985db553e7362b64237544f6a16f77ec55a8cf8',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160087CS','AMALU PRADEEP THEVALAKARA','16c555208ee6e111cb1f00c9b99f688e145d7f39',1,'123espn@gmail.com','UG','gghgh','urgf','daccds','79943223976',NULL,NULL,'ghvsagnx','Computer Science and Engineering'),('B160093CS','RAINA','3d636889c1cf8519aea131f6551dc90b78394c77',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160099CS','YALAMARTI SRI RAM PAVAN\n','2d27f8f90fd36dbf6b27b373ec38af7c11796c0b',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160109CS','RAYIPALLI VAMSI KRISHNA','8a499eb35c62ccd5731ea79da8671ae4d6852b33',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160116CS','APARNA M','75eae056254917bf14080a6b2bbf3185b5aa0cf8',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160124CS','MANDYAM REDDYSEKHAR','b76d7ca4a0d4e5f217e88779d525ba613bae30cf',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160139CS','ASWIN A','576818a7213bcd5517b56dd2b481fa1ef63f77db',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160146CS','PUNIT KUMAR','74cfc7086ef0882a02b7fed474aabf0cf42881f9',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160153CS','SANGEETH JOHN','3c55e585751158be89daea823dc8672b2421677b',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160158CS','MANU JOSE PHILIP','070024ae29a08a8e717ed675d359e82bb89ff06d',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160175CS','SUDHI MOHAN','63a0f4c7acc59ab993bd50a248eb99db2dc7845b',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160185CS','SREERAJ R MENON','cf5f4df149129c936c885c7c9e19e2f67068a19b',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160198CS','T BHARAT BHUSHAN REDDY','cec525e41bcdae1bf8e9055b1bc03a160ca28547',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160210CS','HANAMKONDA VAMSHI','12708c532a2a3773cc43a429056a985e1b167c62',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160214CS','REDNAM SAI SUJITHA','a4172ff4f67c39e59cfa1c55d5dc36e25e30a3b0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160228CS','VRINDHA K','d073555b2925d0cf5da707f92fae349475d22a5f',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160230CS','ABHIJITH S','c3b6dca1e1f68926acbe4cdaa1249e49ed83cf11',1,'abhbijioth@gmail.com','UG','no','SBI','KATTANGAL','09875434567',NULL,NULL,'671280210U','Computer Science and Engineering'),('B160246CS','HARISHANKAR S','f55e94c17ae85b395f33407d0fe12592b8eed9c8',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160253CS','BINIL BABU G','7f3c15e1fb06ca17fbabb09e6adeebb2ef4e8f71',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160268CS','SNEHA K','8e885e4911f204ae58a9a79ea84ddeecee585a53',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160275CS','ADHERSH KRISHNA V','3a2254ee40cd47c256d5c7e0f41691cfee08bb8d',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160278CS','RAHUL M S','50af1653c63da379cf069043e9a56576170cc53b',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160286CS','PILLA VIJAYA LAKSHMI','7480341bcb7aa454c2c47caff640787c2e860625',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160326CS','NIRMALA VAISHALINI','3dee2263793901d1b46bc050054b35d6022946a4',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160333CS','KOPPARTHI ANNARAPU SIVA VARDHAN RED','95fd492c38784093908771336e0dfcd26d5c2cd3',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160340CS','PASUPULETI SATYANARAYANA','448d372abaacaed0a3c2708994467bde853ba0d2',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160346CS','RISHAD C','45a017d2d9151a24a9aa51d9fd72e3bc20c0e7e2',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160356CS','AJISHA T.P','35aa776a0e85f91ccc2479480ffdcecf83aaa599',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160376CS','ANUPAMA KUMARI','4a57ca5a785541c989ada570db4f5098903a2bd6',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160405CS','MUHAMMAD NIYAS T T K','935e60c8aca514fb1dafb1dad4af709a34845d5b',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160428CS','MARUBOYINA SAI ANEESHA','5cf077236ddccaaeee77b7b4a15c14a92a6bf464',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160470CS','AKHIL JOSEPH SUNNY','878eae2916e141a34e76ae137f147347dc4ce483',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160473CS','NUKALA SAI DHANUJ','ac23515c58b214f1ebf3e079ab684a670b42875c',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160483CS','VISAKH S','07ae197da1b75e2144252819a565144aaa6fe6ce',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160497CS','GHORADKAR PRAJWAL PANDURANG','1e474e25cabc2d8285bf74b2085fb037b16ba211',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160506CS','SHAIK MOHAMMAD SHAREEF','9507ded869dad022212b696c1d191446da91e79a',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160511CS','SHIRSWAR MALHAR HEMANTKUMAR','b438f5c352d7f2cb375118e2e4f68ffaf55899da',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160517CS','GURUDU KALYAN KUMAR','42fd73414e0096ac1652e74003e8594cb11912a1',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160536CS','KONDIPUDI KRUPA PRAKASH','71bdb0dc5f8528f8b8b5e334d3bcc52a7b65d927',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160547CS','CHEDURUPALLI JAGADEESH','da0cc54f944de93cb275be70a0770bbd0dd7283b',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160555CS','CHUNDRU PRUDHVI SAIRAM','36ba5359425f14d47f585b5efe1d6e3afd2c27b0',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160581CS','ANJITHA S BABU','e14cb086ef2d16b745ba407d8c4acee0c7b2d253',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160589CS','MOHAMMAD HUSAIN','e01daff12178a935e8657575888adc68b4283c54',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160606CS','BYRI YOGESWAR BHARAT KUMAR','b5be85e8198718fe76f005e84da97c577c5842cf',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160610CS','STEBIN JOSEPH','704b9aeae2ff28c9f6db33aed50a28b603569c1e',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160632CS','SHAH KENIL RAMESHBHAI','5782ac2899cd1e4d8aaecf1c7b58d4a523861111',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160642CS','BISHAIN NAVRANGE','d587e4b8c97dcd7932493160a22e1914e0cdb746',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160653CS','GOGINENI BHARATH','9a3c6a2aa1d511d768c08606746ad27d033e2fa9',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160660CS','PACHCHIPULUSU VINEELA','fcb86fd0a0036f6b0b936f61e04437fc11dc9654',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160668CS','LINGAMANENI DIVYA','ece2578451399222a80fa933465739a4aed32a8b',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160683CS','TARITLA RAHUL','6111b427e61c5e7ef02420e4152b1963e5274c58',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160688CS','VISHNU POOTHERY','1474bc6d2bbb6cebfe08a925a586f145a75ebfad',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160710CS','RAKESH CHOWDARY YARLAGADDA','0e22fbca7ea69de1d395072b171232cd3e612d84',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160716CS','RAVURI ANUSHA','5266a23bb51799e15d9f755c75c6f74bf9bdcb08',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160733CS','JONNALAGADDA VISHNU VARDHAN SAI','b0e55754e4708c30cd160089526ecc65980c146a',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160741CS','JISHNU V','41d898ec5e0a7d818e1c934b2eedb4dc5f15db61',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('b160743ec','sai kiran pollireddy','399ca8fdfa976da83ec00df7050558089a392ed9',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160747CS','GAJJARAPU HEMANTHNATH CHOWDARY','76021349b0bcff6e746cc340b6c17d46c68b5cf5',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160756CS','RAHUL KUMAR','364213eec07b163dc3d7b00bbcd00e9fe1e32f23',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160769CS','JAMMALA VINOD KUMAR REDDY','ba841d21b06599b1674b9df500744bfd5c7c5a7c',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160799CS','SAI GOPAL RATHOD','2a4d7a863e3f337f5a7bea93acb63b6f4bdeef69',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160829CS','HARSHITHA POTLA','c0db8ee0cddfa0be5a05f7a7bef78e38da5c8873',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160850CS','M RAM PRABHU','8e44a60ef028cfc2286a2700c941066bcc1e0f92',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160855CS','MERUGU SHARATH','76e81608ff72ebdd3920c73c7ced315ff2de0e6b',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160865CS','ALLU SAI PRUDHVI','619d581cf9c59d40e477248cb1692714f09369e8',1,'allusaiprudhvi111@gmail.com','UG','nothing','SBI','CHETTAMANGALAM','987656789087',NULL,NULL,'76629U9989','Computer Science and Engineering'),('B160886CS','KOLLI SAI SARANYA','a507bdf348e4d3f7015d04bf36da90a70e3e9dc3',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160901CS','JYOTHSNA SHAJI','dc69f10a8605109deffd64a0dd83ec04be2a4c0c',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('B160932CS','FARSANA.K','de0e8d44fc1ec423f1433d971bc7c914f81dc6ed',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-06 14:23:04
