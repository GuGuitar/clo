USE internships;

-- Update existing teacher with Thai name and education
UPDATE users SET 
    username = 'teacher01',
    first_name = 'สมปอง',
    last_name = 'สุขสวัสดิ์',
    education = 'ปริญญาเอก: Ph.D. Computer Science, Carnegie Mellon University\\nปริญญาโท: M.Sc. Software Engineering, Chulalongkorn University\\nปริญญาตรี: B.Sc. Computer Science, มหาวิทยาลัยศรีนครินทรวิโรฒ'
WHERE id = 2;

-- Insert 7 new teachers
INSERT INTO users (username, password, role, first_name, last_name, year_level, profile_image, education) VALUES
('teacher02', '1234', 'teacher', 'วิภาวดี', 'ศรีสุวรรณ', NULL, NULL, 'ปริญญาเอก: Ph.D. Information Technology, King Mongkut''s University of Technology Thonburi\\nปริญญาโท: M.Sc. Computer Engineering, Kasetsart University\\nปริญญาตรี: B.Sc. Information Technology, มหาวิทยาลัยศรีนครินทรวิโรฒ'),
('teacher03', '1234', 'teacher', 'ประเสริฐ', 'เจริญสุข', NULL, NULL, 'ปริญญาเอก: Ph.D. Data Science, University of Tokyo\\nปริญญาโท: M.Eng. Computer Engineering, Chulalongkorn University\\nปริญญาตรี: B.Eng. Computer Engineering, มหาวิทยาลัยเกษตรศาสตร์'),
('teacher04', '1234', 'teacher', 'นภาพร', 'รักเรียน', NULL, NULL, 'ปริญญาเอก: Ph.D. Artificial Intelligence, Stanford University\\nปริญญาโท: M.Sc. Computer Science, Thammasat University\\nปริญญาตรี: B.Sc. Mathematics, มหาวิทยาลัยศรีนครินทรวิโรฒ'),
('teacher05', '1234', 'teacher', 'กิตติพงศ์', 'แก้วมณี', NULL, NULL, 'ปริญญาเอก: Ph.D. Cybersecurity, University of Melbourne\\nปริญญาโท: M.Sc. Information Security, Mahidol University\\nปริญญาตรี: B.Sc. Computer Science, จุฬาลงกรณ์มหาวิทยาลัย'),
('teacher06', '1234', 'teacher', 'สุชาดา', 'พงศ์ไพบูลย์', NULL, NULL, 'ปริญญาเอก: Ph.D. Software Engineering, National University of Singapore\\nปริญญาโท: M.Sc. Software Engineering, มหาวิทยาลัยศรีนครินทรวิโรฒ\\nปริญญาตรี: B.Sc. Information Technology, มหาวิทยาลัยธรรมศาสตร์'),
('teacher07', '1234', 'teacher', 'ธนวัฒน์', 'อุดมโชค', NULL, NULL, 'ปริญญาเอก: Ph.D. Machine Learning, ETH Zurich\\nปริญญาโท: M.Eng. Electrical Engineering, King Mongkut''s Institute of Technology Ladkrabang\\nปริญญาตรี: B.Eng. Computer Engineering, มหาวิทยาลัยเกษตรศาสตร์'),
('teacher08', '1234', 'teacher', 'พิมพ์ชนก', 'วงศ์สกุล', NULL, NULL, 'ปริญญาเอก: Ph.D. Human-Computer Interaction, MIT\\nปริญญาโท: M.Sc. UX Design, Chulalongkorn University\\nปริญญาตรี: B.Sc. Computer Science, มหาวิทยาลัยศรีนครินทรวิโรฒ');
