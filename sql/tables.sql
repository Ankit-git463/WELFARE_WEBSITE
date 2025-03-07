CREATE TABLE buses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bus_type VARCHAR(50),           -- Type of bus (Institute Bus, IITP Bus, Girls Bus, etc.)
    route VARCHAR(255),             -- Route that the bus follows (e.g., "Campus to Patna City")
    departure_date DATE,            -- Date when the bus departs
    departure_time TIME,            -- Time of bus departure
    source VARCHAR(100),            -- Starting point of the bus route
    destination VARCHAR(100)        -- End point of the bus route
);

-- Add records to the 'buses' table
INSERT INTO buses (bus_type, route, departure_date, departure_time, source, destination)
VALUES
('Institute Bus', 'Campus to Patna City', '2024-09-30', '08:00:00', 'Campus', 'Patna City'),
('IITP Bus', 'Patna City to Campus', '2024-09-30', '10:00:00', 'Patna City', 'Campus'),
('Girls Bus', 'Campus to Patna Junction', '2024-09-30', '07:30:00', 'Campus', 'Patna Junction'),
('Institute Bus', 'Campus to Gaya', '2024-09-30', '09:00:00', 'Campus', 'Gaya'),
('IITP Bus', 'Gaya to Campus', '2024-09-30', '14:00:00', 'Gaya', 'Campus'),
('Girls Bus', 'Campus to Patna City', '2024-09-30', '12:00:00', 'Campus', 'Patna City');




CREATE TABLE bus_info (
    bus_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_number VARCHAR(50),
    driver_name VARCHAR(100),
    contact VARCHAR(20)
);
CREATE TABLE bus_schedule (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_id INT, -- Foreign key linking to bus_info
    departure_time TIME,
    source VARCHAR(100),
    destination VARCHAR(100),
    FOREIGN KEY (bus_id) REFERENCES bus_info(bus_id) ON DELETE CASCADE
);
INSERT INTO bus_info (bus_number, driver_name, contact) VALUES
('Bus 01 - UP6562T5177', 'Akhilesh', '+919102543825'),
('Bus 02 - UP65ET9129', 'Abrar', '8738-068045'),
('Bus 03 - UP65DT0590', 'Sanjay', '+91 74929 52232');


-- Bus 01 Schedule (UP6562T5177)
INSERT INTO bus_schedule (bus_id, departure_time, source, destination) VALUES
(1, '08:00:00', 'Kalam', 'Tut Block'),
(1, '08:45:00', 'Kalam', 'Tut Block'),
(1, '09:30:00', 'Kalam', 'Tut Block'),
(1, '09:45:00', 'Kalam', 'Tut Block'),
(1, '10:00:00', 'Kalam', 'Tut Block'),
(1, '10:15:00', 'Kalam', 'Tut Block'),
(1, '10:30:00', 'Kalam', 'Tut Block'),
(1, '10:45:00', 'Kalam', 'Tut Block'),
(1, '11:10:00', 'Tut Block', 'Kalam'),
(1, '11:45:00', 'Kalam', 'Tut Block'),
(1, '12:00:00', 'Kalam', 'Tut Block'),
(1, '12:15:00', 'Tut Block', 'Kalam'),
(1, '12:30:00', 'Tut Block', 'Kalam'),
(1, '12:40:00', 'Tut Block', 'Kalam'),
(1, '12:55:00', 'Tut Block', 'Kalam'),
(1, '14:15:00', 'Kalam', 'Tut Block'),
(1, '14:30:00', 'Kalam', 'Tut Block'),
(1, '14:45:00', 'Kalam', 'Tut Block'),
(1, '15:00:00', 'Kalam', 'Tut Block'),
(1, '15:30:00', 'Kalam', 'Tut Block'),
(1, '15:45:00', 'Kalam', 'Tut Block'),
(1, '16:05:00', 'Tut Block', 'Kalam'),
(1, '16:30:00', 'Kalam', 'Tut Block'),
(1, '16:50:00', 'Tut Block', 'Kalam'),
(1, '17:05:00', 'Tut Block', 'Kalam'),
(1, '17:15:00', 'Tut Block', 'Kalam'),
(1, '17:30:00', 'Tut Block', 'Kalam'),
(1, '18:00:00', 'Kalam', 'Tut Block'),
(1, '18:10:00', 'Tut Block', 'Kalam');

