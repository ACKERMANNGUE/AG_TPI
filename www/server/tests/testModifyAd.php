<?php
include_once '../inc/inc.all.php';

$user = new User("romain.prtt@eduge.ch", "ROROBocop", "Romain", "Peretti", "0788888888", "CH", 1, "lala");
$ad = new Ad(13, $user->nickname, "Annonce de test", "Voici une annonce se créant dans le fichier de test pour la modification", 1, 2, 3, 4, 5, 25, null);


if (AdManager::modifyAd($ad)) {
    echo "Trop bien, ça fonctionne !";
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
