-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 07:32 AM
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
-- Database: `agrify`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `register_user` (IN `p_username` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(100), IN `p_role` ENUM('farmer','buyer'), OUT `p_result` VARCHAR(255))   BEGIN
    DECLARE v_exists INT;

    SELECT COUNT(*) INTO v_exists FROM users WHERE username = p_username OR email = p_email;

    IF v_exists > 0 THEN
        SET p_result = 'Username or email already exists.';
    ELSE
        INSERT INTO users (username, email, password, role) 
        VALUES (p_username, p_email, p_password, p_role);
        SET p_result = 'success';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_register_user` (IN `p_username` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(100), IN `p_role` ENUM('farmer','buyer','admin'), OUT `p_result` VARCHAR(255))   BEGIN
    DECLARE existing_username INT;
    DECLARE existing_email INT;

    SELECT COUNT(*) INTO existing_username FROM users WHERE username = p_username;
    SELECT COUNT(*) INTO existing_email FROM users WHERE email = p_email;

    IF existing_username > 0 THEN
        SET p_result = 'Username already exists.';
    ELSEIF existing_email > 0 THEN
        SET p_result = 'Email already exists.';
    ELSEIF NOT is_valid_email(p_email) THEN
        SET p_result = 'Invalid email format.';
    ELSE
        INSERT INTO users (username, email, password, role) 
        VALUES (p_username, p_email, p_password, p_role);
        SET p_result = 'success';
    END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `is_valid_email` (`email` VARCHAR(100)) RETURNS TINYINT(1) DETERMINISTIC BEGIN
    RETURN email REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cages`
--

CREATE TABLE `cages` (
  `cage_id` int(11) NOT NULL,
  `cage_name` varchar(255) NOT NULL,
  `cage_desc` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cages`
--

INSERT INTO `cages` (`cage_id`, `cage_name`, `cage_desc`, `image_path`, `created_at`) VALUES
(1, 'test', 'test', '../uploads/1745576760_aaa.png', '2025-04-25 18:42:01'),
(2, 'abdu', 'eric', '/uploads/cage_680b6c9bebad39.77913173_daddy.png', '2025-04-25 19:06:03'),
(3, 'test', 'test', NULL, '2025-04-26 09:58:10'),
(4, 'file sent', 'whe', '/php/uploads/cage_680c41cce24427.35349694_cale.png', '2025-04-26 10:15:40'),
(5, 'again', 'again', '../php/uploads/cage_680c41f6a232a0.87499536_4.png', '2025-04-26 10:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `livestock`
--

CREATE TABLE `livestock` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL CHECK (`age` >= 0),
  `weight` decimal(10,2) DEFAULT NULL CHECK (`weight` >= 0),
  `price` decimal(10,2) DEFAULT NULL CHECK (`price` >= 0),
  `status` enum('available','sold','pending') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketplace`
--

CREATE TABLE `marketplace` (
  `id` int(11) NOT NULL,
  `livestock_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL CHECK (`price` >= 0),
  `status` enum('listed','pending','sold') DEFAULT 'listed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `livestock_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL CHECK (`price` >= 0),
  `status` enum('completed','canceled') DEFAULT 'completed',
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('farmer','buyer','admin') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(3, 'testuser', 'testuser@example.com', '$2y$10$dt10WpJpPtNQSmsdtqmX5.lBVvzeVO4fsS6dI2qesw/Gegw5oUyr2', 'admin', '2025-04-11 06:44:08'),
(4, 'Bisaya', 'ericbisaya@email.com', '$2y$10$FEQmh3U7a6SrgWEH/LCpgOKJJQUt1OixQBiJH5ELSTGaJInRI0MXa', 'farmer', '2025-04-21 07:14:06'),
(5, 'EricBisaya', 'ericbisaya2@email.com', '$2y$10$upfFDB7ivtArOGzaf30kpO7DV3CeLR9e0bOD9J3lQWHEcSpQtziEa', 'farmer', '2025-04-21 07:17:45'),
(6, 'Lebron', 'lebron@gmail.com', '$2y$10$7ZJCzziCnJ/AtQlFoXG4cOYOCQtRI1zyXEhzctjYcilscnMxR8rUy', 'farmer', '2025-04-21 07:21:14'),
(7, 'Eric', 'paul@gmail.com', '$2y$10$GBipabc98WQMnPhHm6WZx.cqjwL.aIjiHwfLM8W9oiKnBzeuKWMp.', 'farmer', '2025-04-23 07:50:12');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `trg_after_user_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    INSERT INTO user_log (user_id, action)
    VALUES (NEW.user_id, 'User Registered');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`log_id`, `user_id`, `action`, `timestamp`) VALUES
(1, 4, 'User Registered', '2025-04-21 07:14:06'),
(2, 5, 'User Registered', '2025-04-21 07:17:45'),
(3, 6, 'User Registered', '2025-04-21 07:21:14'),
(4, 7, 'User Registered', '2025-04-23 07:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `contact` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`profile_id`, `user_id`, `name`, `address`, `dob`, `contact`, `created_at`) VALUES
(1, 4, 'Libradilla, Eric L', 'Bisaya Street', '2025-04-01', '09123456789', '2025-04-21 07:14:06'),
(2, 5, 'Azeem, Abdu O.', 'Cabatangan', '2025-04-05', '09123456789', '2025-04-21 07:17:45'),
(3, 6, 'Justin James Lebron', 'Lebron Street', '2025-04-03', '09123456789', '2025-04-21 07:21:14'),
(4, 7, 'Paul Abdu', 'Labuan', '2025-04-03', '09123456789', '2025-04-23 07:50:12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_list`
-- (See below for the actual view)
--
CREATE TABLE `vw_user_list` (
`user_id` int(11)
,`username` varchar(100)
,`email` varchar(100)
,`role` enum('farmer','buyer','admin')
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `vw_user_list`
--
DROP TABLE IF EXISTS `vw_user_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_user_list`  AS SELECT `users`.`user_id` AS `user_id`, `users`.`username` AS `username`, `users`.`email` AS `email`, `users`.`role` AS `role`, `users`.`created_at` AS `created_at` FROM `users` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cages`
--
ALTER TABLE `cages`
  ADD PRIMARY KEY (`cage_id`);

--
-- Indexes for table `livestock`
--
ALTER TABLE `livestock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `marketplace`
--
ALTER TABLE `marketplace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livestock_id` (`livestock_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `livestock_id` (`livestock_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cages`
--
ALTER TABLE `cages`
  MODIFY `cage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `livestock`
--
ALTER TABLE `livestock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketplace`
--
ALTER TABLE `marketplace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `livestock`
--
ALTER TABLE `livestock`
  ADD CONSTRAINT `livestock_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace`
--
ALTER TABLE `marketplace`
  ADD CONSTRAINT `marketplace_ibfk_1` FOREIGN KEY (`livestock_id`) REFERENCES `livestock` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marketplace_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marketplace_ibfk_3` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`livestock_id`) REFERENCES `livestock` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
