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


create table sudokus
(
    id      int      not null,
    board   longtext collate utf8mb4_bin not null   check (json_valid(`board`)),
    mask    longtext collate utf8mb4_bin not null   check (json_valid(`mask`)),
    level   int                          not null
);

# CONSTRAINTS
ALTER TABLE sudokus
    ADD PRIMARY KEY (id);
ALTER TABLE sudokus MODIFY COLUMN id INT AUTO_INCREMENT;