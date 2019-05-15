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
<title>Détail du produit</title>
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
                                            <h4><?= $ad->price ?> CHF</h4>
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