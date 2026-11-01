-- MySQL schema + sample data. Import in phpMyAdmin.
CREATE DATABASE IF NOT EXISTS event_db;
USE event_db;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  roll_no VARCHAR(30),
  department VARCHAR(30),
  semester INT,
  password VARCHAR(50)
);

CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150),
  description TEXT,
  venue VARCHAR(100),
  event_date DATE,
  event_time VARCHAR(20),
  seats INT,
  category VARCHAR(30)
);

CREATE TABLE participants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  event_id INT,
  registered_on DATE
);

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(50)
);

INSERT INTO users (name, roll_no, department, semester, password) VALUES
('Aarav Sharma','36442724010','BCA',3,'pass123'),
('Priya Das','36442724011','BCA',3,'pass123'),
('Rohit Verma','36442724025','BBA',5,'pass123'),
('Sneha Banerjee','36442724031','BSc',1,'pass123'),
('Imran Khan','36442724044','BBA',3,'pass123'),
('Ananya Roy','36442724052','BSc',5,'pass123');

INSERT INTO events (title, description, venue, event_date, event_time, seats, category) VALUES
('Tech Fest 2026','Annual technical festival with project exhibitions, coding contests and robotics demos.','Main Auditorium','2026-11-10','10:00 AM',100,'Technical'),
('Cultural Night','An evening of music, drama and performances by students.','Open Air Theatre','2026-11-14','06:00 PM',150,'Cultural'),
('24-Hour Hackathon','Build a working app in 24 hours in teams of up to 4.','Computer Lab 2','2026-11-20','09:00 AM',40,'Technical'),
('Seminar on Artificial Intelligence','Guest lecture on how AI is changing jobs and everyday life.','Seminar Hall','2026-11-25','11:00 AM',80,'Academic'),
('Annual Sports Meet','Track and field, cricket, football and more.','College Ground','2026-12-02','08:00 AM',200,'Sports'),
('General Knowledge Quiz','Inter-department quiz with exciting prizes.','Room 101','2026-12-05','02:00 PM',30,'Academic'),
('Dance Competition','Solo and group dance competition, any style.','Main Auditorium','2026-12-10','04:00 PM',60,'Cultural'),
('Singing Competition','Solo singing contest with live judges.','Music Room','2026-12-15','03:00 PM',25,'Cultural');

INSERT INTO participants (user_id, event_id, registered_on) VALUES
(1,1,'2026-10-28'),(1,3,'2026-10-28'),(2,1,'2026-10-29'),(2,7,'2026-10-30'),
(3,4,'2026-10-30'),(3,6,'2026-10-31'),(4,2,'2026-10-31'),(5,5,'2026-10-31'),(6,8,'2026-11-01');

INSERT INTO admins (username, password) VALUES ('admin','admin123');
