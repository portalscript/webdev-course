INSERT INTO
	recipes (name, description, owner)
VALUES
	(
		"Brownies",
		"Indulge your taste buds with the ultimate chocolatey treat - homemade brownies! These delectable squares of moist and fudgy goodness are perfect for satisfying your sweet tooth and delighting friends and family. With their rich, deep cocoa flavor and melt-in-your-mouth texture, these brownies are sure to become a favorite go-to dessert.",
		"pjtatlow"
	),
	(
		"Cookies",
		"Get ready to experience the warm and comforting embrace of freshly baked cookies. These timeless treats are the epitome of homemade goodness, conjuring up memories of childhood and filling the air with an irresistible aroma that wafts through your kitchen.",
		"pjtatlow"
	);

INSERT INTO
	ingredients (recipe_id, name, quantity, unit)
VALUES
	(1, "Flour", 1, "cup"),
	(1, "Butter", 1, "cup"),
	(1, "Sugar", 2, "cups"),
	(1, "Eggs", 4, ""),
	(1, "Large Eggs", 4, ""),
	(1, "Vanilla Extract", 1, "teaspoon"),
	(1, "Salt", 0.25, "teaspoon"),
	(1, "Cocoa Powder", 0.5, "cup");

INSERT INTO
	steps (recipe_id, num, name, description)
VALUES
	(
		1,
		1,
		"Preheat oven",
		"Preheat your oven to 350°F (175°C). Grease a 9x13-inch baking pan or line it with parchment paper for easier removal."
	),
	(
		1,
		2,
		"Melt butter",
		"In a microwave-safe bowl, melt the butter. You can do this in the microwave in 30-second intervals, stirring in between, until the butter is completely melted. Alternatively, you can melt the butter on the stovetop using a saucepan."
	),
	(
		1,
		3,
		"Combine butter and sugar",
		"In a separate large mixing bowl, combine the melted butter and granulated sugar. Mix until well combined."
	),
	(
		1,
		4,
		"Add eggs and vanilla",
		"Add the eggs one at a time, mixing well after each addition. Stir in the vanilla extract."
	),
	(
		1,
		5,
		"Mix dry ingredients separately",
		"In another bowl, whisk together the all-purpose flour, cocoa powder, and salt. Gradually add this dry mixture to the wet ingredients, mixing until just combined. Be careful not to overmix."
	),
	(
		1,
		6,
		"Pour into baking pan",
		"Pour the brownie batter into the prepared baking pan, spreading it evenly."
	),
	(
		1,
		7,
		"Bake",
		"Bake in the preheated oven for about 25-30 minutes, or until a toothpick inserted into the center comes out with a few moist crumbs. Be cautious not to overbake, as brownies are best when they are fudgy and moist."
	),
	(
		1,
		8,
		"Cool",
		"Once done, remove the brownies from the oven and let them cool in the pan for a while. Then, transfer them to a wire rack to cool completely."
	),
	(
		1,
		9,
		"Enjoy!",
		"Enjoy your homemade brownies! They are perfect for indulging in as a delicious dessert or for sharing with friends and family."
	);