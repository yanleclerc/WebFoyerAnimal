function validerFormulaire(){
    var nomValide = validerChamps("form-nom","nom-erreur");
    var typeValide = validerChamps("form-type","type-erreur");
    var raceValide = validerChamps("form-race","race-erreur");
    var descriptionValide = validerChamps("form-description","description-erreur");
    var courrielValide = validerChamps("form-courriel","courriel-erreur") &&
        validerCourriel("form-courriel","courriel-erreur");
    var numCiviqueValide = validerChamps("form-adresseCiv","adresseCiv-erreur");
    var villeValide = validerChamps("form-ville","ville-erreur");
    var codePostalValide = validerChamps("form-cp","cp-erreur") &&
        validerCodePostal("form-cp","cp-erreur");


    return nomValide && typeValide && raceValide && descriptionValide && courrielValide && numCiviqueValide
        && villeValide && codePostalValide ;
}

function validerChamps(inputId,divId){
    var champ = document.getElementById(inputId).value;

    if (champ == null || champ == ""){
        document.getElementById(divId).innerHTML = "Ce champ est obligatoire";
        document.getElementById(divId).className = "alert alert-danger";
        return false;
    } else if (champ.contains(',')){
        document.getElementById(divId).innerHTML = "Le format est invalide";
        document.getElementById(divId).className = "alert alert-danger";
        return false;
    }
    return true;
}

function validerCourriel(inputId,divId){
    var courriel = document.getElementById(inputId).value;

    if (!courriel.match(/(\w+@\w+\.\w+)/g)){
        document.getElementById(divId).innerHTML = "Le format est invalide";
        document.getElementById(divId).className = "alert alert-danger";
        return false
    }
    return true;
}

function validerCodePostal(inputId,divId){
    var codePostal = document.getElementById(inputId).value;

     if (! codePostal.match(/(\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1})/g)){
        document.getElementById(divId).innerHTML = "Le format est invalide";
        document.getElementById(divId).className = "alert alert-danger";
        return false;
    }
    return true;
}