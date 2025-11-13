-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: estore
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) DEFAULT NULL,
  `brand_logo_path` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,'Intel','resources//brand_logos//intel.svg'),(2,'Nvidia','resources//brand_logos//nvidia.svg'),(3,'Apple','resources//brand_logos//apple.svg'),(4,'Asus','resources//brand_logos//asus.svg'),(5,'Acer','resources//brand_logos//acer.svg'),(6,'Samsung','resources//brand_logos//samsung.svg'),(7,'MSI','resources//brand_logos//msi.svg'),(8,'AMD','resources//brand_logos//amd.svg');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `cart_date` datetime DEFAULT NULL,
  `cart_qty` int DEFAULT NULL,
  `cart_user_id` int NOT NULL,
  `cart_product_id` int NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_user1_idx` (`cart_user_id`),
  KEY `fk_cart_product1_idx` (`cart_product_id`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`cart_product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`cart_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (63,'2024-09-19 22:29:25',1,10,15),(70,'2024-11-11 15:01:32',3,1,13),(71,'2024-12-26 18:30:11',3,1,15);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Desktop PC'),(2,'Laptops'),(3,'Monitors'),(4,'Motherboards'),(5,'Graphic Cards'),(6,'RAM'),(7,'Hard Disks'),(8,'SSD'),(9,'Speakers'),(10,'Processors');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `city_id` int NOT NULL,
  `district_district_id` int NOT NULL,
  `city_name_en` varchar(45) DEFAULT NULL,
  `city_name_si` varchar(45) DEFAULT NULL,
  `postcode` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_cities_districts1_idx` (`district_district_id`),
  CONSTRAINT `fk_cities_districts1` FOREIGN KEY (`district_district_id`) REFERENCES `districts` (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,1,'Akkaraipattu','අක්කරපත්තුව','32400'),(2,1,'Ambagahawatta','අඹගහවත්ත','90326'),(3,1,'Ampara','අම්පාර','32000'),(4,1,'Bakmitiyawa','බක්මිටියාව','32024'),(5,1,'Deegawapiya','දීඝවාපිය','32006'),(6,1,'Devalahinda','දෙවලහිඳ','32038'),(7,1,'Digamadulla Weeragoda','දිගාමඩුල්ල වීරගොඩ','32008'),(8,1,'Dorakumbura','දොරකුඹුර','32104'),(9,1,'Gonagolla','ගොනගොල්ල','32064'),(10,1,'Hulannuge','හුලංනුගේ','32514'),(11,1,'Kalmunai','කල්මුණේ','32300'),(12,1,'Kannakipuram','කන්නකිපුරම්','32405'),(13,1,'Karativu','කරතිව්','32250'),(14,1,'Kekirihena','කැකිරිහේන','32074'),(15,1,'Koknahara','කොක්නහර','32035'),(16,1,'Kolamanthalawa','කෝලමන්තලාව','32102'),(17,1,'Komari','කෝමාරි','32418'),(18,1,'Lahugala','ලාහුගල','32512'),(19,1,'lmkkamam','ල්ම්ක්කමම්','32450'),(20,1,'Mahaoya','මහඔය','32070'),(21,1,'Marathamune','මාරත්මුනේ','32314'),(22,1,'Namaloya','නාමල්ඔය','32037'),(23,1,'Navithanveli','නාවිදන්වෙලි','32308'),(24,1,'Nintavur','නින්දවූර්','32340'),(25,1,'Oluvil','ඔළුවිල','32360'),(26,1,'Padiyatalawa','පදියතලාව','32100'),(27,1,'Pahalalanda','පහලලන්ද','32034'),(28,1,'Panama','පානම','32508'),(29,1,'Pannalagama','පන්නලගම','32022'),(30,1,'Paragahakele','පරගහකැලේ','32031'),(31,1,'Periyaneelavanai','පෙරියනීලවන්නි','32316'),(32,1,'Polwaga Janapadaya','පොල්වග ජනපදය','32032'),(33,1,'Pottuvil','පොතුවිල්','32500'),(34,1,'Sainthamaruthu','සායින්දමරුදු','32280'),(35,1,'Samanthurai','සමන්තුරේ','32200'),(36,1,'Serankada','සේරන්කද','32101'),(37,1,'Tempitiya','ටැම්පිටිය','32072'),(38,1,'Thambiluvil','ල්තැඹිළුවි','32415'),(39,1,'Tirukovil','තිරුකෝවිල','32420'),(40,1,'Uhana','උහන','32060'),(41,1,'Wadinagala','වඩිනාගල','32039'),(42,1,'Wanagamuwa','වනගමුව','32454'),(43,2,'Angamuwa','අංගමුව','50248'),(44,2,'Anuradhapura','අනුරාධපුරය','50000'),(45,2,'Awukana','අව්කන','50169'),(46,2,'Bogahawewa','බෝගහවැව','50566'),(47,2,'Dematawewa','දෙමටවැව','50356'),(48,2,'Dimbulagala','දිඹුලාගල','51031'),(49,2,'Dutuwewa','දුටුවැව','50393'),(50,2,'Elayapattuwa','ඇලයාපත්තුව','50014'),(51,2,'Ellewewa','ඇල්ලේවැව','51034'),(52,2,'Eppawala','එප්පාවල','50260'),(53,2,'Etawatunuwewa','ඇතාවැටුනවැව','50584'),(54,2,'Etaweeragollewa','ඇතාවීරගොලෑව','50518'),(55,2,'Galapitagala','ගලපිටගල','32066'),(56,2,'Galenbindunuwewa','ගලෙන්බිඳුනුවැව','50390'),(57,2,'Galkadawala','ගල්කඩවල','50006'),(58,2,'Galkiriyagama','ගල්කිරියාගම','50120'),(59,2,'Galkulama','ගල්කුලම','50064'),(60,2,'Galnewa','ගල්නෑව','50170'),(61,2,'Gambirigaswewa','ගම්බිරිගස්වැව','50057'),(62,2,'Ganewalpola','ගනේවල්පොල','50142'),(63,2,'Gemunupura','ගැමුණුපුර','50224'),(64,2,'Getalawa','ගෙතලාව','50392'),(65,2,'Gnanikulama','ඝාණිකුළම','50036'),(66,2,'Gonahaddenawa','ගෝනහද්දෙනෑව','50554'),(67,2,'Habarana','හබරන','50150'),(68,2,'Halmillawa Dambulla','හල්මිලෑව දඹුල්ල','50124'),(69,2,'Halmillawetiya','හල්මිල්ලවැටිය','50552'),(70,2,'Hidogama','හිද්දෝගම','50044'),(71,2,'Horawpatana','හොරොව්පතාන','50350'),(72,2,'Horiwila','හොරිවිල','50222'),(73,2,'Hurigaswewa','හුරිගස්වැව','50176'),(74,2,'Hurulunikawewa','හුරුලුනිකවැව','50394'),(75,2,'Ihala Puliyankulama','ඉහල පුලියන්කුලම','61316'),(76,2,'Kagama','කගම','50282'),(77,2,'Kahatagasdigiliya','කහටගස්දිගිලිය','50320'),(78,2,'Kahatagollewa','කහටගොල්ලෑව','50562'),(79,2,'Kalakarambewa','කලකරඹෑව','50288'),(80,2,'Kalaoya','කලාඔය','50226'),(81,2,'Kalawedi Ulpotha','කලාවැදි උල්පොත','50556'),(82,2,'Kallanchiya','කලංචිය','50454'),(83,2,'Kalpitiya','කල්පිටිය','61360'),(84,2,'Kalukele Badanagala','කළුකැලේ බදනාගල','51037'),(85,2,'Kapugallawa','කපුගල්ලව','50370'),(86,2,'Karagahawewa','කරගහවැව','50232'),(87,2,'Kashyapapura','කාශ්‍යපපුර','51032'),(88,2,'Kebithigollewa','කැබිතිගොල්ලෑව','50500'),(89,2,'Kekirawa','කැකිරාව','50100'),(90,2,'Kendewa','කේන්දෑව','50452'),(91,2,'Kiralogama','කිරළෝගම','50259'),(92,2,'Kirigalwewa','කිරිගල්වැව','50511'),(93,2,'Kirimundalama','කිරිමුන්ඩලම','61362'),(94,2,'Kitulhitiyawa','කිතුල්හිටියාව','50132'),(95,2,'Kurundankulama','කුරුන්දන්කුලම','50062'),(96,2,'Labunoruwa','ලබුනෝරුව','50088'),(97,2,'Ihalagama','ඉහලගම','50304'),(98,2,'Ipologama','ඉපොලොගම','50280'),(99,2,'Madatugama','මාදතුගම','50130'),(100,2,'Maha Elagamuwa','මහ ඇලගමුව','50126'),(101,2,'Mahabulankulama','මහබුලංකුලම','50196'),(102,2,'Mahailluppallama','මහඉලුප්පල්ලම','50270'),(103,2,'Mahakanadarawa','මහකනදරාව','50306'),(104,2,'Mahapothana','මහපොතාන','50327'),(105,2,'Mahasenpura','මහසෙන්පුර','50574'),(106,2,'Mahawilachchiya','මහවිලච්චිය','50022'),(107,2,'Mailagaswewa','මයිලගස්වැව','50384'),(108,2,'Malwanagama','මල්වනගම','50236'),(109,2,'Maneruwa','මනේරුව','50182'),(110,2,'Maradankadawala','මරදන්කඩවල','50080'),(111,2,'Maradankalla','මරදන්කල්ල','50308'),(112,2,'Medawachchiya','මැදවච්චිය','50500'),(113,2,'Megodawewa','මීගොඩවැව','50334'),(114,2,'Mihintale','මිහින්තලේ','50300'),(115,2,'Morakewa','මොරකෑව','50349'),(116,2,'Mulkiriyawa','මුල්කිරියාව','50324'),(117,2,'Muriyakadawala','මුරියකඩවල','50344'),(118,5,'Colombo 15','කොළඹ 15','01500'),(119,2,'Nachchaduwa','නච්චදූව','50046'),(120,2,'Namalpura','නාමල්පුර','50339'),(121,2,'Negampaha','නෑගම්පහ','50180'),(122,2,'Nochchiyagama','නොච්චියාගම','50200'),(123,2,'Nuwaragala','නුවරගල','51039'),(124,2,'Padavi Maithripura','පදවි මෛත්‍රීපුර','50572'),(125,2,'Padavi Parakramapura','පදවි පරාක්‍රමපුර','50582'),(126,2,'Padavi Sripura','පදවි ශ්‍රීපුර','50587'),(127,2,'Padavi Sritissapura','පදවි ශ්‍රීතිස්සපුර','50588'),(128,2,'Padaviya','පදවිය','50570'),(129,2,'Padikaramaduwa','පඩිකරමඩුව','50338'),(130,2,'Pahala Halmillewa','පහල හල්මිල්ලෑව','50206'),(131,2,'Pahala Maragahawe','පහල මරගහවෙ','50220'),(132,2,'Pahalagama','පහලගම','50244'),(133,2,'Palugaswewa','පලුගස්වැව','50144'),(134,2,'Pandukabayapura','පන්ඩුකාබයපුර','50448'),(135,2,'Pandulagama','පන්ඩුලගම','50029'),(136,2,'Parakumpura','පරාක්‍රමපුර','50326'),(137,2,'Parangiyawadiya','පරංගියාවාඩිය','50354'),(138,2,'Parasangahawewa','පරසන්ගහවැව','50055'),(139,2,'Pelatiyawa','පැලටියාව','51033'),(140,2,'Pemaduwa','පෙමදූව','50020'),(141,2,'Perimiyankulama','පෙරිමියන්කුලම','50004'),(142,2,'Pihimbiyagolewa','පිහිඹියගොල්ලෑව','50512'),(143,2,'Pubbogama','පුබ්බෝගම','50122'),(144,2,'Punewa','පූනෑව','50506'),(145,2,'Rajanganaya','රාජාංගනය','50246'),(146,2,'Rambewa','රම්බෑව්','50450'),(147,2,'Rampathwila','රම්පත්විල','50386'),(148,2,'Rathmalgahawewa','රත්මල්ගහවැව','50514'),(149,2,'Saliyapura','සාලියපුර','50008'),(150,2,'Seeppukulama','සීප්පුකුලම','50380'),(151,2,'Senapura','සේනාපුර','50284'),(152,2,'Sivalakulama','සිවලකුලම','50068'),(153,2,'Siyambalewa','සියඹලෑව','50184'),(154,2,'Sravasthipura','ස්‍රාවස්තිපුර','50042'),(155,2,'Talawa','තලාව','50230'),(156,2,'Tambuttegama','තඹුත්තේගම','50240'),(157,2,'Tammennawa','තම්මැන්නාව','50104'),(158,2,'Tantirimale','තන්තිරිමලේ','50016'),(159,2,'Telhiriyawa','තෙල්හිරියාව','50242'),(160,2,'Tirappane','තිරප්පනේ','50072'),(161,2,'Tittagonewa','තිත්තගෝනෑව','50558'),(162,2,'Udunuwara Colony','උඩුනුවර කොළණිය','50207'),(163,2,'Upuldeniya','උපුල්දෙනිය','50382'),(164,2,'Uttimaduwa','උට්ටිමඩුව','50067'),(165,2,'Vellamanal','වෙල්ලමනල්','31053'),(166,2,'Viharapalugama','විහාරපාළුගම','50012'),(167,2,'Wahalkada','වාහල්කඩ','50564'),(168,2,'Wahamalgollewa','වහමල්ගොල්ලෑව','50492'),(169,2,'Walagambahuwa','වලගම්බාහුව','50086'),(170,2,'Walahaviddawewa','වලහාවිද්දෑව','50516'),(171,2,'Welimuwapotana','වැලිමුවපතාන','50358'),(172,2,'Welioya Project','වැලිඔය ව්‍යාපෘතිය','50586'),(173,3,'Akkarasiyaya','අක්කරසියය','90166'),(174,3,'Aluketiyawa','අලුකෙටියාව','90736'),(175,3,'Aluttaramma','අළුත්තරම','90722'),(176,3,'Ambadandegama','අඹදන්ඩෙගම','90108'),(177,3,'Ambagasdowa','අඹගස්දූව','90300'),(178,3,'Arawa','අරාව','90017'),(179,3,'Arawakumbura','අරාවකුඹුර','90532'),(180,3,'Arawatta','අරාවත්ත','90712'),(181,3,'Atakiriya','අටකිරියාව','90542'),(182,3,'Badulla','බදුල්ල','90000'),(183,3,'Baduluoya','බදුලුඔය','90019'),(184,3,'Ballaketuwa','බල්ලකැටුව','90092'),(185,3,'Bambarapana','බඹරපාන','90322'),(186,3,'Bandarawela','බණ්ඩාරවෙල','90100'),(187,3,'Beramada','බෙරමඩ','90066'),(188,3,'Bibilegama','බිබිලේගම','90502'),(189,3,'Boragas','බොරගස්','90362'),(190,3,'Boralanda','බොරලන්ද','90170'),(191,3,'Bowela','බෝවෙල','90302'),(192,3,'Central Camp','මධ්‍යම කඳවුර','32050'),(193,3,'Damanewela','දමනෙවෙල','32126'),(194,3,'Dambana','දඹාන','90714'),(195,3,'Dehiattakandiya','දෙහිඅත්තකන්ඩිය','32150'),(196,3,'Demodara','දෙමෝදර','90080'),(197,3,'Diganatenna','දිගනතැන්න','90132'),(198,3,'Dikkapitiya','දික්කපිටිය','90214'),(199,3,'Dimbulana','දිඹුලාන','90324'),(200,3,'Divulapelessa','දිවුලපැලැස්ස','90726'),(201,3,'Diyatalawa','දියතලාව','90150'),(202,3,'Dulgolla','දුල්ගොල්ල','90104'),(203,3,'Ekiriyankumbura','ඇකිරියන්කුඹුර','91502'),(204,3,'Ella','ඇල්ල','90090'),(205,3,'Ettampitiya','ඇට්ටම්පිටිය','90140'),(206,3,'Galauda','ගලඋඩ','90065'),(207,3,'Galporuyaya','ගල්පොරුයාය','90752'),(208,3,'Gawarawela','ගවරවෙල','90082'),(209,3,'Girandurukotte','ගිරාඳුරුකෝට්ටෙ','90750'),(210,3,'Godunna','ගොඩුන්න','90067'),(211,3,'Gurutalawa','ගුරුතලාව','90208'),(212,3,'Haldummulla','හල්දුම්මුල්ල','90180'),(213,3,'Hali Ela','හාලි ඇල','90060'),(214,3,'Hangunnawa','හඟුන්නෑව','90224'),(215,3,'Haputale','හපුතලේ','90160'),(216,3,'Hebarawa','හබරාව','90724'),(217,3,'Heeloya','හීලොය','90112'),(218,3,'Helahalpe','හෙලහල්පේ','90122'),(219,3,'Helapupula','හෙලපුපුළ','90094'),(220,3,'Hopton','හෝප්ටන්','90524'),(221,3,'Idalgashinna','ඉදල්ගස්ඉන්න','96167'),(222,3,'Kahataruppa','කහටරුප්ප','90052'),(223,3,'Kalugahakandura','කළුගහකණ්ඳුර','90546'),(224,3,'Kalupahana','කළුපහණ','90186'),(225,3,'Kebillawela','කොබිල්ලවෙල','90102'),(226,3,'Kendagolla','කන්දෙගොල්ල','90048'),(227,3,'Keselpotha','කෙසෙල්පොත','90738'),(228,3,'Ketawatta','කේතවත්ත','90016'),(229,3,'Kiriwanagama','කිරිවනගම','90184'),(230,3,'Koslanda','කොස්ලන්ද','90190'),(231,3,'Kuruwitenna',NULL,'90728'),(232,3,'Kuttiyagolla',NULL,'90046'),(233,3,'Landewela',NULL,'90068'),(234,3,'Liyangahawela',NULL,'90106'),(235,3,'Lunugala',NULL,'90530'),(236,3,'Lunuwatta',NULL,'90310'),(237,3,'Madulsima',NULL,'90535'),(238,3,'Mahiyanganaya',NULL,'90700'),(239,3,'Makulella',NULL,'90114'),(240,3,'Malgoda',NULL,'90754'),(241,3,'Mapakadawewa',NULL,'90730'),(242,3,'Maspanna',NULL,'90328'),(243,3,'Maussagolla',NULL,'90582'),(244,3,'Mawanagama',NULL,'32158'),(245,3,'Medawela Udukinda',NULL,'90218'),(246,3,'Meegahakiula',NULL,'90015'),(247,3,'Metigahatenna',NULL,'90540'),(248,3,'Mirahawatta',NULL,'90134'),(249,3,'Miriyabedda',NULL,'90504'),(250,3,'Nawamedagama',NULL,'32120'),(251,3,'Nelumgama',NULL,'90042'),(252,3,'Nikapotha',NULL,'90165'),(253,3,'Nugatalawa',NULL,'90216'),(254,3,'Ohiya',NULL,'90168'),(255,3,'Pahalarathkinda',NULL,'90756'),(256,3,'Pallekiruwa',NULL,'90534'),(257,3,'Passara',NULL,'90500'),(258,3,'Pattiyagedara',NULL,'90138'),(259,3,'Pelagahatenna',NULL,'90522'),(260,3,'Perawella',NULL,'90222'),(261,3,'Pitamaruwa',NULL,'90544'),(262,3,'Pitapola',NULL,'90171'),(263,3,'Puhulpola',NULL,'90212'),(264,3,'Rajagalatenna',NULL,'32068'),(265,3,'Ratkarawwa',NULL,'90164'),(266,3,'Ridimaliyadda',NULL,'90704'),(267,3,'Silmiyapura',NULL,'90364'),(268,3,'Sirimalgoda',NULL,'90044'),(269,3,'Siripura',NULL,'32155'),(270,3,'Sorabora Colony',NULL,'90718'),(271,3,'Soragune',NULL,'90183'),(272,3,'Soranatota',NULL,'90008'),(273,3,'Taldena',NULL,'90014'),(274,3,'Timbirigaspitiya',NULL,'90012'),(275,3,'Uduhawara',NULL,'90226'),(276,3,'Uraniya',NULL,'90702'),(277,3,'Uva Karandagolla',NULL,'90091'),(278,3,'Uva Mawelagama',NULL,'90192'),(279,3,'Uva Tenna',NULL,'90188'),(280,3,'Uva Tissapura',NULL,'90734'),(281,3,'Welimada',NULL,'90200'),(282,3,'Werunketagoda',NULL,'32062'),(283,3,'Wewatta',NULL,'90716'),(284,3,'Wineethagama',NULL,'90034'),(285,3,'Yalagamuwa',NULL,'90329'),(286,3,'Yalwela',NULL,'90706'),(287,4,'Addalaichenai',NULL,'32350'),(288,4,'Ampilanthurai','අම්පිලන්තුරෙයි','30162'),(289,4,'Araipattai',NULL,'30150'),(290,4,'Ayithiyamalai',NULL,'30362'),(291,4,'Bakiella',NULL,'30206'),(292,4,'Batticaloa','මඩකලපුව','30000'),(293,4,'Cheddipalayam','චෙඩ්ඩිපලයම්','30194'),(294,4,'Chenkaladi','චෙන්කලඩි','30350'),(295,4,'Eravur','එරාවූර්','30300'),(296,4,'Kaluwanchikudi',NULL,'30200'),(297,4,'Kaluwankemy',NULL,'30372'),(298,4,'Kannankudah',NULL,'30016'),(299,4,'Karadiyanaru',NULL,'30354'),(300,4,'Kathiraveli',NULL,'30456'),(301,4,'Kattankudi',NULL,'30100'),(302,4,'Kiran',NULL,'30394'),(303,4,'Kirankulam',NULL,'30159'),(304,4,'Koddaikallar',NULL,'30249'),(305,4,'Kokkaddichcholai',NULL,'30160'),(306,4,'Kurukkalmadam',NULL,'30192'),(307,4,'Mandur',NULL,'30220'),(308,4,'Miravodai',NULL,'30426'),(309,4,'Murakottanchanai',NULL,'30392'),(310,4,'Navagirinagar',NULL,'30238'),(311,4,'Navatkadu',NULL,'30018'),(312,4,'Oddamavadi',NULL,'30420'),(313,4,'Palamunai',NULL,'32354'),(314,4,'Pankudavely',NULL,'30352'),(315,4,'Periyaporativu',NULL,'30230'),(316,4,'Periyapullumalai',NULL,'30358'),(317,4,'Pillaiyaradi',NULL,'30022'),(318,4,'Punanai',NULL,'30428'),(319,4,'Thannamunai',NULL,'30024'),(320,4,'Thettativu',NULL,'30196'),(321,4,'Thikkodai',NULL,'30236'),(322,4,'Thirupalugamam',NULL,'30234'),(323,4,'Unnichchai',NULL,'30364'),(324,4,'Vakaneri',NULL,'30424'),(325,4,'Vakarai',NULL,'30450'),(326,4,'Valaichenai',NULL,'30400'),(327,4,'Vantharumoolai',NULL,'30376'),(328,4,'Vellavely',NULL,'30204'),(329,5,'Akarawita','අකරවිට','10732'),(330,5,'Ambalangoda','අම්බලන්ගොඩ','80300'),(331,5,'Athurugiriya','අතුරුගිරිය','10150'),(332,5,'Avissawella','අවිස්සාවේල්ල','10700'),(333,5,'Batawala','බටවැල','10513'),(334,5,'Battaramulla','බත්තරමුල්ල','10120'),(335,5,'Biyagama','බියගම','11650'),(336,5,'Bope','බෝපෙ','10522'),(337,5,'Boralesgamuwa','බොරලැස්ගමුව','10290'),(338,5,'Colombo 8','කොළඹ 8','00800'),(339,5,'Dedigamuwa','දැඩිගමුව','10656'),(340,5,'Dehiwala','දෙහිවල','10350'),(341,5,'Deltara','දෙල්තර','10302'),(342,5,'Habarakada','හබරකඩ','10204'),(343,5,'Hanwella',NULL,'10650'),(344,5,'Hiripitya',NULL,'10232'),(345,5,'Hokandara',NULL,'10118'),(346,5,'Homagama',NULL,'10200'),(347,5,'Horagala',NULL,'10502'),(348,5,'Kaduwela',NULL,'10640'),(349,5,'Kaluaggala',NULL,'11224'),(350,5,'Kapugoda',NULL,'10662'),(351,5,'Kehelwatta',NULL,'12550'),(352,5,'Kiriwattuduwa',NULL,'10208'),(353,5,'Kolonnawa',NULL,'10600'),(354,5,'Kosgama',NULL,'10730'),(355,5,'Madapatha',NULL,'10306'),(356,5,'Maharagama',NULL,'10280'),(357,5,'Malabe',NULL,'10115'),(358,5,'Moratuwa',NULL,'10400'),(359,5,'Mount Lavinia',NULL,'10370'),(360,5,'Mullegama',NULL,'10202'),(361,5,'Napawela',NULL,'10704'),(362,5,'Nugegoda',NULL,'10250'),(363,5,'Padukka',NULL,'10500'),(364,5,'Pannipitiya',NULL,'10230'),(365,5,'Piliyandala',NULL,'10300'),(366,5,'Pitipana Homagama',NULL,'10206'),(367,5,'Polgasowita',NULL,'10320'),(368,5,'Pugoda',NULL,'10660'),(369,5,'Ranala',NULL,'10654'),(370,5,'Siddamulla',NULL,'10304'),(371,5,'Siyambalagoda',NULL,'81462'),(372,5,'Sri Jayawardenepu',NULL,'10100'),(373,5,'Talawatugoda',NULL,'10116'),(374,5,'Tummodara',NULL,'10682'),(375,5,'Waga',NULL,'10680'),(376,5,'Colombo 6','කොළඹ 6','00600'),(377,6,'Agaliya','අගලිය','80212'),(378,6,'Ahangama','අහංගම','80650'),(379,6,'Ahungalla','අහුන්ගල්ල','80562'),(380,6,'Akmeemana','අක්මීමාන','80090'),(381,6,'Alawatugoda','අලවතුගොඩ','20140'),(382,6,'Aluthwala','අළුත්වල','80332'),(383,6,'Ampegama','අම්පෙගම','80204'),(384,6,'Amugoda','අමුගොඩ','80422'),(385,6,'Anangoda','අනන්ගොඩ','80044'),(386,6,'Angulugaha','අඟුලුගහ','80122'),(387,6,'Ankokkawala','අංකොක්කාවල','80048'),(388,6,'Aselapura','ඇසලපුර','51072'),(389,6,'Baddegama','බද්දේගම','80200'),(390,6,'Balapitiya','බලපිටිය','80550'),(391,6,'Banagala','බනගල','80143'),(392,6,'Batapola','බටපොල','80320'),(393,6,'Bentota','බෙන්තොට','80500'),(394,6,'Boossa','බූස්ස','80270'),(395,6,'Dellawa','දෙල්ලව','81477'),(396,6,'Dikkumbura','දික්කුඹුර','80654'),(397,6,'Dodanduwa','දොඩන්දූව','80250'),(398,6,'Ella Tanabaddegama','ඇල්ල තනබද්දේගම','80402'),(399,6,'Elpitiya','ඇල්පිටිය','80400'),(400,6,'Galle','ගාල්ල','80000'),(401,6,'Ginimellagaha','ගිනිමෙල්ලගහ','80220'),(402,6,'Gintota','ගින්තොට','80280'),(403,6,'Godahena','ගොඩහේන','80302'),(404,6,'Gonamulla Junction','ගෝනමුල්ල හංදිය','80054'),(405,6,'Gonapinuwala','ගොනාපිනූවල','80230'),(406,6,'Habaraduwa','හබරාදූව','80630'),(407,6,'Haburugala','හබුරුගල','80506'),(408,6,'Hikkaduwa',NULL,'80240'),(409,6,'Hiniduma',NULL,'80080'),(410,6,'Hiyare',NULL,'80056'),(411,6,'Kahaduwa',NULL,'80460'),(412,6,'Kahawa',NULL,'80312'),(413,6,'Karagoda',NULL,'80151'),(414,6,'Karandeniya',NULL,'80360'),(415,6,'Kosgoda',NULL,'80570'),(416,6,'Kottawagama',NULL,'80062'),(417,6,'Kottegoda',NULL,'81180'),(418,6,'Kuleegoda',NULL,'80328'),(419,6,'Magedara',NULL,'80152'),(420,6,'Mahawela Sinhapura',NULL,'51076'),(421,6,'Mapalagama',NULL,'80112'),(422,6,'Mapalagama Central',NULL,'80116'),(423,6,'Mattaka',NULL,'80424'),(424,6,'Meda-Keembiya',NULL,'80092'),(425,6,'Meetiyagoda',NULL,'80330'),(426,6,'Nagoda',NULL,'80110'),(427,6,'Nakiyadeniya',NULL,'80064'),(428,6,'Nawadagala',NULL,'80416'),(429,6,'Neluwa',NULL,'80082'),(430,6,'Nindana',NULL,'80318'),(431,6,'Pahala Millawa',NULL,'81472'),(432,6,'Panangala',NULL,'80075'),(433,6,'Pannimulla Panagoda',NULL,'80086'),(434,6,'Parana ThanaYamgoda',NULL,'80114'),(435,6,'Patana',NULL,'22012'),(436,6,'Pitigala',NULL,'80420'),(437,6,'Poddala',NULL,'80170'),(438,6,'Polgampola',NULL,'12136'),(439,6,'Porawagama',NULL,'80408'),(440,6,'Rantotuwila',NULL,'80354'),(441,6,'Talagampola',NULL,'80058'),(442,6,'Talgaspe',NULL,'80406'),(443,6,'Talpe',NULL,'80615'),(444,6,'Tawalama',NULL,'80148'),(445,6,'Tiranagama',NULL,'80244'),(446,6,'Udalamatta',NULL,'80108'),(447,6,'Udugama',NULL,'80070'),(448,6,'Uluvitike',NULL,'80168'),(449,6,'Unawatuna',NULL,'80600'),(450,6,'Unenwitiya',NULL,'80214'),(451,6,'Uragaha',NULL,'80352'),(452,6,'Uragasmanhandiya',NULL,'80350'),(453,6,'Wakwella',NULL,'80042'),(454,6,'Walahanduwa',NULL,'80046'),(455,6,'Wanchawela',NULL,'80120'),(456,6,'Wanduramba',NULL,'80100'),(457,6,'Warukandeniya',NULL,'80084'),(458,6,'Watugedara',NULL,'80340'),(459,6,'Weihena',NULL,'80216'),(460,6,'Welikanda',NULL,'51070'),(461,6,'Wilanagama',NULL,'20142'),(462,6,'Yakkalamulla',NULL,'80150'),(463,6,'Yatalamatta',NULL,'80107'),(464,7,'Akaragama','අකරගම','11536'),(465,7,'Ambagaspitiya','අඹගස්පිටිය','11052'),(466,7,'Ambepussa','අඹේපුස්ස','11212'),(467,7,'Andiambalama','ආඬිඅම්බලම','11558'),(468,7,'Attanagalla','අත්තනගල්ල','11120'),(469,7,'Badalgama','බඩල්ගම','11538'),(470,7,'Banduragoda','බඳුරගොඩ','11244'),(471,7,'Batuwatta','බටුවත්ත','11011'),(472,7,'Bemmulla','බෙම්මුල්ල','11040'),(473,7,'Biyagama IPZ','බියගම IPZ','11672'),(474,7,'Bokalagama','බොකලගම','11216'),(475,7,'Bollete (WP)','බොල්ලතේ','11024'),(476,7,'Bopagama','බෝපගම','11134'),(477,7,'Buthpitiya','බුත්පිටිය','11720'),(478,7,'Dagonna','දාගොන්න','11524'),(479,7,'Danowita','දංඕවිට','11896'),(480,7,'Debahera','දෙබහැර','11889'),(481,7,'Dekatana','දෙකටන','11690'),(482,7,'Delgoda','දෙල්ගොඩ','11700'),(483,7,'Delwagura','දෙල්වගුර','11228'),(484,7,'Demalagama','දෙමළගම','11692'),(485,7,'Demanhandiya','දෙමන්හන්දිය','11270'),(486,7,'Dewalapola','දේවාලපොල','11102'),(487,7,'Divulapitiya','දිවුලපිටිය','11250'),(488,7,'Divuldeniya','දිවුල්දෙණිය','11208'),(489,7,'Dompe','දොම්පෙ','11680'),(490,7,'Dunagaha','දුනගහ','11264'),(491,7,'Ekala','ඒකල','11380'),(492,7,'Ellakkala','ඇල්ලක්කල','11116'),(493,7,'Essella',NULL,'11108'),(494,7,'Galedanda','ගලේදණ්ඩ','90206'),(495,7,'Gampaha','ගම්පහ','11000'),(496,7,'Ganemulla','ගණේමුල්ල','11020'),(497,7,'Giriulla','ගිරිවුල්ල','60140'),(498,7,'Gonawala','ගෝනවල','11630'),(499,7,'Halpe','හල්පෙ','70145'),(500,7,'Hapugastenna',NULL,'70164'),(501,7,'Heiyanthuduwa',NULL,'11618'),(502,7,'Hinatiyana Madawala',NULL,'11568'),(503,7,'Hiswella',NULL,'11734'),(504,7,'Horampella',NULL,'11564'),(505,7,'Hunumulla',NULL,'11262'),(506,7,'Hunupola',NULL,'60582'),(507,7,'Ihala Madampella',NULL,'11265'),(508,7,'Imbulgoda',NULL,'11856'),(509,7,'Ja-Ela',NULL,'11350'),(510,7,'Kadawatha',NULL,'11850'),(511,7,'Kahatowita',NULL,'11144'),(512,7,'Kalagedihena',NULL,'11875'),(513,7,'Kaleliya',NULL,'11160'),(514,7,'Kandana',NULL,'11320'),(515,7,'Katana',NULL,'11534'),(516,7,'Katudeniya',NULL,'21016'),(517,7,'Katunayake',NULL,'11450'),(518,7,'Katunayake Air Force Camp',NULL,'11440'),(519,7,'Katunayake(FTZ)',NULL,'11420'),(520,7,'Katuwellegama',NULL,'11526'),(521,7,'Kelaniya',NULL,'11600'),(522,7,'Kimbulapitiya',NULL,'11522'),(523,7,'Kirindiwela',NULL,'11730'),(524,7,'Kitalawalana',NULL,'11206'),(525,7,'Kochchikade',NULL,'11540'),(526,7,'Kotadeniyawa',NULL,'11232'),(527,7,'Kotugoda',NULL,'11390'),(528,7,'Kumbaloluwa',NULL,'11105'),(529,7,'Loluwagoda',NULL,'11204'),(530,7,'Mabodale',NULL,'11114'),(531,7,'Madelgamuwa',NULL,'11033'),(532,7,'Makewita',NULL,'11358'),(533,7,'Makola',NULL,'11640'),(534,7,'Malwana',NULL,'11670'),(535,7,'Mandawala',NULL,'11061'),(536,7,'Marandagahamula',NULL,'11260'),(537,7,'Mellawagedara',NULL,'11234'),(538,7,'Minuwangoda',NULL,'11550'),(539,7,'Mirigama',NULL,'11200'),(540,7,'Miriswatta',NULL,'80508'),(541,7,'Mithirigala',NULL,'11742'),(542,7,'Muddaragama',NULL,'11112'),(543,7,'Mudungoda',NULL,'11056'),(544,7,'Mulleriyawa New Town',NULL,'10620'),(545,7,'Naranwala',NULL,'11063'),(546,7,'Nawana',NULL,'11222'),(547,7,'Nedungamuwa',NULL,'11066'),(548,7,'Negombo',NULL,'11500'),(549,7,'Nikadalupotha',NULL,'60580'),(550,7,'Nikahetikanda',NULL,'11128'),(551,7,'Nittambuwa',NULL,'11880'),(552,7,'Niwandama',NULL,'11354'),(553,7,'Opatha',NULL,'80142'),(554,7,'Pamunugama',NULL,'11370'),(555,7,'Pamunuwatta',NULL,'11214'),(556,7,'Panawala',NULL,'70612'),(557,7,'Pasyala',NULL,'11890'),(558,7,'Peliyagoda',NULL,'11830'),(559,7,'Pepiliyawala',NULL,'11741'),(560,7,'Pethiyagoda',NULL,'11043'),(561,7,'Polpithimukulana',NULL,'11324'),(562,7,'Puwakpitiya',NULL,'10712'),(563,7,'Radawadunna',NULL,'11892'),(564,7,'Radawana',NULL,'11725'),(565,7,'Raddolugama',NULL,'11400'),(566,7,'Ragama',NULL,'11010'),(567,7,'Ruggahawila',NULL,'11142'),(568,7,'Seeduwa',NULL,'11410'),(569,7,'Siyambalape',NULL,'11607'),(570,7,'Talahena',NULL,'11504'),(571,7,'Thambagalla',NULL,'60584'),(572,7,'Thimbirigaskatuwa',NULL,'11532'),(573,7,'Tittapattara',NULL,'10664'),(574,7,'Udathuthiripitiya',NULL,'11054'),(575,7,'Udugampola',NULL,'11030'),(576,7,'Uggalboda',NULL,'11034'),(577,7,'Urapola',NULL,'11126'),(578,7,'Uswetakeiyawa',NULL,'11328'),(579,7,'Veyangoda',NULL,'11100'),(580,7,'Walgammulla',NULL,'11146'),(581,7,'Walpita',NULL,'11226'),(582,7,'Walpola (WP)',NULL,'11012'),(583,7,'Wathurugama',NULL,'11724'),(584,7,'Watinapaha',NULL,'11104'),(585,7,'Wattala',NULL,'11104'),(586,7,'Weboda',NULL,'11858'),(587,7,'Wegowwa',NULL,'11562'),(588,7,'Weweldeniya',NULL,'11894'),(589,7,'Yakkala',NULL,'11870'),(590,7,'Yatiyana',NULL,'11566'),(591,8,'Ambalantota','අම්බලන්තොට','82100'),(592,8,'Angunakolapelessa','අඟුණකොළපැලැස්ස','82220'),(593,8,'Angunakolawewa','අඟුණකොලවැව','91302'),(594,8,'Bandagiriya Colony','බන්ඩගිරිය කොලොනි','82005'),(595,8,'Barawakumbuka','බරවකුඹුර','82110'),(596,8,'Beliatta','බෙලිඅත්ත','82400'),(597,8,'Beragama','බෙරගම','82102'),(598,8,'Beralihela','බෙරලිහෙල','82618'),(599,8,'Bundala','බූන්දල','82002'),(600,8,'Ellagala','ඇල්ලගල','82619'),(601,8,'Gangulandeniya','ගඟුලදෙණිය','82586'),(602,8,'Getamanna','ගැටමාන්න','82420'),(603,8,'Goda Koggalla','ගොඩ කොග්ගල්ල','82401'),(604,8,'Gonagamuwa Uduwila','ගොනාගමුව උඩුවිල','82602'),(605,8,'Gonnoruwa','ගොන්නොරුව','82006'),(606,8,'Hakuruwela','හකුරුවෙල','82248'),(607,8,'Hambantota','හම්බන්තොට','82000'),(608,8,'Handugala','හඳගුල','81326'),(609,8,'Hungama',NULL,'82120'),(610,8,'Ihala Beligalla',NULL,'82412'),(611,8,'Ittademaliya',NULL,'82462'),(612,8,'Julampitiya',NULL,'82252'),(613,8,'Kahandamodara',NULL,'82126'),(614,8,'Kariyamaditta',NULL,'82274'),(615,8,'Katuwana',NULL,'82500'),(616,8,'Kawantissapura',NULL,'82622'),(617,8,'Kirama',NULL,'82550'),(618,8,'Kirinda',NULL,'82614'),(619,8,'Lunama',NULL,'82108'),(620,8,'Lunugamwehera',NULL,'82634'),(621,8,'Magama',NULL,'82608'),(622,8,'Mahagalwewa',NULL,'82016'),(623,8,'Mamadala',NULL,'82109'),(624,8,'Medamulana',NULL,'82254'),(625,8,'Middeniya',NULL,'82270'),(626,8,'Migahajandur',NULL,'82014'),(627,8,'Modarawana',NULL,'82416'),(628,8,'Mulkirigala',NULL,'82242'),(629,8,'Nakulugamuwa',NULL,'82300'),(630,8,'Netolpitiya',NULL,'82135'),(631,8,'Nihiluwa',NULL,'82414'),(632,8,'Padawkema',NULL,'82636'),(633,8,'Pahala Andarawewa',NULL,'82008'),(634,8,'Rammalawarapitiya',NULL,'82554'),(635,8,'Ranakeliya',NULL,'82612'),(636,8,'Ranmuduwewa',NULL,'82018'),(637,8,'Ranna',NULL,'82125'),(638,8,'Ratmalwala',NULL,'82276'),(639,8,'RU/Ridiyagama',NULL,'82106'),(640,8,'Sooriyawewa Town',NULL,'82010'),(641,8,'Tangalla',NULL,'82200'),(642,8,'Tissamaharama',NULL,'82600'),(643,8,'Uda Gomadiya',NULL,'82504'),(644,8,'Udamattala',NULL,'82638'),(645,8,'Uswewa',NULL,'82278'),(646,8,'Vitharandeniya',NULL,'82232'),(647,8,'Walasmulla',NULL,'82450'),(648,8,'Weeraketiya',NULL,'82240'),(649,8,'Weerawila',NULL,'82632'),(650,8,'Weerawila NewTown',NULL,'82615'),(651,8,'Wekandawela',NULL,'82246'),(652,8,'Weligatta',NULL,'82004'),(653,8,'Yatigala',NULL,'82418'),(654,9,'Jaffna',NULL,'40000'),(655,10,'Agalawatta','අගලවත්ත','12200'),(656,10,'Alubomulla','අලුබෝමුල්ල','12524'),(657,10,'Anguruwatota','අංගුරුවතොට','12320'),(658,10,'Atale','අටලේ','71363'),(659,10,'Baduraliya','බදුරලීය','12230'),(660,10,'Bandaragama','බණ්ඩාරගම','12530'),(661,10,'Batugampola','බටුගම්පොල','10526'),(662,10,'Bellana','බෙල්ලන','12224'),(663,10,'Beruwala','බේරුවල','12070'),(664,10,'Bolossagama','බොලොස්සගම','12008'),(665,10,'Bombuwala','බොඹුවල','12024'),(666,10,'Boralugoda','බොරළුගොඩ','12142'),(667,10,'Bulathsinhala','බුලත්සිංහල','12300'),(668,10,'Danawala Thiniyawala','දනවල තිනියවල','12148'),(669,10,'Delmella','දෙල්මෙල්ල','12304'),(670,10,'Dharga Town','දර්ගා නගරය','12090'),(671,10,'Diwalakada','දිවාලකද','12308'),(672,10,'Dodangoda','දොඩන්ගොඩ','12020'),(673,10,'Dombagoda','දොඹගොඩ','12416'),(674,10,'Ethkandura','ඇත්කඳුර','80458'),(675,10,'Galpatha','ගල්පාත','12005'),(676,10,'Gamagoda','ගමගොඩ','12016'),(677,10,'Gonagalpura','ගොනාගල්පුර','80502'),(678,10,'Gonapola Junction','ගෝනපොල හංදිය','12410'),(679,10,'Govinna','ගෝවින්න','12310'),(680,10,'Gurulubadda','ගුරුලුබැද්ද','12236'),(681,10,'Halkandawila','හල්කන්දවිල','12055'),(682,10,'Haltota','හල්තොට','12538'),(683,10,'Halvitigala Colony','හල්විටගල ජනපදය','80146'),(684,10,'Halwala','හල්වල','12118'),(685,10,'Halwatura','හල්වතුර','12306'),(686,10,'Handapangoda','හඳපාන්ගොඩ','10524'),(687,10,'Hedigalla Colony',NULL,'12234'),(688,10,'Henegama',NULL,'11715'),(689,10,'Hettimulla',NULL,'71210'),(690,10,'Horana',NULL,'12400'),(691,10,'Ittapana',NULL,'12116'),(692,10,'Kahawala',NULL,'10508'),(693,10,'Kalawila Kiranthidiya',NULL,'12078'),(694,10,'Kalutara',NULL,'12000'),(695,10,'Kananwila',NULL,'12418'),(696,10,'Kandanagama',NULL,'12428'),(697,10,'Kelinkanda',NULL,'12218'),(698,10,'Kitulgoda',NULL,'12222'),(699,10,'Koholana',NULL,'12007'),(700,10,'Kuda Uduwa',NULL,'12426'),(701,10,'Labbala',NULL,'60162'),(702,10,'lhalahewessa',NULL,'80432'),(703,10,'lnduruwa',NULL,'80510'),(704,10,'lngiriya',NULL,'12440'),(705,10,'Maggona',NULL,'12060'),(706,10,'Mahagama',NULL,'12210'),(707,10,'Mahakalupahana',NULL,'12126'),(708,10,'Maharangalla',NULL,'71211'),(709,10,'Malgalla Talangalla',NULL,'80144'),(710,10,'Matugama',NULL,'12100'),(711,10,'Meegahatenna',NULL,'12130'),(712,10,'Meegama',NULL,'12094'),(713,10,'Meegoda',NULL,'10504'),(714,10,'Millaniya',NULL,'12412'),(715,10,'Millewa',NULL,'12422'),(716,10,'Miwanapalana',NULL,'12424'),(717,10,'Molkawa',NULL,'12216'),(718,10,'Morapitiya',NULL,'12232'),(719,10,'Morontuduwa',NULL,'12564'),(720,10,'Nawattuduwa',NULL,'12106'),(721,10,'Neboda',NULL,'12030'),(722,10,'Padagoda',NULL,'12074'),(723,10,'Pahalahewessa',NULL,'12144'),(724,10,'Paiyagala',NULL,'12050'),(725,10,'Panadura',NULL,'12500'),(726,10,'Pannala',NULL,'60160'),(727,10,'Paragastota',NULL,'12414'),(728,10,'Paragoda',NULL,'12302'),(729,10,'Paraigama',NULL,'12122'),(730,10,'Pelanda',NULL,'12214'),(731,10,'Pelawatta',NULL,'12138'),(732,10,'Pimbura',NULL,'70472'),(733,10,'Pitagaldeniya',NULL,'71360'),(734,10,'Pokunuwita',NULL,'12404'),(735,10,'Poruwedanda',NULL,'12432'),(736,10,'Ratmale',NULL,'81030'),(737,10,'Remunagoda',NULL,'12009'),(738,10,'Talgaswela',NULL,'80470'),(739,10,'Tebuwana',NULL,'12025'),(740,10,'Uduwara',NULL,'12322'),(741,10,'Utumgama',NULL,'12127'),(742,10,'Veyangalla',NULL,'12204'),(743,10,'Wadduwa',NULL,'12560'),(744,10,'Walagedara',NULL,'12112'),(745,10,'Walallawita',NULL,'12134'),(746,10,'Waskaduwa',NULL,'12580'),(747,10,'Welipenna',NULL,'12108'),(748,10,'Weliveriya',NULL,'11710'),(749,10,'Welmilla Junction',NULL,'12534'),(750,10,'Weragala',NULL,'71622'),(751,10,'Yagirala',NULL,'12124'),(752,10,'Yatadolawatta',NULL,'12104'),(753,10,'Yatawara Junction',NULL,'12006'),(754,11,'Aludeniya','අලුදෙණිය','20062'),(755,11,'Ambagahapelessa','අඹගහපැලැස්ස','20986'),(756,11,'Ambagamuwa Udabulathgama','අඹගමුව උඩබුලත්ගම','20678'),(757,11,'Ambatenna','අඹතැන්න','20136'),(758,11,'Ampitiya','අම්පිටිය','20160'),(759,11,'Ankumbura','අංකුඹුර','20150'),(760,11,'Atabage','අටබාගෙ','20574'),(761,11,'Balana','බලන','20308'),(762,11,'Bambaragahaela','බඹරගහඇල','20644'),(763,11,'Batagolladeniya','බටගොල්ලදෙණිය','20154'),(764,11,'Batugoda','බටුගොඩ','20132'),(765,11,'Batumulla','බටුමුල්ල','20966'),(766,11,'Bawlana','බව්ලන','20218'),(767,11,'Bopana','බෝපන','20932'),(768,11,'Danture','දංතුරේ','20465'),(769,11,'Dedunupitiya','දේදුනුපිටිය','20068'),(770,11,'Dekinda','දෙකිඳ','20658'),(771,11,'Deltota','දෙල්තොට','20430'),(772,11,'Divulankadawala','දිවුලන්කදවල','51428'),(773,11,'Dolapihilla','දොලපිහිල්ල','20126'),(774,11,'Dolosbage','දොලොස්බාගෙ','20510'),(775,11,'Dunuwila','දුනුවිල','20824'),(776,11,'Etulgama','ඇතුල්ගම','20202'),(777,11,'Galaboda','ගලබොඩ','20664'),(778,11,'Galagedara','ගලගෙදර','20100'),(779,11,'Galaha','ගලහ','20420'),(780,11,'Galhinna','ගල්හින්න','20152'),(781,11,'Gampola','ගම්පොල','20500'),(782,11,'Gelioya','ගෙලිඔය','20620'),(783,11,'Godamunna','ගොඩමුන්න','20214'),(784,11,'Gomagoda','ගොමගොඩ','20184'),(785,11,'Gonagantenna','ගොනාගන්තැන්න','20712'),(786,11,'Gonawalapatana','ගෝනවලපතන','20656'),(787,11,'Gunnepana','ගුන්නෙපන','20270'),(788,11,'Gurudeniya','ගුරුදෙණිය','20189'),(789,11,'Hakmana','හක්මන','81300'),(790,11,'Handaganawa','හඳගනාව','20984'),(791,11,'Handawalapitiya','හඳවලපිටිය','20438'),(792,11,'Handessa','හඳැස්ස','20480'),(793,11,'Hanguranketha',NULL,'20710'),(794,11,'Harangalagama',NULL,'20669'),(795,11,'Hataraliyadda',NULL,'20060'),(796,11,'Hindagala',NULL,'20414'),(797,11,'Hondiyadeniya',NULL,'20524'),(798,11,'Hunnasgiriya',NULL,'20948'),(799,11,'Inguruwatta',NULL,'60064'),(800,11,'Jambugahapitiya',NULL,'20822'),(801,11,'Kadugannawa',NULL,'20300'),(802,11,'Kahataliyadda',NULL,'20924'),(803,11,'Kalugala',NULL,'20926'),(804,11,'Kandy',NULL,'20000'),(805,11,'Kapuliyadde',NULL,'20206'),(806,11,'Katugastota',NULL,'20800'),(807,11,'Katukitula',NULL,'20588'),(808,11,'Kelanigama',NULL,'20688'),(809,11,'Kengalla',NULL,'20186'),(810,11,'Ketaboola',NULL,'20660'),(811,11,'Ketakumbura',NULL,'20306'),(812,11,'Kobonila',NULL,'20928'),(813,11,'Kolabissa',NULL,'20212'),(814,11,'Kolongoda',NULL,'20971'),(815,11,'Kulugammana',NULL,'20048'),(816,11,'Kumbukkandura',NULL,'20902'),(817,11,'Kumburegama',NULL,'20086'),(818,11,'Kundasale',NULL,'20168'),(819,11,'Leemagahakotuwa',NULL,'20482'),(820,11,'lhala Kobbekaduwa',NULL,'20042'),(821,11,'Lunugama',NULL,'11062'),(822,11,'Lunuketiya Maditta',NULL,'20172'),(823,11,'Madawala Bazaar',NULL,'20260'),(824,11,'Madawalalanda',NULL,'32016'),(825,11,'Madugalla',NULL,'20938'),(826,11,'Madulkele',NULL,'20840'),(827,11,'Mahadoraliyadda',NULL,'20945'),(828,11,'Mahamedagama',NULL,'20216'),(829,11,'Mahanagapura',NULL,'32018'),(830,11,'Mailapitiya',NULL,'20702'),(831,11,'Makkanigama',NULL,'20828'),(832,11,'Makuldeniya',NULL,'20921'),(833,11,'Mangalagama',NULL,'32069'),(834,11,'Mapakanda',NULL,'20662'),(835,11,'Marassana',NULL,'20210'),(836,11,'Marymount Colony',NULL,'20714'),(837,11,'Mawatura',NULL,'20564'),(838,11,'Medamahanuwara',NULL,'20940'),(839,11,'Medawala Harispattuwa',NULL,'20120'),(840,11,'Meetalawa',NULL,'20512'),(841,11,'Megoda Kalugamuwa',NULL,'20409'),(842,11,'Menikdiwela',NULL,'20470'),(843,11,'Menikhinna',NULL,'20170'),(844,11,'Mimure',NULL,'20923'),(845,11,'Minigamuwa',NULL,'20109'),(846,11,'Minipe',NULL,'20983'),(847,11,'Moragahapallama',NULL,'32012'),(848,11,'Murutalawa',NULL,'20232'),(849,11,'Muruthagahamulla',NULL,'20526'),(850,11,'Nanuoya',NULL,'22150'),(851,11,'Naranpanawa',NULL,'20176'),(852,11,'Narawelpita',NULL,'81302'),(853,11,'Nawalapitiya',NULL,'20650'),(854,11,'Nawathispane',NULL,'20670'),(855,11,'Nillambe',NULL,'20418'),(856,11,'Nugaliyadda',NULL,'20204'),(857,11,'Ovilikanda',NULL,'21020'),(858,11,'Pallekotuwa',NULL,'20084'),(859,11,'Panwilatenna',NULL,'20544'),(860,11,'Paradeka',NULL,'20578'),(861,11,'Pasbage',NULL,'20654'),(862,11,'Pattitalawa',NULL,'20511'),(863,11,'Peradeniya',NULL,'20400'),(864,11,'Pilimatalawa',NULL,'20450'),(865,11,'Poholiyadda',NULL,'20106'),(866,11,'Pubbiliya',NULL,'21502'),(867,11,'Pupuressa',NULL,'20546'),(868,11,'Pussellawa',NULL,'20580'),(869,11,'Putuhapuwa',NULL,'20906'),(870,11,'Rajawella',NULL,'20180'),(871,11,'Rambukpitiya',NULL,'20676'),(872,11,'Rambukwella',NULL,'20128'),(873,11,'Rangala',NULL,'20922'),(874,11,'Rantembe',NULL,'20990'),(875,11,'Sangarajapura',NULL,'20044'),(876,11,'Senarathwela',NULL,'20904'),(877,11,'Talatuoya',NULL,'20200'),(878,11,'Teldeniya',NULL,'20900'),(879,11,'Tennekumbura',NULL,'20166'),(880,11,'Uda Peradeniya',NULL,'20404'),(881,11,'Udahentenna',NULL,'20506'),(882,11,'Udatalawinna',NULL,'20802'),(883,11,'Udispattuwa',NULL,'20916'),(884,11,'Ududumbara',NULL,'20950'),(885,11,'Uduwahinna',NULL,'20934'),(886,11,'Uduwela',NULL,'20164'),(887,11,'Ulapane',NULL,'20562'),(888,11,'Unuwinna',NULL,'20708'),(889,11,'Velamboda',NULL,'20640'),(890,11,'Watagoda',NULL,'22110'),(891,11,'Watagoda Harispattuwa',NULL,'20134'),(892,11,'Wattappola',NULL,'20454'),(893,11,'Weligampola',NULL,'20666'),(894,11,'Wendaruwa',NULL,'20914'),(895,11,'Weragantota',NULL,'20982'),(896,11,'Werapitya',NULL,'20908'),(897,11,'Werellagama',NULL,'20080'),(898,11,'Wettawa',NULL,'20108'),(899,11,'Yahalatenna',NULL,'20234'),(900,11,'Yatihalagala',NULL,'20034'),(901,12,'Alawala','අලවල','11122'),(902,12,'Alawatura','අලවතුර','71204'),(903,12,'Alawwa','අලව්ව','60280'),(904,12,'Algama','අල්ගම','71607'),(905,12,'Alutnuwara','අළුත්නුවර','71508'),(906,12,'Ambalakanda','අම්බලකන්ද','71546'),(907,12,'Ambulugala','අම්බුළුගල','71503'),(908,12,'Amitirigala','අමිතිරිගල','71320'),(909,12,'Ampagala','අම්පාගල','71232'),(910,12,'Anhandiya','අංහන්දිය','60074'),(911,12,'Anhettigama','අංහෙට්ටිගම','71403'),(912,12,'Aranayaka','අරනායක','71540'),(913,12,'Aruggammana','අරුග්ගම්මන','71041'),(914,12,'Batuwita','බටුවිට','71321'),(915,12,'Beligala(Sab)','බෙලිගල','71044'),(916,12,'Belihuloya','බෙලිහුල්ඔය','70140'),(917,12,'Berannawa','බෙරන්නව','71706'),(918,12,'Bopitiya','බෝපිටිය','60155'),(919,12,'Bopitiya (SAB)','බෝපිටිය (සබර)','71612'),(920,12,'Boralankada','බොරලන්කද','71418'),(921,12,'Bossella','බොස්සැල්ල','71208'),(922,12,'Bulathkohupitiya','බුලත්කොහුපිටිය','71230'),(923,12,'Damunupola','දමුනුපොල','71034'),(924,12,'Debathgama','දෙබත්ගම','71037'),(925,12,'Dedugala','දේදුගල','71237'),(926,12,'Deewala Pallegama','දීවල පල්ලෙගම','71022'),(927,12,'Dehiowita','දෙහිඕවිට','71400'),(928,12,'Deldeniya','දෙල්දෙණිය','71009'),(929,12,'Deloluwa','දෙලෝලුව','71401'),(930,12,'Deraniyagala','දැරණියගල','71430'),(931,12,'Dewalegama','දේවාලේගම','71050'),(932,12,'Dewanagala','දෙවනගල','71527'),(933,12,'Dombemada','දොඹේමද','71115'),(934,12,'Dorawaka','දොරවක','71601'),(935,12,'Dunumala','දුනුමල','71605'),(936,12,'Galapitamada','ගලපිටමඩ','71603'),(937,12,'Galatara','ගලතර','71505'),(938,12,'Galigamuwa Town','ගලිගමුව නගරය','71350'),(939,12,'Gallella','ගල්ලෑල්ල','70062'),(940,12,'Galpatha(Sab)','ගල්පාත (සබරගමුව)','71312'),(941,12,'Gantuna','ගන්තුන','71222'),(942,12,'Getahetta','ගැටහැත්ත','70620'),(943,12,'Godagampola','ගොඩගම්පොල','70556'),(944,12,'Gonagala','ගෝනාගල','71318'),(945,12,'Hakahinna','හකහින්න','71352'),(946,12,'Hakbellawaka','හක්බෙල්ලවක','71715'),(947,12,'Halloluwa','හල්ලෝලුව','20032'),(948,12,'Hedunuwewa',NULL,'22024'),(949,12,'Hemmatagama',NULL,'71530'),(950,12,'Hewadiwela',NULL,'71108'),(951,12,'Hingula',NULL,'71520'),(952,12,'Hinguralakanda',NULL,'71417'),(953,12,'Hingurana',NULL,'32010'),(954,12,'Hiriwadunna',NULL,'71014'),(955,12,'Ihala Walpola',NULL,'80134'),(956,12,'Ihalagama',NULL,'70144'),(957,12,'Imbulana',NULL,'71313'),(958,12,'Imbulgasdeniya',NULL,'71055'),(959,12,'Kabagamuwa',NULL,'71202'),(960,12,'Kahapathwala',NULL,'60062'),(961,12,'Kandaketya',NULL,'90020'),(962,12,'Kannattota',NULL,'71372'),(963,12,'Karagahinna',NULL,'21014'),(964,12,'Kegalle',NULL,'71000'),(965,12,'Kehelpannala',NULL,'71533'),(966,12,'Ketawala Leula',NULL,'20198'),(967,12,'Kitulgala',NULL,'71720'),(968,12,'Kondeniya',NULL,'71501'),(969,12,'Kotiyakumbura',NULL,'71370'),(970,12,'Lewangama',NULL,'71315'),(971,12,'Mahabage',NULL,'71722'),(972,12,'Makehelwala',NULL,'71507'),(973,12,'Malalpola',NULL,'71704'),(974,12,'Maldeniya',NULL,'22021'),(975,12,'Maliboda',NULL,'71411'),(976,12,'Maliyadda',NULL,'90022'),(977,12,'Malmaduwa',NULL,'71325'),(978,12,'Marapana',NULL,'70041'),(979,12,'Mawanella',NULL,'71500'),(980,12,'Meetanwala',NULL,'60066'),(981,12,'Migastenna Sabara',NULL,'71716'),(982,12,'Miyanawita',NULL,'71432'),(983,12,'Molagoda',NULL,'71016'),(984,12,'Morontota',NULL,'71220'),(985,12,'Narangala',NULL,'90064'),(986,12,'Narangoda',NULL,'60152'),(987,12,'Nattarampotha',NULL,'20194'),(988,12,'Nelundeniya',NULL,'71060'),(989,12,'Niyadurupola',NULL,'71602'),(990,12,'Noori',NULL,'71407'),(991,12,'Pannila',NULL,'12114'),(992,12,'Pattampitiya',NULL,'71130'),(993,12,'Pilawala',NULL,'20196'),(994,12,'Pothukoladeniya',NULL,'71039'),(995,12,'Puswelitenna',NULL,'60072'),(996,12,'Rambukkana',NULL,'71100'),(997,12,'Rilpola',NULL,'90026'),(998,12,'Rukmale',NULL,'11129'),(999,12,'Ruwanwella',NULL,'71300'),(1000,12,'Samanalawewa',NULL,'70142'),(1001,12,'Seaforth Colony',NULL,'71708'),(1002,5,'Colombo 2','කොළඹ 2','200'),(1003,12,'Spring Valley',NULL,'90028'),(1004,12,'Talgaspitiya',NULL,'71541'),(1005,12,'Teligama',NULL,'71724'),(1006,12,'Tholangamuwa',NULL,'71619'),(1007,12,'Thotawella',NULL,'71106'),(1008,12,'Udaha Hawupe',NULL,'70154'),(1009,12,'Udapotha',NULL,'71236'),(1010,12,'Uduwa',NULL,'20052'),(1011,12,'Undugoda',NULL,'71200'),(1012,12,'Ussapitiya',NULL,'71510'),(1013,12,'Wahakula',NULL,'71303'),(1014,12,'Waharaka',NULL,'71304'),(1015,12,'Wanaluwewa',NULL,'11068'),(1016,12,'Warakapola',NULL,'71600'),(1017,12,'Watura',NULL,'71035'),(1018,12,'Weeoya',NULL,'71702'),(1019,12,'Wegalla',NULL,'71234'),(1020,12,'Weligalla',NULL,'20610'),(1021,12,'Welihelatenna',NULL,'71712'),(1022,12,'Wewelwatta',NULL,'70066'),(1023,12,'Yatagama',NULL,'71116'),(1024,12,'Yatapana',NULL,'71326'),(1025,12,'Yatiyantota',NULL,'71700'),(1026,12,'Yattogoda',NULL,'71029'),(1027,13,'Kandavalai',NULL,''),(1028,13,'Karachchi',NULL,''),(1029,13,'Kilinochchi',NULL,''),(1030,13,'Pachchilaipalli',NULL,''),(1031,13,'Poonakary',NULL,''),(1032,14,'Akurana','අකුරණ','20850'),(1033,14,'Alahengama','අලහෙන්ගම','60416'),(1034,14,'Alahitiyawa','අලහිටියාව','60182'),(1035,14,'Ambakote','අඹකොටේ','60036'),(1036,14,'Ambanpola','අඹන්පොල','60650'),(1037,14,'Andiyagala','ආඬියාගල','50112'),(1038,14,'Anukkane','අනුක්කනේ','60214'),(1039,14,'Aragoda','අරංගොඩ','60308'),(1040,14,'Ataragalla','අටරගල්ල','60706'),(1041,14,'Awulegama','අවුලේගම','60462'),(1042,14,'Balalla','බලල්ල','60604'),(1043,14,'Bamunukotuwa','බමුණකොටුව','60347'),(1044,14,'Bandara Koswatta','බන්ඩාර කොස්වත්ත','60424'),(1045,14,'Bingiriya','බින්ගිරිය','60450'),(1046,14,'Bogamulla','බෝගමුල්ල','60107'),(1047,14,'Boraluwewa','බොරළුවැව','60437'),(1048,14,'Boyagane','බෝයගානෙ','60027'),(1049,14,'Bujjomuwa','බුජ්ජෝමුව','60291'),(1050,14,'Buluwala','බුලුවල','60076'),(1051,14,'Dadayamtalawa','දඩයම්තලාව','32046'),(1052,14,'Dambadeniya','දඹදෙණිය','60130'),(1053,14,'Daraluwa','දරලුව','60174'),(1054,14,'Deegalla','දීගල්ල','60228'),(1055,14,'Demataluwa','දෙමටලුව','60024'),(1056,14,'Demuwatha','දෙමුවත','70332'),(1057,14,'Diddeniya','දෙණියාය','60544'),(1058,14,'Digannewa','දිගන්නෑව','60485'),(1059,14,'Divullegoda','දිවුලේගොඩ','60472'),(1060,14,'Diyasenpura','දියසෙන්පුර','51504'),(1061,14,'Dodangaslanda','දොඩන්ගස්ලන්ද','60530'),(1062,14,'Doluwa','දොළුව','20532'),(1063,14,'Doragamuwa','දොරගමුව','20816'),(1064,14,'Doratiyawa','දොරටියාව','60013'),(1065,14,'Dunumadalawa','දුනුමඩවල','50214'),(1066,14,'Dunuwilapitiya','දුනුවිලපිටිය','21538'),(1067,14,'Ehetuwewa','ඇහැටුවැව','60716'),(1068,14,'Elibichchiya','ඇලිබිච්චිය','60156'),(1069,14,'Embogama',NULL,'60718'),(1070,14,'Etungahakotuwa','ඇතුන්ගහකොටුව','60266'),(1071,14,'Galadivulwewa','ගලදිවුල්වැව','50210'),(1072,14,'Galgamuwa','ගල්ගමුව','60700'),(1073,14,'Gallellagama','ගල්ලෑල්ලගම','20095'),(1074,14,'Gallewa',NULL,'60712'),(1075,14,'Ganegoda','ගණේගොඩ','80440'),(1076,14,'Girathalana','ගිරාතලන','60752'),(1077,14,'Gokaralla','ගොකරුල්ල','60522'),(1078,14,'Gonawila','ගොනාවිල','60170'),(1079,14,'Halmillawewa','හල්මිල්ලවැව','60441'),(1080,14,'Handungamuwa',NULL,'21536'),(1081,14,'Harankahawa',NULL,'20092'),(1082,14,'Helamada',NULL,'71046'),(1083,14,'Hengamuwa',NULL,'60414'),(1084,14,'Hettipola',NULL,'60430'),(1085,14,'Hewainna',NULL,'10714'),(1086,14,'Hilogama',NULL,'60486'),(1087,14,'Hindagolla',NULL,'60034'),(1088,14,'Hiriyala Lenawa',NULL,'60546'),(1089,14,'Hiruwalpola',NULL,'60458'),(1090,14,'Horambawa',NULL,'60181'),(1091,14,'Hulogedara',NULL,'60474'),(1092,14,'Hulugalla',NULL,'60477'),(1093,14,'Ihala Gomugomuwa',NULL,'60211'),(1094,14,'Ihala Katugampala',NULL,'60135'),(1095,14,'Indulgodakanda',NULL,'60016'),(1096,14,'Ithanawatta',NULL,'60025'),(1097,14,'Kadigawa',NULL,'60492'),(1098,14,'Kalankuttiya',NULL,'50174'),(1099,14,'Kalatuwawa',NULL,'10718'),(1100,14,'Kalugamuwa',NULL,'60096'),(1101,14,'Kanadeniyawala',NULL,'60054'),(1102,14,'Kanattewewa',NULL,'60422'),(1103,14,'Kandegedara',NULL,'90070'),(1104,14,'Karagahagedara',NULL,'60106'),(1105,14,'Karambe',NULL,'60602'),(1106,14,'Katiyawa',NULL,'50261'),(1107,14,'Katupota',NULL,'60350'),(1108,14,'Kawudulla',NULL,'51414'),(1109,14,'Kawuduluwewa Stagell',NULL,'51514'),(1110,14,'Kekunagolla',NULL,'60183'),(1111,14,'Keppitiwalana',NULL,'60288'),(1112,14,'Kimbulwanaoya',NULL,'60548'),(1113,14,'Kirimetiyawa',NULL,'60184'),(1114,14,'Kirindawa',NULL,'60212'),(1115,14,'Kirindigalla',NULL,'60502'),(1116,14,'Kithalawa',NULL,'60188'),(1117,14,'Kitulwala',NULL,'11242'),(1118,14,'Kobeigane',NULL,'60410'),(1119,14,'Kohilagedara',NULL,'60028'),(1120,14,'Konwewa',NULL,'60630'),(1121,14,'Kosdeniya',NULL,'60356'),(1122,14,'Kosgolla',NULL,'60029'),(1123,14,'Kotagala',NULL,'22080'),(1124,5,'Colombo 13','කොළඹ 13','01300'),(1125,14,'Kotawehera',NULL,'60483'),(1126,14,'Kudagalgamuwa',NULL,'60003'),(1127,14,'Kudakatnoruwa',NULL,'60754'),(1128,14,'Kuliyapitiya',NULL,'60200'),(1129,14,'Kumaragama',NULL,'51412'),(1130,14,'Kumbukgeta',NULL,'60508'),(1131,14,'Kumbukwewa',NULL,'60506'),(1132,14,'Kuratihena',NULL,'60438'),(1133,14,'Kurunegala',NULL,'60000'),(1134,14,'lbbagamuwa',NULL,'60500'),(1135,14,'lhala Kadigamuwa',NULL,'60238'),(1136,14,'Lihiriyagama',NULL,'61138'),(1137,14,'lllagolla',NULL,'20724'),(1138,14,'llukhena',NULL,'60232'),(1139,14,'Lonahettiya',NULL,'60108'),(1140,14,'Madahapola',NULL,'60552'),(1141,14,'Madakumburumulla',NULL,'60209'),(1142,14,'Madalagama',NULL,'70158'),(1143,14,'Madawala Ulpotha',NULL,'21074'),(1144,14,'Maduragoda',NULL,'60532'),(1145,14,'Maeliya',NULL,'60512'),(1146,14,'Magulagama',NULL,'60221'),(1147,14,'Maha Ambagaswewa',NULL,'51518'),(1148,14,'Mahagalkadawala',NULL,'60731'),(1149,14,'Mahagirilla',NULL,'60479'),(1150,14,'Mahamukalanyaya',NULL,'60516'),(1151,14,'Mahananneriya',NULL,'60724'),(1152,14,'Mahapallegama',NULL,'71063'),(1153,14,'Maharachchimulla',NULL,'60286'),(1154,14,'Mahatalakolawewa',NULL,'51506'),(1155,14,'Mahawewa',NULL,'61220'),(1156,14,'Maho',NULL,'60600'),(1157,14,'Makulewa',NULL,'60714'),(1158,14,'Makulpotha',NULL,'60514'),(1159,14,'Makulwewa',NULL,'60578'),(1160,14,'Malagane',NULL,'60404'),(1161,14,'Mandapola',NULL,'60434'),(1162,14,'Maspotha',NULL,'60344'),(1163,14,'Mawathagama',NULL,'60060'),(1164,14,'Medirigiriya',NULL,'51500'),(1165,14,'Medivawa',NULL,'60612'),(1166,14,'Meegalawa',NULL,'60750'),(1167,14,'Meegaswewa',NULL,'51508'),(1168,14,'Meewellawa',NULL,'60484'),(1169,14,'Melsiripura',NULL,'60540'),(1170,14,'Metikumbura',NULL,'60304'),(1171,14,'Metiyagane',NULL,'60121'),(1172,14,'Minhettiya',NULL,'60004'),(1173,14,'Minuwangete',NULL,'60406'),(1174,14,'Mirihanagama',NULL,'60408'),(1175,14,'Monnekulama',NULL,'60495'),(1176,14,'Moragane',NULL,'60354'),(1177,14,'Moragollagama',NULL,'60640'),(1178,14,'Morathiha',NULL,'60038'),(1179,14,'Munamaldeniya',NULL,'60218'),(1180,14,'Muruthenge',NULL,'60122'),(1181,14,'Mutugala',NULL,'51064'),(1182,14,'Nabadewa',NULL,'60482'),(1183,14,'Nagollagama',NULL,'60590'),(1184,14,'Nagollagoda',NULL,'60226'),(1185,14,'Nakkawatta',NULL,'60186'),(1186,14,'Narammala',NULL,'60100'),(1187,14,'Nawasenapura',NULL,'51066'),(1188,14,'Nawatalwatta',NULL,'60292'),(1189,14,'Nelliya',NULL,'60549'),(1190,14,'Nikaweratiya',NULL,'60470'),(1191,14,'Nugagolla',NULL,'21534'),(1192,14,'Nugawela',NULL,'20072'),(1193,14,'Padeniya',NULL,'60461'),(1194,14,'Padiwela',NULL,'60236'),(1195,14,'Pahalagiribawa',NULL,'60735'),(1196,14,'Pahamune',NULL,'60112'),(1197,14,'Palagala',NULL,'50111'),(1198,14,'Palapathwela',NULL,'21070'),(1199,14,'Palaviya',NULL,'61280'),(1200,14,'Pallewela',NULL,'11150'),(1201,14,'Palukadawala',NULL,'60704'),(1202,14,'Panadaragama',NULL,'60348'),(1203,14,'Panagamuwa',NULL,'60052'),(1204,14,'Panaliya',NULL,'60312'),(1205,14,'Panapitiya',NULL,'70152'),(1206,14,'Panliyadda',NULL,'60558'),(1207,14,'Pansiyagama',NULL,'60554'),(1208,14,'Parape',NULL,'71105'),(1209,14,'Pathanewatta',NULL,'90071'),(1210,14,'Pattiya Watta',NULL,'20118'),(1211,14,'Perakanatta',NULL,'21532'),(1212,14,'Periyakadneluwa',NULL,'60518'),(1213,14,'Pihimbiya Ratmale',NULL,'60439'),(1214,14,'Pihimbuwa',NULL,'60053'),(1215,14,'Pilessa',NULL,'60058'),(1216,14,'Polgahawela',NULL,'60300'),(1217,14,'Polgolla',NULL,'20250'),(1218,14,'Polpitigama',NULL,'60620'),(1219,14,'Pothuhera',NULL,'60330'),(1220,14,'Pothupitiya',NULL,'70338'),(1221,14,'Pujapitiya',NULL,'20112'),(1222,14,'Rakwana',NULL,'70300'),(1223,14,'Ranorawa',NULL,'50212'),(1224,14,'Rathukohodigala',NULL,'20818'),(1225,14,'Ridibendiella',NULL,'60606'),(1226,14,'Ridigama',NULL,'60040'),(1227,14,'Saliya Asokapura',NULL,'60736'),(1228,14,'Sandalankawa',NULL,'60176'),(1229,14,'Sevanapitiya',NULL,'51062'),(1230,14,'Sirambiadiya',NULL,'61312'),(1231,14,'Sirisetagama',NULL,'60478'),(1232,14,'Siyambalangamuwa',NULL,'60646'),(1233,14,'Siyambalawewa',NULL,'32048'),(1234,14,'Solepura',NULL,'60737'),(1235,14,'Solewewa',NULL,'60738'),(1236,14,'Sunandapura',NULL,'60436'),(1237,14,'Talawattegedara',NULL,'60306'),(1238,14,'Tambutta',NULL,'60734'),(1239,14,'Tennepanguwa',NULL,'90072'),(1240,14,'Thalahitimulla',NULL,'60208'),(1241,14,'Thalakolawewa',NULL,'60624'),(1242,14,'Thalwita',NULL,'60572'),(1243,14,'Tharana Udawela',NULL,'60227'),(1244,14,'Thimbiriyawa',NULL,'60476'),(1245,14,'Tisogama',NULL,'60453'),(1246,14,'Torayaya',NULL,'60499'),(1247,14,'Tulhiriya',NULL,'71610'),(1248,14,'Tuntota',NULL,'71062'),(1249,14,'Tuttiripitigama',NULL,'60426'),(1250,14,'Udagaldeniya',NULL,'71113'),(1251,14,'Udahingulwala',NULL,'20094'),(1252,14,'Udawatta',NULL,'20722'),(1253,14,'Udubaddawa',NULL,'60250'),(1254,14,'Udumulla',NULL,'71521'),(1255,14,'Uhumiya',NULL,'60094'),(1256,14,'Ulpotha Pallekele',NULL,'60622'),(1257,14,'Ulpothagama',NULL,'20965'),(1258,14,'Usgala Siyabmalangamuwa',NULL,'60732'),(1259,14,'Vijithapura',NULL,'50110'),(1260,14,'Wadakada',NULL,'60318'),(1261,14,'Wadumunnegedara',NULL,'60204'),(1262,14,'Walakumburumulla',NULL,'60198'),(1263,14,'Wannigama',NULL,'60465'),(1264,14,'Wannikudawewa',NULL,'60721'),(1265,14,'Wannilhalagama',NULL,'60722'),(1266,14,'Wannirasnayakapura',NULL,'60490'),(1267,14,'Warawewa',NULL,'60739'),(1268,14,'Wariyapola',NULL,'60400'),(1269,14,'Watareka',NULL,'10511'),(1270,14,'Wattegama',NULL,'20810'),(1271,14,'Watuwatta',NULL,'60262'),(1272,14,'Weerapokuna',NULL,'60454'),(1273,14,'Welawa Juncton',NULL,'60464'),(1274,14,'Welipennagahamulla',NULL,'60240'),(1275,14,'Wellagala',NULL,'60402'),(1276,14,'Wellarawa',NULL,'60456'),(1277,14,'Wellawa',NULL,'60570'),(1278,14,'Welpalla',NULL,'60206'),(1279,14,'Wennoruwa',NULL,'60284'),(1280,14,'Weuda',NULL,'60080'),(1281,14,'Wewagama',NULL,'60195'),(1282,14,'Wilgamuwa',NULL,'21530'),(1283,14,'Yakwila',NULL,'60202'),(1284,14,'Yatigaloluwa',NULL,'60314'),(1285,15,'Mannar',NULL,'41000'),(1286,15,'Puthukudiyiruppu',NULL,'30158'),(1287,16,'Akuramboda','අකුරම්බොඩ','21142'),(1288,16,'Alawatuwala','අලවතුවල','60047'),(1289,16,'Alwatta','අල්වත්ත','21004'),(1290,16,'Ambana','අම්බාන','21504'),(1291,16,'Aralaganwila','අරලගන්විල','51100'),(1292,16,'Ataragallewa','අටරගල්ලෑව','21512'),(1293,16,'Bambaragaswewa','බඹරගස්වැව','21212'),(1294,16,'Barawardhana Oya','බරවර්ධන ඔය','20967'),(1295,16,'Beligamuwa','බෙලිගමුව','21214'),(1296,16,'Damana','දමන','32014'),(1297,16,'Dambulla','දඹුල්ල','21100'),(1298,16,'Damminna','දම්මින්න','51106'),(1299,16,'Dankanda','දංකන්ද','21032'),(1300,16,'Delwite','දෙල්විටේ','60044'),(1301,16,'Devagiriya','දේවගිරිය','21552'),(1302,16,'Dewahuwa','දේවහුව','21206'),(1303,16,'Divuldamana','දිවුල්දමන','51104'),(1304,16,'Dullewa','දුල්වල','21054'),(1305,16,'Dunkolawatta','දුන්කොලවත්ත','21046'),(1306,16,'Elkaduwa','ඇල්කඩුව','21012'),(1307,16,'Erawula Junction','එරවුල හන්දිය','21108'),(1308,16,'Etanawala','එතනවල','21402'),(1309,16,'Galewela','ගලේවෙල','21200'),(1310,16,'Galoya Junction','ගල්ඔය හන්දිය','51375'),(1311,16,'Gammaduwa','ගම්මඩුව','21068'),(1312,16,'Gangala Puwakpitiya','ගන්ගල පුවක්පිටිය','21404'),(1313,16,'Hasalaka',NULL,'20960'),(1314,16,'Hattota Amuna',NULL,'21514'),(1315,16,'Imbulgolla',NULL,'21064'),(1316,16,'Inamaluwa',NULL,'21124'),(1317,16,'Iriyagolla',NULL,'60045'),(1318,16,'Kaikawala',NULL,'21066'),(1319,16,'Kalundawa',NULL,'21112'),(1320,16,'Kandalama',NULL,'21106'),(1321,16,'Kavudupelella',NULL,'21072'),(1322,16,'Kibissa',NULL,'21122'),(1323,16,'Kiwula',NULL,'21042'),(1324,16,'Kongahawela',NULL,'21500'),(1325,16,'Laggala Pallegama',NULL,'21520'),(1326,16,'Leliambe',NULL,'21008'),(1327,16,'Lenadora',NULL,'21094'),(1328,16,'lhala Halmillewa',NULL,'50262'),(1329,16,'lllukkumbura',NULL,'21406'),(1330,16,'Madipola',NULL,'21156'),(1331,16,'Maduruoya',NULL,'51108'),(1332,16,'Mahawela',NULL,'21140'),(1333,16,'Mananwatta',NULL,'21144'),(1334,16,'Maraka',NULL,'21554'),(1335,16,'Matale',NULL,'21000'),(1336,16,'Melipitiya',NULL,'21055'),(1337,16,'Metihakka',NULL,'21062'),(1338,16,'Millawana',NULL,'21154'),(1339,16,'Muwandeniya',NULL,'21044'),(1340,16,'Nalanda',NULL,'21082'),(1341,16,'Naula',NULL,'21090'),(1342,16,'Opalgala',NULL,'21076'),(1343,16,'Pallepola',NULL,'21152'),(1344,16,'Pimburattewa',NULL,'51102'),(1345,16,'Pulastigama',NULL,'51050'),(1346,16,'Ranamuregama',NULL,'21524'),(1347,16,'Rattota',NULL,'21400'),(1348,16,'Selagama',NULL,'21058'),(1349,16,'Sigiriya',NULL,'21120'),(1350,16,'Sinhagama',NULL,'51378'),(1351,16,'Sungavila',NULL,'51052'),(1352,16,'Talagoda Junction',NULL,'21506'),(1353,16,'Talakiriyagama',NULL,'21116'),(1354,16,'Tamankaduwa',NULL,'51089'),(1355,16,'Udasgiriya',NULL,'21051'),(1356,16,'Udatenna',NULL,'21006'),(1357,16,'Ukuwela',NULL,'21300'),(1358,16,'Wahacotte',NULL,'21160'),(1359,16,'Walawela',NULL,'21048'),(1360,16,'Wehigala',NULL,'21009'),(1361,16,'Welangahawatte',NULL,'21408'),(1362,16,'Wewalawewa',NULL,'21114'),(1363,16,'Yatawatta',NULL,'21056'),(1364,17,'Akuressa','අකුරැස්ස','81400'),(1365,17,'Alapaladeniya','අලපලදෙණිය','81475'),(1366,17,'Aparekka','අපරැක්ක','81032'),(1367,17,'Athuraliya','අතුරලීය','81402'),(1368,17,'Bengamuwa','බෙන්ගමුව','81614'),(1369,17,'Bopagoda','බෝපගොඩ','81412'),(1370,17,'Dampahala','දම්පහල','81612'),(1371,17,'Deegala Lenama','දීගල ලෙනම','81452'),(1372,17,'Deiyandara','දෙයියන්දර','81320'),(1373,17,'Denagama','දෙනගම','81314'),(1374,17,'Denipitiya','දෙණිපිටිය','81730'),(1375,17,'Deniyaya','දෙණියාය','81500'),(1376,17,'Derangala','දෙරණගල','81454'),(1377,17,'Devinuwara (Dondra)','දෙවිනුවර (දෙවුන්දර)','81160'),(1378,17,'Dikwella','දික්වැල්ල','81200'),(1379,17,'Diyagaha','දියගහ','81038'),(1380,17,'Diyalape','දියලපේ','81422'),(1381,17,'Gandara','ගන්දර','81170'),(1382,17,'Godapitiya','ගොඩපිටිය','81408'),(1383,17,'Gomilamawarala','ගොමිලමවරල','81072'),(1384,17,'Hawpe',NULL,'80132'),(1385,17,'Horapawita',NULL,'81108'),(1386,17,'Kalubowitiyana',NULL,'81478'),(1387,17,'Kamburugamuwa',NULL,'81750'),(1388,17,'Kamburupitiya',NULL,'81100'),(1389,17,'Karagoda Uyangoda',NULL,'81082'),(1390,17,'Karaputugala',NULL,'81106'),(1391,17,'Karatota',NULL,'81318'),(1392,17,'Kekanadurra',NULL,'81020'),(1393,17,'Kiriweldola',NULL,'81514'),(1394,17,'Kiriwelkele',NULL,'81456'),(1395,17,'Kolawenigama',NULL,'81522'),(1396,17,'Kotapola',NULL,'81480'),(1397,17,'Lankagama',NULL,'81526'),(1398,17,'Makandura',NULL,'81070'),(1399,17,'Maliduwa',NULL,'81424'),(1400,17,'Maramba',NULL,'81416'),(1401,17,'Matara',NULL,'81000'),(1402,17,'Mediripitiya',NULL,'81524'),(1403,17,'Miella',NULL,'81312'),(1404,17,'Mirissa',NULL,'81740'),(1405,17,'Morawaka',NULL,'81470'),(1406,17,'Mulatiyana Junction',NULL,'81071'),(1407,17,'Nadugala',NULL,'81092'),(1408,17,'Naimana',NULL,'81017'),(1409,17,'Palatuwa',NULL,'81050'),(1410,17,'Parapamulla',NULL,'81322'),(1411,17,'Pasgoda',NULL,'81615'),(1412,17,'Penetiyana',NULL,'81722'),(1413,17,'Pitabeddara',NULL,'81450'),(1414,17,'Puhulwella',NULL,'81290'),(1415,17,'Radawela',NULL,'81316'),(1416,17,'Ransegoda',NULL,'81064'),(1417,17,'Rotumba',NULL,'81074'),(1418,17,'Sultanagoda',NULL,'81051'),(1419,17,'Telijjawila',NULL,'81060'),(1420,17,'Thihagoda',NULL,'81280'),(1421,17,'Urubokka',NULL,'81600'),(1422,17,'Urugamuwa',NULL,'81230'),(1423,17,'Urumutta',NULL,'81414'),(1424,17,'Viharahena',NULL,'81508'),(1425,17,'Walakanda',NULL,'81294'),(1426,17,'Walasgala',NULL,'81220'),(1427,17,'Waralla',NULL,'81479'),(1428,17,'Weligama',NULL,'81700'),(1429,17,'Wilpita',NULL,'81404'),(1430,17,'Yatiyana',NULL,'81034'),(1431,18,'Ayiwela',NULL,'91516'),(1432,18,'Badalkumbura','බඩල්කුඹුර','91070'),(1433,18,'Baduluwela','බදුලුවෙල','91058'),(1434,18,'Bakinigahawela','බකිණිගහවෙල','91554'),(1435,18,'Balaharuwa','බලහරුව','91295'),(1436,18,'Bibile','බිබිලේ','91500'),(1437,18,'Buddama','බුද්ධගම','91038'),(1438,18,'Buttala','බුත්තල','91100'),(1439,18,'Dambagalla','දඹගල්ල','91050'),(1440,18,'Diyakobala','දියකොබල','91514'),(1441,18,'Dombagahawela','දොඹගහවෙල','91010'),(1442,18,'Ethimalewewa','ඇතිමලේවැව','91020'),(1443,18,'Ettiliwewa','ඇත්තිලිවැව','91250'),(1444,18,'Galabedda','ගලබැද්ද','91008'),(1445,18,'Gamewela','ගමේවැල','90512'),(1446,18,'Hambegamuwa','හම්බෙගමුව','91308'),(1447,18,'Hingurukaduwa',NULL,'90508'),(1448,18,'Hulandawa',NULL,'91004'),(1449,18,'Inginiyagala',NULL,'91040'),(1450,18,'Kandaudapanguwa',NULL,'91032'),(1451,18,'Kandawinna',NULL,'91552'),(1452,18,'Kataragama',NULL,'91400'),(1453,18,'Kotagama',NULL,'91512'),(1454,18,'Kotamuduna',NULL,'90506'),(1455,18,'Kotawehera Mankada',NULL,'91312'),(1456,18,'Kudawewa',NULL,'61226'),(1457,18,'Kumbukkana',NULL,'91098'),(1458,18,'Marawa',NULL,'91006'),(1459,18,'Mariarawa',NULL,'91052'),(1460,18,'Medagana',NULL,'91550'),(1461,18,'Medawelagama',NULL,'90518'),(1462,18,'Miyanakandura',NULL,'90584'),(1463,18,'Monaragala',NULL,'91000'),(1464,18,'Moretuwegama',NULL,'91108'),(1465,18,'Nakkala',NULL,'91003'),(1466,18,'Namunukula',NULL,'90580'),(1467,18,'Nannapurawa',NULL,'91519'),(1468,18,'Nelliyadda',NULL,'91042'),(1469,18,'Nilgala',NULL,'91508'),(1470,18,'Obbegoda',NULL,'91007'),(1471,18,'Okkampitiya',NULL,'91060'),(1472,18,'Pangura',NULL,'91002'),(1473,18,'Pitakumbura',NULL,'91505'),(1474,18,'Randeniya',NULL,'91204'),(1475,18,'Ruwalwela',NULL,'91056'),(1476,18,'Sella Kataragama',NULL,'91405'),(1477,18,'Siyambalagune',NULL,'91202'),(1478,18,'Siyambalanduwa',NULL,'91030'),(1479,18,'Suriara',NULL,'91306'),(1480,18,'Tanamalwila',NULL,'91300'),(1481,18,'Uva Gangodagama',NULL,'91054'),(1482,18,'Uva Kudaoya',NULL,'91298'),(1483,18,'Uva Pelwatta',NULL,'91112'),(1484,18,'Warunagama',NULL,'91198'),(1485,18,'Wedikumbura',NULL,'91005'),(1486,18,'Weherayaya Handapanagala',NULL,'91206'),(1487,18,'Wellawaya',NULL,'91200'),(1488,18,'Wilaoya',NULL,'91022'),(1489,18,'Yudaganawa',NULL,'51424'),(1490,19,'Mullativu',NULL,'42000'),(1491,20,'Agarapathana','ආගරපතන','22094'),(1492,20,'Ambatalawa','අඹතලාව','20686'),(1493,20,'Ambewela','අඹේවෙල','22216'),(1494,20,'Bogawantalawa','බොගවන්තලාව','22060'),(1495,20,'Bopattalawa','බෝපත්තලාව','22095'),(1496,20,'Dagampitiya','දාගම්පිටිය','20684'),(1497,20,'Dayagama Bazaar','දයගම බසාර්','22096'),(1498,20,'Dikoya','දික්ඔය','22050'),(1499,20,'Doragala','දොරගල','20567'),(1500,20,'Dunukedeniya','දුනුකෙදෙණිය','22002'),(1501,20,'Egodawela','එගොඩවෙල','90013'),(1502,20,'Ekiriya','ඇකිරිය','20732'),(1503,20,'Elamulla','ඇලමුල්ල','20742'),(1504,20,'Ginigathena','ගිනිගතැන','20680'),(1505,20,'Gonakele','ගොනාකැලේ','22226'),(1506,20,'Haggala','හග්ගල','22208'),(1507,20,'Halgranoya','හාල්ගරනඔය','22240'),(1508,20,'Hangarapitiya',NULL,'22044'),(1509,20,'Hapugastalawa',NULL,'20668'),(1510,20,'Harasbedda',NULL,'22262'),(1511,20,'Hatton',NULL,'22000'),(1512,20,'Hewaheta',NULL,'20440'),(1513,20,'Hitigegama',NULL,'22046'),(1514,20,'Jangulla',NULL,'90063'),(1515,20,'Kalaganwatta',NULL,'22282'),(1516,20,'Kandapola',NULL,'22220'),(1517,20,'Karandagolla',NULL,'20738'),(1518,20,'Keerthi Bandarapura',NULL,'22274'),(1519,20,'Kiribathkumbura',NULL,'20442'),(1520,20,'Kotiyagala',NULL,'91024'),(1521,20,'Kotmale',NULL,'20560'),(1522,20,'Kottellena',NULL,'22040'),(1523,20,'Kumbalgamuwa',NULL,'22272'),(1524,20,'Kumbukwela',NULL,'22246'),(1525,20,'Kurupanawela',NULL,'22252'),(1526,20,'Labukele',NULL,'20592'),(1527,20,'Laxapana',NULL,'22034'),(1528,20,'Lindula',NULL,'22090'),(1529,20,'Madulla',NULL,'22256'),(1530,20,'Mandaram Nuwara',NULL,'20744'),(1531,20,'Maskeliya',NULL,'22070'),(1532,20,'Maswela',NULL,'20566'),(1533,20,'Maturata',NULL,'20748'),(1534,20,'Mipanawa',NULL,'22254'),(1535,20,'Mipilimana',NULL,'22214'),(1536,20,'Morahenagama',NULL,'22036'),(1537,20,'Munwatta',NULL,'20752'),(1538,20,'Nayapana Janapadaya',NULL,'20568'),(1539,20,'Nildandahinna',NULL,'22280'),(1540,20,'Nissanka Uyana',NULL,'22075'),(1541,20,'Norwood',NULL,'22058'),(1542,20,'Nuwara Eliya',NULL,'22200'),(1543,20,'Padiyapelella',NULL,'20750'),(1544,20,'Pallebowala',NULL,'20734'),(1545,20,'Panvila',NULL,'20830'),(1546,20,'Pitawala',NULL,'20682'),(1547,20,'Pundaluoya',NULL,'22120'),(1548,20,'Ramboda',NULL,'20590'),(1549,20,'Rikillagaskada',NULL,'20730'),(1550,20,'Rozella',NULL,'22008'),(1551,20,'Rupaha',NULL,'22245'),(1552,20,'Ruwaneliya',NULL,'22212'),(1553,20,'Santhipura',NULL,'22202'),(1554,20,'Talawakele',NULL,'22100'),(1555,20,'Tawalantenna',NULL,'20838'),(1556,20,'Teripeha',NULL,'22287'),(1557,20,'Udamadura',NULL,'22285'),(1558,20,'Udapussallawa',NULL,'22250'),(1559,20,'Uva Deegalla',NULL,'90062'),(1560,20,'Uva Uduwara',NULL,'90061'),(1561,20,'Uvaparanagama',NULL,'90230'),(1562,20,'Walapane',NULL,'22270'),(1563,20,'Watawala',NULL,'22010'),(1564,20,'Widulipura',NULL,'22032'),(1565,20,'Wijebahukanda',NULL,'22018'),(1566,21,'Attanakadawala','අත්තනගඩවල','51235'),(1567,21,'Bakamuna','බකමූණ','51250'),(1568,21,'Diyabeduma','දියබෙදුම','51225'),(1569,21,'Elahera','ඇලහැර','51258'),(1570,21,'Giritale','ගිරිතලේ','51026'),(1571,21,'Hingurakdamana',NULL,'51408'),(1572,21,'Hingurakgoda',NULL,'51400'),(1573,21,'Jayanthipura',NULL,'51024'),(1574,21,'Kalingaela',NULL,'51002'),(1575,21,'Lakshauyana',NULL,'51006'),(1576,21,'Mankemi',NULL,'30442'),(1577,21,'Minneriya',NULL,'51410'),(1578,21,'Onegama',NULL,'51004'),(1579,21,'Orubendi Siyambalawa',NULL,'51256'),(1580,21,'Palugasdamana',NULL,'51046'),(1581,21,'Panichankemi',NULL,'30444'),(1582,21,'Polonnaruwa',NULL,'51000'),(1583,21,'Talpotha',NULL,'51044'),(1584,21,'Tambala',NULL,'51049'),(1585,21,'Unagalavehera',NULL,'51008'),(1586,21,'Wijayabapura',NULL,'51042'),(1587,22,'Adippala',NULL,'61012'),(1588,22,'Alutgama','අළුත්ගම','12080'),(1589,22,'Alutwewa','අළුත්වැව','51014'),(1590,22,'Ambakandawila','අඹකඳවිල','61024'),(1591,22,'Anamaduwa','ආනමඩුව','61500'),(1592,22,'Andigama','අඬිගම','61508'),(1593,22,'Angunawila','අඟුණවිල','61264'),(1594,22,'Attawilluwa','අත්තවිල්ලුව','61328'),(1595,22,'Bangadeniya','බංගදෙණිය','61238'),(1596,22,'Baranankattuwa','බරණන්කට්ටුව','61262'),(1597,22,'Battuluoya','බත්තුලුඔය','61246'),(1598,22,'Bujjampola','බුජ්ජම්පොල','61136'),(1599,22,'Chilaw','හලාවත','61000'),(1600,22,'Dalukana','දලුකන','51092'),(1601,22,'Dankotuwa','දංකොටුව','61130'),(1602,22,'Dewagala','දේවගල','51094'),(1603,22,'Dummalasuriya','දුම්මලසූරිය','60260'),(1604,22,'Dunkannawa','දුන්කන්නාව','61192'),(1605,22,'Eluwankulama','එළුවන්කුලම','61308'),(1606,22,'Ettale','ඇත්තලේ','61343'),(1607,22,'Galamuna','ගලමුන','51416'),(1608,22,'Galmuruwa','ගල්මුරුව','61233'),(1609,22,'Hansayapalama',NULL,'51098'),(1610,22,'Ihala Kottaramulla',NULL,'61154'),(1611,22,'Ilippadeniya',NULL,'61018'),(1612,22,'Inginimitiya',NULL,'61514'),(1613,22,'Ismailpuram',NULL,'61302'),(1614,22,'Jayasiripura',NULL,'51246'),(1615,22,'Kakkapalliya',NULL,'61236'),(1616,22,'Kalkudah',NULL,'30410'),(1617,22,'Kalladiya',NULL,'61534'),(1618,22,'Kandakuliya',NULL,'61358'),(1619,22,'Karathivu',NULL,'61307'),(1620,22,'Karawitagara',NULL,'61022'),(1621,22,'Karuwalagaswewa',NULL,'61314'),(1622,22,'Katuneriya',NULL,'61180'),(1623,22,'Koswatta',NULL,'61158'),(1624,22,'Kottantivu',NULL,'61252'),(1625,22,'Kottapitiya',NULL,'51244'),(1626,22,'Kottukachchiya',NULL,'61532'),(1627,22,'Kumarakattuwa',NULL,'61032'),(1628,22,'Kurinjanpitiya',NULL,'61356'),(1629,22,'Kuruketiyawa',NULL,'61516'),(1630,22,'Lunuwila',NULL,'61150'),(1631,22,'Madampe',NULL,'61230'),(1632,22,'Madurankuliya',NULL,'61270'),(1633,22,'Mahakumbukkadawala',NULL,'61272'),(1634,22,'Mahauswewa',NULL,'61512'),(1635,22,'Mampitiya',NULL,'51090'),(1636,22,'Mampuri',NULL,'61341'),(1637,22,'Mangalaeliya',NULL,'61266'),(1638,22,'Marawila',NULL,'61210'),(1639,22,'Mudalakkuliya',NULL,'61506'),(1640,22,'Mugunuwatawana',NULL,'61014'),(1641,22,'Mukkutoduwawa',NULL,'61274'),(1642,22,'Mundel',NULL,'61250'),(1643,22,'Muttibendiwila',NULL,'61195'),(1644,22,'Nainamadama',NULL,'61120'),(1645,22,'Nalladarankattuwa',NULL,'61244'),(1646,22,'Nattandiya',NULL,'61190'),(1647,22,'Nawagattegama',NULL,'61520'),(1648,22,'Nelumwewa',NULL,'51096'),(1649,22,'Norachcholai',NULL,'61342'),(1650,22,'Pallama',NULL,'61040'),(1651,22,'Palliwasalturai',NULL,'61354'),(1652,22,'Panirendawa',NULL,'61234'),(1653,22,'Parakramasamudraya',NULL,'51016'),(1654,22,'Pothuwatawana',NULL,'61162'),(1655,22,'Puttalam',NULL,'61300'),(1656,22,'Puttalam Cement Factory',NULL,'61326'),(1657,22,'Rajakadaluwa',NULL,'61242'),(1658,22,'Saliyawewa Junction',NULL,'61324'),(1659,22,'Serukele',NULL,'61042'),(1660,22,'Siyambalagashene',NULL,'61504'),(1661,22,'Tabbowa',NULL,'61322'),(1662,22,'Talawila Church',NULL,'61344'),(1663,22,'Toduwawa',NULL,'61224'),(1664,22,'Udappuwa',NULL,'61004'),(1665,22,'Uridyawa',NULL,'61502'),(1666,22,'Vanathawilluwa',NULL,'61306'),(1667,22,'Waikkal',NULL,'61110'),(1668,22,'Watugahamulla',NULL,'61198'),(1669,22,'Wennappuwa',NULL,'61170'),(1670,22,'Wijeyakatupotha',NULL,'61006'),(1671,22,'Wilpotha',NULL,'61008'),(1672,22,'Yodaela',NULL,'51422'),(1673,22,'Yogiyana',NULL,'61144'),(1674,23,'Akarella','අකරැල්ල','70082'),(1675,23,'Amunumulla','අමුනුමුල්ල','90204'),(1676,23,'Atakalanpanna','අටකලන්පන්න','70294'),(1677,23,'Ayagama','අයගම','70024'),(1678,23,'Balangoda','බලන්ගොඩ','70100'),(1679,23,'Batatota','බටතොට','70504'),(1680,23,'Beralapanathara','බෙරලපනතර','81541'),(1681,23,'Bogahakumbura','බෝගහකුඹුර','90354'),(1682,23,'Bolthumbe','බොල්තුඹෙ','70131'),(1683,23,'Bomluwageaina',NULL,'70344'),(1684,23,'Bowalagama','බෝවලගම','82458'),(1685,23,'Bulutota','බුලුතොට','70346'),(1686,23,'Dambuluwana','දඹුලුවාන','70019'),(1687,23,'Daugala','දවුගල','70455'),(1688,23,'Dela','දෙල','70042'),(1689,23,'Delwala','දෙල්වල','70046'),(1690,23,'Dodampe','දොඩම්පෙ','70017'),(1691,23,'Doloswalakanda','දොලොස්වලකන්ද','70404'),(1692,23,'Dumbara Manana','දුම්බර මනන','70495'),(1693,23,'Eheliyagoda','ඇහැළියගොඩ','70600'),(1694,23,'Ekamutugama','එකමුතුගම','70254'),(1695,23,'Elapatha','ඇලපාත','70032'),(1696,23,'Ellagawa','ඇල්ලගාව','70492'),(1697,23,'Ellaulla','','70552'),(1698,23,'Ellawala','ඇල්ලවල','70606'),(1699,23,'Embilipitiya','ඇඹිලිපිටිය','70200'),(1700,23,'Eratna','එරත්න','70506'),(1701,23,'Erepola','එරෙපොල','70602'),(1702,23,'Gabbela','ගබ්බෙල','70156'),(1703,23,'Gangeyaya','ගන්ගෙයාය','70195'),(1704,23,'Gawaragiriya','ගවරගිරිය','70026'),(1705,23,'Gillimale','ගිලීමලේ','70002'),(1706,23,'Godakawela','ගොඩකවැල','70160'),(1707,23,'Gurubewilagama','ගුරුබෙවිලගම','70136'),(1708,23,'Halwinna','හල්වින්න','70171'),(1709,23,'Handagiriya','හඳගිරිය','70106'),(1710,23,'Hatangala',NULL,'70105'),(1711,23,'Hatarabage',NULL,'70108'),(1712,23,'Hewanakumbura',NULL,'90358'),(1713,23,'Hidellana',NULL,'70012'),(1714,23,'Hiramadagama',NULL,'70296'),(1715,23,'Horewelagoda',NULL,'82456'),(1716,23,'Ittakanda',NULL,'70342'),(1717,23,'Kahangama',NULL,'70016'),(1718,23,'Kahawatta',NULL,'70150'),(1719,23,'Kalawana',NULL,'70450'),(1720,23,'Kaltota',NULL,'70122'),(1721,23,'Kalubululanda',NULL,'90352'),(1722,23,'Kananke Bazaar',NULL,'80136'),(1723,23,'Kandepuhulpola',NULL,'90356'),(1724,23,'Karandana',NULL,'70488'),(1725,23,'Karangoda',NULL,'70018'),(1726,23,'Kella Junction',NULL,'70352'),(1727,23,'Keppetipola',NULL,'90350'),(1728,23,'Kiriella',NULL,'70480'),(1729,23,'Kiriibbanwewa',NULL,'70252'),(1730,23,'Kolambageara',NULL,'70180'),(1731,23,'Kolombugama',NULL,'70403'),(1732,23,'Kolonna',NULL,'70350'),(1733,23,'Kudawa',NULL,'70005'),(1734,23,'Kuruwita',NULL,'70500'),(1735,23,'Lellopitiya',NULL,'70056'),(1736,23,'lmaduwa',NULL,'80130'),(1737,23,'lmbulpe',NULL,'70134'),(1738,23,'Mahagama Colony',NULL,'70256'),(1739,23,'Mahawalatenna',NULL,'70112'),(1740,23,'Makandura Sabara',NULL,'70298'),(1741,23,'Malwala Junction',NULL,'70001'),(1742,23,'Malwatta',NULL,'32198'),(1743,23,'Matuwagalagama',NULL,'70482'),(1744,23,'Medagalatur',NULL,'70021'),(1745,23,'Meddekanda',NULL,'70127'),(1746,23,'Minipura Dumbara',NULL,'70494'),(1747,23,'Mitipola',NULL,'70604'),(1748,23,'Moragala Kirillapone',NULL,'81532'),(1749,23,'Morahela',NULL,'70129'),(1750,23,'Mulendiyawala',NULL,'70212'),(1751,23,'Mulgama',NULL,'70117'),(1752,23,'Nawalakanda',NULL,'70469'),(1753,23,'NawinnaPinnakanda',NULL,'70165'),(1754,23,'Niralagama',NULL,'70038'),(1755,23,'Nivitigala',NULL,'70400'),(1756,23,'Omalpe',NULL,'70215'),(1757,23,'Opanayaka',NULL,'70080'),(1758,23,'Padalangala',NULL,'70230'),(1759,23,'Pallebedda',NULL,'70170'),(1760,23,'Pallekanda',NULL,'82454'),(1761,23,'Pambagolla',NULL,'70133'),(1762,23,'Panamura',NULL,'70218'),(1763,23,'Panapola',NULL,'70461'),(1764,23,'Paragala',NULL,'81474'),(1765,23,'Parakaduwa',NULL,'70550'),(1766,23,'Pebotuwa',NULL,'70045'),(1767,23,'Pelmadulla',NULL,'70070'),(1768,23,'Pinnawala',NULL,'70130'),(1769,23,'Pothdeniya',NULL,'81538'),(1770,23,'Rajawaka',NULL,'70116'),(1771,23,'Ranwala',NULL,'70162'),(1772,23,'Rassagala',NULL,'70135'),(1773,23,'Ratgama',NULL,'80260'),(1774,23,'Ratna Hangamuwa',NULL,'70036'),(1775,23,'Ratnapura',NULL,'70000'),(1776,23,'Sewanagala',NULL,'70250'),(1777,23,'Sri Palabaddala',NULL,'70004'),(1778,23,'Sudagala',NULL,'70502'),(1779,23,'Talakolahinna',NULL,'70101'),(1780,23,'Tanjantenna',NULL,'70118'),(1781,23,'Teppanawa',NULL,'70512'),(1782,23,'Tunkama',NULL,'70205'),(1783,23,'Udakarawita',NULL,'70044'),(1784,23,'Udaniriella',NULL,'70034'),(1785,23,'Udawalawe',NULL,'70190'),(1786,23,'Ullinduwawa',NULL,'70345'),(1787,23,'Veddagala',NULL,'70459'),(1788,23,'Vijeriya',NULL,'70348'),(1789,23,'Waleboda',NULL,'70138'),(1790,23,'Watapotha',NULL,'70408'),(1791,23,'Waturawa',NULL,'70456'),(1792,23,'Weligepola',NULL,'70104'),(1793,23,'Welipathayaya',NULL,'70124'),(1794,23,'Wikiliya',NULL,'70114'),(1795,24,'Agbopura','අග්බෝපුර','31304'),(1796,24,'Buckmigama','බක්මීගම','31028'),(1797,24,'China Bay','චීන වරාය','31050'),(1798,24,'Dehiwatte','දෙහිවත්ත','31226'),(1799,24,'Echchilampattai','එච්චිලම්පට්ටෙයි','31236'),(1800,24,'Galmetiyawa','ගල්මැටියාව','31318'),(1801,24,'Gomarankadawala','ගෝමරන්කඩවල','31026'),(1802,24,'Kaddaiparichchan',NULL,'31212'),(1803,24,'Kallar',NULL,'30250'),(1804,24,'Kanniya',NULL,'31032'),(1805,24,'Kantalai',NULL,'31300'),(1806,24,'Kantalai Sugar Factory',NULL,'31306'),(1807,24,'Kiliveddy',NULL,'31220'),(1808,24,'Kinniya',NULL,'31100'),(1809,24,'Kuchchaveli',NULL,'31014'),(1810,24,'Kumburupiddy',NULL,'31012'),(1811,24,'Kurinchakemy',NULL,'31112'),(1812,24,'Lankapatuna',NULL,'31234'),(1813,24,'Mahadivulwewa',NULL,'31036'),(1814,24,'Maharugiramam',NULL,'31106'),(1815,24,'Mallikativu',NULL,'31224'),(1816,24,'Mawadichenai',NULL,'31238'),(1817,24,'Mullipothana',NULL,'31312'),(1818,24,'Mutur',NULL,'31200'),(1819,24,'Neelapola',NULL,'31228'),(1820,24,'Nilaveli','නිලාවැලි','31010'),(1821,24,'Pankulam',NULL,'31034'),(1822,24,'Pulmoddai','පුල්මුඩේ','50567'),(1823,24,'Rottawewa',NULL,'31038'),(1824,24,'Sampaltivu',NULL,'31006'),(1825,24,'Sampoor','සාම්පූර්','31216'),(1826,24,'Serunuwara','සේනුවර','31232'),(1827,24,'Seruwila','සේරුවිල','31260'),(1828,24,'Sirajnagar',NULL,'31314'),(1829,24,'Somapura','සෝමපුර','31222'),(1830,24,'Tampalakamam',NULL,'31046'),(1831,24,'Thuraineelavanai',NULL,'30254'),(1832,24,'Tiriyayi',NULL,'31016'),(1833,24,'Toppur',NULL,'31250'),(1834,24,'Trincomalee','තිරිකුණාමලය','31000'),(1835,24,'Wanela',NULL,'31308'),(1836,25,'Vavuniya','වව්නියාව','43000'),(1837,5,'Colombo 1','කොළඹ 1','100'),(1838,5,'Colombo 3','කොළඹ 3','300'),(1839,5,'Colombo 4','කොළඹ 4','400'),(1840,5,'Colombo 5','කොළඹ 5','500'),(1841,5,'Colombo 7','කොළඹ 7','700'),(1842,5,'Colombo 9','කොළඹ 9','900'),(1843,5,'Colombo 10','කොළඹ 10','1000'),(1844,5,'Colombo 11','කොළඹ 11','1100'),(1845,5,'Colombo 12','කොළඹ 12','1200'),(1846,5,'Colombo 14','කොළඹ 14','1400');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `color` (
  `color_name` varchar(45) DEFAULT NULL,
  `color_code` varchar(45) NOT NULL,
  PRIMARY KEY (`color_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES ('Black','#000000'),('Blue','#0000ff'),('Green','#00ff00'),('Grey','#808080'),('Red','#ff0000'),('Pink','#ff00ff'),('White','#ffffff');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `condition`
--

DROP TABLE IF EXISTS `condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `condition` (
  `condition_id` int NOT NULL AUTO_INCREMENT,
  `condition_name` varchar(45) NOT NULL,
  PRIMARY KEY (`condition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condition`
--

LOCK TABLES `condition` WRITE;
/*!40000 ALTER TABLE `condition` DISABLE KEYS */;
INSERT INTO `condition` VALUES (1,'Brand NEW'),(2,'Used');
/*!40000 ALTER TABLE `condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_us` (
  `contact_us_id` int NOT NULL AUTO_INCREMENT,
  `contact_us_msg` text,
  `user_id` int NOT NULL,
  `contact_us_date` datetime DEFAULT NULL,
  PRIMARY KEY (`contact_us_id`),
  KEY `fk_contact_us_user1_idx` (`user_id`),
  CONSTRAINT `fk_contact_us_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_us`
--

LOCK TABLES `contact_us` WRITE;
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
INSERT INTO `contact_us` VALUES (1,'Please Call Me.',1,'2024-09-20 01:03:47'),(2,'Hi',1,'2024-09-20 01:08:49');
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `districts` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `province_province_id` int NOT NULL,
  `district_name_en` varchar(45) DEFAULT NULL,
  `district_name_si` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_districts_provinces1_idx` (`province_province_id`),
  CONSTRAINT `fk_districts_provinces1` FOREIGN KEY (`province_province_id`) REFERENCES `provinces` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts`
--

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` VALUES (1,6,'Ampara','අම්පාර'),(2,8,'Anuradhapura','අනුරාධපුරය'),(3,7,'Badulla','බදුල්ල'),(4,6,'Batticaloa','මඩකලපුව'),(5,1,'Colombo','කොළඹ'),(6,3,'Galle','ගාල්ල'),(7,1,'Gampaha','ගම්පහ'),(8,3,'Hambantota','හම්බන්තොට'),(9,9,'Jaffna','යාපනය'),(10,1,'Kalutara','කළුතර'),(11,2,'Kandy','මහනුවර'),(12,5,'Kegalle','කෑගල්ල'),(13,9,'Kilinochchi','කිලිනොච්චිය'),(14,4,'Kurunegala','කුරුණෑගල'),(15,9,'Mannar','මන්නාරම'),(16,2,'Matale','මාතලේ'),(17,3,'Matara','මාතර'),(18,7,'Monaragala','මොණරාගල'),(19,9,'Mullaitivu','මුලතිව්'),(20,2,'Nuwara Eliya','නුවර එළිය'),(21,8,'Polonnaruwa','පොළොන්නරුව'),(22,4,'Puttalam','පුත්තලම'),(23,5,'Ratnapura','රත්නපුර'),(24,6,'Trincomalee','ත්‍රිකුණාමලය'),(25,9,'Vavuniya','වව්නියාව');
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `feedback_star` int DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL,
  `feedback_msg` varchar(45) DEFAULT NULL,
  `feedback_user_id` int NOT NULL,
  `feedback_product_id` int NOT NULL,
  PRIMARY KEY (`feedback_id`),
  KEY `fk_feedback_user1_idx` (`feedback_user_id`),
  KEY `fk_feedback_product1_idx` (`feedback_product_id`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`feedback_product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`feedback_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,4,'2024-09-14 19:51:08','Hi',1,17),(2,4,'2024-09-14 23:16:36','Best Product',1,14),(3,3,'2024-09-19 22:24:31','Good Super',10,15),(4,3,'2024-09-19 22:27:34','Good',10,17),(5,4,'2024-09-26 21:38:35','Best WOW!',1,16),(6,0,'2025-02-10 22:56:51','',1,10);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (1,'Male'),(2,'Female');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gui`
--

DROP TABLE IF EXISTS `gui`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gui` (
  `graphic_card_id` int NOT NULL,
  `graphic_card_name` varchar(45) DEFAULT NULL,
  `brand_brand_id` int NOT NULL,
  PRIMARY KEY (`graphic_card_id`),
  KEY `fk_gui_brand1_idx` (`brand_brand_id`),
  CONSTRAINT `fk_gui_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gui`
--

LOCK TABLES `gui` WRITE;
/*!40000 ALTER TABLE `gui` DISABLE KEYS */;
INSERT INTO `gui` VALUES (1,'RTX 3050',2),(2,'Intel UHD',1),(3,'Intel Iris Xe',1),(4,'RTX 2050',2),(5,'RTX 3050 Ti',2),(6,'RTX 3060',2),(7,'RTX 4060',2),(8,'RTX 4070',2),(9,'AMD Radeon Graphics',8);
/*!40000 ALTER TABLE `gui` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `invoice_price` double DEFAULT NULL,
  `invoice_qty` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_user1_idx` (`user_id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,323056,'2024-09-13 23:34:56',26,1,1,8),(2,323056,'2024-09-13 23:34:56',570,2,1,15),(3,323056,'2024-09-13 23:34:56',199,1,1,17),(4,323056,'2024-09-13 23:34:56',69,2,1,12),(5,686665,'2024-09-13 23:40:32',26,1,1,8),(6,686665,'2024-09-13 23:40:32',570,2,1,15),(7,686665,'2024-09-13 23:40:32',199,4,1,17),(8,686665,'2024-09-13 23:40:32',69,2,1,12),(9,174109,'2024-09-13 23:46:05',295,1,1,6),(10,174109,'2024-09-13 23:46:05',295,2,1,7),(11,669372,'2024-09-14 08:44:02',295,1,1,6),(12,669372,'2024-09-14 08:44:02',69,1,1,12),(13,669372,'2024-09-14 08:44:02',967,1,1,13),(14,921016,'2024-09-14 14:20:09',70,1,1,10),(15,714092,'2024-09-14 14:24:12',70,2,1,10),(16,990159,'2024-09-19 21:56:15',295,1,1,6),(17,990159,'2024-09-19 21:56:15',570,2,1,15),(18,990159,'2024-09-19 21:56:15',967,2,1,13),(19,648910,'2024-11-10 18:04:35',295,2,1,6);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processor`
--

DROP TABLE IF EXISTS `processor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processor` (
  `processor_id` int NOT NULL,
  `processor_name` varchar(45) DEFAULT NULL,
  `brand_brand_id` int NOT NULL,
  PRIMARY KEY (`processor_id`),
  KEY `fk_processor_brand1_idx` (`brand_brand_id`),
  CONSTRAINT `fk_processor_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processor`
--

LOCK TABLES `processor` WRITE;
/*!40000 ALTER TABLE `processor` DISABLE KEYS */;
INSERT INTO `processor` VALUES (1,'Intel Core I3',1),(2,'Intel Core I5',1),(3,'Intel Core I7',1),(4,'Intel Core I9',1),(5,'Intel 14th Generation',1),(6,'AMD Ryzen 5',8);
/*!40000 ALTER TABLE `processor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `delevery_fee` double DEFAULT NULL,
  `description` text,
  `status_id` int NOT NULL,
  `category_category_id` int NOT NULL,
  `product_details_product_details_id` int DEFAULT NULL,
  `brand_brand_id` int NOT NULL,
  `registered_date` datetime DEFAULT NULL,
  `color_color_code` varchar(45) NOT NULL,
  `product_qty` int DEFAULT NULL,
  `condition_condition_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_category1_idx` (`category_category_id`),
  KEY `fk_product_product_details1_idx` (`product_details_product_details_id`),
  KEY `fk_product_brand1_idx` (`brand_brand_id`),
  KEY `fk_product_color1_idx` (`color_color_code`),
  KEY `fk_product_condition1_idx` (`condition_condition_id`),
  CONSTRAINT `fk_product_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_category_id`) REFERENCES `category` (`category_id`),
  CONSTRAINT `fk_product_color1` FOREIGN KEY (`color_color_code`) REFERENCES `color` (`color_code`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_condition_id`) REFERENCES `condition` (`condition_id`),
  CONSTRAINT `fk_product_product_details1` FOREIGN KEY (`product_details_product_details_id`) REFERENCES `product_details` (`product_details_id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (5,'Asus Creator Q530VJ',320,5,'This is Very Good Laptop',1,2,3,4,'2024-08-27 17:08:51','#000000',10,1),(6,'MSI GF63 Thin 11UC – i5',295,4,'This is Very Good Laptop',1,2,4,7,'2024-08-27 17:16:06','#000000',2,1),(7,'Asus TUF Gaming F15 FX507ZC4 – i5',295,5,'This is Good Laptop',1,2,5,4,'2024-08-27 17:22:36','#808080',5,1),(8,'SAMSUNG 980 SSD 500GB PCIe 4.0 NVMe',26,1,'Speed SSD Nvme Drive.',1,8,NULL,6,'2024-08-27 17:32:20','#000000',6,2),(10,'AMD Ryzen 7 5800X',70,4,'8 Cores, 16 Threads\r\nUp To 4.7GHz Desktop Processor',1,10,NULL,8,'2024-08-29 13:06:32','#808080',0,1),(12,'Asus Dual Geforce GTX 1650 4GB GDDR6X OC',69,4,'Good Graphic Card',1,5,NULL,4,'2024-08-29 13:11:48','#000000',0,1),(13,'Asus ROG Strix Scar16',967,1,'G634JZR Intel I9-14900HX | RTX 4070, 8GB GDDR6 | 16GB DDR5 5600MHz | 1TB M.2 NVMe SSD | 16” Inch (2560*1600) QHD 240hz Display | Windows 11 Home (2 YEARS WARRANTY)',1,2,6,4,'2024-08-29 13:17:37','#000000',4,1),(14,'Asus Prime A620M-K DDR5 Motherboard',39,3,'Good Motherboard',1,4,NULL,4,'2024-08-29 22:53:49','#000000',NULL,1),(15,'Intel Core I7-14700 Desktop',570,21,'Intel Core I7-14700| B760 MOTHERBOARD | 32GB DDR5 5600MHz | 1TB NVMe SSD |4060 8GB GDDR6 | 750 WATT 80 Plus Gold | Mid-Tower Gaming Case ARGB',1,1,7,1,'2024-08-29 22:56:20','#000000',3,2),(16,'MSI G2422C Curved Gaming Monitor',64,6,'24\' FHD 180Hz 1ms Curved Gaming Monitor',1,3,NULL,7,'2024-08-29 23:00:15','#000000',NULL,1),(17,'ASUS VIVOBOOK GO 15 E1504F',199,9,'ASUS VIVOBOOK GO 15 E1504F AMD Ryzen 5 7520U | AMD Radeon Graphics | 8GB DDR5 | 512GB NVME M.2 SSD | Windows 11 Home ',1,2,8,4,'2024-08-30 21:01:09','#808080',0,2);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_details`
--

DROP TABLE IF EXISTS `product_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_details` (
  `product_details_id` int NOT NULL AUTO_INCREMENT,
  `gui_graphic_card_id` int DEFAULT NULL,
  `processor_processor_id` int DEFAULT NULL,
  `ram_size` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`product_details_id`),
  KEY `fk_product_details_gui1_idx` (`gui_graphic_card_id`),
  KEY `fk_product_details_processor1_idx` (`processor_processor_id`),
  CONSTRAINT `fk_product_details_gui1` FOREIGN KEY (`gui_graphic_card_id`) REFERENCES `gui` (`graphic_card_id`),
  CONSTRAINT `fk_product_details_processor1` FOREIGN KEY (`processor_processor_id`) REFERENCES `processor` (`processor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_details`
--

LOCK TABLES `product_details` WRITE;
/*!40000 ALTER TABLE `product_details` DISABLE KEYS */;
INSERT INTO `product_details` VALUES (3,1,3,'5'),(4,1,2,'4'),(5,1,2,'5'),(6,8,4,'5'),(7,7,3,'6'),(8,9,6,'4');
/*!40000 ALTER TABLE `product_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_product_images_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_images_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES ('resources//product_images//Asus Creator Q530VJ01581959720.jpeg',5),('resources//product_images//Asus Creator Q530VJ1896062468.jpeg',5),('resources//product_images//Asus Creator Q530VJ2735346759.jpeg',5),('resources//product_images//MSI GF63 Thin 11UC – i501053617465.jpeg',6),('resources//product_images//MSI GF63 Thin 11UC – i51821967279.jpeg',6),('resources//product_images//MSI GF63 Thin 11UC – i521718041034.jpeg',6),('resources//product_images//Asus TUF Gaming F15 FX507ZC4 – i50483566864.jpeg',7),('resources//product_images//Asus TUF Gaming F15 FX507ZC4 – i511052121042.jpeg',7),('resources//product_images//Asus TUF Gaming F15 FX507ZC4 – i521909676395.jpeg',7),('resources//product_images//AMD Ryzen 7 5800X0383150128.jpeg',10),('resources//product_images//AMD Ryzen 7 5800X11365432262.jpeg',10),('resources//product_images//AMD Ryzen 7 5800X22029045199.jpeg',10),('resources//product_images//Asus Dual Geforce GTX 1650 4GB GDDR6X OC01417181281.jpeg',12),('resources//product_images//Asus Dual Geforce GTX 1650 4GB GDDR6X OC1463923288.jpeg',12),('resources//product_images//Asus Dual Geforce GTX 1650 4GB GDDR6X OC21427431193.jpeg',12),('resources//product_images//Asus ROG Strix Scar160289752035.jpeg',13),('resources//product_images//Asus ROG Strix Scar1611756816598.jpeg',13),('resources//product_images//Asus ROG Strix Scar1622045192585.jpeg',13),('resources//product_images//Asus Prime A620M-K DDR5 Motherboard0985379119.jpeg',14),('resources//product_images//Asus Prime A620M-K DDR5 Motherboard165351485.jpeg',14),('resources//product_images//Asus Prime A620M-K DDR5 Motherboard2232181241.jpeg',14),('resources//product_images//Intel Core I7-14700 Desktop01976795983.jpeg',15),('resources//product_images//Intel Core I7-14700 Desktop12013165094.jpeg',15),('resources//product_images//Intel Core I7-14700 Desktop21329952788.jpeg',15),('resources//product_images//MSI G2422C0301608794.jpeg',16),('resources//product_images//MSI G2422C1560331926.jpeg',16),('resources//product_images//MSI G2422C2604347963.jpeg',16),('resources//product_images//ASUS VIVOBOOK GO 15 E1504F0791283156.jpeg',17),('resources//product_images//ASUS VIVOBOOK GO 15 E1504F1283438218.jpeg',17),('resources//product_images//ASUS VIVOBOOK GO 15 E1504F2491929201.jpeg',17);
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_images`
--

DROP TABLE IF EXISTS `profile_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_images` (
  `path` varchar(100) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_images_user1_idx` (`user_id`),
  CONSTRAINT `fk_images_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_images`
--

LOCK TABLES `profile_images` WRITE;
/*!40000 ALTER TABLE `profile_images` DISABLE KEYS */;
INSERT INTO `profile_images` VALUES ('resources//profile_images//Sandaru_66cccb823e7c0.jpeg',1);
/*!40000 ALTER TABLE `profile_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provinces` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name_en` varchar(45) DEFAULT NULL,
  `province_name_si` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provinces`
--

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
INSERT INTO `provinces` VALUES (1,'Western','බස්නාහිර'),(2,'Central','මධ්‍යම'),(3,'Southern','දකුණු'),(4,'North Western','වයඹ'),(5,'Sabaragamuwa','සබරගමුව'),(6,'Eastern','නැගෙනහිර'),(7,'Uva','ඌව'),(8,'North Central','උතුරු මැද'),(9,'Northern','උතුරු');
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `type` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Active'),(2,'Inactive');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(40) DEFAULT NULL,
  `lname` varchar(40) DEFAULT NULL,
  `uname` varchar(40) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `gender_id` int NOT NULL,
  `status_id` int NOT NULL,
  `registered_date` datetime DEFAULT NULL,
  `vcode` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname_UNIQUE` (`uname`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `mobile_UNIQUE` (`mobile`),
  KEY `fk_user_gender_idx` (`gender_id`),
  KEY `fk_user_status1_idx` (`status_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Sandaru','Samarasekara','sandaruns2004','sandaruns2004@gmail.com','qqqqqq','0767588712',1,1,'2024-07-17 23:26:12',222824),(8,'Minindu','Nethmina','minindu2007','nethminaminindu@gmail.com','Mns2007#','0766008951',1,1,'2024-09-19 22:19:03',281641),(10,'Preethika ','Nilmini','preethika75','prithikanilmini75@gmail.com','Agpn1975#','0766008950',2,1,'2024-09-19 22:22:18',211563);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_address`
--

DROP TABLE IF EXISTS `user_has_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_has_address` (
  `user_id` int NOT NULL,
  `cities_city_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `line1` varchar(50) DEFAULT NULL,
  `line2` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_has_address_user1_idx` (`user_id`),
  KEY `fk_user_has_address_cities1_idx` (`cities_city_id`),
  CONSTRAINT `fk_user_has_address_cities1` FOREIGN KEY (`cities_city_id`) REFERENCES `cities` (`city_id`),
  CONSTRAINT `fk_user_has_address_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_address`
--

LOCK TABLES `user_has_address` WRITE;
/*!40000 ALTER TABLE `user_has_address` DISABLE KEYS */;
INSERT INTO `user_has_address` VALUES (1,367,1,'218/40 ,Wondergrove Wata Mawatha','Samagi Mawatha');
/*!40000 ALTER TABLE `user_has_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `watchlist`
--

DROP TABLE IF EXISTS `watchlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `watchlist` (
  `w_id` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`w_id`),
  KEY `fk_watchlist_user1_idx` (`user_id`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watchlist`
--

LOCK TABLES `watchlist` WRITE;
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
INSERT INTO `watchlist` VALUES (144,'2024-09-19 22:29:16',10,15);
/*!40000 ALTER TABLE `watchlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-14  2:18:40
