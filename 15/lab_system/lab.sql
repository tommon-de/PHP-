/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : lab

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-08 08:15:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `s_class`
-- ----------------------------
DROP TABLE IF EXISTS `s_class`;
CREATE TABLE `s_class` (
  `c_id` varchar(6) NOT NULL,
  `c_name` varchar(30) NOT NULL,
  `c_stu_num` int(100) NOT NULL,
  `c_master` varchar(8) NOT NULL,
  `c_type` int(1) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_class
-- ----------------------------
INSERT INTO `s_class` VALUES ('C16F37', '16移动应用开发1班', '32', '张根海', '0');
INSERT INTO `s_class` VALUES ('C16F38', '16移动应用开发2班', '36', '林世鑫', '0');
INSERT INTO `s_class` VALUES ('Z16F34', '16网络技术3+2班', '57', '官凤林', '0');
INSERT INTO `s_class` VALUES ('C17F38', '17移动应用开发', '40', '杜华英', '0');
INSERT INTO `s_class` VALUES ('C16F29', '16网络技术', '40', '林海', '0');
INSERT INTO `s_class` VALUES ('C16F33', '16电子商务', '45', '周运姐', '0');
INSERT INTO `s_class` VALUES ('Z16F30', '16中职网络技术', '62', '邓老师', '0');
INSERT INTO `s_class` VALUES ('Z17F27', '电子商务中职', '62', '黄老师', '0');
INSERT INTO `s_class` VALUES ('Z16F29', '16网络清华万博班', '62', '刘老师', '0');
INSERT INTO `s_class` VALUES ('C16F31', '16网络技术2班', '40', '余老师', '0');
INSERT INTO `s_class` VALUES ('C16F32', '16电子商务1班', '43', '杨老师', '0');
INSERT INTO `s_class` VALUES ('C15F33', '15网络技术班', '42', '张老师', '0');
INSERT INTO `s_class` VALUES ('Z17F25', '17计算机应用班', '62', '郭老师', '0');
INSERT INTO `s_class` VALUES ('Z16J48', '16机电工程班', '61', '李老师', '0');

-- ----------------------------
-- Table structure for `s_class_plan`
-- ----------------------------
DROP TABLE IF EXISTS `s_class_plan`;
CREATE TABLE `s_class_plan` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_shi_id` varchar(6) NOT NULL,
  `p_xingqi` int(1) NOT NULL,
  `p_class_id` varchar(6) NOT NULL,
  `p_lesson` varchar(30) NOT NULL,
  `p_teacher_id` int(1) NOT NULL,
  `p_node` varchar(4) NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `index_id` (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_class_plan
-- ----------------------------
INSERT INTO `s_class_plan` VALUES ('5', '16-606', '1', 'c16f37', 'PHP移动应用开发', '1', '12');
INSERT INTO `s_class_plan` VALUES ('6', '16-606', '2', 'c16f38', 'PHP移动应用开发', '1', '12');
INSERT INTO `s_class_plan` VALUES ('7', '16-606', '1', 'c16f37', 'PHP移动应用开发', '1', '34');
INSERT INTO `s_class_plan` VALUES ('8', '16-606', '2', 'c16f38', 'PHP移动应用开发', '1', '34');
INSERT INTO `s_class_plan` VALUES ('9', '16-606', '1', 'Z16F30', '平面设计师模块(2)', '25', '56');
INSERT INTO `s_class_plan` VALUES ('10', '16-606', '1', 'Z16F30', '平面设计师模块(2)', '25', '78');
INSERT INTO `s_class_plan` VALUES ('11', '16-606', '2', 'Z16F34', '常用工具软件', '27', '56');
INSERT INTO `s_class_plan` VALUES ('12', '16-606', '3', 'Z17F27', '计算机文字录入处理员', '31', '12');
INSERT INTO `s_class_plan` VALUES ('13', '16-606', '3', 'Z16F29', '电子商务基础', '29', '34');
INSERT INTO `s_class_plan` VALUES ('14', '16-606', '3', 'Z16F30', '主题（新闻）类网站设计', '30', '56');
INSERT INTO `s_class_plan` VALUES ('15', '16-606', '3', 'Z16F30', '主题（新闻）类网站设计', '30', '78');
INSERT INTO `s_class_plan` VALUES ('16', '16-606', '4', 'C16F31', '网页编辑与美化', '26', '12');
INSERT INTO `s_class_plan` VALUES ('17', '16-606', '4', 'C16F31', '网页编辑与美化', '26', '34');
INSERT INTO `s_class_plan` VALUES ('18', '16-606', '4', 'C16F32', '网页编辑与美化', '26', '56');
INSERT INTO `s_class_plan` VALUES ('19', '16-606', '4', 'C16F32', '网页编辑与美化', '26', '78');
INSERT INTO `s_class_plan` VALUES ('20', '16-606', '5', 'C15F33', '网络综合布线', '32', '12');
INSERT INTO `s_class_plan` VALUES ('21', '16-606', '5', 'Z17F25', '数码照片处理', '33', '34');

-- ----------------------------
-- Table structure for `s_machine`
-- ----------------------------
DROP TABLE IF EXISTS `s_machine`;
CREATE TABLE `s_machine` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(20) NOT NULL,
  `m_bujian` varchar(50) NOT NULL,
  `m_shi_id` varchar(6) NOT NULL,
  PRIMARY KEY (`m_id`),
  UNIQUE KEY `index_id` (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_machine
-- ----------------------------
INSERT INTO `s_machine` VALUES ('1', 'pc_01', '显示器', '16-606');
INSERT INTO `s_machine` VALUES ('2', 'pc_01', '鼠标', '16-606');
INSERT INTO `s_machine` VALUES ('3', 'pc_01', '键盘', '16-606');
INSERT INTO `s_machine` VALUES ('4', 'pc_01', '主机', '16-606');
INSERT INTO `s_machine` VALUES ('5', 'pc_02', '显示器', '16-606');
INSERT INTO `s_machine` VALUES ('6', 'pc_02', '鼠标', '16-606');
INSERT INTO `s_machine` VALUES ('7', 'pc_02', '键盘', '16-606');
INSERT INTO `s_machine` VALUES ('8', 'pc_02', '主机', '16-606');
INSERT INTO `s_machine` VALUES ('9', 'pc_03', '主机', '16-606');
INSERT INTO `s_machine` VALUES ('10', 'pc_03', '键盘', '16-606');
INSERT INTO `s_machine` VALUES ('11', 'pc_03', '鼠标', '16-606');
INSERT INTO `s_machine` VALUES ('13', 'pc_teacher', '显示器', '16-606');
INSERT INTO `s_machine` VALUES ('14', 'pc_teacher', '键盘', '16-606');
INSERT INTO `s_machine` VALUES ('15', 'pc_teacher', '鼠标', '16-606');
INSERT INTO `s_machine` VALUES ('16', 'pc_teacher', '主机', '16-606');
INSERT INTO `s_machine` VALUES ('20', 'pc_01', '网络', '16-606');
INSERT INTO `s_machine` VALUES ('21', 'pc_02', '网络', '16-606');
INSERT INTO `s_machine` VALUES ('22', 'pc_03', '网络', '16-606');
INSERT INTO `s_machine` VALUES ('23', 'pc_个人计算机-01', '音箱', '16-606');

-- ----------------------------
-- Table structure for `s_shixunshi`
-- ----------------------------
DROP TABLE IF EXISTS `s_shixunshi`;
CREATE TABLE `s_shixunshi` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_shi_index` varchar(6) NOT NULL,
  `s_shi_seats` int(2) NOT NULL,
  `s_shi_finish_time` date NOT NULL,
  `s_shi_admin` int(11) NOT NULL,
  `s_shi_machine_name` varchar(50) NOT NULL,
  `s_shi_machine_type` varchar(50) NOT NULL,
  `s_shi_machine_num` int(3) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_shixunshi
-- ----------------------------
INSERT INTO `s_shixunshi` VALUES ('1', '16-606', '58', '2017-09-14', '2', 'pc_个人计算机', '联想-k235', '60');
INSERT INTO `s_shixunshi` VALUES ('2', '16-210', '60', '2017-09-14', '20', 'pc_个人计算机', '联想-k235', '60');
INSERT INTO `s_shixunshi` VALUES ('3', '16-313', '58', '2017-09-01', '6', 'pc学生机', '联想T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('4', '16-314', '60', '2017-09-01', '6', 'pc学生机', 'lenovo-pc204B', '62');
INSERT INTO `s_shixunshi` VALUES ('5', '7-206', '58', '2017-09-01', '16', 'pc学生机', '联想T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('6', '7-204', '58', '2017-09-01', '10', 'pc学生机', '联想T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('7', '16-406', '30', '2017-09-01', '22', '网络硬设', '神州数码+华为路由', '36');
INSERT INTO `s_shixunshi` VALUES ('8', '7-208', '60', '2017-09-01', '12', 'pc学生机', '联想T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('9', '7-209', '60', '2017-09-01', '13', 'pc学生机', 'lenovoTB2-kb23', '62');
INSERT INTO `s_shixunshi` VALUES ('10', '7-309', '58', '2017-09-01', '14', 'pc会计实训机', '联想T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('11', '7-310', '58', '2017-10-05', '15', 'pc学生机', 'lenovo-T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('12', '7-110', '58', '2017-09-01', '16', 'pc学生机', '联想T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('13', '16-306', '58', '2017-09-01', '21', 'pc学生机', '联想T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('16', '16-407', '60', '2017-09-01', '17', 'pc学生机', '联想T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('17', '16-506', '60', '2017-09-01', '23', '锐捷网络', 'RuiJie-net123-32', '60');
INSERT INTO `s_shixunshi` VALUES ('18', '16-511', '58', '2017-08-05', '24', 'pc电商一体机', '联想B2-ye23', '60');
INSERT INTO `s_shixunshi` VALUES ('19', '16-612', '60', '2017-09-01', '11', 'pc学生计算机', '联想T2-kb23', '60');
INSERT INTO `s_shixunshi` VALUES ('20', '16-613', '60', '2017-09-01', '9', 'pc学生计算机', '联想E2-kb23', '60');

-- ----------------------------
-- Table structure for `s_user`
-- ----------------------------
DROP TABLE IF EXISTS `s_user`;
CREATE TABLE `s_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(20) NOT NULL,
  `u_pass` varchar(200) NOT NULL,
  `u_true_name` varchar(8) NOT NULL,
  `u_right` int(1) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_user
-- ----------------------------
INSERT INTO `s_user` VALUES ('1', 'linshixin', 'e10adc3949ba59abbe56e057f20f883e', '林世鑫', '3');
INSERT INTO `s_user` VALUES ('2', 'luyonghao', 'e10adc3949ba59abbe56e057f20f883e', '吕永豪', '2');
INSERT INTO `s_user` VALUES ('3', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '实训中心', '1');
INSERT INTO `s_user` VALUES ('5', 'zhanggenghai', 'e10adc3949ba59abbe56e057f20f883e', '张根海', '3');
INSERT INTO `s_user` VALUES ('6', 'huangchengyong', 'e10adc3949ba59abbe56e057f20f883e', '黄承用', '2');
INSERT INTO `s_user` VALUES ('7', 'lijingfeng', 'e10adc3949ba59abbe56e057f20f883e', '李金峰', '3');
INSERT INTO `s_user` VALUES ('8', 'liyuan', 'e10adc3949ba59abbe56e057f20f883e', '李圆', '3');
INSERT INTO `s_user` VALUES ('9', 'libingjie', 'e10adc3949ba59abbe56e057f20f883e', '李宾杰', '2');
INSERT INTO `s_user` VALUES ('10', 'zhengwenyang', 'e10adc3949ba59abbe56e057f20f883e', '曾文洋', '2');
INSERT INTO `s_user` VALUES ('11', 'linkairu', 'e10adc3949ba59abbe56e057f20f883e', '林凯如', '2');
INSERT INTO `s_user` VALUES ('12', 'luxudong', 'e10adc3949ba59abbe56e057f20f883e', '黎旭东', '2');
INSERT INTO `s_user` VALUES ('13', 'huangjunyong', 'e10adc3949ba59abbe56e057f20f883e', '黄俊荣', '2');
INSERT INTO `s_user` VALUES ('14', 'zhangzhipiao', 'e10adc3949ba59abbe56e057f20f883e', '张志漂', '2');
INSERT INTO `s_user` VALUES ('15', 'huangxiaoxia', 'e10adc3949ba59abbe56e057f20f883e', '黄晓霞', '2');
INSERT INTO `s_user` VALUES ('16', 'liangfuyong', 'e10adc3949ba59abbe56e057f20f883e', '梁富荣', '2');
INSERT INTO `s_user` VALUES ('17', 'yezhibing', 'e10adc3949ba59abbe56e057f20f883e', '叶智彬', '2');
INSERT INTO `s_user` VALUES ('18', 'liazhiyang', 'e10adc3949ba59abbe56e057f20f883e', ' 赖志洋', '2');
INSERT INTO `s_user` VALUES ('19', 'huangzhixin', 'e10adc3949ba59abbe56e057f20f883e', '黄志鑫', '2');
INSERT INTO `s_user` VALUES ('20', 'wubing', 'e10adc3949ba59abbe56e057f20f883e', '吴斌', '2');
INSERT INTO `s_user` VALUES ('21', 'qiuzhengfu', 'e10adc3949ba59abbe56e057f20f883e', '邱振孚', '2');
INSERT INTO `s_user` VALUES ('22', 'dengzhiqi', 'e10adc3949ba59abbe56e057f20f883e', '邓智琦', '2');
INSERT INTO `s_user` VALUES ('23', 'zhangzheqiang', 'e10adc3949ba59abbe56e057f20f883e', '张泽祥', '2');
INSERT INTO `s_user` VALUES ('24', 'linzhiqian', 'e10adc3949ba59abbe56e057f20f883e', '林志贤', '2');
INSERT INTO `s_user` VALUES ('25', 'wengzhuqing', 'e10adc3949ba59abbe56e057f20f883e', '文祝青', '3');
INSERT INTO `s_user` VALUES ('26', 'yangyanhua', 'e10adc3949ba59abbe56e057f20f883e', '杨延华', '3');
INSERT INTO `s_user` VALUES ('27', 'dengxinye', 'e10adc3949ba59abbe56e057f20f883e', '邓新跃', '3');
INSERT INTO `s_user` VALUES ('28', 'huangyidao', 'e10adc3949ba59abbe56e057f20f883e', '黄逸道', '3');
INSERT INTO `s_user` VALUES ('29', 'wangying', 'e10adc3949ba59abbe56e057f20f883e', '王莹', '3');
INSERT INTO `s_user` VALUES ('30', 'zhengfeibi', 'e10adc3949ba59abbe56e057f20f883e', '曾飞碧', '3');
INSERT INTO `s_user` VALUES ('31', 'hewudai', 'e10adc3949ba59abbe56e057f20f883e', '何伍带', '3');
INSERT INTO `s_user` VALUES ('32', 'qingweiqiang', 'e10adc3949ba59abbe56e057f20f883e', '覃伟强', '3');
INSERT INTO `s_user` VALUES ('33', 'tangxiaofeng', 'e10adc3949ba59abbe56e057f20f883e', '谭晓峰', '3');

-- ----------------------------
-- Table structure for `s_using_list`
-- ----------------------------
DROP TABLE IF EXISTS `s_using_list`;
CREATE TABLE `s_using_list` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_shi_id` varchar(6) NOT NULL,
  `l_m_name` varchar(20) NOT NULL,
  `l_c_name` varchar(20) NOT NULL,
  `l_m_pro` varchar(30) NOT NULL,
  `l_zhou` int(1) NOT NULL,
  `l_xingqi` int(2) NOT NULL,
  `l_node` varchar(4) NOT NULL,
  `l_class` varchar(6) NOT NULL,
  `l_teacher` varchar(8) NOT NULL,
  `l_time` datetime NOT NULL,
  PRIMARY KEY (`l_id`),
  UNIQUE KEY `index_id` (`l_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_using_list
-- ----------------------------
INSERT INTO `s_using_list` VALUES ('1', '16-606', '全部', '全部', '正常', '1', '1', '12', 'c16f37', '林世鑫', '2018-01-01 10:01:37');
INSERT INTO `s_using_list` VALUES ('2', '16-606', 'pc_01', '鼠标', '故障', '1', '1', '34', 'c16f37', '林世鑫', '2018-01-01 10:01:42');
INSERT INTO `s_using_list` VALUES ('3', '16-606', 'pc_02', '键盘', '故障', '1', '1', '34', 'c16f37', '林世鑫', '2018-01-01 10:01:45');
INSERT INTO `s_using_list` VALUES ('4', '16-606', 'pc_03', '音箱', '故障', '1', '1', '34', 'c16f37', '林世鑫', '2018-01-01 10:01:48');
INSERT INTO `s_using_list` VALUES ('5', '16-606', 'pc_teacher', '网络', '故障', '1', '2', '12', 'c16f38', '林世鑫', '2018-01-01 10:22:12');
INSERT INTO `s_using_list` VALUES ('6', '16-606', '全部', '全部', '正常', '2', '1', '12', 'c16f37', '林世鑫', '2018-01-01 10:38:01');
INSERT INTO `s_using_list` VALUES ('7', '16-606', '全部', '全部', '正常', '3', '1', '12', 'c16f37', '林世鑫', '2018-01-01 10:40:00');
INSERT INTO `s_using_list` VALUES ('8', '16-606', 'pc_01', '显示器', '故障', '7', '2', '12', 'c16f38', '林世鑫', '2018-01-01 03:19:05');
INSERT INTO `s_using_list` VALUES ('9', '16-606', 'pc_03', '键盘', '故障', '7', '2', '12', 'c16f38', '林世鑫', '2018-01-01 03:19:05');
INSERT INTO `s_using_list` VALUES ('10', '16-606', 'pc_teacher', '音箱', '故障', '7', '2', '34', 'c16f38', '林世鑫', '2018-01-01 03:19:05');
INSERT INTO `s_using_list` VALUES ('11', '16-606', 'pc_teacher', '麦克风', '故障', '7', '2', '34', 'c16f38', '林世鑫', '2018-01-01 03:19:05');
INSERT INTO `s_using_list` VALUES ('12', '16-606', 'pc_02', '网络', '故障', '7', '2', '34', 'c16f38', '林世鑫', '2018-01-01 03:19:05');
INSERT INTO `s_using_list` VALUES ('13', '16-606', 'pc_01', '显示器', '故障', '12', '1', '34', 'c16f37', '林世鑫', '2018-01-01 03:19:31');
INSERT INTO `s_using_list` VALUES ('14', '16-606', 'pc_02', '键盘', '故障', '12', '1', '34', 'c16f37', '林世鑫', '2018-01-01 03:19:31');
INSERT INTO `s_using_list` VALUES ('15', '16-606', 'pc_01', '显示器', '故障', '14', '2', '12', 'c16f38', '林世鑫', '2018-01-01 03:24:53');
INSERT INTO `s_using_list` VALUES ('16', '16-606', 'pc_02', '网络', '故障', '14', '2', '12', 'c16f38', '林世鑫', '2018-01-01 03:24:53');
INSERT INTO `s_using_list` VALUES ('17', '16-606', 'pc_03', '键盘', '故障', '14', '2', '34', 'c16f38', '林世鑫', '2018-01-01 03:24:53');
INSERT INTO `s_using_list` VALUES ('18', '16-606', '全部', '全部', '正常', '14', '2', '34', 'c16f38', '林世鑫', '2018-01-01 15:31:14');
INSERT INTO `s_using_list` VALUES ('19', '16-606', '全部', '全部', '正常', '1', '1', '56', 'Z16F30', '文祝青', '2018-01-07 17:49:11');
INSERT INTO `s_using_list` VALUES ('20', '16-606', '全部', '全部', '正常', '1', '1', '78', 'Z16F30', '文祝青', '2018-01-07 17:49:35');
INSERT INTO `s_using_list` VALUES ('21', '16-606', 'pc_01', '鼠标', '故障', '1', '2', '56', 'Z16F34', '邓新跃', '2018-01-07 17:50:53');
INSERT INTO `s_using_list` VALUES ('22', '16-606', 'pc_03', '网络', '故障', '1', '2', '56', 'Z16F34', '邓新跃', '2018-01-07 17:50:53');
INSERT INTO `s_using_list` VALUES ('23', '16-606', '全部', '全部', '正常', '1', '4', '12', 'C16F31', '杨延华', '2018-01-07 17:51:39');
INSERT INTO `s_using_list` VALUES ('24', '16-606', '全部', '全部', '正常', '1', '4', '34', 'C16F31', '杨延华', '2018-01-07 17:52:34');
INSERT INTO `s_using_list` VALUES ('25', '16-606', '全部', '全部', '正常', '1', '4', '56', 'C16F32', '杨延华', '2018-01-07 17:52:45');
INSERT INTO `s_using_list` VALUES ('26', '16-606', 'pc_01', '网络', '故障', '1', '4', '78', 'C16F32', '杨延华', '2018-01-07 17:53:05');
INSERT INTO `s_using_list` VALUES ('27', '16-606', 'pc_02', '键盘', '故障', '1', '4', '78', 'C16F32', '杨延华', '2018-01-07 17:53:05');

-- ----------------------------
-- View structure for `output`
-- ----------------------------
DROP VIEW IF EXISTS `output`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `output` AS select `s_using_list`.`l_shi_id` AS `l_shi_id`,`s_using_list`.`l_zhou` AS `l_zhou`,`s_using_list`.`l_xingqi` AS `l_xingqi`,`s_using_list`.`l_node` AS `l_node`,`s_using_list`.`l_class` AS `l_class`,`s_using_list`.`l_m_name` AS `l_m_name`,`s_using_list`.`l_c_name` AS `l_c_name`,`s_using_list`.`l_m_pro` AS `l_m_pro`,`s_class`.`c_stu_num` AS `c_stu_num`,`s_using_list`.`l_teacher` AS `l_teacher` from (`s_class` join `s_using_list` on((`s_class`.`c_id` = `s_using_list`.`l_class`))) group by `s_using_list`.`l_zhou`,`s_using_list`.`l_xingqi`,`s_using_list`.`l_node`,`s_using_list`.`l_c_name` order by `s_using_list`.`l_zhou`,`s_using_list`.`l_xingqi`,`s_using_list`.`l_node` ;
