create database bookStore;
use bookStore;

create table bookInventory(
bookId int auto_increment primary key,
bookName varchar(255) not null,
authorName varchar(255) not null,
quantity int,
price int not null,
img blob
);

drop table bookinventory;

create table orders(
orderId int auto_increment primary key,
firstName varchar(255),
lastName varchar(255),
paymentType varchar(255),
book_purchased int
);
alter table orders add email varchar(255);