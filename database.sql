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
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','staff','teacher') NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `education` text DEFAULT NULL,
  `student_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Requests Table
CREATE TABLE `internship_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `program_type` varchar(50) NOT NULL,
  `major` varchar(100) NOT NULL,
  `student_phone` varchar(20) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `internship_type` enum('course','experience') NOT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `location_type` enum('domestic','international') NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `doc_language` enum('thai','english') NOT NULL,
  `doc_type` enum('consideration','consideration_and_referral') NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `coordinator_name` varchar(100) NOT NULL,
  `agency_phone` varchar(20) NOT NULL,
  `agency_email` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `semester` varchar(10) NOT NULL,
  `academic_year` varchar(10) NOT NULL,
  `attempt_number` int(11) NOT NULL DEFAULT 1,
  `previous_agency` varchar(255) DEFAULT NULL,
  `reason_for_change` text DEFAULT NULL,
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

-- Users (Staff, Teachers, Students)
INSERT INTO `users` (`username`,`password`,`role`,`first_name`,`last_name`,`title`,`year_level`,`profile_image`,`education`) VALUES
	 ('admin','1234','staff','Admin','Krub',NULL,NULL,NULL,NULL),
	 ('teacher01','1234','teacher','ดิษฐ์','สุทธิวงศ์','อ.ดร.',NULL,'Dit-scaled.jpg','ปริญญาเอก: Ph.D. Information Technology , มหาวิทยาลัยพระจอมเกล้าพระนครเหนือ\\n
ปริญญาโท: วท.ม. การจัดการเทคโนโลยีสารสนเทศ , มหาวิทยาลัยหอการค้าไทย\\n
ปริญญาตรี: วท.บ. ศาสตร์คอมพิวเตอร์ , มหาวิทยาลัยธรรมศาสตร์'),
	 ('6610001','1234','student','Somchai','Jaidee',NULL,3,NULL,NULL),
	 ('6610002','1234','student','Somsri','Rukthai',NULL,4,NULL,NULL),
	 ('6610003','1234','student','Mana','Manee',NULL,3,NULL,NULL),
	 ('6610004','1234','student','Piti','Chujai',NULL,4,NULL,NULL),
	 ('6610005','1234','student','Weera','Suwan',NULL,3,NULL,NULL),
	 ('6610006','1234','student','Napa','Deemak',NULL,4,NULL,NULL),
	 ('6610007','1234','student','Komsan','Kengkan',NULL,3,'',NULL),
	 ('6610008','1234','student','Suda','Ngamta',NULL,4,NULL,NULL);

INSERT INTO `users` (`username`,`password`,`role`,`first_name`,`last_name`,`title`,`year_level`,`profile_image`,`education`) VALUES
	 ('6610009','1234','student','Wichai','Phoprasert',NULL,3,NULL,NULL),
	 ('6610010','1234','student','Naree','Rakrien',NULL,4,NULL,NULL),
	 ('teacher02','1234','teacher','ฐิติ','อติชาติชยากร','อ.ดร.',NULL,'thiti-scaled.jpg','ปริญญาเอก: ค.ด. เทคโนโลยีและสื่อสารการศึกษา, จุฬาลงกรณ์มหาวิทยาลัย\\n
ปริญญาโท: อ.ม. บรรณารักษศาสตร์และสารนิเทศศาสตร์, จุฬาลงกรณ์มหาวิทยาลัย\\n
ปริญญาตรี: ศศ.บ. บรรณารักษศาสตร์และสารสนเทศศาสตร์, มหาวิทยาลัยศรีนครินทรวิโรฒ'),
	 ('teacher03','1234','teacher','วิภากร','วัฒนสินธุ์','ผศ.ดร.',NULL,'Vipakorn-200x300.jpg','ปริญญาเอก: วท.ด. ธุรกิจเทคโนโลยีและการจัดการนวัตกรรม, จุฬาลงกรณ์มหาวิทยาลัย\\n
ปริญญาโท: MS Computer Information System, Colorado State University\\n
ปริญญาโท: MBA Finance, Colorado State University\\n
ปริญญาตรี: น.บ. นิติศาสตร์, มหาวิทยาลัยสุโขทัยธรรมาธิราช\\n
ปริญญาตรี: บธ.บ การตลาด, จุฬาลงกรณ์มหาวิทยาลัย'),
	 ('teacher04','1234','teacher','โชคธำรงค์','จงจอหอ','อ.ดร.',NULL,'Chokthamrong.jpg','ปริญญาเอก: ปร.ด. สารสนเทศศึกษา, สารสนเทศศึกษา\\n
ปริญญาโท: วท.ม. เทคโนโลยีผู้ประกอบการและการจัดการนวัตกรรม, มหาวิทยาลัยนเรศวร\\n
ปริญญาโท: ศศ.ม. การจัดการทรัพยากรชีวภาพ, มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี\\n
ปริญญาตรี: ศศ.บ. สารสนเทศศาสตร์, มหาวิทยาลัยขอนแก่น'),
	 ('teacher05','1234','teacher','โชติมา','วัฒนะ','อ.',NULL,'Chotima.jpg','ปริญญาเอก: Ph.D. Philosophy Information Science, Sukhothai Thammathirat Open University \\n
ปริญญาโท: M.A. Information Management, KhonKean University\\n
ปริญญาตรี: B.A. Information Science, Mahasarakham University'),
	 ('teacher06','1234','teacher','ดุษฎี','สีวังคำ','ผศ.ดร.',NULL,'Dussadee-683x1024.jpg','ปริญญาเอก: Ph.D. Technical Education Technology, King Mongkut’s University of Technology North Bangkok\\n
ปริญญาโท: M.S. Information Technology,  King Mongkut’s University of Technology North Bangkok\\n
ปริญญาตรี	: B.S. Computer Science, Rajabhat Institute Phetchabun'),
	 ('teacher07','1234','teacher','ศศิพิมล','ประพินพงศกร','ผศ.ดร.',NULL,'Sasipimol-683x1024.jpg','ปริญญาเอก: ค.ด. เทคโนโลยีและสื่อสารการศึกษา, จุฬาลงกรณ์มหาวิทยาลัย\\n'),
	 ('teacher08','1234','teacher','ศุมรรษตรา','แสนวา','อ.ดร.',NULL,'Sumattra-683x1024.jpg','ปริญญาเอก: ปร.ด. สารสนเทศศึกษา , มหาวิทยาลัยขอนแก่น \\n
ปริญญาโท: ศศ.ม. บรรณารักษศาสตร์และสารสนเทศศาสตร์ , มหาวิทยาลัยมหาสารคาม\\n
ปริญญาตรี: ศศ.บ. ภาษาอังกฤษ, มหาวิทยาลัยมหาสารคาม');

-- Mock Internship Request
INSERT INTO `internship_requests` (`student_id`, `program_type`, `major`, `student_phone`, `student_email`, `internship_type`, `course_code`, `course_name`, `location_type`, `country`, `doc_language`, `doc_type`, `company_name`, `position`, `coordinator_name`, `agency_phone`, `agency_email`, `start_date`, `end_date`, `semester`, `academic_year`, `attempt_number`, `previous_agency`, `reason_for_change`, `status`) VALUES
(3, 'วท.บ.', 'วิทยาการคอมพิวเตอร์', '0812345678', 'mana@example.com', 'experience', NULL, NULL, 'domestic', NULL, 'thai', 'consideration', 'Google Thai', 'Frontend Dev', 'K. Somsak', '02-111-2222', 'hr@google.co.th', '2026-06-01', '2026-08-31', '1', '2569', 1, NULL, NULL, 1),
(4, 'ศศ.บ.', 'ภาษาอังกฤษ', '0898765432', 'piti@example.com', 'course', 'EN401', 'Internship in English', 'international', 'UK', 'english', 'consideration_and_referral', 'Deepmind', 'AI Engineer', 'Mr. Smith', '+44-1234-567', 'smith@deepmind.com', '2026-06-01', '2026-08-31', '1', '2569', 2, 'OpenAI', 'Visa issue', 2);