-- Bus 02 Schedule (UP65ET9129)
INSERT INTO bus_schedule (bus_id, departure_time, source, destination) VALUES
(2, '10:00:00', 'IIT (Kalam)', 'Patna (Bihar Museum)'),
(2, '11:30:00', 'Patna (Bihar Museum)', 'IIT (Kalam)'),
(2, '16:00:00', 'IIT (Kalam)', 'Patna (Bihar Museum)'),
(2, '17:30:00', 'Patna (Bihar Museum)', 'IIT (Kalam)'),
(2, '17:10:00', 'Tut Block', 'Kalam'),
(2, '17:25:00', 'Tut Block', 'Kalam'),
(2, '17:50:00', 'Kalam', 'Tut Block'),
(2, '18:00:00', 'Tut Block', 'Kalam');

-- Bus 03 Schedule (UP65DT0590)
INSERT INTO bus_schedule (bus_id, departure_time, source, destination) VALUES
(3, '07:50:00', 'Kalam', 'Tut Block'),
(3, '08:50:00', 'Kalam', 'Tut Block'),
(3, '09:25:00', 'Kalam', 'Tut Block'),
(3, '09:40:00', 'Kalam', 'Tut Block'),
(3, '09:55:00', 'Kalam', 'Tut Block'),
(3, '10:10:00', 'Kalam', 'Tut Block'),
(3, '10:25:00', 'Kalam', 'Tut Block'),
(3, '10:40:00', 'Kalam', 'Tut Block'),
(3, '11:05:00', 'Kalam', 'Tut Block'),
(3, '11:50:00', 'Kalam', 'Tut Block'),
(3, '12:00:00', 'Kalam', 'Tut Block'),
(3, '12:10:00', 'Tut Block', 'Kalam'),
(3, '12:35:00', 'Tut Block', 'Kalam'),
(3, '12:45:00', 'Tut Block', 'Kalam'),
(3, '13:55:00', 'Kalam', 'Tut Block'),
(3, '14:05:00', 'Kalam', 'Tut Block'),
(3, '14:25:00', 'Kalam', 'Tut Block'),
(3, '14:40:00', 'Kalam', 'Tut Block'),
(3, '14:55:00', 'Kalam', 'Tut Block'),
(3, '15:10:00', 'Kalam', 'Tut Block'),
(3, '15:50:00', 'Kalam', 'Tut Block'),
(3, '16:00:00', 'Tut Block', 'Kalam'),
(3, '16:25:00', 'Kalam', 'Tut Block'),
(3, '16:50:00', 'Tut Block', 'Kalam'),
(3, '17:00:00', 'Tut Block', 'Kalam'),
(3, '17:50:00', 'Kalam', 'Tut Block');


-- WEEKEND 



-- ----------------------------EMERGENCY PAGE ------------------------------------
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255),
    name VARCHAR(255),
    position VARCHAR(255),
    contact_number VARCHAR(255)
);


INSERT INTO contacts (category, name, position, contact_number) VALUES
-- IITP Hospital Helpline Numbers 24x7
('IITP Hospital Helpline', 'Ambulance', '', '9264193927'),
('IITP Hospital Helpline', 'Apollo Pharmacy', '', '7605035992'),
('IITP Hospital Helpline', 'Medical Officer (Dr. Shobhakant)', '', '9612747626, 8259846524'),
('IITP Hospital Helpline', 'Mr. Ravi', '', '8210893435, 7488589487'),
('IITP Hospital Helpline', 'PIC_Medical (Dr. Saurabh Kumar Pandey)', '', '7321893616'),
('IITP Hospital Helpline', 'Hospital Reception', '', '06115233800'),
('IITP Hospital Helpline', 'Institute Ambulance', '', '9508910134'),

