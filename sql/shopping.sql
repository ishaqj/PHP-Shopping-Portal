-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 12 dec 2016 kl 17:28
-- Serverversion: 5.6.17
-- PHP-version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `shopping`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `categories`
--

INSERT INTO `categories` (`id`, `cat_name`) VALUES
(1, 'Dator'),
(2, 'TV');

-- --------------------------------------------------------

--
-- Tabellstruktur `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumpning av Data i tabell `images`
--

INSERT INTO `images` (`id`, `image`, `product_id`) VALUES
(21, 'http://tubby.scene7.com/is/image/tubby/22FB3113?$prod_all4one$', 40),
(22, 'http://tubby.scene7.com/is/image/tubby/22FB3113_2?$prod_all4one$', 40),
(23, 'http://tubby.scene7.com/is/image/tubby/22FB3113_1?$prod_all4one$', 40),
(24, 'http://tubby.scene7.com/is/image/tubby/UE60J6285XXE?$prod_all4one$', 41),
(25, 'http://tubby.scene7.com/is/image/tubby/UE60J6285XXE_2?$prod_all4one$', 41),
(26, 'http://tubby.scene7.com/is/image/tubby/UE60J6285XXE_1?$prod_all4one$', 41),
(27, 'http://tubby.scene7.com/is/image/tubby/UE65KS7005XXE?$prod_all4one$', 42),
(28, 'http://tubby.scene7.com/is/image/tubby/UE65KS7005XXE_3?$prod_all4one$', 42),
(29, 'http://tubby.scene7.com/is/image/tubby/UE65KS7005XXE_2?$prod_all4one$', 42),
(30, 'http://tubby.scene7.com/is/image/tubby/UE65KS7005XXE_1?$prod_all4one$', 42),
(31, 'http://tubby.scene7.com/is/image/tubby/OLED55B6V?$prod_all4one$', 43),
(32, 'http://tubby.scene7.com/is/image/tubby/OLED55B6V_6?$prod_all4one$', 43),
(33, 'http://tubby.scene7.com/is/image/tubby/OLED55B6V_5?$prod_all4one$', 43),
(34, 'http://tubby.scene7.com/is/image/tubby/OLED55B6V_4?$prod_all4one$', 43),
(35, 'http://tubby.scene7.com/is/image/tubby/OLED55B6V_3?$prod_all4one$', 43),
(36, 'http://tubby.scene7.com/is/image/tubby/OLED55B6V_2?$prod_all4one$', 43),
(37, 'http://tubby.scene7.com/is/image/tubby/OLED55B6V_1?$prod_all4one$', 43),
(38, 'http://tubby.scene7.com/is/image/tubby/ACDGB1MEQ002?$prod_all4one$', 44),
(39, 'http://tubby.scene7.com/is/image/tubby/ACDGB1MEQ002_1?$prod_all4one$', 44),
(40, 'http://tubby.scene7.com/is/image/tubby/ACDGB1MEQ002_2?$prod_all4one$', 44),
(41, 'http://tubby.scene7.com/is/image/tubby/ACDGB1MEQ015?$prod_all4one$', 45),
(42, 'http://tubby.scene7.com/is/image/tubby/ACDGB1MEQ015_3?$prod_all4one$', 45),
(43, 'http://tubby.scene7.com/is/image/tubby/ACDGB1MEQ015_2?$prod_all4one$', 45),
(44, 'http://tubby.scene7.com/is/image/tubby/ACDGB1MEQ015_1?$prod_all4one$', 45),
(45, 'http://tubby.scene7.com/is/image/tubby/MSIAEGISX025?$prod_all4one$', 46),
(46, 'http://tubby.scene7.com/is/image/tubby/MSIAEGISX025_6?$prod_all4one$', 46),
(47, 'http://tubby.scene7.com/is/image/tubby/MSIAEGISX025_5?$prod_all4one$', 46),
(48, 'http://tubby.scene7.com/is/image/tubby/MSIAEGISX025_4?$prod_all4one$', 46),
(49, 'http://tubby.scene7.com/is/image/tubby/MSIAEGISX025_3?$prod_all4one$', 46),
(50, 'http://tubby.scene7.com/is/image/tubby/MSIAEGISX025_2?$prod_all4one$', 46),
(51, 'http://tubby.scene7.com/is/image/tubby/MSIAEGISX025_1?$prod_all4one$', 46),
(52, 'http://tubby.scene7.com/is/image/tubby/ACNXSHGED001?$prod_all4one$', 47),
(53, 'http://tubby.scene7.com/is/image/tubby/ACNXSHGED001_1?$prod_all4one$', 47),
(54, 'http://tubby.scene7.com/is/image/tubby/ACNXSHGED001_2?$prod_all4one$', 47),
(55, 'http://tubby.scene7.com/is/image/tubby/ACNHQ19ED002?$prod_all4one$', 48),
(56, 'http://tubby.scene7.com/is/image/tubby/ACNHQ19ED002_7?$prod_tnm$', 48),
(57, 'http://tubby.scene7.com/is/image/tubby/ACNHQ19ED002_6?$prod_tnm$', 48),
(58, 'http://tubby.scene7.com/is/image/tubby/ACNHQ19ED002_5?$prod_all4one$', 48),
(59, 'http://tubby.scene7.com/is/image/tubby/ACNHQ19ED002_4?$prod_all4one$', 48),
(60, 'http://tubby.scene7.com/is/image/tubby/ACNHQ19ED002_3?$prod_all4one$', 48),
(61, 'http://tubby.scene7.com/is/image/tubby/ACNHQ19ED002_2?$prod_all4one$', 48),
(62, 'http://tubby.scene7.com/is/image/tubby/ACNHQ19ED002_1?$prod_all4one$', 48),
(63, 'http://tubby.scene7.com/is/image/tubby/LE90FL002UMW?$prod_all4one$', 49),
(64, 'http://tubby.scene7.com/is/image/tubby/LE90FL002UMW_5?$prod_all4one$', 49),
(65, 'http://tubby.scene7.com/is/image/tubby/LE90FL002UMW_4?$prod_all4one$', 49),
(66, 'http://tubby.scene7.com/is/image/tubby/LE90FL002UMW_3?$prod_all4one$', 49),
(67, 'http://tubby.scene7.com/is/image/tubby/LE90FL002UMW?$prod_all4one$', 49),
(68, 'http://tubby.scene7.com/is/image/tubby/LE90FL002UMW_1?$prod_all4one$', 49),
(69, 'http://tubby.scene7.com/is/image/tubby/OLED77G6V?$prod_all4one$', 50),
(70, 'http://tubby.scene7.com/is/image/tubby/OLED77G6V_5?$prod_all4one$', 50),
(71, 'http://tubby.scene7.com/is/image/tubby/OLED77G6V_4?$prod_all4one$', 50),
(72, 'http://tubby.scene7.com/is/image/tubby/OLED77G6V_3?$prod_all4one$', 50),
(73, 'http://tubby.scene7.com/is/image/tubby/OLED77G6V_2?$prod_all4one$', 50),
(74, 'http://tubby.scene7.com/is/image/tubby/OLED77G6V_1?$prod_all4one$', 50),
(77, 'http://tubby.scene7.com/is/image/tubby/86UH955V?$prod_all4one$', 53),
(78, 'http://tubby.scene7.com/is/image/tubby/86UH955V_4?$prod_all4one$', 53),
(79, 'http://tubby.scene7.com/is/image/tubby/86UH955V_3?$prod_all4one$', 53),
(80, 'http://tubby.scene7.com/is/image/tubby/86UH955V_2?$prod_all4one$', 53),
(81, 'http://tubby.scene7.com/is/image/tubby/86UH955V_1?$prod_all4one$', 53);

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(18,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `created_at`, `updated`, `price`, `category_id`) VALUES
(40, 'Thomson 22&quot; Full HD TV 22FB3113', '&lt;p&gt;Full HD 1080p uppl&amp;ouml;sning och Pure Image 3 f&amp;ouml;rb&amp;auml;ttring g&amp;ouml;r att denna eleganta Thomson 22&quot; LED-TV &amp;auml;r ett utm&amp;auml;rkt val f&amp;ouml;r b&amp;aring;de kvalitetsunderh&amp;aring;llning och multimedia uppspelning i k&amp;ouml;ket eller barnrummet.&lt;/p&gt;\r\n&lt;ul style=&quot;list-style-type: square;&quot;&gt;\r\n&lt;li&gt;22&quot; LED TV&lt;/li&gt;\r\n&lt;li&gt;Full HD uppl&amp;ouml;sning&lt;/li&gt;\r\n&lt;li&gt;B31 serien, USB&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-09 16:35:10', '2016-11-09 17:11:06', '1295.00', 2),
(41, 'Samsung 60&quot; Full HD Smart TV UE60J6285XXE', '&lt;p&gt;Denna Samsung 60&quot; Full HD Smart TV UE60J6285XXE bidrar till en h&amp;ouml;g niv&amp;aring; av hemmabio-k&amp;auml;nsla direkt i ditt vardagsrum tack vare det intuitiva Tizen-systemet som g&amp;ouml;r det m&amp;ouml;jligt att utforska en v&amp;auml;rld av underh&amp;aring;llning.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;60&quot; LED Smart TV&lt;/li&gt;\r\n&lt;li&gt;Tizen, Full HD&lt;/li&gt;\r\n&lt;li&gt;Vesa 200x200&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-09 23:37:28', '2016-11-09 23:37:28', '7990.00', 2),
(42, 'Samsung 65&quot; 4K UHD Smart TV UE65KS7005', '&lt;p&gt;Samsung UE5KS7005 65&quot; 4K UHD Smart-TV imponerar med Quantom dot display och PQI 2100. Med en design som passar &amp;ouml;verallt i hemmet, kombinerat med bland annat inbyggt Wi-Fi, &amp;auml;r detta en TV som levererar underh&amp;aring;llning p&amp;aring; h&amp;ouml;g niv&amp;aring;.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;65&quot; LED Smart-TV&lt;/li&gt;\r\n&lt;li&gt;Tizen, Samsung SUHD TV&lt;/li&gt;\r\n&lt;li&gt;HDR, PQI 2100, 7-serien&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-09 23:52:23', '2016-11-09 23:52:23', '14990.00', 2),
(43, 'LG 55&quot; 4K UHD OLED Smart TV OLED55B6V', '&lt;p&gt;L&amp;aring;t dig fascineras av LG 55&quot; 4K UHD OLED Smart TV OLED55B6V, en TV-upplevelse med perfekta bilder som om du sj&amp;auml;lv var p&amp;aring; plats, ser fantastisk ut i alla vardagsrum.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;55&quot; OLED Smart TV&lt;/li&gt;\r\n&lt;li&gt;WebOS 3.0, 4K UHD&lt;/li&gt;\r\n&lt;li&gt;HDR, B6V Series&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-10 00:04:15', '2016-11-10 00:04:15', '22990.00', 2),
(44, 'Acer Predator G6-710 StationÃ¤r dator Gaming', '&lt;p&gt;Acer Predator G6-710 &amp;auml;r en station&amp;auml;r dator med mycket kraft, avancerade komponenter och sofistikerat kylsystem som klarar &amp;auml;ven de mest kr&amp;auml;vande spelen utan f&amp;ouml;rdr&amp;ouml;jning.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Nvidia GTX 980Ti, 6 GB&lt;/li&gt;\r\n&lt;li&gt;Intel Core i7-6700K-processor&lt;/li&gt;\r\n&lt;li&gt;1 TB h&amp;aring;rddisk, 128 GB SSD&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-10 00:42:31', '2016-11-10 00:42:31', '23995.00', 1),
(45, 'Acer Predator G6-710 StationÃ¤r dator gaming', '&lt;p&gt;Acer Predator G6-710 &amp;auml;r en station&amp;auml;r dator med mycket kraft, n&amp;auml;sta generationens Nvidia grafik och sofistikerat kylsystem som klarar &amp;auml;ven de mest kr&amp;auml;vande spel utan f&amp;ouml;rdr&amp;ouml;jning.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Nvidia GTX 1070 FE, 8 GB&lt;/li&gt;\r\n&lt;li&gt;Intel Core i5-6600K-processor&lt;/li&gt;\r\n&lt;li&gt;1 TB h&amp;aring;rddisk + 256 GB SSD&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-10 00:49:40', '2016-11-10 00:49:40', '17995.00', 1),
(46, 'MSI Aegis X-025EU StationÃ¤r dator gaming', '&lt;p&gt;MSI Aegis X Station&amp;auml;ra gaming dator ger dig exceptionell kraft i ett litet chassi. Med Nvidia grafik, uppl&amp;aring;st Intel Core i5 processor och dubbla SSD diskar f&amp;aring;r du en h&amp;auml;rlig spelupplevelse.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Nvidia GTX 1070 Armor 8G&lt;/li&gt;\r\n&lt;li&gt;Intel Core i5-6600K&lt;/li&gt;\r\n&lt;li&gt;16 GB DDR4 RAM, 512 GB SSD&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-10 00:56:42', '2016-11-10 00:56:42', '20995.00', 1),
(47, 'Acer Aspire One Cloudbook 14 BÃ¤rbar dator (grÃ¥)', '&lt;p&gt;Acer Aspire One Cloudbook &amp;auml;r en kompakt b&amp;auml;rbar dator med 14 tum sk&amp;auml;rm som &amp;auml;r l&amp;auml;tt att ta med &amp;ouml;verallt. Inklusive ett &amp;aring;rs abonnemang p&amp;aring; Office 365 Personal.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Intel Celeron N3050-processor&lt;/li&gt;\r\n&lt;li&gt;Med Windows 10 och Office 365&lt;/li&gt;\r\n&lt;li&gt;2 GB RAM, 32 GB flashminne&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-10 00:59:05', '2016-11-10 00:59:05', '2695.00', 1),
(48, 'Acer Predator G9-793 17.3&quot; bÃ¤rbar dator gaming', '&lt;p&gt;N&amp;auml;r du beh&amp;ouml;ver mycket kraft f&amp;ouml;r dina spel kommer Acer Predator G9-793 med 17,3 tums sk&amp;auml;rm vara redo f&amp;ouml;r dig. Med sin Intel Core i5 processor, next gen Nvidia grafikkort och ordentligt med DDR4 RAM kommer datorn prestera bra med &amp;auml;ven kr&amp;auml;vande spel.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Intel Core i7-6700HQ CPU&lt;/li&gt;\r\n&lt;li&gt;Nvidia GTX 1070, 8 GB&lt;/li&gt;\r\n&lt;li&gt;17.3&quot; 4K UHD sk&amp;auml;rm&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-10 14:07:03', '2016-11-10 14:07:03', '24995.00', 1),
(49, 'Lenovo IdeaCentre Y710 Cube StationÃ¤r dator gaming', '&lt;p&gt;Lenovo IdeaCentre Y710 Cube &amp;auml;r en kraftfull speldator i ett litet format. Tack vare en kraftfull 6:e generations Intel Core i5 processor, Nvidia grafik och snabbt DDR4 RAM samt en stor h&amp;aring;rddisk kan du enkelt ta med dig datorn p&amp;aring; LAN partyn.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Intel Core i5-6400 CPU&lt;/li&gt;\r\n&lt;li&gt;Nvidia GTX 1080, 8 GB&lt;/li&gt;\r\n&lt;li&gt;1 TB HDD, 256 GB SSD&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-10 14:09:44', '2016-11-10 14:14:02', '16995.00', 1),
(50, 'LG 77'''' 4K UHD OLED Smart TV OLED77G6V', '&lt;p&gt;M&amp;ouml;t framtiden redan idag. LG 77'''' 4K UHD OLED Smart TV OLED77G6V levererar en otrolig 4K UHD bild kvalitet med HDR p&amp;aring; en transparent glasplatta s&amp;aring; bildens kvalitet m&amp;ouml;ter designen i perfekt harmoni.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;77'''' OLED Smart TV&lt;/li&gt;\r\n&lt;li&gt;4K UHD, HDR&lt;/li&gt;\r\n&lt;li&gt;WebOS 3.0, Series OLED G6&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-10 14:17:16', '2016-11-10 14:17:16', '249990.00', 2),
(53, 'LG 86&quot; 4K UHD Smart-TV 86UH955V', '&lt;p&gt;LG 86UH955V 86&quot; 4K UHD Smart TV ger en unik TV-upplevelse med bilder som om du sj&amp;auml;lv var p&amp;aring; plats, med en uppl&amp;ouml;sning p&amp;aring; 2160p. Inbyggd WiFi tillsammans med WebOS 3.0 ger o&amp;auml;ndliga m&amp;ouml;jligheter.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;86&quot; LED Smart-TV&lt;/li&gt;\r\n&lt;li&gt;WebOS 3.0, 4K UHD&lt;/li&gt;\r\n&lt;li&gt;HDR, UH95-serie&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-11-10 14:28:17', '2016-11-10 14:43:08', '74990.00', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumpning av Data i tabell `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `stock`) VALUES
(36, 40, 100),
(37, 41, 50),
(38, 42, 50),
(39, 43, 100),
(40, 44, 42),
(41, 45, 34),
(42, 46, 45),
(43, 47, 25),
(44, 48, 54),
(45, 49, 24),
(46, 50, 34),
(49, 53, 37);

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Restriktioner för tabell `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Restriktioner för tabell `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
