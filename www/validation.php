<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once 'server/inc/inc.all.php';
$email = "";
$token = "";
if (isset($_GET["token"]) && isset($_GET["email"])) {
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $token = filter_input(INPUT_GET, "token", FILTER_SANITIZE_STRING);
}
$nickname = UserManager::getUserByEmail($email)->nickname;
if (UserManager::getTokenAndDateExpiration($nickname, $dateExpiration, $tokenUser))
$dateExpiration = strtotime($dateExpiration);
if ($tokenUser === $token && $dateExpiration > strtotime("now")) {
    if(UserManager::modifyUsersStatus($nickname, STATUS_USER_VALIDATED)){
        header("Location: accueil.php");
    }
    
}
?>
<!DOCTYPE html>
<html>

<head>
<title>Connexion</title>
    <?php include_once "server/inc/head.inc.php"; ?>
</head>

<body>
    <?php
    include_once "server/inc/nav.inc.php";
    ?>
    <section id="services" class="section section-padded">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="createAd">

                        <h4 class="heading text-center">Se connecter</h4>
                        <form class="well form-horizontal frm" action="#" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Email</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="email" placeholder="votre@email.cc" class="form-control" required="true" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Mot de passe</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="pwd" class="form-control" required="true" type="password"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm"></label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="btnSend" class="form-control" required="true" type="submit" value="Connexion !"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <a href="inscription.php">Pas encore de compte ? Clique moi desssus pour t'inscrire !</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</body>

</html>