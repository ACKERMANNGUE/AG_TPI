<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once 'server/inc/inc.all.php';

if ($_SESSION["ROLE"] != ROLE_USER) {
    header("Location:accueil.php");
}

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
    <title>Créer une annonce</title>
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

                        <h4 class="heading text-center">Créer une annonce</h4>
                        <form class="well form-horizontal frmCreateAd" action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Titre</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input id="title" name="title" placeholder="Titre de l'annonce" class="form-control" required="true" value="" type="text" maxlength="20"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Description</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><textarea id="description" name="description" placeholder="Description de l'annonce" class="form-control" required="true"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Marque</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="brand" id="brand">
                                                    <?php foreach ($brands as $b) : ?>
                                                        <option value=<?= '"' . $b->code . '"' ?>>
                                                            <?= $b->label ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Modèle</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="model" id="model">
                                                    <?php foreach ($models as $m) : ?>
                                                        <option value=<?= '"' . $m->code . '"' ?>>
                                                            <?= $m->label ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Taille</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="size" id="size">
                                                    <?php foreach ($sizes as $s) : ?>
                                                        <option value=<?= '"' . $s->code . '"' ?>>
                                                            <?= $s->label ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Type</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="type" id="type">
                                                    <?php foreach ($genders as $g) : ?>
                                                        <option value=<?= '"' . $g->code . '"' ?>>
                                                            <?= $g->label ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">État</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="state" id="state">
                                                    <?php foreach ($states as $s) : ?>
                                                        <option value=<?= '"' . $s->code . '"' ?>>
                                                            <?= $s->label ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                            </div>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Prix</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm"><input id="price" name="price" placeholder="0" class="form-control" required="true" value="" type="number"></div>
                                        </div>
                                    </div>
                                    <!--  Changer pour accepter les images !-->
                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Photo (Min. 1)</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <p class="col-md text-danger text-justify">Attention : Veuillez charger les images 1 à 1. Pour annuler les suppressions d'images, rafraîchissez la page</p>
                                            <div id="imagePreview">
                                            </div>
                                            <div class="col-sm "><input type="file" id="fileSelect" class="form-control picture" name="filesToUpload" accept="image/*" /></div>
                                            <div id="imagePreview">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group grpBtnSend">
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm"><button type="button" id="btnSend" class="btn btn-yellow">Créer mon annonce !</button></div>
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
<script type="text/javascript">
    $(document).ready(function() {
		$("#btnHelp").click(function(){
			window.open("help.php", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=1200,height=650");
		});
        $(document).on("click", ".btnDelete", function() {
            $(this).parent().remove();
        });

        $("#btnSend").click(function() {

            var title = $("#title").val();
            var description = $("#description").val();
            var brand = 0;
            $("select.brand").change(function() {
                brand = $(this).children("option:selected").val();
            });
            if (brand === 0) {
                brand = $("#brand").val();
            }
            var model = 0;
            $("select.model").change(function() {
                model = $(this).children("option:selected").val();
            });
            if (model === 0) {
                model = $("#model").val();
            }
            var gender = 0;
            $("select.type").change(function() {
                gender = $(this).children("option:selected").val();
            });
            if (gender === 0) {
                gender = $("#type").val();
            }
            var state = 0;
            $("select.state").change(function() {
                state = $(this).children("option:selected").val();
            });
            if (state === 0) {
                state = $("#state").val();
            }
            var size = 0;
            $("select.size").change(function() {
                size = $(this).children("option:selected").val();
            });
            if (size === 0) {
                size = $("#size").val();
            }

            var price = $("#price").val();
            var child = $("#imagePreview").children();
            var arrFiles = [];
            for (var i = 0; i < child.length; i++) {
                var divWithImage = child[i];
                var btn = divWithImage.children[0].currentSrc;

                var imgBase64 = divWithImage.children[1].currentSrc;
                arrFiles.push(imgBase64);
            }
            if (title != null && description != null && brand != null && model != null && gender != null && state != null && price != null && size != null && arrFiles != null) {
                createAd(title, description, parseInt(brand), parseInt(model), parseInt(gender), parseInt(state), price, parseInt(size), arrFiles);
            }
        }); //#end btn click


        // On capture le changement de sélection d'images
        $("#fileSelect").change(function() {
            // On parcoure les fichers
            var file = $(this)[0].files[0];
            var reader = new FileReader();
            reader.addEventListener("load", function() {
                // Ajouter un section pour l'image
                var el = $("#imagePreview");
                var divImg = $('<div class="col-md-4">');
                var divDelete = $('<a class="btn btn-yellow btnDelete">X</a>');
                el.append(divImg);
                divImg.append(divDelete);
                var imgEl = $('<img class="imgSmaller" />');
                imgEl.attr("src", reader.result);
                divImg.append(imgEl);

            }, false);
            if (file) {
                reader.readAsDataURL(file);
            }
        }); //#end select change

    }); //#end document ready

    /**
     * Modifie l'état d'une annonce
     * @var string Le titre de l'annonce
     * @var string La description de l'annonce
     * @var int le code de la marque séléctionnée
     * @var int le code du modèle séléctionné
     * @var int le code du type séléctionné
     * @var int le code de l'état de l'annonce
     * @var int le code de la taille
     * @var string[] Tableau de string, ce sont les images encodées en base64
     * @returns string Message de confirmation de modification
     */
    function createAd(title, description, brand, model, gender, state, price, size, pictures) {

        $.ajax({
            type: 'POST',
            url: 'server/ajax/ajaxCreateAd.php',
            dataType: 'json',
            data: {
                "title": title,
                "description": description,
                "brand": brand,
                "model": model,
                "size": size,
                "gender": gender,
                "state": state,
                "price": price,
                "pictures": pictures
            },
            success: function(returnedData) {
                var res = returnedData;
                if(parseInt(res.ReturnCode) == 0){
                    window.location.href = "mesAnnonces.php"
                }
            },
            error: function(xhr, tst, err) {
                console.log(err);
            }
        });
    }
    
</script>

</html>