<?php
$nom ="";
$type="";
$race="";
$desc="";
$age =0;
$courriel="";
$adresse="";
$ville="";
$cp="";

$message="";

if($_SERVER["REQUEST_METHOD"]=="GET" && !empty($_GET["form-recherche"])) {
    $recherche= strtolower($_GET["form-recherche"]);
    $resultat= rechercher($recherche);

    if (empty($resultat[0])){
        $messageRecherche = "La recherche n'a rien trouvé...";
    } else {
        header("Location: " . genererRecherche($resultat), true, 303);
        exit;
    }
}

if (validerDonnees()){

    global $nom;
    global $type;
    global $race;
    $age = saisirAge();
    global $desc;
    global $courriel;
    global $adresse;
    global $ville;
    global $cp;

    ecrireFichier();
    header("Location: confirmation.php?nom=". $nom ."&type=" . $type ."&race=" .$race ."&age=". $age ."&desc=".
        $desc ."&courriel=". $courriel  ."&adresse=". $adresse  ."&ville=". $ville ."&cp=". $cp,true,303);
    exit;

}

function validerDonnees(){
    $nomValide = $typeValide = $raceValide = $descValide = $courrielValide = $adresseValide = $villeValide = $cpValide
        = false;

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nomValide =nomEstValide();
        $typeValide=typeEstValide();
        $raceValide=raceEstValide();
        $descValide=descEstValide();
        $courrielValide=courrielEstValide();
        $adresseValide=adresseEstValide();
        $villeValide=villeEstValide();
        $cpValide=cpEstValide();
    }
    return $nomValide && $typeValide && $raceValide && $descValide && $courrielValide && $adresseValide && $villeValide
        && $cpValide;
}
function nomEstValide(){
    global $nom;
    $validation = true;
    if (!isset($_POST["form-nom"]) || empty($_POST["form-nom"])) {
        global $message;
        $message .="Le nom est obligatoire. <br>";
        $validation = false;
    }
    $nom = $_POST["form-nom"];
    return $validation;
}

function typeEstValide(){
    global $type;
    $validation = true;
    if (!isset($_POST["form-type"]) || empty($_POST["form-type"])) {
        global $message;
        $message .="Le type est obligatoire. <br>";
        $validation = false;
    }
    $type = $_POST["form-type"];
    return $validation;
}

function raceEstValide(){
    global $race;
    $validation = true;
    if (!isset($_POST["form-race"]) || empty($_POST["form-race"])) {
        global $message;
        $message .="La race est obligatoire. <br>";
        $validation = false;
    }
    $race = $_POST["form-race"];
    return $validation;
}

function descEstValide(){
    global $desc;
    $validation = true;
    if (!isset($_POST["form-description"]) || empty($_POST["form-description"])) {
        global $message;
        $message .="Une description est obligatoire. <br>";
        $validation = false;
    }
    $desc = $_POST["form-description"];
    return $validation;
}

function courrielEstValide(){
    global $courriel;
    $validation = true;
    if (!isset($_POST["form-courriel"]) || empty($_POST["form-courriel"])) {
        global $message;
        $message .="Le courriel est obligatoire. <br>";
        $validation = false;
    }
    $courriel = $_POST["form-courriel"];
    return $validation;
}

function adresseEstValide(){
    global $adresse;
    $validation = true;
    if (!isset($_POST["form-adresseCiv"]) || empty($_POST["form-adresseCiv"])) {
        global $message;
        $message .="Le numero civique est obligatoire. <br>";
        $validation = false;
    }
    $adresse = $_POST["form-adresseCiv"];
    return $validation;
}

function villeEstValide(){
    global $ville;
    $validation = true;
    if (!isset($_POST["form-ville"]) || empty($_POST["form-ville"])) {
        global $message;
        $message .="La ville est obligatoire. <br>";
        $validation = false;
    }
    $ville = $_POST["form-ville"];
    return $validation;
}

function cpEstValide(){
    global $cp;
    $validation = true;
    if (!isset($_POST["form-cp"]) || empty($_POST["form-cp"])) {
        global $message;
        $message .="Le code postal est obligatoire. <br>";
        $validation = false;
    }
    $cp = $_POST["form-cp"];
    return $validation;
}

function ecrireFichier(){
    $fichierTexte = fopen("animaux.csv","a");
    $ajout = concatenerDonnees();
    fwrite($fichierTexte, $ajout . "\n");
    fclose($fichierTexte);
}

function concatenerDonnees(){
    global $nom;
    global $type;
    global $race;
    $age = saisirAge();
    global $desc;
    global $courriel;
    global $adresse;
    global $ville;
    global $cp;

    return uniqid("X",false )   . "," . $nom . "," . $type . "," . $race . "," . $age . "," . $desc . "," . $courriel . "," . $adresse . "," . $ville
        . "," . $cp;
}

function saisirAge(){
    return strval($_POST["form-age"]);
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
    return $resultats;
}

