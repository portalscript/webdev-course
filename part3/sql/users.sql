CREATE TABLE users (
	username varchar(100) NOT NULL,
	passhash varchar(100) NOT NULL,
	first_name varchar(100) NOT NULL,
	last_name varchar(100) NOT NULL,
	PRIMARY KEY (username)
);