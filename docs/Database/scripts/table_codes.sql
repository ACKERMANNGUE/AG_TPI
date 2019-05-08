
/*
Données pour la table des rôles
*/
INSERT INTO `secondhand`.`roles` (`CODE`, `LABEL`) VALUES ('1', 'Utilisateur');
INSERT INTO `secondhand`.`roles` (`CODE`, `LABEL`) VALUES ('2', 'Administrateur');

/*
Données pour la table des genres
*/
INSERT INTO `secondhand`.`genders` (`CODE`, `LABLE`) VALUES ('1', 'Femme');
INSERT INTO `secondhand`.`genders` (`CODE`, `LABLE`) VALUES ('2', 'Homme');
INSERT INTO `secondhand`.`genders` (`CODE`, `LABLE`) VALUES ('3', 'Unisexe');

/*
Données pour la table des différents modèles d'habits
*/
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('1', 'T-Shirt');
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('2', 'Pull-Over');
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('3', 'Sweatshirt');
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('4', 'Short');
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('5', 'Chemise');
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('6', 'Pantalon');
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('7', 'Polo');
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('8', 'Veste');
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('9', 'K-Way');
INSERT INTO `secondhand`.`models` (`CODE`, `LABEL`) VALUES ('10', 'Manteau');

/*
Données pour la table des différentes marques
*/
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('1', 'Nike');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('2', 'Puma');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('3', 'Adidas');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('4', 'Obey');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('5', 'H&M');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('6', 'Balmain');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('7', 'Pépé Jeans');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('8', 'Champion');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('9', 'Reebok');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('10', 'Ralph Lauren');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('11', 'Levis');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('12', 'Fila');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('13', 'Tommy Hilfiger');
INSERT INTO `secondhand`.`brands` (`CODE`, `LABEL`) VALUES ('14', 'K-Way');

/*
Données pour la table des différentes tailles d'habits
*/
INSERT INTO `secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('1', 'XS');
INSERT INTO `secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('2', 'S');
INSERT INTO `secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('3', 'M');
INSERT INTO `secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('4', 'L');
INSERT INTO `secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('5', 'XL');
INSERT INTO `secondhand`.`sizes` (`CODE`, `LABEL`) VALUES ('6', 'XXL');

/*
Données pour la table des différentes états possible pour une annonce
*/
INSERT INTO `secondhand`.`states` (`CODE`, `LABEL`) VALUES ('1', 'À vendre');
INSERT INTO `secondhand`.`states` (`CODE`, `LABEL`) VALUES ('2', 'Vendue');
INSERT INTO `secondhand`.`states` (`CODE`, `LABEL`) VALUES ('3', 'En cours de vente');
INSERT INTO `secondhand`.`states` (`CODE`, `LABEL`) VALUES ('4', 'Supprimée');
INSERT INTO `secondhand`.`states` (`CODE`, `LABEL`) VALUES ('5', 'Suspendue');
