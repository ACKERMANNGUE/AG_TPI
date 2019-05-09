<?php
include_once '../inc/inc.all.php';

$r = BrandManager::getAllBrands();
if (count($r) > 0) {
    foreach ($r as $b) {
        echo "Marque : " . $b->label."</br>";
    }
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
