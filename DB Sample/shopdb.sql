-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 30, 2024 at 11:28 PM
-- Server version: 8.2.0
-- PHP Version: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int NOT NULL COMMENT 'ID of the entry',
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Name of the entry',
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Content to show in the entry',
  `position` int NOT NULL COMMENT 'Used to establish the display order'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `name`, `content`, `position`) VALUES
(1, 'Our Philosophy', 'Meet Spa is the ideal place for anyone looking for a relaxing experience. The environment at our spa is friendly and elegant. We believe that every person wants to look and feel beautiful, to relax and unwind, and to be able to escape their everyday lives.', 1),
(2, 'Our Mission', 'To help you maintain a beautiful and healthy skin and an optimal scalp that looks and feels young and lush.', 2),
(3, 'Our Services', 'Customized Clinical Facials<br>Head Scalp Treatments<br>Free Consultations', 3);

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int NOT NULL COMMENT 'ID of the account',
  `email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'E-mail of the account holder',
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Hash of the password',
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user' COMMENT 'Permissions for the account	',
  `api_key` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'API key for the user',
  `reset_code` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `fname`, `lname`, `role`, `api_key`, `reset_code`) VALUES
(1, 'meetspa23@gmail.com', '0ec1555f60ae5ce7189344177dad53ff7453baec30ae16e6f2b9fdc6105576633c70d5b6021ee08a05253d2204d9282a154d086077a0bba3eb469a3797a4a4b7', 'Bella', 'Pu', 'admin', NULL, NULL),
(2, 'pianistapr@hotmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Jorge', 'Pabón', 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_policies`
--

