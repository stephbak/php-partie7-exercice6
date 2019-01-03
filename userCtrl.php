<?php
$regexText = '/^[a-zéèàêâùïüëA-Z-\']+$/';
//on initialise un tableau $formError pour stocker les différents messages d'erreurs
$formError = array();
$success = false;
//j'initialise un tableau associatif  pour la civilité
$civilityArray = array(
    0 => 'Madame', 1 => 'Monsieur'
);
if (isset($_POST['submit'])) {//si j'ai appuyé sur le bouton
    if (isset($_POST['firstname'])) {//je vérifi que firstname existe
        if (!empty($_POST['firstname'])) {//je vérifie que ce n'est pas vide
            if (preg_match($regexText, $_POST['firstname'])) {//s'il n'est pas vide je vérifie que ce qu'a rentrer l'utilisateur corresponde a la regex
                $firstname = ' et votre prénom est : ' . htmlspecialchars($_POST['firstname']);
            } else {
                //si ca ne correspond pas à la regex on affiche le msg d'erreur suivant:
                $formError['firstname'] = 'Veuillez rentrer un prénom valide.';
            }
        } else {
            //si c'est vide on affiche le msg d'erreur suivant :
            $formError['firstname'] = 'Veuillez entrer votre prénom.';
        }
    }
    if (isset($_POST['lastname'])) {
        if (!empty($_POST['lastname'])) {
            if (preg_match($regexText, $_POST['lastname'])) {
                $lastname = ' votre nom est : ' . htmlspecialchars($_POST['lastname']);
            } else {
                $formError['lastname'] = 'Veuillez rentrer un nom valide.';
            }
        } else {
            $formError['lastname'] = 'Veuillez entrer votre nom.';
        }
    }
    //si la civilité existe
    if (isset($_POST['civility'])) {
        //je vérifie que la value du POST =0 ou =1
        if ($_POST['civility'] == 0 || $_POST['civility'] == 1) {
            //alors j'affiche le résultat du tableau initialisé
            $civility = ' Vous êtes : ' . htmlspecialchars($civilityArray[$_POST['civility']]);
        } else {
            //sinon j'affiche le msg d'erreur suivant :
            $formError['civility'] = 'merci de choisir un genre!';
        }
    }
    //je compte le nb de ligne existante dans le tableau d'erreur, si =0 : il n'y a pas d'erreur
    if (count($formError) == 0) {
        //la variable $success passe à true pour afficher le résultat
        $success = true;
    }
}
?>