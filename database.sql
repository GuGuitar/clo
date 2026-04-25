-- Database setup script
CREATE DATABASE IF NOT EXISTS `internships` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `internships`;

-- Drop tables if they exist to allow re-running the script
DROP TABLE IF EXISTS `evaluations`;
DROP TABLE IF EXISTS `internship_requests`;
DROP TABLE IF EXISTS `users`;

-- Users Table
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `role` enum('student','staff','teacher') NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `education` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Requests Table
CREATE TABLE `internship_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1: Received, 2: Advisor Approved, 3: Letter Issued, 4: Finished, 9: Canceled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`student_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Evaluations Table
CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `supervision_comments` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`request_id`) REFERENCES `internship_requests`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`teacher_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Mock Data
-- Password is '1234' for everyone. For production, apply hashing like password_hash(), but for this exercise plain or simple hash is fine. We will use plain for simplicity as requested 'Password: 1234'.

-- Staff
INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `last_name`, `title`, `year_level`, `profile_image`, `education`) VALUES
('admin', '1234', 'staff', 'Admin', 'Krub', NULL, NULL, NULL, NULL),
('teacher01', '1234', 'teacher', 'สมปอง', 'สุขสวัสดิ์', 'อ.ดร.', NULL, NULL, 'ปริญญาเอก: Ph.D. Computer Science, Carnegie Mellon University\nปริญญาโท: M.Sc. Software Engineering, Chulalongkorn University\nปริญญาตรี: B.Sc. Computer Science, มหาวิทยาลัยศรีนครินทรวิโรฒ'),
('teacher02', '1234', 'teacher', 'วิภาวดี', 'ศรีสุวรรณ', 'ผศ.ดร.', NULL, NULL, 'ปริญญาเอก: Ph.D. Information Technology, King Mongkut''s University of Technology Thonburi\nปริญญาโท: M.Sc. Computer Engineering, Kasetsart University\nปริญญาตรี: B.Sc. Information Technology, มหาวิทยาลัยศรีนครินทรวิโรฒ'),
('teacher03', '1234', 'teacher', 'ประเสริฐ', 'เจริญสุข', 'อ.ดร.', NULL, NULL, 'ปริญญาเอก: Ph.D. Data Science, University of Tokyo\nปริญญาโท: M.Eng. Computer Engineering, Chulalongkorn University\nปริญญาตรี: B.Eng. Computer Engineering, มหาวิทยาลัยเกษตรศาสตร์'),
('teacher04', '1234', 'teacher', 'นภาพร', 'รักเรียน', 'ผศ.ดร.', NULL, NULL, 'ปริญญาเอก: Ph.D. Artificial Intelligence, Stanford University\nปริญญาโท: M.Sc. Computer Science, Thammasat University\nปริญญาตรี: B.Sc. Mathematics, มหาวิทยาลัยศรีนครินทรวิโรฒ'),
('teacher05', '1234', 'teacher', 'กิตติพงศ์', 'แก้วมณี', 'อ.ดร.', NULL, NULL, 'ปริญญาเอก: Ph.D. Cybersecurity, University of Melbourne\nปริญญาโท: M.Sc. Information Security, Mahidol University\nปริญญาตรี: B.Sc. Computer Science, จุฬาลงกรณ์มหาวิทยาลัย'),
('teacher06', '1234', 'teacher', 'สุชาดา', 'พงศ์ไพบูลย์', 'ผศ.ดร.', NULL, NULL, 'ปริญญาเอก: Ph.D. Software Engineering, National University of Singapore\nปริญญาโท: M.Sc. Software Engineering, มหาวิทยาลัยศรีนครินทรวิโรฒ\nปริญญาตรี: B.Sc. Information Technology, มหาวิทยาลัยธรรมศาสตร์'),
('teacher07', '1234', 'teacher', 'ธนวัฒน์', 'อุดมโชค', 'อ.ดร.', NULL, NULL, 'ปริญญาเอก: Ph.D. Machine Learning, ETH Zurich\nปริญญาโท: M.Eng. Electrical Engineering, King Mongkut''s Institute of Technology Ladkrabang\nปริญญาตรี: B.Eng. Computer Engineering, มหาวิทยาลัยเกษตรศาสตร์'),
('teacher08', '1234', 'teacher', 'พิมพ์ชนก', 'วงศ์สกุล', 'ผศ.ดร.', NULL, NULL, 'ปริญญาเอก: Ph.D. Human-Computer Interaction, MIT\nปริญญาโท: M.Sc. UX Design, Chulalongkorn University\nปริญญาตรี: B.Sc. Computer Science, มหาวิทยาลัยศรีนครินทรวิโรฒ');

-- Students (10 mock)
INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `last_name`, `title`, `year_level`, `profile_image`, `education`) VALUES
('6610001', '1234', 'student', 'Somchai', 'Jaidee', NULL, 3, NULL, NULL),
('6610002', '1234', 'student', 'Somsri', 'Rukthai', NULL, 4, NULL, NULL),
('6610003', '1234', 'student', 'Mana', 'Manee', NULL, 3, NULL, NULL),
('6610004', '1234', 'student', 'Piti', 'Chujai', NULL, 4, NULL, NULL),
('6610005', '1234', 'student', 'Weera', 'Suwan', NULL, 3, NULL, NULL),
('6610006', '1234', 'student', 'Napa', 'Deemak', NULL, 4, NULL, NULL),
('6610007', '1234', 'student', 'Komsan', 'Kengkan', NULL, 3, NULL, NULL),
('6610008', '1234', 'student', 'Suda', 'Ngamta', NULL, 4, NULL, NULL),
('6610009', '1234', 'student', 'Wichai', 'Phoprasert', NULL, 3, NULL, NULL),
('6610010', '1234', 'student', 'Naree', 'Rakrien', NULL, 4, NULL, NULL);

-- Mock Internship Request
INSERT INTO `internship_requests` (`student_id`, `company_name`, `position`, `start_date`, `end_date`, `status`) VALUES
(3, 'Google Thai', 'Frontend Dev', '2026-06-01', '2026-08-31', 1),
(4, 'Deepmind', 'AI Engineer', '2026-06-01', '2026-08-31', 2);
