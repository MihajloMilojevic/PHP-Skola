CREATE DATABASE m2_forum;

USE m2_forum;

CREATE TABLE korisnici( 
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	ime TEXT NOT NULL, 
	prezime TEXT NOT NULL, 
	email TEXT NOT NULL, 
	lozinka TEXT NOT NULL,
);

INSERT INTO korisnici(ime, prezime, email, lozinka)
VALUES ('Mihajlo', 'Milojevic', 'milojevicm374@gmail.com', 'Mihajlo123');