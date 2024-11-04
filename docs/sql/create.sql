DROP DATABASE IF EXISTS sudoku;
CREATE DATABASE sudoku;
USE sudoku;

create table users
(
    id       int                  not null,
    password varchar(255)         not null,
    country  varchar(100)         not null,
    admin    tinyint(1) default 0 not null,
    username varchar(100)         not null
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8mb4;


# CONSTRAINTS
ALTER TABLE users
    ADD PRIMARY KEY (id);
ALTER TABLE users MODIFY COLUMN id INT AUTO_INCREMENT;