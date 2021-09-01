
DROP TABLE IF EXISTS `buying_products`;

CREATE TABLE `buying_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `companies_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buy_qty` int(11) NOT NULL DEFAULT '0' COMMENT 'unit',
  `sell_qty` int(11) NOT NULL DEFAULT '0' COMMENT 'unit',
  `available_qty` int(11) NOT NULL DEFAULT '0' COMMENT 'unit',
  `unit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'kg / piece',
  `buy_price` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'per unit',
  `sell_price` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'per unit',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_list_qty` int(11) DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = available 0= unavailable',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `buying_products` */

insert  into `buying_products`(`id`,`companies_id`,`category_id`,`name`,`buy_qty`,`sell_qty`,`available_qty`,`unit`,`buy_price`,`sell_price`,`group`,`details`,`short_list_qty`,`exp_date`,`status`,`deleted_at`,`deleted_by`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,1,1,'Flour',45,0,45,'Kg',30.00,0.00,NULL,NULL,0,NULL,1,NULL,NULL,1,1,'2021-06-09 02:32:36','2021-06-13 02:38:18'),(2,1,1,'Suger',47,0,47,'Kg',70.00,0.00,NULL,NULL,0,NULL,1,NULL,NULL,1,1,'2021-06-09 02:32:36','2021-06-13 02:38:28'),(3,1,6,'Hilsha',5,0,5,'Piece',800.00,0.00,NULL,NULL,NULL,NULL,1,NULL,NULL,1,NULL,'2021-06-13 02:43:18',NULL),(4,1,4,'Boiler',20,0,20,'Piece',120.00,0.00,NULL,NULL,NULL,NULL,1,NULL,NULL,1,NULL,'2021-06-13 02:43:18',NULL);

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`deleted_at`,`deleted_by`,`created_at`,`updated_at`) values (1,'Grocery',NULL,NULL,'2021-06-07 02:25:25','2021-06-07 02:25:25'),(2,'Meat',NULL,NULL,'2021-06-13 01:24:14','2021-06-13 01:24:14'),(3,'Vegetables',NULL,NULL,'2021-06-13 01:25:17','2021-06-13 01:25:17'),(4,'Poultry',NULL,NULL,'2021-06-13 01:26:28','2021-06-13 01:26:28'),(5,'Fruits',NULL,NULL,'2021-06-13 01:26:50','2021-06-13 01:26:50'),(6,'Fish',NULL,NULL,'2021-06-13 01:27:20','2021-06-13 01:27:20');

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sr_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sr_mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `companies` */

insert  into `companies`(`id`,`name`,`sr_name`,`sr_mobile_no`,`deleted_at`,`deleted_by`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'ABC','abc',NULL,NULL,NULL,1,1,'2021-06-07 01:10:50','2021-06-07 01:11:01');

/*Table structure for table `computer_works` */

DROP TABLE IF EXISTS `computer_works`;

CREATE TABLE `computer_works` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` int(11) NOT NULL DEFAULT '0',
  `cost` int(11) NOT NULL DEFAULT '0',
  `profit` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `computer_works` */

/*Table structure for table `customer_dues` */

DROP TABLE IF EXISTS `customer_dues`;

