<?php
	// Global vars
	define('ROOT', dirname(dirname(__FILE__)));
	define('DS', DIRECTORY_SEPARATOR);
	define('PATH', 'http://venko.localhost.com/hangman/public/');
	define('PROJECT_NAME', 'Hangman Game');
	define('MAIN_TITLE', 'Hangman Game');
	
	// DB connection
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'hangman');
	define('DB_USER', 'root');
	define('DB_PASS', '');

	// Default controller settings
	define('DEFAULT_CONTROLLER', 'game');
	define('DEFAULT_CONTROLLER_ACTION', 'index');