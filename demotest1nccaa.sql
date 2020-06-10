-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2020 at 03:07 PM
-- Server version: 10.1.45-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demotest1nccaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_history`
--

CREATE TABLE `action_history` (
  `user_id` int(10) NOT NULL,
  `id` int(20) NOT NULL,
  `first_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `card_num4` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `action_date` int(20) NOT NULL,
  `action_num` int(2) NOT NULL,
  `amount_num` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `exam_mon` int(1) NOT NULL,
  `exam_year` year(4) NOT NULL,
  `show_allow` int(1) NOT NULL,
  `receipt_title` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `detail_title` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `cme_cycle_start` year(4) NOT NULL,
  `exam_type` enum('CDQ','CME','Certification','Admin','ITE','Interest','Other') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `action_history`
--

INSERT INTO `action_history` (`user_id`, `id`, `first_name`, `last_name`, `card_num4`, `action_date`, `action_num`, `amount_num`, `exam_mon`, `exam_year`, `show_allow`, `receipt_title`, `detail_title`, `cme_cycle_start`, `exam_type`) VALUES
(3010, 630, 'Ivette', 'Alfonso', '0007', 1564977600, 14, '1', 2, 2020, 0, 'Certification Exam (Main 2020)', 'For February 8, 2020 Exam', 0000, 'Certification'),
(3010, 631, 'Ivette', 'Alfonso', '0007', 1564977600, 2, '1', 2, 2020, 0, 'Certification Exam (Main 2020)', 'For February 8, 2020 Exam', 0000, 'Certification'),
(2788, 738, 'Josiah', 'McFarland', '0007', 1564977600, 14, '1', 2, 2020, 0, 'Certification Exam (Main 2020)', 'For February 8, 2020 Exam', 0000, 'Certification'),
(2788, 739, 'Josiah', 'McFarland', '0007', 1564977600, 1, '1', 2, 2020, 0, 'Certification Exam (Main 2020)', 'For February 8, 2020 Exam', 0000, 'Certification'),
(1008, 924, 'Christa M', 'Hoffman', '0007', 1581310800, 6, '1', 2, 2020, 1, 'CDQ Exam (Main 2020)', '', 0000, 'CDQ'),
(1008, 925, 'Christa M', 'Hoffman', '0007', 1581310800, 1, '1', 2, 2020, 1, 'CDQ Exam (Main 2020)', '', 0000, 'CDQ'),
(3274, 1301, 'Joseph', 'Albright', '0007', 1571630400, 21, '4', 2, 2020, 0, 'Certification Exam Retake #2 (2020)', 'For February 8, 2020 Exam', 0000, 'Certification'),
(3274, 1302, 'Joseph', 'Albright', '0007', 1571630400, 2, '4', 2, 2020, 0, 'Certification Exam Retake #2 (2020)', 'For February 8, 2020 Exam', 0000, 'Certification'),
(2591, 2070, 'David Zagorski', 'Jr', '9340', 1589725542, 3, '1', 6, 0000, 0, 'CME Payment', '', 2018, 'CME');

-- --------------------------------------------------------

--
-- Table structure for table `action_history_cdq`
--

