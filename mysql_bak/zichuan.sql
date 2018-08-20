/*
Navicat MySQL Data Transfer

Source Server         : 本地链接
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : zichuan

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-20 18:11:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zi_admin
-- ----------------------------
DROP TABLE IF EXISTS `zi_admin`;
CREATE TABLE `zi_admin` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_user` varchar(255) DEFAULT NULL,
  `ad_passad` varchar(255) DEFAULT NULL,
  `ad_passad_jia` varchar(255) DEFAULT NULL,
  `create_time` int(32) DEFAULT NULL,
  `update_time` int(32) DEFAULT NULL,
  `ad_quanuser_id` int(32) DEFAULT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zi_admin
-- ----------------------------
INSERT INTO `zi_admin` VALUES ('4', 'admin', 'e152b306d514e0fa3af63f7aafd958df', 'r_ycazei', '1533697363', '1534144095', '1');
INSERT INTO `zi_admin` VALUES ('7', '客服', '87259b98eb872b21f6e5ac4605bfa62a', 'g-jy97_8', '1534144033', '1534145419', '7');

-- ----------------------------
-- Table structure for zi_flow
-- ----------------------------
DROP TABLE IF EXISTS `zi_flow`;
CREATE TABLE `zi_flow` (
  `fl_id` int(150) NOT NULL AUTO_INCREMENT,
  `fl_ip` varchar(255) DEFAULT NULL,
  `fl_adds` varchar(255) DEFAULT NULL,
  `fl_time` int(32) DEFAULT NULL,
  `fl_url` varchar(255) DEFAULT NULL,
  `fl_year` varchar(255) DEFAULT NULL,
  `fl_month` varchar(255) DEFAULT NULL,
  `fl_day` varchar(255) DEFAULT NULL,
  `fl_ency` int(150) DEFAULT NULL,
  PRIMARY KEY (`fl_id`),
  KEY `fl_id` (`fl_id`) USING BTREE,
  KEY `fl_ip` (`fl_ip`) USING BTREE,
  KEY `fl_year` (`fl_year`) USING BTREE,
  KEY `fl_month` (`fl_month`) USING BTREE,
  KEY `fl_day` (`fl_day`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zi_flow
-- ----------------------------
INSERT INTO `zi_flow` VALUES ('46', '127.0.0.1', '无法获取', '1534430054', '/index/index/index.html', '2018', '08', '1534348800', '9');
INSERT INTO `zi_flow` VALUES ('47', '127.0.0.1', '无法获取', '1534432251', '/index/index/aa.html', '2018', '08', '1534348800', '20');
INSERT INTO `zi_flow` VALUES ('48', '127.0.0.1', '无法获取', '1534595761', '/index/goods/network.html', '2018', '08', '1534521600', '5');
INSERT INTO `zi_flow` VALUES ('49', '127.0.0.1', '无法获取', '1534729326', '/index/index/index.html', '2018', '08', '1534694400', '4');

-- ----------------------------
-- Table structure for zi_goods
-- ----------------------------
DROP TABLE IF EXISTS `zi_goods`;
CREATE TABLE `zi_goods` (
  `go_id` int(11) NOT NULL AUTO_INCREMENT,
  `go_user` varchar(255) DEFAULT NULL,
  `go_jibie` int(32) DEFAULT NULL,
  `create_time` int(32) DEFAULT NULL,
  `update_time` int(32) DEFAULT NULL,
  `go_money` varchar(255) DEFAULT NULL,
  `go_bak` varchar(255) DEFAULT NULL,
  `go_guan` int(32) DEFAULT '1',
  PRIMARY KEY (`go_id`),
  KEY `go_user` (`go_user`) USING BTREE,
  KEY `go_id` (`go_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of zi_goods
-- ----------------------------
INSERT INTO `zi_goods` VALUES ('69', 'index', '1', '1533707104', '1533759796', '899', '苹果8p', '1');
INSERT INTO `zi_goods` VALUES ('70', 'network', '1', '1533852656', '1533852656', '899', '全网通4G手机', '1');
INSERT INTO `zi_goods` VALUES ('71', 'network_2', '1', '1533854457', '1533854457', '999', '全网通4G手机_999', '1');
INSERT INTO `zi_goods` VALUES ('72', 'index_1', '1', '1534149871', '1534149871', '998', '苹果x', '1');

-- ----------------------------
-- Table structure for zi_lately
-- ----------------------------
DROP TABLE IF EXISTS `zi_lately`;
CREATE TABLE `zi_lately` (
  `la_id` int(11) NOT NULL AUTO_INCREMENT,
  `la_admin_id` int(11) DEFAULT NULL,
  `la_time` int(32) DEFAULT NULL,
  `la_ip` varchar(255) DEFAULT NULL,
  `la_ip_adds` varchar(255) NOT NULL,
  PRIMARY KEY (`la_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zi_lately
-- ----------------------------
INSERT INTO `zi_lately` VALUES ('1', '4', '1533697736', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('2', '4', '1533698243', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('3', '4', '1533752391', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('4', '4', '1533852448', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('5', '4', '1533853676', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('6', '4', '1533856649', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('7', '4', '1533866225', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('8', '4', '1533866526', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('9', '4', '1533866997', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('10', '4', '1533916928', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('11', '4', '1534046420', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('12', '4', '1534067541', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('13', '4', '1534145411', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('14', '7', '1534145431', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('15', '4', '1534146556', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('16', '7', '1534148665', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('17', '4', '1534148709', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('18', '7', '1534150017', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('19', '4', '1534150205', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('20', '4', '1534340500', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('21', '4', '1534382992', null, '');
INSERT INTO `zi_lately` VALUES ('22', '4', '1534423259', null, '');
INSERT INTO `zi_lately` VALUES ('23', '4', '1534427961', null, '');
INSERT INTO `zi_lately` VALUES ('24', '4', '1534470335', null, '');
INSERT INTO `zi_lately` VALUES ('25', '4', '1534517515', null, '');
INSERT INTO `zi_lately` VALUES ('26', '4', '1534523461', null, '');
INSERT INTO `zi_lately` VALUES ('27', '4', '1534558262', null, '');
INSERT INTO `zi_lately` VALUES ('28', '4', '1534729342', '127.0.0.1', 'XXXX内网IP');
INSERT INTO `zi_lately` VALUES ('29', '4', '1534730223', null, '');
INSERT INTO `zi_lately` VALUES ('30', '4', '1534754851', null, '');

-- ----------------------------
-- Table structure for zi_level
-- ----------------------------
DROP TABLE IF EXISTS `zi_level`;
CREATE TABLE `zi_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `point_id` int(11) DEFAULT NULL,
  `create_time` int(32) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `update_time` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zi_level
-- ----------------------------
INSERT INTO `zi_level` VALUES ('2', 'zichuang.com', '71', '1533891120', '12321', '1533891120');
INSERT INTO `zi_level` VALUES ('3', 'ye2.com', '70', '1533891165', '232', '1533891165');

-- ----------------------------
-- Table structure for zi_order
-- ----------------------------
DROP TABLE IF EXISTS `zi_order`;
CREATE TABLE `zi_order` (
  `or_id` int(150) NOT NULL AUTO_INCREMENT,
  `or_name` varchar(255) DEFAULT NULL,
  `or_style` varchar(255) DEFAULT NULL,
  `or_moeny` varchar(255) DEFAULT NULL,
  `or_number` int(11) DEFAULT NULL,
  `or_user` varchar(255) DEFAULT NULL,
  `or_tel` varchar(255) DEFAULT NULL,
  `or_addr` varchar(255) DEFAULT NULL,
  `or_goods` varchar(255) DEFAULT NULL,
  `or_tive` varchar(255) DEFAULT NULL,
  `create_time` int(32) DEFAULT NULL,
  `or_bak` varchar(255) DEFAULT NULL,
  `or_year` varchar(255) DEFAULT NULL,
  `or_month` varchar(255) DEFAULT NULL,
  `or_day` varchar(255) DEFAULT NULL,
  `or_ip` varchar(255) DEFAULT NULL,
  `or_ip_adds` varchar(255) DEFAULT NULL,
  `or_order` varchar(255) DEFAULT NULL,
  `or_goods_id` int(32) DEFAULT NULL,
  `update_time` int(32) DEFAULT NULL,
  PRIMARY KEY (`or_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zi_order
-- ----------------------------
INSERT INTO `zi_order` VALUES ('9', '苹果iPhone 8 Plus256G', '金色', '899', '1', '吴坤盛', '13760740438', '广东省-广州市-天河区，贮存', '4', '1', '1533769769', null, '2018', '08', '1533744000', '127.0.0.1', 'XXXX内网IP', null, '69', null);
INSERT INTO `zi_order` VALUES ('10', '苹果iPhone 8 Plus 256G', '银色', '899', '1', '吴坤盛', '1376070438', '福建省-福州市-长乐市，1211', '4', '1', '1533771634', null, '2018', '08', '1533744000', '127.0.0.1', 'XXXX内网IP', null, '69', null);
INSERT INTO `zi_order` VALUES ('11', '苹果iPhone 8 Plus 256G', '红色', '899', '1', '吴坤盛', '13760740438', '湖南省-长沙市-市辖区，123', '4', '1', '1533783072', null, '2018', '08', '1533744000', '127.0.0.1', 'XXXX内网IP', null, '69', null);
INSERT INTO `zi_order` VALUES ('12', '全网通4G手机 双卡双待手机', '蓝色', '899', '1', 'admin', '13113985742', '123', '2', '1', '1533853660', '', '2018', '08', '1533830400', '127.0.0.1', 'XXXX内网IP', '2656', '70', null);
INSERT INTO `zi_order` VALUES ('13', '全网通4G手机 双卡双待手机', '黑色', '999', '1', 'admin', '13113985742', '123', '4', '1', '1533854493', null, '2018', '08', '1533830400', '127.0.0.1', 'XXXX内网IP', null, '71', null);
INSERT INTO `zi_order` VALUES ('14', '苹果iPhone 8 Plus 256G', '金色', '899', '1', '吴坤盛', '13113985742', '福建省-福州市-市辖区，1231', '4', '1', '1533856564', null, '2018', '08', '1533830400', '127.0.0.1', 'XXXX内网IP', null, '69', null);
INSERT INTO `zi_order` VALUES ('15', '苹果iPhone 8 Plus 256G', '金色', '899', '1', '无尽', '13113985742', '广东省-广州市-从化市，12311', '4', '2', '1533856630', '', '2018', '08', '1533830400', '127.0.0.1', 'XXXX内网IP', '', '69', null);
INSERT INTO `zi_order` VALUES ('16', '苹果Apple iPhone X 256G', '银色', '899', '1', 'admin', '13113985742', '河北省-石家庄市-桥东区，123', '4', '1', '1534152208', null, '2018', '08', '1534089600', '127.0.0.1', 'XXXX内网IP', null, '69', null);
INSERT INTO `zi_order` VALUES ('18', '苹果iPhone 8 Plus 256G', '金色', '899', '1', 'admin', '13113985742', '湖南省-株洲市-荷塘区，123', '5', '1', '1534345514', '', '2018', '08', '1534262400', '127.0.0.1', 'XXXX内网IP', '', '69', null);
INSERT INTO `zi_order` VALUES ('19', '苹果iPhone 8 Plus 256G', '金色', '899', '1', 'admin', '13113985742', '广东省-潮州市-市辖区，12123', '8', '1', '1534347090', '', '2018', '08', '1534262400', '127.0.0.1', 'XXXX内网IP', '13123123123123123123123123', '69', null);
INSERT INTO `zi_order` VALUES ('20', '苹果iPhone 8 Plus 256G', '红色', '899', '1', 'admin', '13113985742', '湖南省-长沙市-市辖区，22', '6', '1', '1534347216', '', '2018', '08', '1534262400', '127.0.0.1', 'XXXX内网IP', '123123', '69', '1534758140');
INSERT INTO `zi_order` VALUES ('21', '苹果iPhone 8 Plus 256G', '银色', '899', '1', 'admin', '13113985742', '湖南省-湘潭市-市辖区，23', '4', '1', '1534347257', null, '2018', '08', '1534262400', '127.0.0.1', 'XXXX内网IP', null, '69', null);
INSERT INTO `zi_order` VALUES ('22', '苹果iPhone 8 Plus 256G', '红色', '899', '1', 'admin', '13113985742', '广东省-揭阳市-榕城区，231', '3', '1', '1534347490', '', '2018', '08', '1534262400', '127.0.0.1', 'XXXX内网IP', '123123123123213123123', '69', null);
INSERT INTO `zi_order` VALUES ('23', '苹果iPhone 8 Plus 256G', '红色', '899', '1', 'admin', '13113985742', '广东省-广州市-荔湾区，1212123', '4', '1', '1534347608', '', '2018', '08', '1534262400', '127.0.0.1', '无法获取', '', '69', '1534756951');
INSERT INTO `zi_order` VALUES ('24', '苹果iPhone 8 Plus 256G', '黑色', '899', '1', 'admin', '13113985742', '湖南省-长沙市-天心区，23123', '4', '1', '1534347663', null, '2018', '08', '1534262400', '127.0.0.1', '无法获取', null, '69', null);
INSERT INTO `zi_order` VALUES ('70', '苹果iPhone 8 Plus 256G', '黑色', '899', '1', 'admin', '13113985742', '天津市-市辖区-和平区，12321321321', '3', '1', '1534430424', '', '2018', '08', '1534348800', '127.0.0.1', '无法获取', '', '69', '1534756919');
INSERT INTO `zi_order` VALUES ('71', '苹果iPhone 8 Plus 256G', '金色', '899', '1', 'admin', '13113985742', '安徽省-合肥市-市辖区，12312', '9', '1', '1534433118', '', '2018', '08', '1534348800', '127.0.0.1', '保留地址', '123', '69', '1534758645');
INSERT INTO `zi_order` VALUES ('72', '苹果iPhone 8 Plus 256G', '黑色', '899', '1', 'admin', '13113985742', '广东省-广州市-市辖区，23', '9', '1', '1534729389', '', '2018', '08', '1534694400', '127.0.0.1', '保留地址', '1231231313123', '69', '1534758630');

-- ----------------------------
-- Table structure for zi_page
-- ----------------------------
DROP TABLE IF EXISTS `zi_page`;
CREATE TABLE `zi_page` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `want_id` int(11) DEFAULT NULL,
  `point_id` int(11) DEFAULT NULL,
  `create_time` int(32) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `update_time` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zi_page
-- ----------------------------
INSERT INTO `zi_page` VALUES ('3', '70', '71', '1533887624', '', '1533887624');

-- ----------------------------
-- Table structure for zi_quan
-- ----------------------------
DROP TABLE IF EXISTS `zi_quan`;
CREATE TABLE `zi_quan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `kong` varchar(255) DEFAULT NULL,
  `fang` varchar(255) DEFAULT NULL,
  `fuji` varchar(255) DEFAULT NULL,
  `create_time` int(32) DEFAULT NULL,
  `update_time` int(32) DEFAULT NULL,
  `guan` int(32) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zi_quan
-- ----------------------------
INSERT INTO `zi_quan` VALUES ('11', '订单列表', null, null, '1', '1534099841', '1534113871', '1');
INSERT INTO `zi_quan` VALUES ('19', '金额统计', null, null, '1', '1534114353', '1534114353', '1');
INSERT INTO `zi_quan` VALUES ('20', '发货管理', null, null, '1', '1534114361', '1534114361', '1');
INSERT INTO `zi_quan` VALUES ('21', '商品列表', null, null, '1', '1534114371', '1534114371', '1');
INSERT INTO `zi_quan` VALUES ('22', '流量列表', null, null, '1', '1534114384', '1534114384', '1');
INSERT INTO `zi_quan` VALUES ('23', '系统列表', null, null, '1', '1534114392', '1534114392', '1');
INSERT INTO `zi_quan` VALUES ('24', '最新订单', 'newest', 'index', '2', '1534114536', '1534114536', '11');
INSERT INTO `zi_quan` VALUES ('25', '全部订单', 'newest', 'whole', '2', '1534114552', '1534114552', '11');
INSERT INTO `zi_quan` VALUES ('26', '有效订单', 'newest', 'tive', '2', '1534114567', '1534114567', '11');
INSERT INTO `zi_quan` VALUES ('27', '无效订单', 'newest', 'invalid', '2', '1534114588', '1534114588', '11');
INSERT INTO `zi_quan` VALUES ('28', '修改', 'newest', 'save_bak', '3', '1534114624', '1534114664', '25');
INSERT INTO `zi_quan` VALUES ('29', '删除', 'newest', 'delete_newest', '3', '1534114713', '1534114713', '25');
INSERT INTO `zi_quan` VALUES ('30', '本月金额', 'newest', 'yue_money', '2', '1534114779', '1534114779', '19');
INSERT INTO `zi_quan` VALUES ('31', '全部金额', 'money', 'money_nian', '2', '1534114806', '1534114806', '19');
INSERT INTO `zi_quan` VALUES ('32', '月份', 'money', 'money_yue', '3', '1534114835', '1534115817', '31');
INSERT INTO `zi_quan` VALUES ('33', '日份', 'money', 'money_ri', '3', '1534114850', '1534115827', '31');
INSERT INTO `zi_quan` VALUES ('34', '发货中', 'newest', 'goods', '2', '1534114905', '1534114905', '20');
INSERT INTO `zi_quan` VALUES ('35', '确定签收', 'newest', 'sign', '2', '1534114921', '1534114921', '20');
INSERT INTO `zi_quan` VALUES ('36', '退货', 'newest', 'retu', '2', '1534114937', '1534114937', '20');
INSERT INTO `zi_quan` VALUES ('37', '静态页面列表', 'goods', 'index', '2', '1534115020', '1534115020', '21');
INSERT INTO `zi_quan` VALUES ('38', '添加', 'goods', 'add', '3', '1534115044', '1534115149', '37');
INSERT INTO `zi_quan` VALUES ('39', '修改', 'goods', 'save', '3', '1534115115', '1534115158', '37');
INSERT INTO `zi_quan` VALUES ('40', 'PV', 'pv', 'yue', '2', '1534115232', '1534115232', '22');
INSERT INTO `zi_quan` VALUES ('41', 'UV', 'Uv', 'yue', '2', '1534115263', '1534115263', '22');
INSERT INTO `zi_quan` VALUES ('42', '查看日期', 'pv', 'ri', '3', '1534115348', '1534115348', '40');
INSERT INTO `zi_quan` VALUES ('43', '展示ip点击数量', 'pv', 'ip', '3', '1534115381', '1534115381', '40');
INSERT INTO `zi_quan` VALUES ('44', '展示针对ip显示当天操作信息', 'pv', 'pv_index', '3', '1534115509', '1534115509', '40');
INSERT INTO `zi_quan` VALUES ('45', '删除月份', 'pv', 'detele_yue', '3', '1534115531', '1534115531', '40');
INSERT INTO `zi_quan` VALUES ('46', '删除日', 'pv', 'detele_ri', '3', '1534115551', '1534115551', '40');
INSERT INTO `zi_quan` VALUES ('47', '删除针对日期的ip', 'pv', 'detele_ip_ri', '3', '1534115571', '1534115571', '40');
INSERT INTO `zi_quan` VALUES ('48', '删除id', 'pv', 'detele_index', '3', '1534115588', '1534115588', '40');
INSERT INTO `zi_quan` VALUES ('49', '删除月份', 'uv', 'delete_yue', '3', '1534115621', '1534115621', '41');
INSERT INTO `zi_quan` VALUES ('50', '查看日期', 'uv', 'ri', '3', '1534115635', '1534115635', '41');
INSERT INTO `zi_quan` VALUES ('51', '查看日期', 'uv', 'ri', '3', '1534115690', '1534115690', '41');
INSERT INTO `zi_quan` VALUES ('52', '查看ip', 'uv', 'ip', '3', '1534115723', '1534115723', '41');
INSERT INTO `zi_quan` VALUES ('53', '账号管理', 'admin', 'index', '2', '1534115894', '1534115894', '23');
INSERT INTO `zi_quan` VALUES ('54', '设置页面跳转', 'page', 'index', '2', '1534115935', '1534115935', '23');
INSERT INTO `zi_quan` VALUES ('55', '设置域名页面', 'level', 'index', '2', '1534115949', '1534115949', '23');
INSERT INTO `zi_quan` VALUES ('56', '添加权限名称', 'quanuser', 'index', '2', '1534115964', '1534147124', '23');
INSERT INTO `zi_quan` VALUES ('57', '添加权限', 'quan', 'index', '2', '1534115988', '1534115988', '23');
INSERT INTO `zi_quan` VALUES ('58', '添加', 'admin', 'add', '3', '1534116018', '1534116018', '53');
INSERT INTO `zi_quan` VALUES ('59', '修改', 'admin', 'save_bak', '3', '1534116037', '1534116037', '53');
INSERT INTO `zi_quan` VALUES ('60', '删除', 'admin', 'delete_admin', '3', '1534116054', '1534116054', '53');
INSERT INTO `zi_quan` VALUES ('61', '添加', 'page', 'add', '3', '1534116088', '1534116088', '54');
INSERT INTO `zi_quan` VALUES ('62', '修改', 'page', 'save', '3', '1534116116', '1534116116', '54');
INSERT INTO `zi_quan` VALUES ('63', '删除', 'page', 'delete_page', '3', '1534116135', '1534116135', '54');
INSERT INTO `zi_quan` VALUES ('64', '添加', 'level', 'add', '3', '1534116478', '1534116478', '55');
INSERT INTO `zi_quan` VALUES ('65', '修改', 'level', 'save', '3', '1534116497', '1534116497', '55');
INSERT INTO `zi_quan` VALUES ('66', '删除', 'level', 'delete_level', '3', '1534116546', '1534116546', '55');
INSERT INTO `zi_quan` VALUES ('67', '添加', 'quan', 'add', '3', '1534116641', '1534116641', '57');
INSERT INTO `zi_quan` VALUES ('68', '修改', 'quan', 'save_bak', '3', '1534116655', '1534116655', '57');
INSERT INTO `zi_quan` VALUES ('69', '删除', 'quan', 'delete_bak', '3', '1534116666', '1534116666', '57');
INSERT INTO `zi_quan` VALUES ('70', '删除', 'goods', 'delete_goods', null, '1534147416', '1534147416', '37');
INSERT INTO `zi_quan` VALUES ('71', '再联系', 'newest', 'liax', '2', '1534345417', '1534389306', '11');
INSERT INTO `zi_quan` VALUES ('72', '未发货', 'newest', 'delivery', '2', '1534389551', '1534389551', '11');
INSERT INTO `zi_quan` VALUES ('73', '未处理', 'newest', 'handle', '2', '1534390952', '1534390952', '11');
INSERT INTO `zi_quan` VALUES ('74', '数据汇总', null, null, '1', '1534517888', '1534517888', '1');
INSERT INTO `zi_quan` VALUES ('75', '订单汇总', 'summary', 'order', '2', '1534517928', '1534518097', '74');
INSERT INTO `zi_quan` VALUES ('76', '待审核', 'newest', 'audited', '2', '1534563183', '1534563183', '11');
INSERT INTO `zi_quan` VALUES ('77', '垃圾单', 'newest', 'garbage', '2', '1534734740', '1534734740', '11');
INSERT INTO `zi_quan` VALUES ('78', '拒收', 'newest', 'tion', '2', '1534754948', '1534757307', '11');

-- ----------------------------
-- Table structure for zi_quanuser
-- ----------------------------
DROP TABLE IF EXISTS `zi_quanuser`;
CREATE TABLE `zi_quanuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameuser` varchar(255) DEFAULT NULL,
  `quan` varchar(255) DEFAULT NULL,
  `create_time` int(32) DEFAULT NULL,
  `update_time` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zi_quanuser
-- ----------------------------
INSERT INTO `zi_quanuser` VALUES ('1', '超级管理员', '0', '1534133309', '1534133309');
INSERT INTO `zi_quanuser` VALUES ('7', '客服', '11,24,25,26,27,19,30,31,32,33,20,34,35,36,22,40,42,43,41,50,51,52', '1534143552', '1534143552');
