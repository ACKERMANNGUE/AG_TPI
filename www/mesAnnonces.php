<?php
include_once 'server/inc/inc.all.php';

$ads = AdManager::getAdsFromUser($_SESSION["NICKNAME"]);
//$pictures = PictureManager::insertPicturesForAd();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mes annonces</title>
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
            <div class="row services">
                <?php foreach ($ads as $ad) : ?>
                    <div class="col-md-4">
                        <div class="service myads">
                            <div class="card-img-top">
                                <a href='detailsAnnonce.php?idAd=<?= $ad->id ?>'>
                                    <img class="imgProduct" src='<?php
                                                                    $pic = PictureManager::getPicturesForAnAd($ad->id);
                                                                    echo $pic[0]->img;
                                                                    ?>' alt='imgOfProduct' <?= $ad->nickname . '"' ?> class="icon">
                                </a>
                            </div>
                            <h4 class="header text-center"><?= $ad->title ?></h4>
                            <p class="description row">
                                <span class="col-xs-6"> Marque : <?= BrandManager::getBrandsName($ad->brand) ?></span>
                                <span class="col-xs-6">Prix : <?= $ad->price ?> CHF</span>
                                <span class="col-md-12 linkButton">
                                    <a class="linkButtonStyle" href="modifierAnnonce.php?idAd=<?= $ad->id ?>">Modifier</a>
                                </span>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</body>

</html>