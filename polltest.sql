-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 05:50 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `polltest`;
USE `polltest`;

-- Table: admin_users
CREATE TABLE `admin_users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `govt_id` VARCHAR(100) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table: approved_admin_ids
CREATE TABLE `approved_admin_ids` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `govt_id` VARCHAR(100) NOT NULL UNIQUE
);

-- Table: contact_messages
CREATE TABLE `contact_messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100),
  `email` VARCHAR(100),
  `subject` VARCHAR(150),
  `message` TEXT,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table: elections
CREATE TABLE `elections` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `start_date` DATE,
  `end_date` DATE,
  `status` ENUM('upcoming', 'ongoing', 'ended') DEFAULT 'upcoming'
);

-- Table: languages (political parties)
CREATE TABLE `languages` (
  `lan_id` INT AUTO_INCREMENT PRIMARY KEY,
  `fullname` VARCHAR(100) NOT NULL,
  `about` VARCHAR(255),
  `votecount` INT DEFAULT 0
);

-- Table: loginusers (voter credentials)
CREATE TABLE `loginusers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `rank` VARCHAR(50) DEFAULT 'voter',
  `status` VARCHAR(20) DEFAULT 'ACTIVE'
);

-- Table: voters (voter info)
CREATE TABLE `voters` (
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `status` VARCHAR(20) DEFAULT 'NOTVOTED',
  `voted` VARCHAR(100)
);

-- Table: vote (record of votes)
CREATE TABLE `vote` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100),
  `party` VARCHAR(100),
  `timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Sample insert for elections
INSERT INTO `elections` (`title`, `description`, `start_date`, `end_date`, `status`)
VALUES ('College President Election', 'Election for college president.', '2025-05-05', '2025-05-07', 'ongoing');
