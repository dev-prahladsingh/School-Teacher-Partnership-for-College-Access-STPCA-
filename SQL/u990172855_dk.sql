-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 25, 2024 at 05:44 PM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u990172855_dk`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty_data`
--

CREATE TABLE `faculty_data` (
  `id` int(11) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `region_id` varchar(255) DEFAULT NULL,
  `schools` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  `tsdate` date DEFAULT NULL,
  `tedate` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `creation_date` date DEFAULT curdate(),
  `applied_for_reallotment` enum('Yes','No') NOT NULL DEFAULT 'No',
  `reallotment_reason` text DEFAULT NULL,
  `board` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_data`
--

INSERT INTO `faculty_data` (`id`, `department`, `name`, `region_id`, `schools`, `address`, `target`, `tsdate`, `tedate`, `user_id`, `status`, `creation_date`, `applied_for_reallotment`, `reallotment_reason`, `board`) VALUES
(3, 'COMPUTER', 'Prahlad Singh', '1', 'Birla Open Minds International School', 'Bareilly, Uttar Pradesh', 3, '2024-07-25', '2024-08-04', 104, 'Expired', '2024-07-25', 'No', NULL, 'CBSE Board');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_fill_data`
--

CREATE TABLE `faculty_fill_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `tsdate` date DEFAULT NULL,
  `tedate` date DEFAULT NULL,
  `schools` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `board` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `pcont` varchar(20) DEFAULT NULL,
  `p_dob` date DEFAULT NULL,
  `p_doa` date DEFAULT NULL,
  `p_email` varchar(50) DEFAULT NULL,
  `tgtname` varchar(255) DEFAULT NULL,
  `tgtcont` varchar(20) DEFAULT NULL,
  `pgtname` varchar(255) DEFAULT NULL,
  `pgtcont` varchar(20) DEFAULT NULL,
  `twelve` int(11) DEFAULT NULL,
  `topic_covered` varchar(255) DEFAULT NULL,
  `visit_remark` varchar(255) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo_path` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `excel_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `iname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `key_name` varchar(255) DEFAULT NULL,
  `key_cont` varchar(20) DEFAULT NULL,
  `key_email` varchar(255) DEFAULT NULL,
  `key_dob` date DEFAULT NULL,
  `key_doa` date DEFAULT NULL,
  `visit_remark` varchar(255) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo_path` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `excel_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`id`, `user_id`, `name`, `department`, `type`, `iname`, `address`, `date`, `key_name`, `key_cont`, `key_email`, `key_dob`, `key_doa`, `visit_remark`, `creation_date`, `photo_path`, `region`, `excel_path`) VALUES
(1, 104, 'Prahlad Singh', 'COMPUTER', 'Bookstore', 'Vaishno Book Depot', 'Suresh Sharm Nagar', '2024-07-26', 'Mr.Sanjay Yadav', '9149062842', 'prahladsingh75122gmail.com', '1999-06-16', '2024-07-02', 'Good', '2024-07-25 04:14:10', 'uploads/pexels-pixabay-302769.jpg', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pgt_info`
--

CREATE TABLE `pgt_info` (
  `id` int(11) NOT NULL,
  `faculty_fill_data_id` int(11) NOT NULL,
  `pgt_name` varchar(255) DEFAULT NULL,
  `pgt_contact` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `doa` date DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `region_name`) VALUES
(1, 'Bareilly'),
(2, 'Badaun'),
(3, 'Pilibhit'),
(4, 'Shahjahanpur');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `board` varchar(255) DEFAULT 'cbse',
  `address` varchar(255) DEFAULT 'No Address'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_name`, `region_id`, `board`, `address`) VALUES
