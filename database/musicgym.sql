-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2015 at 08:25 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `musicgym`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Gibson'),
(2, 'Epiphone'),
(4, 'Fender'),
(7, 'Korg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(25, 'Guitars and Basses', 0),
(26, 'Drums', 0),
(27, 'Keys', 0),
(28, 'DJ', 0),
(29, 'Microphones', 0),
(31, 'Electric Guitars', 25),
(33, 'Electric Basses', 25),
(34, 'Acoustic Guitars', 25),
(35, 'Acoustic Basses', 25),
(36, 'Acoustic Drums', 26),
(37, 'Electronic Drums', 26),
(38, 'Sticks and Mallets', 26),
(39, 'Orchestral Percussion', 26),
(40, 'Keyboards', 27),
(41, 'Synthetizers', 27),
(42, 'MIDI Keyboards', 27),
(43, 'Complete DJ Sets', 28),
(44, 'DJ Soft and Hardware', 28),
(45, 'Vocal Microphones', 29),
(46, 'Instrument Microphones', 29),
(48, 'Studio', 0),
(49, 'Audio Interfaces', 48);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `list_price` decimal(10,0) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `deleted`, `quantity`) VALUES
(1, 'Gibson LP Less', '1390', '1500', 1, '31', '/site/images/products/Electric Guitar Gibson LP Less.jpg', 'Gibson Les Paul Less+ HCS 2015, electric guitar, G-Force tuning system, mahogany body, maple top, mahogany neck, rounded thomann C neck profile, rosewood fretboard, trapez inlays, 22 frets, 628mm scale, 46mm nut width, 1x 57 Classic and 57 Plus humbuckers, toggle switch, 2x volume and 1x tone controls, mini toggle coil split, nickel Tune-o-Matic bridge, finish: heritage cherry sunburst, incl. case, incl. thomann G-Force charger', 1, 0, 2),
(2, 'Epiphone Les Paul', '318', '400', 2, '31', '/site/images/products/Electric Guitar Epiphone Les Paul Standard.jpg', 'Epiphone Les Paul Standard Ebony , electric guitar, mahognay body, mahogany neck, rosewood fretboard, 42,67 mm saddle width, thomann 628 mm scale lenght, 2x alnico classic humbucking pick-ups, Grover tuners, chrome hardware, trapez inlays, colour: ebony', 1, 0, 3),
(6, 'test', '466', '677', 2, '33', '/site/images/products/755ffad90b2d702a54890aaa4102b470.jpg', 'ergerhreh', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(1, 'Alex Bratu', 'alexbratuu@gmail.com', '$2y$10$tytUlkRvKsmsjOOgZV8JGO6IfK0vEC7EvGFvrjm6U12oTYHxttV8W', '2015-11-02 20:36:10', '2015-11-02 00:00:00', 'admin,editor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
