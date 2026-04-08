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
  `year_level` int(11) DEFAULT NULL,
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
INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `last_name`, `year_level`) VALUES
('admin', '1234', 'staff', 'Admin', 'Krub', NULL),
('teacher', '1234', 'teacher', 'Ajarn', 'Sompong', NULL);

-- Students (10 mock)
INSERT INTO `users` (`username`, `password`, `role`, `first_name`, `last_name`, `year_level`) VALUES
('6610001', '1234', 'student', 'Somchai', 'Jaidee', 3),
('6610002', '1234', 'student', 'Somsri', 'Rukthai', 4),
('6610003', '1234', 'student', 'Mana', 'Manee', 3),
('6610004', '1234', 'student', 'Piti', 'Chujai', 4),
('6610005', '1234', 'student', 'Weera', 'Suwan', 3),
('6610006', '1234', 'student', 'Napa', 'Deemak', 4),
('6610007', '1234', 'student', 'Komsan', 'Kengkan', 3),
('6610008', '1234', 'student', 'Suda', 'Ngamta', 4),
('6610009', '1234', 'student', 'Wichai', 'Phoprasert', 3),
('6610010', '1234', 'student', 'Naree', 'Rakrien', 4);

-- Mock Internship Request
INSERT INTO `internship_requests` (`student_id`, `company_name`, `position`, `start_date`, `end_date`, `status`) VALUES
(3, 'Google Thai', 'Frontend Dev', '2026-06-01', '2026-08-31', 1),
(4, 'Deepmind', 'AI Engineer', '2026-06-01', '2026-08-31', 2);