CREATE TABLE `action_history_cdq` (
  `user_id` int(10) NOT NULL,
  `id` int(20) NOT NULL,
  `first_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `card_num4` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `action_date` int(20) NOT NULL,
  `action_num` int(2) NOT NULL,
  `amount_num` int(1) NOT NULL,
  `exam_mon` int(1) NOT NULL,
  `exam_year` year(4) NOT NULL,
  `show_allow` int(1) NOT NULL,
  `receipt_title` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `action_history_cdq`
--

INSERT INTO `action_history_cdq` (`user_id`, `id`, `first_name`, `last_name`, `card_num4`, `action_date`, `action_num`, `amount_num`, `exam_mon`, `exam_year`, `show_allow`, `receipt_title`) VALUES
(1008, 429, 'Christa M', 'Hoffman', '0007', 1581310800, 6, 1, 2, 2020, 1, 'CDQ Exam (Main 2020)'),
(1008, 430, 'Christa M', 'Hoffman', '0007', 1581310800, 1, 1, 2, 2020, 1, 'CDQ Exam (Main 2020)');

-- --------------------------------------------------------

--
-- Table structure for table `action_history_certification`
--

CREATE TABLE `action_history_certification` (
  `user_id` int(10) NOT NULL,
  `id` int(20) NOT NULL,
  `first_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `card_num4` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `action_date` int(20) NOT NULL,
  `action_num` int(2) NOT NULL,
  `amount_num` int(1) NOT NULL,
  `exam_mon` int(1) NOT NULL,
  `exam_year` year(4) NOT NULL,
  `show_allow` int(1) NOT NULL,
  `receipt_title` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `detail_title` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `action_history_certification`
--

INSERT INTO `action_history_certification` (`user_id`, `id`, `first_name`, `last_name`, `card_num4`, `action_date`, `action_num`, `amount_num`, `exam_mon`, `exam_year`, `show_allow`, `receipt_title`, `detail_title`) VALUES
(3010, 291, 'Ivette', 'Alfonso', '0007', 1564977600, 14, 1, 2, 2020, 0, 'Certification Exam (Main 2020)', 'For February 8, 2020 Exam'),
(3010, 292, 'Ivette', 'Alfonso', '0007', 1564977600, 2, 1, 2, 2020, 0, 'Certification Exam (Main 2020)', 'For February 8, 2020 Exam'),
(2788, 399, 'Josiah', 'McFarland', '0007', 1564977600, 14, 1, 2, 2020, 0, 'Certification Exam (Main 2020)', 'For February 8, 2020 Exam'),
(2788, 400, 'Josiah', 'McFarland', '0007', 1564977600, 1, 1, 2, 2020, 0, 'Certification Exam (Main 2020)', 'For February 8, 2020 Exam'),
(3274, 459, 'Joseph', 'Albright', '0007', 1547528400, 16, 1, 6, 2019, 1, 'Certification Exam (Main 2019)', 'For June 8, 2019 Exam'),
(3274, 460, 'Joseph', 'Albright', '0007', 1547528400, 3, 1, 6, 2019, 1, 'Certification Exam (Main 2019)', 'For June 8, 2019 Exam'),
(3274, 461, 'Joseph', 'Albright', '0007', 1571630400, 21, 4, 2, 2020, 0, 'Certification Exam Retake #2 (2020)', 'For February 8, 2020 Exam'),
(3274, 462, 'Joseph', 'Albright', '0007', 1571630400, 2, 4, 2, 2020, 0, 'Certification Exam Retake #2 (2020)', 'For February 8, 2020 Exam');

-- --------------------------------------------------------

--
-- Table structure for table `action_history_cme`
--

CREATE TABLE `action_history_cme` (
  `user_id` int(10) NOT NULL,
  `id` int(20) NOT NULL,
  `first_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `card_num4` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `action_date` int(20) NOT NULL,
  `action_num` int(2) NOT NULL,
  `amount_num` int(1) NOT NULL,
  `cme_cycle_start` year(4) NOT NULL,
  `issues_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_title` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `action_history_cme`
--

INSERT INTO `action_history_cme` (`user_id`, `id`, `first_name`, `last_name`, `card_num4`, `action_date`, `action_num`, `amount_num`, `cme_cycle_start`, `issues_text`, `receipt_title`) VALUES
(2591, 803, 'David Zagorski', 'Jr', '9340', 1589725542, 3, 1, 2018, '', 'CME Payment');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permission`
--

CREATE TABLE `admin_permission` (
  `user_id` bigint(20) DEFAULT '0',
  `admin_id` bigint(20) DEFAULT '0',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_permission`
--

INSERT INTO `admin_permission` (`user_id`, `admin_id`, `type`, `value`, `created`, `modified`, `enabled`) VALUES
(22, 0, 'general_setting', '1', NULL, NULL, 1),
(22, 0, 'advertisers_manage', '1', NULL, NULL, 1),
(22, 0, 'affiliates_manage', '1', NULL, NULL, 1),
(22, 0, 'offer_manage', '1', NULL, NULL, 1),
(22, 0, 'reports', '1', NULL, NULL, 1),
(22, 0, 'Payment_History', '1', NULL, NULL, 1),
(22, 0, 'content_manage', '1', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `announcementlists`
--

CREATE TABLE `announcementlists` (
  `id` int(11) NOT NULL,
  `created` date DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `visibility` int(2) DEFAULT NULL,
  `audience` varchar(255) DEFAULT NULL,
  `contents` longtext,
  `button` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcementlists`
--

INSERT INTO `announcementlists` (`id`, `created`, `subject`, `visibility`, `audience`, `contents`, `button`) VALUES
(1, '2020-05-03', 'NEW â€“ ANNOUNCEMENTS SECTION', 1, 'All', '<p><span style=\"color:#000000\">Introducing the new </span><span style=\"color:#c0392b\"><strong>Announcements</strong></span><span style=\"color:#000000\"> area of the NCCAA&rsquo;s new website. Please check this area of your member profile frequently for brief updates.</span></p>\r\n', 'NEW'),
(2, '2020-05-02', 'BLOG POSTS', 1, 'All', '<p><span style=\"color:#000000\">The Blog area of your account is utilized for longer, more detailed communications. The information will always be available in your account &ndash; no more searching for emails. Click on the Blog link to review all posts.</span></p>\r\n', ''),
(3, '2020-05-01', 'RECEIPTS', 1, 'All', '<p><span style=\"color:#000000\">For proof of payments made on the new website, please click on either CME Activity&nbsp;or CDQ Activity and scroll to the bottom of the page for a copy of your receipt.</span></p>\r\n', 'IMPORTANT'),
(4, '2020-05-04', 'VERIFICATION OF CERTIFICATION REQUESTS', 0, 'All', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bloglikes`
--

CREATE TABLE `bloglikes` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bloglikes`
--

INSERT INTO `bloglikes` (`user_id`, `id`, `post_id`, `created`) VALUES
(2591, 32, 25, '2020-01-22 17:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `bloglists`
--

CREATE TABLE `bloglists` (
  `id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `contents` text,
  `views` int(11) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `publish` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bloglists`
--

INSERT INTO `bloglists` (`id`, `created`, `author`, `title`, `contents`, `views`, `likes`, `publish`) VALUES
(44, '2020-02-01 00:00:00', 'Soren Campbell', 'Message from NCCAA CEO', '<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">As the NCCAA continues to make improvements to the CAA user experience, while maintaining the integrity of the CAA certification process, let&rsquo;s take a moment to reflect back on 2019.&nbsp; In April of 2019, the NCCAA hosted our first-ever NCCAA Town Hall meeting, in order to gather information and feedback from the CAA community.&nbsp; In conjunction with a national survey, at the meeting, the NCCAA received valuable feedback about what is important to CAAs regarding their certification process.&nbsp; The following is a list of concerns and desires communicated to the NCCAA through the meeting and survey.&nbsp; Included in <em>italics</em> are the corresponding actions taken by the NCCAA to address the concerns of the CAA community.</span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Increase time interval for CDQ exam</span></span></strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> - <em>Board voted to extend Continued Certification Assessment timeline, redesign process is currently in development, utilizing a profession-wide CAA Workgroup for feedback and comment.</em></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ol start=\"2\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Focused exam preparation materials</span></span></strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> - <em>in development as part of Education &amp; Remediation Projects addressing several concerns of CAAs. Specifically, a bank of practice exam questions is well underway.</em></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ol start=\"3\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Exam Study Guide</span></span></strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> - <em>in development as part of Education &amp; Remediation Projects addressing several concerns of CAAs. Specifically, working with educational collaborators to create in-person exam preparation educational meetings.</em></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ol start=\"4\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">More clinically-relevant CDQ</span></span></strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> - <em>Exam Committee constantly strives to accomplish a clinically relevant exam, through continuous review of content outline, including analysis of recent Educational Survey data, allowing for exams closely linked to CAA current practice. </em></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:48px\"><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><em>&nbsp;</em></span></span></span></p>\r\n\r\n<ol start=\"5\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Increased CME opportunities for CAAs</span></span></strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> -<em> Creating, Distributing and Analytics of Educational Survey data.&nbsp; Publishing (Q1 2020) should attract more CME providers in the learning medium and content areas that CAAs prefer and utilize.&nbsp; Thereby, increasing CME opportunities for CAAs.</em></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ol start=\"6\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Remediation</span></span></strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> - <em>in development, in conjunction with the Continued Certification 10 year timeline project.</em></span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<ol start=\"7\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Collecting data on what study materials are being utilized by CAAs and what method of learning (eg. in-person, online) CAAs prefer - </span></span></strong><em><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Educational Needs Assessment Survey completed and awaiting Board approval for publication.</span></span></em></span></span></span></li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Over the course of 2019, the NCCAA Board listened to the CAA community and focused their attention on certification, remediation and promotion of post-graduation continuing medical education, including exam preparation.&nbsp; The Board leadership of the NCCAA is currently working on both long- and short-term strategic plans.&nbsp; Finally, the Board has welcomed a new Chair, Megan Varellas, and offers thanks and gratitude to Sherryl Adamic for her years of service.</span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Helvetica Neue&quot;\"><span style=\"color:black\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">2020 has started with the launch of the new NCCAA website.&nbsp; Throughout 2020, the web presence of NCCAA will be used to communicate with CAAs, hospitals, licensing authorities, and the public on all things related to CAA certification.&nbsp; The 10-year Continued Certification Project continues to be developed with the help of a workgroup comprised of practicing CAAs, many of whom hold or have held leadership positions within the CAA profession.&nbsp; Lastly, NCCAA leadership has engaged CAA leaders for comment regarding NCCAA strategic planning via a NCCAA Strategic Survey.&nbsp; Through these efforts, to encourage the involvement of CAAs outside of the NCCAA Board, the NCCAA continues to build relationships, thus strengthening the Commission and empowering CAAs to be a part of their certification process.</span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n', 78, 0, 'Yes'),
(45, '2020-02-02 00:00:00', 'Megan Varellas', 'Message from NCCAA Board of Directors Chair', '<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:black\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">NCCAA assures the public of CAA safety but should also provide significant value to professionals using our services.&nbsp;&nbsp; The Board of Directors of the NCCAA functions as a development team, working to create services for professionals which are consistent with the goals of the organization. The NCCAA strives to ensure greater access to the education and professional development necessary to assist professionals in learning, maintaining and honing the skills required to perform their services at the highest possible level of skill, while helping that professional to be assured that he or she can comfortably check off knowledge benchmarks to achieve</span></span><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> certification.</span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:black\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Across all healthcare professions, continuing education and professional certification is evolving away from high stakes testing and is moving towards providing a true benefit of continued learning, growth, and achievement in health care practice for the applicant.&nbsp;&nbsp; There is no shortage of opinions on how best to certify or measure the skills necessary to healthcare providers and NCCAA is constantly researching, reviewing, and considering new progressive approaches to our operations and services. We are committed to developing and providing the highest quality of those services and operations possible in order to gain your satisfaction.&nbsp;&nbsp; NCCAA wants to invest in you, both personally and professionally, by updating our certification and recertification programs, creating new programs such as a reentry for professionals who have been out of clinical practice and written exam content review products, creating educational materials that provide true and measurable skills to help the user focus on his or her career development, and improving our methods of communicating and interacting with practitioners, among many other practitioner requests.&nbsp; </span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:black\"><span style=\"font-size:13.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">You, the practitioner, are our most important asset. Your feedback is critical to our success.&nbsp; We want to learn from our mistakes as well as our successes. To ensure that you are heard, we will review the results of both the second practice survey and multi organization leadership survey at our Q1 meeting to see what we did right, what we did wrong, and what we could do better.&nbsp; We will strive to reduce disruption and added stress to our providers, and to offer clear and concise communication as updates to the process occurs.&nbsp; We are all challenged as healthcare providers generally, and specifically as CAAs.&nbsp; We all want to be part of a profession that enjoys recognition for delivering high quality anesthesia care as advanced practice providers. I hope you will take a few minutes to view the board members and answer our survey questions when you log in on our new website.&nbsp; We look forward to hearing from you.&nbsp; </span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 66, 0, 'Yes'),
(46, '2020-03-20 00:00:00', 'Megan Varellas', 'COVID-19 and Online CME Opportunities', '<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Dear CAA Community,&nbsp;</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Thank you for the important role that you play in the healthcare field as we enter this challenging time in combatting COVID-19. You are a critical part of what is already a stressed healthcare system, focused on ensuring patients continue to get the critical care they need beyond COVID.&nbsp;&nbsp;</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">We know that this is also a difficult time, personally, with the need to make significant lifestyle changes, manage family disruptions, and stay healthy.&nbsp;</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Over the past several days, federal and local governments and many employers have imposed travel restrictions and bans on large group gatherings in an effort to slow the spread of the virus.</span></span></span><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:#202020\"><span style=\"background-color:white\">&nbsp;The CDC issued new guidelines for social distancing, recommending events with 50 or more attendees be postponed for at least&nbsp;</span><strong>eight weeks</strong><span style=\"background-color:white\">&nbsp;in an effort to mitigate the coronavirus&rsquo;s spread.&nbsp;</span></span></span></span><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">This will lead to several meeting and event postponements and cancellations. We understand this can be frustrating, due to efforts to make advance arrangements and adjust your schedules.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">With the high level of public uncertainty and heightened anxiety with regard to their health, now as much as ever, the CAA profession needs to assure our greater communities and patients of our readiness and competency.&nbsp;Therefore, we will continue to handle certification issues as we always have. In a similar manner to how our nation&rsquo;s schools and universities are handling this pandemic, we encourage CAAs to look to online/distance learning for their Continuing Medical Education (CME) needs. With the unknown trajectory and timeline of this pandemic, understanding potential options to help you meet your CME certification requirements is important.&nbsp;&nbsp;</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">What is NCCAA doing to help?&nbsp;&nbsp;</span></span></span></strong><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Your NCCAA team has pulled together a list of CME resources that are available without the need for travel or gathering with large groups of people.&nbsp;Please see the list below. Inclusion in this list is not an endorsement by the NCCAA and exclusion from this list does not indicate that a CME activity is not applicable for NCCAA CME registration. These resources were pulled from historical NCCAA CME submission data as a guide to help you in your search for CME resources.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">The NCCAA simply desires to help you find the necessary resources to maintain your certification through this difficult time.&nbsp;</span></span></span></span></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">AnesthesiaFile-Dannemiller:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://www.anesthesiafile.com</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Audio Digest:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://www.audio-digest.org/Specialties/Anesthesiology</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">ACE-CAA &amp; ASA SEE &amp; ASA Journal CME:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://www.asahq.org/shop-asa#sort=relevancy</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">American Seminar Institute:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://www.americanseminar.com</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">UpToDate:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://www.uptodate.com/home</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Medscape CME:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://www.medscape.org/anesthesiology</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">NetCE:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://www.netce.com</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">International Anesthesia Research Society:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://iars.org</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Frank Moya Continuing Education Programs:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://www.currentreviews.com</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Oakstone CME:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;<a href=\"http://Â https://www.oakstone.com\">&nbsp;</a>https://www.oakstone.com</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">OpenAnesthesia:</span></span></span></strong><span style=\"font-size:10pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">&nbsp;&nbsp;https://www.openanesthesia.org</span></span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Below are a few FAQs we&rsquo;ve been receiving, that we&rsquo;d like to address:</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><strong><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">FAQS</span></span></span></span></span></span></strong></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Are there any changes to NCCAA&rsquo;s office schedule or board member meetings?&nbsp;</span></span></span></strong><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">NCCAA staff will remain available to answer questions and provide clarification regarding all matters related to your certification. To contact us, please send an email to <a href=\"mailto:contact@nccaa.org\">contact@nccaa.org</a>.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><strong><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Which association meetings and training events have been cancelled?&nbsp;</span></span></span></strong><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">As you can imagine, this is a rapidly changing situation, based on local government regulations, venue decisions and requirements, such as any changes regarding the availability of presenters and instructors. Please check the websites of the event coordinators to learn their latest plans and any options they may offer as an alternative to enable you to secure CME.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:medium\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#000000\"><span style=\"font-size:10.5pt\"><span style=\"font-family:Helvetica\"><span style=\"color:black\">Thank you all for everything you do every day to improve the lives of those in your communities. Please remember to also take care of yourselves. We will continue to share information we receive as it relates to events or new opportunities for CME in an effort to help you maintain your certification.</span></span></span></span></span></span></p>\r\n', 180, 1, 'Yes'),
(47, '2020-03-22 00:00:00', 'Megan Varellas', 'Making Your Own Reusable Elastomeric Respirator For Use During Covid-19 Viral Pandemic N95 Shortage', '<h1><strong><span style=\"font-size:12px\">Click the link &quot;Read More&quot; below to follow and view the YouTube Video&nbsp;for &quot;Making Your Own Reusable Elastomeric Respirator For Use During Covid-19 Viral Pandemic N95 Shortage.&quot;</span></strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"https://www.youtube.com/watch?v=Es_iY5WJdmI&amp;feature=youtu.be\">Y</a><a href=\"https://www.youtube.com/watch?v=Es_iY5WJdmI&amp;feature=youtu.be\" target=\"_blank\">ouTube Video Here</a></p>\r\n\r\n<p>&nbsp;</p>\r\n', 34, 0, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `blogviews`
--

CREATE TABLE `blogviews` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogviews`
--

INSERT INTO `blogviews` (`user_id`, `id`, `post_id`, `created`) VALUES
(3274, 28, 3, '2019-05-24 06:13:42'),
(0, 35, 1, '2019-09-30 16:13:02'),
(1008, 207, 45, '2020-02-19 20:06:50'),
(0, 240, 45, '2020-02-24 18:43:20'),
(0, 540, 44, '2020-05-12 11:15:16'),
(0, 523, 46, '2020-05-07 09:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `caas`
--

CREATE TABLE `caas` (
  `user_id` varchar(220) NOT NULL,
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(20) DEFAULT '0',
  `type` varchar(255) DEFAULT 'User',
  `account_type` varchar(255) DEFAULT 'U',
  `certificate_no` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `employer` varchar(255) DEFAULT NULL,
  `facility` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT 'Male',
  `age` varchar(255) DEFAULT NULL,
  `years` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `gps` varchar(255) DEFAULT NULL,
  `confirm` varchar(255) DEFAULT NULL,
  `on_date` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT 'user',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cdq_history`
--

CREATE TABLE `cdq_history` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `scheduled` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(32) NOT NULL,
  `result` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `user_id` varchar(220) NOT NULL,
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(20) DEFAULT '0',
  `type` varchar(255) DEFAULT 'User',
  `account_type` varchar(255) DEFAULT 'U',
  `certificate_no` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `employer` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `gps` varchar(255) DEFAULT NULL,
  `confirm` varchar(255) DEFAULT NULL,
  `on_date` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT 'user',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ip_address` varchar(45) COLLATE utf8_bin NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('02be91ced256418507e15669fab6b40f49af5422', '1.39.222.68', 1590331322, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303333313332323b),
('05368843e2623b73893900ddf3331ceacec914f8', '216.97.208.249', 1590253827, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303235333832373b),
('0c1dd870457adaa048fa4e6bbe65481537870f43', '49.206.180.162', 1590352449, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303335323434393b),
('0cd2952491546f0e8e2cc495bc6e4c0471d053f6', '216.97.208.249', 1590068824, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303036383832343b),
('121c8a578177039a5780c31469f4ce96ef01e2c4', '216.97.208.249', 1590073749, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037333734393b),
('18ac26167f10406464f3f4fb44ff54233763ed01', '1.39.208.112', 1590228916, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232383931363b),
('19128bcfa4a9d111cd1696f966bd2b0fe93f9482', '49.206.178.162', 1590070535, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037303533353b),
('1c302957649d549ed862902b47cdd33c27407184', '216.97.208.249', 1590151177, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303135313137373b),
('2058b4507029b65f067a36de76080c6f56bbab78', '49.206.180.162', 1590354250, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303335343235303b),
('20cbaaceb37818d7aa9e7a0ce395ed7d5aeee6c4', '216.97.208.249', 1590073471, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037333437303b),
('227b86772b57b3c642da7184b2ea4d860f526fc0', '49.206.178.162', 1590070782, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037303738323b),
('26dff36d5e76f01d242942777100fc0796bdd153', '216.97.208.249', 1590253845, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303235333832373b),
('27b54e5c560f9955cb7f35f38f55e8bf4a8451d9', '157.37.255.163', 1590071648, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037313437333b),
('2802aa695b42cbf26dfde6980ff857fd37973bf8', '1.39.196.22', 1590225243, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232353234333b),
('2b9aada15ec7b8f1db8e8f8659c95dac98a6132d', '1.39.208.112', 1590226080, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232363038303b),
('2d2f5f31ad4aa0caad0af196febe3dd2dea71c07', '49.206.180.162', 1590354867, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303335343836373b),
('2f54d1f3bbde689df86c8fa2ffa54a27a27cf1f4', '49.206.184.12', 1590227595, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232373539353b),
('340bbc146e485ba0c1478190abfc410f05ee6f19', '1.39.208.112', 1590214954, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303231343935343b),
('343d9a48641ea370f38a8a797514ecb6746cfde2', '1.39.204.163', 1590330638, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303333303633383b),
('34b1a874376f8f41ba27fe829ffa712f7d424dd5', '49.206.184.12', 1590227533, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232373439303b),
('388fcbd6ca0b53cc5baf4369c98fa8ee890d5b85', '49.206.178.162', 1590070569, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037303536393b),
('3a9f87ed59496c94a9c91ca44bc6eafa32e13c18', '1.39.204.163', 1590331322, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303333313332323b),
('43d5d0e5ca657bc11367d30c56d800959bcc2795', '49.206.184.12', 1590281393, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303238313339333b),
('44cefcb3a5935813134bffe583fff477d1d0323a', '49.206.180.162', 1590353614, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303335333631343b),
('493dc91d2d812a6f50a163437579b0db79e05e7f', '216.97.208.249', 1590318239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303331383135323b),
('4f3b42fcbed079a63cc17c3ddd36c97dd5421fc4', '216.97.208.249', 1590066898, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303036363839383b),
('4ff8b9d58e9430774ff20084061abe92282ff57b', '1.39.196.22', 1590226570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232363537303b),
('50692ff6eea68a43026bcb170c058161be33461a', '216.97.208.249', 1590318152, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303331383135323b),
('55b3dc882fb8cf16b3f33738cc2cc712e417e550', '49.206.180.162', 1590350148, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303335303134383b),
('59f1258ec2100a7878ead7373874f1dcadbd6ec0', '216.97.208.249', 1590073749, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037333734393b),
('5cfaea0144506b4e571437f08b821e4ea152cc07', '1.39.208.112', 1590226875, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232363837353b),
('63168aa00971d8533c7df63435203cd46a758773', '49.206.180.162', 1590354868, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303335343836373b),
('6f32ccfa0851fccbb498bbe5d5896a9786385952', '216.97.208.249', 1590114521, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303131343532313b),
('720edc230294f90f2f088d8cea6900830ce92bfb', '216.97.208.249', 1590073583, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037333538323b),
('7310ad87438d1c1a05e2e9a05bb4f495d92f97f8', '78.109.18.227', 1590263630, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303236333633303b),
('7c8208e1ce346099e26b10f47d6eeb56cac674c8', '1.39.208.112', 1590228603, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232383630333b),
('8531c6d5dfc5ea879b1c136509f96de3364b47d7', '216.97.208.249', 1590114521, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303131343532313b),
('88169f7eb83ba96e87034e1c9bc077bec0e86bc1', '49.206.178.162', 1590070782, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037303738323b),
('8b0e0476fe7a85075aa266d3b800902f1e9a3db2', '1.39.204.163', 1590329786, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303332393738363b),
('9b0c36afbd7e50d10f1fc0be42dd58ca6d19ec52', '216.97.208.249', 1590068071, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303036383037313b),
('a46a0a0cc1daa1d260d752ddee9a50c3a55cd81a', '52.114.14.102', 1590071827, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037313832373b),
('ab218498fad59b40e2e7e064e2954a0b2b3f5e70', '1.39.197.21', 1590289104, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303238393130343b),
('b8292e6d08550880eba3cfac1c6f0491b1daa7a1', '216.97.208.249', 1590292464, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303239323234323b),
('b99eea524348158ca848dd868dce38bb36a9244f', '216.97.208.249', 1590346304, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303334363234363b),
('c039330823105ff12e90e9ac76b285bc1a8a6cd3', '1.39.208.112', 1590213056, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303231333035363b),
('c29da98882f1712f41a906b408c7fa7af12e0a2a', '1.39.208.112', 1590214954, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303231343935343b),
('c9a5af0a4ec4e88378dc87036f4c6412ac3289b7', '49.206.180.162', 1590353300, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303335333330303b),
('ce05b61df51ded55d015fca76cb2d2c5179b5cce', '49.206.180.162', 1590352146, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303335323134363b),
('d0e6ec915bc2e4250251218b3cc5a6fd64d6c811', '52.114.14.102', 1590212677, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303231323637373b),
('d6244658cba4e540ce56f9d63e9e4ff9d8330771', '216.97.208.249', 1590263578, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303236333537383b),
('e0b1cd61c5bd45089f0952ecece6c7e536a6f348', '1.39.196.22', 1590227722, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232373732323b),
('e2e0a48a9a5bc3ffa88f9477d5944f2744b5a3f7', '1.39.208.112', 1590214610, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303231343631303b),
('e5d366f416cefc40a82d28717be9cc13dfa3fd4f', '216.97.208.249', 1590069421, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303036393432313b),
('e73be425512af068b01cf33d1e4d497255577347', '49.206.179.54', 1590086488, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303038363438383b),
('eb0bbff8e58c45f891119cf3f74ed5daabd3a5e4', '49.206.176.54', 1590402454, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303430323435343b),
('ec07bd542c036c86af1683d7e76d74153611f2e5', '1.39.196.22', 1590228916, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232383931363b),
('ee8f371389841c44ffdee60d23f1932d3f6370e4', '216.97.208.249', 1590427639, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303432373633393b),
('f3fd4928023d61394a6b66e066ee5ce57f4484e9', '49.206.178.162', 1590070501, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303037303438333b),
('f5541a5049a37c474910e7883e9cd1a7ef27f9e3', '1.39.208.112', 1590225612, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232353631323b),
('fbdd3ed5f30d00039ab895b067089eefb6d58f26', '49.206.184.12', 1590227595, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539303232373539353b);

-- --------------------------------------------------------

--
-- Table structure for table `cme_history`
--

CREATE TABLE `cme_history` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `credits` float NOT NULL,
  `facility` varchar(255) NOT NULL,
  `credit_datetime` datetime NOT NULL,
  `attachment_id` int(11) NOT NULL,
  `attachment_datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_blast`
--

CREATE TABLE `email_blast` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL COMMENT 'Blast Email Sender id',
  `receiver_ids` varchar(255) DEFAULT '' COMMENT 'Receiver Id values',
  `subject` varchar(255) DEFAULT '' COMMENT 'Blast Email subject',
  `attach` varchar(255) DEFAULT '' COMMENT 'Blast Email attach',
  `content` mediumtext COMMENT 'Blast Email content',
  `regdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Email sent date ',
  `receiver_to` varchar(255) DEFAULT NULL COMMENT 'Receiver Emails',
  `receiver_cc` varchar(255) DEFAULT '' COMMENT 'Receiver''s CC Emails',
  `receiver_bcc` mediumtext COMMENT 'Receiver BCC Emails',
  `banner_img` varchar(255) DEFAULT '' COMMENT 'Email template''s banner IMG',
  `activate` int(255) DEFAULT '1' COMMENT '1: active, 0: inactive',
  `sender_email` varchar(255) DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `sender_ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_group`
--

CREATE TABLE `email_group` (
  `users_id` varchar(255) DEFAULT NULL COMMENT 'users tbl id',
  `id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT '' COMMENT 'Group Name',
  `is_active` int(255) DEFAULT '1' COMMENT 'alive/ not',
  `regdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_message`
--

CREATE TABLE `email_message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL COMMENT 'sender id: FROM user id',
  `receiver_id` int(11) DEFAULT '0' COMMENT 'sender : To user id',
  `subject` varchar(255) DEFAULT '' COMMENT 'msg title',
  `attach` varchar(255) DEFAULT '' COMMENT 'msg attach file ',
  `content` text COMMENT 'msg content',
  `read` int(255) DEFAULT '0' COMMENT 'read flag: 0=not readed, 1=readed',
  `regdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'msg created date',
  `opendate` timestamp NULL DEFAULT NULL COMMENT 'msg opened date',
  `is_del` int(255) DEFAULT '0' COMMENT 'delete msg id: 0=exist, 1=deleted',
  `p_id` int(11) DEFAULT '0' COMMENT 'Parent Message ID'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `admin_id` bigint(20) DEFAULT '0',
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `gps` varchar(255) DEFAULT NULL,
  `on_date` datetime DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `errorsubmission`
--

CREATE TABLE `errorsubmission` (
  `error_id` int(10) UNSIGNED NOT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `addeddate` date DEFAULT NULL,
  `issue` longtext,
  `attachedfile` varchar(255) DEFAULT NULL,
  `hardware` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `browser_version` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `connection` varchar(255) DEFAULT NULL,
  `screen_size` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `email` varchar(255) DEFAULT NULL,
  `fix_content` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_account_security_information`
--

CREATE TABLE `final_account_security_information` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `id_crm` int(8) DEFAULT NULL,
  `id_certificate` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last4ssn` int(5) DEFAULT NULL,
  `security_information` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `social_security` varchar(255) DEFAULT NULL,
  `mother_maiden_name` varchar(255) DEFAULT NULL,
  `alma_mater` varchar(100) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_account_security_information`
--

INSERT INTO `final_account_security_information` (`user_id`, `id`, `id_crm`, `id_certificate`, `username`, `password`, `last4ssn`, `security_information`, `dob`, `social_security`, `mother_maiden_name`, `alma_mater`, `active`) VALUES
(2788, 2825, 0, 0, 'jcm188@case.edu', 'uujK5mlf', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3010, 3121, 0, 0, 'iamb6@mail.umkc.edu', 'q5OAr6Tj', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2591, 3469, 21937239, 495, 'sleepman23@gmail.com', '123456', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3274, 5641, NULL, 0, NULL, NULL, NULL, NULL, '1969-12-31', NULL, NULL, '9', 1),
(1008, 5844, 2, 2, 'demo02@gmail.com', 'demopass02', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3476, 5845, NULL, 0, NULL, NULL, NULL, NULL, '2000-05-01', NULL, NULL, '72', 1),
(3478, 5846, NULL, 0, NULL, NULL, NULL, NULL, '2020-05-01', NULL, NULL, '72', 1),
(3479, 5847, NULL, 0, NULL, NULL, NULL, NULL, '2000-01-01', NULL, NULL, '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `final_address_contact_information`
--

CREATE TABLE `final_address_contact_information` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `apt_suite` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `gps` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1',
  `cell_phone` varchar(255) DEFAULT NULL,
  `business_phone` varchar(255) DEFAULT NULL,
  `home_phone` varchar(255) DEFAULT NULL,
  `other_phone` varchar(255) DEFAULT NULL,
  `email_default` varchar(255) DEFAULT NULL,
  `confirm_email` varchar(255) DEFAULT NULL,
  `email_default2` varchar(255) DEFAULT NULL,
  `confirm_email2` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_address_contact_information`
--

INSERT INTO `final_address_contact_information` (`user_id`, `id`, `address_1`, `apt_suite`, `city`, `state`, `zip_code`, `gps`, `country`, `active`, `cell_phone`, `business_phone`, `home_phone`, `other_phone`, `email_default`, `confirm_email`, `email_default2`, `confirm_email2`) VALUES
(1008, 1075, '1572 Blue Water Ter N  ', '212', 'Pompano Beach', 'FL', '33062', '26.2474478, -80.0926014', 'United States', 1, '954-692-1555', '954-692-1555', '954-692-1555', '954-692-1555', 'christamloar@yahoo.com', 'christamloar@yahoo.com', 'christamloar@yahoo.com', 'christamloar@yahoo.com'),
(2591, 1371, '16780 Snyder Rd ', '212', 'Chagrin Falls', 'OH', '44023', '41.4298516, -81.3910999', 'United States', 1, '', '', '', '', 'sleepman23@gmail.com', 'sleepman23@gmail.com', 'sleepman23@gmail.com', 'sleepman23@gmail.com'),
(3274, 10079, NULL, NULL, NULL, NULL, '', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3476, 10322, NULL, NULL, NULL, NULL, '77777', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3478, 10323, NULL, NULL, NULL, NULL, '77777', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3479, 10324, NULL, NULL, NULL, NULL, '66677', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `final_add_another_address`
--

CREATE TABLE `final_add_another_address` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `another_address` varchar(255) NOT NULL,
  `another_apt` varchar(255) NOT NULL,
  `another_city` varchar(255) NOT NULL,
  `another_state` varchar(255) NOT NULL,
  `another_zip` varchar(255) NOT NULL,
  `another_country` varchar(255) NOT NULL,
  `active` bigint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_employee_skills`
--

CREATE TABLE `final_employee_skills` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `languages_speak` varchar(255) DEFAULT NULL,
  `other_than_english` varchar(255) DEFAULT NULL,
  `which_languages` varchar(255) DEFAULT NULL,
  `teach_or_environment` varchar(255) DEFAULT NULL,
  `teach_healthcare_or` varchar(255) DEFAULT NULL,
  `all_specialities_techniques` varchar(1000) DEFAULT NULL,
  `all_specialities_techniques_other` varchar(255) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1',
  `skills_languages2` varchar(100) DEFAULT NULL,
  `skills_languages3` varchar(100) DEFAULT NULL,
  `skills_languages4` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_employee_skills`
--

INSERT INTO `final_employee_skills` (`user_id`, `id`, `languages_speak`, `other_than_english`, `which_languages`, `teach_or_environment`, `teach_healthcare_or`, `all_specialities_techniques`, `all_specialities_techniques_other`, `active`, `skills_languages2`, `skills_languages3`, `skills_languages4`) VALUES
(3479, 578, NULL, NULL, NULL, 'No', 'No', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `final_employer_benefits`
--

CREATE TABLE `final_employer_benefits` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `employer_offer_benefit` varchar(500) DEFAULT NULL,
  `other_benefits` varchar(500) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_employer_compensation`
--

CREATE TABLE `final_employer_compensation` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `basic_compension` varchar(255) DEFAULT NULL,
  `full_compension` varchar(255) DEFAULT NULL,
  `employer_overtime_pay` varchar(255) DEFAULT NULL,
  `employer_overtime_compensation` varchar(255) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_employer_retirement`
--

CREATE TABLE `final_employer_retirement` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `retirement_setup_plan` varchar(500) DEFAULT NULL,
  `retirement_setup_plan_other` varchar(255) DEFAULT NULL,
  `profit_sharing` varchar(255) DEFAULT NULL,
  `employer_matching` varchar(255) DEFAULT NULL,
  `employer_offer_lumpsum` varchar(255) DEFAULT NULL,
  `pension_of` varchar(255) DEFAULT NULL,
  `after_service_years` varchar(255) DEFAULT NULL,
  `service_offer_other` varchar(255) DEFAULT NULL,
  `anticipated_year_retirement` varchar(255) DEFAULT NULL,
  `anticipated_month_retirement` varchar(255) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_employment_info`
--

CREATE TABLE `final_employment_info` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `first_employment_date` date DEFAULT NULL,
  `employment_status` varchar(255) DEFAULT NULL,
  `employement_practice_state1` varchar(255) DEFAULT NULL,
  `employement_practice_state2` varchar(255) DEFAULT NULL,
  `employement_practice_state3` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `employer_name` varchar(255) DEFAULT NULL,
  `employer_address` varchar(255) DEFAULT NULL,
  `employer_city` varchar(255) DEFAULT NULL,
  `employer_state` varchar(255) DEFAULT NULL,
  `employer_zip` varchar(255) DEFAULT NULL,
  `employer_gps` varchar(255) DEFAULT NULL,
  `employer_phone` varchar(255) DEFAULT NULL,
  `type_setting_1` varchar(255) DEFAULT NULL,
  `type_setting_1_other` varchar(255) DEFAULT NULL,
  `type_setting_2` varchar(255) DEFAULT NULL,
  `type_setting_2_other` varchar(255) DEFAULT NULL,
  `providers_grp1` varchar(255) DEFAULT NULL,
  `providers_grp2` varchar(255) DEFAULT NULL,
  `providers_grp3` varchar(255) DEFAULT NULL,
  `typical_weekly1` varchar(1000) DEFAULT NULL,
  `typical_weekly_other` varchar(255) DEFAULT NULL,
  `divided_1` varchar(255) DEFAULT NULL,
  `divided_2` varchar(255) DEFAULT NULL,
  `divided_3` varchar(255) DEFAULT NULL,
  `divided_4` varchar(255) DEFAULT NULL,
  `divided_5` varchar(255) DEFAULT NULL,
  `divided_6` varchar(255) DEFAULT NULL,
  `divided_7` varchar(255) DEFAULT NULL,
  `divided_8` varchar(255) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1',
  `employer_apt` varchar(100) DEFAULT NULL,
  `employer_email` varchar(100) DEFAULT NULL,
  `employer_email_conf` varchar(100) DEFAULT NULL,
  `employer_email2` varchar(100) DEFAULT NULL,
  `employed_group_other` varchar(100) DEFAULT NULL,
  `typical_weekly_hour` varchar(150) DEFAULT NULL,
  `first_employment_year` varchar(10) DEFAULT NULL,
  `employer_country` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_exam_certification_info`
--

CREATE TABLE `final_exam_certification_info` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `expected_test_date` text,
  `actual_exam_date_taken` date DEFAULT NULL,
  `actual_exam_result` varchar(255) DEFAULT NULL,
  `certification_expected_test_date` date DEFAULT NULL,
  `actual_certification_exam_taken` date DEFAULT NULL,
  `actual_certification_result` varchar(255) DEFAULT NULL,
  `expected_test_date_2` date DEFAULT NULL,
  `actual_exam_date_taken2` date DEFAULT NULL,
  `actual_exam_result2` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `fail_opportunities` varchar(255) DEFAULT NULL,
  `pass_opportunities` varchar(255) DEFAULT NULL,
  `registration_cycle` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `title_of_meeting` varchar(255) DEFAULT NULL,
  `c_start_date` date DEFAULT NULL,
  `c_end_date` date DEFAULT NULL,
  `c_time` varchar(255) DEFAULT NULL,
  `accredited_by` varchar(255) DEFAULT NULL,
  `accredited_by2` varchar(255) DEFAULT NULL,
  `search_expiration_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `past_periods` varchar(255) DEFAULT NULL,
  `exam_accomodations` varchar(255) DEFAULT NULL,
  `prior_attempts` varchar(255) DEFAULT NULL,
  `country_region_id` varchar(255) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_generalinform`
--

CREATE TABLE `final_generalinform` (
  `user_id` int(20) NOT NULL,
  `final_generalinform_id` int(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `f_name` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `m_name` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `l_name` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `suffix` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_generalinform`
--

INSERT INTO `final_generalinform` (`user_id`, `final_generalinform_id`, `title`, `f_name`, `m_name`, `l_name`, `suffix`, `status`) VALUES
(1008, 1008, NULL, 'Test01', 'M', 'Jolene', NULL, NULL),
(2591, 2591, NULL, 'Arilius', 'R', 'Lewis', NULL, NULL),
(2788, 2768, NULL, 'Shooter', NULL, 'McGavin', NULL, NULL),
(3010, 2990, NULL, 'Shank', NULL, 'Rodriquez', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `final_other_memberships`
--

CREATE TABLE `final_other_memberships` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `belong_to_othermembership` varchar(255) DEFAULT NULL,
  `dated_joined` text,
  `membership_number` varchar(255) DEFAULT NULL,
  `other_groups_belongs` varchar(255) DEFAULT NULL,
  `comments` varchar(1000) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1',
  `group_name` varchar(150) DEFAULT NULL,
  `group_name2` varchar(100) DEFAULT NULL,
  `dated_joined2` varchar(100) DEFAULT NULL,
  `membership_number2` varchar(100) DEFAULT NULL,
  `comments2` varchar(100) DEFAULT NULL,
  `group_name3` varchar(150) DEFAULT NULL,
  `dated_joined3` varchar(100) DEFAULT NULL,
  `membership_number3` varchar(100) DEFAULT NULL,
  `comments3` varchar(100) DEFAULT NULL,
  `national` varchar(220) NOT NULL,
  `StateLevel_Assistants` varchar(220) NOT NULL,
  `national1` varchar(220) NOT NULL,
  `StateLevel_Anesthesiologists` varchar(220) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_personal_information`
--

CREATE TABLE `final_personal_information` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `active` bigint(1) DEFAULT '1',
  `age` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `race` varchar(255) DEFAULT NULL,
  `ethnicity` varchar(255) DEFAULT NULL,
  `ethnicity_other` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `any_children` varchar(255) DEFAULT NULL,
  `no_of_children` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_personal_information`
--

INSERT INTO `final_personal_information` (`user_id`, `id`, `active`, `age`, `gender`, `race`, `ethnicity`, `ethnicity_other`, `height`, `weight`, `marital_status`, `any_children`, `no_of_children`) VALUES
(3274, 87, 1, NULL, 'm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3476, 606, 1, NULL, 'Neutral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3478, 607, 1, NULL, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3479, 608, 1, NULL, 'Male', '', '', '', NULL, NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `final_program_university_info`
--

CREATE TABLE `final_program_university_info` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `actual_graduation_date` date DEFAULT NULL,
  `actual_grad_year` varchar(10) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `university_id` int(11) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `university_apt` varchar(15) DEFAULT NULL,
  `univerisity_code` varchar(255) DEFAULT NULL,
  `university_address` varchar(255) DEFAULT NULL,
  `university_state` varchar(255) DEFAULT NULL,
  `university_city` varchar(255) DEFAULT NULL,
  `university_zip_code` varchar(255) DEFAULT NULL,
  `university_phone` varchar(255) DEFAULT NULL,
  `univeristy_program_director` varchar(255) DEFAULT NULL,
  `univeristy_program_director_last_name` varchar(150) DEFAULT NULL,
  `univeristy_program_director_designation` varchar(150) DEFAULT NULL,
  `university_phone2` varchar(255) DEFAULT NULL,
  `university_school` varchar(255) DEFAULT NULL,
  `matric_date` date DEFAULT NULL,
  `expected_graduation_date` date DEFAULT NULL,
  `program_length` varchar(255) DEFAULT NULL,
  `clinical_length` varchar(255) DEFAULT NULL,
  `specialities_training` varchar(500) DEFAULT NULL,
  `degree_type1` varchar(255) DEFAULT NULL,
  `degree_type2` varchar(255) DEFAULT NULL,
  `years_certified` varchar(255) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `other_specialities` varchar(255) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1',
  `university_photo` varchar(150) DEFAULT NULL,
  `one_year_certified` int(15) DEFAULT NULL,
  `university_email` varchar(150) DEFAULT NULL,
  `university_email_conf` varchar(150) DEFAULT NULL,
  `university_url` varchar(150) DEFAULT NULL,
  `univeristy_program_director_phone` varchar(100) DEFAULT NULL,
  `univeristy_program_director_email` varchar(100) DEFAULT NULL,
  `univeristy_program_director1` varchar(100) DEFAULT NULL,
  `univeristy_program_director_last_name1` varchar(100) DEFAULT NULL,
  `univeristy_program_director_designation1` varchar(100) DEFAULT NULL,
  `univeristy_program_title1` varchar(100) DEFAULT NULL,
  `univeristy_program_director_phone1` varchar(100) DEFAULT NULL,
  `univeristy_program_director_email1` varchar(100) DEFAULT NULL,
  `univeristy_program_director2` varchar(100) DEFAULT NULL,
  `univeristy_program_director_designation2` varchar(100) DEFAULT NULL,
  `univeristy_assistant_phone` varchar(150) DEFAULT NULL,
  `univeristy_assistant_email` varchar(150) DEFAULT NULL,
  `univeristy_photo1` varchar(100) DEFAULT NULL,
  `univeristy_photo2` varchar(100) DEFAULT NULL,
  `university_actual_grad_day` varchar(50) DEFAULT NULL,
  `university_actual_grad_year` varchar(50) DEFAULT NULL,
  `university_country` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_program_university_info`
--

INSERT INTO `final_program_university_info` (`user_id`, `id`, `actual_graduation_date`, `actual_grad_year`, `designation`, `university_id`, `university`, `university_apt`, `univerisity_code`, `university_address`, `university_state`, `university_city`, `university_zip_code`, `university_phone`, `univeristy_program_director`, `univeristy_program_director_last_name`, `univeristy_program_director_designation`, `university_phone2`, `university_school`, `matric_date`, `expected_graduation_date`, `program_length`, `clinical_length`, `specialities_training`, `degree_type1`, `degree_type2`, `years_certified`, `certificate`, `other_specialities`, `active`, `university_photo`, `one_year_certified`, `university_email`, `university_email_conf`, `university_url`, `univeristy_program_director_phone`, `univeristy_program_director_email`, `univeristy_program_director1`, `univeristy_program_director_last_name1`, `univeristy_program_director_designation1`, `univeristy_program_title1`, `univeristy_program_director_phone1`, `univeristy_program_director_email1`, `univeristy_program_director2`, `univeristy_program_director_designation2`, `univeristy_assistant_phone`, `univeristy_assistant_email`, `univeristy_photo1`, `univeristy_photo2`, `university_actual_grad_day`, `university_actual_grad_year`, `university_country`) VALUES
(1008, 149, '2008-06-01', '2008', '987', 8, 'University Test 1', '', 'Provided by admin', '', '', '', '', '0', '0', '0', '', '0', '0', '0000-00-00', '0000-00-00', '24', '0', '0', 'Masters', '0', '0', '0', '0', 1, '0', 0, '0', '0', '0', '', '0', '0', '0', 'MD', 'Director', '', '0', '0', '0', '0', '0', 'Attach in Email', 'Attach in Email', '2008-06-01', '2008', 'United States'),
(2591, 2307, '2000-06-01', '2000', '986', 0, 'University Test 2', '100', 'Provided by admin', NULL, NULL, NULL, NULL, '0', '0', '0', '', '0', '0', '0000-00-00', '0000-00-00', '24', '0', '0', 'Masters', '0', '0', '0', '0', 1, '0', 0, '0', '0', '0', NULL, '0', '0', '0', 'MD', 'Director 2', NULL, '0', '0', '0', '0', '0', 'Attach in Email', 'Attach in Email', '2000-06-01', '2000', 'United States'),
(3274, 2693, '2019-05-17', '2019', '985', 9, 'University Test 3', NULL, 'Provided by admin', '', '', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'United States'),
(3010, 2753, '2020-12-31', '2020', 'Sum1 Sum', 9, 'University Test 4H', '100H', 'Provided by admin', '', '', '', '', '0', '0', '0', '0', '0', '0', '0000-00-00', '2020-12-30', '24', '0', '0', 'Masters', '0', '0', '0', '0', 1, '0', 0, '0', '0', '0', '8162351953', '0', '0', '0', 'MD', 'Director', '', '0', '0', '0', '0', '0', 'Attach in Email', 'Attach in Email', '0', '0', 'United States'),
(2788, 2801, '2020-05-17', '2020', 'QQQ11', 11, 'University Test 5', '100', 'Provided by admin', '', '', '', '', '0', '0', '0', '0', '0', '0', '0000-00-00', '0000-00-00', '24', '0', '0', 'Masters', '0', '0', '0', '0', 1, '0', 0, '0', '0', '0', '', '0', '0', '0', 'MD', 'Director', '', '0', '0', '0', '0', '0', 'Attach in Email', 'Attach in Email', '0', '0', 'United States'),
(3476, 3012, '2020-05-18', '2020', 'QQQ9', 72, '', NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(3478, 3013, '2020-05-04', '2020', '', 72, '', NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(3479, 3014, '2090-12-01', '2090', 'QQQ2B', 2, 'Central Texas College B', NULL, 'Provided by admin', '122 Oak Street', 'GA', 'Savannah', '31406', '111-112-1111', NULL, NULL, NULL, '111-112-1111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2091', 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `final_retirements_previous_employers`
--

CREATE TABLE `final_retirements_previous_employers` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `start_date` text,
  `end_date` text,
  `ex_employer_name` varchar(255) DEFAULT NULL,
  `ex_employer_address` varchar(255) DEFAULT NULL,
  `ex_employer_city` varchar(255) DEFAULT NULL,
  `ex_employer_state` varchar(255) DEFAULT NULL,
  `ex_employer_zip` varchar(255) DEFAULT NULL,
  `ex_employer_phone` varchar(255) DEFAULT NULL,
  `type_of_settings` varchar(255) DEFAULT NULL,
  `type_of_settings_other` varchar(255) DEFAULT NULL,
  `type_of_group` varchar(255) DEFAULT NULL,
  `type_of_group_other` varchar(255) DEFAULT NULL,
  `active` bigint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `GOODadmin`
--

CREATE TABLE `GOODadmin` (
  `user_id` varchar(220) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(200) DEFAULT '',
  `password` varchar(100) DEFAULT '',
  `l_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT '',
  `role` enum('super admin','admin','employee') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `balance` double DEFAULT '0',
  `default` tinyint(4) DEFAULT '0',
  `enabled` tinyint(4) DEFAULT '1',
  `status` varchar(255) DEFAULT '',
  `date` datetime DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incomecdq`
--

CREATE TABLE `incomecdq` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `amount` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `late_due_date` date NOT NULL,
  `late_fee_amount` varchar(255) NOT NULL,
  `retake1_due_date` date NOT NULL,
  `retake1_amount` varchar(75) NOT NULL,
  `retake2_due_date` date NOT NULL,
  `retake2_amount` varchar(255) NOT NULL,
  `exam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `incomecertification`
--

CREATE TABLE `incomecertification` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `amount` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `late_due_date` date NOT NULL,
  `late_fee_amount` varchar(255) NOT NULL,
  `retake1_due_date` date NOT NULL,
  `retake1_amount` varchar(75) NOT NULL,
  `retake2_due_date` date NOT NULL,
  `retake2_amount` varchar(255) NOT NULL,
  `retake3_due_date` date NOT NULL,
  `retake3_amount` varchar(255) NOT NULL,
  `retake4_due_date` date NOT NULL,
  `retake4_amount` varchar(255) NOT NULL,
  `retake5_due_date` date NOT NULL,
  `retake5_amount` varchar(255) NOT NULL,
  `exam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incomecertification`
--

INSERT INTO `incomecertification` (`user_id`, `id`, `exam_date`, `amount`, `due_date`, `late_due_date`, `late_fee_amount`, `retake1_due_date`, `retake1_amount`, `retake2_due_date`, `retake2_amount`, `retake3_due_date`, `retake3_amount`, `retake4_due_date`, `retake4_amount`, `retake5_due_date`, `retake5_amount`, `exam`) VALUES
(3010, 176, '2099-05-01', '888', '2088-05-01', '2020-05-02', '777', '2020-06-01', '778', '2020-06-02', '779', '2020-05-03', '780', '2020-05-04', '781', '2020-05-05', '782', '211');

-- --------------------------------------------------------

--
-- Table structure for table `incomecme`
--

CREATE TABLE `incomecme` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `cme_date` date NOT NULL,
  `amount` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `late_due_date` date NOT NULL,
  `late_fee_amount` varchar(255) NOT NULL,
  `cme_cycle_start` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incomecme`
--

INSERT INTO `incomecme` (`user_id`, `id`, `cme_date`, `amount`, `due_date`, `late_due_date`, `late_fee_amount`, `cme_cycle_start`) VALUES
(2591, 810, '2020-05-17', '235.00', '2020-05-17', '2020-05-17', '0', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default` tinyint(4) DEFAULT '0',
  `image` text COLLATE utf8_unicode_ci,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` double DEFAULT '1',
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `code`, `language`, `default`, `image`, `currency`, `unit`, `created`, `modified`, `enabled`) VALUES
(1, 'EN', 'English U.S', 1, 'en.jpg', 'Dollar', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT '0',
  `top_menu` tinyint(4) DEFAULT '0',
  `middle_menu` tinyint(4) DEFAULT '0',
  `bottom_menu` tinyint(4) DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `is_home` tinyint(4) DEFAULT '0',
  `display` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `template` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_setting`
--

CREATE TABLE `paypal_setting` (
  `user_id` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `id` bigint(20) NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sandbox` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `paypal_setting`
--

INSERT INTO `paypal_setting` (`user_id`, `id`, `currency`, `sandbox`, `signature`, `password`, `username`, `created`, `modified`, `enabled`) VALUES
('', 1, NULL, '1', 'Aa59uhewgyn78hUcRR-uuQfrZ6ApArzv0F8CuZLQRgL84U977dMoLKRj', 'S8MYKKQNG87G2TB2', 'pvsysgroup01-facilitator_api1.gmail.com', NULL, '1535028554', 1),
('', 2, NULL, '1', 'sk_test_ZiAxJ6SSA7seMbFixL0Qj7QV', '', 'pk_test_cqggiwfAnkHjs4zmwyBLD3kL', NULL, '1542368892', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile_photo`
--

CREATE TABLE `profile_photo` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_users`
--

CREATE TABLE `profile_users` (
  `user_id` varchar(220) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) NOT NULL,
  `admin_id` bigint(20) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `alumni` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone_2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gps` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `on_date` datetime DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_bin DEFAULT 'user',
  `created` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `admin_id`, `name`, `alumni`, `company_name`, `address`, `city`, `country`, `state`, `zip`, `phone`, `phone_2`, `email`, `website`, `gps`, `on_date`, `created_by`, `created`, `modified`, `enabled`) VALUES
(1, 0, 'Department of Anesthesiology', 'Alumni', 'Case Western Reserve University', '820 FIRST St NE', 'Washington', 'USA', 'DC', '20002', '202-758-7171', '', 'casewestern@case.edu', '', '38.9005591, -77.0078767', '2019-01-05 06:12:43', 'user', '1546690363', '1548078197', 1),
(2, 0, 'Department of Anesthesiology', 'Alumni', 'Case Western Reserve University', '6410 Fannin St', 'Houston', 'USA', 'TX', '77030', '713-574-8201', '', 'casewestern@case.edu', '', '29.7145361, -95.39796360000003', '2019-01-05 06:12:43', 'user', '1546690363', '1548078186', 1),
(3, 0, 'Department of Anesthesiology', 'Alumni', 'Case Western Reserve University', '10900 Euclid Ave', 'Cleveland', 'USA', 'OH', '44106-5007', '216.844.8077', '', 'casewestern@case.edu', '', '41.50462, -81.60973200000001', '2019-01-05 06:12:43', 'user', '1546690363', '1548078174', 1),
(4, 0, 'Department of Anesthesiology', 'Alumni', 'Emory University', '1364 Clifton Road, NE', 'Atlanta', 'USA', 'GA', '30322', '404.778.5778', '', 'emoryuniversity@emory.edu', '', '33.7811458, -84.3231935', '2019-01-05 06:12:43', 'user', '1546690363', '1547115604', 1),
(5, 0, 'Department of Anesthesiology', 'Alumni', 'Indiana University', '340 West 10th Street', 'Indianapolis', 'USA', 'IN', '46202-3082', '317-274-8157', '', 'indianauniversity@iu.edu', '', '39.7816087, -86.16519419999997', '2019-01-05 06:12:43', 'user', '1546690363', '1547115590', 1),
(6, 0, 'Department of Anesthesiology', 'Alumni', 'Nova Southeastern University', '3200 S. University Drive', 'Ft. Lauderdale', 'USA', 'FL', '33328', '800-541-6682', '', 'novasoutheast@nova.edu', '', '26.081743, -80.24974299999997', '2019-01-05 06:12:43', 'user', '1546690363', '1547115578', 1),
(7, 0, 'Department of Anesthesiology', 'Alumni', 'Medical College of Wisconsin', '9200 W. Wisconsin Ave', 'Milwaukee', 'USA', 'WI', '53226', '(414) 955-5649', '', 'universityofwisconsin@mcw.edu', '', '43.0384971, -88.0324157', '2019-01-05 06:12:43', 'user', '1546690363', '1547115562', 1),
(8, 0, 'Department of Anesthesiology', 'Alumni', 'Nova Southeastern Tampa', '3632 Queen Palm Drive', 'Tampa', 'USA', 'FL', '33619', '(813) 574-5339', '', 'novasoutheast@nova.edu', '', '27.9763972, -82.3358035', '2019-01-05 06:12:43', 'user', '1546690363', '1547115551', 1),
(9, 0, 'Department of Anesthesiology', 'Alumni', 'Quinnipiac', '275 Mount Carmel Avenue, NH-MED', 'Hamden', 'USA', 'CT', '06518', '212-893-6734', '', 'quinnipianuniversity@quinnipiac.edu', '', '41.4191748, -72.89268830000003', '2019-01-05 06:12:43', 'user', '1546690363', '1547115528', 1),
(10, 0, 'Department of Anesthesiology', 'Alumni', 'South University', '709 Mall Blvd', 'Savannah', 'USA', 'GA ', '31406', '548-889-0229', '', 'southuniversity@south.edu', '', '31.9996116, -81.10547489999999', '2019-01-05 06:12:43', 'user', '1546690363', '1547115476', 1),
(11, 0, 'Department of Anesthesiology', 'Alumni 2', 'University of Colorado School of Medicine', '12401 E. 17th Ave 7th Floor', 'Aurora', 'USA', 'CO', '80045', '720-848-6709', '', 'coloradouniversity@csu.edu', '', '39.7440805, -104.8428159', '2019-01-05 06:12:43', 'user', '1546690363', '1547115429', 1),
(12, 0, 'Department of Anesthesiology', 'Alumni', 'University of Missouri', '2411 Holmes Street', 'Kansas City', 'USA', 'MO', '64108', '816-235-1808', '', 'universityofmissouri@mku.edu', '', '39.0834589, -94.57525880000003', '2019-01-05 06:12:43', 'user', '1546690363', '1547115274', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `field` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `modified` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`field`, `value`, `created`, `modified`) VALUES
('rss_url', NULL, NULL, NULL),
('pinterest_url', NULL, NULL, NULL),
('menu_imag', NULL, NULL, NULL),
('menu_image', 'batman_2.jpg', NULL, NULL),
('image', 'logo.png', NULL, NULL),
('footer_text', 'All rights reserved @ 2014', NULL, NULL),
('donation', '5', NULL, NULL),
('l_background', 'account_bg3.jpg', NULL, NULL),
('r_background', 'remar.jpg', NULL, NULL),
('bank_name', 'bank name', NULL, NULL),
('bank_account', '9876543210', NULL, NULL),
('chat_option', '0', NULL, NULL),
('admin_link', 'admin123', NULL, NULL),
('background2', 'subscribe-bg.jpg', NULL, NULL),
('linkedin_url', 'http://linkedin.com', NULL, NULL),
('youtube_url', 'https://www.youtube.com', NULL, NULL),
('twitter_url', 'https://twitter.com', NULL, NULL),
('facebook_url', 'https://www.facebook.com/', NULL, NULL),
('google_plus', 'https://plus.google.com', NULL, NULL),
('skype_id', NULL, NULL, NULL),
('instagram_url', 'http://instagram_url.com', NULL, NULL),
('product_image', 'th_(2).jpg', NULL, NULL),
('background', '61.jpg', NULL, NULL),
('brand_background', '6.jpg', NULL, NULL),
('home_tour_link', 'http://localhost/VictoriaLove/t/l/2', NULL, NULL),
('b_background', '3.jpg', NULL, NULL),
('home_background', 'slider.jpg', NULL, NULL),
('site_name', 'NCCAA', NULL, NULL),
('home_title', 'NCCAA', NULL, NULL),
('site_email', 'contact@nccaa.org', NULL, NULL),
('meta_title', 'NCCAA', NULL, NULL),
('keywords', 'NCCAA', NULL, NULL),
('meta_description', 'NCCAA', NULL, NULL),
('phone', '859-903-0089', NULL, NULL),
('address', '8459 US 42 #160\r\nFlorence, KY 41042', NULL, NULL),
('gps', '41.09653995238045, 29.00349739114995', NULL, NULL),
('website_active', '1', NULL, NULL),
('website_desc', '<h1>We&#39;ll be back soon!</h1>\r\n\r\n<div>\r\n<p>Sorry for the inconvenience but we are performing some maintenance at the moment. we will be back online shortly!</p>\r\n\r\n<p>The NCCAA</p>\r\n</div>\r\n', NULL, NULL),
('analytic_code', '                                              ', NULL, NULL),
('logo', 'logo.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `video_file` text COLLATE utf8_unicode_ci,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `article_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `watch_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `states` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `states`) VALUES
(1, 'AL'),
(2, 'AK'),
(3, 'AZ'),
(4, 'AR'),
(5, 'CA'),
(6, 'CO'),
(7, 'CT'),
(8, 'DE'),
(9, 'DC'),
(10, 'FL'),
(11, 'GA'),
(12, 'HI'),
(13, 'ID'),
(14, 'IL'),
(15, 'IN'),
(16, 'IA'),
(17, 'KS'),
(18, 'KY'),
(19, 'LA'),
(20, 'ME'),
(21, 'MD'),
(22, 'MA'),
(23, 'MI'),
(24, 'MN'),
(25, 'MS'),
(26, 'MO'),
(27, 'MT'),
(28, 'NE'),
(29, 'NV'),
(30, 'NH'),
(31, 'NJ'),
(32, 'NM'),
(33, 'NY'),
(34, 'NC'),
(35, 'ND'),
(36, 'OH'),
(37, 'OK'),
(38, 'OR'),
(39, 'PA'),
(40, 'RI'),
(41, 'SC'),
(42, 'SD'),
(43, 'TN'),
(44, 'TX'),
(45, 'UT'),
(46, 'VT'),
(47, 'VA'),
(48, 'WA'),
(49, 'WV'),
(50, 'WI'),
(51, 'WY');

-- --------------------------------------------------------

--
-- Table structure for table `static_text`
--

CREATE TABLE `static_text` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `static_text`
--

INSERT INTO `static_text` (`id`, `name`, `created`, `modified`, `enabled`) VALUES
(1, 'Register', '1428477556', '1428481717', 1),
(2, 'Login', '1428477587', '1428481717', 1),
(3, 'Search', '1428477632', '1428481717', 1),
(4, 'Update', '1428477690', '1446201428', 1),
(5, 'Delete', '1428477724', '1446303257', 1),
(6, 'Product', '1428477823', '1428481717', 1),
(7, 'Add Payment', '1428477846', '1471847738', 1),
(8, 'Register a business', '1428477864', '1522135729', 1),
(9, 'News', '1428477903', '1428481717', 1),
(10, 'Home', '1428477988', '1428481717', 1),
(11, 'Pages', '1428478009', '1428481717', 1),
(12, 'Sign Up', '1428478059', '1428481717', 1),
(13, 'Sign in', '1428478074', '1428481717', 1),
(14, 'My Account', '1428478094', '1428481718', 1),
(15, 'Created By', '1428478114', '1471868218', 1),
(16, 'Name', '1428478127', '1428481718', 1),
(17, 'Surname', '1428478142', '1428481718', 1),
(18, 'E-mail', '1428478156', '1428481718', 1),
(19, 'Your Password', '1428478199', '1428481718', 1),
(20, 'Password', '1428478217', '1428481718', 1),
(21, 'confirm password', '1428478240', '1428481718', 1),
(22, 'Cancel', '1428478281', '1428481718', 1),
(23, 'Menu', '1428478326', '1447751308', 1),
(24, 'Forgot Your Password', '1428478393', '1449048058', 1),
(25, 'Day', '1428478435', '1471448376', 1),
(26, 'Available', '1428478474', '1428481718', 1),
(27, 'Keywords', '1428478489', '1446291808', 1),
(28, 'View', '1428478501', '1447754968', 1),
(29, 'Membership Management', '1428478523', '1471097053', 1),
(30, 'Clicks', '1428478543', '1521199550', 1),
(31, 'TRENDS', '1428478559', '1521872081', 1),
(32, 'Membership', '1428478609', '1471008779', 1),
(33, 'New Customer', '1428478664', '1447750805', 1),
(34, 'Team', '1428478685', '1476339843', 1),
(35, 'I accept ', '1428478740', '1476347344', 1),
(36, 'people', '1428478752', '1471005234', 1),
(37, 'Please wait for approve by admin', '1428478810', '1518085923', 1),
(38, 'description', '1428478828', '1428481718', 1),
(39, 'code', '1428478841', '1428481718', 1),
(40, 'FOLLOW US ON', '1428478853', '1521873015', 1),
(41, 'price', '1428478883', '1428481718', 1),
(42, 'Year', '1428478891', '1471448501', 1),
(43, 'Total', '1428478915', '1428481718', 1),
(44, 'Thanks For Joining Our System , For More Features Please Upgrade Your Membership', '1428478959', '1474904638', 1),
(45, 'Profile Update', '1428479019', '1428481718', 1),
(46, 'address', '1428479081', '1428481718', 1),
(47, 'Liked', '1428479123', '1428481718', 1),
(48, 'Bank Name', '1428479154', '1472884944', 1),
(49, 'My Order', '1428479168', '1428481718', 1),
(50, 'Change Password', '1428479182', '1428481718', 1),
(51, 'Old Password', '1428479191', '1428481718', 1),
(52, 'State', '1428479233', '1471434889', 1),
(53, 'Action', '1428479261', '1428481719', 1),
(54, 'What do you want to learn?', '1428479286', '1521876458', 1),
(55, 'Message', '1428595392', '1428595392', 1),
(56, 'submit', '1428595433', '1428595433', 1),
(57, 'Logout', '1428595459', '1428595459', 1),
(58, 'calender', '1428596210', '1471005498', 1),
(59, 'My Profile', '1428918325', '1471245520', 1),
(60, 'Owner', '1428918342', '1522041583', 1),
(61, 'Month', '1428918428', '1471448450', 1),
(62, 'Copy Right', '1437662021', '1447751474', 1),
(63, 'Your Membership', '1438581278', '1472049953', 1),
(64, 'Term', '1438581329', '1472570262', 1),
(65, 'New', '1438581451', '1438581451', 1),
(66, 'Edit Profile', '1438581540', '1522041481', 1),
(67, 'Reporting', '1438581600', '1471426054', 1),
(68, 'Home Title1', '1438581689', '1521193595', 1),
(69, 'Home Desc', '1438581740', '1521193628', 1),
(70, 'Business', '1438581813', '1522041631', 1),
(71, 'More', '1438581868', '1438581868', 1),
(72, 'Get the latest deals and special offers', '1438581953', '1447751137', 1),
(73, 'Read More', '1438582113', '1438582113', 1),
(74, 'Get membership', '1438582181', '1472888418', 1),
(75, 'Employee', '1438582406', '1472911869', 1),
(76, 'Enter password', '1438582442', '1522136665', 1),
(77, 'Subscribe', '1438583457', '1438583457', 1),
(78, 'Favorites', '1438584051', '1522041771', 1),
(79, 'Pricing', '1438584155', '1471009113', 1),
(80, 'Dashboard', '1438601454', '1438601454', 1),
(81, 'Enter your email', '1438603598', '1438603598', 1),
(82, 'Phone', '1438603648', '1438603648', 1),
(83, 'Date Of birth', '1438603677', '1438603677', 1),
(84, 'City', '1438603697', '1438603697', 1),
(85, 'Country', '1438603711', '1438603711', 1),
(86, 'Create Account', '1438603742', '1438603742', 1),
(87, 'Retype Password', '1438603863', '1522136727', 1),
(88, 'Payment', '1438603880', '1472889154', 1),
(89, 'Support', '1438603893', '1471009242', 1),
(90, 'Get started', '1438603907', '1471009508', 1),
(91, 'operated by', '1438603930', '1529998343', 1),
(92, 'Footer Private Limited', '1438603951', '1530003143', 1),
(93, 'Brand Box Title 3', '1439279932', '1521444229', 1),
(94, 'Brand Box Title 4', '1443714848', '1521444261', 1),
(95, 'Brand Box Desc 1', '1443714883', '1521444285', 1),
(96, 'Brand Box Desc 2', '1443714911', '1521444289', 1),
(97, 'Brand Box Desc 3', '1443714926', '1521444306', 1),
(98, 'Brand Box Desc 4', '1443714946', '1521444313', 1),
(99, 'Facebook', '1443715302', '1443715302', 1),
(100, 'Twitter', '1443715327', '1443715327', 1),
(101, 'Google', '1443715344', '1443715344', 1),
(102, 'Signature ', '1443868455', '1472885037', 1),
(103, 'First and last name', '1443868573', '1522136533', 1),
(104, 'History', '1443868609', '1471424532', 1),
(105, 'Full Name', '1443868638', '1522136503', 1),
(106, 'schedule', '1443868662', '1471425774', 1),
(107, 'list', '1443878111', '1471005609', 1),
(108, 'Company', '1443878162', '1471009652', 1),
(109, 'Remove', '1443878313', '1443878313', 1),
(110, 'Presentation Video', '1443878829', '1522823491', 1),
(111, 'Email Address', '1443878862', '1443878862', 1),
(112, 'Plan', '1443879258', '1471855987', 1),
(113, 'User Type', '1443879294', '1472889206', 1),
(114, 'Address Details', '1443879324', '1443879324', 1),
(115, 'Post', '1443879362', '1472908218', 1),
(116, 'Type', '1443879911', '1471097872', 1),
(117, 'Type your location', '1443879923', '1471097973', 1),
(118, 'Size', '1443879934', '1443879934', 1),
(119, 'Review', '1443879968', '1471955605', 1),
(120, 'What Client Say', '1443879984', '1471098184', 1),
(121, 'From', '1443879995', '1471097936', 1),
(122, 'To', '1443880012', '1471097960', 1),
(123, 'Observations', '1443880024', '1472912066', 1),
(124, 'Our Classes', '1443880069', '1522823548', 1),
(125, 'Account', '1443880088', '1472912272', 1),
(126, 'About', '1443881175', '1473761186', 1),
(127, 'Income Managment', '1443881784', '1473759165', 1),
(128, 'Salary Paid', '1443881943', '1472570958', 1),
(129, 'Cash On Delivery', '1443881962', '1443881962', 1),
(130, 'Total Balance', '1443881975', '1472206723', 1),
(131, 'ticket management', '1443882853', '1471016322', 1),
(132, 'Back', '1443883903', '1472889252', 1),
(133, 'Order Confirm', '1443883929', '1443883929', 1),
(134, 'Language', '1444130161', '1444130161', 1),
(135, 'paypal API', '1445864497', '1473759300', 1),
(136, 'Reviews', '1445864513', '1515759626', 1),
(137, 'settings', '1445864853', '1471005867', 1),
(138, 'RECENT BUSINESS', '1445869181', '1521872319', 1),
(139, 'Offers', '1445869205', '1522825144', 1),
(140, 'Profile', '1445869219', '1521869829', 1),
(141, 'Events', '1445869240', '1522041817', 1),
(142, 'Home Section Title 1', '1445871218', '1521195745', 1),
(143, 'Home Section Desc 1', '1445873707', '1521195754', 1),
(144, 'Crendential', '1445955322', '1472572285', 1),
(145, 'Gender', '1445955346', '1472571639', 1),
(146, 'Your Details', '1445957173', '1445957173', 1),
(147, 'Forgot Password', '1445958109', '1445958109', 1),
(148, 'Photographer', '1446012421', '1472897009', 1),
(149, 'info', '1446108159', '1471012408', 1),
(150, 'S. No.', '1446109502', '1471865896', 1),
(151, 'Visit', '1446186569', '1446186569', 1),
(152, 'Order History', '1446186940', '1446186940', 1),
(153, 'Date', '1446187011', '1446187011', 1),
(154, 'comments', '1446187049', '1522823982', 1),
(155, 'Total Amount', '1446187087', '1446187087', 1),
(156, 'Option', '1446187126', '1446187126', 1),
(157, 'Comment', '1446201046', '1446201046', 1),
(158, 'Status', '1446201085', '1446201085', 1),
(159, 'Select image', '1446201309', '1446201309', 1),
(160, 'Change', '1446201356', '1446201356', 1),
(161, 'New Password', '1446201570', '1446201570', 1),
(162, 'General Settings', '1446210730', '1446210730', 1),
(163, 'Email Settings', '1446210773', '1446210773', 1),
(164, 'Language', '1446210914', '1446210914', 1),
(165, 'Update Data', '1446210966', '1446210966', 1),
(166, 'Product Management', '1446210981', '1446210981', 1),
(167, 'Category', '1446210997', '1446210997', 1),
(168, 'Categories', '1446211021', '1521869926', 1),
(169, 'FEATURED BUSINESSES', '1446211037', '1521872282', 1),
(170, 'Products', '1446211059', '1446211059', 1),
(171, 'Order Management', '1446211077', '1446211077', 1),
(172, 'Website', '1446211093', '1446211093', 1),
(173, 'Reports', '1446211107', '1446211107', 1),
(174, 'Payment History', '1446211122', '1446211122', 1),
(175, 'Enter a email', '1446211137', '1522136627', 1),
(176, 'Rank', '1446211163', '1472887303', 1),
(177, 'User Management', '1446211181', '1446211181', 1),
(178, 'User', '1446211197', '1446211197', 1),
(179, 'You need to ', '1446211209', '1515230596', 1),
(180, 'Content Management', '1446211224', '1446211224', 1),
(181, 'Content', '1446211238', '1446211238', 1),
(182, 'Page', '1446211259', '1446211259', 1),
(183, 'Slider', '1446211272', '1446211272', 1),
(184, 'Partner Logo', '1446211386', '1446212241', 1),
(185, 'standards/formates', '1446211434', '1471014794', 1),
(186, 'Newsletter', '1446211447', '1446211447', 1),
(187, 'User Subcriber', '1446211494', '1446211494', 1),
(188, 'Social Network', '1446211647', '1446211647', 1),
(189, 'Static Text', '1446211703', '1446211703', 1),
(190, 'Thank you for subscribing', '1446212409', '1446212409', 1),
(191, 'You already subscribe', '1446212463', '1446212463', 1),
(192, 'Event', '1446212696', '1446212696', 1),
(193, 'Enter a username', '1446212714', '1522136576', 1),
(194, 'quantity', '1446212928', '1472908739', 1),
(195, 'Tax', '1446212945', '1472909088', 1),
(196, 'Already have an account?', '1446212956', '1522136240', 1),
(197, 'New', '1446213004', '1446213004', 1),
(198, 'locations', '1446213020', '1471014959', 1),
(199, 'Thank You for contacting us. We Will Contact You soon', '1446213533', '1446213533', 1),
(200, 'Mail can not be send dur to some server problem', '1446213586', '1446213586', 1),
(201, 'Please enter a valid email-id', '1446213601', '1446213601', 1),
(202, 'Please enter email-id', '1446213614', '1446213614', 1),
(203, 'invoices', '1446214568', '1471007986', 1),
(204, 'features', '1446214634', '1471009009', 1),
(205, 'Used Balance', '1446221046', '1472206782', 1),
(206, 'Partners', '1446271430', '1471010192', 1),
(207, 'Yes', '1446271509', '1446271509', 1),
(208, 'No', '1446271518', '1446271518', 1),
(209, 'Ticket', '1446271532', '1472888943', 1),
(210, 'Bank Account', '1446271691', '1472570802', 1),
(211, 'Profile has been successfully updated', '1446277661', '1446277661', 1),
(212, 'Old Password is wrong password', '1446277709', '1446277709', 1),
(213, 'Password does not match', '1446277773', '1446277773', 1),
(214, 'Your Password has successfully been Updated', '1446277808', '1446277808', 1),
(215, 'Thank you for order', '1446278658', '1446278658', 1),
(216, 'Thanks for register!', '1446278798', '1446278798', 1),
(217, 'Please verify your account by clicking the link sent to your e-mail address', '1446278815', '1446278815', 1),
(218, 'Be sure to check your junk mail folder', '1446278828', '1446278828', 1),
(219, 'Field required', '1446279068', '1446279068', 1),
(220, 'Email must unique', '1446279226', '1446279226', 1),
(221, 'Field must contain an integer', '1446279379', '1446279379', 1),
(222, 'Your email ID has not verify', '1446281246', '1446281246', 1),
(223, 'Your account has been deactived', '1446281260', '1446281260', 1),
(224, 'Invalid user id or password', '1446281278', '1446281278', 1),
(225, 'Your password has successfully sent your email ID. Please Check email', '1446281409', '1446281409', 1),
(226, 'Invalid email-ID', '1446281436', '1446281436', 1),
(227, 'Order Information', '1446281889', '1446281889', 1),
(228, 'There is no data', '1446282073', '1446282073', 1),
(229, 'Amount', '1446282188', '1446282188', 1),
(230, 'Remaining', '1446282205', '1446282205', 1),
(231, 'Used', '1446282218', '1446282218', 1),
(232, 'Expire Date', '1446282233', '1446282233', 1),
(233, 'Add New', '1446282544', '1446282544', 1),
(234, 'Add', '1446282553', '1446282553', 1),
(235, 'Save', '1446282572', '1446282572', 1),
(236, 'Title', '1446282603', '1446282603', 1),
(237, 'Users', '1446290331', '1446290331', 1),
(238, 'Workout', '1446290344', '1471425577', 1),
(239, 'Today Order', '1446290392', '1446290392', 1),
(240, 'Month Order', '1446290410', '1446290410', 1),
(241, 'Year Order', '1446290690', '1446290690', 1),
(242, 'Username', '1446290862', '1446290862', 1),
(243, 'Ordered On', '1446290921', '1446290921', 1),
(244, 'ID', '1446291094', '1446291094', 1),
(245, 'Site Name', '1446291451', '1446291451', 1),
(246, 'Site Email', '1446291464', '1446291464', 1),
(247, 'Meta Title', '1446291476', '1446291476', 1),
(248, 'Meta Description', '1446291500', '1446291500', 1),
(249, 'Home Title', '1446291512', '1446291512', 1),
(250, 'Analytic Code', '1446291523', '1446291572', 1),
(251, 'Website Active', '1446291582', '1446291582', 1),
(252, 'Website Offline Message', '1446291606', '1446291606', 1),
(253, 'Logo', '1446291627', '1446291627', 1),
(254, 'Edit', '1446292488', '1446292488', 1),
(255, 'Subject', '1446292636', '1446292636', 1),
(256, 'Confirm', '1446292939', '1446292939', 1),
(257, 'Create', '1446293408', '1446293408', 1),
(258, 'Options', '1446293805', '1446293805', 1),
(259, 'Flag', '1446293826', '1446293826', 1),
(260, 'Default', '1446293854', '1446293854', 1),
(261, 'Currency', '1446294078', '1446294078', 1),
(262, 'Unit $ price ', '1446294105', '1446294105', 1),
(263, 'Image', '1446294130', '1446294130', 1),
(264, 'Drag to data and then click \'Save\'', '1446294875', '1446294875', 1),
(265, 'Are you sure?', '1446295018', '1446295018', 1),
(266, 'Parent', '1446295561', '1471087680', 1),
(267, 'Slug', '1446295594', '1446295594', 1),
(268, 'Translation data', '1446295612', '1446295612', 1),
(269, 'Subcategory', '1446296679', '1446296679', 1),
(270, 'Section', '1446296704', '1446296704', 1),
(271, 'Discount Price', '1446297902', '1446297902', 1),
(272, 'account info', '1446297927', '1471016141', 1),
(273, 'Brand Image Title', '1446297951', '1521445198', 1),
(274, 'Brand Image Desc', '1446297975', '1521445205', 1),
(275, 'Youtube Link', '1446297993', '1446297993', 1),
(276, 'Body', '1446298012', '1446298012', 1),
(277, 'More Photo', '1446298043', '1446298043', 1),
(278, 'Upload', '1446298065', '1446298065', 1),
(279, 'Export', '1446298652', '1446298652', 1),
(280, 'You must', '1446299588', '1522824094', 1),
(281, 'to submit a review', '1446299616', '1522824135', 1),
(282, 'store', '1446300679', '1471010794', 1),
(283, 'Token', '1446300899', '1446300899', 1),
(284, 'Place', '1446302138', '1446302138', 1),
(285, 'sales portal', '1446303772', '1471014570', 1),
(286, 'Active', '1446303867', '1472888239', 1),
(287, 'Reduction Amount', '1446304467', '1446304467', 1),
(288, 'Template', '1446305049', '1446305049', 1),
(289, 'Top Menu', '1446305063', '1446305063', 1),
(290, 'Bottom Menu', '1446305077', '1446305077', 1),
(291, 'Position', '1446305683', '1446305683', 1),
(292, 'Link', '1446306007', '1446306007', 1),
(293, 'Save And Send', '1446306818', '1446306818', 1),
(294, 'Setting has successfully updated', '1446451363', '1446451363', 1),
(295, 'Data has successfully created', '1446451427', '1446451644', 1),
(296, 'Data has successfully updated', '1446451585', '1446451669', 1),
(297, 'Data has successfully deleted', '1446451599', '1446451599', 1),
(298, 'Data has successfully sent', '1446452501', '1446452501', 1),
(299, 'Code should be unique', '1446453473', '1446453473', 1),
(300, 'Documents', '1446616967', '1471006753', 1),
(301, 'Availability', '1446616995', '1446616995', 1),
(302, 'Add Review', '1446617025', '1522824218', 1),
(303, 'Contact Us', '1446619679', '1446619679', 1),
(304, 'December', '1446620477', '1510036886', 1),
(305, 'November', '1446620503', '1510036860', 1),
(306, 'Company Name', '1446621306', '1446621306', 1),
(307, 'October', '1446621391', '1510036839', 1),
(308, 'September', '1446621434', '1510036804', 1),
(309, 'program', '1446622474', '1471006414', 1),
(310, 'starred', '1446640888', '1471011795', 1),
(311, 'Administrator', '1446813761', '1522825548', 1),
(312, 'Contact Owner', '1446814106', '1522824350', 1),
(313, 'July', '1446815422', '1510036774', 1),
(314, 'August', '1446815437', '1510036789', 1),
(315, 'Logos', '1446815599', '1471010386', 1),
(316, 'Classes', '1446815612', '1471006566', 1),
(317, 'salary', '1446815631', '1471424216', 1),
(318, 'View Direction', '1446817456', '1522824698', 1),
(319, 'Advertisement', '1447827893', '1447827893', 1),
(320, 'Click Here', '1474904918', '1474904918', 1),
(321, 'Thank you for upgrading your account', '1474905091', '1474905091', 1),
(322, 'January', '1474905210', '1510036667', 1),
(323, 'February', '1474905301', '1510036678', 1),
(324, 'March', '1474905343', '1510036695', 1),
(325, 'May', '1474905370', '1510036704', 1),
(326, 'April', '1474905402', '1510036729', 1),
(327, 'June', '1474905433', '1510036747', 1),
(328, 'privacy', '1510003962', '1510003962', 1),
(329, 'terms.of.use', '1510004105', '1510004105', 1),
(330, 'address', '1510006322', '1510006322', 1),
(331, 'Advertisement', '1510009624', '1521199481', 1),
(332, 'Map of', '1510010016', '1522824735', 1),
(333, 'Home Box Title 1', '1510010213', '1521194872', 1),
(334, 'Home Box Title 2', '1510010236', '1521194881', 1),
(335, 'Home Box Title 3', '1510010946', '1521194904', 1),
(336, 'Home Box Title 4', '1510011107', '1521194908', 1),
(337, 'Home Box Desc 1', '1510011167', '1521194944', 1),
(338, 'Home Box Desc 2', '1510011267', '1521194961', 1),
(339, 'Home Box Desc 3', '1510012003', '1521194966', 1),
(340, 'Home Box Desc 4', '1510012257', '1521194969', 1),
(341, 'All Categories', '1510012763', '1521875295', 1),
(343, 'Follow us on Instagram', '1510013476', '1521873089', 1),
(344, 'Follow us on Facebook', '1510013743', '1521873066', 1),
(345, 'start', '1510015499', '1510015499', 1);

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `survey_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `survey_title`, `created`) VALUES
(7, 'Anesthesia Questions', '02/19/2020'),
(8, '2020 June CDQ Info', '12/04/2019'),
(9, 'Engagement Questions', '02/19/2020');

-- --------------------------------------------------------

--
-- Table structure for table `survey_answers`
--

CREATE TABLE `survey_answers` (
  `user_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `choice_id` int(5) DEFAULT NULL,
  `choice_answer` text COLLATE utf8_unicode_ci,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `question_type` enum('Radio','Text','') COLLATE utf8_unicode_ci DEFAULT NULL,
  `question` text COLLATE utf8_unicode_ci,
  `key_id` int(5) DEFAULT NULL,
  `key_answer` text COLLATE utf8_unicode_ci,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_choices`
--

CREATE TABLE `survey_question_choices` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `choice_id` int(11) DEFAULT NULL,
  `choice_answer` text COLLATE utf8_unicode_ci,
  `created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_cme`
--

CREATE TABLE `tbl_add_cme` (
  `user_id` int(20) NOT NULL,
  `id` int(20) NOT NULL,
  `date_submitted` int(20) NOT NULL,
  `cme_type` int(2) NOT NULL,
  `cme_hours` float NOT NULL,
  `cme_doc` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `cme_provider` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `acknowledgements` int(2) NOT NULL,
  `cme_cycle_start` int(5) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_add_cme`
--

INSERT INTO `tbl_add_cme` (`user_id`, `id`, `date_submitted`, `cme_type`, `cme_hours`, `cme_doc`, `cme_provider`, `acknowledgements`, `cme_cycle_start`, `file_name`, `checked`) VALUES
(2591, 6478, 1589725149, 1, 23, 'examcme/uploads/cme_1589725149.pdf', '1', 1, 2018, 'AAAA 2020', 1),
(2591, 6480, 1589725479, 1, 24, 'examcme/uploads/cme_1589725479.pdf', '1', 1, 2018, 'CWRU CMEs', 1),
(1008, 6488, 1590282630, 1, 777, 'examcme/uploads/cme_1590282630.pdf', '1', 1, 2018, 'RayJ', 0),
(1008, 6489, 1590282630, 2, 777, 'examcme/uploads/cme_1590282630.pdf', '1', 1, 2018, 'RayJ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_assistant`
--

CREATE TABLE `tbl_admin_assistant` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Designation` varchar(250) NOT NULL,
  `Job_Title` varchar(250) NOT NULL,
  `Bus_Phone` varchar(250) NOT NULL,
  `Cell_Phone` varchar(250) NOT NULL,
  `Other` int(11) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Start_Date` varchar(250) NOT NULL,
  `Other_Credentials` varchar(250) NOT NULL,
  `Photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_assistant`
--

INSERT INTO `tbl_admin_assistant` (`id`, `University_Id`, `First_Name`, `Last_Name`, `Designation`, `Job_Title`, `Bus_Phone`, `Cell_Phone`, `Other`, `Email`, `Start_Date`, `Other_Credentials`, `Photo`) VALUES
(1, 1, 'Teri', 'Haskins', '', 'Education Manager', '713-574-9465', '', 0, '', '8/1/2011', '', 'Attach in Email'),
(2, 2, 'France', 'Turner', 'MPH', 'Eduational Coordinator/Registrar', '912-201-8083', '', 0, 'fdturner@southuniversity.edu', '09-01-17', '', 'Attach in Email'),
(3, 3, 'Alissa', 'Pullom', '', 'Program Coordinator', '813-574-5269', '', 0, 'ap1416@nova.edu', '09-05-11', '', ''),
(4, 5, 'Sara', 'Hickman', 'MBA', 'Program Coordinator', '317-278-2532', '765-346-5752', 0, 'sarhickm@iu.edu', '02-01-17', 'N/A', 'Attach in Email'),
(5, 6, 'Stephanie', 'Dixon', 'BS', 'Assistant Program Director', '404-727-4744', '770-361-0440', 0, 'stephanie.dixon@emory.edu', '03-02-00', '', 'Attach in Email'),
(6, 7, '', '', '', '', '', '', 0, '', '', '', 'Attach in Email'),
(7, 8, 'Xiomara', 'Santiago', '', 'Academic Coordinator', '954-262-1531', '', 0, 'xs8@nova.edu', '', '', 'N/A'),
(8, 9, 'Maria', 'Young', 'BS', 'Student Support Specialist II', '8162351982', '', 0, 'youngmari@umkc.edu', '', '', 'Attach in Email'),
(9, 10, 'Emma', 'Momich', 'BA, BS', 'Clinical Coordinator', '(414) 955-5649', '', 0, 'emomich@mcw.edu', '11-26-18', '', 'Attach in Email'),
(10, 11, 'Carlos', 'Saldana', 'MFA', 'Education Manager', '202-758-2508', '915-328-8127', 0, 'crs159@case.edu', '', '', 'Attach in Email'),
(11, 12, 'Lauren', 'Bohatka', 'MTA', 'Education Manager, Interim', '1-216-844-8077', '1-216-716-0919', 0, 'lxb360@case.edu', '', '', 'Attach in Email');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cdqhistory`
--

CREATE TABLE `tbl_cdqhistory` (
  `user_id` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `incomecdq_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_certificationhistory`
--

CREATE TABLE `tbl_certificationhistory` (
  `user_id` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `incomecertification_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `University_id` int(11) NOT NULL,
  `First_Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `Last_Name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `overview_active` int(2) NOT NULL,
  `ITE_exam_active` int(2) NOT NULL,
  `ITE_score` int(11) NOT NULL,
  `Cert_exam_active` int(2) NOT NULL,
  `Certification_score` int(11) NOT NULL,
  `Graduation_active` int(2) NOT NULL,
  `Graduation_score` int(11) NOT NULL,
  `class_of` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`user_id`, `id`, `University_id`, `First_Name`, `Last_Name`, `overview_active`, `ITE_exam_active`, `ITE_score`, `Cert_exam_active`, `Certification_score`, `Graduation_active`, `Graduation_score`, `class_of`) VALUES
(3010, 438, 9, 'Ivette', 'Alfonso', 0, 0, 0, 0, 0, 0, 0, 2020),
(2788, 482, 11, 'Josiah', 'McFarland', 1, 1, 1, 1, 1, 1, 1, 2020),
(3274, 864, 9, 'Joseph', 'Albright', 0, 1, 1, 1, 2, 0, 0, 2019),
(3478, 1069, 72, 'Cheese', 'Wiz', 0, 0, 0, 0, 0, 0, 0, 2020),
(3479, 1070, 2, 'Homer D', 'Formby', 0, 0, 0, 0, 0, 0, 0, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_of_2019`
--

CREATE TABLE `tbl_class_of_2019` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Other` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_of_2020`
--

CREATE TABLE `tbl_class_of_2020` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Other` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_of_2021`
--

CREATE TABLE `tbl_class_of_2021` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Other` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cmehistory`
--

CREATE TABLE `tbl_cmehistory` (
  `user_id` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `incomecme_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coordinator`
--

CREATE TABLE `tbl_coordinator` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Designation` varchar(250) NOT NULL,
  `Job_Title` varchar(250) NOT NULL,
  `Bus_Phone` varchar(250) NOT NULL,
  `Cell_Phone` varchar(250) NOT NULL,
  `Other` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Start_Date` varchar(250) NOT NULL,
  `Other_Credentials` varchar(250) NOT NULL,
  `Photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_coordinator`
--

INSERT INTO `tbl_coordinator` (`id`, `University_Id`, `First_Name`, `Last_Name`, `Designation`, `Job_Title`, `Bus_Phone`, `Cell_Phone`, `Other`, `Email`, `Start_Date`, `Other_Credentials`, `Photo`) VALUES
(1, 4, 'Steven', 'Winterbach', '', 'Program Coordinator', '303 724 0197', '', '', 'steven.winterbach@ucdenver.edu', '', '', 'Attach in Email');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dates`
--

CREATE TABLE `tbl_dates` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `Matriculation_2017` varchar(250) NOT NULL,
  `Expected_ITE_Exam_2017` varchar(250) NOT NULL,
  `Expected_Certification_Exam_2017` varchar(250) NOT NULL,
  `Expected_Graduation_2017` varchar(250) NOT NULL,
  `Matriculation_2018` varchar(250) NOT NULL,
  `Expected_ITE_Exam_2018` varchar(250) NOT NULL,
  `Expected_Certification_Exam_2018` varchar(250) NOT NULL,
  `Expected_Graduation_2018` varchar(250) NOT NULL,
  `Matriculation_2019` varchar(250) NOT NULL,
  `Expected_ITE_Exam_2019` varchar(250) NOT NULL,
  `Expected_Certification_Exam_2019` varchar(250) NOT NULL,
  `Expected_Graduation_2019` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dates`
--

INSERT INTO `tbl_dates` (`id`, `University_Id`, `Matriculation_2017`, `Expected_ITE_Exam_2017`, `Expected_Certification_Exam_2017`, `Expected_Graduation_2017`, `Matriculation_2018`, `Expected_ITE_Exam_2018`, `Expected_Certification_Exam_2018`, `Expected_Graduation_2018`, `Matriculation_2019`, `Expected_ITE_Exam_2019`, `Expected_Certification_Exam_2019`, `Expected_Graduation_2019`) VALUES
(1, 1, '6/1/2010', '6/2/2018', '2/9/2019', '5/19/2019', '5/29/2018', '6/1/2019', '2/8/2020', '5/17/2020', '5/28/2019', '6/6/2020', '2/6/2021', '5/16/2021'),
(2, 2, '06-19-17', '06/2018', '06/2019', '09-14-19', '06-18-18', '06/2019', '06/2020', '09-12-20', '06-17-19', '06/2020', '06/2021', '09-11-21'),
(3, 3, '30-May-17', '2-Jun-18', '8-Jun-19', '16-Aug-19', '29-May-18', '1-Jun-19', '1-Jun-20', '1-Aug-20', '28-May-19', '1-Jun-20', '1-Jun-21', '1-Aug-21'),
(4, 4, '08-28-17', 'Jun-19', 'Oct-19', 'Dec-19', '08-27-18', 'Jun-20', 'Oct-20', 'Dec-20', '08-26-19', 'Jun-21', 'Oct-21', 'Dec-21'),
(5, 5, '08-21-17', '06-01-19', '10-12-19', '12-07-19', '08-20-18', '06-06-20', '10-10-20', '12-05-20', '08-26-19', '06-05-21', '10-09-21', '12-04-21'),
(6, 6, '06-05-17', '06-02-18', '06-08-19', '08-10-19', '06-04-18', '06-01-19', '06/01/20', '08-08-20', '06-03-19', '06/03/20', '06/01/21', '08/06/21'),
(7, 7, '05-22-17', '', '06-08-19', '08-16-19', '05-21-18', '06-01-19', '', '08-14-20', '05-20-19', '08-13-21', '', ''),
(8, 8, '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 9, '01-09-17', 'Jun-18', 'Feb-19', 'May 20,2019', '01-08-18', 'Jun-19', 'Feb-20', '20-May-20', '01-07-19', 'Jun-20', 'Feb-21', '20-May-21'),
(10, 10, '08/2017', '06/2019', '10/2019', '12/2019', '8/2018', '6/2020', '10/2020', '12/2020', '08/2019', '06/2021', '10/2021', '12/2021'),
(11, 11, '30-May-17', '2-Jun-18', '9-Feb-19', '19-May-19', '29-May-18', '1-Jun-19', '8-Feb-20', '17-May-20', '28-May-19', '6-Jun-20', '6-Feb-21', '16-May-21'),
(12, 12, '30-May-17', '2-Jun-18', '9-Feb-19', '19-May-19', '29-May-18', '1-Jun-19', '8-Feb-20', '17-May-20', '28-May-19', '6-Jun-20', '6-Feb-21', '16-May-21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `Department_Name` varchar(250) NOT NULL,
  `Department_Phone` varchar(250) NOT NULL,
  `Other_Phone` varchar(250) NOT NULL,
  `Fax` varchar(250) NOT NULL,
  `Department_Email` varchar(250) NOT NULL,
  `Confirm_Email` varchar(250) NOT NULL,
  `Website_URL` varchar(250) NOT NULL,
  `Department_Photo_First` varchar(250) NOT NULL,
  `Department_Photo_Second` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `University_Id`, `Department_Name`, `Department_Phone`, `Other_Phone`, `Fax`, `Department_Email`, `Confirm_Email`, `Website_URL`, `Department_Photo_First`, `Department_Photo_Second`) VALUES
(1, 1, '', '', '', '', '', '', '', 'Attach in Email', 'Attach in Email'),
(2, 2, 'Anesthesiologist Assistant Program', '912-201-8080', '', '912-790-4199', 'aaprograminfo@southuniversity.edu', 'aaprograminfo@southuniversity.edu', 'https://www.southuniversity.edu/savannah/areas-of-study/anesthesiologist-assistant/anesthesia-science-master-of-medical-science-mmsc', 'Attach in Email', 'Attach in Email'),
(3, 3, '', '', '', '813-574-5321', '', '', 'https://healthsciences.nova.edu/healthsciences/anesthesia/index.html', 'Attach in Email', 'Attach in Email'),
(4, 4, '', '303 724 0197', '303 724 1764', '303 724 1761', 'mmsa-info@ucdenver.edu', 'mmsa-info@ucdenver.edu', 'www.medschool.ucdenver.edu/aaprogram', 'Attach in Email', 'Attach in Email'),
(5, 5, 'Anesthesiologist Assistant Program', '317-278-2532', 'N/A', '317-274-0256', 'iusmaa@iu.edu', 'iusmaa@iu.edu', 'https://medicine.iu.edu/departments/anesthesia/education-programs/ms/', 'Attach in Email', 'Attach in Email'),
(6, 6, '', '', '', '', '', '', '', 'Attach in Email', 'Attach in Email'),
(7, 7, 'Anesthesiologist Assistant Program', '203-582-8726', '', '', 'aaprogram@quinnipiac.edu', 'aaprogram@quinnipiac.edu', 'https://www.qu.edu/schools/medicine/academics/anesthesiologist-assistant-program.html', 'Attach in Email', 'Attach in Email'),
(8, 8, 'Anesthesiologist Assistant Program', '', '', '954-262-3959', '', '', '', 'Attach in Email', 'Attach in Email'),
(9, 9, 'Master of Science in Ansesthesia Program', '8162351953', '8162355412', '8162356517', 'guthriem@umkc.edu', 'guthriem@umkc.edu', 'http://med.umkc.edu/msa/', 'Attach in Email', 'Attach in Email'),
(10, 10, 'Master of Science in Anesthesia', '414 955 5649', '', '', 'mcwmsa@mcw.edu', 'mcwmsa@mcw.edu', 'https://www.mcw.edu/education/master-of-science-in-anesthesia-anesthesiologist-assistant-program', 'N/A', 'N/A'),
(11, 11, 'CWRU Graduate Studies, CWRU School of Medicine', '', '', '', '', '', 'https://case.edu/medicine/msa-program/', 'Attach in Email', 'Attach in Email'),
(12, 12, 'CWRU School of Medicine', '', '', '', '', '', 'https://case.edu/medicine/', 'Attach in Email', 'Attach in Email');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expected_dates`
--

CREATE TABLE `tbl_expected_dates` (
  `id` int(20) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `Matriculation_Date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Expected_ITE_Exam` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Expected_Cert_Exam` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Expected_Graduation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ITE_Registration_Begins` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ITE_Registration_Ends` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Cert_Registration_Begins` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Cert_Registration_Ends` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `class_of_year` year(4) NOT NULL,
  `CDQ_Expected` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CDQ_Registration_Begins` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CDQ_Registration_Ends` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CDQ_Registration_Late_Begains` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CDQ_Registration_Late_Ends` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Registration_amount` float(10,2) NOT NULL,
  `Registration_late_amount` float(10,2) NOT NULL,
  `exam_month_year` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `exam01` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `start_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `end_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `amount01` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `start_late_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `end_late_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `amount02` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `retake01` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `retake01_start_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `retake01_end_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `amount03` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `retake02` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `retake02_start_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `retake02_end_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `amount04` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `reset_exam01` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `reset_start_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `reset_end_reg` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `types` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_expected_dates`
--

INSERT INTO `tbl_expected_dates` (`id`, `University_Id`, `Matriculation_Date`, `Expected_ITE_Exam`, `Expected_Cert_Exam`, `Expected_Graduation`, `ITE_Registration_Begins`, `ITE_Registration_Ends`, `Cert_Registration_Begins`, `Cert_Registration_Ends`, `class_of_year`, `CDQ_Expected`, `CDQ_Registration_Begins`, `CDQ_Registration_Ends`, `CDQ_Registration_Late_Begains`, `CDQ_Registration_Late_Ends`, `Registration_amount`, `Registration_late_amount`, `exam_month_year`, `exam01`, `start_reg`, `end_reg`, `amount01`, `start_late_reg`, `end_late_reg`, `amount02`, `retake01`, `retake01_start_reg`, `retake01_end_reg`, `amount03`, `retake02`, `retake02_start_reg`, `retake02_end_reg`, `amount04`, `reset_exam01`, `reset_start_reg`, `reset_end_reg`, `types`) VALUES
(1, 1, '02-08-2020', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.8.2020', '02-08-2020', '08-01-2019', '09-30-2019', '1,327.50', '10-01-2019', '02-07-2020', '1,593.00', '06-13-2020', 'Upon Fail', '06-12-2020', '150.00', '02-06-2021', 'Upon Fail', '06-12-2020', '150.00', '06-13-2026', '11-01-2025', '01-15-2026', 'CDQ'),
(2, 1, '02-06-2021', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.6.2021', '02-06-2021', '08-01-2020', '09-30-2020', '1,327.50', '10-01-2020', '02-05-2021', '1,593.00', '06-12-2021', 'Upon Fail', '06-11-2021', '150.00', '02-05-2022', 'Upon Fail', '02-04-2022', '150.00', '06-12-2027', '11-01-2026', '01-15-2026', 'CDQ'),
(3, 1, '02-05-2022', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.5.2022', '02-05-2022', '08-01-2021', '09-30-2021', '1,327.50', '10-01-2021', '02-04-2022', '1,593.00', '06-11-2022', 'Upon Fail', '06-10-2022', '150.00', '02-04-2023', 'Upon Fail', '02-03-2023', '150.00', '06-11-2028', '11-01-2027', '01-15-2026', 'CDQ'),
(4, 1, '02-04-2023', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.04.2023', '02-04-2023', '08-01-2022', '09-30-2012', '1,327.50', '10-01-2022', '02-03-2023', '1,593.00', '06-10-2023', 'Upon Fail', '06-09-2023', '150.00', '02-10-2024', 'Upon Fail', '02-09-2024', '150.00', '06-10-2029', '11-01-2028', '01-15-2026', 'CDQ'),
(6, 1, '02-08-2025', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.02.2025', '02-08-2025', '08-01-2024', '09-30-2014', '1,327.50', '10-01-2024', '02-07-2025', '1,593.00', '06-14-2025', 'Upon Fail', '06-13-2025', '150.00', '02-14-2026', 'Upon Fail', '02-13-2026', '150.00', '06-14-2031', '11-01-2030', '01-15-2026', 'CDQ'),
(7, 1, '02-10-2024', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.10.2024', '02-10-2024', '08-01-2023', '09-30-2013', '1,327.50', '10-01-2023', '02-09-2024', '1,593.00', '06-08-2024', 'Upon Fail', '06-07-2024', '150.00', '02-08-2025', 'Upon Fail', 'Upon Fail', '150.00', '06-08-2030', '11-01-2029', '01-15-2026', 'CDQ'),
(8, 1, '02-14-2026', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.14.2026', '02-14-2026', '08-01-2025', '09-30-2015', '1,327.50', '10-01-2025', '02-13-2026', '1,593.00', '06-13-2026', 'Upon Fail', '06-12-2026', '150.00', '02-13-2027', 'Upon Fail', '02-12-2027', '150.00', '06-13-2032', '11-01-2031', '01-15-2026', 'CDQ'),
(9, 11, '02-08-2020', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.8.2020', '02-08-2020', '08-01-2019', '09-30-2019', '1,327.50', '10-01-2019', '02-07-2020', '1,593.00', '06-13-2020', 'Upon Fail', '06-12-2020', '150.00', '02-06-2021', 'Upon Fail', '06-12-2020', '150.00', '06-13-2026', '11-01-2025', '01-15-2026', 'CDQ'),
(10, 11, '02-06-2021', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.6.2021', '02-06-2021', '08-01-2020', '09-30-2020', '1,327.50', '10-01-2020', '02-05-2021', '1,593.00', '06-12-2021', 'Upon Fail', '06-11-2021', '150.00', '02-05-2022', 'Upon Fail', '02-04-2022', '150.00', '06-12-2027', '11-01-2026', '01-15-2026', 'CDQ'),
(11, 11, '02-05-2022', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.5.2022', '02-05-2022', '08-01-2021', '09-30-2021', '1,327.50', '10-01-2021', '02-04-2022', '1,593.00', '06-11-2022', 'Upon Fail', '06-10-2022', '150.00', '02-04-2023', 'Upon Fail', '02-03-2023', '150.00', '06-11-2028', '11-01-2027', '01-15-2026', 'CDQ'),
(12, 11, '02-04-2023', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.04.2023', '02-04-2023', '08-01-2022', '09-30-2012', '1,327.50', '10-01-2022', '02-03-2023', '1,593.00', '06-10-2023', 'Upon Fail', '06-09-2023', '150.00', '02-10-2024', 'Upon Fail', '02-09-2024', '150.00', '06-10-2029', '11-01-2028', '01-15-2026', 'CDQ'),
(13, 11, '02-08-2025', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.02.2025', '02-08-2025', '08-01-2024', '09-30-2014', '1,327.50', '10-01-2024', '02-07-2025', '1,593.00', '06-14-2025', 'Upon Fail', '06-13-2025', '150.00', '02-14-2026', 'Upon Fail', '02-13-2026', '150.00', '06-14-2031', '11-01-2030', '01-15-2026', 'CDQ'),
(14, 11, '02-10-2024', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.10.2024', '02-10-2024', '08-01-2023', '09-30-2013', '1,327.50', '10-01-2023', '02-09-2024', '1,593.00', '06-08-2024', 'Upon Fail', '06-07-2024', '150.00', '02-08-2025', 'Upon Fail', 'Upon Fail', '150.00', '06-08-2030', '11-01-2029', '01-15-2026', 'CDQ'),
(15, 11, '02-14-2026', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.14.2026', '02-14-2026', '08-01-2025', '09-30-2015', '1,327.50', '10-01-2025', '02-13-2026', '1,593.00', '06-13-2026', 'Upon Fail', '06-12-2026', '150.00', '02-13-2027', 'Upon Fail', '02-12-2027', '150.00', '06-13-2032', '11-01-2031', '01-15-2026', 'CDQ'),
(16, 12, '02-08-2020', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.8.2020', '02-08-2020', '08-01-2019', '09-30-2019', '1,327.50', '10-01-2019', '02-07-2020', '1,593.00', '06-13-2020', 'Upon Fail', '06-12-2020', '150.00', '02-06-2021', 'Upon Fail', '06-12-2020', '150.00', '06-13-2026', '11-01-2025', '01-15-2026', 'CDQ'),
(17, 12, '02-06-2021', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.6.2021', '02-06-2021', '08-01-2020', '09-30-2020', '1,327.50', '10-01-2020', '02-05-2021', '1,593.00', '06-12-2021', 'Upon Fail', '06-11-2021', '150.00', '02-05-2022', 'Upon Fail', '02-04-2022', '150.00', '06-12-2027', '11-01-2026', '01-15-2026', 'CDQ'),
(18, 12, '02-05-2022', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.5.2022', '02-05-2022', '08-01-2021', '09-30-2021', '1,327.50', '10-01-2021', '02-04-2022', '1,593.00', '06-11-2022', 'Upon Fail', '06-10-2022', '150.00', '02-04-2023', 'Upon Fail', '02-03-2023', '150.00', '06-11-2028', '11-01-2027', '01-15-2026', 'CDQ'),
(19, 12, '02-04-2023', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.04.2023', '02-04-2023', '08-01-2022', '09-30-2012', '1,327.50', '10-01-2022', '02-03-2023', '1,593.00', '06-10-2023', 'Upon Fail', '06-09-2023', '150.00', '02-10-2024', 'Upon Fail', '02-09-2024', '150.00', '06-10-2029', '11-01-2028', '01-15-2026', 'CDQ'),
(20, 12, '02-08-2025', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.02.2025', '02-08-2025', '08-01-2024', '09-30-2014', '1,327.50', '10-01-2024', '02-07-2025', '1,593.00', '06-14-2025', 'Upon Fail', '06-13-2025', '150.00', '02-14-2026', 'Upon Fail', '02-13-2026', '150.00', '06-14-2031', '11-01-2030', '01-15-2026', 'CDQ'),
(21, 12, '02-10-2024', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.10.2024', '02-10-2024', '08-01-2023', '09-30-2013', '1,327.50', '10-01-2023', '02-09-2024', '1,593.00', '06-08-2024', 'Upon Fail', '06-07-2024', '150.00', '02-08-2025', 'Upon Fail', 'Upon Fail', '150.00', '06-08-2030', '11-01-2029', '01-15-2026', 'CDQ'),
(22, 12, '02-14-2026', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.14.2026', '02-14-2026', '08-01-2025', '09-30-2015', '1,327.50', '10-01-2025', '02-13-2026', '1,593.00', '06-13-2026', 'Upon Fail', '06-12-2026', '150.00', '02-13-2027', 'Upon Fail', '02-12-2027', '150.00', '06-13-2032', '11-01-2031', '01-15-2026', 'CDQ'),
(23, 9, '02-08-2020', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.8.2020', '02-08-2020', '08-01-2019', '09-30-2019', '1,327.50', '10-01-2019', '02-07-2020', '1,593.00', '06-13-2020', 'Upon Fail', '06-12-2020', '150.00', '02-06-2021', 'Upon Fail', '06-12-2020', '150.00', '06-13-2026', '11-01-2025', '01-15-2026', 'CDQ'),
(24, 9, '02-06-2021', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.6.2021', '02-06-2021', '08-01-2020', '09-30-2020', '1,327.50', '10-01-2020', '02-05-2021', '1,593.00', '06-12-2021', 'Upon Fail', '06-11-2021', '150.00', '02-05-2022', 'Upon Fail', '02-04-2022', '150.00', '06-12-2027', '11-01-2026', '01-15-2026', 'CDQ'),
(25, 9, '02-05-2022', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.5.2022', '02-05-2022', '08-01-2021', '09-30-2021', '1,327.50', '10-01-2021', '02-04-2022', '1,593.00', '06-11-2022', 'Upon Fail', '06-10-2022', '150.00', '02-04-2023', 'Upon Fail', '02-03-2023', '150.00', '06-11-2028', '11-01-2027', '01-15-2026', 'CDQ'),
(26, 9, '02-04-2023', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.04.2023', '02-04-2023', '08-01-2022', '09-30-2012', '1,327.50', '10-01-2022', '02-03-2023', '1,593.00', '06-10-2023', 'Upon Fail', '06-09-2023', '150.00', '02-10-2024', 'Upon Fail', '02-09-2024', '150.00', '06-10-2029', '11-01-2028', '01-15-2026', 'CDQ'),
(27, 9, '02-08-2025', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.02.2025', '02-08-2025', '08-01-2024', '09-30-2014', '1,327.50', '10-01-2024', '02-07-2025', '1,593.00', '06-14-2025', 'Upon Fail', '06-13-2025', '150.00', '02-14-2026', 'Upon Fail', '02-13-2026', '150.00', '06-14-2031', '11-01-2030', '01-15-2026', 'CDQ'),
(28, 9, '02-10-2024', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.10.2024', '02-10-2024', '08-01-2023', '09-30-2013', '1,327.50', '10-01-2023', '02-09-2024', '1,593.00', '06-08-2024', 'Upon Fail', '06-07-2024', '150.00', '02-08-2025', 'Upon Fail', 'Upon Fail', '150.00', '06-08-2030', '11-01-2029', '01-15-2026', 'CDQ'),
(29, 9, '02-14-2026', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'feb.14.2026', '02-14-2026', '08-01-2025', '09-30-2015', '1,327.50', '10-01-2025', '02-13-2026', '1,593.00', '06-13-2026', 'Upon Fail', '06-12-2026', '150.00', '02-13-2027', 'Upon Fail', '02-12-2027', '150.00', '06-13-2032', '11-01-2031', '01-15-2026', 'CDQ'),
(30, 2, '06-13-2020', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.2020', '06-13-2020', '11-01-2019', '01-15-2020', '1,327.50', '01-16-2020', '06-12-2020', '1,593.00', '02-06-2021', 'Upon Fail', '02-05-2021', '150.00', '150.00', 'Upon Fail', '06-11-2021', '150.00', '06-13-2026', '11-01-2025', '01-15-2026', 'CDQ'),
(32, 2, '06-12-2021', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.12.2021', '06-12-2021', '11/01/2020', '01-15-2021', '1,327.50', '01-16-2021', '06-11-2021', '1,593.00', '02-05-2022', 'Upon Fail', '02-04-2022', '150.00', '06-11-2022', 'Upon Fail', '06-10-2022', '150.00', '06-12-2027', '11-01-2026', '01-15-2026', 'CDQ'),
(33, 2, '06-11-2022', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.11.2022', '06-11-2022', '11-01-2021', '01-15-2022', '1,327.50', '01-16-2022', '06-10-2022', '1,593.00', '02-04-2023', 'Upon Fail', '02-03-2023', '150.00', '06-10-2023', 'Upon Fail', '06-09-2023', '150.00', '06-11-2028', '11-01-2027', '01-15-2026', 'CDQ'),
(34, 2, '06-10-2023', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.10.2023', '06-10-2023', '11-01-2022', '01-15-2023', '1,327.50', '01-16-2023', '06-09-2023', '1,593.00', '02-10-2024', 'Upon Fail', '02-09-2024', '150.00', '06-08-2024', 'Upon Fail', '06-07-2024', '150.00', '06-10-2029', '11-01-2028', '01-15-2026', 'CDQ'),
(35, 2, '06-08-2024', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.8.2024', '06-08-2024', '11-01-2023', '01-15-2024', '1,327.50', '01-16-2024', '06-07-2024', '1,593.00', '02-08-2025', 'Upon Fail', '02-07-2025', '150.00', '06-14-2025', 'Upon Fail', '06-13-2025', '150.00', '06-08-2030', '11-01-2029', '01-15-2026', 'CDQ'),
(36, 2, '06-14-2025', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.14.2025', '06-14-2025', '11-01-2024', '01-15-2025', '1,327.50', '01-16-2025', '06-13-2025', '1,593.00', '02-14-2026', 'Upon Fail', '02-13-2026', '150.00', '06-13-2026', 'Upon Fail', '06-12-2026', '150.00', '06-14-2031', '11-01-2030', '01-15-2026', 'CDQ'),
(37, 2, '06-13-2026', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.26', '06-13-2026', '11-01-2025', '01-15-2026', '1,327.50', '01-16-2026', '06-12-2026', '1,593.00', '02-13-2027', 'Upon Fail', '02-12-2027', '02-12-2027', '06-12-2027', 'Upon Fail', '06-11-2027', '150.00', '06-13-2032', '11-01-2031', '01-15-2026', 'CDQ'),
(42, 3, '06-13-2020', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.2020', '06-13-2020', '11-01-2019', '01-15-2020', '1,327.50', '01-16-2020', '06-12-2020', '1,593.00', '02-06-2021', 'Upon Fail', '02-05-2021', '150.00', '150.00', 'Upon Fail', '06-11-2021', '150.00', '06-13-2026', '11-01-2025', '01-15-2026', 'CDQ'),
(43, 3, '06-12-2021', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.12.2021', '06-12-2021', '11/01/2020', '01-15-2021', '1,327.50', '01-16-2021', '06-11-2021', '1,593.00', '02-05-2022', 'Upon Fail', '02-04-2022', '150.00', '06-11-2022', 'Upon Fail', '06-10-2022', '150.00', '06-12-2027', '11-01-2026', '01-15-2026', 'CDQ'),
(44, 3, '06-11-2022', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.11.2022', '06-11-2022', '11-01-2021', '01-15-2022', '1,327.50', '01-16-2022', '06-10-2022', '1,593.00', '02-04-2023', 'Upon Fail', '02-03-2023', '150.00', '06-10-2023', 'Upon Fail', '06-09-2023', '150.00', '06-11-2028', '11-01-2027', '01-15-2026', 'CDQ'),
(45, 3, '06-10-2023', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.10.2023', '06-10-2023', '11-01-2022', '01-15-2023', '1,327.50', '01-16-2023', '06-09-2023', '1,593.00', '02-10-2024', 'Upon Fail', '02-09-2024', '150.00', '06-08-2024', 'Upon Fail', '06-07-2024', '150.00', '06-10-2029', '11-01-2028', '01-15-2026', 'CDQ'),
(46, 3, '06-08-2024', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.8.2024', '06-08-2024', '11-01-2023', '01-15-2024', '1,327.50', '01-16-2024', '06-07-2024', '1,593.00', '02-08-2025', 'Upon Fail', '02-07-2025', '150.00', '06-14-2025', 'Upon Fail', '06-13-2025', '150.00', '06-08-2030', '11-01-2029', '01-15-2026', 'CDQ'),
(47, 3, '06-14-2025', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.14.2025', '06-14-2025', '11-01-2024', '01-15-2025', '1,327.50', '01-16-2025', '06-13-2025', '1,593.00', '02-14-2026', 'Upon Fail', '02-13-2026', '150.00', '06-13-2026', 'Upon Fail', '06-12-2026', '150.00', '06-14-2031', '11-01-2030', '01-15-2026', 'CDQ'),
(48, 3, '06-13-2026', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.26', '06-13-2026', '11-01-2025', '01-15-2026', '1,327.50', '01-16-2026', '06-12-2026', '1,593.00', '02-13-2027', 'Upon Fail', '02-12-2027', '02-12-2027', '06-12-2027', 'Upon Fail', '06-11-2027', '150.00', '06-13-2032', '11-01-2031', '01-15-2026', 'CDQ'),
(49, 6, '06-13-2020', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.2020', '06-13-2020', '11-01-2019', '01-15-2020', '1,327.50', '01-16-2020', '06-12-2020', '1,593.00', '02-06-2021', 'Upon Fail', '02-05-2021', '150.00', '150.00', 'Upon Fail', '06-11-2021', '150.00', '06-13-2026', '11-01-2025', '01-15-2026', 'CDQ'),
(50, 6, '06-12-2021', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.12.2021', '06-12-2021', '11/01/2020', '01-15-2021', '1,327.50', '01-16-2021', '06-11-2021', '1,593.00', '02-05-2022', 'Upon Fail', '02-04-2022', '150.00', '06-11-2022', 'Upon Fail', '06-10-2022', '150.00', '06-12-2027', '11-01-2026', '01-15-2026', 'CDQ'),
(51, 6, '06-11-2022', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.11.2022', '06-11-2022', '11-01-2021', '01-15-2022', '1,327.50', '01-16-2022', '06-10-2022', '1,593.00', '02-04-2023', 'Upon Fail', '02-03-2023', '150.00', '06-10-2023', 'Upon Fail', '06-09-2023', '150.00', '06-11-2028', '11-01-2027', '01-15-2026', 'CDQ'),
(52, 6, '06-10-2023', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.10.2023', '06-10-2023', '11-01-2022', '01-15-2023', '1,327.50', '01-16-2023', '06-09-2023', '1,593.00', '02-10-2024', 'Upon Fail', '02-09-2024', '150.00', '06-08-2024', 'Upon Fail', '06-07-2024', '150.00', '06-10-2029', '11-01-2028', '01-15-2026', 'CDQ'),
(53, 6, '06-08-2024', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.8.2024', '06-08-2024', '11-01-2023', '01-15-2024', '1,327.50', '01-16-2024', '06-07-2024', '1,593.00', '02-08-2025', 'Upon Fail', '02-07-2025', '150.00', '06-14-2025', 'Upon Fail', '06-13-2025', '150.00', '06-08-2030', '11-01-2029', '01-15-2026', 'CDQ'),
(54, 6, '06-14-2025', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.14.2025', '06-14-2025', '11-01-2024', '01-15-2025', '1,327.50', '01-16-2025', '06-13-2025', '1,593.00', '02-14-2026', 'Upon Fail', '02-13-2026', '150.00', '06-13-2026', 'Upon Fail', '06-12-2026', '150.00', '06-14-2031', '11-01-2030', '01-15-2026', 'CDQ'),
(55, 6, '06-13-2026', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.26', '06-13-2026', '11-01-2025', '01-15-2026', '1,327.50', '01-16-2026', '06-12-2026', '1,593.00', '02-13-2027', 'Upon Fail', '02-12-2027', '02-12-2027', '06-12-2027', 'Upon Fail', '06-11-2027', '150.00', '06-13-2032', '11-01-2031', '01-15-2026', 'CDQ'),
(56, 7, '06-13-2020', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.2020', '06-13-2020', '11-01-2019', '01-15-2020', '1,327.50', '01-16-2020', '06-12-2020', '1,593.00', '02-06-2021', 'Upon Fail', '02-05-2021', '150.00', '150.00', 'Upon Fail', '06-11-2021', '150.00', '06-13-2026', '11-01-2025', '01-15-2026', 'CDQ'),
(57, 7, '06-12-2021', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.12.2021', '06-12-2021', '11/01/2020', '01-15-2021', '1,327.50', '01-16-2021', '06-11-2021', '1,593.00', '02-05-2022', 'Upon Fail', '02-04-2022', '150.00', '06-11-2022', 'Upon Fail', '06-10-2022', '150.00', '06-12-2027', '11-01-2026', '01-15-2026', 'CDQ'),
(58, 7, '06-11-2022', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.11.2022', '06-11-2022', '11-01-2021', '01-15-2022', '1,327.50', '01-16-2022', '06-10-2022', '1,593.00', '02-04-2023', 'Upon Fail', '02-03-2023', '150.00', '06-10-2023', 'Upon Fail', '06-09-2023', '150.00', '06-11-2028', '11-01-2027', '01-15-2026', 'CDQ'),
(59, 7, '06-10-2023', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.10.2023', '06-10-2023', '11-01-2022', '01-15-2023', '1,327.50', '01-16-2023', '06-09-2023', '1,593.00', '02-10-2024', 'Upon Fail', '02-09-2024', '150.00', '06-08-2024', 'Upon Fail', '06-07-2024', '150.00', '06-10-2029', '11-01-2028', '01-15-2026', 'CDQ'),
(60, 7, '06-08-2024', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.8.2024', '06-08-2024', '11-01-2023', '01-15-2024', '1,327.50', '01-16-2024', '06-07-2024', '1,593.00', '02-08-2025', 'Upon Fail', '02-07-2025', '150.00', '06-14-2025', 'Upon Fail', '06-13-2025', '150.00', '06-08-2030', '11-01-2029', '01-15-2026', 'CDQ'),
(61, 7, '06-14-2025', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.14.2025', '06-14-2025', '11-01-2024', '01-15-2025', '1,327.50', '01-16-2025', '06-13-2025', '1,593.00', '02-14-2026', 'Upon Fail', '02-13-2026', '150.00', '06-13-2026', 'Upon Fail', '06-12-2026', '150.00', '06-14-2031', '11-01-2030', '01-15-2026', 'CDQ'),
(62, 7, '06-13-2026', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.26', '06-13-2026', '11-01-2025', '01-15-2026', '1,327.50', '01-16-2026', '06-12-2026', '1,593.00', '02-13-2027', 'Upon Fail', '02-12-2027', '02-12-2027', '06-12-2027', 'Upon Fail', '06-11-2027', '150.00', '06-13-2032', '11-01-2031', '01-15-2026', 'CDQ'),
(63, 8, '06-13-2020', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.2020', '06-13-2020', '11-01-2019', '01-15-2020', '1,327.50', '01-16-2020', '06-12-2020', '1,593.00', '02-06-2021', 'Upon Fail', '02-05-2021', '150.00', '150.00', 'Upon Fail', '06-11-2021', '150.00', '06-13-2026', '11-01-2025', '01-15-2026', 'CDQ'),
(64, 8, '06-12-2021', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.12.2021', '06-12-2021', '11/01/2020', '01-15-2021', '1,327.50', '01-16-2021', '06-11-2021', '1,593.00', '02-05-2022', 'Upon Fail', '02-04-2022', '150.00', '06-11-2022', 'Upon Fail', '06-10-2022', '150.00', '06-12-2027', '11-01-2026', '01-15-2026', 'CDQ'),
(65, 8, '06-11-2022', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.11.2022', '06-11-2022', '11-01-2021', '01-15-2022', '1,327.50', '01-16-2022', '06-10-2022', '1,593.00', '02-04-2023', 'Upon Fail', '02-03-2023', '150.00', '06-10-2023', 'Upon Fail', '06-09-2023', '150.00', '06-11-2028', '11-01-2027', '01-15-2026', 'CDQ'),
(66, 8, '06-10-2023', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.10.2023', '06-10-2023', '11-01-2022', '01-15-2023', '1,327.50', '01-16-2023', '06-09-2023', '1,593.00', '02-10-2024', 'Upon Fail', '02-09-2024', '150.00', '06-08-2024', 'Upon Fail', '06-07-2024', '150.00', '06-10-2029', '11-01-2028', '01-15-2026', 'CDQ'),
(67, 8, '06-08-2024', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.8.2024', '06-08-2024', '11-01-2023', '01-15-2024', '1,327.50', '01-16-2024', '06-07-2024', '1,593.00', '02-08-2025', 'Upon Fail', '02-07-2025', '150.00', '06-14-2025', 'Upon Fail', '06-13-2025', '150.00', '06-08-2030', '11-01-2029', '01-15-2026', 'CDQ'),
(68, 8, '06-14-2025', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.14.2025', '06-14-2025', '11-01-2024', '01-15-2025', '1,327.50', '01-16-2025', '06-13-2025', '1,593.00', '02-14-2026', 'Upon Fail', '02-13-2026', '150.00', '06-13-2026', 'Upon Fail', '06-12-2026', '150.00', '06-14-2031', '11-01-2030', '01-15-2026', 'CDQ'),
(69, 8, '06-13-2026', '', '', '', '', '', '', '', 0000, '', '', '', '', '', 0.00, 0.00, 'jun.13.26', '06-13-2026', '11-01-2025', '01-15-2026', '1,327.50', '01-16-2026', '06-12-2026', '1,593.00', '02-13-2027', 'Upon Fail', '02-12-2027', '02-12-2027', '06-12-2027', 'Upon Fail', '06-11-2027', '150.00', '06-13-2032', '11-01-2031', '01-15-2026', 'CDQ'),
(70, 7, '', '', '', '08/16/2019', '', '', '', '', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(71, 6, '01/17/2020', '', '06/08/2019', '08/09/2019', '', '', '', '', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(72, 6, '06/04/2018', '06/01/2019', '06/13/2020', '08/08/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(73, 10, '08/01/2018', '06/01/2019', '10/12/2019', '12/13/2019', '04/01/2019', '05/15/2019', '04/01/2019', '06/15/2019', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(74, -490, '', '', '02/08/2020', '', '', '', '11/01/2019', '01/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(75, 8, '05/29/2018', '06/01/2019', '06/13/2020', '08/01/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(76, 2, '09/01/2018', '10/01/2019', '11/01/2069', '12/01/2070', '04/01/2019', '04/02/2019', '04/03/2019', '04/04/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(77, 11, '05/29/2018', '06/01/2019', '02/08/2020', '05/17/2020', '', '', '08/01/2019', '09/30/2019', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(78, 5, '08/21/2017', '06/01/2019', '10/12/2019', '12/07/2019', '04/01/2019', '05/15/2019', '04/01/2019', '06/15/2019', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(79, 10, '08/01/2018', '06/06/2020', '10/10/2020', '12/11/2020', '04/01/2020', '05/01/2020', '04/01/2020', '05/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(80, 4, '08/28/2017', '06/01/2019', '10/12/2019', '12/15/2019', '04/01/2019', '05/15/2019', '04/01/2019', '05/15/2019', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(81, 4, '08/26/2019', '06/06/2020', '10/10/2020', '12/13/2020', '04/01/2020', '05/15/2020', '04/01/2020', '05/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(82, 3, '05/29/2018', '06/01/2019', '06/13/2020', '08/01/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(83, 7, '05/21/2018', '06/01/2019', '06/13/2020', '08/14/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(84, 7, '01/01/2021', '06/01/2022', '06/13/2020', '10/14/2023', '', '', '11/01/2019', '01/15/2020', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(85, 12, '', '06/01/2019', '02/08/2020', '05/17/2020', '04/01/2019', '05/01/2019', '08/01/2019', '09/30/2019', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(86, 6, '06/03/2019', '06/06/2020', '06/12/2021', '08/06/2021', '04/01/2020', '05/01/2020', '11/01/2020', '01/15/2021', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(87, 1, '', '', '', '05/19/2019', '', '', '', '', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(88, 2, '', '', '', '09/14/2019', '', '', '', '', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(89, 3, '', '', '', '08/16/2019', '', '', '', '', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(90, 8, '', '', '', '08/16/2019', '', '', '', '', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(91, 9, '', '', '', '05/17/2019', '', '', '', '', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(92, 11, '05/30/2017', '06/02/2018', '02/09/2019', '05/19/2019', '', '', '', '', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(93, 12, '', '', '', '05/19/2019', '', '', '', '', 2019, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(94, 1, '', '', '02/08/2020', '05/17/2020', '', '', '08/01/2019', '09/30/2019', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(95, 5, '08/20/2018', '06/06/2020', '10/10/2020', '12/05/2020', '04/01/2020', '05/15/2020', '04/01/2020', '06/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(96, 9, '01/08/2018', '06/01/2019', '02/08/2020', '05/18/2020', '', '', '08/01/2019', '09/30/2019', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(97, 2, '06/17/2019', '06/06/2020', '06/12/2021', '09/10/2021', '04/01/2020', '05/01/2020', '11/01/2020', '01/15/2021', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(98, -3202, '08/01/2018', '06/06/2020', '10/10/2020', '12/11/2020', '04/01/2020', '05/01/2020', '04/01/2020', '05/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(99, 10, '', '06/05/2021', '10/09/2021', '', '04/01/2021', '05/01/2021', '04/01/2021', '05/15/2021', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(100, 1, '', '06/06/2020', '02/13/2021', '', '04/01/2020', '05/01/2020', '08/01/2020', '09/30/2020', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(101, 1, '', '06/05/2021', '02/12/2022', '', '04/01/2021', '05/01/2021', '08/01/2021', '09/30/2021', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(102, 1, '', '06/04/2022', '02/11/2023', '', '04/01/2022', '05/01/2022', '08/01/2022', '09/30/2022', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(103, 2, '', '06/05/2021', '06/11/2022', '09/18/2022', '04/01/2021', '05/01/2021', '11/01/2021', '01/15/2022', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(104, 2, '', '06/04/2022', '06/10/2023', '', '04/01/2022', '05/01/2022', '11/01/2022', '01/15/2023', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(105, 3, '08/20/2019', '06/06/2020', '06/12/2021', '05/15/2021', '04/01/2020', '05/01/2020', '11/01/2020', '01/15/2021', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(106, 3, '', '', '', '', '', '', '', '', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(107, 3, '', '06/04/2022', '06/10/2023', '', '04/01/2022', '05/01/2022', '11/01/2022', '01/15/2023', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(108, 4, '', '06/05/2021', '10/09/2021', '12/18/2021', '04/01/2021', '05/01/2021', '04/01/2021', '05/15/2021', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(109, 4, '', '06/04/2022', '10/08/2022', '', '04/01/2022', '05/01/2022', '04/01/2022', '05/15/2022', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(110, 4, '', '06/03/2023', '10/14/2023', '', '04/01/2023', '05/01/2023', '04/01/2023', '05/15/2023', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(111, 5, '08/20/2019', '06/05/2021', '10/09/2021', '12/04/2021', '04/01/2021', '05/01/2021', '04/01/2021', '05/15/2021', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(112, 5, '', '06/04/2022', '10/08/2022', '', '04/01/2022', '05/01/2022', '04/01/2022', '05/15/2022', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(113, 5, '', '06/03/2023', '10/14/2023', '', '04/01/2023', '05/01/2023', '04/01/2023', '05/15/2023', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(114, 6, '06/03/2020', '06/05/2021', '06/11/2022', '08/06/2022', '04/01/2021', '05/01/2021', '11/01/2021', '01/15/2022', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(115, 6, '', '06/04/2022', '06/10/2023', '', '04/01/2022', '05/01/2022', '11/01/2022', '01/15/2023', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(116, 7, '', '06/06/2020', '06/12/2021', '', '04/01/2020', '05/01/2020', '11/01/2020', '01/15/2021', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(117, 7, '', '06/05/2021', '06/11/2022', '', '04/01/2021', '05/01/2021', '11/01/2021', '01/15/2022', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(118, 8, '', '06/06/2020', '06/05/2021', '', '04/01/2020', '05/01/2020', '11/01/2020', '01/15/2021', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(119, 8, '', '', '06/05/2021', '06/11/2022', '04/01/2021', '05/01/2021', '11/01/2021', '01/15/2022', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(120, 8, '', '06/04/2022', '06/10/2023', '', '04/01/2022', '05/01/2022', '11/01/2022', '01/15/2023', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(121, 9, '01/07/2019', '06/06/2020', '02/13/2021', '05/17/2021', '04/01/2020', '05/01/2020', '08/01/2020', '09/30/2020', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(122, 9, '01/06/2020', '06/05/2021', '02/12/2022', '05/16/2022', '04/01/2021', '05/01/2021', '08/01/2021', '09/30/2021', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(123, 9, '', '06/04/2022', '02/11/2023', '', '04/01/2022', '05/01/2022', '11/01/2022', '01/15/2023', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(124, 10, '', '06/04/2022', '10/08/2022', '', '04/01/2022', '05/01/2022', '04/01/2022', '05/15/2022', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(125, 10, '', '06/03/2023', '10/14/2023', '', '04/01/2023', '05/01/2023', '04/01/2023', '05/15/2023', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(126, 11, '05/28/2019', '06/06/2020', '02/06/2021', '05/16/2021', '04/01/2020', '05/01/2020', '08/01/2020', '09/30/2020', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(127, 11, '05/26/2020', '06/05/2021', '02/12/2022', '05/15/2022', '04/01/2021', '05/01/2021', '08/01/2021', '09/30/2021', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(128, 11, '', '06/04/2022', '02/11/2023', '', '04/01/2022', '05/01/2022', '08/01/2022', '09/30/2022', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(129, 12, '', '06/06/2020', '02/13/2021', '', '04/01/2020', '05/01/2020', '08/01/2020', '09/30/2020', 2021, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(130, 12, '', '06/05/2021', '02/12/2022', '05/15/2022', '04/01/2021', '05/01/2021', '08/01/2021', '09/30/2021', 2022, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(131, 12, '', '06/04/2022', '02/11/2023', '', '04/01/2022', '05/01/2022', '08/01/2022', '09/30/2022', 2023, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(132, -352, '06/04/2018', '06/01/2019', '06/13/2020', '08/08/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(133, 72, '05/01/2020', '05/02/2020', '05/03/2020', '05/04/2020', '05/06/2020', '05/07/2020', '05/08/2020', '05/09/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(134, 276, '05/01/2020', '07/02/2020', '08/01/2020', '09/30/2020', '05/06/2020', '05/07/2020', '05/08/2020', '05/09/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(135, 277, '09/01/2018', '10/01/2019', '11/01/2077', '12/01/2078', '04/01/2019', '04/02/2019', '04/03/2019', '04/04/2020', 2020, '', '', '', '', '', 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expected_datesOLD`
--

CREATE TABLE `tbl_expected_datesOLD` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `Matriculation_Date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Expected_ITE_Exam` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Expected_Cert_Exam` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Expected_Graduation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ITE_Registration_Begins` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ITE_Registration_Ends` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Cert_Registration_Begins` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Cert_Registration_Ends` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `class_of_year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_expected_datesOLD`
--

INSERT INTO `tbl_expected_datesOLD` (`id`, `University_Id`, `Matriculation_Date`, `Expected_ITE_Exam`, `Expected_Cert_Exam`, `Expected_Graduation`, `ITE_Registration_Begins`, `ITE_Registration_Ends`, `Cert_Registration_Begins`, `Cert_Registration_Ends`, `class_of_year`) VALUES
(21, 12, '05/30/2017', '06/02/2018', '02/09/2019', '05/19/2019', '01/01/2018', '06/01/2018', '11/01/2018', '05/18/2019', 2019),
(22, -3202, '06/05/2017', '06/02/2018', '06/08/2019', '08/10/2019', '04/01/2018', '05/15/2018', '11/01/2018', '01/15/2019', 2019),
(23, 6, '06/05/2017', '06/02/2018', '06/08/2019', '08/10/2019', '04/01/2018', '05/15/2018', '11/01/2018', '01/15/2019', 2019),
(24, 11, '05/30/2017', '06/02/2018', '02/09/2019', '05/19/2019', '04/01/2018', '05/15/2018', '08/01/2018', '09/30/2018', 2019),
(25, 11, '05/29/2018', '06/01/2019', '02/08/2020', '05/17/2020', '04/01/2019', '05/15/2019', '08/01/2019', '09/30/2019', 2020),
(26, 11, '05/28/2019', '06/06/2020', '02/06/2021', '05/16/2021', '04/01/2020', '05/15/2020', '08/01/2021', '09/30/2021', 2021),
(27, 12, '06/04/2018', '06/01/2019', '06/13/2020', '08/20/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020),
(28, 12, '05/28/2019', '06/06/2020', '02/06/2021', '05/16/2021', '04/01/2020', '05/15/2020', '08/01/2020', '09/30/2020', 2021),
(29, 1, '06/01/2017', '06/02/2018', '02/09/2019', '05/19/2019', '04/01/2018', '05/15/2018', '08/01/2018', '09/30/2018', 2019),
(30, 1, '05/29/2018', '06/01/2019', '02/08/2020', '05/17/2020', '04/01/2019', '05/15/2019', '08/01/2019', '09/30/2019', 2020),
(31, 1, '05/28/2019', '06/06/2020', '02/06/2021', '05/16/2021', '04/01/2020', '05/15/2020', '08/01/2020', '09/30/2020', 2021),
(32, 6, '06/04/2018', '06/01/2019', '06/13/2020', '08/20/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020),
(33, 6, '06/03/2019', '06/06/2020', '06/12/2021', '08/06/2021', '04/01/2020', '05/15/2020', '11/01/2020', '01/15/2021', 2021),
(34, 5, '08/21/2017', '06/01/2019', '10/12/2019', '12/07/2019', '04/01/2019', '05/15/2019', '04/01/2019', '06/15/2019', 2019),
(35, 5, '08/20/2018', '06/06/2020', '10/10/2020', '12/05/2020', '04/01/2020', '05/15/2020', '04/01/2020', '06/15/2020', 2020),
(36, 5, '08/26/2019', '06/05/2021', '10/09/2021', '12/04/2021', '04/01/2021', '05/15/2021', '04/01/2021', '06/15/2021', 2021),
(37, 10, '08/01/2017', '06/01/2019', '10/12/2019', '12/13/2019', '04/01/2019', '05/15/2019', '04/01/2019', '06/15/2019', 2019),
(38, 10, '08/01/2018', '06/06/2020', '10/10/2020', '12/11/2020', '04/01/2020', '05/15/2020', '04/01/2020', '06/15/2020', 2020),
(39, 10, '08/01/2019', '06/05/2021', '10/09/2021', '12/05/2021', '04/01/2021', '05/15/2021', '04/01/2021', '06/15/2021', 2021),
(40, 8, '', '06/02/2018', '06/08/2019', '08/16/2019', '04/01/2018', '05/15/2018', '11/01/2018', '01/15/2019', 2019),
(41, 8, '05/29/2018', '06/01/2019', '06/13/2020', '08/14/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020),
(42, 8, '05/28/2019', '06/06/2020', '06/12/2021', '08/13/2021', '04/01/2020', '05/15/2020', '11/01/2020', '01/15/2021', 2021),
(43, 3, '05/30/2017', '06/02/2018', '06/08/2019', '08/16/2019', '04/01/2018', '05/15/2018', '11/01/2018', '01/15/2019', 2019),
(44, 3, '05/29/2018', '06/01/2019', '06/13/2020', '08/14/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020),
(45, 3, '05/28/2019', '06/06/2020', '06/12/2021', '08/13/2021', '04/01/2020', '05/15/2020', '11/01/2020', '01/15/2021', 2021),
(46, 7, '05/22/2017', '06/02/2018', '06/08/2019', '08/16/2019', '04/01/2018', '05/15/2018', '11/01/2018', '01/15/2019', 2019),
(47, 7, '05/21/2018', '06/01/2019', '06/13/2020', '08/14/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020),
(48, 7, '05/20/2019', '06/06/2020', '06/12/2021', '08/13/2021', '04/01/2020', '05/15/2020', '11/01/2020', '01/15/2021', 2021),
(49, 2, '06/19/2017', '06/02/2018', '06/08/2019', '09/14/2019', '04/01/2018', '05/15/2018', '11/01/2018', '01/15/2019', 2019),
(50, 2, '06/18/2018', '06/01/2019', '06/13/2020', '09/12/2020', '04/01/2019', '05/15/2019', '11/01/2019', '01/15/2020', 2020),
(51, 2, '06/17/2019', '06/06/2020', '06/12/2021', '09/11/2021', '04/01/2020', '05/15/2020', '11/01/2020', '01/15/2021', 2021),
(52, 4, '08/28/2017', '06/01/2019', '10/12/2019', '12/15/2019', '04/01/2019', '05/15/2019', '04/01/2019', '06/15/2019', 2019),
(53, 4, '08/27/2018', '06/06/2020', '10/10/2020', '12/13/2020', '04/01/2020', '05/15/2020', '04/01/2020', '06/15/2020', 2020),
(54, 4, '08/26/2019', '06/05/2021', '10/09/2021', '12/12/2021', '04/01/2021', '05/15/2021', '04/01/2021', '06/15/2021', 2021),
(55, 9, '01/09/2017', '06/02/2018', '02/09/2019', '05/20/2019', '04/01/2018', '05/15/2018', '08/01/2018', '01/15/2019', 2019),
(56, 9, '01/08/2018', '06/01/2019', '02/08/2020', '05/20/2020', '04/01/2019', '05/15/2019', '08/01/2019', '09/30/2019', 2020),
(57, 9, '01/07/2019', '06/06/2020', '02/06/2021', '05/20/2021', '04/01/2020', '05/15/2020', '08/01/2020', '09/30/2020', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medical_director`
--

CREATE TABLE `tbl_medical_director` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Designation` varchar(250) NOT NULL,
  `Job_Title` varchar(250) NOT NULL,
  `Bus_Phone` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Start_Date` varchar(250) NOT NULL,
  `Other_Credentials` varchar(250) NOT NULL,
  `Photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_other`
--

CREATE TABLE `tbl_other` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `Event_Name` varchar(250) NOT NULL,
  `Date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program_details`
--

CREATE TABLE `tbl_program_details` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `Unique_Identifier` varchar(250) NOT NULL,
  `Program_Length` varchar(250) NOT NULL,
  `Matriculation_Date` varchar(250) NOT NULL,
  `First_year` varchar(250) NOT NULL,
  `Degree_Offered` varchar(250) NOT NULL,
  `Designation` varchar(250) NOT NULL,
  `years_certified` varchar(100) DEFAULT NULL,
  `certificate` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_program_details`
--

INSERT INTO `tbl_program_details` (`id`, `University_Id`, `Unique_Identifier`, `Program_Length`, `Matriculation_Date`, `First_year`, `Degree_Offered`, `Designation`, `years_certified`, `certificate`) VALUES
(1, 1, 'Provided by admin', '24', '6/1/2010', '', 'Masters', 'MSA', NULL, NULL),
(2, 2, 'Provided by admin', '28 months', '17-Jun-19', 'Provided by admin', 'Masters', 'MMSc', NULL, NULL),
(3, 3, 'Provided by admin', '27 months', 'Jun-09', 'Provided by admin', 'Masters', 'MS', NULL, NULL),
(4, 4, 'Provided by admin', '28', 'Last week of August', 'Provided by admin - 2013', 'Masters', 'MSA', NULL, NULL),
(5, 5, 'Provided by admin', '28', 'August', 'Provided by admin', 'Masters', 'MSA', NULL, NULL),
(6, 6, 'Provided by admin', '27', 'June', 'Provided by admin', 'Masters', 'MMSc', NULL, NULL),
(7, 7, 'Provided by admin', '27', 'May', 'Provided by admin', 'Masters', 'MMSc', NULL, NULL),
(8, 8, 'Provided by admin', '27 Months', '', 'Provided by admin', 'Masters', '', NULL, NULL),
(9, 9, 'Provided by admin', '29 months', 'January', 'Provided by admin', 'Masters', 'MSA', NULL, NULL),
(10, 10, 'Provided by admin', '28 months', '', 'Provided by admin', 'Masters', 'MSA', NULL, NULL),
(11, 11, 'Provided by admin', '24', '28-May-19', 'Provided by admin', 'Masters', 'MSA', NULL, NULL),
(12, 12, 'Provided by admin', '24', '28-May-19', 'Provided by admin', 'Masters', 'MSA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program_director`
--

CREATE TABLE `tbl_program_director` (
  `user_id` varchar(220) NOT NULL,
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Designation` varchar(250) NOT NULL,
  `Program_Name` varchar(250) NOT NULL,
  `Program_Address` varchar(250) NOT NULL,
  `Title` enum('Regional Director','Program Director','Assistant Program Director','Admin Assistant','ITE Coordinator') NOT NULL,
  `Bus_Phone` varchar(250) NOT NULL,
  `Cell_Phone` varchar(250) NOT NULL,
  `Other` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Start_Date` varchar(250) NOT NULL,
  `Other_Credentials` varchar(250) NOT NULL,
  `Photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_program_director`
--

INSERT INTO `tbl_program_director` (`user_id`, `id`, `University_Id`, `First_Name`, `Last_Name`, `Designation`, `Program_Name`, `Program_Address`, `Title`, `Bus_Phone`, `Cell_Phone`, `Other`, `Email`, `Start_Date`, `Other_Credentials`, `Photo`) VALUES
('0', 91, 1, '', '', 'a', '', '', 'Regional Director', '0', '', '0', '', '05-21-2020', '0', ''),
('0', 92, 1, '', '', '', '', '', 'Program Director', '0', '', '0', '', '05-21-2020', '0', ''),
('0', 93, 1, 'c', '', '', '', '', 'Assistant Program Director', '0', '', '0', '', '05-21-2020', '0', ''),
('0', 94, 1, 'd', '', '', '', '', 'Admin Assistant', '0', '', '0', '', '05-21-2020', '0', ''),
('0', 95, 1, 'e', '', '', '', '', 'ITE Coordinator', '0', '', '0', '', '05-21-2020', '0', ''),
('0', 96, 2, 'Luscious', '', '', '', '', 'Program Director', '0', '', '0', '', '05-23-2020', '0', ''),
('0', 97, 3, 'Deuce', '', '', '', '', 'Program Director', '0', '', '0', '', '05-19-2020', '0', ''),
('0', 98, 4, 'Patches', '', '', '', '', 'Program Director', '0', '', '0', '', '05-19-2020', '0', ''),
('0', 99, 5, 'Shank', '', '', '', '', 'Program Director', '0', '', '0', '', '05-19-2020', '0', ''),
('0', 100, 6, 'Too', 'Sweet', '', '', '', 'Program Director', '0', '', '0', '', '05-19-2020', '0', ''),
('0', 101, 7, 'Alamo', '', '', '', '', 'Program Director', '0', '', '0', '', '05-19-2020', '0', ''),
('0', 102, 8, 'Freckles', '', '', '', '', 'Program Director', '0', '', '0', '', '05-19-2020', '0', ''),
('0', 103, 9, 'Blade', '', '', '', '', 'Program Director', '0', '', '0', '', '05-19-2020', '0', ''),
('0', 104, 10, 'Bugsy', '', '', '', '', 'Program Director', '0', '', '0', '', '05-19-2020', '0', ''),
('0', 106, 12, 'Knuckles', '', '', '', '', 'Program Director', '0', '', '0', '', '05-19-2020', '0', ''),
('0', 107, 277, 'Luscious', '', '', '', '', 'Program Director', '0', '', '0', '', '05-23-2020', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program_medical`
--

CREATE TABLE `tbl_program_medical` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Designation` varchar(250) NOT NULL,
  `Job_Title` varchar(250) NOT NULL,
  `Bus_Phone` varchar(250) NOT NULL,
  `Cell_Phone` varchar(250) NOT NULL,
  `Other` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Start_Date` varchar(250) NOT NULL,
  `Other_Credentials` varchar(250) NOT NULL,
  `Photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regional_director`
--

CREATE TABLE `tbl_regional_director` (
  `id` int(11) NOT NULL,
  `University_Id` int(11) NOT NULL,
  `First_Name` varchar(250) NOT NULL,
  `Last_Name` varchar(250) NOT NULL,
  `Designation` varchar(250) NOT NULL,
  `Job_Title` varchar(250) NOT NULL,
  `Bus_Phone` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Start_Date` varchar(250) NOT NULL,
  `Other_Credentials` varchar(250) NOT NULL,
  `Photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_university`
--

CREATE TABLE `tbl_university` (
  `id` int(11) UNSIGNED NOT NULL,
  `University_Name` varchar(250) NOT NULL,
  `Institution_ID` varchar(100) NOT NULL,
  `Designation` varchar(100) NOT NULL,
  `University_Code` varchar(250) NOT NULL,
  `Program_Address_First` varchar(250) NOT NULL,
  `Program_Address_Second` varchar(250) NOT NULL,
  `Program_Suite` varchar(250) NOT NULL,
  `Program_City` varchar(250) NOT NULL,
  `Program_State` varchar(250) NOT NULL,
  `Program_Zip` varchar(250) NOT NULL,
  `Country` varchar(250) NOT NULL,
  `Program_Bus_Phone` varchar(250) NOT NULL,
  `Program_Other_Phone` varchar(250) NOT NULL,
  `Program_Fax_Phone` varchar(250) NOT NULL,
  `Program_Extension` varchar(250) NOT NULL,
  `Program_School_Photo_First` varchar(250) NOT NULL,
  `Program_School_Photo_Second` varchar(250) NOT NULL,
  `University_Photo` varchar(250) NOT NULL,
  `University_logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_university`
--

INSERT INTO `tbl_university` (`id`, `University_Name`, `Institution_ID`, `Designation`, `University_Code`, `Program_Address_First`, `Program_Address_Second`, `Program_Suite`, `Program_City`, `Program_State`, `Program_Zip`, `Country`, `Program_Bus_Phone`, `Program_Other_Phone`, `Program_Fax_Phone`, `Program_Extension`, `Program_School_Photo_First`, `Program_School_Photo_Second`, `University_Photo`, `University_logo`) VALUES
(1, 'California State', 'ABCD1', 'QQQ1ZZZZ', 'Provided by admin', '122 Main Street', '', '771', 'Houston', 'Texas', '77006', 'United States', '111-111-1111', '111-111-1112', '111-111-1113', '', 'Attach in Email', 'Attach in Email', 'uploads/1_university_photo_1569191521.jpg', 'logo1.jpg'),
(2, 'Central Texas College C', 'ABCD2', 'QQQ2C', 'Provided by admin', '122 Oak Street', '', '772', 'Savannah', 'GA', '31406', 'United States', '111-112-1111', '111-112-1111', '111-112-1111', '', 'Attach in Email', 'Attach in Email', 'uploads/2_university_photo_1583783430.jpg', 'logo7.png'),
(3, 'City 3', 'ABCD3', 'QQQ3', 'Provided by admin', '122 Pine Street', '', '773', 'Tampa', 'FL', '33619', 'United States', '111-113-1111', '111-113-1111', '111-113-1111', '', 'Attach in Email', 'Attach in Email', '', 'logo5.jpg'),
(4, 'City 4', 'ABCD4', 'QQQ4', 'Provided by admin', '122 Spruce Street', 'Mailstop 4444', '774', 'Aurora', 'Colorado', '80045', 'United States', '111-114-1111', '111-114-1111', '111-114-1111', '', 'Attach in Email', 'Attach in Email', '', 'logo8.png'),
(5, 'City 5 Very Long University Address', 'ABCD5', 'QQQ5', 'Provided by admin', '122 Dust Street', 'Major Hall', '775', 'Indianapolis', 'Indiana', '46202', 'United States', '111-115-1111', 'N/A', '111-115-1111', 'N/A', 'Attach in Email', 'Attach in Email', '', 'logo3.png'),
(6, 'City 6', 'ABCD6', 'QQQ6', 'Provided by admin', 'Test Program Address First', '122 Sequoia Street', '776', 'Atlanta', 'GA', '30329', 'United States', '111-116-1111', '111-116-1111', '111-116-1111', '', 'Attach in Email', 'Attach in Email', 'uploads/university_photo1568654010.jpg', 'logo2.jpg'),
(7, 'City 7', 'ABCD7', 'QQQ7', 'Provided by admin', '122 Maple Street', 'School of Hard Knocks', '777', 'Hamden', 'CT', '6518', 'United States', '111-117-1111', '111-117-1111', '111-117-1111', '', 'Attach in Email', 'Attach in Email', '', 'logo6.jpg'),
(8, 'City 8', 'ABCD8', 'QQQ8', 'Provided by admin', '122 Hickory Street', '', '778 Annex', 'Fort Lauderdale', 'FL', '33328', 'United States', '111-118-1111', '', '', '', 'https://www.nova.edu/index.html', 'https://www.nova.edu/index.html', 'uploads/8_university_photo_1569246864.jpg', 'logo5.jpg'),
(9, 'City 9', 'ABCD9', 'QQQ9', 'Provided by admin', '122 Birch Street', '', '779', 'Kansas City', 'MO', '64157', 'United States', '', '', '', '', 'Attach in Email', 'Attach in Email', '', 'logo9.png'),
(10, 'City 10', 'ABCD10', 'QQQ10', 'Provided by admin', '122 Cherry Street', 'Building 8', '780', 'Milwaukee', 'Wisconsin', '53226', 'United States', '111-110-1111', '111-110-1111', '', '', 'Attach in Email', 'Attach in Email', '', 'logo4.png'),
(11, 'City 11 another very long address in Alaska', 'ABCD11', 'QQQ11', '', '122 Magnolia Street', '', 'Suite Z-888', 'Washington', 'DC', '20002', 'United States', '111-122-1111', '111-122-1111', '111-122-1111', '', 'Attach in Email', 'Attach in Email', '', 'logo1.jpg'),
(12, 'City 12, Far Far Away', 'ABCD12', 'QQQ12', 'Provided by admin', '122 Fir Street', '', '782', 'Cleveland', 'OH', '44106-5007', 'United States', '111-133-1111', '111-133-1111', '111-133-1111', '', 'Attach in Email', 'Attach in Email', 'uploads/12_university_photo_1569190987.jpg', 'logo1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `temp_stats`
--

CREATE TABLE `temp_stats` (
  `user_id` int(11) NOT NULL,
  `id` int(20) NOT NULL,
  `id_crm` int(11) DEFAULT NULL,
  `id_certificate` int(11) DEFAULT NULL,
  `first_year` int(4) NOT NULL,
  `certification_date` date NOT NULL,
  `cme_due` date NOT NULL,
  `cdq_due` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_stats`
--

INSERT INTO `temp_stats` (`user_id`, `id`, `id_crm`, `id_certificate`, `first_year`, `certification_date`, `cme_due`, `cdq_due`) VALUES
(1008, 149, 21935923, 901, 2008, '0000-00-00', '2020-06-01', '2026-06-01'),
(2591, 2307, 21937239, 495, 2000, '0000-00-00', '2020-06-01', '2024-06-01'),
(2788, 2764, 77772625, 32697594, 2020, '2022-06-01', '2022-06-01', '2026-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `is_certified` tinyint(1) DEFAULT '1',
  `full_name` varchar(255) DEFAULT NULL,
  `temp_password` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('Student','CAA','Program Director','Employer','Admin','Retired','De-certified') NOT NULL,
  `last_login` datetime NOT NULL,
  `last_import` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `email`, `password`, `status`, `is_certified`, `full_name`, `temp_password`, `role`, `last_login`, `last_import`) VALUES
(4, '', 'adminZZ1234@gmail.com', 'admin01ZZ1234', 0, 1, 'Admin 01', 0, 'Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1008, '', 'demo02@gmail.com', 'demopass02', 0, 1, 'User Demo02', 0, 'CAA', '0000-00-00 00:00:00', '2019-05-07 20:32:18'),
(2591, '', 'demo01@gmail.com', 'demopass01', 0, 1, 'User Demo01', 0, 'CAA', '0000-00-00 00:00:00', '2019-05-07 20:32:12'),
(3249, '', 'adminDD1234@gmail.com', 'admin04DD1234', 0, 1, 'Admin 04', 0, 'Admin', '0000-00-00 00:00:00', '2019-11-07 04:10:41'),
(2788, '', 'demo04@gmail.com', 'demopass04', 0, 0, 'Icabob Crane', 0, 'CAA', '0000-00-00 00:00:00', '2019-04-29 15:07:04'),
(3010, '', 'demo03@gmail.com', 'demopass03', 0, 0, 'User Demo03', 0, 'Student', '0000-00-00 00:00:00', '2019-04-29 15:07:06'),
(3247, '', 'adminKK1234@gmail.com', 'admin02KK1234', 0, 1, 'Admin 02', 0, 'Admin', '0000-00-00 00:00:00', '2019-11-07 01:16:49'),
(3203, '', 'city1@university.edu', 'xyz123', 0, 1, 'University 1', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3204, '', 'city2@university.edu', 'xyz124', 0, 1, 'University 2', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3205, '', 'city3@university.edu', 'xyz125', 0, 1, 'University 3', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3206, '', 'city4@university.edu', 'xyz126', 0, 1, 'University 4', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3207, '', 'city5@university.edu', 'xyz127', 0, 1, 'University 5', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3208, '', 'city6@university.edu', 'xyz128', 0, 1, 'University 6', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3209, '', 'city7@university.edu', 'xyz129', 0, 1, 'University 7', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3210, '', 'city8@university.edu', 'xyz130', 0, 1, 'University 8', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3211, '', 'city9@university.edu', 'xyz131', 0, 1, 'University 9', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3212, '', 'city10@university.edu', 'xyz132', 0, 1, 'University 10', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3213, '', 'city11@university.edu', 'xyz133', 0, 1, 'University 11', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3214, '', 'city12@university.edu', 'xyz134', 0, 1, 'University 12', 0, 'Program Director', '0000-00-00 00:00:00', '2019-05-09 13:03:48'),
(3250, '', 'adminTT1234@gmail.com', 'admin03TT1234', 0, 1, 'Admin 03', 0, 'Admin', '0000-00-00 00:00:00', '2019-11-07 04:10:41'),
(3274, '', 'demo05@gmail.com', 'demopass05', 0, 1, 'User Demo05', 0, 'Student', '2020-03-02 15:21:17', '2020-03-02 15:21:17'),
(3478, '', 'cheesewiz@nuttin.com', '7VIHdf3xlu', 0, 1, 'Cheese Wiz', 0, 'Student', '2020-05-23 18:27:37', '2020-05-23 18:27:37'),
(3479, '', 'homerformby@sup.com', '2Y1xf7U9L5', 0, 1, 'Homer C Formby', 0, 'Student', '2020-05-23 18:44:44', '2020-05-23 18:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `user_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `full_name` varbinary(256) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `created_at` varchar(256) DEFAULT NULL,
  `browser` varchar(256) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `os` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`user_id`, `id`, `full_name`, `role`, `email`, `created_at`, `browser`, `ip`, `os`) VALUES
(4, 9656, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/21/20 08:49:03', 'Safari 13', '49.206.178.162', 'Mac OS X 10_14_6'),
(2591, 9657, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/21/20 08:57:09', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(2591, 9658, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/21/20 08:58:35', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(2591, 9659, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/21/20 09:07:59', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9660, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/21/20 09:09:22', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(2591, 9661, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/21/20 09:18:43', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9662, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/21/20 09:20:56', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9663, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/21/20 10:02:50', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9664, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/21/20 10:37:33', 'Chrome 81', '157.37.255.163', 'Windows 10'),
(2591, 9665, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/21/20 10:41:43', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9666, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/21/20 14:51:40', 'Safari 13', '49.206.179.54', 'Mac OS X 10_14_6'),
(2591, 9667, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/23/20 06:14:34', 'Chrome 81', '1.39.208.112', 'Windows 10'),
(4, 9668, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 06:31:54', 'Chrome 81', '1.39.208.112', 'Windows 10'),
(4, 9669, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 08:26:36', 'Safari 13', '49.206.184.12', 'Mac OS X 10_14_6'),
(4, 9670, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 09:30:07', 'Safari 13', '49.206.184.12', 'Mac OS X 10_14_6'),
(4, 9671, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 10:34:59', 'Chrome 81', '1.39.208.119', 'Android 6.0'),
(4, 9672, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 12:18:10', 'Chrome 81', '1.39.211.23', 'Windows 10'),
(2591, 9673, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/23/20 12:44:28', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(2591, 9674, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/23/20 12:49:04', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9675, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 16:39:42', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9676, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 17:48:27', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9677, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 20:28:31', 'Safari 13', '49.206.184.12', 'Mac OS X 10_14_6'),
(4, 9678, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 20:48:35', 'Safari 13', '49.206.184.12', 'Mac OS X 10_14_6'),
(4, 9679, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 22:39:40', 'Chrome 81', '1.39.197.21', 'Windows 10'),
(4, 9680, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 22:59:31', 'Chrome 81', '1.39.197.21', 'Windows 10'),
(4, 9681, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 22:59:53', 'Safari 13', '49.206.180.162', 'Mac OS X 10_14_6'),
(2591, 9682, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/23/20 23:02:25', 'Chrome 81', '1.39.197.21', 'Windows 10'),
(4, 9683, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/23/20 23:51:00', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(2591, 9684, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/23/20 23:52:05', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9685, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/24/20 08:25:56', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(2591, 9686, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/24/20 15:51:42', 'Chrome 83', '49.206.180.162', 'Mac OS X 10_14_6'),
(2591, 9687, 0x557365722044656d6f3031, 'CAA', 'demo01@gmail.com', '05/24/20 17:04:36', 'Chrome 83', '49.206.180.162', 'Mac OS X 10_14_6'),
(4, 9688, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/25/20 10:37:37', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9689, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/25/20 12:50:15', 'Chrome 81', '216.97.208.249', 'Windows 10'),
(4, 9690, 0x41646d696e203031, 'Admin', 'adminZZ1234@gmail.com', '05/25/20 14:50:23', 'Chrome 81', '216.97.208.249', 'Windows 10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_history`
--
ALTER TABLE `action_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `action_history_cdq`
--
ALTER TABLE `action_history_cdq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `action_history_certification`
--
ALTER TABLE `action_history_certification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `action_history_cme`
--
ALTER TABLE `action_history_cme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcementlists`
--
ALTER TABLE `announcementlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bloglikes`
--
ALTER TABLE `bloglikes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_user` (`post_id`,`user_id`);

--
-- Indexes for table `bloglists`
--
ALTER TABLE `bloglists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogviews`
--
ALTER TABLE `blogviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_user` (`post_id`,`user_id`);

--
-- Indexes for table `caas`
--
ALTER TABLE `caas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cdq_history`
--
ALTER TABLE `cdq_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `cme_history`
--
ALTER TABLE `cme_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_blast`
--
ALTER TABLE `email_blast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_group`
--
ALTER TABLE `email_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_message`
--
ALTER TABLE `email_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `errorsubmission`
--
ALTER TABLE `errorsubmission`
  ADD PRIMARY KEY (`error_id`);

--
-- Indexes for table `final_account_security_information`
--
ALTER TABLE `final_account_security_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_address_contact_information`
--
ALTER TABLE `final_address_contact_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_add_another_address`
--
ALTER TABLE `final_add_another_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_employee_skills`
--
ALTER TABLE `final_employee_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_employer_benefits`
--
ALTER TABLE `final_employer_benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_employer_compensation`
--
ALTER TABLE `final_employer_compensation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_employer_retirement`
--
ALTER TABLE `final_employer_retirement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_employment_info`
--
ALTER TABLE `final_employment_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_exam_certification_info`
--
ALTER TABLE `final_exam_certification_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_generalinform`
--
ALTER TABLE `final_generalinform`
  ADD PRIMARY KEY (`final_generalinform_id`);

--
-- Indexes for table `final_other_memberships`
--
ALTER TABLE `final_other_memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_personal_information`
--
ALTER TABLE `final_personal_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_program_university_info`
--
ALTER TABLE `final_program_university_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_retirements_previous_employers`
--
ALTER TABLE `final_retirements_previous_employers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `GOODadmin`
--
ALTER TABLE `GOODadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomecdq`
--
ALTER TABLE `incomecdq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomecertification`
--
ALTER TABLE `incomecertification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomecme`
--
ALTER TABLE `incomecme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_setting`
--
ALTER TABLE `paypal_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_photo`
--
ALTER TABLE `profile_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_users`
--
ALTER TABLE `profile_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_text`
--
ALTER TABLE `static_text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_question_choices`
--
ALTER TABLE `survey_question_choices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_add_cme`
--
ALTER TABLE `tbl_add_cme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_assistant`
--
ALTER TABLE `tbl_admin_assistant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cdqhistory`
--
ALTER TABLE `tbl_cdqhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_certificationhistory`
--
ALTER TABLE `tbl_certificationhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_class_of_2019`
--
ALTER TABLE `tbl_class_of_2019`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_class_of_2020`
--
ALTER TABLE `tbl_class_of_2020`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_class_of_2021`
--
ALTER TABLE `tbl_class_of_2021`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cmehistory`
--
ALTER TABLE `tbl_cmehistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_coordinator`
--
ALTER TABLE `tbl_coordinator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dates`
--
ALTER TABLE `tbl_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_expected_dates`
--
ALTER TABLE `tbl_expected_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_expected_datesOLD`
--
ALTER TABLE `tbl_expected_datesOLD`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_medical_director`
--
ALTER TABLE `tbl_medical_director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_other`
--
ALTER TABLE `tbl_other`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_program_details`
--
ALTER TABLE `tbl_program_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_program_director`
--
ALTER TABLE `tbl_program_director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_program_medical`
--
ALTER TABLE `tbl_program_medical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_regional_director`
--
ALTER TABLE `tbl_regional_director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_university`
--
ALTER TABLE `tbl_university`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_stats`
--
ALTER TABLE `temp_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_history`
--
ALTER TABLE `action_history`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2072;

--
-- AUTO_INCREMENT for table `action_history_cdq`
--
ALTER TABLE `action_history_cdq`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=721;

--
-- AUTO_INCREMENT for table `action_history_certification`
--
ALTER TABLE `action_history_certification`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=525;

--
-- AUTO_INCREMENT for table `action_history_cme`
--
ALTER TABLE `action_history_cme`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=805;

--
-- AUTO_INCREMENT for table `announcementlists`
--
ALTER TABLE `announcementlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bloglikes`
--
ALTER TABLE `bloglikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `bloglists`
--
ALTER TABLE `bloglists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `blogviews`
--
ALTER TABLE `blogviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=546;

--
-- AUTO_INCREMENT for table `caas`
--
ALTER TABLE `caas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cdq_history`
--
ALTER TABLE `cdq_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- AUTO_INCREMENT for table `cme_history`
--
ALTER TABLE `cme_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_blast`
--
ALTER TABLE `email_blast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `email_group`
--
ALTER TABLE `email_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `email_message`
--
ALTER TABLE `email_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `errorsubmission`
--
ALTER TABLE `errorsubmission`
  MODIFY `error_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `final_account_security_information`
--
ALTER TABLE `final_account_security_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5848;

--
-- AUTO_INCREMENT for table `final_address_contact_information`
--
ALTER TABLE `final_address_contact_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10325;

--
-- AUTO_INCREMENT for table `final_add_another_address`
--
ALTER TABLE `final_add_another_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_employee_skills`
--
ALTER TABLE `final_employee_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=579;

--
-- AUTO_INCREMENT for table `final_employer_benefits`
--
ALTER TABLE `final_employer_benefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `final_employer_compensation`
--
ALTER TABLE `final_employer_compensation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `final_employer_retirement`
--
ALTER TABLE `final_employer_retirement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `final_employment_info`
--
ALTER TABLE `final_employment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `final_exam_certification_info`
--
ALTER TABLE `final_exam_certification_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `final_generalinform`
--
ALTER TABLE `final_generalinform`
  MODIFY `final_generalinform_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3223;

--
-- AUTO_INCREMENT for table `final_other_memberships`
--
ALTER TABLE `final_other_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `final_personal_information`
--
ALTER TABLE `final_personal_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=609;

--
-- AUTO_INCREMENT for table `final_program_university_info`
--
ALTER TABLE `final_program_university_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3015;

--
-- AUTO_INCREMENT for table `final_retirements_previous_employers`
--
ALTER TABLE `final_retirements_previous_employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `GOODadmin`
--
ALTER TABLE `GOODadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomecdq`
--
ALTER TABLE `incomecdq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `incomecertification`
--
ALTER TABLE `incomecertification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `incomecme`
--
ALTER TABLE `incomecme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=812;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paypal_setting`
--
ALTER TABLE `paypal_setting`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profile_photo`
--
ALTER TABLE `profile_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `profile_users`
--
ALTER TABLE `profile_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `static_text`
--
ALTER TABLE `static_text`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `survey_answers`
--
ALTER TABLE `survey_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6995;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `survey_question_choices`
--
ALTER TABLE `survey_question_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tbl_add_cme`
--
ALTER TABLE `tbl_add_cme`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6490;

--
-- AUTO_INCREMENT for table `tbl_admin_assistant`
--
ALTER TABLE `tbl_admin_assistant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_cdqhistory`
--
ALTER TABLE `tbl_cdqhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_certificationhistory`
--
ALTER TABLE `tbl_certificationhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1071;

--
-- AUTO_INCREMENT for table `tbl_class_of_2019`
--
ALTER TABLE `tbl_class_of_2019`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `tbl_class_of_2020`
--
ALTER TABLE `tbl_class_of_2020`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `tbl_class_of_2021`
--
ALTER TABLE `tbl_class_of_2021`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_cmehistory`
--
ALTER TABLE `tbl_cmehistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_coordinator`
--
ALTER TABLE `tbl_coordinator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_dates`
--
ALTER TABLE `tbl_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_expected_dates`
--
ALTER TABLE `tbl_expected_dates`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tbl_expected_datesOLD`
--
ALTER TABLE `tbl_expected_datesOLD`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_medical_director`
--
ALTER TABLE `tbl_medical_director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_other`
--
ALTER TABLE `tbl_other`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_program_details`
--
ALTER TABLE `tbl_program_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_program_director`
--
ALTER TABLE `tbl_program_director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_program_medical`
--
ALTER TABLE `tbl_program_medical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_regional_director`
--
ALTER TABLE `tbl_regional_director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `temp_stats`
--
ALTER TABLE `temp_stats`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2765;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3480;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9691;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
