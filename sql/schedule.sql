
-- WEEKEND ----------------------------------------------------------------------
CREATE TABLE weekend_schedule(
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_id INT, -- Foreign key linking to bus_info
    departure_time TIME,
    source VARCHAR(100),
    destination VARCHAR(100),
    FOREIGN KEY (bus_id) REFERENCES bus_info(bus_id) ON DELETE CASCADE
);
-- Insert records for Bus 01 (UP6562T5177)
INSERT INTO weekend_schedule (bus_id, departure_time, source, destination)
VALUES
(1, '08:00:00', 'Kalam', 'Tut Block'),
(1, '08:45:00', 'Kalam', 'Tut Block'),
(1, '09:30:00', 'Kalam (IIT)', 'Tut Block'),
(1, '10:45:00', 'Kalam', 'Tut Block'),
(1, '11:10:00', 'Tut Block', 'Kalam'),
(1, '12:40:00', 'Tut Block', 'Kalam'),
(1, '14:30:00', 'Kalam', 'Tut Block'),
(1, '16:50:00', 'Tut Block', 'Kalam');

-- Insert records for Bus 02 (UP65ET9129)
INSERT INTO weekend_schedule (bus_id, departure_time, source, destination)
VALUES
(2, '10:00:00', 'IIT (Kalam)', 'Patna (Bihar Museum)'),
(2, '11:30:00', 'Patna (Bihar Museum)', 'IIT (Kalam)'),
(2, '16:00:00', 'IIT (Kalam)', 'Patna (Bihar Museum)'),
(2, '17:30:00', 'Patna (Bihar Museum)', 'IIT (Kalam)'),
(2, '18:00:00', 'IIT (Kalam)', 'Tut Block'),
(2, '19:00:00', 'Tut Block', 'IIT (Kalam)'),
(2, '08:15:00', 'IIT (Kalam)', 'Tut Block'),
(2, '12:30:00', 'Patna (Bihar Museum)', 'IIT (Kalam)');


-- Insert records for Bus 03 (UP65DT0590)
INSERT INTO weekend_schedule (bus_id, departure_time, source, destination)
VALUES
(3, '08:00:00', 'Kalam', 'Tut Block'),
(3, '08:45:00', 'Kalam', 'Tut Block'),
(3, '09:30:00', 'Kalam (IIT)', 'Tut Block'),
(3, '10:15:00', 'Kalam', 'Tut Block'),
(3, '11:10:00', 'Tut Block', 'Kalam'),
(3, '12:30:00', 'Kalam (IIT)', 'Tut Block'),
(3, '14:45:00', 'Kalam', 'Tut Block'),
(3, '16:50:00', 'Tut Block', 'Kalam');


-- WEEKDAYS -------------------------------------------------------------

CREATE TABLE daily_schedule (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_id INT, -- Foreign key linking to bus_info
    departure_time TIME,
    node VARCHAR (100),
    destination VARCHAR(100),
    FOREIGN KEY (bus_id) REFERENCES bus_info(bus_id) ON DELETE CASCADE
);

INSERT INTO daily_schedule (bus_id, departure_time, node , destination) 
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


