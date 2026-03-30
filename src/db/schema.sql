CREATE TABLE IF NOT EXISTS Employee_Records (
    ID INTEGER PRIMARY KEY AUTOINCREMENT,
    Username TEXT,
    Password TEXT NOT NULL,
    First_Name TEXT NOT NULL,
    Last_Name TEXT NOT NULL,
    DOB TEXT,
    Email TEXT,
    Address TEXT,
    City TEXT,
    State TEXT,
    Zip_Code TEXT,
    SSN TEXT,
    Position TEXT,
    Phone_Number TEXT,
    P_Level INTEGER NOT NULL DEFAULT 1
);

CREATE TABLE IF NOT EXISTS Healthcare (
    ID INTEGER PRIMARY KEY,
    Marital_Status INTEGER DEFAULT 0,
    Children INTEGER DEFAULT 0,
    "401k" INTEGER DEFAULT 0,
    Healthcare_Plan INTEGER DEFAULT 0,
    Dental INTEGER DEFAULT 0,
    Optical INTEGER DEFAULT 0,
    Life_Insurance_Plan INTEGER DEFAULT 0,
    Smoker INTEGER DEFAULT 0,
    FOREIGN KEY (ID) REFERENCES Employee_Records(ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Employee_Finance (
    ID INTEGER PRIMARY KEY,
    Gross_Pay REAL DEFAULT 0,
    FOREIGN KEY (ID) REFERENCES Employee_Records(ID) ON DELETE CASCADE
);
