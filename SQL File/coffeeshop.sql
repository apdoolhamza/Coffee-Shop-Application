-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 04:00 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `createdDate`) VALUES
(1, 'Apdool Hamza', 'abdulmajeedone23@gmail.com', '$2y$10$WXO678pzmDGFPlspmuWzYeLxJ.jIJh7coKmm1cDYieyaX1p/cz1zO', '2024-03-19 21:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `productName` varchar(14) DEFAULT NULL,
  `productPrice` double(10,2) NOT NULL DEFAULT 0.00,
  `productGradient` varchar(13) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productName`, `productPrice`, `productGradient`, `productDescription`, `productImage`, `postingDate`) VALUES
(1, 'Americano', 2500.00, 'hot water', 'An Americano is a type of coffee made by adding boiled water to a shot of espresso. It is called an \"Americano\" because it is similar to the kind of coffee typically served in the United States, usually made by brewing hot water over ground coffee beans. The result is a coffee that is less strong and less concentrated than an espresso but still has the rich, full flavour of the coffee.', 'images (26).jpeg', '2024-03-22 06:20:54'),
(2, 'Cappuccino', 3000.00, 'steamed milk', 'A cappuccino is a coffee made with equal parts espresso, steamed milk, and foam. It is typically served in a small, 6-ounce (180-milliliter) cup. A cappuccino is characterized by its rich, creamy texture and robust and bold flavour.', 'images (14).jpeg', '2024-03-22 06:23:16'),
(3, 'Latte', 700.00, 'milk foam', 'A latte is a coffee figured up with espresso and steamed milk, topped with a thin layer of milk foam. It is typically served in a tall, 12-ounce (360-millilitre) glass. A latte has a milder flavour and a creamier texture. The milk foam on top adds a smooth, velvety texture and a slightly sweet taste.', 'images (6).jpeg', '2024-03-22 06:25:12'),
(4, 'Macchiato', 2000.00, 'steamed milk', 'A macchiato is a coffee made with a small amount of steamed milk and a dollop of milk foam on top of a shot of espresso. It is typically served in a small, 4-ounce (120-millilitre) glass. The word \"macchiato\" means \"marked\" or \"stained\" in Italian, which refers to the way that the milk foam \"marks\" the espresso. It is similar to a cappuccino but has less milk and more foam, giving it a more concentrated flavour.', 'images (26).jpeg', '2024-03-22 06:26:45'),
(5, 'Mocha', 500.00, 'chocolate', 'Mocha is a coffee made with a latte base and chocolate syrup or cocoa powder added. It is typically served in a tall, 12-ounce (360-millilitre) glass. The chocolate flavour in a mocha comes from either chocolate syrup or cocoa powder, which is mixed into the steamed milk before the espresso is added. This gives the mocha a rich, chocolaty taste and a smooth, creamy texture.', 'images (48).jpeg', '2024-03-22 06:28:20'),
(6, 'Flat White', 4500.00, 'steamed milk', 'A Flat White is a coffee prepared with a double shot of espresso and a small amount of steamed milk, topped with a thin layer of milk foam. A Flat White is made with about 3 ounces (90 millilitres) of espresso and 4 ounces (120 millilitres) of steamed milk, topped with a thin layer of milk foam. The milk foam is typically poured over the espresso and milk in a circular motion, creating a \"flat\" surface on top of the drink. Flat White originated in Australia and has become a popular coffee drink worldwide.', 'images (39).jpeg', '2024-03-22 06:29:45'),
(7, 'Cortado', 2500.00, 'boiled milk', 'A cortado is a coffee made with a small amount of boiled milk and a thin layer of milk foam on top of a shot of espresso. It is typically served in a small, 4-ounce (120-millilitre) glass. The word \"cortado\" means \"cut\" in Spanish, which refers to the way that the milk \"cuts\" the strength of the espresso. A cortado is characterized by its balanced, smooth flavour and creamy, velvety texture.', 'robbie-down-LI8inyHnm_A-unsplash-768x548.webp', '2024-03-22 06:31:45'),
(8, 'Red Eye', 1000.00, 'flavour', 'A Red Eye is a coffee made by including a shot of espresso in a cup of drip coffee. It is called a \"Red Eye\" because the added caffeine from the espresso is believed to help people stay awake and alert, much like rubbing the redness out of your eyes. A Red Eye is typically made with about 8 ounces (240 millilitres) of drip coffee and 1 ounce (30 millilitres) of espresso. Some variations of the Red Eye include adding additional espresso shots or using flavoured syrups to enhance the flavour.', '600px-Baileys_and_coffee.jpg', '2024-03-22 06:33:29'),
(9, 'Black Eye', 3200.00, 'espresso', 'A Black Eye is a type of coffee made by putting two shots of espresso into a cup of drip coffee. It is called a \"Black Eye\" because the added caffeine from the espresso is believed to help people stay awake and alert, much like having a black eye. It is often preferred by those who find a Red Eye too weak or by those who enjoy the intense, concentrated espresso flavour. A Black Eye is typically made with about 8 ounces (240 millilitres) of drip coffee and 2 ounces (60 millilitres) of espresso.', 'images (38).jpeg', '2024-03-22 06:35:15'),
(10, 'Long Black', 2350.00, 'hot water', 'A Long Black is a type of coffee made by flowing a double shot of espresso over hot water. It is called a \"Long Black\" because the espresso is poured over the hot water, creating a \"long\" coffee. A Long Black is a robust and bold coffee similar to an Americano, but it is made with a double shot of espresso, giving it a more concentrated flavour. Those who enjoy the rich, full flavour of espresso often prefer it but want a longer-lasting caffeine boost.', 'images (45).jpeg', '2024-03-22 06:36:40'),
(11, 'Vienna', 5000.00, 'espresso', 'A Vienna is a coffee made with an espresso base and whipped cream instead of milk foam. It is called \"Vienna\" because it is believed to have originated in the Austrian capital city of Vienna. It is similar to a latte, but it is made with whipped cream instead of milk foam, which gives it a lighter, fluffier texture.', 'coffeecard2.jpeg', '2024-03-22 06:38:16'),
(12, 'Matcha Latte', 2700.00, 'tea powder', 'A Matcha Latte is a coffee made with a latte base and matcha green tea powder. It is a creamy, aromatic coffee characterized by its smooth, velvety texture and subtle, earthy flavour. A Matcha Latte is made with about 3 ounces (90 millilitres) of espresso, 9 ounces (270 millilitres) of steamed milk, and 1 teaspoon (5 millilitres) of matcha green tea powder. The milk foam is added, along with a sprinkle of matcha green tea powder, for extra flavour.', 'coffeeCard.jpeg', '2024-03-22 06:40:00'),
(13, 'Golden Latte', 4000.00, 'ginger', 'A Golden Latte is a coffee made with a latte base, turmeric, ginger, and other spices. It is a creamy, aromatic coffee characterized by its smooth, velvety texture and warm, spicy flavour. A Golden Latte is made with about 3 ounces (90 millilitres) of espresso, 9 ounces (270 millilitres) of steamed milk, and a blend of spices, such as turmeric, ginger, cinnamon, and black pepper.', 'images (72).jpeg', '2024-03-22 06:41:12'),
(14, 'Irish Coffee', 6000.00, 'sugar', 'Irish Coffee is a coffee made by adding Irish whiskey, sugar, and whipped cream to a cup of hot coffee. Irish Coffee is traditionally served in a tall, stemmed glass, often garnished with a sprinkle of ground cinnamon or a twist of orange peel for extra flavour.', 'images (78).jpeg', '2024-03-22 06:42:27'),
(15, 'Cold Brew', 3500.00, 'cold water', 'Cold brew is a coffee prepared by steeping ground beans in cold water for an extended period, usually 12-24 hours. It is a refreshing, smooth-tasting coffee characterized by its low acidity and rich, full-bodied flavour. Cold brew coffee is made by placing ground coffee beans in a container, such as a jar or a pitcher, and adding cold water to the beans.', 'images (74).jpeg', '2024-03-22 06:44:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `useraddress` longtext DEFAULT NULL,
  `userphone` varchar(11) DEFAULT NULL,
  `userpassword` varchar(250) DEFAULT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `useraddress`, `userphone`, `userpassword`, `reg_date`) VALUES
(1, 'Apdoolmajeed Hamza', 'Katsina State, Rimi Local Government, S/Unguwa, Opposite AMADI Rimi Memorial Islamic School', '08138028142', '$2y$10$kN.s4wHEugtOXptONUPLOO0VKDda3zgcMKNFslxm18T2DkWHxZEd6', '2024-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `users_order`
--

CREATE TABLE `users_order` (
  `id` int(11) NOT NULL,
  `userid` varchar(250) DEFAULT NULL,
  `productid` varchar(250) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_order`
--

INSERT INTO `users_order` (`id`, `userid`, `productid`, `quantity`, `orderDate`) VALUES
(1, '1', '2', 1, '2024-03-24 02:26:13'),
(2, '1', '6', 1, '2024-03-24 02:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userid`, `productid`, `postingDate`) VALUES
(2, 1, 9, '2024-03-24 02:24:49'),
(3, 1, 15, '2024-03-24 02:25:09'),
(4, 1, 8, '2024-03-24 02:25:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_order`
--
ALTER TABLE `users_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_order`
--
ALTER TABLE `users_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
