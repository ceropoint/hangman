CREATE DATABASE hangman;
USE hangman;

CREATE TABLE IF NOT EXISTS categories(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS words(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	cat_id INT NOT NULL,
	name VARCHAR(30) NOT NULL,
	hint TEXT NOT NULL,
	FOREIGN KEY(cat_id) REFERENCES categories(id)
);

CREATE TABLE IF NOT EXISTS users(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(80) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	games_played INT NOT NULL DEFAULT 0,
	games_won INT NOT NULL DEFAULT 0,
	games_lost INT NOT NULL DEFAULT 0,
	letter_guesses INT NOT NULL DEFAULT 0,
	full_words_guessed INT NOT NULL DEFAULT 0
);

INSERT INTO categories(id, name) VALUES
(1, 'Cities'),
(2, 'Animals'),
(3, 'Countries'),
(4, 'Sports'),
(5, 'Cars');

INSERT INTO words(cat_id, name, hint) VALUES
(1, 'Paris', 'The city of love'),
(1, 'Prague', 'The city of hundred spires'),
(1, 'Amsterdam', 'Venice of the North'),
(1, 'Grenoble', 'Capital of the Alps'),
(1, 'Kuala Lumpur', 'Golden Triangle'),
(1, 'Las Vegas', 'Sin City'),
(1, 'Istanbul', 'A city located on the Bosphorus'),
(1, 'Shanghai', 'The biggest city in China'),
(2, 'Mosquito', 'A blood-thursty beast you can barely see.'),
(2, 'Python', 'Programming language'),
(2, 'Hummingbird', 'As small as a thumb and fast'),
(2, 'Mammoth', 'A prehistoric elephant'),
(2, 'Penguin', 'Spend half their time in water and the other half on land'),
(2, 'Kangaroo', 'Cant walk backwards'),
(2, 'Polar Bear', 'Eat mainly seals'),
(2, 'Beaver', 'Front teeth never stop growing'),
(2, 'Jellyfish', 'Does not have brain'),
(3, 'Japan', 'The land of the rising sun'),
(3, 'Canada', 'They like hockey and maple syrup'),
(3, 'New Zealand', 'The film set of "The Lord of the Rings"'),
(3, 'North Korea', 'Kim Jong Un'),
(3, 'Vatican City', 'Pope loves this place'),
(3, 'Iceland', 'Opposite of Greenland'),
(3, 'Switzerland', 'Country famous for its clocks'),
(3, 'Algeria', 'Largest country in the Sahara'),
(4, 'Table Tennis', 'Use paddle and ball and is played on a table'),
(4, 'Basketball', 'To score make it in the hoop'),
(4, 'Baseball', 'Uses a bat and a ball with 9 players on team'),
(4, 'Field Hockey', 'Uses stick and puck/ ball most often on grass'),
(4, 'Cricket', 'Uses a bat and a ball with 11 players on team'),
(4, 'Soccer', 'You can only use your feet'),
(5, 'Aston Martin', 'Car made in United Kingdom'),
(5, 'Volkswagen', 'Car made in Germany'),
(5, 'Chevrolet', 'Car made in US'),
(5, 'Alfa Romeo', 'Car made in Italy'),
(5, 'Lamborghini', 'Car made in Italy'),
(5, 'Hyundai', 'Car made in Japan'),
(5, 'Nissan', 'Car made in Japan'),
(5, 'Toyota', 'Car made in Japan');



