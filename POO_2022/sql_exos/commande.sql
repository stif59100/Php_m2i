START TRANSACTION;

SELECT id_client FROM clients WHERE nom = 'BUGUET' AND prenom = 'Pascal';
INSERT INTO cdes(id_client, date_cde) SELECT id_client, CURDATE() FROM clients WHERE nom = 'BUGUET' AND prenom = 'Pascal';

SELECT LAST_INSERT_ID();

SELECT id_produit FROM produits WHERE designation = 'Badoit';
SELECT id_produit FROM produits WHERE designation = 'Evian';
SELECT id_produit FROM produits WHERE designation = 'Graves';

INSERT INTO ligcdes(id_cde, id_produit, qte) SELECT LAST_INSERT_ID(), 5, 1 FROM DUAL;
INSERT INTO ligcdes(id_cde, id_produit, qte) VALUES(111, 1, 1);
INSERT INTO ligcdes(id_cde, id_produit, qte) VALUES(111, 3, 1);

SELECT * FROM cdes;

SELECT * FROM ligcdes;

COMMIT;