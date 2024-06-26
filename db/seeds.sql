-- Insert data into the users table
INSERT INTO users (name, email, password, role) VALUES
('Shihab Mahamud', 'shihab@gmail.com', '$2y$10$fXGWFJONQE6J1ruDnNAZGu.UCaU5gifwogJMWLFMMyUZeZLyfC0wu' /*password123*/, 'student'),
('Momi Rohman', 'momi@gmail.com', '$2y$10$fXGWFJONQE6J1ruDnNAZGu.UCaU5gifwogJMWLFMMyUZeZLyfC0wu' /*password123*/, 'student'),
('Methila Afrin', 'methila@gmail.com', '$2y$10$fXGWFJONQE6J1ruDnNAZGu.UCaU5gifwogJMWLFMMyUZeZLyfC0wu' /*password123*/, 'student');

-- Insert data into the students table, referencing the user_id from the users table
INSERT INTO students (phone_number, user_id) VALUES
('1234234', (SELECT id FROM users WHERE email = 'shihab@gmail.com')),
('1234234', (SELECT id FROM users WHERE email = 'momi@gmail.com')),
('1234234', (SELECT id FROM users WHERE email = 'methila@gmail.com'));

-- Insert data into the courses table
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

-- Insert data into the student_courses table
INSERT INTO student_courses (student_id, course_id, mark) VALUES
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'shihab@gmail.com')), 1, 85), -- Shihab enrolled in Mathematics
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'shihab@gmail.com')), 3, 90), -- Shihab enrolled in Physics
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'momi@gmail.com')), 2, 70), -- Momi enrolled in History
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'methila@gmail.com')), 1, 88), -- Methila enrolled in Mathematics
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'methila@gmail.com')), 4, 79), -- Methila enrolled in Computer Science
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'shihab@gmail.com')), 6, 86), -- Shihab enrolled in Mathematics 2
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'shihab@gmail.com')), 7, 81), -- Shihab enrolled in Physics 2
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'momi@gmail.com')), 8, 60), -- Momi enrolled in History 2
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'methila@gmail.com')), 9, 75), -- Methila enrolled in Computer Science 2
((SELECT id FROM students WHERE user_id = (SELECT id FROM users WHERE email = 'methila@gmail.com')), 10, 80); -- Methila enrolled in Literature 2

