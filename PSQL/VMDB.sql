
CREATE TABLE Employee (
    FName text NOT NULL,
    LName text NOT NULL,
    Phone text,
    Position text NOT NULL,
    Salary money,
    SDate date NOT NULL,
    StreetName text NOT NULL,
    City text NOT NULL,
    Zip INTEGER CHECK (Zip BETWEEN 00001 AND 99999) UNIQUE,
    LNum integer UNIQUE,
    BNum integer UNIQUE,
    Email text,
    SSN text PRIMARY KEY NOT NULL
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

CREATE TABLE Location (
    LocationID serial PRIMARY KEY NOT NULL,
    StreetName text NOT NULL,
    City text NOT NULL,
    State text NOT NULL,
    Zip INTEGER CHECK (Zip BETWEEN 00001 AND 99999) UNIQUE,
    Description text
);

CREATE TABLE Supplier(
    SupplierID serial PRIMARY KEY,
    Name text,
    Phone INTEGER CHECK (Phone BETWEEN 0000000000 AND 9999999999), --A valid 7 digit number
    StreetName text,
    City text,
    State text,
    Zip INTEGER CHECK (Zip BETWEEN 00001 AND 99999) UNIQUE
);

CREATE TABLE ItemType(
    ItemTypeID serial PRIMARY KEY,
    ItemTypeName text,
    MSRP money
);

CREATE TABLE Orders (
    OrderID serial PRIMARY KEY NOT NULL,
    SupplierID integer REFERENCES Supplier(SupplierID),
    OrderType text NOT NULL
);

CREATE TABLE Route (
    RouteID serial PRIMARY KEY NOT NULL,
    LicenseNumber integer REFERENCES Employee(LNum),
    DateCreated date NOT NULL,
    TimeCreated date NOT NULL
);


CREATE TABLE Delivery (
    RouteID bigint NOT NULL,
    LocationID integer REFERENCES Location(LocationID),
    OrderID integer REFERENCES Orders(OrderID),
    Odate date NOT NULL,
    TimeArrived text NOT NULL,
    TimeSpent text NOT NULL,
    PRIMARY KEY(RouteID),
    CONSTRAINT Delivery_RouteID_fkey FOREIGN KEY (RouteID)
        REFERENCES Route(RouteID) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION
);


CREATE TABLE OrderContains (
    ItemTypeID serial NOT NULL,
    OrderID serial NOT NULL,
    NumItemType integer NOT NULL,
    ItemTypePrice integer NOT NULL,
    ExpDate date NOT NULL,
    PRIMARY KEY(ItemTypeID, OrderID),
    CONSTRAINT OrderContains_ItemTypeID_fkey FOREIGN KEY (ItemTypeId)
        REFERENCES ItemType(ItemTypeID) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT OrderContains_OrderID_fkey FOREIGN KEY (OrderID)
        REFERENCES Orders(OrderID) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION
);


CREATE TABLE VendingMachine (
    MachineID serial NOT NULL,
    ClientID serial NOT NULL,
    LocationID integer NOT NULL,
    Build text,
    ItemsPerSlot integer NOT NULL,
    Capacity integer NOT NULL,
    PRIMARY KEY(ClientID, MachineID),
    CONSTRAINT VendingMachine_ClientID_fkey FOREIGN KEY (ClientID)
        REFERENCES Client(ClientID) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION
);



