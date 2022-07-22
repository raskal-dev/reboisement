<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');

if(isset($_POST['essence']))
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
    $anneeExercice=trim($Fonction->secure($_POST['anneeExercice']));
    $users_id=$Fonction->user('id');
    
    
    $sql_rbsmt="INSERT INTO `pepiniere`(`dateRempl`, `region`, `district`, `commune`, `fokontany`, `site`,  `longitude`, `latitude`, `responsablePepiniere`, `nombrePlatebande`, `anneeExercice`, `users_id`) VALUES (NOW(), :region, :district, :commune, :fokontany, :site,  :longitude, :latitude, :responsablePepiniere, :nombrePlatebande,:anneeExercice, :users_id)";
    $req_rbsmt=$db->prepare($sql_rbsmt);
    $req_rbsmt->execute(array(
                                                                                                                                                            "region"=>$region,
                                                                                                                                                            "district"=>$district,
                                                                                                                                                            "commune"=>$commune,
                                                                                                                                                            "fokontany"=>$fokontany,
                                                                                                                                                            "site"=>$site,
                                                                                                                                                            "longitude"=>$longitude,
                                                                                                                                                            "latitude"=>$latitude,
                                                                                                                                                            "responsablePepiniere"=>$responsablePepiniere,
                                                                                                                                                            "nombrePlatebande"=>$nombrePlatebande,
                                                                                                                                                            "anneeExercice"=>$anneeExercice,
                                                                                                                                                             "users_id"=>$users_id
                    ));
    $id_pepiniere=$db->lastInsertId();
    for($count = 0; $count < count($_POST['essence']); $count++)
    {
            $users_id=$Fonction->user('id');
            $_POST['essence'][$count]=trim($Fonction->secure($_POST['essence'][$count]));
            $_POST['nombrePlantSemi'][$count]=trim($Fonction->secure($_POST['nombrePlantSemi'][$count]));
            $_POST['dateSemi'][$count]=trim($Fonction->secure($_POST['dateSemi'][$count]));
            $_POST['SourcePlant'][$count]=trim($Fonction->secure($_POST['SourcePlant'][$count]));

            $query="INSERT INTO `essence_pepiniere_semi`(`dateRegist`, `essence`,  `nombrePlantSemi`, `dateSemi`, `id_pepiniere`, `users_id`)
                    VALUES(NOW(), :essence,:nombrePlantSemi,:dateSemi,:id_pepiniere, :users_id)";
            $statement = $db->prepare($query);
            $statement->execute(array(
                                    'essence'=>$_POST['essence'][$count],
                                    'nombrePlantSemi'=>$_POST['nombrePlantSemi'][$count],
                                    'dateSemi'=>$_POST['dateSemi'][$count],
                                    'id_pepiniere'=>$id_pepiniere,
                                     "users_id"=>$users_id
                                      ));
    }
}

?>