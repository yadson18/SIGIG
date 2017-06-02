create table users(
	id int primary key auto_increment not null,
	name varchar(100) not null,
	registration varchar(16) unique not null,
	email varchar(60) not null,
	username varchar(100) not null,
	password varchar(255) not null,
	role varchar(20) not null,
	created datetime default null,
	modified datetime default null
);

create table receipts(
	id int primary key auto_increment not null,
	receiptType enum('anual', 'mensal') not null,
	payment date not null,
	send date not null,
	user_id int not null,
	aproved boolean not null
);

create table files(
	id int primary key auto_increment not null,
	name varchar(255) not null,
	src varchar(255) not null
);

create table receipts_files( 
	id_receipt int unsigned,
	id_file int,
	constraint pk_receipt_file primary key clustered(id_receipt, id_file)
);


