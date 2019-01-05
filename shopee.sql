/*
 Navicat Premium Data Transfer

 Source Server         : admin
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : shopee

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 05/01/2019 22:49:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `product_image` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `price` double(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'camera', 'camera.jpg', 150000.00);
INSERT INTO `products` VALUES (2, 'hard disk', 'hard-disk.jpg', 200000.00);
INSERT INTO `products` VALUES (3, 'smart phone', 'smart-phone.jpg', 1000000.00);
INSERT INTO `products` VALUES (4, 'laptop', 'laptop.jpg', 5000000.00);

SET FOREIGN_KEY_CHECKS = 1;
