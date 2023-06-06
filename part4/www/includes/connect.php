<?php

function openDB(): mysqli {
	return new mysqli("database", "recipe-app-user", "super-secret-password", "recipes", 3306);
}