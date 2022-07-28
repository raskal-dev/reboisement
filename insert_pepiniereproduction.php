<?php
session_start();
require_once 'includes/function.php';
require_once 'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');

if (isset($_POST['essence'])) {

        $id_pepiniere = trim($Fonction->secure($_POST['id_pepiniere']));
        $users_id = $Fonction->user('id');

        for ($count = 0; $count < count($_POST['essence']); $count++) {
                $users_id = $Fonction->user('id');
                $_POST['essence'][$count] = trim($Fonction->secure($_POST['essence'][$count]));
                $_POST['dateSemi'][$count] = trim($Fonction->secure($_POST['dateSemi'][$count]));
                $_POST['type_semi'][$count] = trim($Fonction->secure($_POST['type_semi'][$count]));
                $_POST['nombrePlantSemi'][$count] = trim($Fonction->secure($_POST['nombrePlantSemi'][$count]));

                $query = "INSERT INTO `essence_pepiniere_semi`( `dateSemi`,`type_semi`,`essence`,`nombrePlantSemi`,`id_pepiniere`,`users_id`)
                VALUES(:dateSemi, :type_semi, :essence, :nombrePlantSemi, :id_pepiniere, :users_id)";
                $statement = $db->prepare($query);
                $statement->execute(array(
                        'dateSemi' => $_POST['dateSemi'][$count],
                        'type_semi' => $_POST['type_semi'][$count],
                        'essence' => $_POST['essence'][$count],
                        'nombrePlantSemi' => $_POST['nombrePlantSemi'][$count],
                        'id_pepiniere' => $id_pepiniere,
                        'users_id' => $users_id
                ));
        }
}

unset($_SESSION['id_pepiniere']);
