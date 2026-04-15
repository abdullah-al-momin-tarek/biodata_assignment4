-- Run this SQL in phpMyAdmin or MySQL CLI to set up the database

CREATE DATABASE IF NOT EXISTS biodata_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE biodata_db;

CREATE TABLE IF NOT EXISTS biodata (
    id          INT UNSIGNED     NOT NULL AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(150)     NOT NULL,
    dob         DATE             NOT NULL,
    age         TINYINT UNSIGNED NOT NULL,
    gender      VARCHAR(10)      NOT NULL,
    religion    VARCHAR(100)     NOT NULL,
    education   VARCHAR(150)     NOT NULL,
    profession  VARCHAR(150)     NOT NULL,
    father_name VARCHAR(150)     NOT NULL,
    mother_name VARCHAR(150)     NOT NULL,
    contact     VARCHAR(15)      NOT NULL,
    address     TEXT             NOT NULL,
    created_at  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
