-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 07, 2021 at 08:05 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(10) NOT NULL,
  `issue_title` varchar(200) NOT NULL,
  `issue_desc` varchar(200) NOT NULL,
  `issue_status_id` int(10) NOT NULL COMMENT '1 - Todo\r\n2- In Progress\r\n3 - In Review\r\n4 - Completed',
  `issue_image` varchar(200) NOT NULL,
  `issue_video` varchar(255) NOT NULL,
  `page_link` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status_code` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 - Active\r\n1 - In Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `issue_status`
--

CREATE TABLE `issue_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issue_status`
--

INSERT INTO `issue_status` (`id`, `status`) VALUES
(1, 'Todo'),
(2, 'In Progress'),
(3, 'In Review'),
(4, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `project_manager_id` int(10) NOT NULL,
  `developer_id` int(10) DEFAULT NULL,
  `status_id` int(10) NOT NULL COMMENT '0-ON Hold,1-Active,2-In Progress',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `dev_date` date NOT NULL,
  `launch_date` date NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status_code` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 - Active,1 - In Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `project_manager_id`, `developer_id`, `status_id`, `created_at`, `dev_date`, `launch_date`, `updated`, `status_code`) VALUES
(1, 'Caliper Pro', 4, 9, 2, '2020-12-10 00:15:00', '2020-12-30', '2021-01-05', '2021-01-07 00:03:06', '0'),
(2, 'Echo Group', 2, 6, 3, '2020-12-10 00:15:51', '2020-12-29', '2021-01-08', '2020-12-21 18:55:17', '0'),
(3, 'Sig Saucer', 5, 11, 2, '2020-12-10 00:49:28', '2020-12-24', '2021-01-22', '2020-12-11 03:31:01', '0'),
(4, 'Perkins', 2, 10, 2, '2020-12-10 02:32:50', '2020-12-24', '2020-12-31', '2020-12-11 03:29:51', '0'),
(5, 'agamatrix', 4, 6, 2, '2020-12-10 03:42:08', '2020-12-31', '2020-12-25', '2020-12-14 18:11:36', '0'),
(6, 'Anti Cancer', 4, 9, 3, '2020-12-10 21:23:29', '2020-12-19', '2020-12-31', '2020-12-11 03:30:56', '0'),
(7, 'Vip Tyres', 2, 6, 1, '2020-12-11 03:00:18', '2021-01-09', '2021-01-21', '2020-12-14 18:30:10', '0'),
(8, 'Randori', 5, 10, 2, '2020-12-11 03:37:54', '2020-12-12', '2021-01-02', '2020-12-11 03:43:33', '0'),
(9, 'Parterre', 3, 6, 3, '2020-12-11 20:29:25', '2021-01-01', '2021-03-01', '2021-01-07 01:03:28', '0'),
(10, 'TWI ', 5, 6, 3, '2020-12-11 20:54:50', '2020-12-25', '2021-01-01', '2020-12-16 03:34:31', '0'),
(11, 'Project_Manager', 4, 8, 2, '2020-12-16 04:08:30', '2020-12-31', '2021-01-09', NULL, '0'),
(12, ' User Manager', 2, 6, 1, '2020-12-16 04:19:54', '2021-01-07', '2021-01-08', '2020-12-17 03:05:43', '1'),
(13, 'mandy', 2, 6, 1, '2020-12-17 02:58:26', '2020-12-10', '2020-12-26', '2020-12-17 03:04:40', '1'),
(14, 'Reebok', 2, 6, 1, '2020-12-18 00:42:53', '2020-12-17', '2020-12-10', NULL, '0'),
(15, 'Texture Plus', 2, 9, 1, '2020-12-18 01:16:03', '2020-12-24', '2021-01-02', '2020-12-29 21:29:27', '1'),
(16, 'Dmart', 2, 6, 1, '2020-12-18 02:30:11', '2020-12-09', '2021-02-11', '2020-12-22 21:19:12', '1'),
(17, 'Deck', 2, 6, 1, '2020-12-18 02:38:48', '2020-12-25', '2021-01-08', '2020-12-22 21:19:10', '1'),
(18, 'Brite Optical', 2, 6, 1, '2020-12-21 18:37:41', '2018-12-20', '2020-12-31', '2020-12-21 18:37:53', '1'),
(19, 'vital', 4, 12, 2, '2020-12-21 18:45:30', '2020-12-02', '2021-03-11', '2020-12-22 21:10:33', '1'),
(20, 'Reebok', 5, 11, 2, '2020-12-21 20:26:14', '2020-12-09', '2020-12-19', '2020-12-22 21:10:30', '1'),
(21, 'amazon', 2, 6, 1, '2020-12-21 20:27:12', '2020-12-23', '2021-01-29', '2020-12-22 21:10:28', '1'),
(22, 'Mandy Website', 4, 6, 2, '2021-01-05 20:01:35', '2021-01-02', '2021-01-30', '2021-01-08 00:27:54', '1');

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE `project_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`id`, `status`) VALUES
(1, 'On Hold'),
(2, 'Active'),
(3, 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` enum('admin','pm','dev') NOT NULL DEFAULT 'dev',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status_code` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-Active,1-In Active',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `role`, `email`, `password`, `status_code`, `created`, `updated`) VALUES
(1, 'admin', 'admin', 'admin@example.com', 'e6e061838856bf47e1de730719fb2609', '0', '2020-12-10 03:35:06', '2020-12-10 03:37:19'),
(2, 'jack', 'pm', 'jack@example.com', '12ef7c5f50528bb5a002033ffa5551ee', '0', '2020-12-10 03:35:47', '2020-12-10 03:37:25'),
(3, 'john', 'pm', 'john@example.com', '58c2bd8a8be6198468412a24a56acf0b', '0', '2020-12-10 03:36:13', '2020-12-10 03:37:29'),
(4, 'rose', 'pm', 'rose@example.com', 'a970789ce93055bcd3520ace798e69f3', '0', '2020-12-10 03:36:39', '2020-12-10 03:37:33'),
(5, 'bella', 'pm', 'bella@example.com', '6d4c7d3b63cc5569b4e972374086cacf', '0', '2020-12-10 03:37:03', '2020-12-10 03:37:38'),
(6, 'ram', 'dev', 'ram@example.com', '3db66ceb605c1bcb779c63e180c4f2d0', '0', '2020-12-10 03:43:01', NULL),
(7, 'murali', 'dev', 'murali@example.com', '2f300f3f5cf52c8bbfd8970bf0bd4409', '0', '2020-12-10 03:43:44', NULL),
(8, 'rathina', 'dev', 'rathina@example.com', '11ec9596ca86a781b48006b9b9508e68', '0', '2020-12-10 03:44:30', NULL),
(9, 'vyshak', 'dev', 'vys@example.com', 'c62338683e290749e4dd3e0635e4330e', '0', '2020-12-10 03:44:54', NULL),
(10, 'saif', 'dev', 'saif@example.com', '33b991f2640e764fb6a08d367a7f8b01', '0', '2020-12-10 03:45:30', NULL),
(11, 'pradeep', 'dev', 'pradeep@example.com', '1701c008765fe7e0ad4135ab9805ba64', '0', '2020-12-10 19:45:24', NULL),
(12, 'abdul', 'dev', 'abdul@example.com', '377dc4d23d9e74079d33c0e7695efd74', '0', '2020-12-10 19:49:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_status`
--
ALTER TABLE `issue_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_status`
--
ALTER TABLE `project_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
