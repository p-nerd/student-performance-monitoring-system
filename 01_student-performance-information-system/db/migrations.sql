DROP TABLE IF EXISTS student_courses;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS courses;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone_number VARCHAR(255) NOT NULL
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    credit int NOT NULL,
    semester int NOT NULL
);

CREATE TABLE student_courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    UNIQUE(student_id, course_id),  -- Ensure uniqueness of student-course pairs
    mark int NULL
);

