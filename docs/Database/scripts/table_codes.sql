
/*
Données pour la table des rôles
*/
INSERT INTO `schema_secondhand`.`roles` (`CODE`, `LABEL`) VALUES ('1', 'Utilisateur');
INSERT INTO `schema_secondhand`.`roles` (`CODE`, `LABEL`) VALUES ('2', 'Administrateur');

/*
Données pour la table des genres
*/
INSERT INTO `schema_secondhand`.`genders` (`CODE`, `LABLE`) VALUES ('1', 'Femme');
INSERT INTO `schema_secondhand`.`genders` (`CODE`, `LABLE`) VALUES ('2', 'Homme');
INSERT INTO `schema_secondhand`.`genders` (`CODE`, `LABLE`) VALUES ('3', 'Unisexe');

/*
Données pour la table des différents modèles d'habits
*/
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('1', 'T-Shirt');
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('2', 'Pull-Over');
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('3', 'Sweatshirt');
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('4', 'Short');
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('5', 'Chemise');
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('6', 'Pantalon');
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('7', 'Polo');
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('8', 'Veste');
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('9', 'K-Way');
INSERT INTO `schema_secondhand`.`models` (`CODE`, `LABEL`) VALUES ('10', 'Manteau');

/*
Données pour la table des différentes marques
*/
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('1', 'Nike');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('2', 'Puma');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('3', 'Adidas');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('4', 'Obey');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('5', 'H&M');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('6', 'Balmain');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('7', 'Pépé Jeans');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('8', 'Champion');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('9', 'Reebok');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('10', 'Ralph Lauren');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('11', 'Levis');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('12', 'Fila');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('13', 'Tommy Hilfiger');
INSERT INTO `schema_secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('14', 'K-Way');

/*
Données pour la table des différentes tailles d'habits
*/
INSERT INTO `schema_secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('1', 'XS');
INSERT INTO `schema_secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('2', 'S');
INSERT INTO `schema_secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('3', 'M');
INSERT INTO `schema_secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('4', 'L');
INSERT INTO `schema_secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('5', 'XL');
INSERT INTO `schema_secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('6', 'XXL');

/*
Données pour la table des différentes états possible pour une annonce
*/
INSERT INTO `schema_secondhand`.`states` (`CODE`, `LABEL`) VALUES ('1', 'À vendre');
INSERT INTO `schema_secondhand`.`states` (`CODE`, `LABEL`) VALUES ('2', 'Vendue');
INSERT INTO `schema_secondhand`.`states` (`CODE`, `LABEL`) VALUES ('3', 'En cours de vente');
INSERT INTO `schema_secondhand`.`states` (`CODE`, `LABEL`) VALUES ('4', 'Supprimée');
INSERT INTO `schema_secondhand`.`states` (`CODE`, `LABEL`) VALUES ('5', 'Suspendue');

/*
Données pour la table des différents status possible pour un utilisateur
*/
INSERT INTO `schema_secondhand`.`status` (`CODE`, `LABEL`) VALUES ('1', 'Validé');
INSERT INTO `schema_secondhand`.`status` (`CODE`, `LABEL`) VALUES ('2', 'Bloqué');
