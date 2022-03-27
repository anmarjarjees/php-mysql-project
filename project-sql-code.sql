-- Host: 127.0.0.1:3307
-- Please refer to my comments in the database connection file to understand why using the port "3307"
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10
-- Instructor/Devloper: Anmar Jarjees

-- Creating the database for the project
CREATE DATABASE IF NOT EXISTS web_workshop;

-- Create the "members" table:
CREATE TABLE IF NOT EXISTS members 
(
    member_id int(11) NOT NULL, 
    first_name varchar(40) NOT NULL, 
    last_name varchar(40) NOT NULL, 
    dob date NOT NULL, email varchar(80) NOT NULL, 
    phone varchar(20) NOT NULL, 
    occupation_id int(11) NOT NULL 
);

-- NOTE: For more learning refer to my "Full MySQL Coding Examples"

-- You could have created the primary key when the table was created, 
-- if not you can alter the table by adding the primary key: 
-- The "occupation_id" is a Forign key to be connected with the Primary key of "occupations" table
ALTER TABLE members 
ADD PRIMARY KEY (member_id), 
ADD KEY occupation_id (occupation_id);

-- Modifying the primary key
ALTER TABLE members 
MODIFY member_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

-- Create the "occupations" table:
CREATE TABLE occupations 
( 
    occupation_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(60) NOT NULL 
);


-- Inserting data/recorrdsd into table "members":
INSERT INTO members (member_id, first_name, last_name, dob, email, phone, occupation_id) 
VALUES 
(7, 'Alex', 'Chow', '2021-10-01', 'alexchow@phppdoprogramming.ca', '7654321', 1),
(8, 'Alexa', 'Chow', '2021-07-07', 'alexachow@pdoprogramming.ca', '7654321', 3),
(9, 'Martin', 'Smith', '2019-04-18', 'martinasmith@goingwithphpisgood.ca', '7654321', 3),
(10, 'Martin', 'Smith', '0000-00-00', 'martinsmith@goingwithphpisfun.ca', '', 1);



-- Inserting data/recorrdsd into table "occupations":
INSERT INTO `occupations` (occupation_id, name) 
VALUES
(1, 'Information systems analysts and consultants'),
(2, 'Database analysts and data administrators'),
(3, 'Software engineers and designers	'),
(4, 'Computer programmers and interactive media developers'),
(5, 'Web designers and developers'),
(6, 'College and other vocational instructor'),
(7, ' Other');

-- Creating The PK/FK relation between the two tables:
ALTER TABLE members 
ADD CONSTRAINT fk_occupations_members 
FOREIGN KEY (occupation_id) 
REFERENCES occupations (occupation_id);


