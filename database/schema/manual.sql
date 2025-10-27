/*
 Navicat Premium Data Transfer

 Source Server         : ZLocalhost
 Source Server Type    : MariaDB
 Source Server Version : 100525 (10.5.25-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : manual

 Target Server Type    : MariaDB
 Target Server Version : 100525 (10.5.25-MariaDB)
 File Encoding         : 65001

 Date: 27/10/2025 08:02:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('laravel-cache-c2aa0a15fcbb62c28702326cdf9bb273', 'i:1;', 1761271806);
INSERT INTO `cache` VALUES ('laravel-cache-c2aa0a15fcbb62c28702326cdf9bb273:timer', 'i:1761271806;', 1761271806);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group`  (
  `group_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `group_icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `group_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `group_sort` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`group_code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('app', 'Apps', 'bi-rocket', NULL, 2);
INSERT INTO `group` VALUES ('system', 'System', 'bi-gear', NULL, 3);

-- ----------------------------
-- Table structure for jenis
-- ----------------------------
DROP TABLE IF EXISTS `jenis`;
CREATE TABLE `jenis`  (
  `jenis_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `jenis_nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jenis_code_rs` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jenis_harga` int(11) NULL DEFAULT NULL,
  `jenis_fee` int(11) NULL DEFAULT NULL,
  `jenis_total` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`jenis_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis
-- ----------------------------
INSERT INTO `jenis` VALUES (5, 'Jenis Example', 'SKC', 10000, 500, 1000);
INSERT INTO `jenis` VALUES (6, 'Sprei Kerut Lotus Bed Orange', 'SKC', 15000, 750, 500);

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cancelled_at` int(11) NULL DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `menu_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `menu_group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_controller` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_action` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu_sort` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`menu_code`) USING BTREE,
  INDEX `menu_ibfk_1`(`menu_group`) USING BTREE,
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`menu_group`) REFERENCES `group` (`group_code`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('group', 'system', 'Group', 'App\\Http\\Controllers\\GroupController', 'getData', NULL);
INSERT INTO `menu` VALUES ('jenis', 'app', 'Jenis', 'App\\Http\\Controllers\\JenisController', 'index', NULL);
INSERT INTO `menu` VALUES ('menu', 'system', 'Menu', 'App\\Http\\Controllers\\MenuController', 'getData', NULL);
INSERT INTO `menu` VALUES ('rs', 'app', 'Rs', 'App\\Http\\Controllers\\RsController', 'index', NULL);
INSERT INTO `menu` VALUES ('ruangan', 'app', 'Ruangan', 'App\\Http\\Controllers\\RuanganController', 'index', NULL);
INSERT INTO `menu` VALUES ('transaksi', 'app', 'Transaksi', 'App\\Http\\Controllers\\TransaksiController', 'index', NULL);
INSERT INTO `menu` VALUES ('user', 'app', 'User', 'App\\Http\\Controllers\\UserController', 'getData', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2025_09_12_113330_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` VALUES (5, '2025_09_12_113344_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (6, '2025_09_21_032354_add_username_to_users_table', 1);
INSERT INTO `migrations` VALUES (7, '2025_09_23_034738_create_settings_table', 1);
INSERT INTO `migrations` VALUES (8, '2025_09_23_042150_create_telescope_entries_table', 1);
INSERT INTO `migrations` VALUES (9, '2025_09_24_072604_create_coin_table', 1);
INSERT INTO `migrations` VALUES (10, '2025_09_27_102702_create_cache_table', 0);
INSERT INTO `migrations` VALUES (11, '2025_09_27_102702_create_cache_locks_table', 0);
INSERT INTO `migrations` VALUES (12, '2025_09_27_102702_create_coin_table', 0);
INSERT INTO `migrations` VALUES (13, '2025_09_27_102702_create_failed_jobs_table', 0);
INSERT INTO `migrations` VALUES (14, '2025_09_27_102702_create_group_table', 0);
INSERT INTO `migrations` VALUES (15, '2025_09_27_102702_create_job_batches_table', 0);
INSERT INTO `migrations` VALUES (16, '2025_09_27_102702_create_jobs_table', 0);
INSERT INTO `migrations` VALUES (17, '2025_09_27_102702_create_menu_table', 0);
INSERT INTO `migrations` VALUES (18, '2025_09_27_102702_create_password_reset_tokens_table', 0);
INSERT INTO `migrations` VALUES (19, '2025_09_27_102702_create_personal_access_tokens_table', 0);
INSERT INTO `migrations` VALUES (20, '2025_09_27_102702_create_sessions_table', 0);
INSERT INTO `migrations` VALUES (21, '2025_09_27_102702_create_settings_table', 0);
INSERT INTO `migrations` VALUES (22, '2025_09_27_102702_create_telescope_entries_table', 0);
INSERT INTO `migrations` VALUES (23, '2025_09_27_102702_create_telescope_entries_tags_table', 0);
INSERT INTO `migrations` VALUES (24, '2025_09_27_102702_create_telescope_monitoring_table', 0);
INSERT INTO `migrations` VALUES (25, '2025_09_27_102702_create_users_table', 0);
INSERT INTO `migrations` VALUES (26, '2025_09_27_102705_add_foreign_keys_to_menu_table', 0);
INSERT INTO `migrations` VALUES (27, '2025_09_27_102705_add_foreign_keys_to_telescope_entries_tags_table', 0);
INSERT INTO `migrations` VALUES (28, '2025_09_27_150000_add_analysis_tracking_to_coin_table', 2);
INSERT INTO `migrations` VALUES (29, '2025_09_27_170000_create_coin_price_history_table', 3);
INSERT INTO `migrations` VALUES (30, '2025_10_06_154432_create_trades_table', 4);
INSERT INTO `migrations` VALUES (31, '2025_10_08_021200_add_usd_trading_fields_to_trades_table', 5);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
INSERT INTO `password_reset_tokens` VALUES ('itok.toni@gmail.com', '$2y$12$iKDORBsPcmw9XnvvGnzPpeK90jfG/YvbRSUr03.Dl62.FJgvUQL5G', '2025-09-27 00:42:31');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE,
  INDEX `personal_access_tokens_expires_at_index`(`expires_at`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for rs
-- ----------------------------
DROP TABLE IF EXISTS `rs`;
CREATE TABLE `rs`  (
  `rs_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rs_nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rs_alamat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rs_logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`rs_code`) USING BTREE,
  INDEX `rs_code`(`rs_code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rs
-- ----------------------------
INSERT INTO `rs` VALUES ('SKC', 'Siloam Karawaci', 'Karawaci', 'rs_logos/1761197300_68f9bcf47f63a.png');
INSERT INTO `rs` VALUES ('SLV', 'Siloam Lippo Village', 'Tangerang', 'rs_logos/1761192396_68f9a9ccc8d66.png');

-- ----------------------------
-- Table structure for ruangan
-- ----------------------------
DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE `ruangan`  (
  `ruangan_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ruangan_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ruangan_nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ruangan_code_rs` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ruangan_id`) USING BTREE,
  UNIQUE INDEX `ruangan_code`(`ruangan_code`) USING BTREE,
  INDEX `ruangan_id`(`ruangan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ruangan
-- ----------------------------
INSERT INTO `ruangan` VALUES (1, 'R001', 'Ruangan Example', 'SKC');
INSERT INTO `ruangan` VALUES (2, 'R002', 'Another Ruangan', 'SKC');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id`) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('QZQnsQqqtafuC6wsGNp6Q4wDuA9ofteZzbT6b75P', 101, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUXM1dEpHYzNOMkk2a25tT3I5amZNWFRpVHVqQlFGN21PS0xhd3pHZyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTAxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkSGlqdm5WNFZvc3QzcmcvcUhsNVZWdTNjMlFlbi9IMDlQTHl6SkRMbW1WOVZVc2FqZUtZS2kiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vbWFudWFsLnRlc3QvYXBwL3J1YW5nYW4vZGF0YSI7czo1OiJyb3V0ZSI7czoxNToicnVhbmdhbi5nZXREYXRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1761451100);
INSERT INTO `sessions` VALUES ('tRY8sLheIY6a2QUZWMEaxlXvrNApsj9qdTdyXiW7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.22.1 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXJzdXJHbnlNMkpDc0NXZTVtem5CMWFZTnB2UDNHUlFyTDFScVBuMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9tYW51YWwudGVzdC8/aGVyZD1wcmV2aWV3IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1761443529);

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `settings_key_unique`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for telescope_entries
-- ----------------------------
DROP TABLE IF EXISTS `telescope_entries`;
CREATE TABLE `telescope_entries`  (
  `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`sequence`) USING BTREE,
  UNIQUE INDEX `telescope_entries_uuid_unique`(`uuid`) USING BTREE,
  INDEX `telescope_entries_batch_id_index`(`batch_id`) USING BTREE,
  INDEX `telescope_entries_family_hash_index`(`family_hash`) USING BTREE,
  INDEX `telescope_entries_created_at_index`(`created_at`) USING BTREE,
  INDEX `telescope_entries_type_should_display_on_index_index`(`type`, `should_display_on_index`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of telescope_entries
-- ----------------------------

-- ----------------------------
-- Table structure for telescope_entries_tags
-- ----------------------------
DROP TABLE IF EXISTS `telescope_entries_tags`;
CREATE TABLE `telescope_entries_tags`  (
  `entry_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`entry_uuid`, `tag`) USING BTREE,
  INDEX `telescope_entries_tags_tag_index`(`tag`) USING BTREE,
  CONSTRAINT `telescope_entries_tags_ibfk_1` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of telescope_entries_tags
-- ----------------------------

-- ----------------------------
-- Table structure for telescope_monitoring
-- ----------------------------
DROP TABLE IF EXISTS `telescope_monitoring`;
CREATE TABLE `telescope_monitoring`  (
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`tag`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of telescope_monitoring
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `transaksi_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaksi_code_rs` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `transaksi_id_jenis` bigint(20) NULL DEFAULT NULL,
  `transaksi_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `transaksi_kotor` int(11) NULL DEFAULT NULL,
  `transaksi_retur` int(11) NULL DEFAULT NULL,
  `transaksi_rewash` int(11) NULL DEFAULT NULL,
  `transaksi_tanggal` date NULL DEFAULT NULL,
  `transaksi_qc_kotor` int(11) NULL DEFAULT NULL,
  `transaksi_qc_retur` int(11) NULL DEFAULT NULL,
  `transaksi_qc_rewash` int(11) NULL DEFAULT NULL,
  `transaksi_created_at` datetime NULL DEFAULT NULL,
  `transaksi_updated_at` datetime NULL DEFAULT NULL,
  `transaksi_deleted_at` datetime NULL DEFAULT NULL,
  `transaksi_created_by` int(11) NULL DEFAULT NULL,
  `transaksi_updated_by` int(11) NULL DEFAULT NULL,
  `transaksi_deleted_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`transaksi_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (31, 'SKC', 5, 'TRX68FD7E5E47682', 2, 2, 2, '2025-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `transaksi` VALUES (32, 'SKC', 6, 'TRX68FD7E5E47682', 3, 4, 5, '2025-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rs` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 103 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Prof. Erich Blick', NULL, 'adella51@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '6lfDYUz8qI', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (2, 'Royce Armstrong', NULL, 'lblock@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'dSNKpVT4fd', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (4, 'Keira Nitzsche', NULL, 'leola.welch@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '1GsyEqoABn', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (5, 'Dr. Sheridan Robel I', NULL, 'sherwood39@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'edkSsAItis', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (6, 'Tanya Zemlak Jr.', NULL, 'dorcas.hansen@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'yr8RTDO3oc', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (7, 'Clemmie Heidenreich', NULL, 'kiana10@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'M8iq3Gbaaa', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (8, 'Ms. Mollie McKenzie', NULL, 'jayme.schowalter@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'wnVowbzIqQ', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (11, 'Noble Jenkins', NULL, 'ytowne@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'yN58Dc96J1', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (12, 'Corrine Brown IV', NULL, 'noemi.brakus@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '9NL9cZm1cl', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (13, 'Alberta Bergstrom', NULL, 'deckow.conor@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'ydUP4QNzMs', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (14, 'Dr. Matilde Sporer', NULL, 'rudy81@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'LX5fobr7ZO', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (15, 'Domenico Kling', NULL, 'hammes.darrel@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'gEXBmXlBVz', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (16, 'Bettye Dietrich IV', NULL, 'georgiana.gorczany@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'Ki1O9K2Ua4', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (17, 'Pamela Schultz', NULL, 'delfina25@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'ZibZVSCgK3', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (18, 'Cayla Berge', NULL, 'garfield85@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'UbqYHgb7cF', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (19, 'Kaelyn Lowe', NULL, 'little.heather@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'SEFdwVw1Lm', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (20, 'Eriberto Waelchi', NULL, 'lola.mccullough@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'DTYLVsB3iP', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (21, 'Zoe Langosh', NULL, 'nbeer@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'ok93hzB9jy', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (22, 'Malvina Christiansen', NULL, 'zoey.orn@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'Vbdbepuxk2', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (23, 'Baby Kautzer', NULL, 'npurdy@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'w9TiNxg9cW', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (24, 'Cayla Hagenes V', NULL, 'hickle.virgie@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'gVXwjGHI3L', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (25, 'Jovanny Terry', NULL, 'alanna95@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'E6eUn0UHA5', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (26, 'Shanna Gorczany', NULL, 'candida.feest@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'nUB58WVQ9M', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (27, 'Chad Howe', NULL, 'swalter@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '6uvKJfszlu', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (28, 'Nikko Rohan', NULL, 'gvonrueden@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'wRhhy5LveO', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (29, 'Madisyn Weimann', NULL, 'stanley34@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'rs2G0TVUpt', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (30, 'Elisa O\'Hara', NULL, 'ayden15@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'AFoC2omhuO', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (31, 'Mr. Wallace Yost I', NULL, 'dario.powlowski@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'eO8xifOGBX', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (32, 'Mr. Bret Gutmann', NULL, 'jude02@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'tE5kBJM4XG', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (33, 'Alice Cremin', NULL, 'bmertz@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'cjLiEM8L5m', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (34, 'Mckayla Jacobi II', NULL, 'huel.eden@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'l07Gu5kC1n', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (35, 'Bo Wiegand', NULL, 'kemmer.newton@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'iOjSzjSTP4', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (36, 'Prof. Obie Gaylord', NULL, 'fritz.lehner@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'mZC0qV2FMo', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (37, 'Ashtyn Champlin', NULL, 'wsteuber@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'nmUhWLRtGd', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (38, 'Mr. Luciano Torphy II', NULL, 'berry95@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'FdT7C6flcu', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (39, 'Veda Mueller', NULL, 'karmstrong@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'fHzAG5GpLv', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (40, 'Mr. Ryleigh Frami DVM', NULL, 'foster40@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'zQFHaY2daF', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (41, 'Nels Mertz', NULL, 'cora.yost@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'V7PnkZQubW', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (42, 'Holden Haag', NULL, 'marcus.hintz@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'R9na3ZJX4O', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (43, 'Dr. Richard Rohan', NULL, 'pschamberger@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'Crt8nOgQDZ', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (44, 'Jazlyn Klein', NULL, 'loberbrunner@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'avCQWrIP2y', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (45, 'Devon Gusikowski', NULL, 'hermann.laurence@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'zTmx423Pz5', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (46, 'Rigoberto Schroeder', NULL, 'weldon.nienow@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'ryzRYjP7XT', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (47, 'Rolando Cronin', NULL, 'vallie21@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'rJPRfT15QT', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (48, 'Suzanne Ankunding', NULL, 'schneider.barton@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'YJOUFaOm9A', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (49, 'Kathryn Purdy', NULL, 'gavin32@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'kVAJ2058f7', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (50, 'Miss Clemmie Murazik III', NULL, 'angelica18@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'UT6n8NHqZ2', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (51, 'Devante O\'Reilly', NULL, 'deshawn21@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'CINhHkYHOB', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (52, 'Harvey Nader', NULL, 'heffertz@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'QLWR18Bt8O', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (53, 'Chris Stoltenberg', NULL, 'willms.jasen@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'kUeybgz073', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (54, 'Frida Volkman', NULL, 'hartmann.una@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'VWAGNyYQuC', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (55, 'Jerad Reilly', NULL, 'cole.drake@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'bQU86HE0nU', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (56, 'Cydney Langosh I', NULL, 'alysson32@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'gYLezn3OWc', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (57, 'Akeem Kuphal Jr.', NULL, 'clare15@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'hLQDHUXeJh', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (58, 'Mrs. Lue Dietrich', NULL, 'wmohr@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '5C6cEIdx7t', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (59, 'Modesta Welch', NULL, 'vernie52@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'u09HAEDB5s', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (60, 'Yolanda Kiehn DDS', NULL, 'ardith20@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'yrFmTCZqtR', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (61, 'Dr. Erik Franecki', NULL, 'rosamond77@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'y7KFfHLMgm', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (62, 'Yadira Cole', NULL, 'twiegand@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'AxagKXLqsH', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (63, 'Antwon Keebler', NULL, 'altenwerth.antoinette@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '1Zo1gTPTBb', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (64, 'Buddy West', NULL, 'jarret09@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '1GS27LiDuM', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (65, 'Miss Kali Kihn', NULL, 'karina.willms@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '4AwwpFhmgE', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (66, 'Rafaela D\'Amore', NULL, 'raynor.zelma@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'miQ7OhHTQq', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (67, 'Derek Crona IV', NULL, 'charley77@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'dG7uqFADcW', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (68, 'Dr. Sheridan Emmerich', NULL, 'weissnat.aubrey@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'p7H5wMliKY', NULL, NULL, '2025-09-25 04:05:28', '2025-09-25 04:05:28', NULL, NULL);
INSERT INTO `users` VALUES (69, 'Armand Yost', NULL, 'blanda.harry@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'DpuhY6Hw2a', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (70, 'Syble Jacobi', NULL, 'juwan.koch@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'Gx6qjeKtzU', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (71, 'Dr. Doris Rohan Sr.', NULL, 'clemmie.treutel@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'zgQ0nEMrCE', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (72, 'Frida Bergnaum Sr.', NULL, 'hwisoky@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '4RcMBF4QuO', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (73, 'Barry Welch', NULL, 'stanton.raymond@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '0jRpK1K4I0', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (74, 'Domenica Cormier Jr.', NULL, 'ondricka.adrienne@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'K1vRMVfjwH', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (75, 'Joelle Jaskolski', NULL, 'mweber@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'dbZS46xcO9', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (76, 'Leland Zemlak Jr.', NULL, 'jgleason@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '7Ei7In18to', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (77, 'Prof. Eileen Lang', NULL, 'fwintheiser@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'SJrB50lN5X', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (78, 'Sylvia O\'Hara', NULL, 'oral81@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'jlcv4OaGoY', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (79, 'Adam White', NULL, 'jordon.wunsch@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'Rb9GqsEsSf', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (80, 'Marcelino Mohr', NULL, 'bbeier@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'OZzfoZvIJY', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (81, 'Willis Spencer', NULL, 'hmckenzie@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'QclauLuE5a', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (82, 'Lucile Harvey', NULL, 'plangworth@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, '9eIywzhJZh', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (83, 'Elfrieda Dickens', NULL, 'gregory.west@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'SzKaAYe5QH', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (84, 'Ludwig Bartoletti', NULL, 'mann.freddie@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'h6vQwn00h0', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (85, 'Archibald Padberg I', NULL, 'mstamm@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'nddRWhX36X', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (86, 'Joey Kshlerin', NULL, 'sadie.cassin@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'iR71HbVC1D', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (87, 'Cruz Metz', NULL, 'ellen.hand@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'VorkccV4Lx', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (88, 'Cathryn Nikolaus', NULL, 'kory12@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'ktg0sR8HL6', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (89, 'Claudine Langosh', NULL, 'chaz08@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'n19swyfVW9', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (90, 'Mr. Kameron Swift', NULL, 'sonya.wiza@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'gMftfsGtrj', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (91, 'Mr. Remington Keebler', NULL, 'morar.wilhelmine@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'Ga1ZGIIm7e', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (92, 'Dr. Wilson Nader', NULL, 'winona34@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'Xmp72U1b9j', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (93, 'Gunner Gleichner', NULL, 'kobe.hegmann@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'hPPF7GbXPJ', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (94, 'Brielle Fritsch', NULL, 'orn.rupert@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'bSf3VGMAuj', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (95, 'Marshall Lang', NULL, 'filomena90@example.com', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'ptBMuHC1or', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (96, 'Prof. Arielle Towne Sr.', NULL, 'cartwright.lonie@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'eoPpf5wgzk', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (97, 'Francisca Kassulke', NULL, 'moses12@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'd8Bk5uWuXr', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (98, 'Elna Murray', NULL, 'goodwin.catharine@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'xRkNnm6qDl', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (99, 'Anissa Hirthe Sr.', NULL, 'upton.antonia@example.net', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'WyW6gyQXh7', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (100, 'Dr. Jannie Schuster I', NULL, 'manuela.stroman@example.org', '2025-09-25 04:05:28', '$2y$12$tA.ItSnTa6wJt3FIab7TzOhcgulAtpHZu/3m1knh2AfR96ZiXq8pu', NULL, NULL, NULL, 'nWvtq1B0JX', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', NULL, NULL);
INSERT INTO `users` VALUES (101, 'itok toni laksono', 'itoktoni', 'itok.toni@gmail.com', '2025-09-25 04:05:29', '$2y$12$HijvnV4Vost3rg/qHl5VVu3c2Qen/H09PLyzJDLmmV9VUsajeKYKi', NULL, NULL, NULL, 'DDSwNaMUYnUEoQwNVOP8IznIFEadfE2fC768eSSyKYN4ZwWipAv3nZCSCU7s', NULL, NULL, '2025-09-25 04:05:29', '2025-09-25 04:05:29', '100', NULL);
INSERT INTO `users` VALUES (102, 'fewfwefwe', 'fweqfewfwe', 'fwefwefew@gmail.com', NULL, '$2y$12$87nvQzHpjLq79sTIm6.xTekoWPPqVM/FGFc9Db5F7jTDrofCX4YfO', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-27 06:32:16', '2025-09-27 06:32:16', 'user', NULL);

-- ----------------------------
-- View structure for kotor
-- ----------------------------
DROP VIEW IF EXISTS `kotor`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `kotor` AS SELECT
	transaksi_code AS kotor_code,
	rs_code AS kotor_rs_id,
	rs_nama AS kotor_rs_nama,
	transaksi_tanggal AS kotor_tanggal,
	sum( transaksi_kotor ) AS kotor_kotor,
	sum( transaksi_retur ) AS kotor_retur,
	sum( transaksi_rewash ) AS kotor_rewash 
FROM
	transaksi
	JOIN rs ON transaksi_code_rs = rs_code 
GROUP BY
	transaksi_code,
	rs_code,
	rs_nama,
	transaksi_tanggal ;

SET FOREIGN_KEY_CHECKS = 1;
