CREATE DATABASE job_portal;

USE job_portal;

CREATE TABLE employers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employer_name VARCHAR(100) NOT NULL,
    company_name VARCHAR(100) NOT NULL,
    contact_no VARCHAR(15) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);