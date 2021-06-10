-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 05:40 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makefuture`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mf_applyform`
--

CREATE TABLE `mf_applyform` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT 0,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `student_mobile` varchar(191) DEFAULT NULL,
  `father_name` varchar(191) DEFAULT NULL,
  `father_mobile` varchar(191) DEFAULT NULL,
  `mother_name` varchar(191) DEFAULT NULL,
  `mother_mobile` varchar(191) DEFAULT NULL,
  `nationality` varchar(191) DEFAULT NULL,
  `cast` varchar(191) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `citizenship` varchar(191) DEFAULT NULL,
  `examination` varchar(191) DEFAULT NULL,
  `rank_number` varchar(191) DEFAULT NULL,
  `qualified_examination` varchar(191) DEFAULT NULL,
  `registation_number` varchar(191) NOT NULL,
  `parmanent_address` text DEFAULT NULL,
  `local_address` text DEFAULT NULL,
  `state_id` int(10) NOT NULL DEFAULT 0,
  `college_id` int(10) NOT NULL DEFAULT 0,
  `academic_year` varchar(50) DEFAULT NULL,
  `course_id` int(10) NOT NULL DEFAULT 0,
  `currency` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `payment_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '''0''=>''Pending'', ''1''=>''Completed'', ''2'' => ''Failed''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_applyform`
--

