<?php
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
include_once '../inc/inc.all.php';


$pictures = PictureManager::getPicturesForAnAd(9);

foreach($pictures as $p){
    echo '<img src="'.$p->img.'" alt="..."/>';
}
