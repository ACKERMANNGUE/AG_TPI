<?php
include_once 'server/inc/inc.all.php';

if ($_SESSION["ROLE"] != ROLE_ADMIN) {
    header("Location:accueil.php");
}


$ads = AdManager::getAds();
$states = StateManager::getAllStates();

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
            <div class="row services">
                <?php foreach ($ads as $ad) : ?>
                    <div class="col-md-4">
                        <div class="servicesGestion">
                            <div class="card-img-top">
                                <a href='detailsAnnonce.php?idAd=<?= $ad->id ?>'>
                                    <img class="imgProduct" src='<?php
                                                                    $pic = PictureManager::getPicturesForAnAd($ad->id);
                                                                    echo $pic[0]->img;
                                                                    ?>' alt='imgOfProduct' <?= $ad->nickname . '"' ?> class="icon">
                                </a>
                            </div>
                            <h4 class="heading"><?= $ad->title ?></h4>
                            <p class="description row">
                                <span class="col-xs-6"> Marque : <?= BrandManager::getBrandsName($ad->brand) ?></span>
                                <span class="col-xs-6"> Posté par : <?= $ad->nickname ?></span>
                                <span class="col-xs-6">Prix : <?= $ad->price ?> CHF</span>
                                <span class="col-xs-6"><?= StateManager::getStatesName($ad->state) ?></span>
                                <span class="col-xs-12"><button id="<?= $ad->id ?>" class="btn btn-yellow btnGestion" onClick="DisplayDropdown(this.id);">...</button></span>
                                <span class="col-xs-12" hidden>
                                    <select id="select<?= $ad->id ?>" class="form-control displaySelect" name="state">
                                        <?php foreach ($states as $s) {
                                            if ($s->code === $ad->state) {
                                                echo '<option value="' . $s->code . '" selected="selected">' . $s->label . '</option>';
                                            } else {
                                                echo '<option value="' . $s->code . '">
                                                        ' . $s->label . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </span>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        var flag = false;

    });

    function DisplayDropdown(id) {
        var select = $("#select" + id).parent();
        select.slideToggle(350);
        $('select').on('change', function() {
            idAd =  parseInt(id);
            idState = parseInt($(this).val());
            setState4Ad(idAd, idState);
        });
    }
    /**
     * Modifie l'état d'une annonce
     * @var int L'id de l'annonce
     * @var int L'id de l'état
     * @returns string Message de confirmation de modification
     */
    function setState4Ad(a, s) {
        $.ajax({
            type: 'POST',
            url: 'server/ajax/ajaxModifyAdsState.php',
            dataType: 'json',
            data: {
                "idAd": a,
                "idState": s
            },
            success: function(returnedData) {
                var res = returnedData;

            },
            error: function(xhr, tst, err) {
                console.log(err);
            }
        });
    }
    
</script>

</html>