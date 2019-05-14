<?php
include_once 'server/inc/inc.all.php';

if($_SESSION["ROLE"] != ROLE_USER){
    header("Location:accueil.php");
}

$ads = AdManager::getAdsFromUser($_SESSION["NICKNAME"]);
if($ads == null){
    $ads = [];
}
?>
<!DOCTYPE html>
<html>

<head>
<title>Mes annonces</title>
    <?php include_once "server/inc/head.inc.php"; ?>
</head>
</head>

<body>
<?php 
	include_once "server/inc/nav.inc.php";
	?>
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