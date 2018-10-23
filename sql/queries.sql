CREATE DATABASE todo_app;
USE todo_app

CREATE USER 'app_user' IDENTIFIED BY 'asd';
GRANT ALL PRIVILEGES ON *.* TO 'app_user';

CREATE SCHEMA todo_schema;

CREATE TABLE items
(
    id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(255)
);

ALTER TABLE items ADD completed boolean NULL;
ALTER TABLE items ADD deadline date NOT NULL;
