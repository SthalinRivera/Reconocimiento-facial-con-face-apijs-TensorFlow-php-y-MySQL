-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para attendancemsystem
DROP DATABASE IF EXISTS `attendancemsystem`;
CREATE DATABASE IF NOT EXISTS `attendancemsystem` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `attendancemsystem`;

-- Volcando estructura para tabla attendancemsystem.tbladmin
DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dateRegistered` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla attendancemsystem.tbladmin: 3 rows
/*!40000 ALTER TABLE `tbladmin` DISABLE KEYS */;
REPLACE INTO `tbladmin` (`id`, `userName`, `firstName`, `lastName`, `emailAddress`, `password`, `dateRegistered`) VALUES
	(1, 'admin', 'Admin', 'Rivera Centeno', 'admin@gmail.com', 'c670ddc55c979ea11545f3d52d1b9f5f', ''),
	(4, 'admin2', 'Luis ', 'Cañas', 'lcanas@undc.edu.pe', '25d55ad283aa400af464c76d713c07ad', '2024-06-26'),
	(5, 'admin2', 'Sthalin', 'rivera', 'lcanaDs@undc.edu.pe', '428e97d6bd96584340719402b1de65df', '2024-06-26');
/*!40000 ALTER TABLE `tbladmin` ENABLE KEYS */;

-- Volcando estructura para tabla attendancemsystem.tblattendance
DROP TABLE IF EXISTS `tblattendance`;
CREATE TABLE IF NOT EXISTS `tblattendance` (
  `attendanceID` int NOT NULL AUTO_INCREMENT,
  `studentRegistrationNumber` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `course` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `attendanceStatus` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `dateMarked` date NOT NULL,
  `dateTimeMarked` datetime NOT NULL,
  `unit` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`attendanceID`)
) ENGINE=InnoDB AUTO_INCREMENT=5461 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla attendancemsystem.tblattendance: ~114 rows (aproximadamente)
REPLACE INTO `tblattendance` (`attendanceID`, `studentRegistrationNumber`, `course`, `attendanceStatus`, `dateMarked`, `dateTimeMarked`, `unit`) VALUES
	(5347, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:01:58', ''),
	(5348, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 13:02:13', ''),
	(5349, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:32:45', ''),
	(5350, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 13:32:46', ''),
	(5351, '72717504', '', 'presente', '2024-06-27', '2024-06-27 13:33:04', ''),
	(5352, '70147431', '', 'presente', '2024-06-27', '2024-06-27 13:33:08', ''),
	(5353, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:33:45', ''),
	(5354, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:34:45', ''),
	(5355, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 13:35:14', ''),
	(5356, '72717504', '', 'presente', '2024-06-27', '2024-06-27 13:35:27', ''),
	(5357, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:35:45', ''),
	(5358, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 13:36:43', ''),
	(5359, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:36:46', ''),
	(5360, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:37:46', ''),
	(5361, '72717504', '', 'presente', '2024-06-27', '2024-06-27 13:37:57', ''),
	(5362, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 13:37:58', ''),
	(5363, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:38:54', ''),
	(5364, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:38:54', ''),
	(5365, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 13:52:22', ''),
	(5366, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:52:22', ''),
	(5367, '72717504', '', 'presente', '2024-06-27', '2024-06-27 13:52:23', ''),
	(5368, '70147431', '', 'presente', '2024-06-27', '2024-06-27 13:52:29', ''),
	(5369, '72960217', '', 'presente', '2024-06-27', '2024-06-27 13:52:37', ''),
	(5370, '73625197', '', 'presente', '2024-06-27', '2024-06-27 13:53:22', ''),
	(5371, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 13:53:22', ''),
	(5372, '72717504', '', 'presente', '2024-06-27', '2024-06-27 13:53:27', ''),
	(5373, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 14:13:10', ''),
	(5374, '73625197', '', 'presente', '2024-06-27', '2024-06-27 14:13:10', ''),
	(5375, '72717504', '', 'presente', '2024-06-27', '2024-06-27 14:13:12', ''),
	(5376, '73625197', '', 'presente', '2024-06-27', '2024-06-27 15:59:52', ''),
	(5377, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:00:23', ''),
	(5378, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:00:25', ''),
	(5379, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:00:52', ''),
	(5380, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:01:23', ''),
	(5381, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:01:52', ''),
	(5382, '72717504', '', 'presente', '2024-06-27', '2024-06-27 16:01:58', ''),
	(5383, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:02:18', ''),
	(5384, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:02:51', ''),
	(5385, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:02:54', ''),
	(5386, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:03:27', ''),
	(5387, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:03:54', ''),
	(5388, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:04:20', ''),
	(5389, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:04:31', ''),
	(5390, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:05:09', ''),
	(5391, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:05:24', ''),
	(5392, '72717504', '', 'presente', '2024-06-27', '2024-06-27 16:05:29', ''),
	(5393, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:05:36', ''),
	(5394, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:07:59', ''),
	(5395, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:08:04', ''),
	(5396, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:09:04', ''),
	(5397, '72717504', '', 'presente', '2024-06-27', '2024-06-27 16:09:13', ''),
	(5398, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:10:03', ''),
	(5399, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:10:04', ''),
	(5400, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:10:08', ''),
	(5401, '72717504', '', 'presente', '2024-06-27', '2024-06-27 16:10:20', ''),
	(5402, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:12:38', ''),
	(5403, '72717504', '', 'presente', '2024-06-27', '2024-06-27 16:12:42', ''),
	(5404, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:12:49', ''),
	(5405, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:20:10', ''),
	(5406, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:20:12', ''),
	(5407, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:20:13', ''),
	(5408, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:21:10', ''),
	(5409, '72717504', '', 'presente', '2024-06-27', '2024-06-27 16:21:12', ''),
	(5410, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:21:20', ''),
	(5411, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:21:33', ''),
	(5412, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:22:10', ''),
	(5413, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:22:33', ''),
	(5414, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:23:01', ''),
	(5415, '72717504', '', 'presente', '2024-06-27', '2024-06-27 16:23:03', ''),
	(5416, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:23:33', ''),
	(5417, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:24:06', ''),
	(5418, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:24:08', ''),
	(5419, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:24:36', ''),
	(5420, 'unknown', '', 'presente', '2024-06-27', '2024-06-27 16:25:06', ''),
	(5421, '72960217', '', 'presente', '2024-06-27', '2024-06-27 16:25:36', ''),
	(5422, '73625197', '', 'presente', '2024-06-27', '2024-06-27 16:25:37', ''),
	(5423, '72717504', '', 'presente', '2024-06-27', '2024-06-27 16:25:50', ''),
	(5424, '7362519743', '', 'presente', '2024-07-01', '2024-07-01 16:31:35', ''),
	(5425, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:31:38', ''),
	(5426, '72960217', '', 'presente', '2024-07-01', '2024-07-01 16:31:38', ''),
	(5427, 'unknown', '', 'presente', '2024-07-01', '2024-07-01 16:31:39', ''),
	(5428, '73625197', '', 'presente', '2024-07-01', '2024-07-01 16:31:40', ''),
	(5429, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:32:38', ''),
	(5430, 'unknown', '', 'presente', '2024-07-01', '2024-07-01 16:33:15', ''),
	(5431, '73625197', '', 'presente', '2024-07-01', '2024-07-01 16:33:16', ''),
	(5432, '7362519743', '', 'presente', '2024-07-01', '2024-07-01 16:33:23', ''),
	(5433, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:33:56', ''),
	(5434, '7362519743', '', 'presente', '2024-07-01', '2024-07-01 16:34:23', ''),
	(5435, '73625197', '', 'presente', '2024-07-01', '2024-07-01 16:34:30', ''),
	(5436, 'unknown', '', 'presente', '2024-07-01', '2024-07-01 16:34:33', ''),
	(5437, '7362519743', '', 'presente', '2024-07-01', '2024-07-01 16:35:23', ''),
	(5438, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:35:36', ''),
	(5439, '7362519743', '', 'presente', '2024-07-01', '2024-07-01 16:36:23', ''),
	(5440, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:36:41', ''),
	(5441, '73625197', '', 'presente', '2024-07-01', '2024-07-01 16:36:43', ''),
	(5442, 'unknown', '', 'presente', '2024-07-01', '2024-07-01 16:36:44', ''),
	(5443, '72960217', '', 'presente', '2024-07-01', '2024-07-01 16:37:34', ''),
	(5444, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:37:41', ''),
	(5445, 'unknown', '', 'presente', '2024-07-01', '2024-07-01 16:38:02', ''),
	(5446, '7362519743', '', 'presente', '2024-07-01', '2024-07-01 16:38:06', ''),
	(5447, '73625197', '', 'presente', '2024-07-01', '2024-07-01 16:38:09', ''),
	(5448, '72717504', '', 'presente', '2024-07-01', '2024-07-01 16:38:23', ''),
	(5449, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:38:41', ''),
	(5450, '72960217', '', 'presente', '2024-07-01', '2024-07-01 16:38:45', ''),
	(5451, '7362519743', '', 'presente', '2024-07-01', '2024-07-01 16:39:06', ''),
	(5452, 'unknown', '', 'presente', '2024-07-01', '2024-07-01 16:39:12', ''),
	(5453, '73625197', '', 'presente', '2024-07-01', '2024-07-01 16:39:34', ''),
	(5454, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:39:49', ''),
	(5455, '7362519743', '', 'presente', '2024-07-01', '2024-07-01 16:40:08', ''),
	(5456, '73625197', '', 'presente', '2024-07-01', '2024-07-01 16:40:46', ''),
	(5457, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:40:50', ''),
	(5458, 'unknown', '', 'presente', '2024-07-01', '2024-07-01 16:40:56', ''),
	(5459, '7362519743', '', 'presente', '2024-07-01', '2024-07-01 16:41:08', ''),
	(5460, '736251', '', 'presente', '2024-07-01', '2024-07-01 16:41:52', '');

-- Volcando estructura para tabla attendancemsystem.tblcourse
DROP TABLE IF EXISTS `tblcourse`;
CREATE TABLE IF NOT EXISTS `tblcourse` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `facultyID` int NOT NULL,
  `dateCreated` date NOT NULL,
  `courseCode` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla attendancemsystem.tblcourse: ~1 rows (aproximadamente)
REPLACE INTO `tblcourse` (`ID`, `name`, `facultyID`, `dateCreated`, `courseCode`) VALUES
	(10, 'Ingenieria de Sistemas ', 8, '2024-04-07', 'IS');

-- Volcando estructura para tabla attendancemsystem.tblfaculty
DROP TABLE IF EXISTS `tblfaculty`;
CREATE TABLE IF NOT EXISTS `tblfaculty` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `facultyName` varchar(255) NOT NULL,
  `facultyCode` varchar(50) NOT NULL,
  `dateRegistered` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla attendancemsystem.tblfaculty: 1 rows
/*!40000 ALTER TABLE `tblfaculty` DISABLE KEYS */;
REPLACE INTO `tblfaculty` (`Id`, `facultyName`, `facultyCode`, `dateRegistered`) VALUES
	(8, 'Facultad de Ingenieria de Sistemas', 'FIS', '2024-04-07');
/*!40000 ALTER TABLE `tblfaculty` ENABLE KEYS */;

-- Volcando estructura para tabla attendancemsystem.tbllecture
DROP TABLE IF EXISTS `tbllecture`;
CREATE TABLE IF NOT EXISTS `tbllecture` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNo` varchar(50) NOT NULL,
  `facultyCode` varchar(50) NOT NULL,
  `dateCreated` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla attendancemsystem.tbllecture: 2 rows
