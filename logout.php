<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/function.php';
$Fonction->allow(membre);

// On remplit le cookie par une valeur fausse pour ne pas être réutilisé
setcookie("sid", "session ended", time()+3600);

// On redirige l'utilisateur vers la page d'accueil
header('location:index.php');
unset($_SESSION['last_accessrbsmt']);
unset($_SESSION['authentifier']);
unset($_SESSION['id_stocks']);
unset($_SESSION['inputs']);
unset($_SESSION['district']);
unset($_SESSION['commune']);
unset($_SESSION['params']);
unset($_SESSION['reboisement_id']);
unset($_SESSION['nom_vernac']);
unset($_SESSION['region']);
unset($_SESSION['nom_region']);
unset($_SESSION['nom_district']);
unset($_SESSION['id_pepiniere']);
unset($_SESSION['pepinieriste']);
exit();

