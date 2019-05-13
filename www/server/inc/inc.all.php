<?php
/* Pour avoir accès aux sessions quasiment partout */
session_start();

/* Pour éviter de se reconnecter tout le temps TODO : Enlever quand inutile */ 
$_SESSION["NICKNAME"] = "ACKERMANNGUE";

/* Connexion à la Base de données */

include_once __DIR__. '/../database/database.php';

/* Classes utilisées */

include_once __DIR__. '/../Ad.php';
include_once __DIR__. '/../Brand.php';
include_once __DIR__. '/../Country.php';
include_once __DIR__. '/../Gender.php';
include_once __DIR__. '/../Model.php';
include_once __DIR__. '/../Role.php';
include_once __DIR__. '/../Size.php';
include_once __DIR__. '/../State.php';
include_once __DIR__. '/../User.php';
include_once __DIR__. '/../Picture.php';


/* Managers des classes utilisées */
include_once __DIR__. '/../manager/UserManager.php';
include_once __DIR__. '/../manager/AdManager.php';
include_once __DIR__. '/../manager/BrandManager.php';
include_once __DIR__. '/../manager/CountryManager.php';
include_once __DIR__. '/../manager/GenderManager.php';
include_once __DIR__. '/../manager/ModelManager.php';
include_once __DIR__. '/../manager/SizeManager.php';
include_once __DIR__. '/../manager/StateManager.php';
include_once __DIR__. '/../manager/PictureManager.php';



?>