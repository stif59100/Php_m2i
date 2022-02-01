SELECT clients.id_client, clients.nom, clients.prenom, villes.nom_ville, clients.cp, cdes.id_cde FROM (cours.clients clients INNER JOIN cours.villes villes ON (clients.cp = villes.cp)) INNER JOIN cours.cdes cdes ON (cdes.id_client = clients.id_client) WHERE cdes.id_cde = 1;  

SELECT produits.designation,
       produits.prix,
       produits.id_produit,
       ligcdes.qte,
       ligcdes.id_cde
  FROM cours.ligcdes ligcdes
       INNER JOIN cours.produits produits
          ON (ligcdes.id_produit = produits.id_produit);

SELECT SUM(produits.prix) * ligcdes.qte as total FROM cours.ligcdes ligcdes INNER JOIN cours.produits produits ON (ligcdes.id_produit = produits.id_produit)WHERE ligcdes.id_cde = 1; 