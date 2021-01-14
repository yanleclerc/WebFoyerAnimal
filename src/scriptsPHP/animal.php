<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../vendor/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssFoyerAnimal.css">
    <title>Refuge animal LEC</title>
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
                <a class="nav-link" href="formulaire.php">Mise en adoption</a>
            </li>
        </ul>
        <form class="form-inline my-3 my-lg-0">
            <input class="form-control mr-md-2" type="search" placeholder="Recherche" aria-label="Recherche" disabled>
            <button class="btn btn-outline-light my-2 my-md-0" type="submit" disabled>Rechercher</button>
        </form>
    </nav>

    <main>
        <div class="card mb-3">
            <img src="../images/headerImageTp3.jpg" class="card-img-top" alt="animal-vedette">
            <div class="card-body">
                <h5 class="card-title">Animal En Vedette</h5>
                <p class="lead"> <?php echo "Nom de l'animal : " . str_replace("*", " ",$_GET["nom"]) . "<br>" .
                        "Type de l'animal : " . str_replace("*", " ",$_GET["type"]) . "<br>" .
                        "Race de l'animal : " . str_replace("*", " ",$_GET["race"]) . "<br>" .
                        "Age : " . $_GET["age"] . "<br>" .
                        "Description : " . str_replace("*", " ",$_GET["desc"]) . "<br>" .
                        "Courriel personne-ressource : " . $_GET["courriel"] . "<br>" .
                        "Adresse civique : " . str_replace("*", " ",$_GET["adresse"]) . "<br>" .
                        "Ville : " . str_replace("*", " ",$_GET["ville"]) . "<br>" .
                        "Code Postal : " . str_replace("*", " ",$_GET["cp"]) . "<br>"; ?>
                </p>
               <?php echo "<a href='mailto:". $_GET["courriel"]  ."'>Envoyer un courriel.</a>" ?>
                <p class="card-text"><small class="text-muted">Date de publication : 5 d&eacute;cembre 2020</small></p>
            </div>
        </div>
    </main>

    <footer>
        <div class="blockquote-footer">Auteur: Yan-Alexandre Leclerc, Code Permanent: LECY20069604</div>
    </footer>
</div>
<script src="../vendor/JS/jquery-3.5.1.min.js"></script>
<script src="../vendor/JS/bootstrap.min.js"></script>
</body>
</html>