SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `states` (
  `id` tinyint UNSIGNED NOT NULL,
  `country_id` int UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `states` (`id`, `country_id`, `name`, `code`) VALUES
(1, 235, 'Alabama', 'AL'),
(2, 235, 'Alaska', 'AK'),
(3, 235, 'Arizona', 'AZ'),
(4, 235, 'Arkansas', 'AR'),
(5, 235, 'California', 'CA'),
(6, 235, 'Colorado', 'CO'),
(7, 235, 'Connecticut', 'CT'),
(8, 235, 'Delaware', 'DE'),
(9, 235, 'Florida', 'FL'),
(10, 235, 'Georgia', 'GA'),
(11, 235, 'Hawaii', 'HI'),
(12, 235, 'Idaho', 'ID'),
(13, 235, 'Illinois', 'IL'),
(14, 235, 'Indiana', 'IN'),
(15, 235, 'Iowa', 'IA'),
(16, 235, 'Kansas', 'KS'),
(17, 235, 'Kentucky', 'KY'),
(18, 235, 'Louisiana', 'LA'),
(19, 235, 'Maine', 'ME'),
(20, 235, 'Maryland', 'MD'),
(21, 235, 'Massachusetts', 'MA'),
(22, 235, 'Michigan', 'MI'),
(23, 235, 'Minnesota', 'MN'),
(24, 235, 'Mississippi', 'MS'),
(25, 235, 'Missouri', 'MO'),
(26, 235, 'Montana', 'MT'),
(27, 235, 'Nebraska', 'NE'),
(28, 235, 'Nevada', 'NV'),
(29, 235, 'New Hampshire', 'NH'),
(30, 235, 'New Jersey', 'NJ'),
(31, 235, 'New Mexico', 'NM'),
(32, 235, 'New York', 'NY'),
(33, 235, 'North Carolina', 'NC'),
(34, 235, 'North Dakota', 'ND'),
(35, 235, 'Ohio', 'OH'),
(36, 235, 'Oklahoma', 'OK'),
(37, 235, 'Oregon', 'OR'),
(38, 235, 'Pennsylvania', 'PA'),
(39, 235, 'Rhode Island', 'RI'),
(40, 235, 'South Carolina', 'SC'),
(41, 235, 'South Dakota', 'SD'),
(42, 235, 'Tennessee', 'TN'),
(43, 235, 'Texas', 'TX'),
(44, 235, 'Utah', 'UT'),
(45, 235, 'Vermont', 'VT'),
(46, 235, 'Virginia', 'VA'),
(47, 235, 'Washington', 'WA'),
(48, 235, 'West Virginia', 'WV'),
(49, 235, 'Wisconsin', 'WI'),
(50, 235, 'Wyoming', 'WY');


ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);


ALTER TABLE `states`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
