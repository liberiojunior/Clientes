drop database tpa_oo;
create database tpa_oo;
use tpa_oo;
create table cliente (
id int unsigned auto_increment not null,
foto varchar(100)null,
nome varchar(100)not null,
email varchar(100)not null,
endereco  varchar(100)not null,
celular char(11) not null,
PRIMARY KEY(id)
);

INSERT INTO cliente VALUES(null, null,'Liberio', 'lib@gmail.com','Rua 1',3140028922);