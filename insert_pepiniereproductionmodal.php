<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');

if(isset($_POST['region']))
{
    $insert_region=trim($Fonction->secure($_POST['region']));
    $insert_district=trim($Fonction->secure($_POST['district']));
    $insert_commune=trim($Fonction->secure($_POST['commune']));
    
    $sql_region="SELECT * FROM region WHERE id=?";
    $req_region=$db->prepare($sql_region);
    $req_region->execute([$insert_region]);
    $info_region=$req_region->fetch(PDO::FETCH_ASSOC);
    $region=$info_region['nom_region'];
    
    $sql_district="SELECT * FROM district WHERE id=?";
    $req_district=$db->prepare($sql_district);
    $req_district->execute([$insert_district]);
    $info_district=$req_district->fetch(PDO::FETCH_ASSOC);
    $district=$info_district['nom_district'];
    
    $sql_commune="SELECT * FROM commune WHERE id=?";
    $req_commune=$db->prepare($sql_commune);
    $req_commune->execute([$insert_commune]);
    $info_commune=$req_commune->fetch(PDO::FETCH_ASSOC);
    $commune=$info_commune['nom_commune'];
    
    $fokontany=trim($Fonction->secure($_POST['fokontany']));
    $site=trim($Fonction->secure($_POST['site']));
    $longitude=trim($Fonction->secure($_POST['longitude']));
    $latitude=trim($Fonction->secure($_POST['latitude']));
    $responsablePepiniere=trim($Fonction->secure($_POST['responsablePepiniere']));
    $nombrePlatebande=trim($Fonction->secure($_POST['nombrePlatebande']));
    $users_id=$Fonction->user('id');
    
    
    $sql_rbsmt="INSERT INTO `pepiniere`(`dateRempl`, `region`, `district`, `commune`, `fokontany`, `site`,  `longitude`, `latitude`, `responsablePepiniere`,`nombrePlatebande`, `users_id`) VALUES (NOW(), :region, :district, :commune, :fokontany, :site,  :longitude, :latitude, :responsablePepiniere, :nombrePlatebande, :users_id)";
    $req_rbsmt=$db->prepare($sql_rbsmt);
    $req_rbsmt->execute(array(
                "region" => $region,
                "district" => $district,
                "commune" => $commune,
                "fokontany" => $fokontany,
                "site" => $site,
                "longitude" => $longitude,
                "latitude" => $latitude,
                "responsablePepiniere" => $responsablePepiniere,
                "nombrePlatebande" => $nombrePlatebande,
                "users_id"=>$users_id
        ));    
}
