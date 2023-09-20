-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 03:54 PM
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
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `userId` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`userId`, `product_id`, `quantity`) VALUES
(3, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_price`, `status`) VALUES
(6, 3, '2023-09-15', 489.00, 'completed'),
(10, 3, '2023-09-20', 680.00, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(23, 6, 24, 1, 150.00),
(24, 6, 36, 3, 18.00),
(25, 6, 31, 1, 35.00),
(26, 6, 26, 1, 250.00),
(35, 10, 24, 3, 100.00),
(36, 10, 27, 1, 200.00),
(37, 10, 30, 1, 120.00),
(38, 10, 28, 1, 60.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` double NOT NULL,
  `product_image` text NOT NULL,
  `product_details` text NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_image`, `product_details`, `added_by`, `archive`) VALUES
(24, 'Air Max 3', 100, '6502bab3c8e09.jpeg', 'Introducing the \"Air Max 3\" - the epitome of style, comfort, and innovation in footwear. Crafted to deliver the perfect blend of fashion-forward design and unparalleled performance, these shoes are a true game-changer. With their iconic Air Max cushioning technology, the \"Air Max 3\" offers exceptional comfort and support with every step, making them ideal for both urban adventures and athletic pursuits. Elevate your shoe game and step into a world of style and comfort with the \"Air Max 3.\" Experience the future of footwear today.', 'issaalsabeh', 0),
(25, 'Ethereal Elegance', 54, '6502baea4fe96.jpeg', 'Introducing \"Ethereal Elegance,\" a captivating perfume that embodies sophistication and allure. This enchanting fragrance takes you on a sensory journey with its delicate blend of floral and woody notes. With a top note of fresh bergamot, heart notes of romantic roses and exotic jasmine, and a base note of warm sandalwood, \"Ethereal Elegance\" is a scent that lingers, leaving an unforgettable and enchanting impression. Elevate your daily rituals with this exquisite fragrance, and let \"Ethereal Elegance\" be your signature scent of allure and sophistication.', 'issaalsabeh', 0),
(26, 'Canon 500', 250, '6502bb1e00571.jpeg', 'Introducing the \"Canon 500,\" your gateway to visual excellence. This camera combines precision engineering with cutting-edge technology to capture moments with breathtaking clarity and detail. With its user-friendly interface and powerful features, the \"Canon 500\" empowers both beginners and photography enthusiasts to unleash their creativity and capture memories like never before. Elevate your photography game and explore the world through the lens of the \"Canon 500\" – where every click tells a story.', 'issaalsabeh', 0),
(27, 'AirPods Pro Max', 200, '6502bb61db5d3.jpeg', '\"AirPods Pro Max\" is the pinnacle of wireless audio technology. These premium earbuds offer an immersive sound experience, combining active noise cancellation with crystal-clear audio quality. Designed for comfort and style, the \"AirPods Pro Max\" deliver an unparalleled listening experience, whether you\'re in a bustling city or enjoying your favorite tunes in serene solitude. Elevate your audio world with \"AirPods Pro Max\" – where sound meets perfection.', 'issaalsabeh', 0),
(28, 'G15 Keyboard', 60, '6502bbb6af056.png', 'The \"G15 Keyboard\" is a gamer\'s dream come true. Engineered for ultimate performance, it offers a responsive and customizable gaming experience like no other. With programmable keys, customizable RGB lighting, and a sleek design, the \"G15 Keyboard\" is not just a peripheral but an essential weapon in your gaming arsenal. Elevate your gameplay to the next level with the precision and control of the \"G15 Keyboard\" – where every keystroke counts.', 'issaalsabeh', 0),
(29, 'Dove Lotion', 10, '6502bc22ca50d.jpeg', '\"Dove Lotion\" is your daily dose of skin love. Formulated with nourishing ingredients, this lotion provides deep hydration and care for your skin, leaving it soft, smooth, and radiant. Pamper yourself with the gentle, dermatologist-recommended formula that\'s suitable for all skin types. With \"Dove Lotion,\" you can embrace a daily skincare routine that keeps your skin feeling beautifully moisturized and healthy. Discover the secret to supple, glowing skin with \"Dove Lotion\" – where care meets confidence.', 'issaalsabeh', 0),
(30, 'GlamourSculpt Set', 120, '6502bc6b6367f.jpeg', 'Introducing the \"GlamourSculpt Deluxe Makeup Set\" – your all-in-one beauty companion for creating stunning looks. This luxurious makeup collection includes an array of richly pigmented eyeshadows, silky-smooth blushes, velvety lip shades, and precision brushes. With the \"GlamourSculpt Deluxe Makeup Set,\" you\'ll effortlessly transform your face into a canvas of artistry. Whether you\'re aiming for a natural glow or a bold, glamorous style, this set empowers you to express your unique beauty. Elevate your makeup game and unveil your inner artist with the \"GlamourSculpt Deluxe Makeup Set\" – where beauty meets creativity.', 'issaalsabeh', 0),
(31, 'Mouse M283', 35, '6502bcaa14c87.png', 'The \"Mouse M283\" is your reliable companion for seamless navigation and productivity. Designed for comfort and precision, this wireless mouse offers a responsive and ergonomic solution for your computing needs. With a sleek and modern design, the \"Mouse M283\" is not just a peripheral but an essential tool in your daily workflow. Elevate your computing experience with the ease and accuracy of the \"Mouse M283\" – where precision meets comfort.', 'issaalsabeh', 0),
(32, 'Mouse Pad X34 ', 15, '6502bcdbea8b6.png', 'The \"X34 Mouse Pad\" is your ultimate surface for precision and control. Crafted with a premium textured finish, this mouse pad offers optimal tracking accuracy and smooth glide for your mouse, ensuring that every move is swift and precise. With its sleek design and ample size, the \"X34 Mouse Pad\" provides ample space for both work and play. Elevate your mouse\'s performance and enhance your computing or gaming experience with the \"X34 Mouse Pad\" – where precision and style converge.', 'issaalsabeh', 0),
(36, 'Rubik\'s Cube', 18, '65036dd0423ce.jpg', 'The \"Rubik\'s Cube\" is a classic, mind-bending puzzle that challenges your problem-solving skills as you twist and turn its colorful sides to solve it. It\'s an enduring symbol of both complexity and the joy of conquering a challenge.', 'issaalsabeh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(50) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersPhone` varchar(16) NOT NULL,
  `usersUsername` varchar(50) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `usersRole` varchar(12) NOT NULL,
  `usersCity` varchar(128) NOT NULL,
  `usersArea` varchar(128) NOT NULL,
  `usersStreet` varchar(128) NOT NULL,
  `usersBuilding` varchar(128) NOT NULL,
  `usersFloor` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersPhone`, `usersUsername`, `usersPwd`, `usersRole`, `usersCity`, `usersArea`, `usersStreet`, `usersBuilding`, `usersFloor`) VALUES
(2, 'Admin', 'admin@admin.com', '24372304', 'admin', '$2y$10$nzhh4TFgJrYGnFyssh6nNOnhaPDHGislRTaFJcXI1q/zPMI4E9YTS', 'Admin', '', '', '', '', 0),
(3, 'Issa AlSabeh', 'issa@gmail.com', '12345678', 'issaalsabeh', '$2y$10$Po6X8n7lzXtxImt1Kh1xjuipECAj8B327XwgW3B7kmhPcua75N/Xu', 'User', 'Beirut', 'Test Area', 'Test Street', 'Building 3', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `cart_ibfk_1` (`userId`),
  ADD KEY `cart_ibfk_2` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`usersId`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`usersId`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