-- NSMCH Helpline Numbers 24x7
('NSMCH Helpline', 'Bhola Ji', '', '9264193928, 8825317071'),
('NSMCH Helpline', 'Hospital Manager', '', '9102403264'),
('NSMCH Helpline', 'Mr. Aryan Singh', '', '9264452653, 9386896999'),
('NSMCH Helpline', 'Mr. Sanjay Verma', '', '9264193992'),

-- Security Helpline Numbers 24x7
('Security Helpline', 'Security Officer (Mr. Deepak Chourasia)', '', '8340269042, 9574578404'),
('Security Helpline', 'Security Patrolling Vehicle', '', '8102917508'),
('Security Helpline', 'Security Supervisor (Mr. Prahlad Singh)', '', '9122171516'),
('Security Helpline', 'Security Supervisor (Mr. HariShankar)', '', '6202159737'),
('Security Helpline', 'Security Supervisor (Mr. T N Sharma)', '', '8860345289'),

-- A.P.J. Abdul Kalam Hostel
('A.P.J. Abdul Kalam Hostel', 'Warden (A & B Block) (Dr. Chandra Shekhar Prajapati)', '', '7259475116'),
('A.P.J. Abdul Kalam Hostel', 'Warden (C & D Block) (Dr. Shailesh Kumar Tiwari)', '', '+91-612-302-8074'),
('A.P.J. Abdul Kalam Hostel', 'Caretaker (Mr. Sudama)', '', '6206250769'),
('A.P.J. Abdul Kalam Hostel', 'Caretaker (Mr. Sujit Tiwari)', '', '9122737307'),
('A.P.J. Abdul Kalam Hostel', 'Hostel Office (Administration) (Mr. Deep Raj)', '', '8825236592'),
('A.P.J. Abdul Kalam Hostel', 'Mess Manager (Mess 1) (Mr. Umanand)', '', '8789471175'),
('A.P.J. Abdul Kalam Hostel', 'Mess Manager (Mess 2) (Mr. Prem)', '', '9755213223'),
('A.P.J. Abdul Kalam Hostel', 'Cleaning Supervisor (Mr. Bipin)', '', '7004976395'),
('A.P.J. Abdul Kalam Hostel', 'Carpenter (Mr. Kunal)', '', '9973359488'),
('A.P.J. Abdul Kalam Hostel', 'Electrician (Mr. Kamlesh)', '', '7481091061'),

-- C.V. Raman Hostel
('C.V. Raman Hostel', 'Warden (Dr. Chandra Shekhar Prajapati)', '', '+91-6115-233-141'),
('C.V. Raman Hostel', 'Caretaker (Mr. Samad)', '', '9931405122'),
('C.V. Raman Hostel', 'Hostel Office (Administration) (Mr. Amit)', '', '9386433912'),
('C.V. Raman Hostel', 'Hostel Office (Administration) (Mr. Anurag)', '', '9661699330'),
('C.V. Raman Hostel', 'Mess Manager (Mr. Sanjeet)', '', '7002280341'),
('C.V. Raman Hostel', 'Cleaning Supervisor (Mr. Bipin)', '', '7004976395'),

-- Aryabhatta Hostel
('Aryabhatta Hostel', 'Warden (A1 & A2 Block) (Dr. T. Rajagopala Rao)', '', '+91-612-302-8238'),
('Aryabhatta Hostel', 'Warden (B1 & B2 Block) (Dr. Suraj Suman)', '', '+91-6115-233-970'),
('Aryabhatta Hostel', 'Hostel Office (Ms. Supriya)', '', '9122458200'),
('Aryabhatta Hostel', 'Caretaker (Mr. Imraan)', '', '7766842737'),
('Aryabhatta Hostel', 'Caretaker (Mr. Naushad)', '', '9060075032'),
('Aryabhatta Hostel', 'Cleaning Supervisor (Mr. Bipin)', '', '7004976395'),
('Aryabhatta Hostel', 'Mess Manager (Mr. Gautam Rana)', '', '8167644026'),

