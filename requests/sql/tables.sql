CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    password VARCHAR(255)  -- For login if needed
);


CREATE TABLE requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    request_date DATE,
    time_slot_start TIME,
    time_slot_end TIME,
    status VARCHAR(20) DEFAULT 'Pending',
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);


CREATE TABLE schedule_requests (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    time_slot_start TIME,
    request_date DATE,
    status VARCHAR(20) DEFAULT 'Pending',
    bus_id INT DEFAULT NULL,     -- When scheduled, a bus is assigned
    driver_info VARCHAR(255)     -- Driver details once the bus is scheduled
);

CREATE TABLE bus_schedule (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_id INT,
    time_slot_start TIME,
    date DATE,
    driver_info VARCHAR(255),
    status VARCHAR(20) DEFAULT 'Scheduled'
);


CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('Admin', 'SuperAdmin') NOT NULL
);


INSERT INTO students (student_name, email) VALUES
('Alice Johnson', 'alice.johnson@example.com'),
('Bob Smith', 'bob.smith@example.com'),
('Charlie Brown', 'charlie.brown@example.com');

INSERT INTO requests (student_id, request_date, time_slot_start, time_slot_end, status) VALUES
(1, '2024-10-16', '10:00:00', '10:30:00', 'Pending'),
(2, '2024-10-16', '10:30:00', '11:00:00', 'Pending'),
(1, '2024-10-16', '11:00:00', '11:30:00', 'Approved'),
(3, '2024-10-16', '10:30:00', '11:00:00', 'Rejected');


INSERT INTO bus_schedule (time_slot_start, date, driver_info) VALUES
('10:00:00', '2024-10-16', 'Driver 1'),
('10:30:00', '2024-10-16', 'Driver 2'),
('11:00:00', '2024-10-16', 'Driver 3');


INSERT INTO admins (email, role) VALUES
('admin@example.com', 'SuperAdmin'),
('admin2@example.com', 'Admin');
