<?php 
include_once '../inc/inc.all.php';

$user = new User("romain.prtt@eduge.ch", "ROROBocop", "Romain", "Peretti", "0788888888", "CH", 1, "lala");
$a = $user;
if(UserManager::createUser($user)){
    echo "Trop bien, ça fonctionne !";
}else{
    echo "Dommage, c'est pas fonctionnel...";
}