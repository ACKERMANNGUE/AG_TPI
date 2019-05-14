<?php
include_once 'server/inc/inc.all.php';

$ads = AdManager::getAds();
//$pictures = PictureManager::insertPicturesForAd();
?>
<!DOCTYPE html>
<html>

<head>
	<title>Accueil</title>
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
					<?php if ($ad->state == STATE_TOSELL) : ?>
						<div class="col-md-4">
							<div class="service">
								<div class="card-img-top">
									<a href='detailsAnnonce.php?idAd=<?= $ad->id ?>'>
										<img class="imgProduct" src='<?php
																		$pic = PictureManager::getPicturesForAnAd($ad->id);
																		echo $pic[0]->img;
																		?>' alt='imgOfProduct' <?= $ad->nickname . '"' ?> class="icon">
									</a>
								</div>
								<h4 class="heading text-center"><?= $ad->title ?></h4>
								<p class="description row">
									<span class="col-xs-6"> Marque : <?= BrandManager::getBrandsName($ad->brand) ?></span>
									<span class="col-xs-6">Prix : <?= $ad->price ?> CHF</span>
								</p>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</body>

</html>