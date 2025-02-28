CREATE DATABASE projectukl;
USE projectukl;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30),
    password VARCHAR(100)
);

INSERT INTO users (username, password) VALUES
('Alice', 'alice@example.com'),
('Bob', 'bob@example.com');