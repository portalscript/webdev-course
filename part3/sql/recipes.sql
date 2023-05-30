CREATE TABLE recipes (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(200) NOT NULL,
	description VARCHAR(1000) NOT NULL,
	owner VARCHAR(100) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (owner) REFERENCES users(username)
);

CREATE TABLE ingredients (
	id INT NOT NULL AUTO_INCREMENT,
	recipe_id INT NOT NULL,
	name VARCHAR(200) NOT NULL,
	quantity FLOAT NOT NULL,
	unit VARCHAR(100) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (recipe_id) REFERENCES recipes(id)
);

CREATE TABLE steps (
	id INT NOT NULL AUTO_INCREMENT,
	recipe_id INT NOT NULL,
	name VARCHAR(200) NOT NULL,
	num INT NOT NULL,
	description VARCHAR(1000) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (recipe_id, num),
	FOREIGN KEY (recipe_id) REFERENCES recipes(id)
);