INSERT INTO `mf_applyform` (`id`, `user_id`, `name`, `email`, `dob`, `student_mobile`, `father_name`, `father_mobile`, `mother_name`, `mother_mobile`, `nationality`, `cast`, `gender`, `citizenship`, `examination`, `rank_number`, `qualified_examination`, `registation_number`, `parmanent_address`, `local_address`, `state_id`, `college_id`, `academic_year`, `course_id`, `currency`, `price`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 27, 'John Smith', 'john898910@yopmail.com', '2021-05-03', '231', 'aj', '+448888888888', 'rd', '123', 'singapore', 'yd', 'Male', '5656', NULL, NULL, NULL, '', '#76 Street Nova\r\ntest 1', '#76 Street Nova\r\ntest 1', 1, 4, '2021', 2, 'inr', '3600.00', 1, '2021-05-05 04:07:53', '2021-05-07 07:36:17'),
(2, 27, 'John Smith', 'john898910@yopmail.com', '2021-04-27', '654', 'aj', '+448888888888', 'rd', '562', 'singapore', 'yd', 'Male', '5656', NULL, NULL, NULL, '', '#76 Street Nova\r\ntest 1', '#76 Street Nova\r\ntest 1', 1, 4, '2021', 1, 'inr', '8000.00', 0, '2021-05-07 04:25:05', '2021-05-07 04:25:05'),
(3, 27, 'John Smith', 'john898910@yopmail.com', '2021-04-27', '654', 'aj', '+448888888888', 'rd', '562', 'singapore', 'yd', 'Male', '5656', NULL, NULL, NULL, '', '#76 Street Nova\r\ntest 1', '#76 Street Nova\r\ntest 1', 1, 4, '2021', 1, 'inr', '8000.00', 1, '2021-05-07 04:28:47', '2021-05-15 09:12:02'),
(4, 27, 'John Smith', 'john898910@yopmail.com', NULL, NULL, NULL, '+448888888888', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, NULL, '', '#76 Street Nova', 'test 1', 1, 4, '2022', 1, 'inr', '8000.00', 1, '2021-05-07 04:30:41', '2021-05-07 07:34:21'),
(5, 28, 'Sumanta Nag', 'john89897@yopmail.com', '2021-04-27', '+448888888888', 'aj', '+448888888888', 'rd', '+448888888888', 'singapore', 'yd', 'Male', '5656', NULL, NULL, NULL, '', '#76 Street Nova', 'test 1', 1, 4, '2022', 2, 'inr', '3600.00', 0, '2021-05-07 07:26:14', '2021-05-07 07:26:14'),
(6, 28, 'Sumanta Nag', 'john89897@yopmail.com', '2021-04-27', '+448888888888', 'aj', '+448888888888', 'rd', '+448888888888', 'singapore', 'yd', 'Male', '5656', NULL, NULL, NULL, '', '#76 Street Nova', 'test 1', 1, 4, '2022', 2, 'inr', '3600.00', 1, '2021-05-07 07:26:57', '2021-05-07 07:27:05'),
(7, 33, 'Ajeet Pal', 'wtm.ajeet@gmail.com', '1988-01-05', '8588893705', 'Ram Autar Pal', '8588893705', 'Phoolmati Devi', '8588893706', 'Indian', 'OBC', 'Male', '865953730648', NULL, NULL, NULL, '', 'Mau-UP', 'Baguiati-Kolkata', 1, 4, '2021', 1, 'inr', '8000.00', 1, '2021-05-19 00:50:09', '2021-05-19 00:52:31'),
(8, 33, 'Ajeet Paul', 'wtm.ajeet@gmail.com', '1988-01-01', '8765473817', 'R A Paul', '8765473819', 'Patiya Devi', '8765473818', 'Indian', 'OBC', 'Male', '868953730648', NULL, NULL, NULL, '', 'Karnatka', 'Karnatka', 2, 5, '2022', 2, 'inr', '3200.00', 1, '2021-05-19 04:34:11', '2021-05-19 04:34:33'),
(9, 34, 'Siddhartha Sarkar', 'siddharthasarkar100@gmail.com', '2000-01-01', '8777655903', 'ranjit', '+918777655903', 'alaka', NULL, 'Indian', 'gen', 'Male', '123456789876', NULL, NULL, NULL, '', 'P.B.basu Sarani', 'sdcd', 1, 4, '2021', 1, 'inr', '8000.00', 0, '2021-05-25 02:27:41', '2021-05-25 02:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `mf_applyform_exam`
--

CREATE TABLE `mf_applyform_exam` (
  `id` bigint(20) NOT NULL,
  `applyform_id` bigint(20) NOT NULL,
  `subject_name` varchar(191) DEFAULT NULL,
  `marks` varchar(191) DEFAULT NULL,
  `percentage` varchar(191) DEFAULT NULL,
  `document` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_applyform_exam`
--

INSERT INTO `mf_applyform_exam` (`id`, `applyform_id`, `subject_name`, `marks`, `percentage`, `document`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test', '300', '62', NULL, '2021-05-07 04:07:53', '2021-05-07 04:07:53'),
(2, 3, 'Test', '300', '62', NULL, '2021-05-07 04:28:47', '2021-05-07 04:28:47'),
(3, 4, 'Test', '300', '62', '1620381641cartimg.jpg', '2021-05-07 04:30:41', '2021-05-07 04:30:41'),
(4, 2, 'Test', '300', '62', NULL, '2021-05-07 04:28:47', '2021-05-07 04:28:47'),
(5, 6, 'Subject Name', '300', '62', '1620401217cartimg.jpg', '2021-05-07 07:26:57', '2021-05-07 07:26:57'),
(6, 7, 'BCA', '4055', '64.88', '1621414209Primary-Care.jpg', '2021-05-19 00:50:09', '2021-05-19 00:50:09'),
(7, 8, 'Intermediate', '480', '80', '1621427651Phoenician.jpg', '2021-05-19 04:34:11', '2021-05-19 04:34:11'),
(8, 9, 'english', '80', '80', NULL, '2021-05-25 02:27:41', '2021-05-25 02:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `mf_city`
--

CREATE TABLE `mf_city` (
  `id` int(10) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `state_id` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_city`
--

INSERT INTO `mf_city` (`id`, `name`, `status`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Kolkata', 1, 1, '2021-04-28 02:05:16', '2021-04-28 02:05:51'),
(2, 'Bangalore', 1, 2, '2021-04-28 04:23:44', '2021-04-28 04:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `mf_college`
--

CREATE TABLE `mf_college` (
  `id` int(10) NOT NULL,
  `college_type` text DEFAULT NULL,
  `college_name` text DEFAULT NULL,
  `short_name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `state_id` int(10) NOT NULL DEFAULT 0,
  `city_id` int(10) NOT NULL DEFAULT 0,
  `bannerimage` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `estd_info` varchar(191) DEFAULT NULL,
  `rank_info` varchar(191) DEFAULT NULL,
  `brochure` text DEFAULT NULL,
  `map` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `course_fee` longtext DEFAULT NULL,
  `admission` longtext DEFAULT NULL,
  `placement` longtext DEFAULT NULL,
  `hostel` longtext DEFAULT NULL,
  `news_articles` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '''0''=>''Inactive'', ''1''=>''Active''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_college`
--

INSERT INTO `mf_college` (`id`, `college_type`, `college_name`, `short_name`, `slug`, `meta_keyword`, `meta_description`, `state_id`, `city_id`, `bannerimage`, `logo`, `estd_info`, `rank_info`, `brochure`, `map`, `description`, `course_fee`, `admission`, `placement`, `hostel`, `news_articles`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Engineering,Management', 'Indian Institute Of Management', 'IIMB', 'indian-institute-of-management', 'Indian Institute Of Management', 'Indian Institute Of Management', 2, 2, '1619691119innerbanner2.jpg', '1619691624collegesicon.jpg', 'ESTD 1973', 'RANKED 2 FOR MBA BY NIRF 2020', '1619691119colleges_portal_(1).docx', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.391712421121!2d88.3808768141874!3d22.60184313759435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0276183cb52ac7%3A0x4042bc94233f3bff!2sKolkata!5e0!3m2!1sen!2sin!4v1616072056914!5m2!1sen!2sin\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '<p><strong>Indian Institute of Management (IIM)</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>\r\n\r\n<h3>IIM Bangalore MBA vs IIM Ahmedabad MBA :</h3>\r\n\r\n<p>There is a cut-throat competition between IIM Bangalore and <strong>IIM Ahmedabad</strong> for MBA admission. Both of them rank among <strong>top management colleges in India</strong>. Key components of comparison are:</p>\r\n\r\n<ul>\r\n	<li>As per ranking: IIM Ahmedabad ranks #1 in 2020, while IIM Bangalore ranked #1 in 2019 by NIRF.</li>\r\n	<li>Both offer MBA degrees in place of PG Diplomas after course completion.</li>\r\n	<li>In terms of fee: Both IIM Bangalore and IIM Ahmedabad charge INR 23 lakhs for its MBA programme. Read: IIM Bangalore MBA Fee.</li>\r\n	<li>MBA admission at IIM Bangalore and Ahmedabad are highly selective. Accepting CAT percentile between 99 and 100 and high distinction in academics. Check: IIMs Selection Criteria.</li>\r\n	<li>In terms of placements: IIM Ahmedabad leads with highest CTC of INR 74.6 LPA. in comparison to IIM Bangalore offering between INR 50-55 LPA in 2020. With a promising high ROI.</li>\r\n	<li>Exchange Programmes: IIM Bangalore has partnered with 13 international institutions, IIM Ahmedabad has only 07 international partnerships.</li>\r\n</ul>', '<p><strong>Indian Institute of Management (IIM)</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>', '<p><strong>Indian Institute of Management (IIM)</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>', '<p><strong>Indian Institute of Management (IIM)</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>', '<p><strong>Indian Institute of Management (IIM)</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>', '<p><strong>Indian Institute of Management (IIM)</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>', 1, '2021-04-29 03:39:53', '2021-04-29 10:50:40'),
(4, 'Management', 'Programme in Enterprise Management', 'PGPEM', 'post-graduate-programme-in-enterprise-management', 'Post Graduate Programme in Enterprise Management', 'Post Graduate Programme in Enterprise Management', 1, 1, '1619713905innerbanner1.jpg', '1619713905collegesicon1.jpg', 'ESTD 1975', 'RANKED 1 FOR MBA BY NIRF 2021', '1619713905colleges_portal_(1).docx', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.391712421121!2d88.3808768141874!3d22.60184313759435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0276183cb52ac7%3A0x4042bc94233f3bff!2sKolkata!5e0!3m2!1sen!2sin!4v1616072056914!5m2!1sen!2sin\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '<p><strong>Post Graduate Programme in Enterprise Management</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>\r\n\r\n<h3>IIM Bangalore MBA vs IIM Ahmedabad MBA :</h3>\r\n\r\n<p>There is a cut-throat competition between IIM Bangalore and <strong>IIM Ahmedabad</strong> for MBA admission. Both of them rank among <strong>top management colleges in India</strong>. Key components of comparison are:</p>\r\n\r\n<ul>\r\n	<li>As per ranking: IIM Ahmedabad ranks #1 in 2020, while IIM Bangalore ranked #1 in 2019 by NIRF.</li>\r\n	<li>Both offer MBA degrees in place of PG Diplomas after course completion.</li>\r\n	<li>In terms of fee: Both IIM Bangalore and IIM Ahmedabad charge INR 23 lakhs for its MBA programme. Read: IIM Bangalore MBA Fee.</li>\r\n	<li>MBA admission at IIM Bangalore and Ahmedabad are highly selective. Accepting CAT percentile between 99 and 100 and high distinction in academics. Check: IIMs Selection Criteria.</li>\r\n	<li>In terms of placements: IIM Ahmedabad leads with highest CTC of INR 74.6 LPA. in comparison to IIM Bangalore offering between INR 50-55 LPA in 2020. With a promising high ROI.</li>\r\n	<li>Exchange Programmes: IIM Bangalore has partnered with 13 international institutions, IIM Ahmedabad has only 07 international partnerships.</li>\r\n</ul>', '<p><strong>Post Graduate Programme in Enterprise Management</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>\r\n\r\n<h3>IIM Bangalore MBA vs IIM Ahmedabad MBA :</h3>\r\n\r\n<p>There is a cut-throat competition between IIM Bangalore and <strong>IIM Ahmedabad</strong> for MBA admission. Both of them rank among <strong>top management colleges in India</strong>. Key components of comparison are:</p>\r\n\r\n<ul>\r\n	<li>As per ranking: IIM Ahmedabad ranks #1 in 2020, while IIM Bangalore ranked #1 in 2019 by NIRF.</li>\r\n	<li>Both offer MBA degrees in place of PG Diplomas after course completion.</li>\r\n	<li>In terms of fee: Both IIM Bangalore and IIM Ahmedabad charge INR 23 lakhs for its MBA programme. Read: IIM Bangalore MBA Fee.</li>\r\n	<li>MBA admission at IIM Bangalore and Ahmedabad are highly selective. Accepting CAT percentile between 99 and 100 and high distinction in academics. Check: IIMs Selection Criteria.</li>\r\n	<li>In terms of placements: IIM Ahmedabad leads with highest CTC of INR 74.6 LPA. in comparison to IIM Bangalore offering between INR 50-55 LPA in 2020. With a promising high ROI.</li>\r\n	<li>Exchange Programmes: IIM Bangalore has partnered with 13 international institutions, IIM Ahmedabad has only 07 international partnerships.</li>\r\n</ul>', '<p><strong>Post Graduate Programme in Enterprise Management</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>\r\n\r\n<h3>IIM Bangalore MBA vs IIM Ahmedabad MBA :</h3>\r\n\r\n<p>There is a cut-throat competition between IIM Bangalore and <strong>IIM Ahmedabad</strong> for MBA admission. Both of them rank among <strong>top management colleges in India</strong>. Key components of comparison are:</p>\r\n\r\n<ul>\r\n	<li>As per ranking: IIM Ahmedabad ranks #1 in 2020, while IIM Bangalore ranked #1 in 2019 by NIRF.</li>\r\n	<li>Both offer MBA degrees in place of PG Diplomas after course completion.</li>\r\n	<li>In terms of fee: Both IIM Bangalore and IIM Ahmedabad charge INR 23 lakhs for its MBA programme. Read: IIM Bangalore MBA Fee.</li>\r\n	<li>MBA admission at IIM Bangalore and Ahmedabad are highly selective. Accepting CAT percentile between 99 and 100 and high distinction in academics. Check: IIMs Selection Criteria.</li>\r\n	<li>In terms of placements: IIM Ahmedabad leads with highest CTC of INR 74.6 LPA. in comparison to IIM Bangalore offering between INR 50-55 LPA in 2020. With a promising high ROI.</li>\r\n	<li>Exchange Programmes: IIM Bangalore has partnered with 13 international institutions, IIM Ahmedabad has only 07 international partnerships.</li>\r\n</ul>', '<p><strong>Post Graduate Programme in Enterprise Management</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>\r\n\r\n<h3>IIM Bangalore MBA vs IIM Ahmedabad MBA :</h3>\r\n\r\n<p>There is a cut-throat competition between IIM Bangalore and <strong>IIM Ahmedabad</strong> for MBA admission. Both of them rank among <strong>top management colleges in India</strong>. Key components of comparison are:</p>\r\n\r\n<ul>\r\n	<li>As per ranking: IIM Ahmedabad ranks #1 in 2020, while IIM Bangalore ranked #1 in 2019 by NIRF.</li>\r\n	<li>Both offer MBA degrees in place of PG Diplomas after course completion.</li>\r\n	<li>In terms of fee: Both IIM Bangalore and IIM Ahmedabad charge INR 23 lakhs for its MBA programme. Read: IIM Bangalore MBA Fee.</li>\r\n	<li>MBA admission at IIM Bangalore and Ahmedabad are highly selective. Accepting CAT percentile between 99 and 100 and high distinction in academics. Check: IIMs Selection Criteria.</li>\r\n	<li>In terms of placements: IIM Ahmedabad leads with highest CTC of INR 74.6 LPA. in comparison to IIM Bangalore offering between INR 50-55 LPA in 2020. With a promising high ROI.</li>\r\n	<li>Exchange Programmes: IIM Bangalore has partnered with 13 international institutions, IIM Ahmedabad has only 07 international partnerships.</li>\r\n</ul>', '<p><strong>Post Graduate Programme in Enterprise Management</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>\r\n\r\n<h3>IIM Bangalore MBA vs IIM Ahmedabad MBA :</h3>\r\n\r\n<p>There is a cut-throat competition between IIM Bangalore and <strong>IIM Ahmedabad</strong> for MBA admission. Both of them rank among <strong>top management colleges in India</strong>. Key components of comparison are:</p>\r\n\r\n<ul>\r\n	<li>As per ranking: IIM Ahmedabad ranks #1 in 2020, while IIM Bangalore ranked #1 in 2019 by NIRF.</li>\r\n	<li>Both offer MBA degrees in place of PG Diplomas after course completion.</li>\r\n	<li>In terms of fee: Both IIM Bangalore and IIM Ahmedabad charge INR 23 lakhs for its MBA programme. Read: IIM Bangalore MBA Fee.</li>\r\n	<li>MBA admission at IIM Bangalore and Ahmedabad are highly selective. Accepting CAT percentile between 99 and 100 and high distinction in academics. Check: IIMs Selection Criteria.</li>\r\n	<li>In terms of placements: IIM Ahmedabad leads with highest CTC of INR 74.6 LPA. in comparison to IIM Bangalore offering between INR 50-55 LPA in 2020. With a promising high ROI.</li>\r\n	<li>Exchange Programmes: IIM Bangalore has partnered with 13 international institutions, IIM Ahmedabad has only 07 international partnerships.</li>\r\n</ul>', '<p><strong>Post Graduate Programme in Enterprise Management</strong>, Bangalore is the 3rd IIM, established after IIM Calcutta. It was institutionalised in 1973, to provide managers for public sector companies due to growing demands. IIM Bangalore is a distinguished Management institute in not just India but in Asia too. It is known for its renowned flagship MBA program. IIM Bangalore Admission Criteria for MBA is very comprehensive, only a handful (of 400) from over a lakh applications are shortlisted for final admission. NIRF ranked IIM Bangalore at #2 in 2020, while FT Global Rankings 2020 ranked IIMB MBA at #27. IIM Bangalore is also ranked for its PGPEM programme in top 100 in Financial Times EMBA 2020 Ranking and has achieved 2nd position in India.</p>\r\n\r\n<p>Located in India&rsquo;s Silicon Valley, the hub of startups and technological advancements, IIM Bangalore attracts more than 150 companies annually for on-campus placement drives. IIM Bangalore Placements are usually 100% and average CTC is promising in terms of high ROI. IIM Bangalore is also the only Indian institution to have partnered with Yale University for exchange programs through Global Network for Advanced Management.</p>\r\n\r\n<h3>IIM Bangalore MBA vs IIM Ahmedabad MBA :</h3>\r\n\r\n<p>There is a cut-throat competition between IIM Bangalore and <strong>IIM Ahmedabad</strong> for MBA admission. Both of them rank among <strong>top management colleges in India</strong>. Key components of comparison are:</p>\r\n\r\n<ul>\r\n	<li>As per ranking: IIM Ahmedabad ranks #1 in 2020, while IIM Bangalore ranked #1 in 2019 by NIRF.</li>\r\n	<li>Both offer MBA degrees in place of PG Diplomas after course completion.</li>\r\n	<li>In terms of fee: Both IIM Bangalore and IIM Ahmedabad charge INR 23 lakhs for its MBA programme. Read: IIM Bangalore MBA Fee.</li>\r\n	<li>MBA admission at IIM Bangalore and Ahmedabad are highly selective. Accepting CAT percentile between 99 and 100 and high distinction in academics. Check: IIMs Selection Criteria.</li>\r\n	<li>In terms of placements: IIM Ahmedabad leads with highest CTC of INR 74.6 LPA. in comparison to IIM Bangalore offering between INR 50-55 LPA in 2020. With a promising high ROI.</li>\r\n	<li>Exchange Programmes: IIM Bangalore has partnered with 13 international institutions, IIM Ahmedabad has only 07 international partnerships.</li>\r\n</ul>', 1, '2021-04-29 11:01:45', '2021-04-29 11:05:37'),
(5, 'Engineering,Science', 'Bangalore College of Engineering and Technology', 'BCET', 'bangalore-college-of-engineering-and-technology', 'Bangalore College of Engineering and Technology', 'Bangalore College of Engineering and Technology', 2, 2, '1619762570bcet02.jpg', NULL, 'ESTD 1970', 'RANKED 2 FOR MBA BY NIRF 2021', NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15561.855361083548!2d77.7102832!3d12.8132758!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbd6c78f825941766!2sBangalore%20College%20of%20Engineering%20and%20Technology!5e0!3m2!1sen!2sin!4v1580366460578!5m2!1sen!2sin\" width=\"600\" height=\"400\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', '<p>Bangalore College of Engineering and Technology (BCET) is one among the teaching and research Institutes. The Institute strives towards providing education that inspires students. This 20 year old institution that comes under COMEDK and CET Karnataka. BCET is affialiated to Visvesvaraya Technological University (VTU) belagavi, approved by AICTE New Delhi and recognized by Government of Karnataka</p>\r\n\r\n<p>Bangalore College of Engineering &amp; Technology (BCET) was founded in 2000 by Bangalore Educational Trust to impart quality education in a stimulating and innovative environment where students are empowered with knowledge and professional skills while upholding the values of integrity, tolerance and mutual respect. Since its inception the Bangalore Educational Trust has promoted education in the areas of Engineering &amp; Technology, Nursing, Edcation.</p>\r\n\r\n<p>Highly qualified, well experienced &amp; competent research oriented faculty, motivating and creating an environment for students to develop their skills and strengthen their knowledge. The strength of BCET lies in its choice of faculty members, all of whom have vast experience in addition to enviable academic qualifications; faculty members are into research which helps them in creating knowledge and delivering the same to students. This makes the institution academically vibrant.</p>', '<h3>Computer Science &amp; Engineering</h3>\r\n\r\n<hr />\r\n<p>Department of Computer Science and Engineering takes special efforts to impart learning ability for the students. The students are focused with the use of conceptual understanding of core domain area in Computing as well as enhanced programming skills disseminating their analytical abilities. The faculties of our department are well qualified and have rich knowledge in their subjects. In order to update their knowledge The staff members are deputed to undergo training in the latest topics.</p>\r\n\r\n<h3>Electronics and Communication engineering</h3>\r\n\r\n<hr />\r\n<p>This course aims to prepare students for developing their careers in the field of &ldquo;Electronics and Communication engineering&rdquo;. Digital Signal Processing in telecommunication has seen explosive growth during the past two decades, as phenomenal advances both in the research and application have been made. Advances in digital computer technology and software development have been the Motivating factors for this growth.</p>\r\n\r\n<h3>Electrical &amp; Electronics Engineering</h3>\r\n\r\n<hr />\r\n<p>Electrical engineering is a field of engineering that deals with the study and application of electricity, electronics and electromagnetism. This field covers a range of areas including power, electronics, control systems, signal processing and telecommunications. Electrical engineering is considered to deal with the problems associated with large-scale electrical systems such as power transmission and motor control, whereas electronic engineering deals with the study of small-scale electronic systems including computers and integrated circuits. Electrical engineers are usually concerned with using electricity to transmit energy, while electronic engineers are concerned with using electricity to transmit information.</p>', '<p>The meritorious and economically backward students get scholarship to pursue their education in this institutions. The scholarship by way of fee concession is given by the institution to all the students allotted by the State Government and Central Government. Scholarships are also considered to the deserving candidates under other categories by the management as appropriate.</p>\r\n\r\n<p>Students admitted under the reservation category for SC / ST / OBC can seek scholarship for the fee payable to the insitution from the State Government, subject to their eligibility as notified by the government from time to time.</p>\r\n\r\n<p>Students who had applied for scholarship to the Government authorities and Other outside Bodies shall verify the status of their refundable amount after the fee adjustment</p>', '<p>Our college provides the best placements for students. Some of the companies in which our students are placed are:-</p>', '<p>The meritorious and economically backward students get scholarship to pursue their education in this institutions. The scholarship by way of fee concession is given by the institution to all the students allotted by the State Government and Central Government. Scholarships are also considered to the deserving candidates under other categories by the management as appropriate.</p>\r\n\r\n<p>Students admitted under the reservation category for SC / ST / OBC can seek scholarship for the fee payable to the insitution from the State Government, subject to their eligibility as notified by the government from time to time.</p>\r\n\r\n<p>Students who had applied for scholarship to the Government authorities and Other outside Bodies shall verify the status of their refundable amount after the fee adjustment</p>', '<p>The meritorious and economically backward students get scholarship to pursue their education in this institutions. The scholarship by way of fee concession is given by the institution to all the students allotted by the State Government and Central Government. Scholarships are also considered to the deserving candidates under other categories by the management as appropriate.</p>\r\n\r\n<p>Students admitted under the reservation category for SC / ST / OBC can seek scholarship for the fee payable to the insitution from the State Government, subject to their eligibility as notified by the government from time to time.</p>\r\n\r\n<p>Students who had applied for scholarship to the Government authorities and Other outside Bodies shall verify the status of their refundable amount after the fee adjustment</p>', 1, '2021-04-30 00:32:50', '2021-04-30 00:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `mf_college_course`
--

CREATE TABLE `mf_college_course` (
  `id` bigint(20) NOT NULL,
  `college_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_college_course`
--

INSERT INTO `mf_college_course` (`id`, `college_id`, `course_id`, `price`) VALUES
(10, 5, 2, '3200.00'),
(14, 2, 3, '5000.00'),
(13, 2, 2, '3000.00'),
(7, 4, 1, '8000.00'),
(6, 4, 2, '3600.00'),
(11, 5, 1, '4500.00');

-- --------------------------------------------------------

--
-- Table structure for table `mf_college_faculty`
--

CREATE TABLE `mf_college_faculty` (
  `id` int(10) NOT NULL,
  `college_id` int(10) NOT NULL,
  `title` text DEFAULT NULL,
  `designation` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `bannerimage` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '''0''=>''Inactive'', ''1''=>''Active''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_college_faculty`
--

INSERT INTO `mf_college_faculty` (`id`, `college_id`, `title`, `designation`, `slug`, `meta_keyword`, `meta_description`, `bannerimage`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'Dr. Banumathi T', 'Chairperson', 'dr-banumathi-t', 'Dr. Banumathi T', 'Dr. Banumathi T', NULL, '<p>BCET has a distinctive mission and history that set us apart from other institutions when we started Bangalore Educational Trust almost two decades ago. We envisioned a new kind of academic institution-one that could put it, &quot;serve the times and the nation&#39;s needs.&quot;</p>\r\n\r\n<p>Our efforts for innovating curriculum, percolating research culture, supporting our innovative student teams and upgrading our infrastructure with a vision and commitment to move further on the pathways of excellence perhaps is what made BCET to climb to be a top class institution in the region. It must be highly satisfying that our stake holders namely, the Industry, Government and the people in the community have acknowledged their recognition of the spirit of excellence of our institution as it is truly reflected in our endeavor to provide value based education.</p>\r\n\r\n<p>Faith in the name of our institution, the Government and the society recognizes the value of goodness that is cultivated in this institution in plenty by its students, teachers and all those who are part and parcel of this institution. I am sure our achievements will make feel everyone of us proud. Our alumni here in India and abroad will feel proud of our achievements and this must invigorate our mind and soul to commit for even higher levels of achievements in the ensuing years.</p>', 1, '2021-04-30 02:34:29', '2021-04-30 02:35:39'),
(2, 2, 'PROF. RAJALAXMI KAMATH', 'Professor, Department Of Centre For Public Policy', 'prof-rajalaxmi-kamath', 'PROF. RAJALAXMI KAMATH', 'PROF. RAJALAXMI KAMATH', NULL, '<p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>\r\n\r\n<p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>', 1, '2021-04-30 02:38:29', '2021-04-30 02:38:29'),
(3, 4, 'Dr. Channankaiah, ME, PhD', 'Principal', 'dr-channankaiah-me-phd', 'Dr. Channankaiah, ME, PhD', 'Dr. Channankaiah, ME, PhD', '1619770570innerbanner1.jpg', '<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>\r\n\r\n<p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>', 1, '2021-04-30 02:40:18', '2021-04-30 02:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `mf_college_image`
--

CREATE TABLE `mf_college_image` (
  `id` bigint(20) NOT NULL,
  `college_id` int(10) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_college_image`
--

INSERT INTO `mf_college_image` (`id`, `college_id`, `image`) VALUES
(1, 2, '1619688486details1.jpg'),
(13, 4, '1619713905servicesbg2.jpg'),
(3, 2, '1619690033about-img1.jpg'),
(4, 2, '1619690045aboutimg.jpg'),
(12, 4, '1619713905servicesbg1.jpg'),
(11, 2, '1619712045details1.jpg'),
(10, 2, '1619691119details1.jpg'),
(14, 5, '1619762570pic1.jpg'),
(15, 5, '1619762570pic8.jpg'),
(16, 5, '1619762570pic9.jpg'),
(17, 5, '1619762570pic10.jpg'),
(18, 5, '1619762570pic11-1.jpg'),
(19, 5, '1619762570pic12.jpg'),
(20, 5, '1619762570pic14.jpg'),
(21, 5, '1619762570pic15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mf_course`
--

CREATE TABLE `mf_course` (
  `id` int(10) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `completed_in` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `bannerimage` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `course_type` tinyint(4) DEFAULT 0 COMMENT '''1''=>''10th'',''2''=>''12th'',''3''=>''Graduation''',
  `course_subtype` tinyint(4) NOT NULL DEFAULT 0 COMMENT '''1''=>''Science'',''2''=>''Arts'',''3''=>''Commerce''',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_course`
--

INSERT INTO `mf_course` (`id`, `name`, `slug`, `image`, `completed_in`, `status`, `meta_keyword`, `meta_description`, `bannerimage`, `description`, `course_type`, `course_subtype`, `created_at`, `updated_at`) VALUES
(1, 'MBA/PGDM', 'mba-pgdm', '1619693847courseimg1.jpg', '2', 1, 'MBA/PGDM', 'MBA/PGDM', NULL, '<p>MBA/PGDM</p>', 2, 1, '2021-04-28 03:18:27', '2021-05-29 05:03:55'),
(2, 'BE/B.Tech', 'be-b-tech', '1619693829courseimg.jpg', '4', 1, NULL, NULL, NULL, NULL, 0, 0, '2021-04-28 03:20:16', '2021-04-29 10:55:57'),
(3, 'PH.D FINANCE & ACCOUNTS', 'ph-d-finance-accounts', '1619693642courseimg5.jpg', '5', 1, NULL, NULL, NULL, NULL, 0, 0, '2021-04-28 04:04:18', '2021-04-29 10:54:03'),
(4, 'Diploma in Engineering/Polytechnic course', 'diploma-in-engineering-polytechnic-course', '', '3', 1, 'Diploma in Engineering/Polytechnic course', 'Diploma in Engineering/Polytechnic course', NULL, '<p><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:16.5pt\"><span style=\"font-family:&quot;Lato&quot;,&quot;serif&quot;\"><span style=\"color:#333333\">About Diploma in Engineering (Polytechnic)</span></span></span></strong></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Lato&quot;,&quot;serif&quot;\"><span style=\"color:#333333\">Diploma in Engineering is a professional course which is of a total of 3 years duration. The candidates who have passed class 10th or 12th can apply for admission to Diploma in Engineering. Sometimes, the candidates cannot get admission in BE or B. Tech directly. Therefore, they apply for a degree in Diploma in Engineering which can help them get admission directly to the second year of Engineering. After completing a degree in Diploma, the candidates can go for B.Tech which collectively takes them 6 years to complete their engineering (3 years diploma + 3 years B. Tech).</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Lato&quot;,&quot;serif&quot;\"><span style=\"color:#333333\">Through the Diploma in Engineering, the candidates can go for a specific stream of engineering. Through the course, the candidates are provided theoretical and practical knowledge in terms of basic Mathematics, Physics, Chemistry, Computer Science, and other related subjects.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">Following are the key points and Highlights of the Polytechnic course-</span></span></span></span></span></span></p>\r\n\r\n<table border=\"1\" cellspacing=\"0\" class=\"Table\" style=\"background:white; border-collapse:collapse; border:solid #dddddd 1.0pt; width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"background-color:white; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Course Level</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:white; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">12th</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#f2f2f2; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">course Duration</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#f2f2f2\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">3 years (6 Semesters)</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:white; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Eligibility</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:white\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">10th from any Recognized Board, minimum 35 % in 10th</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#f2f2f2; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Age</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#f2f2f2\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Minimum of 14 years</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:white; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Admission Process</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:white\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Direct in Most of the Private colleges, for Government colleges Entrance exam</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#f2f2f2; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Tuition fees</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#f2f2f2\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">5 thousand per year to 50 thousand per year</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:white; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Exam Type</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:white\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Semester wise</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#f2f2f2; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Starting Average Salary</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#f2f2f2\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">1.5 lakhs to 3 lakhs per year</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:white; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Job profile</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:white\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Junior Engineer, Teacher,</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#f2f2f2; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Placement Opportunities</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#f2f2f2\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Government Jobs, Electricity Department, PWD, IOCL</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:white; border-color:#dddddd\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Top Achievement</span></span></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:white\">\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"font-family:&quot;Trebuchet MS&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">most of the top-level engineers are Diploma holders</span></span></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:16.5pt\"><span style=\"font-family:&quot;Lato&quot;,&quot;serif&quot;\"><span style=\"color:#333333\">Diploma in Engineering (Polytechnic) Career Options and Job Prospects</span></span></span></strong></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Lato&quot;,&quot;serif&quot;\"><span style=\"color:#333333\">After completing a course in Diploma in Engineering,&nbsp; the candidates can opt for various career opportunities and job prospects. The candidates who have pursued a degree in Diploma in Engineering can go for either a government-based or a private based industry. The various job options which the candidates can off after pursuing a degree in Diploma in Engineering include Assistant Engineer, Junior Manager, Assistant Inventory Manager, Project Assistant, Junior Engineer, Professor, Consultant, etc. The starting salary of a candidate for Diploma in Civil Engineering ranges in between INR 3 to 6 LPA</span></span></span></span></span></span></p>\r\n\r\n<h3><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri Light&quot;,sans-serif\"><span style=\"color:#5b9bd5\"><strong><span style=\"font-size:18.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Who should Join Diploma in Engineering or Polytechnic course?</span></span></span></strong></span></span></span></span></h3>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">Students whose interest is in the technical field or engineering, they should join this course.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">Students who have an interest in mathematics and science subjects can also think about taking this course.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">If a student has decided that he has to pursue further engineering and pursue a career in the field of engineering, then he can start his career by pursuing a diploma in engineering or a polytechnic course.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">Also, students who want to get a job oriented technical degree by paying a low fee in a short time, in which there are good chances of getting both government jobs and private jobs, then they should also do this course</span></span></span></span></span></p>\r\n\r\n<h3><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri Light&quot;,sans-serif\"><span style=\"color:#5b9bd5\"><strong><span style=\"font-size:18.0pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#203245\">Benefits of Diploma in Engineering/Polytechnic course-</span></span></span></strong></span></span></span></span></h3>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">There are many benefits of doing this course, only after doing this course of 3 years, you can work on the post of Junior Engineer, and this technical course has the potential to take your career to a good height.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">You can start working in both government and private fields by paying fewer fees and getting this technical degree in less time.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">Another advantage of doing this course is that if you want to do further engineering, then you can get admission directly in the second year, then you save 1 year there.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">In the case of many students, it is seen that after doing this course, they start working and together they also do engineering from distance mode or after taking experience.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">Many people start their own business after doing this course, and as they have technical knowledge, they are also very successful.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:11.5pt\"><span style=\"font-family:&quot;Arial&quot;,&quot;sans-serif&quot;\"><span style=\"color:#636363\">So if your interest is also in the field of engineering, then once you understand this course, if you like it, then you can think about joining this course.</span></span></span></span></span></p>', 2, 1, '2021-05-29 05:05:18', '2021-05-29 05:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `mf_email_template`
--

CREATE TABLE `mf_email_template` (
  `id` int(2) NOT NULL,
  `registration_email` longtext NOT NULL,
  `user_registration_email_to_admin` text DEFAULT NULL,
  `forgotpass_email` longtext NOT NULL,
  `release_request_approved_email` text DEFAULT NULL,
  `account_approved_email` text DEFAULT NULL,
  `password_change_email` text DEFAULT NULL,
  `order_email` longtext DEFAULT NULL,
  `order_email_to_admin` text DEFAULT NULL,
  `order_complete_email` text DEFAULT NULL,
  `order_complete_email_to_admin` text DEFAULT NULL,
  `order_accept_email` text DEFAULT NULL,
  `order_cancel_email` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_email_template`
--

INSERT INTO `mf_email_template` (`id`, `registration_email`, `user_registration_email_to_admin`, `forgotpass_email`, `release_request_approved_email`, `account_approved_email`, `password_change_email`, `order_email`, `order_email_to_admin`, `order_complete_email`, `order_complete_email_to_admin`, `order_accept_email`, `order_cancel_email`) VALUES
(1, '<p style=\"text-align: left;\">Hello&nbsp;{#Firstname#},</p><p style=\"text-align: left;\">Welcome to College Portal, and thank you for joining the family!</p><div><div style=\"text-align: left;\">Your account has been created.</div><div style=\"text-align: left;\">To get started, login with your user details at:</div><div style=\"text-align: left;\"><br></div><div><br></div><div><a href=\"{#Loginurl#}\" class=\"custom-button\" target=\"_blank\" style=\"mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-size:16px;color:#FFFFFF;border-style:solid;border-color:#056B4E;border-width:15px 30px;display:inline-block;background:#056B4E;border-radius:4px;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center\">Login</a></div></div><div><br></div><p style=\"text-align: left;\">Email / Username:&nbsp;<span style=\"font-weight: 700;\">{#Email#}</span></p><p style=\"text-align: left;\">Password: <b>{#Password#}</b></p>\r\n\r\n<p style=\"text-align: left;\">Thank you,</p><p style=\"text-align: left;\">The College Portal Team</p><p style=\"text-align: left;\">P.S. If you have any questions or need any assistance, reply to this email and our friendly support staff can help you out.</p>', '<p>Hello {#Firstname#},</p><p>A new user has been registered. Details have been given below.</p> <p>{#UserDetails#}. </p><p>Thank you,</p><p>The Juve Team<br></p>', '<p style=\"text-align: left;\">Dear Member,</p>\r\n\r\n<p style=\"text-align: left;\">Please <a href=\"{#ResetPasswordLink#}\">click here</a> to reset your password or directly open the below link.</p>\r\n\r\n<p style=\"text-align: left;\">{#ResetPasswordLink#}</p><p style=\"text-align: left;\"><br></p><p style=\"text-align: left;\">Regards,</p><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-size: 11.9px;\">{#Sitename#}</span><br></p>', '<p style=\"text-align: left;\">Hello {#Fullname#},</p><p style=\"text-align: left;\"><span style=\"color: rgb(51, 51, 51); font-size: 11.9px;\">Earning amount&nbsp;</span>{#<span style=\"color: rgb(51, 51, 51); font-size: 11.9px;\">Earningamount</span>#} has approved \" their \" {#Sitename#}\".</p><p style=\"text-align: left;\">Thank you,</p><p style=\"text-align: left;\">The Anoview Team<br></p><div><br></div><p><br></p>', '<p style=\"text-align: left;\"><b>Hello {#Fullname#},</b></p>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\"> \r\n                     <tbody><tr style=\"border-collapse:collapse\"> \r\n                      <td align=\"center\" class=\"es-m-txt-c\" style=\"padding:0;Margin:0\"><p style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:22px;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;line-height:33px;color:#434343\"><strong>Your account has been approved!</strong></p></td> \r\n                     </tr> \r\n                     <tr style=\"border-collapse:collapse\"> \r\n                      <td align=\"center\" style=\"padding:0;Margin:0;padding-left:10px;padding-right:10px;padding-top:30px\"><span class=\"es-button-border\" style=\"border-style:solid;border-color:transparent;background:#056B4E;border-width:0px;display:inline-block;border-radius:4px;width:auto\"><a href=\"{#Loginurl#}\" class=\"es-button\" target=\"_blank\" style=\"mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-size:16px;color:#FFFFFF;border-style:solid;border-color:#056B4E;border-width:15px 30px;display:inline-block;background:#056B4E;border-radius:4px;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center\">Login my account</a></span></td> \r\n                     </tr> \r\n                   </tbody></table>', '<p>Hi &nbsp;{#Fullname#},</p><p>The password for your College Portal&nbsp;Account was recently changed.</p><p><br></p>\r\n\r\n<p>If you did not change your password, please notify our support team at support@collegeportal.com<br></p>\r\n\r\n<p>Thank you,</p><p>The College Portal&nbsp;Team</p>', '<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\"> \r\n                     <tbody><tr style=\"border-collapse:collapse\"> \r\n                      <td align=\"center\" class=\"es-m-txt-c\" style=\"padding:0;Margin:0\">\r\n<h3>Thank you!</h3>\r\n<h4>Your order number is: <span>{#</span>TransactionID<span>#}</span></h4>\r\n<p style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:22px;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;line-height:33px;color:#434343\"><br></p></td> \r\n                     </tr> \r\n                     <tr style=\"border-collapse:collapse\"> \r\n                      <td align=\"center\" style=\"padding:0;Margin:0;padding-left:10px;padding-right:10px;padding-top:30px\"><span class=\"es-button-border\" style=\"border-style:solid;border-color:transparent;background:#056B4E;border-width:0px;display:inline-block;border-radius:4px;width:auto\"><a href=\"{#Loginurl#}\" class=\"es-button\" target=\"_blank\" style=\"mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-size:16px;color:#FFFFFF;border-style:solid;border-color:#056B4E;border-width:15px 30px;display:inline-block;background:#056B4E;border-radius:4px;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center\">Login</a></span></td> \r\n                     </tr> \r\n                   </tbody></table>', '<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\"> \r\n                     <tbody><tr style=\"border-collapse:collapse\"> \r\n                      <td align=\"center\" class=\"es-m-txt-c\" style=\"padding:0;Margin:0\">\r\n<h3>Dear Admin!</h3>\r\n<h4>Order number is: <span>{#</span>TransactionID#}</h4>\r\n</td> \r\n                     </tr> \r\n                   </tbody></table>', '<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\"> \r\n                     <tbody><tr style=\"border-collapse:collapse\"> \r\n                      <td align=\"center\" class=\"es-m-txt-c\" style=\"padding:0;Margin:0\">\r\n<h3>Dear {#Fullname#}!</h3>\r\n<h4>Order number is: <span>{#OrderID#}</span></h4>\r\n</td> \r\n                     </tr> \r\n                   </tbody></table>', '<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\"> \r\n                     <tbody><tr style=\"border-collapse:collapse\"> \r\n                      <td align=\"center\" class=\"es-m-txt-c\" style=\"padding:0;Margin:0\">\r\n<h3>Dear Admin!</h3>\r\n<h4>Order number is: <span>{#OrderID#}</span></h4>\r\n</td> \r\n                     </tr> \r\n                   </tbody></table>', '<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" role=\"presentation\" style=\"mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px\"> \r\n                     <tbody><tr style=\"border-collapse:collapse\"> \r\n                      <td align=\"center\" class=\"es-m-txt-c\" style=\"padding:0;Margin:0\">\r\n<h3>Dear {#Fullname#}!</h3>\r\n<h4>Order number is: <span>{#OrderID#}</span></h4>\r\n</td> \r\n                     </tr> \r\n                   </tbody></table>', '<h3>Dear {#Fullname#}!</h3>\r\n<h4 style=\"text-align: center; \">Order number is: <span>{#OrderID#}</span></h4><h4 style=\"text-align: center; \"><span>Order has been cancelled.</span></h4>');

-- --------------------------------------------------------

--
-- Table structure for table `mf_news`
--

CREATE TABLE `mf_news` (
  `id` int(10) NOT NULL,
  `college_id` int(10) DEFAULT 0,
  `title` text DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `bannerimage` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '''0''=>''Inactive'', ''1''=>''Active''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_news`
--

INSERT INTO `mf_news` (`id`, `college_id`, `title`, `slug`, `meta_keyword`, `meta_description`, `bannerimage`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Custom Solutions', 'custom-solutions', 'Custom Solutions', 'Custom Solutions', '1619773415blogimg.jpg', '<p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>', 1, '2021-04-30 03:31:11', '2021-04-30 03:33:35'),
(2, 5, 'Vestibulum ipsum dui, consequat faucibus', 'vestibulum-ipsum-dui-consequat-faucibus', 'Vestibulum ipsum dui, consequat faucibus', 'Vestibulum ipsum dui, consequat faucibus', '1619774022blogimg1.jpg', '<p>What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book it has?</p>\r\n\r\n<p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book.</p>\r\n\r\n<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>', 1, '2021-04-30 03:43:42', '2021-04-30 03:43:55'),
(3, 2, 'One-Click Lorem Ipsum Generator', 'one-click-lorem-ipsum-generator', 'One-Click Lorem Ipsum Generator', 'One-Click Lorem Ipsum Generator', '1619779866innerbanner.jpg', '<p>This lorem ipsum generator is made for all the webdesigners, designers, webmasters and others who need lorem ipsum. Generator is made the way that everyone can use it, but especially for projects which need html markup. You can decide which html tags you want and our generator will generate just as you specified. Pretty cool, isn&#39;t it?</p>\r\n\r\n<h1>Lorem Ipsum</h1>\r\n\r\n<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, '2021-04-30 05:21:06', '2021-04-30 05:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `mf_partner`
--

CREATE TABLE `mf_partner` (
  `id` int(10) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `rank` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '''0''=>''Inactive'', ''1''=>''Active''',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_partner`
--

INSERT INTO `mf_partner` (`id`, `name`, `image`, `rank`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ValueFirst', '1619700733ourpaterlogo1.png', 1, 1, '2021-04-29 07:21:34', '2021-04-29 07:30:00'),
(2, 'Renault Nissan', '1619701224ourpaterlogo2.png', 2, 1, '2021-04-29 07:30:24', '2021-04-29 07:31:17'),
(3, 'Cap', '1619701296ourpaterlogo3.png', 3, 1, '2021-04-29 07:31:36', '2021-04-29 07:31:36'),
(4, 'Urjanet', '1619701309ourpaterlogo4.png', 4, 1, '2021-04-29 07:31:49', '2021-04-29 07:31:49'),
(5, 'Onzen', '1619701321ourpaterlogo5.png', 5, 1, '2021-04-29 07:32:01', '2021-04-29 07:32:01'),
(6, 'Essar', '1619701332ourpaterlogo6.png', 6, 1, '2021-04-29 07:32:12', '2021-04-29 07:32:12'),
(7, 'Cap', '1619701343ourpaterlogo7.png', 7, 1, '2021-04-29 07:32:23', '2021-04-29 07:32:23'),
(8, 'Birla', '1619701356ourpaterlogo8.png', 8, 1, '2021-04-29 07:32:36', '2021-04-29 07:32:36'),
(9, 'US', '1619701367ourpaterlogo9.png', 9, 1, '2021-04-29 07:32:47', '2021-04-29 07:32:47'),
(10, 'Aspire', '1619701379ourpaterlogo10.png', 10, 1, '2021-04-29 07:32:59', '2021-04-29 07:32:59'),
(11, 'Bio', '1619701389ourpaterlogo11.png', 11, 1, '2021-04-29 07:33:09', '2021-04-29 07:33:09'),
(12, 'Tri', '1619701400ourpaterlogo12.png', 12, 1, '2021-04-29 07:33:20', '2021-04-29 07:33:20'),
(13, 'Wab', '1619701417ourpaterlogo13.png', 13, 1, '2021-04-29 07:33:37', '2021-04-29 07:33:37'),
(14, 'Bri', '1619701453ourpaterlogo14.png', 14, 1, '2021-04-29 07:34:13', '2021-04-29 07:34:13'),
(15, 'Soft', '1619701470ourpaterlogo15.png', 15, 1, '2021-04-29 07:34:30', '2021-04-29 07:34:30'),
(16, 'TM Tech', '1619701488ourpaterlogo16.png', 16, 1, '2021-04-29 07:34:48', '2021-04-29 07:34:48'),
(17, 'Inter', '1619701504ourpaterlogo17.png', 17, 1, '2021-04-29 07:35:04', '2021-04-29 07:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `mf_referral`
--

CREATE TABLE `mf_referral` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `referred_by` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '''0''=>''Unpaid'', ''1''=>''Paid''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_referral`
--

INSERT INTO `mf_referral` (`id`, `user_id`, `referred_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 21, 7, 0, '2021-04-30 07:09:41', '2021-04-30 07:09:41'),
(5, 25, 7, 0, '2021-04-30 07:31:30', '2021-04-30 07:31:30'),
(7, 27, 7, 0, '2021-05-07 04:07:53', '2021-05-07 04:07:53'),
(8, 28, 7, 0, '2021-05-07 07:26:14', '2021-05-07 07:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `mf_settings`
--

CREATE TABLE `mf_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mf_settings`
--

INSERT INTO `mf_settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'College Portal', '', 'text', 1, 'Site'),
(2, 'site.logo', 'Site Logo', '1618718527logomain.png', '', 'image', 2, 'Site'),
(3, 'admin.pagination', 'Admin Pagination', '25', '', 'text', 1, 'Admin'),
(4, 'site.pagination', 'Front-end Pagination', '4', '', 'text', 1, 'Site'),
(5, 'site.meta_title', 'Meta Title', 'College Portal', '', 'text', 1, 'Site'),
(6, 'site.meta_keyword', 'Meta Keyword', 'College Portal', '', 'text', 1, 'Site'),
(7, 'site.meta_description', 'Meta Description', 'College Portal', '', 'text', 1, 'Site'),
(8, 'site.meta_image', 'Meta Image', '', '', 'image', 1, 'Site'),
(9, 'site.logo2', 'Site Logo 2', '1618718557favicon.png', '', 'image', 2, 'Site'),
(10, 'site.contact_email', 'Contact Email', 'contact_email8989@yopmail.com', '', 'text', 1, 'Site'),
(11, 'site.support_email', 'Support Email', 'support_email8989@yopmail.com', '', 'text', 1, 'Site'),
(12, 'site.address', 'Address', 'Aenean iaculis consequat <br>\r\nquam id hendrerit', '', 'text', 1, 'Site'),
(13, 'site.email', 'Site Email', 'info@collegeportal.com', '', 'text', 1, 'Site'),
(14, 'site.phone', 'Site Phone', '(0123)-456-789', '', 'text', 1, 'Site'),
(15, 'site.facebook_link', 'Site Facebook', 'https://www.facebook.com/', '', 'text', 1, 'Site'),
(16, 'site.twitter_link', 'Site Twitter', 'https://twitter.com/', '', 'text', 1, 'Site'),
(17, 'site.google_plus_link', 'Site Google Plus', 'https://myaccount.google.com/', '', 'text', 1, 'Site'),
(18, 'site.instagram_link', 'Site Instagram', 'https://www.instagram.com/', '', 'text', 1, 'Site'),
(19, 'site.message_show_time', 'Site Message Show Time', '6', '', 'text', 1, 'Site');

-- --------------------------------------------------------

--
-- Table structure for table `mf_state`
--

CREATE TABLE `mf_state` (
  `id` int(10) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `country_id` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_state`
--

INSERT INTO `mf_state` (`id`, `name`, `status`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'West Bengal', 1, 0, '2021-04-27 00:20:55', '2021-04-27 00:20:55'),
(2, 'Karnataka', 1, 0, '2021-04-28 04:23:03', '2021-04-28 04:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `mf_transactions_tbl`
--

CREATE TABLE `mf_transactions_tbl` (
  `id` int(255) NOT NULL,
  `applyform_id` bigint(20) NOT NULL DEFAULT 0,
  `transaction_id` varchar(255) NOT NULL,
  `razorpay_order_id` varchar(191) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(10) NOT NULL DEFAULT 'usd',
  `transaction_date` timestamp NULL DEFAULT NULL COMMENT 'Date Format: Y-m-d H:i:s',
  `payment_through` int(10) NOT NULL COMMENT '''1''=>''Stripe'', ''2''=>''Paypal''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mf_transactions_tbl`
--

INSERT INTO `mf_transactions_tbl` (`id`, `applyform_id`, `transaction_id`, `razorpay_order_id`, `user_id`, `amount`, `currency`, `transaction_date`, `payment_through`, `created_at`, `updated_at`) VALUES
(1, 4, 'ch_1IoTLuEW0HcfhwQ12Lzz2Fq8', NULL, 27, '8000.00', 'inr', '2021-05-07 07:34:21', 1, '2021-05-07 07:34:21', '2021-05-07 07:34:21'),
(2, 1, 'ch_1IoTNlEW0HcfhwQ1Keek8fQ9', NULL, 27, '3600.00', 'inr', '2021-05-07 07:36:17', 1, '2021-05-07 07:36:17', '2021-05-07 07:36:17'),
(3, 6, 'ch_1IoVa0EW0HcfhwQ1qRzAjJuu', NULL, 28, '3600.00', 'inr', '2021-05-07 07:27:05', 1, '2021-05-07 07:27:05', '2021-05-07 07:27:05'),
(4, 3, 'pay_HB97DJBliO77L8', 'order_HB94W8Ap0WrOmg', 27, '8000.00', 'inr', '2021-05-15 09:12:02', 1, '2021-05-15 09:12:02', '2021-05-15 09:12:02'),
(5, 7, 'pay_HCajq2Zmbl5qHm', 'order_HCaheSjmzM4tcH', 33, '8000.00', 'inr', '2021-05-19 00:52:31', 1, '2021-05-19 00:52:31', '2021-05-19 00:52:31'),
(6, 8, 'pay_HCeWZniOsykDAE', 'order_HCeWIsReFFDK3V', 33, '3200.00', 'inr', '2021-05-19 04:34:33', 1, '2021-05-19 04:34:33', '2021-05-19 04:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body2` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bannertype` int(10) NOT NULL DEFAULT 0 COMMENT '''1''=>''Image'',''2''=>''Video',
  `image2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bannerimage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bannertext` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `display_in` int(5) NOT NULL DEFAULT 0 COMMENT '''0''=>''None'', ''1''=>''Header'', ''2''=>''Footer'', ''3''=>''Header & Footer''',
  `menu_order` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_title`, `body`, `body2`, `bannertype`, `image2`, `bannerimage`, `bannertext`, `slug`, `meta_title`, `meta_keyword`, `meta_description`, `btn_text`, `btn_url`, `parent_id`, `display_in`, `menu_order`) VALUES
(1, 'Home', NULL, NULL, '', 1, '1608285794banner1.jpg', NULL, NULL, 'home', NULL, NULL, NULL, NULL, NULL, 0, 3, 1),
(2, 'Make Future Today About Us', 'About Us', NULL, '', 0, NULL, '1619347413innerbanner.jpg', NULL, 'about-us', '', 'About Us', 'About Us', NULL, NULL, 0, 3, 2),
(3, 'Make Future Today', 'Our Services', NULL, '', 0, NULL, '1619355868innerbanner.jpg', NULL, 'our-services', NULL, 'Make Future Today', 'Make Future Today', NULL, NULL, 0, 3, 3),
(4, 'Find a Course', 'Find a Course', NULL, '', 0, NULL, NULL, NULL, 'find-a-course', NULL, 'Find a Course', 'Find a Course', NULL, NULL, 0, 3, 4),
(5, 'Contact Us', 'Contact Us', NULL, '', 0, NULL, NULL, NULL, 'contact', NULL, 'Contact Us', 'Contact Us', NULL, NULL, 0, 3, 9),
(6, 'Find a College', 'Find a College', NULL, '', 0, NULL, NULL, NULL, 'find-a-college', NULL, 'Find a College', 'Find a College', NULL, NULL, 0, 3, 5),
(7, 'Admission', 'Admission', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>\r\n\r\n<p>It is a long established fact that</p>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary,</p>\r\n\r\n<p>Contrary to popular belief</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', '', 0, NULL, NULL, NULL, 'admission', NULL, 'Admission', 'Please read our full terms of use before you use our website.', NULL, NULL, 0, 3, 7),
(8, 'Apply for Counselling', 'Apply for Counselling', NULL, '', 0, NULL, NULL, NULL, 'apply-for-counselling', NULL, 'Apply for Counselling', 'Apply for Counselling', NULL, NULL, 0, 3, 8),
(9, 'Apply Form', 'Apply Form', NULL, '', 0, NULL, NULL, NULL, 'apply-form', NULL, 'Apply Form', 'Apply Form', NULL, NULL, 8, 1, 1),
(10, 'Terms & Conditions', 'Terms & Conditions', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><h3>It is a long established fact that</h3><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary,</p><h3>Contrary to popular belief</h3><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', '', 0, NULL, NULL, NULL, 'terms', NULL, 'Terms & Conditions', 'Terms & Conditions', NULL, NULL, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pages_extra`
--

CREATE TABLE `pages_extra` (
  `id` int(10) NOT NULL,
  `page_id` int(10) NOT NULL,
  `type` int(10) NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `image2` text DEFAULT NULL,
  `body` text DEFAULT NULL,
  `sub_title` varchar(191) DEFAULT NULL,
  `btn_text` varchar(191) DEFAULT NULL,
  `btn_url` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages_extra`
--

INSERT INTO `pages_extra` (`id`, `page_id`, `type`, `title`, `image`, `image2`, `body`, `sub_title`, `btn_text`, `btn_url`) VALUES
(1, 1, 4, 'Top <span> Colleges</span>', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium sem eget suscipit feugiat. Maecenas consequat viverra enim vitae hendrerit</p>', NULL, 'View All College', 'http://localhost/makefuture/public/find-a-college'),
(2, 1, 5, 'Top <span>Courses</span>', NULL, NULL, '<p>Vestibulum ipsum dui, consequat faucibus consectetur eget, tempor id elit. Ut id nisl ac quam placerat ornare.</p>', NULL, NULL, NULL),
(3, 1, 6, 'Our <span>Partners</span>', NULL, NULL, '<p>Aenean lobortis dictum dapibus. Aenean iaculis consequat quam id hendrerit. Morbi mauris lectus, accumsan sit amet fringilla tristique, faucibus vel orci.</p>', NULL, NULL, NULL),
(5, 1, 2, 'Welcome to <strong>College Portal</strong>', '1619333388aboutimg.jpg', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium sem eget suscipit feugiat. Maecenas consequat viverra enim vitae hendrerit. Etiam et ligula a enim porta placerat.</p>\r\n\r\n<p>Etiam tincidunt consectetur magna, a volutpat massa efficitur at. Cras non congue lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum sollicitudin quam erat, et gravida libero fringilla vitae. Nulla at massa eu ipsum vestibulum.</p>', 'About Us', 'Learn more', '#'),
(6, 1, 3, 'Our <span> Services</span>', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium sem eget suscipit feugiat. Maecenas consequat viverra enim vitae hendrerit</p>', NULL, NULL, NULL),
(7, 1, 3, 'Student', '1619333625servicesbg1.jpg', '1619333712servicesicon1.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium sem eget suscipit feugiat. Maecenas consequat viverra enim vitae hendrerit. Etiam et ligula a enim porta placerat.</p>\r\n\r\n<p>Etiam tincidunt consectetur magna, a volutpat massa efficitur at. Cras non congue lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum sollicitudin quam erat, et gravida libero fringilla vitae. Nulla at massa eu ipsum vestibulum.</p>', NULL, NULL, NULL),
(8, 1, 3, 'Franchise', '1619333625servicesbg2.jpg', '1619333625servicesicon2.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium sem eget suscipit feugiat. Maecenas consequat viverra enim vitae hendrerit. Etiam et ligula a enim porta placerat.</p>\r\n\r\n<p>Etiam tincidunt consectetur magna, a volutpat massa efficitur at. Cras non congue lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum sollicitudin quam erat, et gravida libero fringilla vitae. Nulla at massa eu ipsum vestibulum.</p>', NULL, NULL, NULL),
(9, 1, 8, 'Downlad <strong>The App Today</strong>', '1619334264appmobail.png', NULL, '<p>Aenean iaculis consequat quam id hendrerit. Morbi mauris lectus, accumsan sit amet fringilla tristique, faucibus vel orci. Maecenas laoreet sed erat et feugiat. Phasellus tincidunt pharetra felis sed sagittis. Quisque et rhoncus nulla, quis pulvinar purus.</p>\r\n\r\n<ul>\r\n	<li><a href=\"#\"><img alt=\"\" src=\"http://localhost/makefuture/public/ckfinder_files/images/applogo.png\" /></a></li>\r\n	<li><a href=\"#\"><img alt=\"\" src=\"http://localhost/makefuture/public/ckfinder_files/images/applogo1.png\" /></a></li>\r\n</ul>', NULL, NULL, NULL),
(10, 1, 7, 'latest <span>News</span>', NULL, NULL, '<p>Maecenas laoreet sed erat et feugiat. Phasellus tincidunt pharetra felis sed sagittis. Quisque et rhoncus nulla, quis pulvinar purus. Aenean sed dui eget</p>', NULL, NULL, NULL),
(11, 3, 3, 'Student', '1619355868servicesbg1.jpg', '1619355868servicesicon1.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium sem eget suscipit feugiat. Maecenas consequat viverra enim vitae hendrerit. Etiam et ligula a enim porta placerat.</p>\r\n\r\n<p>Etiam tincidunt consectetur magna, a volutpat massa efficitur at. Cras non congue lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum sollicitudin quam erat, et gravida libero fringilla vitae. Nulla at massa eu ipsum vestibulum.</p>', NULL, NULL, NULL),
(12, 3, 3, 'Franchise', '1619355868servicesbg2.jpg', '1619355868servicesicon2.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium sem eget suscipit feugiat. Maecenas consequat viverra enim vitae hendrerit. Etiam et ligula a enim porta placerat.</p>\r\n\r\n<p>Etiam tincidunt consectetur magna, a volutpat massa efficitur at. Cras non congue lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum sollicitudin quam erat, et gravida libero fringilla vitae. Nulla at massa eu ipsum vestibulum.</p>', NULL, NULL, NULL),
(13, 2, 6, 'Our <span>Partners</span>', '1603596068active-earth.png', NULL, '<p>Aenean lobortis dictum dapibus. Aenean iaculis consequat quam id hendrerit. Morbi mauris lectus, accumsan sit amet fringilla tristique, faucibus vel orci.</p>', NULL, NULL, NULL),
(15, 2, 2, 'Welcome to <strong>College Portal</strong>', '1619347378about-img1.jpg', '1619347378aboutimg.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium sem eget suscipit feugiat. Maecenas consequat viverra enim vitae hendrerit. Etiam et ligula a enim porta placerat.</p>\r\n\r\n<p>Etiam tincidunt consectetur magna, a volutpat massa efficitur at. Cras non congue lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum sollicitudin quam erat, et gravida libero fringilla vitae. Nulla at massa eu ipsum vestibulum.</p>', 'About Us', NULL, NULL),
(16, 2, 3, 'Our <strong>Mission</strong>', '1619349575about-img-re.jpg', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium sem eget suscipit feugiat. Maecenas consequat viverra enim vitae hendrerit. Etiam et ligula a enim porta placerat.</p>\r\n\r\n<p>Etiam tincidunt consectetur magna, a volutpat massa efficitur at. Cras non congue lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum sollicitudin quam erat, et gravida libero fringilla vitae. Nulla at massa eu ipsum vestibulum. Maecenas non laoreet risus, quis maximus libero. Nullam eget ultricies eros, in tristique quam. Donec vel arcu eleifend odio vestibulum pulvinar. Donec imperdiet, justo vel tristique interdum, dui mauris sagittis mi, id mollis urna velit ut dolor. Vestibulum pellentesque urna eros, a vehicula odio varius in. Maecenas varius sapien vel ultrices feugiat.</p>', NULL, NULL, NULL),
(17, 2, 4, 'Our <strong>Vision</strong>', '1619348552Visionimg.jpg', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare lacinia tortor, non lobortis ante pretium sit amet. Aliquam erat volutpat. Aenean eleifend erat id pulvinar commodo. Aenean molestie est eget justo tincidunt, sit amet lacinia lacus laoreet. Maecenas tempor gravida nunc, id malesuada erat faucibus tincidunt. Quisque posuere velit at enim aliquet, id aliquam quam tristique. Morbi volutpat mollis varius.</p>\r\n\r\n<p>Ut dictum accumsan porttitor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a urna et ipsum congue efficitur eget in est. Suspendisse rhoncus ipsum ut orci ornare, et vulputate ex semper. Praesent at posuere odio, at vehicula mi.</p>', NULL, NULL, 'https://www.youtube.com/watch?v=pBFQdxA-apI'),
(18, 2, 5, 'Our <span>Portfolio</span>', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac mauris lobortis, sollicitudin dolor vitae, fermentum arcu.</p>', NULL, NULL, NULL),
(27, 2, 7, NULL, '1619349849portfolio-img1.jpg', NULL, NULL, NULL, NULL, NULL),
(28, 2, 7, NULL, '1619349849portfolio-img2.jpg', NULL, NULL, NULL, NULL, NULL),
(29, 2, 7, NULL, '1619353410portfolio-img3.jpg', NULL, NULL, NULL, NULL, NULL),
(30, 2, 7, NULL, '1619353777portfolio-img4.jpg', NULL, NULL, NULL, NULL, NULL),
(19, 40, 3, 'How to Apply', NULL, NULL, '<p style=\"text-align:justify\"><span style=\"color:#252b2f; font-family:Poppins,sans-serif; font-size:16px\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock.</span></p>', NULL, NULL, NULL),
(20, 40, 3, 'Contrary to popular belief', '', NULL, '<p>Qualification Required:Graduate</p>\r\n\r\n<p>Salary:&pound; 150.00 - &pound; 250.00</p>', NULL, 'APPLY NOW', 'https://www.lipsum.com/'),
(22, 3, 5, 'Enquiry <span>Now</span>', NULL, NULL, '<p>Aenean lobortis dictum dapibus. Aenean iaculis consequat quam id hendrerit. Morbi mauris lectus, accumsan sit amet fringilla tristique, faucibus vel orci.</p>', NULL, NULL, NULL),
(23, 1, 1, '<small>We Provide</small> <strong> Online Courses </strong> on Your Time', '1618824936bannerbg1.jpg', NULL, '<h4>advertisement</h4>\r\n\r\n<ul>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n</ul>', 'Discover over 10,000 courses from 6,500 education providers in India', NULL, NULL),
(26, 1, 1, '<small>We Provide</small> <strong> Online Courses </strong> on Your Time', '1619347767bannerbg2.png', NULL, '<h4>advertisement</h4>\r\n\r\n<ul>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n	<li>Lorem ipsum dolor sit amet consectetur adipiscing elit Maecenas pretium sem eget suscipit feugiat Maecenas.</li>\r\n</ul>', 'Discover over 10,000 courses from 6,500 education providers in India', NULL, NULL),
(31, 2, 7, NULL, '1619353777portfolio-img5.jpg', NULL, NULL, NULL, NULL, NULL),
(33, 2, 7, NULL, '1619353874portfolio-img6.jpg', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-11 14:18:05', 'ca5001195639b75e3ebf20274bb64fb5f57aa6871d9677cc58c22afff356ecf7', '[\"*\"]', NULL, '2021-05-11 06:18:05', '2021-05-11 06:18:05'),
(2, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-11 14:19:57', 'c87b5cf2281c8df8e11a62fb4815aaea0ca4f994d5a00dcae2351c4f4dcf77de', '[\"*\"]', NULL, '2021-05-11 06:19:57', '2021-05-11 06:19:57'),
(3, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-11 15:11:06', '84bb509f7138d202857df40bb527e3a7ee766a0339da232ad904acefde327fa4', '[\"*\"]', NULL, '2021-05-11 07:11:06', '2021-05-11 07:11:06'),
(4, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-11 15:54:38', '297231badbed074173fae5a2e51f8798f651bbd0ea09c89fce78e3a448fc3288', '[\"*\"]', NULL, '2021-05-11 07:54:38', '2021-05-11 07:54:38'),
(5, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-11 16:06:20', '102c66f85d379ccaaef08f58b15abe92ddbe89d2e320ce6affc8383a5180d529', '[\"*\"]', NULL, '2021-05-11 08:06:20', '2021-05-11 08:06:20'),
(6, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-11 16:26:26', 'ad5eedd300d96dcfb25fedfc0d4638d80ba1dd5870b615228a693734b4ef1f43', '[\"*\"]', NULL, '2021-05-11 08:26:26', '2021-05-11 08:26:26'),
(7, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-11 16:28:20', '599a47638c069afa5b1e1c9a152f0a2e98bb1089727996c6304c396584b833d1', '[\"*\"]', NULL, '2021-05-11 08:28:20', '2021-05-11 08:28:20'),
(8, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-12 17:27:25', 'd1c7c4c389e67c3c885f6fcfad35de3598aceda0d4d23b23800676dcdfcb3e25', '[\"*\"]', NULL, '2021-05-12 09:27:25', '2021-05-12 09:27:25'),
(9, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-13 06:34:58', '549be1330500a538aebd950b6dddbfff2f3f155528cb430a8ad8fe35baa248a0', '[\"*\"]', NULL, '2021-05-12 22:34:58', '2021-05-12 22:34:58'),
(10, 'App\\Models\\User', 30, 'demo@gmail.com__2021-05-15 16:43:50', '78486c2e606678463183ee1e9de2a4e8690301304cf9f0bc6c3756d949b57be4', '[\"*\"]', NULL, '2021-05-15 08:43:50', '2021-05-15 08:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_module` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_module` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_module` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_module` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`, `add_module`, `edit_module`, `view_module`, `delete_module`) VALUES
(1, 'admin', 'Administrator', '2020-07-07 06:50:45', '2021-02-01 05:45:11', 'test,dashboard,order,transaction,payment_request,earning,page,user', 'test,dashboard,order,transaction,payment_request,earning,page,user', 'test,dashboard,order,transaction,payment_request,earning,page,user', 'test,dashboard,order,transaction,payment_request,earning,page,user'),
(2, 'franchise', 'Franchise', '2020-07-07 06:50:45', '2021-02-02 03:20:11', 'test', 'test,order,page', 'test,dashboard,order,transaction,page', 'test'),
(3, 'student', 'Student', '2020-07-07 06:50:45', '2020-07-07 06:50:45', 'test', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 4,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhaar_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 0 COMMENT '	''0''=>''Inactive'', ''1''=>''Active'', ''2''=>''Deleted Account''',
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `already_logged` int(2) NOT NULL DEFAULT 0,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone_number`, `address`, `aadhaar_number`, `created_at`, `updated_at`, `status`, `avatar`, `last_login`, `already_logged`, `referral_code`) VALUES
(1, 1, 'Super', 'Admin', 'testing.web017@gmail.com', '2021-02-15 06:20:46', '$2y$10$q14A/2H67Nuwalut5gMOku.EVOuLYOo9r5J.zYpJP.CtExKp.aBsC', NULL, '123', 'he', NULL, '2020-12-08 00:38:09', '2021-05-01 04:42:54', 1, NULL, '2021-06-02 03:14:10', 1, NULL),
(2, 3, 'Mns', 'Customer', 'mns_07@yopmail.com', '2021-03-19 21:34:45', '$2y$10$irSODHV9eTG2vYtsyjLxm.0x7SHr6InkVhYe0LTzeMv.VcD2fNHRS', NULL, NULL, NULL, '17B Lake temple road', '2020-12-18 15:45:49', '2021-04-18 10:22:01', 1, '', '2021-03-19 16:05:16', 0, NULL),
(3, 3, 'Manas', 'Das', 'mns_08@yopmail.com', '2021-03-19 21:34:56', '$2y$10$GZ7idueYHl8c20haePLUC.oDMBumAo2ePIFt1K/aM28BEPH6FSahy', NULL, NULL, NULL, NULL, '2020-12-18 15:52:37', '2021-04-18 10:22:01', 1, '', NULL, 0, NULL),
(4, 3, 'Test', 'Customer', 'tester05@yopmail.com', '2021-03-19 21:35:07', '$2y$10$B87szaMGmXPJrLjb5BllTO67lg5JPlS7K65KEFCAw6/UygACfSkzS', NULL, NULL, NULL, '16B stand road', '2020-12-18 17:00:00', '2021-04-18 10:22:01', 1, '', '2021-03-19 16:01:10', 0, NULL),
(5, 3, 'Susan', 'Smith', 'susan8989@yopmail.com', '2021-02-05 07:58:57', '$2y$10$1K.Ir5K9VOLlVLy7qKVxdexfW9Ew37eddzyqDSCcTwpd2qSnF2SSe', 'jsgdCETsJAkc5ah3gwjhoIFmPgWSdKzhyx6BILvBj2xjG26TonnnQdn6F9JQ', NULL, NULL, NULL, '2020-12-26 02:55:58', '2021-04-18 10:22:01', 1, NULL, '2021-04-26 06:57:42', 0, NULL),
(6, 3, 'John', 'Smith', 'john8989@yopmail.com', '2020-12-30 03:28:40', '$2y$10$ILUoTO9Vv03DCrD40v.BW.hssfsW2OvkDIGCb6MzeSW76dF3q5uh2', NULL, NULL, 'Test', '76 Street', '2020-12-30 00:53:08', '2021-05-06 05:17:33', 1, NULL, '2021-05-07 23:42:52', 0, NULL),
(7, 2, 'Roy', 'Blackford', 'subadmin8989@yopmail.com', NULL, '$2y$10$ht1gmcS.AJCfAKWpkRflHefASXnZGC3bWxAHLwR49f9TtL.c9Iwsy', NULL, '1234567890', 'tes', '123', '2021-02-01 23:09:25', '2021-05-06 05:20:21', 1, '', '2021-05-07 23:51:09', 0, 'LJJM3AUBL'),
(8, 3, 'Susan1', 'Smith', 'susan89891@yopmail.com', '2021-02-11 01:52:20', '$2y$10$EX1UtEuk5i8THfc9DBG0heuhBTmAQrGx6VZPBzQkicMoprQHjA/iO', NULL, NULL, NULL, NULL, '2021-02-11 01:50:02', '2021-04-18 10:22:01', 1, NULL, '2021-03-24 12:39:08', 0, NULL),
(9, 3, 'Unregistered', 'User', 'unregistered.user@fakeemailaddress.com', '2021-02-24 18:03:22', '$2y$10$DUchcVZqRceqH8l7xKqNDuBt0ur4zb9RUXMaSvpEql/kp7ux08GCW', NULL, NULL, NULL, NULL, '2021-02-17 23:37:16', '2021-04-18 10:22:01', 1, NULL, NULL, 0, NULL),
(10, 3, 'Unregistered1', 'User2', 'notareal@emailaddress.com', '2021-02-24 04:57:02', '$2y$10$THMGSDhwo22/NjilQColEuEWMiA6Cc4hGRMURNnpeuuKf6G7re0vC', NULL, NULL, NULL, NULL, '2021-02-24 04:57:02', '2021-04-18 10:22:01', 1, NULL, NULL, 0, NULL),
(14, 3, 'Jack4', 'Surname4', 'anoviewtest@yopmail.com', '2021-03-16 19:04:41', '$2y$10$scDaG7Wg7CzoqIA2R8fS8uAA7oKMdTNy6g6MwqgzKmZKiM1dHqegu', NULL, NULL, NULL, NULL, '2021-02-25 07:58:29', '2021-04-18 10:22:01', 1, '', '2021-03-03 02:20:51', 0, NULL),
(15, 3, 'Susan2', 'Smith', 'susan89892@yopmail.com', '2021-03-16 19:04:30', '$2y$10$EUQZUMLb2KNikQi3HZZoGuMlaQWRL.rVn2Omes9X93oP2zERBILQi', NULL, NULL, NULL, NULL, '2021-03-16 13:29:49', '2021-04-18 10:22:01', 1, NULL, '2021-03-19 16:59:39', 0, NULL),
(16, 3, 'Susan3', 'Smith', 'susan89893@yopmail.com', '2021-03-16 19:55:43', '$2y$10$ZmVcakZTxdTsG8M3tH0toOS/BDrUUkxuwF9sUuFF88IDLpB9WbDO6', NULL, NULL, NULL, NULL, '2021-03-16 14:25:05', '2021-04-18 10:22:01', 1, '', '2021-03-19 16:59:57', 0, NULL),
(17, 3, 'Kenneth', 't', 'john89891@yopmail.com', NULL, '$2y$10$iJDIeojH/JHGe4PD3jDjvOMTg3JYplGkSgE1DkMifh191QjJ27sVa', NULL, NULL, NULL, NULL, '2021-03-29 11:59:34', '2021-04-18 10:22:01', 1, NULL, NULL, 0, NULL),
(18, 3, 'Kenneth', 'q', 'john89892@yopmail.com', NULL, '$2y$10$GL.4k8vawE3p3lqRmf5Rxufh9/IaAVPEXK5w.v0pfCl5/OqsJttbu', NULL, NULL, NULL, NULL, '2021-03-29 12:03:20', '2021-04-18 10:22:01', 1, NULL, NULL, 0, NULL),
(19, 3, 'Kenneth', 'w', 'john89893@yopmail.com', NULL, '$2y$10$N8AdZWjkt//bqDt3G11HQeQYo8rKNi.iy4T4MOqljwvpFRuzNWq.O', NULL, NULL, NULL, NULL, '2021-03-29 12:09:28', '2021-04-18 10:22:01', 1, NULL, NULL, 0, NULL),
(20, 3, 'Leonard', 'Q', 'john89894@yopmail.com', NULL, '$2y$10$utKJLWDbHDf8R6mfo9PkHeVcx4j1JDM7WRUg7k5CNofCE9nzxg6a6', NULL, '123', 'rr', NULL, '2021-03-29 12:27:55', '2021-04-26 08:41:26', 1, NULL, NULL, 0, NULL),
(21, 3, 'John', 'Sm', 'john89895@yopmail.com', NULL, '$2y$10$bl1c6zaoOjKkPkzDPXuSxuCZ8kUwbkrIIga3K/8kXZUmIzE/QgZOy', NULL, '+448888888888', '#76 Street Nova\r\ntest 1', '', '2021-04-30 07:09:41', '2021-04-30 07:09:41', 1, NULL, NULL, 0, ''),
(25, 3, 'Sumanta', 'Smith', 'john89896@yopmail.com', NULL, '$2y$10$tPRlR/DMI0/DU/LMp.qYA.7cMnkAPp2g4WDesxD/DxpGCECfr1CFu', NULL, '+919163509003', 'test\r\ntest 1', '', '2021-04-30 07:31:30', '2021-04-30 07:31:30', 1, NULL, NULL, 0, ''),
(27, 3, 'John', 'Smith', 'john898910@yopmail.com', NULL, '$2y$10$1bcLIQo7Nu6LiMDOm0/aNOGt08g66WFNGX0t1BOFvauvHJuDCKW3m', NULL, NULL, NULL, NULL, '2021-05-07 04:07:48', '2021-05-08 01:52:32', 1, NULL, '2021-05-25 02:14:59', 0, NULL),
(28, 3, 'Sumanta', 'Nag', 'john89897@yopmail.com', NULL, '$2y$10$aFP/yXkaNoGCK4CVX/VrkuEc6OYBmhfXVgKMSQ1SSdx3Cmg/S0yB6', NULL, NULL, 'test', NULL, '2021-05-07 07:26:14', '2021-05-13 04:47:17', 1, NULL, NULL, 0, NULL),
(29, 3, 'Golam', 'Ambia', 'golamambia78@gmail.com', NULL, '$2y$10$4p8uzc54xNK1fWy.kO5xJOnLkLVqVzT4BuQbZVE8g5fVy1xRbq3Wa', NULL, '7003832809', 'horishpur nayagram,', NULL, '2021-05-11 04:06:07', '2021-05-11 04:06:07', 1, '', NULL, 0, ''),
(30, 3, 'Golam', 'Ambia', 'demo@gmail.com', NULL, '$2y$10$e3aMmtd.xLrEIQOSw5EzhOhJzHN744s4lNLBlItjsTcd313cM7BRq', NULL, '1234567890', 'kolkata', NULL, '2021-05-11 04:14:36', '2021-05-15 08:46:16', 1, '1621097176IMG20210507100033.jpg', '2021-05-15 08:43:50', 1, ''),
(31, 3, 'Golam', 'Ambia', 'demo2@gmail.com', NULL, '$2y$10$PkAxXXbehI./OYs.X3nYxeNdRX4dNE8ZoR67S1c0GHLEPeSjuFqka', NULL, '89899889989', 'horishpur nayagram,', NULL, '2021-05-11 04:19:43', '2021-05-11 04:19:43', 1, '', NULL, 0, ''),
(32, 3, 'Golam', 'Ambia', 'gol@gmail.com', NULL, '$2y$10$WpOm07xfojdas4889Gojz.VlLYmtVw4t6UQF2UPjua/cE9amdaA.S', NULL, '45658997323', 'horishpur nayagram,', NULL, '2021-05-11 05:11:41', '2021-05-11 05:11:41', 1, '', NULL, 0, ''),
(33, 3, 'Ajeet', 'Pal', 'wtm.ajeet@gmail.com', NULL, '$2y$10$qP/v.EKtSeHKP2DzHg2DXu6C60sHdBUkDVA3rWQHkwJJpUONNV35u', '2sMKV0P5gcNGqvviYT0R2qjCVlDupVJTVEkllIh797uspdt0k6ISwH862wlS', '8588893705', 'Mau-UP', '', '2021-05-19 00:42:32', '2021-05-19 00:42:32', 1, NULL, '2021-05-19 05:33:45', 0, ''),
(34, 3, 'Siddhartha', ' Sarkar', 'siddharthasarkar100@gmail.com', NULL, '$2y$10$ERwkJHRZmZuISPjXQCPi9.kKIhB/jSd0Jbb9F6WOwKVkuAHYHt55u', NULL, NULL, NULL, NULL, '2021-05-25 02:27:41', '2021-05-25 02:27:41', 1, NULL, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `mf_applyform`
--
ALTER TABLE `mf_applyform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_applyform_exam`
--
ALTER TABLE `mf_applyform_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_city`
--
ALTER TABLE `mf_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_college`
--
ALTER TABLE `mf_college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_college_course`
--
ALTER TABLE `mf_college_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_college_faculty`
--
ALTER TABLE `mf_college_faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_college_image`
--
ALTER TABLE `mf_college_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_course`
--
ALTER TABLE `mf_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_email_template`
--
ALTER TABLE `mf_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_news`
--
ALTER TABLE `mf_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_partner`
--
ALTER TABLE `mf_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_referral`
--
ALTER TABLE `mf_referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_settings`
--
ALTER TABLE `mf_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_state`
--
ALTER TABLE `mf_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mf_transactions_tbl`
--
ALTER TABLE `mf_transactions_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `pages_extra`
--
ALTER TABLE `pages_extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(250));

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mf_applyform`
--
ALTER TABLE `mf_applyform`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mf_applyform_exam`
--
ALTER TABLE `mf_applyform_exam`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mf_city`
--
ALTER TABLE `mf_city`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mf_college`
--
ALTER TABLE `mf_college`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mf_college_course`
--
ALTER TABLE `mf_college_course`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mf_college_faculty`
--
ALTER TABLE `mf_college_faculty`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mf_college_image`
--
ALTER TABLE `mf_college_image`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mf_course`
--
ALTER TABLE `mf_course`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mf_news`
--
ALTER TABLE `mf_news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mf_partner`
--
ALTER TABLE `mf_partner`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mf_referral`
--
ALTER TABLE `mf_referral`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mf_settings`
--
ALTER TABLE `mf_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mf_state`
--
ALTER TABLE `mf_state`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mf_transactions_tbl`
--
ALTER TABLE `mf_transactions_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pages_extra`
--
ALTER TABLE `pages_extra`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
