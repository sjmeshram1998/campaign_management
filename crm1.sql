-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 12:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm1`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign_details`
--

CREATE TABLE `campaign_details` (
  `id` int(11) NOT NULL,
  `camp_code` varchar(50) NOT NULL,
  `communication_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `file_no` int(11) NOT NULL,
  `quarter` varchar(255) NOT NULL,
  `camp_name` varchar(100) NOT NULL,
  `camp_start_date` date NOT NULL,
  `camp_end_date` date NOT NULL,
  `camp_status` enum('Pending','Completed','Live','Pause','Cancel','Escalation') NOT NULL,
  `delivery_days` varchar(200) DEFAULT NULL,
  `lead_goal` int(11) NOT NULL,
  `weekly_lead` int(11) DEFAULT NULL,
  `delivered_lead` int(11) DEFAULT 0,
  `generated_lead` int(11) NOT NULL,
  `undelivered_lead` int(11) DEFAULT 0,
  `pending_lead` int(11) DEFAULT 0,
  `extra_lead` int(11) DEFAULT 0,
  `named_acc` varchar(255) NOT NULL,
  `exclusions` varchar(255) NOT NULL,
  `first_delivery_date` date NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `job_level` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `custm_que` varchar(255) DEFAULT NULL,
  `company_size` varchar(110) DEFAULT NULL,
  `notes` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaign_details`
--

INSERT INTO `campaign_details` (`id`, `camp_code`, `communication_id`, `channel_id`, `file_no`, `quarter`, `camp_name`, `camp_start_date`, `camp_end_date`, `camp_status`, `delivery_days`, `lead_goal`, `weekly_lead`, `delivered_lead`, `generated_lead`, `undelivered_lead`, `pending_lead`, `extra_lead`, `named_acc`, `exclusions`, `first_delivery_date`, `country`, `job_title`, `job_level`, `industry`, `custm_que`, `company_size`, `notes`, `duration`, `created_at`, `updated_at`) VALUES
(414, 'AUD-19076', 621968, 20482, 1, 'Q3 2024', 'Galileo - NA', '2024-11-14', '2024-12-01', 'Live', 'Thursday', 37, 10, 8, 0, 0, 29, 0, 'Yes', 'No', '2024-11-15', 'Canada;United States', 'Chief Executive Officer\nChief Financial Officer\nChief Information Officer\nChief Operating Officer\nChief Privacy / Compliance / Risk Officer\nChief Security / Information Security Officer\nChief Technology Officer\nDirector - Product Management\nDirector - Sec', 'C-Level / Executive Team;Director;EVP / SVP / VP / AVP;', 'Accountable Care Organization;Accounting;Agriculture/Forestry;Airlines/Aviation;Alternative Dispute Resolution;Alternative Medicine;Ancillary Clinical Service Provider;Animation;Apparel & Fashion;Architecture & Planning;Architecture and Engineering;Arts a', 'No', '11-100;101-250;251-500;501-1,000;1,001-5,000;5,001-10,000;10,001+', '-', '2318', '2024-11-15 16:02:36', '2024-11-15 16:22:21'),
(415, 'AUD-19076', 621966, 20482, 1, 'Q3 2024', 'Galileo - NA', '2024-11-14', '2024-11-17', 'Live', 'Wednesday', 37, 10, 0, 0, 0, 37, 0, 'Yes', 'No', '2024-11-16', 'Canada;United States', 'Chief Executive Officer\nChief Financial Officer\nChief Information Officer\nChief Operating Officer\nChief Privacy / Compliance / Risk Officer\nChief Security / Information Security Officer\nChief Technology Officer\nDirector - Product Management\nDirector - Sec', 'C-Level / Executive Team;Director;EVP / SVP / VP / AVP;', 'Accountable Care Organization;Accounting;Agriculture/Forestry;Airlines/Aviation;Alternative Dispute Resolution;Alternative Medicine;Ancillary Clinical Service Provider;Animation;Apparel & Fashion;Architecture & Planning;Architecture and Engineering;Arts a', 'No', '11-100;101-250;251-500;501-1,000;1,001-5,000;5,001-10,000;10,001+', '-', '3571', '2024-11-15 16:02:36', '2024-11-15 16:02:36'),
(416, 'AUD-18325', 619939, 20352, 1, 'Q3 2024', '3M - NA', '2024-11-14', '2024-12-05', 'Live', 'Tuesday,Thursday', 152, 60, 0, 0, 0, 152, 0, 'No', 'No', '2024-11-16', 'Canada;United States', 'C-Level: Other\nChief Executive Officer\nChief Experience Officer\nChief Financial Officer\nChief HR Officer\nChief Marketing Officer\nChief Operating Officer\nChief Privacy / Compliance / Risk Officer\nChief Revenue Officer\nDirector - Call Center\nDirector - Cust', 'Architect;C-Level / Executive Team;Director;EVP / SVP / VP / AVP;Manager', 'Hospital/Medical Center/Multi-Hospital System/IDN', 'No', '11-100;101-250;251-500;501-1,000;1,001-5,000;5,001-10,000;10,001+', '-', '3067', '2024-11-15 16:02:36', '2024-11-15 16:02:36'),
(417, 'AUD-19209', 622060, 20157, 1, 'Q3 2024', 'Infor - UK', '2024-11-14', '2024-12-05', 'Live', 'Wednesday,Friday', 280, 115, 0, 0, 0, 280, 0, 'No', 'No', '2024-11-17', 'Canada;United States', 'Application / Software Development;Application Management: Finance;Application Management: HR;Application Management: Healthcare;Application Management: Integration / Middleware;Application Management: IoT;Application Management: Other;BI / Analytics / AI', 'Architect;C-Level / Executive Team;Director;EVP / SVP / VP / AVP;Manager', 'Logistics and Supply Chain;Transportation/Distribution;Wholesale', 'No', '501-1,000;1,001-5,000;5,001-10,000;10,001+', 'Please prioritize the below functions:\nChief Financial Officer\nChief Information Officer\nChief Operating Officer\nChief Technology Officer\nPurchasing/Procurement\nSupply Chain/Logistics', '3545', '2024-11-15 16:02:36', '2024-11-15 16:02:36'),
(418, 'AUD-18812', 602995, 20231, 1, 'Q3 2024', 'Coder Technologies - NA', '2024-11-14', '2024-12-08', 'Live', 'Tuesday,Thursday', 53, 15, 0, 0, 0, 53, 0, 'Yes', 'No', '2024-11-18', 'Canada;United States', 'Application / Software Development;Application Management: Finance;Application Management: HR;Application Management: Healthcare;Application Management: Integration / Middleware;Application Management: IoT;Application Management: Other;BI / Analytics / AI', 'Architect;C-Level / Executive Team;Director;EVP / SVP / VP / AVP;Manager', 'Accountable Care Organization;Accounting;Agriculture/Forestry;Airlines/Aviation;Alternative Dispute Resolution;Alternative Medicine;Ancillary Clinical Service Provider;Animation;Apparel & Fashion;Architecture & Planning;Architecture and Engineering;Arts a', 'No', '1,001-5,000;5,001-10,000;10,001+', 'Please prioritize the below functions:\nApplication / Software Development\nApplication Management: Other\nCIO\nCTO\nDevOps\nIT Project Management / PMO\nQA/Testing\nApplication Management: Finance\nApplication Management: Healthcare\nApplication Management: HR\nApp', '3371', '2024-11-15 16:02:36', '2024-11-15 16:02:36'),
(419, 'AUD-18812', 602996, 20231, 1, 'Q3 2024', 'Coder Technologies - NA', '2024-11-15', '2024-12-09', 'Live', 'Wednesday,Friday', 53, 15, 0, 0, 0, 53, 0, 'Yes', 'No', '2024-11-21', 'Canada;United States', 'Application / Software Development;Application Management: Finance;Application Management: HR;Application Management: Healthcare;Application Management: Integration / Middleware;Application Management: IoT;Application Management: Other;BI / Analytics / AI', 'Architect;C-Level / Executive Team;Director;EVP / SVP / VP / AVP;Manager', 'Accountable Care Organization;Accounting;Agriculture/Forestry;Airlines/Aviation;Alternative Dispute Resolution;Alternative Medicine;Ancillary Clinical Service Provider;Animation;Apparel & Fashion;Architecture & Planning;Architecture and Engineering;Arts a', 'No', '1,001-5,000;5,001-10,000;10,001+', 'Please prioritize the below functions:\nApplication / Software Development\nApplication Management: Other\nCIO\nCTO\nDevOps\nIT Project Management / PMO\nQA/Testing\nApplication Management: Finance\nApplication Management: Healthcare\nApplication Management: HR\nApp', '927', '2024-11-15 16:02:36', '2024-11-15 16:02:36'),
(420, 'AUD-18812', 609879, 20231, 1, 'Q3 2024', 'Coder Technologies - NA', '2024-11-20', '2024-12-10', 'Live', 'Monday,Thursday', 53, 15, 0, 0, 0, 53, 0, 'Yes', 'No', '2024-11-21', 'Canada;United States', 'Application / Software Development;Application Management: Finance;Application Management: HR;Application Management: Healthcare;Application Management: Integration / Middleware;Application Management: IoT;Application Management: Other;BI / Analytics / AI', 'Architect;C-Level / Executive Team;Director;EVP / SVP / VP / AVP;Manager', 'Accountable Care Organization;Accounting;Agriculture/Forestry;Airlines/Aviation;Alternative Dispute Resolution;Alternative Medicine;Ancillary Clinical Service Provider;Animation;Apparel & Fashion;Architecture & Planning;Architecture and Engineering;Arts a', 'No', '1,001-5,000;5,001-10,000;10,001+', 'Please prioritize the below functions:\nApplication / Software Development\nApplication Management: Other\nCIO\nCTO\nDevOps\nIT Project Management / PMO\nQA/Testing\nApplication Management: Finance\nApplication Management: Healthcare\nApplication Management: HR\nApp', '2942', '2024-11-15 16:02:36', '2024-11-15 16:02:36'),
(421, 'AUD-18812', 603004, 20231, 1, 'Q3 2024', 'Coder Technologies - NA', '2024-11-18', '2024-12-10', 'Live', 'Tuesday,Friday', 53, 15, 0, 0, 0, 53, 0, 'Yes', 'No', '2024-11-21', 'Canada;United States', 'Application / Software Development;Application Management: Finance;Application Management: HR;Application Management: Healthcare;Application Management: Integration / Middleware;Application Management: IoT;Application Management: Other;BI / Analytics / AI', 'Architect;C-Level / Executive Team;Director;EVP / SVP / VP / AVP;Manager', 'Accountable Care Organization;Accounting;Agriculture/Forestry;Airlines/Aviation;Alternative Dispute Resolution;Alternative Medicine;Ancillary Clinical Service Provider;Animation;Apparel & Fashion;Architecture & Planning;Architecture and Engineering;Arts a', 'No', '1,001-5,000;5,001-10,000;10,001+', 'Please prioritize the below functions:\nApplication / Software Development\nApplication Management: Other\nCIO\nCTO\nDevOps\nIT Project Management / PMO\nQA/Testing\nApplication Management: Finance\nApplication Management: Healthcare\nApplication Management: HR\nApp', '766', '2024-11-15 16:02:36', '2024-11-15 16:02:36'),
(422, 'AUD-19340', 621993, 20100, 1, 'Q3 2024', 'KnowledgeLake - NA', '2024-10-15', '2024-10-25', 'Live', 'Monday,Thursday', 48, 84, 0, 0, 0, 48, 0, 'No', 'No', '2024-10-22', 'Canada;United States', 'Application / Software Development;Application Management: Finance;Application Management: HR;Application Management: Healthcare;Application Management: Integration / Middleware;Application Management: IoT;Application Management: Other;BI / Analytics / AI', 'Architect;C-Level / Executive Team;Director;EVP / SVP / VP / AVP;Manager', 'Higher Education', 'No', '11-100;101-250;251-500;501-1,000;1,001-5,000;5,001-10,000;10,001+', 'Please prioritize the below functions:\nApplication / Software Development\nCIO\nCTO\nDevOps\nIT Infrastructure and Cloud Operations\nEngineering: Data Center/IT', '3573', '2024-11-15 16:02:36', '2024-11-15 16:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(30) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'sneha', 'sneha@gmail.com', '$2y$10$rsSCseS/4qUgno4LvyAFTOsVszz316wZBZwRzUoGWOMlxNg3riZsC', 'admin'),
(2, 'saqlain2024', 'saqlain.khan@yoanone.com', '$2y$10$OUr6QOnYSqCTERFOEip2x.wSpnip/jzvs/hJWIaou2f9PqM0.fTA2', 'admin'),
(3, 'akash7', 'akash.satpute@yoanone.com', '$2y$10$n7P1RExvNUSOt2qjjODbte5WKrCeLR5G1QbP.yQA/6PX/2pkjyfHi', 'user'),
(4, 'sneha', 'sneha.meshram@yoanone.com', '6c50638298d080e24c43f4e79eb5c124', 'user'),
(5, 'sneha', 'sneha.meshram@yoanone.com', '9aad1c075cf27a63dcd4c3b29b281cdf', 'user'),
(6, 'sneha', 'sneha.meshram@yoanone.com', '9aad1c075cf27a63dcd4c3b29b281cdf', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaign_details`
--
ALTER TABLE `campaign_details`
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
-- AUTO_INCREMENT for table `campaign_details`
--
ALTER TABLE `campaign_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
