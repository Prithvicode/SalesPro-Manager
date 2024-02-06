




CREATE TABLE Users (
    UserID INT PRIMARY KEY,
    UserName VARCHAR(255) NOT NULL,
    UserType VARCHAR(50) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    PasswordHash VARCHAR(255) NOT NULL,
    PhoneNumber VARCHAR(20),
    Address TEXT
);


 CREATE TABLE Products (
    ProductID INT PRIMARY KEY,
    ProductName VARCHAR(255) NOT NULL,
    Description TEXT,
    SKU VARCHAR(50) NOT NULL,
    ProductionTimeDays INT,
    CostPrice DECIMAL(10, 2) NOT NULL,
    SellingPrice DECIMAL(10, 2) NOT NULL,
    InventoryLevel INT 
);


CREATE TABLE PriceHistory (
    PriceID INT PRIMARY KEY AUTO_INCREMENT,
    ProductID INT,
    CostPrice DECIMAL(10, 2) NOT NULL,
    SellPrice DECIMAL(10, 2) NOT NULL,
    EffectiveDate DATE NOT NULL,
    CONSTRAINT FK_PriceHistory_Product FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);


CREATE TABLE ProductionLog ( 
    ProductionLogID INT PRIMARY KEY,
    ProductID INT,
    ProductionDate DATE NOT NULL,
    QuantityProduced INT NOT NULL,
    CONSTRAINT FK_ProductionLog_Product FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
); 


CREATE TABLE Orders (
    OrderID INT PRIMARY KEY,
    OrderNumber VARCHAR(20) NOT NULL,
    CustomerID INT,
    AssignedDeliveryStaffID INT,  -- Foreign key for assigned delivery staff
    OrderDate DATE NOT NULL,
    VerificationStatus VARCHAR(50) DEFAULT 'Pending',
    ProductionStatus VARCHAR(50) DEFAULT 'Not Started',
    DeliveryStatus VARCHAR(50) DEFAULT 'Not Delivered',
    DeliveryDate DATE,
    CONSTRAINT FK_Orders_Customer FOREIGN KEY (CustomerID) REFERENCES Users(UserID),
    CONSTRAINT FK_Orders_AssignedDeliveryStaff FOREIGN KEY (AssignedDeliveryStaffID) REFERENCES Users(UserID)
);






CREATE TABLE CancellationHistory (
    CancellationID INT PRIMARY KEY,
    OrderID INT,
    CancellationTimestamp DATETIME NOT NULL,
    Reason TEXT,
    CONSTRAINT FK_CancellationHistory_Order FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);

CREATE TABLE Sales (
    SalesID INT PRIMARY KEY AUTO_INCREMENT,
    OrderID INT,
    SalesStaffID INT,
    SalesTimestamp DATETIME NOT NULL,
    MoneyReceived BOOLEAN DEFAULT FALSE, -- Indicates whether money has been received for the sale
    TotalAmount DECIMAL(10, 2), -- Total amount of the sale
    ProfitMade DECIMAL(10, 2), -- Profit made from the sale
    CONSTRAINT FK_Sales_Order FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    CONSTRAINT FK_Sales_SalesStaff FOREIGN KEY (SalesStaffID) REFERENCES Users(UserID)
);


ALTER TABLE ProductionLog
ADD COLUMN ProductionStaffID INT;


ALTER TABLE ProductionLog
ADD COLUMN ProductionStaffID INT,
ADD CONSTRAINT FK_ProductionLog_ProductionStaff FOREIGN KEY (ProductionStaffID) REFERENCES Users(UserID);

