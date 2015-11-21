-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2015 at 05:46 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Gibson'),
(2, 'Epiphone'),
(4, 'Fender'),
(7, 'Korg'),
(8, 'Harley Benton'),
(9, 'Yamaha'),
(10, 'Native Instruments'),
(11, 'Pioneer'),
(12, 'BC Rich'),
(13, 'Ibanez'),
(14, 'Pearl');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expire_date`, `paid`) VALUES
(1, '[{"id":"1","quantity":"1"},{"id":"2","quantity":"2"}]', '2015-12-18 18:28:50', 1),
(3, '[{"id":"2","quantity":"1"}]', '2015-12-18 18:51:34', 1),
(4, '[{"id":"2","quantity":"3"},{"id":"1","quantity":"2"}]', '2015-12-18 19:01:08', 1),
(5, '[{"id":"2","quantity":"3"},{"id":"1","quantity":"2"}]', '2015-12-18 19:07:44', 1),
(6, '[{"id":"2","quantity":"1"}]', '2015-12-21 12:01:32', 1),
(9, '[{"id":"1","quantity":"1"},{"id":"2","quantity":"2"}]', '2015-12-21 13:43:50', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `deleted`, `quantity`) VALUES
(1, 'Gibson LP Less', '1390', '1500', 1, '31', '/site/images/products/Electric Guitar Gibson LP Less.jpg', 'Gibson Les Paul Less+ HCS 2015, electric guitar, G-Force tuning system, mahogany body, maple top, mahogany neck, rounded thomann C neck profile, rosewood fretboard, trapez inlays, 22 frets, 628mm scale, 46mm nut width, 1x 57 Classic and 57 Plus humbuckers, toggle switch, 2x volume and 1x tone controls, mini toggle coil split, nickel Tune-o-Matic bridge, finish: heritage cherry sunburst, incl. case, incl. thomann G-Force charger', 1, 0, 2),
(2, 'Epiphone Les Paul', '319', '400', 2, '31', '/site/images/products/Electric Guitar Epiphone Les Paul Standard.jpg', 'Epiphone Les Paul Standard Ebony , electric guitar, mahognay body, mahogany neck, rosewood fretboard, 42,67 mm saddle width, thomann 628 mm scale lenght, 2x alnico classic humbucking pick-ups, Grover tuners, chrome hardware, trapez inlays, colour: ebony', 1, 0, 2),
(6, 'test', '466', '677', 2, '33', '/site/images/products/755ffad90b2d702a54890aaa4102b470.jpg', 'ergerhreh', 0, 1, 2),
(7, 'Fender Special Strat', '1049', '1100', 4, '31', '/site/images/products/92b58e5028ce7cd60bcf1af2e31ad9aa.jpg', 'Fender American Special Stratocaster HSS OW e-guitar, alder body, maple neck, modern C-shape, rosewood fretboard, 22 jumbo frets, thomann scale 648mm, nut width 42.8mm,', 1, 0, 3),
(8, 'Harley Benton DC580', '129', '150', 8, '31', '/site/images/products/2b92de0b28561e923f8389e4b94a5893.jpg', 'Harley Benton DC-580 CH Vintage Series, electric guitar, basswood body, set C-shape canadian maple neck, rosewood fretboard, fretboard thomann radius 350mm, crown inlays', 1, 0, 5),
(9, 'Korg Pro King', '899', '1000', 7, '41', '/site/images/products/d9e466cd28135e09536c23a5bdf7e948.jpg', 'Korg King Korg, Analog Modeling Synthesizer, 61-Tasten semi-weighted Keyboard Velocity-sensitive, 24-Voices Polyphony, XMT (eXpanded Modeling Technology), 300 Presets thomann (200 Factory + 100 User)', 1, 0, 1),
(10, 'Yamaha DTX400K', '449', '500', 9, '37', '/site/images/products/7ebd67e8fe79dbfa2a1e0841ef26de0d.jpg', 'Yamaha DTX400K E-Drum Set, for beginners with silent kick pedal KU100, DTX400 drum module with 169 sounds, 10 drum thomann kits, metronome, 10 coaching programs, 10 songs, stereo 1/4&quot; jack headphones/output, stereo 1/8&quot; jack Aux In', 1, 0, 3),
(11, 'Traktor Kontrol D2', '489', '550', 10, '44', '/site/images/products/7c3f3ac1e455d41c08e493ee86f69a07.jpg', 'Native Instruments Traktor Kontrol D2, DJ Controller for Traktor-Software with high Resolution Color Display, 14 touch sensitive Controller, thomann 8 Multi-Color-Pads for Sample Playback, Cue-Points, Loops or Beat-Jumps, Touch-Strip, 4 touch sensitive Remix Deck-Fader and Rotary Knobs, FX-Unit with more than 30 Studio-Effects and Macros', 1, 0, 2),
(12, 'Pioneer XDJ-R1', '928', '1000', 11, '43', '/site/images/products/885170f569592f9f6c74b2091c6442d5.jpg', 'ioneer XDJ-R1, all in one DJ System, Double CD/USB Player, Remote Control via iPad, iPhone or iPod Touch, Jog thomann Wheels, 2 Channel Mixer, with Switches for Loops, HotCues, Samples and Sound Colour FX, DJ Software Recordbox included, dimensions 623 x 308 x 107mm, weight 6,8 Kg, Optional Bag', 1, 0, 1),
(13, 'Mockingbird ST TR', '539', '600', 12, '31', '/site/images/products/abc36f70acbdae382d7599a7e1c3fce3.jpg', 'BC Rich Mockingbird ST Slash TR, e-guitar, mahogany body, AAA quilted maple veneer neck, ebony fingerboard, 24 jumbo thomann frets, Floyd Rose 1000 series tremolo, 2x duncan designed humbucker pick-ups', 1, 0, 2),
(14, 'BC Rich JRV 7', '660', '700', 12, '31', '/site/images/products/a6b71a7ac68c1929cc643fe10e954be9.jpg', 'BC Rich JRV 7 TP, 7 string E-Guitar, Mahogany Body, Neck thru Maple Neck, Ebony Fretboard, 24 Frets, Scale thomann 648mm, 2 BC Rich B.D.S.M. Humbucker Pickups, Floyd Rose Tremolo Original, Grover Mini Rotomatic Tuners, Black HArdware, Finish Trans Purple', 0, 0, 2),
(15, 'Fender Special Tele', '888', '1100', 4, '31', '/site/images/products/7bae32fbd195458b7efb08b0d1f71760.jpg', 'Fender American Special Telecaster Electric Guitar - alder body, modern &#039;C&#039; shape maple neck, 22 jumbo frets, 648mm thomann scale, 43mm nut width, chrome hardware, vintage style 3-saddle strings-thru-body Tele bridge, 2x Texas Special single coil pickups, 3-way switch, Greasebucket tone circuit', 0, 0, 1),
(16, 'Fender SQ VM', '369', '400', 4, '33', '/site/images/products/0550d777390dcc2e2e01fa8cbea52215.jpg', '', 1, 0, 3),
(17, 'Squier Affinity P-Bass', '288', '300', 4, '33', '/site/images/products/d4a27a0099c221ba4393787b92fca0da.jpg', 'Fender Squier Affinity P-Bass PJ OWT 2013, Affinity series, bass guitar, 4-string, alder body, maple neck (&quot;C&quot;-shape), longscale, thomann rosewood fretboard, 20 Medium Jumbo frets,', 0, 0, 3),
(18, 'Yamaha C40', '109', '150', 9, '34', '/site/images/products/5b6ab8c432ba430a0ee06a80f3b72b15.jpg', 'Yamaha C40 classical guitar, spruce top, meranti back &amp; sides, nato neck, rosewood fretboard, rosewood bridge, 52 mm thomann sadddle width, 49-100 mm body depth, 650mm/25.59&quot; scale leght', 1, 0, 5),
(19, 'Ibanez PCBE12', '225', '300', 13, '35', '/site/images/products/031d0b504ec4b5277b6b0f78a1f5b67e.jpg', 'Ibanez PCBE12-OPN, acoustic bass, spruce top, mahogany back &amp; sides, maple neck, rosewood bidge &amp; fretboard, 20 frets, thomann 32&quot; long scale, 43mm nut width, tortoiseshell rosette, chrome tuners, Ibanez under saddle pickup &amp; AEQ-2T preamp with tuner', 0, 0, 2),
(20, 'Pearl EXX725BR', '749', '800', 14, '36', '/site/images/products/c3f2b0ef593d9dc25212ae8669ac9c3b.jpg', 'Pearl Export Standard Set - Jet Black #31, EXX725BR/C, Standard Version , wrapped shells in colour: Jet Black thomann (#31), chrome shell hardware, blended Asian Mahogany/Poplar shells for deeper and richer sound', 1, 0, 3),
(21, 'Yamaha PSR-S770', '1049', '1100', 9, '40', '/site/images/products/61bfc1e880f059a2834d57ea07d6d961.jpg', 'Yamaha PSR-S770 Keyboard - 61 touch-responsive keys, 1346 sounds, 360 styles, 128-note polyphoniy, GM2/GS sound compatible, Mic/Guitar Input, thomann Drum Setup Function, DJ Styles, Real-Time Live Controllers and Arpeggio-Function, 160 MB internal expansion store, DSP Technology with Real Distortion and Real Reverb', 0, 0, 2),
(22, 'Komplete Kontrol S61', '589', '600', 10, '42', '/site/images/products/5e64cfc05acf2c4fce5fbc29aeb6de8f.jpg', 'Native Instruments Komplete Kontrol S61, Controller-Keyboard for NI Komplete 9 and 10, 61 Keys Fatar-Keyboard, automatic assignment oft thomann the Main Parameters of each Komplete-Instrument to the Touchsensitive Rotary Knobs via Native Map, create Arpeggios, Accords or Scales from single Notes, multi-color Light-Guide Key lighting, Clear-View-Display, extended Touch-Strip-Functions', 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charge_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cart_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `grand_total` decimal(10,0) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `txn_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(3, 'Test Testo', 'test@test.com', '$2y$10$C01Q.7sNGzRsKFcM4MTyceMtcqrfnlS91vMaCk83WRCwmvItp70fK', '2015-11-07 18:03:42', '2015-11-07 17:12:57', 'editor,admin'),
(4, 'Alex Bratu', 'alexbratuu@gmail.com', '$2y$10$0QoGdYw1PXDJkHdCF7aaS.OaUcOTVnP3RU/7hfSGSzGxyGHF.dbMe', '2015-11-07 18:13:38', '2015-11-21 14:22:05', 'admin,editor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
