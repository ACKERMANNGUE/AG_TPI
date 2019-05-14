<?php
include_once 'server/inc/inc.all.php';

if(!isset($_SESSION["ROLE"])){
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

if (isset($_POST["btnSend"])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $size = $_POST["size"];
    $type = $_POST["type"];
    $state = $_POST["state"];
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
    /* */
    if (count($title) > 0 && count($description) > 0 && count($brand) > 0 && count($model) > 0 && count($size) > 0 && count($type) > 0) {
        $Ad = new Ad($idAd, $_SESSION["NICKNAME"], $title, $description, $type, $size, $brand, $model, $state, $price, null);
        if (AdManager::modifyAd($Ad)) {
            echo "Annonce Modifiée";
            header("Location:mesAnnonces.php");
        }
    }
}

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
                        <form class="well form-horizontal frmCreateAd" action="#" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-xs-6 control-label lblForm">Titre</label>
                                    <div class="col-md-6 inputGroupContainer">
                                        <div class="input-group inputForm"><input id="title" name="title" placeholder="Titre de l'annonce" class="form-control" required="true" value="<?= $ad->title ?>" type="text"></div>
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
                                                <select class="form-control" name="brand">
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
                                                <select class="form-control" name="model">
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
                                                <select class="form-control" name="size">
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
                                                <select class="form-control" name="type">
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
                                                <select class="form-control" name="state">
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
                                            <div class="col-sm"><input type="file" class="form-control picture" name="filesToUpload[]" multiple accept="image/*" /></div>
                                            <div class="col-md-8 imgDetails">
                                                <p class="col-md text-danger text-justify">Attention : Si vous chargez de nouvelles images,
                                                     celles-ci vont écraser celles présentent actuellement.</p>
                                                <div class="col-md-4">
                                                    <?php if (count($pictures) > 0) {
                                                        echo '<img class="imgSmaller" src="' . $pictures[0]->img . '" alt="" />';
                                                    } ?>
                                                </div>
                                                <div class="col-md-4">
                                                    <?php if (count($pictures) > 1) {
                                                        echo '<img class="imgSmaller" src=' . $pictures[1]->img . ' alt="" />';
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

                                    <div class="form-group grpBtnSend">
                                        <div class="col-md-6 inputGroupContainer">
                                            <div class="input-group inputForm"><input id="price" name="btnSend" class="form-control" required="true" value="Modifier mon annonce !" type="submit"></div>
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