(1, 'Delhi Public School (DPS) Bareilly', 1, 'CBSE Board', 'Panchvati, 11 KM Milestone, Rampur Road, Parsakhera, Bareilly - 243001, Uttar Pradesh'),
(2, 'Alma Mater School', 1, 'CBSE Board', 'C-140, Kurmanchal Nagar, Bareilly, Uttar Pradesh'),
(3, 'Birla Open Minds International School', 1, 'CBSE Board', 'Bareilly, Uttar Pradesh'),
(4, 'Woodrow Senior Secondary School', 1, 'CBSE Board', 'Bareilly, Uttar Pradesh'),
(5, 'Greenwood Senior Secondary School', 1, 'CBSE Board', 'Bareilly, Uttar Pradesh'),
(6, 'Hartmann College', 1, 'ICSE Board', 'Izzatnagar, Bareilly - 243122, Uttar Pradesh'),
(7, 'St. Francis Convent School', 1, 'ICSE Board', 'Bareilly, Uttar Pradesh'),
(8, 'St. Maria\'s School', 1, 'CBSE Board', 'Bareilly, Uttar Pradesh'),
(9, 'Baba Saheb Ambedkar School', 2, 'CBSE Board', 'Near Bus Stand, Badaun - 243601, Uttar Pradesh'),
(10, 'Saraswati Shishu Mandir', 2, 'U.P. Board', 'Rajepur, Badaun - 243602, Uttar Pradesh'),
(11, 'Maharishi Vidya Mandir', 2, 'CBSE Board', 'Shivrajpur, Badaun - 243603, Uttar Pradesh'),
(12, 'St. Joseph\'s School', 2, 'ICSE Board', 'City Centre, Badaun - 243604, Uttar Pradesh'),
(13, 'Ravi Shankar School', 2, 'U.P. Board', 'Khergaon, Badaun - 243605, Uttar Pradesh'),
(14, 'Government Inter College', 2, 'U.P. Board', 'Gulshan Nagar, Badaun - 243606, Uttar Pradesh'),
(15, 'Shri Ram School', 2, 'CBSE Board', 'Harsauli, Badaun - 243607, Uttar Pradesh'),
(16, 'Vidya Bhawan School', 2, 'ICSE Board', 'Chandpur, Badaun - 243608, Uttar Pradesh'),
(17, 'The Little Angels School', 2, 'CBSE Board', 'Rohilkhand, Badaun - 243609, Uttar Pradesh'),
(18, 'New Era School', 2, 'U.P. Board', 'Barampur, Badaun - 243610, Uttar Pradesh'),
(19, 'Bright Future Academy', 2, 'CBSE Board', 'Chandausi Road, Badaun - 243611, Uttar Pradesh'),
(20, 'Royal International School', 2, 'ICSE Board', 'Kiswana, Badaun - 243612, Uttar Pradesh'),
(21, 'Sunrise School', 2, 'CBSE Board', 'Sadar, Badaun - 243613, Uttar Pradesh'),
(22, 'Asha School', 2, 'U.P. Board', 'Saidpur, Badaun - 243614, Uttar Pradesh'),
(23, 'Pathway School', 2, 'CBSE Board', 'Nawabganj, Badaun - 243615, Uttar Pradesh'),
(24, 'Holy Child School', 3, 'CBSE Board', 'Civil Lines, Pilibhit - 262001, Uttar Pradesh'),
(25, 'Sainik School', 3, 'CBSE Board', 'Avas Vikas Colony, Pilibhit - 262002, Uttar Pradesh'),
(26, 'Bharatiya Vidya Bhavan', 3, 'ICSE Board', 'Naina Pur, Pilibhit - 262003, Uttar Pradesh'),
(27, 'Pilibhit Inter College', 3, 'U.P. Board', 'Near Railway Station, Pilibhit - 262004, Uttar Pradesh'),
(28, 'Ravi Shankar School', 3, 'CBSE Board', 'Rahatpur, Pilibhit - 262006, Uttar Pradesh'),
(29, 'St. Xavier\'s School', 3, 'ICSE Board', 'Puranpur, Pilibhit - 262007, Uttar Pradesh'),
(30, 'Maharishi Vidya Mandir', 3, 'CBSE Board', 'Bisalpur, Pilibhit - 262008, Uttar Pradesh'),
(31, 'New Dawn School', 3, 'U.P. Board', 'Bhadaura, Pilibhit - 262009, Uttar Pradesh'),
(32, 'Shri Ram School', 3, 'CBSE Board', 'Dariaon, Pilibhit - 262010, Uttar Pradesh'),
(33, 'The Little Angels School', 3, 'ICSE Board', 'Bisen Nagar, Pilibhit - 262011, Uttar Pradesh'),
(34, 'Government Girls Inter College', 3, 'U.P. Board', 'Ravindra Nagar, Pilibhit - 262012, Uttar Pradesh'),
(35, 'Pilibhit Public School', 3, 'CBSE Board', 'Nauganva, Pilibhit - 262013, Uttar Pradesh'),
(36, 'Vidya Bhawan School', 3, 'ICSE Board', 'Khatima Road, Pilibhit - 262014, Uttar Pradesh'),
(37, 'Sunrise Academy', 3, 'U.P. Board', 'Maholi, Pilibhit - 262015, Uttar Pradesh'),
(38, 'Delhi Public School (DPS) Shahjahanpur', 4, 'CBSE Board', 'Jahagirganj, Shahjahanpur - 242001, Uttar Pradesh'),
(39, 'Sainik School Shahjahanpur', 4, 'CBSE Board', 'Near Bypass, Shahjahanpur - 242002, Uttar Pradesh'),
(40, 'St. Joseph\'s School', 4, 'ICSE Board', 'Civil Lines, Shahjahanpur - 242003, Uttar Pradesh'),
(41, 'Government Inter College', 4, 'U.P. Board', 'Chandpur, Shahjahanpur - 242004, Uttar Pradesh'),
(42, 'Shri Ram School', 4, 'CBSE Board', 'Gorakhpur Road, Shahjahanpur - 242005, Uttar Pradesh'),
(43, 'Maharishi Vidya Mandir', 4, 'CBSE Board', 'Sadar Bazar, Shahjahanpur - 242006, Uttar Pradesh'),
(44, 'Vidya Bhawan School', 4, 'ICSE Board', 'Nawabganj, Shahjahanpur - 242007, Uttar Pradesh'),
(45, 'Sunrise Academy', 4, 'U.P. Board', 'Kachhawa, Shahjahanpur - 242008, Uttar Pradesh'),
(46, 'Ravi Shankar School', 4, 'CBSE Board', 'Zaidpur, Shahjahanpur - 242009, Uttar Pradesh'),
(47, 'New Era School', 4, 'U.P. Board', 'Rohil, Shahjahanpur - 242010, Uttar Pradesh'),
(48, 'Bright Future Academy', 4, 'ICSE Board', 'Pilibhit Road, Shahjahanpur - 242011, Uttar Pradesh'),
(49, 'Pathway School', 4, 'CBSE Board', 'Khurda, Shahjahanpur - 242012, Uttar Pradesh'),
(50, 'Government Girls Inter College', 4, 'U.P. Board', 'Bharatpur, Shahjahanpur - 242013, Uttar Pradesh'),
(51, 'Asha School', 4, 'CBSE Board', 'Kishanpur, Shahjahanpur - 242014, Uttar Pradesh'),
(52, 'Royal International School', 4, 'ICSE Board', 'Sadar, Shahjahanpur - 242015, Uttar Pradesh');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `mobile_number`, `school_name`, `department`, `region`, `year`) VALUES
(4, 'akdjfjsd', 'yrrytrty', 'dttyedtyed', 'hfhfh', 'fgd', 4321);