CREATE TABLE `customer_dues` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `credit_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `debit_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customer_dues` */

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'credit' COMMENT 'credit,dabit',
  `balance` double(10,2) NOT NULL DEFAULT '0.00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_mobile_no_unique` (`mobile_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`name`,`mobile_no`,`address`,`balance_type`,`balance`,`deleted_at`,`deleted_by`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'Walking',NULL,NULL,'credit',0.00,NULL,NULL,NULL,NULL,'2021-06-09 02:52:30','2021-06-09 02:52:30');

/*Table structure for table `daily_balances` */

DROP TABLE IF EXISTS `daily_balances`;

CREATE TABLE `daily_balances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `balance` double(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `daily_balances` */

/*Table structure for table `daily_sells` */

DROP TABLE IF EXISTS `daily_sells`;

CREATE TABLE `daily_sells` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `sell_date` date NOT NULL,
  `total_sell` double(10,2) NOT NULL,
  `total_profit` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `daily_sells` */

insert  into `daily_sells`(`id`,`category_id`,`sell_date`,`total_sell`,`total_profit`,`created_at`,`updated_at`) values (1,1,'2021-06-10',60.00,0.00,'2021-06-10 02:48:14','2021-06-10 02:48:14'),(2,1,'2021-06-10',0.00,0.00,'2021-06-10 02:48:14','2021-06-10 02:48:14');

/*Table structure for table `expense_categories` */

DROP TABLE IF EXISTS `expense_categories`;

CREATE TABLE `expense_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expense_categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `expense_categories` */

insert  into `expense_categories`(`id`,`name`,`note`,`deleted_at`,`deleted_by`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'Travel Expenses','Travel Expenses',NULL,NULL,1,1,'2021-06-13 01:19:48','2021-06-13 01:22:15'),(2,'Office Expenses','Official all types of Expenses.',NULL,NULL,1,NULL,'2021-06-13 01:21:36','2021-06-13 01:21:36'),(3,'Rent, Utilities & Phone','Rent, Utilities & Phone',NULL,NULL,1,NULL,'2021-06-13 01:22:44','2021-06-13 01:22:44');

/*Table structure for table `expenses` */

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `expense_category_id` bigint(20) NOT NULL,
  `amount` double(10,2) NOT NULL DEFAULT '0.00',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `expenses` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `loan_details` */

DROP TABLE IF EXISTS `loan_details`;

CREATE TABLE `loan_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_provider_id` bigint(20) NOT NULL,
  `credit_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `debit_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `loan_details` */

/*Table structure for table `loan_providers` */

DROP TABLE IF EXISTS `loan_providers`;

CREATE TABLE `loan_providers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_amount` double(10,2) NOT NULL DEFAULT '0.00',
  `loan_paid` double(10,2) NOT NULL DEFAULT '0.00',
  `loan_remain` double(10,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=loan raning,0=loan close',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loan_providers_mobile_no_unique` (`mobile_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `loan_providers` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('system','visitor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'visitor',
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_mobile_no_type_unique` (`mobile_no`,`type`),
  UNIQUE KEY `users_email_type_unique` (`email`,`type`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (28,'2014_10_12_000000_create_users_table',1),(29,'2014_10_12_100000_create_password_resets_table',1),(30,'2016_06_01_000001_create_oauth_auth_codes_table',1),(31,'2016_06_01_000002_create_oauth_access_tokens_table',1),(32,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(33,'2016_06_01_000004_create_oauth_clients_table',1),(34,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(35,'2019_08_19_000000_create_failed_jobs_table',1),(36,'2020_04_13_044143_create_permission_tables',1),(37,'2020_04_22_120306_create_otps',1),(38,'2020_04_22_120314_create_otp_counts',1),(39,'2020_06_10_145012_create_companies',1),(40,'2020_06_10_145140_create_products',1),(41,'2020_06_12_114311_create_oreders',1),(42,'2020_06_12_114705_create_oreder_details',1),(43,'2020_06_14_221531_create_daily_sells',1),(44,'2020_06_15_165650_create_categories',1),(45,'2020_06_17_122639_create_monthly_sells',1),(46,'2020_06_17_163429_create_expense_categories',1),(47,'2020_06_17_163731_create_expenses',1),(48,'2020_06_18_115525_create_customers',1),(49,'2020_06_18_120008_create_customer_dues',1),(50,'2020_06_27_145957_create_daily_balances',1),(51,'2020_06_28_113043_create_computer_work',1),(52,'2020_06_30_120845_create_return_items',1),(53,'2020_07_02_100159_create_loan_providers',1),(54,'2020_07_02_101025_create_loan_details',1),(55,'2021_06_08_013550_create_selling_products_table',2),(56,'2021_06_08_014400_create_suppliers_table',3);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'System User Management','web','2021-06-01 03:17:53','2021-06-01 03:17:53'),(2,'Administration','web','2021-06-01 03:17:53','2021-06-01 03:17:53'),(3,'Product Management','web','2021-06-01 03:17:53','2021-06-01 03:17:53'),(4,'Invoice Management','web','2021-06-01 03:17:54','2021-06-01 03:17:54'),(5,'Role Management','web','2021-06-01 03:17:54','2021-06-01 03:17:54'),(6,'Settings','web','2021-06-01 03:17:54','2021-06-01 03:17:54'),(7,'Company Management','web','2021-06-01 03:17:54','2021-06-01 03:17:54'),(8,'Report Manager','web','2021-06-01 03:17:54','2021-06-01 03:17:54'),(9,'Expense Category','web','2021-06-01 03:17:54','2021-06-01 03:17:54'),(10,'Expense Management','web','2021-06-01 03:17:54','2021-06-01 03:17:54'),(11,'Customer Management','web','2021-06-01 03:17:54','2021-06-01 03:17:54'),(12,'Customer Due Management','web','2021-06-01 03:17:54','2021-06-01 03:17:54'),(13,'Loan Management','web','2021-06-01 03:17:54','2021-06-01 03:17:54');




/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'Super Admin','web','2021-06-01 03:17:54','2021-06-01 03:17:54');


/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (1,'App\\User',1);

/*Table structure for table `monthly_sells` */

DROP TABLE IF EXISTS `monthly_sells`;

CREATE TABLE `monthly_sells` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `year` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_sell` double(10,2) NOT NULL,
  `total_profit` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `monthly_sells` */

insert  into `monthly_sells`(`id`,`category_id`,`year`,`month`,`total_sell`,`total_profit`,`created_at`,`updated_at`) values (1,1,'2021','06',60.00,0.00,'2021-06-10 02:48:14','2021-06-10 02:48:14'),(2,1,'2021','06',0.00,0.00,'2021-06-10 02:48:14','2021-06-10 02:48:14');

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_access_tokens` */

/*Table structure for table `oauth_auth_codes` */

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_auth_codes` */

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_clients` */

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

/*Table structure for table `order_details` */

DROP TABLE IF EXISTS `order_details`;

CREATE TABLE `order_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` double(10,2) NOT NULL,
  `profit` double(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_details` */

insert  into `order_details`(`id`,`order_id`,`product_id`,`qty`,`unit_price`,`total_price`,`discount`,`grand_total`,`profit`,`created_at`,`updated_at`) values (1,1,1,1,60.00,60.00,0.00,60.00,0.00,'2021-06-10 02:48:14','2021-06-10 02:48:14'),(2,1,2,1,120.00,120.00,0.00,120.00,0.00,'2021-06-10 02:48:14','2021-06-10 02:48:14');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_product` int(11) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `grand_price` double(10,2) NOT NULL,
  `profit` double(10,2) NOT NULL DEFAULT '0.00',
  `sell_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`invoice_no`,`customer_name`,`customer_mobile`,`number_of_product`,`total_price`,`discount`,`grand_price`,`profit`,`sell_by`,`created_at`,`updated_at`) values (1,'210610100',NULL,NULL,2,180.00,0.00,180.00,0.00,1,'2021-06-10 02:48:14','2021-06-10 02:48:14');

/*Table structure for table `otp_counts` */

DROP TABLE IF EXISTS `otp_counts`;

CREATE TABLE `otp_counts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('system','visitor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `otp_counts_user_id_foreign` (`user_id`),
  KEY `otp_counts_mobile_index` (`mobile`),
  CONSTRAINT `otp_counts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `otp_counts` */

/*Table structure for table `otps` */

DROP TABLE IF EXISTS `otps`;

CREATE TABLE `otps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('system','visitor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `otps_user_id_foreign` (`user_id`),
  KEY `otps_mobile_index` (`mobile`),
  KEY `otps_token_index` (`token`),
  CONSTRAINT `otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `otps` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `return_items` */

DROP TABLE IF EXISTS `return_items`;

CREATE TABLE `return_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `returnable_amount` double(10,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `return_items` */

insert  into `return_items`(`id`,`product_id`,`qty`,`unit_price`,`total_price`,`discount`,`returnable_amount`,`deleted_at`,`deleted_by`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,1,5,30.00,150.00,0.00,150.00,NULL,NULL,1,NULL,'2021-06-13 02:02:13','2021-06-13 02:02:13'),(2,2,3,70.00,210.00,0.00,210.00,NULL,NULL,1,NULL,'2021-06-13 02:09:26','2021-06-13 02:09:26');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1);


/*Table structure for table `selling_products` */

DROP TABLE IF EXISTS `selling_products`;

CREATE TABLE `selling_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sell_price` double(10,2) NOT NULL DEFAULT '0.00' COMMENT 'per pice',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = available 0= unavailable',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `selling_products` */

insert  into `selling_products`(`id`,`name`,`details`,`sell_price`,`status`,`deleted_at`,`deleted_by`,`created_by`,`updated_by`,`created_at`,`updated_at`) values (1,'Mini Burger','Mini School Burger',60.00,1,NULL,NULL,1,1,'2021-06-09 01:25:21','2021-06-09 02:19:07'),(2,'Jamboo Burger','Double Petty Jamboo Burger',120.00,1,NULL,NULL,1,1,'2021-06-09 01:25:21','2021-06-10 01:58:37');

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suppliers` */



insert  into `users`(`id`,`name`,`mobile_no`,`email`,`password`,`type`,`api_token`,`remember_token`,`deleted_at`,`created_at`,`updated_at`) values (1,'Super Admin','01675923371','admin@gmail.com','$2y$10$oGQg65L0wvthnZ5MAfSivu2OZtrU7USxeanvb3qu0LBa.MBzR4Qzq','system',NULL,NULL,NULL,'2021-06-01 03:17:56','2021-06-01 03:17:56');
