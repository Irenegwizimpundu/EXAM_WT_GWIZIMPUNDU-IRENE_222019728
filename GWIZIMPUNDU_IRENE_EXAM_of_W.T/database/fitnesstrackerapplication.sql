-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 03:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitnesstrackerapplication`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

CREATE TABLE `achievement` (
  `achievement_id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `achievement_name` varchar(100) DEFAULT NULL,
  `date_unlocked` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`achievement_id`, `UserId`, `achievement_name`, `date_unlocked`) VALUES
(1, 1, 'Completed 5k run', '2024-05-01'),
(2, 2, 'Reached weight loss target', '2024-05-02'),
(3, 3, 'Won fitness challenge', '2024-04-28'),
(4, 4, 'Achieved personal best in bench press', '2024-05-05'),
(5, 1, 'Consistently tracked meals for a month', '2024-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `exercise_id` int(11) NOT NULL,
  `exercise_name` varchar(100) NOT NULL,
  `description` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`exercise_id`, `exercise_name`, `description`) VALUES
(2, 'Sit-up', 'Mind-body practice for flexibility and relaxation'),
(3, 'Squats', '	Compound exercise for lower body strength'),
(4, 'Pull-up', '	Compound exercise for lower body strength'),
(5, 'Plank', 'Mind-body practice for flexibility and relaxation'),
(6, 'Lunges', '	Compound exercise for lower body strength'),
(7, 'Running', 'Outdoor or treadmill running for cardio'),
(8, 'Squats', 'Compound exercise for lower body strength'),
(9, 'Push-ups', 'Bodyweight exercise for upper body strength'),
(10, 'Yoga', 'Mind-body practice for flexibility and relaxation'),
(11, 'Cycling', 'Indoor or outdoor cycling for cardio and leg strength');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(100) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `protein` float DEFAULT NULL,
  `carbs` float DEFAULT NULL,
  `fat` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `calories`, `protein`, `carbs`, `fat`) VALUES
(1, 'Chicken Breast', 231, 43.2, 0, 3.60),
(2, 'Broccoli', 50, 4, 9, 0.00),
(3, 'Brown Rice', 112, 2.6, 23.5, 0.90),
(4, 'Salmon', 206, 22, 0, 13.40),
(5, 'Oatmeal', 143, 5.5, 25.3, 2.40),
(6, 'Banana', 105, 1.3, 27, 0.40);

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `goal_id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `goal_type` varchar(100) DEFAULT NULL,
  `target` float DEFAULT NULL,
  `deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`goal_id`, `UserId`, `goal_type`, `target`, `deadline`) VALUES
(1, 4, 'Weight Loss', 10, '2024-06-30'),
(2, 2, 'Muscle Gain', 5, '2024-07-15'),
(3, 3, 'Marathon Training', 44, '0000-00-00'),
(4, 1, 'Strength Increase', 2, '0000-00-00'),
(5, 4, 'Healthy Eating', 111, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `meal_food`
--

CREATE TABLE `meal_food` (
  `meal_food_id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meal_food`
--

INSERT INTO `meal_food` (`meal_food_id`, `food_id`, `quantity`) VALUES
(1, 2, 1),
(2, 4, 1),
(3, 3, 1),
(4, 1, 1),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `UserId`, `age`, `height`, `weight`) VALUES
(1, 3, 30, 175.00, 70.00),
(2, 2, 35, 180.00, 85.00),
(3, 3, 28, 165.00, 60.00),
(4, 4, 40, 185.00, 90.00),
(5, 1, 25, 170.00, 75.00);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `progress_id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `body_fat_percentage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`progress_id`, `UserId`, `date`, `weight`, `body_fat_percentage`) VALUES
(1, 3, '2024-05-01', 68, 15.00),
(2, 1, '2024-05-01', 83, 20.00),
(3, 1, '2024-05-01', 58, 12.00),
(4, 3, '2024-05-01', 88, 18.00),
(5, 1, '2024-05-01', 72, 16.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'IRENE', 'GWIZIMPUNDU', 'IRENE08', 'IR@GMAIL.COM', '+250782437086', '$2y$10$F5i9ziOm49MB1k3GYSW5nODuMD6z7xRl8g2u97s/buAcjgeggPtEm', '2024-05-11 10:08:30', '3', 0),
(2, 'MUHAMED', 'ABUDULI', 'muhamaddd', 'muhamadabd@gmail.com', '07387777777', '$2y$10$yUULRdczSKb1NP0fUKiBqeowmXtH7ryqf9QDHVa0D/Va4L2Ak9KZa', '2024-05-12 07:50:08', '76666', 0),
(3, 'byukusenge', 'peter', 'byuk', 'peterbyuka@gmail.com', '07899555666', '$2y$10$4F.iMZMk2ZIrsBK7C6Sa/e9S5463fI5yEncaVnlDLIJcI7soOicaC', '2024-05-12 07:51:51', '64434', 0),
(4, 'alex', 'sanchez', 'sanchezalex', 'sanchez@gmail.com', '078333322222', '$2y$10$RagLkxPgdygKViPbqxCc1OoY7kabBrIDr4gCLwOqOKQqYdW02RBEq', '2024-05-12 07:52:53', '2222', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `activity_id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `activity_name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`activity_id`, `UserId`, `activity_name`, `date`, `duration`) VALUES
(1, 4, 'Running', '2024-05-01', 0),
(2, 1, 'Weightlifting', '2024-05-01', 1),
(3, 3, 'Yoga', '2024-05-01', 1),
(4, 2, 'Cycling', '2024-05-01', 1),
(5, 1, 'Walking', '2024-05-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

CREATE TABLE `workouts` (
  `workout_id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `workout_name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`workout_id`, `UserId`, `workout_name`, `date`, `duration`) VALUES
(1, 3, 'Morning Run', '2024-05-01', 0),
(2, 1, 'Full Body Workout', '2024-05-01', 1),
(3, 3, 'Yoga Session', '2024-05-01', 1),
(4, 1, 'Chest and Triceps', '2024-05-01', 1),
(5, 2, 'Brisk Walk', '2024-05-01', 1),
(6, 2, 'kungufu', '2024-05-16', 3),
(7, 3, 'pressing', '2024-01-10', 5),
(9, 4, 'eating food', '2024-06-06', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`achievement_id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `meal_food`
--
ALTER TABLE `meal_food`
  ADD PRIMARY KEY (`meal_food_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`workout_id`),
  ADD KEY `UserId` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievement`
--
ALTER TABLE `achievement`
  MODIFY `achievement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meal_food`
--
ALTER TABLE `meal_food`
  MODIFY `meal_food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `workout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievement`
--
ALTER TABLE `achievement`
  ADD CONSTRAINT `achievement_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `meal_food`
--
ALTER TABLE `meal_food`
  ADD CONSTRAINT `meal_food_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `user_activity_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `workouts`
--
ALTER TABLE `workouts`
  ADD CONSTRAINT `workouts_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
