/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : approver

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-04-30 21:19:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for administrators
-- ----------------------------
DROP TABLE IF EXISTS `administrators`;
CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `staff_id` varchar(11) DEFAULT '',
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of administrators
-- ----------------------------
INSERT INTO `administrators` VALUES ('5', 'Adeniji Charles Ayodipupo', 'adenijiayocharles@gmail.com', '2000916', '$2y$10$ilSkl.Nks1IwKqPkTcpng.ZjtmgQIoxoDR2nFhXLF8iPs17CezcOW', '2020-04-24 09:32:08');
INSERT INTO `administrators` VALUES ('7', 'Jon Snow', 'jonsnow@gmail.com', '3000567', '$2y$10$M/i2NBShhVKc2zkCgd8RhOwbAH2AlWYwHwk6eXrz3a4hBdXiMxNMa', '2020-04-30 20:02:21');

-- ----------------------------
-- Table structure for approval_requests
-- ----------------------------
DROP TABLE IF EXISTS `approval_requests`;
CREATE TABLE `approval_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `experiment_id` int(11) NOT NULL,
  `reasons` text NOT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`files`)),
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of approval_requests
-- ----------------------------
INSERT INTO `approval_requests` VALUES ('1', '14', 'let approve d this fgfg fgfgfg fgf gfg', 0x5B2237386632343431383933393834313065653462626132353063303963383533312E646F63222C2238343361356261613234643331336262646235316364616534373336366365372E646F6378222C2239306339653631396334633136396331393031373061613039383266303835342E646F63225D, '2', '2020-04-30 20:38:01');

-- ----------------------------
-- Table structure for assigned_requests
-- ----------------------------
DROP TABLE IF EXISTS `assigned_requests`;
CREATE TABLE `assigned_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) DEFAULT NULL,
  `eao_id` varchar(11) DEFAULT '',
  `feedback` text DEFAULT NULL,
  `feedback_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of assigned_requests
-- ----------------------------
INSERT INTO `assigned_requests` VALUES ('1', '1', '1111007', 'let approve', '1', '2020-04-30 20:43:13');
INSERT INTO `assigned_requests` VALUES ('2', '1', '1234567', 'lets reject', '2', '2020-04-30 20:44:12');

-- ----------------------------
-- Table structure for eaos
-- ----------------------------
DROP TABLE IF EXISTS `eaos`;
CREATE TABLE `eaos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `staff_id` varchar(11) DEFAULT '',
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of eaos
-- ----------------------------
INSERT INTO `eaos` VALUES ('1', 'John  Snow', 'johnsnow@gmaesofthrons.com', '1234567', '$2y$10$CSwYbQY7Q9CHErBz1o8tvOOMVFuhEKu/8RliMOiqKVY0GzbMC3hS6', '2020-04-30 20:40:18');
INSERT INTO `eaos` VALUES ('2', 'James Bond', 'oo7@mi6.gov', '1111007', '$2y$10$SEYN6h2LcWN.U6tIr41Obu9fsqCcKoNgnvmSL4KjkSPYgAs8PAvS6', '2020-04-30 20:40:52');

-- ----------------------------
-- Table structure for experiments
-- ----------------------------
DROP TABLE IF EXISTS `experiments`;
CREATE TABLE `experiments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of experiments
-- ----------------------------
INSERT INTO `experiments` VALUES ('6', '2000916', 'Pretty good experiment title', 'Due to the COVID-19 pandemic, and in-line with the Lagos State social distancing guideline, the Firebase Study Jam would be postponed to a later date, the new date would be communicated as soon as possible.\r\n\r\nWe are so sorry for the inconvenience this might have caused. sdsdsd\r\n\r\nLet us endeavour to follow the all safety guidelines to protect ourselves and others.\r\n\r\nKind Regards.', '2020-04-24 10:45:34');
INSERT INTO `experiments` VALUES ('8', '2000916', 'this is my esxperiment', 'detaas lorem ipsum', '2020-04-30 19:18:45');
INSERT INTO `experiments` VALUES ('10', '2000916', 'title new 4', 'sdsdsd ssdsdsd', '2020-04-30 20:37:09');
INSERT INTO `experiments` VALUES ('11', '2000916', 'Test experiment new', 'new ddesription', '2020-04-30 20:08:45');
INSERT INTO `experiments` VALUES ('14', '2000916', 'Test experiment', 'test dscription', '2020-04-30 20:37:24');

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `createa_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('5', 'Adeniji Charles Ayodipupo', 'adenijiayocharles@gmail.com', '2000916', '$2y$10$q8OxBCe9U1hiM5zP12NtPO/JM9esShjtXP2Tcnn.1aAKbG6V6DIC2', '2020-04-30 11:55:51');
