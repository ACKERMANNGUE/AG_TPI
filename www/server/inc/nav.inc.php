<?php 
/**
 * Travail TPI Mai 2019
 * @copyright Gawen 2019 - CFPT-Informatique
 * @author Ackermann Gawen gawen.ackrm@edge.ch
 * @version 1.0 
 */
if(isset($_SESSION["ROLE"]) && intval($_SESSION["ROLE"]) == ROLE_USER){
    echo '<nav class="navbar navbar-fixed-top">
    <div class="container">
        <div class="collapse navbar-collapse navDisplay" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-nav">
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="creerAnnonce.php">Créer une annonce</a></li>
                <li><a href="mesAnnonces.php">Mes annonces</a></li>
                <li><a href="deconnexion.php" class="btn btn-yellow">Déconnexion</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>';
}

if(isset($_SESSION["ROLE"]) && intval($_SESSION["ROLE"]) == ROLE_ADMIN){
    echo '<nav class="navbar navbar-fixed-top">
    <div class="container">
        <div class="collapse navbar-collapse navDisplay" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-nav">
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="gestionUtilisateurs.php">Gérer les utilisateurs</a></li>
                <li><a href="gestionAnnonces.php">Gérer les annonces</a></li>
                <li><a href="deconnexion.php" class="btn btn-yellow">Déconnexion</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>';
}

if(!isset($_SESSION["ROLE"])){
    echo '<nav class="navbar navbar-fixed-top">
    <div class="container">
        <div class="collapse navbar-collapse navDisplay" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-nav">
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="connexion.php" class="btn btn-yellow">Connexion</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>';
}

?>