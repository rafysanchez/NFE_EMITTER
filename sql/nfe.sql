/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : aula

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-06 09:41:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `nfe`
-- ----------------------------
DROP TABLE IF EXISTS `nfe`;
CREATE TABLE `nfe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chNFe` varchar(100) DEFAULT NULL,
  `CNPJ` varchar(20) DEFAULT NULL,
  `xNome` varchar(255) DEFAULT NULL,
  `IE` varchar(50) DEFAULT NULL,
  `dhEmi` varchar(30) DEFAULT NULL,
  `digVal` varchar(150) DEFAULT NULL,
  `dhRecbto` varchar(30) DEFAULT NULL,
  `nProt` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `pasta` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
