ALTER TABLE
	recipes
ADD
	FULLTEXT INDEX text_index (name, description);