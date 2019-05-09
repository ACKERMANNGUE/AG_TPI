<?php
include_once '../inc/inc.all.php';

$r = CountryManager::getAllCountries();
if (count($r) > 0) {
    foreach ($r as $b) {
        echo "Pays : " . $b->label . "</br>";
    }
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