function genererRecherche($resultat){
    return str_replace(" ", "*", "pageRecherche.php?nom=" . trim($resultat[0][1]) . "&type=" . trim($resultat[0][2])
        . "&race=" . trim($resultat[0][3]) ."&age=" . trim($resultat[0][4]) . "&desc=" . trim($resultat[0][5]) . "&courriel=" .
        trim($resultat[0][6]) . "&adresse=" . trim($resultat[0][7]) . "&ville=" . trim($resultat[0][8]) . "&cp=" .
        trim($resultat[0][9]));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../vendor/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cssFoyerAnimal.css">
    <title>Formulaire Adoption</title>
    <script src="../scriptsJS/formulaire.js"></script>
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
            <li class="nav-item ">
                <a class="nav-link" href="pageAccueil.php">Accueil</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="formulaire.php">Mise en adoption</a>
            </li>
        </ul>
        <form class="form-inline my-3 my-lg-0" role="form" action="formulaire.php" method="GET">
            <input class="form-control mr-md-2 " type="search" name="form-recherche" placeholder="Recherche" aria-label="Recherche">
            <button class="btn btn-outline-light my-2 my-md-0" type="submit" >Rechercher</button>
        </form>
    </nav>

    <main>
        <div class="row">
            <div class="col-lg-6 offset-3 mt-1">
                <?php if (!empty($messageRecherche)) {
                    echo "<p class='lead alert alert-danger'>{$messageRecherche}</p>";
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-11 offset-lg-0">
                <h2 class="display-4"><u>Formulaire de mise en adoption</u></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-3 mt-1">
                <p class="lead"> Veuillez remplir toutes les cases en respectant les indications et en vous assurant
                    de donner les bonnes informations. Nous ne sommes pas responsables des erreurs de formulaires.
                </p>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($message)) {
                echo "<p class='messageErreur'>{$message}</p>";
            }
            ?>
        </div>
        <div class="row ">
            <div class="col-lg-12">
                <form class="form-horizontal" role="form" action="formulaire.php" method="POST" >
                    <div class="form-group">
                        <label class="control-label col-lg-5" for="form-nom">Nom de l'animal</label>
                        <div class="col-lg-5">
                            <?php echo "<input type='text' class='form-control input-lg' id='form-nom' name='form-nom'
                               placeholder='Saisir le nom' value='{$nom}'>"; ?>
                            <div id="nom-erreur"></div>
                            <small id="aide-nom" class="form-text text-muted">Veuillez respecter la limite de 3 &agrave;
                                20 caract&egrave;res inclusivement. Ne pas inclure de virgule.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-5" for="form-type">Type de l'animal</label>
                        <div class="col-lg-5">
                            <?php
                            echo "<input type='text' class='form-control input-lg' id='form-type' name='form-type'
                                   placeholder='Saisir le type' value='{$type}'>"; ?>
                            <div id="type-erreur"></div>
                            <small id="aide-type" class="form-text text-muted">Veuillez ne pas inclure de virgule.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-5" for="form-race">Race de l'animal</label>
                        <div class="col-lg-5">
                            <?php
                            echo "<input type='text' class='form-control input-lg' id='form-race' name='form-race'
                                   placeholder='Saisir la race' value='{$race}'>"; ?>
                            <div id="race-erreur"></div>
                            <small id="aide-race" class="form-text text-muted">Veuillez ne pas inclure de virgule.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3" for="form-age">Age de l'animal</label>
                        <div class="col-lg-2">
                            <select class="form-control" id="form-age" name="form-age">
                                <?php
                                for($i = 0; $i < 31; $i++) {
                                    if ($i == $age) {
                                        $selected = "selected='selected'";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='{$i}' {$selected}>{$i}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-5" for="form-description">Description de l'animal</label>
                        <div class="col-lg-5">
                            <?php
                            echo "<textarea class='form-control input-lg' id='form-description' rows='5' name='form-description'
                                      placeholder='Saisir une petite description'>{$desc}</textarea>"; ?>
                            <div id="description-erreur"></div>
                            <small id="aide-description" class="form-text text-muted">Veuillez ne pas inclure de virgule.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-5" for="form-courriel">Adresse courriel du propri&eacute;taire
                        </label>
                        <div class="col-lg-5">
                            <?php
                             echo "<input type='text' class='form-control input-lg' id='form-courriel' name='form-courriel'
                                   placeholder='Saisir votre adresse courriel' value='{$courriel}'>"; ?>
                            <div id="courriel-erreur"></div>
                            <small id="aide-courriel" class="form-text text-muted">Veuillez respecter les standards
                                d'adresse courriel et ne pas inclure de virgule.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-5" for="form-adresse">Adresse compl&egrave;te</label>
                        <div class="col-lg-5">
                            <label class="control-label col-lg-5" for="form-adresseCiv">Num&eacute;ro civique</label>
                            <?php
                            echo "<input type='text' class='form-control input-lg' id='form-adresseCiv' name='form-adresseCiv'
                                   placeholder='Saisir le numero civique' value='{$adresse}'>"; ?>
                            <div id="adresseCiv-erreur"></div>
                            <small id="aide-adresseCiv" class="form-text text-muted">Veuillez inclure une valeur
                                num&eacute;rique et ne pas inclure de virgule.</small>
                        </div>
                        <div class="col-lg-5">
                            <label class="control-label col-lg-5" for="form-ville">Ville</label>
                            <?php
                            echo "<input type='text' class='form-control input-lg' id='form-ville' name='form-ville'
                                   placeholder='Saisir la ville' value='{$ville}'>"; ?>
                            <div id="ville-erreur"></div>
                            <small id="aide-adresseVille" class="form-text text-muted">Veuillez ne pas inclure de
                                virgule.</small>
                        </div>
                        <div class="col-lg-5">
                            <label class="control-label col-lg-5" for="form-cp">Code Postal</label>
                            <?php
                            echo"<input type='text' class='form-control input-lg' id='form-cp' name='form-cp'
                                   placeholder='Saisir le code postal' value='{$cp}'>"; ?>
                            <div role="alert"  id="cp-erreur"></div>
                            <small id="aide-adresseCiv" class="form-text text-muted">Veuillez respecter le format
                                canadien et ne pas inclure de virgule ni d'espace.</small>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-dark" type="reset" value="Effacer">
                            <input type="submit" class="btn btn-dark" value="Soumettre" onclick="return validerFormulaire()">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
    </footer>

</div>
<script src="../vendor/JS/jquery-3.5.1.min.js"></script>
<script src="../vendor/JS/bootstrap.min.js"></script>
</body>
</html>
