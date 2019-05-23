<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once 'server/inc/inc.all.php';

$countries = CountryManager::getAllCountries();

if (isset($_POST["btnSend"])) {
    $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pswd = filter_input(INPUT_POST, 'pswd', FILTER_SANITIZE_STRING);

    if (count($nickname) > 0 && count($lastname) > 0 && count($firstname) > 0 && count($country) > 0 && count($phone) > 0 && count($email) > 0 && count($pswd) > 0) {
        $user = new User($email, $nickname, $firstname, $lastname, $phone, $country, ROLE_USER, $pswd, STATUS_USER_BLOCKED);
        if (UserManager::createUser($user)) {

            header("Location:accueil.php");
        }
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Créer une annonce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="server/css/animate.css">
    <link rel="stylesheet" type="text/css" href="server/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="server/css/cardio.css">
    <!-- Main style -->

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

                        <h4 class="heading text-center">Créer son compte</h4>
                        <form class="well form-horizontal frm" action="#" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Pseudo</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="nickname" placeholder="Pseudonyme" class="form-control" required="true" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Nom de famille</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="lastname" placeholder="Nom de famille" class="form-control" required="true" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Prénom</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="firstname" placeholder="Prénom" class="form-control" required="true" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Pays</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm">
                                            <select class="form-control" name="country">
                                                <?php foreach ($countries as $c) : ?>
                                                    <option value=<?= '"' . $c->isocode . '"' ?>>
                                                        <?= $c->label ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">N° de téléphone</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="phone" placeholder="07912376589" class="form-control" required="true" type="text" maxlength="10"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Email</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="email" placeholder="votre@email.cc" class="form-control" required="true" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Mot de passe</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="pswd" class="form-control" required="true" type="password"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm"></label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input name="btnSend" class="form-control" required="true" type="submit" value="Créer mon compte !"></div>
                                    </div>
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