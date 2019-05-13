<?php
include_once '../inc/inc.all.php';


$pictures = PictureManager::getPicturesForAnAd(9);

foreach($pictures as $p){
    echo '<img src="'.$p->img.'" alt="..."/>';
}
