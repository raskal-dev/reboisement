<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');

if(isset($_POST['nomVernaculaire']))
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

				$acteur=trim($Fonction->secure($_POST['acteur']));
				$typeActeur=trim($Fonction->secure($_POST['typeActeur']));
				$dreed=trim($Fonction->secure($_POST['dreed']));
				$fokontany=trim($Fonction->secure($_POST['fokontany']));
				$site=trim($Fonction->secure($_POST['site']));
				$situationJuridique=trim($Fonction->secure($_POST['situationJuridique']));
				$responsable=trim($Fonction->secure($_POST['responsable']));
				$objectifReboisement=trim($Fonction->secure($_POST['objectifReboisement']));
				$objectifRpf=trim($Fonction->secure($_POST['objectifRpf']));
				$Approche=trim($Fonction->secure($_POST['Approche']));
				$surfaceTotalPrevu=trim($Fonction->secure($_POST['surfaceTotalPrevu']));
				$superficieRealise=trim($Fonction->secure($_POST['superficieRealise']));
				$class_=trim($Fonction->secure($_POST['class_']));
				$mangroveOuTerrestre=trim($Fonction->secure($_POST['mangroveOuTerrestre']));
        $dateMiseEnTerre=trim($Fonction->secure($_POST['dateMiseEnTerre']));
        $anneeRebois=trim($Fonction->secure($_POST['anneeRebois']));
        $users_id=$Fonction->user('id');

    $sql_rbsmt="INSERT INTO `reboisement`(`dateRemplissage`,`acteur`, `typeActeur`, `dreed`, `region`, `district`, `commune`, `fokontany`, `site`, `situationJuridique`, `responsable`, `objectifReboisement`, `objectifRpf`, `Approche`, `surfaceTotalPrevu`, `superficieRealise`, `class_`, `mangroveOuTerrestre`, `dateMiseEnTerre`, `anneeRebois`, `users_id`) VALUES (NOW(),:acteur, :typeActeur, :dreed, :region, :district, :commune, :fokontany, :site, :situationJuridique, :responsable, :objectifReboisement, :objectifRpf, :Approche, :surfaceTotalPrevu, :superficieRealise, :class_, :mangroveOuTerrestre, :dateMiseEnTerre, :anneeRebois, :users_id)";
    $req_rbsmt=$db->prepare($sql_rbsmt);
    $req_rbsmt->execute(array(

                                                                                                                                                            "acteur"=>$acteur,
                                                                                                                                                            "typeActeur"=>$typeActeur,
                                                                                                                                                            "dreed"=>$dreed,
                                                                                                                                                            "region"=>$region,
                                                                                                                                                            "district"=>$district,
                                                                                                                                                            "commune"=>$commune,
                                                                                                                                                            "fokontany"=>$fokontany,
                                                                                                                                                            "site"=>$site,
                                                                                                                                                            "situationJuridique"=>$situationJuridique,
                                                                                                                                                            "responsable"=>$responsable,
                                                                                                                                                            "objectifReboisement"=>$objectifReboisement,
                                                                                                                                                            "objectifRpf"=>$objectifRpf,
                                                                                                                                                            "Approche"=>$Approche,
                                                                                                                                                            "surfaceTotalPrevu"=>$surfaceTotalPrevu,
                                                                                                                                                            "superficieRealise"=>$superficieRealise,
                                                                                                                                                            "class_"=>$class_,
                                                                                                                                                            "mangroveOuTerrestre"=>$mangroveOuTerrestre,
                                                                                                                                                            "dateMiseEnTerre"=>$dateMiseEnTerre,
                                                                                                                                                            "anneeRebois"=>$anneeRebois,
                                                                                                                                                             "users_id"=>$users_id
																				));
    $reboisement_id=$db->lastInsertId();
    for($count = 0; $count < count($_POST['nomVernaculaire']); $count++)
    {
            $users_id=$Fonction->user('id');
            $_POST['nomScientifique'][$count]=trim($Fonction->secure($_POST['nomScientifique'][$count]));
            $_POST['nomVernaculaire'][$count]=trim($Fonction->secure($_POST['nomVernaculaire'][$count]));
												$_POST['nombrePlantMiseEnTerre'][$count]=trim($Fonction->secure($_POST['nombrePlantMiseEnTerre'][$count]));
												$_POST['SourcePlant'][$count]=trim($Fonction->secure($_POST['SourcePlant'][$count]));

            $query="INSERT INTO `plant_mise_terre`(`dateRegister`, `nomScientifique`, `nomVernaculaire`, 	`nombrePlantMiseEnTerre`, `SourcePlant`, `reboisement_id`, `users_id`)
                    VALUES(NOW(), :nomScientifique,:nomVernaculaire,:nombrePlantMiseEnTerre,:SourcePlant,:reboisement_id, :users_id)";
            $statement = $db->prepare($query);
            $statement->execute(array(
                    'nomScientifique'=>$_POST['nomScientifique'][$count],
                    'nomVernaculaire'=>$_POST['nomVernaculaire'][$count],
										'nombrePlantMiseEnTerre'=>$_POST['nombrePlantMiseEnTerre'][$count],

									  'SourcePlant'=>$_POST['SourcePlant'][$count],
                    'reboisement_id'=>$reboisement_id,
                    "users_id"=>$users_id
                                      ));
    }
    for($calc = 0; $calc < count($_POST['longitude']); $calc++)
    {
            $users_id=$Fonction->user('id');
            if($_POST['longitude'][$calc]==""){
              $_POST['longitude'][$calc]="0";
            }else
            {$_POST['longitude'][$calc]=trim($Fonction->secure($_POST['longitude'][$calc]));}

            if($_POST['latitude'][$calc]==""){
              $_POST['latitude'][$calc]="0";
            }else
            {$_POST['latitude'][$calc]=trim($Fonction->secure($_POST['latitude'][$calc]));}


            $query="INSERT INTO `gpsrebois`(`dateInsert`, `longitude`, `latitude`, `reboisement_id`, `users_id`)
                    VALUES(NOW(),:longitude,:latitude,:reboisement_id, :users_id)";
            $statement = $db->prepare($query);
            $statement->execute(array(
                    'longitude'=>$_POST['longitude'][$calc],
                    'latitude'=>$_POST['latitude'][$calc],
                    'reboisement_id'=>$reboisement_id,
                    "users_id"=>$users_id
                                      ));
    }
}

?>
