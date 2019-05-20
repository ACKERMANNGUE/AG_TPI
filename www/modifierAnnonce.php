<?php
include_once 'server/inc/inc.all.php';

if (SessionManager::GetRole() === false) {
    header("Location:accueil.php");
}

$idAd = filter_input(INPUT_GET, "idAd", FILTER_SANITIZE_NUMBER_INT);

$ad = AdManager::getAdById($idAd);
$pictures = PictureManager::getPicturesForAnAd($idAd);

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
    <title>Modifier une annonce</title>
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
                        <h4 class="heading text-center">Modifier une annonce</h4>
                        <form class="well form-horizontal frmCreateAd" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Titre</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input id="title" name="title" placeholder="Titre de l'annonce" class="form-control" required="true" value="<?= $ad->title ?>" type="text" maxlength="20"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Description</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><textarea id="description" name="description" placeholder="Description de l'annonce" class="form-control" required="true"><?= $ad->description ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Marque</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="brand" id="brand">
                                                    <?php foreach ($brands as $b) {
                                                        if ($b->code === $ad->brand) {
                                                            echo '<option value="' . $b->code . '" selected="selected">' . $b->label . '</option>';
                                                        } else {
                                                            echo '<option value="' . $b->code . '">
                                                        ' . $b->label . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Modèle</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="model" id="model">
                                                    <?php foreach ($models as $m) {
                                                        if ($m->code === $ad->model) {
                                                            echo '<option value="' . $m->code . '" selected="selected">' . $m->label . '</option>';
                                                        } else {
                                                            echo '<option value="' . $m->code . '">
                                                        ' . $m->label . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Taille</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="size" id="size">
                                                    <?php foreach ($sizes as $s) {
                                                        if ($s->code === $ad->size) {
                                                            echo '<option value="' . $s->code . '" selected="selected">' . $s->label . '</option>';
                                                        } else {
                                                            echo '<option value="' . $s->code . '">
                                                        ' . $s->label . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Type</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="type" id="type">
                                                    <?php foreach ($genders as $g) {
                                                        if ($g->code === $ad->gender) {
                                                            echo '<option value="' . $g->code . '" selected="selected">' . $g->label . '</option>';
                                                        } else {
                                                            echo '<option value="' . $g->code . '">
                                                        ' . $g->label . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">État</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm">
                                                <select class="form-control" name="state" id="state">
                                                    <?php foreach ($states as $s) {
                                                        if ($s->code === $ad->state) {
                                                            echo '<option value="' . $s->code . '" selected="selected">' . $s->label . '</option>';
                                                        } else {
                                                            echo '<option value="' . $s->code . '">
                                                        ' . $s->label . '</option>';
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Prix</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm"><input id="price" name="price" placeholder="0" class="form-control" required="true" value="<?= $ad->price ?>" type="text"></div>
                                        </div>
                                    </div>
                                    <!--  Changer pour accepter les images !-->
                                    <div class="form-group">
                                        <label class="col-xs-6 control-label lblForm">Photo (Min. 1)</label>
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="col-sm"><input type="file" id="fileSelect" class="form-control picture" name="filesToUpload" accept="image/*" /></div>
                                            <div class="col-md-8 imgDetails">
                                                <p class="col-md text-danger text-justify">Attention : Veuillez charger les nouvelles images 1 à 1. Pour annuler les suppressions d'images, rafraîchissez la page</p>
                                                <div id="imagePreview">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group grpBtnSend">
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><button type="button" id="btnSend" class="btn btn-yellow">Modifier mon annonce !</button></div>
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
        displayImagesOnLoad();
        $(document).on("click", ".btnDelete", function() {
            $(this).parent().remove();
        });
        $("#btnSend").click(function() {
            var idAd = <?= $idAd ?>;
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
            if (idAd != null && title != null && description != null && brand != null && model != null && gender != null && state != null && price != null && size != null && arrFiles != null) {
                modifyAd(parseInt(idAd), title, description, parseInt(brand), parseInt(model), parseInt(gender), parseInt(state), price, parseInt(size), arrFiles);
            }
        }); //#end btn click

        var imgToDelete;
        $(".btnDelete").click(function() {
            
        });

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
     * @var int L'id de l'annonce
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
    function modifyAd(idAd, title, description, brand, model, gender, state, price, size, pictures) {

        $.ajax({
            type: 'POST',
            url: 'server/ajax/ajaxModifyAd.php',
            dataType: 'json',
            data: {
                "idAd": idAd,
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

            },
            error: function(xhr, tst, err) {
                console.log(err);
            }
        });
    }

    function displayImagesOnLoad() {
        var i;
        $.ajax({
            type: 'POST',
            url: 'server/ajax/ajaxGetPicturesForAd.php',
            dataType: 'json',
            data: {
                "idAd": <?= $idAd ?>
            },
            success: function(returnedData) {
                var r = returnedData.ImageInBase64;
                if (r != null) {
                    for (i = 0; i < r.length; i++) {
                        var el = $("#imagePreview");
                        var divImg = $('<div class="col-md-4">');
                        var divDelete = $('<a class="btn btn-yellow btnDelete" data-index="' + r[i].index + '">X</a>');
                        el.append(divImg);
                        divImg.append(divDelete);
                        var imgEl = $('<img class="imgSmaller" />');
                        imgEl.attr("src", r[i].img);
                        divImg.append(imgEl);
                    }
                }
            },
            error: function(xhr, tst, err) {
                console.log(err);
            }
        });



    }
</script>

</html>