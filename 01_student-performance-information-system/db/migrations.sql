CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone_number VARCHAR(255) NOT NULL
);

INSERT INTO students (first_name, last_name, email, phone_number) VALUES
('Shihab', "Mahamud", "shihab@gmail.com", "1234234"),
('Momi', "Rohman", "momi@gmail.com", "1234234"),
('Methila', "Afrin", "methila@gmail.com", "1234234");

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    credit int NOT NULL,
    mark int NULL
);

INSERT INTO courses (name, credit, mark) VALUES
('Mathematics', 3, null),
('History', 4, null),
('Physics', 3, null),
('Computer Science', 3, null),
('Literature', 4, NULL);

CREATE TABLE student_courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    UNIQUE(student_id, course_id)  -- Ensure uniqueness of student-course pairs
);

INSERT INTO student_courses (student_id, course_id) VALUES
(1, 1), -- Shihab enrolled in Mathematics
(1, 3), -- Shihab enrolled in Physics
(2, 2), -- Momi enrolled in History
(3, 1), -- Methila enrolled in Mathematics
(3, 4); -- Methila enrolled in Computer Science