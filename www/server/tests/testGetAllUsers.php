<?php
include_once '../inc/inc.all.php';

$r = UserManager::getUsers();
if (count($r) > 0) {
    foreach ($r as $u) {
        echo "Email : " . $u->email . " Pseudo : " . $u->nickname."</br>";
    }
} else {
    echo "Dommage, c'est pas fonctionnel...";
}
