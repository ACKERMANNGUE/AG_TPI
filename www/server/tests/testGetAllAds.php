<?php
include_once '../inc/inc.all.php';

$r = AdManager::getAds();
if (count($r) > 0) {
    foreach ($r as $a) {
        echo "Titre : " . $a->title . " Date de mise en ligne : " . $a->postingDate. " Pseudo du propriétaire de l'annonce : " . $a->nickname."</br>";
    }
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
