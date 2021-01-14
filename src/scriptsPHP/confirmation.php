<?php
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
            <div class="col-lg-6 offset-3">
                <h2 class="display-4">F&eacute;licitation!</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-3">
               <p class="lead"> <?php echo "La demande d'adoption pour " . $_GET["nom"] . " a &eacute;t&eacute;
         envoy&eacute;e avec succ&egrave;s!"; ?>
               </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-3">
                <h3 class="display-4">R&eacute;vision :</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-3">
                <p class="lead"> <?php echo "Type de l'animal : " . $_GET["type"] . "<br>" .
                        "Race de l'animal : " . $_GET["race"] . "<br>" .
                        "Age : " . $_GET["age"] . "<br>" .
                        "Description : " . $_GET["desc"] . "<br>" .
                        "Courriel personne-ressource : " . $_GET["courriel"] . "<br>" .
                        "Adresse civique : " . $_GET["adresse"] . "<br>" .
                        "Ville : " . $_GET["ville"] . "<br>" .
                        "Code Postal : " . $_GET["cp"] . "<br>"; ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 offset-3">
                <h2 class="display-5">Nos animaux vous remercient de votre compassion.</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-3">
                <img class="img-thumbnail" src="../images/chienCute.jpg" alt="chien-remerciement">
            </div>
        </div>

    </main>
</div>
<script src="../vendor/JS/jquery-3.5.1.min.js"></script>
<script src="../vendor/JS/bootstrap.min.js"></script>
</body>
</html>
