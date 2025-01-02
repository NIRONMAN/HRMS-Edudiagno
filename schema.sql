DROP DATABASE IF EXISTS hrms;

CREATE DATABASE hrms;

USE hrms;

CREATE TABLE employee (
    Id int NOT NULL AUTO_INCREMENT, 
    Name VARCHAR(50) NOT NULL, 

    DateJoined DATE NOT NULL,

    Department ENUM("IT", "RESEARCH"),
    SubDepartment VARCHAR(50),
    Designation ENUM("HR", "SALES"),

    PaymentMode Enum("BANK TRANSFER", "Cash"),
    Bank VARCHAR(50),
    BankIFSC VARCHAR(20),
    BankAccount VARCHAR(30),
    UAN VARCHAR(30),
    PFNumber VARCHAR(30),
    PANNumber VARCHAR(20),

    PRIMARY KEY (Id)
);

-- temporarily create dummy users
INSERT INTO employee
    (Name, DateJoined, Department, SubDepartment, Designation, PaymentMode, Bank, BankIFSC, BankAccount, UAN, PFNumber, PANNumber)
VALUES
    ("John", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345"),
    ("Alice", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345"),
    ("Bob", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345"),
    ("Tom", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345"),
    ("Alex", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345"),
    ("Casey", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345"),
    ("Taylor", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345"),
    ("Morgan", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345"),
    ("Dakota", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345"),
    ("Jordan", "2024-01-01", "IT", "NA", "HR", "BANK TRANSFER", "SBI", "SBI000055558888", "4000555666777", "UAN12345", "PF123356", "PAN12345");

CREATE TABLE attendance(
    Id int NOT NULL AUTO_INCREMENT,
    EmployeeId int,
    InTime DATETIME,
    OutTime DATETIME,
    PRIMARY KEY (Id),
    FOREIGN KEY (EmployeeId) REFERENCES employee(Id)
);


-- temporarily create dummy attendance
INSERT INTO attendance
    (EmployeeId, InTime, OutTime)
VALUES
    (1, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),
    (2, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),
    (3, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),
    (4, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),
    (5, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),
    (6, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),
    (7, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),
    (8, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),
    (9, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),
    (10, "2024-01-01 9:00:00", "2024-01-01 5:00:00"),

    (1, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),
    (2, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),
    (3, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),
    (4, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),
    (5, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),
    (6, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),
    (7, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),
    (8, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),
    (9, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),
    (10, "2024-01-02 9:00:00", "2024-01-02 5:00:00"),

    (1, "2024-01-03 9:00:00", "2024-01-03 5:00:00"),
    (2, "2024-01-03 9:00:00", "2024-01-03 5:00:00"),
    (3, "2024-01-03 9:00:00", "2024-01-03 5:00:00"),
    (4, "2024-01-03 9:00:00", "2024-01-03 5:00:00"),
    (5, "2024-01-03 9:00:00", "2024-01-03 5:00:00"),
    (6, "2024-01-03 9:00:00", "2024-01-03 5:00:00"),
    (7, "2024-01-03 9:00:00", "2024-01-03 5:00:00"),
    (8, "2024-01-03 9:00:00", "2024-01-03 5:00:00"),
    (9, "2024-01-03 9:00:00", "2024-01-03 5:00:00"),
    (10, "2024-01-03 9:00:00", "2024-01-03 5:00:00");

CREATE TABLE payslip(
    Id int NOT NULL AUTO_INCREMENT,
    EmployeeId int,
    TotalWorkingHours int,
    TotalEarning FLOAT(20, 2),
    PRIMARY KEY (Id),
    FOREIGN KEY (EmployeeId) REFERENCES employee(Id)
);