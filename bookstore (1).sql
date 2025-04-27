-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 05:10 PM
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
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rating` decimal(3,1) NOT NULL DEFAULT 4.7,
  `num_ratings` int(11) NOT NULL DEFAULT 1234
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `category`, `price`, `original_price`, `image`, `rating`, `num_ratings`) VALUES
(1, 'C++ Programming for the Absolute Beginner', 'Mark Lee', NULL, 'Programming', 599.00, 999.00, 'c++.jpeg', 4.7, 1234),
(2, 'The Pragmatic Programmer', 'Andrew Hunt and David Thomas', NULL, 'Programming', 599.00, 999.00, 'The_pragmatic.jpeg', 4.7, 1234),
(3, 'Clean Code', 'Robert C. Martin', NULL, 'Programming', 599.00, 999.00, 'clean_code.jpeg', 4.7, 1234),
(4, 'Introduction to the Theory of Computation', 'Michael Sipser', NULL, 'Programming', 599.00, 999.00, 'computation.jpeg', 4.7, 1234),
(5, 'You Dont Know JS', 'Kyle Simpson', NULL, 'Programming', 599.00, 999.00, 'dont_js.jpg', 4.7, 1234),
(6, 'Code Complete', 'Steve McConnell', NULL, 'Programming', 599.00, 999.00, 'code_complete.jpeg', 4.7, 1234),
(7, 'Effective Java', 'Joshua Bloch', NULL, 'Programming', 599.00, 999.00, 'effective_java.jpeg', 4.7, 1234),
(8, 'Design Patterns', 'Erich Gamma, Richard Helm, Ralph Johnson, and John Vlissides', NULL, 'Programming', 599.00, 999.00, 'Design_patterns.jpeg', 4.7, 1234),
(9, 'JavaScript: The Good Parts', 'Douglas Crockford', NULL, 'Programming', 599.00, 999.00, 'javascript.jpg', 4.7, 1234),
(10, 'Automate the Boring Stuff with Python', 'Al Sweigart', NULL, 'Programming', 599.00, 999.00, 'Automate.jpg', 4.7, 1234),
(11, 'The Intelligent Investor', 'Benjamin Graham', NULL, 'Finance', 599.00, 999.00, 'intelligent.jpeg', 4.7, 1234),
(12, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', NULL, 'Finance', 599.00, 999.00, 'rich_dad.jpeg', 4.7, 1234),
(13, 'The Millionaire Next Door', 'Thomas J. Stanley and William D. Danko', NULL, 'Finance', 599.00, 999.00, 'millionaire.jpeg', 4.7, 1234),
(14, 'I Will Teach You to Be Rich', 'Ramit Seth', NULL, 'Finance', 599.00, 999.00, 'Teach_you.jpeg', 4.7, 1234),
(15, 'The Total Money Makeover', 'Dave Ramsey', NULL, 'Finance', 599.00, 999.00, 'total_money.jpeg', 4.7, 1234),
(16, 'Principles: Life and Work', 'Ray Dalio', NULL, 'Finance', 599.00, 999.00, 'principles.jpeg', 4.7, 1234),
(17, 'Your Money or Your Life', 'Vicki Robin and Joe Dominguez', NULL, 'Finance', 599.00, 999.00, 'your_money.jpg', 4.7, 1234),
(18, 'The Little Book of Common Sense Investing', 'John C. Bogle', NULL, 'Finance', 599.00, 999.00, 'little_book.jpeg', 4.7, 1234),
(19, 'Think and Grow Rich', 'Napoleon Hill', NULL, 'Finance', 599.00, 999.00, 'think.jpeg', 4.7, 1234),
(20, 'The Psychology of Money', 'Morgan Housel', NULL, 'Finance', 599.00, 999.00, 'psychology.jpg', 4.7, 1234),
(21, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', NULL, 'General Knowledge', 599.00, 999.00, 'sapiens.jpeg', 4.7, 1234),
(22, 'Guns, Germs, and Steel: The Fates of Human Societies', 'Jared Diamond', NULL, 'General Knowledge', 599.00, 999.00, 'guns.jpeg', 4.7, 1234),
(23, 'The Gene: An Intimate History', 'Siddhartha Mukherjee', NULL, 'General Knowledge', 599.00, 999.00, 'gene.jpeg', 4.7, 1234),
(24, 'The Immortal Life of Henrietta Lacks', 'Rebecca Skloot', NULL, 'General Knowledge', 599.00, 999.00, 'immortal.jpeg', 4.7, 1234),
(25, 'A Short History of Nearly Everything', 'Bill Bryson', NULL, 'General Knowledge', 599.00, 999.00, 'short.jpeg', 4.7, 1234),
(26, 'The Elements of Style', 'William Strunk Jr. and E.B. White', NULL, 'General Knowledge', 599.00, 999.00, 'elements.jpeg', 4.7, 1234),
(27, 'The World Atlas of Coffee', 'James Hoffmann', NULL, 'General Knowledge', 599.00, 999.00, 'world.jpeg', 4.7, 1234),
(28, 'The Art of War', 'Sun Tzu', NULL, 'General Knowledge', 599.00, 999.00, 'art of war.jpeg', 4.7, 1234),
(29, 'Mans Search for Meaning', 'Viktor Frankl', NULL, 'General Knowledge', 599.00, 999.00, 'search.jpeg', 4.7, 1234),
(30, 'Meditations', 'Marcus Aurelius', NULL, 'General Knowledge', 599.00, 999.00, 'meditations.jpeg', 4.7, 1234);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `book_id` int(6) UNSIGNED NOT NULL,
  `quantity` int(3) NOT NULL DEFAULT 1,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `book_id`, `quantity`, `added_date`) VALUES
(1, 1, 3, 1, '2025-04-22 14:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_books`
--

