/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : ssm

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 27/04/2022 12:22:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for footerkanan
-- ----------------------------
DROP TABLE IF EXISTS `footerkanan`;
CREATE TABLE `footerkanan`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Judul` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Isi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of footerkanan
-- ----------------------------
INSERT INTO `footerkanan` VALUES (1, 'Our Newsletter', 'However, none of the things I will read but it is our great fault that I will read many');

-- ----------------------------
-- Table structure for footerkiri
-- ----------------------------
DROP TABLE IF EXISTS `footerkiri`;
CREATE TABLE `footerkiri`  (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Judul` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Isi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Isi2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Twitter` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Facebook` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Instagram` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `LinkedIn` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of footerkiri
-- ----------------------------
INSERT INTO `footerkiri` VALUES (1, 'PT. SYAM SURYA MANDIRI', 'Jl. Propinsi No. 01 Kampung Kajang', 'Kec. Anggana Kutai Kartanegara', '(+62  541) 682237', 'info@syamsurya.co.id', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for kontak
-- ----------------------------
DROP TABLE IF EXISTS `kontak`;
CREATE TABLE `kontak`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nama` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Judul` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `Status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kontak
-- ----------------------------
INSERT INTO `kontak` VALUES (1, 'shandy', 'Shuhada', 'isi ini', 'Semoga bisa', NULL);
INSERT INTO `kontak` VALUES (2, 'Shuhada', 'shandy', 'isi ini', 'sadfasfasdf', NULL);
INSERT INTO `kontak` VALUES (3, 'ewfeqfefeaf', 'sdfsdfsdfg', 'sdfgsdgsdg', 'sgffsdgfsdg', NULL);
INSERT INTO `kontak` VALUES (4, 'wreqrqr', 'sdfafasfas', 'sdfgsdgsdg', 'qwrewqrqreq', NULL);
INSERT INTO `kontak` VALUES (5, 'trurturty', 'rturtutrutru', 'uyrutyruytruyytu', 'uryurtuyrrt', NULL);
INSERT INTO `kontak` VALUES (6, 'qwrewqreqwr', 'qwrwqrqwrqr', 'qwreqwrqrqwr', 'qwreewrqwrqwr', NULL);
INSERT INTO `kontak` VALUES (7, 'hgjkjkhgjkhjg', 'jhkjgkgkhg', 'hkghjkghjkgh', 'gkghkhjgkhgkj', NULL);
INSERT INTO `kontak` VALUES (8, 'fhddfhdd', 'hgfdhdfhdfh', 'dhgdhghdg', 'fdhdfhfd', NULL);
INSERT INTO `kontak` VALUES (9, 'fhddfhdd', 'hgfdhdfhdfh', 'dhgdhghdg', 'fdhdfhfd', NULL);
INSERT INTO `kontak` VALUES (10, 'afsasfddsfafsda', 'sadfdasfasdfasfd', 'sadfasfdsadf', 'sadfsafsadfsadfasf', NULL);
INSERT INTO `kontak` VALUES (11, 'sdagdsgdsgsdg', 'dsfgsdgdsgds', 'dsfgdsgdsfgfds', 'sdfgsdgsdg', NULL);
INSERT INTO `kontak` VALUES (12, 'sdagdsgdsgsdg', 'dsfgsdgdsgds', 'dsfgdsgdsfgfds', 'sdfgsdgsdg', NULL);
INSERT INTO `kontak` VALUES (13, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (14, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (15, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (16, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (17, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (18, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (19, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (20, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (21, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (22, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (23, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (24, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (25, 'sadfsadf', 'assadfasf', 'asdfdasfdas', 'sadfasfdas', NULL);
INSERT INTO `kontak` VALUES (26, 'Shuhada', 'shuhada@gmail.com', 'Bertanya', 'Mohon maaf sebelum ijin bertanya Pak', NULL);

-- ----------------------------
-- Table structure for layanan
-- ----------------------------
DROP TABLE IF EXISTS `layanan`;
CREATE TABLE `layanan`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Judul` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Isi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of layanan
-- ----------------------------
INSERT INTO `layanan` VALUES (1, 'Isoqar', 'Penghargaan', '0001.jpg');
INSERT INTO `layanan` VALUES (2, 'Kementrian', 'Kementrian dan kelautan', '0002.jpg');
INSERT INTO `layanan` VALUES (3, 'Karantina', 'Karantina', 'Web SSM1.jpg');
INSERT INTO `layanan` VALUES (4, 'Cooking', 'Cooking', 'Web SSM2.jpg');
INSERT INTO `layanan` VALUES (5, 'Benur', 'Benur', 'Web SSM3.jpeg');
INSERT INTO `layanan` VALUES (6, 'Ministry', 'Ministry', 'Web SSM4.jpg');

-- ----------------------------
-- Table structure for motivation
-- ----------------------------
DROP TABLE IF EXISTS `motivation`;
CREATE TABLE `motivation`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Judul` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Isi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of motivation
-- ----------------------------
INSERT INTO `motivation` VALUES (1, 'Keep Spirit', 'Enthusiasm and keep trying is one of the keys to success that can be done anytime and anywhere, so keep the spirit up, Enthusiasm and keep trying is one of the keys to success that can be done anytime and anywhere, so keep the spirit up', 'Cooked003.jpg');

-- ----------------------------
-- Table structure for portofolio
-- ----------------------------
DROP TABLE IF EXISTS `portofolio`;
CREATE TABLE `portofolio`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Judul` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Isi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Gambar2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Gambar3` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of portofolio
-- ----------------------------
INSERT INTO `portofolio` VALUES (1, 'BT HO', 'BT HO', 'BT HO.jpg', NULL, NULL);
INSERT INTO `portofolio` VALUES (2, 'BT HO', 'BT HO', 'IMG_4407(1).jpg', NULL, NULL);
INSERT INTO `portofolio` VALUES (3, 'Black Pink Cooked', 'Black Pink Cooked', 'BlackPinkCooked001.jpg', NULL, NULL);
INSERT INTO `portofolio` VALUES (4, 'Cooked', 'Cooked', 'Cooked005.jpg', NULL, NULL);
INSERT INTO `portofolio` VALUES (5, 'Cooked Strong', 'Cooked Strong', 'Cooked006.jpg', NULL, NULL);

-- ----------------------------
-- Table structure for tentang
-- ----------------------------
DROP TABLE IF EXISTS `tentang`;
CREATE TABLE `tentang`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Judul` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Isi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tentang
-- ----------------------------
INSERT INTO `tentang` VALUES (1, 'Company Introduction', '<p style=\"text-align:justify;\">Please allow me as owner of PT. Syam Surya Mandiri to deliver our high appreciate and thank\'s for all support and assistance we had received.</p>\r\n\r\n<p style=\"text-align:justify;\">PT. Syam Surya Mandiri is one of frozen shrimp factory located in Anggana - Kutai Kartanegara - East Borneo, Indonesia Established on August 2 of 2002 as an outcome of family support and Anggana farmers effort.</p>\r\n\r\n<p style=\"text-align:justify;\">Our business base on traditional farming consist 99% processed in our factory. Hence to maintain good supply of raw material, we have integrated hatchery to provide good quality shrimp fry for our ponds.</p>\r\n\r\n<p style=\"text-align:justify;\"><u><strong>Our Perspective</strong></u></p>\r\n\r\n<p style=\"text-align:justify;\">Achieve fisheries community welfare and incomes, to attain advance and independent fisheries industry.</p>', 'BT-NOBASHI.jpg');
INSERT INTO `tentang` VALUES (3, 'Our Principal Mission', '<p>Our principal mission is Prime Quality including :<br />\r\n1. Prime Product Quality.<br />\r\n2. Prime Satisfaction Services.<br />\r\n3. Prime Human Resource.<br />\r\n4. Prime Sustainable Environment.</p>\r\n\r\n<p>We are HACCP certified factory \"A\" grade qualification, BRC and EC number approved.</p>\r\n\r\n<p>We commit to food safety and quality, customer satisfaction an good ecology awareness.</p>\r\n\r\n<p>May god\'s mercy guidance are always us.</p>', 'IMG_4407.jpg');

-- ----------------------------
-- Table structure for tim
-- ----------------------------
DROP TABLE IF EXISTS `tim`;
CREATE TABLE `tim`  (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Judul` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Isi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Twitter` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Fb` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Instagram` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Linkedin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
