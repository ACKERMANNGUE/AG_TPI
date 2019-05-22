<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
$idAd = 14;
?>
<!DOCTYPE html>
<html>

<head>
	<title>PAGE DE TEST</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../dhtmlxSuite/codebase/dhtmlx.js"></script>
	<link rel="stylesheet" type="text/css" href="../dhtmlxSuite/codebase/fonts/font_roboto/roboto.css">
	<link rel="stylesheet" type="text/css" href="../dhtmlxSuite/codebase/dhtmlx.css">
	<link rel="stylesheet" type="text/css" href="../css/animate.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/cardio.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="../Constants/constants.js"></script>
</head>

<body onload="doOnLoad();" onunload="doOnUnload();">
	<div id="vp"></div>
	<div id="controls"><button id="btnBuy">Acheter</button></div>
	<div id="succes"></div>
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
		w1.button("park").disable();
		w1.button("minmax").disable();
		w1.setText("Achat de l'article");
		w1.denyResize();
		//Ajout du formulaire dans la fenêtre
		myForm = w1.attachForm(formData, true);
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
			url: '../ajax/ajaxBuyProductSendMailToOwnerForProduct.php',
			dataType: 'json',
			data: {
				"idAd": idAd,
				"emailPurchaser": email,
				"phone": phone
			},
			success: function(returnedData) {
				var msg = returnedData.Message;
				$("#succes").append("<p>" + msg + " Vous pouvez fermer cette fenêtre." + "</p>")
			},
			error: function(xhr, tst, err) {
				console.log(err);
			}
		});
	}
</script>

</html>