Install Xamp on your pc.
copy all file on Xamp\htdocs\clock directory
open Xamp control panel and active Apache and My Sql
go to any Browser and search http://localhost/phpmyadmin
create a new database name clock
in the sql write this code:
-- db.sql
CREATE DATABASE IF NOT EXISTS clock_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE clock_app;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  email VARCHAR(150) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


then search http://localhost/clock/login.php
