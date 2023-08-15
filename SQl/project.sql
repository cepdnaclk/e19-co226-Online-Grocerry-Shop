
create database project;
Use project;


create table USER(
    UserId int auto_increment,
    FName varchar(30),
    LName varchar(30),
    Password varchar(30),
    Dirstrict varchar(30),
    City varchar(30),
    Street varchar(30),
    HouseNo int,
    PhoneNo int,
    Email varchar(30),
    Dateofbirth DATE,
    primary key(UserId)
);

create table ADMIN (
    adminId INT PRIMARY KEY,
    name VARCHAR(30) ,
    email VARCHAR(30),
    password VARCHAR(30)
);


create table COURIER(
    Id int,
    CourierName VARCHAR(30),
    Salary float,
    StartDate date,
    PhoneNumber varchar(10),
    AreaCovered varchar(30),
    CourierImage mediumblob
);


create table ORDERTABLE(
    Id int auto_increment,
    PaymentMethod varchar(4),
    Amount float,
    DeliveryDate date,
    OrderDate date,
    UserId int,
    rating int,
    primary key (Id),
    foreign key (UserId) references USER(UserId)
);

create table PRODUCT(
    Id int auto_increment,
    ProductName varchar(30),
    Category varchar(30),
    SellingPrice float,
    BuyingPrice float,
    Description varchar(127),
    Image mediumblob,
    Quantity int, 
    primary key (Id)
);

create table ORDER_ITEMS(
    OrderId int,
    ProductId int,
    Quantity float,
    Price float,
    rating float,
    primary key (OrderId,ProductId),
    foreign key (OrderId) references ORDERTABLE(Id),
    foreign key (ProductId) references PRODUCT(Id)
);


create table SUPPLIER(
    Id int,
    SupplierName varchar(30),
    Email varchar(30),
    PhoneNo int,
    DuePayment float,
    SupplierImage mediumblob,
    primary key (Id)
);

create table SUPPLIER_PRODUCT(
    SupplierId int,
    ProductId int,
    foreign key (SupplierId) references SUPPLIER(Id),
    foreign key (ProductID) references product(Id)
); 

create table SUPPLY(
    Id int auto_increment,
    ProductId int,
    OrderDate date,
    Quantity int,
    primary key (Id),
    foreign key (ProductId) references product(Id)
);