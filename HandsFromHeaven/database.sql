CREATE TABLE Company (
    CompanyID SERIAL PRIMARY KEY,
    Password VARCHAR(255) NOT NULL,
    CHECK (LENGTH(Password) >= 8),
    CompanyName VARCHAR(255) NOT NULL,
    Phone VARCHAR(20)  UNIQUE,
    CHECK (Phone ~ '^(\+?\d{1,3})?\s?\d{10}$'),
    Email VARCHAR(255) UNIQUE ,
    CHECK (Email ~ '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
    FundAvailable DECIMAL(10,2) ,
    Verified BOOLEAN DEFAULT FALSE
);

CREATE TABLE NGO (
    NGOID SERIAL PRIMARY KEY,
    Password VARCHAR(255) NOT NULL,
    CHECK (LENGTH(Password) >= 8),
    NGOName VARCHAR(255) NOT NULL,
    Phone VARCHAR(20)  UNIQUE,
    CHECK (Phone ~ '^(\+?\d{1,3})?\s?\d{10}$'),
    Email VARCHAR(255) UNIQUE ,
    CHECK (Email ~ '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
    MissionStatement TEXT ,
    FundingNeeds DECIMAL(10,2),
    Verified BOOLEAN DEFAULT FALSE
);


CREATE TABLE Project (
    ProjectID INT PRIMARY KEY NOT NULL,
    ProjectName VARCHAR(255) ,
    StartDate DATE NOT NULL,
    EndDate DATE ,
    CHECK (StartDate <= EndDate),
    Status VARCHAR(50) NOT NULL,
    AmountCollected DECIMAL(10,2),
    GoalAmount DECIMAL(10,2) 
);


CREATE TABLE FundAllocation (
    RequestID INT PRIMARY KEY NOT NULL,
    RequestDate DATE NOT NULL,
    Amount DECIMAL(10,2) NOT NULL,
    CHECK (Amount >= 0),
    Status VARCHAR(50) NOT NULL,
    AllocationDate DATE ,
    CHECK (RequestDate <= AllocationDate),
    com_id INT NOT NULL,
    N_id INT ,
    P_id INT NOT NULL,
    FOREIGN KEY (com_id) REFERENCES Company(CompanyID),
    FOREIGN KEY (N_id) REFERENCES NGO(NGOID),
    FOREIGN KEY (P_id) REFERENCES Project(ProjectID)
);


CREATE TABLE Company_Causes (
    Company_num INT NOT NULL,
    cCause VARCHAR(255) ,
    PRIMARY KEY (Company_num, cCause),
    FOREIGN KEY (Company_num) REFERENCES Company(CompanyID)
    ON DELETE SET NULL ON UPDATE CASCADE
);


CREATE TABLE NGO_Causes (
    NGO_num INT NOT NULL,
    nCause VARCHAR(255) ,
    PRIMARY KEY (NGO_num, nCause),
    FOREIGN KEY (NGO_num) REFERENCES NGO(NGOID)
    ON DELETE SET NULL ON UPDATE CASCADE
);


CREATE TABLE Project_Causes (
    Project_num INT NOT NULL,
    pCause VARCHAR(255) NOT NULL,
    PRIMARY KEY (Project_num, pCause),
    FOREIGN KEY (Project_num) REFERENCES Project(ProjectID)
    ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE donates_to_CN (
    comp_no INT NOT NULL,
    N_no INT NOT NULL,
    PRIMARY KEY (comp_no, N_no),
    FOREIGN KEY (comp_no) REFERENCES Company(CompanyID),
    FOREIGN KEY (N_no) REFERENCES NGO(NGOID)
);


CREATE TABLE donates_to_CP  (
    com_no INT NOT NULL,
    p_no INT NOT NULL,
    PRIMARY KEY (com_no, p_no),
    FOREIGN KEY (com_no) REFERENCES Company(CompanyID),
    FOREIGN KEY (p_no) REFERENCES Project(ProjectID)
);


CREATE TABLE collabs_on (
    N_num INT NOT NULL,
    p_num INT NOT NULL,
    PRIMARY KEY (N_num, p_num),
    FOREIGN KEY (N_num) REFERENCES NGO(NGOID),
    FOREIGN KEY (p_num) REFERENCES Project(ProjectID)
);

CREATE TABLE contact_messages (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE volunteers (
    id SERIAL PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    gender VARCHAR(10) NOT NULL,
    resume_filename VARCHAR(255) NOT NULL
);

