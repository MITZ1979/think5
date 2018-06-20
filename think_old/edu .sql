-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2018 at 10:10 AM
-- Server version: 10.2.11-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edu`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `id` int(11) unsigned NOT NULL COMMENT '班级主键',
  `name` varchar(100) DEFAULT NULL COMMENT '班级名称',
  `length` varchar(20) DEFAULT NULL COMMENT '学制',
  `price` int(11) DEFAULT NULL COMMENT '学费',
  `status` int(11) DEFAULT NULL COMMENT '是否启用',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `is_delete` int(11) DEFAULT NULL COMMENT '允许删除',
  `student_id` int(11) DEFAULT NULL COMMENT '关联外键'
) ENGINE=InnoDB AUTO_INCREMENT=1017 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `name`, `length`, `price`, `status`, `create_time`, `update_time`, `delete_time`, `is_delete`, `student_id`) VALUES
(1012, '1201', '2', 1200, 1, 1522390773, 1523275398, NULL, 1, NULL),
(1013, '1201', '3', 2333, 1, 1522390837, 1523253625, NULL, 1, NULL),
(1014, 'web前端', '2年', 19800, 1, 1522757390, 1523448494, 1523448494, 1, NULL),
(1015, 'web前端', '两年', 19800, 1, 1522820174, 1523253625, NULL, 1, NULL),
(1016, 'web前端', '两年', 19800, 1, 1523151512, 1523435470, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) unsigned NOT NULL COMMENT '主键',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `sex` varchar(4) DEFAULT NULL COMMENT '性别',
  `age` tinyint(4) unsigned DEFAULT NULL COMMENT '年龄',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `status` int(11) DEFAULT NULL COMMENT '当前状态',
  `start_time` int(11) DEFAULT NULL COMMENT '入学时间',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `is_delete` int(11) DEFAULT NULL COMMENT '允许删除',
  `grade_id` int(11) unsigned DEFAULT NULL COMMENT '关联外键'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `sex`, `age`, `mobile`, `email`, `status`, `start_time`, `create_time`, `update_time`, `delete_time`, `is_delete`, `grade_id`) VALUES
(5, '李华', '男', 18, '13478458740', 'liliu@qq.com', 1, 1523462400, 1523495597, 1523495597, NULL, NULL, 1016);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) unsigned NOT NULL COMMENT '主键',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `degree` varchar(30) DEFAULT NULL COMMENT '学历',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `school` varchar(50) DEFAULT NULL COMMENT '毕业学校',
  `hiredate` int(11) DEFAULT NULL COMMENT '入职时间',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `is_delete` int(11) DEFAULT 1 COMMENT '允许删除',
  `status` int(11) DEFAULT NULL COMMENT '1启用0禁用',
  `grade_id` int(11) DEFAULT NULL COMMENT '外键'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `degree`, `mobile`, `school`, `hiredate`, `create_time`, `update_time`, `delete_time`, `is_delete`, `status`, `grade_id`) VALUES
(7, 'miss', '专科生', '13677456541', '南方IT学院', 1523376000, 1523416067, 1523494622, NULL, 1, 1, 1015),
(8, 'hr', '本科生', '13478458740', '南方IT学院', 1483113600, 1523416152, 1523494622, NULL, 1, 1, 1016),
(9, 'MS', '本科生', '13478458740', '南方IT学院', 1523376000, 1523416732, 1523494622, NULL, 1, 1, 1015),
(11, '小刘', '本科生', '1264569814', '南方IT研究院', 1523462400, 1523495258, 1523495258, NULL, 1, 1, 1011),
(12, 'pet', '专科生', '13677456541', '南方IT学院', 1523462400, 1523495910, 1523495910, NULL, 1, 1, 1015);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `name` varchar(50) DEFAULT NULL COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码',
  `email` varchar(255) DEFAULT NULL COMMENT '用户邮箱',
  `role` tinyint(2) unsigned DEFAULT 1 COMMENT '角色',
  `status` int(2) unsigned DEFAULT 1 COMMENT '状态:1启用0禁止',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '跟新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `login_time` int(11) unsigned DEFAULT NULL COMMENT '登陆时间',
  `login_count` int(11) unsigned DEFAULT 0 COMMENT '登陆次数',
  `is_delete` int(2) unsigned DEFAULT 0 COMMENT '是否删除1是0否'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `role`, `status`, `create_time`, `update_time`, `delete_time`, `login_time`, `login_count`, `is_delete`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@qq.com', 1, 1, 1523147012, 1523497183, NULL, 1523274486, 22, 1),
(2, 'peter', 'e10adc3949ba59abbe56e057f20f883e', 'peter@qq.com', 0, 1, NULL, 1523497183, NULL, 1523275200, 4, 1),
(14, 'zhu', '123456', 'zhuxiao@qq.com', 0, 1, 1523496075, 1523497183, NULL, NULL, 0, 1),
(15, '王教授', '123456', 'wang@qq.com', 0, 1, 1523497171, 1523497183, NULL, NULL, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '班级主键',AUTO_INCREMENT=1017;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
