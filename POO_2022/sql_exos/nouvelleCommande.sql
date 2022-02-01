## Nouvelle commande avec 2 produits (Evian et Badoit)

START TRANSACTION;

INSERT INTO cdes(date_cde, id_client) SELECT CURDATE(), id_client FROM clients WHERE nom='Buguet' AND prenom = 'Pascal';
SELECT LAST_INSERT_ID() FROM DUAL;

INSERT INTO ligcdes(qte, id_cde, id_produit) SELECT 1, LAST_INSERT_ID(), id_produit FROM produits WHERE designation = 'Evian';
INSERT INTO ligcdes(qte, id_cde, id_produit) SELECT 1, LAST_INSERT_ID(), id_produit FROM produits WHERE designation = 'Badoit';

## SELECT * FROM cdes c NATURAL JOIN ligcdes l NATURAL JOIN produits WHERE c.id_cde = LAST_INSERT_ID();
COMMIT;
## ROLLBACK;


SELECT * FROM cdes c NATURAL JOIN ligcdes l NATURAL JOIN produits WHERE c.id_cde = LAST_INSERT_ID();

SELECT * FROM cdes c NATURAL JOIN ligcdes l NATURAL JOIN produits WHERE c.id_cde = (SELECT id_cde FROM cdes ORDER BY id_cde DESC LIMIT 0,1);
SELECT * FROM cdes c NATURAL JOIN ligcdes l NATURAL JOIN produits WHERE c.id_cde = (SELECT MAX(id_cde) FROM cdes);

SELECT id_cde FROM cdes ORDER BY id_cde DESC LIMIT 0,1;

SELECT MAX(id_cde) FROM cdes;


