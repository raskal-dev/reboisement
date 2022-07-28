<?php 
session_start();


$mysqli = new mysqli('localhost', 'root', '', 'reboisement') or die(mysqli_error($mysqli));

$ID_TYPE_ACTEUR = 0;
$update = false;
$LIBELLETYPE_ACTEUR = '';
$DESCRIPTION = '';

if (isset($_POST['save'])) {
    $LIBELLETYPE_ACTEUR = $_POST['LIBELLETYPE_ACTEUR'];
    $DESCRIPTION = $_POST['DESCRIPTION'];

    $mysqli->query("INSERT INTO type_acteur (LIBELLETYPE_ACTEUR,DESCRIPTION) VALUES ('$LIBELLETYPE_ACTEUR','$DESCRIPTION')") or die($mysqli->error);

    $_SESSION['message'] = "Type acteur enregistré !";
    $_SESSION['msg_type'] = "success";

    header("location:type_acteur.php");
}

if (isset($_GET['delete'])) {
    $ID_TYPE_ACTEUR = $_GET['delete'];
    $mysqli->query("DELETE FROM type_acteur WHERE ID_TYPE_ACTEUR=$ID_TYPE_ACTEUR") or die($mysqli->error);

    $_SESSION['message'] = "Type acteur supprimé !";
    $_SESSION['msg_type'] = "danger";

    header("location:type_acteur.php");

}

if (isset($_GET['edit'])) {
    $ID_TYPE_ACTEUR = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM type_acteur WHERE ID_TYPE_ACTEUR=$ID_TYPE_ACTEUR") or die($mysqli->error);
    if ($row=$result->fetch_array()) {
        $LIBELLETYPE_ACTEUR = $row['LIBELLETYPE_ACTEUR'];
        $DESCRIPTION = $row['DESCRIPTION'];
    }


}
if (isset($_POST['update'])) {
    $ID_TYPE_ACTEUR = $_POST['ID_TYPE_ACTEUR'];
    $LIBELLETYPE_ACTEUR = $_POST['LIBELLETYPE_ACTEUR'];
    $DESCRIPTION = $_POST['DESCRIPTION'];

    $mysqli->query("UPDATE type_acteur SET LIBELLETYPE_ACTEUR='$LIBELLETYPE_ACTEUR',DESCRIPTION='$DESCRIPTION' WHERE ID_TYPE_ACTEUR=$ID_TYPE_ACTEUR") or die($mysqli->error);

    $_SESSION['message'] = "Type acteur a éié bien modifié!";
    $_SESSION['msg_type'] = "info";

    header("location:type_acteur.php");     

}
?>