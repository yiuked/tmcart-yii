/*
Navicat MySQL Data Transfer

Source Server         : wamp
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : yii_cart

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-04-20 07:40:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tm_access`
-- ----------------------------
DROP TABLE IF EXISTS `tm_access`;
CREATE TABLE `tm_access` (
  `id_profile` int(10) unsigned NOT NULL,
  `id_tab` int(10) unsigned NOT NULL,
  `view` int(11) NOT NULL,
  `add` int(11) NOT NULL,
  `edit` int(11) NOT NULL,
  `delete` int(11) NOT NULL,
  PRIMARY KEY (`id_profile`,`id_tab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tm_access
-- ----------------------------

-- ----------------------------
-- Table structure for `tm_employee`
-- ----------------------------
DROP TABLE IF EXISTS `tm_employee`;
CREATE TABLE `tm_employee` (
  `id_employee` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_profile` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `email` varchar(128) COLLATE utf8_bin NOT NULL,
  `passwd` varchar(128) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL,
  `add_date` datetime NOT NULL,
  `upd_date` datetime NOT NULL,
  `last_date` datetime NOT NULL,
  PRIMARY KEY (`id_employee`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tm_employee
-- ----------------------------
INSERT INTO `tm_employee` VALUES ('8', '1', 'shrakie', 'yiuked@vip.qq.com', '616766', '1', '2016-04-08 17:05:54', '2016-04-08 17:05:54', '2016-04-08 17:05:54');
INSERT INTO `tm_employee` VALUES ('9', '2', 'Yiuked', '610006622@qq.com', '616766', '1', '2016-04-08 17:06:44', '2016-04-08 17:06:44', '2016-04-08 17:06:44');

-- ----------------------------
-- Table structure for `tm_profile`
-- ----------------------------
DROP TABLE IF EXISTS `tm_profile`;
CREATE TABLE `tm_profile` (
  `id_profile` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tm_profile
-- ----------------------------
INSERT INTO `tm_profile` VALUES ('1', '超级管理员');
INSERT INTO `tm_profile` VALUES ('2', '销售员');

-- ----------------------------
-- Table structure for `tm_tabs`
-- ----------------------------
DROP TABLE IF EXISTS `tm_tabs`;
CREATE TABLE `tm_tabs` (
  `id_tab` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `icon_class` varchar(64) NOT NULL,
  `icon_img` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `route` varchar(128) NOT NULL,
  `position` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_tab`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tm_tabs
-- ----------------------------
INSERT INTO `tm_tabs` VALUES ('1', '0', 'IS_ROOT', '', '', '根目录', '', '0', '1');
INSERT INTO `tm_tabs` VALUES ('2', '1', 'IS_MAIN', 'glyphicon glyphicon-user', '', '管理员', 'admin/employee/index', '1', '1');
INSERT INTO `tm_tabs` VALUES ('3', '1', 'IS_MAIN', 'glyphicon glyphicon-th', '', '产品', '', '2', '1');
INSERT INTO `tm_tabs` VALUES ('4', '1', 'IS_MAIN', 'glyphicon glyphicon-shopping-cart', '', '定单', '', '3', '1');
INSERT INTO `tm_tabs` VALUES ('5', '1', 'IS_MAIN', 'glyphicon glyphicon-plane', '', '物流', '', '4', '1');
INSERT INTO `tm_tabs` VALUES ('6', '1', 'IS_MAIN', 'glyphicon glyphicon-cog', '', '系统', '', '5', '0');
INSERT INTO `tm_tabs` VALUES ('7', '2', 'IS_MENU', '', '', '管理员列表', 'admin/employee/index', '1', '1');
INSERT INTO `tm_tabs` VALUES ('8', '2', 'IS_MENU', '', '', '管理员分组', 'admin/profile/index', '2', '1');
INSERT INTO `tm_tabs` VALUES ('9', '2', 'IS_MENU', '', '', '权限管理', '', '3', '1');
