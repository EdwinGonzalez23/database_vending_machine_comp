
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
    LNum integer UNIQUE,
    BNum integer UNIQUE,
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
    Phone text,
    StreetName text,
    City text,
    State text,
    Zip INTEGER
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
    TimeCreated time NOT NULL
);

CREATE TABLE Warehouse(
    WarehouseID serial PRIMARY KEY,
    SSN text,
    Capacity INTEGER,
    StreetName text,
    City text,
    State text,
    Zip INTEGER
);

CREATE TABLE GasReceipt(
    ReceiptID serial PRIMARY KEY,
    LicenseNumber INTEGER references Employee(LNum),
    StreetName text,
    City text,
    State text,
    Zip text,
    TotalPrice money,
    DateCreated Date
);

CREATE TABLE VendingMachine (
    MachineID serial NOT NULL unique,
    ClientID integer references Client(ClientID) NOT NULL unique,
    LocationID integer NOT NULL,
    Build text,
    ItemsPerSlot integer NOT NULL,
    Capacity integer NOT NULL
    --PRIMARY KEY(ClientID, MachineID),
    --CONSTRAINT VendingMachine_ClientID_fkey FOREIGN KEY (ClientID)
    --    REFERENCES Client(ClientID) MATCH SIMPLE
    --ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE Invoice(
    InvoiceID serial PRIMARY KEY,
    MachineID INTEGER references VendingMachine(MachineID),
    DateCreated DATE,
    TimeCreated TIME
);

CREATE TABLE Vehicle(
    VehicleID serial PRIMARY KEY,
    PlateNumber text,
    LicenseNumber INTEGER references Employee(Lnum),
    Make text,
    Model text,
    VIN text
);

CREATE TABLE Delivery (
    RouteID integer NOT NULL,
    LocationID integer REFERENCES Location(LocationID),
    OrderID integer REFERENCES Orders(OrderID),
    Odate date NOT NULL,
    TimeArrived time NOT NULL,
    TimeSpent text NOT NULL,
    PRIMARY KEY(RouteID),
    CONSTRAINT Delivery_RouteID_fkey FOREIGN KEY (RouteID)
        REFERENCES Route(RouteID) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION
);


CREATE TABLE OrderContains (
    ItemTypeID integer NOT NULL,
    OrderID integer NOT NULL,
    NumItemType integer NOT NULL,
    ItemTypePrice money NOT NULL,
    ExpDate date NOT NULL,
    PRIMARY KEY(ItemTypeID, OrderID),
    CONSTRAINT OrderContains_ItemTypeID_fkey FOREIGN KEY (ItemTypeId)
        REFERENCES ItemType(ItemTypeID) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT OrderContains_OrderID_fkey FOREIGN KEY (OrderID)
        REFERENCES Orders(OrderID) MATCH SIMPLE
    ON UPDATE NO ACTION ON DELETE NO ACTION
);




CREATE TABLE WarehouseHas(
    WarehouseID INTEGER NOT NULL,
    ItemTypeID INTEGER NOT NULL,
    NumItemType INTEGER,
    ItemTypePrice money,
    PRIMARY KEY(WarehouseID, ItemTypeID),
    	CONSTRAINT WarehouseHas_WarehouseID_fkey FOREIGN KEY (WarehouseID)
    	REFERENCES Warehouse(WarehouseID) MATCH SIMPLE
    	ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT WarehouseHas_ItemTypeID_fkey FOREIGN KEY (ItemTypeID)
    	REFERENCES ItemType(ItemTypeID) MATCH SIMPLE
    	ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE WarehouseReceives (
    OrderID INTEGER NOT NULL,
    WarehouseID INTEGER NOT NULL,
    TimeRec TIME,
    DateRec DATE,
    PRIMARY KEY(OrderID, WarehouseID),
    CONSTRAINT WarehouseReceives_OrderID_fkey FOREIGN KEY (OrderID)
    	REFERENCES Orders(OrderID) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT WarehouseReceives_WarehouseID_fkey FOREIGN KEY (WarehouseID)
    	REFERENCES Warehouse(WarehouseID) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE OrdersFrom(
    BadgeNumber INTEGER NOT NULL,
    SupplierID INTEGER NOT NULL, 
    DateOrdered date,
    TimeOrdered time,
    PRIMARY KEY(BadgeNumber, SupplierID),
    CONSTRAINT OrdersFrom_SSN_fkey FOREIGN KEY (BadgeNumber)
    	REFERENCES Employee(BNum) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT OrdersFrom_SupplierID_fkey FOREIGN KEY (SupplierID)
    	REFERENCES Supplier(SupplierID) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE PlacesOrder(
    OrderID INTEGER NOT NULL,
    BadgeNumber INTEGER NOT NULL,
    TimePlaced time,
    DatePlaced DATE,
    PRIMARY KEY(OrderID, BadgeNumber),
    CONSTRAINT PlacesOrder_OrderID_fkey FOREIGN KEY (OrderID)
    	REFERENCES Orders(OrderID) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT PlacesOrder_BadgeNumber_fkey FOREIGN KEY (BadgeNumber)
    	REFERENCES Employee(BNum) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION
);


CREATE TABLE ItemsSold(
    ItemTypeID INTEGER NOT NULL,
    InvoiceID INTEGER NOT NULL,
    NumSold INTEGER,
    PriceSold money,
    PRIMARY KEY(ItemTypeID, InvoiceID),
    CONSTRAINT ItemsSold_ItemTypeID_fkey FOREIGN KEY (ItemTypeID)
   	REFERENCES ItemType(ItemTypeID) MATCH SIMPLE
    	ON UPDATE NO ACTION ON DELETE NO ACTION,
    CONSTRAINT ItemsSold_InvoiceID_fkey FOREIGN KEY (InvoiceID)
    	REFERENCES Invoice(InvoiceID) MATCH SIMPLE
    	ON UPDATE NO ACTION ON DELETE NO ACTION
);



