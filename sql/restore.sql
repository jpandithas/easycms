-- Restore script for Cms project

CREATE DATABASE IF NOT EXISTS `cms2017`;

CREATE USER 'cmsuser' IDENTIFIED BY '1234';

GRANT ALL PRIVILEGES ON `cms2017`.* TO 'cmsuser'@'localhost' IDENTIFIED BY '1234';