-- Asima Hostel
('Asima Hostel', 'Warden (Dr. K. Saloni)', '', '9811201243'),
('Asima Hostel', 'Associate Warden (Dr. Pradhi Rajeev)', '', '8004040013'),
('Asima Hostel', 'Hostel Office (Administration) (Ms. Nishita)', '', '9718394431'),
('Asima Hostel', 'Caretaker (Ms. Anamika Singh)', '', '9771000367'),
('Asima Hostel', 'Caretaker (Ms. Minnat Ji)', '', '9798402929'),
('Asima Hostel', 'Caretaker (Mrs. Neelam Ji)', '', '7004655822'),
('Asima Hostel', 'Mess Manager (Mr. Vikram, Remote)', '', '9582774420'),
('Asima Hostel', 'Mess Manager (Mr. Vivek, Onsite)', '', '8279512876'),
('Asima Hostel', 'Cleaning Supervisor (Ms. Seema)', '', '9934393413'),

-- Married Hostel
-- (Insert more if available for Married Hostel)

-- Gymkhanna Core Members
('Gymkhanna Core Members', 'Vice President (Shubham Satyam)', '', '8340389862'),
('Gymkhanna Core Members', 'General Secretary, Students Welfare Board (Suryansh Bansal)', '', '7017172124'),
('Gymkhanna Core Members', 'General Secretary, Games and Sports Council (Shivam Dubey)', '', '917754054559'),
('Gymkhanna Core Members', 'General Secretary, HoSCA (Ankit Kumar)', '', '7084829448'),
('Gymkhanna Core Members', 'General Secretary, Students Technical Council (Kirtan Jain)', '', '9483960241'),
('Gymkhanna Core Members', 'Under Graduate Representative (Panav Arpit Raaj)', '', '9606158818'),
('Gymkhanna Core Members', 'Post Graduate Representative (Ashish Ranjan)', '', '9107632910');



-- ------------QUERIES ----------------------

CREATE TABLE queries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE queries 
ADD COLUMN status ENUM('resolved', 'unresolved') DEFAULT 'unresolved',
ADD COLUMN reply TEXT;


CREATE TABLE daily_schedule (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_id INT, -- Foreign key linking to bus_info
    departure_time TIME,
    node VARCHAR (100),
    FOREIGN KEY (bus_id) REFERENCES bus_info(bus_id) ON DELETE CASCADE
);

INSERT INTO daily_schedule (bus_id, departure_time, node) 
VALUES 
-- Bus 1 Schedule
(1, '07:00:00', 'Gate 1','Hostel 1' ),
(1, '07:15:00', 'Admin Building', 'Academic Block'),
(1, '07:30:00', 'Hostel 1' , 'Bihta'),
(1, '07:45:00', 'Academic Block', 'Hostel 2'),
(1, '08:00:00', 'Kalam Hostel', 'Academic Block'),
-- Bus 2 Schedule
(2, '08:00:00', 'Main Gate', 'Academic Block'),
(2, '08:15:00', 'Central Library', 'Bihta'),
(2, '08:30:00', 'ME Block', 'Gate 2'),
(2, '08:45:00', 'CSE Department','Academic Block'),
(2, '09:00:00', 'Hostel 2' , 'Gate 2'),
-- Bus 3 Schedule
(3, '09:00:00', 'Main Gate','Academic Block'),
(3, '09:15:00', 'Admin Building', 'Gate 2'),
(3, '09:30:00', 'Guest House', 'Academic Block'),
(3, '09:45:00', 'Hostel 3', 'Gate 1'),
(3, '10:00:00', 'Sports Complex','Academic Block');
