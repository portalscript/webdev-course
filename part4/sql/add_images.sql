ALTER TABLE
	recipes
ADD
	COLUMN image VARCHAR(1024);

UPDATE
	recipes
SET
	image = "https://assets.bonappetit.com/photos/64272438b1072d0f16190886/16:9/w_5887,h_3311,c_limit/033123-brownies-lede.jpg"
WHERE
	id = 1;