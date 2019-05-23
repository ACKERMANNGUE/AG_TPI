<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once 'server/inc/inc.all.php';

if (SessionManager::GetRole() != ROLE_ADMIN) {
    header("Location:accueil.php");
}


$ads = AdManager::getAds();
$ads = AdManager::getAds();
$brands = BrandManager::getAllBrands();
$countries = CountryManager::getAllCountries();
$genders = GenderManager::getAllGenders();
$models = ModelManager::getAllModels();
$sizes = SizeManager::getAllSizes();
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
            <div class="row filter">
                <label class="col-md-2 lbl">Prix allant de</label>
                <input type="number" id="priceMin" class="input col-md-2" placeholder="Valeur Minimum" min="0"/>
				<label class="col-md-1 lbl">à</label>
				<input type="number" id="priceMax" class="input col-md-1" placeholder="Valeur Maximum" />
                <label class="col-md-1 control-label lbl to">Marque</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="selectFilter" name="brand" id="brand">
                            <option value="unset" selected="selected">Choisissez une marque</option>
                            <?php foreach ($brands as $b) {
                                echo '<option value="' . $b->code . '">
                                                        ' . $b->label . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                </div>


                <label class="col-md-2 lbl">Modèle</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="selectFilter" name="model" id="model">
                            <option value="unset" selected="selected">Choisissez un modèle</option>
                            <?php foreach ($models as $m) {
                                echo '<option value="' . $m->code . '">
                                                        ' . $m->label . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <label class="col-md-2 lbl">Taille</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="selectFilter" name="size" id="size">
                            <option value="unset" selected="selected">Choisissez une taille</option>
                            <?php foreach ($sizes as $s) {
                                echo '<option value="' . $s->code . '">
                                                        ' . $s->label . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                </div>

                <label class="col-md-2 lbl">Type</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="selectFilter" name="type" id="type">
                            <option value="unset" selected="selected">Choisissez un genre</option>
                            <?php foreach ($genders as $g) {
                                echo '<option value="' . $g->code . '">
                                                        ' . $g->label . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <label class="col-md-2 lbl">État</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="selectFilter" name="state" id="state">
                            <option value="unset" selected="selected">Choisissez un état</option>
                            <?php foreach ($states as $s) {
                                echo '<option value="' . $s->code . '">
                                                        ' . $s->label . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>
        <p id="NoRecordSet"></p>


    </section>

</body>
<script type="text/javascript">
    var states;
    $(document).ready(function() {

		$("#btnHelp").click(function(){
			window.open("help.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=1200,height=650");
		});

        getAds(UNSET_VALUE, UNSET_VALUE, UNSET_VALUE, UNSET_VALUE, UNSET_VALUE, UNSET_VALUE, UNSET_VALUE);
        var minPrice = null;
        var maxPrice = null;
        var brand = null;
        var model = null;
        var size = null;
        var gender = null;
        var state = null;
        $("#priceMin").change(function() {
            minPrice = $(this).val();
            getAds(minPrice, maxPrice, brand, model, size, gender, state);
        });
        $("#priceMax").change(function() {
            maxPrice = $(this).val();
            getAds(minPrice, maxPrice, brand, model, size, gender, state);
        });
        $("#brand").change(function() {
            brand = $(this).val();
            getAds(minPrice, maxPrice, brand, model, size, gender, state);
        });
        $("#model").change(function() {
            model = $(this).val();
            getAds(minPrice, maxPrice, brand, model, size, gender, state);
        });
        $("#size").change(function() {
            size = $(this).val();
            getAds(minPrice, maxPrice, brand, model, size, gender, state);
        });
        $("#type").change(function() {
            gender = $(this).val();
            getAds(minPrice, maxPrice, brand, model, size, gender, state);
        });
        $("#state").change(function() {
            state = $(this).val();
            getAds(minPrice, maxPrice, brand, model, size, gender, state);
        });
    });


    function DisplayDropdown(id) {
        var select = $("#select" + id).parent();
        select.slideToggle(350);
        $('select').on('change', function() {
            idAd = parseInt(id);
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


    /**
     * Fonction récupérant les annonces avec leur image de couverture
     */
    function loadAds() {

        $.ajax({
            type: 'GET',
            url: 'server/ajax/ajaxGetAds.php',
            dataType: 'json',
            data: {},
            success: function(returnedData) {
                var ads = returnedData;
                displayAds(ads.Ads);
            },
            error: function(xhr, tst, err) {
                console.log(err);
            }
        });
    }
    /**
    Fonction affichant les annonces
    * @param Array Les données devant être affichées
     */
    function displayAds(ads, states) {
        $(".ads").remove();
        if (ads == null) {
            $("#NoRecordSet").text(NORECORDS);
        } else {
            $("#NoRecordSet").empty();

            for (var i = 0; i < ads.length; i++) {
                    var el = $("#services");

                    var divAd = $('<div class="col-md-3 ads">');
                    var divAdService = $('<div class="servicesGestion">');

                    var detailsAd = $('<a>').attr("href", 'detailsAnnonce.php?idAd=' + ads[i].id);
                    var divImg = $('<div class="card-img-top">');
                    //Ajout d'un car je retourne un JSON Composé de l'Ad et de son image de couverture à la suite
                    var imgProduct = $('<img class="imgProduct">').attr("src", ads[i].picture);

                    var title = $('<h4 class="heading text-center" id="title">').text(ads[i].title);
                    var descriptionRow = $('<p class="description row">');
                    var spanBrand = $('<span class="col-xs-6 brandAndPrice" id="brand">').text(ads[i].brand);
                    var spanPrice = $('<span class="col-xs-6 brandAndPrice" id="price">').text(ads[i].price + "CHF");

                    var spanState = $('<span class="col-xs-6" id="state">');
                    var spanUser = $('<span class="col-xs-6" id="user">').text(ads[i].nickname);

                    var spanBtnModifyState = $(' <span class="col-xs-12"><button id="' +
                        ads[i].id + '" class="btn btn-yellow btnGestion" onClick="DisplayDropdown(this.id);">...</button></span>');
                    var spanSelectModifyState = $('<span class="col-xs-12" hidden>');
                    var SelectModifyState = $('<select id="select' + ads[i].id + '" class="form-control displaySelect" name="state">');
                    var spanSelectOptionModifyStateSelectedValue = '';

                    el.append(divAd);
                    divAd.append(divAdService);

                    divAdService.append(detailsAd);
                    detailsAd.append(divImg);
                    divImg.append(imgProduct);

                    divAdService.append(title);
                    divAdService.append(descriptionRow);

                    descriptionRow.append(spanBrand);
                    descriptionRow.append(spanPrice);
                    descriptionRow.append(spanState);
                    descriptionRow.append(spanUser);
                    descriptionRow.append(spanBtnModifyState);
                    descriptionRow.append(spanSelectModifyState);
                    spanSelectModifyState.append(SelectModifyState);


                    for (var j = 0; j < states.length; j++) {

                        if (ads[i].state == states[j].code) {
                            spanState.text(states[j].label);
                            spanSelectOptionModifyStateSelectedValue = '<option value="' + states[j].code +
                                '" selected="selected">' + states[j].label +
                                '</option>';
                            SelectModifyState.append(spanSelectOptionModifyStateSelectedValue);

                        } else {
                            spanSelectOptionModifyStateSelectedValue = '<option value="' + states[j].code +
                                '">' + states[j].label +
                                '</option>';
                            SelectModifyState.append(spanSelectOptionModifyStateSelectedValue);

                        }
                    }
                
            }
        }
    }
    /**
    Fonction récupérant les annonces en fonction du filtre appliqué
    * @param int Le prix minimum du produit
    * @param int Le prix maximum du produit
    * @param int La marque du produit
    * @param int Le modèle du produit
    * @param int La taille du produit
    * @param int Le type du produit
    * @param int L'état de l'annonce
     */
    function getAds(minPrice, maxPrice, brand, model, size, gender, state) {
        $.ajax({
            type: 'GET',
            url: 'server/ajax/ajaxGetAds.php',
            dataType: 'json',
            data: {
                "minPrice": minPrice,
                "maxPrice": maxPrice,
                "brand": brand,
                "model": model,
                "size": size,
                "gender": gender,
                "state": state
            },
            success: function(returnedData) {
                var ads = returnedData.Ads;
                var states = returnedData.States;
                displayAds(ads, states);

            },
            error: function(xhr, tst, err) {
                console.log(err);
            }
        });
    }
</script>

</html>