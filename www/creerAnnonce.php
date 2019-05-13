<?php
include_once 'server/inc/inc.all.php';

$brands = BrandManager::getAllBrands();
$countries = CountryManager::getAllCountries();
$genders = GenderManager::getAllGenders();
$models = ModelManager::getAllModels();
$sizes = SizeManager::getAllSizes();
$states = StateManager::getAllStates();

if(isset($_POST["btnSend"])){
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $size = $_POST["size"];
    $type = $_POST["type"];
    $state = $_POST["state"];
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);

    if(count($title) > 0 && count($description) > 0 &&count($brand) > 0 &&count($model) > 0 &&count($size) > 0 &&count($type) > 0){
        $Ad = new Ad(null, $_SESSION["NICKNAME"] ,$title,$description,$type, $size, $brand, $model, $state, $price, null);
        if(AdManager::createAd($Ad)){
            echo "Annonce créée";
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
                    <div class="createAd">

                        <h4 class="heading text-center">Créer une annonce</h4>
                        <form class="well form-horizontal frmCreateAd" action="#" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Titre</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input id="title" name="title" placeholder="Titre de l'annonce" class="form-control" required="true" value="" type="text"></div>
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
                                            <select class="form-control" name="brand">
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
                                            <select class="form-control" name="model">
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
                                            <select class="form-control" name="size">
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
                                            <select class="form-control" name="type">
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
                                            <select class="form-control" name="state">
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
                                        <div class="input-group inputForm"><input id="price" name="price" placeholder="0" class="form-control" required="true" value="" type="text"></div>
                                    </div>
                                </div>
                                <!--  Changer pour accepter les images !-->
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Photo (Min. 1)</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="col-sm "><input type="file" class="form-control picture" name="filesToUpload[]" multiple accept="image/*" /></div>
                                    </div>
                                </div>
                                <div class="form-group grpBtnSend">
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input id="price" name="btnSend" class="form-control" required="true" value="Créer mon annonce !" type="submit"></div>
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