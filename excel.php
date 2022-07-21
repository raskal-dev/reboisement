<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/function.php';
$Fonction->logged_only();

 $index_annee=""; 
if(isset($_GET['search']) && $_GET['search']=="ap" && isset($_GET['index_annee']) && !empty($_GET['index_annee']))
{
  $index_annee = $Fonction->secure($_GET['index_annee']);
  $sql="select
      `reboisement`.`acteur` as `Gestionnaire`,
      count(`reboisement`.`acteur`) as `Acteurs`,
      sum(`reboisement`.`superficieRealise`) as `Surface`
      from `reboisement`
      WHERE `reboisement`.`typeActeur` LIKE 'Gestionaire AP'
          AND `reboisement`.`anneeRebois` LIKE '$index_annee'
      group by
      `reboisement`.`acteur`,`reboisement`.`anneeRebois`
      ORDER BY `reboisement`.`acteur` ASC";
    $reqs=$db->prepare($sql);
    $reqs->execute();
    $data=$reqs->fetchAll(PDO::FETCH_ASSOC);
    
	require_once 'includes/class.csv.php';
	CSV::export($data,'AP_'.$index_annee);
  
}
if(isset($_GET['search']) && $_GET['search']=="objrpf" && isset($_GET['index_annee']) && !empty($_GET['index_annee']))
{
  $index_annee = $Fonction->secure($_GET['index_annee']);
  $sql="select
    `reboisement`.`objectifRpf` as `objectif Rpf`,
    sum(`reboisement`.`superficieRealise`) as `Surface`
    from `reboisement`
				WHERE `reboisement`.`anneeRebois` LIKE '$index_annee'
    group by
    `reboisement`.`objectifRpf`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`objectifRpf` ASC";
  $reqs=$db->prepare($sql);
  $reqs->execute();
  $data=$reqs->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data,'Objectif_RPF_'.$index_annee);
}
if(isset($_GET['search']) && $_GET['search']=="type" && isset($_GET['index_annee']) && !empty($_GET['index_annee']))
{
  $index_annee = $Fonction->secure($_GET['index_annee']);
  $sql="select
    `reboisement`.`typeActeur` as `Type Acteur`,
    sum(`reboisement`.`superficieRealise`) as `Surface`
    from `reboisement`
				WHERE `reboisement`.`anneeRebois` LIKE '$index_annee'
    group by
    `reboisement`.`typeActeur`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`typeActeur` ASC";
  $reqs=$db->prepare($sql);
  $reqs->execute();
  $data=$reqs->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data,'Type_Acteur_'.$index_annee);
}
if(isset($_GET['search']) && $_GET['search']=="class" && isset($_GET['index_annee']) && !empty($_GET['index_annee']))
{
  $index_annee = $Fonction->secure($_GET['index_annee']);
  $sql="select
    `reboisement`.`typeActeur` as `Type Acteur`,
    sum(case when `reboisement`.`class_` = 'Inf_01ha' then `reboisement`.`superficieRealise` else 0 end) as `Inf_01ha`,
				sum(case when `reboisement`.`class_` = '1_10' then `reboisement`.`superficieRealise` else 0 end) as `1_10`,
				sum(case when `reboisement`.`class_` = '10_100' then `reboisement`.`superficieRealise` else 0 end) as `10_100`,
				sum(case when `reboisement`.`class_` = 'Sup_100' then `reboisement`.`superficieRealise` else 0 end) as `Sup_100`
    from `reboisement`
				WHERE `reboisement`.`anneeRebois` LIKE '$index_annee'
    group by
    `reboisement`.`typeActeur`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`typeActeur` ASC";
  $reqs=$db->prepare($sql);
  $reqs->execute();
  $data=$reqs->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data,'Classe_'.$index_annee);
}
if(isset($_GET['search']) && $_GET['search']=="comm" && isset($_GET['index_annee']) && !empty($_GET['index_annee']))
{
  $index_annee = $Fonction->secure($_GET['index_annee']);
  $sql="select
    `region`.`nom_region` as `Région`,
    count(DISTINCT `reboisement`.`commune`) as `Nombre Commune reboisée`,
    count(DISTINCT `commune`.`id`) as `Nombre Total commune`
    from `reboisement`
				JOIN region on region.nom_region=reboisement.region
				JOIN district on region.id=district.region_id
				JOIN commune on commune.district_id=district.id
				WHERE `reboisement`.`anneeRebois` LIKE '$index_annee'
    group by
    `region`.`nom_region`,`reboisement`.`region`,`reboisement`.`anneeRebois`
    ORDER BY `region`.`nom_region` ASC";
  $reqs=$db->prepare($sql);
  $reqs->execute();
  $data=$reqs->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data,'Commune_reboisee_'.$index_annee);
}
if(isset($_GET['search']) && $_GET['search']=="parcelle" && isset($_GET['index_annee']) && !empty($_GET['index_annee']))
{
  $index_annee = $Fonction->secure($_GET['index_annee']);
  $sql="select
    `reboisement`.`typeActeur` as `Type Acteur`,
    sum(case when `reboisement`.`class_` = 'Inf_01ha' then 1 else 0 end) as `Inf_01ha`,
				sum(case when `reboisement`.`class_` = '1_10' then 1 else 0 end) as `1_10`,
				sum(case when `reboisement`.`class_` = '10_100' then 1 else 0 end) as `10_100`,
				sum(case when `reboisement`.`class_` = 'Sup_100' then 1 else 0 end) as `Sup_100`
    from `reboisement`
				WHERE `reboisement`.`anneeRebois` LIKE '$index_annee'
    group by
    `reboisement`.`typeActeur`,`reboisement`.`typeActeur`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`typeActeur` ASC";
  $reqs=$db->prepare($sql);
  $reqs->execute();
  $data=$reqs->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data,'Nombre_parcelle_'.$index_annee);
}
if(isset($_GET['search']) && $_GET['search']=="situation" && isset($_GET['index_annee_deb']) && !empty($_GET['index_annee_deb']) && isset($_GET['index_annee_fin']) && !empty($_GET['index_annee_fin']))
{
  $index_annee_deb = $Fonction->secure($_GET['index_annee_deb']);
		$index_annee_fin = $Fonction->secure($_GET['index_annee_fin']);
    $sql="select
    
		`reboisement`.`mangroveOuTerrestre` as `Terrestre`,
    `reboisement`.`region` as `Région`,
    sum(`reboisement`.`surfaceTotalPrevu`) as `Objectif (ha)`,
    sum(`reboisement`.`superficieRealise`) as `Réalisation (ha)`
		
    from `reboisement`
				WHERE `reboisement`.`dateRemplissage` between '$index_annee_deb' and '$index_annee_fin'
				and `reboisement`.`mangroveOuTerrestre` LIKE 'Terrestre'
    group by
    `reboisement`.`region`,`reboisement`.`mangroveOuTerrestre`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs=$db->prepare($sql);
  $reqs->execute();
  $data=$reqs->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data,'Situation_Terrestre_du_'.$index_annee_fin);
  
  
