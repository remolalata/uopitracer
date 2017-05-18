-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2017 at 04:47 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumnitracerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(100) NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(500) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_level` varchar(100) NOT NULL,
  `college` varchar(100) NOT NULL,
  `user_image` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `user_level`, `college`, `user_image`) VALUES
(1, 'ronne', '8eed3ca420fdbc10a5e95c30cd638cc7', 'Veronica', 'Canlas', 'canlasveronica@yahoo.com', 'Superadmin', '', 'images/admin/images (1).jpg'),
(6, 'shielacayabyab', '5a5a25b0785d8e4a0a65c3e0d632f940', 'SHIELA', 'CAYABYAB', 'shielacayabyab@gmail.com', 'Co-admin', 'CMA', 'images/admin/946916_10201108925110428_1078157264_n.jpg'),
(9, 'jz', 'd19cff9d1a41e5c99333d3b6b11389a5', 'JOHN', 'ZAMORA', 'johnzamora@yahoo.com', 'Co-admin', 'CEA', 'images/admin_default.png'),
(10, 'kim', '114fdfefd3d69799f0b6f73ef764d405', 'KIM', 'SANTOS', 'kim@yahoo.com', 'Co-admin', 'CSS', 'images/admin/Alumni-2.jpg'),
(13, 'merry', '3d88c25a396877e8299341b42d683e13', 'MERRY', 'CHRISTMAS', 'merrchistmas@gmailc.om', 'Co-admin', 'LAW', 'images/admin_default.png'),
(14, 'remolalata', '9931b6b642535d2f1d621ce455c67319', 'REMO', 'LALATA', 'remo.lalata2@gmail.com', 'Co-admin', 'CEA', 'images/admin_default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_logs`
--

