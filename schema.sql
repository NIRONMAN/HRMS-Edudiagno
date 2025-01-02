DROP DATABASE IF EXISTS hrms;

CREATE DATABASE hrms;

USE hrms;

CREATE TABLE employee (
    Id int NOT NULL, 
    Name VARCHAR(50) NOT NULL, 
    PRIMARY KEY (Id)
);

CREATE TABLE attendance(
    Id int NOT NULL,
    EmployeeId int,
    InTime TIMESTAMP,
    OutTime TIMESTAMP,
    FOREIGN KEY (EmployeeId) REFERENCES employee(Id)
);