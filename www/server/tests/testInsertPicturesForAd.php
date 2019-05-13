<?php
include_once '../inc/inc.all.php';


$ad = AdManager::getAdById(9);
if(isset($_POST["btnSend"])){
    PictureManager::insertPicturesForAd($ad->id);
}
?>

<form class="well form-horizontal frmCreateAd" action="#" method="POST" enctype="multipart/form-data">
<input type="file" class="form-control picture" name="filesToUpload[]" multiple accept="image/*" />
<input id="price" name="btnSend" class="form-control" required="true" value="Créer mon annonce !" type="submit">
</form>