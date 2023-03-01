-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2023 at 09:41 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eamunc`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocs`
--

CREATE TABLE `blocs` (
  `id` bigint UNSIGNED NOT NULL,
  `committe_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocs`
--

INSERT INTO `blocs` (`id`, `committe_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Bloc 111', '2022-05-24 04:11:40', '2022-05-24 04:11:40', NULL),
(2, 1, 'Bloc 1', '2022-05-26 03:50:56', '2022-05-26 03:50:56', NULL),
(3, 2, 'Bloc 2', '2022-09-29 07:01:04', '2022-09-29 07:01:04', NULL),
(4, 5, 'Bloc 23', '2022-10-08 05:11:20', '2022-10-08 05:11:20', NULL),
(5, 2, 'Bloc 45', '2022-10-08 05:12:05', '2022-10-08 05:12:05', NULL),
(6, 2, 'Bloc 1', '2022-10-08 05:12:43', '2022-10-08 05:12:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bloc_chats`
--

CREATE TABLE `bloc_chats` (
  `id` bigint UNSIGNED NOT NULL,
  `bloc_id` int NOT NULL,
  `user_id` int NOT NULL,
  `committe_id` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bloc_chats`
--

INSERT INTO `bloc_chats` (`id`, `bloc_id`, `user_id`, `committe_id`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 10, 2, 'Hi', '2022-06-14 07:57:02', '2022-06-14 07:57:02', NULL),
(2, 1, 10, 2, 'Hlo', '2022-06-14 07:57:12', '2022-06-14 07:57:12', NULL),
(3, 1, 10, 2, 'ertyert', '2022-09-29 07:04:42', '2022-09-29 07:04:42', NULL),
(4, 3, 25, 2, 'werwer', '2022-09-29 07:05:33', '2022-09-29 07:05:33', NULL),
(5, 4, 29, 5, 'hi', '2022-10-08 10:44:29', '2022-10-08 10:44:29', NULL),
(6, 4, 29, 5, 'We at Indian School Al Ghubra are honored to have our MUNC to be associated with the memory of Late Mr. E. AHAMED, who was not only an excellent politician, but a virtuous man who represented those who', '2022-10-08 10:46:01', '2022-10-08 10:46:01', NULL),
(7, 2, 6, 1, 'test thuisd chat', '2023-02-25 19:44:44', '2023-02-25 19:44:44', NULL),
(8, 2, 31, 1, 'yes this is the resolution', '2023-02-25 19:46:25', '2023-02-25 19:46:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bloc_members`
--

CREATE TABLE `bloc_members` (
  `id` bigint UNSIGNED NOT NULL,
  `bloc_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bloc_members`
--

INSERT INTO `bloc_members` (`id`, `bloc_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 8, '2022-05-24 04:11:40', '2022-10-08 05:12:33', '2022-10-08 05:12:33'),
(2, 1, 9, '2022-05-24 04:11:40', '2022-10-08 05:12:33', '2022-10-08 05:12:33'),
(3, 2, 6, '2022-05-26 03:50:56', '2023-02-25 19:45:34', '2023-02-25 19:45:34'),
(4, 2, 6, '2022-05-26 03:51:27', '2023-02-25 19:45:34', '2023-02-25 19:45:34'),
(5, 2, 6, '2022-05-26 03:51:28', '2023-02-25 19:45:34', '2023-02-25 19:45:34'),
(6, 3, 24, '2022-09-29 07:01:04', '2022-09-29 07:05:23', '2022-09-29 07:05:23'),
(7, 1, 8, '2022-09-29 07:04:31', '2022-10-08 05:12:33', '2022-10-08 05:12:33'),
(8, 1, 9, '2022-09-29 07:04:31', '2022-10-08 05:12:33', '2022-10-08 05:12:33'),
(9, 3, 24, '2022-09-29 07:05:23', '2022-09-29 07:05:23', NULL),
(10, 3, 25, '2022-09-29 07:05:23', '2022-09-29 07:05:23', NULL),
(11, 4, 23, '2022-10-08 05:11:20', '2022-10-08 10:07:44', '2022-10-08 10:07:44'),
(12, 5, 27, '2022-10-08 05:12:05', '2022-10-08 05:12:05', NULL),
(13, 1, 8, '2022-10-08 05:12:33', '2022-10-08 05:12:33', NULL),
(14, 6, 9, '2022-10-08 05:12:43', '2022-10-08 05:12:43', NULL),
(15, 4, 23, '2022-10-08 10:07:44', '2022-10-08 10:07:44', NULL),
(16, 2, 6, '2023-02-25 19:45:34', '2023-02-25 19:45:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agenda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`id`, `name`, `image`, `title`, `agenda`, `sub_title`, `description`, `video`, `file`, `position`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SOCHUM', 'committee/1646976908_bgcjC_5242.png', 'Social, Humanitarian, and Cultural Committee', 'Medical Access In Low-Income And Low-Resource Countries', 'Letter from the President', 'Healthcare is a vitally important service, and according to the UN, a basic human\r\nright; however, hundreds of millions of people around the world today lack\r\naccess to proper medical care. The topic of medical access in low-income and\r\nlow-resource countries is an immensely complicated one, but it is essential that it\r\nbe addressed and acted upon promptly.\r\nA number of factors play into the lack of medical access in a given country, such\r\nas a shortage of medical personnel, inefficient administrative structure etc.\r\nThis background guide will attempt to give a brief overview of the topic, expose\r\ndelegates to some important factors to consider, and provide some links for\r\nfurther reading. It will provide the bare minimum of knowledge that is required of\r\nall delegates. Delegates must do further research and develop their country\r\nstances.', '5f-MZp1o0ZQ', NULL, 0, '2022-03-11 00:05:08', '2023-02-25 18:48:36', NULL),
(2, 'UNEP', 'committee/1646979963_I89yq_5496.png', 'United Nations Environment Programme', 'Reviewing the 2030 Agenda with special emphasis on the Environmental Dimension', 'Letter from the President', 'I am Kshama Mumbai, and it is my immense pleasure to serve as your Director General for the second edition of the virtual E.Ahmed Model United Nations Conference. 2020 has certainly been a year that has challenged us all. A crisis within a world largely in crisis, not quite the fairy tale we aspired for. The pandemic affected every age group; from young children to the older population. Businesses shut down, schools closed and even the greatest economies seemed to suffer terribly.\r\n\r\nHowever, chaos did not triumph as we began to see order in this world, and that delegates is the beauty of our reality. It is but a utopian world where there are no challenges, humanity has and will continue to face hurdles through its survival. But to find solutions to the same it is inevitable that we must come together as one. No problem is larger than the capability of humans to collectively solve it, provided we work as one.\r\n\r\nHenry Ford once said, “Coming together is a beginning; staying together is a process and working together is a success”. It is this very spirit that we at E.A.MUNC uphold. Through the conference you will realize that we do stand when we are united, and fall when we are divided. As you work to achieve consensus in your committees you are in the most basic sense, working for a better world. Let this conference serve as a stepping stone for you to endeavour towards a brighter future for us and the generations to come.', 'e2iGq6goQQk', NULL, 0, '2022-03-11 00:56:03', '2023-02-25 12:07:04', NULL),
(5, 'WHO', 'committee/1677310400_7HG9F_8617.jpg', 'World Health Organization', 'World Peace', 'COMMUNITY HEALTH CARE WORKERS: CHALLENGES AND  OPPORTUNITIES', 'The World Health Organization was created in 1948 to coordinate health affairs within the United\r\nNations system. Its initial priorities were malaria, and other communicable diseases, plus women\r\nand children’s health, nutrition, and sanitation. From the beginning, it worked with member\r\ncountries to spot and address public health issues, support health research and issue guidelines. It\r\nalso classified diseases. Additionally, to governments, WHO coordinated with other UN agencies,\r\ndonors, non-governmental organizations (NGOs) and therefore the private sector. Investigating\r\nand managing disease outbreaks was the responsibility of every individual country, although under\r\nthe International Health Regulations, governments were expected to report cases of a couple of\r\ncontagious diseases like plague and cholera. WHO had no authority to police what member\r\ncountries did. By 2003 WHO, headquartered in Geneva, was organized into 141 country offices\r\nwhich reported to 6 regional offices. It had 192 member countries and employed about 8,000\r\ndoctors, scientists, epidemiologists, managers, and administrators.\r\nThe First World Health Assembly met in Geneva within the summer of 1948 and established\r\npriorities for the organization: malaria, tuberculosis, venereal diseases, maternal and child health,\r\nsanitary engineering, and nutrition. The organization had a budget of US$5 million in 1948.\r\nadditionally, the Organization was involved in wide-ranging disease prevention and control efforts\r\nincluding mass campaigns against yaws, endemic syphilis, leprosy, and trachoma', 'u0rH8HjqW1o', NULL, 0, '2022-05-13 09:02:18', '2023-02-25 07:33:20', NULL),
(11, 'HSC', 'committee/1677351209_wjMsd_2967.jpg', 'HISTORICAL SECURITY COUNCIL', 'THE LIBYAN WAR OF 2011', 'THE LIBYAN WAR OF 2011', 'The Libyan Civil War is an ongoing conflict as of 18 October 2011 in Libya, a country located in\r\nSouthern Africa. This conflict resulted from the clash of forces of Colonel Muammar Gaddafi\r\nand certain foreign supported groups (hoping to overthrow the government led by Colonel\r\nMuammar Gaddafi).\r\n\r\nIn the beginning of 2011, amid a wave of protests throughout countries in the Middle East and\r\nNorth Africa, established organizations began to demonstrate large ‘peaceful’ protests against the\r\ndeep rooted regimes. This led to transfer of powers in Egypt and Tunisia.\r\nSimilar uprising protests against the four-decade rule of Muammar al-Gaddafi took place in\r\nLibya, which lead to a wide-spread civil war and intervention of the international military.', '7j5f4tgceEs', NULL, 0, '2023-02-25 18:53:29', '2023-02-25 18:57:32', NULL),
(12, 'UNHRC', 'committee/1677351796_Zofsi_8245.jpg', 'United Nations Human Rights Council.', 'to promote and protect human rights around the world', 'To promote and protect human rights around the world', 'To promote and protect human rights around the world', '', NULL, 0, '2023-02-25 19:03:16', '2023-02-25 19:03:16', NULL),
(13, 'ABS', 'committee/1677565789_AF8bI_1136.jpg', 'Advance Building Software', 'Digital Transofamtion of Data', 'ABS ERP', 'ERP software suitable for construction industry', '', NULL, 0, '2023-02-28 06:29:49', '2023-02-28 06:29:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `committee_files`
--

CREATE TABLE `committee_files` (
  `id` bigint UNSIGNED NOT NULL,
  `committe_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `committee_files`
--

INSERT INTO `committee_files` (`id`, `committe_id`, `name`, `file`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'samplepdf.pdf', 'committee/doc/1654511672_OjdQF_5583.pdf', '2022-06-06 10:34:32', '2023-02-25 12:13:13', '2023-02-25 12:13:13'),
(2, '1', 'sample - 1.pdf', 'committee/doc/1654511792_wG3yq_6382.pdf', '2022-06-06 10:36:32', '2022-06-06 10:36:32', NULL),
(3, '1', 'sample.pdf', 'committee/doc/1654511792_cSG46_5157.pdf', '2022-06-06 10:36:32', '2022-06-06 10:36:32', NULL),
(4, '5', 'WHO_Background Guide.pdf', 'committee/doc/1677164227_Ic5jR_2746.pdf', '2023-02-23 14:57:07', '2023-02-28 06:14:18', '2023-02-28 06:14:18'),
(5, '2', 'UNEP_Background Guide.pdf', 'committee/doc/1677326824_fCtka_5057.pdf', '2023-02-25 12:07:04', '2023-02-25 12:07:04', NULL),
(6, '1', 'SOCHUM_Background Guide.pdf', 'committee/doc/1677327219_3oBWA_8941.pdf', '2023-02-25 12:13:39', '2023-02-25 12:13:39', NULL),
(7, '11', 'HSC_Background Guide.pdf', 'committee/doc/1677351209_ltEHU_8183.pdf', '2023-02-25 18:53:29', '2023-02-25 18:53:29', NULL),
(8, '12', 'HSC_Background Guide.pdf', 'committee/doc/1677351796_AlMEU_4528.pdf', '2023-02-25 19:03:16', '2023-02-25 19:03:16', NULL),
(9, '5', 'office march events.docx', 'committee/doc/1677564903_pAhv7_6975.docx', '2023-02-28 06:15:03', '2023-02-28 06:15:03', NULL),
(10, '13', 'IMS SOFTWARE pdf.pdf', 'committee/doc/1677565789_7iQlR_1667.pdf', '2023-02-28 06:29:49', '2023-02-28 06:29:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `committee_members`
--

CREATE TABLE `committee_members` (
  `id` bigint UNSIGNED NOT NULL,
  `committe_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conference_schedules`
--

CREATE TABLE `conference_schedules` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conference_schedules`
--

INSERT INTO `conference_schedules` (`id`, `title`, `date`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Day One', '2023-03-10', 'Day One', '2022-03-10 23:26:56', '2023-01-21 08:36:14', NULL),
(2, 'Day Two', '2023-03-11', 'Day Two', '2022-03-10 23:27:50', '2023-01-21 08:36:04', NULL),
(3, 'Day Three', '2023-03-12', 'Day Three', '2022-03-10 23:29:24', '2023-01-21 08:35:55', NULL),
(4, 'Day Four', '2023-03-13', 'Day Four', '2022-06-18 11:39:33', '2023-01-21 08:42:44', NULL),
(5, 'Day Five', '2023-03-14', 'Day Five', '2023-01-21 08:41:17', '2023-01-21 08:43:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conference_schedule_times`
--

CREATE TABLE `conference_schedule_times` (
  `id` int UNSIGNED NOT NULL,
  `schedule_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conference_schedule_times`
--

INSERT INTO `conference_schedule_times` (`id`, `schedule_id`, `name`, `time_start`, `time_end`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 3, 'Committee Session III', '03:00:00', '07:45:00', NULL, NULL, NULL),
(18, 3, 'Break', '07:15:00', '07:30:00', NULL, NULL, NULL),
(19, 3, 'Valedictory Function', '07:30:00', '08:00:00', NULL, NULL, NULL),
(20, 2, 'Committee Session II', '03:00:00', '07:30:00', NULL, NULL, NULL),
(21, 1, 'Opening Ceremony', '15:00:00', '15:30:00', NULL, NULL, NULL),
(22, 1, 'Break', '03:30:00', '03:45:00', NULL, NULL, NULL),
(23, 1, 'Committee Session I', '03:30:00', '07:45:00', NULL, NULL, NULL),
(24, 1, 'Committee Session 2', '17:05:00', '18:02:00', NULL, NULL, NULL),
(29, 4, 'Committee Session 2', '16:00:00', '17:45:00', NULL, NULL, NULL),
(30, 4, 'Committee Session 2', '17:44:00', '18:44:00', NULL, NULL, NULL),
(31, 5, 'WHO kick off meeting', '12:41:00', '13:42:00', NULL, NULL, NULL),
(32, 5, 'SOCHUM kick off meeting', '15:42:00', '17:42:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `iso_alpha2` varchar(2) DEFAULT NULL,
  `iso_alpha3` varchar(3) DEFAULT NULL,
  `iso_numeric` int DEFAULT NULL,
  `currency_code` char(3) DEFAULT NULL,
  `currency_name` varchar(32) DEFAULT NULL,
  `currrency_symbol` varchar(3) DEFAULT NULL,
  `phone_code` varchar(6) DEFAULT NULL,
  `flag` varchar(6) DEFAULT NULL,
  `zoneID` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso_alpha2`, `iso_alpha3`, `iso_numeric`, `currency_code`, `currency_name`, `currrency_symbol`, `phone_code`, `flag`, `zoneID`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 4, 'AFN', 'Afghani', '؋', '93', 'AF.png', 1),
(2, 'Albania', 'AL', 'ALB', 8, 'ALL', 'Lek', 'Lek', '355', 'AL.png', 1),
(3, 'Algeria', 'DZ', 'DZA', 12, 'DZD', 'Dinar', NULL, '213', 'DZ.png', 1),
(4, 'American Samoa', 'AS', 'ASM', 16, 'USD', 'Dollar', '$', '1684', 'AS.png', 1),
(5, 'Andorra', 'AD', 'AND', 20, 'EUR', 'Euro', '€', '376', 'AD.png', 1),
(6, 'Angola', 'AO', 'AGO', 24, 'AOA', 'Kwanza', 'Kz', '244', 'AO.png', 1),
(7, 'Anguilla', 'AI', 'AIA', 660, 'XCD', 'Dollar', '$', '1264', 'AI.png', 1),
(8, 'Antarctica', 'AQ', 'ATA', 10, '', '', NULL, '0', 'AQ.png', 1),
(9, 'Antigua and Barbuda', 'AG', 'ATG', 28, 'XCD', 'Dollar', '$', '1268', 'AG.png', 1),
(10, 'Argentina', 'AR', 'ARG', 32, 'ARS', 'Peso', '$', '54', 'AR.png', 1),
(11, 'Armenia', 'AM', 'ARM', 51, 'AMD', 'Dram', NULL, '374', 'AM.png', 1),
(12, 'Aruba', 'AW', 'ABW', 533, 'AWG', 'Guilder', 'ƒ', '297', 'AW.png', 1),
(13, 'Australia', 'AU', 'AUS', 36, 'AUD', 'Dollar', '$', '61', 'AU.png', 1),
(14, 'Austria', 'AT', 'AUT', 40, 'EUR', 'Euro', '€', '43', 'AT.png', 1),
(15, 'Azerbaijan', 'AZ', 'AZE', 31, 'AZN', 'Manat', 'ман', '994', 'AZ.png', 1),
(16, 'Bahamas', 'BS', 'BHS', 44, 'BSD', 'Dollar', '$', '1242', 'BS.png', 1),
(17, 'Bahrain', 'BH', 'BHR', 48, 'BHD', 'Dinar', NULL, '973', 'BH.png', 1),
(18, 'Bangladesh', 'BD', 'BGD', 50, 'BDT', 'Taka', NULL, '880', 'BD.png', 1),
(19, 'Barbados', 'BB', 'BRB', 52, 'BBD', 'Dollar', '$', '1246', 'BB.png', 1),
(20, 'Belarus', 'BY', 'BLR', 112, 'BYR', 'Ruble', 'p.', '375', 'BY.png', 1),
(21, 'Belgium', 'BE', 'BEL', 56, 'EUR', 'Euro', '€', '32', 'BE.png', 1),
(22, 'Belize', 'BZ', 'BLZ', 84, 'BZD', 'Dollar', 'BZ$', '501', 'BZ.png', 1),
(23, 'Benin', 'BJ', 'BEN', 204, 'XOF', 'Franc', NULL, '229', 'BJ.png', 1),
(24, 'Bermuda', 'BM', 'BMU', 60, 'BMD', 'Dollar', '$', '1441', 'BM.png', 1),
(25, 'Bhutan', 'BT', 'BTN', 64, 'BTN', 'Ngultrum', NULL, '975', 'BT.png', 1),
(26, 'Bolivia', 'BO', 'BOL', 68, 'BOB', 'Boliviano', '$b', '591', 'BO.png', 1),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', 70, 'BAM', 'Marka', 'KM', '387', 'BA.png', 1),
(28, 'Botswana', 'BW', 'BWA', 72, 'BWP', 'Pula', 'P', '267', 'BW.png', 1),
(29, 'Bouvet Island', 'BV', 'BVT', 74, 'NOK', 'Krone', 'kr', '0', 'BV.png', 1),
(30, 'Brazil', 'BR', 'BRA', 76, 'BRL', 'Real', 'R$', '55', 'BR.png', 1),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', 86, 'USD', 'Dollar', '$', '246', 'IO.png', 1),
(32, 'British Virgin Islands', 'VG', 'VGB', 92, 'USD', 'Dollar', '$', '1284', 'VG.png', 1),
(33, 'Brunei', 'BN', 'BRN', 96, 'BND', 'Dollar', '$', '673', 'BN.png', 1),
(34, 'Bulgaria', 'BG', 'BGR', 100, 'BGN', 'Lev', 'лв', '359', 'BG.png', 1),
(35, 'Burkina Faso', 'BF', 'BFA', 854, 'XOF', 'Franc', NULL, '226', 'BF.png', 1),
(36, 'Burundi', 'BI', 'BDI', 108, 'BIF', 'Franc', NULL, '257', 'BI.png', 1),
(37, 'Cambodia', 'KH', 'KHM', 116, 'KHR', 'Riels', '៛', '855', 'KH.png', 1),
(38, 'Cameroon', 'CM', 'CMR', 120, 'XAF', 'Franc', 'FCF', '237', 'CM.png', 1),
(39, 'Canada', 'CA', 'CAN', 124, 'CAD', 'Dollar', '$', '1', 'CA.png', 1),
(40, 'Cape Verde', 'CV', 'CPV', 132, 'CVE', 'Escudo', NULL, '238', 'CV.png', 1),
(41, 'Cayman Islands', 'KY', 'CYM', 136, 'KYD', 'Dollar', '$', '1345', 'KY.png', 1),
(42, 'Central African Republic', 'CF', 'CAF', 140, 'XAF', 'Franc', 'FCF', '236', 'CF.png', 1),
(43, 'Chad', 'TD', 'TCD', 148, 'XAF', 'Franc', NULL, '235', 'TD.png', 1),
(44, 'Chile', 'CL', 'CHL', 152, 'CLP', 'Peso', NULL, '56', 'CL.png', 1),
(45, 'China', 'CN', 'CHN', 156, 'CNY', 'Yuan Renminbi', '¥', '86', 'CN.png', 1),
(46, 'Christmas Island', 'CX', 'CXR', 162, 'AUD', 'Dollar', '$', '61', 'CX.png', 1),
(47, 'Cocos Islands', 'CC', 'CCK', 166, 'AUD', 'Dollar', '$', '672', 'CC.png', 1),
(48, 'Colombia', 'CO', 'COL', 170, 'COP', 'Peso', '$', '57', 'CO.png', 1),
(49, 'Comoros', 'KM', 'COM', 174, 'KMF', 'Franc', NULL, '269', 'KM.png', 1),
(50, 'Cook Islands', 'CK', 'COK', 184, 'NZD', 'Dollar', '$', '682', 'CK.png', 1),
(51, 'Costa Rica', 'CR', 'CRI', 188, 'CRC', 'Colon', '₡', '506', 'CR.png', 1),
(52, 'Croatia', 'HR', 'HRV', 191, 'HRK', 'Kuna', 'kn', '385', 'HR.png', 1),
(53, 'Cuba', 'CU', 'CUB', 192, 'CUP', 'Peso', '₱', '53', 'CU.png', 1),
(54, 'Cyprus', 'CY', 'CYP', 196, 'CYP', 'Pound', NULL, '357', 'CY.png', 1),
(55, 'Czech Republic', 'CZ', 'CZE', 203, 'CZK', 'Koruna', 'Kč', '420', 'CZ.png', 1),
(56, 'Democratic Republic of the Congo', 'CD', 'COD', 180, 'CDF', 'Franc', NULL, '242', 'CD.png', 1),
(57, 'Denmark', 'DK', 'DNK', 208, 'DKK', 'Krone', 'kr', '45', 'DK.png', 1),
(58, 'Djibouti', 'DJ', 'DJI', 262, 'DJF', 'Franc', NULL, '253', 'DJ.png', 1),
(59, 'Dominica', 'DM', 'DMA', 212, 'XCD', 'Dollar', '$', '1767', 'DM.png', 1),
(60, 'Dominican Republic', 'DO', 'DOM', 214, 'DOP', 'Peso', 'RD$', '1809', 'DO.png', 1),
(61, 'East Timor', 'TL', 'TLS', 626, 'USD', 'Dollar', '$', '670', 'TL.png', 1),
(62, 'Ecuador', 'EC', 'ECU', 218, 'USD', 'Dollar', '$', '593', 'EC.png', 1),
(63, 'Egypt', 'EG', 'EGY', 818, 'EGP', 'Pound', '£', '20', 'EG.png', 1),
(64, 'El Salvador', 'SV', 'SLV', 222, 'SVC', 'Colone', '$', '503', 'SV.png', 1),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 226, 'XAF', 'Franc', 'FCF', '240', 'GQ.png', 1),
(66, 'Eritrea', 'ER', 'ERI', 232, 'ERN', 'Nakfa', 'Nfk', '291', 'ER.png', 1),
(67, 'Estonia', 'EE', 'EST', 233, 'EEK', 'Kroon', 'kr', '372', 'EE.png', 1),
(68, 'Ethiopia', 'ET', 'ETH', 231, 'ETB', 'Birr', NULL, '251', 'ET.png', 1),
(69, 'Falkland Islands', 'FK', 'FLK', 238, 'FKP', 'Pound', '£', '500', 'FK.png', 1),
(70, 'Faroe Islands', 'FO', 'FRO', 234, 'DKK', 'Krone', 'kr', '298', 'FO.png', 1),
(71, 'Fiji', 'FJ', 'FJI', 242, 'FJD', 'Dollar', '$', '679', 'FJ.png', 1),
(72, 'Finland', 'FI', 'FIN', 246, 'EUR', 'Euro', '€', '358', 'FI.png', 1),
(73, 'France', 'FR', 'FRA', 250, 'EUR', 'Euro', '€', '33', 'FR.png', 1),
(74, 'French Guiana', 'GF', 'GUF', 254, 'EUR', 'Euro', '€', '594', 'GF.png', 1),
(75, 'French Polynesia', 'PF', 'PYF', 258, 'XPF', 'Franc', NULL, '689', 'PF.png', 1),
(76, 'French Southern Territories', 'TF', 'ATF', 260, 'EUR', 'Euro  ', '€', '0', 'TF.png', 1),
(77, 'Gabon', 'GA', 'GAB', 266, 'XAF', 'Franc', 'FCF', '241', 'GA.png', 1),
(78, 'Gambia', 'GM', 'GMB', 270, 'GMD', 'Dalasi', 'D', '220', 'GM.png', 1),
(79, 'Georgia', 'GE', 'GEO', 268, 'GEL', 'Lari', NULL, '995', 'GE.png', 1),
(80, 'Germany', 'DE', 'DEU', 276, 'EUR', 'Euro', '€', '49', 'DE.png', 1),
(81, 'Ghana', 'GH', 'GHA', 288, 'GHC', 'Cedi', '¢', '233', 'GH.png', 1),
(82, 'Gibraltar', 'GI', 'GIB', 292, 'GIP', 'Pound', '£', '350', 'GI.png', 1),
(83, 'Greece', 'GR', 'GRC', 300, 'EUR', 'Euro', '€', '30', 'GR.png', 1),
(84, 'Greenland', 'GL', 'GRL', 304, 'DKK', 'Krone', 'kr', '299', 'GL.png', 1),
(85, 'Grenada', 'GD', 'GRD', 308, 'XCD', 'Dollar', '$', '1473', 'GD.png', 1),
(86, 'Guadeloupe', 'GP', 'GLP', 312, 'EUR', 'Euro', '€', '590', 'GP.png', 1),
(87, 'Guam', 'GU', 'GUM', 316, 'USD', 'Dollar', '$', '1671', 'GU.png', 1),
(88, 'Guatemala', 'GT', 'GTM', 320, 'GTQ', 'Quetzal', 'Q', '502', 'GT.png', 1),
(89, 'Guinea', 'GN', 'GIN', 324, 'GNF', 'Franc', NULL, '224', 'GN.png', 1),
(90, 'Guinea-Bissau', 'GW', 'GNB', 624, 'XOF', 'Franc', NULL, '245', 'GW.png', 1),
(91, 'Guyana', 'GY', 'GUY', 328, 'GYD', 'Dollar', '$', '592', 'GY.png', 1),
(92, 'Haiti', 'HT', 'HTI', 332, 'HTG', 'Gourde', 'G', '509', 'HT.png', 1),
(93, 'Heard Island and McDonald Islands', 'HM', 'HMD', 334, 'AUD', 'Dollar', '$', '0', 'HM.png', 1),
(94, 'Honduras', 'HN', 'HND', 340, 'HNL', 'Lempira', 'L', '504', 'HN.png', 1),
(95, 'Hong Kong', 'HK', 'HKG', 344, 'HKD', 'Dollar', '$', '852', 'HK.png', 1),
(96, 'Hungary', 'HU', 'HUN', 348, 'HUF', 'Forint', 'Ft', '36', 'HU.png', 1),
(97, 'Iceland', 'IS', 'ISL', 352, 'ISK', 'Krona', 'kr', '354', 'IS.png', 1),
(98, 'India', 'IN', 'IND', 356, 'INR', 'Rupee', '₹', '91', 'IN.png', 1),
(99, 'Indonesia', 'ID', 'IDN', 360, 'IDR', 'Rupiah', 'Rp', '62', 'ID.png', 1),
(100, 'Iran', 'IR', 'IRN', 364, 'IRR', 'Rial', '﷼', '98', 'IR.png', 1),
(101, 'Iraq', 'IQ', 'IRQ', 368, 'IQD', 'Dinar', NULL, '964', 'IQ.png', 1),
(102, 'Ireland', 'IE', 'IRL', 372, 'EUR', 'Euro', '€', '353', 'IE.png', 1),
(103, 'Israel', 'IL', 'ISR', 376, 'ILS', 'Shekel', '₪', '972', 'IL.png', 1),
(104, 'Italy', 'IT', 'ITA', 380, 'EUR', 'Euro', '€', '39', 'IT.png', 1),
(105, 'Ivory Coast', 'CI', 'CIV', 384, 'XOF', 'Franc', NULL, '225', 'CI.png', 1),
(106, 'Jamaica', 'JM', 'JAM', 388, 'JMD', 'Dollar', '$', '1876', 'JM.png', 1),
(107, 'Japan', 'JP', 'JPN', 392, 'JPY', 'Yen', '¥', '81', 'JP.png', 1),
(108, 'Jordan', 'JO', 'JOR', 400, 'JOD', 'Dinar', NULL, '962', 'JO.png', 1),
(109, 'Kazakhstan', 'KZ', 'KAZ', 398, 'KZT', 'Tenge', 'лв', '7', 'KZ.png', 1),
(110, 'Kenya', 'KE', 'KEN', 404, 'KES', 'Shilling', NULL, '254', 'KE.png', 1),
(111, 'Kiribati', 'KI', 'KIR', 296, 'AUD', 'Dollar', '$', '686', 'KI.png', 1),
(112, 'Kuwait', 'KW', 'KWT', 414, 'KWD', 'Dinar', NULL, '965', 'KW.png', 1),
(113, 'Kyrgyzstan', 'KG', 'KGZ', 417, 'KGS', 'Som', 'лв', '996', 'KG.png', 1),
(114, 'Laos', 'LA', 'LAO', 418, 'LAK', 'Kip', '₭', '856', 'LA.png', 1),
(115, 'Latvia', 'LV', 'LVA', 428, 'LVL', 'Lat', 'Ls', '371', 'LV.png', 1),
(116, 'Lebanon', 'LB', 'LBN', 422, 'LBP', 'Pound', '£', '961', 'LB.png', 1),
(117, 'Lesotho', 'LS', 'LSO', 426, 'LSL', 'Loti', 'L', '266', 'LS.png', 1),
(118, 'Liberia', 'LR', 'LBR', 430, 'LRD', 'Dollar', '$', '231', 'LR.png', 1),
(119, 'Libya', 'LY', 'LBY', 434, 'LYD', 'Dinar', NULL, '218', 'LY.png', 1),
(120, 'Liechtenstein', 'LI', 'LIE', 438, 'CHF', 'Franc', 'CHF', '423', 'LI.png', 1),
(121, 'Lithuania', 'LT', 'LTU', 440, 'LTL', 'Litas', 'Lt', '370', 'LT.png', 1),
(122, 'Luxembourg', 'LU', 'LUX', 442, 'EUR', 'Euro', '€', '352', 'LU.png', 1),
(123, 'Macao', 'MO', 'MAC', 446, 'MOP', 'Pataca', 'MOP', '853', 'MO.png', 1),
(124, 'Macedonia', 'MK', 'MKD', 807, 'MKD', 'Denar', 'ден', '389', 'MK.png', 1),
(125, 'Madagascar', 'MG', 'MDG', 450, 'MGA', 'Ariary', NULL, '261', 'MG.png', 1),
(126, 'Malawi', 'MW', 'MWI', 454, 'MWK', 'Kwacha', 'MK', '265', 'MW.png', 1),
(127, 'Malaysia', 'MY', 'MYS', 458, 'MYR', 'Ringgit', 'RM', '60', 'MY.png', 1),
(128, 'Maldives', 'MV', 'MDV', 462, 'MVR', 'Rufiyaa', 'Rf', '960', 'MV.png', 1),
(129, 'Mali', 'ML', 'MLI', 466, 'XOF', 'Franc', NULL, '223', 'ML.png', 1),
(130, 'Malta', 'MT', 'MLT', 470, 'MTL', 'Lira', NULL, '356', 'MT.png', 1),
(131, 'Marshall Islands', 'MH', 'MHL', 584, 'USD', 'Dollar', '$', '692', 'MH.png', 1),
(132, 'Martinique', 'MQ', 'MTQ', 474, 'EUR', 'Euro', '€', '596', 'MQ.png', 1),
(133, 'Mauritania', 'MR', 'MRT', 478, 'MRO', 'Ouguiya', 'UM', '222', 'MR.png', 1),
(134, 'Mauritius', 'MU', 'MUS', 480, 'MUR', 'Rupee', '₨', '230', 'MU.png', 1),
(135, 'Mayotte', 'YT', 'MYT', 175, 'EUR', 'Euro', '€', '269', 'YT.png', 1),
(136, 'Mexico', 'MX', 'MEX', 484, 'MXN', 'Peso', '$', '52', 'MX.png', 1),
(137, 'Micronesia', 'FM', 'FSM', 583, 'USD', 'Dollar', '$', '691', 'FM.png', 1),
(138, 'Moldova', 'MD', 'MDA', 498, 'MDL', 'Leu', NULL, '373', 'MD.png', 1),
(139, 'Monaco', 'MC', 'MCO', 492, 'EUR', 'Euro', '€', '377', 'MC.png', 1),
(140, 'Mongolia', 'MN', 'MNG', 496, 'MNT', 'Tugrik', '₮', '976', 'MN.png', 1),
(141, 'Montserrat', 'MS', 'MSR', 500, 'XCD', 'Dollar', '$', '1664', 'MS.png', 1),
(142, 'Morocco', 'MA', 'MAR', 504, 'MAD', 'Dirham', NULL, '212', 'MA.png', 1),
(143, 'Mozambique', 'MZ', 'MOZ', 508, 'MZN', 'Meticail', 'MT', '258', 'MZ.png', 1),
(144, 'Myanmar', 'MM', 'MMR', 104, 'MMK', 'Kyat', 'K', '95', 'MM.png', 1),
(145, 'Namibia', 'NA', 'NAM', 516, 'NAD', 'Dollar', '$', '264', 'NA.png', 1),
(146, 'Nauru', 'NR', 'NRU', 520, 'AUD', 'Dollar', '$', '674', 'NR.png', 1),
(147, 'Nepal', 'NP', 'NPL', 524, 'NPR', 'Rupee', '₨', '977', 'NP.png', 1),
(148, 'Netherlands', 'NL', 'NLD', 528, 'EUR', 'Euro', '€', '31', 'NL.png', 1),
(149, 'Netherlands Antilles', 'AN', 'ANT', 530, 'ANG', 'Guilder', 'ƒ', '599', 'AN.png', 1),
(150, 'New Caledonia', 'NC', 'NCL', 540, 'XPF', 'Franc', NULL, '687', 'NC.png', 1),
(151, 'New Zealand', 'NZ', 'NZL', 554, 'NZD', 'Dollar', '$', '64', 'NZ.png', 1),
(152, 'Nicaragua', 'NI', 'NIC', 558, 'NIO', 'Cordoba', 'C$', '505', 'NI.png', 1),
(153, 'Niger', 'NE', 'NER', 562, 'XOF', 'Franc', NULL, '227', 'NE.png', 1),
(154, 'Nigeria', 'NG', 'NGA', 566, 'NGN', 'Naira', '₦', '234', 'NG.png', 1),
(155, 'Niue', 'NU', 'NIU', 570, 'NZD', 'Dollar', '$', '683', 'NU.png', 1),
(156, 'Norfolk Island', 'NF', 'NFK', 574, 'AUD', 'Dollar', '$', '672', 'NF.png', 1),
(157, 'North Korea', 'KP', 'PRK', 408, 'KPW', 'Won', '₩', '850', 'KP.png', 1),
(158, 'Northern Mariana Islands', 'MP', 'MNP', 580, 'USD', 'Dollar', '$', '1670', 'MP.png', 1),
(159, 'Norway', 'NO', 'NOR', 578, 'NOK', 'Krone', 'kr', '47', 'NO.png', 1),
(160, 'Oman', 'OM', 'OMN', 512, 'OMR', 'Rial', '﷼', '968', 'OM.png', 1),
(161, 'Pakistan', 'PK', 'PAK', 586, 'PKR', 'Rupee', '₨', '92', 'PK.png', 1),
(162, 'Palau', 'PW', 'PLW', 585, 'USD', 'Dollar', '$', '680', 'PW.png', 1),
(163, 'Palestinian Territory', 'PS', 'PSE', 275, 'ILS', 'Shekel', '₪', '970', 'PS.png', 1),
(164, 'Panama', 'PA', 'PAN', 591, 'PAB', 'Balboa', 'B/.', '507', 'PA.png', 1),
(165, 'Papua New Guinea', 'PG', 'PNG', 598, 'PGK', 'Kina', NULL, '675', 'PG.png', 1),
(166, 'Paraguay', 'PY', 'PRY', 600, 'PYG', 'Guarani', 'Gs', '595', 'PY.png', 1),
(167, 'Peru', 'PE', 'PER', 604, 'PEN', 'Sol', 'S/.', '51', 'PE.png', 1),
(168, 'Philippines', 'PH', 'PHL', 608, 'PHP', 'Peso', 'Php', '63', 'PH.png', 1),
(169, 'Pitcairn', 'PN', 'PCN', 612, 'NZD', 'Dollar', '$', '0', 'PN.png', 1),
(170, 'Poland', 'PL', 'POL', 616, 'PLN', 'Zloty', 'zł', '48', 'PL.png', 1),
(171, 'Portugal', 'PT', 'PRT', 620, 'EUR', 'Euro', '€', '351', 'PT.png', 1),
(172, 'Puerto Rico', 'PR', 'PRI', 630, 'USD', 'Dollar', '$', '1787', 'PR.png', 1),
(173, 'Qatar', 'QA', 'QAT', 634, 'QAR', 'Rial', '﷼', '974', 'QA.png', 1),
(174, 'Republic of the Congo', 'CG', 'COG', 178, 'XAF', 'Franc', 'FCF', '242', 'CG.png', 1),
(175, 'Reunion', 'RE', 'REU', 638, 'EUR', 'Euro', '€', '262', 'RE.png', 1),
(176, 'Romania', 'RO', 'ROU', 642, 'RON', 'Leu', 'lei', '40', 'RO.png', 1),
(177, 'Russia', 'RU', 'RUS', 643, 'RUB', 'Ruble', 'руб', '70', 'RU.png', 1),
(178, 'Rwanda', 'RW', 'RWA', 646, 'RWF', 'Franc', NULL, '250', 'RW.png', 1),
(179, 'Saint Helena', 'SH', 'SHN', 654, 'SHP', 'Pound', '£', '290', 'SH.png', 1),
(180, 'Saint Kitts and Nevis', 'KN', 'KNA', 659, 'XCD', 'Dollar', '$', '1869', 'KN.png', 1),
(181, 'Saint Lucia', 'LC', 'LCA', 662, 'XCD', 'Dollar', '$', '1758', 'LC.png', 1),
(182, 'Saint Pierre and Miquelon', 'PM', 'SPM', 666, 'EUR', 'Euro', '€', '508', 'PM.png', 1),
(183, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 670, 'XCD', 'Dollar', '$', '1784', 'VC.png', 1),
(184, 'Samoa', 'WS', 'WSM', 882, 'WST', 'Tala', 'WS$', '684', 'WS.png', 1),
(185, 'San Marino', 'SM', 'SMR', 674, 'EUR', 'Euro', '€', '378', 'SM.png', 1),
(186, 'Sao Tome and Principe', 'ST', 'STP', 678, 'STD', 'Dobra', 'Db', '239', 'ST.png', 1),
(187, 'Saudi Arabia', 'SA', 'SAU', 682, 'SAR', 'Rial', '﷼', '966', 'SA.png', 1),
(188, 'Senegal', 'SN', 'SEN', 686, 'XOF', 'Franc', NULL, '221', 'SN.png', 1),
(189, 'Serbia and Montenegro', 'CS', 'SCG', 891, 'RSD', 'Dinar', 'Дин', '381', 'CS.png', 1),
(190, 'Seychelles', 'SC', 'SYC', 690, 'SCR', 'Rupee', '₨', '248', 'SC.png', 1),
(191, 'Sierra Leone', 'SL', 'SLE', 694, 'SLL', 'Leone', 'Le', '232', 'SL.png', 1),
(192, 'Singapore', 'SG', 'SGP', 702, 'SGD', 'Dollar', '$', '65', 'SG.png', 1),
(193, 'Slovakia', 'SK', 'SVK', 703, 'SKK', 'Koruna', 'Sk', '421', 'SK.png', 1),
(194, 'Slovenia', 'SI', 'SVN', 705, 'EUR', 'Euro', '€', '386', 'SI.png', 1),
(195, 'Solomon Islands', 'SB', 'SLB', 90, 'SBD', 'Dollar', '$', '677', 'SB.png', 1),
(196, 'Somalia', 'SO', 'SOM', 706, 'SOS', 'Shilling', 'S', '252', 'SO.png', 1),
(197, 'South Africa', 'ZA', 'ZAF', 710, 'ZAR', 'Rand', 'R', '27', 'ZA.png', 1),
(198, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 239, 'GBP', 'Pound', '£', '0', 'GS.png', 1),
(199, 'South Korea', 'KR', 'KOR', 410, 'KRW', 'Won', '₩', '82', 'KR.png', 1),
(200, 'Spain', 'ES', 'ESP', 724, 'EUR', 'Euro', '€', '34', 'ES.png', 1),
(201, 'Sri Lanka', 'LK', 'LKA', 144, 'LKR', 'Rupee', '₨', '94', 'LK.png', 1),
(202, 'Sudan', 'SD', 'SDN', 736, 'SDD', 'Dinar', NULL, '249', 'SD.png', 1),
(203, 'Suriname', 'SR', 'SUR', 740, 'SRD', 'Dollar', '$', '597', 'SR.png', 1),
(204, 'Svalbard and Jan Mayen', 'SJ', 'SJM', 744, 'NOK', 'Krone', 'kr', '47', 'SJ.png', 1),
(205, 'Swaziland', 'SZ', 'SWZ', 748, 'SZL', 'Lilangeni', NULL, '268', 'SZ.png', 1),
(206, 'Sweden', 'SE', 'SWE', 752, 'SEK', 'Krona', 'kr', '46', 'SE.png', 1),
(207, 'Switzerland', 'CH', 'CHE', 756, 'CHF', 'Franc', 'CHF', '41', 'CH.png', 1),
(208, 'Syria', 'SY', 'SYR', 760, 'SYP', 'Pound', '£', '963', 'SY.png', 1),
(209, 'Taiwan', 'TW', 'TWN', 158, 'TWD', 'Dollar', 'NT$', '886', 'TW.png', 1),
(210, 'Tajikistan', 'TJ', 'TJK', 762, 'TJS', 'Somoni', NULL, '992', 'TJ.png', 1),
(211, 'Tanzania', 'TZ', 'TZA', 834, 'TZS', 'Shilling', NULL, '255', 'TZ.png', 1),
(212, 'Thailand', 'TH', 'THA', 764, 'THB', 'Baht', '฿', '66', 'TH.png', 1),
(213, 'Togo', 'TG', 'TGO', 768, 'XOF', 'Franc', NULL, '228', 'TG.png', 1),
(214, 'Tokelau', 'TK', 'TKL', 772, 'NZD', 'Dollar', '$', '690', 'TK.png', 1),
(215, 'Tonga', 'TO', 'TON', 776, 'TOP', 'Pa\'anga', 'T$', '676', 'TO.png', 1),
(216, 'Trinidad and Tobago', 'TT', 'TTO', 780, 'TTD', 'Dollar', 'TT$', '1868', 'TT.png', 1),
(217, 'Tunisia', 'TN', 'TUN', 788, 'TND', 'Dinar', NULL, '216', 'TN.png', 1),
(218, 'Turkey', 'TR', 'TUR', 792, 'TRY', 'Lira', 'YTL', '90', 'TR.png', 1),
(219, 'Turkmenistan', 'TM', 'TKM', 795, 'TMM', 'Manat', 'm', '7370', 'TM.png', 1),
(220, 'Turks and Caicos Islands', 'TC', 'TCA', 796, 'USD', 'Dollar', '$', '1649', 'TC.png', 1),
(221, 'Tuvalu', 'TV', 'TUV', 798, 'AUD', 'Dollar', '$', '688', 'TV.png', 1),
(222, 'U.S. Virgin Islands', 'VI', 'VIR', 850, 'USD', 'Dollar', '$', '1340', 'VI.png', 1),
(223, 'Uganda', 'UG', 'UGA', 800, 'UGX', 'Shilling', NULL, '256', 'UG.png', 1),
(224, 'Ukraine', 'UA', 'UKR', 804, 'UAH', 'Hryvnia', '₴', '380', 'UA.png', 1),
(225, 'United Arab Emirates', 'AE', 'ARE', 784, 'AED', 'Dirham', NULL, '971', 'AE.png', 1),
(226, 'United Kingdom', 'GB', 'GBR', 826, 'GBP', 'Pound', '£', '44', 'GB.png', 1),
(227, 'United States', 'US', 'USA', 840, 'USD', 'Dollar', '$', '1', 'US.png', 1),
(228, 'United States Minor Outlying Islands', 'UM', 'UMI', 581, 'USD', 'Dollar ', '$', '1', 'UM.png', 1),
(229, 'Uruguay', 'UY', 'URY', 858, 'UYU', 'Peso', '$U', '598', 'UY.png', 1),
(230, 'Uzbekistan', 'UZ', 'UZB', 860, 'UZS', 'Som', 'лв', '998', 'UZ.png', 1),
(231, 'Vanuatu', 'VU', 'VUT', 548, 'VUV', 'Vatu', 'Vt', '678', 'VU.png', 1),
(232, 'Vatican', 'VA', 'VAT', 336, 'EUR', 'Euro', '€', '39', 'VA.png', 1),
(233, 'Venezuela', 'VE', 'VEN', 862, 'VEF', 'Bolivar', 'Bs', '58', 'VE.png', 1),
(234, 'Vietnam', 'VN', 'VNM', 704, 'VND', 'Dong', '₫', '84', 'VN.png', 1),
(235, 'Wallis and Futuna', 'WF', 'WLF', 876, 'XPF', 'Franc', NULL, '681', 'WF.png', 1),
(236, 'Western Sahara', 'EH', 'ESH', 732, 'MAD', 'Dirham', NULL, '212', 'EH.png', 1),
(237, 'Yemen', 'YE', 'YEM', 887, 'YER', 'Rial', '﷼', '967', 'YE.png', 1),
(238, 'Zambia', 'ZM', 'ZMB', 894, 'ZMK', 'Kwacha', 'ZK', '260', 'ZM.png', 1),
(239, 'Zimbabwe', 'ZW', 'ZWE', 716, 'ZWD', 'Dollar', 'Z$', '263', 'ZW.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint UNSIGNED NOT NULL,
  `delegate_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `committee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_answer`
--

CREATE TABLE `feedback_answer` (
  `id` bigint UNSIGNED NOT NULL,
  `feedback_id` int NOT NULL,
  `question_id` int NOT NULL,
  `answers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_question`
--

CREATE TABLE `feedback_question` (
  `id` bigint UNSIGNED NOT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback_question`
--

INSERT INTO `feedback_question` (`id`, `question`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Do you plan to attend this conference in the future? *', NULL, NULL, NULL),
(2, 'How would you grade this conference from the scale of 1 to 10', NULL, NULL, NULL),
(3, 'How satisfied are you with the quality of networking opportunities at EAMUNC', NULL, NULL, NULL),
(4, 'How likely are you to recommend this conference to your peers?', NULL, NULL, NULL),
(5, 'How would you grade your bureau members?', NULL, NULL, NULL),
(6, 'How can we improve for next year?', NULL, NULL, NULL),
(7, 'What did you like the most about E.A.MUNC?', NULL, NULL, NULL),
(8, 'Which topics would you like to explore in future sessions?', NULL, NULL, NULL),
(9, 'How did the conference influence your perception about MUNC?', NULL, NULL, NULL),
(10, 'What were your favorite experiences or moments at this conference?', NULL, NULL, NULL),
(11, 'Do you have any other suggestions or feedback that you would like to share?', NULL, '2022-03-18 22:35:03', '2022-03-18 22:35:03'),
(12, 'SDSD', '2022-03-18 04:54:49', '2022-03-18 04:54:56', '2022-03-18 04:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=>inactive,1=>active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `cover_image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Conference', 'gallery/1646980514_LuDLg_7863.jpg', 1, '2022-03-11 01:05:14', '2022-03-11 01:07:37', NULL),
(2, 'Past Conferences', 'gallery/1665297352_7Pvip_4411.jpg', 1, '2022-10-09 06:35:52', '2022-10-09 06:36:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint UNSIGNED NOT NULL,
  `connect_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `connect_id`, `type`, `name`, `video`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'gallery', NULL, NULL, 'gallery/1646980657_slIjw_9822.jpg', '2022-03-11 01:07:37', '2022-03-11 01:07:37', NULL),
(2, '1', 'gallery', NULL, NULL, 'gallery/1646980661_1rQnT_9006.jpg', '2022-03-11 01:07:41', '2022-03-11 01:07:41', NULL),
(3, '1', 'gallery', NULL, NULL, 'gallery/1646980666_rbFuQ_2639.jpg', '2022-03-11 01:07:46', '2022-03-11 01:07:46', NULL),
(4, '1', 'gallery', NULL, NULL, 'gallery/1646980670_xtL2a_2711.jpg', '2022-03-11 01:07:50', '2022-03-11 01:07:50', NULL),
(5, '1', 'gallery', NULL, NULL, 'gallery/1646980675_pzfqY_4658.jpg', '2022-03-11 01:07:55', '2022-03-11 01:07:55', NULL),
(6, '37', 'past_conference', NULL, NULL, 'conference/1646983346_ZiQnK_1256.jpg', '2022-03-11 01:52:26', '2022-03-11 01:52:34', '2022-03-11 01:52:34'),
(7, '37', 'past_conference', NULL, NULL, 'conference/1646983429_gEfj6_8653.jpg', '2022-03-11 01:53:49', '2022-03-11 01:53:49', NULL),
(8, '37', 'past_conference', NULL, NULL, 'conference/1646983485_E5HVR_7963.jpg', '2022-03-11 01:54:45', '2022-03-11 01:54:45', NULL),
(9, '37', 'past_conference', NULL, NULL, 'conference/1646983489_qBKwX_8645.jpg', '2022-03-11 01:54:49', '2022-03-11 01:54:49', NULL),
(10, '2', 'gallery', NULL, NULL, 'gallery/1665297366_MhQ7C_6524.jpg', '2022-10-09 06:36:06', '2022-10-09 06:36:06', NULL),
(11, '2', 'gallery', NULL, NULL, 'gallery/1665297374_CocZv_1387.jpg', '2022-10-09 06:36:14', '2022-10-09 06:36:14', NULL),
(12, '2', 'gallery', NULL, NULL, 'gallery/1665297384_pfN1f_8355.jpg', '2022-10-09 06:36:24', '2022-10-09 06:36:24', NULL),
(13, '2', 'gallery', NULL, NULL, 'gallery/1665297476_lI40z_1302.jpg', '2022-10-09 06:37:56', '2022-10-09 06:37:56', NULL),
(14, '2', 'gallery', NULL, NULL, 'gallery/1665297485_pnlS3_9705.jpg', '2022-10-09 06:38:06', '2022-10-09 06:38:06', NULL),
(15, '2', 'gallery', NULL, NULL, 'gallery/1665297492_nvk2G_7796.jpg', '2022-10-09 06:38:12', '2022-10-09 06:38:12', NULL),
(16, '2', 'gallery', NULL, NULL, 'gallery/1665297498_GcAHL_4312.jpg', '2022-10-09 06:38:18', '2022-10-09 06:38:18', NULL),
(17, '2', 'gallery', NULL, NULL, 'gallery/1665297510_u04ea_3644.jpg', '2022-10-09 06:38:30', '2022-10-09 06:38:30', NULL),
(18, '2', 'gallery', NULL, NULL, 'gallery/1665297518_QQYNG_7577.jpg', '2022-10-09 06:38:38', '2022-10-09 06:38:38', NULL),
(19, '2', 'gallery', NULL, NULL, 'gallery/1665297524_m4PtJ_4366.jpg', '2022-10-09 06:38:44', '2022-10-09 06:38:44', NULL),
(20, '2', 'gallery', NULL, NULL, 'gallery/1665297530_N2l7R_9120.jpg', '2022-10-09 06:38:50', '2022-10-09 06:38:50', NULL),
(21, '2', 'gallery', NULL, NULL, 'gallery/1665297535_H1utc_4921.jpg', '2022-10-09 06:38:55', '2022-10-09 06:38:55', NULL),
(22, '2', 'gallery', NULL, NULL, 'gallery/1665297548_CX4Yp_5455.jpg', '2022-10-09 06:39:08', '2022-10-09 06:39:08', NULL),
(23, '2', 'gallery', NULL, NULL, 'gallery/1665297554_7kdxG_5584.jpg', '2022-10-09 06:39:14', '2022-10-09 06:39:14', NULL),
(24, '2', 'gallery', NULL, NULL, 'gallery/1665297559_S8UVX_5003.jpg', '2022-10-09 06:39:19', '2022-10-09 06:39:19', NULL),
(25, '65', 'past_conference', NULL, NULL, 'conference/1677353029_Ihbeb_8147.jpeg', '2023-02-25 19:23:49', '2023-02-25 19:23:49', NULL),
(26, '65', 'past_conference', NULL, NULL, 'conference/1677353038_Cxovp_7041.jpeg', '2023-02-25 19:23:58', '2023-02-25 19:23:58', NULL),
(27, '65', 'past_conference', NULL, NULL, 'conference/1677353047_AJyU0_5703.jpeg', '2023-02-25 19:24:07', '2023-02-25 19:24:07', NULL),
(28, '65', 'past_conference', NULL, NULL, 'conference/1677353218_mxvOg_6974.jpeg', '2023-02-25 19:26:58', '2023-02-25 19:26:58', NULL),
(29, '65', 'past_conference', NULL, NULL, 'conference/1677353234_FYhfP_9743.jpeg', '2023-02-25 19:27:14', '2023-02-25 19:27:14', NULL),
(30, '65', 'past_conference', NULL, NULL, 'conference/1677353244_qNZYp_4754.jpeg', '2023-02-25 19:27:24', '2023-02-25 19:27:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `line_by_line`
--

CREATE TABLE `line_by_line` (
  `id` bigint UNSIGNED NOT NULL,
  `committe_id` int NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `line_by_line`
--

INSERT INTO `line_by_line` (`id`, `committe_id`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '<p>testing this is a propoer chat and editor so that everytine can see this</p>', '2023-02-25 19:52:32', '2023-02-25 19:52:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_05_112921_create_images_table', 1),
(6, '2022_03_05_113256_create_galleries_table', 1),
(7, '2022_03_08_033357_create_conference_schedules_table', 1),
(8, '2022_03_08_034137_create_conference_schedule_times_table', 1),
(9, '2022_03_09_034035_create_site_indexes_table', 1),
(10, '2022_03_09_091112_create_committees_table', 1),
(11, '2022_03_09_111557_create_committee_members_table', 1),
(13, '2022_03_15_090645_create_schools_table', 3),
(15, '2022_03_15_100329_create_feedback_qsns_table', 4),
(16, '2022_03_15_100443_create_feedback_table', 4),
(17, '2022_03_15_100918_create_feedback_ans_table', 4),
(18, '2022_05_12_071454_create_students_table', 5),
(19, '2022_05_16_051627_create_speakers_table', 6),
(20, '2022_05_16_103047_create_blocs_table', 7),
(21, '2022_05_16_103115_create_bloc_members_table', 8),
(22, '2022_05_17_094214_create_bloc_chat_table', 9),
(23, '2022_05_18_102647_create_paper_submissions_table', 10),
(24, '2022_05_19_061653_create_vienna_formula_table', 11),
(25, '2022_05_19_061912_create_line_by_line_table', 12),
(26, '2022_05_19_062011_create_resolution_table', 13),
(27, '2022_05_20_060513_create_program_schedules_table', 14),
(28, '2022_05_20_060612_create_program_schedule_times_table', 15),
(29, '2022_05_23_110417_create_committee_files_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `paper_submissions`
--

CREATE TABLE `paper_submissions` (
  `id` bigint UNSIGNED NOT NULL,
  `committe_id` int NOT NULL,
  `user_id` int NOT NULL,
  `paper` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `paper_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paper_submissions`
--

INSERT INTO `paper_submissions` (`id`, `committe_id`, `user_id`, `paper`, `paper_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 11, 'paper/1653365574_KVABL_3195.pdf', 'samplepdf.pdf', '2022-05-24 04:12:54', '2022-05-24 04:12:54', NULL),
(2, 2, 25, 'paper/1664360442_59gVu_6622.docx', 'circular.docx', '2022-09-28 10:20:42', '2022-09-28 10:20:42', NULL),
(3, 5, 28, 'paper/1665205772_KuXPE_6824.docx', 'Question paper sheet.docx', '2022-10-08 05:09:32', '2022-10-08 05:09:32', NULL),
(4, 1, 6, 'paper/1677353994_NsOee_9048.docx', 'Round Square - Basket ball collaboration circular.docx', '2023-02-25 19:39:54', '2023-02-25 19:39:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ajil2@advance.com', 'wg7cWmqwIUEyHHuZg3zHsN8yAUcAJDI2xaiOfvTx8JvODqay7p7pUfKK8Gyt3tQN', '2022-05-12 06:20:27'),
('admin@admin.com', 'EI7vaGoIk9FiVREnCuDnvHzjsi4SWH7ynZ3ZMqj7ph4pQxb4Q0EWN6TsDG62CABf', '2022-05-12 06:25:49'),
('dony@dpsdoha.com', '1Lwmg2zIEhLjvlaagMYE8lZNVkIepnQR1aaOHVjexqO9xC6vxZS4pYYthfY4PVx6', '2022-05-13 09:07:59'),
('sa.vergis@gmail.com', 'p6WDSiq3kZNqF2bkjNSek8DREgHLaAsog9Eo3G6wOEca5Dk3C77UhjsrMfg4ezv7', '2022-06-20 05:00:47'),
('isg@meitsystems.com', '81PGSC62ZDg3bJKEW5EQsIAy5KGarTpl23xeGxjjeH7kcAMviiirKr4vCN2DvceJ', '2022-06-28 05:29:29'),
('jecawa7110@jrvps.com', 'bAZIF5pRGWUAE0p0qVctqFyxtuqjDIJeb9WB0wqwZAKY0SreOlHp5fHkvs69DzzY', '2022-06-28 05:40:56'),
('rikot48651@akapple.com', '5pKVZv9Dwuqx6dzLWmn62GriOqx3LeYZHAatR0Xd7hiqtIbL0tRHLOdmofTTAEP2', '2022-06-28 05:42:54'),
('ashwin@isg.com', 'Zs0FnuTfp5M8T4n9cLWvziHxt5fXoZB183AFVcPjz5fdQaD3qEKQhF7AELx7xtGp', '2022-06-28 07:34:32'),
('girir99790@lankew.com', 'ru16oLJmAufLCgto6R23Xs6LK1VDI4FzlJVJGSySmRHa9Eqj9gLoARHRdiW0C1jT', '2022-06-28 07:35:41'),
('girir99790@lankew.com', 'AcOkTUP8I7JaLtVEHNWfw328xKyG4KRY3nsmAOBgNdwoXNxCfCRVhTHV5Ue8cFiu', '2022-06-28 08:28:10'),
('balifap355@jrvps.com', 'XvajWqUwRA7GXwdCAB7oArxpDZxaMwFnzms3MmGEik1MEHzDw8dWG3sE6HD4m4L2', '2022-06-28 09:52:51'),
('jecawa7110@jrvps.com', '4htSR003q8pr3BDoBDUeXCYKhnmuLlomdvG55IN78jLJb5g1qXExwn2tfyqV5Gsu', '2022-06-29 06:25:44'),
('jecawa7110@jrvps.com', 'FejlsgCSNFxW6QYpyqg7PXXqhKc9C53iQ1qlfDjRhPmDGwQ0I3pr8WgwhzqQrZYs', '2022-06-29 06:25:53'),
('isg@meitsystems.com', 'R01QhcWd0eRMCuYpIhS4VwUDDEsru42HA4SKSfVPoK6fyKaskE3Vum9xLzUhrLBk', '2022-10-13 12:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_schedules`
--

CREATE TABLE `program_schedules` (
  `id` int UNSIGNED NOT NULL,
  `committe_id` int NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_schedules`
--

INSERT INTO `program_schedules` (`id`, `committe_id`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '2022-05-20', '2022-05-24 04:11:14', '2022-05-24 04:11:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program_schedule_times`
--

CREATE TABLE `program_schedule_times` (
  `id` int UNSIGNED NOT NULL,
  `schedule_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_schedule_times`
--

INSERT INTO `program_schedule_times` (`id`, `schedule_id`, `title`, `time_start`, `time_end`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'test1', '10:40:00', '14:40:00', NULL, NULL, NULL),
(2, 1, 'test2', '10:41:00', '12:41:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resolution`
--

CREATE TABLE `resolution` (
  `id` bigint UNSIGNED NOT NULL,
  `committe_id` int NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resolution`
--

INSERT INTO `resolution` (`id`, `committe_id`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '<p>testing this is a propoer chat and editor so that everytine can see this</p>', '2023-02-25 19:53:36', '2023-02-25 19:53:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advisor_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '0->pending,1->active,2->reject',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `logo`, `advisor_name`, `email`, `mobile`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'E.A.MUNC', 'host_schools/1652422374_JLmk6_9576.png', 'raj', 'raj@admin.com', '12121212121212', 1, NULL, '2022-05-13 00:42:54', NULL),
(2, 'School A', 'host_schools/1652424427_G9BcE_2575.png', 'Rahul', 'rahul@test.com', '32322322222', 1, '2022-05-13 06:47:07', '2023-02-28 06:21:31', '2023-02-28 06:21:31'),
(3, 'DPS Doha', 'host_schools/1652432086_M2sRx_6458.png', 'Mohsin', 'kobibew817@doerma.com', '987456321', 1, '2022-05-13 08:54:46', '2023-02-28 06:21:04', '2023-02-28 06:21:04'),
(4, 'khs School', 'host_schools/1652846686_SAnKP_4376.png', 'tom', 'tom123@email.com', '912311233233', 1, '2022-05-18 04:04:46', '2023-02-28 06:21:36', '2023-02-28 06:21:36'),
(5, 'Hi Tech Public School', 'host_schools/1653285417_ZmAyf_7635.png', 'Rahul', 'QQQQ98960@akapple.com', '919696985698', 1, '2022-05-23 05:56:57', '2023-02-28 06:21:45', '2023-02-28 06:21:45'),
(6, 'Sultan School', 'host_schools/1655700864_qz9sk_1593.png', 'Mrs. Gabriella', 'anuelza.tms@gmail.com', '0096898594767', 1, '2022-06-20 04:54:24', '2022-06-20 04:54:24', NULL),
(7, 'school22', 'host_schools/1656306845_314Dg_4066.png', 'faculty12', 'sfsfs@sdfdf.gjgj', '913232232', 1, '2022-06-27 05:14:05', '2023-02-28 06:24:50', '2023-02-28 06:24:50'),
(8, 'HFC', 'host_schools/1656394563_PCozW_2334.jpg', 'Naveed', 'Naveed@gmail.com', '91987465321', 1, '2022-06-28 05:36:03', '2023-02-28 06:21:12', '2023-02-28 06:21:12'),
(9, 'ABC1 SCHOOL', 'host_schools/1658229411_Tzmx5_4805.png', 'test adv', 'testadv@eemail.com', '9132322324444', 1, '2022-07-19 11:16:51', '2022-07-19 11:16:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_indexes`
--

CREATE TABLE `site_indexes` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_indexes`
--

INSERT INTO `site_indexes` (`id`, `type`, `name`, `title`, `image`, `file`, `post`, `video`, `description`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'banner', NULL, 'Banner 1', 'banner/1653973667_s2RtO_5666.jpg', NULL, NULL, NULL, NULL, NULL, '2022-03-10 22:21:00', '2022-05-31 05:07:47', NULL),
(2, 'president_messages', 'Mr. Ahmed Rayees', 'Message from the President', 'president_image/1664349458_8SaNE_2638.jpeg', NULL, 'Chairman, EAMUNC', NULL, 'We at Indian School Al Ghubra are honored to have our MUNC to be associated with the memory of Late Mr. E. AHAMED, who was not only an excellent politician, but a virtuous man who represented those who were underprivileged or whose voice was usually left unheard. He did this on numerous occasions at the United Nation’s where he represented for not only India’s issues, but the world’s issues as well. E.A.MUNC truly believes its motto FREEDOM FROM FEAR is the perfect tribute to the Conference’s namesake, Mr. E. AHAMED.\r\n\r\n​The first session of E.A.MUNC was conducted at Kannur, in January 2018, at DIAS campus, India. It saw schools from India as well as Oman participate, with more than 200 delegates represented in six committees. At E.A.MUNC, Malayalam committee was first introduced in the world of MUNC.\r\n\r\nMr. SHYAM SARAN, Mr. ANIL WADHWA, Mrs. DEEPA GOPALAN, Dr. P MOHAMMED ALI, and Mr. ANWAR ALI T. P are diplomats and dignitaries, who have mentored E.A.MUNC from the time of its inception.\r\n\r\n​E.A.MUNC is a platform for delegates to convert their awareness of the world they live in into action. Each one of the delegates has something unique to bring to the table, they bring in their differences and similarities to discuss a plethora of extraordinary ideas and vision for the future. E.A.MUNC unites them and their peers towards seeking realistic and long term solutions, it dares them to challenge the norm and question the existing policies, it encourages the delegates to take action and influence change, and lastly, E.A.MUNC inspires the young minds to break boundaries and arrive at resolutions to the issues at hand. This was seen also at all the previous sessions of E.A.MUNC, where students from India and Oman belonging to various nationalities participated. Being at E.A.MUNC for delegates is like being at the UNITED NATIONS as the environment and use of UN4MUN procedures are similar to a large extent to the U.N.\r\n\r\nWishing the delegates all the very best in making decisions through consensus as global citizens and finding solutions that may shape the world of tomorrow, today.\r\n\r\n​', NULL, NULL, '2022-09-28 07:18:43', NULL),
(3, 'faculties_messages', 'Aditya Sharma', 'Message from Secretary General', 'thumbnail/1667992697_7m3qa_1324.png', NULL, 'Secretary General', 'MOYXJh1OEjc', NULL, NULL, '2022-03-10 23:10:38', '2022-11-09 11:18:17', NULL),
(4, 'faculties_messages', 'Kshama Mumbai', 'Message from Director General', 'thumbnail/1667992877_G2TNJ_6830.png', NULL, 'Director General', 'mQMvY_d_BL8', NULL, NULL, '2022-03-10 23:15:15', '2022-11-09 11:21:17', NULL),
(5, 'conference_update', NULL, 'CLIMATE CHANGE', 'conference_updates/1646974217_cDFKo_3017.jpg', NULL, NULL, NULL, 'How the US commitment to lower emissions will affect the fight against climate change', NULL, '2022-03-10 23:20:17', '2022-03-10 23:20:17', NULL),
(6, 'conference_update', NULL, 'OIL AND GAS', 'conference_updates/1646974386_BGhbc_7051.jpg', NULL, NULL, NULL, 'Why do oil prices matter to the global economy? An expert explains', NULL, '2022-03-10 23:23:06', '2022-03-10 23:23:06', NULL),
(7, 'conference_update', NULL, 'SYSTEMIC RACISM', 'conference_updates/1646974414_E51Vt_2871.jpg', NULL, NULL, NULL, 'How we are fighting systemic racism in the workplace', NULL, '2022-03-10 23:23:34', '2022-03-10 23:23:34', NULL),
(8, 'vision', NULL, 'The Vision', 'vision/1646975073_ABoPk_2539.jpg', NULL, NULL, NULL, '<p>Honoring the late Shri E. Ahamed, the E.A.MUN conference started its journey with its first edition in 2018. A simple yet profound motivation behind this initiative:&nbsp;</p><p><strong>Empowering The Youth To Use Its Voice.</strong></p><p>Continuous efforts and unwavering support from the management committee ensured that the conference reached greater heights each year.</p><p>&nbsp;E.A.MUNC aims to help the youth realize its potential and work towards a better tomorrow. We recognize the importance of nurturing students at a young age and providing them the platforms to understand and help the world around them.&nbsp;</p><p>In today’s interconnected world, diplomacy and international affairs stand as important ideals. We believe that building these skills from early on, is bound to help the youth in their future endeavors.&nbsp;</p><p>We hope to continue to strive in this direction, and do the best we can to prepare the youth for a brighter tomorrow.</p>', NULL, NULL, '2022-03-15 00:14:17', NULL),
(9, 'our_mentors', 'Dr. P. Mohamed Ali', 'Dr. P. Mohamed Ali', 'our_mentors/1667980813_nJBPH_2746.jpg', NULL, NULL, NULL, 'Dr P Mohamed Ali is known for seizing the odds, encountering challenges and growing from strength to strength. He started his professional career in ‘General Reserve Engineering Force’ under the Ministry of Defence at Mizoram, in the North-East of India. After three years of hard work in a challenging terrain, he decided to move to the Middle-East which was emerging as a business hub following the gulf boom. Thereafter, in 1972, Dr Ali co-founded GALFAR Engineering and Contracting in the Sultanate of Oman. From modest operations as a small construction company, the organization progressively grew to become Oman’s largest private sector company and employer, with EPC capability in oil and gas, roads and bridges, civil and maritime infrastructure and utilities, and service sectors. GALFAR is one of the largest employers of Omani nationals in all facets of its operations.', NULL, '2022-03-10 23:40:32', '2022-11-09 08:00:13', NULL),
(10, 'our_mentors', 'Mr. Anil Wadhwa', 'Mr. Anil Wadhwa', 'our_mentors/1667980711_Zgv3a_2587.png', NULL, NULL, NULL, 'Anil Wadha; born 26 May 1957 is an Indian civil servant who belongs to the Indian Foreign Service cadre. He has served as the Indian Ambassador to Italy, Poland, Oman and Thailand. He is currently a Senior Fellow & Cluster Leader at the Vivekananda International Foundation in New Delhi. He has served as the Director/Joint Secretary at the Technical Secretariat of the Organisation for the Prohibition of Chemical Weapons, The Hague from July 1993 to July 2000.', NULL, '2022-03-10 23:42:28', '2022-11-09 07:58:31', NULL),
(11, 'our_mentors', 'Mr. Ahmed Rayees', 'Mr. Ahmed Rayees', 'our_mentors/1667980590_FsUWb_3661.png', NULL, NULL, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, '2022-03-10 23:43:30', '2022-11-09 07:56:30', NULL),
(12, 'our_mentors', 'Mr. Anwar Ali T.P.', 'Mr. Anwar Ali T.P.', 'our_mentors/1667980531_YU03Q_5313.png', NULL, NULL, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, '2022-03-10 23:43:59', '2022-11-09 07:55:31', NULL),
(13, 'our_mentors', 'Mr. Shyam Saran', 'Mr. Shyam Saran', 'our_mentors/1667980433_Xf5dU_1930.png', NULL, NULL, NULL, 'Mr. Shyam Saran is an Indian career diplomat. He joined the Indian Foreign Service in 1970 and rose to become the Foreign Secretary to the Government of India. Prior to his appointment as the Foreign Secretary he served as India\'s ambassador to Myanmar, Indonesia and Nepal and as its High Commissioner to Mauritius. Upon finishing his tenure as the Foreign Secretary, he was appointed the Prime Minister’s Special Envoy for Indo-US Civil Nuclear Issues and later as Special Envoy and Chief Negotiator on Climate Change.', NULL, '2022-03-10 23:44:49', '2022-11-09 07:53:53', NULL),
(14, 'our_mentors', 'Mrs. Deepa Gopalan Wadhwa', 'Mrs. Deepa Gopalan Wadhwa', 'our_mentors/1665931694_W6TDF_3701.png', NULL, NULL, NULL, 'Deepa Gopalan Wadhwa has been a distinguished career diplomat who joined the Indian Foreign Service (IFS) in 1979 and retired in December 2015. A graduate from Madras University, she has an undergraduate degree in Chemistry and a post graduate degree in English Literature.\r\n\r\nShe has served as Ambassador of India to Japan (2012-2015), Qatar (2009-2012) and Sweden (2005-2009). She was concurrently accredited as Ambassador to Latvia (from Stockholm), and Republic of the Marshall Islands (from Tokyo). During her career, she has also held other significant assignments in Geneva, Hong Kong, China, The Netherlands, the International Labour Organization (ILO) and the Ministry of External Affairs.\r\n\r\nIn the course of her career spanning over 36 years, she has handled a wide swathe of issues and subjects related to India’s relations with key countries such as Pakistan, China, and Japan; participated in international conferences and negotiations related to climate change, sustainable development, disarmament and human rights and was instrumental in the active promotion of India’s economic interests in areas of trade, technology, investments and energy security during postings in Europe, the GCC and Japan.', NULL, '2022-03-10 23:45:31', '2022-11-09 07:52:22', NULL),
(15, 'letter', 'Aditya Sharma', 'Letter from Secretary General', 'letter/1667132663_Ox5U0_2743.JPG', NULL, 'Secretary General E.A.MUNC', NULL, 'Greetings Delegates and Faculty Advisors,\r\nI, Aditya Sharma, am humbled to serve as the Secretary General for the Second Virtual Version of E. Ahamad Model United Nations Conference. The world is in crisis since humanity established itself, but what is important from our side is our bond. It is imperative that times change us, so do the situations. However, standing together as a human race is the foremost duty of either of us. Thus, the theme of the conference is set to be ‘Unbreakable Unity through Crisis’.\r\n​\r\n“However difficult life may seem, there is always something you can do and succeed at.” For me this ‘something’ has been MUN. Being passionate about turning into a renowned entrepreneur at some point, I have made a fair share of efforts into understanding the working of various fields, and MUN has been the major source of supporting me in this. Starting my MUN career as a chit barer in DISEC and imagining myself to know all the ‘then-seeming’ baffling terms to now mentoring others about the terms- MUN has taught me discipline, importance of teamwork, and has instilled the consistent motivation to persevere. \r\n​\r\nAt EAMUNC, we value consensus, diplomacy, and the art of collaboration. Awards are important, but what is more important is the knowledge you gain.\r\nI take this honor to welcome you to the Second Virtual EAMUNC and wish all of you the best of luck!\r\n​\r\nThank you,\r\nRegards\r\nAditya Sharma\r\nSecretary General', NULL, '2022-03-10 23:49:06', '2022-10-30 12:24:24', NULL),
(16, 'letter', 'Kshama Mumbai', 'Letter from Director General', 'letter/1646976078_Pte8s_7808.jpg', NULL, 'Director General', NULL, 'I am Kshama Mumbai, and it is my immense pleasure to serve as your Director General for the second edition of the virtual E.Ahmed Model United Nations Conference. 2020 has certainly been a year that has challenged us all. A crisis within a world largely in crisis, not quite the fairy tale we aspired for. The pandemic affected every age group; from young children to the older population. Businesses shut down, schools closed and even the greatest economies seemed to suffer terribly.\r\n\r\nHowever, chaos did not triumph as we began to see order in this world, and that delegates is the beauty of our reality. It is but a utopian world where there are no challenges, humanity has and will continue to face hurdles through its survival. But to find solutions to the same it is inevitable that we must come together as one. No problem is larger than the capability of humans to collectively solve it, provided we work as one.\r\n\r\nHenry Ford once said, “Coming together is a beginning; staying together is a process and working together is a success”. It is this very spirit that we at E.A.MUNC uphold. Through the conference you will realize that we do stand when we are united, and fall when we are divided. As you work to achieve consensus in your committees you are in the most basic sense, working for a better world. Let this conference serve as a stepping stone for you to endeavour towards a brighter future for us and the generations to come.', NULL, '2022-03-10 23:51:18', '2022-03-10 23:51:18', NULL),
(17, 'work_members', 'Keerthi Hegde', 'Director General', 'work_members/1646976339_ZITnC_2958.jpg', NULL, NULL, NULL, NULL, NULL, '2022-03-10 23:55:39', '2022-03-10 23:55:39', NULL),
(18, 'work_members', 'Keerthi Hegde', 'Director General', 'work_members/1646976358_gh1C8_7951.jpg', NULL, NULL, NULL, NULL, NULL, '2022-03-10 23:55:58', '2022-03-10 23:55:58', NULL),
(19, 'work_members', 'Keerthi Hegde', 'Director General', 'work_members/1646976393_D6swI_6047.jpg', NULL, NULL, NULL, NULL, NULL, '2022-03-10 23:56:33', '2022-03-10 23:56:33', NULL),
(20, 'work_members', 'Keerthi Hegde', 'Director General', 'work_members/1646976413_J9gtC_5117.jpg', NULL, NULL, NULL, NULL, NULL, '2022-03-10 23:56:53', '2022-03-10 23:56:53', NULL),
(21, 'important_date', NULL, 'Delegate Roster, Delegate Fees, Waivers, and Training Modules due', NULL, NULL, NULL, NULL, NULL, '2022-03-11', '2022-03-10 23:57:33', '2022-03-10 23:57:33', NULL),
(22, 'important_date', NULL, 'Delegate Roster, Delegate Fees, Waivers, and Training Modules due2', NULL, NULL, NULL, NULL, NULL, '2022-03-12', '2022-03-10 23:57:51', '2022-03-10 23:57:51', NULL),
(23, 'important_date', NULL, 'Delegate Roster, Delegate Fees, Waivers, and Training Modules due', NULL, NULL, NULL, NULL, NULL, '2022-03-13', '2022-03-10 23:57:59', '2022-03-10 23:57:59', NULL),
(24, 'important_date', NULL, 'Delegate Roster, Delegate Fees, Waivers, and Training Modules due', NULL, NULL, NULL, NULL, NULL, '2022-03-14', '2022-03-10 23:58:07', '2022-03-10 23:58:07', NULL),
(25, 'rules', NULL, 'Rules of Proceedure', NULL, 'rules/1667132762_D4jz1_3743.pdf', NULL, NULL, NULL, NULL, NULL, '2022-10-30 12:26:02', NULL),
(26, 'live', NULL, NULL, NULL, NULL, NULL, '_0oxwE5FUB0', NULL, NULL, NULL, '2022-03-11 00:57:25', NULL),
(27, 'timer', NULL, 'Timer', NULL, NULL, NULL, NULL, NULL, '2023-02-28', NULL, '2023-01-21 08:29:52', NULL),
(28, 'alumni', NULL, 'EAMUNC Alumni', 'alumni/1646980952_jUcxg_5347.jpg', NULL, NULL, NULL, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins with:\r\n\r\n“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.” The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn\'t distract from the layout. A practice not without controversy, laying out pages with meaningless filler text can be very useful when the focus is meant to be on design, not content.\r\n\r\nThe passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it\'s seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.', NULL, NULL, '2022-03-11 01:13:43', NULL),
(29, 'alumni_news', 'How the US commitment to lower emissions will affect the fight against climate change', 'US commitment', 'alumninews/1646981203_kMHRc_3163.jpg', NULL, NULL, NULL, 'How the US commitment to lower emissions will affect the fight against climate change', NULL, '2022-03-11 01:16:43', '2022-03-11 01:17:44', NULL),
(30, 'alumni_news', 'global economy', 'global economy', 'alumninews/1646981361_hZxxk_6812.jpg', NULL, NULL, NULL, 'Why do oil prices matter to the global economy? An expert explains', NULL, '2022-03-11 01:19:21', '2022-03-11 01:19:21', NULL),
(31, 'alumni_news', 'fighting systemic', 'Brilliant Performances by EAMUN alumni', 'alumninews/1677091547_apvOZ_6525.jpg', NULL, NULL, NULL, 'EAMUNC alumni from Deenul Islam Sabha Girls higher Secondary school in Kannur city get brilliant sucess in the Plus Two examinations.', NULL, '2022-03-11 01:21:50', '2023-02-22 18:45:47', NULL),
(32, 'host_schools', NULL, 'School Name', 'host_schools/1646982216_B9jIq_7241.jpg', NULL, NULL, NULL, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins with:', NULL, '2022-03-11 01:33:36', '2022-03-11 01:33:36', NULL),
(33, 'host_schools', NULL, 'School Name', 'host_schools/1646982322_inkqQ_7300.jpg', NULL, NULL, NULL, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins with:', NULL, '2022-03-11 01:35:22', '2022-03-11 01:35:22', NULL),
(34, 'host_schools', NULL, 'School Name', 'host_schools/1646982348_qlTvR_9782.jpg', NULL, NULL, NULL, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins with:', NULL, '2022-03-11 01:35:48', '2022-03-11 01:35:48', NULL),
(35, 'act_impact', NULL, 'Act to Impact', 'act_impacts/1646982544_gQUFx_2645.jpg', NULL, NULL, NULL, 'Introduction to Virtual E.A.MUNC -2020\r\nThis guide will walk you through the use the\r\nplatform - Zoom - for the VIRTUAL\r\nE.A.MUNC-2020\r\nYou can download the application by visiting the\r\nwebsite: https://zoom.us. Once you download the\r\napplication, please create an account for yourself\r\nthat you will use to log in to all the committee\r\nsessions for the conference.\r\nYou can use the app on your laptop or your mobile\r\nphone. This document will apprise you of the\r\nfeatures on zoom on a laptop with each version\r\nhaving the same features.\r\nThe details of each committee session and\r\nconference session will be shared with you 24 hours\r\nbefore the pop breakout-up session to the email ID\r\nof your faculty advisor.\r\nPlease ensure you check your email account/\r\nWhatsApp regularly for all updates.\r\nWe proceed with an explanation of the features of\r\nzoom following which, we will explain the specific\r\nfeatures you will need for committee proceedings.', NULL, NULL, '2023-02-25 19:09:20', NULL),
(36, 'vc_condunt', NULL, 'Virtual Code Of Conduct', 'vc_condunts/1646982820_KVAXH_5572.jpg', 'vc_condunts/doc/1677567420_TiHKh_5986.pdf', NULL, NULL, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins with: “Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.” The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn\'t distract from the layout. A practice not without controversy, laying out pages with meaningless filler text can be very useful when the focus is meant to be on design, not content. The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it\'s seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.\r\n\r\nTest Data', NULL, NULL, '2023-02-28 06:57:00', NULL),
(37, 'past_conference', NULL, 'EAMUNC 2022', 'pastconference/image/1646983182_1CLVz_6669.jpg', 'pastconference/doc/1646983182_KSYTq_6742.pdf', NULL, NULL, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins with:\r\n\r\n“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.” The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn\'t distract from the layout. A practice not without controversy, laying out pages with meaningless filler text can be very useful when the focus is meant to be on design, not content.\r\n\r\nThe passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it\'s seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.', NULL, '2022-03-11 01:49:42', '2022-03-11 01:49:42', NULL),
(38, 'news_letter', NULL, 'EAMUNC Annual Newsletter 2023', 'newsletter/image/1647318319_y7Oqo_7855.jpg', 'newsletter/doc/1647318319_XF0Se_4147.pdf', NULL, NULL, 'EAMUNC Annual Newsletter 2023', NULL, '2022-03-14 22:55:19', '2022-03-14 22:55:19', NULL),
(39, 'news_letter', NULL, 'EAMUNC Annual Newsletter 2024', 'newsletter/image/1647318451_JhOUL_6746.jpg', 'newsletter/doc/1647318451_50PAb_6158.pdf', NULL, NULL, 'EAMUNC Annual Newsletter 2024', NULL, '2022-03-14 22:57:31', '2022-03-14 22:57:31', NULL),
(40, 'faq', NULL, 'What is Loerm Ipsume 1500s, when an unknown printer took a galley ?', NULL, NULL, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', NULL, NULL, '2022-03-18 04:02:21', NULL),
(41, 'terms', NULL, 'Terms of Service', NULL, NULL, NULL, NULL, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', NULL, NULL, '2022-03-17 23:53:52', NULL),
(42, 'policy', NULL, 'Privacy Policy', NULL, NULL, NULL, NULL, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', NULL, NULL, '2022-03-17 23:55:16', NULL),
(45, 'faq', NULL, 'sdsds', NULL, NULL, NULL, NULL, 'sdsds sdsds sdfsd sdsd sdsd', NULL, '2022-03-18 03:59:16', '2022-03-18 03:59:45', '2022-03-18 03:59:45'),
(46, 'faq', NULL, 'What is Loerm Ipsume 1500s, when an unknown printer took a galley ?', NULL, NULL, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', NULL, '2022-03-18 04:02:33', '2022-03-18 04:02:33', NULL),
(47, 'faq', NULL, 'faq Lorem Ipsum is simply dummy text of the printing and', NULL, NULL, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', NULL, '2022-03-18 04:02:59', '2022-03-18 04:02:59', NULL),
(48, 'participate_schools', NULL, 'TEST11', 'participate_schools/1651146559_CeFGM_9507.png', NULL, NULL, NULL, 'SDFSFSDF SDGVDSGDsfsfsf dgdfdf dgdfdfdf dfdfszfx dgdfdg dgewdvx dd11', NULL, '2022-04-28 06:19:19', '2022-04-28 06:19:46', '2022-04-28 06:19:46'),
(49, 'participate_schools', NULL, 'Afgfgdfgf 122', 'participate_schools/1651146614_d91d1_4822.png', NULL, NULL, NULL, 'gdsgdsg dsgsdgdsg dfgfdgfg dsfgcvxv egdsghhds dsgfgfgg', NULL, '2022-04-28 06:20:14', '2023-02-28 06:25:51', '2023-02-28 06:25:51'),
(50, 'guideline', NULL, 'Guideline', NULL, 'vc_condunts/doc/1652419166_8fR07_9046.pdf', NULL, NULL, '<p>RULES OF PROCEDURE</p><ul><li>Model United Nations has been in practice for over 70 years; however, it was not<br>monitored by the UN itself. Consequently, the UN Department of Public Information<br>decided to launch UN4MUN, an initiative to teach MUN teams how to bring their<br>simulations more in line with the way the UN actually works. The following rules of<br>procedure, adapted from UN4MUN focuses on its core principle of consensus. It is<br>unique in the sense that it reflects how the UN has changed over the years.</li><li>Roll Call</li></ul><p>Each session begins with a roll call wherein the bureau member will call out the names of<br>the member states in alphabetical order. Delegates are expected to raise their placards and<br>say “Present” when their country has been called out. In case a delegate arrives after the<br>roll call, he/she is expected to send a note to the chair confirming their presence.</p><ul><li>Quorum</li></ul><p>The quorum is the minimum number of member States who need to be present for the<br>Chair to open a meeting and for the GA to take decisions. The quorum for opening a GA<br>meeting is one-fourth of the member States.</p><p>&nbsp;</p>', NULL, NULL, '2023-02-25 20:21:41', NULL),
(51, 'liability_waiver', 'WHO_Background Guide.pdf', NULL, NULL, 'liability_form/1677354118_Y4N0W_4660.pdf', NULL, NULL, NULL, NULL, NULL, '2023-02-25 19:41:58', NULL),
(52, 'important_date', NULL, 'test', NULL, NULL, NULL, NULL, NULL, '2022-06-11', '2022-05-31 21:12:22', '2022-05-31 21:12:22', NULL),
(53, 'banner', NULL, 'banner 2', 'banner/1654509220_3eZUg_4671.jpg', NULL, NULL, NULL, NULL, NULL, '2022-06-06 09:53:43', '2022-06-14 07:18:32', '2022-06-14 07:18:32'),
(54, 'mission', NULL, 'Mission', 'mission/1655199354_eULZW_9398.png', NULL, NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', NULL, '2022-06-06 09:59:46', '2022-06-14 09:35:54', NULL),
(55, 'reg_status', 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-13 06:18:33', '2023-01-21 08:44:03', NULL),
(56, 'conference_update', NULL, 'CLIMATE CHANGE', 'conference_updates/1655188195_WQtxx_9153.png', NULL, NULL, NULL, 'How the US commitment to lower emissions will affect the fight against climate change How the US commitment to lower emissions will affect the fight against climate change How the US commitment to lower emissions will affect the fight against climate change', NULL, '2022-06-14 06:29:55', '2022-06-14 06:29:55', NULL),
(57, 'banner', NULL, 'banner', 'banner/1655191088_Dgv5c_2344.jpg', NULL, NULL, NULL, NULL, NULL, '2022-06-14 07:18:08', '2022-09-28 07:11:49', '2022-09-28 07:11:49'),
(58, 'banner', NULL, 'banner', 'banner/1655191099_T7SZH_9151.jpg', NULL, NULL, NULL, NULL, NULL, '2022-06-14 07:18:20', '2022-10-26 04:17:53', '2022-10-26 04:17:53'),
(59, 'banner', NULL, 'banner', 'banner/1655191128_8dFbd_8193.jpg', NULL, NULL, NULL, NULL, NULL, '2022-06-14 07:18:49', '2022-09-28 07:11:57', '2022-09-28 07:11:57'),
(60, 'banner', NULL, 'Conference', 'banner/1655551303_bR6Dl_3888.jpeg', NULL, NULL, NULL, NULL, NULL, '2022-06-18 11:21:43', '2022-09-28 07:10:46', '2022-09-28 07:10:46'),
(61, 'conference_update', NULL, 'Ukraine War and its global effects', 'conference_updates/1655552199_MXX96_4549.jpg', NULL, NULL, NULL, 'The effects of the Ukrainian war have spread almost globally.', NULL, '2022-06-18 11:36:39', '2022-06-18 11:38:27', '2022-06-18 11:38:27'),
(62, 'banner', NULL, 'EAMUNC 2017', 'banner/1664349065_mvdUs_8903.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-28 07:11:05', '2022-09-28 07:11:05', NULL),
(63, 'banner', NULL, 'Banner 2', 'banner/1664349239_GnSNh_8527.jpg', NULL, NULL, NULL, NULL, NULL, '2022-09-28 07:13:59', '2022-09-28 07:13:59', NULL),
(64, 'banner', NULL, 'test', 'banner/1674290338_0DIyr_3887.JPG', NULL, NULL, NULL, NULL, NULL, '2023-01-21 08:38:59', '2023-01-21 08:38:59', NULL),
(65, 'past_conference', NULL, 'EAMUNC 2017', 'pastconference/image/1677353006_b2M2V_8850.jpeg', 'pastconference/doc/1677353007_4JWe7_6167.pdf', NULL, NULL, 'Data', NULL, '2023-02-25 19:23:27', '2023-02-25 19:23:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` bigint UNSIGNED NOT NULL,
  `committe_id` int NOT NULL,
  `country_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`id`, `committe_id`, `country_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 45, 8, '2022-05-24 04:09:02', '2022-06-14 09:14:52', '2022-06-14 09:14:52'),
(2, 2, 45, 8, '2022-05-24 04:09:06', '2022-06-14 09:14:52', '2022-06-14 09:14:52'),
(3, 2, 13, 9, '2022-05-24 04:09:06', '2022-06-14 09:14:52', '2022-06-14 09:14:52'),
(4, 2, 45, 8, '2022-05-24 04:09:08', '2022-06-14 09:14:52', '2022-06-14 09:14:52'),
(5, 2, 13, 9, '2022-05-24 04:09:08', '2022-06-14 09:14:52', '2022-06-14 09:14:52'),
(6, 2, 72, 11, '2022-05-24 04:09:08', '2022-06-14 09:14:52', '2022-06-14 09:14:52'),
(7, 2, 13, 9, '2022-06-14 09:14:52', '2022-06-14 09:14:52', NULL),
(8, 2, 72, 11, '2022-06-14 09:14:52', '2022-06-14 09:14:52', NULL),
(9, 1, 13, 6, '2023-02-25 19:31:11', '2023-02-25 19:31:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `type` int NOT NULL COMMENT '1->ISG Student,2->School Student',
  `user_id` int NOT NULL,
  `school_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mun_experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bureaumem_experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `awards_received` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `committee_choice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_choice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `liability_form` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0->pending,1->Approve,2->invite,3->active,4->reject',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `type`, `user_id`, `school_id`, `name`, `email`, `class`, `phone_code`, `whatsapp_no`, `mun_experience`, `bureaumem_experience`, `awards_received`, `committee_choice`, `country_choice`, `position`, `liability_form`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 'Keerthi Hegde', 'ajil@agilityglobal.net', '11 A', '91', '2525252525', '1', '1', NULL, '1', '98', 'president', NULL, 3, '2022-05-13 06:42:04', '2022-06-28 05:13:01', '2022-06-28 05:13:01'),
(2, 2, 3, 2, 'Student 1', 'saritha@advanceinfotech.io', '10 E', '91', '54333413131', '2', '1', NULL, '5', '17', NULL, NULL, 0, '2022-05-13 06:47:07', '2023-02-28 06:22:16', '2023-02-28 06:22:16'),
(3, 2, 4, 3, 'Adil', 'kobibew817@doerma.com', '8 A', '91', '123456123', 'NO', 'NO', NULL, '5', '18', 'president', NULL, 1, '2022-05-13 08:54:46', '2023-02-28 06:22:46', '2023-02-28 06:22:46'),
(4, 2, 5, 3, 'Dony', 'rikot48651@akapple.com', '10 B', '', '666777445', 'No', 'No', NULL, '5', 'India', 'Member', NULL, 1, '2022-05-13 08:54:46', '2023-02-28 06:22:36', '2023-02-28 06:22:36'),
(5, 2, 6, 4, 'Aditya Chopra', 'anz_tms@yahoo.com', '10 S', '91', '3322323223', '2', '1', NULL, '1', '13', NULL, NULL, 3, '2022-05-18 04:04:46', '2023-02-28 06:22:57', '2023-02-28 06:22:57'),
(6, 1, 7, 1, 'Alex', 'alex@gmail.com', '5 A', '974', '3326325', 'NO', 'No', NULL, '2', '101', NULL, NULL, 1, '2022-05-18 04:38:12', '2022-06-28 05:12:40', '2022-06-28 05:12:40'),
(7, 2, 8, 5, 'mekema', 'mekema8483@dakcans.com', '10 B', '91', '969636963', '2', '1', NULL, '1', '1', NULL, NULL, 1, '2022-05-23 05:56:57', '2022-06-08 19:32:52', NULL),
(8, 2, 9, 5, 'gowoma', 'gowoma5253@roxoas.com', '9 A', '91', '9898989898988', '2', '33', NULL, '2', '13', NULL, NULL, 3, '2022-05-23 05:56:57', '2023-02-28 06:24:17', '2023-02-28 06:24:17'),
(9, 2, 10, 5, 'jesih', 'anuelza.tms@gmail.com', '10 D', '91', '1123323443', '4', '2', NULL, '2', '17', NULL, NULL, 3, '2022-05-23 05:56:57', '2022-09-29 06:59:52', NULL),
(10, 1, 11, 1, 'xejixi', 'xejixi8905@hbehs.com', '11 A', '91', '544433322444', '1', '2', NULL, '2', '72', NULL, NULL, 3, '2022-05-23 06:12:18', '2022-06-28 05:12:27', '2022-06-28 05:12:27'),
(11, 1, 12, 1, 'doyes', 'doyes10266@cupbest.com', '10 C', '91', '3222112343', '2', '44', NULL, '2', '98', 'secretary', NULL, 3, '2022-05-23 06:17:50', '2022-06-28 05:12:49', '2022-06-28 05:12:49'),
(12, 1, 13, 1, 'Mohsin', 'kinik20165@roxoas.com', '10 A', '91', '9874563210', 'No', 'No', NULL, '5', '217', NULL, 'liability_submitform/1653463350_65KIY_4196.pdf', 3, '2022-05-25 07:17:58', '2022-06-28 05:12:21', '2022-06-28 05:12:21'),
(13, 1, 14, 1, 'Aanya', 'sa.vergis@gmail.com', '9 A', '00968', '95259742', 'testing all features', 'testing all features', NULL, '5', '217', NULL, NULL, 1, '2022-06-20 04:44:56', '2022-06-28 05:12:34', '2022-06-28 05:12:34'),
(14, 2, 15, 6, 'Anu', 'isg@meitsystems.com', '9', '00968', '99329332', 'test', 'test', NULL, '5', '217', NULL, NULL, 2, '2022-06-20 04:54:24', '2023-01-21 13:07:51', '2023-01-21 13:07:51'),
(15, 2, 16, 7, 'sovafap961', 'sovafap961@giftcv.com', '10 E', '91', '322355', '2 fghffh', NULL, 'fgfgfgf', '5', '15', NULL, NULL, 0, '2022-06-27 05:14:05', '2023-02-28 06:23:51', '2023-02-28 06:23:51'),
(16, 2, 17, 7, 'sovafap96111', 'sovafap96111@giftcv.com', '3 B', '91', '4343222111', '2', '2', 'DFD', '2', '3', NULL, NULL, 0, '2022-06-27 05:14:05', '2023-02-28 06:24:05', '2023-02-28 06:24:05'),
(17, 1, 18, 0, 'maydiyatro', 'maydiyatro@vusra.com', '11 A', '91', '2345654321', '0', '0', NULL, '2', '4', NULL, NULL, 0, '2022-06-27 05:16:12', '2022-06-27 05:16:12', NULL),
(18, 1, 19, 0, 'tiyor20808', 'tiyor20808@exoare.com', '11 A', '91', '45566632323', '2', '44', NULL, '5', '16', NULL, NULL, 0, '2022-06-27 05:22:55', '2022-06-29 06:25:21', NULL),
(19, 1, 20, 0, 'Ashwin', 'ashwin@isg.com', '10', '', NULL, 'NO', 'No', 'No', '12', '171', NULL, NULL, 1, '2022-06-28 05:13:53', '2023-02-25 19:04:34', NULL),
(20, 2, 21, 8, 'Akhil', 'jecawa7110@jrvps.com', '12', '', NULL, 'No', NULL, 'No', '2', '15', NULL, NULL, 2, '2022-06-28 05:36:03', '2022-06-29 06:25:48', NULL),
(21, 1, 22, 0, 'Vipin', 'girir99790@lankew.com', '11', '', NULL, NULL, NULL, NULL, '1', '17', NULL, NULL, 2, '2022-06-28 05:43:11', '2022-06-28 07:35:45', NULL),
(22, 1, 23, 0, 'yedatit', 'balifap355@jrvps.com', '11 A', '91', '4523456789', NULL, NULL, NULL, '5', '6', NULL, NULL, 3, '2022-06-28 08:04:57', '2022-06-28 09:51:11', NULL),
(23, 1, 24, 0, 'Rachael Bobby', 'yedatit501@lankew.com', '11A', '91', '34546565651', NULL, NULL, NULL, '11', '37', NULL, NULL, 3, '2022-06-29 06:02:56', '2023-02-25 18:54:15', NULL),
(24, 1, 25, 0, 'Agility', 'info@agilityglobal.net', '5', '', NULL, NULL, NULL, NULL, '2', '160', NULL, NULL, 3, '2022-06-29 06:15:51', '2023-01-26 07:55:05', '2023-01-26 07:55:05'),
(25, 2, 26, 9, 'difivo', 'difivo8261@opude.com', '2', '91', '434322266655', NULL, NULL, NULL, '5', '19', NULL, NULL, 0, '2022-07-19 11:16:51', '2022-07-19 11:16:51', NULL),
(26, 2, 27, 9, 'hertuyerko', 'hertuyerko@vusra.com', '4', '', NULL, NULL, NULL, NULL, '2', '16', NULL, NULL, 3, '2022-07-19 11:16:51', '2022-07-19 11:19:19', NULL),
(27, 1, 28, 0, 'Mohsin Shukkur', 'mohsin@advanceinfotech.io', '10', '091', '8054666777', NULL, NULL, NULL, '2', '98', NULL, NULL, 3, '2022-10-08 05:05:26', '2022-10-13 11:54:06', '2022-10-13 11:54:06'),
(28, 1, 29, 0, 'Sujanyaa Sriram', 'tasafod776@lutota.com', '11A', '91', '2323232323', '1', '2', NULL, '5', '13', NULL, NULL, 3, '2022-10-08 05:29:24', '2023-02-24 09:57:56', NULL),
(29, 1, 30, 0, 'Mohsin', 'mohsinshukkur@gmail.com', '10th', '91', '9746793120', NULL, NULL, NULL, '5', '160', NULL, NULL, 3, '2022-10-13 11:34:44', '2022-10-13 11:53:59', '2022-10-13 11:53:59'),
(30, 1, 31, 0, 'Aanya Liz Vergis', 'info@meitsystems.com', '5 C', '', NULL, NULL, NULL, NULL, '1', '27', NULL, NULL, 3, '2023-01-26 09:30:01', '2023-02-25 18:47:38', NULL),
(31, 1, 32, 0, 'Mohsin', 'gosavop747@pubpng.com', '10 A', '', NULL, NULL, NULL, NULL, '13', '98', NULL, 'liability_submitform/1677568431_fF7PU_9186.doc', 3, '2023-02-28 06:45:03', '2023-02-28 07:25:03', '2023-02-28 07:25:03'),
(32, 1, 33, 0, 'Jamsheer', 'jamsheer36@gmail.com', 'Test', '91', '9946889684', NULL, NULL, NULL, '13', '94', NULL, NULL, 3, '2023-02-28 11:05:32', '2023-02-28 11:09:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int NOT NULL DEFAULT '2' COMMENT '1->President,2->Delegates,3->Bureau members',
  `type` int NOT NULL DEFAULT '0' COMMENT '1=>isg_delegates,2=>school_delegates',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=>inactive,1=>active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `phone`, `role`, `type`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, 'admin@admin.com', '1234567891', 1, 0, NULL, '$2y$10$bQEIgAhxBEVhBpDYNS5rOuS5K4Yrw8cUxjMNhlr4B6iWOYqjxSRyO', NULL, 1, NULL, '2022-05-23 06:42:14', NULL),
(2, 'Keerthi Hegde', NULL, 'ajil@agilityglobal.net', '2525252525', 3, 1, NULL, '$2y$10$WIk6wrwHJBMtT8DUGu.xRuYvCMkYUET6WlNyGCI4J9gAICYbE4U3a', NULL, 1, '2022-05-13 06:42:04', '2022-06-28 05:13:01', '2022-06-28 05:13:01'),
(3, 'Student 1', NULL, 'saritha@advanceinfotech.io', '54333413131', 2, 2, NULL, '$2y$10$6Iy2BjsFCFkb.cNiiz1EdONTeQsr7EGhuXmgXFCdDOjgvu9FXI8pu', NULL, 0, '2022-05-13 06:47:07', '2023-02-28 06:22:16', '2023-02-28 06:22:16'),
(4, 'Adil', NULL, 'kobibew817@doerma.com', '123456123', 3, 2, NULL, NULL, NULL, 0, '2022-05-13 08:54:46', '2023-02-28 06:22:46', '2023-02-28 06:22:46'),
(5, 'Dony', NULL, 'rikot48651@akapple.com', '666777445', 3, 2, NULL, '$2y$10$BjhVUJT0vj68IJrWf0INwu7yW72BcmjNeOv/J6kJADhc.1it4lOWG', NULL, 1, '2022-05-13 08:54:46', '2023-02-28 06:22:36', '2023-02-28 06:22:36'),
(6, 'Aditya Chopra', 'user_image/1653135274_dDDzH_7377.jpg', 'anz_tms@yahoo.com', '3322323223', 2, 2, NULL, '$2y$10$3YGX9Nw8ghiYmw6OdbYzqep54b3ZF0J5yBhTaCV6Cz.ArRSzF9fwO', NULL, 1, '2022-05-18 04:04:46', '2023-02-28 06:22:57', '2023-02-28 06:22:57'),
(7, 'Alex', NULL, 'alex@gmail.com', '3326325', 2, 1, NULL, NULL, NULL, 0, '2022-05-18 04:38:12', '2022-06-28 05:12:40', '2022-06-28 05:12:40'),
(8, 'mekema', NULL, 'mekema8483@dakcans.com', '969636963', 2, 2, NULL, '$2y$10$LUK/nkbrne2gH/Oir/ye9uMXZY/8AGZOJwRMRAE10XnSH6KDGCvLa', NULL, 1, '2022-05-23 05:56:57', '2022-05-23 06:09:48', NULL),
(9, 'gowoma', NULL, 'gowoma5253@roxoas.com', '9898989898988', 2, 2, NULL, '$2y$10$vPKXl5Sas5VmDmYpEAn5A.mYxlsDP3DFHEjZIKsxdgz3O3KYMnZyO', NULL, 1, '2022-05-23 05:56:57', '2023-02-28 06:24:17', '2023-02-28 06:24:17'),
(10, 'jesih', NULL, 'anuelza.tms@gmail.com', '1123323443', 3, 2, NULL, '$2y$10$OjWIL3J0d48xEp1k4bvAb.rp1KZCv413tl5WUm.B/F9yd3sO5Dyry', NULL, 1, '2022-05-23 05:56:57', '2022-09-29 06:59:52', NULL),
(11, 'xejixi', NULL, 'xejixi8905@hbehs.com', '544433322444', 2, 1, NULL, '$2y$10$UO0WAZ8zach66EPwqGlNXeMed.pyLOnLXNu7tCDkGD9IT8vcv37Z.', NULL, 1, '2022-05-23 06:12:18', '2022-06-28 05:12:27', '2022-06-28 05:12:27'),
(12, 'doyes', NULL, 'doyes10266@cupbest.com', '3222112343', 3, 1, NULL, '$2y$10$9mEhad9vXjNkrUf4z6BY8ek/Zz5WnUoRddhGDDsRzpWnmh8FNGM6m', NULL, 1, '2022-05-23 06:17:50', '2022-06-28 05:12:49', '2022-06-28 05:12:49'),
(13, 'Mohsin', 'user_image/1653463492_Qhs0A_2437.jpg', 'kinik20165@roxoas.com', '9874563210', 2, 1, NULL, '$2y$10$NrFpFrXoPMnBxiP7Pc.RTevdjKRmJLLxjwg90ZmMc3jqh2DZ.hcW.', NULL, 1, '2022-05-25 07:17:58', '2022-06-28 05:12:21', '2022-06-28 05:12:21'),
(14, 'Aanya', NULL, 'sa.vergis@gmail.com', '95259742', 2, 1, NULL, NULL, NULL, 0, '2022-06-20 04:44:56', '2022-06-28 05:12:34', '2022-06-28 05:12:34'),
(15, 'Anu', NULL, 'isg@meitsystems.com', '99329332', 2, 2, NULL, NULL, NULL, 0, '2022-06-20 04:54:24', '2023-01-21 13:07:51', '2023-01-21 13:07:51'),
(16, 'sovafap961', NULL, 'sovafap961@giftcv.com', '322355', 2, 2, NULL, NULL, NULL, 0, '2022-06-27 05:14:05', '2023-02-28 06:23:51', '2023-02-28 06:23:51'),
(17, 'sovafap96111', NULL, 'sovafap96111@giftcv.com', '4343222111', 2, 2, NULL, NULL, NULL, 0, '2022-06-27 05:14:05', '2023-02-28 06:24:05', '2023-02-28 06:24:05'),
(18, 'maydiyatro', NULL, 'maydiyatro@vusra.com', '2345654321', 2, 1, NULL, NULL, NULL, 0, '2022-06-27 05:16:12', '2022-06-27 05:16:12', NULL),
(19, 'tiyor20808', NULL, 'tiyor20808@exoare.com', '45566632323', 2, 1, NULL, NULL, NULL, 0, '2022-06-27 05:22:55', '2022-06-29 06:25:21', NULL),
(20, 'Ashwin', NULL, 'ashwin@isg.com', NULL, 3, 1, NULL, NULL, NULL, 0, '2022-06-28 05:13:53', '2023-02-25 19:04:34', NULL),
(21, 'Akhil', NULL, 'jecawa7110@jrvps.com', NULL, 2, 2, NULL, NULL, NULL, 0, '2022-06-28 05:36:03', '2022-06-28 05:36:03', NULL),
(22, 'Vipin', NULL, 'girir99790@lankew.com', NULL, 2, 1, NULL, NULL, NULL, 0, '2022-06-28 05:43:11', '2022-06-28 05:43:11', NULL),
(23, 'yedatit', NULL, 'balifap355@jrvps.com', '4523456789', 2, 1, NULL, '$2y$10$ji9LtkP2Xe5NcbECnSVfH.Vl2GmT5g.zfQhI95fjHgNFXLHupl.yC', NULL, 1, '2022-06-28 08:04:57', '2022-06-28 09:51:11', NULL),
(24, 'Rachael Bobby', NULL, 'yedatit501@lankew.com', '34546565651', 3, 1, NULL, '$2y$10$OBvXgAJgZHCeO/FNpFWnsOnw6i3HIS3Zx/Dsep5A0et2C5fJoHdwm', NULL, 1, '2022-06-29 06:02:56', '2023-02-25 18:54:15', NULL),
(25, 'Agility', NULL, 'info@agilityglobal.net', NULL, 2, 1, NULL, '$2y$10$WGLyjD85I143NnAb9rPQeulsWB8XSE8/Rz3NtTmezqGN6HtLPwG5i', NULL, 1, '2022-06-29 06:15:51', '2023-01-26 07:55:05', '2023-01-26 07:55:05'),
(26, 'difivo', NULL, 'difivo8261@opude.com', '434322266655', 2, 2, NULL, NULL, NULL, 0, '2022-07-19 11:16:51', '2022-07-19 11:16:51', NULL),
(27, 'hertuyerko', NULL, 'hertuyerko@vusra.com', NULL, 2, 2, NULL, '$2y$10$3KcMYOTzJbcpuojaor14Ku42qpXYLmrJ0troRBOoMvpv/zeadHJ/y', NULL, 1, '2022-07-19 11:16:51', '2022-07-19 11:19:19', NULL),
(28, 'Mohsin Shukkur', NULL, 'mohsin@advanceinfotech.io', '8054666777', 3, 1, NULL, '$2y$10$4RhSKXFy6Wf9TiNkVm2/4OFL.qPp/A2e4/p5II3deMAqHqyA1WtHC', NULL, 1, '2022-10-08 05:05:26', '2022-10-13 11:54:06', '2022-10-13 11:54:06'),
(29, 'Sujanyaa Sriram', NULL, 'tasafod776@lutota.com', '2323232323', 3, 1, NULL, '$2y$10$U/FEqGfDAbiO0Aw6LsnT6OGQOoBMoZF4Z72vrbbN7fo0M2yWeBmkq', NULL, 1, '2022-10-08 05:29:24', '2023-02-24 09:57:56', NULL),
(30, 'Mohsin', NULL, 'mohsinshukkur@gmail.com', '9746793120', 3, 1, NULL, '$2y$10$nHsSeLe44nPSHn.3y2lqiOoGCAt4SOllyqlDHwyvJvUWISZlnfTku', NULL, 1, '2022-10-13 11:34:44', '2022-10-13 11:53:59', '2022-10-13 11:53:59'),
(31, 'Aanya Liz Vergis', 'user_image/1677353574_Pbxa4_4689.jpeg', 'info@meitsystems.com', NULL, 3, 1, NULL, '$2y$10$0djvSFN9eiOpwqbGbI0IrO9RX01jTTiFCsN4gITgVloIqz.tfRfs6', NULL, 1, '2023-01-26 09:30:01', '2023-02-25 19:32:54', NULL),
(32, 'Mohsin', 'user_image/1677568139_pF9r3_3670.jpeg', 'gosavop747@pubpng.com', NULL, 2, 1, NULL, '$2y$10$2icXoEgjuzPh3/WkFpStz.2DkcjD2Q3oONhQ3SpJlTVRPcaG7.Qhi', NULL, 1, '2023-02-28 06:45:03', '2023-02-28 07:25:03', '2023-02-28 07:25:03'),
(33, 'Jamsheer', NULL, 'jamsheer36@gmail.com', '9946889684', 2, 1, NULL, '$2y$10$NqqEFf2oJNGZrCDbI1SGv.a2dcyB/Q7Xu4nse8/ypFOlQASRDQ5Le', NULL, 1, '2023-02-28 11:05:32', '2023-02-28 11:11:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vienna_formula`
--

CREATE TABLE `vienna_formula` (
  `id` bigint UNSIGNED NOT NULL,
  `committe_id` int NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vienna_formula`
--

INSERT INTO `vienna_formula` (`id`, `committe_id`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '<p>testing this is a propoer chat and editor so that everytine can see this</p>', '2023-02-25 19:47:41', '2023-02-25 19:47:41', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocs`
--
ALTER TABLE `blocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blocs_name_index` (`name`);

--
-- Indexes for table `bloc_chats`
--
ALTER TABLE `bloc_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bloc_chats_user_id_index` (`user_id`),
  ADD KEY `bloc_chats_committe_id_index` (`committe_id`);

--
-- Indexes for table `bloc_members`
--
ALTER TABLE `bloc_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committee_files`
--
ALTER TABLE `committee_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committee_members`
--
ALTER TABLE `committee_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conference_schedules`
--
ALTER TABLE `conference_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conference_schedule_times`
--
ALTER TABLE `conference_schedule_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_answer`
--
ALTER TABLE `feedback_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_question`
--
ALTER TABLE `feedback_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `line_by_line`
--
ALTER TABLE `line_by_line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_submissions`
--
ALTER TABLE `paper_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paper_submissions_paper_index` (`paper`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `program_schedules`
--
ALTER TABLE `program_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_schedule_times`
--
ALTER TABLE `program_schedule_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resolution`
--
ALTER TABLE `resolution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_indexes`
--
ALTER TABLE `site_indexes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `speakers_country_id_index` (`country_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_user_id_index` (`user_id`),
  ADD KEY `students_name_index` (`name`),
  ADD KEY `students_email_index` (`email`),
  ADD KEY `students_whatsapp_no_index` (`whatsapp_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `vienna_formula`
--
ALTER TABLE `vienna_formula`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocs`
--
ALTER TABLE `blocs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bloc_chats`
--
ALTER TABLE `bloc_chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bloc_members`
--
ALTER TABLE `bloc_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `committee_files`
--
ALTER TABLE `committee_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `committee_members`
--
ALTER TABLE `committee_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conference_schedules`
--
ALTER TABLE `conference_schedules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `conference_schedule_times`
--
ALTER TABLE `conference_schedule_times`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_answer`
--
ALTER TABLE `feedback_answer`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_question`
--
ALTER TABLE `feedback_question`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `line_by_line`
--
ALTER TABLE `line_by_line`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `paper_submissions`
--
ALTER TABLE `paper_submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_schedules`
--
ALTER TABLE `program_schedules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `program_schedule_times`
--
ALTER TABLE `program_schedule_times`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `site_indexes`
--
ALTER TABLE `site_indexes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vienna_formula`
--
ALTER TABLE `vienna_formula`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
