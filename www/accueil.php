<?php
include_once 'server/inc/inc.all.php';

$ads = AdManager::getAds();

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Accueil</title>
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
			<div class="row services">
				<?php foreach ($ads as $ad) : ?>
					<div class="col-md-4">
						<div class="service">
							<div class="card-img-top">
								<img class="imgProduct" src="server/imgProduct/Nike_T-Shirt_Junior.jpg" alt="" class="icon">
							</div>
							<h4 class="heading text-center"><?= $ad->title ?></h4>
							<p class="description row">
								<span class="col-xs-6"> Marque : <?= BrandManager::getBrandsName($ad->brand) ?></span>
								<span class="col-xs-6">Prix : <?= $ad->price ?> CHF</span>
							</p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</body>

</html>