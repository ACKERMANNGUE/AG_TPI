<?php
include_once '../inc/inc.all.php';
$id = 14;
$r = AdManager::getAdsUsersNickname($id);
if ($r != false) {
        echo "Annonce de : " . $r ."</br>";
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
