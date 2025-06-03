-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 12:37 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `local_theatre`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `BlogID` int(11) NOT NULL,
  `BlogTitle` varchar(32) NOT NULL,
  `BlogContent` varchar(50) NOT NULL,
  `BlogStatus` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `BlogCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BlogAuthorFK` int(11) NOT NULL,
  `ShowIDFK` int(11) NOT NULL,
  `image_url` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`BlogID`, `BlogTitle`, `BlogContent`, `BlogStatus`, `BlogCreated`, `BlogAuthorFK`, `ShowIDFK`, `image_url`) VALUES
(1, 'Review of Shrek', 'Great performance by the cast!', 'Approved', '2025-06-03 08:45:48', 1, 1, 'shrek_the_movie.jpeg'),
(2, 'Review of Grease', 'Great performance by the cast!', 'Approved', '2025-06-03 09:40:58', 1, 2, 'grease_musical.jpg'),
(3, 'Life Of Pi Review', 'A Real Tiger?!', 'Approved', '2025-06-03 13:45:32', 1, 3, 'life_of_pi.jpeg'),
(4, 'Mary Poppins Review', 'How Did She Fly?', 'Approved', '2025-06-03 20:30:32', 1, 4, 'mary_poppins.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `CommentID` int(11) NOT NULL,
  `CommentTitle` varchar(32) NOT NULL,
  `CommentCreated` varchar(200) NOT NULL,
  `CommentStatus` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `CommentBlogIDFK` int(11) NOT NULL,
  `UserIDFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`CommentID`, `CommentTitle`, `CommentCreated`, `CommentStatus`, `CommentBlogIDFK`, `UserIDFK`) VALUES
(1, 'Loved it!', 'Wonderful review, I agree!', 'Approved', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `NewsID` int(11) NOT NULL,
  `NewsTitle` varchar(32) NOT NULL,
  `NewsCreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ShowIDFK` int(11) NOT NULL,
  `NewsAddedByFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`NewsID`, `NewsTitle`, `NewsCreated`, `ShowIDFK`, `NewsAddedByFK`) VALUES
(1, 'Shrek Tickets Sold Out!', '2025-06-02 09:11:02', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `ShowID` int(11) NOT NULL,
  `ShowName` varchar(255) NOT NULL,
  `ShowType` varchar(255) NOT NULL,
  `DateShown` date NOT NULL,
  `DateAdded` date NOT NULL,
  `showimage_url` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`ShowID`, `ShowName`, `ShowType`, `DateShown`, `DateAdded`, `showimage_url`) VALUES
(1, 'Shrek', 'Drama', '2025-06-01', '2025-05-20', 'shrek_the_movie.jpg'),
(2, 'Grease', 'Musical', '2025-06-02', '2025-05-20', 'grease_musical.jpg'),
(3, 'Life_Of_Pi', 'Drama', '2025-06-03', '2025-05-20', 'life_of_pi.jpg'),
(4, 'Mary_Poppins', 'Musical', '2025-06-03', '2025-06-04', 'mary_poppins.jpg'),
(5, 'Winnie_The_Pooh', 'Musical', '2025-06-04', '2025-06-03', 'winnie_the_pooh.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(12) NOT NULL,
  `UserEmail` varchar(32) NOT NULL,
  `UserRole` enum('User','Admin') NOT NULL DEFAULT 'User',
  `UserPassword` varchar(32) NOT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `surname` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `UserEmail`, `UserRole`, `UserPassword`, `firstname`, `surname`) VALUES
(1, 'uzair_moh', 'moh@example.com', 'Admin', 'securepassword', 'Uzair', 'Mohammed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`BlogID`),
  ADD KEY `ShowIDFK` (`ShowIDFK`),
  ADD KEY `BlogAuthorFK` (`BlogAuthorFK`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `UserIDFK` (`UserIDFK`),
  ADD KEY `CommentBlogIDFK` (`CommentBlogIDFK`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`NewsID`),
  ADD KEY `NewsAddedByFK` (`NewsAddedByFK`),
  ADD KEY `ShowIDFK` (`ShowIDFK`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`ShowID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `BlogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `NewsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `ShowID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`ShowIDFK`) REFERENCES `shows` (`ShowID`),
  ADD CONSTRAINT `blogs_ibfk_2` FOREIGN KEY (`BlogAuthorFK`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_ibfk_1` FOREIGN KEY (`UserIDFK`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `blog_comments_ibfk_2` FOREIGN KEY (`CommentBlogIDFK`) REFERENCES `blogs` (`BlogID`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`NewsAddedByFK`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`ShowIDFK`) REFERENCES `shows` (`ShowID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
