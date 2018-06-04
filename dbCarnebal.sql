create database dbCarnebal;

use dbCarnebal;

create table tbFuncionario(
cdFuncionario int not null auto_increment,
cpf char(11),
nomeFuncionario varchar(60),
endereco varchar(200),
complemento varchar(50),
ddd char(2),
telefone char(11),
sexo char(1),
dtNascimento date,
cargo varchar(6),
email varchar(100),
senha varchar(20),
foto varchar(255),
primary key (cdFuncionario)
);


create table tbCliente(
cdCliente int not null auto_increment,
ddd char(2),
telefone char(11),
nomeCliente varchar (60),
endereco varchar(200),
complemento varchar(50),
primary key (cdCliente)
);

create table tbProduto(
cdProduto int not null auto_increment,
nomeProduto varchar (20),
descricao varchar (120),
precoUnitario decimal(6,2),
foto varchar(255),
primary key (cdProduto)
);


create table tbComanda(
cdComanda int not null auto_increment,
dtComanda date not null,
hrComanda time not null,
vlTotal decimal (7,2),
cdFuncionario int not null,
cdCliente int,
primary key (cdComanda),
foreign key (cdCliente) references tbCliente(cdCliente),
foreign key (cdFuncionario) references tbFuncionario(cdFuncionario)
);


create table tbControle(
cdControle int not null auto_increment,
cdProduto int not null,
qtProduto int not null,
vlControle decimal (8,2) not null,
cdComanda int not null,
primary key (cdControle),
foreign key (cdProduto) references tbProduto(cdProduto),
foreign key (cdComanda) references tbComanda(cdComanda),
UNIQUE KEY `ix_Controle` (cdProduto, cdComanda)
);