-- --------------------------------------------------------

--
-- Table structure for table `tgt_info`
--

CREATE TABLE `tgt_info` (
  `id` int(11) NOT NULL,
  `faculty_fill_data_id` int(11) NOT NULL,
  `tgt_name` varchar(255) DEFAULT NULL,
  `tgt_contact` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `doa` date DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usersss`
--

CREATE TABLE `usersss` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'inactive',
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersss`
--

INSERT INTO `usersss` (`id`, `name`, `department`, `role`, `username`, `password`, `status`, `phone`) VALUES
(1, 'Dr. Rekha Gangwar', 'ZOOLOGY DEPTT.', 'user', 'gangwar.rekha01@gmail.com', '12345678', 'inactive', NULL),
(2, 'Dr. Monika Saxena', 'ZOOLOGY DEPTT.', 'user', 'monikasaxena2016@gmail.com', '12345678', 'inactive', NULL),
(3, 'Ms. Farha Hussain', 'ZOOLOGY DEPTT.', 'user', 'farhahusain31@gmail.com', '12345678', 'inactive', NULL),
(4, 'Mr. Chanchal Srivastava', 'ZOOLOGY DEPTT.', 'user', 'chanchalbest123@gmail.com', '12345678', 'active', NULL),
(5, 'Dr. Manoj Joshi', 'BOTANY DEPTT.', 'user', 'manoj.joshi26@gmail.com', '12345678', 'active', NULL),
(6, 'Ms. Somiya Ankita Massey', 'BOTANY DEPTT.', 'user', '906812483.sm@gmail.com', '12345678', 'active', NULL),
(7, 'Ms. Nazia Qamar', 'BOTANY DEPTT.', 'user', 'naziaqamar91@gmail.com', '12345678', 'active', NULL),
(8, 'Ms. Shilpa Chandravanshi', 'BOTANY DEPTT.', 'user', 'shilparajoot@gmail.com', '12345678', 'active', NULL),
(9, 'Dr. Nisha Dinkar', 'BIOTECH.', 'user', 'nishadinkar@gmail.com', '12345678', 'active', NULL),
(10, 'Dr. Mohd. Faheem Khan', 'BIOTECH.', 'user', 'faheemphd@gmail.com', '12345678', 'active', NULL),
(11, 'Mr. Rakesh Kumar Sarkar', 'BIOTECH.', 'user', 'rsarkar271@gmail.com', '12345678', 'active', NULL),
(12, 'Ms. Bushra Fatima', 'BIOTECH.', 'user', 'bushrafatima2807@gmail.com', '12345678', 'active', NULL),
(13, 'Dr. Ajai Gupta', 'CHEMISTRY DEPTT.', 'user', 'ajaykcmt@gmail.com', '12345678', 'active', NULL),
(14, 'Dr. Shalini Gupta', 'CHEMISTRY DEPTT.', 'user', 'shalinidr74@gmail.com', '12345678', 'active', NULL),
(15, 'Mr. Gufran Ali', 'CHEMISTRY DEPTT.', 'user', 'gufranalimsc46@gmail.com', '12345678', 'active', NULL),
(16, 'Dr. Amit Kumar Gupta', 'MATHS DEPTT.', 'user', 'guptaamit48@rediffmail.com', '12345678', 'active', NULL),
(17, 'Mr. Brijesh Babu', 'MATHS DEPTT.', 'user', 'brijeshgangwar@gmail.com', '12345678', 'active', NULL),
(18, 'Dr. Pawan Saxena', 'MATHS DEPTT.', 'user', 'saxenapawan78@gmail.com', '12345678', 'active', NULL),
(19, 'Mr. Harshvardhan', 'MATHS DEPTT.', 'user', 'harshshakya243001@gmail.com', '12345678', 'active', NULL),
(20, 'Mr. Rajit Kumar', 'MATHS DEPTT.', 'user', 'rajitmishra7318@gmail.com', '12345678', 'active', NULL),
(21, 'Mr. Munish Kumar', 'PHYSICS DEPTT.', 'user', 'munish85physics@gmail.com', '12345678', 'active', NULL),
(22, 'Mr. Dinesh Kumar', 'PHYSICS DEPTT.', 'user', 'dineshkr1502@gmial.com', '12345678', 'active', NULL),
(23, 'Ms. Akanksha Gupta', 'PHYSICS DEPTT.', 'user', 'ag2305147@gnauk,cin', '12345678', 'active', NULL),
(24, 'Mr. Kumar Pal Singh', 'PHYSICS DEPTT.', 'user', 'kumarpalsingh00@gmail.com', '12345678', 'active', NULL),
(25, 'Mrs. Pragya Ritambhara', 'HOME SC. DEPTT.', 'user', 'pragyaritz21@gmail.com', '12345678', 'active', NULL),
(26, 'Mrs. Shubhra Trivedi', 'HOME SC. DEPTT.', 'user', 'mrsshubhratrivedi@gmail.com', '12345678', 'active', NULL),
(27, 'Ms. Jyotsana Sharma', 'HOME SC. DEPTT.', 'user', 'jt.Bareilly@gmail.com', '12345678', 'active', NULL),
(28, 'Ms. Shyama Chouhan', 'HOME SC. DEPTT.', 'user', 'ayushichauhan1512@gmail.com', '12345678', 'active', NULL),
(29, 'Dr. R.K. Singh', 'EDUCATION DEPTT.', 'user', 'rksinghkcmt@gmail.com', '12345678', 'active', NULL),
(30, 'Mrs. Kalpana Katiyar', 'EDUCATION DEPTT.', 'user', 'kalpanajashwar007@gmail.com', '12345678', 'active', NULL),
(31, 'Mr. S.S. Sharma', 'EDUCATION DEPTT.', 'user', 'shivss164@gmail.com', '12345678', 'active', NULL),
(32, 'Mr. Om Pal Singh', 'EDUCATION DEPTT.', 'user', 'ompal610@gmail.com', '12345678', 'active', NULL),
(33, 'Mrs. Savita Johari', 'EDUCATION DEPTT.', 'user', 'savita3333@gmail.com', '12345678', 'active', NULL),
(34, 'Mr. Mohammad Javed', 'EDUCATION DEPTT.', 'user', 'mohdjavedjafri@gmail.com', '12345678', 'active', NULL),
(35, 'Mrs. Rachna Singh', 'EDUCATION DEPTT.', 'user', 'singh.ishi2013@gmail.com', '12345678', 'active', NULL),
(36, 'Mrs. Meenu Kanotra', 'EDUCATION DEPTT.', 'user', 'meenu.kanotra03@gmial.com', '12345678', 'active', NULL),
(37, 'Mr. Ghanshyam', 'EDUCATION DEPTT.', 'user', 'ghanshyamjuly1980@gmail.com', '12345678', 'active', NULL),
(38, 'Mr. Ajai Tiwari', 'EDUCATION DEPTT.', 'user', 'AJAYRU1@Yahoo.com', '12345678', 'active', NULL),
(39, 'Mr. Harish Kumar', 'EDUCATION DEPTT.', 'user', 'harikmn2013@gmail.com', '12345678', 'active', NULL),
(40, 'Mrs. Seema Saxena', 'EDUCATION DEPTT.', 'user', 'saxenaseema755@gmail.com', '12345678', 'active', NULL),
(41, 'Mr. Ahsan Ali', 'EDUCATION DEPTT.', 'user', 'aliahsanali8`819@gamil.com', '12345678', 'active', NULL),
(42, 'Mrs. Pragya', 'EDUCATION DEPTT.', 'user', '', '12345678', 'active', NULL),
(43, 'Mr. Trivendra Kumar', 'EDUCATION DEPTT.', 'user', 'rinkusji24@gmail.com', '12345678', 'active', NULL),
(44, 'Mr. Nirpendra Pratap Singh', 'EDUCATION DEPTT.', 'user', 'nikk.1189bly@gmail.com', '12345678', 'active', NULL),
(45, 'Ms. Swati Kaushik', 'EDUCATION DEPTT.', 'user', 'sanswatidixit@gmail.com', '12345678', 'active', NULL),
(46, 'Mrs. Taruna Rani', 'EDUCATION DEPTT.', 'user', 'Dr.tarunarani@gmail.com', '12345678', 'active', NULL),
(47, 'Mrs. Anuradha Pandey', 'EDUCATION DEPTT.', 'user', 'anupandey396@gmail.com', '12345678', 'active', NULL),
(48, 'Mrs. Mukta Mani Sharma', 'EDUCATION DEPTT.', 'user', 'muktamanisharma@gmail.com', '12345678', 'active', NULL),
(49, 'Ms. Archana Devi', 'EDUCATION DEPTT.', 'user', 'archanashakya825@gmail.com', '12345678', 'active', NULL),
(50, 'Mrs. Retesh Gupta', 'EDUCATION DEPTT.', 'user', 'rinki2248@gmail.com', '12345678', 'active', NULL),
(51, 'Mr. Ritesh Agarwal', 'MANAGEMENT', 'user', 'ragarwal76@gmail.com', '12345678', 'active', NULL),
(52, 'Dr. Prabodh Gour', 'MANAGEMENT', 'admin', 'dr.prabodhgour@gmail.com', '12345678', 'active', '9149062842'),
(53, 'Mr. Ajeet Verma', 'MANAGEMENT', 'user', 'vermaajeet1981@gmail.com', '12345678', 'active', NULL),
(54, 'Mrs. Ratika Chawla', 'MANAGEMENT', 'user', 'ratikachawla12@gmail.com', '12345678', 'active', NULL),
(55, 'Mr. Ravi Verma', 'MANAGEMENT', 'user', 'vermaravi01@gmail.com', '12345678', 'active', NULL),
(56, 'Mr. Fahad Beg', 'MANAGEMENT', 'user', 'fhdbeg@gmail.com', '12345678', 'active', NULL),
(57, 'Mr. Anil Kumar Singh', 'MANAGEMENT', 'user', 'anil.mjpru@gmail.com', '12345678', 'active', NULL),
(58, 'Mr. Paras Agarwal', 'MANAGEMENT', 'user', 'paras1103@gmail.com', '12345678', 'active', NULL),
(59, 'Mr. Mukul Gupta', 'MANAGEMENT', 'user', 'mukulguptahr@gmail.com', '12345678', 'active', NULL),
(60, 'Mr. Harish Kumar', 'MANAGEMENT', 'user', 'kumar.harish861978@gmail.com', '12345678', 'active', NULL),
(61, 'Mr. Amiyo Das', 'MANAGEMENT', 'user', 'amiyodas9@gmail.com', '12345678', 'active', NULL),
(62, 'Mrs. Tejasvita Singh', 'MANAGEMENT', 'user', 'singh.tejasvita@gmail.com', '12345678', 'active', NULL),
(63, 'Ms. Sunaina Mahajan', 'MANAGEMENT', 'user', 'sunainamahajan58@gmail.com', '12345678', 'active', NULL),
(64, 'Ms. Priyadarshini Gour', 'MANAGEMENT', 'user', 'priya.gaur456@gmail.com', '12345678', 'active', NULL),
(65, 'Ms. Trishty Khandelwal', 'MANAGEMENT', 'user', 'trishty9@gmail.com', '12345678', 'active', NULL),
(66, 'Shri Shivam Kashyap', 'MANAGEMENT', 'user', 'shivamkashyap13@g.mail.com', '12345678', 'active', NULL),
(67, 'Ms. Diya Oli', 'MANAGEMENT', 'user', 'olidiya22@gmail.com', '12345678', 'active', NULL),
(68, 'Mr. Deepak Awasthi', 'COMPUTER', 'user', 'posttodeepak@gmail.com', '12345678', 'active', '7534001517'),
(69, 'Mr. Rajat Kapoor', 'COMPUTER', 'user', 'nerajatkapoor@gmail.com', '12345678', 'active', NULL),
(70, 'Mr. Sanjeev Sharma', 'COMPUTER', 'user', 'sanjeevprof@gmail.com', '12345678', 'active', NULL),
(71, 'Mr. Ankur Bhardwaj', 'COMPUTER', 'user', 'ankur.mca0811@gmail.com', '12345678', 'active', NULL),
(72, 'Mrs. Shivani Rastogi', 'COMPUTER', 'user', 'shivani.rastogi15@gmail.com', '12345678', 'active', NULL),
(73, 'Mr. Sachin Arora', 'COMPUTER', 'user', 'sachinarorabareilly@gmial.com', '12345678', 'active', NULL),
(74, 'Ms. Sonali Singh', 'COMPUTER', 'user', 'sonalisinghnky@gmail.com', '12345678', 'active', NULL),
(75, 'Mr. Ritik Saxena', 'COMPUTER', 'user', 'saxenaritik3002@gmail.com', '12345678', 'active', NULL),
(76, 'Ms. Khyati Pancholi', 'COMPUTER', 'user', 'khyatipancholi30@gmail.com', '12345678', 'active', NULL),
(77, 'Ms. Riya Agarwal', 'COMPUTER', 'user', 'agarwalriya1803@gmail.com', '12345678', 'active', NULL),
(78, 'Mr. Ram Mohan Saxena', 'STAFF MEMBERS', 'user', 'rmsaxena1955@gmail.com', '12345678', 'active', NULL),
(79, 'Mr. Shyama Charan', 'STAFF MEMBERS', 'user', 'scmkcmt71@gmail.com', '12345678', 'active', NULL),
(80, 'Mr. Shakeel Ahmad', 'STAFF MEMBERS', 'user', 'shakilbly786@gmail.com', '12345678', 'active', NULL),
(81, 'Mr. Shushant Pandey', 'STAFF MEMBERS', 'user', 'sushantpandey062@gmail.com', '12345678', 'active', NULL),
(82, 'Mr. Abhishek Saxena', 'STAFF MEMBERS', 'user', 'abhisheksaxena652@gmail.com', '12345678', 'active', NULL),
(83, 'Mr. Ranvijay Singh', 'STAFF MEMBERS', 'user', 'ranvijay08singh@rediffmail.com', '12345678', 'active', NULL),
(84, 'Mr. Sumit Kumar', 'STAFF MEMBERS', 'user', 'saxenasumit78@gmail.com', '12345678', 'active', NULL),
(85, 'Ms. Prity Devi', 'STAFF MEMBERS', 'user', 'pritydevi890@gmail.com', '12345678', 'active', NULL),
(86, 'Ms. Mehnaz', 'STAFF MEMBERS', 'user', 'mehnazznsari77@gmail.com', '12345678', 'active', NULL),
(101, 'Dr. Prabodh Gour', 'MANAGEMENT', 'user', 'drprabodhgour6@gmail.com', '12345678', 'active', NULL),
(104, 'Prahlad Singh', 'COMPUTER', 'user', 'prahlad.singh.education@gmail.com', '12345678', 'active', '7099345673');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty_data`
--
ALTER TABLE `faculty_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_fill_data`
--
ALTER TABLE `faculty_fill_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pgt_info`
--
ALTER TABLE `pgt_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_fill_data_id` (`faculty_fill_data_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tgt_info`
--
ALTER TABLE `tgt_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_fill_data_id` (`faculty_fill_data_id`);

--
-- Indexes for table `usersss`
--
ALTER TABLE `usersss`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty_data`
--
ALTER TABLE `faculty_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty_fill_data`
--
ALTER TABLE `faculty_fill_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pgt_info`
--
ALTER TABLE `pgt_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tgt_info`
--
ALTER TABLE `tgt_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usersss`
--
ALTER TABLE `usersss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pgt_info`
--
ALTER TABLE `pgt_info`
  ADD CONSTRAINT `pgt_info_ibfk_1` FOREIGN KEY (`faculty_fill_data_id`) REFERENCES `faculty_fill_data` (`id`);

--
-- Constraints for table `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`);

--
-- Constraints for table `tgt_info`
--
ALTER TABLE `tgt_info`
  ADD CONSTRAINT `tgt_info_ibfk_1` FOREIGN KEY (`faculty_fill_data_id`) REFERENCES `faculty_fill_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