CREATE TABLE `collection_books` (
  `id` int(6) UNSIGNED NOT NULL,
  `collection_id` int(6) UNSIGNED NOT NULL,
  `book_id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `status`, `order_date`, `book_id`, `quantity`, `shipping_address`) VALUES
(1, 1, 599.00, 'pending', '2025-04-22 14:32:30', NULL, NULL, NULL),
(2, 1, 599.00, 'pending', '2025-04-22 15:07:32', NULL, NULL, NULL),
(3, 1, 599.00, 'pending', '2025-04-22 15:16:25', NULL, NULL, NULL),
(4, 1, 599.00, 'pending', '2025-04-22 15:16:28', NULL, NULL, NULL),
(5, 1, 599.00, 'confirmed', '2025-04-22 15:16:39', NULL, NULL, NULL),
(6, 2, 599.00, 'pending', '2025-04-22 15:44:36', NULL, NULL, NULL),
(7, 2, 599.00, 'pending', '2025-04-22 15:44:45', NULL, NULL, NULL),
(8, 2, 599.00, 'pending', '2025-04-22 15:44:51', NULL, NULL, NULL),
(9, 2, 599.00, 'pending', '2025-04-22 15:44:55', NULL, NULL, NULL),
(10, 2, 599.00, 'pending', '2025-04-22 15:51:58', NULL, NULL, NULL),
(11, 2, 599.00, 'pending', '2025-04-22 15:52:32', NULL, NULL, NULL),
(12, 2, 599.00, 'pending', '2025-04-22 16:02:19', NULL, NULL, NULL),
(13, 2, 599.00, 'confirmed', '2025-04-22 16:03:17', NULL, NULL, NULL),
(14, 2, 599.00, 'confirmed', '2025-04-22 16:04:03', NULL, NULL, NULL),
(15, 2, 599.00, 'confirmed', '2025-04-22 16:05:19', NULL, NULL, NULL),
(16, 1, 599.00, 'confirmed', '2025-04-23 01:22:18', 1, 1, 'Prakash Monis, NIRNDI HOUSE, NAVOOR P&V, BELTHANGADY, jhhdflk, llhsh, 454445, 08867252705'),
(17, 1, 599.00, 'pending', '2025-04-24 14:32:28', 1, 1, 'Prakash Monis, NIRNDI HOUSE, NAVOOR P&V, BELTHANGADY, jhhdflk, llhsh, 454445, 08867252705'),
(18, 1, 599.00, 'pending', '2025-04-24 14:33:21', 1, 1, 'Prakash Monis, NIRNDI HOUSE, NAVOOR P&V, BELTHANGADY, jhhdflk, llhsh, 454445, 08867252705'),
(19, 1, 599.00, 'pending', '2025-04-24 14:36:01', 1, 1, 'Prakash Monis, NIRNDI HOUSE, NAVOOR P&V, BELTHANGADY, jhhdflk, llhsh, 454445, 08867252705'),
(20, 1, 599.00, 'pending', '2025-04-24 14:57:05', 1, 1, 'jjshdkj, NIRNDI HOUSE, NAVOOR P&V, BELTHANGADY, jhhdflk, llhsh, 454445, 08867252705');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(6) UNSIGNED NOT NULL,
  `order_id` int(6) UNSIGNED NOT NULL,
  `book_id` int(6) UNSIGNED NOT NULL,
  `quantity` int(3) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `book_id`, `quantity`, `price`) VALUES
(1, 1, 3, 1, 599.00),
(2, 2, 6, 1, 599.00),
(3, 3, 6, 1, 599.00),
(4, 4, 6, 1, 599.00),
(5, 5, 6, 1, 599.00),
(6, 6, 23, 1, 599.00),
(7, 7, 2, 1, 599.00),
(8, 8, 1, 1, 599.00),
(9, 9, 1, 1, 599.00),
(10, 10, 3, 1, 599.00),
(11, 11, 5, 1, 599.00),
(12, 12, 1, 1, 599.00),
(13, 13, 1, 1, 599.00),
(14, 14, 1, 1, 599.00),
(15, 15, 1, 1, 599.00),
(16, 16, 1, 1, 599.00),
(17, 17, 1, 1, 599.00),
(18, 18, 1, 1, 599.00),
(19, 19, 1, 1, 599.00),
(20, 20, 1, 1, 599.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `reg_date`) VALUES
(1, 'Prakash', 'prakashmonis06@gmail.com', '$2y$10$8IMLJ9Gs4RU31mZN8CVH0OiG/b6/896w1OgBkbusTuqKJU6.7RHve', '2025-04-22 14:13:38'),
(2, 'Prakash Monis', 'prakashmonis07@gmail.com', '$2y$10$fT5/icStI62ACaGMQP8pW.S95Ud1ZoAia5M4YqbBaLEoRgOIGUxry', '2025-04-22 15:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `book_id` int(6) UNSIGNED NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `book_id`, `added_date`) VALUES
(1, 1, 1, '2025-04-22 14:58:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_books`
--
ALTER TABLE `collection_books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `collection_id` (`collection_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_books`
--
ALTER TABLE `collection_books`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collection_books`
--
ALTER TABLE `collection_books`
  ADD CONSTRAINT `collection_books_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collection_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
