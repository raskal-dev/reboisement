<?php 
session_start();


$mysqli = new mysqli('localhost', 'root', '', 'reboisement') or die(mysqli_error($mysqli));

$id_nompep = 0;
$update = false;
$nom_pep = '';

if (isset($_POST['save'])) {
    $nom_pep = $_POST['nom_pep'];

    $mysqli->query("INSERT INTO nom_pepiniere (nom_pep) VALUES ('$nom_pep')") or die($mysqli->error);

    $_SESSION['message'] = "Pépinière enregistré !";
    $_SESSION['msg_type'] = "success";

    header("location:Fiche_nom_pepiniere.php");
}

if (isset($_GET['delete'])) {
    $id_nompep = $_GET['delete'];
    $mysqli->query("DELETE FROM nom_pepiniere WHERE id_nompep=$id_nompep") or die($mysqli->error);

    $_SESSION['message'] = "Pépinière supprimé !";
    $_SESSION['msg_type'] = "danger";

    header("location:Fiche_nom_pepiniere.php");

}

if (isset($_GET['edit'])) {
    $id_nompep = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM nom_pepiniere WHERE id_nompep=$id_nompep") or die($mysqli->error);
    if ($row=$result->fetch_array()) {
        $nom_pep = $row['nom_pep'];
    }


}
if (isset($_POST['update'])) {
    $id_nompep = $_POST['id_nompep'];
    $nom_pep = $_POST['nom_pep'];

    $mysqli->query("UPDATE nom_pepiniere SET nom_pep='$nom_pep' WHERE id_nompep=$id_nompep") or die($mysqli->error);

    $_SESSION['message'] = "Pépinière a éié bien modifié!";
    $_SESSION['msg_type'] = "info";

    header("location:Fiche_nom_pepiniere.php");     

}
?>