CREATE TABLE `tbl_admin_logs` (
  `log_id` int(10) NOT NULL,
  `log_history` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_level` varchar(255) NOT NULL,
  `action` text NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_logs`
--

INSERT INTO `tbl_admin_logs` (`log_id`, `log_history`, `name`, `user_level`, `action`, `date`) VALUES
(355, '', 'Veronica Canlas', '', 'registered an alumni', 'Sep 06 2016 - 12:41 AM'),
(356, '', 'Veronica Canlas', 'Superadmin', 'registered an alumni', 'Sep 06 2016 - 12:43 AM'),
(357, '', 'Veronica Canlas', 'Superadmin', 'approve job pos', 'Sep 06 2016 - 12:44 AM'),
(358, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Sep 09 2016 - 02:43 PM'),
(359, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Sep 12 2016 - 07:05 PM'),
(360, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Sep 13 2016 - 11:38 AM'),
(361, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Sep 14 2016 - 01:02 PM'),
(362, '', 'Veronica Canlas', 'Superadmin', 'logged out', 'Sep 14 2016 - 01:08 PM'),
(363, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Sep 14 2016 - 01:10 PM'),
(364, '', 'Veronica Canlas', 'Superadmin', 'logged out', 'Sep 14 2016 - 01:12 PM'),
(365, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Oct 01 2016 - 07:02 PM'),
(366, '', 'Veronica Canlas', 'Superadmin', 'logged out', 'Oct 01 2016 - 07:05 PM'),
(367, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Nov 06 2016 - 08:27 PM'),
(368, '', 'Veronica Canlas', 'Superadmin', 'logged out', 'Nov 06 2016 - 08:41 PM'),
(369, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Nov 08 2016 - 06:38 PM'),
(370, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Nov 10 2016 - 06:52 PM'),
(371, '', 'Veronica Canlas', 'Superadmin', 'logged out', 'Nov 10 2016 - 06:53 PM'),
(372, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Nov 11 2016 - 10:34 PM'),
(373, '', 'Veronica Canlas', 'Superadmin', 'registered an alumni', 'Nov 11 2016 - 10:35 PM'),
(374, '', 'Veronica Canlas', 'Superadmin', 'logged out', 'Nov 11 2016 - 10:35 PM'),
(375, '', 'Veronica Canlas', 'Superadmin', 'logged in', 'Jan 27 2017 - 11:02 AM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alumni`
--

CREATE TABLE `tbl_alumni` (
  `student_number` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `email_add` varchar(200) NOT NULL,
  `coursecode` varchar(10) NOT NULL,
  `college` varchar(255) NOT NULL,
  `year_graduated` varchar(10) NOT NULL,
  `alumni_picture` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birthdate` varchar(50) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_birthdate` varchar(100) NOT NULL,
  `father_occupation` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_birthdate` varchar(100) NOT NULL,
  `mother_occupation` varchar(100) NOT NULL,
  `secondary_school` varchar(500) NOT NULL,
  `secondary_year_graduated` varchar(4) NOT NULL,
  `primary_school` varchar(500) NOT NULL,
  `primary_year_graduated` varchar(4) NOT NULL,
  `date_updated` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_alumni`
--

INSERT INTO `tbl_alumni` (`student_number`, `password`, `lastname`, `firstname`, `middlename`, `email_add`, `coursecode`, `college`, `year_graduated`, `alumni_picture`, `gender`, `birthdate`, `mobile_number`, `religion`, `address`, `father_name`, `father_birthdate`, `father_occupation`, `mother_name`, `mother_birthdate`, `mother_occupation`, `secondary_school`, `secondary_year_graduated`, `primary_school`, `primary_year_graduated`, `date_updated`, `status`) VALUES
('1001', 'e60781268442acd2fba50e5d62658918', 'CANLAS', 'VERONICA', 'LAGERA', 'vlcanlas@up.phinma.edu.ph', 'BSIT', 'CITE', '2011', '', '', '', '09778173599', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
('10123', '420d631de3dc2798140a972bb8c3fe4a', 'CHOU', 'TZUYU', 'W', 'chou.tzuyu@gmail.com', 'BSLL', 'LAW', '2011', '', '', '', '09772795285', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
('101234', '7128801af36789ec8417e027b6cd3e08', 'MYOUI', 'MINA', 'F', 'mina@gmail.com', 'BSA', 'CMA', '2011', '', '', '', '090789789', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
('1111', 'd4186398ebf1301c5fb7f1e457f57093', 'DOO', 'JOHN', 'G', 'JD@YAHOO.COM', 'BSN', 'CHS', '2013', '', '', '', '9127787564', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
('11234', 'da005c5dbdf69ccd0829a832d94f887a', 'SSFF', 'FFF', 'RT', 'DJDJ@YAHOO.COM', 'BSIT', 'CITE', '2011', '', '', '', '98783746', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
('1222', '496eb473a23e65ac9f20941e372561a6', 'SMITH', 'MARY', 'Y', 'SMITHM@GMAIL.COM', 'BSN', 'CHS', '2011', '', '', '', '9176543789', '', '', '', '', '', '', '', '', '', '', '', '', '', 0),
('23123', '1a755f80fe565e609d268b733e117b02', 'QEQEQWE', 'QWE', 'QWEQWE', 'weq2@WEQE.COM', 'BSA', 'CMA', '2011', '', '', '', '124123', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
('42342', '91f5cd5b7ad813c3be0791176f6823b2', 'WEQW', 'EQE', 'QWEQWEQ', 'qweqe@qweqw.com', 'BSBA-FM', 'CMA', '2011', '', '', '', '13241231', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
('7500051010', 'db6dbf75e5e41f38682d60da5a7ffe8c', 'DACANAY', 'ARNOLD', 'A', 'dacanayarnold@ggo.com', 'BSIT', 'CITE', '2012', 'admin/images/alumni_default.png', 'Female', '06/10/2017', '09186754352', 'rc', 'mangaldan', 'desiree', '16/10/2017', 'none', 'nenita', '12/12/2007', 'none', 'mangaldan', '1995', 'mangaldan', '1995', 'Jul 23 2016', 1),
('7500067010', '4fd6d51134711f5c728b30daeb8dda8b', 'LUSTESTICA', 'CHARLES', 'B', 'charleslustestica@gmail.com', 'BSN', 'CHS', '2015', '', '', '', '09166789065', '', '', '', '', '', '', '', '', '', '', '', '', '', 0),
('111005511', '9276f67ed58bbbeb6c90eb00f5f6392e', 'SANA', 'SANA', 'S', 'sana@gmail.com', 'BSBA-FM', 'CMA', '2013', 'admin/images/alumni_default.png', 'Male', '23/11/2032', '(63) 977-888-8888', 'weqeqw', 'eqweqw', 'qeqweqw', '21/03/2012', 'qweqw', 'eqweq', '12/03/2012', 'qeqweqw', 'qweqwe', '2005', 'qweqwe', '2002', 'Nov 14 2016', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alumni_backup_list`
--

CREATE TABLE `tbl_alumni_backup_list` (
  `student_number` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `email_add` varchar(200) NOT NULL,
  `coursecode` varchar(10) NOT NULL,
  `college` varchar(25) NOT NULL,
  `year_graduated` varchar(10) NOT NULL,
  `alumni_picture` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birthdate` varchar(50) NOT NULL,
  `mobile_number` varchar(11) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_birthdate` varchar(100) NOT NULL,
  `father_occupation` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_birthdate` varchar(100) NOT NULL,
  `mother_occupation` varchar(100) NOT NULL,
  `secondary_school` varchar(500) NOT NULL,
  `secondary_year_graduated` varchar(4) NOT NULL,
  `primary_school` varchar(500) NOT NULL,
  `primary_year_graduated` varchar(4) NOT NULL,
  `date_updated` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_alumni_backup_list`
--

INSERT INTO `tbl_alumni_backup_list` (`student_number`, `password`, `lastname`, `firstname`, `middlename`, `email_add`, `coursecode`, `college`, `year_graduated`, `alumni_picture`, `gender`, `birthdate`, `mobile_number`, `religion`, `address`, `father_name`, `father_birthdate`, `father_occupation`, `mother_name`, `mother_birthdate`, `mother_occupation`, `secondary_school`, `secondary_year_graduated`, `primary_school`, `primary_year_graduated`, `date_updated`) VALUES
('1222', '496eb473a23e65ac9f20941e372561a6', 'SMITH', 'MARY', 'Y', 'SMITHM@GMAIL.COM', 'BSN', 'CHS', '2011', '', '', '', '9176543789', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('7500051010', 'db6dbf75e5e41f38682d60da5a7ffe8c', 'DACANAY', 'ARNOLD', 'A', 'dacanayarnold@ggo.com', 'BSIT', 'CITE', '2012', 'admin/images/alumni_default.png', 'Female', '06/10/2017', '09186754352', 'rc', 'mangaldan', 'desiree', '16/10/2017', '16/10/2017', 'nenita', '12/12/2007', 'none', 'mangaldan', '1995', 'mangaldan', '1995', 'Jul 23 2016'),
('7500067010', '4fd6d51134711f5c728b30daeb8dda8b', 'LUSTESTICA', 'CHARLES', 'B', 'charleslustestica@gmail.com', 'BSN', 'CHS', '2015', '', '', '', '09166789065', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_college`
--

CREATE TABLE `tbl_college` (
  `collegecode` varchar(255) NOT NULL,
  `collegename` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_college`
--

INSERT INTO `tbl_college` (`collegecode`, `collegename`) VALUES
('CEA', 's'),
('CHSs', 'College of Health Sciencess'),
('CITE', 'College of Information Technology Education'),
('CMA', 'College of Management & Accountancy'),
('CSS', 'College of Social Sciences'),
('LAW', 'College of Law');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

CREATE TABLE `tbl_courses` (
  `coursecode` varchar(10) NOT NULL,
  `coursename` varchar(500) NOT NULL,
  `college` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`coursecode`, `coursename`, `college`) VALUES
('BSA', 'Bachelor of Science in Accountancy', 'CMA'),
('BSBA-FM', 'Bachelor of Science in Business Administration major in Financial Management', 'CMA'),
('BSBA-MM', 'Bachelor of Science in Business Administration major in Marketing Management', 'CMA'),
('BSCE', 'Bachelor of Science in Civil Engineering', 'CEA'),
('BSECE', 'Bachelor of Science in Electronics and Communications Engineering', 'CEA'),
('BSED', 'Bachelor in Education', 'CSS'),
('BSIT', 'Bachelor of Science in Information Technology', 'CITE'),
('BSLL', 'LAW LAW LAW', 'LAW'),
('BSN', 'Bachelor of Science in Nursing', 'CHS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employment`
--

CREATE TABLE `tbl_employment` (
  `student_number` varchar(100) NOT NULL,
  `college` varchar(255) NOT NULL,
  `employment_status` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `year_employed` varchar(10) NOT NULL,
  `job_level` varchar(100) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_address` varchar(200) NOT NULL,
  `company_address_lat_long` text NOT NULL,
  `company_number` varchar(100) NOT NULL,
  `date_updated` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employment`
--

INSERT INTO `tbl_employment` (`student_number`, `college`, `employment_status`, `job_title`, `year_employed`, `job_level`, `company_name`, `company_address`, `company_address_lat_long`, `company_number`, `date_updated`) VALUES
('7500051010', 'CITE', 'Contractual', 'clerk', '2011', 'Rank or Clerical', '123', '', ', ', '123', 'Jul 23 2016');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_categories`
--

CREATE TABLE `tbl_job_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_categories`
--

INSERT INTO `tbl_job_categories` (`category_id`, `category_name`) VALUES
(1, 'Accounting'),
(2, 'Administrative/Clerical'),
(3, 'Arts/Media'),
(4, 'Automotive'),
(5, 'Biotechnology'),
(6, 'Business'),
(7, 'Construction'),
(8, 'Customer Service'),
(9, 'Education'),
(10, 'Engineering'),
(11, 'Executive'),
(12, 'Facilities'),
(13, 'Financial Services'),
(14, 'Government'),
(15, 'Healthcare'),
(16, 'Hospitality'),
(17, 'Human Resources'),
(18, 'Information Technology'),
(19, 'Insurance'),
(20, 'Law Enforcement'),
(21, 'Legal'),
(22, 'Manufacturing'),
(23, 'Marketing'),
(24, 'Real Estate'),
(26, 'Other'),
(27, 'Retail/Wholesale'),
(28, 'Sales'),
(29, 'Science'),
(30, 'Telecommunications'),
(31, 'Transportation/War');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_locations`
--

CREATE TABLE `tbl_job_locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_locations`
--

INSERT INTO `tbl_job_locations` (`location_id`, `location_name`) VALUES
(1, 'National Capital Region'),
(2, 'Central Luzon'),
(3, 'Armm'),
(4, 'Calabarzon & Mimaropa'),
(5, 'Eastern Visayas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_posts`
--

CREATE TABLE `tbl_job_posts` (
  `job_post_id` int(11) NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `company_number` varchar(255) NOT NULL,
  `location` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `college` varchar(255) NOT NULL,
  `date_posted` varchar(100) NOT NULL,
  `posted_by_id` varchar(255) NOT NULL,
  `posted_by` varchar(100) NOT NULL,
  `if_job_posted_by_alumni` int(11) NOT NULL DEFAULT '0',
  `student_number` varchar(100) NOT NULL,
  `job_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_posts`
--

INSERT INTO `tbl_job_posts` (`job_post_id`, `job_title`, `salary`, `company_name`, `company_email`, `company_number`, `location`, `address`, `category`, `description`, `college`, `date_posted`, `posted_by_id`, `posted_by`, `if_job_posted_by_alumni`, `student_number`, `job_status`) VALUES
(22, 'Marketing Assistant', '5000 - 8000', 'ABC Marketing', 'abcmarketing@gmail.com', '0977567892', 'National Capital Region', 'Mandaluyong City', 'Business', 'Wala lang sample lang ito..', '', 'Jun 11 2016', '1', 'Ronne Roever', 0, '', 1),
(23, 'IT Instructor', '15000 - 20000', 'University of Pangasinan', 'upang@yahoo.com', '515-27-49', 'Central Luzon', 'Arellano St., Dagupan City', 'Information Technology', 'wala lang dummy lang ito', '', 'Jun 11 2016', '1', 'Ronne Roever', 0, '', 1),
(24, 'Civil Engineer', '30000 - 50000', 'ABC Engineering Corp.', 'abcenginering@hotmail.com', '7228310', 'Armm', 'Davao City', 'Engineering', 'wala lang dummy lang ito', '', 'Jun 11 2016', '1', 'Ronne Roever', 0, '', 1),
(25, 'Sample', '1000000 - 2000000', 'Sample', 'sample@gmail.com', '23423423423424', 'National Capital Region', 'sample', 'Arts/Media', 'sample', '', 'Jun 12 2016', '', 'Lanard Diaz', 1, '121006290', 2),
(26, 'asdasd', '10000 - 20000', 'asdasd', 'akosiaaron0803@gmail.com', '23423423423424', 'National Capital Region', 'asadsad', 'Accounting', 'asdasdasd', '', 'Jun 12 2016', '', 'Lanard Diaz', 1, '121006290', 2),
(27, 'android developer', '10000 - 20000', 'Sample', 'sample@gmail.com', '123123123', 'National Capital Region', 'caasdasd', 'Information Technology', 'asasdasd', '', 'Jun 12 2016', '', 'Lanard Diaz', 1, '121006290', 1),
(28, 'qweqwe', '10000 - 20000', 'asdasd', 'akosiaaron0803@gmail.com', '2131312', 'National Capital Region', 'asdasda', 'Accounting', 'asdasdas', '', 'Jun 12 2016', '', 'Lanard Diaz', 1, '121006290', 2),
(29, 'Technical Support ( Convergys)', '15000 - 20000', 'Convergys', 'convergys@yahoo.com', '12345', 'National Capital Region', 'makati ', 'Information Technology', 'Call Center ', '', 'Jun 14 2016', '', 'Rhenzel Balanon', 1, '111004603', 1),
(30, 'Math Teacher', '10000 - 20000', 'UPANG', 'upang@yahoo.com', '5152749', 'Central Luzon', 'Dagupan City', 'Education', 'sample description', '', 'Jul 23 2016', '1', 'Ronne Roever', 0, '', 1),
(31, 'Network Administrator', '20000  - 50000', 'ABC Company', 'Abc123@gmail.com', '1234567', 'National Capital Region', 'Baguio city', 'Information Technology', 'Licensed Network Administrator', '', 'Jul 23 2016', '', 'VERONICA CANLAS', 1, '1001', 1),
(32, 'manager', '123 - 312', 'SM Town', 'sm@gmail.com', '0908839123', 'Central Luzon', 'SM SM', 'Accounting', 'Manager', 'LAW', 'Jul 31 2016', '13', 'MERRY CHRISTMAS', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_events`
--

CREATE TABLE `tbl_news_events` (
  `news_events_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `posted_by_id` varchar(255) NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `date_time_posted` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news_events`
--

INSERT INTO `tbl_news_events` (`news_events_id`, `title`, `content`, `image`, `posted_by_id`, `posted_by`, `date_time_posted`) VALUES
(1, 'Welcome to UPangiTracer', '<p>Hi hello&nbsp;Hi hello&nbsp;Hi hello&nbsp;Hi hello&nbsp;Hi hello&nbsp;</p>', 'images/news_events/UPANG_logo.png', '1', 'Ronne Roever', 'Jun 11 2016 - 10:01 PM'),
(2, 'PHINMA UPANG offers “Pisasalamat” for 91 years', '<p>With a rich heritage in quality education spanning 91 years, the entire community of PHINMA University of Pangasinan commemorated its Founding Anniversary Celebration this year with the theme&nbsp;<em>Pisasalamat ed 91</em>(Grateful at 91), looking forward to an even &ldquo;bigger, better, best&rdquo; future for the institution.</p><p>&nbsp;</p><p>The one-day celebration kicked off on February 19, 2016 with a colorful display of costumes and talent at the University Gymnasium by the&nbsp;<em>Ligliwa&nbsp;</em>Dance Troupe together with the amazing ensemble of local folk songs of the rondalla group&nbsp;<em>Anewing na Cuerdas</em>, both from Mangatarem National High School. Students from the Basic Education department also showcased an energetic performance of&nbsp;<em>Awit ng Kabataan</em>.</p>', 'images/news_events/phinma.png', '1', 'Ronne Roever', 'Jun 12 2016 - 07:34 PM'),
(3, 'sample news', '<p>sample content here</p>', 'images/news_events/Alumni-2.jpg', '1', 'Ronne Roever', 'Jul 23 2016 - 04:51 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_logs`
--
ALTER TABLE `tbl_admin_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_alumni`
--
ALTER TABLE `tbl_alumni`
  ADD PRIMARY KEY (`student_number`);

--
-- Indexes for table `tbl_alumni_backup_list`
--
ALTER TABLE `tbl_alumni_backup_list`
  ADD PRIMARY KEY (`student_number`);

--
-- Indexes for table `tbl_college`
--
ALTER TABLE `tbl_college`
  ADD PRIMARY KEY (`collegecode`);

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD PRIMARY KEY (`coursecode`);

--
-- Indexes for table `tbl_employment`
--
ALTER TABLE `tbl_employment`
  ADD PRIMARY KEY (`student_number`);

--
-- Indexes for table `tbl_job_categories`
--
ALTER TABLE `tbl_job_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_job_locations`
--
ALTER TABLE `tbl_job_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tbl_job_posts`
--
ALTER TABLE `tbl_job_posts`
  ADD PRIMARY KEY (`job_post_id`);

--
-- Indexes for table `tbl_news_events`
--
ALTER TABLE `tbl_news_events`
  ADD PRIMARY KEY (`news_events_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_admin_logs`
--
ALTER TABLE `tbl_admin_logs`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;
--
-- AUTO_INCREMENT for table `tbl_job_locations`
--
ALTER TABLE `tbl_job_locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_job_posts`
--
ALTER TABLE `tbl_job_posts`
  MODIFY `job_post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tbl_news_events`
--
ALTER TABLE `tbl_news_events`
  MODIFY `news_events_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
