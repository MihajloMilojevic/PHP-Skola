CREATE DATABASE IF NOT EXISTS m2_forum;

USE m2_forum;

CREATE TABLE IF NOT EXISTS korisnici( 
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	ime TEXT NOT NULL, 
	prezime TEXT NOT NULL, 
	email TEXT NOT NULL, 
	lozinka TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS teme(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	naziv TEXT NOT NULL,
	opis TEXT NOT NULL,
	datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	autor_id INT NOT NULL REFERENCES korisnici(id)
);

CREATE TABLE IF NOT EXISTS komentari(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	tekst TEXT NOT NULL,
	datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	autor_id INT NOT NULL REFERENCES korisnici(id),
	tema_id INT NOT NULL REFERENCES teme(id)
);

DELIMITER //

CREATE FUNCTION IF NOT EXISTS json_tema(id_in INT) RETURNS json 
BEGIN
	RETURN (
    	SELECT
    JSON_OBJECT(
        'id',
        t.id,
        'naziv',
        t.naziv,
        'opis',
        t.opis,
        'datum',
        DATE_FORMAT(t.datum, '%d.%m.%Y %H:%i:%s'),
        'autor',
        JSON_EXTRACT(
            (
            SELECT
                JSON_OBJECT('ime', k.ime, 'prezime', k.prezime)
            FROM
                korisnici k
            WHERE
                k.id = t.autor_id
        ),
        '$'
        ),
        'komentari',
        JSON_EXTRACT(
            CONCAT(
                '[',
                (
                SELECT
                    GROUP_CONCAT(
                        JSON_OBJECT(
                            'autor',
                            JSON_EXTRACT(
                                (
                                SELECT
                                    JSON_OBJECT(
                                        'ime',
                                        kor.ime,
                                        'prezime',
                                        kor.prezime
                                    )
                                FROM
                                    korisnici kor
                                WHERE
                                    kor.id = k.autor_id
                            ),
                            '$'
                            ),
                            'tekst',
                            k.tekst,
                            'datum',
                            DATE_FORMAT(k.datum, '%d.%m.%Y %H:%i:%s')
                        ) SEPARATOR ', '
                    )
                FROM
                    komentari k
                WHERE
                    k.tema_id = t.id
            ),
            ']'
            ),
            '$'
        )
    ) AS JSON
FROM
    teme t
WHERE
    t.id = id_in;
    );
END//

DELIMITER ;

CREATE VIEW json_teme AS SELECT *, json_tema(id) as json from teme;

INSERT INTO korisnici(ime, prezime, email, lozinka)
VALUES ('Mihajlo', 'Milojevic', 'milojevicm374@gmail.com', '	Mihajlo123');
INSERT INTO korisnici(ime, prezime, email, lozinka)
VALUES ('Stefan', 'Pejkovic', 'stefanpejkovic2004@gmail.com', 'Pali123');


INSERT INTO teme (naziv, opis, datum, autor_id) VALUES
('Tema1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sapien justo, venenatis ac lobortis vitae, malesuada ut odio. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec diam lectus, condimentum vitae dapibus eu, ullamcorper gravida urna. Ut blandit dui eros, et sodales turpis fringilla in. Proin et feugiat leo. Cras aliquet dolor sit amet sagittis cursus. Donec in nibh mauris. Cras pharetra erat ac eros lobortis, eu lobortis magna venenatis.', '2022-11-23 21:19:34', 1);

INSERT INTO komentari(tekst, autor_id, tema_id) VALUES 
('Komentat 1', 1, 1),
('Komentat 2', 2, 1),
('Komentat 3', 2, 1),
('Komentat 4', 1, 1);
