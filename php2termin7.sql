-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2018 at 11:46 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php2termin7`
--

-- --------------------------------------------------------

--
-- Table structure for table `galerija`
--

CREATE TABLE `galerija` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slika_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `galerija`
--

INSERT INTO `galerija` (`id`, `title`, `description`, `slika_id`) VALUES
(1, 'C#', 'C# logo', 6),
(2, 'Laravel', 'laravel logo', 7),
(3, 'PHP', 'php logo', 8),
(4, 'JS', 'js logo', 9),
(5, 'HTML5', 'html5 logo', 10),
(6, 'CSS3', 'css3 logo', 11);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(50) NOT NULL,
  `korisnicko_ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uloga_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `korisnicko_ime`, `lozinka`, `email`, `uloga_id`) VALUES
(6, 'gzuz', '5fc685faa53475ba3cdb84bb3cab833f', 'gzuz@187.de', 1),
(11, 'bonezmc', '42f749ade7f9e195bf475f37a44cafcb', 'bonez@187.de', 2);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id` int(50) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id`, `naziv`, `link`) VALUES
(1, 'Home', '/'),
(2, 'Galerija', 'gallery'),
(3, 'O autoru', 'autor');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(50) NOT NULL,
  `naslov` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sadrzaj` text COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slika_id` int(255) NOT NULL,
  `korisnik_id` int(255) NOT NULL,
  `created_at` int(255) DEFAULT NULL,
  `updated_at` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `naslov`, `sadrzaj`, `video`, `slika_id`, `korisnik_id`, `created_at`, `updated_at`) VALUES
(1, 'Laravel Tutorial EP 1', 'In this video I will talk about what Laravel is and also give you a demo of what we will be building. Laravel is the most popular open source PHP framework and uses the MVC (Model View Controller) design pattern. We will be covering all of the fundamentals of Laravel 5.4 in this series including....\r\n', 'https://www.youtube.com/embed/watch?v=EU7PRmCpx-0', 1, 11, 1518403216, NULL),
(2, 'C# Tutorial EP 1', 'You guys asked for it and here I begin my large C# tutorial which will eventually cover Xamarin and game development. We start by covering how to install Visual Studio and Xamarin. Then we look at Namespaces, Main, Input, Output, Loops, Command Line Arguments, Arrays, Data Types, DateTime, TimeSpan, BigInteger, Formatting, Strings, String Functions, Functions and much more.\r\n', 'https://www.youtube.com/embed/watch?v=0p0JLFZj2C8', 2, 11, 1518403247, NULL),
(3, 'Laravel Tutorial EP 2', 'In this video we will setup our environment. We will be using XAMPP which gives us an Apache server with PHP and MySQL. We will install Laravel with Composer and we will be using the Git Bash terminal and integrate it with Visual Studio Code\r\n', 'https://www.youtube.com/embed/watch?v=H3uRXvwXz1o', 1, 11, 1518403602, NULL),
(4, 'C# Tutorial EP 2', 'In this part of my C# tutorial I cover Implicit Typing, Casting, For, For Each and Arrays and StringBuilder in vast detail. For best results take notes on the cheat sheet provided above as you watch and leave any questions you have.\r\n', 'https://www.youtube.com/embed/watch?v=bBG2o905sRQ', 2, 11, 1521303895, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE `slika` (
  `id` int(50) NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slika`
--

INSERT INTO `slika` (`id`, `alt`, `putanja`) VALUES
(1, 'Post 1', 'images/lartut.png'),
(2, 'Post 2', 'images/cstut.png'),
(3, 'Materijali', 'images/post3.jpg'),
(5, 'C# Post', 'images/5.png\r\n'),
(6, 'C#', 'images/6.png\r\n'),
(7, 'Laravel', 'images/7.png'),
(8, 'PHP', 'images/8.png\r\n'),
(9, 'JS', 'images/9.png\r\n'),
(10, 'HTML5', 'images/10.png'),
(11, 'CSS3', 'images/11.png'),
(14, 'C#', 'images/1521317873.png'),
(15, 'tutorijal gallery', 'images/1521413748_AM9.png'),
(16, 'tutorijal gallery', 'images/1521413808_AM9.png'),
(17, 'tutorijal gallery', 'images/1521413832_AM9.png'),
(18, 'tutorijal gallery', 'images/1521416049_slider1.jpg'),
(19, 'tutorijal gallery', 'images/1521416140_slider1.jpg'),
(26, 'alt', 'images/1521424526.jpg'),
(27, 'alt', 'images/1521424551.jpg'),
(28, 'qqqq', 'images/1521424881.jpg'),
(29, 'aaaaa', 'images/1521424922.jpg'),
(30, 'aaaa', 'images/1521425093.jpg'),
(33, 'blog gallery', 'images/1521427673_img7.jpg'),
(51, 'blog gallery', 'images/1521428704_4.png'),
(52, 'blog gallery', 'images/1521428710_5.png'),
(53, 'blog gallery', 'images/1521428719_3.jpg'),
(54, 'blog gallery', 'images/1521428747_1521428704_4.png'),
(55, 'blog gallery', 'images/1521428754_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` int(50) NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'admin'),
(2, 'korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galerija`
--
ALTER TABLE `galerija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slika`
--
ALTER TABLE `slika`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galerija`
--
ALTER TABLE `galerija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `slika`
--
ALTER TABLE `slika`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
