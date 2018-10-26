/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : jxc

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-11-04 10:15:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `vich_codes`
-- ----------------------------
DROP TABLE IF EXISTS `vich_codes`;
CREATE TABLE `vich_codes` (
  `code` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `createUser` int(11) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=1502174039 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vich_codes
-- ----------------------------
INSERT INTO `vich_codes` VALUES ('1502174001', '27');
INSERT INTO `vich_codes` VALUES ('1502174038', '1');

-- ----------------------------
-- Table structure for `vich_companys`
-- ----------------------------
DROP TABLE IF EXISTS `vich_companys`;
CREATE TABLE `vich_companys` (
  `companyId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '公司ID',
  `companyName` varchar(255) NOT NULL COMMENT '公司名称',
  `companyAddress` varchar(255) NOT NULL COMMENT '公司地址',
  `companyTel` varchar(255) DEFAULT NULL COMMENT '公司电话',
  `companyUserName` varchar(255) NOT NULL COMMENT '公司联系人',
  `companyUserPhone` varchar(255) NOT NULL COMMENT '公司联系人电话',
  `companyUserEmail` varchar(255) DEFAULT NULL COMMENT '公司联系人邮箱',
  `companyUserQQ` varchar(255) DEFAULT NULL COMMENT '公司联系人QQ',
  `flag` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未审核 1已审核 -1删除',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL COMMENT '创建人',
  `createTime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`companyId`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='公司表';

-- ----------------------------
-- Records of vich_companys
-- ----------------------------
INSERT INTO `vich_companys` VALUES ('32', '无锡刘潭服装有限公司', '测试', '05108899778', '测试', '13033312369', '13033312369@qq.com', '13033312369', '1', '0', '1', '2017-08-01 10:36:56');
INSERT INTO `vich_companys` VALUES ('37', '无锡刘潭服装有限公司(亳州)', 'xxxxx', '010-6666666', '王二', '13666666666', 'test@example.com', '136666666666', '1', '32', '27', '2017-07-30 21:13:40');
INSERT INTO `vich_companys` VALUES ('38', '柬埔寨', '柬埔寨', '0510-22222222', '柬埔', '13666666666', '13666666666@163.com', '13666666666', '1', '32', '1', '2017-09-14 14:03:55');
INSERT INTO `vich_companys` VALUES ('39', '无锡刘潭服装有限公司', '有限公司', '05108899778', '李二', '13589569885', '13589569885@qq.com', '13589569885', '1', '32', '1', '2017-11-03 15:18:38');
INSERT INTO `vich_companys` VALUES ('40', '测试', '测试', '0510-6666666', '测试', '13564111240', '13564111240@qq.com', '907914683', '1', '32', '1', '2017-11-04 10:03:34');

-- ----------------------------
-- Table structure for `vich_customers`
-- ----------------------------
DROP TABLE IF EXISTS `vich_customers`;
CREATE TABLE `vich_customers` (
  `customerId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customerName` varchar(255) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `customerUserName` varchar(255) NOT NULL,
  `customerUserPhone` varchar(255) NOT NULL,
  `customerUserEmail` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`customerId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='客户表';

-- ----------------------------
-- Records of vich_customers
-- ----------------------------
INSERT INTO `vich_customers` VALUES ('2', '测试', '中文2', '中文', '13912382811', '11@qq.com', '1', '0', '1', '2017-08-06 16:40:49');
INSERT INTO `vich_customers` VALUES ('3', '测试1', '测试2', '测试', '13584617265', '13584617265@qq.com', '-1', '32', '1', '2017-11-03 15:24:35');

-- ----------------------------
-- Table structure for `vich_departments`
-- ----------------------------
DROP TABLE IF EXISTS `vich_departments`;
CREATE TABLE `vich_departments` (
  `departmentId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '部门ID',
  `departmentName` varchar(255) NOT NULL COMMENT '部门名称',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`departmentId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='部门表';

-- ----------------------------
-- Records of vich_departments
-- ----------------------------
INSERT INTO `vich_departments` VALUES ('9', '生产部', '生产部', '1', '0', '1', '2017-08-01 10:34:18');
INSERT INTO `vich_departments` VALUES ('11', '采购部', '采购部', '1', '0', '1', '2017-08-01 10:34:43');
INSERT INTO `vich_departments` VALUES ('12', '仓库部', '仓库部', '1', '0', '1', '2017-08-01 10:35:09');
INSERT INTO `vich_departments` VALUES ('13', '销售部', '销售部', '1', '0', '1', '2017-08-01 10:35:17');
INSERT INTO `vich_departments` VALUES ('14', '财务部', '财务部', '1', '0', '1', '2017-08-01 10:35:27');

-- ----------------------------
-- Table structure for `vich_depots`
-- ----------------------------
DROP TABLE IF EXISTS `vich_depots`;
CREATE TABLE `vich_depots` (
  `depotId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '仓库ID',
  `depotName` varchar(255) NOT NULL COMMENT '仓库名称',
  `depotNo` varchar(20) DEFAULT NULL COMMENT '仓库编码',
  `companyId` int(11) NOT NULL COMMENT '所属公司',
  `employeeId` int(11) NOT NULL COMMENT '仓库负责人',
  `isDefault` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 默认 0非默认',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`depotId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='仓库表';

-- ----------------------------
-- Records of vich_depots
-- ----------------------------
INSERT INTO `vich_depots` VALUES ('10', '仓库01', '132465', '0', '13', '0', '1', '32', '1', '2017-09-07 13:33:53');
INSERT INTO `vich_depots` VALUES ('11', '仓库02', null, '0', '11', '0', '1', '32', '1', '2017-09-07 13:37:55');
INSERT INTO `vich_depots` VALUES ('12', '仓库03', '123456', '0', '11', '0', '1', '32', '1', '2017-09-07 13:39:01');
INSERT INTO `vich_depots` VALUES ('13', '11', '12', '0', '11', '0', '-1', '32', '1', '2017-10-12 11:41:56');
INSERT INTO `vich_depots` VALUES ('14', '仓库04', 'G1', '0', '20', '0', '-1', '32', '1', '2017-11-03 15:21:27');

-- ----------------------------
-- Table structure for `vich_depot_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_depot_goods`;
CREATE TABLE `vich_depot_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `batchNo` varchar(255) DEFAULT NULL COMMENT '入库批次',
  `depotId` int(11) NOT NULL COMMENT '仓库',
  `depotSubId` int(11) NOT NULL COMMENT '库位',
  `supplierId` int(11) DEFAULT NULL,
  `goodsId` int(11) NOT NULL COMMENT '商品ID',
  `goodsPrice` decimal(10,2) DEFAULT '0.00',
  `goodsCnt` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `flag` tinyint(4) DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='仓库商品表';

-- ----------------------------
-- Records of vich_depot_goods
-- ----------------------------
INSERT INTO `vich_depot_goods` VALUES ('7', 'PN1709082238527438', '10', '6', '12', '23', '10.00', '3', '1', '32', '1', '2017-09-08 22:48:21');
INSERT INTO `vich_depot_goods` VALUES ('8', 'PN1709082251052391', '10', '6', '12', '23', '15.00', '0', '1', '32', '1', '2017-09-08 22:52:43');
INSERT INTO `vich_depot_goods` VALUES ('9', 'PN1709082257501516', '10', '6', '11', '22', '10.00', '1', '1', '32', '1', '2017-09-08 22:58:02');
INSERT INTO `vich_depot_goods` VALUES ('10', 'PN1710180947345117', '10', '6', '12', '22', '10.00', '0', '1', '32', '1', '2017-10-18 09:47:47');
INSERT INTO `vich_depot_goods` VALUES ('11', 'PN1711031542407799', '0', '6', '11', '28', '20.00', '10', '1', '32', '1', '2017-11-03 15:43:29');
INSERT INTO `vich_depot_goods` VALUES ('12', 'PN1711031542588202', '0', '6', '11', '27', '5.00', '1', '1', '32', '1', '2017-11-03 15:43:29');

-- ----------------------------
-- Table structure for `vich_depot_subs`
-- ----------------------------
DROP TABLE IF EXISTS `vich_depot_subs`;
CREATE TABLE `vich_depot_subs` (
  `depotSubId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '库位ID',
  `depotId` int(11) NOT NULL COMMENT '所属仓库',
  `depotSubName` varchar(255) NOT NULL COMMENT '库位名称',
  `depotSubNo` varchar(255) DEFAULT NULL COMMENT '库位编码',
  `companyId` int(11) DEFAULT NULL COMMENT '所属公司',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`depotSubId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='库位表';

-- ----------------------------
-- Records of vich_depot_subs
-- ----------------------------
INSERT INTO `vich_depot_subs` VALUES ('6', '10', 'A库位', null, '32', '1', '32', '1', '2017-09-07 13:37:16');
INSERT INTO `vich_depot_subs` VALUES ('7', '10', 'B库位', null, '32', '1', '32', '1', '2017-09-07 13:37:33');
INSERT INTO `vich_depot_subs` VALUES ('8', '11', 'C库位', null, '37', '1', '32', '1', '2017-09-07 13:38:16');
INSERT INTO `vich_depot_subs` VALUES ('9', '11', 'D库位', '1231561', '32', '1', '32', '1', '2017-09-07 13:38:27');
INSERT INTO `vich_depot_subs` VALUES ('10', '12', 'E库位', null, '37', '1', '32', '1', '2017-09-07 13:39:16');
INSERT INTO `vich_depot_subs` VALUES ('11', '12', 'F库位', null, '32', '1', '32', '1', '2017-09-07 13:39:27');
INSERT INTO `vich_depot_subs` VALUES ('12', '14', 'G库位', 'G1', '32', '-1', '32', '1', '2017-11-03 15:22:05');

-- ----------------------------
-- Table structure for `vich_employees`
-- ----------------------------
DROP TABLE IF EXISTS `vich_employees`;
CREATE TABLE `vich_employees` (
  `employeeId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '员工ID',
  `companyId` int(11) NOT NULL COMMENT '公司',
  `departmentId` int(11) NOT NULL COMMENT '部门ID',
  `employeeName` varchar(255) NOT NULL COMMENT '员工姓名',
  `employeeAddress` varchar(255) NOT NULL COMMENT '员工住址',
  `employeePhone` varchar(255) NOT NULL COMMENT '员工电话',
  `employeeEmail` varchar(255) DEFAULT NULL COMMENT '员工邮箱',
  `employeeQQ` varchar(255) DEFAULT NULL COMMENT '员工QQ',
  `employeeJob` varchar(255) NOT NULL COMMENT '职务',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`employeeId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='员工表';

-- ----------------------------
-- Records of vich_employees
-- ----------------------------
INSERT INTO `vich_employees` VALUES ('11', '32', '12', '李四', 'xxxxxxxxx', '13912382811', 'test@qq.com', '1000000000', '部门经理', '1', '32', '1', '2017-08-01 11:43:05');
INSERT INTO `vich_employees` VALUES ('13', '32', '9', '刘欣', 'xxxxxxxxx', '18755676654', '123@qq.com', '1123443244', '技术员', '1', '32', '1', '2017-08-02 09:15:31');
INSERT INTO `vich_employees` VALUES ('20', '32', '11', '采购员一', 'xxxxxx', '13666666666', '13666666666@163.com', '909999999', '采购员', '1', '32', '1', '2017-09-07 17:05:56');
INSERT INTO `vich_employees` VALUES ('21', '38', '12', '仓库员', '测试', '13666666666', '13666666666@163.com', '13666666666', '仓库管理', '1', '32', '1', '2017-09-14 14:04:53');
INSERT INTO `vich_employees` VALUES ('22', '32', '11', '李二', '**************', '13589568955', '13589568955@qq.com', '13589568955', '采购员', '1', '32', '1', '2017-11-03 15:16:36');

-- ----------------------------
-- Table structure for `vich_finance`
-- ----------------------------
DROP TABLE IF EXISTS `vich_finance`;
CREATE TABLE `vich_finance` (
  `financeId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate` varchar(11) DEFAULT '0' COMMENT '0其他1水费2电费3物流4工资5餐饮6配送7社保8采购9销售10固定资产',
  `type` tinyint(11) NOT NULL COMMENT '1支出 2收入',
  `targetId` int(11) NOT NULL COMMENT '对象Id',
  `invoiceIds` varchar(255) DEFAULT '0' COMMENT '发票Id',
  `companyId` int(11) DEFAULT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`financeId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='财务';

-- ----------------------------
-- Records of vich_finance
-- ----------------------------
INSERT INTO `vich_finance` VALUES ('1', '8', '1', '12', '1,2', '32', '250.00', '', '1', '32', '1', '2017-09-09 00:32:35');
INSERT INTO `vich_finance` VALUES ('4', '8', '1', '11', '3', '32', '120.00', '', '1', '32', '1', '2017-10-17 16:47:06');
INSERT INTO `vich_finance` VALUES ('5', '9', '2', '2', '4', '32', '10.00', '', '1', '32', '1', '2017-10-17 16:54:30');
INSERT INTO `vich_finance` VALUES ('6', '2', '1', '0', '0', '32', '10.00', '1', '1', '32', '1', '2017-10-17 18:14:01');
INSERT INTO `vich_finance` VALUES ('7', '3', '1', '0', '0', '32', '20.00', '000', '1', '32', '1', '2017-11-03 15:35:55');

-- ----------------------------
-- Table structure for `vich_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_goods`;
CREATE TABLE `vich_goods` (
  `goodsId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `goodsSn` varchar(255) NOT NULL COMMENT '商品货号',
  `goodsBarCode` varchar(255) DEFAULT NULL COMMENT '条形码',
  `goodsName` varchar(255) NOT NULL COMMENT '商品名称',
  `goodsSpec` varchar(255) DEFAULT NULL COMMENT '规格',
  `goodsCateId1` int(11) DEFAULT NULL COMMENT '一级分类Id',
  `goodsCateId2` int(11) DEFAULT NULL COMMENT '二级分类Id',
  `goodsCateId` int(11) NOT NULL COMMENT '三级分类ID',
  `goodsUnitId` int(11) NOT NULL COMMENT '单位ID',
  `lastPrice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '上次进价',
  `minPrice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '历史最低价',
  `maxPrice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '历史最高价',
  `avgPrice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '平均采购价',
  `searchKey` varchar(255) DEFAULT NULL COMMENT '助记词 用于快速查询',
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  `productionDate` date DEFAULT NULL,
  `invalidDate` date DEFAULT NULL,
  PRIMARY KEY (`goodsId`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of vich_goods
-- ----------------------------
INSERT INTO `vich_goods` VALUES ('22', 'S00000001', '1502174002', '白圆铅笔', '22*18*7   20支/盒', '22', '16', '23', '14', '10.00', '10.00', '10.00', '10.00', '笔', '', '1', '32', '1', '2017-09-07 10:31:31', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('23', 'S00000002', '1502174003', '6B、HB、2B、3B铅笔', '18*22*7 20支/盒', '22', '16', '23', '14', '15.00', '10.00', '15.00', '12.50', '铅笔', '', '1', '32', '1', '2017-09-07 10:33:28', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('24', 'S00000003', '1502174004', '圆珠笔', '14*7*3 12支/盒', '22', '16', '24', '14', '0.00', '0.00', '0.00', '0.00', '笔', '', '1', '32', '1', '2017-09-07 10:35:28', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('25', 'S00000004', '1502174005', '水溶性笔芯', '12*15 100支/袋', '22', '16', '24', '15', '0.00', '0.00', '0.00', '0.00', '笔芯', '', '1', '32', '1', '2017-09-07 10:42:19', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('26', 'S00000005', '1502174006', '记号笔', '15*9*3 10支/盒', '22', '16', '24', '14', '0.00', '0.00', '0.00', '0.00', ' ', '', '1', '32', '1', '2017-09-07 10:42:19', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('27', 'S00000006', '1502174007', '双头记号笔', '15*7*3 10支/盒', '22', '16', '24', '14', '5.00', '5.00', '5.00', '5.00', '', '', '1', '32', '1', '2017-09-07 10:42:19', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('28', 'S00000007', '1502174008', '白板笔', '14*9*4 10支/盒', '22', '16', '24', '14', '20.00', '20.00', '20.00', '20.00', '', '', '1', '32', '1', '2017-09-07 10:42:19', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('29', 'S00000008', '1502174009', '水笔   （黑/红）', '15*7*3 12支/盒', '22', '16', '24', '14', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 10:42:19', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('30', 'S00000009', '1502174010', '水笔芯（黑/红）', '15*5*5 20支/盒', '22', '16', '24', '14', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 10:42:19', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('31', 'S00000010', '1502174011', '水溶性笔芯', '12*15 100支/袋', '22', '16', '24', '15', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 10:42:19', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('32', 'S00000011', '1502174012', '按动水笔', '15*8*2 12支/盒', '22', '16', '24', '14', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:00:32', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('33', 'S00000012', '1502174013', '高温消矢笔', '14*9*3 100支/袋', '22', '16', '24', '16', '0.00', '0.00', '0.00', '0.00', '', '以后不用，库存', '1', '32', '1', '2017-09-07 11:00:39', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('34', 'S00000013', '1502174014', '清洗笔', '13*10*4 10支/盒', '22', '16', '24', '14', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:00:41', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('35', 'S00000014', '1502174015', '橡皮', '15*13*4 30块/盒', '22', '16', '24', '14', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:00:44', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('36', 'S00000015', '1502174016', '退色笔 粗', '30*27 100支/袋', '22', '16', '24', '15', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:00:47', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('37', 'S00000016', '1502174017', '褪色笔 细', '30*27 12支/袋', '22', '16', '24', '15', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:00:49', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('40', 'S00000017', '1502174018', '回形针', '14*8*6 10小盒/盒', '22', '17', '29', '14', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:11:41', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('41', 'S00000018', '1502174019', '大头针 ', '14*8*6 10小盒/盒', '22', '17', '29', '14', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:11:44', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('42', 'S00000019', '1502174020', '订书钉（大）', '14*7*4 10小盒/盒', '22', '17', '29', '14', '0.00', '0.00', '0.00', '0.00', null, null, '1', '32', '1', '2017-09-07 11:11:47', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('43', 'S00000020', '1502174021', '订书钉（中）', '14*7*4 10小盒/盒', '22', '17', '29', '14', '0.00', '0.00', '0.00', '0.00', null, null, '1', '32', '1', '2017-09-07 11:11:50', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('44', 'S00000021', '1502174022', '订书钉（小）', '14*7*4 10小盒/盒', '22', '17', '29', '14', '0.00', '0.00', '0.00', '0.00', null, null, '1', '32', '1', '2017-09-07 11:11:53', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('45', 'S00000022', '1502174023', '装订夹', '20*8*2 50付/盒', '22', '17', '30', '14', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:11:55', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('46', 'S00000023', '1502174024', '订书机', '13*7*4 ', '22', '17', '31', '17', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:11:58', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('47', 'S00000024', '1502174025', '打孔机', '13*9*6 ', '22', '17', '32', '17', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:12:01', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('48', 'S00000025', '1502174026', '加厚订书钉', '8*7*2 ', '22', '17', '29', '14', '0.00', '0.00', '0.00', '0.00', null, '用量及少、库存', '1', '32', '1', '2017-09-07 11:12:03', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('49', 'S00000026', '1502174027', '90*120白板', ' ', '22', '17', '33', '11', '0.00', '0.00', '0.00', '0.00', '', '按需采购，虚拟库位', '1', '32', '1', '2017-09-07 11:12:06', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('50', 'S00000027', '1502174028', '挂锁', ' ', '22', '17', '34', '11', '0.00', '0.00', '0.00', '0.00', '', '按需采购，虚拟库位', '1', '32', '1', '2017-09-07 11:12:09', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('51', 'S00000028', '1502174029', '文件架', '35*34', '22', '18', '35', '17', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:25:57', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('52', 'S00000029', '1502174030', '得力文件夹', '25*30*35 12个箱', '22', '18', '36', '18', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:26:00', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('53', 'S00000030', '1502174031', '拉杆文件夹（厚）', '32*34 10只/袋', '22', '18', '36', '15', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:26:03', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('54', 'S00000031', '1502174033', '拉杆文件夹（薄）', '32*34 10只/袋', '22', '18', '36', '15', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-09-07 11:26:08', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('55', 'S00000031', '1502174034', '红复写纸', '35*24', '22', '26', '27', '14', '0.00', '0.00', '0.00', '0.00', '红复写纸', '用量及少、库存', '1', '32', '1', '2017-10-11 11:25:50', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('56', 'S00000032', '1502174035', '文件夹', '25*35', '22', '18', '36', '11', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-11-03 15:06:23', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('57', '102222222', '1502174036', '测试商品', '1cm', '22', '16', '24', '11', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-11-04 09:52:27', '2017-11-04', '2020-11-04');
INSERT INTO `vich_goods` VALUES ('58', '33333333', '1502174037', '测试商品2', '2cm', '22', '16', '23', '11', '0.00', '0.00', '0.00', '0.00', '', '', '1', '32', '1', '2017-11-04 10:00:11', '2017-11-01', '2017-11-07');

-- ----------------------------
-- Table structure for `vich_goods_cates`
-- ----------------------------
DROP TABLE IF EXISTS `vich_goods_cates`;
CREATE TABLE `vich_goods_cates` (
  `cateId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '产品分类ID',
  `parentId` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `ppid` int(11) DEFAULT NULL COMMENT '一级分类Id',
  `cateNo` varchar(255) NOT NULL COMMENT '分类编号',
  `cateName` varchar(255) NOT NULL COMMENT '分类名称',
  `cateSort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`cateId`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- ----------------------------
-- Records of vich_goods_cates
-- ----------------------------
INSERT INTO `vich_goods_cates` VALUES ('16', '22', '0', '10', '笔类', '1', '1', '32', '1', '2017-09-07 09:38:54');
INSERT INTO `vich_goods_cates` VALUES ('17', '22', '0', '20', '装订类', '2', '1', '32', '1', '2017-09-07 09:39:15');
INSERT INTO `vich_goods_cates` VALUES ('18', '22', '0', '30', '文件夹类', '3', '1', '32', '1', '2017-09-07 09:41:49');
INSERT INTO `vich_goods_cates` VALUES ('19', '0', '0', '22', '测试', '1', '-1', '32', '1', '2017-10-10 15:15:11');
INSERT INTO `vich_goods_cates` VALUES ('20', '19', '0', '222', '测试1', '1', '-1', '32', '1', '2017-10-10 15:15:31');
INSERT INTO `vich_goods_cates` VALUES ('21', '20', '19', '2222', '测试3', '1', '-1', '32', '1', '2017-10-10 15:15:47');
INSERT INTO `vich_goods_cates` VALUES ('22', '0', '0', '001', '办公用品', '1', '1', '32', '1', '2017-10-11 09:39:12');
INSERT INTO `vich_goods_cates` VALUES ('23', '16', '22', '0112', '铅笔', '1', '1', '32', '1', '2017-10-11 10:26:53');
INSERT INTO `vich_goods_cates` VALUES ('24', '16', '22', '01231', '中性笔', '1', '1', '32', '1', '2017-10-11 10:27:39');
INSERT INTO `vich_goods_cates` VALUES ('25', '16', '22', '0123', '钢笔', '1', '1', '32', '1', '2017-10-11 10:28:01');
INSERT INTO `vich_goods_cates` VALUES ('26', '22', '0', '123', '文本纸类', '1', '1', '32', '1', '2017-10-11 11:23:32');
INSERT INTO `vich_goods_cates` VALUES ('27', '26', '22', '2335', '复写纸', '1', '1', '32', '1', '2017-10-11 11:23:48');
INSERT INTO `vich_goods_cates` VALUES ('28', '26', '22', '31264', '复印纸', '1', '1', '32', '1', '2017-10-11 11:24:09');
INSERT INTO `vich_goods_cates` VALUES ('29', '17', '22', '00000', '针订', '1', '1', '32', '1', '2017-10-11 12:18:02');
INSERT INTO `vich_goods_cates` VALUES ('30', '17', '22', '03211', '装订夹', '1', '1', '32', '1', '2017-10-11 12:23:23');
INSERT INTO `vich_goods_cates` VALUES ('31', '17', '22', '134156', '订书机', '1', '1', '32', '1', '2017-10-11 12:23:41');
INSERT INTO `vich_goods_cates` VALUES ('32', '17', '22', '7815', '打孔机', '1', '1', '32', '1', '2017-10-11 12:23:53');
INSERT INTO `vich_goods_cates` VALUES ('33', '17', '22', '1231', '白板', '1', '1', '32', '1', '2017-10-11 12:24:49');
INSERT INTO `vich_goods_cates` VALUES ('34', '17', '22', '123454', '挂锁', '1', '1', '32', '1', '2017-10-11 12:25:07');
INSERT INTO `vich_goods_cates` VALUES ('35', '18', '22', '0546', '文件架', '1', '1', '32', '1', '2017-10-11 12:48:47');
INSERT INTO `vich_goods_cates` VALUES ('36', '18', '22', '0322', '文件夹', '1', '1', '32', '1', '2017-10-11 12:49:11');
INSERT INTO `vich_goods_cates` VALUES ('37', '0', '0', '135252', '机物料', '1', '1', '32', '1', '2017-10-11 15:05:23');
INSERT INTO `vich_goods_cates` VALUES ('38', '16', '22', '020', '橡皮', '1', '-1', '32', '1', '2017-11-03 15:07:46');
INSERT INTO `vich_goods_cates` VALUES ('39', '16', '22', '29831231', '毛笔', '1', '-1', '32', '1', '2017-11-04 10:01:30');

-- ----------------------------
-- Table structure for `vich_goods_conf`
-- ----------------------------
DROP TABLE IF EXISTS `vich_goods_conf`;
CREATE TABLE `vich_goods_conf` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(11) DEFAULT NULL,
  `sets` text,
  `default` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vich_goods_conf
-- ----------------------------
INSERT INTO `vich_goods_conf` VALUES ('1', '32', '{\"goodsSn\":{\"top\":\"0\",\"left\":\"0\",\"offsetTop\":\"0\",\"offsetLeft\":\"0\",\"initTop\":\"0\",\"initLeft\":\"0\",\"height\":\"0\",\"width\":\"0\"},\"goodsName\":{\"top\":\"0\",\"left\":\"0\",\"offsetTop\":\"0\",\"offsetLeft\":\"0\",\"initTop\":\"0\",\"initLeft\":\"0\",\"height\":\"0\",\"width\":\"0\"},\"cateName\":{\"top\":\"226\",\"left\":\"592\",\"offsetTop\":\"181\",\"offsetLeft\":\"114\",\"initTop\":\"87\",\"initLeft\":\"20\",\"height\":\"16\",\"width\":\"56\"},\"goodsQRCode\":{\"top\":\"0\",\"left\":\"0\",\"offsetTop\":\"0\",\"offsetLeft\":\"0\",\"initTop\":\"0\",\"initLeft\":\"0\",\"height\":\"0\",\"width\":\"0\"},\"goodsBarCode\":{\"top\":\"98\",\"left\":\"536\",\"offsetTop\":\"53\",\"offsetLeft\":\"58\",\"initTop\":\"210\",\"initLeft\":\"20\",\"height\":\"51\",\"width\":\"178\"},\"printArea\":\"300\"}', '1');

-- ----------------------------
-- Table structure for `vich_goods_units`
-- ----------------------------
DROP TABLE IF EXISTS `vich_goods_units`;
CREATE TABLE `vich_goods_units` (
  `unitId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品单位ID',
  `unitName` varchar(255) NOT NULL COMMENT '商品单位名称',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL,
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`unitId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='商品单位表';

-- ----------------------------
-- Records of vich_goods_units
-- ----------------------------
INSERT INTO `vich_goods_units` VALUES ('11', '件', '1', '0', '1', '2017-08-03 13:26:18');
INSERT INTO `vich_goods_units` VALUES ('12', '个', '1', '0', '1', '2017-08-03 13:26:24');
INSERT INTO `vich_goods_units` VALUES ('14', '盒', '1', '32', '1', '2017-09-07 10:29:03');
INSERT INTO `vich_goods_units` VALUES ('15', '袋', '1', '32', '1', '2017-09-07 10:41:00');
INSERT INTO `vich_goods_units` VALUES ('16', '支', '1', '32', '1', '2017-09-07 10:54:31');
INSERT INTO `vich_goods_units` VALUES ('17', '只', '1', '32', '1', '2017-09-07 11:08:12');
INSERT INTO `vich_goods_units` VALUES ('18', '箱', '1', '32', '1', '2017-09-07 11:17:53');
INSERT INTO `vich_goods_units` VALUES ('19', '瓶', '1', '32', '1', '2017-11-03 15:23:27');

-- ----------------------------
-- Table structure for `vich_invoices`
-- ----------------------------
DROP TABLE IF EXISTS `vich_invoices`;
CREATE TABLE `vich_invoices` (
  `invoiceId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoiceNo` varchar(255) NOT NULL,
  `orderId` int(11) NOT NULL,
  `supplierId` int(11) NOT NULL COMMENT '采购发票->供应商id 销售发票->客户id',
  `totalMoney` decimal(10,2) NOT NULL,
  `endTime` datetime DEFAULT NULL,
  `noticeTime` datetime DEFAULT NULL,
  `companyId` int(11) NOT NULL,
  `financeId` int(11) NOT NULL DEFAULT '0' COMMENT '财务流水Id',
  `payStatus` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未付款 1已付款',
  `invoiceStatus` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未收票 1已收票',
  `flag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1',
  `createTime` datetime NOT NULL,
  `createUser` int(11) NOT NULL,
  `createCompany` int(11) NOT NULL,
  `type` enum('2','1') DEFAULT '1' COMMENT '1采购发票 2销售发票',
  `remark` tinytext,
  `invoiceImg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`invoiceId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='采购发票表';

-- ----------------------------
-- Records of vich_invoices
-- ----------------------------
INSERT INTO `vich_invoices` VALUES ('1', 'IN1709082248218745', '1', '12', '100.00', '2017-09-13 00:00:00', '2017-09-08 00:00:00', '32', '1', '1', '0', '1', '2017-09-08 22:48:21', '1', '32', '1', null, null);
INSERT INTO `vich_invoices` VALUES ('2', 'IN1709082252437384', '2', '12', '150.00', '2017-09-13 00:00:00', '2017-09-08 00:00:00', '32', '1', '1', '0', '1', '2017-09-08 22:52:43', '1', '32', '1', null, null);
INSERT INTO `vich_invoices` VALUES ('3', 'IN1709082258023298', '3', '11', '120.00', null, null, '32', '4', '1', '0', '1', '2017-09-08 22:58:02', '1', '32', '1', null, null);
INSERT INTO `vich_invoices` VALUES ('4', 'IN1710171437356135', '4', '2', '10.00', null, null, '32', '5', '1', '0', '1', '2017-10-17 14:37:35', '1', '32', '2', null, null);
INSERT INTO `vich_invoices` VALUES ('5', 'IN1710180947476481', '4', '12', '100.00', '2017-10-26 00:00:00', '2017-10-28 00:00:00', '32', '0', '0', '1', '1', '2017-10-18 09:47:47', '1', '32', '1', '12', 'upload/20171018/dce9c83744a5c83d9ebf193911551331.jpeg');
INSERT INTO `vich_invoices` VALUES ('6', 'IN1711031543298728', '7', '11', '205.00', null, null, '32', '0', '0', '0', '1', '2017-11-03 15:43:29', '1', '32', '1', null, null);

-- ----------------------------
-- Table structure for `vich_logs_depot`
-- ----------------------------
DROP TABLE IF EXISTS `vich_logs_depot`;
CREATE TABLE `vich_logs_depot` (
  `logId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `logUser` int(11) DEFAULT NULL,
  `logType` tinyint(4) DEFAULT '1' COMMENT '1入库 2 出库',
  `logContent` text,
  `depotId` int(11) DEFAULT NULL,
  `orderId` int(11) DEFAULT NULL,
  `orderType` varchar(255) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`logId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='商品出入库日志';

-- ----------------------------
-- Records of vich_logs_depot
-- ----------------------------
INSERT INTO `vich_logs_depot` VALUES ('7', '1', '1', '[{\"batchNo\":\"PN1709082238527438\",\"depotId\":\"10\",\"depotSubId\":\"6\",\"supplierId\":\"12\",\"goodsId\":\"23\",\"goodsPrice\":\"10.00\",\"goodsCnt\":\"10\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 22:48:21\"}]', null, '1', 'PURCHASE_IN', '2017-09-08 22:48:21');
INSERT INTO `vich_logs_depot` VALUES ('8', '1', '1', '[{\"batchNo\":\"PN1709082251052391\",\"depotId\":\"10\",\"depotSubId\":\"6\",\"supplierId\":\"12\",\"goodsId\":\"23\",\"goodsPrice\":\"15.00\",\"goodsCnt\":\"10\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 22:52:43\"}]', null, '2', 'PURCHASE_IN', '2017-09-08 22:52:43');
INSERT INTO `vich_logs_depot` VALUES ('9', '1', '1', '[{\"batchNo\":\"PN1709082257501516\",\"depotId\":\"10\",\"depotSubId\":\"6\",\"supplierId\":\"11\",\"goodsId\":\"22\",\"goodsPrice\":\"10.00\",\"goodsCnt\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 22:58:02\"}]', null, '3', 'PURCHASE_IN', '2017-09-08 22:58:02');
INSERT INTO `vich_logs_depot` VALUES ('10', '1', '2', '[{\"id\":\"9\",\"depotSubId\":\"6\",\"batchNo\":\"PN1709082257501516\",\"goodsCnt\":\"10\"}]', '10', '1', 'USE_OUT', '2017-09-08 23:53:32');
INSERT INTO `vich_logs_depot` VALUES ('11', '1', '1', '[{\"id\":\"9\",\"batchNo\":\"PN1709082257501516\",\"depotSubId\":\"6\",\"goodsCnt\":\"1\"}]', '10', '1', 'OTHER_IN', '2017-09-09 00:29:04');
INSERT INTO `vich_logs_depot` VALUES ('12', '1', '2', '[{\"id\":\"7\",\"depotSubId\":\"6\",\"batchNo\":\"PN1709082238527438\",\"goodsCnt\":\"5\"},{\"id\":\"8\",\"depotSubId\":\"6\",\"batchNo\":\"PN1709082251052391\",\"goodsCnt\":\"10\"},{\"id\":\"9\",\"depotSubId\":\"6\",\"batchNo\":\"PN1709082257501516\",\"goodsCnt\":\"3\"}]', '10', '3', 'USE_OUT', '2017-09-23 09:31:18');
INSERT INTO `vich_logs_depot` VALUES ('13', '1', '1', '[{\"id\":\"9\",\"batchNo\":\"PN1709082257501516\",\"depotSubId\":\"6\",\"goodsCnt\":\"1\"}]', '10', '2', 'OTHER_IN', '2017-10-11 17:44:10');
INSERT INTO `vich_logs_depot` VALUES ('14', '1', '2', '[{\"id\":\"7\",\"depotSubId\":\"6\",\"batchNo\":\"PN1709082238527438\",\"goodsCnt\":\"1\"}]', null, '3', 'SALE_OUT', '2017-10-16 18:19:01');
INSERT INTO `vich_logs_depot` VALUES ('15', '1', '2', '[{\"id\":\"7\",\"depotSubId\":\"6\",\"batchNo\":\"PN1709082238527438\",\"goodsCnt\":\"1\"}]', '0', '3', 'SALE_OUT', '2017-10-16 18:23:23');
INSERT INTO `vich_logs_depot` VALUES ('16', '1', '2', '[{\"id\":\"7\",\"depotSubId\":\"6\",\"batchNo\":\"PN1709082238527438\",\"goodsCnt\":\"1\"}]', '0', '4', 'SALE_OUT', '2017-10-17 14:37:35');
INSERT INTO `vich_logs_depot` VALUES ('17', '1', '1', '[{\"batchNo\":\"PN1710180947345117\",\"depotId\":\"10\",\"depotSubId\":\"6\",\"supplierId\":\"12\",\"goodsId\":\"22\",\"goodsPrice\":\"10.00\",\"goodsCnt\":\"10\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-18 09:47:47\"}]', null, '4', 'PURCHASE_IN', '2017-10-18 09:47:47');
INSERT INTO `vich_logs_depot` VALUES ('18', '1', '1', '[{\"batchNo\":\"PN1711031542407799\",\"depotId\":null,\"depotSubId\":\"6\",\"supplierId\":\"11\",\"goodsId\":\"28\",\"goodsPrice\":\"20.00\",\"goodsCnt\":\"10\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:43:29\"},{\"batchNo\":\"PN1711031542588202\",\"depotId\":null,\"depotSubId\":\"6\",\"supplierId\":\"11\",\"goodsId\":\"27\",\"goodsPrice\":\"5.00\",\"goodsCnt\":\"1\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:43:29\"}]', null, '7', 'PURCHASE_IN', '2017-11-03 15:43:29');
INSERT INTO `vich_logs_depot` VALUES ('19', '1', '2', '[{\"id\":\"10\",\"depotSubId\":\"6\",\"batchNo\":\"PN1710180947345117\",\"goodsCnt\":\"10\"}]', '10', '5', 'USE_OUT', '2017-11-04 09:47:32');

-- ----------------------------
-- Table structure for `vich_logs_order`
-- ----------------------------
DROP TABLE IF EXISTS `vich_logs_order`;
CREATE TABLE `vich_logs_order` (
  `logId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单日志ID',
  `logUser` int(11) NOT NULL COMMENT '操作人',
  `logType` varchar(255) NOT NULL COMMENT '事件',
  `logContent` text NOT NULL COMMENT '结果',
  `orderId` int(11) NOT NULL COMMENT '订单ID',
  `orderType` varchar(255) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`logId`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8 COMMENT='订单日志表';

-- ----------------------------
-- Records of vich_logs_order
-- ----------------------------
INSERT INTO `vich_logs_order` VALUES ('1', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"PR1709081723359286\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 17:23:35\"}', '1', 'PLAN', '2017-09-08 17:23:35');
INSERT INTO `vich_logs_order` VALUES ('2', '1', 'INSERT', '{\"orderId\":1,\"goodsId\":22,\"goodsPrice\":10,\"goodsCnt\":10,\"remark\":\"123\",\"arrivalTime\":\"2017-09-09\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 17:24:29\"}', '1', 'PLAN', '2017-09-08 17:24:29');
INSERT INTO `vich_logs_order` VALUES ('3', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-08 17:24:44\"}', '1', 'PLAN', '2017-09-08 17:24:44');
INSERT INTO `vich_logs_order` VALUES ('8', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-08 17:28:03\"}', '1', 'PLAN', '2017-09-08 17:28:03');
INSERT INTO `vich_logs_order` VALUES ('9', '1', 'CREATE', '{\"supplierId\":12,\"orderNo\":\"IP1709082238156922\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 22:38:15\"}', '1', 'PURCHASE_IN', '2017-09-08 22:38:15');
INSERT INTO `vich_logs_order` VALUES ('10', '1', 'INSERT', '{\"orderId\":1,\"goodsId\":23,\"goodsPrice\":10,\"goodsCnt\":10,\"remark\":\"\",\"depotId\":10,\"depotSubId\":6,\"supplierId\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 22:38:52\",\"orderSubNo\":\"PN1709082238527438\"}', '1', 'PURCHASE_IN', '2017-09-08 22:38:52');
INSERT INTO `vich_logs_order` VALUES ('11', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-08 22:39:04\"}', '1', 'PURCHASE_IN', '2017-09-08 22:39:04');
INSERT INTO `vich_logs_order` VALUES ('18', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-08 22:48:21\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-09-08 22:48:21\",\"updateUser\":\"1\"}', '1', 'PURCHASE_IN', '2017-09-08 22:48:21');
INSERT INTO `vich_logs_order` VALUES ('19', '1', 'CREATE', '{\"supplierId\":12,\"orderNo\":\"IP1709082249259495\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 22:49:25\"}', '2', 'PURCHASE_IN', '2017-09-08 22:49:25');
INSERT INTO `vich_logs_order` VALUES ('20', '1', 'INSERT', '{\"orderId\":2,\"goodsId\":23,\"goodsPrice\":15,\"goodsCnt\":10,\"remark\":\"\",\"depotId\":10,\"depotSubId\":6,\"supplierId\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 22:51:05\",\"orderSubNo\":\"PN1709082251052391\"}', '2', 'PURCHASE_IN', '2017-09-08 22:51:05');
INSERT INTO `vich_logs_order` VALUES ('21', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-08 22:51:14\"}', '2', 'PURCHASE_IN', '2017-09-08 22:51:14');
INSERT INTO `vich_logs_order` VALUES ('22', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-08 22:52:43\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-09-08 22:52:43\",\"updateUser\":\"1\"}', '2', 'PURCHASE_IN', '2017-09-08 22:52:43');
INSERT INTO `vich_logs_order` VALUES ('23', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"IP1709082254233104\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 22:54:23\"}', '3', 'PURCHASE_IN', '2017-09-08 22:54:23');
INSERT INTO `vich_logs_order` VALUES ('24', '1', 'INSERT', '{\"orderId\":3,\"goodsId\":22,\"goodsPrice\":10,\"goodsCnt\":12,\"remark\":\"\",\"depotId\":10,\"depotSubId\":6,\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 22:57:50\",\"orderSubNo\":\"PN1709082257501516\"}', '3', 'PURCHASE_IN', '2017-09-08 22:57:50');
INSERT INTO `vich_logs_order` VALUES ('25', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-08 22:57:57\"}', '3', 'PURCHASE_IN', '2017-09-08 22:57:57');
INSERT INTO `vich_logs_order` VALUES ('26', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-08 22:58:02\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-09-08 22:58:02\",\"updateUser\":\"1\"}', '3', 'PURCHASE_IN', '2017-09-08 22:58:02');
INSERT INTO `vich_logs_order` VALUES ('27', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"OY1709082321191674\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 23:21:19\"}', '1', 'USE_OUT', '2017-09-08 23:21:19');
INSERT INTO `vich_logs_order` VALUES ('28', '1', 'INSERT', '{\"orderId\":1,\"goodsCnt\":10,\"remark\":\"\",\"departmentId\":9,\"employeeId\":13,\"goodsPrice\":\"10.00\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 23:22:15\",\"goodsId\":\"22\",\"depotGoodsId\":9,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082257501516\"}', '1', 'USE_OUT', '2017-09-08 23:22:15');
INSERT INTO `vich_logs_order` VALUES ('29', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-08 23:22:21\"}', '1', 'USE_OUT', '2017-09-08 23:22:21');
INSERT INTO `vich_logs_order` VALUES ('30', '1', 'INSERT', '{\"orderId\":1,\"goodsCnt\":10,\"remark\":\"\",\"departmentId\":9,\"employeeId\":13,\"goodsPrice\":\"15.00\",\"supplierId\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 23:23:58\",\"goodsId\":\"23\",\"depotGoodsId\":8,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082251052391\"}', '1', 'USE_OUT', '2017-09-08 23:23:58');
INSERT INTO `vich_logs_order` VALUES ('31', '1', 'INSERT', '{\"orderId\":1,\"goodsCnt\":10,\"remark\":\"\",\"departmentId\":9,\"employeeId\":13,\"goodsPrice\":\"10.00\",\"supplierId\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-08 23:24:15\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\"}', '1', 'USE_OUT', '2017-09-08 23:24:15');
INSERT INTO `vich_logs_order` VALUES ('32', '1', 'DELETE', '{\"flag\":-1,\"id\":[\"2\",\"3\"]}', '1', 'USE_OUT', '2017-09-08 23:24:42');
INSERT INTO `vich_logs_order` VALUES ('33', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-08 23:53:09\"}', '1', 'USE_OUT', '2017-09-08 23:53:09');
INSERT INTO `vich_logs_order` VALUES ('34', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-08 23:53:32\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-09-08 23:53:32\",\"updateUser\":\"1\"}', '1', 'USE_OUT', '2017-09-08 23:53:32');
INSERT INTO `vich_logs_order` VALUES ('35', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"PD1709090025144518\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-09 00:25:14\"}', '1', 'INVENTORY', '2017-09-09 00:25:14');
INSERT INTO `vich_logs_order` VALUES ('36', '1', 'INSERT', '{\"orderId\":1,\"goodsCnt\":3,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-09 00:27:02\",\"goodsId\":\"22\",\"depotGoodsId\":9,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082257501516\"}', '1', 'INVENTORY', '2017-09-09 00:27:02');
INSERT INTO `vich_logs_order` VALUES ('37', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-09 00:27:35\"}', '1', 'INVENTORY', '2017-09-09 00:27:35');
INSERT INTO `vich_logs_order` VALUES ('38', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-09 00:27:53\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-09-09 00:27:53\",\"updateUser\":\"1\"}', '1', 'INVENTORY', '2017-09-09 00:27:53');
INSERT INTO `vich_logs_order` VALUES ('39', '1', 'CREATE', '{\"orderNo\":\"IQ1709090027537251\",\"depotId\":\"10\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"reviewer\":\"1\",\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-09 00:27:53\"}', '1', 'OTHER_IN', '2017-09-09 00:27:53');
INSERT INTO `vich_logs_order` VALUES ('40', '1', 'INSERT', '{\"orderId\":\"1\",\"totalMoney\":10,\"totalCnt\":1,\"goods\":[{\"orderId\":\"1\",\"orderSubNo\":\"PN1709082257501516\",\"depotGoodsId\":\"9\",\"goodsId\":\"22\",\"supplierId\":\"11\",\"depotSubId\":\"6\",\"goodsPrice\":\"10.00\",\"goodsCnt\":1,\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-09 00:27:53\"}]}', '1', 'OTHER_IN', '2017-09-09 00:27:53');
INSERT INTO `vich_logs_order` VALUES ('41', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-09 00:29:04\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-09-09 00:29:04\",\"updateUser\":\"1\"}', '1', 'OTHER_IN', '2017-09-09 00:29:04');
INSERT INTO `vich_logs_order` VALUES ('42', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"PD1709090029175148\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-09 00:29:17\"}', '2', 'INVENTORY', '2017-09-09 00:29:17');
INSERT INTO `vich_logs_order` VALUES ('43', '1', 'INSERT', '{\"orderId\":2,\"goodsCnt\":3,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-09 00:29:39\",\"goodsId\":\"22\",\"depotGoodsId\":9,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082257501516\"}', '2', 'INVENTORY', '2017-09-09 00:29:39');
INSERT INTO `vich_logs_order` VALUES ('44', '1', 'UPDATE', '{\"goodsCnt\":4,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"id\":2}', '2', 'INVENTORY', '2017-09-09 00:29:55');
INSERT INTO `vich_logs_order` VALUES ('45', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-09 00:30:02\"}', '2', 'INVENTORY', '2017-09-09 00:30:02');
INSERT INTO `vich_logs_order` VALUES ('46', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-09 00:30:17\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-09-09 00:30:17\",\"updateUser\":\"1\"}', '2', 'INVENTORY', '2017-09-09 00:30:17');
INSERT INTO `vich_logs_order` VALUES ('47', '1', 'CREATE', '{\"orderNo\":\"IQ1709090030173084\",\"depotId\":\"10\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"reviewer\":\"1\",\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-09 00:30:17\"}', '2', 'OTHER_IN', '2017-09-09 00:30:17');
INSERT INTO `vich_logs_order` VALUES ('48', '1', 'INSERT', '{\"orderId\":\"2\",\"totalMoney\":10,\"totalCnt\":1,\"goods\":[{\"orderId\":\"2\",\"orderSubNo\":\"PN1709082257501516\",\"depotGoodsId\":\"9\",\"goodsId\":\"22\",\"supplierId\":\"11\",\"depotSubId\":\"6\",\"goodsPrice\":\"10.00\",\"goodsCnt\":1,\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-09 00:30:17\"}]}', '2', 'OTHER_IN', '2017-09-09 00:30:17');
INSERT INTO `vich_logs_order` VALUES ('49', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"PR1709141408452742\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-14 14:08:45\"}', '2', 'PLAN', '2017-09-14 14:08:45');
INSERT INTO `vich_logs_order` VALUES ('50', '1', 'INSERT', '{\"orderId\":2,\"goodsId\":25,\"goodsPrice\":10,\"goodsCnt\":20,\"remark\":\"xxx\",\"arrivalTime\":\"2017-09-15\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-14 14:10:13\"}', '2', 'PLAN', '2017-09-14 14:10:13');
INSERT INTO `vich_logs_order` VALUES ('51', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-14 14:11:53\"}', '2', 'PLAN', '2017-09-14 14:11:53');
INSERT INTO `vich_logs_order` VALUES ('52', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-14 14:12:50\",\"reviewerMemo\":\"xxxx\",\"flag\":3,\"updateTime\":\"2017-09-14 14:12:50\",\"updateUser\":\"1\"}', '2', 'PLAN', '2017-09-14 14:12:50');
INSERT INTO `vich_logs_order` VALUES ('53', '28', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"DH1709141426323187\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"28\",\"createTime\":\"2017-09-14 14:26:32\"}', '1', 'ARRIVAL', '2017-09-14 14:26:32');
INSERT INTO `vich_logs_order` VALUES ('54', '28', 'INSERT', '{\"orderId\":1,\"goodsId\":23,\"goodsPrice\":10,\"goodsCnt\":10,\"remark\":\"xx\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"28\",\"createTime\":\"2017-09-14 14:37:23\"}', '1', 'ARRIVAL', '2017-09-14 14:37:23');
INSERT INTO `vich_logs_order` VALUES ('55', '28', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"28\",\"updateTime\":\"2017-09-14 14:37:47\"}', '1', 'ARRIVAL', '2017-09-14 14:37:47');
INSERT INTO `vich_logs_order` VALUES ('56', '1', 'NOPASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-14 14:38:23\",\"reviewerMemo\":\"xxx\",\"flag\":-3,\"updateTime\":\"2017-09-14 14:38:23\",\"updateUser\":\"1\"}', '1', 'ARRIVAL', '2017-09-14 14:38:23');
INSERT INTO `vich_logs_order` VALUES ('57', '28', 'DELETE', '{\"flag\":-1,\"id\":[\"1\"]}', '0', 'ARRIVAL', '2017-09-14 14:38:57');
INSERT INTO `vich_logs_order` VALUES ('58', '28', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"TH1709141439076438\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"28\",\"createTime\":\"2017-09-14 14:39:07\"}', '1', 'RETURN', '2017-09-14 14:39:07');
INSERT INTO `vich_logs_order` VALUES ('59', '28', 'INSERT', '{\"orderId\":1,\"goodsId\":24,\"goodsPrice\":1,\"goodsCnt\":1,\"remark\":\"\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"28\",\"createTime\":\"2017-09-14 14:39:25\"}', '1', 'RETURN', '2017-09-14 14:39:25');
INSERT INTO `vich_logs_order` VALUES ('60', '1', 'CREATE', '{\"depotId\":11,\"orderNo\":\"OY1709230926583832\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-23 09:26:58\"}', '2', 'USE_OUT', '2017-09-23 09:26:59');
INSERT INTO `vich_logs_order` VALUES ('61', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"OY1709230927168044\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-23 09:27:16\"}', '3', 'USE_OUT', '2017-09-23 09:27:16');
INSERT INTO `vich_logs_order` VALUES ('62', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":5,\"remark\":\"\",\"departmentId\":9,\"employeeId\":13,\"goodsPrice\":\"10.00\",\"supplierId\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-23 09:27:32\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\"}', '3', 'USE_OUT', '2017-09-23 09:27:32');
INSERT INTO `vich_logs_order` VALUES ('63', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":10,\"remark\":\"\",\"departmentId\":11,\"employeeId\":20,\"goodsPrice\":\"15.00\",\"supplierId\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-23 09:27:46\",\"goodsId\":\"23\",\"depotGoodsId\":8,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082251052391\"}', '3', 'USE_OUT', '2017-09-23 09:27:46');
INSERT INTO `vich_logs_order` VALUES ('64', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":3,\"remark\":\"\",\"departmentId\":12,\"employeeId\":11,\"goodsPrice\":\"10.00\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-09-23 09:27:59\",\"goodsId\":\"22\",\"depotGoodsId\":9,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082257501516\"}', '3', 'USE_OUT', '2017-09-23 09:27:59');
INSERT INTO `vich_logs_order` VALUES ('65', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-09-23 09:28:03\"}', '3', 'USE_OUT', '2017-09-23 09:28:03');
INSERT INTO `vich_logs_order` VALUES ('66', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-09-23 09:31:18\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-09-23 09:31:18\",\"updateUser\":\"1\"}', '3', 'USE_OUT', '2017-09-23 09:31:18');
INSERT INTO `vich_logs_order` VALUES ('67', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-10-11 17:44:10\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-10-11 17:44:10\",\"updateUser\":\"1\"}', '2', 'OTHER_IN', '2017-10-11 17:44:10');
INSERT INTO `vich_logs_order` VALUES ('68', '1', 'CREATE', '{\"supplierId\":12,\"orderNo\":\"IP1710141018139895\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-14 10:18:13\"}', '4', 'PURCHASE_IN', '2017-10-14 10:18:13');
INSERT INTO `vich_logs_order` VALUES ('69', '1', 'CREATE', '{\"customerId\":2,\"orderNo\":\"SO1710161347396213\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 13:47:39\"}', '3', 'SALE_OUT', '2017-10-16 13:47:39');
INSERT INTO `vich_logs_order` VALUES ('70', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"OY1710161649359371\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 16:49:35\"}', '4', 'USE_OUT', '2017-10-16 16:49:35');
INSERT INTO `vich_logs_order` VALUES ('71', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 17:28:54\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\"}', '3', 'SALE_OUT', '2017-10-16 17:28:54');
INSERT INTO `vich_logs_order` VALUES ('72', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 17:37:19\",\"goodsId\":\"22\",\"depotGoodsId\":9,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082257501516\",\"depotId\":\"10\"}', '3', 'SALE_OUT', '2017-10-16 17:37:19');
INSERT INTO `vich_logs_order` VALUES ('73', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"PD1710161758569386\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 17:58:56\"}', '3', 'INVENTORY', '2017-10-16 17:58:56');
INSERT INTO `vich_logs_order` VALUES ('74', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":6,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 17:59:05\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\"}', '3', 'INVENTORY', '2017-10-16 17:59:05');
INSERT INTO `vich_logs_order` VALUES ('75', '1', 'UPDATE', '{\"goodsCnt\":7,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"id\":3}', '3', 'INVENTORY', '2017-10-16 17:59:19');
INSERT INTO `vich_logs_order` VALUES ('76', '1', 'UPDATE', '{\"goodsCnt\":2,\"remark\":\"\",\"id\":1}', '3', 'SALE_OUT', '2017-10-16 18:00:48');
INSERT INTO `vich_logs_order` VALUES ('77', '1', 'DELETE', '{\"flag\":-1,\"id\":1}', '3', 'SALE_OUT', '2017-10-16 18:02:11');
INSERT INTO `vich_logs_order` VALUES ('78', '1', 'DELETE', '{\"flag\":-1,\"id\":2}', '3', 'SALE_OUT', '2017-10-16 18:02:57');
INSERT INTO `vich_logs_order` VALUES ('79', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 18:03:18\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\",\"depotId\":\"10\"}', '3', 'SALE_OUT', '2017-10-16 18:03:18');
INSERT INTO `vich_logs_order` VALUES ('80', '1', 'DELETE', '{\"flag\":-1,\"id\":3}', '3', 'SALE_OUT', '2017-10-16 18:03:26');
INSERT INTO `vich_logs_order` VALUES ('81', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 18:03:32\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\",\"depotId\":\"10\"}', '3', 'SALE_OUT', '2017-10-16 18:03:32');
INSERT INTO `vich_logs_order` VALUES ('82', '1', 'UPDATE', '{\"goodsCnt\":2,\"remark\":\"\",\"id\":4}', '3', 'SALE_OUT', '2017-10-16 18:03:49');
INSERT INTO `vich_logs_order` VALUES ('83', '1', 'UPDATE', '{\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"id\":4}', '3', 'SALE_OUT', '2017-10-16 18:05:16');
INSERT INTO `vich_logs_order` VALUES ('84', '1', 'DELETE', '{\"flag\":-1,\"id\":[\"4\"]}', '3', 'SALE_OUT', '2017-10-16 18:08:48');
INSERT INTO `vich_logs_order` VALUES ('85', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 18:09:01\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\",\"depotId\":\"10\"}', '3', 'SALE_OUT', '2017-10-16 18:09:01');
INSERT INTO `vich_logs_order` VALUES ('86', '1', 'DELETE', '{\"flag\":-1,\"id\":[\"5\"]}', '3', 'SALE_OUT', '2017-10-16 18:09:06');
INSERT INTO `vich_logs_order` VALUES ('87', '1', 'INSERT', '{\"orderId\":3,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 18:15:09\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\",\"depotId\":\"10\"}', '3', 'SALE_OUT', '2017-10-16 18:15:09');
INSERT INTO `vich_logs_order` VALUES ('88', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-10-16 18:15:15\"}', '3', 'SALE_OUT', '2017-10-16 18:15:15');
INSERT INTO `vich_logs_order` VALUES ('89', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-10-16 18:19:01\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-10-16 18:19:01\",\"updateUser\":\"1\"}', '3', 'SALE_OUT', '2017-10-16 18:19:01');
INSERT INTO `vich_logs_order` VALUES ('90', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-10-16 18:20:17\"}', '3', 'SALE_OUT', '2017-10-16 18:20:17');
INSERT INTO `vich_logs_order` VALUES ('91', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-10-16 18:23:23\",\"reviewerMemo\":\"1\",\"flag\":3,\"updateTime\":\"2017-10-16 18:23:23\",\"updateUser\":\"1\"}', '3', 'SALE_OUT', '2017-10-16 18:23:23');
INSERT INTO `vich_logs_order` VALUES ('92', '1', 'DELETE', '{\"flag\":-1,\"id\":[\"2\"]}', '0', 'SALE_OUT', '2017-10-16 18:25:48');
INSERT INTO `vich_logs_order` VALUES ('93', '1', 'CREATE', '{\"customerId\":2,\"orderNo\":\"SO1710161848418444\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-16 18:48:41\"}', '4', 'SALE_OUT', '2017-10-16 18:48:41');
INSERT INTO `vich_logs_order` VALUES ('94', '1', 'INSERT', '{\"orderId\":4,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-17 14:37:24\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\",\"depotId\":\"10\"}', '4', 'SALE_OUT', '2017-10-17 14:37:24');
INSERT INTO `vich_logs_order` VALUES ('95', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-10-17 14:37:29\"}', '4', 'SALE_OUT', '2017-10-17 14:37:29');
INSERT INTO `vich_logs_order` VALUES ('96', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-10-17 14:37:35\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-10-17 14:37:35\",\"updateUser\":\"1\"}', '4', 'SALE_OUT', '2017-10-17 14:37:35');
INSERT INTO `vich_logs_order` VALUES ('97', '1', 'INSERT', '{\"orderId\":4,\"goodsId\":22,\"goodsPrice\":10,\"goodsCnt\":10,\"remark\":\"xx\",\"depotId\":10,\"depotSubId\":6,\"supplierId\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-18 09:47:34\",\"orderSubNo\":\"PN1710180947345117\"}', '4', 'PURCHASE_IN', '2017-10-18 09:47:34');
INSERT INTO `vich_logs_order` VALUES ('98', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-10-18 09:47:38\"}', '4', 'PURCHASE_IN', '2017-10-18 09:47:38');
INSERT INTO `vich_logs_order` VALUES ('99', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-10-18 09:47:47\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-10-18 09:47:47\",\"updateUser\":\"1\"}', '4', 'PURCHASE_IN', '2017-10-18 09:47:47');
INSERT INTO `vich_logs_order` VALUES ('100', '1', 'INSERT', '{\"orderId\":1,\"goodsPrice\":123,\"goodsCnt\":2,\"remark\":\"\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-18 11:53:21\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\",\"depotId\":\"10\"}', '1', 'SALE_OUT', '2017-10-18 11:53:21');
INSERT INTO `vich_logs_order` VALUES ('101', '1', 'UPDATE', '{\"goodsPrice\":223,\"goodsCnt\":2,\"remark\":\"\",\"id\":8}', '1', 'SALE_OUT', '2017-10-18 11:54:23');
INSERT INTO `vich_logs_order` VALUES ('102', '1', 'CREATE', '{\"deliverTime\":\"2017-10-10\",\"customerId\":2,\"orderNo\":\"SO1710181430503478\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"123\",\"createTime\":\"2017-10-18 14:30:50\"}', '5', 'SALE_OUT', '2017-10-18 14:30:50');
INSERT INTO `vich_logs_order` VALUES ('103', '1', 'INSERT', '{\"orderId\":5,\"goodsPrice\":1,\"goodsCnt\":1,\"remark\":\"\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-18 15:50:43\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\",\"depotId\":\"10\"}', '5', 'SALE_OUT', '2017-10-18 15:50:43');
INSERT INTO `vich_logs_order` VALUES ('104', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-10-18 15:50:48\"}', '5', 'SALE_OUT', '2017-10-18 15:50:48');
INSERT INTO `vich_logs_order` VALUES ('105', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"PD1710200918031212\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"111\",\"createTime\":\"2017-10-20 09:18:03\"}', '4', 'INVENTORY', '2017-10-20 09:18:03');
INSERT INTO `vich_logs_order` VALUES ('106', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"PR1710200918214352\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"xxx\",\"createTime\":\"2017-10-20 09:18:21\"}', '3', 'PLAN', '2017-10-20 09:18:21');
INSERT INTO `vich_logs_order` VALUES ('107', '1', 'CREATE', '{\"supplierId\":12,\"orderNo\":\"DH1710200918301092\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"xx\",\"createTime\":\"2017-10-20 09:18:30\"}', '2', 'ARRIVAL', '2017-10-20 09:18:30');
INSERT INTO `vich_logs_order` VALUES ('108', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"TH1710200918386685\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"xxx\",\"createTime\":\"2017-10-20 09:18:38\"}', '2', 'RETURN', '2017-10-20 09:18:38');
INSERT INTO `vich_logs_order` VALUES ('109', '1', 'INSERT', '{\"orderId\":2,\"goodsId\":22,\"goodsPrice\":1,\"goodsCnt\":1,\"remark\":\"1\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-10-20 09:18:47\"}', '2', 'RETURN', '2017-10-20 09:18:47');
INSERT INTO `vich_logs_order` VALUES ('110', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"ID1711031336501972\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"xx\",\"createTime\":\"2017-11-03 13:36:50\"}', '1', 'ALLOT_IN', '2017-11-03 13:36:50');
INSERT INTO `vich_logs_order` VALUES ('111', '1', 'INSERT', '{\"orderId\":1,\"goodsId\":22,\"goodsPrice\":10,\"goodsCnt\":10,\"remark\":\"xxx\",\"supplierId\":11,\"depotSubId\":6,\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:37:33\",\"depotId\":\"10\",\"orderSubNo\":\"AN1711031337339029\"}', '1', 'ALLOT_IN', '2017-11-03 13:37:33');
INSERT INTO `vich_logs_order` VALUES ('112', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"OD1711031338263307\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 13:38:26\"}', '1', 'ALLOT_OUT', '2017-11-03 13:38:26');
INSERT INTO `vich_logs_order` VALUES ('113', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"PD1711031338574625\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"xx\",\"createTime\":\"2017-11-03 13:38:57\"}', '5', 'INVENTORY', '2017-11-03 13:38:57');
INSERT INTO `vich_logs_order` VALUES ('114', '1', 'INSERT', '{\"orderId\":5,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:41:33\",\"depotId\":\"10\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\"}', '5', 'INVENTORY', '2017-11-03 13:41:33');
INSERT INTO `vich_logs_order` VALUES ('115', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-11-03 13:41:39\"}', '5', 'INVENTORY', '2017-11-03 13:41:39');
INSERT INTO `vich_logs_order` VALUES ('116', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-11-03 13:41:44\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-11-03 13:41:44\",\"updateUser\":\"1\"}', '5', 'INVENTORY', '2017-11-03 13:41:44');
INSERT INTO `vich_logs_order` VALUES ('117', '1', 'CREATE', '{\"orderNo\":\"OQ1711031341442282\",\"depotId\":\"10\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"reviewer\":\"1\",\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:41:44\"}', '1', 'OTHER_OUT', '2017-11-03 13:41:44');
INSERT INTO `vich_logs_order` VALUES ('118', '1', 'INSERT', '{\"orderId\":\"1\",\"totalMoney\":20,\"totalCnt\":2,\"goods\":[{\"orderId\":\"1\",\"orderSubNo\":\"PN1709082238527438\",\"depotGoodsId\":\"7\",\"goodsId\":\"23\",\"supplierId\":\"12\",\"depotSubId\":\"6\",\"goodsPrice\":\"10.00\",\"goodsCnt\":2,\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:41:44\"}]}', '1', 'OTHER_OUT', '2017-11-03 13:41:44');
INSERT INTO `vich_logs_order` VALUES ('119', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"PD1711031344275257\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 13:44:27\"}', '6', 'INVENTORY', '2017-11-03 13:44:27');
INSERT INTO `vich_logs_order` VALUES ('120', '1', 'INSERT', '{\"orderId\":6,\"goodsCnt\":10,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:44:38\",\"depotId\":\"10\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\"}', '6', 'INVENTORY', '2017-11-03 13:44:38');
INSERT INTO `vich_logs_order` VALUES ('121', '1', 'INSERT', '{\"orderId\":6,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"15.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:44:53\",\"depotId\":\"10\",\"goodsId\":\"23\",\"depotGoodsId\":8,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082251052391\"}', '6', 'INVENTORY', '2017-11-03 13:44:53');
INSERT INTO `vich_logs_order` VALUES ('122', '1', 'UPDATE', '{\"goodsCnt\":2,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"id\":5}', '6', 'INVENTORY', '2017-11-03 13:45:06');
INSERT INTO `vich_logs_order` VALUES ('123', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-11-03 13:45:10\"}', '6', 'INVENTORY', '2017-11-03 13:45:10');
INSERT INTO `vich_logs_order` VALUES ('124', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-11-03 13:45:13\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-11-03 13:45:13\",\"updateUser\":\"1\"}', '6', 'INVENTORY', '2017-11-03 13:45:13');
INSERT INTO `vich_logs_order` VALUES ('125', '1', 'CREATE', '{\"orderNo\":\"OQ1711031345134293\",\"depotId\":\"10\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"reviewer\":\"1\",\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:45:13\"}', '2', 'OTHER_OUT', '2017-11-03 13:45:13');
INSERT INTO `vich_logs_order` VALUES ('126', '1', 'CREATE', '{\"orderNo\":\"IQ1711031345132040\",\"depotId\":\"10\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"reviewer\":\"1\",\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:45:13\"}', '3', 'OTHER_IN', '2017-11-03 13:45:13');
INSERT INTO `vich_logs_order` VALUES ('127', '1', 'INSERT', '{\"orderId\":\"2\",\"totalMoney\":10,\"totalCnt\":1,\"goods\":[{\"orderId\":\"2\",\"orderSubNo\":\"PN1709082238527438\",\"depotGoodsId\":\"7\",\"goodsId\":\"23\",\"supplierId\":\"12\",\"depotId\":\"10\",\"depotSubId\":\"6\",\"goodsPrice\":\"10.00\",\"goodsCnt\":1,\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:45:13\"}]}', '2', 'OTHER_OUT', '2017-11-03 13:45:13');
INSERT INTO `vich_logs_order` VALUES ('128', '1', 'INSERT', '{\"orderId\":\"3\",\"totalMoney\":15,\"totalCnt\":1,\"goods\":[{\"orderId\":\"3\",\"orderSubNo\":\"PN1709082251052391\",\"depotGoodsId\":\"8\",\"depotId\":\"10\",\"goodsId\":\"23\",\"supplierId\":\"12\",\"depotSubId\":\"6\",\"goodsPrice\":\"15.00\",\"goodsCnt\":1,\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 13:45:13\"}]}', '3', 'OTHER_IN', '2017-11-03 13:45:13');
INSERT INTO `vich_logs_order` VALUES ('129', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"IP1711031358169837\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 13:58:16\"}', '5', 'PURCHASE_IN', '2017-11-03 13:58:16');
INSERT INTO `vich_logs_order` VALUES ('130', '1', 'DELETE', '{\"flag\":-1,\"id\":[\"5\"]}', '0', 'PURCHASE_IN', '2017-11-03 13:58:26');
INSERT INTO `vich_logs_order` VALUES ('131', '1', 'INSERT', '{\"orderId\":4,\"goodsCnt\":2,\"remark\":\"\",\"departmentId\":12,\"employeeId\":11,\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 14:04:16\",\"depotId\":\"10\",\"goodsId\":\"23\",\"depotGoodsId\":7,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082238527438\"}', '4', 'USE_OUT', '2017-11-03 14:04:16');
INSERT INTO `vich_logs_order` VALUES ('132', '1', 'DELETE', '{\"flag\":-1,\"id\":[\"7\"]}', '4', 'USE_OUT', '2017-11-03 14:04:41');
INSERT INTO `vich_logs_order` VALUES ('133', '1', 'INSERT', '{\"orderId\":4,\"goodsCnt\":10,\"remark\":\"\",\"goodsPrice\":\"15.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 14:05:50\",\"depotId\":\"10\",\"goodsId\":\"23\",\"depotGoodsId\":8,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082251052391\"}', '4', 'INVENTORY', '2017-11-03 14:05:50');
INSERT INTO `vich_logs_order` VALUES ('134', '1', 'DELETE', '{\"flag\":-1,\"id\":[\"7\"]}', '4', 'INVENTORY', '2017-11-03 14:06:03');
INSERT INTO `vich_logs_order` VALUES ('135', '1', 'CREATE', '{\"supplierId\":12,\"orderNo\":\"PR1711031525021831\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 15:25:02\"}', '4', 'PLAN', '2017-11-03 15:25:02');
INSERT INTO `vich_logs_order` VALUES ('136', '1', 'INSERT', '{\"orderId\":4,\"goodsId\":24,\"goodsPrice\":10,\"goodsCnt\":10,\"remark\":\"***\",\"arrivalTime\":\"2017-11-17\",\"supplierId\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:25:58\",\"depotId\":null}', '4', 'PLAN', '2017-11-03 15:25:58');
INSERT INTO `vich_logs_order` VALUES ('137', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-11-03 15:26:17\"}', '4', 'PLAN', '2017-11-03 15:26:17');
INSERT INTO `vich_logs_order` VALUES ('138', '1', 'INSERT', '{\"orderId\":4,\"goodsId\":23,\"goodsPrice\":10,\"goodsCnt\":20,\"remark\":\"\",\"arrivalTime\":\"2017-11-23\",\"supplierId\":\"12\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:26:38\",\"depotId\":null}', '4', 'PLAN', '2017-11-03 15:26:38');
INSERT INTO `vich_logs_order` VALUES ('139', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-11-03 15:26:50\"}', '4', 'PLAN', '2017-11-03 15:26:50');
INSERT INTO `vich_logs_order` VALUES ('140', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-11-03 15:26:59\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-11-03 15:26:59\",\"updateUser\":\"1\"}', '4', 'PLAN', '2017-11-03 15:26:59');
INSERT INTO `vich_logs_order` VALUES ('141', '1', 'CREATE', '{\"supplierId\":12,\"orderNo\":\"DH1711031527486108\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 15:27:48\"}', '3', 'ARRIVAL', '2017-11-03 15:27:48');
INSERT INTO `vich_logs_order` VALUES ('142', '1', 'CREATE', '{\"deliverTime\":\"2017-11-09\",\"customerId\":2,\"orderNo\":\"SO1711031528557998\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 15:28:55\"}', '6', 'SALE_OUT', '2017-11-03 15:28:55');
INSERT INTO `vich_logs_order` VALUES ('143', '1', 'INSERT', '{\"orderId\":6,\"goodsPrice\":10,\"goodsCnt\":10,\"remark\":\"\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:29:14\",\"depotId\":\"10\",\"goodsId\":\"22\",\"depotGoodsId\":10,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1710180947345117\"}', '6', 'SALE_OUT', '2017-11-03 15:29:14');
INSERT INTO `vich_logs_order` VALUES ('144', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-11-03 15:29:24\"}', '6', 'SALE_OUT', '2017-11-03 15:29:24');
INSERT INTO `vich_logs_order` VALUES ('145', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"IP1711031529543159\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 15:29:54\"}', '6', 'PURCHASE_IN', '2017-11-03 15:29:54');
INSERT INTO `vich_logs_order` VALUES ('146', '1', 'INSERT', '{\"orderId\":6,\"goodsId\":24,\"goodsPrice\":1,\"goodsCnt\":20,\"remark\":\"\",\"depotId\":null,\"depotSubId\":6,\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:30:19\",\"orderSubNo\":\"PN1711031530199436\"}', '6', 'PURCHASE_IN', '2017-11-03 15:30:19');
INSERT INTO `vich_logs_order` VALUES ('147', '1', 'DELETE', '{\"flag\":-1,\"id\":[\"6\"]}', '0', 'PURCHASE_IN', '2017-11-03 15:30:39');
INSERT INTO `vich_logs_order` VALUES ('148', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"OY1711031531233872\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 15:31:23\"}', '5', 'USE_OUT', '2017-11-03 15:31:23');
INSERT INTO `vich_logs_order` VALUES ('149', '1', 'INSERT', '{\"orderId\":5,\"goodsCnt\":10,\"remark\":\"\",\"departmentId\":11,\"employeeId\":20,\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:32:26\",\"depotId\":\"10\",\"goodsId\":\"22\",\"depotGoodsId\":10,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1710180947345117\"}', '5', 'USE_OUT', '2017-11-03 15:32:26');
INSERT INTO `vich_logs_order` VALUES ('150', '1', 'CREATE', '{\"depotId\":10,\"orderNo\":\"PD1711031533144289\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 15:33:14\"}', '7', 'INVENTORY', '2017-11-03 15:33:14');
INSERT INTO `vich_logs_order` VALUES ('151', '1', 'INSERT', '{\"orderId\":7,\"goodsCnt\":1,\"remark\":\"\",\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:33:35\",\"depotId\":\"10\",\"goodsId\":\"22\",\"depotGoodsId\":9,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082257501516\"}', '7', 'INVENTORY', '2017-11-03 15:33:35');
INSERT INTO `vich_logs_order` VALUES ('152', '1', 'INSERT', '{\"orderId\":1,\"goodsCnt\":1,\"remark\":\"\",\"departmentId\":9,\"employeeId\":13,\"goodsPrice\":\"10.00\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:34:09\",\"depotId\":\"10\",\"goodsId\":\"22\",\"depotGoodsId\":9,\"depotSubId\":\"6\",\"orderSubNo\":\"PN1709082257501516\"}', '1', 'ALLOT_OUT', '2017-11-03 15:34:09');
INSERT INTO `vich_logs_order` VALUES ('153', '1', 'INSERT', '{\"orderId\":3,\"goodsId\":26,\"goodsPrice\":15,\"goodsCnt\":10,\"remark\":\"\",\"arrivalTime\":\"2017-11-03\",\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:40:01\",\"depotId\":null}', '3', 'PLAN', '2017-11-03 15:40:01');
INSERT INTO `vich_logs_order` VALUES ('154', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-11-03 15:40:53\"}', '3', 'PLAN', '2017-11-03 15:40:54');
INSERT INTO `vich_logs_order` VALUES ('155', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"IP1711031541593523\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"1111\",\"createTime\":\"2017-11-03 15:41:59\"}', '7', 'PURCHASE_IN', '2017-11-03 15:41:59');
INSERT INTO `vich_logs_order` VALUES ('156', '1', 'INSERT', '{\"orderId\":7,\"goodsId\":28,\"goodsPrice\":20,\"goodsCnt\":10,\"remark\":\"1111\",\"depotId\":null,\"depotSubId\":6,\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:42:40\",\"orderSubNo\":\"PN1711031542407799\"}', '7', 'PURCHASE_IN', '2017-11-03 15:42:40');
INSERT INTO `vich_logs_order` VALUES ('157', '1', 'INSERT', '{\"orderId\":7,\"goodsId\":27,\"goodsPrice\":5,\"goodsCnt\":1,\"remark\":\"\",\"depotId\":null,\"depotSubId\":6,\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:42:58\",\"orderSubNo\":\"PN1711031542588202\"}', '7', 'PURCHASE_IN', '2017-11-03 15:42:58');
INSERT INTO `vich_logs_order` VALUES ('158', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-11-03 15:43:15\"}', '7', 'PURCHASE_IN', '2017-11-03 15:43:15');
INSERT INTO `vich_logs_order` VALUES ('159', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-11-03 15:43:29\",\"reviewerMemo\":\"11\",\"flag\":3,\"updateTime\":\"2017-11-03 15:43:29\",\"updateUser\":\"1\"}', '7', 'PURCHASE_IN', '2017-11-03 15:43:29');
INSERT INTO `vich_logs_order` VALUES ('160', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"IP1711031546209608\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 15:46:20\"}', '8', 'PURCHASE_IN', '2017-11-03 15:46:20');
INSERT INTO `vich_logs_order` VALUES ('161', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"IP1711031553247980\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-03 15:53:24\"}', '9', 'PURCHASE_IN', '2017-11-03 15:53:24');
INSERT INTO `vich_logs_order` VALUES ('162', '1', 'INSERT', '{\"orderId\":9,\"goodsId\":22,\"goodsPrice\":123,\"goodsCnt\":123,\"remark\":\"\",\"depotId\":10,\"depotSubId\":6,\"supplierId\":\"11\",\"flag\":1,\"createCompany\":\"32\",\"createUser\":\"1\",\"createTime\":\"2017-11-03 15:53:37\",\"orderSubNo\":\"PN1711031553371973\"}', '9', 'PURCHASE_IN', '2017-11-03 15:53:37');
INSERT INTO `vich_logs_order` VALUES ('163', '1', 'UPDATE', '{\"goodsCnt\":1,\"remark\":\"123\",\"departmentId\":9,\"employeeId\":13,\"goodsPrice\":\"10.00\",\"id\":1}', '1', 'ALLOT_OUT', '2017-11-03 16:44:00');
INSERT INTO `vich_logs_order` VALUES ('164', '1', 'CREATE', '{\"supplierId\":12,\"orderNo\":\"PR1711040837581744\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"10\",\"createTime\":\"2017-11-04 08:37:58\"}', '5', 'PLAN', '2017-11-04 08:37:58');
INSERT INTO `vich_logs_order` VALUES ('165', '1', 'CREATE', '{\"supplierId\":11,\"orderNo\":\"PR1711040943114316\",\"totalMoney\":0,\"totalCnt\":0,\"flag\":0,\"createCompany\":\"32\",\"createUser\":\"1\",\"remark\":\"\",\"createTime\":\"2017-11-04 09:43:11\"}', '6', 'PLAN', '2017-11-04 09:43:11');
INSERT INTO `vich_logs_order` VALUES ('166', '1', 'TOREVIEW', '{\"flag\":1,\"reviewer\":1,\"reviewerMemo\":\"\",\"updateUser\":\"1\",\"updateTime\":\"2017-11-04 09:47:17\"}', '5', 'USE_OUT', '2017-11-04 09:47:17');
INSERT INTO `vich_logs_order` VALUES ('167', '1', 'PASS', '{\"reviewer\":\"1\",\"reviewerTime\":\"2017-11-04 09:47:32\",\"reviewerMemo\":\"\",\"flag\":3,\"updateTime\":\"2017-11-04 09:47:32\",\"updateUser\":\"1\"}', '5', 'USE_OUT', '2017-11-04 09:47:32');

-- ----------------------------
-- Table structure for `vich_menu_url`
-- ----------------------------
DROP TABLE IF EXISTS `vich_menu_url`;
CREATE TABLE `vich_menu_url` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  `module_id` int(11) NOT NULL,
  `is_show` tinyint(4) NOT NULL COMMENT '是否在sidebar里出现',
  `online` int(11) NOT NULL DEFAULT '1' COMMENT '在线状态，还是下线状态，即可用，不可用。',
  `shortcut_allowed` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '是否允许快捷访问',
  `menu_desc` varchar(255) DEFAULT NULL,
  `father_menu` int(11) NOT NULL DEFAULT '0' COMMENT '上一级菜单',
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_url` (`menu_url`)
) ENGINE=InnoDB AUTO_INCREMENT=285 DEFAULT CHARSET=utf8 COMMENT='功能链接（菜单链接）';

-- ----------------------------
-- Records of vich_menu_url
-- ----------------------------
INSERT INTO `vich_menu_url` VALUES ('1', '首页', '/panel/index.php', '1', '0', '1', '1', '后台首页', '0');
INSERT INTO `vich_menu_url` VALUES ('2', '账号列表', '/panel/users.php', '1', '1', '1', '1', '账号列表', '0');
INSERT INTO `vich_menu_url` VALUES ('3', '修改账号', '/panel/user_modify.php', '1', '0', '1', '0', '修改账号', '2');
INSERT INTO `vich_menu_url` VALUES ('4', '新建账号', '/panel/user_add.php', '1', '0', '1', '1', '新建账号', '2');
INSERT INTO `vich_menu_url` VALUES ('5', '个人信息', '/panel/profile.php', '1', '0', '1', '1', '个人信息', '0');
INSERT INTO `vich_menu_url` VALUES ('6', '账号组成员', '/panel/group.php', '1', '0', '1', '0', '显示账号组详情及该组成员', '7');
INSERT INTO `vich_menu_url` VALUES ('7', '账号组管理', '/panel/groups.php', '1', '1', '1', '1', '增加管理员', '0');
INSERT INTO `vich_menu_url` VALUES ('8', '修改账号组', '/panel/group_modify.php', '1', '0', '1', '0', '修改账号组', '7');
INSERT INTO `vich_menu_url` VALUES ('9', '新建账号组', '/panel/group_add.php', '1', '0', '1', '1', '新建账号组', '7');
INSERT INTO `vich_menu_url` VALUES ('10', '权限管理', '/panel/group_role.php', '1', '1', '1', '1', '用户权限依赖于账号组的权限', '0');
INSERT INTO `vich_menu_url` VALUES ('11', '菜单模块', '/panel/modules.php', '1', '1', '1', '1', '菜单里的模块', '0');
INSERT INTO `vich_menu_url` VALUES ('12', '编辑菜单模块', '/panel/module_modify.php', '1', '0', '1', '0', '编辑模块', '11');
INSERT INTO `vich_menu_url` VALUES ('13', '添加菜单模块', '/panel/module_add.php', '1', '0', '1', '1', '添加菜单模块', '11');
INSERT INTO `vich_menu_url` VALUES ('14', '功能列表', '/panel/menus.php', '1', '1', '1', '1', '菜单功能及可访问的链接', '0');
INSERT INTO `vich_menu_url` VALUES ('15', '增加功能', '/panel/menu_add.php', '1', '0', '1', '1', '增加功能', '14');
INSERT INTO `vich_menu_url` VALUES ('16', '功能修改', '/panel/menu_modify.php', '1', '0', '1', '0', '修改功能', '14');
INSERT INTO `vich_menu_url` VALUES ('17', '设置模板', '/panel/set.php', '1', '0', '1', '1', '设置模板', '0');
INSERT INTO `vich_menu_url` VALUES ('18', '便签管理', '/panel/quicknotes.php', '1', '1', '1', '1', 'quick note', '0');
INSERT INTO `vich_menu_url` VALUES ('19', '菜单链接列表', '/panel/module.php', '1', '0', '1', '0', '显示模块详情及该模块下的菜单', '11');
INSERT INTO `vich_menu_url` VALUES ('20', '登入', '/login.php', '1', '0', '1', '1', '登入页面', '0');
INSERT INTO `vich_menu_url` VALUES ('21', '操作记录', '/panel/syslog.php', '1', '1', '1', '1', '用户操作的历史行为', '0');
INSERT INTO `vich_menu_url` VALUES ('22', '系统信息', '/panel/system.php', '1', '1', '1', '1', '显示系统相关信息', '0');
INSERT INTO `vich_menu_url` VALUES ('23', 'ajax访问修改快捷菜单', '/ajax/shortcut.php', '1', '0', '1', '0', 'ajax请求', '0');
INSERT INTO `vich_menu_url` VALUES ('24', '添加便签', '/panel/quicknote_add.php', '1', '0', '1', '1', '添加quicknote的内容', '18');
INSERT INTO `vich_menu_url` VALUES ('25', '修改便签', '/panel/quicknote_modify.php', '1', '0', '1', '0', '修改quicknote的内容', '18');
INSERT INTO `vich_menu_url` VALUES ('26', '系统设置', '/panel/setting.php', '1', '0', '1', '0', '系统设置', '0');
INSERT INTO `vich_menu_url` VALUES ('105', '新增产品', '/sys/goods_add.php', '4', '0', '1', '1', '', '107');
INSERT INTO `vich_menu_url` VALUES ('106', '编辑产品', '/sys/goods_modify.php', '4', '0', '1', '0', '', '107');
INSERT INTO `vich_menu_url` VALUES ('107', '产品管理', '/sys/goods.php', '4', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('108', '产品分类管理', '/sys/goods_cats.php', '4', '1', '1', '1', null, '0');
INSERT INTO `vich_menu_url` VALUES ('109', '增加产品分类', '/sys/goods_cats_add.php', '4', '0', '1', '1', '', '108');
INSERT INTO `vich_menu_url` VALUES ('110', '编辑产品分类', '/sys/goods_cats_modify.php', '4', '0', '1', '0', '', '108');
INSERT INTO `vich_menu_url` VALUES ('111', '供应商管理', '/sys/suppliers.php', '4', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('112', '新增供应商', '/sys/suppliers_add.php', '4', '0', '1', '1', '', '111');
INSERT INTO `vich_menu_url` VALUES ('113', '编辑供应商', '/sys/suppliers_modify.php', '4', '0', '1', '0', '', '111');
INSERT INTO `vich_menu_url` VALUES ('114', '员工管理', '/sys/employee.php', '4', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('115', '新增员工', '/sys/employee_add.php', '4', '0', '1', '1', '', '114');
INSERT INTO `vich_menu_url` VALUES ('116', '编辑员工', '/sys/employee_modify.php', '4', '0', '1', '0', '', '114');
INSERT INTO `vich_menu_url` VALUES ('117', '公司管理', '/sys/company.php', '4', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('118', '新增公司', '/sys/company_add.php', '4', '0', '1', '1', '', '117');
INSERT INTO `vich_menu_url` VALUES ('119', '编辑公司', '/sys/company_modify.php', '4', '0', '1', '0', '', '117');
INSERT INTO `vich_menu_url` VALUES ('120', '部门管理', '/sys/department.php', '4', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('121', '新增部门', '/sys/department_add.php', '4', '0', '1', '1', '', '120');
INSERT INTO `vich_menu_url` VALUES ('122', '编辑部门', '/sys/department_modify.php', '4', '0', '1', '0', '', '120');
INSERT INTO `vich_menu_url` VALUES ('123', '仓库管理', '/sys/depot.php', '4', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('124', '新增仓库', '/sys/depot_add.php', '4', '0', '1', '1', '', '123');
INSERT INTO `vich_menu_url` VALUES ('125', '编辑仓库', '/sys/depot_modify.php', '4', '0', '1', '0', '', '123');
INSERT INTO `vich_menu_url` VALUES ('126', '采购订单', '/purchase/plan_order.php', '10', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('127', '采购订单录入', '/purchase/plan_order_add.php', '10', '0', '1', '0', '', '126');
INSERT INTO `vich_menu_url` VALUES ('128', '采购单修改', '/purchase/plan_order_modify.php', '10', '0', '1', '0', '', '126');
INSERT INTO `vich_menu_url` VALUES ('129', '采购进货单', '/purchase/arrival_order.php', '10', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('130', '采购退货单', '/purchase/return_order.php', '10', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('131', '采购发票', '/purchase/invoice.php', '10', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('132', '价格管理', '/purchase/price.php', '10', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('133', '应付款单', '/finance/pay_order.php', '8', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('134', '财务详情', '/finance/finance_detail.php', '8', '0', '1', '0', '', '149');
INSERT INTO `vich_menu_url` VALUES ('135', '采购入库单', '/storage/purchase_storage.php', '5', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('137', '其他入库单', '/storage/other_storage.php', '5', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('138', '调拨入库单', '/storage/allot_storage.php', '5', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('139', '领用出库单', '/storage/using_deliver.php', '5', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('140', '其他出库单', '/storage/other_deliver.php', '5', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('141', '库存盘点单', '/storage/count_order.php', '5', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('142', '各部门领用明细表', '/charts/purchase.php', '7', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('143', '各部门领用汇总表', '/charts/return.php', '7', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('144', '材料入库、出库、盘存明细表', '/charts/suppliers.php', '7', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('145', '材料入库、出库、盘存汇总表', '/charts/global.php', '7', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('148', '应付款单添加财务', '/finance/pay_add.php', '8', '0', '1', '0', '', '133');
INSERT INTO `vich_menu_url` VALUES ('149', '财务查询', '/finance/search.php', '8', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('150', '应收账款', '/finance/collect.php', '8', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('151', '产品计量管理', '/sys/unit.php', '4', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('152', '增加产品计量单位', '/sys/unit_add.php', '4', '0', '1', '1', '', '151');
INSERT INTO `vich_menu_url` VALUES ('153', '编辑产品计量单位', '/sys/unit_modify.php', '4', '0', '1', '0', '', '151');
INSERT INTO `vich_menu_url` VALUES ('161', '采购退货单录入', '/purchase/return_order_add.php', '10', '0', '1', '0', '', '130');
INSERT INTO `vich_menu_url` VALUES ('162', '登记入库商品', '/storage/purchase_storage_add.php', '5', '0', '1', '0', '', '135');
INSERT INTO `vich_menu_url` VALUES ('163', '商品查询', '/purchase/goods_search.php', '10', '0', '1', '0', '', '0');
INSERT INTO `vich_menu_url` VALUES ('164', '登记出库单', '/storage/using_deliver_add.php', '5', '0', '1', '0', '', '139');
INSERT INTO `vich_menu_url` VALUES ('165', '调拨入库单新增', '/storage/allot_storage_add.php', '5', '0', '1', '0', '', '138');
INSERT INTO `vich_menu_url` VALUES ('166', '增加盘点单', '/storage/count_order_add.php', '5', '0', '1', '0', '', '141');
INSERT INTO `vich_menu_url` VALUES ('167', '删除公司', '/sys/company_del.php', '4', '0', '1', '0', '', '117');
INSERT INTO `vich_menu_url` VALUES ('168', '删除部门', '/sys/department_del.php', '4', '0', '1', '0', '', '120');
INSERT INTO `vich_menu_url` VALUES ('169', '删除员工', '/sys/employee_del.php', '4', '0', '1', '0', '', '114');
INSERT INTO `vich_menu_url` VALUES ('170', '产品分类删除', '/sys/goods_cats_del.php', '4', '0', '1', '0', '', '108');
INSERT INTO `vich_menu_url` VALUES ('171', '产品计量单位删除', '/sys/unit_del.php', '4', '0', '1', '0', '', '151');
INSERT INTO `vich_menu_url` VALUES ('172', '删除商品', '/sys/goods_del.php', '4', '0', '1', '0', '删除商品', '107');
INSERT INTO `vich_menu_url` VALUES ('173', '删除供应商', '/sys/suppliers_del.php', '4', '0', '1', '0', '', '111');
INSERT INTO `vich_menu_url` VALUES ('174', '客户管理', '/sys/customer.php', '4', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('175', '供应商审核', '/sys/suppliers_review.php', '4', '0', '1', '0', '', '111');
INSERT INTO `vich_menu_url` VALUES ('176', '库存预警', '/message/storage.php', '12', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('177', '价格预警', '/message/price.php', '12', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('178', '待办事务', '/message/other.php', '12', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('179', '产品条码打印', '/code/goods_qrcode.php', '11', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('180', '库位条码打印', '/code/depotSub_qrcode.php', '11', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('181', '产品打印预览', '/code/preview.php', '11', '0', '1', '0', '', '179');
INSERT INTO `vich_menu_url` VALUES ('182', '价格管理趋势图', '/purchase/price_view.php', '10', '0', '1', '0', '', '132');
INSERT INTO `vich_menu_url` VALUES ('183', '价格管理详情列表', '/purchase/price_list.php', '10', '0', '1', '0', '', '132');
INSERT INTO `vich_menu_url` VALUES ('184', '采购进货单录入', '/purchase/arrival_order_add.php', '10', '0', '1', '0', '', '129');
INSERT INTO `vich_menu_url` VALUES ('185', '库位产品列表', '/sys/depotSub_goods.php', '4', '0', '1', '0', '', '123');
INSERT INTO `vich_menu_url` VALUES ('186', '新增库位', '/sys/depotSub_add.php', '4', '0', '1', '0', '', '123');
INSERT INTO `vich_menu_url` VALUES ('187', '产品二维码设计', '/code/design.php', '11', '0', '1', '0', '', '179');
INSERT INTO `vich_menu_url` VALUES ('188', '库位打印预览', '/code/depotSub_preview.php', '11', '0', '1', '0', '', '180');
INSERT INTO `vich_menu_url` VALUES ('189', '新增客户', '/sys/customer_add.php', '4', '0', '1', '0', '', '174');
INSERT INTO `vich_menu_url` VALUES ('190', '编辑客户', '/sys/customer_modify.php', '4', '0', '1', '0', '', '174');
INSERT INTO `vich_menu_url` VALUES ('191', '删除客户', '/sys/customer_del.php', '4', '0', '1', '0', '', '174');
INSERT INTO `vich_menu_url` VALUES ('192', '调拨出库单', '/storage/allot_deliver.php', '5', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('193', '采购订单审核', '/purchase/plan_order_review.php', '10', '0', '1', '0', '', '126');
INSERT INTO `vich_menu_url` VALUES ('194', '采购进货单审核', '/purchase/arrival_order_review.php', '10', '0', '1', '0', '', '129');
INSERT INTO `vich_menu_url` VALUES ('195', '采购退货单审核', '/purchase/return_order_review.php', '10', '0', '1', '0', '', '130');
INSERT INTO `vich_menu_url` VALUES ('196', '采购入库单审核', '/storage/purchase_storage_review.php', '5', '0', '1', '0', '', '135');
INSERT INTO `vich_menu_url` VALUES ('197', '其他入库单审核', '/storage/other_storage_review.php', '5', '0', '1', '0', '', '137');
INSERT INTO `vich_menu_url` VALUES ('198', '调拨入库单审核', '/storage/allot_storage_review.php', '5', '0', '1', '0', '', '138');
INSERT INTO `vich_menu_url` VALUES ('199', '领用出库单审核', '/storage/using_deliver_review.php', '5', '0', '1', '0', '', '139');
INSERT INTO `vich_menu_url` VALUES ('200', '其他出库单审核', '/storage/other_deliver_review.php', '5', '0', '1', '0', '', '140');
INSERT INTO `vich_menu_url` VALUES ('201', '调拨出库单审核', '/storage/allot_deliver_review.php', '5', '0', '1', '0', '', '192');
INSERT INTO `vich_menu_url` VALUES ('202', '库存盘点单审核', '/storage/count_order_review.php', '5', '0', '1', '0', '', '141');
INSERT INTO `vich_menu_url` VALUES ('203', '采购订单创建', '/purchase/plan_order_create.php', '10', '0', '1', '0', '', '126');
INSERT INTO `vich_menu_url` VALUES ('204', '采购订单详情', '/purchase/plan_order_details.php', '10', '0', '1', '0', '', '126');
INSERT INTO `vich_menu_url` VALUES ('205', '进货单创建', '/purchase/arrival_order_create.php', '10', '0', '1', '0', 'xxx', '129');
INSERT INTO `vich_menu_url` VALUES ('206', '进货单详情', '/purchase/arrival_order_details.php', '10', '0', '1', '0', '', '129');
INSERT INTO `vich_menu_url` VALUES ('207', '进货单修改', '/purchase/arrival_order_modify.php', '10', '0', '1', '0', '', '129');
INSERT INTO `vich_menu_url` VALUES ('208', '采购退货单创建', '/purchase/return_order_create.php', '10', '0', '1', '0', '', '130');
INSERT INTO `vich_menu_url` VALUES ('209', '采购退货单详情', '/purchase/return_order_details.php', '10', '0', '1', '0', '', '130');
INSERT INTO `vich_menu_url` VALUES ('210', '采购退货单修改', '/purchase/return_order_modify.php', '10', '0', '1', '0', '', '130');
INSERT INTO `vich_menu_url` VALUES ('211', '采购入库单创建', '/storage/purchase_storage_create.php', '5', '0', '1', '0', 'xxxx', '135');
INSERT INTO `vich_menu_url` VALUES ('212', '采购入库单详情', '/storage/purchase_storage_details.php', '5', '0', '1', '0', 'xx', '135');
INSERT INTO `vich_menu_url` VALUES ('213', '采购入库单修改', '/storage/purchase_storage_modify.php', '5', '0', '1', '0', '', '135');
INSERT INTO `vich_menu_url` VALUES ('214', '商品查询', '/storage/goods_search.php', '5', '0', '1', '0', '', '0');
INSERT INTO `vich_menu_url` VALUES ('215', '调拨入库单创建', '/storage/allot_storage_create.php', '5', '0', '1', '0', '', '138');
INSERT INTO `vich_menu_url` VALUES ('216', '调拨入库单详情', '/storage/allot_storage_details.php', '5', '0', '1', '0', '\r\n', '138');
INSERT INTO `vich_menu_url` VALUES ('217', '调拨入库单修改', '/storage/allot_storage_modify.php', '5', '0', '1', '0', '', '138');
INSERT INTO `vich_menu_url` VALUES ('218', '调拨出库单创建', '/storage/allot_deliver_create.php', '5', '0', '1', '0', '', '192');
INSERT INTO `vich_menu_url` VALUES ('219', '调拨出库单详情', '/storage/allot_deliver_details.php', '5', '0', '1', '0', '', '192');
INSERT INTO `vich_menu_url` VALUES ('220', '调拨出库单修改', '/storage/allot_deliver_modify.php', '5', '0', '1', '0', '', '192');
INSERT INTO `vich_menu_url` VALUES ('221', '调拨出库单录入', '/storage/allot_deliver_add.php', '5', '0', '1', '0', '', '192');
INSERT INTO `vich_menu_url` VALUES ('222', '领用出库单创建', '/storage/using_deliver_create.php', '5', '0', '1', '0', '', '139');
INSERT INTO `vich_menu_url` VALUES ('223', '领用出库单详情', '/storage/using_deliver_details.php', '5', '0', '1', '0', '', '139');
INSERT INTO `vich_menu_url` VALUES ('224', '领用出库单修改', '/storage/using_deliver_modify.php', '5', '0', '1', '0', '', '139');
INSERT INTO `vich_menu_url` VALUES ('225', '库存盘点单创建', '/storage/count_order_create.php', '5', '0', '1', '0', '', '141');
INSERT INTO `vich_menu_url` VALUES ('226', '库存盘点单详情', '/storage/count_order_details.php', '5', '0', '1', '0', '', '141');
INSERT INTO `vich_menu_url` VALUES ('227', '库存盘点单修改', '/storage/count_order_modify.php', '5', '0', '1', '0', '', '141');
INSERT INTO `vich_menu_url` VALUES ('228', '采购订单商品删除', '/purchase/plan_order_delete.php', '10', '0', '1', '0', '', '126');
INSERT INTO `vich_menu_url` VALUES ('229', '进货单商品删除', '/purchase/arrival_order_delete.php', '10', '0', '1', '0', '', '129');
INSERT INTO `vich_menu_url` VALUES ('230', '退货单商品删除', '/purchase/return_order_delete.php', '10', '0', '1', '0', '', '130');
INSERT INTO `vich_menu_url` VALUES ('231', '采购入库单商品删除', '/storage/ip_goods_delete.php', '5', '0', '1', '0', '', '135');
INSERT INTO `vich_menu_url` VALUES ('232', '调拨入库单商品删除', '/storage/id_goods_delete.php', '5', '0', '1', '0', '', '138');
INSERT INTO `vich_menu_url` VALUES ('233', '领用出库单商品删除', '/storage/oy_goods_delete.php', '5', '0', '1', '0', '', '139');
INSERT INTO `vich_menu_url` VALUES ('234', '库存盘点单商品删除', '/storage/pd_goods_delete.php', '5', '0', '1', '0', '', '141');
INSERT INTO `vich_menu_url` VALUES ('235', '调拨出库单商品删除', '/storage/od_goods_delete.php', '5', '0', '1', '0', '', '192');
INSERT INTO `vich_menu_url` VALUES ('236', '采购订单删除', '/purchase/plan_delete.php', '10', '0', '1', '0', '', '126');
INSERT INTO `vich_menu_url` VALUES ('237', '进货单删除', '/purchase/arrival_delete.php', '10', '0', '1', '0', '', '129');
INSERT INTO `vich_menu_url` VALUES ('238', '退货单删除', '/purchase/return_delete.php', '10', '0', '1', '0', '', '130');
INSERT INTO `vich_menu_url` VALUES ('239', '采购入库单删除', '/storage/ip_delete.php', '5', '0', '1', '0', '', '135');
INSERT INTO `vich_menu_url` VALUES ('240', '调拨入库单删除', '/storage/id_delete.php', '5', '0', '1', '0', '', '138');
INSERT INTO `vich_menu_url` VALUES ('241', '领用出库单删除', '/storage/oy_delete.php', '5', '0', '1', '0', '', '139');
INSERT INTO `vich_menu_url` VALUES ('242', '库存盘点单删除', '/storage/pd_delete.php', '5', '0', '1', '0', '', '141');
INSERT INTO `vich_menu_url` VALUES ('243', '调拨出库单删除', '/storage/od_delete.php', '5', '0', '1', '0', '', '192');
INSERT INTO `vich_menu_url` VALUES ('244', '采购订单提交审核', '/purchase/plan_to_review.php', '10', '0', '1', '0', '', '126');
INSERT INTO `vich_menu_url` VALUES ('245', '进货单提交审核', '/purchase/arrival_to_review.php', '10', '0', '1', '0', '', '129');
INSERT INTO `vich_menu_url` VALUES ('246', '退货单提交审核', '/purchase/return_to_review.php', '10', '0', '1', '0', '', '130');
INSERT INTO `vich_menu_url` VALUES ('247', '采购入库单提交审核', '/storage/ip_to_review.php', '5', '0', '1', '0', '', '135');
INSERT INTO `vich_menu_url` VALUES ('248', '调拨入库单提交审核', '/storage/id_to_review.php', '5', '0', '1', '0', '', '138');
INSERT INTO `vich_menu_url` VALUES ('249', '领用出库单提交审核', '/storage/oy_to_review.php', '5', '0', '1', '0', '', '139');
INSERT INTO `vich_menu_url` VALUES ('250', '库存盘点单提交审核', '/storage/pd_to_review.php', '5', '0', '1', '0', '', '141');
INSERT INTO `vich_menu_url` VALUES ('251', '调拨出库单提交审核', '/storage/od_to_review.php', '5', '0', '1', '0', '', '192');
INSERT INTO `vich_menu_url` VALUES ('252', '其他入库单详情', '/storage/other_storage_details.php', '5', '0', '1', '0', '', '137');
INSERT INTO `vich_menu_url` VALUES ('253', '其他出库单详情', '/storage/other_deliver_details.php', '5', '0', '1', '0', '', '140');
INSERT INTO `vich_menu_url` VALUES ('254', '删除库位', '/sys/depotSub_del.php', '4', '0', '1', '0', '', '123');
INSERT INTO `vich_menu_url` VALUES ('255', '删除仓库', '/sys/depot_del.php', '4', '0', '1', '0', '', '123');
INSERT INTO `vich_menu_url` VALUES ('256', '编辑库位', '/sys/depotSub_modify.php', '4', '0', '1', '0', '', '123');
INSERT INTO `vich_menu_url` VALUES ('257', '上传发票', '/ajax/base64Upload.php', '8', '0', '1', '0', '', '133');
INSERT INTO `vich_menu_url` VALUES ('258', '发票详情', '/purchase/invoice_details.php', '10', '0', '1', '0', '', '131');
INSERT INTO `vich_menu_url` VALUES ('259', '库存预警添加设置', '/message/storage_setting.php', '12', '0', '1', '0', '', '260');
INSERT INTO `vich_menu_url` VALUES ('260', '库存预警设置', '/message/storage_sets.php', '12', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('261', '库存预警设置修改', '/message/storage_modify.php', '12', '0', '1', '0', '', '260');
INSERT INTO `vich_menu_url` VALUES ('262', '库存预警设置删除', '/message/storage_del.php', '12', '0', '1', '0', '', '260');
INSERT INTO `vich_menu_url` VALUES ('263', '价格预警设置', '/message/price_sets.php', '12', '1', '1', '1', '价格预警设置', '0');
INSERT INTO `vich_menu_url` VALUES ('264', '价格预警设置新增', '/message/price_setting.php', '12', '0', '1', '0', '', '263');
INSERT INTO `vich_menu_url` VALUES ('265', '价格预警设置编辑', '/message/price_modify.php', '12', '0', '1', '0', '', '263');
INSERT INTO `vich_menu_url` VALUES ('266', '价格预警设置删除', '/message/price_del.php', '12', '0', '1', '0', '', '263');
INSERT INTO `vich_menu_url` VALUES ('267', '销售订单', '/sales/index.php', '13', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('268', '销售订单创建', '/sales/create.php', '13', '0', '1', '0', '', '267');
INSERT INTO `vich_menu_url` VALUES ('269', '销售订单产品修改', '/sales/edit.php', '13', '0', '1', '0', '', '267');
INSERT INTO `vich_menu_url` VALUES ('270', '销售订单审核', '/sales/review.php', '13', '0', '1', '0', '', '267');
INSERT INTO `vich_menu_url` VALUES ('271', '销售订单删除', '/sales/del.php', '13', '0', '1', '0', '', '267');
INSERT INTO `vich_menu_url` VALUES ('272', '销售订单详情', '/sales/details.php', '13', '0', '1', '0', '', '267');
INSERT INTO `vich_menu_url` VALUES ('273', '销售订单产品新增', '/sales/add.php', '13', '0', '1', '0', '', '267');
INSERT INTO `vich_menu_url` VALUES ('274', '商品查询', '/sales/goods_search.php', '13', '0', '1', '0', '', '267');
INSERT INTO `vich_menu_url` VALUES ('275', '提交审核', '/sales/to_review.php', '13', '0', '1', '0', '', '267');
INSERT INTO `vich_menu_url` VALUES ('276', '订单商品删除', '/sales/goods_del.php', '13', '0', '1', '0', '', '267');
INSERT INTO `vich_menu_url` VALUES ('277', '应收账款添加财务', '/finance/collect_add.php', '8', '0', '1', '0', '', '150');
INSERT INTO `vich_menu_url` VALUES ('278', '添加财务', '/finance/finance_add.php', '8', '0', '1', '0', '', '149');
INSERT INTO `vich_menu_url` VALUES ('279', '应收款单收票', '/finance/pay_collect.php', '8', '0', '1', '0', '', '150');
INSERT INTO `vich_menu_url` VALUES ('280', '采购明细/汇总表', '/charts/chart1.php', '7', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('281', '库存明细/汇总表', '/charts/chart2.php', '7', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('282', '调拨明细/汇总表', '/charts/chart3.php', '7', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('283', '入库明细/汇总表', '/charts/chart4.php', '7', '1', '1', '1', '', '0');
INSERT INTO `vich_menu_url` VALUES ('284', '出库明细/汇总表', '/charts/chart5.php', '7', '1', '1', '1', '', '0');

-- ----------------------------
-- Table structure for `vich_messages`
-- ----------------------------
DROP TABLE IF EXISTS `vich_messages`;
CREATE TABLE `vich_messages` (
  `messageId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fromUser` int(11) NOT NULL,
  `toUser` int(11) NOT NULL,
  `content` text,
  `type` tinyint(4) NOT NULL COMMENT '类型 1库存预警 2价格预警 3待办事务',
  `companyId` int(11) DEFAULT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1已读 -1删除',
  `createTime` datetime NOT NULL,
  `showType` tinyint(4) DEFAULT '0' COMMENT '1缺货提醒 2滞销提醒 3库存异常 4催票提醒 5催款提醒',
  `targetId` int(11) DEFAULT '0' COMMENT '对象Id',
  PRIMARY KEY (`messageId`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8 COMMENT='消息表';

-- ----------------------------
-- Records of vich_messages
-- ----------------------------
INSERT INTO `vich_messages` VALUES ('132', '0', '1', '催票提醒：发票号:IN1709082248218745,预计收票时间:2017-09-13 00:00:00', '3', '32', '0', '2017-10-18 14:54:54', '4', null);
INSERT INTO `vich_messages` VALUES ('133', '0', '1', '催票提醒：发票号:IN1709082252437384,预计收票时间:2017-09-13 00:00:00', '3', '32', '0', '2017-10-18 14:54:54', '4', null);
INSERT INTO `vich_messages` VALUES ('134', '0', '1', '催票提醒：发票号:IN1709082248218745,预计收票时间:2017-09-13 00:00:00', '3', '32', '0', '2017-10-18 15:27:20', '4', '1');
INSERT INTO `vich_messages` VALUES ('135', '0', '1', '催票提醒：发票号:IN1709082252437384,预计收票时间:2017-09-13 00:00:00', '3', '32', '0', '2017-10-18 15:27:20', '4', '2');
INSERT INTO `vich_messages` VALUES ('136', '0', '1', '催票提醒：发票号:IN1709082248218745,预计收票时间:2017-09-13 00:00:00', '3', '32', '0', '2017-10-18 15:47:26', '4', '1');
INSERT INTO `vich_messages` VALUES ('137', '0', '1', '催票提醒：发票号:IN1709082252437384,预计收票时间:2017-09-13 00:00:00', '3', '32', '0', '2017-10-18 15:47:26', '4', '2');
INSERT INTO `vich_messages` VALUES ('138', '1', '1', '销售单待审核：单号:SO1710181430503478,金额:1.00,时间:2017-10-18 14:30:50', '3', '32', '0', '2017-10-18 15:50:48', '0', '0');
INSERT INTO `vich_messages` VALUES ('140', '0', '1', '发货提醒：单号:SO1710181430503478,预计发货时间:2017-10-20 00:00:00', '3', '32', '0', '2017-10-18 15:52:16', '0', '5');
INSERT INTO `vich_messages` VALUES ('141', '1', '1', '盘点单待审核：单号:PD1711031338574625,金额:10.00,时间:2017-11-03 13:38:57', '3', '32', '0', '2017-11-03 13:41:39', '0', '0');
INSERT INTO `vich_messages` VALUES ('142', '1', '1', '其他出库单待审核：单号:OQ1711031341442282,金额:0,时间:2017-11-03 13:41:44', '3', '32', '0', '2017-11-03 13:41:44', '0', '0');
INSERT INTO `vich_messages` VALUES ('143', '0', '1', '库存异常：库位:A库位,商品批次:PN1709082238527438,系统库存比盘点库存多数量：2', '1', '32', '0', '2017-11-03 13:41:44', '3', '0');
INSERT INTO `vich_messages` VALUES ('144', '1', '1', '盘点单待审核：单号:PD1711031344275257,金额:35.00,时间:2017-11-03 13:44:27', '3', '32', '0', '2017-11-03 13:45:10', '0', '0');
INSERT INTO `vich_messages` VALUES ('145', '1', '1', '其他出库单待审核：单号:OQ1711031345134293,金额:0,时间:2017-11-03 13:45:13', '3', '32', '0', '2017-11-03 13:45:13', '0', '0');
INSERT INTO `vich_messages` VALUES ('146', '0', '1', '库存异常：库位:A库位,商品批次:PN1709082238527438,系统库存比盘点库存多数量：1', '1', '32', '0', '2017-11-03 13:45:13', '3', '0');
INSERT INTO `vich_messages` VALUES ('147', '1', '1', '其他入库单待审核：单号:IQ1711031345132040,金额:0,时间:2017-11-03 13:45:13', '3', '32', '0', '2017-11-03 13:45:13', '0', '0');
INSERT INTO `vich_messages` VALUES ('148', '0', '1', '库存异常：库位:A库位,商品批次:PN1709082251052391,系统库存比盘点库存多数量：1', '1', '32', '0', '2017-11-03 13:45:13', '3', '0');
INSERT INTO `vich_messages` VALUES ('149', '1', '1', '采购计划单待审核：单号:PR1711031525021831,金额:100.00,时间:2017-11-03 15:25:02', '3', '32', '0', '2017-11-03 15:26:17', '0', '0');
INSERT INTO `vich_messages` VALUES ('150', '1', '1', '采购计划单待审核：单号:PR1711031525021831,金额:300.00,时间:2017-11-03 15:25:02', '3', '32', '0', '2017-11-03 15:26:50', '0', '0');
INSERT INTO `vich_messages` VALUES ('151', '1', '1', '销售单待审核：单号:SO1711031528557998,金额:100.00,时间:2017-11-03 15:28:55', '3', '32', '0', '2017-11-03 15:29:24', '0', '0');
INSERT INTO `vich_messages` VALUES ('152', '1', '1', '采购计划单待审核：单号:PR1710200918214352,金额:150.00,时间:2017-10-20 09:18:21', '3', '32', '0', '2017-11-03 15:40:54', '0', '0');
INSERT INTO `vich_messages` VALUES ('153', '1', '1', '采购入库单待审核：单号:IP1711031541593523,金额:205.00,时间:2017-11-03 15:41:59', '3', '32', '0', '2017-11-03 15:43:15', '0', '0');
INSERT INTO `vich_messages` VALUES ('154', '1', '1', '领用出库单待审核：单号:OY1711031531233872,金额:100.00,时间:2017-11-03 15:31:23', '3', '32', '0', '2017-11-04 09:47:17', '0', '0');
INSERT INTO `vich_messages` VALUES ('155', '0', '1', '库存预警：库位:D库位,商品:6B、HB、2B、3B铅笔,库存:0', '1', '32', '0', '2017-11-04 09:47:32', '1', '0');
INSERT INTO `vich_messages` VALUES ('156', '0', '1', '库存预警：库位:A库位,商品:6B、HB、2B、3B铅笔,库存:3', '1', '32', '0', '2017-11-04 09:47:32', '1', '0');
INSERT INTO `vich_messages` VALUES ('157', '0', '1', '库存预警：库位:A库位,商品:白圆铅笔,库存:1', '1', '32', '0', '2017-11-04 09:47:32', '1', '0');
INSERT INTO `vich_messages` VALUES ('158', '0', '1', '库存预警：库位:A库位,商品:打孔机,库存:0', '1', '32', '0', '2017-11-04 09:47:32', '1', '0');

-- ----------------------------
-- Table structure for `vich_module`
-- ----------------------------
DROP TABLE IF EXISTS `vich_module`;
CREATE TABLE `vich_module` (
  `module_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `module_url` varchar(128) NOT NULL,
  `module_sort` int(11) unsigned NOT NULL DEFAULT '1',
  `module_desc` varchar(255) DEFAULT NULL,
  `module_icon` varchar(32) DEFAULT 'icon-th' COMMENT '菜单模块图标',
  `online` int(11) NOT NULL DEFAULT '1' COMMENT '模块是否在线',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='菜单模块';

-- ----------------------------
-- Records of vich_module
-- ----------------------------
INSERT INTO `vich_module` VALUES ('1', '控制面板', '/panel/index.php', '0', 'erp', 'icon-th', '1');
INSERT INTO `vich_module` VALUES ('4', '系统设置', '/index.php', '1', '', 'icon-cog', '1');
INSERT INTO `vich_module` VALUES ('5', '库存管理', '/index.php', '2', '', 'icon-th-large', '1');
INSERT INTO `vich_module` VALUES ('7', '统计报表', '/index.php', '4', '', 'icon-list-alt', '1');
INSERT INTO `vich_module` VALUES ('8', '财务管理', '/index.php', '6', '', 'icon-folder-close', '1');
INSERT INTO `vich_module` VALUES ('10', '采购管理', '/index.php', '1', '', 'icon-shopping-cart', '1');
INSERT INTO `vich_module` VALUES ('11', '条码管理', '/index.php', '10', '', 'icon-barcode', '1');
INSERT INTO `vich_module` VALUES ('12', '消息管理', '/index.php', '0', '', 'icon-comment', '1');
INSERT INTO `vich_module` VALUES ('13', '销售管理', '/index.php', '1', '', 'icon-star', '1');

-- ----------------------------
-- Table structure for `vich_msetting_depot`
-- ----------------------------
DROP TABLE IF EXISTS `vich_msetting_depot`;
CREATE TABLE `vich_msetting_depot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `depotId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `goodsCateId` int(11) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `minWarnNum` int(11) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='库存预警消息设置';

-- ----------------------------
-- Records of vich_msetting_depot
-- ----------------------------
INSERT INTO `vich_msetting_depot` VALUES ('1', '11', '9', '16', '23', '10', '1', '2017-09-07 15:11:00', '32', '1');
INSERT INTO `vich_msetting_depot` VALUES ('7', '10', '6', '16', '23', '12', '1', '2017-09-08 10:10:30', '32', '1');
INSERT INTO `vich_msetting_depot` VALUES ('8', '10', '6', '16', '22', '5', '1', '2017-09-08 23:22:43', '32', '1');
INSERT INTO `vich_msetting_depot` VALUES ('9', '10', '6', '24', '27', '20', '-1', '2017-11-03 14:57:40', '32', '1');
INSERT INTO `vich_msetting_depot` VALUES ('10', '10', '6', '32', '47', '10', '1', '2017-11-03 15:55:03', '32', '1');

-- ----------------------------
-- Table structure for `vich_msetting_price`
-- ----------------------------
DROP TABLE IF EXISTS `vich_msetting_price`;
CREATE TABLE `vich_msetting_price` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goodsCateId` int(11) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `upPercent` float(5,2) DEFAULT '0.00',
  `downPercent` float(5,2) DEFAULT '0.00',
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='价格预警设置表';

-- ----------------------------
-- Records of vich_msetting_price
-- ----------------------------
INSERT INTO `vich_msetting_price` VALUES ('1', '16', '22', '15.00', '0.00', '1', '32', '1', '2017-09-08 09:51:47');
INSERT INTO `vich_msetting_price` VALUES ('4', '16', '0', '15.00', '5.00', '1', '32', '1', '2017-09-08 11:15:50');
INSERT INTO `vich_msetting_price` VALUES ('5', '16', '26', '0.00', '0.00', '1', '32', '1', '2017-09-08 11:27:04');
INSERT INTO `vich_msetting_price` VALUES ('6', '34', '51', '15.00', '15.00', '-1', '32', '1', '2017-11-03 15:00:54');
INSERT INTO `vich_msetting_price` VALUES ('7', '24', '36', '15.00', '20.00', '1', '32', '1', '2017-11-03 15:56:46');
INSERT INTO `vich_msetting_price` VALUES ('8', '33', '49', '20.00', '20.00', '-1', '32', '1', '2017-11-03 15:57:34');
INSERT INTO `vich_msetting_price` VALUES ('9', '24', '28', '10.00', '10.00', '1', '32', '1', '2017-11-04 08:37:23');

-- ----------------------------
-- Table structure for `vich_orders_dh`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_dh`;
CREATE TABLE `vich_orders_dh` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='采购到货单表';

-- ----------------------------
-- Records of vich_orders_dh
-- ----------------------------
INSERT INTO `vich_orders_dh` VALUES ('1', 'DH1709141426323187', '11', null, '100.00', '10', '1', '2017-09-14 14:38:23', 'xxx', null, '-1', '32', '28', '2017-09-14 14:26:32', '1', '2017-09-14 14:38:23');
INSERT INTO `vich_orders_dh` VALUES ('2', 'DH1710200918301092', '12', null, '0.00', '0', null, null, null, 'xx', '0', '32', '1', '2017-10-20 09:18:30', null, null);
INSERT INTO `vich_orders_dh` VALUES ('3', 'DH1711031527486108', '12', null, '0.00', '0', null, null, null, '', '0', '32', '1', '2017-11-03 15:27:48', null, null);

-- ----------------------------
-- Table structure for `vich_orders_dh_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_dh_goods`;
CREATE TABLE `vich_orders_dh_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='采购到货商品表';

-- ----------------------------
-- Records of vich_orders_dh_goods
-- ----------------------------
INSERT INTO `vich_orders_dh_goods` VALUES ('1', '1', null, '23', '11', null, null, '10.00', '10', 'xx', '1', '32', '28', '2017-09-14 14:37:23', '0');

-- ----------------------------
-- Table structure for `vich_orders_id`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_id`;
CREATE TABLE `vich_orders_id` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='调拨入库单';

-- ----------------------------
-- Records of vich_orders_id
-- ----------------------------
INSERT INTO `vich_orders_id` VALUES ('1', 'ID1711031336501972', null, '10', '100.00', '10', null, null, null, 'xx', '0', '32', '1', '2017-11-03 13:36:50', '1', '2017-11-03 13:37:33');

-- ----------------------------
-- Table structure for `vich_orders_id_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_id_goods`;
CREATE TABLE `vich_orders_id_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of vich_orders_id_goods
-- ----------------------------
INSERT INTO `vich_orders_id_goods` VALUES ('1', '1', 'AN1711031337339029', '22', '11', '6', null, '10.00', '10', 'xxx', '1', '32', '1', '2017-11-03 13:37:33', '10');

-- ----------------------------
-- Table structure for `vich_orders_ip`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_ip`;
CREATE TABLE `vich_orders_ip` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='采购入库单';

-- ----------------------------
-- Records of vich_orders_ip
-- ----------------------------
INSERT INTO `vich_orders_ip` VALUES ('1', 'IP1709082238156922', '12', '10', '100.00', '10', '1', '2017-09-08 22:48:21', '', null, '3', '32', '1', '2017-09-08 22:38:15', '1', '2017-09-08 22:48:21');
INSERT INTO `vich_orders_ip` VALUES ('2', 'IP1709082249259495', '12', null, '150.00', '10', '1', '2017-09-08 22:52:43', '', null, '3', '32', '1', '2017-09-08 22:49:25', '1', '2017-09-08 22:52:43');
INSERT INTO `vich_orders_ip` VALUES ('3', 'IP1709082254233104', '11', null, '120.00', '12', '1', '2017-09-08 22:58:02', '', null, '3', '32', '1', '2017-09-08 22:54:23', '1', '2017-09-08 22:58:02');
INSERT INTO `vich_orders_ip` VALUES ('4', 'IP1710141018139895', '12', null, '100.00', '10', '1', '2017-10-18 09:47:47', '', null, '3', '32', '1', '2017-10-14 10:18:13', '1', '2017-10-18 09:47:47');
INSERT INTO `vich_orders_ip` VALUES ('5', 'IP1711031358169837', '11', null, '0.00', '0', null, null, null, '', '-1', '32', '1', '2017-11-03 13:58:16', null, null);
INSERT INTO `vich_orders_ip` VALUES ('6', 'IP1711031529543159', '11', null, '20.00', '20', null, null, null, '', '-1', '32', '1', '2017-11-03 15:29:54', '1', '2017-11-03 15:30:19');
INSERT INTO `vich_orders_ip` VALUES ('7', 'IP1711031541593523', '11', null, '205.00', '11', '1', '2017-11-03 15:43:29', '11', '1111', '3', '32', '1', '2017-11-03 15:41:59', '1', '2017-11-03 15:43:29');
INSERT INTO `vich_orders_ip` VALUES ('8', 'IP1711031546209608', '11', null, '0.00', '0', null, null, null, '', '0', '32', '1', '2017-11-03 15:46:20', null, null);
INSERT INTO `vich_orders_ip` VALUES ('9', 'IP1711031553247980', '11', null, '15129.00', '123', null, null, null, '', '0', '32', '1', '2017-11-03 15:53:24', '1', '2017-11-03 15:53:37');

-- ----------------------------
-- Table structure for `vich_orders_ip_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_ip_goods`;
CREATE TABLE `vich_orders_ip_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL COMMENT '入库批次',
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vich_orders_ip_goods
-- ----------------------------
INSERT INTO `vich_orders_ip_goods` VALUES ('1', '1', 'PN1709082238527438', '23', '12', '6', null, '10.00', '10', '', '1', '32', '1', '2017-09-08 22:38:52', '10');
INSERT INTO `vich_orders_ip_goods` VALUES ('2', '2', 'PN1709082251052391', '23', '12', '6', null, '15.00', '10', '', '1', '32', '1', '2017-09-08 22:51:05', '10');
INSERT INTO `vich_orders_ip_goods` VALUES ('3', '3', 'PN1709082257501516', '22', '11', '6', null, '10.00', '12', '', '1', '32', '1', '2017-09-08 22:57:50', '10');
INSERT INTO `vich_orders_ip_goods` VALUES ('4', '4', 'PN1710180947345117', '22', '12', '6', null, '10.00', '10', 'xx', '1', '32', '1', '2017-10-18 09:47:34', '10');
INSERT INTO `vich_orders_ip_goods` VALUES ('5', '6', 'PN1711031530199436', '24', '11', '6', null, '1.00', '20', '', '1', '32', '1', '2017-11-03 15:30:19', null);
INSERT INTO `vich_orders_ip_goods` VALUES ('6', '7', 'PN1711031542407799', '28', '11', '6', null, '20.00', '10', '1111', '1', '32', '1', '2017-11-03 15:42:40', null);
INSERT INTO `vich_orders_ip_goods` VALUES ('7', '7', 'PN1711031542588202', '27', '11', '6', null, '5.00', '1', '', '1', '32', '1', '2017-11-03 15:42:58', null);
INSERT INTO `vich_orders_ip_goods` VALUES ('8', '9', 'PN1711031553371973', '22', '11', '6', null, '123.00', '123', '', '1', '32', '1', '2017-11-03 15:53:37', '10');

-- ----------------------------
-- Table structure for `vich_orders_iq`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_iq`;
CREATE TABLE `vich_orders_iq` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='其他入库单';

-- ----------------------------
-- Records of vich_orders_iq
-- ----------------------------
INSERT INTO `vich_orders_iq` VALUES ('1', 'IQ1709090027537251', null, '10', '10.00', '1', '1', '2017-09-09 00:29:04', '', null, '3', '32', '1', '2017-09-09 00:27:53', '1', '2017-09-09 00:29:04');
INSERT INTO `vich_orders_iq` VALUES ('2', 'IQ1709090030173084', null, '10', '10.00', '1', '1', '2017-10-11 17:44:10', '', null, '3', '32', '1', '2017-09-09 00:30:17', '1', '2017-10-11 17:44:10');
INSERT INTO `vich_orders_iq` VALUES ('3', 'IQ1711031345132040', null, '10', '15.00', '1', '1', null, null, null, '1', '32', '1', '2017-11-03 13:45:13', null, null);

-- ----------------------------
-- Table structure for `vich_orders_iq_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_iq_goods`;
CREATE TABLE `vich_orders_iq_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL,
  `depotGoodsId` int(11) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of vich_orders_iq_goods
-- ----------------------------
INSERT INTO `vich_orders_iq_goods` VALUES ('1', '1', 'PN1709082257501516', '9', '22', '11', '6', null, '10.00', '1', null, '1', '32', '1', '2017-09-09 00:27:53', '0');
INSERT INTO `vich_orders_iq_goods` VALUES ('2', '2', 'PN1709082257501516', '9', '22', '11', '6', null, '10.00', '1', null, '1', '32', '1', '2017-09-09 00:30:17', '0');
INSERT INTO `vich_orders_iq_goods` VALUES ('3', '3', 'PN1709082251052391', '8', '23', '12', '6', null, '15.00', '1', null, '1', '32', '1', '2017-11-03 13:45:13', '10');

-- ----------------------------
-- Table structure for `vich_orders_od`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_od`;
CREATE TABLE `vich_orders_od` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='调拨出库单';

-- ----------------------------
-- Records of vich_orders_od
-- ----------------------------
INSERT INTO `vich_orders_od` VALUES ('1', 'OD1711031338263307', null, '10', '10.00', '1', null, null, null, '', '0', '32', '1', '2017-11-03 13:38:26', '1', '2017-11-03 16:44:00');

-- ----------------------------
-- Table structure for `vich_orders_od_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_od_goods`;
CREATE TABLE `vich_orders_od_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL COMMENT '入库批次',
  `depotGoodsId` int(11) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `departmentId` int(11) DEFAULT NULL,
  `employeeId` int(11) DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of vich_orders_od_goods
-- ----------------------------
INSERT INTO `vich_orders_od_goods` VALUES ('1', '1', 'PN1709082257501516', '9', '22', null, '6', null, '9', '13', '10.00', '1', '123', '1', '32', '1', '2017-11-03 15:34:09', '10');

-- ----------------------------
-- Table structure for `vich_orders_oq`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_oq`;
CREATE TABLE `vich_orders_oq` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='其他出库单';

-- ----------------------------
-- Records of vich_orders_oq
-- ----------------------------
INSERT INTO `vich_orders_oq` VALUES ('1', 'OQ1711031341442282', null, '10', '20.00', '2', '1', null, null, null, '1', '32', '1', '2017-11-03 13:41:44', null, null);
INSERT INTO `vich_orders_oq` VALUES ('2', 'OQ1711031345134293', null, '10', '10.00', '1', '1', null, null, null, '1', '32', '1', '2017-11-03 13:45:13', null, null);

-- ----------------------------
-- Table structure for `vich_orders_oq_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_oq_goods`;
CREATE TABLE `vich_orders_oq_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL COMMENT '入库批次',
  `depotGoodsId` int(11) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of vich_orders_oq_goods
-- ----------------------------
INSERT INTO `vich_orders_oq_goods` VALUES ('1', '1', 'PN1709082238527438', '7', '23', '12', '6', null, '10.00', '2', null, '1', '32', '1', '2017-11-03 13:41:44', '0');
INSERT INTO `vich_orders_oq_goods` VALUES ('2', '2', 'PN1709082238527438', '7', '23', '12', '6', null, '10.00', '1', null, '1', '32', '1', '2017-11-03 13:45:13', '10');

-- ----------------------------
-- Table structure for `vich_orders_oy`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_oy`;
CREATE TABLE `vich_orders_oy` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='领用出库单';

-- ----------------------------
-- Records of vich_orders_oy
-- ----------------------------
INSERT INTO `vich_orders_oy` VALUES ('1', 'OY1709082321191674', null, '10', '100.00', '10', '1', '2017-09-08 23:53:32', '', null, '3', '32', '1', '2017-09-08 23:21:19', '1', '2017-09-08 23:53:32');
INSERT INTO `vich_orders_oy` VALUES ('2', 'OY1709230926583832', null, '11', '0.00', '0', null, null, null, null, '0', '32', '1', '2017-09-23 09:26:58', null, null);
INSERT INTO `vich_orders_oy` VALUES ('3', 'OY1709230927168044', null, '10', '230.00', '18', '1', '2017-09-23 09:31:18', '', null, '3', '32', '1', '2017-09-23 09:27:16', '1', '2017-09-23 09:31:18');
INSERT INTO `vich_orders_oy` VALUES ('4', 'OY1710161649359371', null, '10', '0.00', '0', null, null, null, null, '3', '32', '1', '2017-10-16 16:49:35', '1', '2017-11-03 14:04:41');
INSERT INTO `vich_orders_oy` VALUES ('5', 'OY1711031531233872', null, '10', '100.00', '10', '1', '2017-11-04 09:47:32', '', '', '3', '32', '1', '2017-11-03 15:31:23', '1', '2017-11-04 09:47:32');

-- ----------------------------
-- Table structure for `vich_orders_oy_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_oy_goods`;
CREATE TABLE `vich_orders_oy_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL COMMENT '入库批次',
  `depotGoodsId` int(11) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `departmentId` int(11) DEFAULT NULL,
  `employeeId` int(11) DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of vich_orders_oy_goods
-- ----------------------------
INSERT INTO `vich_orders_oy_goods` VALUES ('1', '1', 'PN1709082257501516', '9', '22', '11', '6', null, '9', '13', '10.00', '10', '', '1', '32', '1', '2017-09-08 23:22:15', null);
INSERT INTO `vich_orders_oy_goods` VALUES ('2', '1', 'PN1709082251052391', '8', '23', '12', '6', null, '9', '13', '15.00', '10', '', '-1', '32', '1', '2017-09-08 23:23:58', null);
INSERT INTO `vich_orders_oy_goods` VALUES ('3', '1', 'PN1709082238527438', '7', '23', '12', '6', null, '9', '13', '10.00', '10', '', '-1', '32', '1', '2017-09-08 23:24:15', null);
INSERT INTO `vich_orders_oy_goods` VALUES ('4', '3', 'PN1709082238527438', '7', '23', '12', '6', null, '9', '13', '10.00', '5', '', '1', '32', '1', '2017-09-23 09:27:32', null);
INSERT INTO `vich_orders_oy_goods` VALUES ('5', '3', 'PN1709082251052391', '8', '23', '12', '6', null, '11', '20', '15.00', '10', '', '1', '32', '1', '2017-09-23 09:27:46', null);
INSERT INTO `vich_orders_oy_goods` VALUES ('6', '3', 'PN1709082257501516', '9', '22', '11', '6', null, '12', '11', '10.00', '3', '', '1', '32', '1', '2017-09-23 09:27:59', null);
INSERT INTO `vich_orders_oy_goods` VALUES ('7', '4', 'PN1709082238527438', '7', '23', null, '6', null, '12', '11', '10.00', '2', '', '-1', '32', '1', '2017-11-03 14:04:16', '10');
INSERT INTO `vich_orders_oy_goods` VALUES ('8', '5', 'PN1710180947345117', '10', '22', null, '6', null, '11', '20', '10.00', '10', '', '1', '32', '1', '2017-11-03 15:32:26', '10');

-- ----------------------------
-- Table structure for `vich_orders_pd`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_pd`;
CREATE TABLE `vich_orders_pd` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='盘点单';

-- ----------------------------
-- Records of vich_orders_pd
-- ----------------------------
INSERT INTO `vich_orders_pd` VALUES ('1', 'PD1709090025144518', null, '10', '30.00', '3', '1', '2017-09-09 00:27:53', '', null, '3', '32', '1', '2017-09-09 00:25:14', '1', '2017-09-09 00:27:53');
INSERT INTO `vich_orders_pd` VALUES ('2', 'PD1709090029175148', null, '10', '40.00', '4', '1', '2017-09-09 00:30:17', '', null, '3', '32', '1', '2017-09-09 00:29:17', '1', '2017-09-09 00:30:17');
INSERT INTO `vich_orders_pd` VALUES ('3', 'PD1710161758569386', null, '10', '70.00', '7', null, null, null, null, '0', '32', '1', '2017-10-16 17:58:56', '1', '2017-10-16 17:59:19');
INSERT INTO `vich_orders_pd` VALUES ('4', 'PD1710200918031212', null, '10', '0.00', '0', null, null, null, '111', '0', '32', '1', '2017-10-20 09:18:03', '1', '2017-11-03 14:06:03');
INSERT INTO `vich_orders_pd` VALUES ('5', 'PD1711031338574625', null, '10', '10.00', '1', '1', '2017-11-03 13:41:44', '', 'xx', '3', '32', '1', '2017-11-03 13:38:57', '1', '2017-11-03 13:41:44');
INSERT INTO `vich_orders_pd` VALUES ('6', 'PD1711031344275257', null, '10', '35.00', '3', '1', '2017-11-03 13:45:13', '', '', '3', '32', '1', '2017-11-03 13:44:27', '1', '2017-11-03 13:45:13');
INSERT INTO `vich_orders_pd` VALUES ('7', 'PD1711031533144289', null, '10', '10.00', '1', null, null, null, '', '0', '32', '1', '2017-11-03 15:33:14', '1', '2017-11-03 15:33:35');

-- ----------------------------
-- Table structure for `vich_orders_pd_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_pd_goods`;
CREATE TABLE `vich_orders_pd_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `depotGoodsId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL COMMENT '入库批次',
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of vich_orders_pd_goods
-- ----------------------------
INSERT INTO `vich_orders_pd_goods` VALUES ('1', '1', '9', 'PN1709082257501516', '22', '11', '6', null, '10.00', '3', '', '1', '32', '1', '2017-09-09 00:27:02', '0');
INSERT INTO `vich_orders_pd_goods` VALUES ('2', '2', '9', 'PN1709082257501516', '22', '11', '6', null, '10.00', '4', '', '1', '32', '1', '2017-09-09 00:29:39', '0');
INSERT INTO `vich_orders_pd_goods` VALUES ('3', '3', '7', 'PN1709082238527438', '23', null, '6', null, '10.00', '7', '', '1', '32', '1', '2017-10-16 17:59:05', '0');
INSERT INTO `vich_orders_pd_goods` VALUES ('4', '5', '7', 'PN1709082238527438', '23', null, '6', null, '10.00', '1', '', '1', '32', '1', '2017-11-03 13:41:33', '10');
INSERT INTO `vich_orders_pd_goods` VALUES ('5', '6', '7', 'PN1709082238527438', '23', null, '6', null, '10.00', '2', '', '1', '32', '1', '2017-11-03 13:44:38', '10');
INSERT INTO `vich_orders_pd_goods` VALUES ('6', '6', '8', 'PN1709082251052391', '23', null, '6', null, '15.00', '1', '', '1', '32', '1', '2017-11-03 13:44:53', '10');
INSERT INTO `vich_orders_pd_goods` VALUES ('7', '4', '8', 'PN1709082251052391', '23', null, '6', null, '15.00', '10', '', '-1', '32', '1', '2017-11-03 14:05:50', '10');
INSERT INTO `vich_orders_pd_goods` VALUES ('8', '7', '9', 'PN1709082257501516', '22', null, '6', null, '10.00', '1', '', '1', '32', '1', '2017-11-03 15:33:35', '10');

-- ----------------------------
-- Table structure for `vich_orders_pr`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_pr`;
CREATE TABLE `vich_orders_pr` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL COMMENT '0创建 1待审核 -3审核未通过 3审核通过 4关闭 -1删除',
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='采购计划单';

-- ----------------------------
-- Records of vich_orders_pr
-- ----------------------------
INSERT INTO `vich_orders_pr` VALUES ('1', 'PR1709081723359286', '11', null, '100.00', '10', '1', null, '', null, '1', '32', '1', '2017-09-08 17:23:35', '1', '2017-09-08 17:28:03');
INSERT INTO `vich_orders_pr` VALUES ('2', 'PR1709141408452742', '11', null, '200.00', '20', '1', '2017-09-14 14:12:50', 'xxxx', null, '3', '32', '1', '2017-09-14 14:08:45', '1', '2017-09-14 14:12:50');
INSERT INTO `vich_orders_pr` VALUES ('3', 'PR1710200918214352', '11', null, '150.00', '10', '1', null, '', 'xxx', '1', '32', '1', '2017-10-20 09:18:21', '1', '2017-11-03 15:40:53');
INSERT INTO `vich_orders_pr` VALUES ('4', 'PR1711031525021831', '12', null, '300.00', '30', '1', '2017-11-03 15:26:59', '', '', '3', '32', '1', '2017-11-03 15:25:02', '1', '2017-11-03 15:26:59');
INSERT INTO `vich_orders_pr` VALUES ('5', 'PR1711040837581744', '12', null, '0.00', '0', null, null, null, '10', '0', '32', '1', '2017-11-04 08:37:58', null, null);
INSERT INTO `vich_orders_pr` VALUES ('6', 'PR1711040943114316', '11', null, '0.00', '0', null, null, null, '', '0', '32', '1', '2017-11-04 09:43:11', null, null);

-- ----------------------------
-- Table structure for `vich_orders_pr_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_pr_goods`;
CREATE TABLE `vich_orders_pr_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='采购计划单商品表';

-- ----------------------------
-- Records of vich_orders_pr_goods
-- ----------------------------
INSERT INTO `vich_orders_pr_goods` VALUES ('1', '1', null, '22', '11', null, '2017-09-09 00:00:00', '10.00', '10', '123', '1', '32', '1', '2017-09-08 17:24:29', '0');
INSERT INTO `vich_orders_pr_goods` VALUES ('2', '2', null, '25', '11', null, '2017-09-15 00:00:00', '10.00', '20', 'xxx', '1', '32', '1', '2017-09-14 14:10:13', '0');
INSERT INTO `vich_orders_pr_goods` VALUES ('3', '4', null, '24', '12', null, '2017-11-17 00:00:00', '10.00', '10', '***', '1', '32', '1', '2017-11-03 15:25:58', null);
INSERT INTO `vich_orders_pr_goods` VALUES ('4', '4', null, '23', '12', null, '2017-11-23 00:00:00', '10.00', '20', '', '1', '32', '1', '2017-11-03 15:26:38', null);
INSERT INTO `vich_orders_pr_goods` VALUES ('5', '3', null, '26', '11', null, '2017-11-03 00:00:00', '15.00', '10', '', '1', '32', '1', '2017-11-03 15:40:01', null);

-- ----------------------------
-- Table structure for `vich_orders_so`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_so`;
CREATE TABLE `vich_orders_so` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `deliverTime` datetime DEFAULT NULL COMMENT '预计发货时间',
  `noticeTime` datetime DEFAULT NULL COMMENT '提醒时间',
  `depotId` int(11) DEFAULT '0',
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='销售出库单';

-- ----------------------------
-- Records of vich_orders_so
-- ----------------------------
INSERT INTO `vich_orders_so` VALUES ('1', 'SO1710161345534225', '2', '446.00', '2', null, null, null, null, '0', '32', '1', '2017-10-16 13:45:53', '1', '2017-10-18 11:54:23', null, null, '0');
INSERT INTO `vich_orders_so` VALUES ('2', 'SO1710161347038549', '2', '0.00', '0', null, null, null, null, '-1', '32', '1', '2017-10-16 13:47:03', null, null, null, null, '0');
INSERT INTO `vich_orders_so` VALUES ('3', 'SO1710161347396213', '2', '10.00', '1', '1', '2017-10-16 18:23:23', '1', null, '3', '32', '1', '2017-10-16 13:47:39', '1', '2017-10-16 18:23:23', null, null, '0');
INSERT INTO `vich_orders_so` VALUES ('4', 'SO1710161848418444', '2', '10.00', '1', '1', '2017-10-17 14:37:35', '', null, '3', '32', '1', '2017-10-16 18:48:41', '1', '2017-10-17 14:37:35', null, null, '0');
INSERT INTO `vich_orders_so` VALUES ('5', 'SO1710181430503478', '2', '1.00', '1', '1', null, '', '123', '1', '32', '1', '2017-10-18 14:30:50', '1', '2017-10-18 15:50:48', '2017-10-20 00:00:00', '2017-10-18 15:35:01', '0');
INSERT INTO `vich_orders_so` VALUES ('6', 'SO1711031528557998', '2', '100.00', '10', '1', null, '', '', '1', '32', '1', '2017-11-03 15:28:55', '1', '2017-11-03 15:29:24', '2017-11-09 00:00:00', null, '0');

-- ----------------------------
-- Table structure for `vich_orders_so_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_so_goods`;
CREATE TABLE `vich_orders_so_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL,
  `depotGoodsId` int(11) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vich_orders_so_goods
-- ----------------------------
INSERT INTO `vich_orders_so_goods` VALUES ('1', '3', 'PN1709082238527438', '7', '23', '6', '10', '2', '10.00', '', '-1', '32', '1', '2017-10-16 17:28:54');
INSERT INTO `vich_orders_so_goods` VALUES ('2', '3', 'PN1709082257501516', '9', '22', '6', '10', '1', '10.00', '', '-1', '32', '1', '2017-10-16 17:37:19');
INSERT INTO `vich_orders_so_goods` VALUES ('3', '3', 'PN1709082238527438', '7', '23', '6', '10', '1', '10.00', '', '-1', '32', '1', '2017-10-16 18:03:18');
INSERT INTO `vich_orders_so_goods` VALUES ('4', '3', 'PN1709082238527438', '7', '23', '6', '10', '1', '10.00', '', '-1', '32', '1', '2017-10-16 18:03:32');
INSERT INTO `vich_orders_so_goods` VALUES ('5', '3', 'PN1709082238527438', '7', '23', '6', '10', '1', '10.00', '', '-1', '32', '1', '2017-10-16 18:09:01');
INSERT INTO `vich_orders_so_goods` VALUES ('6', '3', 'PN1709082238527438', '7', '23', '6', '10', '1', '10.00', '', '1', '32', '1', '2017-10-16 18:15:09');
INSERT INTO `vich_orders_so_goods` VALUES ('7', '4', 'PN1709082238527438', '7', '23', '6', '10', '1', '10.00', '', '1', '32', '1', '2017-10-17 14:37:24');
INSERT INTO `vich_orders_so_goods` VALUES ('8', '1', 'PN1709082238527438', '7', '23', '6', '10', '2', '223.00', '', '1', '32', '1', '2017-10-18 11:53:21');
INSERT INTO `vich_orders_so_goods` VALUES ('9', '5', 'PN1709082238527438', '7', '23', '6', '10', '1', '1.00', '', '1', '32', '1', '2017-10-18 15:50:43');
INSERT INTO `vich_orders_so_goods` VALUES ('10', '6', 'PN1710180947345117', '10', '22', '6', '10', '10', '10.00', '', '1', '32', '1', '2017-11-03 15:29:14');

-- ----------------------------
-- Table structure for `vich_orders_th`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_th`;
CREATE TABLE `vich_orders_th` (
  `orderId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderNo` varchar(255) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  `totalMoney` decimal(10,2) DEFAULT NULL,
  `totalCnt` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `reviewerTime` datetime DEFAULT NULL,
  `reviewerMemo` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `updateUser` int(11) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='退货单表';

-- ----------------------------
-- Records of vich_orders_th
-- ----------------------------
INSERT INTO `vich_orders_th` VALUES ('1', 'TH1709141439076438', '11', null, '1.00', '1', null, null, null, null, '0', '32', '28', '2017-09-14 14:39:07', '28', '2017-09-14 14:39:25');
INSERT INTO `vich_orders_th` VALUES ('2', 'TH1710200918386685', '11', null, '1.00', '1', null, null, null, 'xxx', '0', '32', '1', '2017-10-20 09:18:38', '1', '2017-10-20 09:18:47');

-- ----------------------------
-- Table structure for `vich_orders_th_goods`
-- ----------------------------
DROP TABLE IF EXISTS `vich_orders_th_goods`;
CREATE TABLE `vich_orders_th_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` int(11) DEFAULT NULL,
  `orderSubNo` varchar(255) DEFAULT NULL,
  `goodsId` int(11) DEFAULT NULL,
  `supplierId` int(11) DEFAULT NULL,
  `depotSubId` int(11) DEFAULT NULL,
  `arrivalTime` datetime DEFAULT NULL,
  `goodsPrice` decimal(10,2) DEFAULT NULL,
  `goodsCnt` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `flag` tinyint(4) DEFAULT NULL,
  `createCompany` int(11) DEFAULT NULL,
  `createUser` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  `depotId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of vich_orders_th_goods
-- ----------------------------
INSERT INTO `vich_orders_th_goods` VALUES ('1', '1', null, '24', '11', null, null, '1.00', '1', '', '1', '32', '28', '2017-09-14 14:39:25', '0');
INSERT INTO `vich_orders_th_goods` VALUES ('2', '2', null, '22', '11', null, null, '1.00', '1', '1', '1', '32', '1', '2017-10-20 09:18:47', '0');

-- ----------------------------
-- Table structure for `vich_quick_note`
-- ----------------------------
DROP TABLE IF EXISTS `vich_quick_note`;
CREATE TABLE `vich_quick_note` (
  `note_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'note_id',
  `note_content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `owner_id` int(10) unsigned NOT NULL COMMENT '谁添加的',
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用于显示的quick note';

-- ----------------------------
-- Records of vich_quick_note
-- ----------------------------

-- ----------------------------
-- Table structure for `vich_suppliers`
-- ----------------------------
DROP TABLE IF EXISTS `vich_suppliers`;
CREATE TABLE `vich_suppliers` (
  `supplierId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '供应商ID',
  `supplierName` varchar(255) NOT NULL COMMENT '供应商名称',
  `supplierAddress` varchar(255) NOT NULL COMMENT '供应商地址',
  `supplierTel` varchar(255) DEFAULT NULL COMMENT '供应商电话',
  `supplierUserName` varchar(255) NOT NULL COMMENT '供应商负责人',
  `supplierUserPhone` varchar(255) NOT NULL COMMENT '供应商负责人电话',
  `supplierUserEmail` varchar(255) DEFAULT NULL COMMENT '供应商负责人邮箱',
  `supplierUserQQ` varchar(255) DEFAULT NULL COMMENT '供应商负责人QQ',
  `bankName` varchar(255) NOT NULL COMMENT '银行名称',
  `bankAccount` varchar(255) NOT NULL COMMENT '账户',
  `bankOpenName` varchar(255) NOT NULL COMMENT '开户银行',
  `cardUserName` varchar(255) NOT NULL COMMENT '开卡人姓名',
  `cardUserPhone` varchar(255) NOT NULL COMMENT '开卡人电话',
  `cardMoney` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `createCompany` int(11) NOT NULL COMMENT '创建公司',
  `createUser` int(11) NOT NULL,
  `createTime` datetime NOT NULL,
  `reviewer` int(11) DEFAULT NULL COMMENT '审核人',
  `reviewTime` datetime DEFAULT NULL COMMENT '审核时间',
  PRIMARY KEY (`supplierId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='供应商表';

-- ----------------------------
-- Records of vich_suppliers
-- ----------------------------
INSERT INTO `vich_suppliers` VALUES ('11', '测试供应商', '测试', '010-9999999', '测试', '13564111240', 'test@example.com', '13564111240', '测试', '6214832136673428', '测试', '测试', '13564111240', '0.00', 'xxxxxxxxxxxxxxx', '1', '32', '27', '2017-08-03 11:30:54', '27', null);
INSERT INTO `vich_suppliers` VALUES ('12', '测试供应商--2', '地址22222', '0501-1111111', '李四', '13666666666', '13666666666.vip@173.com', '908888888', '招商银行', '6214832136673428', '招商银行xxx分行', '李四', '13666666666', '0.00', '', '1', '32', '1', '2017-08-28 09:06:02', '1', null);
INSERT INTO `vich_suppliers` VALUES ('13', '测试供', '测试供测试供', '010-9999999', '钱二', '13696569566', '1258944569@qq.com', '58944569', '银行', '6214832136673428', '银行', '钱二', '13696569566', '0.00', '', '-1', '32', '1', '2017-11-03 15:14:37', '1', null);

-- ----------------------------
-- Table structure for `vich_system`
-- ----------------------------
DROP TABLE IF EXISTS `vich_system`;
CREATE TABLE `vich_system` (
  `key_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `key_value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`key_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='系统配置表';

-- ----------------------------
-- Records of vich_system
-- ----------------------------
INSERT INTO `vich_system` VALUES ('timezone', '\"Asia/Shanghai\"');

-- ----------------------------
-- Table structure for `vich_sys_log`
-- ----------------------------
DROP TABLE IF EXISTS `vich_sys_log`;
CREATE TABLE `vich_sys_log` (
  `op_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `action` varchar(255) NOT NULL,
  `class_name` varchar(255) NOT NULL COMMENT '操作了哪个类的对象',
  `class_obj` varchar(32) NOT NULL COMMENT '操作的对象是谁，可能为对象的ID',
  `result` text NOT NULL COMMENT '操作的结果',
  `op_time` int(11) NOT NULL,
  PRIMARY KEY (`op_id`),
  KEY `op_time` (`op_time`),
  KEY `class_name` (`class_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1242 DEFAULT CHARSET=utf8 COMMENT='操作日志表';

-- ----------------------------
-- Records of vich_sys_log
-- ----------------------------
INSERT INTO `vich_sys_log` VALUES ('1', '', 'LOGOUT', 'User', '', '', '1500961665');
INSERT INTO `vich_sys_log` VALUES ('2', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1500961703');
INSERT INTO `vich_sys_log` VALUES ('3', '', 'LOGOUT', 'User', '', '', '1500962660');
INSERT INTO `vich_sys_log` VALUES ('4', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1500962764');
INSERT INTO `vich_sys_log` VALUES ('5', 'admin', 'LOGOUT', 'User', '1', '', '1500962769');
INSERT INTO `vich_sys_log` VALUES ('6', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1500962782');
INSERT INTO `vich_sys_log` VALUES ('7', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1500962830');
INSERT INTO `vich_sys_log` VALUES ('8', 'admin', 'LOGOUT', 'User', '1', '', '1500963137');
INSERT INTO `vich_sys_log` VALUES ('9', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1500963564');
INSERT INTO `vich_sys_log` VALUES ('10', 'admin', 'ADD', 'Module', '3', '{\"module_name\":\"\\u7ba1\\u7406\\u770b\\u677f\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-comment\"}', '1500964986');
INSERT INTO `vich_sys_log` VALUES ('11', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1500969496');
INSERT INTO `vich_sys_log` VALUES ('12', 'admin', 'DELETE', 'Module', '3', '{\"module_id\":\"3\",\"module_name\":\"\\u7ba1\\u7406\\u770b\\u677f\",\"module_url\":\"\\/index.php\",\"module_sort\":\"1\",\"module_desc\":\"\",\"module_icon\":\"icon-comment\",\"online\":\"1\"}', '1500969634');
INSERT INTO `vich_sys_log` VALUES ('13', 'admin', 'ADD', 'Module', '4', '{\"module_name\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-th\"}', '1500969686');
INSERT INTO `vich_sys_log` VALUES ('14', 'admin', 'MODIFY', 'Module', '1', '{\"module_name\":\"\\u63a7\\u5236\\u9762\\u677f\",\"module_desc\":\"erp\",\"module_icon\":\"icon-th\",\"module_url\":\"\\/panel\\/index.php\",\"module_sort\":\"0\"}', '1500969721');
INSERT INTO `vich_sys_log` VALUES ('15', 'admin', 'ADD', 'Module', '5', '{\"module_name\":\"\\u5165\\u5e93\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-th\"}', '1500969755');
INSERT INTO `vich_sys_log` VALUES ('16', 'admin', 'ADD', 'Module', '6', '{\"module_name\":\"\\u5e93\\u5b58\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-th\"}', '1500969765');
INSERT INTO `vich_sys_log` VALUES ('17', 'admin', 'ADD', 'Module', '7', '{\"module_name\":\"\\u7edf\\u8ba1\\u62a5\\u8868\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-th\"}', '1500969777');
INSERT INTO `vich_sys_log` VALUES ('18', 'admin', 'ADD', 'Module', '8', '{\"module_name\":\"\\u8d22\\u52a1\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-th\"}', '1500969786');
INSERT INTO `vich_sys_log` VALUES ('19', 'admin', 'ADD', 'Module', '9', '{\"module_name\":\"\\u5e94\\u6536\\u5e94\\u4ed8\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-th\"}', '1500969797');
INSERT INTO `vich_sys_log` VALUES ('20', 'admin', 'ADD', 'MenuUrl', '104', '{\"menu_name\":\"\\u7cfb\\u7edf\\u53d8\\u91cf\\u8bbe\\u7f6e\",\"menu_url\":\"\\/sys\\/base.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500969895');
INSERT INTO `vich_sys_log` VALUES ('21', 'admin', 'ADD', 'MenuUrl', '105', '{\"menu_name\":\"\\u4ea7\\u54c1\\u57fa\\u672c\\u4fe1\\u606f\",\"menu_url\":\"\\/sys\\/goods.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500969927');
INSERT INTO `vich_sys_log` VALUES ('22', 'admin', 'ADD', 'MenuUrl', '106', '{\"menu_name\":\"\\u4ea7\\u54c1\\u5206\\u7c7b\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/goods_cats.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500970125');
INSERT INTO `vich_sys_log` VALUES ('23', 'admin', 'MODIFY', 'MenuUrl', '105', '{\"menu_name\":\"\\u4ea7\\u54c1\\u57fa\\u672c\\u4fe1\\u606f\",\"menu_url\":\"\\/sys\\/goods.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"4\"}', '1500970163');
INSERT INTO `vich_sys_log` VALUES ('24', 'admin', 'MODIFY', 'MenuUrl', '105', '{\"menu_name\":\"\\u65b0\\u589e\\u4ea7\\u54c1\",\"menu_url\":\"\\/sys\\/goods_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"4\"}', '1500970230');
INSERT INTO `vich_sys_log` VALUES ('25', 'admin', 'ADD', 'MenuUrl', '107', '{\"menu_name\":\"\\u4ea7\\u54c1\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/goods.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500970252');
INSERT INTO `vich_sys_log` VALUES ('26', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107\"}', '1500970259');
INSERT INTO `vich_sys_log` VALUES ('27', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108\"}', '1500971302');
INSERT INTO `vich_sys_log` VALUES ('28', 'admin', 'ADD', 'MenuUrl', '109', '{\"menu_name\":\"\\u589e\\u52a0\\u4ea7\\u54c1\\u5206\\u7c7b\",\"menu_url\":\"\\/sys\\/goods_cats_add.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971364');
INSERT INTO `vich_sys_log` VALUES ('29', 'admin', 'ADD', 'MenuUrl', '110', '{\"menu_name\":\"\\u7f16\\u8f91\\u4ea7\\u54c1\\u5206\\u7c7b\",\"menu_url\":\"\\/sys\\/goods_cats_modify.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\"}', '1500971394');
INSERT INTO `vich_sys_log` VALUES ('30', 'admin', 'MODIFY', 'MenuUrl', '106', '{\"menu_name\":\"\\u7f16\\u8f91\\u4ea7\\u54c1\",\"menu_url\":\"\\/sys\\/goods_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\",\"module_id\":\"4\"}', '1500971404');
INSERT INTO `vich_sys_log` VALUES ('31', 'admin', 'ADD', 'MenuUrl', '111', '{\"menu_name\":\"\\u4f9b\\u5e94\\u5546\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/suppliers.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971462');
INSERT INTO `vich_sys_log` VALUES ('32', 'admin', 'ADD', 'MenuUrl', '112', '{\"menu_name\":\"\\u65b0\\u589e\\u4f9b\\u5e94\\u5546\",\"menu_url\":\"\\/sys\\/suppliers_add.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971487');
INSERT INTO `vich_sys_log` VALUES ('33', 'admin', 'ADD', 'MenuUrl', '113', '{\"menu_name\":\"\\u7f16\\u8f91\\u4f9b\\u5e94\\u5546\",\"menu_url\":\"\\/sys\\/suppliers_modify.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\"}', '1500971508');
INSERT INTO `vich_sys_log` VALUES ('34', 'admin', 'ADD', 'MenuUrl', '114', '{\"menu_name\":\"\\u5458\\u5de5\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/staff.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971562');
INSERT INTO `vich_sys_log` VALUES ('35', 'admin', 'ADD', 'MenuUrl', '115', '{\"menu_name\":\"\\u65b0\\u589e\\u5458\\u5de5\",\"menu_url\":\"\\/sys\\/staff_add.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971587');
INSERT INTO `vich_sys_log` VALUES ('36', 'admin', 'ADD', 'MenuUrl', '116', '{\"menu_name\":\"\\u7f16\\u8f91\\u5458\\u5de5\",\"menu_url\":\"\\/sys\\/staff_modify.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\"}', '1500971608');
INSERT INTO `vich_sys_log` VALUES ('37', 'admin', 'ADD', 'MenuUrl', '117', '{\"menu_name\":\"\\u516c\\u53f8\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/company.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971650');
INSERT INTO `vich_sys_log` VALUES ('38', 'admin', 'ADD', 'MenuUrl', '118', '{\"menu_name\":\"\\u65b0\\u589e\\u516c\\u53f8\",\"menu_url\":\"\\/sys\\/company_add.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971669');
INSERT INTO `vich_sys_log` VALUES ('39', 'admin', 'ADD', 'MenuUrl', '119', '{\"menu_name\":\"\\u7f16\\u8f91\\u516c\\u53f8\",\"menu_url\":\"\\/sys\\/company_modify.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\"}', '1500971702');
INSERT INTO `vich_sys_log` VALUES ('40', 'admin', 'ADD', 'MenuUrl', '120', '{\"menu_name\":\"\\u90e8\\u95e8\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/department.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971754');
INSERT INTO `vich_sys_log` VALUES ('41', 'admin', 'MODIFY', 'MenuUrl', '114', '{\"menu_name\":\"\\u5458\\u5de5\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/employee.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"4\"}', '1500971775');
INSERT INTO `vich_sys_log` VALUES ('42', 'admin', 'MODIFY', 'MenuUrl', '115', '{\"menu_name\":\"\\u65b0\\u589e\\u5458\\u5de5\",\"menu_url\":\"\\/sys\\/employee_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"4\"}', '1500971786');
INSERT INTO `vich_sys_log` VALUES ('43', 'admin', 'MODIFY', 'MenuUrl', '116', '{\"menu_name\":\"\\u7f16\\u8f91\\u5458\\u5de5\",\"menu_url\":\"\\/sys\\/employee_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\",\"module_id\":\"4\"}', '1500971799');
INSERT INTO `vich_sys_log` VALUES ('44', 'admin', 'ADD', 'MenuUrl', '121', '{\"menu_name\":\"\\u65b0\\u589e\\u90e8\\u95e8\",\"menu_url\":\"\\/sys\\/department_add.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971836');
INSERT INTO `vich_sys_log` VALUES ('45', 'admin', 'ADD', 'MenuUrl', '122', '{\"menu_name\":\"\\u7f16\\u8f91\\u90e8\\u95e8\",\"menu_url\":\"\\/sys\\/department_modify.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\"}', '1500971864');
INSERT INTO `vich_sys_log` VALUES ('46', 'admin', 'ADD', 'MenuUrl', '123', '{\"menu_name\":\"\\u4ed3\\u5e93\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/depot.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971915');
INSERT INTO `vich_sys_log` VALUES ('47', 'admin', 'ADD', 'MenuUrl', '124', '{\"menu_name\":\"\\u65b0\\u589e\\u4ed3\\u5e93\",\"menu_url\":\"\\/sys\\/depot_add.php\",\"module_id\":\"1\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500971934');
INSERT INTO `vich_sys_log` VALUES ('48', 'admin', 'ADD', 'MenuUrl', '125', '{\"menu_name\":\"\\u7f16\\u8f91\\u4ed3\\u5e93\",\"menu_url\":\"\\/sys\\/depot_modify.php\",\"module_id\":\"1\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\"}', '1500971956');
INSERT INTO `vich_sys_log` VALUES ('49', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125\"}', '1500972008');
INSERT INTO `vich_sys_log` VALUES ('50', 'admin', 'MODIFY', 'MenuUrl', '124', '{\"menu_name\":\"\\u65b0\\u589e\\u4ed3\\u5e93\",\"menu_url\":\"\\/sys\\/depot_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"4\"}', '1500972018');
INSERT INTO `vich_sys_log` VALUES ('51', 'admin', 'MODIFY', 'MenuUrl', '125', '{\"menu_name\":\"\\u7f16\\u8f91\\u4ed3\\u5e93\",\"menu_url\":\"\\/sys\\/depot_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\",\"module_id\":\"4\"}', '1500972025');
INSERT INTO `vich_sys_log` VALUES ('52', 'admin', 'MODIFY', 'Module', '4', '{\"module_name\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"module_desc\":\"\",\"module_icon\":\"icon-cog\",\"module_url\":\"\\/index.php\",\"module_sort\":\"1\",\"online\":\"1\"}', '1500972057');
INSERT INTO `vich_sys_log` VALUES ('53', 'admin', 'ADD', 'Module', '10', '{\"module_name\":\"\\u91c7\\u8d2d\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-shopping-cart\"}', '1500972288');
INSERT INTO `vich_sys_log` VALUES ('54', 'admin', 'ADD', 'MenuUrl', '126', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\",\"menu_url\":\"\\/purchase\\/order.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500972863');
INSERT INTO `vich_sys_log` VALUES ('55', 'admin', 'ADD', 'MenuUrl', '127', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u5f55\\u5165\",\"menu_url\":\"\\/purchase\\/order_add.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500972898');
INSERT INTO `vich_sys_log` VALUES ('56', 'admin', 'ADD', 'MenuUrl', '128', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/purchase\\/order_modify.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\"}', '1500972945');
INSERT INTO `vich_sys_log` VALUES ('57', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128\"}', '1500972950');
INSERT INTO `vich_sys_log` VALUES ('58', 'admin', 'MODIFY', 'Module', '10', '{\"module_name\":\"\\u91c7\\u8d2d\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-shopping-cart\",\"module_url\":\"\\/index.php\",\"module_sort\":\"1\",\"online\":\"1\"}', '1500972966');
INSERT INTO `vich_sys_log` VALUES ('59', 'admin', 'MODIFY', 'MenuUrl', '126', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\",\"menu_url\":\"\\/purchase\\/order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"10\"}', '1500972980');
INSERT INTO `vich_sys_log` VALUES ('60', 'admin', 'ADD', 'MenuUrl', '129', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8fdb\\u8d27\\u5355\",\"menu_url\":\"\\/purchase\\/receive_order.php\",\"module_id\":\"10\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500973016');
INSERT INTO `vich_sys_log` VALUES ('61', 'admin', 'ADD', 'MenuUrl', '130', '{\"menu_name\":\"\\u91c7\\u8d2d\\u9000\\u8d27\\u5355\",\"menu_url\":\"\\/p\",\"module_id\":\"1\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500973036');
INSERT INTO `vich_sys_log` VALUES ('62', 'admin', 'MODIFY', 'MenuUrl', '130', '{\"menu_name\":\"\\u91c7\\u8d2d\\u9000\\u8d27\\u5355\",\"menu_url\":\"\\/purchase\\/return_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"10\"}', '1500973080');
INSERT INTO `vich_sys_log` VALUES ('63', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130\"}', '1500973085');
INSERT INTO `vich_sys_log` VALUES ('64', 'admin', 'ADD', 'MenuUrl', '131', '{\"menu_name\":\"\\u91c7\\u8d2d\\u53d1\\u7968\",\"menu_url\":\"\\/purchase\\/invoice.php\",\"module_id\":\"10\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500973132');
INSERT INTO `vich_sys_log` VALUES ('65', 'admin', 'ADD', 'MenuUrl', '132', '{\"menu_name\":\"\\u4ef7\\u683c\\u7ba1\\u7406\",\"menu_url\":\"\\/purchase\\/price.php\",\"module_id\":\"10\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500973165');
INSERT INTO `vich_sys_log` VALUES ('66', 'admin', 'ADD', 'MenuUrl', '133', '{\"menu_name\":\"\\u5e94\\u4ed8\\u6b3e\\u5355\",\"menu_url\":\"\\/purchase\\/pay_order.php\",\"module_id\":\"10\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500973255');
INSERT INTO `vich_sys_log` VALUES ('67', 'admin', 'ADD', 'MenuUrl', '134', '{\"menu_name\":\"\\u5e94\\u4ed8\\u660e\\u7ec6\\u8d26\\/\\u603b\\u8d26\",\"menu_url\":\"\\/purchase\\/pay_detail.php\",\"module_id\":\"10\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500973292');
INSERT INTO `vich_sys_log` VALUES ('68', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134\"}', '1500973300');
INSERT INTO `vich_sys_log` VALUES ('69', 'admin', 'MODIFY', 'Module', '5', '{\"module_name\":\"\\u5165\\u5e93\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-th-large\",\"module_url\":\"\\/index.php\",\"module_sort\":\"1\",\"online\":\"1\"}', '1500973542');
INSERT INTO `vich_sys_log` VALUES ('70', 'admin', 'MODIFY', 'Module', '5', '{\"module_name\":\"\\u5e93\\u5b58\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-th-large\",\"module_url\":\"\\/index.php\",\"module_sort\":\"1\",\"online\":\"1\"}', '1500973664');
INSERT INTO `vich_sys_log` VALUES ('71', 'admin', 'ADD', 'MenuUrl', '135', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\",\"menu_url\":\"\\/storage\\/order_add.php\",\"module_id\":\"5\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500973785');
INSERT INTO `vich_sys_log` VALUES ('72', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135\"}', '1500973788');
INSERT INTO `vich_sys_log` VALUES ('73', 'admin', 'MODIFY', 'Module', '5', '{\"module_name\":\"\\u5e93\\u5b58\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-th-large\",\"module_url\":\"\\/index.php\",\"module_sort\":\"2\",\"online\":\"1\"}', '1500973909');
INSERT INTO `vich_sys_log` VALUES ('74', 'admin', 'ADD', 'MenuUrl', '136', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u8bb0\\u5f55\",\"menu_url\":\"\\/storage\\/order_record.php\",\"module_id\":\"5\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500973977');
INSERT INTO `vich_sys_log` VALUES ('75', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136\"}', '1500973981');
INSERT INTO `vich_sys_log` VALUES ('76', 'admin', 'ADD', 'MenuUrl', '137', '{\"menu_name\":\"\\u91c7\\u8d2d\\u9000\\u8d27\",\"menu_url\":\"\\/storage\\/return_order.php\",\"module_id\":\"5\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500974105');
INSERT INTO `vich_sys_log` VALUES ('77', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137\"}', '1500974109');
INSERT INTO `vich_sys_log` VALUES ('78', 'admin', 'MODIFY', 'Module', '5', '{\"module_name\":\"\\u5165\\u5e93\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-th-large\",\"module_url\":\"\\/index.php\",\"module_sort\":\"2\",\"online\":\"1\"}', '1500974326');
INSERT INTO `vich_sys_log` VALUES ('79', 'admin', 'DELETE', 'Module', '6', '{\"module_id\":\"6\",\"module_name\":\"\\u5e93\\u5b58\\u7ba1\\u7406\",\"module_url\":\"\\/index.php\",\"module_sort\":\"1\",\"module_desc\":\"\",\"module_icon\":\"icon-th\",\"online\":\"1\"}', '1500974757');
INSERT INTO `vich_sys_log` VALUES ('80', 'admin', 'MODIFY', 'Module', '5', '{\"module_name\":\"\\u5e93\\u5b58\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-th-large\",\"module_url\":\"\\/index.php\",\"module_sort\":\"2\",\"online\":\"1\"}', '1500974770');
INSERT INTO `vich_sys_log` VALUES ('81', 'admin', 'MODIFY', 'MenuUrl', '135', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1500974797');
INSERT INTO `vich_sys_log` VALUES ('82', 'admin', 'MODIFY', 'MenuUrl', '136', '{\"menu_name\":\"\\u6682\\u4f30\\u5165\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/reckon_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1500974914');
INSERT INTO `vich_sys_log` VALUES ('83', 'admin', 'MODIFY', 'MenuUrl', '137', '{\"menu_name\":\"\\u5176\\u4ed6\\u5165\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/other_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1500974936');
INSERT INTO `vich_sys_log` VALUES ('84', 'admin', 'ADD', 'MenuUrl', '138', '{\"menu_name\":\"\\u5e93\\u5b58\\u8c03\\u62e8\\u5355\",\"menu_url\":\"\\/storage\\/allot_order.php\",\"module_id\":\"5\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500974989');
INSERT INTO `vich_sys_log` VALUES ('85', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138\"}', '1500974993');
INSERT INTO `vich_sys_log` VALUES ('86', 'admin', 'ADD', 'MenuUrl', '139', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/deliver_order.php\",\"module_id\":\"5\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500975067');
INSERT INTO `vich_sys_log` VALUES ('87', 'admin', 'MODIFY', 'MenuUrl', '139', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/receive_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1500975110');
INSERT INTO `vich_sys_log` VALUES ('88', 'admin', 'ADD', 'MenuUrl', '140', '{\"menu_name\":\"\\u5176\\u4ed6\\u51fa\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/other_outorder.php\",\"module_id\":\"5\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500975164');
INSERT INTO `vich_sys_log` VALUES ('89', 'admin', 'ADD', 'MenuUrl', '141', '{\"menu_name\":\"\\u5e93\\u5b58\\u76d8\\u70b9\\u5355\",\"menu_url\":\"\\/storage\\/count_order.php\",\"module_id\":\"5\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500975186');
INSERT INTO `vich_sys_log` VALUES ('90', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141\"}', '1500975190');
INSERT INTO `vich_sys_log` VALUES ('91', 'admin', 'ADD', 'MenuUrl', '142', '{\"menu_name\":\"\\u91c7\\u8d2d\\u62a5\\u8868\",\"menu_url\":\"\\/charts\\/purchase.php\",\"module_id\":\"7\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500975483');
INSERT INTO `vich_sys_log` VALUES ('92', 'admin', 'ADD', 'MenuUrl', '143', '{\"menu_name\":\"\\u91c7\\u8d2d\\u9000\\u8d27\\u62a5\\u8868\",\"menu_url\":\"\\/charts\\/return.php\",\"module_id\":\"7\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500975518');
INSERT INTO `vich_sys_log` VALUES ('93', 'admin', 'ADD', 'MenuUrl', '144', '{\"menu_name\":\"\\u4f9b\\u5e94\\u5546\\u62a5\\u8868\",\"menu_url\":\"\\/charts\\/suppliers.php\",\"module_id\":\"7\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500975585');
INSERT INTO `vich_sys_log` VALUES ('94', 'admin', 'ADD', 'MenuUrl', '145', '{\"menu_name\":\"\\u5168\\u5c40\\u7edf\\u8ba1\\u62a5\\u8868\",\"menu_url\":\"\\/storage\\/global.php\",\"module_id\":\"7\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500975682');
INSERT INTO `vich_sys_log` VALUES ('95', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145\"}', '1500975688');
INSERT INTO `vich_sys_log` VALUES ('96', 'admin', 'MODIFY', 'Module', '7', '{\"module_name\":\"\\u7edf\\u8ba1\\u62a5\\u8868\",\"module_desc\":\"\",\"module_icon\":\"icon-list-alt\",\"module_url\":\"\\/index.php\",\"module_sort\":\"1\",\"online\":\"1\"}', '1500975724');
INSERT INTO `vich_sys_log` VALUES ('97', 'admin', 'MODIFY', 'Module', '7', '{\"module_name\":\"\\u7edf\\u8ba1\\u62a5\\u8868\",\"module_desc\":\"\",\"module_icon\":\"icon-list-alt\",\"module_url\":\"\\/index.php\",\"module_sort\":\"4\",\"online\":\"1\"}', '1500975735');
INSERT INTO `vich_sys_log` VALUES ('98', 'admin', 'MODIFY', 'Module', '8', '{\"module_name\":\"\\u8d22\\u52a1\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-file\",\"module_url\":\"\\/index.php\",\"module_sort\":\"1\",\"online\":\"1\"}', '1500975923');
INSERT INTO `vich_sys_log` VALUES ('99', 'admin', 'ADD', 'MenuUrl', '146', '{\"menu_name\":\"\\u94f6\\u884c\\u7ba1\\u7406\",\"menu_url\":\"\\/finance\\/bank.php\",\"module_id\":\"8\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500975972');
INSERT INTO `vich_sys_log` VALUES ('100', 'admin', 'ADD', 'MenuUrl', '147', '{\"menu_name\":\"\\u8d22\\u52a1\\u5206\\u7c7b\",\"menu_url\":\"\\/finance\\/cate.php\",\"module_id\":\"8\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500976003');
INSERT INTO `vich_sys_log` VALUES ('101', 'admin', 'ADD', 'MenuUrl', '148', '{\"menu_name\":\"\\u6dfb\\u52a0\\u8d22\\u52a1\",\"menu_url\":\"\\/finance\\/add.php\",\"module_id\":\"8\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500976037');
INSERT INTO `vich_sys_log` VALUES ('102', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148\"}', '1500976047');
INSERT INTO `vich_sys_log` VALUES ('103', 'admin', 'MODIFY', 'Module', '8', '{\"module_name\":\"\\u8d22\\u52a1\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-file\",\"module_url\":\"\\/index.php\",\"module_sort\":\"6\",\"online\":\"1\"}', '1500976057');
INSERT INTO `vich_sys_log` VALUES ('104', 'admin', 'ADD', 'MenuUrl', '149', '{\"menu_name\":\"\\u8d22\\u52a1\\u67e5\\u8be2\",\"menu_url\":\"\\/finance\\/search.php\",\"module_id\":\"8\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500976092');
INSERT INTO `vich_sys_log` VALUES ('105', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149\"}', '1500976096');
INSERT INTO `vich_sys_log` VALUES ('106', 'admin', 'MODIFY', 'MenuUrl', '133', '{\"menu_name\":\"\\u5e94\\u4ed8\\u6b3e\\u5355\",\"menu_url\":\"\\/purchase\\/pay_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"9\"}', '1500976117');
INSERT INTO `vich_sys_log` VALUES ('107', 'admin', 'MODIFY', 'MenuUrl', '134', '{\"menu_name\":\"\\u5e94\\u4ed8\\u660e\\u7ec6\\u8d26\\/\\u603b\\u8d26\",\"menu_url\":\"\\/purchase\\/pay_detail.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"9\"}', '1500976128');
INSERT INTO `vich_sys_log` VALUES ('108', 'admin', 'MODIFY', 'Module', '9', '{\"module_name\":\"\\u5e94\\u6536\\u5e94\\u4ed8\",\"module_desc\":\"\",\"module_icon\":\"icon-calendar\",\"module_url\":\"\\/index.php\",\"module_sort\":\"1\",\"online\":\"1\"}', '1500976162');
INSERT INTO `vich_sys_log` VALUES ('109', 'admin', 'MODIFY', 'Module', '9', '{\"module_name\":\"\\u5e94\\u6536\\u5e94\\u4ed8\",\"module_desc\":\"\",\"module_icon\":\"icon-calendar\",\"module_url\":\"\\/index.php\",\"module_sort\":\"6\",\"online\":\"1\"}', '1500976175');
INSERT INTO `vich_sys_log` VALUES ('110', 'admin', 'ADD', 'MenuUrl', '150', '{\"menu_name\":\"\\u5e94\\u4ed8\\u8d26\\u6b3e\",\"menu_url\":\"\\/balance\\/pay.php\",\"module_id\":\"1\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1500976258');
INSERT INTO `vich_sys_log` VALUES ('111', 'admin', 'MODIFY', 'MenuUrl', '150', '{\"menu_name\":\"\\u5e94\\u4ed8\\u8d26\\u6b3e\",\"menu_url\":\"\\/balance\\/collect.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"9\"}', '1500976300');
INSERT INTO `vich_sys_log` VALUES ('112', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150\"}', '1500976314');
INSERT INTO `vich_sys_log` VALUES ('113', 'admin', 'MODIFY', 'MenuUrl', '150', '{\"menu_name\":\"\\u5e94\\u6536\\u8d26\\u6b3e\",\"menu_url\":\"\\/balance\\/collect.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"9\"}', '1500976495');
INSERT INTO `vich_sys_log` VALUES ('114', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1500977603');
INSERT INTO `vich_sys_log` VALUES ('115', 'admin', 'LOGOUT', 'User', '1', '', '1500977612');
INSERT INTO `vich_sys_log` VALUES ('116', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1500977790');
INSERT INTO `vich_sys_log` VALUES ('117', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501030348');
INSERT INTO `vich_sys_log` VALUES ('118', 'admin', 'MODIFY', 'MenuUrl', '133', '{\"menu_name\":\"\\u5e94\\u4ed8\\u6b3e\\u5355\",\"menu_url\":\"\\/balance\\/pay_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"9\"}', '1501033961');
INSERT INTO `vich_sys_log` VALUES ('119', 'admin', 'MODIFY', 'MenuUrl', '132', '{\"menu_name\":\"\\u4ef7\\u683c\\u7ba1\\u7406\",\"menu_url\":\"\\/balance\\/price.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"10\"}', '1501033980');
INSERT INTO `vich_sys_log` VALUES ('120', 'admin', 'MODIFY', 'MenuUrl', '132', '{\"menu_name\":\"\\u4ef7\\u683c\\u7ba1\\u7406\",\"menu_url\":\"\\/purchase\\/price.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"10\"}', '1501034019');
INSERT INTO `vich_sys_log` VALUES ('121', 'admin', 'MODIFY', 'MenuUrl', '134', '{\"menu_name\":\"\\u5e94\\u4ed8\\u660e\\u7ec6\\u8d26\\/\\u603b\\u8d26\",\"menu_url\":\"\\/balance\\/pay_detail.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"9\"}', '1501034034');
INSERT INTO `vich_sys_log` VALUES ('122', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501036949');
INSERT INTO `vich_sys_log` VALUES ('123', 'admin', 'MODIFY', 'MenuUrl', '136', '{\"menu_name\":\"\\u6682\\u4f30\\u5165\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/reckon_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1501038242');
INSERT INTO `vich_sys_log` VALUES ('124', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501039406');
INSERT INTO `vich_sys_log` VALUES ('125', 'admin', 'ADD', 'MenuUrl', '151', '{\"menu_name\":\"\\u4ea7\\u54c1\\u8ba1\\u91cf\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/unit.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1501044370');
INSERT INTO `vich_sys_log` VALUES ('126', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151\"}', '1501044376');
INSERT INTO `vich_sys_log` VALUES ('127', 'admin', 'MODIFY', 'MenuUrl', '105', '{\"menu_name\":\"\\u65b0\\u589e\\u4ea7\\u54c1\",\"menu_url\":\"\\/sys\\/goods_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"107\",\"module_id\":\"4\"}', '1501045054');
INSERT INTO `vich_sys_log` VALUES ('128', 'admin', 'MODIFY', 'MenuUrl', '106', '{\"menu_name\":\"\\u7f16\\u8f91\\u4ea7\\u54c1\",\"menu_url\":\"\\/sys\\/goods_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"107\",\"module_id\":\"4\"}', '1501045065');
INSERT INTO `vich_sys_log` VALUES ('129', 'admin', 'MODIFY', 'MenuUrl', '109', '{\"menu_name\":\"\\u589e\\u52a0\\u4ea7\\u54c1\\u5206\\u7c7b\",\"menu_url\":\"\\/sys\\/goods_cats_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"108\",\"module_id\":\"4\"}', '1501045806');
INSERT INTO `vich_sys_log` VALUES ('130', 'admin', 'MODIFY', 'MenuUrl', '110', '{\"menu_name\":\"\\u7f16\\u8f91\\u4ea7\\u54c1\\u5206\\u7c7b\",\"menu_url\":\"\\/sys\\/goods_cats_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"108\",\"module_id\":\"4\"}', '1501045822');
INSERT INTO `vich_sys_log` VALUES ('131', 'admin', 'MODIFY', 'MenuUrl', '112', '{\"menu_name\":\"\\u65b0\\u589e\\u4f9b\\u5e94\\u5546\",\"menu_url\":\"\\/sys\\/suppliers_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"111\",\"module_id\":\"4\"}', '1501047077');
INSERT INTO `vich_sys_log` VALUES ('132', 'admin', 'MODIFY', 'MenuUrl', '113', '{\"menu_name\":\"\\u7f16\\u8f91\\u4f9b\\u5e94\\u5546\",\"menu_url\":\"\\/sys\\/suppliers_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"111\",\"module_id\":\"4\"}', '1501047101');
INSERT INTO `vich_sys_log` VALUES ('133', 'admin', 'MODIFY', 'MenuUrl', '115', '{\"menu_name\":\"\\u65b0\\u589e\\u5458\\u5de5\",\"menu_url\":\"\\/sys\\/employee_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"114\",\"module_id\":\"4\"}', '1501047310');
INSERT INTO `vich_sys_log` VALUES ('134', 'admin', 'MODIFY', 'MenuUrl', '116', '{\"menu_name\":\"\\u7f16\\u8f91\\u5458\\u5de5\",\"menu_url\":\"\\/sys\\/employee_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"114\",\"module_id\":\"4\"}', '1501047319');
INSERT INTO `vich_sys_log` VALUES ('135', 'admin', 'MODIFY', 'MenuUrl', '118', '{\"menu_name\":\"\\u65b0\\u589e\\u516c\\u53f8\",\"menu_url\":\"\\/sys\\/company_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"117\",\"module_id\":\"4\"}', '1501048288');
INSERT INTO `vich_sys_log` VALUES ('136', 'admin', 'MODIFY', 'MenuUrl', '119', '{\"menu_name\":\"\\u7f16\\u8f91\\u516c\\u53f8\",\"menu_url\":\"\\/sys\\/company_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"117\",\"module_id\":\"4\"}', '1501048300');
INSERT INTO `vich_sys_log` VALUES ('137', 'admin', 'MODIFY', 'MenuUrl', '121', '{\"menu_name\":\"\\u65b0\\u589e\\u90e8\\u95e8\",\"menu_url\":\"\\/sys\\/department_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"120\",\"module_id\":\"4\"}', '1501048772');
INSERT INTO `vich_sys_log` VALUES ('138', 'admin', 'MODIFY', 'MenuUrl', '122', '{\"menu_name\":\"\\u7f16\\u8f91\\u90e8\\u95e8\",\"menu_url\":\"\\/sys\\/department_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"120\",\"module_id\":\"4\"}', '1501048785');
INSERT INTO `vich_sys_log` VALUES ('139', 'admin', 'MODIFY', 'MenuUrl', '124', '{\"menu_name\":\"\\u65b0\\u589e\\u4ed3\\u5e93\",\"menu_url\":\"\\/sys\\/depot_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"123\",\"module_id\":\"4\"}', '1501049340');
INSERT INTO `vich_sys_log` VALUES ('140', 'admin', 'MODIFY', 'MenuUrl', '125', '{\"menu_name\":\"\\u7f16\\u8f91\\u4ed3\\u5e93\",\"menu_url\":\"\\/sys\\/depot_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"123\",\"module_id\":\"4\"}', '1501049354');
INSERT INTO `vich_sys_log` VALUES ('141', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501050102');
INSERT INTO `vich_sys_log` VALUES ('142', 'admin', 'ADD', 'MenuUrl', '152', '{\"menu_name\":\"\\u589e\\u52a0\\u4ea7\\u54c1\\u8ba1\\u91cf\\u5355\\u4f4d\",\"menu_url\":\"\\/sys\\/unit_add.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"151\"}', '1501053347');
INSERT INTO `vich_sys_log` VALUES ('143', 'admin', 'ADD', 'MenuUrl', '153', '{\"menu_name\":\"\\u7f16\\u8f91\\u4ea7\\u54c1\\u8ba1\\u91cf\\u5355\\u4f4d\",\"menu_url\":\"\\/sys\\/unit_modify.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"151\"}', '1501053389');
INSERT INTO `vich_sys_log` VALUES ('144', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153\"}', '1501053395');
INSERT INTO `vich_sys_log` VALUES ('145', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501005543');
INSERT INTO `vich_sys_log` VALUES ('146', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501006012');
INSERT INTO `vich_sys_log` VALUES ('147', 'admin', 'LOGOUT', 'User', '1', '', '1501006156');
INSERT INTO `vich_sys_log` VALUES ('148', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501006163');
INSERT INTO `vich_sys_log` VALUES ('149', 'admin', 'LOGOUT', 'User', '1', '', '1501055333');
INSERT INTO `vich_sys_log` VALUES ('150', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501055357');
INSERT INTO `vich_sys_log` VALUES ('151', 'admin', 'LOGOUT', 'User', '1', '', '1501055541');
INSERT INTO `vich_sys_log` VALUES ('152', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501055551');
INSERT INTO `vich_sys_log` VALUES ('153', 'admin', 'ADD', 'MenuUrl', '154', '{\"menu_name\":\"\\u65b0\\u589e\\u94f6\\u884c\\u8d26\\u6237\",\"menu_url\":\"\\/finance\\/bank_add.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"146\"}', '1501056857');
INSERT INTO `vich_sys_log` VALUES ('154', 'admin', 'ADD', 'MenuUrl', '155', '{\"menu_name\":\"\\u7f16\\u8f91\\u94f6\\u884c\\u8d26\\u6237\",\"menu_url\":\"\\/finance\\/bank_modify.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"146\"}', '1501057303');
INSERT INTO `vich_sys_log` VALUES ('155', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155\"}', '1501057309');
INSERT INTO `vich_sys_log` VALUES ('156', 'admin', 'ADD', 'MenuUrl', '156', '{\"menu_name\":\"\\u589e\\u52a0\\u8d22\\u52a1\\u5206\\u7c7b\",\"menu_url\":\"\\/finance\\/cate_add.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"147\"}', '1501057644');
INSERT INTO `vich_sys_log` VALUES ('157', 'admin', 'ADD', 'MenuUrl', '157', '{\"menu_name\":\"\\u7f16\\u8f91\\u8d22\\u52a1\\u5206\\u7c7b\",\"menu_url\":\"\\/finance\\/cate_edit.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"147\"}', '1501057680');
INSERT INTO `vich_sys_log` VALUES ('158', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157\"}', '1501058006');
INSERT INTO `vich_sys_log` VALUES ('159', 'admin', 'ADD', 'MenuUrl', '158', '{\"menu_name\":\"\\u589e\\u52a0\\u8d22\\u52a1\\u5206\\u7c7b\",\"menu_url\":\"\\/finance\\/cate_add.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"147\"}', '1501058245');
INSERT INTO `vich_sys_log` VALUES ('160', 'admin', 'ADD', 'MenuUrl', '159', '{\"menu_name\":\"\\u7f16\\u8f91\\u8d22\\u52a1\\u5206\\u7c7b\",\"menu_url\":\"\\/finance\\/cate_modify.php\",\"module_id\":\"1\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1501058284');
INSERT INTO `vich_sys_log` VALUES ('161', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,158\"}', '1501058301');
INSERT INTO `vich_sys_log` VALUES ('162', 'admin', 'ADD', 'MenuUrl', '160', '{\"menu_name\":\"\\u7f16\\u8f91\\u8d22\\u52a1\\u5206\\u7c7b\",\"menu_url\":\"\\/finance\\/cate_modify.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"147\"}', '1501058420');
INSERT INTO `vich_sys_log` VALUES ('163', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,158,160\"}', '1501058426');
INSERT INTO `vich_sys_log` VALUES ('164', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155\"}', '1501058919');
INSERT INTO `vich_sys_log` VALUES ('165', 'admin', 'DELETE', 'MenuUrl', '160', '{\"menu_id\":\"160\",\"menu_name\":\"\\u7f16\\u8f91\\u8d22\\u52a1\\u5206\\u7c7b\",\"menu_url\":\"\\/finance\\/cate_modify.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":\"1\",\"shortcut_allowed\":\"0\",\"menu_desc\":\"\",\"father_menu\":\"147\"}', '1501058986');
INSERT INTO `vich_sys_log` VALUES ('166', 'admin', 'DELETE', 'MenuUrl', '158', '{\"menu_id\":\"158\",\"menu_name\":\"\\u589e\\u52a0\\u8d22\\u52a1\\u5206\\u7c7b\",\"menu_url\":\"\\/finance\\/cate_add.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":\"1\",\"shortcut_allowed\":\"0\",\"menu_desc\":\"\",\"father_menu\":\"147\"}', '1501058991');
INSERT INTO `vich_sys_log` VALUES ('167', 'admin', 'MODIFY', 'MenuUrl', '148', '{\"menu_name\":\"\\u6dfb\\u52a0\\u8d22\\u52a1\",\"menu_url\":\"\\/finance\\/add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"149\",\"module_id\":\"8\"}', '1501059020');
INSERT INTO `vich_sys_log` VALUES ('168', 'admin', 'LOGOUT', 'User', '1', '', '1501010686');
INSERT INTO `vich_sys_log` VALUES ('169', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501010697');
INSERT INTO `vich_sys_log` VALUES ('170', 'admin', 'MODIFY', 'MenuUrl', '127', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u5f55\\u5165\",\"menu_url\":\"\\/purchase\\/order_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\",\"module_id\":\"10\"}', '1501011009');
INSERT INTO `vich_sys_log` VALUES ('171', 'admin', 'MODIFY', 'MenuUrl', '128', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/purchase\\/order_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\",\"module_id\":\"10\"}', '1501011031');
INSERT INTO `vich_sys_log` VALUES ('172', 'admin', 'LOGOUT', 'User', '1', '', '1501011079');
INSERT INTO `vich_sys_log` VALUES ('173', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501011088');
INSERT INTO `vich_sys_log` VALUES ('174', 'admin', 'LOGOUT', 'User', '1', '', '1501059874');
INSERT INTO `vich_sys_log` VALUES ('175', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501059881');
INSERT INTO `vich_sys_log` VALUES ('176', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.123\"}', '1501011352');
INSERT INTO `vich_sys_log` VALUES ('177', 'admin', 'LOGOUT', 'User', '1', '', '1501061561');
INSERT INTO `vich_sys_log` VALUES ('178', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501061583');
INSERT INTO `vich_sys_log` VALUES ('179', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501115692');
INSERT INTO `vich_sys_log` VALUES ('180', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501015883');
INSERT INTO `vich_sys_log` VALUES ('181', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501120266');
INSERT INTO `vich_sys_log` VALUES ('182', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501024133');
INSERT INTO `vich_sys_log` VALUES ('183', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501024315');
INSERT INTO `vich_sys_log` VALUES ('184', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501031408');
INSERT INTO `vich_sys_log` VALUES ('185', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501133229');
INSERT INTO `vich_sys_log` VALUES ('186', 'admin', 'ADD', 'MenuUrl', '161', '{\"menu_name\":\"\\/purchase\\/return_add.php\",\"menu_url\":\"\\/\\u767b\\u8bb0\\u9000\\u8d27\\u4ea7\\u54c1\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\"}', '1501133509');
INSERT INTO `vich_sys_log` VALUES ('187', 'admin', 'ADD', 'MenuUrl', '162', '{\"menu_name\":\"\\u767b\\u8bb0\\u5165\\u5e93\\u5546\\u54c1\",\"menu_url\":\"\\/storage\\/order_add.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\"}', '1501133587');
INSERT INTO `vich_sys_log` VALUES ('188', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,161,162\"}', '1501133594');
INSERT INTO `vich_sys_log` VALUES ('189', 'admin', 'MODIFY', 'MenuUrl', '161', '{\"menu_name\":\"\\u767b\\u8bb0\\u9000\\u8d27\\u4ea7\\u54c1\",\"menu_url\":\"\\/purchase\\/return_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\",\"module_id\":\"10\"}', '1501133606');
INSERT INTO `vich_sys_log` VALUES ('190', 'admin', 'LOGOUT', 'User', '1', '', '1501136951');
INSERT INTO `vich_sys_log` VALUES ('191', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501136968');
INSERT INTO `vich_sys_log` VALUES ('192', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501041549');
INSERT INTO `vich_sys_log` VALUES ('193', 'admin', 'LOGOUT', 'User', '1', '', '1501140115');
INSERT INTO `vich_sys_log` VALUES ('194', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1501140130');
INSERT INTO `vich_sys_log` VALUES ('195', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501140139');
INSERT INTO `vich_sys_log` VALUES ('196', 'admin', 'ADD', 'MenuUrl', '163', '{\"menu_name\":\"\\u5546\\u54c1\\u67e5\\u8be2\",\"menu_url\":\"\\/sys\\/goods_search.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\"}', '1501140492');
INSERT INTO `vich_sys_log` VALUES ('197', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,161,162,163\"}', '1501140499');
INSERT INTO `vich_sys_log` VALUES ('198', 'admin', 'LOGOUT', 'User', '1', '', '1501141054');
INSERT INTO `vich_sys_log` VALUES ('199', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501141062');
INSERT INTO `vich_sys_log` VALUES ('200', 'admin', 'ADD', 'MenuUrl', '164', '{\"menu_name\":\"\\u767b\\u8bb0\\u51fa\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/out_storage.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\"}', '1501141408');
INSERT INTO `vich_sys_log` VALUES ('201', 'admin', 'ADD', 'MenuUrl', '165', '{\"menu_name\":\"\\u767b\\u8bb0\\u8c03\\u62e8\\u4ea7\\u54c1\",\"menu_url\":\"\\/storage\\/allot_order_add.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\"}', '1501141445');
INSERT INTO `vich_sys_log` VALUES ('202', 'admin', 'ADD', 'MenuUrl', '166', '{\"menu_name\":\"\\u589e\\u52a0\\u76d8\\u70b9\\u5355\",\"menu_url\":\"\\/storage\\/count_order_add.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"141\"}', '1501141525');
INSERT INTO `vich_sys_log` VALUES ('203', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,161,162,163,164,165,166\"}', '1501141531');
INSERT INTO `vich_sys_log` VALUES ('204', 'admin', 'LOGOUT', 'User', '1', '', '1501043519');
INSERT INTO `vich_sys_log` VALUES ('205', 'admin', 'LOGOUT', 'User', '1', '', '1501141616');
INSERT INTO `vich_sys_log` VALUES ('206', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501141622');
INSERT INTO `vich_sys_log` VALUES ('207', 'admin', 'MODIFY', 'MenuUrl', '163', '{\"menu_name\":\"\\u5546\\u54c1\\u67e5\\u8be2\",\"menu_url\":\"\\/purchase\\/goods_search.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\",\"module_id\":\"10\"}', '1501141682');
INSERT INTO `vich_sys_log` VALUES ('208', 'admin', 'LOGOUT', 'User', '1', '', '1501143923');
INSERT INTO `vich_sys_log` VALUES ('209', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501143940');
INSERT INTO `vich_sys_log` VALUES ('210', 'admin', 'MODIFY', 'MenuUrl', '165', '{\"module_id\":\"5\"}', '1501144028');
INSERT INTO `vich_sys_log` VALUES ('211', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501047718');
INSERT INTO `vich_sys_log` VALUES ('212', 'admin', 'LOGOUT', 'User', '1', '', '1501148805');
INSERT INTO `vich_sys_log` VALUES ('213', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501148815');
INSERT INTO `vich_sys_log` VALUES ('214', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501052984');
INSERT INTO `vich_sys_log` VALUES ('215', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501202552');
INSERT INTO `vich_sys_log` VALUES ('216', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501053269');
INSERT INTO `vich_sys_log` VALUES ('217', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501060246');
INSERT INTO `vich_sys_log` VALUES ('218', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501209201');
INSERT INTO `vich_sys_log` VALUES ('219', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501060656');
INSERT INTO `vich_sys_log` VALUES ('220', 'admin', 'LOGOUT', 'User', '1', '', '1501060745');
INSERT INTO `vich_sys_log` VALUES ('221', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501288496');
INSERT INTO `vich_sys_log` VALUES ('222', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501306243');
INSERT INTO `vich_sys_log` VALUES ('223', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1501309276');
INSERT INTO `vich_sys_log` VALUES ('224', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501309288');
INSERT INTO `vich_sys_log` VALUES ('225', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501320078');
INSERT INTO `vich_sys_log` VALUES ('226', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501461645');
INSERT INTO `vich_sys_log` VALUES ('227', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501327437');
INSERT INTO `vich_sys_log` VALUES ('228', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501465064');
INSERT INTO `vich_sys_log` VALUES ('229', 'admin', 'MODIFY', 'Company', '20', '{\"companyId\":\"20\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501477559');
INSERT INTO `vich_sys_log` VALUES ('230', 'admin', 'MODIFY', 'Company', '19', '{\"companyId\":\"19\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501341887');
INSERT INTO `vich_sys_log` VALUES ('231', 'admin', 'MODIFY', 'Company', '19', '{\"companyId\":\"19\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501341969');
INSERT INTO `vich_sys_log` VALUES ('232', 'admin', 'MODIFY', 'Company', '21', '{\"companyId\":\"21\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501341985');
INSERT INTO `vich_sys_log` VALUES ('233', 'admin', 'MODIFY', 'Company', '21', '{\"companyId\":\"21\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501342173');
INSERT INTO `vich_sys_log` VALUES ('234', 'admin', 'MODIFY', 'Company', '21', '{\"companyId\":\"21\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501342218');
INSERT INTO `vich_sys_log` VALUES ('235', 'admin', 'MODIFY', 'Company', '21', '{\"companyId\":\"21\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501342256');
INSERT INTO `vich_sys_log` VALUES ('236', 'admin', 'MODIFY', 'Company', '21', '{\"companyId\":\"21\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501342347');
INSERT INTO `vich_sys_log` VALUES ('237', 'admin', 'MODIFY', 'Company', '21', '{\"companyId\":\"21\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501342353');
INSERT INTO `vich_sys_log` VALUES ('238', 'admin', 'MODIFY', 'Company', '21', '{\"companyId\":\"21\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501342358');
INSERT INTO `vich_sys_log` VALUES ('239', 'admin', 'MODIFY', 'Company', '21', '{\"companyId\":\"21\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501342365');
INSERT INTO `vich_sys_log` VALUES ('240', 'admin', 'MODIFY', 'Company', '21', '{\"companyId\":\"21\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501342369');
INSERT INTO `vich_sys_log` VALUES ('241', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501342991');
INSERT INTO `vich_sys_log` VALUES ('242', 'admin', 'ADD', 'MenuUrl', '167', '{\"menu_name\":\"\\u5220\\u9664\\u516c\\u53f8\",\"menu_url\":\"\\/sys\\/company_del.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"117\"}', '1501343592');
INSERT INTO `vich_sys_log` VALUES ('243', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,161,162,163,164,165,166,167\"}', '1501343598');
INSERT INTO `vich_sys_log` VALUES ('244', 'admin', 'LOGOUT', 'User', '1', '', '1501481042');
INSERT INTO `vich_sys_log` VALUES ('245', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501481051');
INSERT INTO `vich_sys_log` VALUES ('246', 'admin', 'DELETE', 'Company', 'a:1:{i:0;s:2:\"20\";}', '[\"20\"]', '1501481178');
INSERT INTO `vich_sys_log` VALUES ('247', 'admin', 'DELETE', 'Company', 'a:1:{i:0;s:2:\"20\";}', '[\"20\"]', '1501481201');
INSERT INTO `vich_sys_log` VALUES ('248', 'admin', 'DELETE', 'Company', 'a:1:{i:0;s:2:\"20\";}', '[\"20\"]', '1501345247');
INSERT INTO `vich_sys_log` VALUES ('249', 'admin', 'ADD', 'Company', '25', '{\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481529');
INSERT INTO `vich_sys_log` VALUES ('250', 'admin', 'ADD', 'Company', '26', '{\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-8888888\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481545');
INSERT INTO `vich_sys_log` VALUES ('251', 'admin', 'DELETE', 'Company', '25,26', '\"25,26\"', '1501481554');
INSERT INTO `vich_sys_log` VALUES ('252', 'admin', 'ADD', 'Company', '27', '{\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481567');
INSERT INTO `vich_sys_log` VALUES ('253', 'admin', 'ADD', 'Company', '28', '{\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481577');
INSERT INTO `vich_sys_log` VALUES ('254', 'admin', 'DELETE', 'Company', '28', '\"28\"', '1501481587');
INSERT INTO `vich_sys_log` VALUES ('255', 'admin', 'ADD', 'Company', '29', '{\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd51\",\"companyTel\":\"010-8888888\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481605');
INSERT INTO `vich_sys_log` VALUES ('256', 'admin', 'DELETE', 'Company', '29', '\"29\"', '1501481616');
INSERT INTO `vich_sys_log` VALUES ('257', 'admin', 'MODIFY', 'Company', '27', '{\"companyId\":\"27\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481799');
INSERT INTO `vich_sys_log` VALUES ('258', 'admin', 'MODIFY', 'Company', '27', '{\"companyId\":\"27\",\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd51\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481811');
INSERT INTO `vich_sys_log` VALUES ('259', 'admin', 'MODIFY', 'Company', '27', '{\"companyId\":\"27\",\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd51\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481836');
INSERT INTO `vich_sys_log` VALUES ('260', 'admin', 'MODIFY', 'Company', '27', '{\"companyId\":\"27\",\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd52\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481842');
INSERT INTO `vich_sys_log` VALUES ('261', 'admin', 'MODIFY', 'Company', '27', '{\"companyId\":\"27\",\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd53\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481885');
INSERT INTO `vich_sys_log` VALUES ('262', 'admin', 'MODIFY', 'Company', '27', '{\"companyId\":\"27\",\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd54\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501481924');
INSERT INTO `vich_sys_log` VALUES ('263', 'admin', 'MODIFY', 'Company', '27', '{\"companyId\":\"27\",\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd53\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501482152');
INSERT INTO `vich_sys_log` VALUES ('264', 'admin', 'DELETE', 'Company', '27', '\"27\"', '1501482163');
INSERT INTO `vich_sys_log` VALUES ('265', 'admin', 'ADD', 'Company', '30', '{\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"13564111240@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501482349');
INSERT INTO `vich_sys_log` VALUES ('266', 'admin', 'ADD', 'Company', '31', '{\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd51\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"13564111240@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501484011');
INSERT INTO `vich_sys_log` VALUES ('267', 'admin', 'ADD', 'DEPARTMENT', '2', '{\"departmentName\":\"11\",\"companyId\":\"30\",\"remark\":\"11\"}', '1501485820');
INSERT INTO `vich_sys_log` VALUES ('268', 'admin', 'ADD', 'DEPARTMENT', '3', '{\"departmentName\":\"\\u6d4b\\u8bd5\\u90e8\\u95e81\",\"remark\":\"xxxxx\"}', '1501351368');
INSERT INTO `vich_sys_log` VALUES ('269', 'admin', 'ADD', 'DEPARTMENT', '4', '{\"departmentName\":\"\\u6d4b\\u8bd5\\u90e8\\u95e82\",\"remark\":\"\\u6d4b\\u8bd5\\u90e8\\u95e82\"}', '1501351385');
INSERT INTO `vich_sys_log` VALUES ('270', 'admin', 'ADD', 'DEPARTMENT', '5', '{\"departmentName\":\"\\u6d4b\\u8bd5\\u90e8\\u95e82\",\"remark\":\"\\u6d4b\\u8bd5\\u90e8\\u95e82\"}', '1501351385');
INSERT INTO `vich_sys_log` VALUES ('271', 'admin', 'ADD', 'DEPARTMENT', '6', '{\"departmentName\":\"\\u6d4b\\u8bd5\\u90e8\\u95e82\",\"remark\":\"\\u6d4b\\u8bd5\\u90e8\\u95e82\"}', '1501351385');
INSERT INTO `vich_sys_log` VALUES ('272', 'admin', 'ADD', 'DEPARTMENT', '7', '{\"departmentName\":\"\\u6d4b\\u8bd5\\u90e8\\u95e82\",\"remark\":\"\"}', '1501351386');
INSERT INTO `vich_sys_log` VALUES ('273', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501351612');
INSERT INTO `vich_sys_log` VALUES ('274', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501351672');
INSERT INTO `vich_sys_log` VALUES ('275', 'admin', 'ADD', 'DEPARTMENT', '8', '{\"departmentName\":\"11\",\"remark\":\"11\"}', '1501487385');
INSERT INTO `vich_sys_log` VALUES ('276', 'admin', 'MODIFY', 'Department', '2', '{\"departmentId\":\"2\",\"departmentName\":\"2\",\"remark\":\"2222\"}', '1501487944');
INSERT INTO `vich_sys_log` VALUES ('277', 'admin', 'MODIFY', 'Department', '1', '{\"departmentId\":\"1\",\"departmentName\":\"11\",\"remark\":\"1111\"}', '1501488130');
INSERT INTO `vich_sys_log` VALUES ('278', 'admin', 'ADD', 'MenuUrl', '168', '{\"menu_name\":\"\\u5220\\u9664\\u90e8\\u95e8\",\"menu_url\":\"\\/sys\\/department_del.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"120\"}', '1501352690');
INSERT INTO `vich_sys_log` VALUES ('279', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,161,162,163,164,165,166,167,168\"}', '1501352723');
INSERT INTO `vich_sys_log` VALUES ('280', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501353033');
INSERT INTO `vich_sys_log` VALUES ('281', 'admin', 'LOGOUT', 'User', '1', '', '1501353245');
INSERT INTO `vich_sys_log` VALUES ('282', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501353252');
INSERT INTO `vich_sys_log` VALUES ('283', 'admin', 'LOGOUT', 'User', '1', '', '1501489140');
INSERT INTO `vich_sys_log` VALUES ('284', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501489163');
INSERT INTO `vich_sys_log` VALUES ('285', 'admin', 'LOGOUT', 'User', '1', '', '1501489318');
INSERT INTO `vich_sys_log` VALUES ('286', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501489329');
INSERT INTO `vich_sys_log` VALUES ('287', 'admin', 'DELETE', 'Department', '4', '\"4\"', '1501489434');
INSERT INTO `vich_sys_log` VALUES ('288', 'admin', 'MODIFY', 'Department', '6', '{\"departmentId\":\"6\",\"departmentName\":\"\\u6d4b\\u8bd5\\u90e8\\u95e82\",\"remark\":\"\\u6d4b\\u8bd5\\u90e8\\u95e82\"}', '1501356680');
INSERT INTO `vich_sys_log` VALUES ('289', 'admin', 'MODIFY', 'Company', '30', '{\"companyId\":\"30\",\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"13564111240@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501356689');
INSERT INTO `vich_sys_log` VALUES ('290', 'admin', 'ADD', 'Employee', '5', '{\"companyId\":\"30\",\"departmentId\":\"5\",\"employeeName\":\"\\u8def\\u516d\",\"employeeAddress\":\"\\u5bb6\\u91cc\",\"employeePhone\":\"13966608909\",\"employeeEmail\":\"123@qq.com\",\"employeeQQ\":\"1123443244\",\"employeeJob\":\"\\u6280\\u672f\\u5458 \"}', '1501493487');
INSERT INTO `vich_sys_log` VALUES ('291', 'admin', 'ADD', 'Employee', '6', '{\"companyId\":\"30\",\"departmentId\":\"5\",\"employeeName\":\"\\u4f59\\u5143\",\"employeeAddress\":\"\\u4f60\\u52a0\",\"employeePhone\":\"13966608909\",\"employeeEmail\":\"123@qq.com\",\"employeeQQ\":\"1123443244\",\"employeeJob\":\"\\u6280\\u672f\\u5458\"}', '1501493810');
INSERT INTO `vich_sys_log` VALUES ('292', 'admin', 'ADD', 'Employee', '7', '{\"companyId\":\"31\",\"departmentId\":\"5\",\"employeeName\":\"\\u82b1\\u6e56\",\"employeeAddress\":\"\\u5bb6\",\"employeePhone\":\"18755676654\",\"employeeEmail\":\"123@qq.com\",\"employeeQQ\":\"12345678\",\"employeeJob\":\"\\u5ba2\\u6237\"}', '1501494145');
INSERT INTO `vich_sys_log` VALUES ('293', 'admin', 'ADD', 'Employee', '8', '{\"companyId\":\"30\",\"departmentId\":\"5\",\"employeeName\":\"\\u5218\\u519b\",\"employeeAddress\":\"11\",\"employeePhone\":\"13912382811\",\"employeeEmail\":\"111@qqc.om\",\"employeeQQ\":\"11111\",\"employeeJob\":\"1111111\"}', '1501360283');
INSERT INTO `vich_sys_log` VALUES ('294', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501548005');
INSERT INTO `vich_sys_log` VALUES ('295', 'admin', 'ADD', 'Employee', '9', '{\"companyId\":\"30\",\"departmentId\":\"5\",\"employeeName\":\"\\u4f60\\u597d\",\"employeeAddress\":\"\\u5bb6\",\"employeePhone\":\"13966608909\",\"employeeEmail\":\"123@qq.com\",\"employeeQQ\":\"1123443244\",\"employeeJob\":\"\\u6280\\u672f\\u5458\"}', '1501548075');
INSERT INTO `vich_sys_log` VALUES ('296', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501361969');
INSERT INTO `vich_sys_log` VALUES ('297', 'admin', 'ADD', 'MenuUrl', '169', '{\"menu_name\":\"\\u5220\\u9664\\u5458\\u5de5\",\"menu_url\":\"\\/sys\\/employee_del.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"114\"}', '1501364562');
INSERT INTO `vich_sys_log` VALUES ('298', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,161,162,163,164,165,166,167,168,169\"}', '1501364568');
INSERT INTO `vich_sys_log` VALUES ('299', 'admin', 'ADD', 'Employee', '10', '{\"companyId\":\"30\",\"departmentId\":\"5\",\"employeeName\":\"\\u4f59\\u5143\",\"employeeAddress\":\"\\u5bb6\\u91cc\",\"employeePhone\":\"18755676654\",\"employeeEmail\":\"123@qq.com\",\"employeeQQ\":\"1123443244\",\"employeeJob\":\"\\u5ba2\\u6237\"}', '1501551727');
INSERT INTO `vich_sys_log` VALUES ('300', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501365844');
INSERT INTO `vich_sys_log` VALUES ('301', 'admin', 'LOGOUT', 'User', '1', '', '1501366567');
INSERT INTO `vich_sys_log` VALUES ('302', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501552735');
INSERT INTO `vich_sys_log` VALUES ('303', 'admin', 'DELETE', 'MenuUrl', '146', '{\"menu_id\":\"146\",\"menu_name\":\"\\u94f6\\u884c\\u7ba1\\u7406\",\"menu_url\":\"\\/finance\\/bank.php\",\"module_id\":\"8\",\"is_show\":\"1\",\"online\":\"1\",\"shortcut_allowed\":\"1\",\"menu_desc\":\"\",\"father_menu\":\"0\"}', '1501552976');
INSERT INTO `vich_sys_log` VALUES ('304', 'admin', 'DELETE', 'MenuUrl', '147', '{\"menu_id\":\"147\",\"menu_name\":\"\\u8d22\\u52a1\\u5206\\u7c7b\",\"menu_url\":\"\\/finance\\/cate.php\",\"module_id\":\"8\",\"is_show\":\"1\",\"online\":\"1\",\"shortcut_allowed\":\"1\",\"menu_desc\":\"\",\"father_menu\":\"0\"}', '1501552999');
INSERT INTO `vich_sys_log` VALUES ('305', 'admin', 'DELETE', 'MenuUrl', '154', '{\"menu_id\":\"154\",\"menu_name\":\"\\u65b0\\u589e\\u94f6\\u884c\\u8d26\\u6237\",\"menu_url\":\"\\/finance\\/bank_add.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":\"1\",\"shortcut_allowed\":\"0\",\"menu_desc\":\"\",\"father_menu\":\"146\"}', '1501553012');
INSERT INTO `vich_sys_log` VALUES ('306', 'admin', 'DELETE', 'MenuUrl', '155', '{\"menu_id\":\"155\",\"menu_name\":\"\\u7f16\\u8f91\\u94f6\\u884c\\u8d26\\u6237\",\"menu_url\":\"\\/finance\\/bank_modify.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":\"1\",\"shortcut_allowed\":\"0\",\"menu_desc\":\"\",\"father_menu\":\"146\"}', '1501553025');
INSERT INTO `vich_sys_log` VALUES ('307', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501368170');
INSERT INTO `vich_sys_log` VALUES ('308', 'admin', 'ADD', 'MenuUrl', '170', '{\"menu_name\":\"\\u4ea7\\u54c1\\u5206\\u7c7b\\u5220\\u9664\",\"menu_url\":\"\\/sys\\/goods_cats_del.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"108\"}', '1501368604');
INSERT INTO `vich_sys_log` VALUES ('309', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170\"}', '1501368610');
INSERT INTO `vich_sys_log` VALUES ('310', 'admin', 'DELETE', 'Department', '8', '\"8\"', '1501554823');
INSERT INTO `vich_sys_log` VALUES ('311', 'admin', 'DELETE', 'Department', '7', '\"7\"', '1501368730');
INSERT INTO `vich_sys_log` VALUES ('312', 'admin', 'DELETE', 'Department', '6', '\"6\"', '1501368872');
INSERT INTO `vich_sys_log` VALUES ('313', 'admin', 'DELETE', 'Department', '5', '\"5\"', '1501368877');
INSERT INTO `vich_sys_log` VALUES ('314', 'admin', 'ADD', 'DEPARTMENT', '9', '{\"departmentName\":\"\\u751f\\u4ea7\\u90e8\",\"remark\":\"\\u751f\\u4ea7\\u90e8\"}', '1501368893');
INSERT INTO `vich_sys_log` VALUES ('315', 'admin', 'ADD', 'DEPARTMENT', '10', '{\"departmentName\":\"\\u91c7\\u8d2d\\u90e8\",\"remark\":\"\"}', '1501368902');
INSERT INTO `vich_sys_log` VALUES ('316', 'admin', 'ADD', 'DEPARTMENT', '11', '{\"departmentName\":\"\\u91c7\\u8d2d\\u90e8\",\"remark\":\"\\u91c7\\u8d2d\\u90e8\"}', '1501368919');
INSERT INTO `vich_sys_log` VALUES ('317', 'admin', 'DELETE', 'Department', '10', '\"10\"', '1501368936');
INSERT INTO `vich_sys_log` VALUES ('318', 'admin', 'ADD', 'DEPARTMENT', '12', '{\"departmentName\":\"\\u4ed3\\u5e93\\u90e8\",\"remark\":\"\\u4ed3\\u5e93\\u90e8\"}', '1501368948');
INSERT INTO `vich_sys_log` VALUES ('319', 'admin', 'ADD', 'DEPARTMENT', '13', '{\"departmentName\":\"\\u9500\\u552e\\u90e8\",\"remark\":\"\\u9500\\u552e\\u90e8\"}', '1501368957');
INSERT INTO `vich_sys_log` VALUES ('320', 'admin', 'ADD', 'DEPARTMENT', '14', '{\"departmentName\":\"\\u8d22\\u52a1\\u90e8\",\"remark\":\"\\u8d22\\u52a1\\u90e8\"}', '1501368968');
INSERT INTO `vich_sys_log` VALUES ('321', 'admin', 'DELETE', 'Company', '30,31', '\"30,31\"', '1501368982');
INSERT INTO `vich_sys_log` VALUES ('322', 'admin', 'ADD', 'Company', '32', '{\"companyName\":\"\\u65e0\\u9521\\u5218\\u6f6d\\u670d\\u88c5\\u6709\\u9650\\u516c\\u53f8\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"05108899778\",\"companyUserName\":\"\\u6d4b\\u8bd5\",\"companyUserPhone\":\"13033312369\",\"companyUserEmail\":\"13033312369@qq.com\",\"companyUserQQ\":\"13033312369\"}', '1501369064');
INSERT INTO `vich_sys_log` VALUES ('323', 'admin', 'ADD', 'MenuUrl', '171', '{\"menu_name\":\"\\u4ea7\\u54c1\\u8ba1\\u91cf\\u5355\\u4f4d\\u5220\\u9664\",\"menu_url\":\"\\/sys\\/unit_del.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"151\"}', '1501373217');
INSERT INTO `vich_sys_log` VALUES ('324', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171\"}', '1501373221');
INSERT INTO `vich_sys_log` VALUES ('325', 'admin', 'DELETE', 'Employee', '1,2,3,4,5,6,8,9,10,7', '\"1,2,3,4,5,6,8,9,10,7\"', '1501373318');
INSERT INTO `vich_sys_log` VALUES ('326', 'admin', 'ADD', 'Employee', '11', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeName\":\"\\u90e8\\u95e8\\u7ecf\\u7406\",\"employeeAddress\":\"test\",\"employeePhone\":\"13912382811\",\"employeeEmail\":\"test@qq.com\",\"employeeQQ\":\"111232\",\"employeeJob\":\"\\u90e8\\u95e8\\u7ecf\\u7406\"}', '1501373363');
INSERT INTO `vich_sys_log` VALUES ('327', 'admin', 'MODIFY', 'Employee', '11', '{\"employeeId\":\"11\",\"companyId\":\"32\",\"departmentId\":\"12\",\"employeeName\":\"\\u90e8\\u95e8\\u7ecf\\u7406\",\"employeeAddress\":\"test\",\"employeePhone\":\"13912382811\",\"employeeEmail\":\"test@qq.com\",\"employeeJob\":\"\\u90e8\\u95e8\\u7ecf\\u7406\"}', '1501377200');
INSERT INTO `vich_sys_log` VALUES ('328', 'admin', 'MODIFY', 'Employee', '11', '{\"employeeId\":\"11\",\"companyId\":\"32\",\"departmentId\":\"12\",\"employeeName\":\"\\u90e8\\u95e8\\u7ecf\\u7406\",\"employeeAddress\":\"test\",\"employeePhone\":\"13912382811\",\"employeeEmail\":\"test@qq.com\",\"employeeJob\":\"\\u90e8\\u95e8\\u7ecf\\u7406\"}', '1501377448');
INSERT INTO `vich_sys_log` VALUES ('329', 'admin', 'MODIFY', 'Employee', '11', '{\"employeeId\":\"11\",\"companyId\":\"32\",\"departmentId\":\"12\",\"employeeName\":\"\\u90e8\\u95e8\\u7ecf\\u7406\",\"employeeAddress\":\"test\",\"employeePhone\":\"13912382811\",\"employeeEmail\":\"test@qq.com\",\"employeeQQ\":\"111\",\"employeeJob\":\"\\u90e8\\u95e8\\u7ecf\\u7406\"}', '1501377487');
INSERT INTO `vich_sys_log` VALUES ('330', 'admin', 'ADD', 'GoodsCats', '2', '{\"parentId\":\"0\",\"cateName\":\"\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501378383');
INSERT INTO `vich_sys_log` VALUES ('331', 'admin', 'ADD', 'MenuUrl', '172', '{\"menu_name\":\"\\u5220\\u9664\\u5546\\u54c1\",\"menu_url\":\"\\/sys\\/goods_del.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\\u5220\\u9664\\u5546\\u54c1\",\"shortcut_allowed\":\"0\",\"father_menu\":\"107\"}', '1501381110');
INSERT INTO `vich_sys_log` VALUES ('332', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172\"}', '1501381136');
INSERT INTO `vich_sys_log` VALUES ('333', 'admin', 'ADD', 'GoodsCats', '3', '{\"parentId\":\"1\",\"cateName\":\"\\u4e8c\\u7ea7\\u5206\\u7c7b\",\"cateSort\":\"1\"}', '1501381429');
INSERT INTO `vich_sys_log` VALUES ('334', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501382876');
INSERT INTO `vich_sys_log` VALUES ('335', 'admin', 'ADD', 'GoodsCats', '4', '{\"parentId\":\"1\",\"cateName\":\"\\u4e8c\\u7ea7\\u5206\\u7c7b2\",\"cateSort\":\"1\"}', '1501383724');
INSERT INTO `vich_sys_log` VALUES ('336', 'admin', 'ADD', 'MenuUrl', '173', '{\"menu_name\":\"\\u5220\\u9664\\u4f9b\\u5e94\\u5546\",\"menu_url\":\"\\/sys\\/suppliers_del.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"111\"}', '1501391638');
INSERT INTO `vich_sys_log` VALUES ('337', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173\"}', '1501391643');
INSERT INTO `vich_sys_log` VALUES ('338', 'admin', 'DELETE', 'MenuUrl', '104', '{\"menu_id\":\"104\",\"menu_name\":\"\\u7cfb\\u7edf\\u53d8\\u91cf\\u8bbe\\u7f6e\",\"menu_url\":\"\\/sys\\/base.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":\"1\",\"shortcut_allowed\":\"1\",\"menu_desc\":\"\",\"father_menu\":\"0\"}', '1501398064');
INSERT INTO `vich_sys_log` VALUES ('339', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501399217');
INSERT INTO `vich_sys_log` VALUES ('340', 'admin', 'ADD', 'MenuUrl', '174', '{\"menu_name\":\"\\u5ba2\\u6237\\u7ba1\\u7406\",\"menu_url\":\"\\/sys\\/customer.php\",\"module_id\":\"4\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1501399360');
INSERT INTO `vich_sys_log` VALUES ('341', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174\"}', '1501399366');
INSERT INTO `vich_sys_log` VALUES ('342', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501400034');
INSERT INTO `vich_sys_log` VALUES ('343', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501635598');
INSERT INTO `vich_sys_log` VALUES ('344', 'admin', 'ADD', 'Employee', '12', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeName\":\"\\u5218\\u6b23\",\"employeeAddress\":\"\\u5bb6\",\"employeePhone\":\"13966608909\",\"employeeEmail\":\"123@qq.com\",\"employeeQQ\":\"1123443244\",\"employeeJob\":\"\\u6280\\u672f\\u5458\"}', '1501636167');
INSERT INTO `vich_sys_log` VALUES ('345', 'admin', 'ADD', 'Employee', '13', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeName\":\"\\u5218\\u6b23\",\"employeeAddress\":\"\\u5bb6\",\"employeePhone\":\"18755676654\",\"employeeEmail\":\"123@qq.com\",\"employeeQQ\":\"1123443244\",\"employeeJob\":\"\\u6280\\u672f\\u5458\"}', '1501636715');
INSERT INTO `vich_sys_log` VALUES ('346', 'admin', 'MODIFY', 'MenuUrl', '150', '{\"menu_name\":\"\\u5e94\\u6536\\u8d26\\u6b3e\",\"menu_url\":\"\\/balance\\/collect.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"8\"}', '1501402357');
INSERT INTO `vich_sys_log` VALUES ('347', 'admin', 'MODIFY', 'MenuUrl', '133', '{\"menu_name\":\"\\u5e94\\u4ed8\\u6b3e\\u5355\",\"menu_url\":\"\\/balance\\/pay_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"8\"}', '1501402399');
INSERT INTO `vich_sys_log` VALUES ('348', 'admin', 'MODIFY', 'MenuUrl', '134', '{\"menu_name\":\"\\u5e94\\u4ed8\\u660e\\u7ec6\\u8d26\\/\\u603b\\u8d26\",\"menu_url\":\"\\/balance\\/pay_detail.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"133\",\"module_id\":\"8\"}', '1501402437');
INSERT INTO `vich_sys_log` VALUES ('349', 'admin', 'DELETE', 'Module', '9', '{\"module_id\":\"9\",\"module_name\":\"\\u5e94\\u6536\\u5e94\\u4ed8\",\"module_url\":\"\\/index.php\",\"module_sort\":\"6\",\"module_desc\":\"\",\"module_icon\":\"icon-calendar\",\"online\":\"1\"}', '1501402451');
INSERT INTO `vich_sys_log` VALUES ('350', 'admin', 'MODIFY', 'MenuUrl', '133', '{\"menu_name\":\"\\u5e94\\u4ed8\\u6b3e\\u5355\",\"menu_url\":\"\\/finance\\/pay_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"8\"}', '1501402721');
INSERT INTO `vich_sys_log` VALUES ('351', 'admin', 'MODIFY', 'MenuUrl', '134', '{\"menu_name\":\"\\u5e94\\u4ed8\\u660e\\u7ec6\\u8d26\\/\\u603b\\u8d26\",\"menu_url\":\"\\/finance\\/pay_detail.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"133\",\"module_id\":\"8\"}', '1501402739');
INSERT INTO `vich_sys_log` VALUES ('352', 'admin', 'MODIFY', 'MenuUrl', '150', '{\"menu_name\":\"\\u5e94\\u6536\\u8d26\\u6b3e\",\"menu_url\":\"\\/finance\\/collect.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"8\"}', '1501402776');
INSERT INTO `vich_sys_log` VALUES ('353', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501637912');
INSERT INTO `vich_sys_log` VALUES ('354', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501639932');
INSERT INTO `vich_sys_log` VALUES ('355', 'admin', 'MODIFY', 'Company', '32', '{\"companyId\":\"32\",\"companyName\":\"\\u65e0\\u9521\\u5218\\u6f6d\\u670d\\u88c5\\u6709\\u9650\\u516c\\u53f8\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"05108899778\",\"companyUserName\":\"\\u6d4b\\u8bd5\",\"companyUserPhone\":\"13033312369\",\"companyUserEmail\":\"13033312369@qq.com\",\"companyUserQQ\":\"13033312369\"}', '1501640095');
INSERT INTO `vich_sys_log` VALUES ('356', 'admin', 'LOGOUT', 'User', '1', '', '1501642998');
INSERT INTO `vich_sys_log` VALUES ('357', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501643007');
INSERT INTO `vich_sys_log` VALUES ('358', 'admin', 'LOGOUT', 'User', '1', '', '1501643024');
INSERT INTO `vich_sys_log` VALUES ('359', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501408363');
INSERT INTO `vich_sys_log` VALUES ('360', 'admin', 'LOGOUT', 'User', '1', '', '1501408373');
INSERT INTO `vich_sys_log` VALUES ('361', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501643079');
INSERT INTO `vich_sys_log` VALUES ('362', 'admin', 'LOGOUT', 'User', '1', '', '1501643299');
INSERT INTO `vich_sys_log` VALUES ('363', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501643307');
INSERT INTO `vich_sys_log` VALUES ('364', 'admin', 'MODIFY', 'Company', '32', '{\"companyId\":\"32\",\"companyName\":\"\\u65e0\\u9521\\u5218\\u6f6d\\u670d\\u88c5\\u6709\\u9650\\u516c\\u53f8\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"05108899778\",\"companyUserName\":\"\\u6d4b\\u8bd5\",\"companyUserPhone\":\"13033312369\",\"companyUserEmail\":\"13033312369@qq.com\",\"companyUserQQ\":\"13033312369\"}', '1501643324');
INSERT INTO `vich_sys_log` VALUES ('365', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501408929');
INSERT INTO `vich_sys_log` VALUES ('366', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501643742');
INSERT INTO `vich_sys_log` VALUES ('367', 'admin', 'ADD', 'GoodsUnit', '5', '{\"unitName\":\"\\u6d4b\\u8bd5\"}', '1501644029');
INSERT INTO `vich_sys_log` VALUES ('368', 'admin', 'ADD', 'Employee', '14', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\\u5458\",\"employeeAddress\":\"xxxxx\",\"employeePhone\":\"13564111240\",\"employeeEmail\":\"907914683@qq.com\",\"employeeQQ\":\"907914683\",\"employeeJob\":\"\\u6d4b\\u8bd5\"}', '1501644059');
INSERT INTO `vich_sys_log` VALUES ('369', 'admin', 'MODIFY', 'Employee', '14', '{\"employeeId\":\"14\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\\u5458\",\"employeeAddress\":\"xxxxx\",\"employeePhone\":\"13564111240\",\"employeeEmail\":\"907914683@qq.com\",\"employeeQQ\":\"907914683\",\"employeeJob\":\"\\u6d4b\\u8bd5\"}', '1501644081');
INSERT INTO `vich_sys_log` VALUES ('370', 'admin', 'MODIFY', 'Employee', '14', '{\"employeeId\":\"14\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\\u5458\",\"employeeAddress\":\"xxxxx\",\"employeePhone\":\"13564111240\",\"employeeEmail\":\"907914683@qq.com\",\"employeeQQ\":\"907914683\",\"employeeJob\":\"\\u6d4b\\u8bd5\"}', '1501644094');
INSERT INTO `vich_sys_log` VALUES ('371', 'admin', 'ADD', 'GoodsUnit', '6', '{\"unitName\":\"\\u6d4b\\u901f\"}', '1501644282');
INSERT INTO `vich_sys_log` VALUES ('372', 'admin', 'DELETE', 'Employee', '14', '\"14\"', '1501644101');
INSERT INTO `vich_sys_log` VALUES ('373', 'admin', 'ADD', 'Company', '33', '{\"companyName\":\"\\u6d4b\\u8bd5\\u516c\\u53f8\",\"companyAddress\":\"xxxxx\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501644197');
INSERT INTO `vich_sys_log` VALUES ('374', 'admin', 'ADD', 'Company', '34', '{\"companyName\":\"\\u6d4b\\u8bd5\\u516c\\u53f8\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501644229');
INSERT INTO `vich_sys_log` VALUES ('375', 'admin', 'ADD', 'Company', '35', '{\"companyName\":\"\\u6d4b\\u8bd5\\u516c\\u53f8\",\"companyAddress\":\"xxxxx\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501644244');
INSERT INTO `vich_sys_log` VALUES ('376', 'admin', 'DELETE', 'Company', '33,34,35', '\"33,34,35\"', '1501644253');
INSERT INTO `vich_sys_log` VALUES ('377', 'admin', 'ADD', 'GoodsUnit', '7', '{\"unitName\":\"\\u6d4b\\u8bd5\"}', '1501644496');
INSERT INTO `vich_sys_log` VALUES ('378', 'admin', 'ADD', 'DEPARTMENT', '15', '{\"departmentName\":\"\\u6d4b\\u8bd5\\u90e8\\u95e8\",\"remark\":\"xxX\"}', '1501644362');
INSERT INTO `vich_sys_log` VALUES ('379', 'admin', 'DELETE', 'Department', '15', '\"15\"', '1501644367');
INSERT INTO `vich_sys_log` VALUES ('380', 'admin', 'MODIFY', 'GoodsUnit', '5', '{\"unitId\":\"5\",\"unitName\":\"\\u6d4b\\u8bd5\"}', '1501644963');
INSERT INTO `vich_sys_log` VALUES ('381', 'admin', 'MODIFY', 'GoodsUnit', '2', '{\"unitId\":\"2\",\"unitName\":\"\\u5c0f\\u4ef6\"}', '1501644980');
INSERT INTO `vich_sys_log` VALUES ('382', 'admin', 'DELETE', 'GoodsUnit', '1', '\"1\"', '1501645020');
INSERT INTO `vich_sys_log` VALUES ('383', 'admin', 'DELETE', 'GoodsUnit', '5', '\"5\"', '1501645028');
INSERT INTO `vich_sys_log` VALUES ('384', 'admin', 'ADD', 'GoodsUnit', '8', '{\"unitName\":\"\\u5927\\u4ef6\"}', '1501645041');
INSERT INTO `vich_sys_log` VALUES ('385', 'admin', 'MODIFY', 'GoodsUnit', '6', '{\"unitId\":\"6\",\"unitName\":\"\\u6d4b\\u8bd5\"}', '1501645057');
INSERT INTO `vich_sys_log` VALUES ('386', 'admin', 'DELETE', 'GoodsUnit', '6', '\"6\"', '1501645067');
INSERT INTO `vich_sys_log` VALUES ('387', 'admin', 'ADD', 'GoodsCats', '6', '{\"parentId\":\"3\",\"cateName\":\"\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501648163');
INSERT INTO `vich_sys_log` VALUES ('388', 'admin', 'ADD', 'Employee', '15', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\",\"employeeAddress\":\"xxxxxxxxx\",\"employeePhone\":\"13564111888\",\"employeeEmail\":\"test@qq.com\",\"employeeQQ\":\"13564111888\",\"employeeJob\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\"}', '1501650453');
INSERT INTO `vich_sys_log` VALUES ('389', 'admin', 'ADD', 'User', '27', '{\"user_name\":\"test\",\"password\":\"\",\"real_name\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\",\"mobile\":\"13564111888\",\"email\":\"test@qq.com\",\"user_desc\":\"\\u6d4b\\u8bd5\\u8d26\\u53f7\",\"user_group\":\"2\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"15\"}', '1501650499');
INSERT INTO `vich_sys_log` VALUES ('390', 'admin', 'ADD', 'GoodsCats', '7', '{\"parentId\":\"3\",\"cateName\":\"\\u4f60\\u597d\",\"cateSort\":\"1\"}', '1501650825');
INSERT INTO `vich_sys_log` VALUES ('391', 'admin', 'MODIFY', 'User', '27', '{\"real_name\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\",\"mobile\":\"13564111888\",\"email\":\"test@qq.com\",\"user_desc\":\"\\u6d4b\\u8bd5\\u8d26\\u53f7\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"15\",\"selectAll\":\"1\",\"user_group\":\"2\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"ip\":\"192.168.0.100\"}', '1501651222');
INSERT INTO `vich_sys_log` VALUES ('392', 'admin', 'LOGOUT', 'User', '1', '', '1501651279');
INSERT INTO `vich_sys_log` VALUES ('393', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501651500');
INSERT INTO `vich_sys_log` VALUES ('394', 'admin', 'LOGOUT', 'User', '1', '', '1501651686');
INSERT INTO `vich_sys_log` VALUES ('395', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501651693');
INSERT INTO `vich_sys_log` VALUES ('396', 'test', 'LOGOUT', 'User', '27', '', '1501651701');
INSERT INTO `vich_sys_log` VALUES ('397', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501651707');
INSERT INTO `vich_sys_log` VALUES ('398', 'admin', 'MODIFY', 'User', '27', '{\"real_name\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\",\"mobile\":\"13564111888\",\"email\":\"test@qq.com\",\"user_desc\":\"\\u6d4b\\u8bd5\\u8d26\\u53f7\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"15\",\"selectAll\":\"1\",\"user_group\":\"1\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"ip\":\"192.168.0.100\"}', '1501651725');
INSERT INTO `vich_sys_log` VALUES ('399', 'admin', 'LOGOUT', 'User', '1', '', '1501651729');
INSERT INTO `vich_sys_log` VALUES ('400', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501651738');
INSERT INTO `vich_sys_log` VALUES ('401', 'test', 'LOGOUT', 'User', '27', '', '1501651799');
INSERT INTO `vich_sys_log` VALUES ('402', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501651806');
INSERT INTO `vich_sys_log` VALUES ('403', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"1\",\"parentId\":null,\"cateName\":\"\\u6d4b\\u8bd5\\u5206\\u7c7b\",\"cateSort\":\"1\"}', '1501652399');
INSERT INTO `vich_sys_log` VALUES ('404', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"1\",\"parentId\":null,\"cateName\":\"\\u6d4b\\u8bd5\\u5206\\u7c7b2222\",\"cateSort\":\"1\"}', '1501652405');
INSERT INTO `vich_sys_log` VALUES ('405', 'test', 'ADD', 'Company', '36', '{\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u80e1\\u9e4f\\u98de\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"907914683@qq.com\",\"companyUserQQ\":\"13564111240\"}', '1501652249');
INSERT INTO `vich_sys_log` VALUES ('406', 'test', 'ADD', 'DEPARTMENT', '16', '{\"departmentName\":\"\\u6d4b\\u8bd5\\u90e8\\u95e8\",\"remark\":\"\"}', '1501652354');
INSERT INTO `vich_sys_log` VALUES ('407', 'admin', 'LOGOUT', 'User', '1', '', '1501652987');
INSERT INTO `vich_sys_log` VALUES ('408', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501653002');
INSERT INTO `vich_sys_log` VALUES ('409', 'test', 'DELETE', 'Company', '36', '\"36\"', '1501653801');
INSERT INTO `vich_sys_log` VALUES ('410', 'admin', 'DELETE', 'GoodsCate', '6', '\"6\"', '1501654111');
INSERT INTO `vich_sys_log` VALUES ('411', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501420288');
INSERT INTO `vich_sys_log` VALUES ('412', 'admin', 'LOGOUT', 'User', '1', '', '1501420309');
INSERT INTO `vich_sys_log` VALUES ('413', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501420317');
INSERT INTO `vich_sys_log` VALUES ('414', 'test', 'ADD', 'Company', '37', '{\"companyName\":\"\\u6d4b\\u8bd5\\u516c\\u53f8\",\"companyAddress\":\"xxxxx\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u738b\\u4e8c\",\"companyUserPhone\":\"13666666666\",\"companyUserEmail\":\"test@example.com\",\"companyUserQQ\":\"136666666666\"}', '1501420420');
INSERT INTO `vich_sys_log` VALUES ('415', 'test', 'DELETE', 'Company', '36', '\"36\"', '1501420435');
INSERT INTO `vich_sys_log` VALUES ('416', 'test', 'LOGOUT', 'User', '27', '', '1501654188');
INSERT INTO `vich_sys_log` VALUES ('417', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501654196');
INSERT INTO `vich_sys_log` VALUES ('418', 'admin', 'LOGOUT', 'User', '1', '', '1501654407');
INSERT INTO `vich_sys_log` VALUES ('419', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501654417');
INSERT INTO `vich_sys_log` VALUES ('420', 'test', 'LOGOUT', 'User', '27', '', '1501654422');
INSERT INTO `vich_sys_log` VALUES ('421', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501654432');
INSERT INTO `vich_sys_log` VALUES ('422', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501654449');
INSERT INTO `vich_sys_log` VALUES ('423', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501654497');
INSERT INTO `vich_sys_log` VALUES ('424', 'admin', 'LOGOUT', 'User', '1', '', '1501654507');
INSERT INTO `vich_sys_log` VALUES ('425', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501654514');
INSERT INTO `vich_sys_log` VALUES ('426', 'admin', 'LOGOUT', 'User', '1', '', '1501655804');
INSERT INTO `vich_sys_log` VALUES ('427', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501655811');
INSERT INTO `vich_sys_log` VALUES ('428', 'test', 'LOGOUT', 'User', '27', '', '1501656606');
INSERT INTO `vich_sys_log` VALUES ('429', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501656613');
INSERT INTO `vich_sys_log` VALUES ('430', 'test', 'LOGOUT', 'User', '27', '', '1501423437');
INSERT INTO `vich_sys_log` VALUES ('431', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501423445');
INSERT INTO `vich_sys_log` VALUES ('432', 'admin', 'LOGOUT', 'User', '1', '', '1501657104');
INSERT INTO `vich_sys_log` VALUES ('433', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501657111');
INSERT INTO `vich_sys_log` VALUES ('434', 'test', 'MODIFY', 'Employee', '11', '{\"employeeId\":\"11\",\"companyId\":\"32\",\"departmentId\":\"12\",\"employeeName\":\"\\u90e8\\u95e8\\u7ecf\\u7406\",\"employeeAddress\":\"test\",\"employeePhone\":\"13912382811\",\"employeeEmail\":\"test@qq.com\",\"employeeQQ\":\"111\",\"employeeJob\":\"\\u90e8\\u95e8\\u7ecf\\u7406\"}', '1501658062');
INSERT INTO `vich_sys_log` VALUES ('435', 'test', 'ADD', 'Employee', '16', '{\"companyId\":\"37\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\",\"employeeAddress\":\"xxxxx\",\"employeePhone\":\"13666666666\",\"employeeEmail\":\"test@example.com\",\"employeeQQ\":\"13666666666\",\"employeeJob\":\"\\u6d4b\\u8bd5\"}', '1501658222');
INSERT INTO `vich_sys_log` VALUES ('436', 'test', 'DELETE', 'Employee', '16', '\"16\"', '1501658434');
INSERT INTO `vich_sys_log` VALUES ('437', 'test', 'MODIFY', 'Department', '16', '{\"departmentId\":\"16\",\"departmentName\":\"\\u6d4b\\u8bd5\\u90e8\\u95e8\",\"remark\":\"\"}', '1501658796');
INSERT INTO `vich_sys_log` VALUES ('438', 'test', 'ADD', 'Employee', '17', '{\"companyId\":\"37\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\",\"employeeAddress\":\"xxxx\",\"employeePhone\":\"13666666666\",\"employeeEmail\":\"xx@qq.com\",\"employeeQQ\":\"13666666666\",\"employeeJob\":\"\\u6d4b\\u8bd5\"}', '1501658933');
INSERT INTO `vich_sys_log` VALUES ('439', 'test', 'MODIFY', 'Employee', '17', '{\"employeeId\":\"17\",\"companyId\":\"37\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\",\"employeeAddress\":\"xxxx\",\"employeePhone\":\"13666666666\",\"employeeEmail\":\"xx@qq.com\",\"employeeQQ\":\"13666666666\",\"employeeJob\":\"\\u6d4b\\u8bd5\"}', '1501658938');
INSERT INTO `vich_sys_log` VALUES ('440', 'admin', 'ADD', 'Company', '38', '{\"companyName\":\"\\u6d4b\\u8bd51\",\"companyAddress\":\"\\u6d4b\\u8bd51\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501659247');
INSERT INTO `vich_sys_log` VALUES ('441', 'admin', 'MODIFY', 'Company', '38', '{\"companyId\":\"38\",\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd51\",\"companyTel\":\"010-12345667\",\"companyUserName\":\"\\u516d\\u516d\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"123@qq.com\",\"companyUserQQ\":\"1234567\"}', '1501659270');
INSERT INTO `vich_sys_log` VALUES ('442', 'admin', 'DELETE', 'Company', '38', '\"38\"', '1501659278');
INSERT INTO `vich_sys_log` VALUES ('443', 'admin', 'ADD', 'DEPARTMENT', '17', '{\"departmentName\":\"\\u6280\\u672f\\u90e8\",\"remark\":\"\\u6280\\u672f\\u90e8\"}', '1501659358');
INSERT INTO `vich_sys_log` VALUES ('444', 'admin', 'DELETE', 'Department', '17', '\"17\"', '1501659428');
INSERT INTO `vich_sys_log` VALUES ('445', 'test', 'ADD', 'GoodsCats', '8', '{\"parentId\":\"1\",\"cateName\":\"111\",\"cateSort\":\"1\"}', '1501659692');
INSERT INTO `vich_sys_log` VALUES ('446', 'test', 'ADD', 'GoodsCats', '9', '{\"parentId\":\"0\",\"cateName\":\"111\",\"cateSort\":\"1\"}', '1501659724');
INSERT INTO `vich_sys_log` VALUES ('447', 'test', 'DELETE', 'GoodsCate', '8', '\"8\"', '1501660316');
INSERT INTO `vich_sys_log` VALUES ('448', 'test', 'DELETE', 'GoodsCate', '9', '\"9\"', '1501660682');
INSERT INTO `vich_sys_log` VALUES ('449', 'test', 'DELETE', 'GoodsCate', '8,9', '\"8,9\"', '1501660706');
INSERT INTO `vich_sys_log` VALUES ('450', 'admin', 'DELETE', 'GoodsCate', '7', '\"7\"', '1501427571');
INSERT INTO `vich_sys_log` VALUES ('451', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"5\",\"parentId\":null,\"cateName\":\"\\u4e09\\u7ea7\\u5206\\u7c7b\",\"cateSort\":\"1\"}', '1501427576');
INSERT INTO `vich_sys_log` VALUES ('452', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"4\",\"parentId\":null,\"cateName\":\"\\u4e8c\\u7ea7\\u5206\\u7c7b2\",\"cateSort\":\"1\"}', '1501427601');
INSERT INTO `vich_sys_log` VALUES ('453', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"4\",\"parentId\":null,\"cateName\":\"\\u4e8c\\u7ea7\\u5206\\u7c7b2\",\"cateSort\":\"1\"}', '1501427629');
INSERT INTO `vich_sys_log` VALUES ('454', 'admin', 'ADD', 'GoodsCats', '10', '{\"parentId\":\"0\",\"cateName\":\"\\u4e00\\u7ea7\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501427673');
INSERT INTO `vich_sys_log` VALUES ('455', 'admin', 'ADD', 'GoodsCats', '11', '{\"parentId\":\"10\",\"cateName\":\"\\u4e8c\\u7ea7\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501427707');
INSERT INTO `vich_sys_log` VALUES ('456', 'admin', 'ADD', 'GoodsCats', '12', '{\"parentId\":\"11\",\"cateName\":\"\\u4e09\\u7ea7\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501427720');
INSERT INTO `vich_sys_log` VALUES ('457', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"12\",\"parentId\":null,\"cateName\":\"\\u4e09\\u7ea7\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501427728');
INSERT INTO `vich_sys_log` VALUES ('458', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"12\",\"parentId\":null,\"cateName\":\"\\u4e09\\u7ea7\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501427975');
INSERT INTO `vich_sys_log` VALUES ('459', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"12\",\"parentId\":\"11\",\"cateName\":\"\\u4e09\\u7ea7\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501428092');
INSERT INTO `vich_sys_log` VALUES ('460', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"11\",\"parentId\":\"10\",\"cateName\":\"\\u4e8c\\u7ea7\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501428233');
INSERT INTO `vich_sys_log` VALUES ('461', 'test', 'ADD', 'GoodsUnit', '9', '{\"unitName\":\"\\u6d4b\\u8bd5\"}', '1501663260');
INSERT INTO `vich_sys_log` VALUES ('462', 'test', 'DELETE', 'GoodsUnit', '9', '\"9\"', '1501663268');
INSERT INTO `vich_sys_log` VALUES ('463', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501430741');
INSERT INTO `vich_sys_log` VALUES ('464', 'test', 'ADD', 'Supplier', '3', '{\"supplierName\":\"\\u6d4b\\u8bd5\",\"supplierAddress\":\"\\u6d4b\\u8bd5\",\"supplierTel\":\"010-9999999\",\"supplierUserName\":\"\\u6d4b\\u8bd5\",\"supplierUserPhone\":\"13564111240\",\"supplierUserEmail\":\"test@example.com\",\"supplierUserQQ\":\"13564111240\",\"bankName\":\"\\u6d4b\\u8bd5\",\"bankAccount\":\"6214832136673428\",\"bankOpenName\":\"\\u6d4b\\u8bd5\",\"cardUserName\":\"\\u6d4b\\u8bd5\",\"cardUserPhone\":\"13564111240\",\"cardMoney\":\"0\",\"remark\":\"\\u6d4b\\u8bd5\"}', '1501664050');
INSERT INTO `vich_sys_log` VALUES ('465', 'test', 'LOGOUT', 'User', '27', '', '1501664168');
INSERT INTO `vich_sys_log` VALUES ('466', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501431265');
INSERT INTO `vich_sys_log` VALUES ('467', 'admin', 'ADD', 'Supplier', '4', '{\"supplierName\":\"\\u6d4b\\u8bd5\",\"supplierAddress\":\"\\u6d4b\\u8bd5\",\"supplierTel\":\"010-9999999\",\"supplierUserName\":\"\\u6d4b\\u8bd5\",\"supplierUserPhone\":\"13564111240\",\"supplierUserEmail\":\"test@example.com\",\"supplierUserQQ\":\"13564111240\",\"bankName\":\"\\u6d4b\\u8bd5\",\"bankAccount\":\"6214832136673428\",\"bankOpenName\":\"\\u6d4b\\u8bd5\",\"cardUserName\":\"\\u6d4b\\u8bd5\",\"cardUserPhone\":\"13564111240\",\"cardMoney\":\"0\",\"remark\":\"\"}', '1501431294');
INSERT INTO `vich_sys_log` VALUES ('468', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.123\"}', '1501431345');
INSERT INTO `vich_sys_log` VALUES ('469', 'admin', 'DELETE', 'Department', '16', '\"16\"', '1501431412');
INSERT INTO `vich_sys_log` VALUES ('470', 'admin', 'LOGOUT', 'User', '1', '', '1501431416');
INSERT INTO `vich_sys_log` VALUES ('471', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501431429');
INSERT INTO `vich_sys_log` VALUES ('472', 'admin', 'ADD', 'Supplier', '5', '{\"supplierName\":\"\\u516d\\u516d\",\"supplierAddress\":\"\\u516d\\u516d\",\"supplierTel\":\"0554-87898745\",\"supplierUserName\":\"\\u516d\\u516d\",\"supplierUserPhone\":\"18745634563\",\"supplierUserEmail\":\"123@qq.com\",\"supplierUserQQ\":\"46556123\",\"bankName\":\"\\u5efa\\u884c\",\"bankAccount\":\"6212262201023557228\",\"bankOpenName\":\"\\u5efa\\u884c\",\"cardUserName\":\"\\u516d\\u516d\",\"cardUserPhone\":\"18745632589\",\"cardMoney\":\"5000000\",\"remark\":\"\"}', '1501431526');
INSERT INTO `vich_sys_log` VALUES ('473', 'admin', 'ADD', 'Supplier', '6', '{\"supplierName\":\"\\u6d4b\\u8bd5\",\"supplierAddress\":\"\\u6d4b\\u8bd5\",\"supplierTel\":\"010-99999999\",\"supplierUserName\":\"\\u6d4b\\u8bd5\",\"supplierUserPhone\":\"13564111240\",\"supplierUserEmail\":\"1@example.com\",\"supplierUserQQ\":\"13564111240\",\"bankName\":\"\\u6d4b\\u8bd5\",\"bankAccount\":\"6214832136673428\",\"bankOpenName\":\"\\u6d4b\\u8bd5\",\"cardUserName\":\"\\u6d4b\\u8bd5\",\"cardUserPhone\":\"13564111240\",\"cardMoney\":\"0\",\"remark\":\"\"}', '1501431687');
INSERT INTO `vich_sys_log` VALUES ('474', 'admin', 'LOGOUT', 'User', '1', '', '1501432097');
INSERT INTO `vich_sys_log` VALUES ('475', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.123\"}', '1501432106');
INSERT INTO `vich_sys_log` VALUES ('476', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501664962');
INSERT INTO `vich_sys_log` VALUES ('477', 'admin', 'ADD', 'Supplier', '7', '{\"supplierName\":\"\\u516d\\u516d\",\"supplierAddress\":\"\\u516d\\u516d\",\"supplierTel\":\"0554-87898745\",\"supplierUserName\":\"\\u516d\\u516d\",\"supplierUserPhone\":\"18788945612\",\"supplierUserEmail\":\"123@qq.com\",\"supplierUserQQ\":\"46556123\",\"bankName\":\"\\u90ae\\u653f\\u50a8\\u84c4\\u9ec4\\u96c6\\u5206\\u884c\",\"bankAccount\":\"6212262201023557228\",\"bankOpenName\":\"\\u5efa\\u884c\",\"cardUserName\":\"\\u516d\\u516d\",\"cardUserPhone\":\"18755466969\",\"cardMoney\":\"5000000\",\"remark\":\"\"}', '1501432176');
INSERT INTO `vich_sys_log` VALUES ('478', 'admin', 'ADD', 'Supplier', '8', '{\"supplierName\":\"\\u516d\\u516d\",\"supplierAddress\":\"\\u516d\\u516d\",\"supplierTel\":\"0554-87898745\",\"supplierUserName\":\"\\u516d\\u516d\",\"supplierUserPhone\":\"18788945612\",\"supplierUserEmail\":\"123@qq.com\",\"supplierUserQQ\":\"46556123\",\"bankName\":\"\\u90ae\\u653f\\u50a8\\u84c4\\u9ec4\\u96c6\\u5206\\u884c\",\"bankAccount\":\"6212262201023557228\",\"bankOpenName\":\"\\u5efa\\u884c\",\"cardUserName\":\"\\u516d\\u516d\",\"cardUserPhone\":\"18755466969\",\"cardMoney\":\"5000000\",\"remark\":\"\"}', '1501432339');
INSERT INTO `vich_sys_log` VALUES ('479', 'admin', 'ADD', 'MenuUrl', '175', '{\"menu_name\":\"\\u4f9b\\u5e94\\u5546\\u5ba1\\u6838\",\"menu_url\":\"\\/sys\\/suppliers_review.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"111\"}', '1501665911');
INSERT INTO `vich_sys_log` VALUES ('480', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175\"}', '1501666120');
INSERT INTO `vich_sys_log` VALUES ('481', 'admin', 'ADD', 'Supplier', '9', '{\"supplierName\":\"\\u516d\\u516d\",\"supplierAddress\":\"\\u516d\\u516d\",\"supplierTel\":\"0554-87898745\",\"supplierUserName\":\"\\u516d\\u516d\",\"supplierUserPhone\":\"18788945612\",\"supplierUserEmail\":\"123@qq.com\",\"supplierUserQQ\":\"46556123\",\"bankName\":\"\\u90ae\\u653f\\u50a8\\u84c4\\u9ec4\\u96c6\\u5206\\u884c\",\"bankAccount\":\"6212262201023557228\",\"bankOpenName\":\"\\u5efa\\u884c\",\"cardUserName\":\"\\u516d\\u516d\",\"cardUserPhone\":\"18755466969\",\"cardMoney\":\"5000000\",\"remark\":\"\"}', '1501433714');
INSERT INTO `vich_sys_log` VALUES ('482', 'admin', 'ADD', 'Supplier', '10', '{\"supplierName\":\"\\u6d4b\\u8bd5\",\"supplierAddress\":\"\\u6d4b\\u8bd5\",\"supplierTel\":\"010-9999999\",\"supplierUserName\":\"\\u6d4b\\u8bd5\",\"supplierUserPhone\":\"13564111240\",\"supplierUserEmail\":\"test@example.com\",\"supplierUserQQ\":\"13564111240\",\"bankName\":\"\\u6d4b\\u8bd5\",\"bankAccount\":\"6214832136673428\",\"bankOpenName\":\"\\u6d4b\\u8bd5\",\"cardUserName\":\"\\u6d4b\\u8bd5\",\"cardUserPhone\":\"13564111240\",\"cardMoney\":\"0\",\"remark\":\"\"}', '1501666584');
INSERT INTO `vich_sys_log` VALUES ('483', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501720422');
INSERT INTO `vich_sys_log` VALUES ('484', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501720422');
INSERT INTO `vich_sys_log` VALUES ('485', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501720422');
INSERT INTO `vich_sys_log` VALUES ('486', 'admin', 'LOGOUT', 'User', '1', '', '1501720612');
INSERT INTO `vich_sys_log` VALUES ('487', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501720619');
INSERT INTO `vich_sys_log` VALUES ('488', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501720882');
INSERT INTO `vich_sys_log` VALUES ('489', 'test', 'MODIFY', 'Department', '9', '{\"departmentId\":\"9\",\"departmentName\":\"\\u751f\\u4ea7\\u90e8\",\"remark\":\"\\u751f\\u4ea7\\u90e8\"}', '1501720810');
INSERT INTO `vich_sys_log` VALUES ('490', 'test', 'DELETE', 'Department', '14', '\"14\"', '1501720816');
INSERT INTO `vich_sys_log` VALUES ('491', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1501721018');
INSERT INTO `vich_sys_log` VALUES ('492', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1501721024');
INSERT INTO `vich_sys_log` VALUES ('493', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501721037');
INSERT INTO `vich_sys_log` VALUES ('494', 'test', 'LOGOUT', 'User', '27', '', '1501721383');
INSERT INTO `vich_sys_log` VALUES ('495', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501721403');
INSERT INTO `vich_sys_log` VALUES ('496', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,17,18,20,22,23,24,25,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,151,152,153,167,168,169,170,172,173,174,175\"}', '1501721433');
INSERT INTO `vich_sys_log` VALUES ('497', 'admin', 'LOGOUT', 'User', '1', '', '1501721435');
INSERT INTO `vich_sys_log` VALUES ('498', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501721445');
INSERT INTO `vich_sys_log` VALUES ('499', 'test', 'ADD', 'Employee', '18', '{\"companyId\":\"37\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\",\"employeeAddress\":\"123456\",\"employeePhone\":\"13564111240\",\"employeeEmail\":\"907914683@qq.com\",\"employeeQQ\":\"xxx\",\"employeeJob\":\"xx\"}', '1501721484');
INSERT INTO `vich_sys_log` VALUES ('500', 'test', 'LOGOUT', 'User', '27', '', '1501721644');
INSERT INTO `vich_sys_log` VALUES ('501', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501721653');
INSERT INTO `vich_sys_log` VALUES ('502', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,17,18,20,22,23,24,25\"}', '1501721692');
INSERT INTO `vich_sys_log` VALUES ('503', 'admin', 'MODIFY', 'User', '27', '{\"real_name\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\",\"mobile\":\"13564111888\",\"email\":\"test@qq.com\",\"user_desc\":\"\\u6d4b\\u8bd5\\u8d26\\u53f7\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"15\",\"selectAll\":\"0\",\"user_group\":\"1\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"ip\":\"192.168.0.100\"}', '1501721707');
INSERT INTO `vich_sys_log` VALUES ('504', 'admin', 'LOGOUT', 'User', '1', '', '1501721709');
INSERT INTO `vich_sys_log` VALUES ('505', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501721722');
INSERT INTO `vich_sys_log` VALUES ('506', 'admin', 'LOGOUT', 'User', '1', '', '1501722013');
INSERT INTO `vich_sys_log` VALUES ('507', 'test', 'LOGOUT', 'User', '27', '', '1501721870');
INSERT INTO `vich_sys_log` VALUES ('508', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501721881');
INSERT INTO `vich_sys_log` VALUES ('509', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501721943');
INSERT INTO `vich_sys_log` VALUES ('510', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,17,18,20,22,23,24,25,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,151,152,153,167,168,169,170,172,173,174,175\"}', '1501721966');
INSERT INTO `vich_sys_log` VALUES ('511', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,17,18,20,22,23,24,25\"}', '1501722051');
INSERT INTO `vich_sys_log` VALUES ('512', 'test', 'MODIFY', 'Company', '32', '{\"companyId\":\"32\",\"companyName\":\"\\u65e0\\u9521\\u5218\\u6f6d\\u670d\\u88c5\\u6709\\u9650\\u516c\\u53f8\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"05108899778\",\"companyUserName\":\"\\u6d4b\\u8bd5\",\"companyUserPhone\":\"13033312369\",\"companyUserEmail\":\"13033312369@qq.com\",\"companyUserQQ\":\"13033312369\"}', '1501722131');
INSERT INTO `vich_sys_log` VALUES ('513', 'test', 'MODIFY', 'Department', '11', '{\"departmentId\":\"11\",\"departmentName\":\"\\u91c7\\u8d2d\\u90e8\",\"remark\":\"\\u91c7\\u8d2d\\u90e8\"}', '1501722183');
INSERT INTO `vich_sys_log` VALUES ('514', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,17,18,20,22,23,24,25,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,151,152,153,167,168,169,170,172,173,174,175\"}', '1501722377');
INSERT INTO `vich_sys_log` VALUES ('515', 'test', 'ADD', 'Employee', '19', '{\"companyId\":\"37\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\",\"employeeAddress\":\"xxxxx\",\"employeePhone\":\"13564111240\",\"employeeEmail\":\"907914683@qq.com\",\"employeeQQ\":\"907914683\",\"employeeJob\":\"\\u6d4b\\u8bd5\"}', '1501722756');
INSERT INTO `vich_sys_log` VALUES ('516', 'test', 'MODIFY', 'Employee', '18', '{\"employeeId\":\"18\",\"companyId\":\"37\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\",\"employeeAddress\":\"123456\",\"employeePhone\":\"13564111240\",\"employeeEmail\":\"907914683@qq.com\",\"employeeQQ\":\"xxx\",\"employeeJob\":\"xx\"}', '1501722873');
INSERT INTO `vich_sys_log` VALUES ('517', 'test', 'DELETE', 'Employee', '19', '\"19\"', '1501722895');
INSERT INTO `vich_sys_log` VALUES ('518', 'test', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"10\",\"parentId\":\"0\",\"cateName\":\"\\u4e00\\u7ea7\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501722988');
INSERT INTO `vich_sys_log` VALUES ('519', 'test', 'ADD', 'GoodsCats', '14', '{\"parentId\":\"0\",\"cateName\":\"\\u6d4b\\u8bd5\\u4e8c\\u7ea7\",\"cateSort\":\"1\"}', '1501723066');
INSERT INTO `vich_sys_log` VALUES ('520', 'test', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"14\",\"parentId\":\"13\",\"cateName\":\"\\u6d4b\\u8bd5\\u4e8c\\u7ea7\",\"cateSort\":\"1\"}', '1501723072');
INSERT INTO `vich_sys_log` VALUES ('521', 'test', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"11\",\"parentId\":\"10\",\"cateName\":\"\\u4e8c\\u7ea7\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501723110');
INSERT INTO `vich_sys_log` VALUES ('522', 'test', 'DELETE', 'GoodsCate', '14', '\"14\"', '1501723152');
INSERT INTO `vich_sys_log` VALUES ('523', 'test', 'LOGOUT', 'User', '27', '', '1501723555');
INSERT INTO `vich_sys_log` VALUES ('524', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501723563');
INSERT INTO `vich_sys_log` VALUES ('525', 'admin', 'LOGOUT', 'User', '1', '', '1501723595');
INSERT INTO `vich_sys_log` VALUES ('526', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501723603');
INSERT INTO `vich_sys_log` VALUES ('527', 'admin', 'DELETE', 'GoodsUnit', '7', '\"7\"', '1501723614');
INSERT INTO `vich_sys_log` VALUES ('528', 'admin', 'MODIFY', 'MenuUrl', '171', '{\"menu_name\":\"\\u4ea7\\u54c1\\u8ba1\\u91cf\\u5355\\u4f4d\\u5220\\u9664\",\"menu_url\":\"\\/sys\\/unit_del.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"151\",\"module_id\":\"4\"}', '1501723691');
INSERT INTO `vich_sys_log` VALUES ('529', 'test', 'LOGOUT', 'User', '27', '', '1501723701');
INSERT INTO `vich_sys_log` VALUES ('530', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,17,18,20,22,23,24,25,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,151,152,153,167,168,169,170,171,172,173,174,175\"}', '1501723719');
INSERT INTO `vich_sys_log` VALUES ('531', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501723729');
INSERT INTO `vich_sys_log` VALUES ('532', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501723974');
INSERT INTO `vich_sys_log` VALUES ('533', 'test', 'ADD', 'GoodsCats', '15', '{\"parentId\":\"0\",\"cateName\":\"xxxx\",\"cateSort\":\"1\"}', '1501724037');
INSERT INTO `vich_sys_log` VALUES ('534', 'test', 'DELETE', 'GoodsCate', '15', '\"15\"', '1501724042');
INSERT INTO `vich_sys_log` VALUES ('535', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"13\",\"parentId\":\"0\",\"cateName\":\"\\u6d4b\\u8bd5\",\"cateSort\":\"1\"}', '1501723960');
INSERT INTO `vich_sys_log` VALUES ('536', 'admin', 'LOGOUT', 'User', '1', '', '1501724259');
INSERT INTO `vich_sys_log` VALUES ('537', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501724267');
INSERT INTO `vich_sys_log` VALUES ('538', 'admin', 'LOGOUT', 'User', '1', '', '1501724269');
INSERT INTO `vich_sys_log` VALUES ('539', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501724431');
INSERT INTO `vich_sys_log` VALUES ('540', 'test', 'ADD', 'DEPARTMENT', '18', '{\"departmentName\":\"xxx\",\"remark\":\"\"}', '1501725056');
INSERT INTO `vich_sys_log` VALUES ('541', 'test', 'DELETE', 'Department', '18', '\"18\"', '1501725062');
INSERT INTO `vich_sys_log` VALUES ('542', 'test', 'LOGOUT', 'User', '27', '', '1501725065');
INSERT INTO `vich_sys_log` VALUES ('543', 'admin', 'DELETE', 'Employee', '12', '\"12\"', '1501727033');
INSERT INTO `vich_sys_log` VALUES ('544', 'admin', 'ADD', 'Module', '11', '{\"module_name\":\"\\u6761\\u7801\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-qrcode\"}', '1501728195');
INSERT INTO `vich_sys_log` VALUES ('545', 'admin', 'ADD', 'Module', '12', '{\"module_name\":\"\\u6d88\\u606f\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-comment\"}', '1501728215');
INSERT INTO `vich_sys_log` VALUES ('546', 'admin', 'MODIFY', 'Module', '12', '{\"module_name\":\"\\u6d88\\u606f\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-comment\",\"module_url\":\"\\/index.php\",\"module_sort\":\"0\",\"online\":\"1\"}', '1501728455');
INSERT INTO `vich_sys_log` VALUES ('547', 'admin', 'ADD', 'MenuUrl', '176', '{\"menu_name\":\"\\u5e93\\u5b58\\u9884\\u8b66\",\"menu_url\":\"\\/message\\/storage.php\",\"module_id\":\"12\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1501728542');
INSERT INTO `vich_sys_log` VALUES ('548', 'admin', 'ADD', 'MenuUrl', '177', '{\"menu_name\":\"\\u4ef7\\u683c\\u9884\\u8b66\",\"menu_url\":\"\\/message\\/price.php\",\"module_id\":\"12\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1501728607');
INSERT INTO `vich_sys_log` VALUES ('549', 'admin', 'ADD', 'MenuUrl', '178', '{\"menu_name\":\"\\u5f85\\u529e\\u4e8b\\u52a1\",\"menu_url\":\"\\/message\\/other.php\",\"module_id\":\"12\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1501728639');
INSERT INTO `vich_sys_log` VALUES ('550', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178\"}', '1501728647');
INSERT INTO `vich_sys_log` VALUES ('551', 'admin', 'ADD', 'MenuUrl', '179', '{\"menu_name\":\"\\u6761\\u7801\\u6253\\u5370\",\"menu_url\":\"\\/code\\/print.php\",\"module_id\":\"11\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1501728708');
INSERT INTO `vich_sys_log` VALUES ('552', 'admin', 'ADD', 'MenuUrl', '180', '{\"menu_name\":\"\\u6807\\u7b7e\\u8bbe\\u8ba1\\u4e0e\\u6253\\u5370\",\"menu_url\":\"\\/code\\/design.php\",\"module_id\":\"11\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1501728815');
INSERT INTO `vich_sys_log` VALUES ('553', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180\"}', '1501728819');
INSERT INTO `vich_sys_log` VALUES ('554', 'admin', 'MODIFY', 'Module', '11', '{\"module_name\":\"\\u6761\\u7801\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-qrcode\",\"module_url\":\"\\/index.php\",\"module_sort\":\"10\",\"online\":\"1\"}', '1501728832');
INSERT INTO `vich_sys_log` VALUES ('555', 'test', 'ADD', 'Supplier', '11', '{\"supplierName\":\"\\u6d4b\\u8bd5\",\"supplierAddress\":\"\\u6d4b\\u8bd5\",\"supplierTel\":\"010-9999999\",\"supplierUserName\":\"\\u6d4b\\u8bd5\",\"supplierUserPhone\":\"13564111240\",\"supplierUserEmail\":\"test@example.com\",\"supplierUserQQ\":\"13564111240\",\"bankName\":\"\\u6d4b\\u8bd5\",\"bankOpenName\":\"\\u6d4b\\u8bd5\",\"cardUserName\":\"\\u6d4b\\u8bd5\",\"cardUserPhone\":\"13564111240\",\"bankAccount\":\"6214832136673428\",\"cardMoney\":\"0\",\"reviewer\":\"27\",\"remark\":\"\"}', '1501731054');
INSERT INTO `vich_sys_log` VALUES ('556', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501733983');
INSERT INTO `vich_sys_log` VALUES ('557', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1501734526');
INSERT INTO `vich_sys_log` VALUES ('558', 'test', 'LOGOUT', 'User', '27', '', '1501734492');
INSERT INTO `vich_sys_log` VALUES ('559', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501734499');
INSERT INTO `vich_sys_log` VALUES ('560', 'admin', 'MODIFY', 'MenuUrl', '145', '{\"menu_name\":\"\\u5168\\u5c40\\u7edf\\u8ba1\\u62a5\\u8868\",\"menu_url\":\"\\/charts\\/global.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1501735728');
INSERT INTO `vich_sys_log` VALUES ('561', 'admin', 'MODIFY', 'Module', '11', '{\"module_name\":\"\\u6761\\u7801\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-barcode\",\"module_url\":\"\\/index.php\",\"module_sort\":\"10\",\"online\":\"1\"}', '1501736042');
INSERT INTO `vich_sys_log` VALUES ('562', 'admin', 'MODIFY', 'Module', '8', '{\"module_name\":\"\\u8d22\\u52a1\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_icon\":\"icon-folder-close\",\"module_url\":\"\\/index.php\",\"module_sort\":\"6\",\"online\":\"1\"}', '1501736099');
INSERT INTO `vich_sys_log` VALUES ('563', 'admin', 'MODIFY', 'Company', '32', '{\"companyId\":\"32\",\"companyName\":\"\\u65e0\\u9521\\u5218\\u6f6d\\u670d\\u88c5\\u6709\\u9650\\u516c\\u53f8\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"05108899778\",\"companyUserName\":\"\\u6d4b\\u8bd5\",\"companyUserPhone\":\"13033312369\",\"companyUserEmail\":\"13033312369@qq.com\",\"companyUserQQ\":\"13033312369\"}', '1501736376');
INSERT INTO `vich_sys_log` VALUES ('564', 'admin', 'LOGOUT', 'User', '1', '', '1501736460');
INSERT INTO `vich_sys_log` VALUES ('565', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501736469');
INSERT INTO `vich_sys_log` VALUES ('566', 'test', 'LOGOUT', 'User', '27', '', '1501736696');
INSERT INTO `vich_sys_log` VALUES ('567', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501736707');
INSERT INTO `vich_sys_log` VALUES ('568', 'admin', 'LOGOUT', 'User', '1', '', '1501737451');
INSERT INTO `vich_sys_log` VALUES ('569', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501737458');
INSERT INTO `vich_sys_log` VALUES ('570', 'admin', 'LOGOUT', 'User', '1', '', '1501737803');
INSERT INTO `vich_sys_log` VALUES ('571', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501737811');
INSERT INTO `vich_sys_log` VALUES ('572', 'admin', 'DELETE', 'GoodsUnit', '2,3,4,8,10', '\"2,3,4,8,10\"', '1501737972');
INSERT INTO `vich_sys_log` VALUES ('573', 'admin', 'ADD', 'GoodsUnit', '11', '{\"unitName\":\"\\u4ef6\"}', '1501737978');
INSERT INTO `vich_sys_log` VALUES ('574', 'admin', 'ADD', 'GoodsUnit', '12', '{\"unitName\":\"\\u4e2a\"}', '1501737984');
INSERT INTO `vich_sys_log` VALUES ('575', 'test', 'ADD', 'Goods', '', '{\"goodsSn\":\"\",\"goodsBarCode\":\"1111\",\"goodsName\":\"\\u6d4b\\u8bd5\",\"goodsSpec\":\"11\",\"goodsCateId\":\"10\",\"goodsUnitId\":\"11\",\"productionDate\":\"2017-08-17\",\"invalidDate\":\"2017-08-25\",\"searchKey\":\"11\",\"remark\":\"\"}', '1501739835');
INSERT INTO `vich_sys_log` VALUES ('576', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"\",\"goodsBarCode\":\"1111\",\"goodsName\":\"test\",\"goodsSpec\":\"111\",\"goodsCateId\":\"12\",\"goodsUnitId\":\"12\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-08-03\",\"invalidDate\":\"2017-08-10\",\"searchKey\":\"11\",\"remark\":\"111\"}', '1501741148');
INSERT INTO `vich_sys_log` VALUES ('577', 'test', 'LOGOUT', 'User', '27', '', '1501741995');
INSERT INTO `vich_sys_log` VALUES ('578', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501742009');
INSERT INTO `vich_sys_log` VALUES ('579', 'admin', 'LOGOUT', 'User', '1', '', '1501743275');
INSERT INTO `vich_sys_log` VALUES ('580', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1501743282');
INSERT INTO `vich_sys_log` VALUES ('581', 'test', 'DELETE', 'Suppliers', '11', '\"11\"', '1501743978');
INSERT INTO `vich_sys_log` VALUES ('582', 'test', 'LOGOUT', 'User', '27', '', '1501748861');
INSERT INTO `vich_sys_log` VALUES ('583', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501748870');
INSERT INTO `vich_sys_log` VALUES ('584', 'admin', 'ADD', 'MenuUrl', '181', '{\"menu_name\":\"\\u6253\\u5370\\u9884\\u89c8\",\"menu_url\":\"\\/code\\/preview.php\",\"module_id\":\"11\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"179\"}', '1501753309');
INSERT INTO `vich_sys_log` VALUES ('585', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181\"}', '1501753325');
INSERT INTO `vich_sys_log` VALUES ('586', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501806870');
INSERT INTO `vich_sys_log` VALUES ('587', 'admin', 'ADD', 'MenuUrl', '182', '{\"menu_name\":\"\\u4ef7\\u683c\\u67e5\\u8be2\\u8be6\\u60c5\",\"menu_url\":\"\\/purchase\\/price_view.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"132\"}', '1501807192');
INSERT INTO `vich_sys_log` VALUES ('588', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182\"}', '1501807197');
INSERT INTO `vich_sys_log` VALUES ('589', 'admin', 'ADD', 'MenuUrl', '183', '{\"menu_name\":\"\\u4ef7\\u683c\\u67e5\\u8be2\\u8be6\\u60c5\",\"menu_url\":\"\\/purchase\\/price_list.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"132\"}', '1501810525');
INSERT INTO `vich_sys_log` VALUES ('590', 'admin', 'MODIFY', 'MenuUrl', '182', '{\"menu_name\":\"\\u4ef7\\u683c\\u67e5\\u8be2\\u8d8b\\u52bf\",\"menu_url\":\"\\/purchase\\/price_view.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"132\",\"module_id\":\"10\"}', '1501810538');
INSERT INTO `vich_sys_log` VALUES ('591', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183\"}', '1501810543');
INSERT INTO `vich_sys_log` VALUES ('592', 'admin', 'MODIFY', 'MenuUrl', '182', '{\"menu_name\":\"\\u4ef7\\u683c\\u7ba1\\u7406\\u8d8b\\u52bf\\u56fe\",\"menu_url\":\"\\/purchase\\/price_view.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"132\",\"module_id\":\"10\"}', '1501810569');
INSERT INTO `vich_sys_log` VALUES ('593', 'admin', 'MODIFY', 'MenuUrl', '183', '{\"menu_name\":\"\\u4ef7\\u683c\\u7ba1\\u7406\\u8be6\\u60c5\\u5217\\u8868\",\"menu_url\":\"\\/purchase\\/price_list.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"132\",\"module_id\":\"10\"}', '1501810580');
INSERT INTO `vich_sys_log` VALUES ('594', 'admin', 'ADD', 'MenuUrl', '184', '{\"menu_name\":\"\\u65b0\\u589e\\u8fdb\\u8d27\\u5355\",\"menu_url\":\"\\/purchase\\/receive_order_add.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\"}', '1501812574');
INSERT INTO `vich_sys_log` VALUES ('595', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184\"}', '1501812590');
INSERT INTO `vich_sys_log` VALUES ('596', 'admin', 'DELETE', 'MenuUrl', '136', '{\"menu_id\":\"136\",\"menu_name\":\"\\u6682\\u4f30\\u5165\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/reckon_order.php\",\"module_id\":\"5\",\"is_show\":\"1\",\"online\":\"1\",\"shortcut_allowed\":\"1\",\"menu_desc\":\"\",\"father_menu\":\"0\"}', '1501813847');
INSERT INTO `vich_sys_log` VALUES ('597', 'admin', 'MODIFY', 'MenuUrl', '138', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/allot_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1501814228');
INSERT INTO `vich_sys_log` VALUES ('598', 'admin', 'MODIFY', 'MenuUrl', '165', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\\u65b0\\u589e\",\"menu_url\":\"\\/storage\\/allot_order_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\",\"module_id\":\"5\"}', '1501814268');
INSERT INTO `vich_sys_log` VALUES ('599', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501764573');
INSERT INTO `vich_sys_log` VALUES ('600', 'admin', 'ADD', 'MenuUrl', '185', '{\"menu_name\":\"\\u5e93\\u4f4d\\u4ea7\\u54c1\\u5217\\u8868\",\"menu_url\":\"\\/sys\\/depotSub_goods.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"123\"}', '1501819154');
INSERT INTO `vich_sys_log` VALUES ('601', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185\"}', '1501819159');
INSERT INTO `vich_sys_log` VALUES ('602', 'admin', 'LOGOUT', 'User', '1', '', '1501769259');
INSERT INTO `vich_sys_log` VALUES ('603', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501769267');
INSERT INTO `vich_sys_log` VALUES ('604', 'admin', 'ADD', 'MenuUrl', '186', '{\"menu_name\":\"\\u65b0\\u589e\\u5e93\\u4f4d\",\"menu_url\":\"\\/sys\\/depotSub_add.php\",\"module_id\":\"12\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"123\"}', '1501769373');
INSERT INTO `vich_sys_log` VALUES ('605', 'admin', 'MODIFY', 'MenuUrl', '186', '{\"menu_name\":\"\\u65b0\\u589e\\u5e93\\u4f4d\",\"menu_url\":\"\\/sys\\/depotSub_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"123\",\"module_id\":\"4\"}', '1501769397');
INSERT INTO `vich_sys_log` VALUES ('606', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186\"}', '1501769408');
INSERT INTO `vich_sys_log` VALUES ('607', 'admin', 'MODIFY', 'MenuUrl', '179', '{\"menu_name\":\"\\u4ea7\\u54c1\\u4e8c\\u7ef4\\u7801\\u6253\\u5370\",\"menu_url\":\"\\/code\\/goods_qrcode.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"11\"}', '1501822253');
INSERT INTO `vich_sys_log` VALUES ('608', 'admin', 'MODIFY', 'MenuUrl', '180', '{\"menu_name\":\"\\u5e93\\u4f4d\\u4e8c\\u7ef4\\u7801\\u6253\\u5370\",\"menu_url\":\"\\/code\\/depotSub_qrcode.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"11\"}', '1501822298');
INSERT INTO `vich_sys_log` VALUES ('609', 'admin', 'ADD', 'MenuUrl', '187', '{\"menu_name\":\"\\u4ea7\\u54c1\\u4e8c\\u7ef4\\u7801\\u8bbe\\u8ba1\",\"menu_url\":\"\\/code\\/design.php\",\"module_id\":\"11\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"179\"}', '1501829130');
INSERT INTO `vich_sys_log` VALUES ('610', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187\"}', '1501829134');
INSERT INTO `vich_sys_log` VALUES ('611', 'admin', 'ADD', 'MenuUrl', '188', '{\"menu_name\":\"\\u5e93\\u4f4d\\u6253\\u5370\\u9884\\u89c8\",\"menu_url\":\"\\/code\\/depotSub_preview.php\",\"module_id\":\"11\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"180\"}', '1501829972');
INSERT INTO `vich_sys_log` VALUES ('612', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188\"}', '1501829978');
INSERT INTO `vich_sys_log` VALUES ('613', 'admin', 'MODIFY', 'MenuUrl', '181', '{\"menu_name\":\"\\u4ea7\\u54c1\\u6253\\u5370\\u9884\\u89c8\",\"menu_url\":\"\\/code\\/preview.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"179\",\"module_id\":\"11\"}', '1501829991');
INSERT INTO `vich_sys_log` VALUES ('614', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188\"}', '1501783373');
INSERT INTO `vich_sys_log` VALUES ('615', 'admin', 'DELETE', 'Goods', '11,12,13,14,15,16,17', '\"11,12,13,14,15,16,17\"', '1501784037');
INSERT INTO `vich_sys_log` VALUES ('616', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501834242');
INSERT INTO `vich_sys_log` VALUES ('617', 'admin', 'LOGOUT', 'User', '1', '', '1501790124');
INSERT INTO `vich_sys_log` VALUES ('618', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501790133');
INSERT INTO `vich_sys_log` VALUES ('619', 'admin', 'MODIFY', 'MenuUrl', '179', '{\"menu_name\":\"\\u4ea7\\u54c1\\u6761\\u7801\\u6253\\u5370\",\"menu_url\":\"\\/code\\/goods_qrcode.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"11\"}', '1501791261');
INSERT INTO `vich_sys_log` VALUES ('620', 'admin', 'MODIFY', 'MenuUrl', '180', '{\"menu_name\":\"\\u5e93\\u4f4d\\u6761\\u7801\\u6253\\u5370\",\"menu_url\":\"\\/code\\/depotSub_qrcode.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"11\"}', '1501791274');
INSERT INTO `vich_sys_log` VALUES ('621', 'admin', 'MODIFY', 'Company', '37', '{\"companyId\":\"37\",\"companyName\":\"\\u65e0\\u9521\\u5218\\u6f6d\\u670d\\u88c5\\u6709\\u9650\\u516c\\u53f8(\\u4eb3\\u5dde)\",\"companyAddress\":\"xxxxx\",\"companyTel\":\"010-6666666\",\"companyUserName\":\"\\u738b\\u4e8c\",\"companyUserPhone\":\"13666666666\",\"companyUserEmail\":\"test@example.com\",\"companyUserQQ\":\"136666666666\"}', '1501791368');
INSERT INTO `vich_sys_log` VALUES ('622', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501793250');
INSERT INTO `vich_sys_log` VALUES ('623', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501797809');
INSERT INTO `vich_sys_log` VALUES ('624', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501810241');
INSERT INTO `vich_sys_log` VALUES ('625', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1501981097');
INSERT INTO `vich_sys_log` VALUES ('626', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502067395');
INSERT INTO `vich_sys_log` VALUES ('627', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1501982992');
INSERT INTO `vich_sys_log` VALUES ('628', 'admin', 'ADD', 'MenuUrl', '189', '{\"menu_name\":\"\\u65b0\\u589e\\u5ba2\\u6237\",\"menu_url\":\"\\/sys\\/customer_add.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"174\"}', '1502089801');
INSERT INTO `vich_sys_log` VALUES ('629', 'admin', 'ADD', 'MenuUrl', '190', '{\"menu_name\":\"\\u7f16\\u8f91\\u5ba2\\u6237\",\"menu_url\":\"\\/sys\\/customer_modify.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"174\"}', '1502089835');
INSERT INTO `vich_sys_log` VALUES ('630', 'admin', 'ADD', 'MenuUrl', '191', '{\"menu_name\":\"\\u5220\\u9664\\u5ba2\\u6237\",\"menu_url\":\"\\/sys\\/customer_del.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"174\"}', '1502089860');
INSERT INTO `vich_sys_log` VALUES ('631', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191\"}', '1502089866');
INSERT INTO `vich_sys_log` VALUES ('632', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1502007829');
INSERT INTO `vich_sys_log` VALUES ('633', 'admin', 'ADD', 'Customer', '', '{\"customerName\":\"\\u4e2d\\u6587\",\"customerAddress\":\"1\",\"customerUserName\":\"\\u4e2d\\u6587\",\"customerUserPhone\":\"13912382811\",\"customerUserEmail\":\"111@qq.com\"}', '1502008588');
INSERT INTO `vich_sys_log` VALUES ('634', 'admin', 'ADD', 'Customer', '', '{\"customerName\":\"\\u4e2d\\u6587\",\"customerAddress\":\"\\u4e2d\\u6587\",\"customerUserName\":\"\\u4e2d\\u6587\",\"customerUserPhone\":\"13912382811\",\"customerUserEmail\":\"11@qq.com\"}', '1502008850');
INSERT INTO `vich_sys_log` VALUES ('635', 'admin', 'MODIFY', 'Customer', '', '{\"customerId\":\"1\",\"customerName\":\"\\u4e2d\\u6587\",\"customerAddress\":\"\\u6d4b\",\"customerUserName\":\"\\u4e2d\\u6587\",\"customerUserPhone\":\"13912382811\",\"customerUserEmail\":\"111@qq.com\"}', '1502010058');
INSERT INTO `vich_sys_log` VALUES ('636', 'admin', 'DELETE', 'Customer', '1', '\"1\"', '1502010901');
INSERT INTO `vich_sys_log` VALUES ('637', 'admin', 'MODIFY', 'Customer', '2', '{\"customerId\":\"2\",\"customerName\":\"\\u6d4b\\u8bd5\",\"customerAddress\":\"\\u4e2d\\u6587\",\"customerUserName\":\"\\u4e2d\\u6587\",\"customerUserPhone\":\"13912382811\",\"customerUserEmail\":\"11@qq.com\"}', '1502010995');
INSERT INTO `vich_sys_log` VALUES ('638', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502013918');
INSERT INTO `vich_sys_log` VALUES ('639', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1502015669');
INSERT INTO `vich_sys_log` VALUES ('640', 'admin', 'ADD', 'Depot', '8', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"15\",\"depotName\":\"11111\",\"isDefault\":\"0\"}', '1502016055');
INSERT INTO `vich_sys_log` VALUES ('641', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502100132');
INSERT INTO `vich_sys_log` VALUES ('642', 'admin', 'LOGOUT', 'User', '1', '', '1502100234');
INSERT INTO `vich_sys_log` VALUES ('643', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502152405');
INSERT INTO `vich_sys_log` VALUES ('644', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"10000000\",\"goodsBarCode\":\"1502173999\",\"goodsName\":\"\\u6d4b\\u8bd5\",\"goodsSpec\":\"xxx\",\"goodsCateId\":\"10\",\"goodsUnitId\":\"11\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-08-03\",\"invalidDate\":\"2017-08-25\",\"searchKey\":\"x\",\"remark\":\"\"}', '1502174960');
INSERT INTO `vich_sys_log` VALUES ('645', 'admin', 'LOGOUT', 'User', '1', '', '1502175037');
INSERT INTO `vich_sys_log` VALUES ('646', 'test', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1502175051');
INSERT INTO `vich_sys_log` VALUES ('647', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1502175058');
INSERT INTO `vich_sys_log` VALUES ('648', 'test', 'LOGOUT', 'User', '27', '', '1502175077');
INSERT INTO `vich_sys_log` VALUES ('649', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502175083');
INSERT INTO `vich_sys_log` VALUES ('650', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"10000001\",\"goodsBarCode\":\"1502174000\",\"goodsName\":\"sss\",\"goodsSpec\":\"2\",\"goodsCateId\":\"10\",\"goodsUnitId\":\"11\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-08-08\",\"invalidDate\":\"2017-08-17\",\"searchKey\":\"s\",\"remark\":\"\"}', '1502175218');
INSERT INTO `vich_sys_log` VALUES ('651', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502046152');
INSERT INTO `vich_sys_log` VALUES ('652', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502239884');
INSERT INTO `vich_sys_log` VALUES ('653', 'admin', 'LOGOUT', 'User', '1', '', '1502244405');
INSERT INTO `vich_sys_log` VALUES ('654', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502246765');
INSERT INTO `vich_sys_log` VALUES ('655', 'admin', 'LOGOUT', 'User', '1', '', '1502263590');
INSERT INTO `vich_sys_log` VALUES ('656', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502263598');
INSERT INTO `vich_sys_log` VALUES ('657', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502269601');
INSERT INTO `vich_sys_log` VALUES ('658', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502326326');
INSERT INTO `vich_sys_log` VALUES ('659', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502412393');
INSERT INTO `vich_sys_log` VALUES ('660', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502596001');
INSERT INTO `vich_sys_log` VALUES ('661', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502612946');
INSERT INTO `vich_sys_log` VALUES ('662', 'admin', 'MODIFY', 'MenuUrl', '126', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\",\"menu_url\":\"\\/purchase\\/plan_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"10\"}', '1502613874');
INSERT INTO `vich_sys_log` VALUES ('663', 'admin', 'MODIFY', 'MenuUrl', '127', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u5f55\\u5165\",\"menu_url\":\"\\/purchase\\/plan_order_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\",\"module_id\":\"10\"}', '1502613889');
INSERT INTO `vich_sys_log` VALUES ('664', 'admin', 'MODIFY', 'MenuUrl', '128', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/purchase\\/plan_order_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\",\"module_id\":\"10\"}', '1502613902');
INSERT INTO `vich_sys_log` VALUES ('665', 'admin', 'MODIFY', 'MenuUrl', '129', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8fdb\\u8d27\\u5355\",\"menu_url\":\"\\/purchase\\/arrival_order.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"10\"}', '1502614087');
INSERT INTO `vich_sys_log` VALUES ('666', 'admin', 'MODIFY', 'MenuUrl', '184', '{\"menu_name\":\"\\u65b0\\u589e\\u8fdb\\u8d27\\u5355\",\"menu_url\":\"\\/purchase\\/arrival_order_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\",\"module_id\":\"10\"}', '1502614127');
INSERT INTO `vich_sys_log` VALUES ('667', 'admin', 'MODIFY', 'MenuUrl', '161', '{\"menu_name\":\"\\u767b\\u8bb0\\u9000\\u8d27\\u4ea7\\u54c1\",\"menu_url\":\"\\/purchase\\/return_order_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\",\"module_id\":\"10\"}', '1502614190');
INSERT INTO `vich_sys_log` VALUES ('668', 'admin', 'ADD', 'MenuUrl', '192', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/allot_deliver.php\",\"module_id\":\"5\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1502614391');
INSERT INTO `vich_sys_log` VALUES ('669', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192\"}', '1502614397');
INSERT INTO `vich_sys_log` VALUES ('670', 'admin', 'MODIFY', 'MenuUrl', '135', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/purchase_storage.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1502614535');
INSERT INTO `vich_sys_log` VALUES ('671', 'admin', 'MODIFY', 'MenuUrl', '137', '{\"menu_name\":\"\\u5176\\u4ed6\\u5165\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/other_storage.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1502614567');
INSERT INTO `vich_sys_log` VALUES ('672', 'admin', 'MODIFY', 'MenuUrl', '138', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/allot_storage.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1502614583');
INSERT INTO `vich_sys_log` VALUES ('673', 'admin', 'MODIFY', 'MenuUrl', '139', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/using_deliver.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1502614620');
INSERT INTO `vich_sys_log` VALUES ('674', 'admin', 'MODIFY', 'MenuUrl', '140', '{\"menu_name\":\"\\u5176\\u4ed6\\u51fa\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/other_deliver.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"5\"}', '1502614635');
INSERT INTO `vich_sys_log` VALUES ('675', 'admin', 'MODIFY', 'MenuUrl', '162', '{\"menu_name\":\"\\u767b\\u8bb0\\u5165\\u5e93\\u5546\\u54c1\",\"menu_url\":\"\\/storage\\/purchase_storage_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\",\"module_id\":\"5\"}', '1502614674');
INSERT INTO `vich_sys_log` VALUES ('676', 'admin', 'MODIFY', 'MenuUrl', '164', '{\"menu_name\":\"\\u767b\\u8bb0\\u51fa\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/using_deliver_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\",\"module_id\":\"5\"}', '1502614707');
INSERT INTO `vich_sys_log` VALUES ('677', 'admin', 'MODIFY', 'MenuUrl', '165', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\\u65b0\\u589e\",\"menu_url\":\"\\/storage\\/allot_storage_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\",\"module_id\":\"5\"}', '1502614728');
INSERT INTO `vich_sys_log` VALUES ('678', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502529407');
INSERT INTO `vich_sys_log` VALUES ('679', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502671699');
INSERT INTO `vich_sys_log` VALUES ('680', 'admin', 'LOGOUT', 'User', '1', '', '1502681384');
INSERT INTO `vich_sys_log` VALUES ('681', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1502681395');
INSERT INTO `vich_sys_log` VALUES ('682', 'test', 'LOGOUT', 'User', '27', '', '1502681418');
INSERT INTO `vich_sys_log` VALUES ('683', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502681425');
INSERT INTO `vich_sys_log` VALUES ('684', 'admin', 'LOGOUT', 'User', '1', '', '1502682633');
INSERT INTO `vich_sys_log` VALUES ('685', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502682652');
INSERT INTO `vich_sys_log` VALUES ('686', 'admin', 'LOGOUT', 'User', '1', '', '1502697714');
INSERT INTO `vich_sys_log` VALUES ('687', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502697562');
INSERT INTO `vich_sys_log` VALUES ('688', 'admin', 'LOGOUT', 'User', '1', '', '1502700334');
INSERT INTO `vich_sys_log` VALUES ('689', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1502700350');
INSERT INTO `vich_sys_log` VALUES ('690', 'test', 'LOGOUT', 'User', '27', '', '1502701354');
INSERT INTO `vich_sys_log` VALUES ('691', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502701360');
INSERT INTO `vich_sys_log` VALUES ('692', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502757670');
INSERT INTO `vich_sys_log` VALUES ('693', 'admin', 'ADD', 'MenuUrl', '193', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/purchase\\/plan_order_review.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\"}', '1502759254');
INSERT INTO `vich_sys_log` VALUES ('694', 'admin', 'ADD', 'MenuUrl', '194', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8fdb\\u8d27\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/purchase\\/arrival_order_review.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\"}', '1502759292');
INSERT INTO `vich_sys_log` VALUES ('695', 'admin', 'ADD', 'MenuUrl', '195', '{\"menu_name\":\"\\u91c7\\u8d2d\\u9000\\u8d27\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/purchase\\/return_order_review.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\"}', '1502759324');
INSERT INTO `vich_sys_log` VALUES ('696', 'admin', 'ADD', 'MenuUrl', '196', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/purchase_storage\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\"}', '1502759350');
INSERT INTO `vich_sys_log` VALUES ('697', 'admin', 'MODIFY', 'MenuUrl', '196', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/purchase_storage_review.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\",\"module_id\":\"5\"}', '1502759372');
INSERT INTO `vich_sys_log` VALUES ('698', 'admin', 'ADD', 'MenuUrl', '197', '{\"menu_name\":\"\\u5176\\u4ed6\\u5165\\u5e93\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/other_storage_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"137\"}', '1502759394');
INSERT INTO `vich_sys_log` VALUES ('699', 'admin', 'ADD', 'MenuUrl', '198', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/allot_storage_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\"}', '1502759627');
INSERT INTO `vich_sys_log` VALUES ('700', 'admin', 'ADD', 'MenuUrl', '199', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/using_deliver_reivew.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\"}', '1502759676');
INSERT INTO `vich_sys_log` VALUES ('701', 'admin', 'ADD', 'MenuUrl', '200', '{\"menu_name\":\"\\u5176\\u4ed6\\u51fa\\u5e93\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/other_deliver_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"140\"}', '1502759725');
INSERT INTO `vich_sys_log` VALUES ('702', 'admin', 'ADD', 'MenuUrl', '201', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\",\"menu_url\":\"\\/storage\\/allot_deliver_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"192\"}', '1502759759');
INSERT INTO `vich_sys_log` VALUES ('703', 'admin', 'ADD', 'MenuUrl', '202', '{\"menu_name\":\"\\u5e93\\u5b58\\u76d8\\u70b9\\u5355\",\"menu_url\":\"\\/storage\\/count_order_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"141\"}', '1502759788');
INSERT INTO `vich_sys_log` VALUES ('704', 'admin', 'MODIFY', 'MenuUrl', '201', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/allot_deliver_review.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"192\",\"module_id\":\"5\"}', '1502759822');
INSERT INTO `vich_sys_log` VALUES ('705', 'admin', 'MODIFY', 'MenuUrl', '202', '{\"menu_name\":\"\\u5e93\\u5b58\\u76d8\\u70b9\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/count_order_review.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"141\",\"module_id\":\"5\"}', '1502759831');
INSERT INTO `vich_sys_log` VALUES ('706', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,197,198,199,200,201,202\"}', '1502759852');
INSERT INTO `vich_sys_log` VALUES ('707', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202\"}', '1502759855');
INSERT INTO `vich_sys_log` VALUES ('708', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502762861');
INSERT INTO `vich_sys_log` VALUES ('709', 'admin', 'LOGOUT', 'User', '1', '', '1502765377');
INSERT INTO `vich_sys_log` VALUES ('710', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1502765385');
INSERT INTO `vich_sys_log` VALUES ('711', 'test', 'LOGOUT', 'User', '27', '', '1502765393');
INSERT INTO `vich_sys_log` VALUES ('712', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502765404');
INSERT INTO `vich_sys_log` VALUES ('713', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502780700');
INSERT INTO `vich_sys_log` VALUES ('714', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502844533');
INSERT INTO `vich_sys_log` VALUES ('715', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1502848321');
INSERT INTO `vich_sys_log` VALUES ('716', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502848328');
INSERT INTO `vich_sys_log` VALUES ('717', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502850765');
INSERT INTO `vich_sys_log` VALUES ('718', 'admin', 'LOGOUT', 'User', '1', '', '1502869514');
INSERT INTO `vich_sys_log` VALUES ('719', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502869523');
INSERT INTO `vich_sys_log` VALUES ('720', 'admin', 'LOGOUT', 'User', '1', '', '1502869583');
INSERT INTO `vich_sys_log` VALUES ('721', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502869589');
INSERT INTO `vich_sys_log` VALUES ('722', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502878297');
INSERT INTO `vich_sys_log` VALUES ('723', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1502931068');
INSERT INTO `vich_sys_log` VALUES ('724', 'admin', 'LOGOUT', 'User', '1', '', '1502964902');
INSERT INTO `vich_sys_log` VALUES ('725', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503016823');
INSERT INTO `vich_sys_log` VALUES ('726', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1503103502');
INSERT INTO `vich_sys_log` VALUES ('727', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503103522');
INSERT INTO `vich_sys_log` VALUES ('728', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503276085');
INSERT INTO `vich_sys_log` VALUES ('729', 'admin', 'LOGOUT', 'User', '1', '', '1503296975');
INSERT INTO `vich_sys_log` VALUES ('730', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503296982');
INSERT INTO `vich_sys_log` VALUES ('731', 'admin', 'LOGOUT', 'User', '1', '', '1503365192');
INSERT INTO `vich_sys_log` VALUES ('732', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503365201');
INSERT INTO `vich_sys_log` VALUES ('733', 'admin', 'ADD', 'MenuUrl', '203', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/purchase\\/plan_order_create.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\"}', '1503365879');
INSERT INTO `vich_sys_log` VALUES ('734', 'admin', 'ADD', 'MenuUrl', '204', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/purchase\\/plan_order_details.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\"}', '1503365913');
INSERT INTO `vich_sys_log` VALUES ('735', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204\"}', '1503365925');
INSERT INTO `vich_sys_log` VALUES ('736', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503388418');
INSERT INTO `vich_sys_log` VALUES ('737', 'admin', 'ADD', 'GoodsUnit', '13', '{\"unitName\":\"\\u6d4b\\u8bd5\"}', '1503394879');
INSERT INTO `vich_sys_log` VALUES ('738', 'admin', 'DELETE', 'GoodsUnit', '13', '\"13\"', '1503394885');
INSERT INTO `vich_sys_log` VALUES ('739', 'admin', 'ADD', 'Customer', '3', '{\"customerName\":\"\\u6d4b\\u8bd5\",\"customerAddress\":\"\\u6d4b\\u8bd52\",\"customerUserName\":\"\\u6d4b\\u8bd5\",\"customerUserPhone\":\"13564111240\",\"customerUserEmail\":\"1356411240@1.com\"}', '1503394937');
INSERT INTO `vich_sys_log` VALUES ('740', 'admin', 'DELETE', 'Customer', '3', '\"3\"', '1503394943');
INSERT INTO `vich_sys_log` VALUES ('741', 'admin', 'LOGOUT', 'User', '1', '', '1503449081');
INSERT INTO `vich_sys_log` VALUES ('742', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503449092');
INSERT INTO `vich_sys_log` VALUES ('743', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503462205');
INSERT INTO `vich_sys_log` VALUES ('744', 'admin', 'ADD', 'MenuUrl', '205', '{\"menu_name\":\"\\u8fdb\\u8d27\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/purchase\\/arrival_order_create.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"xxx\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\"}', '1503481028');
INSERT INTO `vich_sys_log` VALUES ('745', 'admin', 'MODIFY', 'MenuUrl', '205', '{\"menu_name\":\"\\u8fdb\\u8d27\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/purchase\\/arrival_order_create.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"xxx\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\",\"module_id\":\"10\"}', '1503481046');
INSERT INTO `vich_sys_log` VALUES ('746', 'admin', 'ADD', 'MenuUrl', '206', '{\"menu_name\":\"\\u8fdb\\u8d27\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/purchase\\/arrival_order_details.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\"}', '1503481076');
INSERT INTO `vich_sys_log` VALUES ('747', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206\"}', '1503481080');
INSERT INTO `vich_sys_log` VALUES ('748', 'admin', 'ADD', 'MenuUrl', '207', '{\"menu_name\":\"\\u8fdb\\u8d27\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/purchase\\/arrival_order_modify.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\"}', '1503481557');
INSERT INTO `vich_sys_log` VALUES ('749', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207\"}', '1503481569');
INSERT INTO `vich_sys_log` VALUES ('750', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503536867');
INSERT INTO `vich_sys_log` VALUES ('751', 'admin', 'MODIFY', 'MenuUrl', '161', '{\"menu_name\":\"\\u91c7\\u8d2d\\u9000\\u8d27\\u5355\\u5f55\\u5165\",\"menu_url\":\"\\/purchase\\/return_order_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\",\"module_id\":\"10\"}', '1503537390');
INSERT INTO `vich_sys_log` VALUES ('752', 'admin', 'MODIFY', 'MenuUrl', '184', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8fdb\\u8d27\\u5355\\u5f55\\u5165\",\"menu_url\":\"\\/purchase\\/arrival_order_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\",\"module_id\":\"10\"}', '1503537508');
INSERT INTO `vich_sys_log` VALUES ('753', 'admin', 'ADD', 'MenuUrl', '208', '{\"menu_name\":\"\\u91c7\\u8d2d\\u9000\\u8d27\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/purchase\\/return_order_create.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\"}', '1503537573');
INSERT INTO `vich_sys_log` VALUES ('754', 'admin', 'ADD', 'MenuUrl', '209', '{\"menu_name\":\"\\u91c7\\u8d2d\\u9000\\u8d27\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/purchase\\/return_order_details.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\"}', '1503537611');
INSERT INTO `vich_sys_log` VALUES ('755', 'admin', 'ADD', 'MenuUrl', '210', '{\"menu_name\":\"\\u91c7\\u8d2d\\u9000\\u8d27\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/purchase\\/return_order_modify.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\"}', '1503537650');
INSERT INTO `vich_sys_log` VALUES ('756', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210\"}', '1503537656');
INSERT INTO `vich_sys_log` VALUES ('757', 'admin', 'ADD', 'MenuUrl', '211', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/storage\\/purchase_storage_create.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"xxxx\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\"}', '1503538465');
INSERT INTO `vich_sys_log` VALUES ('758', 'admin', 'ADD', 'MenuUrl', '212', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/storage\\/purchase_storage_details.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"xx\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\"}', '1503538558');
INSERT INTO `vich_sys_log` VALUES ('759', 'admin', 'ADD', 'MenuUrl', '213', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/storage\\/purchase_storage_modify.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\"}', '1503538592');
INSERT INTO `vich_sys_log` VALUES ('760', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212\"}', '1503538601');
INSERT INTO `vich_sys_log` VALUES ('761', 'admin', 'MODIFY', 'MenuUrl', '213', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/storage\\/purchase_storage_modify.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\",\"module_id\":\"5\"}', '1503538616');
INSERT INTO `vich_sys_log` VALUES ('762', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213\"}', '1503538621');
INSERT INTO `vich_sys_log` VALUES ('763', 'admin', 'ADD', 'MenuUrl', '214', '{\"menu_name\":\"\\u5546\\u54c1\\u67e5\\u8be2\",\"menu_url\":\"\\/storage\\/goods_search.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"0\"}', '1503541112');
INSERT INTO `vich_sys_log` VALUES ('764', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214\"}', '1503541118');
INSERT INTO `vich_sys_log` VALUES ('765', 'admin', 'ADD', 'MenuUrl', '215', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/storage\\/allot_storage_create.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\"}', '1503544602');
INSERT INTO `vich_sys_log` VALUES ('766', 'admin', 'ADD', 'MenuUrl', '216', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/storage\\/allot_storage_details.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\\r\\n\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\"}', '1503544658');
INSERT INTO `vich_sys_log` VALUES ('767', 'admin', 'ADD', 'MenuUrl', '217', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/storage\\/allot_storage_modify.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\"}', '1503544685');
INSERT INTO `vich_sys_log` VALUES ('768', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217\"}', '1503544695');
INSERT INTO `vich_sys_log` VALUES ('769', 'admin', 'ADD', 'MenuUrl', '218', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/storage\\/allot_deliver_create.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"192\"}', '1503555582');
INSERT INTO `vich_sys_log` VALUES ('770', 'admin', 'ADD', 'MenuUrl', '219', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/storage\\/allot_deliver_details.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"192\"}', '1503555609');
INSERT INTO `vich_sys_log` VALUES ('771', 'admin', 'ADD', 'MenuUrl', '220', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/storage\\/allot_deliver_modify.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"192\"}', '1503555636');
INSERT INTO `vich_sys_log` VALUES ('772', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220\"}', '1503555641');
INSERT INTO `vich_sys_log` VALUES ('773', 'admin', 'ADD', 'MenuUrl', '221', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\\u5f55\\u5165\",\"menu_url\":\"\\/storage\\/allot_deliver_add.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"192\"}', '1503555734');
INSERT INTO `vich_sys_log` VALUES ('774', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221\"}', '1503555739');
INSERT INTO `vich_sys_log` VALUES ('775', 'admin', 'ADD', 'MenuUrl', '222', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/storage\\/using_deliver_create.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\"}', '1503560864');
INSERT INTO `vich_sys_log` VALUES ('776', 'admin', 'ADD', 'MenuUrl', '223', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/storage\\/using_deliver_details.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\"}', '1503560897');
INSERT INTO `vich_sys_log` VALUES ('777', 'admin', 'ADD', 'MenuUrl', '224', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/storage\\/using_deliver_modify.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\"}', '1503560936');
INSERT INTO `vich_sys_log` VALUES ('778', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224\"}', '1503560946');
INSERT INTO `vich_sys_log` VALUES ('779', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"192.168.0.100\"}', '1503561191');
INSERT INTO `vich_sys_log` VALUES ('780', 'admin', 'MODIFY', 'User', '1', '{\"real_name\":\"SomewhereYu\",\"mobile\":\"13800138001\",\"email\":\"admin@osadmin.org\",\"user_desc\":\"\\u521d\\u59cb\\u7684\\u8d85\\u7ea7\\u7ba1\\u7406\\u5458!\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"15\",\"selectAll\":\"0\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"ip\":\"192.168.0.100\"}', '1503563699');
INSERT INTO `vich_sys_log` VALUES ('781', 'admin', 'LOGOUT', 'User', '1', '', '1503563701');
INSERT INTO `vich_sys_log` VALUES ('782', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503563709');
INSERT INTO `vich_sys_log` VALUES ('783', 'admin', 'ADD', 'MenuUrl', '225', '{\"menu_name\":\"\\u5e93\\u5b58\\u76d8\\u70b9\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/storage\\/count_order_create.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"141\"}', '1503567535');
INSERT INTO `vich_sys_log` VALUES ('784', 'admin', 'ADD', 'MenuUrl', '226', '{\"menu_name\":\"\\u5e93\\u5b58\\u76d8\\u70b9\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/storage\\/count_order_details.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"141\"}', '1503567570');
INSERT INTO `vich_sys_log` VALUES ('785', 'admin', 'ADD', 'MenuUrl', '227', '{\"menu_name\":\"\\u5e93\\u5b58\\u76d8\\u70b9\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/storage\\/count_order_modify.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"141\"}', '1503567615');
INSERT INTO `vich_sys_log` VALUES ('786', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227\"}', '1503567621');
INSERT INTO `vich_sys_log` VALUES ('787', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1503621282');
INSERT INTO `vich_sys_log` VALUES ('788', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503621297');
INSERT INTO `vich_sys_log` VALUES ('789', 'admin', 'ADD', 'MenuUrl', '228', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/allot_deliver_delete.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\"}', '1503625484');
INSERT INTO `vich_sys_log` VALUES ('790', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228\"}', '1503625491');
INSERT INTO `vich_sys_log` VALUES ('791', 'admin', 'MODIFY', 'MenuUrl', '228', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/plan_order_delete.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\",\"module_id\":\"10\"}', '1503626728');
INSERT INTO `vich_sys_log` VALUES ('792', 'admin', 'MODIFY', 'MenuUrl', '228', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/purchase\\/plan_order_delete.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\",\"module_id\":\"10\"}', '1503626785');
INSERT INTO `vich_sys_log` VALUES ('793', 'admin', 'ADD', 'MenuUrl', '229', '{\"menu_name\":\"\\u8fdb\\u8d27\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/purchase\\/arrival_order_delete.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\"}', '1503629996');
INSERT INTO `vich_sys_log` VALUES ('794', 'admin', 'ADD', 'MenuUrl', '230', '{\"menu_name\":\"\\u9000\\u8d27\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/purchase\\/return_order_delete.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\"}', '1503630027');
INSERT INTO `vich_sys_log` VALUES ('795', 'admin', 'MODIFY', 'MenuUrl', '229', '{\"menu_name\":\"\\u8fdb\\u8d27\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/purchase\\/arrival_order_delete.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\",\"module_id\":\"10\"}', '1503630037');
INSERT INTO `vich_sys_log` VALUES ('796', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230\"}', '1503630043');
INSERT INTO `vich_sys_log` VALUES ('797', 'admin', 'ADD', 'MenuUrl', '231', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/ip_goods_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\"}', '1503630883');
INSERT INTO `vich_sys_log` VALUES ('798', 'admin', 'ADD', 'MenuUrl', '232', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/id_goods_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\"}', '1503630938');
INSERT INTO `vich_sys_log` VALUES ('799', 'admin', 'ADD', 'MenuUrl', '233', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/oy_goods_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\"}', '1503630982');
INSERT INTO `vich_sys_log` VALUES ('800', 'admin', 'ADD', 'MenuUrl', '234', '{\"menu_name\":\"\\u5e93\\u5b58\\u76d8\\u70b9\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/pd_goods_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"141\"}', '1503631024');
INSERT INTO `vich_sys_log` VALUES ('801', 'admin', 'ADD', 'MenuUrl', '235', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/od_goods_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"192\"}', '1503631056');
INSERT INTO `vich_sys_log` VALUES ('802', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235\"}', '1503631066');
INSERT INTO `vich_sys_log` VALUES ('803', 'admin', 'ADD', 'MenuUrl', '236', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u5220\\u9664\",\"menu_url\":\"\\/purchase\\/plan_delete.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\"}', '1503635957');
INSERT INTO `vich_sys_log` VALUES ('804', 'admin', 'ADD', 'MenuUrl', '237', '{\"menu_name\":\"\\u8fdb\\u8d27\\u5355\\u5220\\u9664\",\"menu_url\":\"\\/purchase\\/arrival_delete.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\"}', '1503635990');
INSERT INTO `vich_sys_log` VALUES ('805', 'admin', 'ADD', 'MenuUrl', '238', '{\"menu_name\":\"\\u9000\\u8d27\\u5355\\u5220\\u9664\",\"menu_url\":\"\\/purchase\\/return_delete.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\"}', '1503637624');
INSERT INTO `vich_sys_log` VALUES ('806', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238\"}', '1503638042');
INSERT INTO `vich_sys_log` VALUES ('807', 'admin', 'ADD', 'MenuUrl', '239', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/ip_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\"}', '1503638453');
INSERT INTO `vich_sys_log` VALUES ('808', 'admin', 'ADD', 'MenuUrl', '240', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/id_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\"}', '1503638496');
INSERT INTO `vich_sys_log` VALUES ('809', 'admin', 'ADD', 'MenuUrl', '241', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/oy_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\"}', '1503638532');
INSERT INTO `vich_sys_log` VALUES ('810', 'admin', 'ADD', 'MenuUrl', '242', '{\"menu_name\":\"\\u5e93\\u5b58\\u76d8\\u70b9\\u5355\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/pd_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"141\"}', '1503638602');
INSERT INTO `vich_sys_log` VALUES ('811', 'admin', 'ADD', 'MenuUrl', '243', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\\u5220\\u9664\",\"menu_url\":\"\\/storage\\/od_delete.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"192\"}', '1503638630');
INSERT INTO `vich_sys_log` VALUES ('812', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,241,242,243\"}', '1503638639');
INSERT INTO `vich_sys_log` VALUES ('813', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243\"}', '1503639294');
INSERT INTO `vich_sys_log` VALUES ('814', 'admin', 'ADD', 'MenuUrl', '244', '{\"menu_name\":\"\\u91c7\\u8d2d\\u8ba2\\u5355\\u63d0\\u4ea4\\u5ba1\\u6838\",\"menu_url\":\"\\/purchase\\/plan_to_review.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"126\"}', '1503642393');
INSERT INTO `vich_sys_log` VALUES ('815', 'admin', 'ADD', 'MenuUrl', '245', '{\"menu_name\":\"\\u8fdb\\u8d27\\u5355\\u63d0\\u4ea4\\u5ba1\\u6838\",\"menu_url\":\"\\/purchase\\/arrival_to_review.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"129\"}', '1503642440');
INSERT INTO `vich_sys_log` VALUES ('816', 'admin', 'ADD', 'MenuUrl', '246', '{\"menu_name\":\"\\u9000\\u8d27\\u5355\\u63d0\\u4ea4\\u5ba1\\u6838\",\"menu_url\":\"\\/purchase\\/return_to_review.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"130\"}', '1503642471');
INSERT INTO `vich_sys_log` VALUES ('817', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246\"}', '1503642484');
INSERT INTO `vich_sys_log` VALUES ('818', 'admin', 'ADD', 'MenuUrl', '247', '{\"menu_name\":\"\\u91c7\\u8d2d\\u5165\\u5e93\\u5355\\u63d0\\u4ea4\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/ip_to_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"135\"}', '1503645221');
INSERT INTO `vich_sys_log` VALUES ('819', 'admin', 'ADD', 'MenuUrl', '248', '{\"menu_name\":\"\\u8c03\\u62e8\\u5165\\u5e93\\u5355\\u63d0\\u4ea4\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/id_to_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"138\"}', '1503645263');
INSERT INTO `vich_sys_log` VALUES ('820', 'admin', 'ADD', 'MenuUrl', '249', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\\u63d0\\u4ea4\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/oy_to_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\"}', '1503645295');
INSERT INTO `vich_sys_log` VALUES ('821', 'admin', 'ADD', 'MenuUrl', '250', '{\"menu_name\":\"\\u5e93\\u5b58\\u76d8\\u70b9\\u5355\\u63d0\\u4ea4\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/pd_to_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"141\"}', '1503645434');
INSERT INTO `vich_sys_log` VALUES ('822', 'admin', 'ADD', 'MenuUrl', '251', '{\"menu_name\":\"\\u8c03\\u62e8\\u51fa\\u5e93\\u5355\\u63d0\\u4ea4\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/od_to_review.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"192\"}', '1503645480');
INSERT INTO `vich_sys_log` VALUES ('823', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251\"}', '1503645539');
INSERT INTO `vich_sys_log` VALUES ('824', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503706938');
INSERT INTO `vich_sys_log` VALUES ('825', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1503880635');
INSERT INTO `vich_sys_log` VALUES ('826', 'admin', 'ADD', 'Supplier', '12', '{\"supplierName\":\"\\u6d4b\\u8bd5\\u4f9b\\u5e94\\u5546--2\",\"supplierAddress\":\"\\u5730\\u574022222\",\"supplierTel\":\"0501-1111111\",\"supplierUserName\":\"\\u674e\\u56db\",\"supplierUserPhone\":\"13666666666\",\"supplierUserEmail\":\"13666666666.vip@173.com\",\"supplierUserQQ\":\"908888888\",\"bankName\":\"\\u62db\\u5546\\u94f6\\u884c\",\"bankOpenName\":\"\\u62db\\u5546\\u94f6\\u884cxxx\\u5206\\u884c\",\"cardUserName\":\"\\u674e\\u56db\",\"cardUserPhone\":\"13666666666\",\"bankAccount\":\"6214832136673428\",\"cardMoney\":\"0\",\"reviewer\":\"1\",\"remark\":\"\"}', '1503882362');
INSERT INTO `vich_sys_log` VALUES ('827', 'admin', 'REVIEW', 'Suppliers', '12', '{\"flag\":\"1\",\"supplerId\":\"12\"}', '1503882377');
INSERT INTO `vich_sys_log` VALUES ('828', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1503968830');
INSERT INTO `vich_sys_log` VALUES ('829', 'admin', 'MODIFY', 'MenuUrl', '199', '{\"menu_name\":\"\\u9886\\u7528\\u51fa\\u5e93\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/storage\\/using_deliver_review.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"139\",\"module_id\":\"5\"}', '1503986316');
INSERT INTO `vich_sys_log` VALUES ('830', 'admin', 'ADD', 'MenuUrl', '252', '{\"menu_name\":\"\\u5176\\u4ed6\\u5165\\u5e93\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/storage\\/other_storage_details.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"137\"}', '1503991462');
INSERT INTO `vich_sys_log` VALUES ('831', 'admin', 'ADD', 'MenuUrl', '253', '{\"menu_name\":\"\\u5176\\u4ed6\\u51fa\\u5e93\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/storage\\/other_deliver_details.php\",\"module_id\":\"5\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"140\"}', '1503991487');
INSERT INTO `vich_sys_log` VALUES ('832', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253\"}', '1503991495');
INSERT INTO `vich_sys_log` VALUES ('833', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504313006');
INSERT INTO `vich_sys_log` VALUES ('834', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504318698');
INSERT INTO `vich_sys_log` VALUES ('835', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_name\":\"\\u91c7\\u8d2d\",\"group_desc\":\"\\u91c7\\u8d2d\\u7ec4\"}', '1504319521');
INSERT INTO `vich_sys_log` VALUES ('836', 'admin', 'ADD', 'UserGroup', '3', '{\"group_name\":\"\\u8d22\\u52a1\",\"group_desc\":\"\\u8d22\\u52a1\",\"group_role\":\"1,5,17,18,22,23,24,25\",\"owner_id\":\"1\"}', '1504319528');
INSERT INTO `vich_sys_log` VALUES ('837', 'admin', 'ADD', 'UserGroup', '4', '{\"group_name\":\"\\u4ed3\\u5e93\",\"group_desc\":\"\\u4ed3\\u5e93\",\"group_role\":\"1,5,17,18,22,23,24,25\",\"owner_id\":\"1\"}', '1504319534');
INSERT INTO `vich_sys_log` VALUES ('838', 'admin', 'ADD', 'UserGroup', '5', '{\"group_name\":\"\\u4ed3\\u5e93\\u7ba1\\u7406\\u5458\",\"group_desc\":\"\",\"group_role\":\"1,5,17,18,22,23,24,25\",\"owner_id\":\"1\"}', '1504319574');
INSERT INTO `vich_sys_log` VALUES ('839', 'admin', 'ADD', 'UserGroup', '6', '{\"group_name\":\"\\u91c7\\u8d2d\\u5ba1\\u6838\",\"group_desc\":\"\\u91c7\\u8d2d\\u5ba1\\u6838\",\"group_role\":\"1,5,17,18,22,23,24,25\",\"owner_id\":\"1\"}', '1504319588');
INSERT INTO `vich_sys_log` VALUES ('840', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,20,23,176,177,178,126,127,128,129,130,131,132,161,163,182,183,184,203,204,205,206,207,208,209,210,228,229,230,236,237,238,244,245,246\"}', '1504319879');
INSERT INTO `vich_sys_log` VALUES ('841', 'admin', 'MODIFY', 'UserGroup', '6', '{\"group_role\":\"1,5,17,18,22,23,24,25,131,132,163,182,183,193,194,195\"}', '1504320099');
INSERT INTO `vich_sys_log` VALUES ('842', 'admin', 'MODIFY', 'UserGroup', '4', '{\"group_role\":\"1,5,17,18,22,23,24,25,135,137,138,139,140,141,162,164,165,166,192,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,231,232,233,234,235,239,240,241,242,243,247,248,249,250,251,252,253\"}', '1504320172');
INSERT INTO `vich_sys_log` VALUES ('843', 'admin', 'MODIFY', 'UserGroup', '4', '{\"group_role\":\"1,5,17,18,22,23,24,25,176,177,178,135,137,138,139,140,141,162,164,165,166,192,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,231,232,233,234,235,239,240,241,242,243,247,248,249,250,251,252,253\"}', '1504320181');
INSERT INTO `vich_sys_log` VALUES ('844', 'admin', 'MODIFY', 'UserGroup', '4', '{\"group_role\":\"1,5,23,176,177,178,135,137,138,139,140,141,162,164,165,166,192,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,231,232,233,234,235,239,240,241,242,243,247,248,249,250,251,252,253\"}', '1504320198');
INSERT INTO `vich_sys_log` VALUES ('845', 'admin', 'MODIFY', 'UserGroup', '6', '{\"group_role\":\"1,5,23,176,177,178,131,132,163,182,183,193,194,195\"}', '1504320209');
INSERT INTO `vich_sys_log` VALUES ('846', 'admin', 'MODIFY', 'UserGroup', '5', '{\"group_role\":\"1,5,23,176,177,178,196,197,198,199,200,201,202\"}', '1504320302');
INSERT INTO `vich_sys_log` VALUES ('847', 'admin', 'MODIFY', 'UserGroup', '5', '{\"group_name\":\"\\u4ed3\\u5e93\\u5ba1\\u6838\",\"group_desc\":\"\"}', '1504322060');
INSERT INTO `vich_sys_log` VALUES ('848', 'admin', 'ADD', 'Depot', '9', '{\"depotName\":\"\\u6d4b\\u8bd5\",\"companyId\":\"32\",\"departmentId\":\"0\",\"employeeId\":\"11\",\"isDefault\":\"0\",\"nonceStr\":\"2IMywJ6hQWkujwqP\"}', '1504323710');
INSERT INTO `vich_sys_log` VALUES ('849', 'admin', 'ADD', 'DepotSub', '5', '{\"depotId\":\"9\",\"depotSubId\":\"5\",\"depotSubName\":\"\\u6d4b\\u8bd52\",\"companyId\":\"32\"}', '1504323721');
INSERT INTO `vich_sys_log` VALUES ('850', 'admin', 'ADD', 'Depot', '1', '{\"depotName\":\"\\u6d4b\\u8bd52\",\"companyId\":\"32\",\"departmentId\":\"12\",\"employeeId\":\"11\",\"isDefault\":\"0\",\"depotId\":\"9\",\"nonceStr\":\"UEBAEJmFGKzG3uUM\"}', '1504323734');
INSERT INTO `vich_sys_log` VALUES ('851', 'admin', 'ADD', 'MenuUrl', '254', '{\"menu_name\":\"\\u5220\\u9664\\u5e93\\u4f4d\",\"menu_url\":\"\\/sys\\/depot_del.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"123\"}', '1504323780');
INSERT INTO `vich_sys_log` VALUES ('852', 'admin', 'MODIFY', 'MenuUrl', '254', '{\"menu_name\":\"\\u5220\\u9664\\u5e93\\u4f4d\",\"menu_url\":\"\\/sys\\/depotSub_del.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"123\",\"module_id\":\"4\"}', '1504323797');
INSERT INTO `vich_sys_log` VALUES ('853', 'admin', 'ADD', 'MenuUrl', '255', '{\"menu_name\":\"\\u5220\\u9664\\u4ed3\\u5e93\",\"menu_url\":\"\\/sys\\/depot_del.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"123\"}', '1504323819');
INSERT INTO `vich_sys_log` VALUES ('854', 'admin', 'ADD', 'MenuUrl', '256', '{\"menu_name\":\"\\u7f16\\u8f91\\u5e93\\u4f4d\",\"menu_url\":\"\\/sys\\/depotSub_modify.php\",\"module_id\":\"4\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"123\"}', '1504323843');
INSERT INTO `vich_sys_log` VALUES ('855', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256\"}', '1504323850');
INSERT INTO `vich_sys_log` VALUES ('856', 'admin', 'DELETE', 'DepotSub', '5', '{\"depotSubId\":\"5\"}', '1504323868');
INSERT INTO `vich_sys_log` VALUES ('857', 'admin', 'DELETE', 'Depot', '9', '{\"depotId\":\"9\"}', '1504323872');
INSERT INTO `vich_sys_log` VALUES ('858', 'admin', 'MODIFY', 'MenuUrl', '134', '{\"menu_name\":\"\\u8d22\\u52a1\\u7ec6\\u8d26\\/\\u603b\\u8d26\",\"menu_url\":\"\\/finance\\/pay_detail.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"133\",\"module_id\":\"8\"}', '1504336434');
INSERT INTO `vich_sys_log` VALUES ('859', 'admin', 'MODIFY', 'MenuUrl', '148', '{\"menu_name\":\"\\u6dfb\\u52a0\\u8d22\\u52a1\",\"menu_url\":\"\\/finance\\/add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"133\",\"module_id\":\"8\"}', '1504336455');
INSERT INTO `vich_sys_log` VALUES ('860', 'admin', 'MODIFY', 'MenuUrl', '134', '{\"menu_name\":\"\\u8d22\\u52a1\\u7ec6\\u8d26\\/\\u603b\\u8d26\",\"menu_url\":\"\\/finance\\/pay_detail.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"149\",\"module_id\":\"8\"}', '1504336469');
INSERT INTO `vich_sys_log` VALUES ('861', 'admin', 'ADD', 'MenuUrl', '257', '{\"menu_name\":\"\\u4e0a\\u4f20\\u53d1\\u7968\",\"menu_url\":\"\\/ajax\\/base64Upload.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"133\"}', '1504344597');
INSERT INTO `vich_sys_log` VALUES ('862', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257\"}', '1504344604');
INSERT INTO `vich_sys_log` VALUES ('863', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504486028');
INSERT INTO `vich_sys_log` VALUES ('864', 'admin', 'ADD', 'MenuUrl', '258', '{\"menu_name\":\"\\u53d1\\u7968\\u8be6\\u60c5\",\"menu_url\":\"\\/purchase\\/invoice_details.php\",\"module_id\":\"10\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"131\"}', '1504490642');
INSERT INTO `vich_sys_log` VALUES ('865', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258\"}', '1504490648');
INSERT INTO `vich_sys_log` VALUES ('866', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504573051');
INSERT INTO `vich_sys_log` VALUES ('867', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504579602');
INSERT INTO `vich_sys_log` VALUES ('868', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504596888');
INSERT INTO `vich_sys_log` VALUES ('869', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504598366');
INSERT INTO `vich_sys_log` VALUES ('870', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504658566');
INSERT INTO `vich_sys_log` VALUES ('871', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.221.1\"}', '1504683322');
INSERT INTO `vich_sys_log` VALUES ('872', 'admin', 'ADD', 'MenuUrl', '259', '{\"menu_name\":\"\\u5e93\\u5b58\\u9884\\u8b66\\u8bbe\\u7f6e\",\"menu_url\":\"\\/message\\/storage_add.php\",\"module_id\":\"12\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"176\"}', '1504684297');
INSERT INTO `vich_sys_log` VALUES ('873', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259\"}', '1504684372');
INSERT INTO `vich_sys_log` VALUES ('874', 'admin', 'ADD', 'MenuUrl', '260', '{\"menu_name\":\"\\u5e93\\u5b58\\u9884\\u8b66\\u8bbe\\u7f6e\",\"menu_url\":\"\\/message\\/storage_sets.php\",\"module_id\":\"12\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1504684581');
INSERT INTO `vich_sys_log` VALUES ('875', 'admin', 'MODIFY', 'MenuUrl', '259', '{\"menu_name\":\"\\u5e93\\u5b58\\u9884\\u8b66\\u6dfb\\u52a0\\u8bbe\\u7f6e\",\"menu_url\":\"\\/message\\/storage_setting.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"260\",\"module_id\":\"12\"}', '1504684616');
INSERT INTO `vich_sys_log` VALUES ('876', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260\"}', '1504684628');
INSERT INTO `vich_sys_log` VALUES ('877', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504688357');
INSERT INTO `vich_sys_log` VALUES ('878', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504745120');
INSERT INTO `vich_sys_log` VALUES ('879', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.221.1\"}', '1504745438');
INSERT INTO `vich_sys_log` VALUES ('880', 'admin', 'DELETE', 'GoodsCate', '10,11,12,13', '\"10,11,12,13\"', '1504745861');
INSERT INTO `vich_sys_log` VALUES ('881', 'admin', 'ADD', 'GoodsCats', '16', '{\"parentId\":\"0\",\"cateName\":\"\\u7b14\\u7c7b\",\"cateNo\":\"Pen\",\"cateSort\":\"1\",\"nonceStr\":\"rg0K9VGY7gXPdGsF\"}', '1504748334');
INSERT INTO `vich_sys_log` VALUES ('882', 'admin', 'ADD', 'GoodsCats', '17', '{\"parentId\":\"0\",\"cateName\":\"\\u88c5\\u8ba2\\u7c7b\",\"cateNo\":\"ZD\",\"cateSort\":\"2\",\"nonceStr\":\"dMyCl5CSmWGTW56n\"}', '1504748356');
INSERT INTO `vich_sys_log` VALUES ('883', 'admin', 'ADD', 'GoodsCats', '18', '{\"parentId\":\"0\",\"cateName\":\"\\u6587\\u4ef6\\u5939\\u7c7b\",\"cateNo\":\"Folder\",\"cateSort\":\"3\",\"nonceStr\":\"nvmxHvdbgUKUSWNY\"}', '1504748509');
INSERT INTO `vich_sys_log` VALUES ('884', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"18\",\"parentId\":\"0\",\"cateName\":\"\\u6587\\u4ef6\\u5939\\u7c7b\",\"cateSort\":\"3\",\"cateNo\":\"Folder\"}', '1504748782');
INSERT INTO `vich_sys_log` VALUES ('885', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"18\",\"parentId\":\"0\",\"cateName\":\"\\u6587\\u4ef6\\u5939\\u7c7b\",\"cateSort\":\"31\",\"cateNo\":\"Folder\"}', '1504748790');
INSERT INTO `vich_sys_log` VALUES ('886', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"18\",\"parentId\":\"0\",\"cateName\":\"\\u6587\\u4ef6\\u5939\\u7c7b\",\"cateSort\":\"1\",\"cateNo\":\"Folder\"}', '1504748796');
INSERT INTO `vich_sys_log` VALUES ('887', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"18\",\"parentId\":\"0\",\"cateName\":\"\\u6587\\u4ef6\\u5939\\u7c7b\",\"cateSort\":\"3\",\"cateNo\":\"Folder\"}', '1504748808');
INSERT INTO `vich_sys_log` VALUES ('888', 'admin', 'DELETE', 'Goods', '20,21', '\"20,21\"', '1504751198');
INSERT INTO `vich_sys_log` VALUES ('889', 'admin', 'ADD', 'GoodsUnit', '14', '{\"unitName\":\"\\u76d2\",\"nonceStr\":\"uldGAYVWdSv8hFkn\"}', '1504751343');
INSERT INTO `vich_sys_log` VALUES ('890', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"S00000001\",\"goodsBarCode\":\"1502174002\",\"goodsName\":\"\\u767d\\u5706\\u94c5\\u7b14\",\"goodsSpec\":\"22*18*7   20\\u652f\\/\\u76d2\",\"goodsCateId\":\"16\",\"goodsUnitId\":\"14\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-09-07\",\"invalidDate\":\"2018-05-31\",\"searchKey\":\"\\u7b14\",\"remark\":\"\",\"nonceStr\":\"AkSgr1gs2TrD7g72\"}', '1504751491');
INSERT INTO `vich_sys_log` VALUES ('891', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"S00000002\",\"goodsBarCode\":\"1502174003\",\"goodsName\":\"6B\\u3001HB\\u30012B\\u30013B\\u94c5\\u7b14\",\"goodsSpec\":\"18*22*7 20\\u652f\\/\\u76d2\",\"goodsCateId\":\"16\",\"goodsUnitId\":\"14\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-09-07\",\"invalidDate\":\"2018-05-31\",\"searchKey\":\"\\u94c5\\u7b14\",\"remark\":\"\",\"nonceStr\":\"688RYQtQcnoA9Q75\"}', '1504751608');
INSERT INTO `vich_sys_log` VALUES ('892', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"S00000003\",\"goodsBarCode\":\"1502174004\",\"goodsName\":\"\\u5706\\u73e0\\u7b14\",\"goodsSpec\":\"14*7*3 12\\u652f\\/\\u76d2\",\"goodsCateId\":\"16\",\"goodsUnitId\":\"14\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-09-07\",\"invalidDate\":\"2018-05-31\",\"searchKey\":\"\\u7b14\",\"remark\":\"\",\"nonceStr\":\"3jcpcIgB85I5FMGB\"}', '1504751728');
INSERT INTO `vich_sys_log` VALUES ('893', 'admin', 'ADD', 'GoodsUnit', '15', '{\"unitName\":\"\\u888b\",\"nonceStr\":\"l20gGD0HldTL9Ua1\"}', '1504752060');
INSERT INTO `vich_sys_log` VALUES ('894', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"S00000004\",\"goodsBarCode\":\"1502174005\",\"goodsName\":\"\\u6c34\\u6eb6\\u6027\\u7b14\\u82af\",\"goodsSpec\":\"12*15 100\\u652f\\/\\u888b\",\"goodsCateId\":\"16\",\"goodsUnitId\":\"15\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-09-07\",\"invalidDate\":\"2018-05-31\",\"searchKey\":\"\\u7b14\\u82af\",\"remark\":\"\",\"nonceStr\":\"mD024KCpoPQCwAsD\"}', '1504752139');
INSERT INTO `vich_sys_log` VALUES ('895', 'admin', 'ADD', 'GoodsUnit', '16', '{\"unitName\":\"\\u652f\",\"nonceStr\":\"Qw44iLUzCCWdheJu\"}', '1504752871');
INSERT INTO `vich_sys_log` VALUES ('896', 'admin', 'ADD', 'GoodsUnit', '17', '{\"unitName\":\"\\u53ea\",\"nonceStr\":\"vwo9n48S3nDY15A4\"}', '1504753692');
INSERT INTO `vich_sys_log` VALUES ('897', 'admin', 'ADD', 'GoodsUnit', '18', '{\"unitName\":\"\\u7bb1\",\"nonceStr\":\"n2PWqWSwycVnaoBp\"}', '1504754273');
INSERT INTO `vich_sys_log` VALUES ('898', 'admin', 'DELETE', 'Employee', '17,18', '\"17,18\"', '1504762002');
INSERT INTO `vich_sys_log` VALUES ('899', 'admin', 'MODIFY', 'Employee', '15', '{\"employeeId\":\"15\",\"companyId\":\"37\",\"departmentId\":\"9\",\"employeeName\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\",\"employeeAddress\":\"xxxxxxxxx\",\"employeePhone\":\"13564111888\",\"employeeEmail\":\"test@qq.com\",\"employeeQQ\":\"13564111888\",\"employeeJob\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\"}', '1504762008');
INSERT INTO `vich_sys_log` VALUES ('900', 'admin', 'DELETE', 'DepotSub', '4', '{\"depotSubId\":\"4\"}', '1504762025');
INSERT INTO `vich_sys_log` VALUES ('901', 'admin', 'DELETE', 'DepotSub', '2', '{\"depotSubId\":\"2\"}', '1504762029');
INSERT INTO `vich_sys_log` VALUES ('902', 'admin', 'DELETE', 'Depot', '6', '{\"depotId\":\"6\"}', '1504762034');
INSERT INTO `vich_sys_log` VALUES ('903', 'admin', 'DELETE', 'Depot', '8', '{\"depotId\":\"8\"}', '1504762037');
INSERT INTO `vich_sys_log` VALUES ('904', 'admin', 'DELETE', 'Depot', '7', '{\"depotId\":\"7\"}', '1504762040');
INSERT INTO `vich_sys_log` VALUES ('905', 'admin', 'DELETE', 'Depot', '5', '{\"depotId\":\"5\"}', '1504762043');
INSERT INTO `vich_sys_log` VALUES ('906', 'admin', 'ADD', 'Depot', '10', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"13\",\"depotName\":\"\\u4ed3\\u5e9301\",\"isDefault\":\"0\",\"nonceStr\":\"adl6Qn9aFgqib6XG\"}', '1504762433');
INSERT INTO `vich_sys_log` VALUES ('907', 'admin', 'ADD', 'DepotSub', '6', '{\"depotId\":\"10\",\"depotSubId\":\"6\",\"depotSubName\":\"A\\u5e93\\u4f4d\",\"companyId\":\"32\"}', '1504762636');
INSERT INTO `vich_sys_log` VALUES ('908', 'admin', 'ADD', 'DepotSub', '7', '{\"depotId\":\"10\",\"depotSubId\":\"7\",\"depotSubName\":\"B\\u5e93\\u4f4d\",\"companyId\":\"32\"}', '1504762653');
INSERT INTO `vich_sys_log` VALUES ('909', 'admin', 'ADD', 'Depot', '11', '{\"companyId\":\"32\",\"departmentId\":\"12\",\"employeeId\":\"11\",\"depotName\":\"\\u4ed3\\u5e9302\",\"isDefault\":\"0\",\"nonceStr\":\"9gN1UDg5yliT2XAe\"}', '1504762675');
INSERT INTO `vich_sys_log` VALUES ('910', 'admin', 'ADD', 'DepotSub', '8', '{\"depotId\":\"11\",\"depotSubId\":\"8\",\"depotSubName\":\"C\\u5e93\\u4f4d\",\"companyId\":\"37\"}', '1504762696');
INSERT INTO `vich_sys_log` VALUES ('911', 'admin', 'ADD', 'DepotSub', '9', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"depotSubName\":\"D\\u5e93\\u4f4d\",\"companyId\":\"32\"}', '1504762707');
INSERT INTO `vich_sys_log` VALUES ('912', 'admin', 'ADD', 'Depot', '12', '{\"companyId\":\"37\",\"departmentId\":\"0\",\"employeeId\":\"15\",\"depotName\":\"\\u4ed3\\u5e9303\",\"isDefault\":\"0\",\"nonceStr\":\"b5DQ9ornPp3ZyMAb\"}', '1504762741');
INSERT INTO `vich_sys_log` VALUES ('913', 'admin', 'ADD', 'DepotSub', '10', '{\"depotId\":\"12\",\"depotSubId\":\"10\",\"depotSubName\":\"E\\u5e93\\u4f4d\",\"companyId\":\"37\"}', '1504762756');
INSERT INTO `vich_sys_log` VALUES ('914', 'admin', 'ADD', 'DepotSub', '11', '{\"depotId\":\"12\",\"depotSubId\":\"11\",\"depotSubName\":\"F\\u5e93\\u4f4d\",\"companyId\":\"37\"}', '1504762767');
INSERT INTO `vich_sys_log` VALUES ('915', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,20,23,176,177,178,259,260,126,127,128,129,130,131,132,161,163,182,183,184,203,204,205,206,207,208,209,210,228,229,230,236,237,238,244,245,246\"}', '1504769838');
INSERT INTO `vich_sys_log` VALUES ('916', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504769870');
INSERT INTO `vich_sys_log` VALUES ('917', 'admin', 'LOGOUT', 'User', '1', '', '1504769874');
INSERT INTO `vich_sys_log` VALUES ('918', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"127.0.0.1\"}', '1504769880');
INSERT INTO `vich_sys_log` VALUES ('919', 'test', 'LOGOUT', 'User', '27', '', '1504769900');
INSERT INTO `vich_sys_log` VALUES ('920', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"127.0.0.1\"}', '1504769907');
INSERT INTO `vich_sys_log` VALUES ('921', 'test', 'LOGOUT', 'User', '27', '', '1504769944');
INSERT INTO `vich_sys_log` VALUES ('922', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"127.0.0.1\"}', '1504769951');
INSERT INTO `vich_sys_log` VALUES ('923', 'test', 'LOGOUT', 'User', '27', '', '1504769961');
INSERT INTO `vich_sys_log` VALUES ('924', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"127.0.0.1\"}', '1504769967');
INSERT INTO `vich_sys_log` VALUES ('925', 'test', 'LOGOUT', 'User', '27', '', '1504770024');
INSERT INTO `vich_sys_log` VALUES ('926', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"127.0.0.1\"}', '1504770029');
INSERT INTO `vich_sys_log` VALUES ('927', 'admin', 'ADD', 'MenuUrl', '261', '{\"menu_name\":\"\\u5e93\\u5b58\\u9884\\u8b66\\u8bbe\\u7f6e\\u4fee\\u6539\",\"menu_url\":\"\\/message\\/storage_modify.php\",\"module_id\":\"12\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"260\"}', '1504770304');
INSERT INTO `vich_sys_log` VALUES ('928', 'admin', 'ADD', 'MenuUrl', '262', '{\"menu_name\":\"\\u5e93\\u5b58\\u9884\\u8b66\\u8bbe\\u7f6e\\u5220\\u9664\",\"menu_url\":\"\\/message\\/storage_del.php\",\"module_id\":\"12\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"260\"}', '1504770331');
INSERT INTO `vich_sys_log` VALUES ('929', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262\"}', '1504770337');
INSERT INTO `vich_sys_log` VALUES ('930', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,20,23,176,177,178,259,260,261,262,126,127,128,129,130,131,132,161,163,182,183,184,203,204,205,206,207,208,209,210,228,229,230,236,237,238,244,245,246\"}', '1504774989');
INSERT INTO `vich_sys_log` VALUES ('931', 'test', 'LOGOUT', 'User', '27', '', '1504775000');
INSERT INTO `vich_sys_log` VALUES ('932', 'test', 'LOGIN', 'User', '27', '{\"IP\":\"127.0.0.1\"}', '1504775009');
INSERT INTO `vich_sys_log` VALUES ('933', 'admin', 'MODIFY', 'User', '27', '{\"real_name\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\",\"mobile\":\"13564111888\",\"email\":\"test@qq.com\",\"user_desc\":\"\\u6d4b\\u8bd5\\u8d26\\u53f7\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"13\",\"selectAll\":\"0\",\"user_group\":\"2\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"ip\":\"127.0.0.1\"}', '1504775059');
INSERT INTO `vich_sys_log` VALUES ('934', 'admin', 'DELETE', 'User', '27', '{\"user_id\":\"27\",\"user_name\":\"test\",\"password\":null,\"real_name\":\"\\u6d4b\\u8bd5\\u5458\\u5de5\",\"mobile\":\"13564111888\",\"email\":\"test@qq.com\",\"user_desc\":\"\\u6d4b\\u8bd5\\u8d26\\u53f7\",\"login_time\":\"2017-09-07 17:03:29\",\"status\":\"1\",\"login_ip\":\"127.0.0.1\",\"user_group\":\"2\",\"template\":\"default\",\"shortcuts\":null,\"show_quicknote\":\"0\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"13\",\"selectAll\":\"0\"}', '1504775084');
INSERT INTO `vich_sys_log` VALUES ('935', 'test', 'LOGOUT', 'User', '27', '', '1504775091');
INSERT INTO `vich_sys_log` VALUES ('936', 'admin', 'ADD', 'Employee', '20', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeName\":\"\\u91c7\\u8d2d\\u5458\\u4e00\",\"employeeAddress\":\"xxxxxx\",\"employeePhone\":\"13666666666\",\"employeeEmail\":\"13666666666@163.com\",\"employeeQQ\":\"909999999\",\"employeeJob\":\"\\u91c7\\u8d2d\\u5458\",\"nonceStr\":\"FfKHU4lX8yJHcw1l\"}', '1504775156');
INSERT INTO `vich_sys_log` VALUES ('937', 'admin', 'DELETE', 'Employee', '15', '\"15\"', '1504775167');
INSERT INTO `vich_sys_log` VALUES ('938', 'admin', 'LOGOUT', 'User', '1', '', '1504775223');
INSERT INTO `vich_sys_log` VALUES ('939', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504775230');
INSERT INTO `vich_sys_log` VALUES ('940', 'admin', 'MODIFY', 'Employee', '20', '{\"employeeId\":\"20\",\"companyId\":\"32\",\"departmentId\":\"11\",\"employeeName\":\"\\u91c7\\u8d2d\\u5458\\u4e00\",\"employeeAddress\":\"xxxxxx\",\"employeePhone\":\"13666666666\",\"employeeEmail\":\"13666666666@163.com\",\"employeeQQ\":\"909999999\",\"employeeJob\":\"\\u91c7\\u8d2d\\u5458\"}', '1504775506');
INSERT INTO `vich_sys_log` VALUES ('941', 'admin', 'ADD', 'User', '28', '{\"user_name\":\"CG01\",\"password\":\"\",\"real_name\":\"\\u91c7\\u8d2d\\u5458\\u4e00\",\"mobile\":\"13666666666\",\"email\":\"13666666666@163.com\",\"user_desc\":\"\\u91c7\\u8d2d\\u6d4b\\u8bd5\\u8d26\\u53f7\",\"user_group\":\"2\",\"companyId\":\"32\",\"departmentId\":\"11\",\"employeeId\":\"20\",\"selectAll\":\"0\"}', '1504775553');
INSERT INTO `vich_sys_log` VALUES ('942', 'CG01', 'LOGIN', 'User', '28', '{\"IP\":\"127.0.0.1\"}', '1504775563');
INSERT INTO `vich_sys_log` VALUES ('943', 'CG01', 'DELETE', 'MsgSetting', '3', '{\"flag\":-1}', '1504777002');
INSERT INTO `vich_sys_log` VALUES ('944', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504830678');
INSERT INTO `vich_sys_log` VALUES ('945', 'admin', 'ADD', 'MenuUrl', '263', '{\"menu_name\":\"\\u4ef7\\u683c\\u9884\\u8b66\\u8bbe\\u7f6e\",\"menu_url\":\"\\/message\\/price_sets.php\",\"module_id\":\"12\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\\u4ef7\\u683c\\u9884\\u8b66\\u8bbe\\u7f6e\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1504831051');
INSERT INTO `vich_sys_log` VALUES ('946', 'admin', 'ADD', 'MenuUrl', '264', '{\"menu_name\":\"\\u4ef7\\u683c\\u9884\\u8b66\\u8bbe\\u7f6e\\u7f16\\u8f91\",\"menu_url\":\"\\/message\\/price_setting.php\",\"module_id\":\"12\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"263\"}', '1504831123');
INSERT INTO `vich_sys_log` VALUES ('947', 'admin', 'ADD', 'MenuUrl', '265', '{\"menu_name\":\"\\u4ef7\\u683c\\u9884\\u8b66\\u8bbe\\u7f6e\\u7f16\\u8f91\",\"menu_url\":\"\\/message\\/price_modify.php\",\"module_id\":\"12\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"263\"}', '1504831189');
INSERT INTO `vich_sys_log` VALUES ('948', 'admin', 'MODIFY', 'MenuUrl', '264', '{\"menu_name\":\"\\u4ef7\\u683c\\u9884\\u8b66\\u8bbe\\u7f6e\\u65b0\\u589e\",\"menu_url\":\"\\/message\\/price_setting.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"263\",\"module_id\":\"12\"}', '1504831201');
INSERT INTO `vich_sys_log` VALUES ('949', 'admin', 'ADD', 'MenuUrl', '266', '{\"menu_name\":\"\\u4ef7\\u683c\\u9884\\u8b66\\u8bbe\\u7f6e\\u5220\\u9664\",\"menu_url\":\"\\/message\\/price_del.php\",\"module_id\":\"12\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"263\"}', '1504831224');
INSERT INTO `vich_sys_log` VALUES ('950', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266\"}', '1504831239');
INSERT INTO `vich_sys_log` VALUES ('951', 'admin', 'ADD', 'MsgSetting', '1', '{\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"warnPercent\":\"12\"}', '1504835435');
INSERT INTO `vich_sys_log` VALUES ('952', 'admin', 'ADD', 'MsgSetting', '2', '{\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"warnPercent\":\"15.15\"}', '1504835563');
INSERT INTO `vich_sys_log` VALUES ('953', 'admin', 'ADD', 'MsgSetting', '4', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"minWarnNum\":\"12\"}', '1504835954');
INSERT INTO `vich_sys_log` VALUES ('954', 'admin', 'ADD', 'MsgSetting', '5', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"minWarnNum\":\"12\"}', '1504835990');
INSERT INTO `vich_sys_log` VALUES ('955', 'admin', 'ADD', 'MsgSetting', '6', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"minWarnNum\":\"12\"}', '1504836009');
INSERT INTO `vich_sys_log` VALUES ('956', 'admin', 'DELETE', 'MsgSetting', '4', '{\"flag\":-1}', '1504836118');
INSERT INTO `vich_sys_log` VALUES ('957', 'admin', 'DELETE', 'MsgSetting', '6', '{\"flag\":-1}', '1504836124');
INSERT INTO `vich_sys_log` VALUES ('958', 'admin', 'DELETE', 'MsgSetting', 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"5\";}', '{\"flag\":-1}', '1504836140');
INSERT INTO `vich_sys_log` VALUES ('959', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"minWarnNum\":\"10\"}', '1504836624');
INSERT INTO `vich_sys_log` VALUES ('960', 'admin', 'ADD', 'MsgSetting', '7', '{\"depotId\":\"10\",\"depotSubId\":\"6\",\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"minWarnNum\":\"12\"}', '1504836630');
INSERT INTO `vich_sys_log` VALUES ('961', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"minWarnNum\":\"10\"}', '1504836635');
INSERT INTO `vich_sys_log` VALUES ('962', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"minWarnNum\":\"10\"}', '1504836705');
INSERT INTO `vich_sys_log` VALUES ('963', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"minWarnNum\":\"10\"}', '1504836710');
INSERT INTO `vich_sys_log` VALUES ('964', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"minWarnNum\":\"10\"}', '1504836716');
INSERT INTO `vich_sys_log` VALUES ('965', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"minWarnNum\":\"10\"}', '1504836784');
INSERT INTO `vich_sys_log` VALUES ('966', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"minWarnNum\":\"10\"}', '1504836789');
INSERT INTO `vich_sys_log` VALUES ('967', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"depotId\":\"11\",\"depotSubId\":\"9\",\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"minWarnNum\":\"10\"}', '1504836797');
INSERT INTO `vich_sys_log` VALUES ('968', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"warnPercent\":\"15\"}', '1504840197');
INSERT INTO `vich_sys_log` VALUES ('969', 'admin', 'ADD', 'MsgSetting', '3', '{\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"warnPercent\":\"15\"}', '1504840208');
INSERT INTO `vich_sys_log` VALUES ('970', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"warnPercent\":\"15.00\"}', '1504840214');
INSERT INTO `vich_sys_log` VALUES ('971', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"warnPercent\":\"15.00\"}', '1504840233');
INSERT INTO `vich_sys_log` VALUES ('972', 'admin', 'MODIFY', 'MsgSetting', '1', '{\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"warnPercent\":\"15.00\"}', '1504840238');
INSERT INTO `vich_sys_log` VALUES ('973', 'admin', 'DELETE', 'MsgSetting', '3', '{\"flag\":-1}', '1504840506');
INSERT INTO `vich_sys_log` VALUES ('974', 'admin', 'ADD', 'MsgSetting', '4', '{\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"warnPercent\":\"15\"}', '1504840550');
INSERT INTO `vich_sys_log` VALUES ('975', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,20,23,176,177,178,259,260,261,262,263,264,265,266,126,127,128,129,130,131,132,161,163,182,183,184,203,204,205,206,207,208,209,210,228,229,230,236,237,238,244,245,246\"}', '1504840569');
INSERT INTO `vich_sys_log` VALUES ('976', 'admin', 'ADD', 'MsgSetting', '5', '{\"goodsCateId\":\"16\",\"goodsId\":\"26\",\"upPercent\":\"15\",\"downPercent\":\"5\"}', '1504841224');
INSERT INTO `vich_sys_log` VALUES ('977', 'admin', 'MODIFY', 'MsgSetting', '4', '{\"goodsCateId\":\"16\",\"goodsId\":\"23\",\"upPercent\":\"15.00\",\"downPercent\":\"5\"}', '1504841322');
INSERT INTO `vich_sys_log` VALUES ('978', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.221.1\"}', '1504853130');
INSERT INTO `vich_sys_log` VALUES ('979', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504862757');
INSERT INTO `vich_sys_log` VALUES ('980', 'admin', 'LOGOUT', 'User', '1', '', '1504875096');
INSERT INTO `vich_sys_log` VALUES ('981', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504875104');
INSERT INTO `vich_sys_log` VALUES ('982', 'admin', 'MODIFY', 'MsgSetting', '5', '{\"goodsCateId\":\"16\",\"goodsId\":\"26\",\"upPercent\":\"0\",\"downPercent\":\"0\"}', '1504875116');
INSERT INTO `vich_sys_log` VALUES ('983', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504877771');
INSERT INTO `vich_sys_log` VALUES ('984', 'admin', 'ADD', 'MsgSetting', '8', '{\"depotId\":\"10\",\"depotSubId\":\"6\",\"goodsCateId\":\"16\",\"goodsId\":\"22\",\"minWarnNum\":\"5\"}', '1504884163');
INSERT INTO `vich_sys_log` VALUES ('985', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504889327');
INSERT INTO `vich_sys_log` VALUES ('986', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1504889391');
INSERT INTO `vich_sys_log` VALUES ('987', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504889399');
INSERT INTO `vich_sys_log` VALUES ('988', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504889449');
INSERT INTO `vich_sys_log` VALUES ('989', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504889532');
INSERT INTO `vich_sys_log` VALUES ('990', 'admin', 'LOGOUT', 'User', '1', '', '1504889721');
INSERT INTO `vich_sys_log` VALUES ('991', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504889729');
INSERT INTO `vich_sys_log` VALUES ('992', 'admin', 'LOGOUT', 'User', '1', '', '1504688339');
INSERT INTO `vich_sys_log` VALUES ('993', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504917969');
INSERT INTO `vich_sys_log` VALUES ('994', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"16\",\"parentId\":\"0\",\"cateName\":\"\\u7b14\\u7c7b\",\"cateSort\":\"1\",\"cateNo\":\"10\"}', '1504921351');
INSERT INTO `vich_sys_log` VALUES ('995', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"17\",\"parentId\":\"0\",\"cateName\":\"\\u88c5\\u8ba2\\u7c7b\",\"cateSort\":\"2\",\"cateNo\":\"20\"}', '1504921359');
INSERT INTO `vich_sys_log` VALUES ('996', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"18\",\"parentId\":\"0\",\"cateName\":\"\\u6587\\u4ef6\\u5939\\u7c7b\",\"cateSort\":\"3\",\"cateNo\":\"30\"}', '1504921366');
INSERT INTO `vich_sys_log` VALUES ('997', 'admin', 'LOGOUT', 'User', '1', '', '1504925764');
INSERT INTO `vich_sys_log` VALUES ('998', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504925834');
INSERT INTO `vich_sys_log` VALUES ('999', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.221.1\"}', '1504927390');
INSERT INTO `vich_sys_log` VALUES ('1000', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1504927404');
INSERT INTO `vich_sys_log` VALUES ('1001', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1505091937');
INSERT INTO `vich_sys_log` VALUES ('1002', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1505176938');
INSERT INTO `vich_sys_log` VALUES ('1003', 'admin', 'LOGOUT', 'User', '1', '', '1505178650');
INSERT INTO `vich_sys_log` VALUES ('1004', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1505368835');
INSERT INTO `vich_sys_log` VALUES ('1005', 'admin', 'ADD', 'User', '29', '{\"user_name\":\"kucun\",\"password\":\"\",\"real_name\":\"\\u5e93\\u5b58\",\"mobile\":\"13666666666\",\"email\":\"13666666666@163.com\",\"user_desc\":\"\\u5e93\\u5b58\\u7ba1\\u7406\",\"user_group\":\"4\",\"companyId\":\"32\",\"departmentId\":\"12\",\"employeeId\":\"11\",\"selectAll\":\"0\"}', '1505368973');
INSERT INTO `vich_sys_log` VALUES ('1006', 'admin', 'ADD', 'Company', '38', '{\"companyName\":\"\\u67ec\\u57d4\\u5be8\",\"companyAddress\":\"\\u67ec\\u57d4\\u5be8\",\"companyTel\":\"0510-22222222\",\"companyUserName\":\"\\u67ec\\u57d4\",\"companyUserPhone\":\"13666666666\",\"companyUserEmail\":\"13666666666@163.com\",\"companyUserQQ\":\"13666666666\",\"nonceStr\":\"rBZVT4MYwg5WqMD6\"}', '1505369035');
INSERT INTO `vich_sys_log` VALUES ('1007', 'admin', 'ADD', 'Employee', '21', '{\"companyId\":\"38\",\"departmentId\":\"12\",\"employeeName\":\"\\u4ed3\\u5e93\\u5458\",\"employeeAddress\":\"\\u6d4b\\u8bd5\",\"employeePhone\":\"13666666666\",\"employeeEmail\":\"13666666666@163.com\",\"employeeQQ\":\"13666666666\",\"employeeJob\":\"\\u4ed3\\u5e93\\u7ba1\\u7406\",\"nonceStr\":\"Fr31lm6RllOHXrla\"}', '1505369093');
INSERT INTO `vich_sys_log` VALUES ('1008', 'admin', 'ADD', 'UserGroup', '7', '{\"group_name\":\"\\u603b\\u7ecf\\u7406\",\"group_desc\":\"\\u603b\\u7ecf\\u7406\",\"group_role\":\"1,5,17,18,22,23,24,25\",\"owner_id\":\"1\"}', '1505369193');
INSERT INTO `vich_sys_log` VALUES ('1009', 'test', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1505369267');
INSERT INTO `vich_sys_log` VALUES ('1010', 'CG01', 'LOGIN', 'User', '28', '{\"IP\":\"127.0.0.1\"}', '1505369288');
INSERT INTO `vich_sys_log` VALUES ('1011', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1505370351');
INSERT INTO `vich_sys_log` VALUES ('1012', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1505533106');
INSERT INTO `vich_sys_log` VALUES ('1013', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1505533116');
INSERT INTO `vich_sys_log` VALUES ('1014', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1505789230');
INSERT INTO `vich_sys_log` VALUES ('1015', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"::1\"}', '1505870476');
INSERT INTO `vich_sys_log` VALUES ('1016', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"::1\"}', '1505877693');
INSERT INTO `vich_sys_log` VALUES ('1017', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1506128683');
INSERT INTO `vich_sys_log` VALUES ('1018', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1506129509');
INSERT INTO `vich_sys_log` VALUES ('1019', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1506129540');
INSERT INTO `vich_sys_log` VALUES ('1020', 'admin', 'LOGOUT', 'User', '1', '', '1506129594');
INSERT INTO `vich_sys_log` VALUES ('1021', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1506129617');
INSERT INTO `vich_sys_log` VALUES ('1022', 'admin', 'MODIFY', 'MenuUrl', '142', '{\"menu_name\":\"\\u5404\\u90e8\\u95e8\\u9886\\u7528\\u660e\\u7ec6\\u8868\",\"menu_url\":\"\\/charts\\/purchase.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1506136152');
INSERT INTO `vich_sys_log` VALUES ('1023', 'admin', 'MODIFY', 'MenuUrl', '143', '{\"menu_name\":\"\\u5404\\u90e8\\u95e8\\u9886\\u7528\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/charts\\/return.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1506136215');
INSERT INTO `vich_sys_log` VALUES ('1024', '13666666666', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1506137532');
INSERT INTO `vich_sys_log` VALUES ('1025', 'CG01', 'LOGIN', 'User', '28', '{\"IP\":\"127.0.0.1\"}', '1506137545');
INSERT INTO `vich_sys_log` VALUES ('1026', 'admin', 'MODIFY', 'UserGroup', '2', '{\"group_role\":\"1,5,20,23,176,177,178,259,260,261,262,263,264,265,266,126,127,128,129,130,131,132,161,163,182,183,184,203,204,205,206,207,208,209,210,228,229,230,236,237,238,244,245,246,142,143,144,145\"}', '1506137614');
INSERT INTO `vich_sys_log` VALUES ('1027', 'CG01', 'LOGOUT', 'User', '28', '', '1506137616');
INSERT INTO `vich_sys_log` VALUES ('1028', 'CG01', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1506137626');
INSERT INTO `vich_sys_log` VALUES ('1029', 'CG01', 'LOGIN', 'User', '28', '{\"IP\":\"127.0.0.1\"}', '1506137633');
INSERT INTO `vich_sys_log` VALUES ('1030', 'admin', 'MODIFY', 'MenuUrl', '144', '{\"menu_name\":\"\\u6750\\u6599\\u8d2d\\u5165\\u3001\\u9886\\u7528\\u3001\\u76d8\\u5b58\\u660e\\u7ec6\\u8868\",\"menu_url\":\"\\/charts\\/suppliers.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1506143062');
INSERT INTO `vich_sys_log` VALUES ('1031', 'admin', 'MODIFY', 'MenuUrl', '145', '{\"menu_name\":\"\\u6750\\u6599\\u8d2d\\u5165\\u3001\\u9886\\u7528\\u3001\\u76d8\\u5b58\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/charts\\/global.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1506143077');
INSERT INTO `vich_sys_log` VALUES ('1032', 'admin', 'LOGOUT', 'User', '1', '', '1506144651');
INSERT INTO `vich_sys_log` VALUES ('1033', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1506302185');
INSERT INTO `vich_sys_log` VALUES ('1034', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1507509766');
INSERT INTO `vich_sys_log` VALUES ('1035', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507509776');
INSERT INTO `vich_sys_log` VALUES ('1036', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1507609119');
INSERT INTO `vich_sys_log` VALUES ('1037', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507609128');
INSERT INTO `vich_sys_log` VALUES ('1038', 'admin', 'ADD', 'GoodsCats', '19', '{\"parentId\":\"0\",\"cateName\":\"\\u6d4b\\u8bd5\",\"cateSort\":\"1\",\"cateNo\":\"22\"}', '1507619711');
INSERT INTO `vich_sys_log` VALUES ('1039', 'admin', 'ADD', 'GoodsCats', '20', '{\"parentId\":\"19\",\"cateName\":\"\\u6d4b\\u8bd51\",\"cateSort\":\"1\",\"cateNo\":\"222\"}', '1507619731');
INSERT INTO `vich_sys_log` VALUES ('1040', 'admin', 'ADD', 'GoodsCats', '21', '{\"parentId\":\"20\",\"cateName\":\"\\u6d4b\\u8bd53\",\"cateSort\":\"1\",\"cateNo\":\"2222\"}', '1507619747');
INSERT INTO `vich_sys_log` VALUES ('1041', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"20\",\"parentId\":\"19\",\"cateName\":\"\\u6d4b\\u8bd51\",\"cateSort\":\"1\",\"cateNo\":\"222\"}', '1507620483');
INSERT INTO `vich_sys_log` VALUES ('1042', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"21\",\"parentId\":\"20\",\"cateName\":\"\\u6d4b\\u8bd53\",\"cateSort\":\"1\",\"cateNo\":\"2222\"}', '1507620502');
INSERT INTO `vich_sys_log` VALUES ('1043', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"21\",\"parentId\":\"19\",\"cateName\":\"\\u6d4b\\u8bd53\",\"cateSort\":\"1\",\"cateNo\":\"2222\"}', '1507622564');
INSERT INTO `vich_sys_log` VALUES ('1044', 'admin', 'LOGOUT', 'User', '1', '', '1507629939');
INSERT INTO `vich_sys_log` VALUES ('1045', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507683558');
INSERT INTO `vich_sys_log` VALUES ('1046', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"21\",\"parentId\":\"20\",\"cateName\":\"\\u6d4b\\u8bd53\",\"cateSort\":\"1\",\"cateNo\":\"2222\"}', '1507684312');
INSERT INTO `vich_sys_log` VALUES ('1047', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"21\",\"parentId\":\"19\",\"cateName\":\"\\u6d4b\\u8bd53\",\"cateSort\":\"1\",\"cateNo\":\"2222\"}', '1507684333');
INSERT INTO `vich_sys_log` VALUES ('1048', 'admin', 'ADD', 'GoodsCats', '22', '{\"parentId\":\"0\",\"cateName\":\"\\u529e\\u516c\\u7528\\u54c1\",\"cateSort\":\"1\",\"cateNo\":\"001\"}', '1507685952');
INSERT INTO `vich_sys_log` VALUES ('1049', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"21\",\"parentId\":\"20\",\"cateName\":\"\\u6d4b\\u8bd53\",\"cateSort\":\"1\",\"cateNo\":\"2222\"}', '1507685964');
INSERT INTO `vich_sys_log` VALUES ('1050', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"16\",\"parentId\":\"22\",\"cateName\":\"\\u7b14\\u7c7b\",\"cateSort\":\"1\",\"cateNo\":\"10\"}', '1507687047');
INSERT INTO `vich_sys_log` VALUES ('1051', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"17\",\"parentId\":\"22\",\"cateName\":\"\\u88c5\\u8ba2\\u7c7b\",\"cateSort\":\"2\",\"cateNo\":\"20\"}', '1507687144');
INSERT INTO `vich_sys_log` VALUES ('1052', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"18\",\"parentId\":\"22\",\"cateName\":\"\\u6587\\u4ef6\\u5939\\u7c7b\",\"cateSort\":\"3\",\"cateNo\":\"30\"}', '1507687150');
INSERT INTO `vich_sys_log` VALUES ('1053', 'admin', 'DELETE', 'GoodsCate', '19', '\"19\"', '1507687157');
INSERT INTO `vich_sys_log` VALUES ('1054', 'admin', 'ADD', 'GoodsCats', '23', '{\"parentId\":\"16\",\"cateName\":\"\\u94c5\\u7b14\",\"cateSort\":\"1\",\"cateNo\":\"0112\"}', '1507688813');
INSERT INTO `vich_sys_log` VALUES ('1055', 'admin', 'ADD', 'GoodsCats', '24', '{\"parentId\":\"16\",\"cateName\":\"\\u4e2d\\u6027\\u7b14\",\"cateSort\":\"1\",\"cateNo\":\"01231\"}', '1507688859');
INSERT INTO `vich_sys_log` VALUES ('1056', 'admin', 'ADD', 'GoodsCats', '25', '{\"parentId\":\"16\",\"cateName\":\"\\u94a2\\u7b14\",\"cateSort\":\"1\",\"cateNo\":\"0123\"}', '1507688881');
INSERT INTO `vich_sys_log` VALUES ('1057', 'admin', 'ADD', 'GoodsCats', '26', '{\"parentId\":\"22\",\"cateName\":\"\\u6587\\u672c\\u7eb8\\u7c7b\",\"cateSort\":\"1\",\"cateNo\":\"123\"}', '1507692212');
INSERT INTO `vich_sys_log` VALUES ('1058', 'admin', 'ADD', 'GoodsCats', '27', '{\"parentId\":\"26\",\"cateName\":\"\\u590d\\u5199\\u7eb8\",\"cateSort\":\"1\",\"cateNo\":\"2335\"}', '1507692228');
INSERT INTO `vich_sys_log` VALUES ('1059', 'admin', 'ADD', 'GoodsCats', '28', '{\"parentId\":\"26\",\"cateName\":\"\\u590d\\u5370\\u7eb8\",\"cateSort\":\"1\",\"cateNo\":\"31264\"}', '1507692249');
INSERT INTO `vich_sys_log` VALUES ('1060', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"S00000031\",\"goodsBarCode\":\"1502174034\",\"goodsName\":\"\\u7ea2\\u590d\\u5199\\u7eb8\",\"goodsSpec\":\"35*24\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"26\",\"goodsCateId\":\"27\",\"goodsUnitId\":\"14\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-10-11\",\"invalidDate\":\"2018-08-18\",\"searchKey\":\"\\u7ea2\\u590d\\u5199\\u7eb8\",\"remark\":\"\\u7528\\u91cf\\u53ca\\u5c11\\u3001\\u5e93\\u5b58\",\"nonceStr\":\"9XN5yhbwO6tgM815\"}', '1507692350');
INSERT INTO `vich_sys_log` VALUES ('1061', 'admin', 'MODIFY', 'Goods', '55', '{\"goodsId\":\"55\",\"goodsSn\":\"S00000031\",\"goodsName\":\"\\u7ea2\\u590d\\u5199\\u7eb8\",\"goodsSpec\":\"35*24\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"26\",\"goodsCateId\":\"27\",\"goodsUnitId\":\"14\",\"productionDate\":\"2017-10-11\",\"invalidDate\":\"2018-08-18\",\"searchKey\":\"\\u7ea2\\u590d\\u5199\\u7eb8\",\"remark\":\"\\u7528\\u91cf\\u53ca\\u5c11\\u3001\\u5e93\\u5b58\"}', '1507693088');
INSERT INTO `vich_sys_log` VALUES ('1062', 'admin', 'MODIFY', 'Goods', '55', '{\"goodsId\":\"55\",\"goodsSn\":\"S00000031\",\"goodsName\":\"\\u7ea2\\u590d\\u5199\\u7eb8\",\"goodsSpec\":\"35*24\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"26\",\"goodsCateId\":\"28\",\"goodsUnitId\":\"14\",\"productionDate\":\"2017-10-11\",\"invalidDate\":\"2018-08-18\",\"searchKey\":\"\\u7ea2\\u590d\\u5199\\u7eb8\",\"remark\":\"\\u7528\\u91cf\\u53ca\\u5c11\\u3001\\u5e93\\u5b58\"}', '1507693095');
INSERT INTO `vich_sys_log` VALUES ('1063', 'admin', 'MODIFY', 'Goods', '55', '{\"goodsId\":\"55\",\"goodsSn\":\"S00000031\",\"goodsName\":\"\\u7ea2\\u590d\\u5199\\u7eb8\",\"goodsSpec\":\"35*24\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"26\",\"goodsCateId\":\"27\",\"goodsUnitId\":\"14\",\"productionDate\":\"2017-10-11\",\"invalidDate\":\"2018-08-18\",\"searchKey\":\"\\u7ea2\\u590d\\u5199\\u7eb8\",\"remark\":\"\\u7528\\u91cf\\u53ca\\u5c11\\u3001\\u5e93\\u5b58\"}', '1507693100');
INSERT INTO `vich_sys_log` VALUES ('1064', 'admin', 'MODIFY', 'Goods', '22', '{\"goodsId\":\"22\",\"goodsSn\":\"S00000001\",\"goodsName\":\"\\u767d\\u5706\\u94c5\\u7b14\",\"goodsSpec\":\"22*18*7   20\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"23\",\"goodsUnitId\":\"14\",\"productionDate\":\"2017-09-07\",\"invalidDate\":\"2018-05-31\",\"searchKey\":\"\\u7b14\",\"remark\":\"\"}', '1507693125');
INSERT INTO `vich_sys_log` VALUES ('1065', 'admin', 'MODIFY', 'Goods', '23', '{\"goodsId\":\"23\",\"goodsSn\":\"S00000002\",\"goodsName\":\"6B\\u3001HB\\u30012B\\u30013B\\u94c5\\u7b14\",\"goodsSpec\":\"18*22*7 20\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"23\",\"goodsUnitId\":\"14\",\"productionDate\":\"2017-09-07\",\"invalidDate\":\"2018-05-31\",\"searchKey\":\"\\u94c5\\u7b14\",\"remark\":\"\"}', '1507693136');
INSERT INTO `vich_sys_log` VALUES ('1066', 'admin', 'MODIFY', 'Goods', '24', '{\"goodsId\":\"24\",\"goodsSn\":\"S00000003\",\"goodsName\":\"\\u5706\\u73e0\\u7b14\",\"goodsSpec\":\"14*7*3 12\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"14\",\"productionDate\":\"2017-09-07\",\"invalidDate\":\"2018-05-31\",\"searchKey\":\"\\u7b14\",\"remark\":\"\"}', '1507693252');
INSERT INTO `vich_sys_log` VALUES ('1067', 'admin', 'MODIFY', 'Goods', '25', '{\"goodsId\":\"25\",\"goodsSn\":\"S00000004\",\"goodsName\":\"\\u6c34\\u6eb6\\u6027\\u7b14\\u82af\",\"goodsSpec\":\"12*15 100\\u652f\\/\\u888b\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"15\",\"productionDate\":\"2017-09-07\",\"invalidDate\":\"2018-05-31\",\"searchKey\":\"\\u7b14\\u82af\",\"remark\":\"\"}', '1507693268');
INSERT INTO `vich_sys_log` VALUES ('1068', 'admin', 'MODIFY', 'Goods', '26', '{\"goodsId\":\"26\",\"goodsSn\":\"S00000005\",\"goodsName\":\"\\u8bb0\\u53f7\\u7b14\",\"goodsSpec\":\"15*9*3 10\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\" \",\"remark\":\"\"}', '1507693282');
INSERT INTO `vich_sys_log` VALUES ('1069', 'admin', 'MODIFY', 'Goods', '27', '{\"goodsId\":\"27\",\"goodsSn\":\"S00000006\",\"goodsName\":\"\\u53cc\\u5934\\u8bb0\\u53f7\\u7b14\",\"goodsSpec\":\"15*7*3 10\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507693345');
INSERT INTO `vich_sys_log` VALUES ('1070', 'admin', 'MODIFY', 'Goods', '28', '{\"goodsId\":\"28\",\"goodsSn\":\"S00000007\",\"goodsName\":\"\\u767d\\u677f\\u7b14\",\"goodsSpec\":\"14*9*4 10\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507693355');
INSERT INTO `vich_sys_log` VALUES ('1071', 'admin', 'MODIFY', 'Goods', '29', '{\"goodsId\":\"29\",\"goodsSn\":\"S00000008\",\"goodsName\":\"\\u6c34\\u7b14   \\uff08\\u9ed1\\/\\u7ea2\\uff09\",\"goodsSpec\":\"15*7*3 12\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507693440');
INSERT INTO `vich_sys_log` VALUES ('1072', 'admin', 'MODIFY', 'Goods', '30', '{\"goodsId\":\"30\",\"goodsSn\":\"S00000009\",\"goodsName\":\"\\u6c34\\u7b14\\u82af\\uff08\\u9ed1\\/\\u7ea2\\uff09\",\"goodsSpec\":\"15*5*5 20\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695211');
INSERT INTO `vich_sys_log` VALUES ('1073', 'admin', 'MODIFY', 'Goods', '31', '{\"goodsId\":\"31\",\"goodsSn\":\"S00000010\",\"goodsName\":\"\\u6c34\\u6eb6\\u6027\\u7b14\\u82af\",\"goodsSpec\":\"12*15 100\\u652f\\/\\u888b\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"15\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695221');
INSERT INTO `vich_sys_log` VALUES ('1074', 'admin', 'MODIFY', 'Goods', '32', '{\"goodsId\":\"32\",\"goodsSn\":\"S00000011\",\"goodsName\":\"\\u6309\\u52a8\\u6c34\\u7b14\",\"goodsSpec\":\"15*8*2 12\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695231');
INSERT INTO `vich_sys_log` VALUES ('1075', 'admin', 'MODIFY', 'Goods', '33', '{\"goodsId\":\"33\",\"goodsSn\":\"S00000012\",\"goodsName\":\"\\u9ad8\\u6e29\\u6d88\\u77e2\\u7b14\",\"goodsSpec\":\"14*9*3 100\\u652f\\/\\u888b\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"16\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\\u4ee5\\u540e\\u4e0d\\u7528\\uff0c\\u5e93\\u5b58\"}', '1507695244');
INSERT INTO `vich_sys_log` VALUES ('1076', 'admin', 'MODIFY', 'Goods', '34', '{\"goodsId\":\"34\",\"goodsSn\":\"S00000013\",\"goodsName\":\"\\u6e05\\u6d17\\u7b14\",\"goodsSpec\":\"13*10*4 10\\u652f\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695302');
INSERT INTO `vich_sys_log` VALUES ('1077', 'admin', 'MODIFY', 'Goods', '35', '{\"goodsId\":\"35\",\"goodsSn\":\"S00000014\",\"goodsName\":\"\\u6a61\\u76ae\",\"goodsSpec\":\"15*13*4 30\\u5757\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695311');
INSERT INTO `vich_sys_log` VALUES ('1078', 'admin', 'MODIFY', 'Goods', '36', '{\"goodsId\":\"36\",\"goodsSn\":\"S00000015\",\"goodsName\":\"\\u9000\\u8272\\u7b14 \\u7c97\",\"goodsSpec\":\"30*27 100\\u652f\\/\\u888b\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"15\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695320');
INSERT INTO `vich_sys_log` VALUES ('1079', 'admin', 'MODIFY', 'Goods', '37', '{\"goodsId\":\"37\",\"goodsSn\":\"S00000016\",\"goodsName\":\"\\u892a\\u8272\\u7b14 \\u7ec6\",\"goodsSpec\":\"30*27 12\\u652f\\/\\u888b\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"15\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695332');
INSERT INTO `vich_sys_log` VALUES ('1080', 'admin', 'ADD', 'GoodsCats', '29', '{\"parentId\":\"17\",\"cateName\":\"\\u9488\\u8ba2\",\"cateSort\":\"1\",\"cateNo\":\"00000\"}', '1507695482');
INSERT INTO `vich_sys_log` VALUES ('1081', 'admin', 'MODIFY', 'Goods', '40', '{\"goodsId\":\"40\",\"goodsSn\":\"S00000017\",\"goodsName\":\"\\u56de\\u5f62\\u9488\",\"goodsSpec\":\"14*8*6 10\\u5c0f\\u76d2\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"17\",\"goodsCateId\":\"29\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695503');
INSERT INTO `vich_sys_log` VALUES ('1082', 'admin', 'MODIFY', 'Goods', '41', '{\"goodsId\":\"41\",\"goodsSn\":\"S00000018\",\"goodsName\":\"\\u5927\\u5934\\u9488 \",\"goodsSpec\":\"14*8*6 10\\u5c0f\\u76d2\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"17\",\"goodsCateId\":\"29\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695531');
INSERT INTO `vich_sys_log` VALUES ('1083', 'admin', 'ADD', 'GoodsCats', '30', '{\"parentId\":\"17\",\"cateName\":\"\\u88c5\\u8ba2\\u5939\",\"cateSort\":\"1\",\"cateNo\":\"03211\"}', '1507695803');
INSERT INTO `vich_sys_log` VALUES ('1084', 'admin', 'ADD', 'GoodsCats', '31', '{\"parentId\":\"17\",\"cateName\":\"\\u8ba2\\u4e66\\u673a\",\"cateSort\":\"1\",\"cateNo\":\"134156\"}', '1507695821');
INSERT INTO `vich_sys_log` VALUES ('1085', 'admin', 'ADD', 'GoodsCats', '32', '{\"parentId\":\"0\",\"cateName\":\"\\u6253\\u5b54\\u673a\",\"cateSort\":\"1\",\"cateNo\":\"7815\"}', '1507695833');
INSERT INTO `vich_sys_log` VALUES ('1086', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"32\",\"parentId\":\"17\",\"cateName\":\"\\u6253\\u5b54\\u673a\",\"cateSort\":\"1\",\"cateNo\":\"7815\"}', '1507695849');
INSERT INTO `vich_sys_log` VALUES ('1087', 'admin', 'ADD', 'GoodsCats', '33', '{\"parentId\":\"17\",\"cateName\":\"\\u767d\\u677f\",\"cateSort\":\"1\",\"cateNo\":\"1231\"}', '1507695889');
INSERT INTO `vich_sys_log` VALUES ('1088', 'admin', 'ADD', 'GoodsCats', '34', '{\"parentId\":\"17\",\"cateName\":\"\\u767d\\u677f\",\"cateSort\":\"1\",\"cateNo\":\"123454\"}', '1507695907');
INSERT INTO `vich_sys_log` VALUES ('1089', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"34\",\"parentId\":\"17\",\"cateName\":\"\\u6302\\u9501\",\"cateSort\":\"1\",\"cateNo\":\"123454\"}', '1507695917');
INSERT INTO `vich_sys_log` VALUES ('1090', 'admin', 'MODIFY', 'Goods', '45', '{\"goodsId\":\"45\",\"goodsSn\":\"S00000022\",\"goodsName\":\"\\u88c5\\u8ba2\\u5939\",\"goodsSpec\":\"20*8*2 50\\u4ed8\\/\\u76d2\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"17\",\"goodsCateId\":\"30\",\"goodsUnitId\":\"14\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695961');
INSERT INTO `vich_sys_log` VALUES ('1091', 'admin', 'MODIFY', 'Goods', '46', '{\"goodsId\":\"46\",\"goodsSn\":\"S00000023\",\"goodsName\":\"\\u8ba2\\u4e66\\u673a\",\"goodsSpec\":\"13*7*4 \",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"17\",\"goodsCateId\":\"31\",\"goodsUnitId\":\"17\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695980');
INSERT INTO `vich_sys_log` VALUES ('1092', 'admin', 'MODIFY', 'Goods', '47', '{\"goodsId\":\"47\",\"goodsSn\":\"S00000024\",\"goodsName\":\"\\u6253\\u5b54\\u673a\",\"goodsSpec\":\"13*9*6 \",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"17\",\"goodsCateId\":\"32\",\"goodsUnitId\":\"17\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507695993');
INSERT INTO `vich_sys_log` VALUES ('1093', 'admin', 'MODIFY', 'Goods', '49', '{\"goodsId\":\"49\",\"goodsSn\":\"S00000026\",\"goodsName\":\"90*120\\u767d\\u677f\",\"goodsSpec\":\" \",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"17\",\"goodsCateId\":\"33\",\"goodsUnitId\":\"11\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\\u6309\\u9700\\u91c7\\u8d2d\\uff0c\\u865a\\u62df\\u5e93\\u4f4d\"}', '1507696018');
INSERT INTO `vich_sys_log` VALUES ('1094', 'admin', 'MODIFY', 'Goods', '50', '{\"goodsId\":\"50\",\"goodsSn\":\"S00000027\",\"goodsName\":\"\\u6302\\u9501\",\"goodsSpec\":\" \",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"17\",\"goodsCateId\":\"34\",\"goodsUnitId\":\"11\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\\u6309\\u9700\\u91c7\\u8d2d\\uff0c\\u865a\\u62df\\u5e93\\u4f4d\"}', '1507696035');
INSERT INTO `vich_sys_log` VALUES ('1095', 'admin', 'ADD', 'GoodsCats', '35', '{\"parentId\":\"18\",\"cateName\":\"\\u6587\\u4ef6\\u67b6\",\"cateSort\":\"1\",\"cateNo\":\"0546\"}', '1507697327');
INSERT INTO `vich_sys_log` VALUES ('1096', 'admin', 'ADD', 'GoodsCats', '36', '{\"parentId\":\"0\",\"cateName\":\"\\u6587\\u4ef6\\u5939\",\"cateSort\":\"1\",\"cateNo\":\"0322\"}', '1507697351');
INSERT INTO `vich_sys_log` VALUES ('1097', 'admin', 'MODIFY', 'GoodsCate', '', '{\"cateId\":\"36\",\"parentId\":\"18\",\"cateName\":\"\\u6587\\u4ef6\\u5939\",\"cateSort\":\"1\",\"cateNo\":\"0322\"}', '1507697369');
INSERT INTO `vich_sys_log` VALUES ('1098', 'admin', 'MODIFY', 'Goods', '51', '{\"goodsId\":\"51\",\"goodsSn\":\"S00000028\",\"goodsName\":\"\\u6587\\u4ef6\\u67b6\",\"goodsSpec\":\"35*34\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"18\",\"goodsCateId\":\"35\",\"goodsUnitId\":\"17\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507697398');
INSERT INTO `vich_sys_log` VALUES ('1099', 'admin', 'MODIFY', 'Goods', '52', '{\"goodsId\":\"52\",\"goodsSn\":\"S00000029\",\"goodsName\":\"\\u5f97\\u529b\\u6587\\u4ef6\\u5939\",\"goodsSpec\":\"25*30*35 12\\u4e2a\\u7bb1\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"18\",\"goodsCateId\":\"36\",\"goodsUnitId\":\"18\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507697407');
INSERT INTO `vich_sys_log` VALUES ('1100', 'admin', 'MODIFY', 'Goods', '53', '{\"goodsId\":\"53\",\"goodsSn\":\"S00000030\",\"goodsName\":\"\\u62c9\\u6746\\u6587\\u4ef6\\u5939\\uff08\\u539a\\uff09\",\"goodsSpec\":\"32*34 10\\u53ea\\/\\u888b\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"18\",\"goodsCateId\":\"36\",\"goodsUnitId\":\"15\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507697417');
INSERT INTO `vich_sys_log` VALUES ('1101', 'admin', 'MODIFY', 'Goods', '54', '{\"goodsId\":\"54\",\"goodsSn\":\"S00000031\",\"goodsName\":\"\\u62c9\\u6746\\u6587\\u4ef6\\u5939\\uff08\\u8584\\uff09\",\"goodsSpec\":\"32*34 10\\u53ea\\/\\u888b\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"18\",\"goodsCateId\":\"36\",\"goodsUnitId\":\"15\",\"productionDate\":\"\",\"invalidDate\":\"\",\"searchKey\":\"\",\"remark\":\"\"}', '1507697426');
INSERT INTO `vich_sys_log` VALUES ('1102', 'admin', 'ADD', 'GoodsCats', '37', '{\"parentId\":\"0\",\"cateName\":\"\\u673a\\u7269\\u6599\",\"cateSort\":\"1\",\"cateNo\":\"135252\"}', '1507705523');
INSERT INTO `vich_sys_log` VALUES ('1103', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507709059');
INSERT INTO `vich_sys_log` VALUES ('1104', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507717227');
INSERT INTO `vich_sys_log` VALUES ('1105', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507769677');
INSERT INTO `vich_sys_log` VALUES ('1106', 'admin', 'ADD', 'Depot', '13', '{\"companyId\":\"0\",\"departmentId\":\"0\",\"employeeId\":\"11\",\"depotName\":\"11\",\"depotNo\":\"12\",\"isDefault\":\"0\",\"nonceStr\":\"OsfAdKhinEoOZHr8\"}', '1507779716');
INSERT INTO `vich_sys_log` VALUES ('1107', 'admin', 'DELETE', 'Depot', '13', '{\"depotId\":\"13\"}', '1507779722');
INSERT INTO `vich_sys_log` VALUES ('1108', 'admin', 'ADD', 'Depot', '1', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"13\",\"depotName\":\"\\u4ed3\\u5e9301\",\"depotNo\":\"A1221465464165\",\"isDefault\":\"0\",\"depotId\":\"10\",\"nonceStr\":\"4U726IkrqUhdAyf9\"}', '1507779780');
INSERT INTO `vich_sys_log` VALUES ('1109', 'admin', 'ADD', 'Depot', '1', '{\"companyId\":\"0\",\"departmentId\":\"0\",\"employeeId\":\"11\",\"depotName\":\"\\u4ed3\\u5e9303\",\"depotNo\":\"123456\",\"isDefault\":\"0\",\"depotId\":\"12\",\"nonceStr\":\"Tcn58lBri4lfttYr\"}', '1507783945');
INSERT INTO `vich_sys_log` VALUES ('1110', 'admin', 'ADD', 'Depot', '1', '{\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"13\",\"depotName\":\"\\u4ed3\\u5e9301\",\"depotNo\":\"132465\",\"isDefault\":\"0\",\"depotId\":\"10\",\"nonceStr\":\"oIqn3gvCroN6lpUf\"}', '1507783955');
INSERT INTO `vich_sys_log` VALUES ('1111', 'admin', 'ADD', 'Module', '13', '{\"module_name\":\"\\u9500\\u552e\\u7ba1\\u7406\",\"module_desc\":\"\",\"module_url\":\"\\/index.php\",\"module_sort\":1,\"module_icon\":\"icon-star\"}', '1507786140');
INSERT INTO `vich_sys_log` VALUES ('1112', 'admin', 'ADD', 'MenuUrl', '267', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\",\"menu_url\":\"\\/sales\\/index.php\",\"module_id\":\"13\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1507786166');
INSERT INTO `vich_sys_log` VALUES ('1113', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267\"}', '1507786174');
INSERT INTO `vich_sys_log` VALUES ('1114', 'admin', 'LOGIN', 'User', '', '\"\\u7528\\u6237\\u540d\\u6216\\u5bc6\\u7801\\u9519\\u8bef\"', '1507790279');
INSERT INTO `vich_sys_log` VALUES ('1115', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507790287');
INSERT INTO `vich_sys_log` VALUES ('1116', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507792711');
INSERT INTO `vich_sys_log` VALUES ('1117', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507801271');
INSERT INTO `vich_sys_log` VALUES ('1118', 'admin', 'MODIFY', 'Customer', '2', '{\"customerId\":\"2\",\"customerName\":\"\\u6d4b\\u8bd5\",\"customerAddress\":\"\\u4e2d\\u65872\",\"customerUserName\":\"\\u4e2d\\u6587\",\"customerUserPhone\":\"13912382811\",\"customerUserEmail\":\"11@qq.com\"}', '1507801510');
INSERT INTO `vich_sys_log` VALUES ('1119', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507946397');
INSERT INTO `vich_sys_log` VALUES ('1120', 'admin', 'ADD', 'MenuUrl', '268', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/sales\\/add.php\",\"module_id\":\"13\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\"}', '1507947242');
INSERT INTO `vich_sys_log` VALUES ('1121', 'admin', 'ADD', 'MenuUrl', '269', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\\u4fee\\u6539\",\"menu_url\":\"\\/sales\\/edit.php\",\"module_id\":\"13\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\"}', '1507947267');
INSERT INTO `vich_sys_log` VALUES ('1122', 'admin', 'ADD', 'MenuUrl', '270', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\\u5ba1\\u6838\",\"menu_url\":\"\\/sales\\/review.php\",\"module_id\":\"13\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\"}', '1507947292');
INSERT INTO `vich_sys_log` VALUES ('1123', 'admin', 'ADD', 'MenuUrl', '271', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\\u5220\\u9664\",\"menu_url\":\"\\/sales\\/del.php\",\"module_id\":\"13\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\"}', '1507947320');
INSERT INTO `vich_sys_log` VALUES ('1124', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271\"}', '1507947336');
INSERT INTO `vich_sys_log` VALUES ('1125', 'admin', 'ADD', 'MenuUrl', '272', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\\u8be6\\u60c5\",\"menu_url\":\"\\/sales\\/details.php\",\"module_id\":\"13\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\"}', '1507947647');
INSERT INTO `vich_sys_log` VALUES ('1126', 'admin', 'MODIFY', 'MenuUrl', '268', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\\u521b\\u5efa\",\"menu_url\":\"\\/sales\\/create.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\",\"module_id\":\"13\"}', '1507949246');
INSERT INTO `vich_sys_log` VALUES ('1127', 'admin', 'MODIFY', 'MenuUrl', '269', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\\u4fee\\u6539\\u4ea7\\u54c1\",\"menu_url\":\"\\/sales\\/edit.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\",\"module_id\":\"13\"}', '1507949298');
INSERT INTO `vich_sys_log` VALUES ('1128', 'admin', 'MODIFY', 'MenuUrl', '269', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\\u4ea7\\u54c1\\u4fee\\u6539\",\"menu_url\":\"\\/sales\\/edit.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\",\"module_id\":\"13\"}', '1507949320');
INSERT INTO `vich_sys_log` VALUES ('1129', 'admin', 'ADD', 'MenuUrl', '273', '{\"menu_name\":\"\\u9500\\u552e\\u8ba2\\u5355\\u4ea7\\u54c1\\u65b0\\u589e\",\"menu_url\":\"\\/sales\\/add.php\",\"module_id\":\"13\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\"}', '1507949358');
INSERT INTO `vich_sys_log` VALUES ('1130', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273\"}', '1507949365');
INSERT INTO `vich_sys_log` VALUES ('1131', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507950536');
INSERT INTO `vich_sys_log` VALUES ('1132', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1507972435');
INSERT INTO `vich_sys_log` VALUES ('1133', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508116045');
INSERT INTO `vich_sys_log` VALUES ('1134', 'admin', 'ADD', 'MenuUrl', '274', '{\"menu_name\":\"\\u5546\\u54c1\\u67e5\\u8be2\",\"menu_url\":\"\\/sales\\/goods_search.php\",\"module_id\":\"13\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\"}', '1508136510');
INSERT INTO `vich_sys_log` VALUES ('1135', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274\"}', '1508136548');
INSERT INTO `vich_sys_log` VALUES ('1136', 'admin', 'ADD', 'MenuUrl', '275', '{\"menu_name\":\"\\u63d0\\u4ea4\\u5ba1\\u6838\",\"menu_url\":\"\\/sales\\/to_review.php\",\"module_id\":\"13\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\"}', '1508136589');
INSERT INTO `vich_sys_log` VALUES ('1137', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275\"}', '1508136594');
INSERT INTO `vich_sys_log` VALUES ('1138', 'admin', 'ADD', 'MenuUrl', '276', '{\"menu_name\":\"\\u8ba2\\u5355\\u5546\\u54c1\\u5220\\u9664\",\"menu_url\":\"\\/sales\\/goods_del.php\",\"module_id\":\"13\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"267\"}', '1508148507');
INSERT INTO `vich_sys_log` VALUES ('1139', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276\"}', '1508148515');
INSERT INTO `vich_sys_log` VALUES ('1140', 'admin', 'MODIFY', 'MenuUrl', '144', '{\"menu_name\":\"\\u6750\\u6599\\u5165\\u5e93\\u3001\\u51fa\\u5e93\\u3001\\u76d8\\u5b58\\u660e\\u7ec6\\u8868\",\"menu_url\":\"\\/charts\\/suppliers.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1508150997');
INSERT INTO `vich_sys_log` VALUES ('1141', 'admin', 'MODIFY', 'MenuUrl', '145', '{\"menu_name\":\"\\u6750\\u6599\\u5165\\u5e93\\u3001\\u51fa\\u5e93\\u3001\\u76d8\\u5b58\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/charts\\/global.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1508151013');
INSERT INTO `vich_sys_log` VALUES ('1142', 'admin', 'LOGOUT', 'User', '1', '', '1508151015');
INSERT INTO `vich_sys_log` VALUES ('1143', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508204483');
INSERT INTO `vich_sys_log` VALUES ('1144', 'admin', 'MODIFY', 'MenuUrl', '148', '{\"menu_name\":\"\\u5e94\\u4ed8\\u6b3e\\u5355\\u6dfb\\u52a0\\u8d22\\u52a1\",\"menu_url\":\"\\/finance\\/pay_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"133\",\"module_id\":\"8\"}', '1508225454');
INSERT INTO `vich_sys_log` VALUES ('1145', 'admin', 'LOGOUT', 'User', '1', '', '1508229561');
INSERT INTO `vich_sys_log` VALUES ('1146', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508229568');
INSERT INTO `vich_sys_log` VALUES ('1147', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276\"}', '1508229615');
INSERT INTO `vich_sys_log` VALUES ('1148', 'admin', 'MODIFY', 'MenuUrl', '148', '{\"menu_name\":\"\\u5e94\\u4ed8\\u6b3e\\u5355\\u6dfb\\u52a0\\u8d22\\u52a1\",\"menu_url\":\"\\/finance\\/pay_add.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"133\",\"module_id\":\"8\"}', '1508229706');
INSERT INTO `vich_sys_log` VALUES ('1149', 'admin', 'ADD', 'MenuUrl', '277', '{\"menu_name\":\"\\u5e94\\u6536\\u8d26\\u6b3e\\u6dfb\\u52a0\\u8d22\\u52a1\",\"menu_url\":\"\\/finance\\/collect_add.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"150\"}', '1508230191');
INSERT INTO `vich_sys_log` VALUES ('1150', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277\"}', '1508230195');
INSERT INTO `vich_sys_log` VALUES ('1151', 'admin', 'MODIFY', 'MenuUrl', '134', '{\"menu_name\":\"\\u8d22\\u52a1\\u7ec6\\u8d26\\/\\u603b\\u8d26\",\"menu_url\":\"\\/finance\\/finance_detail.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"149\",\"module_id\":\"8\"}', '1508231390');
INSERT INTO `vich_sys_log` VALUES ('1152', 'admin', 'MODIFY', 'MenuUrl', '134', '{\"menu_name\":\"\\u8d22\\u52a1\\u8be6\\u60c5\",\"menu_url\":\"\\/finance\\/finance_detail.php\",\"is_show\":\"0\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"149\",\"module_id\":\"8\"}', '1508232079');
INSERT INTO `vich_sys_log` VALUES ('1153', 'admin', 'ADD', 'MenuUrl', '278', '{\"menu_name\":\"\\u6dfb\\u52a0\\u8d22\\u52a1\",\"menu_url\":\"\\/finance\\/finance_add.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"149\"}', '1508234383');
INSERT INTO `vich_sys_log` VALUES ('1154', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278\"}', '1508234389');
INSERT INTO `vich_sys_log` VALUES ('1155', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508290345');
INSERT INTO `vich_sys_log` VALUES ('1156', 'admin', 'ADD', 'MenuUrl', '279', '{\"menu_name\":\"\\u5e94\\u6536\\u6b3e\\u5355\\u6536\\u7968\",\"menu_url\":\"\\/finance\\/pay_collect.php\",\"module_id\":\"8\",\"is_show\":\"0\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"0\",\"father_menu\":\"150\"}', '1508293854');
INSERT INTO `vich_sys_log` VALUES ('1157', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278,279\"}', '1508293861');
INSERT INTO `vich_sys_log` VALUES ('1158', 'admin', 'LOGOUT', 'User', '1', '', '1508304129');
INSERT INTO `vich_sys_log` VALUES ('1159', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508304137');
INSERT INTO `vich_sys_log` VALUES ('1160', 'admin', 'LOGOUT', 'User', '1', '', '1508309686');
INSERT INTO `vich_sys_log` VALUES ('1161', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508309694');
INSERT INTO `vich_sys_log` VALUES ('1162', 'admin', 'LOGOUT', 'User', '1', '', '1508311634');
INSERT INTO `vich_sys_log` VALUES ('1163', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508311640');
INSERT INTO `vich_sys_log` VALUES ('1164', 'admin', 'LOGOUT', 'User', '1', '', '1508311653');
INSERT INTO `vich_sys_log` VALUES ('1165', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508311660');
INSERT INTO `vich_sys_log` VALUES ('1166', 'admin', 'LOGOUT', 'User', '1', '', '1508312812');
INSERT INTO `vich_sys_log` VALUES ('1167', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508312846');
INSERT INTO `vich_sys_log` VALUES ('1168', 'admin', 'LOGOUT', 'User', '1', '', '1508312872');
INSERT INTO `vich_sys_log` VALUES ('1169', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508312892');
INSERT INTO `vich_sys_log` VALUES ('1170', 'admin', 'LOGOUT', 'User', '1', '', '1508312929');
INSERT INTO `vich_sys_log` VALUES ('1171', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508312936');
INSERT INTO `vich_sys_log` VALUES ('1172', 'admin', 'LOGOUT', 'User', '1', '', '1508312954');
INSERT INTO `vich_sys_log` VALUES ('1173', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508312965');
INSERT INTO `vich_sys_log` VALUES ('1174', 'admin', 'LOGOUT', 'User', '1', '', '1508313058');
INSERT INTO `vich_sys_log` VALUES ('1175', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508313064');
INSERT INTO `vich_sys_log` VALUES ('1176', 'admin', 'LOGOUT', 'User', '1', '', '1508313130');
INSERT INTO `vich_sys_log` VALUES ('1177', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508313136');
INSERT INTO `vich_sys_log` VALUES ('1178', 'admin', 'LOGOUT', 'User', '1', '', '1508313640');
INSERT INTO `vich_sys_log` VALUES ('1179', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508313649');
INSERT INTO `vich_sys_log` VALUES ('1180', 'admin', 'LOGOUT', 'User', '1', '', '1508313674');
INSERT INTO `vich_sys_log` VALUES ('1181', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"127.0.0.1\"}', '1508461744');
INSERT INTO `vich_sys_log` VALUES ('1182', 'admin', 'ADD', 'MenuUrl', '280', '{\"menu_name\":\"\\u91c7\\u8d2d\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/chart\\/chart1.php\",\"module_id\":\"7\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1508462556');
INSERT INTO `vich_sys_log` VALUES ('1183', 'admin', 'ADD', 'MenuUrl', '281', '{\"menu_name\":\"\\u5e93\\u5b58\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/chart\\/chart2.php\",\"module_id\":\"7\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1508462568');
INSERT INTO `vich_sys_log` VALUES ('1184', 'admin', 'ADD', 'MenuUrl', '282', '{\"menu_name\":\"\\u9886\\u7528\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/chart\\/chart3.php\",\"module_id\":\"7\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1508462581');
INSERT INTO `vich_sys_log` VALUES ('1185', 'admin', 'ADD', 'MenuUrl', '283', '{\"menu_name\":\"\\u5165\\u5e93\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/chart\\/chart4.php\",\"module_id\":\"7\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1508462597');
INSERT INTO `vich_sys_log` VALUES ('1186', 'admin', 'MODIFY', 'MenuUrl', '282', '{\"menu_name\":\"\\u8c03\\u62e8\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/chart\\/chart3.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1508462675');
INSERT INTO `vich_sys_log` VALUES ('1187', 'admin', 'ADD', 'MenuUrl', '284', '{\"menu_name\":\"\\u51fa\\u5e93\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/chart\\/chart5.php\",\"module_id\":\"7\",\"is_show\":\"1\",\"online\":1,\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\"}', '1508462689');
INSERT INTO `vich_sys_log` VALUES ('1188', 'admin', 'MODIFY', 'UserGroup', '1', '{\"group_role\":\"1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278,279,280,281,282,283,284\"}', '1508462702');
INSERT INTO `vich_sys_log` VALUES ('1189', 'admin', 'MODIFY', 'MenuUrl', '280', '{\"menu_name\":\"\\u91c7\\u8d2d\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/charts\\/chart1.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1508462824');
INSERT INTO `vich_sys_log` VALUES ('1190', 'admin', 'MODIFY', 'MenuUrl', '281', '{\"menu_name\":\"\\u5e93\\u5b58\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/charts\\/chart2.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1508462836');
INSERT INTO `vich_sys_log` VALUES ('1191', 'admin', 'MODIFY', 'MenuUrl', '282', '{\"menu_name\":\"\\u8c03\\u62e8\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/charts\\/chart3.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1508462847');
INSERT INTO `vich_sys_log` VALUES ('1192', 'admin', 'MODIFY', 'MenuUrl', '283', '{\"menu_name\":\"\\u5165\\u5e93\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/charts\\/chart4.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1508462856');
INSERT INTO `vich_sys_log` VALUES ('1193', 'admin', 'MODIFY', 'MenuUrl', '284', '{\"menu_name\":\"\\u51fa\\u5e93\\u660e\\u7ec6\\/\\u6c47\\u603b\\u8868\",\"menu_url\":\"\\/charts\\/chart5.php\",\"is_show\":\"1\",\"online\":\"1\",\"menu_desc\":\"\",\"shortcut_allowed\":\"1\",\"father_menu\":\"0\",\"module_id\":\"7\"}', '1508462872');
INSERT INTO `vich_sys_log` VALUES ('1194', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"49.80.220.245\"}', '1509687386');
INSERT INTO `vich_sys_log` VALUES ('1195', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"49.80.220.245\"}', '1509688107');
INSERT INTO `vich_sys_log` VALUES ('1196', 'admin', 'ADD', 'User', '30', '{\"user_name\":\"kwe\",\"password\":\"\",\"real_name\":\"kwe\",\"mobile\":\"15698525235\",\"email\":\"15698525235@qq.com\",\"user_desc\":\"nnn\",\"user_group\":\"1\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"13\",\"selectAll\":\"0\"}', '1509691680');
INSERT INTO `vich_sys_log` VALUES ('1197', 'admin', 'MODIFY', 'User', '30', '{\"real_name\":\"kwe\",\"mobile\":\"15698525235\",\"email\":\"15698525235@qq.com\",\"user_desc\":\"nnn\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"13\",\"selectAll\":\"1\",\"user_group\":\"3\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"ip\":\"49.80.220.245\"}', '1509691709');
INSERT INTO `vich_sys_log` VALUES ('1198', 'admin', 'DELETE', 'User', '30', '{\"user_id\":\"30\",\"user_name\":\"kwe\",\"password\":null,\"real_name\":\"kwe\",\"mobile\":\"15698525235\",\"email\":\"15698525235@qq.com\",\"user_desc\":\"nnn\",\"login_time\":\"2017-11-03 14:49:03\",\"status\":\"1\",\"login_ip\":null,\"user_group\":\"3\",\"template\":\"default\",\"shortcuts\":null,\"show_quicknote\":\"0\",\"companyId\":\"32\",\"departmentId\":\"9\",\"employeeId\":\"13\",\"selectAll\":\"1\"}', '1509691743');
INSERT INTO `vich_sys_log` VALUES ('1199', 'admin', 'ADD', 'UserGroup', '8', '{\"group_name\":\"kwe\",\"group_desc\":\"nnn\",\"group_role\":\"1,5,17,18,22,23,24,25\",\"owner_id\":\"1\"}', '1509691762');
INSERT INTO `vich_sys_log` VALUES ('1200', 'admin', 'MODIFY', 'UserGroup', '8', '{\"group_name\":\"kwe\",\"group_desc\":\"nnn\"}', '1509691834');
INSERT INTO `vich_sys_log` VALUES ('1201', 'admin', 'DELETE', 'UserGroup', '8', '{\"group_id\":\"8\",\"group_name\":\"kwe\",\"group_role\":\"1,5,17,18,22,23,24,25\",\"owner_id\":\"1\",\"group_desc\":\"nnn\"}', '1509691874');
INSERT INTO `vich_sys_log` VALUES ('1202', 'admin', 'ADD', 'QuickNote', '1', '{\"note_content\":\"\\u901f\\u5ea6\",\"owner_id\":\"1\"}', '1509692078');
INSERT INTO `vich_sys_log` VALUES ('1203', 'admin', 'DELETE', 'QuickNote', '1', '{\"note_id\":\"1\",\"note_content\":\"\\u901f\\u5ea6\",\"owner_id\":\"1\"}', '1509692092');
INSERT INTO `vich_sys_log` VALUES ('1204', 'admin', 'ADD', 'MsgSetting', '9', '{\"depotId\":\"10\",\"depotSubId\":\"6\",\"goodsCateId\":\"24\",\"goodsId\":\"25\",\"minWarnNum\":\"20\"}', '1509692260');
INSERT INTO `vich_sys_log` VALUES ('1205', 'admin', 'MODIFY', 'MsgSetting', '9', '{\"depotId\":\"10\",\"depotSubId\":\"6\",\"goodsCateId\":\"24\",\"goodsId\":\"27\",\"minWarnNum\":\"20\"}', '1509692282');
INSERT INTO `vich_sys_log` VALUES ('1206', 'admin', 'DELETE', 'MsgSetting', 'a:1:{i:0;s:1:\"9\";}', '{\"flag\":-1}', '1509692293');
INSERT INTO `vich_sys_log` VALUES ('1207', 'admin', 'ADD', 'MsgSetting', '6', '{\"goodsCateId\":\"35\",\"goodsId\":\"51\",\"upPercent\":\"15\",\"downPercent\":\"15\"}', '1509692454');
INSERT INTO `vich_sys_log` VALUES ('1208', 'admin', 'MODIFY', 'MsgSetting', '6', '{\"goodsCateId\":\"34\",\"goodsId\":\"51\",\"upPercent\":\"15.00\",\"downPercent\":\"15.00\"}', '1509692525');
INSERT INTO `vich_sys_log` VALUES ('1209', 'admin', 'DELETE', 'MsgSetting', 'a:1:{i:0;s:1:\"6\";}', '{\"flag\":-1}', '1509692535');
INSERT INTO `vich_sys_log` VALUES ('1210', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1509692722');
INSERT INTO `vich_sys_log` VALUES ('1211', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"S00000032\",\"goodsBarCode\":\"1502174035\",\"goodsName\":\"\\u6587\\u4ef6\\u5939\",\"goodsSpec\":\"25*35\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"18\",\"goodsCateId\":\"36\",\"goodsUnitId\":\"11\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-11-01\",\"invalidDate\":\"2017-11-16\",\"searchKey\":\"\",\"remark\":\"\",\"nonceStr\":\"BrybgGVLh8tOJJ3x\"}', '1509692783');
INSERT INTO `vich_sys_log` VALUES ('1212', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.10\"}', '1509692828');
INSERT INTO `vich_sys_log` VALUES ('1213', 'admin', 'ADD', 'GoodsCats', '38', '{\"parentId\":\"16\",\"cateName\":\"\\u6a61\\u76ae\",\"cateSort\":\"1\",\"cateNo\":\"020\"}', '1509692866');
INSERT INTO `vich_sys_log` VALUES ('1214', 'admin', 'ADD', 'Supplier', '13', '{\"supplierName\":\"\\u6d4b\\u8bd5\\u4f9b\",\"supplierAddress\":\"\\u6d4b\\u8bd5\\u4f9b\\u6d4b\\u8bd5\\u4f9b\",\"supplierTel\":\"010-9999999\",\"supplierUserName\":\"\\u94b1\\u4e8c\",\"supplierUserPhone\":\"13696569566\",\"supplierUserEmail\":\"1258944569@qq.com\",\"supplierUserQQ\":\"58944569\",\"bankName\":\"\\u94f6\\u884c\",\"bankOpenName\":\"\\u94f6\\u884c\",\"cardUserName\":\"\\u94b1\\u4e8c\",\"cardUserPhone\":\"13696569566\",\"bankAccount\":\"6214832136673428\",\"cardMoney\":\"0\",\"reviewer\":\"1\",\"remark\":\"\",\"nonceStr\":\"Z8aZi6XPlaW2Bmvg\"}', '1509693277');
INSERT INTO `vich_sys_log` VALUES ('1215', 'admin', 'REVIEW', 'Suppliers', '13', '{\"flag\":\"1\",\"supplerId\":\"13\"}', '1509693303');
INSERT INTO `vich_sys_log` VALUES ('1216', 'admin', 'DELETE', 'Suppliers', '13', '\"13\"', '1509693316');
INSERT INTO `vich_sys_log` VALUES ('1217', 'admin', 'ADD', 'Employee', '22', '{\"companyId\":\"32\",\"departmentId\":\"11\",\"employeeName\":\"\\u674e\\u4e8c\",\"employeeAddress\":\"**************\",\"employeePhone\":\"13589568955\",\"employeeEmail\":\"13589568955@qq.com\",\"employeeQQ\":\"13589568955\",\"employeeJob\":\"\\u91c7\\u8d2d\\u5458\",\"nonceStr\":\"mWPdA5jG7TUM1M3D\"}', '1509693396');
INSERT INTO `vich_sys_log` VALUES ('1218', 'admin', 'ADD', 'Company', '39', '{\"companyName\":\"\\u65e0\\u9521\\u5218\\u6f6d\\u670d\\u88c5\\u6709\\u9650\\u516c\\u53f8\",\"companyAddress\":\"\\u6709\\u9650\\u516c\\u53f8\",\"companyTel\":\"05108899778\",\"companyUserName\":\"\\u674e\\u4e8c\",\"companyUserPhone\":\"13589569885\",\"companyUserEmail\":\"13589569885@qq.com\",\"companyUserQQ\":\"13589569885\",\"nonceStr\":\"u2JK8iGR1onagDyO\"}', '1509693518');
INSERT INTO `vich_sys_log` VALUES ('1219', 'admin', 'ADD', 'Depot', '14', '{\"companyId\":\"32\",\"departmentId\":\"11\",\"employeeId\":\"20\",\"depotName\":\"\\u4ed3\\u5e9304\",\"depotNo\":\"G1\",\"isDefault\":\"0\",\"nonceStr\":\"JDsyemLJP7dsVxOG\"}', '1509693687');
INSERT INTO `vich_sys_log` VALUES ('1220', 'admin', 'ADD', 'DepotSub', '12', '{\"depotId\":\"14\",\"depotSubId\":\"12\",\"depotSubName\":\"G\\u5e93\\u4f4d\",\"companyId\":\"32\"}', '1509693725');
INSERT INTO `vich_sys_log` VALUES ('1221', 'admin', 'DELETE', 'DepotSub', '12', '{\"depotSubId\":\"12\"}', '1509693764');
INSERT INTO `vich_sys_log` VALUES ('1222', 'admin', 'DELETE', 'Depot', '14', '{\"depotId\":\"14\"}', '1509693770');
INSERT INTO `vich_sys_log` VALUES ('1223', 'admin', 'ADD', 'GoodsUnit', '19', '{\"unitName\":\"\\u74f6\",\"nonceStr\":\"CbK0uiWdWfInkCSt\"}', '1509693807');
INSERT INTO `vich_sys_log` VALUES ('1224', 'admin', 'ADD', 'Customer', '3', '{\"customerName\":\"\\u6d4b\\u8bd51\",\"customerAddress\":\"\\u6d4b\\u8bd52\",\"customerUserName\":\"\\u6d4b\\u8bd5\",\"customerUserPhone\":\"13584617265\",\"customerUserEmail\":\"13584617265@qq.com\",\"nonceStr\":\"xzsZyoyEJgM6aas7\"}', '1509693875');
INSERT INTO `vich_sys_log` VALUES ('1225', 'admin', 'DELETE', 'Customer', '3', '\"3\"', '1509693891');
INSERT INTO `vich_sys_log` VALUES ('1226', 'admin', 'MODIFY', 'MsgSetting', '4', '{\"goodsCateId\":\"16\",\"goodsId\":\"\",\"upPercent\":\"15.00\",\"downPercent\":\"5.00\"}', '1509695418');
INSERT INTO `vich_sys_log` VALUES ('1227', 'admin', 'DELETE', 'GoodsCate', '38', '\"38\"', '1509695629');
INSERT INTO `vich_sys_log` VALUES ('1228', 'admin', 'ADD', 'MsgSetting', '10', '{\"depotId\":\"10\",\"depotSubId\":\"6\",\"goodsCateId\":\"32\",\"goodsId\":\"47\",\"minWarnNum\":\"10\"}', '1509695703');
INSERT INTO `vich_sys_log` VALUES ('1229', 'admin', 'ADD', 'MsgSetting', '7', '{\"goodsCateId\":\"24\",\"goodsId\":\"36\",\"upPercent\":\"15\",\"downPercent\":\"20\"}', '1509695806');
INSERT INTO `vich_sys_log` VALUES ('1230', 'admin', 'ADD', 'MsgSetting', '8', '{\"goodsCateId\":\"33\",\"goodsId\":\"49\",\"upPercent\":\"20\",\"downPercent\":\"20\"}', '1509695854');
INSERT INTO `vich_sys_log` VALUES ('1231', 'admin', 'DELETE', 'MsgSetting', 'a:1:{i:0;s:1:\"8\";}', '{\"flag\":-1}', '1509695863');
INSERT INTO `vich_sys_log` VALUES ('1232', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1509695977');
INSERT INTO `vich_sys_log` VALUES ('1233', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"192.168.0.100\"}', '1509695979');
INSERT INTO `vich_sys_log` VALUES ('1234', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"49.80.220.245\"}', '1509755772');
INSERT INTO `vich_sys_log` VALUES ('1235', 'admin', 'ADD', 'MsgSetting', '9', '{\"goodsCateId\":\"24\",\"goodsId\":\"28\",\"upPercent\":\"10\",\"downPercent\":\"10\"}', '1509755844');
INSERT INTO `vich_sys_log` VALUES ('1236', 'admin', 'LOGIN', 'User', '1', '{\"IP\":\"::1\"}', '1509759746');
INSERT INTO `vich_sys_log` VALUES ('1237', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"102222222\",\"goodsBarCode\":\"1502174036\",\"goodsName\":\"\\u6d4b\\u8bd5\\u5546\\u54c1\",\"goodsSpec\":\"1cm\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"24\",\"goodsUnitId\":\"11\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-09-13\",\"invalidDate\":\"2017-11-22\",\"searchKey\":\"\",\"remark\":\"\",\"nonceStr\":\"Zl0IBTeaMV0HCtty\"}', '1509760347');
INSERT INTO `vich_sys_log` VALUES ('1238', 'admin', 'ADD', 'Goods', '', '{\"goodsSn\":\"33333333\",\"goodsBarCode\":\"1502174037\",\"goodsName\":\"\\u6d4b\\u8bd5\\u5546\\u54c12\",\"goodsSpec\":\"2cm\",\"goodsCateId1\":\"22\",\"goodsCateId2\":\"16\",\"goodsCateId\":\"23\",\"goodsUnitId\":\"11\",\"lastPrice\":\"0\",\"minPrice\":\"0\",\"maxPrice\":\"0\",\"avgPrice\":\"0\",\"productionDate\":\"2017-11-01\",\"invalidDate\":\"2017-11-07\",\"searchKey\":\"\",\"remark\":\"\",\"nonceStr\":\"M7hADJKwMWGaRkRx\"}', '1509760811');
INSERT INTO `vich_sys_log` VALUES ('1239', 'admin', 'ADD', 'GoodsCats', '39', '{\"parentId\":\"16\",\"cateName\":\"\\u6bdb\\u7b14\",\"cateSort\":\"1\",\"cateNo\":\"29831231\"}', '1509760890');
INSERT INTO `vich_sys_log` VALUES ('1240', 'admin', 'DELETE', 'GoodsCate', '39', '\"39\"', '1509760912');
INSERT INTO `vich_sys_log` VALUES ('1241', 'admin', 'ADD', 'Company', '40', '{\"companyName\":\"\\u6d4b\\u8bd5\",\"companyAddress\":\"\\u6d4b\\u8bd5\",\"companyTel\":\"0510-6666666\",\"companyUserName\":\"\\u6d4b\\u8bd5\",\"companyUserPhone\":\"13564111240\",\"companyUserEmail\":\"13564111240@qq.com\",\"companyUserQQ\":\"907914683\",\"nonceStr\":\"VIRAW61EQWVcWmoi\"}', '1509761014');

-- ----------------------------
-- Table structure for `vich_user`
-- ----------------------------
DROP TABLE IF EXISTS `vich_user`;
CREATE TABLE `vich_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_desc` varchar(255) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL COMMENT '登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `login_ip` varchar(32) DEFAULT NULL,
  `user_group` int(11) NOT NULL,
  `template` varchar(32) NOT NULL DEFAULT 'default' COMMENT '主题模板',
  `shortcuts` text COMMENT '快捷菜单',
  `show_quicknote` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示quicknote',
  `companyId` int(11) NOT NULL COMMENT '公司ID',
  `departmentId` int(11) NOT NULL COMMENT '部门ID',
  `employeeId` int(11) NOT NULL COMMENT '员工ID',
  `selectAll` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='后台用户';

-- ----------------------------
-- Records of vich_user
-- ----------------------------
INSERT INTO `vich_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'SomewhereYu', '13800138001', 'admin@osadmin.org', '初始的超级管理员!', '1509759746', '1', '::1', '1', 'default', '2,7,10,11,13,14,18,21,24', '0', '32', '9', '15', '0');
INSERT INTO `vich_user` VALUES ('28', 'CG01', 'e10adc3949ba59abbe56e057f20f883e', '采购员一', '13666666666', '13666666666@163.com', '采购测试账号', '1506137633', '1', '127.0.0.1', '2', 'default', null, '0', '32', '11', '20', '0');
INSERT INTO `vich_user` VALUES ('29', 'kucun', 'e10adc3949ba59abbe56e057f20f883e', '库存', '13666666666', '13666666666@163.com', '库存管理', null, '1', null, '4', 'default', null, '0', '32', '12', '11', '0');

-- ----------------------------
-- Table structure for `vich_user_group`
-- ----------------------------
DROP TABLE IF EXISTS `vich_user_group`;
CREATE TABLE `vich_user_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(32) DEFAULT NULL,
  `group_role` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '初始权限为1,5,17,18,22,23,24,25',
  `owner_id` int(11) DEFAULT NULL COMMENT '创建人ID',
  `group_desc` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='账号组';

-- ----------------------------
-- Records of vich_user_group
-- ----------------------------
INSERT INTO `vich_user_group` VALUES ('1', '超级管理员组', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,137,138,139,140,141,142,143,144,145,148,149,150,151,152,153,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278,279,280,281,282,283,284', '1', '万能的不是神，是程序员');
INSERT INTO `vich_user_group` VALUES ('2', '采购', '1,5,20,23,176,177,178,259,260,261,262,263,264,265,266,126,127,128,129,130,131,132,161,163,182,183,184,203,204,205,206,207,208,209,210,228,229,230,236,237,238,244,245,246,142,143,144,145', '1', '采购组');
INSERT INTO `vich_user_group` VALUES ('3', '财务', '1,5,17,18,22,23,24,25', '1', '财务');
INSERT INTO `vich_user_group` VALUES ('4', '仓库', '1,5,23,176,177,178,135,137,138,139,140,141,162,164,165,166,192,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,231,232,233,234,235,239,240,241,242,243,247,248,249,250,251,252,253', '1', '仓库');
INSERT INTO `vich_user_group` VALUES ('5', '仓库审核', '1,5,23,176,177,178,196,197,198,199,200,201,202', '1', '');
INSERT INTO `vich_user_group` VALUES ('6', '采购审核', '1,5,23,176,177,178,131,132,163,182,183,193,194,195', '1', '采购审核');
INSERT INTO `vich_user_group` VALUES ('7', '总经理', '1,5,17,18,22,23,24,25', '1', '总经理');
