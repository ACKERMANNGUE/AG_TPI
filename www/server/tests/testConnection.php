<?php 
include_once '../inc/inc.all.php';

$user = new User("romain.prtt@eduge.ch", "ROROBocop", "Romain", "Peretti", "0788888888", "CH", 1, "lala");

if(UserManager::Connection($user->email, $user->pswd)){
    echo "Trop bien, ça fonctionne !";
}else{
    echo "Dommage, c'est pas fonctionnel...";
}