<!--
Ce projet web consiste en foyer d'adoption pour animal.
Il contient un formulaire et un moteur de recherche connectés au back-end

@Nom: Leclerc
@Prenom : Yan-Alexandre
-->
<?php
$tableauAnimaux = array_map('str_getcsv', file('animaux.csv'));
array_shift($tableauAnimaux);

$animal1=0;
$animal2 =0;
$animal3 =0;
$animal4=0;
$animal5 =0;
$animal5=0;
$message="";
genererAnimalUnique($tableauAnimaux);


if($_SERVER["REQUEST_METHOD"]=="POST") {
    $recherche= strtolower($_POST["form-recherche"]);
    $resultat= rechercher($recherche);

    if (empty($resultat[0])){
        global $message;
        $message = "La recherche n'a rien trouvé...";
    } else {
        header("Location: " . genererRecherche($resultat), true, 303);
        exit;
    }
}


function rechercher($recherche): array {
    $resultats = [];
    if ($recherche != "" || $recherche != null) {
        if (($stream = fopen("animaux.csv", "r")) !== false) {
            fgetcsv($stream); //sauter la premiere ligne
            while (($ligne = fgetcsv($stream)) !== false) {
                foreach ($ligne as $key) {
                    if (strpos(strtolower($key), $recherche) !== false) {
                        if(!in_array($ligne, $resultats)) {
                            $resultats[] = $ligne;
                        }
                    }
                }
            }
            fclose($stream);
        }
    }
    var_dump_pre($resultats);
    return $resultats;
}

/**
 * Methode prise de https://www.php.net/manual/en/function.var-dump.php
 * pour mieux afficher les arrays en var_dump sur la page HTML.
 *
 * @param null $mixed
 * @return null
 */
function var_dump_pre($mixed = null) {
    echo '<pre>';
    var_dump($mixed);
    echo '</pre>';
    return null;
}

function genererRecherche($resultat){
    return str_replace(" ", "*", "pageRecherche.php?nom=" . trim($resultat[0][1]) . "&type=" . trim($resultat[0][2])
        . "&race=" . trim($resultat[0][3]) ."&age=" . trim($resultat[0][4]) . "&desc=" . urlencode(trim($resultat[0][5]))
        . "&courriel=" . trim($resultat[0][6]) . "&adresse=" . trim($resultat[0][7]) . "&ville=" . trim($resultat[0][8])
        . "&cp=" . trim($resultat[0][9]));
}

function genererAnimalUnique($tableauAnimaux){
    global $animal1, $animal2, $animal3, $animal4, $animal5;

    $numero = range(0, sizeof($tableauAnimaux)-1);
    shuffle($numero);

    $animal1 = $numero[0];
    $animal2 = $numero[1];
    $animal3 = $numero[2];
    $animal4 = $numero[3];
    $animal5 = $numero[4];
}

function genererAdresseAnimal($numero){
    global $tableauAnimaux;

    return str_replace(" ", "*", "animal.php?nom=" . trim($tableauAnimaux[$numero][1]) . "&type=" . trim($tableauAnimaux[$numero][2])
        . "&race=" . trim($tableauAnimaux[$numero][3]) ."&age=" . trim($tableauAnimaux[$numero][4]) . "&desc=" .
        urlencode(trim($tableauAnimaux[$numero][5])) . "&courriel=" . trim($tableauAnimaux[$numero][6]) . "&adresse=" .
        trim($tableauAnimaux[$numero][7]) . "&ville=" . trim($tableauAnimaux[$numero][8]) . "&cp=" .
        trim($tableauAnimaux[$numero][9]));
}
?>
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
            <form class="form-inline my-3 my-lg-0" role="form" action="pageAccueil.php" method="POST" >
                <input class="form-control mr-md-2" type="text" id="form-recherche" name="form-recherche"
                       placeholder="Recherche" aria-label="Recherche">
                <input type="submit" class="form-control btn btn-outline-light my-3 my-lg-0" value="Rechercher">
            </form>
    </nav>

    <main>
        <div class="row">
            <div class="col-lg-6 offset-3 mt-1">
            <?php if (!empty($message)) {
                echo "<p class='lead alert alert-danger'>{$message}</p>";
            }
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-11 offset-lg-0">
                <h2 class="display-4"><u>Bienvenue!</u></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-3 mt-1">
                <p class="lead"> Nous sommes une &eacute;quipe qui a pour mission de trouver une famille d'accueil
                    pour tout genre d'animal. Nous pensons que l'animal a l'instinct de choisir son nouveau maitre ou
                    maitresse. Une rencontre dans nos installations est donc pr&eacute;alable avant de partir avec
                    l'animal.
                </p>
                <p class="lead">
                    Vous pouvez choisir parmis les animaux en vedette ou bien effectuer une recherche dans la barre de
                    navigation.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-11 offset-lg-0">
                <h2 class="display-4"><u>Animaux en adoption</u></h2>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4">
                <div class="card">
                    <img src="../images/headerImageTp3.jpg" class="card-img-top" alt="animal_1">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "{$tableauAnimaux[$animal1][1]}"?></h5>
                        <p class="card-text"><?php echo "{$tableauAnimaux[$animal1][2]} <br>
                                              {$tableauAnimaux[$animal1][3]}"; ?></p>
                        <?php echo "<a class='card-link' href=" . genererAdresseAnimal($animal1) . ">Description compl&egrave;te</a>"; ?>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card">
                    <img src="../images/headerImageTp3.jpg" class="card-img-top" alt="animal_2">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "{$tableauAnimaux[$animal2][1]}"?></h5>
                        <p class="card-text"><?php echo "{$tableauAnimaux[$animal2][2]} <br>
                                              {$tableauAnimaux[$animal2][3]}" ?></p>
                        <?php echo "<a class='card-link' href=" . genererAdresseAnimal($animal2) . ">Description compl&egrave;te</a>"; ?>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card">
                    <img src="../images/headerImageTp3.jpg" class="card-img-top" alt="animal_3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "{$tableauAnimaux[$animal3][1]}"?></h5>
                        <p class="card-text"><?php echo "{$tableauAnimaux[$animal3][2]} <br>
                                              {$tableauAnimaux[$animal3][3]}" ?></p>
                        <?php echo "<a class='card-link' href=" . genererAdresseAnimal($animal3) . ">Description compl&egrave;te</a>"; ?>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card">
                    <img src="../images/headerImageTp3.jpg" class="card-img-top" alt="animal_4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "{$tableauAnimaux[$animal4][1]}"?></h5>
                        <p class="card-text"><?php echo "{$tableauAnimaux[$animal4][2]} <br>
                                              {$tableauAnimaux[$animal4][3]}" ?></p>
                       <?php echo "<a class='card-link' href=" . genererAdresseAnimal($animal4) . ">Description compl&egrave;te</a>"; ?>
                    </div>
                </div>
            </div>

            <div class="col mb-4">
                <div class="card">
                    <img src="../images/headerImageTp3.jpg" class="card-img-top" alt="animal_5">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "{$tableauAnimaux[$animal5][1]}"?></h5>
                        <p class="card-text"><?php echo "{$tableauAnimaux[$animal5][2]} <br>
                                              {$tableauAnimaux[$animal5][3]}" ?></p>
                        <?php echo "<a class='card-link' href=" . genererAdresseAnimal($animal5) . ">Description compl&egrave;te</a>"; ?>
                    </div>
                </div>
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