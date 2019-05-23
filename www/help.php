<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once 'server/inc/inc.all.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Gestion des utilisateurs</title>
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

                        <h4 class="heading text-center">Aides disponibles</h4>
                        <fieldset class="well form-horizontal frm">
                            <div class="form-group text-left">
                            <div class="row ">
                                    <div class="col-xs-12 text-center">
                                        <h2 class="titleUserManual linksUserManual">Visiteur</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 id=""><a class="linksUserManual" href="server/userManual/helpBuyProductVisitor.php">Acheter un produit en tant que visiteur</a></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 id=""><a class="linksUserManual" href="server/userManual/helpRegister.php">Inscription</a></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 id=""><a class="linksUserManual" href="server/userManual/helpFilters.php">Utilisation des filtres</a></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <h2 class="titleUserManual linksUserManual">Utilisateur connecté</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-xs-12 lblForm ">
                                            <h2 id=""><a class="linksUserManual" href="server/userManual/helpBuyProductConnectedUser.php">Acheter un produit en tant qu'utilisateur connecté</a></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 id=""><a class="linksUserManual" href="server/userManual/helpCreateAd.php">Création d’une annonce</a></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-xs-12 lblForm ">
                                            <h2 id=""><a class="linksUserManual" href="server/userManual/helpModifyAd.php">Modification d’une annonce</a></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <h2 class="titleUserManual linksUserManual">Administrateur</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-xs-12 lblForm ">
                                            <h2 id=""><a class="linksUserManual" href="server/userManual/helpGestionUser.php">Gestion d’un utilisateur</a></h2>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-xs-12 lblForm ">
                                            <h2 id=""><a class="linksUserManual" href="server/userManual/helpGestionAd.php">Gestion de l'état d'une annonce</a></h2>
                                        </div>
                                    </div>
                                </div>
                        </fieldset>
                    </div>
                </div>

            </div>
        </div>
    </section>
</body>
<script type="text/javascript">
    $(document).ready(function() {



    });
</script>

</html>