/*!40000 ALTER TABLE `tbllecture` DISABLE KEYS */;
REPLACE INTO `tbllecture` (`Id`, `firstName`, `lastName`, `emailAddress`, `password`, `phoneNo`, `facultyCode`, `dateCreated`) VALUES
	(29, 'stgha', 'asd', 'admin@gmail.com', '6753a27847d7e4e3518b1837c2f0e716', 'asd', 'FIS', '2024-06-24'),
	(28, 'Adler Stalin', ' Rivera Centeno', 'sthalin.11@gmail.com', '25d55ad283aa400af464c76d713c07ad', '910985938', 'FIS', '2024-06-20');
/*!40000 ALTER TABLE `tbllecture` ENABLE KEYS */;

-- Volcando estructura para tabla attendancemsystem.tblstudents
DROP TABLE IF EXISTS `tblstudents`;
CREATE TABLE IF NOT EXISTS `tblstudents` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `registrationNumber` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `faculty` varchar(10) NOT NULL,
  `courseCode` varchar(20) NOT NULL,
  `studentImage1` varchar(300) NOT NULL,
  `studentImage2` varchar(300) NOT NULL,
  `studentImage3` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `studentImage4` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dateRegistered` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla attendancemsystem.tblstudents: 7 rows
/*!40000 ALTER TABLE `tblstudents` DISABLE KEYS */;
REPLACE INTO `tblstudents` (`Id`, `firstName`, `lastName`, `registrationNumber`, `email`, `faculty`, `courseCode`, `studentImage1`, `studentImage2`, `studentImage3`, `studentImage4`, `dateRegistered`) VALUES
	(134, 'MARILENNY', 'BENAVENTE PADILLA', '70147431', '1770147431@undc.edu.pe', 'FIS', 'IS', '70147431_image1.png', '70147431_image2.png', '70147431_image3.png', '70147431_image4.png', '2024-06-25'),
	(135, 'Unknown', 'Unknown', 'unknown', 'unknown@undc.edu.pe', 'FIS', 'IS', 'unknown_image1.png', 'unknown_image2.png', 'unknown_image3.png', 'unknown_image4.png', '2024-06-25'),
	(136, 'CARMEN PAMELA', 'REYNA VIZCARRA', '72717504', '1572717504@undc.edu.pe', 'FIS', 'IS', '72717504_image1.png', '72717504_image2.png', '72717504_image3.png', '72717504_image4.png', '2024-06-26'),
	(137, 'BENI ALEXIS', 'LUYO HUAMÁN', '72960217', '1472960217@undc.edu.pe', 'FIS', 'IS', '72960217_image1.png', '72960217_image2.png', '72960217_image3.png', '72960217_image4.png', '2024-06-26'),
	(138, 'ADLER STALIN', 'RIVERA CENTENO', '7362519743', '157362d5197@undc.edu.pe', 'FIS', 'IS', '7362519743_image1.png', '7362519743_image2.png', '7362519743_image3.png', '7362519743_image4.png', '2024-06-28'),
	(133, 'Adler Stalin ', 'Rivera Centeno', '73625197', 'arivera@undc.edu.pe', 'FIS', 'IS', '73625197_image1.png', '73625197_image2.png', '73625197_image3.png', '73625197_image4.png', '2024-06-25'),
	(139, 'd', 'asd', '736251', 'adminss@gmail.com', 'FIS', 'IS', '736251_image1.png', '736251_image2.png', '736251_image3.png', '736251_image4.png', '2024-06-28');
/*!40000 ALTER TABLE `tblstudents` ENABLE KEYS */;

-- Volcando estructura para tabla attendancemsystem.tblunit
DROP TABLE IF EXISTS `tblunit`;
CREATE TABLE IF NOT EXISTS `tblunit` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `unitCode` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `courseID` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dateCreated` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla attendancemsystem.tblunit: ~1 rows (aproximadamente)
REPLACE INTO `tblunit` (`ID`, `name`, `unitCode`, `courseID`, `dateCreated`) VALUES
	(3, 'Project Implementation', 'BCT 2411', '10', '2024-04-07');

-- Volcando estructura para tabla attendancemsystem.tblvenue
DROP TABLE IF EXISTS `tblvenue`;
CREATE TABLE IF NOT EXISTS `tblvenue` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `className` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `facultyCode` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `currentStatus` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `capacity` int NOT NULL,
  `classification` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dateCreated` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla attendancemsystem.tblvenue: ~4 rows (aproximadamente)
REPLACE INTO `tblvenue` (`ID`, `className`, `facultyCode`, `currentStatus`, `capacity`, `classification`, `dateCreated`) VALUES
	(4, 'B 06', 'FI', 'available', 100, 'class', '2024-04-07'),
	(9, '12', 'FIS', '', 23, 'computerLab', '2024-06-24'),
	(10, '1231', 'FIS', 'scheduled', 23, 'computerLab', '2024-06-24'),
	(11, 'sSSA', 'FIS', 'availlable', 23, 'laboratory', '2024-06-24');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
