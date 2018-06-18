-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2018 at 03:02 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(100) NOT NULL,
  `user_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `intime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `outtime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `overtime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `late` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `date`, `intime`, `outtime`, `overtime`, `status`, `late`, `created_by`, `created_at`) VALUES
(483, '12356', '01/01/2018', '', '', '', 'Absent', NULL, '', '0000-00-00 00:00:00.000000'),
(484, '555', '01/01/2018', '', '', '', 'Absent', NULL, '', '0000-00-00 00:00:00.000000'),
(485, 'jamal55', '01/01/2018', '', '', '', 'Absent', NULL, '', '0000-00-00 00:00:00.000000'),
(486, 'kayes11', '01/01/2018', '', '', '', 'Absent', NULL, '', '0000-00-00 00:00:00.000000'),
(487, 'Tamim99', '01/01/2018', '', '', '', 'Absent', NULL, '', '0000-00-00 00:00:00.000000'),
(488, '12356', '01/02/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(489, '555', '01/02/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(490, 'jamal55', '01/02/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(491, 'kayes11', '01/02/2018', '10.00', '19.00', '1', 'Late', '1', '', '0000-00-00 00:00:00.000000'),
(492, 'Tamim99', '01/02/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(493, '12356', '01/03/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(494, '555', '01/03/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(495, 'jamal55', '01/03/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(496, 'kayes11', '01/03/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(497, 'Tamim99', '01/03/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(498, '12356', '01/04/2018', '10.00', '18.00', '0', 'Late', '1', '', '0000-00-00 00:00:00.000000'),
(499, '555', '01/04/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(500, 'jamal55', '01/04/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(501, 'kayes11', '01/04/2018', '10.00', '18.00', '0', 'Late', '1', '', '0000-00-00 00:00:00.000000'),
(502, 'Tamim99', '01/04/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(503, '12356', '01/05/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(504, '555', '01/05/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(505, 'jamal55', '01/05/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(506, 'kayes11', '01/05/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(507, 'Tamim99', '01/05/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(508, '12356', '01/06/2018', '10.00', '18.00', '0', 'Late', '1', '', '0000-00-00 00:00:00.000000'),
(509, '555', '01/06/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(510, 'jamal55', '01/06/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(511, 'kayes11', '01/06/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(512, 'Tamim99', '01/06/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(513, '12356', '01/07/2018', '10.00', '18.00', '0', 'Late', '1', '', '0000-00-00 00:00:00.000000'),
(514, '555', '01/07/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(515, 'jamal55', '01/07/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(516, 'kayes11', '01/07/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(517, 'Tamim99', '01/07/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(518, '12356', '01/08/2018', '10.00', '18.00', '0', 'Late', '1', '', '0000-00-00 00:00:00.000000'),
(519, '555', '01/08/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(520, 'jamal55', '01/08/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(521, 'kayes11', '01/08/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(522, 'Tamim99', '01/08/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(523, '12356', '01/09/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(524, '555', '01/09/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(525, 'jamal55', '01/09/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(526, 'kayes11', '01/09/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(527, 'Tamim99', '01/09/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(528, '12356', '01/10/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(529, '555', '01/10/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(530, 'jamal55', '01/10/2018', '22.00', '7.00', '1', 'Late', '2', '', '0000-00-00 00:00:00.000000'),
(531, 'kayes11', '01/10/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(532, 'Tamim99', '01/10/2018', '9.00', '19.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(533, '12356', '01/11/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(534, '555', '01/11/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(535, 'jamal55', '01/11/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(536, 'kayes11', '01/11/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(537, 'Tamim99', '01/11/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(538, '12356', '01/12/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(539, '555', '01/12/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(540, 'jamal55', '01/12/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(541, 'kayes11', '01/12/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(542, 'Tamim99', '01/12/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(543, '12356', '01/13/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(544, '555', '01/13/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(545, 'jamal55', '01/13/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(546, 'kayes11', '01/13/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(547, 'Tamim99', '01/13/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(548, '12356', '01/14/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(549, '555', '01/14/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(550, 'jamal55', '01/14/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(551, 'kayes11', '01/14/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(552, 'Tamim99', '01/14/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(553, '12356', '01/15/2018', '9.00', '19.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(554, '555', '01/15/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(555, 'jamal55', '01/15/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(556, 'kayes11', '01/15/2018', '9.00', '19.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(557, 'Tamim99', '01/15/2018', '9.00', '19.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(558, '12356', '01/16/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(559, '555', '01/16/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(560, 'jamal55', '01/16/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(561, 'kayes11', '01/16/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(562, 'Tamim99', '01/16/2018', '11.00', '18.00', '0', 'Late', '2', '', '0000-00-00 00:00:00.000000'),
(563, '12356', '01/17/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(564, '555', '01/17/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(565, 'jamal55', '01/17/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(566, 'kayes11', '01/17/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(567, 'Tamim99', '01/17/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(568, '12356', '01/18/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(569, '555', '01/18/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(570, 'jamal55', '01/18/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(571, 'kayes11', '01/18/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(572, 'Tamim99', '01/18/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(573, '12356', '01/19/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(574, '555', '01/19/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(575, 'jamal55', '01/19/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(576, 'kayes11', '01/19/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(577, 'Tamim99', '01/19/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(578, '12356', '01/20/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(579, '555', '01/20/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(580, 'jamal55', '01/20/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(581, 'kayes11', '01/20/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(582, 'Tamim99', '01/20/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(583, '12356', '01/21/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(584, '555', '01/21/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(585, 'jamal55', '01/21/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(586, 'kayes11', '01/21/2018', '10.00', '18.30', '0.3', 'Late', '1', '', '0000-00-00 00:00:00.000000'),
(587, 'Tamim99', '01/21/2018', '10.00', '18.30', '0.3', 'Late', '1', '', '0000-00-00 00:00:00.000000'),
(588, '12356', '01/22/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(589, '555', '01/22/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(590, 'jamal55', '01/22/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(591, 'kayes11', '01/22/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(592, 'Tamim99', '01/22/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(593, '12356', '01/23/2018', '10.00', '20.00', '2', 'Late', '1', '', '0000-00-00 00:00:00.000000'),
(594, '555', '01/23/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(595, 'jamal55', '01/23/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(596, 'kayes11', '01/23/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(597, 'Tamim99', '01/23/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(598, '12356', '01/24/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(599, '555', '01/24/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(600, 'jamal55', '01/24/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(601, 'kayes11', '01/24/2018', '9.00', '20.00', '2', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(602, 'Tamim99', '01/24/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(603, '12356', '01/25/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(604, '555', '01/25/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(605, 'jamal55', '01/25/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(606, 'kayes11', '01/25/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(607, 'Tamim99', '01/25/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(608, '12356', '01/26/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(609, '555', '01/26/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(610, 'jamal55', '01/26/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(611, 'kayes11', '01/26/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(612, 'Tamim99', '01/26/2018', '', '', '', 'Friday', NULL, '', '0000-00-00 00:00:00.000000'),
(613, '12356', '01/27/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(614, '555', '01/27/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(615, 'jamal55', '01/27/2018', '22.00', '7.00', '1', 'Late', '2', '', '0000-00-00 00:00:00.000000'),
(616, 'kayes11', '01/27/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(617, 'Tamim99', '01/27/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(618, '12356', '01/28/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(619, '555', '01/28/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(620, 'jamal55', '01/28/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(621, 'kayes11', '01/28/2018', '9.00', '19.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(622, 'Tamim99', '01/28/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(623, '12356', '01/29/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(624, '555', '01/29/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(625, 'jamal55', '01/29/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(626, 'kayes11', '01/29/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(627, 'Tamim99', '01/29/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(628, '12356', '01/30/2018', '9.00', '18.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(629, '555', '01/30/2018', '23.00', '6.00', '0', 'Late', '3', '', '0000-00-00 00:00:00.000000'),
(630, 'jamal55', '01/30/2018', '20.00', '6.00', '0', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(631, 'kayes11', '01/30/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(632, 'Tamim99', '01/30/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(633, '12356', '01/31/2018', '9.00', '18.30', '0.3', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(634, '555', '01/31/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(635, 'jamal55', '01/31/2018', '20.00', '7.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(636, 'kayes11', '01/31/2018', '9.00', '19.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000'),
(637, 'Tamim99', '01/31/2018', '9.00', '19.00', '1', 'Present', '0', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(100) NOT NULL,
  `department` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`, `created_by`, `created_at`) VALUES
(2, 'Purchase', '', '0000-00-00 00:00:00.000000'),
(3, 'Products', '', '0000-00-00 00:00:00.000000'),
(7, 'HR', '', '0000-00-00 00:00:00.000000'),
(8, 'Sales', '', '0000-00-00 00:00:00.000000'),
(9, 'test 1', '', '0000-00-00 00:00:00.000000'),
(10, 'test test', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(100) NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `designation`, `created_by`, `created_at`) VALUES
(1, 'Chief Executive Officer', '', '0000-00-00 00:00:00.000000'),
(2, 'Web Application Developer', '', '0000-00-00 00:00:00.000000'),
(3, 'Cyber Security Specialist', '', '0000-00-00 00:00:00.000000'),
(4, 'Manager', '', '0000-00-00 00:00:00.000000'),
(5, 'test 1', '', '0000-00-00 00:00:00.000000'),
(6, 'test test', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(5) NOT NULL,
  `holiday_date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `holiday_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `holiday_date`, `holiday_name`, `created_by`, `created_at`) VALUES
(1, '02/21/2018', 'Language Martyrs Day', '', '0000-00-00 00:00:00.000000'),
(2, '02/07/2018', 'test holiday1', '', '0000-00-00 00:00:00.000000'),
(3, '03/17/2018', 'Sheikh Mujibur Rahma', '', '0000-00-00 00:00:00.000000'),
(4, '03/26/2018', 'Independence Day', '', '0000-00-00 00:00:00.000000'),
(5, '04/14/2018', 'Bengali New Year', '', '0000-00-00 00:00:00.000000'),
(6, '04/29/2018', 'Buddha Purnima', '', '0000-00-00 00:00:00.000000'),
(7, '05/01/2018', 'May Day', '', '0000-00-00 00:00:00.000000'),
(8, '05/02/2018', 'Shab e Barat', '', '0000-00-00 00:00:00.000000'),
(9, '06/12/2018', 'Night of Destiny', '', '0000-00-00 00:00:00.000000'),
(10, '06/15/2018', 'Jumatul Bidah', '', '0000-00-00 00:00:00.000000'),
(12, '06/18/2018', 'Eid ul Fitr', '', '0000-00-00 00:00:00.000000'),
(13, '08/15/2018', 'National Mourning Da', '', '0000-00-00 00:00:00.000000'),
(14, '08/21/2018', 'Eid ul Ajha', '', '0000-00-00 00:00:00.000000'),
(15, '08/22/2018', 'Eid ul Ajha', '', '0000-00-00 00:00:00.000000'),
(16, '08/23/2018', 'Eid ul Ajha', '', '0000-00-00 00:00:00.000000'),
(17, '09/02/2018', 'Janmastomy', '', '0000-00-00 00:00:00.000000'),
(18, '09/21/2018', 'Ashura', '', '0000-00-00 00:00:00.000000'),
(19, '10/21/2018', 'Durga Puja', '', '0000-00-00 00:00:00.000000'),
(20, '11/21/2018', 'Eid e MeladunnNabi', '', '0000-00-00 00:00:00.000000'),
(21, '12/16/2017', 'Victory Day', '', '0000-00-00 00:00:00.000000'),
(22, '12/25/2017', 'Chrishmash Day', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `leave_entry`
--

CREATE TABLE `leave_entry` (
  `id` int(5) NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `leave_type_id` int(5) NOT NULL,
  `available_days` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `from_date` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `to_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `days` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `remaining_days` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `approved_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leave_entry`
--

INSERT INTO `leave_entry` (`id`, `user_id`, `leave_type_id`, `available_days`, `from_date`, `to_date`, `days`, `remaining_days`, `approved_by`, `create_by`, `created_at`) VALUES
(88, '12356', 1, '2', '02/18/2018,02/19/2018,02/20/2018,02/22/2018,02/24/2018,02/25/2018', '02/25/2018', '8', '2', '', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `leave_type_day` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `leave_type`, `leave_type_day`, `create_by`, `created_at`) VALUES
(1, 'Casual Leave', '10', '', '0000-00-00 00:00:00.000000'),
(2, 'Sick Leave', '14', '', '0000-00-00 00:00:00.000000'),
(3, 'Annual Leave', '20', '', '0000-00-00 00:00:00.000000'),
(4, 'Maternity Leave', '180', '', '0000-00-00 00:00:00.000000'),
(5, 'test', '45', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `official_info`
--

CREATE TABLE `official_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `national_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `joining_date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `grade` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(100) NOT NULL,
  `designation_id` int(100) NOT NULL,
  `salary_emp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shift_id` int(100) NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `official_info`
--

INSERT INTO `official_info` (`id`, `user_id`, `national_id`, `joining_date`, `grade`, `department_id`, `designation_id`, `salary_emp`, `shift_id`, `created_by`, `created_at`) VALUES
(1, '12356', '19941590603000294             ', '01/06/2018                    ', 'A', 7, 3, '50000', 14, '', '0000-00-00 00:00:00.000000'),
(2, '555  ', '19941590602000394  ', '01/06/2018   ', 'B', 3, 1, '50000', 15, '', '0000-00-00 00:00:00.000000'),
(3, 'jamal55', '123456789', '01/06/2018 ', 'A', 2, 3, '30000', 15, '', '0000-00-00 00:00:00.000000'),
(4, 'kayes11', '43434', '01/06/2018 ', 'a', 7, 2, '30000', 14, '', '0000-00-00 00:00:00.000000'),
(5, 'Tamim99', '123456789101125', '01/06/2018 ', 'C', 7, 2, '25000', 14, '', '0000-00-00 00:00:00.000000'),
(6, 'ahmed1', '5646545313', '2018-02-07', 'B', 3, 2, '15000', 15, '', '0000-00-00 00:00:00.000000'),
(7, 'ajadnew', '1994159060', '2018-02-14', 'A', 7, 4, '80000', 14, '', '0000-00-00 00:00:00.000000'),
(8, 'test', '334', '2018-02-22', 'a', 3, 3, '20000', 14, '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `present_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `permanent_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id`, `user_id`, `name`, `father_name`, `mother_name`, `birth_date`, `gender`, `phone_number`, `present_address`, `permanent_address`, `photo`, `created_by`, `created_at`) VALUES
(1, '12356', 'maruf                                                                                  ', 'Sheikh Muhammad Solaiman                                                                            ', 'Nur Begum                                                                                 ', '06/30/1994          ', 'male', '01825484458    ', 'Baizid ,Chittagong', '                                                                                 Dhaka,Bangladesh                                                                                                       ', '1518511310maruf.jpg', '', '0000-00-00 00:00:00.000000'),
(2, '555', 'Sakib Al Hasan  ', 'Mahmudur Rahaman  ', 'Israt Jahan  ', '06/30/1994   ', 'male', '01825484458  ', 'Baizid thana ,Chittagong', '  Dhaka    ', '', '', '0000-00-00 00:00:00.000000'),
(3, 'jamal55', 'jamal ', 'Md Hosain ', 'Mrs Kaleda ', '06/30/1994 ', 'male', '01825484458 ', 'abcdef', ' adfdf  ', '1517916726', '', '0000-00-00 00:00:00.000000'),
(4, 'kayes11', 'imrul kayes ', 'kamru lhasan ', 'najnin akttar ', '06/30/1994  ', 'male', '56564512 ', 'dfdsf', ' sdfsdf  ', '1517923423', '', '0000-00-00 00:00:00.000000'),
(5, 'Tamim99', 'Tamim Iqbal ', 'Iqbal Khan ', 'Zorena ', '06/30/1994  ', 'female', '01825484458 ', 'Dhaka,Bangladesh', ' Chitttagong,Bangladesh  ', '1517923252', '', '0000-00-00 00:00:00.000000'),
(6, 'ahmed1', 'maruf ahmed       ', 'abdul karim       ', 'mrs fatema       ', '2018-02-20       ', 'male', '01952651956    ', 'Khulna', '       Barisal              ', '1517922375', '', '0000-00-00 00:00:00.000000'),
(7, 'ajadnew', 'ak ajad', 'md yousuf', 'kaleda begum', '2018-02-13', 'male', '01825484458', 'dhaka', 'dhaka', '1518497738maruf.jpg', '', '0000-00-00 00:00:00.000000'),
(8, 'test', 'test  test', 'test ', 'test ', '2018-11-13 ', 'male', '44534 ', 'dfdsf', ' dsfdsf  ', '1518685781webcam-toy-photo2.jpg', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(100) NOT NULL,
  `salary` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `salary`, `created_by`, `created_at`) VALUES
(1, '50000', '', '0000-00-00 00:00:00.000000'),
(2, '30000', '', '0000-00-00 00:00:00.000000'),
(3, '20000', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(100) NOT NULL,
  `shift` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `in_time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `out_time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `grace_time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `shift`, `in_time`, `out_time`, `grace_time`, `created_by`, `created_at`) VALUES
(14, 'Morning', '9.00', '18.00', '0.15', '', '0000-00-00 00:00:00.000000'),
(15, 'Night', '20.00', '6.00', '0.15', '', '0000-00-00 00:00:00.000000'),
(16, 'test', '9.00', '20.00', '0.15', '', '0000-00-00 00:00:00.000000'),
(17, 'test now', '18.00', '19.00', '0.20', '', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password2` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `email`, `password`, `password2`) VALUES
(89, 'maruful islam', '01825484458', 'skmarufiiuc@gmail.com', '123456', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kola` (`user_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_entry`
--
ALTER TABLE `leave_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `official_info`
--
ALTER TABLE `official_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `xyz` (`department_id`),
  ADD KEY `abc` (`designation_id`),
  ADD KEY `pqr` (`salary_emp`),
  ADD KEY `habijabi` (`shift_id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=638;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `leave_entry`
--
ALTER TABLE `leave_entry`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `official_info`
--
ALTER TABLE `official_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
