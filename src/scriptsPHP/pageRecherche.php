<?php

function genererAdresseAnimal(){

    return str_replace(" ", "*", "animal.php?nom=" . trim($_GET["nom"]) . "&type=" . trim($_GET["type"])
        . "&race=" . trim($_GET["race"]) ."&age=" . trim($_GET["age"]) . "&desc=" .
       urlencode(trim($_GET["desc"])) . "&courriel=" . trim($_GET["courriel"]) . "&adresse=" .
            trim($_GET["adresse"]) . "&ville=" . trim($_GET["ville"]) . "&cp=" .
            trim($_GET["cp"]));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../vendor/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssFoyerAnimal.css">
    <title>Confirmation Adoption</title>
</head>
<body>
<div class="container-fluid">

    <header>
        <div class="row h-100">
            <div class="col-lg-6 offset-lg-3">
                <h1 class="display-1">Refuge Animal LEC</h1>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-md bg-dark navbar-dark justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="pageAccueil.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../scriptsPHP/formulaire.php">Mise en adoption</a>
            </li>
        </ul>
        <form class="form-inline my-3 my-lg-0">
            <input class="form-control mr-md-2" type="search" placeholder="Recherche" aria-label="Recherche" disabled>
            <button class="btn btn-outline-light my-2 my-md-0" type="submit" disabled>Rechercher</button>
        </form>
    </nav>

    <main>
        <div class="row">
            <div class="col-lg-11 offset-lg-0">
                <h2 class="display-4"><u>R&eacute;sultat de la recherche.</u></h2>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3">
        <div class="col mb-4">
            <div class="card">
                <img src="../images/headerImageTp3.jpg" class="card-img-top" alt="animal_2">
                <div class="card-body">
                    <h5 class="card-title"><?php echo "{$_GET["nom"]}"?></h5>
                    <p class="card-text"><?php echo "" . str_replace("*"," ",$_GET["desc"]) ?></p>
                    <?php echo "<a class='card-link' href=" . genererAdresseAnimal() . ">Description compl&egrave;te</a>"; ?>
                </div>
            </div>
        </div>
        </div>
    </main>
</div>
<script src="../vendor/JS/jquery-3.5.1.min.js"></script>
<script src="../vendor/JS/bootstrap.min.js"></script>
</body>
</html>