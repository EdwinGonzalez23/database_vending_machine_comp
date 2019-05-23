CREATE TABLE ItemType(
    ItemTypeID serial PRIMARY KEY,
    SupplierID serial,
    ItemTypeName text,
    MSRP money
);

CREATE TABLE Warehouse(
    WarehouseID serial PRIMARY KEY,
    SSN text,
    Capacity INTEGER,
    StreetName text,
    City text,
    State text,
	Zip INTEGER --Ensure a unique 5 digit zip
);

CREATE TABLE WarehouseHas(
    WarehouseID serial NOT NULL,
    ItemTypeID serial NOT NULL,
    NumItemType INTEGER,
	ItemTypePrice money
);

CREATE TABLE WarehouseReceives (
    OrderID serial NOT NULL,
    WarehouseID serial NOT NULL,
    TimeRec TIME,
    DateRec DATE
);

CREATE TABLE OrdersFrom(
    BadgeNumber INTEGER NOT NULL,
    SupplierID serial NOT NULL,
    DateOrdered date,
    TimeOrdered time
);

CREATE TABLE PlacesOrder(
    OrderID serial NOT NULL,
    BadgeNumber INTEGER NOT NULL,
    TimePlaced TIME,
    DatePlaced DATE
);

CREATE TABLE Supplier(
    SupplierID serial PRIMARY KEY,
    Name text,
    Phone text, --A valid 7 digit number
    StreetName text,
    City text,
    State text,
    Zip INTEGER
);


CREATE TABLE GasReceipt(
    ReceiptID serial PRIMARY KEY,
    LicenseNumber INTEGER,
    StreetName text,
    City text,
    State text,
    Zip text,
    TotalPrice money,
    DateCreated Date
);

CREATE TABLE Invoice(
	InvoiceID serial PRIMARY KEY,
	MachineID serial,
	DateCreated DATE,
	TimeCreated TIME
);

CREATE TABLE ItemsSold(
	ItemTypeID serial NOT NULL,
    InvoiceID serial NOT NULL,
    NumSold INTEGER,
    PriceSold money
);

CREATE TABLE Vehicle(
	VehicleID serial PRIMARY KEY,
	PlateNumber text,
	LicenseNumber INTEGER,
	Make text,
	Model text,
	VIN text
);

CREATE TABLE Employee (
    EmployeeID serial PRIMARY KEY NOT NULL,
    FName text NOT NULL,
    LName text NOT NULL,
    Phone text,
    Position text NOT NULL,
    Salary money,
    SDate date NOT NULL,
    StreetName text NOT NULL,
    City text NOT NULL,
    State text,
    Zip integer,
    LNum integer,
    BNum integer,
    Email text,
    SSN text UNIQUE NOT NULL
);

CREATE TABLE Client (
    ClientID serial PRIMARY KEY NOT NULL,
    FName text NOT NULL,
    LName text NOT NULL,
    Email text,
    Phone text NOT NULL,
    StreetName text NOT NULL,
    City text NOT NULL,
    State text,
    Zip text NOT NULL,
    CompName text
);

CREATE TABLE Delivery (
    RouteID serial NOT NULL,
    LocationID serial NOT NULL,
    OrderID serial NOT NULL,
    Odate date NOT NULL,
    TimeArrived time NOT NULL,
    TimeSpent integer NOT NULL
);

CREATE TABLE Location (
    LocationID serial PRIMARY KEY NOT NULL,
    StreetName text NOT NULL,
    City text NOT NULL,
    State text NOT NULL,
    Zip integer NOT NULL,
    Description text
);

CREATE TABLE OrderContains (
    ItemTypeID serial NOT NULL,
    OrderID serial NOT NULL,
    NumItemType serial NOT NULL,
    ItemTypePrice money NOT NULL,
    ExpDate date NOT NULL
);

CREATE TABLE Orders (
    OrderID serial PRIMARY KEY NOT NULL,
    SupplierID serial NOT NULL,
    OrderType text NOT NULL
);

CREATE TABLE Route (
    RouteID serial PRIMARY KEY NOT NULL,
    LicenseNumber integer NOT NULL,
    DateCreated date NOT NULL,
    TimeCreated time NOT NULL
);

CREATE TABLE VendingMachine (
    MachineID serial PRIMARY KEY NOT NULL,
    ClientID serial NOT NULL,
    LocationID serial NOT NULL,
    Build text,
    ItemsPerSlot integer NOT NULL,
    Capacity integer NOT NULL
);
