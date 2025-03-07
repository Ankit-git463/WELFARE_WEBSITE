CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,        -- Auto-incrementing unique ID for each user
    firstname VARCHAR(100) NOT NULL,          -- First name of the user
    lastname VARCHAR(100) ,           -- Last name of the user
    email VARCHAR(255) NOT NULL UNIQUE,       -- Email, unique to prevent duplicates
    phone VARCHAR(20),                        -- Phone number
    resident ENUM('yes', 'no') NOT NULL,      -- Whether the user is a campus resident
    designation ENUM('student', 'staff', 'professor', 'visitor', 'employee', 'other') NOT NULL, -- User's designation
    idcard VARCHAR(255),                      -- File path or name for student ID card (if applicable)
    dob DATE,                                 -- Date of birth
    password VARCHAR(255) NOT NULL,           -- Password (stored in hashed form, for security)
    is_verified INT , 
    token VARCHAR(255),
    token_expire DATE,
    status INT NOT NULL  , 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Automatically stores the time of registration
);


