<?php
/* Pour avoir accès aux sessions quasiment partout */
session_start();





include_once __DIR__. '/../Constants/constants.php';

/* Connexion à la Base de données */

include_once __DIR__. '/../database/database.php';

/* Config pour swiftMailer */
include_once __DIR__. '/../config/mailparam.php';
include_once __DIR__. '/../swiftmailer5/lib/swift_required.php';

/* Classes utilisées */

include_once __DIR__. '/../model/Ad.php';
include_once __DIR__. '/../model/Brand.php';
include_once __DIR__. '/../model/Country.php';
include_once __DIR__. '/../model/Gender.php';
include_once __DIR__. '/../model/Model.php';
include_once __DIR__. '/../model/Role.php';
include_once __DIR__. '/../model/Size.php';
include_once __DIR__. '/../model/State.php';
include_once __DIR__. '/../model/User.php';
include_once __DIR__. '/../model/Picture.php';
include_once __DIR__. '/../model/Status.php';



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
include_once __DIR__. '/../manager/StatusManager.php';
include_once __DIR__. '/../manager/SessionManager.php';
include_once __DIR__. '/../manager/MailManager.php';

?>
