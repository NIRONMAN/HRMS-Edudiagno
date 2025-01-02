DROP DATABASE IF EXISTS hrms;

CREATE DATABASE hrms;

USE hrms;

CREATE TABLE employee (
    Id int NOT NULL AUTO_INCREMENT, 
    Name VARCHAR(50) NOT NULL, 
    PRIMARY KEY (Id)
);

-- temporarily create dummy users
INSERT INTO employee
    (Name)
VALUES
    ("John"),
    ("Alice"),
    ("Bob"),
    ("Tom"),
    ("Alex"),
    ("Casey"),
    ("Taylor"),
    ("Morgan"),
    ("Dakota"),
    ("Jordan");

CREATE TABLE attendance(
    Id int NOT NULL AUTO_INCREMENT,
    EmployeeId int,
    InTime TIMESTAMP,
    OutTime TIMESTAMP,
    PRIMARY KEY (Id),
    FOREIGN KEY (EmployeeId) REFERENCES employee(Id)
);