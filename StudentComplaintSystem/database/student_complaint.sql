CREATE DATABASE IF NOT EXISTS student_complaint_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_complaint_db;

DROP TABLE IF EXISTS complaints;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','student') NOT NULL DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    course VARCHAR(100) NOT NULL,
    year VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_student_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    reference_no VARCHAR(40) NOT NULL UNIQUE,
    category VARCHAR(80) NOT NULL,
    subject VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    status ENUM('Pending','In Progress','Resolved','Rejected') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_complaint_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

INSERT INTO users (name,email,password,role) VALUES
('System Administrator','admin@school.com','$2y$12$tl06UBy3FsefAvjKZiNsr.3.8TlTX/bfbXvFGo4VlhGgsNcFkqopm','admin'),
('Rahul Sharma','rahul@student.com','$2y$12$tl06UBy3FsefAvjKZiNsr.3.8TlTX/bfbXvFGo4VlhGgsNcFkqopm','student'),
('Priya Patel','priya@student.com','$2y$12$tl06UBy3FsefAvjKZiNsr.3.8TlTX/bfbXvFGo4VlhGgsNcFkqopm','student');

INSERT INTO students (user_id,course,year) VALUES
(2,'B.Tech CSE','3rd Year'),
(3,'B.Tech CSE','2nd Year');

INSERT INTO complaints (student_id,reference_no,category,subject,description,status) VALUES
(1,'CMP-DEMO-001','Infrastructure','Classroom fan not working','The ceiling fan in Room 204 is not working.','Pending'),
(2,'CMP-DEMO-002','Library','Book availability issue','A required reference book is not available in the library.','In Progress');

-- Demo password for all seeded users: admin123
