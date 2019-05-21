<?php

require_once '../inc/inc.all.php';

// Nécessaire lorsqu'on retourne du json
header('Content-Type: application/json');

$minPrice = null;
if (isset($_GET["minPrice"]) && $_GET["minPrice"] != "" && $_GET["minPrice"] != "unset") {
    $minPrice = filter_input(INPUT_GET, 'minPrice', FILTER_SANITIZE_NUMBER_INT);
}
$maxPrice = null;
if (isset($_GET["maxPrice"]) && $_GET["maxPrice"] != "" && $_GET["maxPrice"] != "unset") {
    $maxPrice = filter_input(INPUT_GET, 'maxPrice', FILTER_SANITIZE_NUMBER_INT);
}
$brand = null;
if (isset($_GET["brand"]) && $_GET["brand"] != "" && $_GET["brand"] != "unset") {
    $brand = filter_input(INPUT_GET, 'brand', FILTER_SANITIZE_NUMBER_INT);
}
$model = null;
if (isset($_GET["model"]) && $_GET["model"] != "" && $_GET["model"] != "unset") {
    $model = filter_input(INPUT_GET, 'model', FILTER_SANITIZE_NUMBER_INT);
}
$size = null;
if (isset($_GET["size"]) && $_GET["size"] != "" && $_GET["size"] != "unset") {
    $size = filter_input(INPUT_GET, 'size', FILTER_SANITIZE_NUMBER_INT);
}
$type = null;
if (isset($_GET["gender"]) && $_GET["gender"] != "" && $_GET["gender"] != "unset") {
    $type = filter_input(INPUT_GET, 'gender', FILTER_SANITIZE_NUMBER_INT);
}
$state = null;
if (isset($_GET["state"]) && $_GET["state"] != "" && $_GET["state"] != "unset") {
    $state = filter_input(INPUT_GET, 'state', FILTER_SANITIZE_NUMBER_INT);
}
$arrResult = [];
$states = StateManager::getAllStates();
$ads = AdManager::getAdsWithFilter($minPrice, $maxPrice, $brand, $model, $size, $type, $state);
if ($ads != false) {

    foreach ($ads as $ad) {
        $informations = array("id" => 0, "title" => "", "nickname" => "", "brand" => "", "price" => 0, "state" => 0, "picture" => "");
        $informations["id"] =  $ad->id;
        $informations["nickname"] = $ad->nickname;
        $informations["title"] = $ad->title;
        $informations["brand"] = BrandManager::getBrandsName($ad->brand);
        $informations["price"] = $ad->price;
        $informations["state"] = $ad->state;
        $pictures = PictureManager::getPicturesForAnAd($ad->id);
        $informations["picture"] = $pictures[0]->img;
        array_push($arrResult, $informations);
    }
}
if ($arrResult != null) {
    echo '{ "ReturnCode": 0, "Ads": ' . json_encode($arrResult) . ', "States":' . json_encode($states) . '}';
    exit();
} else {
    echo '{ "ReturnCode": 2, "Message": "Erreur lors du chargement des annonces"}';
    exit();
}
