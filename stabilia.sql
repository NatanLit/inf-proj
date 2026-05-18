CREATE DATABASE stabilia;

USE stabilia;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    age INT,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);