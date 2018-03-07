CREATE TABLE IF NOT EXISTS `jam_rule2` (
  `lhs` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rhs` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support` double(8,2) NOT NULL,
  `confidence` double(8,2) NOT NULL,
  `lift` double(8,2) NOT NULL,
  `count` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;