create database estoque;
USE estoque;
create table produtos(
id int primary key auto_increment,
nome varchar(25),
preco decimal(10,2),
estoque int,
fabricante varchar(50),
dose varchar(10)
);

select * from produtos