<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once 'server/inc/inc.all.php';

if (isset($_POST["btnSend"])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pswd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);


    /* Disparaîtra, en attendant la connexion en AJAX */
    if (UserManager::Connection($email, $pswd)) {
        $user = UserManager::getUserByEmail($email);
        SessionManager::SetNickname($user->nickname);
        SessionManager::SetRole(intval($user->role));
        header("Location:accueil.php");
    } else {

        echo '<script>alert("Attention ! Un problème est survenu, il se peut que l\'email et/ou le mot de passe soit incorrect ou il se peut que votre compte ne soit pas encore activé ou bloqué. Allez vérifier votre boîte mail.");</script>';
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
<script>
    $(document).ready(function() {
        $("#btnHelp").click(function() {
            window.open("help.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=1200,height=650");
        });
    });
</script>

</html>