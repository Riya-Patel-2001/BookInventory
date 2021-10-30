create database bookStore;
use bookStore;

create table bookInventory(
bookId int auto_increment primary key,
bookName varchar(255) not null,
quantity int
);

create table orders(
orderId int auto_increment primary key,
firstName varchar(255),
lastName varchar(255),
paymentType varchar(255),
book_purchased int
);