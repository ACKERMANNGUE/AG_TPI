<?php
include_once 'server/inc/inc.all.php';

$idAd = filter_input(INPUT_GET, "idAd", FILTER_SANITIZE_NUMBER_INT);

$ad = AdManager::getAdById($idAd);
$pictures = PictureManager::getPicturesForAnAd($idAd);
$user = UserManager::getUserByNickname($ad->nickname);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Détail du produit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="server/css/animate.css">
    <link rel="stylesheet" type="text/css" href="server/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="server/css/cardio.css">
    <!-- Main style -->

</head>

<body>
    <nav class="navbar navbar-fixed-top">
        <div class="container">
            <div class="collapse navbar-collapse navDisplay" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">
                    <li><a href="#intro">Accueil</a></li>
                    <li><a href="#services">Créer une annonce</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-yellow">Déconnexion</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <section id="services" class="section section-padded">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">

                        <form class="well form-horizontal detailAd" action="#" method="POST" enctype="multipart/form-data">
                            <fieldset id="flds">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img class="imgDetailsProduct" src=<?= $pictures[0]->img ?> alt="" />
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="col-xs-12 lblForm text-center">
                                            <h2 id="title"><?= $ad->title ?></h2>
                                        </div>
                                        <div class="col-xs-12 lblForm">
                                            <p class="text-justify"><?= $ad->description ?></p>
                                        </div>

                                        <div class="col-xs-6 lblForm text-left">
                                            <h4>Marque : <?= BrandManager::getBrandsName($ad->brand) ?></h4>
                                        </div>
                                        <div class="col-xs-6 lblForm  text-right">
                                            <h4>Taille : <?= SizeManager::getSizesName($ad->size) ?></h4>
                                        </div>
                                        <div class="col-xs-6 lblForm text-left">
                                            <h4>Modèle : <?= ModelManager::getModelsName($ad->model) ?></h4>
                                        </div>
                                        <div class="col-xs-6 lblForm  text-right">
                                            <h4>Type : <?= GenderManager::getGenderName($ad->gender) ?></h4>
                                        </div>
                                        <div class="col-xs-6 lblForm text-left">
                                            <h4>Pays : <?= CountryManager::getCountrysName($user->country) ?></h4>
                                        </div>
                                        <div class="col-xs-6 lblForm text-right">
                                            <h4><?= GenderManager::getGenderName($ad->price) ?>CHF</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 lblForm">
                                                <div class="col-xs-12 lblForm"><input id="btnBuy" type="submit" name="btnBuy" value="Acheter !" /></div>
                                                <h5 id="dtPosted" class="col-xs-12 text-right">Mis en vente le <?= date("d/m/Y", strtotime($ad->postingDate)) ?></h5>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 imgDetails">
                                        <p></p>
                                        <div class="col-md-4">
                                            <?php if (count($pictures) > 1) {
                                                echo '<img class="imgSmaller" src="' . $pictures[1]->img . '" alt="" />';
                                            } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php if (count($pictures) > 2) {
                                                echo '<img class="imgSmaller" src=' . $pictures[2]->img . ' alt="" />';
                                            } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php if (count($pictures) > 3) {
                                                echo '<img class="imgSmaller" src=' . $pictures[3]->img . ' alt="" />';
                                            } ?>
                                        </div>

                                    </div>

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

</html>