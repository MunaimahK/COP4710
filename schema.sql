DROP TABLE IF EXISTS Containers;

DROP TABLE IF EXISTS StorageAreas;

DROP TABLE IF EXISTS Trucks;

DROP TABLE IF EXISTS Cranes;

DROP TABLE IF EXISTS Ships;

DROP TABLE IF EXISTS Berths;

DROP TABLE IF EXISTS Vehicles;

DROP TABLE IF EXISTS Ports;

DROP TABLE IF EXISTS Users;

CREATE TABLE 
  Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT, 
    Name CHAR(20), 
    Email VARCHAR(20), 
    Password VARCHAR(20)
  );

CREATE TABLE
  Ports (
    PortID INT PRIMARY KEY AUTO_INCREMENT,
    StorageAreaCount INT,
    BerthCount INT
  );

CREATE TABLE
  Vehicles (VehicleID INT PRIMARY KEY AUTO_INCREMENT);

CREATE TABLE
  Berths (
    BerthID INT PRIMARY KEY AUTO_INCREMENT,
    IsAvailable BOOLEAN
  );

CREATE TABLE
  Ships (
    VehicleID INT PRIMARY KEY,
    Name CHAR(20),
    Owner CHAR(20),
    BerthID INT,
    EntryTime TIME,
    ExitTime TIME,
    FOREIGN KEY (VehicleID) REFERENCES Vehicles (VehicleID),
    FOREIGN KEY (BerthID) REFERENCES Berths (BerthID)
  );

CREATE TABLE
  Cranes (
    CraneID INT PRIMARY KEY AUTO_INCREMENT,
    PortID INT,
    FOREIGN KEY (PortID) REFERENCES Ports (PortID)
  );

CREATE TABLE
  Trucks (
    VehicleID INT PRIMARY KEY,
    DriverName VARCHAR(100),
    TruckCompany VARCHAR(100),
    LicensePlate VARCHAR(20),
    FOREIGN KEY (VehicleID) REFERENCES Vehicles (VehicleID)
  );

CREATE TABLE
  StorageAreas (
    StorageAreaID INT PRIMARY KEY AUTO_INCREMENT,
    StorageAddress VARCHAR(20) NOT NULL,
    PortID INT,
    FOREIGN KEY (PortID) REFERENCES Ports (PortID)
  );

CREATE TABLE
  Containers (
    ContainerID INT PRIMARY KEY AUTO_INCREMENT,
    CompanyName VARCHAR(255),
    SourceID INT,
    DestinationID INT,
    StorageAreaID INT,
    ContainerStatus VARCHAR(255),
    FOREIGN KEY (SourceID) REFERENCES Vehicles (VehicleID),
    FOREIGN KEY (DestinationID) REFERENCES Vehicles (VehicleID),
    FOREIGN KEY (StorageAreaID) REFERENCES StorageAreas (StorageAreaID)
  );

-- dummy data
INSERT INTO
  Ports (StorageAreaCount, BerthCount)
VALUES
  (0, 0);

INSERT INTO
  Vehicles
VALUES
  ();

INSERT INTO
  Vehicles
VALUES
  ();

INSERT INTO
  Trucks (VehicleID, DriverName, TruckCompany, LicensePlate)
VALUES
  (1, 'John Doe', 'Truck Company', 'ABC123');

INSERT INTO
  Trucks (VehicleID, DriverName, TruckCompany, LicensePlate)
VALUES
  (2, 'Jane Doe', 'Truck Company', 'DEF456');

INSERT INTO
  StorageAreas (StorageAddress, PortID)
VALUES
  ('Address 1', 1);

INSERT INTO
  Containers (
    CompanyName,
    SourceID,
    DestinationID,
    StorageAreaID,
    ContainerStatus
  )
VALUES
  ('Company A', 1, 2, 1, 'at source');
