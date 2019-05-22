<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once 'server/inc/inc.all.php';

$idAd = filter_input(INPUT_GET, "idAd", FILTER_SANITIZE_NUMBER_INT);

$ad = AdManager::getAdById($idAd);
$pictures = PictureManager::getPicturesForAnAd($idAd);
$picCover = "";
$secondPic = "";
$thirdPic = "";
$fourthPic = "";
if (count($pictures) > 0) {
    $picCover = $pictures[0]->img;
    if (count($pictures) > 1) {
        $secondPic = $pictures[1]->img;
    }
    if (count($pictures) > 2) {
        $thirdPic = $pictures[2]->img;
    }
    if (count($pictures) > 3) {
        $fourthPic = $pictures[3]->img;
    }
}
$user = UserManager::getUserByNickname($ad->nickname);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Détail du produit</title>
    <?php include_once "server/inc/head.inc.php"; ?>
</head>

<body onload="doOnLoad();" onunload="doOnUnload();">
    <?php
    include_once "server/inc/nav.inc.php";
    ?>
    <div id="vp">
        <section id="services" class="section section-padded">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">


                            <fieldset id="flds">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img class="imgDetailsProduct" src=<?= $picCover ?> alt="" />
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
                                                <?=
                                                    (intval($ad->state) == STATE_TOSELL) ? '<div class="col-xs-12 lblForm"><input id="btnBuy" type="submit" name="btnBuy" value="Acheter !"/></div>' : "";
                                                ?>
                                                <h5 id="dtPosted" class="col-xs-12 text-right">Mis en vente le <?= date("d/m/Y", strtotime($ad->postingDate)) ?></h5>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 imgDetails">
                                        <div id="succes"></div>
                                        <div class="col-md-4">
                                            <?php if (count($pictures) > 1) {
                                                echo '<img class="imgSmaller" src="' . $secondPic . '" alt="" />';
                                            } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php if (count($pictures) > 2) {
                                                echo '<img class="imgSmaller" src=' . $thirdPic . ' alt="" />';
                                            } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php if (count($pictures) > 3) {
                                                echo '<img class="imgSmaller" src=' . $fourthPic . ' alt="" />';
                                            } ?>
                                        </div>

                                    </div>

                                </div>
                        </div>
                        </fieldset>

                    </div>
                </div>

            </div>
    </div>
    </section>
    </div>
</body>
<script>
    var email, phone;
    var myForm, formData;
    var dhxWins, w1;

    $("#btnBuy").on("click", function() {
        //Changement d'état
        oldMode = mode;
        showWindow(WINDOW_ID, !oldMode);
        mode = !oldMode;
    }); //# end onclick

    $(document).ready(function() {
        mode = false;

    }); //# end document.ready
    //Fonction chargeant la fenêtre
    function doOnLoad() {
        formData = [{
                type: "settings",
                position: "label-left",
                labelWidth: 100,
                inputWidth: 120
            },
            {
                type: "block",
                inputWidth: "auto",
                offsetTop: 12,
                list: [{
                        type: "input",
                        label: "Email : ",
                        name: "email"
                    },
                    {
                        type: "input",
                        label: "N° de Téléphone : ",
                        name: "phone"
                    },
                    {
                        type: "button",
                        value: "Acheter",
                        name: "btnBuy",
                        offsetLeft: 70,
                        offsetTop: 14
                    }
                ]
            }
        ];
        //Création de la fenêtre
        dhxWins = new dhtmlXWindows();
        dhxWins.attachViewportTo("vp");
        w1 = dhxWins.createWindow(WINDOW_ID, 10, 10, 300, 250);
        w1.setPosition(1220, 550);
        w1.button("park").disable();
        w1.button("minmax").disable();

        w1.setText("Achat de l'article");
        w1.denyResize();
        //Ajout du formulaire dans la fenêtre
        myForm = w1.attachForm(formData, true);
        <?php
        if (SessionManager::GetNickname() != false) {
            echo 'myForm.setItemValue("email", "' . UserManager::getUserByNickname(SessionManager::GetNickname())->email . '");';
            echo 'myForm.setReadonly("email", true);';
        }
        ?>
        myForm.attachEvent("onButtonClick", function() {
            email = this.getItemValue("email");
            phone = this.getItemValue("phone");
            if (email.length > 0) {
                if (phone.length == 0) {
                    phone = "";
                }
                buyProduct(<?= $idAd ?>, email, phone);
                //Fermeture de la fenêtre après l'achat
                showWindow(WINDOW_ID, false);
            }
        }); //# end attachEvent
        showWindow(WINDOW_ID, false);
    }
    //Fonction déchargeant la fenêtre
    function doOnUnload() {
        if (dhxWins != null && dhxWins.unload != null) {
            dhxWins.unload();
            dhxWins = w1 = w2 = w3 = null;
        }
    }
    //Fonction gérant l'affichage de la fenêtre
    function showWindow(id, mode) {
        if (mode == true) {
            dhxWins.window(id).show();
        } else {
            dhxWins.window(id).hide();
        }
    }

    /**
    Fonction récupérant les annonces en fonction du filtre appliqué
    * @param int L'id de l'annonce
    * @param string l'email de l'utilisateur souhaitant acheter le produit
    * @param string le N° de téléphone de l'utilisateur souhaitant acheter le produit (non obligatoire)
     */
    function buyProduct(idAd, email, phone = null) {
        $.ajax({
            type: 'POST',
            url: 'server/ajax/ajaxBuyProductSendMailToOwnerForProduct.php',
            dataType: 'json',
            data: {
                "idAd": idAd,
                "emailPurchaser": email,
                "phone": phone
            },
            success: function(returnedData) {
                var msg = returnedData.Message;
                $("#succes").append("<p>" + msg + "</p>");
            },
            error: function(xhr, tst, err) {
                console.log(err);
            }
        });
    }
</script>

</html>