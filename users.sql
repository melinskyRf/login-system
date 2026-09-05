CREATE DATABASE loginDB;

USE loginDB;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Usuário exemplo
INSERT INTO users (username, password)
VALUES ('admin', SHA2('123456', 256));
