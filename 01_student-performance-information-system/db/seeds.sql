INSERT INTO students (first_name, last_name, email, phone_number) VALUES
('Shihab', "Mahamud", "shihab@gmail.com", "1234234"),
('Momi', "Rohman", "momi@gmail.com", "1234234"),
('Methila', "Afrin", "methila@gmail.com", "1234234");

INSERT INTO courses (name, credit, semester) VALUES
('Mathematics', 3, 1),
('History', 4, 1),
('Physics', 3, 1),
('Computer Science', 3, 1),
('Literature', 4, 1),
('Mathematics 2', 3, 2),
('History 2', 4, 2),
('Physics 2', 3, 2),
('Computer Science 2', 3, 2),
('Literature 2', 4, 2);

INSERT INTO student_courses (student_id, course_id, mark) VALUES
(1, 1, 85), -- Shihab enrolled in Mathematics
(1, 3, 90), -- Shihab enrolled in Physics
(2, 2, 70), -- Momi enrolled in History
(3, 1, 88), -- Methila enrolled in Mathematics
(3, 4, 79), -- Methila enrolled in Computer Science
(1, 6, 86), -- Shihab enrolled in Mathematics
(1, 7, 81), -- Shihab enrolled in Physics
(2, 8, 60), -- Momi enrolled in History
(3, 9, 75), -- Methila enrolled in Mathematics
(3, 10, 80); -- Methila enrolled in Computer Science