CREATE TABLE `business_policies` (
  `id` int NOT NULL COMMENT 'ID of the policy',
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Name of the policy',
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Test of the policy',
  `position` int NOT NULL COMMENT 'The order in which they are displayed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `business_policies`
--

INSERT INTO `business_policies` (`id`, `name`, `content`, `position`) VALUES
(1, 'Payments', 'All major credit cards are accepted. We do not accept any personal or traveler\'s checks. Any gift cards, vouchers, or certificates must be mentioned at time of booking.', 1),
(2, 'Refunds', 'There are no refunds for any service, series or product. Unopened products in original, undamaged packaging can be returned within 14 days for store credit when accompanied with a receipt. Spa series of treatments and gift certificates can be exchanged for credit only to be used toward other products or services.', 2),
(3, 'Reservations', 'All spa services are available by appointment. We recommend scheduling your appointment as far in advance as possible to ensure availability. Walk-ins are based on availability. Any gift cards, vouchers, or certificates must be mentioned at time of booking. For parties of 3 and larger or any spa package, we require a credit card or gift certificate number.', 3),
(4, 'Check In', 'If you are a first time client, we suggest that you arrive 10 minutes before your appointment. This will allow ample time for a skin consultation necessary to customize treatments to your personal needs and to complete a profile before your service.', 4),
(5, 'Late Arrivals', 'Late arrivals will not receive an extension of scheduled service.', 5),
(6, 'Cancellations', 'We require 24 hours advance notice in order to cancel or change any service with no charge. If you do not notify us of the cancellation 24 hours prior to your spa treatment, you are subject to a $15 charge for each service that would have been rendered. This policy also applies to gift card, voucher, or certificate holders.', 6),
(7, 'Gift Certificates', 'All gift certificates must be mentioned and approved prior to making your appointment.', 7),
(8, 'Promotions / Offers', 'Spa promotions cannot be used or combined with any other offer, promotion, or third party gift certificate.', 8),
(9, 'Loss or Damage', 'For the protection of your clothing, we recommend wearing the robe provided. We cannot be responsible for any loss or damage of personal items.', 9),
(10, 'Cell Phones', 'We ask that you please mute cell phones during your visit. Please maintain conversations at a considerate volume in all spa areas.', 10),
(11, 'Health Conditions', 'Please advise us at time of booking of any health conditions, allergies, injuries, pregnancy or special needs that may affect your services.', 11),
(12, 'Cleanliness', 'For your safety and health we are committed to the highest standards of cleanliness. All equipment is sterilized and sanitized after every service and treatment.', 12),
(13, 'Gratuities', 'All services do not include gratuity but a cash gratuity of 15-20% of each service price is appropriate and appreciated. However, the gratuity you leave is entirely based on your satisfaction.', 13);

-- --------------------------------------------------------

--
-- Table structure for table `home_carousel`
--

CREATE TABLE `home_carousel` (
  `id` int NOT NULL COMMENT 'ID of the slide',
  `bg_color` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Background color',
  `image_source` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'URI of the image',
  `image_alt_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Alternate text for the image',
  `top_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Starter line',
  `middle_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Headline',
  `lower_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Tagline',
  `url` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Where we redirect'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Holds the contents of the home hero carousel';

--
-- Dumping data for table `home_carousel`
--

INSERT INTO `home_carousel` (`id`, `bg_color`, `image_source`, `image_alt_text`, `top_text`, `middle_text`, `lower_text`, `url`) VALUES
(1, 'f5b1b0', '/images/home-slider/01.png', 'Head Spa', 'Hurry up! Limited time offer.', 'Head Spa', 'Head Spa, Scalp Treatments & much more...', '/Services/Catalog'),
(2, '3aafd2', '/images/home-slider/04.png', 'Masks', 'Has just arrived!', 'Casmara\'s Best Hydration', 'Pamper your skin with Ocean Miracle...', '/Services/Catalog'),
(3, 'eba170', '/images/home-slider/03.jpg', 'Facials', 'Rejuvenate with', 'RF Firming Facials', 'Skin specific and customized facials...', '/Services/Catalog');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int NOT NULL COMMENT 'ID of the location',
  `address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Address of the business',
  `city` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'City of the business',
  `state` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'State of the business',
  `zip` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Zipcode of the business',
  `country` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Country of the business',
  `phone` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Phone to call when clicking (no spaces)',
  `phone_pretty` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Phone in its readable form',
  `email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Email of the business',
  `latitude` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Latitude for maps',
  `longitude` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Longitude for maps',
  `photo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Photo URI'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `address`, `city`, `state`, `zip`, `country`, `phone`, `phone_pretty`, `email`, `latitude`, `longitude`, `photo`) VALUES
(1, '2301 Columbia Pike Ste. E', 'Arlington', 'VA', '22204', 'USA', '15716996891', '1 (571) 699-6891', 'meetspa23@gmail.com', '38.8639129', '-77.0831426', '/images/locations/Arlington-1.jpg'),
(2, '11428 Belvedere Vista Ln', 'Bon Air', 'VA', '23235', 'USA', '15716996891', '1 (571) 699-6891', 'meetspa23@gmail.com', '37.5221196', '-77.6087645', '/images/locations/Arlington-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL COMMENT 'ID of the service',
  `category` int NOT NULL COMMENT 'Category of this service',
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Name of the service',
  `price` text NOT NULL COMMENT 'Price of the service',
  `steps` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Steps involved in the service',
  `addons` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'IDs of applicable addons from Addons table',
  `duration` int NOT NULL COMMENT 'Duration of the service',
  `locations` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Locations where the service is available',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Description of the service',
  `image_one` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Image URI',
  `image_one_description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Image description',
  `image_two` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Image URI',
  `image_two_description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Image description',
  `image_three` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Image URI',
  `image_three_description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Image description'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category`, `name`, `price`, `steps`, `addons`, `duration`, `locations`, `description`, `image_one`, `image_one_description`, `image_two`, `image_two_description`, `image_three`, `image_three_description`) VALUES
(1, 1, 'Basic RF Firming Facial', '60.00', 'Cleansing\nExfoliation\nRadio Frequency Firming\nCold Mask', '1,2,3', 30, '1,2', 'The classic approach in sustaining a clear and renewed complexion. Our Basic RF Firming Facial is designed for all skin types. It comprises gentle cleansing and exfoliation followed by the RF firming treatment which uses radio frequency waves to penetrate the skin\'s surface and activates collagen production. The treatment concludes with a skin-specific cold mask.', '/images/services/01.png', 'Something', '/images/services/01.png', 'Something', '/images/services/03.png', 'Something'),
(2, 1, 'Classic RF Firming Facial', '119.00', '', '', 45, '1,2', 'Our Classic build upon the Basic by adding a facial massage before the Radio Frequency treatment and cooling/heating after the Radio Frequency treatment to lock in nutrients, achieving firming and anti-aging effects.', '/images/services/01.png', 'Something', '/images/services/01.png', 'Something', '/images/services/03.png', 'Something'),
(3, 1, 'Deep Pore Detox Facial', '125.00', '', '', 60, '1,2', 'Clarify and treat your skin to a detox with our Deep Pore Detox facial.  This facial is targeted to breakout-prone, congested skin that is in need of a deep cleanse. It starts with an activated charcoal mask to open the pores and pepare your skin for a thorough extraction, which follows. The PCA Detox gel is used to purify and control oil with a combination of lactic, glycolic, and salicylic acids. This intensive treatment concludes with a soothing cold mask to restore hydration, tighten pores, and calm your skin.', '/images/services/01.png', 'Something', '/images/services/01.png', 'Something', '/images/services/03.png', 'Something'),
(4, 1, 'Acne Clarifying Facial', '135.00', '', '', 60, '1,2', 'Say goodbye to breakouts and congestion with our Acne Clarifying facial that will introduce you to healthy, clear skin. It starts with a gentle cleansing and exfoliation before a therapeutic and thorough extraction that is accompanied by steam to help open the pores up. The high frequency treatment follows to eradicate bacteria, prevent blemish, scarring, and close pores. Our cold ultrasonic treatment with pore-minimizing serum helps calm down redness and tone skin. The treatment concludes with a cold mask to soothe and hydrate.  Watch your skin change for the better and become clearer with each facial.', '/images/services/01.png', 'Something', '/images/services/01.png', 'Something', '/images/services/03.png', 'Something'),
(5, 1, 'Microdermabrasion Skin Peel', '165.00', '', '', 75, '1,2', 'Microdermabrasion is a distinguished technical form of exfoliation that uses diamond technology to remedy a plethora of skin concerns. This treatment is beneficial in relieving congested pores, balancing out an uneven skin tone, reducing the appearance of acne scars and pigmentation, and smoothing out fine lines and rough skin texture. Also, our cold ultrasonic treatment with serum helps calm down and soothe skin. Ideal for resilient and combination to oily skin types -for sensitive skin looking for similar benefits, the Microdermabrasion facial would be a perfect alternative.', '/images/services/01.png', 'Something', '/images/services/01.png', 'Something', '/images/services/03.png', 'Something'),
(6, 1, 'Collagen Anti-Aging Facial', '220.00', '', '', 90, '1,2', 'Defy aging and dehydration with our Collagen Anti-Aging facial that promotes moisture and collagen growth in your skin. A circulation boosting ultrasonic treatment revitalizes and tones skin with frequency waves and a concentrated collagen serum that seeps into the pores. An intensive gel mask infused with collagen activates skin molecules to tighten and absorb moisture, restoring a naturally radiant and hydrated complexion. Look and feel refreshed, luminous, with hydration, and years younger.', '/images/services/01.png', 'Something', '/images/services/01.png', 'Something', '/images/services/03.png', 'Something'),
(7, 1, 'Thermal Lifting Facial (Partial)', '220.00', '', '', 45, '1,2', 'Our Thermal Lifting facial is a highly effective anti-aging treatment that uses radio frequency and infrared heat to dramatically diminish fine lines and restore elasticity to your skin. It is an advanced and safer alternative to other anti-aging procedures that may be invasive and surgical. Thermal technology speeds up collagen growth in the molecules of your skin (a process called collagen remodeling). You will continue to see results with this treatment as your skin becomes tighter, firmer, and more toned.', '/images/services/01.png', 'Something', '/images/services/01.png', 'Something', '/images/services/03.png', 'Something'),
(8, 1, 'Thermal Lifting Facial (Full Face)', '430.00', '', '', 45, '1,2', 'Our Thermal Lifting facial is a highly effective anti-aging treatment that uses radio frequency and infrared heat to dramatically diminish fine lines and restore elasticity to your skin. It is an advanced and safer alternative to other anti-aging procedures that may be invasive and surgical. Thermal technology speeds up collagen growth in the molecules of your skin (a process called collagen remodeling). You will continue to see results with this treatment as your skin becomes tighter, firmer, and more toned.', '/images/services/01.png', 'Something', '/images/services/01.png', 'Something', '/images/services/03.png', 'Something'),
(9, 2, 'Single Herbal Head Scalp Treatment', '80.00', '', '', 45, '1,2', 'Our Head Scalp Treatment can help you with various scalp and hair problems, such as dryness, itchiness, oiliness, thinning, hair loss, etc. A head scalp treatment can boost your immune system, relieve stress, and promote relaxation by stimulating blood circulation and lymph flow.', '/images/services/02.png', 'Something', '/images/services/02.png', 'Something', '/images/services/02.png', 'Something'),
(10, 2, 'Couples Herbal Head Scalp Treatment', '130.00', '', '', 45, '1,2', 'Our Head Scalp Treatment can help you with various scalp and hair problems, such as dryness, itchiness, oiliness, thinning, hair loss, etc. A head scalp treatment can boost your immune system, relieve stress, and promote relaxation by stimulating blood circulation and lymph flow.', '/images/services/02.png', 'Something', '/images/services/02.png', 'Something', '/images/services/02.png', 'Something'),
(11, 3, 'Basic RF Facial + Scalp Treatment', '140.00', '', '', 75, '1,2', 'Our Head Scalp Treatment can help you with various scalp and hair problems, such as dryness, itchiness, oiliness, thinning, hair loss, etc. A head scalp treatment can boost your immune system, relieve stress, and promote relaxation by stimulating blood circulation and lymph flow.', '/images/services/01.png', 'Something', '/images/services/02.png', 'Something', '/images/services/01.png', 'Something'),
(12, 3, 'Body Massage + Scalp Treatment', '130.00', '', '', 90, '1,2', 'Our Head Scalp Treatment can help you with various scalp and hair problems, such as dryness, itchiness, oiliness, thinning, hair loss, etc. A head scalp treatment can boost your immune system, relieve stress, and promote relaxation by stimulating blood circulation and lymph flow.', '/images/services/01.png', 'Something', '/images/services/02.png', 'Something', '/images/services/01.png', 'Something'),
(13, 3, 'Body Massage + Classic RF Firming Facial', '179.00', '', '', 90, '1,2', 'Our Head Scalp Treatment can help you with various scalp and hair problems, such as dryness, itchiness, oiliness, thinning, hair loss, etc. A head scalp treatment can boost your immune system, relieve stress, and promote relaxation by stimulating blood circulation and lymph flow.', '/images/services/01.png', 'Something', '/images/services/02.png', 'Something', '/images/services/01.png', 'Something'),
(14, 3, 'Basic Cleansing + Scalp Treatment', '120.00', '', '', 75, '1,2', 'Our Head Scalp Treatment can help you with various scalp and hair problems, such as dryness, itchiness, oiliness, thinning, hair loss, etc. A head scalp treatment can boost your immune system, relieve stress, and promote relaxation by stimulating blood circulation and lymph flow.', '/images/services/01.png', 'Something', '/images/services/02.png', 'Something', '/images/services/01.png', 'Something'),
(15, 3, 'Basic Cleansing + Deep Compress', '140.00', '', '', 75, '1,2', 'Our Head Scalp Treatment can help you with various scalp and hair problems, such as dryness, itchiness, oiliness, thinning, hair loss, etc. A head scalp treatment can boost your immune system, relieve stress, and promote relaxation by stimulating blood circulation and lymph flow.', '/images/services/01.png', 'Something', '/images/services/02.png', 'Something', '/images/services/01.png', 'Something'),
(16, 3, 'Unblock Body Meridians + Scalp Treatment', '140.00', '', '', 80, '1,2', 'Our Head Scalp Treatment can help you with various scalp and hair problems, such as dryness, itchiness, oiliness, thinning, hair loss, etc. A head scalp treatment can boost your immune system, relieve stress, and promote relaxation by stimulating blood circulation and lymph flow.', '/images/services/01.png', 'Something', '/images/services/02.png', 'Something', '/images/services/01.png', 'Something'),
(17, 6, 'Test Service', '35.00', 'Step 1\r\nStep 2\r\nStep 3\r\nStep 4', '4', 90, '1', 'This service is to test the administration features.', '/images/services/01.png', 'Something', '/images/services/02.png', 'Something', '/images/services/03.png', 'Something'),
(18, 6, 'Test Service', '35.00', 'Step 1\r\nStep 2\r\nStep 3\r\nStep 4', '4', 90, '1', 'This service is to test the administration features.', '/images/services/01.png', 'Something', '/images/services/02.png', 'Something', '/images/services/03.png', 'Something');

-- --------------------------------------------------------

--
-- Table structure for table `service_addons`
--

CREATE TABLE `service_addons` (
  `id` int NOT NULL COMMENT 'ID of the add-on',
  `category` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Category of the add-on',
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Name of the add-on',
  `price` text NOT NULL COMMENT 'Price of the add-on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `service_addons`
--

INSERT INTO `service_addons` (`id`, `category`, `name`, `price`) VALUES
(1, 'Facials', 'Extraction - High Frequency', '25.00'),
(2, 'Facials', 'Deep Pore Detox Gel', '30.00'),
(3, 'Facials', 'Microdermabrasion Skin Peel', '45.00'),
(4, 'Test Category', 'Test Add-on', '12.35');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`) VALUES
(1, 'Facials'),
(2, 'Head Spa'),
(3, 'Combos'),
(6, 'Test Category');

-- --------------------------------------------------------

--
-- Table structure for table `service_promotions`
--

CREATE TABLE `service_promotions` (
  `id` int NOT NULL,
  `service` int NOT NULL,
  `price` text NOT NULL,
  `expiration` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `service_promotions`
--

INSERT INTO `service_promotions` (`id`, `service`, `price`, `expiration`) VALUES
(1, 1, '50.00', NULL),
(2, 2, '80.00', NULL),
(3, 3, '100.00', NULL),
(4, 4, '110.00', NULL),
(9, 9, '70.00', NULL),
(10, 14, '110.00', NULL),
(11, 5, '130.00', NULL),
(12, 10, '120.00', NULL),
(13, 17, '30.00', NULL),
(14, 18, '30.00', NULL),
(15, 18, '30.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `property` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Contains the configurations of the site';

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `property`, `value`) VALUES
(1, 'company_name', 'Meet Spa'),
(2, 'site_headline', 'Look and feel your best!'),
(3, 'service_details_wishlist_and_sharing', 'off'),
(4, 'service_details_creator', 'off'),
(5, 'service_details_sales_number', 'off'),
(6, 'service_details_rating', 'off'),
(7, 'service_details_review_graph', 'off'),
(8, 'service_details_reviews', 'off'),
(9, 'service_details_comments', 'off'),
(10, 'login_button', 'on'),
(11, 'cart_button', 'off'),
(12, 'navbar_search', 'off'),
(13, 'navbar_menu', 'off'),
(14, 'services_page', 'on'),
(15, 'products_page', 'off'),
(16, 'special_offers_page', 'on'),
(17, 'our_team_page', 'off'),
(18, 'blog_page', 'off'),
(19, 'site_logo', '/images/Logo.png'),
(20, 'gift_cards_page', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` text NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `value`) VALUES
('facebook', NULL),
('twitter', NULL),
('instagram', NULL),
('pinterest', NULL),
('youtube', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_policies`
--
ALTER TABLE `business_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_carousel`
--
ALTER TABLE `home_carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_addons`
--
ALTER TABLE `service_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_promotions`
--
ALTER TABLE `service_promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID of the entry', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID of the account', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_policies`
--
ALTER TABLE `business_policies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID of the policy', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `home_carousel`
--
ALTER TABLE `home_carousel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID of the slide', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID of the location', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID of the service', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `service_addons`
--
ALTER TABLE `service_addons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID of the add-on', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_promotions`
--
ALTER TABLE `service_promotions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
