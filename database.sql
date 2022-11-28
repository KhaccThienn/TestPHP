CREATE DATABASE `testPHP` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE testPHP;

CREATE TABLE IF NOT EXISTS `Account` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(255),
  email VARCHAR(255),
  phone VARCHAR(20),
  address VARCHAR(255)
  PRIMARY KEY `pk_id`(`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Course` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255),
  PRIMARY KEY `pk_id`(`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `CourseRegister` (
  user_id int not null,
  course_id int not null,
  FOREIGN KEY (`user_id`) REFERENCES `Account` (`id`),
  FOREIGN KEY (`course_id`) REFERENCES `Course` (`id`)
) ENGINE = InnoDB;

INSERT INTO course (name) VALUES 
("HTML/CSS Pro"),
("PHP Basic"),
("Angular"),
("MySQL"),
("Laravel");