$sql1="select
    
		`reboisement`.`mangroveOuTerrestre` as `Mangrove`,
    `reboisement`.`region` as `Région`,
    sum(`reboisement`.`surfaceTotalPrevu`) as `Objectif (ha)`,
    sum(`reboisement`.`superficieRealise`) as `Réalisation (ha)`
		
    from `reboisement`
		WHERE `reboisement`.`dateRemplissage` between '$index_annee_deb' and '$index_annee_fin'
		and `reboisement`.`mangroveOuTerrestre` LIKE 'Mangrove'
    group by
    `reboisement`.`region`,`reboisement`.`mangroveOuTerrestre`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs1=$db->prepare($sql1);
  $reqs1->execute();
  $data1=$reqs1->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data1,'Situation_Mangrove_du_'.$index_annee_fin);
  
  $sql4="select
    `reboisement`.`mangroveOuTerrestre` as `Total`,
    `reboisement`.`region` as `Région`,
    sum(`reboisement`.`surfaceTotalPrevu`) as `Objectif (ha)`,
    sum(`reboisement`.`superficieRealise`) as `Réalisation (ha)`
		
    from `reboisement`
		WHERE `reboisement`.`dateRemplissage` between '$index_annee_deb' and '$index_annee_fin'
    group by
    `reboisement`.`region`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs4=$db->prepare($sql4);
  $reqs4->execute();
  $data4=$reqs4->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data4,'Situation_total_du_'.$index_annee_fin);
}
if(isset($_GET['search']) && $_GET['search']=="recap" && isset($_GET['index_annee_deb']) && !empty($_GET['index_annee_deb']) && isset($_GET['index_annee_fin']) && !empty($_GET['index_annee_fin']))
{
  $index_annee_deb = $Fonction->secure($_GET['index_annee_deb']);
		$index_annee_fin = $Fonction->secure($_GET['index_annee_fin']);
    $sql="select
    `reboisement`.`mangroveOuTerrestre` as `Terrestre`,
    `reboisement`.`region` as `Région`,
				
    sum(`reboisement`.`superficieRealise`) as `Somme de Superficie (Ha)`,
				sum(`plant_mise_terre`.`nombrePlantMiseEnTerre`) as `Somme de Nombre plants mise en terre`
    from `reboisement`
				join plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
				WHERE `plant_mise_terre`.`dateMiseEnTerre` between '$index_annee_deb' and '$index_annee_fin'
				and `reboisement`.`mangroveOuTerrestre` LIKE 'Terrestre'
    group by
    `reboisement`.`region`,`reboisement`.`mangroveOuTerrestre`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs=$db->prepare($sql);
  $reqs->execute();
  $data=$reqs->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data,'Recap_Terrestre_du_'.$index_annee_fin);
  
  $sql1="select
  		`reboisement`.`mangroveOuTerrestre` as `Mangrove`,
    `reboisement`.`region` as `Région`,
		
    sum(`reboisement`.`superficieRealise`) as `Somme de Superficie (Ha)`,
				sum(`plant_mise_terre`.`nombrePlantMiseEnTerre`) as `Somme de Nombre plants mise en terre`
    from `reboisement`
				join plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
				WHERE `plant_mise_terre`.`dateMiseEnTerre` between '$index_annee_deb' and '$index_annee_fin'
				and `reboisement`.`mangroveOuTerrestre` LIKE 'Mangrove'
    group by
    `reboisement`.`region`,`reboisement`.`mangroveOuTerrestre`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs1=$db->prepare($sql1);
  $reqs1->execute();
  $data1=$reqs1->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data1,'Recap_Mangrove_du_'.$index_annee_fin);
  
  
$sql5="select
		`reboisement`.`mangroveOuTerrestre` as `Total`,
    `reboisement`.`region` as `Région`,
		
    sum(`reboisement`.`superficieRealise`) as `Somme de Superficie (Ha)`,
				sum(`plant_mise_terre`.`nombrePlantMiseEnTerre`) as `Somme de Nombre plants mise en terre`
    from `reboisement`
				join plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
				WHERE `plant_mise_terre`.`dateMiseEnTerre` between '$index_annee_deb' and '$index_annee_fin'
    group by
    `reboisement`.`region`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs5=$db->prepare($sql5);
  $reqs5->execute();
  $data5=$reqs5->fetchAll(PDO::FETCH_ASSOC);  
	require_once 'includes/class.csv.php';
	CSV::export($data5,'Recap_Mangrove_du_'.$index_annee_fin);
}