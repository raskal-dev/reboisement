<!-- templates/baseLayout.php -->
<!DOCTYPE html>
<html>
<head>


  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.0.29, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/medd-126x120.png" type="image/x-icon">
  <meta name="description" content="">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/tether/tether.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dropdown/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/socicon/css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="preload" as="style" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/leaflet.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">


</head>
<body >



 <?php



 $vret=array();
 $test=array();
 $whereClauseData = " where 1=1 ";
 $realisationDistrict = false;
 $regiontoDisplay = "";
 $districtregion=[];

 $listChamps=[ array('nom'=>'acteur','libelle'=>'acteur'),
                array('nom'=>'typeActeur','libelle'=>'typeActeur'),
               array('nom'=>'objectifReboisement','libelle'=>'objectifReboisement'),
               array('nom'=>'objectifRpf','libelle'=>'objectifRpf'),
                array('nom'=>'region','libelle'=>'Région'),
                array('nom'=>'district','libelle'=>'district'),
                 array('nom'=>'commune','libelle'=>'commune'),
                array('nom'=>'nomScientifique','libelle'=>'nomScientifique'),
                 array('nom'=>'mangroveOuTerrestre','libelle'=>'mangroveOuTerrestre'),
                 array('nom'=>'Approche','libelle'=>'Approche'),
                array('nom'=>'NOMBRE_PLANTS','libelle'=>'Nombre plants'),
                 array('nom'=>'surfacePrevu','libelle'=>'surfacePrevu'),
                 array('nom'=>'SourcePlant','libelle'=>'SourcePlant'),
              array('nom'=>'annee_reboisement','libelle'=>'annee_reboisement'),
              array('nom'=>'superficieRealise','libelle'=>'Superficie réalisée')];

  $listChampsRegion=[ array('nom'=>'region','libelle'=>'Région/District'),
                      array('nom'=>'surfacePrevu','libelle'=>'Objectif total (en ha)'),
                      array('nom'=>'superficieRealise','libelle'=>'Superficie totale réalisée (en ha)'),
                      array('nom'=>'pourcentage','libelle'=>'Pourcentage totale réalisation %'),
                     ];

  if (isset($_POST['campagne'])){
    $whereClauseData=$whereClauseData." and anneeRebois='".$_POST['campagne']."'";

  }
  if (isset($_POST['regiondisplay'])){
    $whereClauseDataDistrict=$whereClauseData;
    $whereClauseData=$whereClauseData." and region='".$_POST['regiondisplay']."'";

    $regiontoDisplay=$_POST['regiondisplay'];
    $listdistrictregion = getDataToLoad('select * from district where region_libelle="'.$regiontoDisplay.'"');

    $realisationDistrict = true;

      foreach ($listdistrictregion as $row) {
        array_push($districtregion,$row['nom_district']);

     }

  }


  function connect_db()
            {
                $dsn="mysql:dbname=reboisement;host=localhost:3306";

            try
            {

                $connexion=new PDO($dsn,'root','');

                $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            }
            catch(PDOException $e)
            {
            printf("Echec connexion : %s\n",
            $e->getMessage());
            exit();
            }
            return $connexion;
          }

 function base_url(){
   $url = 'http://102.16.25.129/reboisement/reboisementU/reboisement/';

   return $url;
 }





 function getDataToLoad($sqlText)
 {

     $connexion=connect_db();

$result=Array();
$info=$connexion->query($sqlText);

if (isset($info)){
  foreach ($info as $row)
   {

        $result[]=array_map('utf8_encode', $row);
   }
} else {
    $result[]=[];
}

//print_r($result);
     return $result;

 }



 function setDataChart($ar)
 {

     $result=Array();

 if (sizeof($ar)>0){

   foreach ($ar as $row)
    {

         $result[]=$row;
         array_push($result,$row);
    }

 } else {
     $result[]=[];
 }

     return $result;
 }


   $vret=getDataToLoad('select * from v_realisation'.$whereClauseData);
   $dataToload=$vret;
   $x=array();

/***** referentiel****/
   $listregion = getDataToLoad('select * from region');
   $listespece = getDataToLoad('select * from especes');
   $listdistrict = getDataToLoad('select * from district');
   $listcommune = getDataToLoad('select * from commune');
   $listclass = getDataToLoad('select * from class');
   $listtypeacteur = getDataToLoad('select * from type_acteur');
   $listobjectifrpf = getDataToLoad('select * from objectif_rpf');
   $listecosysteme = getDataToLoad('select * from ecosysteme');
   $listfinancement = getDataToLoad('select distinct financement from reboisement order by 1');
   $listaannereboisement = getDataToLoad('select * from annee_reboisement order by periode');
   $campagneencours = getDataToLoad('select * from annee_reboisement where now() BETWEEN date_debut and date_fin');


/***** donnees reboisement****/
   $surfacePrevuNational = getDataToLoad('select sum(surfaceTotalPrevu) totalObjectif,mangroveOuTerrestre from planification '.$whereClauseData.'group by mangroveOuTerrestre');

   $surfacePrevuNationalMangrove = getDataToLoad('select sum(surfaceTotalPrevu) totalObjectif,mangroveOuTerrestre from planification '.$whereClauseData.' and mangroveOuTerrestre="Mangrove" group by mangroveOuTerrestre');

    $surfacePrevuNationalTerrestre = getDataToLoad('select sum(surfaceTotalPrevu) totalObjectif,mangroveOuTerrestre from planification '.$whereClauseData.' and mangroveOuTerrestre="Terrestre" group by mangroveOuTerrestre');

   $surfaceTotale=getDataToLoad('select  sum(superficieRealise) as superficieRealise ,sum(surfacePrevu) as surfacePrevu,sum(nombre_plants) as nombre_plants from v_realisation'.$whereClauseData);

   $nombreActeur =getDataToLoad('select  count(distinct(acteur)) as nombreActeur from v_realisation'.$whereClauseData);

   $annee =getDataToLoad('select  distinct(annee_reboisement) as annee_reboisement from v_realisation'.$whereClauseData);
   $anneeReboisement=array();

   $anneeSuface=getDataToLoad('select sum(superficieRealise) as superficieRealise,sum(surfacePrevu) as surfacePrevu,annee_reboisement from v_realisation '.$whereClauseData.' group by  annee_reboisement order by annee_reboisement');

   $surfaceReboiseeParRegion=getDataToLoad('select ifnull(sum(superficieRealise),0) as superficieRealise ,ifnull(sum(surfaceTotalPrevu),0) as surfacePrevu,a.nom_region as region
from region a left join reboisement b on(a.nom_region = b.region)'.$whereClauseData.'
group by a.nom_region');

       $surfaceReboiseeParDistrict=getDataToLoad('select ifnull(sum(superficieRealise),0) as superficieRealise ,ifnull(sum(surfaceTotalPrevu),0) as surfacePrevu,a.nom_district as region
from district a left join reboisement b on(a.nom_district = b.district)'.$whereClauseData.'
group by a.nom_district');


     $surfacePrevuParRegion = getDataToLoad('select sum(surfaceTotalPrevu) totalObjectif,region from planification'.$whereClauseData.' group by region');

        $surfacePrevuParDistrict = getDataToLoad('select sum(surfaceTotalPrevu) totalObjectif,district from planification'.$whereClauseData.' and district is not null group by district');

   $superficieRealiseRegion = array();
   $surfacePrevuRegion = array();
   $region = array();
     $superficieRealiseDistrict = array();
   $surfacePrevuDistrict = array();
   $district = array();

    foreach ($surfaceReboiseeParRegion as $row) {
        array_push($superficieRealiseRegion,$row['superficieRealise']);
        array_push($region,$row['region']);
   }

      foreach ($surfacePrevuParRegion as $row) {
        array_push($surfacePrevuRegion,$row['totalObjectif']);

   }

      foreach ($surfaceReboiseeParDistrict as $row) {
        array_push($superficieRealiseDistrict,$row['superficieRealise']);
        array_push($district,$row['region']);
   }

      foreach ($surfacePrevuParDistrict as $row) {
        array_push($surfacePrevuDistrict,$row['totalObjectif']);

   }


   $anneeSufaceRealise = array();
   $anneeSufacePrevue = array();

   foreach ($anneeSuface as $row) {
        array_push($anneeReboisement,$row['annee_reboisement']);
        array_push($anneeSufaceRealise,$row['superficieRealise']);
        array_push($anneeSufacePrevue,$row['surfacePrevu']);
   }

   $surfaceParTypeActeur=getDataToLoad('select sum(superficieRealise) as superficieRealise,typeActeur from reboisement'.$whereClauseData.' group by typeActeur');
   $surfaceRealiseParActeur=array();
   $typeActeur = array();

   foreach ($surfaceParTypeActeur as $row){

      array_push($surfaceRealiseParActeur,$row['superficieRealise']);
      array_push($typeActeur,$row['typeActeur']);
   };

   $surfaceParObjectifRpf=getDataToLoad('select sum(superficieRealise) as superficieRealise,objectifRpf from reboisement '.$whereClauseData.'group by objectifRpf');
   $surfaceRealiseParObjectifRpf=array();
   $objectifRpf = array();

   foreach ($surfaceParObjectifRpf as $row){

      array_push($surfaceRealiseParObjectifRpf,$row['superficieRealise']);
      array_push($objectifRpf,$row['objectifRpf']);
   }

     $surfaceParObjectifReboisement=getDataToLoad('select sum(superficieRealise) as superficieRealise,objectifReboisement from reboisement'.$whereClauseData.' group by objectifReboisement');
   $surfaceRealiseParObjectifReboisement=array();
   $objectifReboisement = array();

   foreach ($surfaceParObjectifReboisement as $row){

      array_push($surfaceRealiseParObjectifReboisement,$row['superficieRealise']);
      array_push($objectifReboisement,$row['objectifReboisement']);
   }

       $surfaceParOrganisme=getDataToLoad('select sum(superficieRealise) as superficieRealise,financement from reboisement '.$whereClauseData.'group by financement');
   $surfaceRealiseParOrganisme=array();
   $organisme = array();

   foreach ($surfaceParOrganisme as $row){

      array_push($surfaceRealiseParOrganisme,$row['superficieRealise']);
      array_push($organisme,$row['financement']);
   }


   $surfacePlanifie = getDataToLoad('select round(sum(surfaceTotalPrevu)) as surfaceTotalPlanifie from planification'.$whereClauseData.' group by anneeRebois');

   $surfacePlanifieRegion = getDataToLoad('select ifnull(round(sum(surfaceTotalPrevu)),0) as surfacePrevu,a.nom_region as region
              from region a left join planification b on(a.nom_region = b.region)'.$whereClauseData.'
              group by a.nom_region');


   $surfacePlanifieRegionMangrove = getDataToLoad('select ifnull(sum(surfaceTotalPrevu),0) as surfacePrevu,a.nom_region as region from region a left join planification b on(a.nom_region = b.region) '.$whereClauseData.' and mangroveOuTerrestre="Mangrove" group by a.nom_region');
    $surfacePlanifieRegionTerrestre = getDataToLoad('select ifnull(sum(surfaceTotalPrevu),0) as surfacePrevu,a.nom_region as region from region a left join planification b on(a.nom_region = b.region) '.$whereClauseData.'and mangroveOuTerrestre="Terrestre" group by a.nom_region');

   $surfaceRealiseEnCours=getDataToLoad('select sum(superficieRealise) as superficieRealise  from reboisement '.$whereClauseData);
   $surfaceRealiseEnCoursMangrove=getDataToLoad('select sum(superficieRealise) as superficieRealise  from reboisement '.$whereClauseData.' and mangroveOuTerrestre="Mangrove" ');

    $surfaceRealiseEnCoursTerrestre=getDataToLoad('select sum(superficieRealise) as superficieRealise  from reboisement '.$whereClauseData.' and mangroveOuTerrestre="Terrestre" ');

   $nombrePlantsEnCours=getDataToLoad('select ifnull(sum(nombrePlantMiseEnTerre),0) as nombre_plants from plant_mise_terre where reboisement_id in (select id from reboisement '.$whereClauseData.') ');

   $nombrePlantsEnCoursMangrove=getDataToLoad('select ifnull(sum(nombrePlantMiseEnTerre),0) as nombre_plants from plant_mise_terre where reboisement_id in (select id from reboisement '.$whereClauseData.'and mangroveOuTerrestre="Mangrove")');

   $nombrePlantsEnCoursTerrestre=getDataToLoad('select ifnull(sum(nombrePlantMiseEnTerre),0) as nombre_plants from plant_mise_terre where reboisement_id in (select id from reboisement '.$whereClauseData.'and mangroveOuTerrestre="Terrestre")');

   $pourcentageRealisationEnCours =(isset($surfacePlanifie[0]['surfaceTotalPlanifie']) ? number_format(100*((float)(isset($surfaceRealiseEnCours[0]['superficieRealise'])?  $surfaceRealiseEnCours[0]['superficieRealise']:  0)/(float)(isset($surfacePlanifie[0]['surfaceTotalPlanifie'])?  $surfacePlanifie[0]['surfaceTotalPlanifie']:  0)),2) :0);

    $pourcentageRealisationEnCoursTerrestre =(isset($surfacePrevuNationalTerrestre[0]['totalObjectif']) ? number_format(100*((float)(isset($surfaceRealiseEnCoursTerrestre[0]['superficieRealise'])?  $surfaceRealiseEnCoursTerrestre[0]['superficieRealise']:  0)/(float)(isset($surfacePrevuNationalTerrestre[0]['totalObjectif'])?  $surfacePrevuNationalTerrestre[0]['totalObjectif']:  0)),2) :0);

     $pourcentageRealisationEnCoursMangrove =(isset($surfacePrevuNationalMangrove[0]['totalObjectif']) ? number_format(100*((float)(isset($surfaceRealiseEnCoursMangrove[0]['superficieRealise'])?  $surfaceRealiseEnCoursMangrove[0]['superficieRealise']:  0)/(float)(isset($surfacePrevuNationalMangrove[0]['totalObjectif'])?  $surfacePrevuNationalMangrove[0]['totalObjectif']:  0)),2) :0);

if ($realisationDistrict){
   $realisationParRegion = getDataToLoad('select ifnull(round(sum(b.surfaceTotalPrevu)),0) as surfacePrevu,ifnull(round(sum(superficieRealise)),0) as superficieRealise,a.nom_district as region,ifnull(round(100*(ifnull(sum(superficieRealise),0)/ifnull(sum(b.surfaceTotalPrevu),0)),2),0) as pourcentage
from district a left join planification b on(a.nom_district = b.district)
left join reboisement c on (a.nom_district =c.district)'.$whereClauseDataDistrict.'and a.region_libelle="'.$regiontoDisplay.'" group by a.nom_district');
}
else{
    $realisationParRegion = getDataToLoad('select ifnull(round(sum(b.surfaceTotalPrevu)),0) as surfacePrevu,ifnull(round(sum(superficieRealise)),0) as superficieRealise,a.nom_region as region,ifnull(round(100*(ifnull(sum(superficieRealise),0)/ifnull(sum(b.surfaceTotalPrevu),0)),2),0) as pourcentage
                                          from region a left join planification b on(a.nom_region = b.region)
                                          left join reboisement c on (a.nom_region =c.region) '.$whereClauseData.'
                                          group by a.nom_region');

}


  ?>


<div id="analysebody">
      <section class="content-header">
        <div class="row">
            <div class="col-8 col-md-8 col-sm-8 align-left">
                <h3 class="mbr-section-title mb-0 ml-4 mbr-fonts-style display-5">
                    <strong>Analyse des données</strong>
                </h3>

            </div>
               <div class="col-4 col-md-4 col-sm-4  align-right ">
                  <ol class="breadcrumb float-sm-right">
                    <select id='searchByCampagne' class="form-control form-control-sm">
                                                        <option value=''> Autres campagnes </option>
                                                        <?php
                                                             foreach ($listaannereboisement as $row):
                                                              echo '<option value="'.$row["periode"].'">'. 'Période ' .$row["periode"].'</option>';
                                                             endforeach;

                                                       ?>

                    </select>

                  </ol>
               </div>
        </div>

    </section>

    <section >

        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-12">
                      <div class="row">
                            <div class="col-md-12">
                                <p class="mbr-text mbr-fonts-style display-7"></p>
                                    <section class="features22 cid-t5wQ6ue0lw " id="features23-15">
                                        <div >
                                        <h5 class="mbr-section-title mbr-fonts-style align-center mb-0 ">
                                        <strong> Suivi campagne en cours </strong></h5><br>

                                         </div>
                                          <div class="col-12 col-md-12 ">
                                             <h5 >
                                                     <select id='analyseRegion' class="form-control form-control-sm">
                                                        <option value=''> Niveau national </option>
                                                        <?php
                                                             foreach ($listregion as $row):
                                                              echo '<option value="'.$row["nom_region"].'">'. 'Région ' .$row["nom_region"].'</option>';
                                                             endforeach;

                                                       ?>

                                                </select>
                                                </h5>
                                            </div>

                                     </section>
                                         <section class="content">
                                             <div class="row">

                                            <div class="col-md-6 col-sm-6 col-12 ">

                                                    <div class="info-box text-center bg-light">
                                                        <span class="info-box-icon bg-info" style="width:120px"><i class="fas fa-chart-area"></i></span>

                                                            <div class="info-box-content mt-4" style="height:105px">

                                                                <h4 class="description-header description-text">Objectif total</h4>
                                                                <h5 class="info-box-number"><?php echo isset($surfacePlanifie[0]['surfaceTotalPlanifie'])?  number_format(round($surfacePlanifie[0]['surfaceTotalPlanifie']),0,',',' '):  0?> ha</h5>
                                                <ul>
                                                <li>
                                                <div class="row mb-0">
                                                <div class="col-6 text-center">
                                                <div class="description-block border-right graphe text-warning" id="objectifTerrestre">
                                                 <span class="info-box-number"><?php echo isset($surfacePrevuNationalTerrestre[0]['totalObjectif'])?  number_format(round($surfacePrevuNationalTerrestre[0]['totalObjectif']),0,',',' '):  0?> ha</span><span class="h5">Terrestre</span>


                                                </div>
                                                </div>
                                                <div class="col-6 text-center">
                                                 <div class="description-block border-right graphe text-red " id="Objectifmangrove" >
                                                  <span class="info-box-number"><?php echo isset($surfacePrevuNationalMangrove[0]['totalObjectif'])?  number_format(round($surfacePrevuNationalMangrove[0]['totalObjectif']),0,',',' '):  0?> ha</span><span class="h5">Mangrove</span>

                                                </div>
                                                </div>
                                               </div>
                                              </li>
                                              </ul>

                                          </div>
                                                </div>
                                                </div>

                                           <div class="col-md-6 col-sm-6 col-12 ">

                                                    <div class="info-box text-center bg-light">
                                                        <span class="info-box-icon bg-warning" style="width:120px"><i class="fas fa-tree"></i></span>

                                                            <div class="info-box-content mt-4" style="height:105px">

                                                                <h4 class="description-header description-text">Surface totale reboisée</h4>
                                                                <h5 class="info-box-number"><?php echo isset($surfaceRealiseEnCours[0]['superficieRealise'])?  number_format(round($surfaceRealiseEnCours[0]['superficieRealise']),0,',',' '):  0?> ha</h5>
                                                <ul>
                                                <li>
                                                <div class="row mb-0">
                                                <div class="col-6 text-center">
                                                <div class="description-block border-right graphe text-success" id="objectifTerrestre">
                                                 <span class="info-box-number"><?php echo isset($surfaceRealiseEnCoursTerrestre[0]['superficieRealise'])?  number_format(round($surfaceRealiseEnCoursTerrestre[0]['superficieRealise']),0,',',' '):  0?> ha</span><span class="h5">Terrestre</span>


                                                </div>
                                                </div>
                                                <div class="col-6 text-center">
                                                 <div class="description-block border-right graphe text-primary " id="Objectifmangrove" >
                                                  <span class="info-box-number"><?php echo isset($surfaceRealiseEnCoursMangrove[0]['superficieRealise'])?  number_format(round($surfaceRealiseEnCoursMangrove[0]['superficieRealise']),0,',',' '):  0?> ha</span><span class="h5">Mangrove</span>

                                                </div>
                                              </div>
                                          </div>
                                              </li>
                                              </ul>

                                          </div>
                                                </div>
                                                </div>




                                           </div>
                                            <div class="row">

                                            <div class="col-md-6 col-sm-6 col-12 ">

                                                    <div class="info-box text-center bg-light">
                                                         <span class="info-box-icon bg-success" style="width:120px"><i class="bi bi-flower3"></i></span>


                                                            <div class="info-box-content mt-4" style="height:105px">

                                                                <h4 class="description-header description-text">Nombre total de plants mis en terre</h4>
                                                                <h5 class="info-box-number"><?php echo isset($nombrePlantsEnCours[0]['nombre_plants'])?  number_format(round($nombrePlantsEnCours[0]['nombre_plants']),0,',',' '):  0?></h5>
                                                <ul>
                                                <li>
                                                <div class="row mb-0">
                                                <div class="col-6 text-center">
                                                <div class="description-block border-right graphe text-secondary" id="objectifTerrestre">
                                                 <span class="info-box-number"><?php echo isset($nombrePlantsEnCoursTerrestre[0]['nombre_plants'])?  number_format(round($nombrePlantsEnCoursTerrestre[0]['nombre_plants']),0,',',' '):  0?></span><span class="h5">Terrestre</span>


                                                </div>
                                                </div>
                                                <div class="col-6 text-center">
                                                 <div class="description-block border-right graphe text-success " id="Objectifmangrove" >
                                                  <span class="info-box-number"><?php echo isset($nombrePlantsEnCoursMangrove[0]['nombre_plants'])?  number_format(round($nombrePlantsEnCoursMangrove[0]['nombre_plants']),0,',',' '):  0?></span><span class="h5">Mangrove</span>

                                                </div>
                                              </div>
                                          </div>
                                              </li>
                                              </ul>

                                          </div>
                                                </div>
                                                </div>

                                           <div class="col-md-6 col-sm-6 col-12 ">

                                                    <div class="info-box text-center bg-light">
                                                        <span class="info-box-icon bg-primary" style="width:120px"><i class="fas fa-users"></i></span>

                                                            <div class="info-box-content mt-4" style="height:105px">

                                                                <h4 class="description-header description-text">Pourcentage total de réalisation</h4>
                                                                <h5 class="info-box-number"><?php echo isset($pourcentageRealisationEnCours)?  $pourcentageRealisationEnCours:  0?>%</h5>
                                                <ul>
                                                <li>
                                                <div class="row mb-0">
                                                <div class="col-6 text-center">
                                                <div class="description-block border-right graphe text-dark" id="objectifTerrestre">
                                                 <span class="info-box-number"><?php echo isset($pourcentageRealisationEnCoursTerrestre)?  $pourcentageRealisationEnCoursTerrestre:  0?>%</span><span class="h5">Terrestre</span>


                                                </div>
                                                </div>
                                                <div class="col-6 text-center">
                                                 <div class="description-block border-right graphe text-info " id="Objectifmangrove" >
                                                  <span class="info-box-number"><?php echo isset($pourcentageRealisationEnCoursMangrove)?  $pourcentageRealisationEnCoursMangrove:  0?>%</span><span class="h5">Mangrove</span>

                                                </div>
                                              </div>
                                          </div>
                                              </li>
                                              </ul>

                                          </div>
                                                </div>
                                                </div>




                                           </div>

                                       </section>
                                         <section class="content">
                                             <div class="card-body" id='data-container-region' style="color:black;align-content: center;">

                                                           <div class="card-header">
                                                             <h5 class="card-title m-0"><strong>Réalisation région</strong></h5>
                                                           </div>
                                                           <div class="card-body" >
                                                             <table id="tabDataRegion" class="display" style="width:100%;font-weight:400">


                                                             </table>
                                                           </div>

                                             </div>
                                  </section>
                                  <section class="pricing1 cid-t5wBgBsKYz" id="pricing1-13">
                                     <div class="row ">
                                            <div class="card col-6 col_md-6 col-lg-6">
                                                <div class="card-wrapper">
                                                     <div class="card-box ">
                                                         <p class="text-center">
                                                      <strong>Surface reboisée par type d'acteur:</strong>
                                                    </p>

                                                    <div class="chart">
                                                      <!-- Sales Chart Canvas -->
                                                       <canvas id="donutChart" ></canvas>
                                                    </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="card col-6 col_md-6 col-lg-6">
                                                <div class="card-wrapper">
                                                    <div class="card-box ">
                                                         <p class="text-center">
                                                      <strong>Surface reboisée par organisme d'appui:</strong>
                                                    </p>

                                                    <div class="chart" >
                                                      <!-- Sales Chart Canvas -->
                                                       <canvas id="pieChart2" ></canvas>
                                                    </div>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                  <div class="row ">
                                                      <div class="card col-12 col-lg-12">
                                                <div class="card-wrapper">
                                                      <div class="card-box ">
                                                         <p class="text-center">
                                                      <strong>Surface reboisée par région/district:</strong>
                                                    </p>

                                                    <div class="chart">
                                                      <!-- Sales Chart Canvas -->
                                                       <canvas id="barChart" style='height:300px'></canvas>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </section>

                                <section class="pricing1 cid-t5wBgBsKYz" id="pricing1-13">

                                            <div class="row ">
                                            <div class="card col-12 col-lg-6">
                                                <div class="card-wrapper">
                                                    <div class="card-box ">
                                                         <p class="text-center">
                                                      <strong>Surface reboisée par objectif RPF:</strong>
                                                    </p>

                                                    <div class="chart">
                                                      <!-- Sales Chart Canvas -->
                                                       <canvas id="pieChart" ></canvas>
                                                    </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="card col-12 col-lg-6">
                                                <div class="card-wrapper">
                                                     <div class="card-box ">
                                                         <p class="text-center">
                                                      <strong>Surface reboisée par objectif reboisement:</strong>
                                                    </p>

                                                    <div class="chart" >
                                                      <!-- Sales Chart Canvas -->
                                                       <canvas id="donutChart2" ></canvas>
                                                    </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                </section>


            <section >

            <section>

            <div class="card " >

                           <div class="card-header border-0">
                             <div class="d-flex justify-content-between">
                               <h4 class="card-title"><strong>Filtre</strong> </h4>
                                   <div class="card-tools">
                                    <a href="#" onclick="initializeFilter()"><strong>Réinitialiser tous les filtres</strong></a>
                                    </div>
                             </div>
                           </div>


           <div class="card-body">
                 <div class="col-12 col-md-12 text-center"><h6><strong> Superficie reboisée et nombre de plants mise en terre suivant filtre</strong></h6>
                </div>
                 <div class='row'>
                  <div class="col-12 col-sm-12 col-md-12 ">

                          <div class="col-12 form-group">
                      <label>Régions</label>
                      <select id='searchByRegion' class="form-control form-control-sm region" multiple="multiple" data-placeholder="Séléctionner région" style="width: 100%;">

                       <?php
                              foreach ($listregion as $row):
                               echo '<option value="'.$row["nom_region"].'">'. $row["nom_region"].'</option>';
                              endforeach;
                        ?>
                     </select>


                    </div>
                      </div>
                 </div>
                 <div class="row">

                  <div class="col-2 col-sm-2 col-md-2" >
                        <input type="text" class="form-control form-control-sm" id="datedebut" placeholder="Du" />
                   </div>

                 <div class="col-2 col-sm-2 col-md-2">

                              <input type="text" class="form-control form-control-sm" id="datefin" placeholder="au" />
                </div>

                  <div class="col-2 col-sm-2 col-md-2" id="divDistrict">

                  <select id='district'  class="form-control form-control-sm">
                     <option value=''> District </option>
                      <?php
                         foreach ($listdistrict as $row):
                          echo '<option value="'.$row["nom_district"].'">'. $row["nom_district"].'</option>';
                         endforeach;

                      ?>

                  </select>

                  </div>
                  <div class="col-3 col-sm-3 col-md-3">

                  <select id='commune'  class="form-control form-control-sm">
                     <option value=''> Commune </option>
                      <?php
                         foreach ($listcommune as $row):
                          echo '<option value="'.$row["nom_commune"].'">'. $row["nom_commune"].'</option>';
                         endforeach;

                      ?>

                  </select>

                  </div>

                    <div class="col-3 col-sm-3 col-md-3">


                  <select id='searchByActeur'  class="form-control form-control-sm" >
                    <option value=''> Type acteur </option>
                     <?php
                         foreach ($listtypeacteur as $row):
                          echo '<option value="'.$row["type_acteur"].'">'. $row["type_acteur"].'</option>';
                         endforeach;

                   ?>

                  </select>
                 </div>
              </div>
              <div class="row">

                 <div class="col-2 col-sm-2 col-md-2">

                  <select id='searchByObjectifRPF'  class="form-control form-control-sm" >
                     <option value=''> Objectif RPF </option>
                     <?php
                         foreach ($listobjectifrpf as $row):
                          echo '<option value="'.$row["LIBELLE_OBJECTIF_RPF"].'">'. $row["LIBELLE_OBJECTIF_RPF"].'</option>';
                         endforeach;

                   ?>

                  </select>

                  </div>

                   <div class="col-2 col-sm-2 col-md-2">

                      <select id='searchByEcosysteme'  class="form-control form-control-sm" >
                         <option value=''> Ecosystème </option>
                         <?php
                         foreach ($listecosysteme as $row):
                          echo '<option value="'.$row["LIBELLE_ECOSYSTEME"].'">'. $row["LIBELLE_ECOSYSTEME"].'</option>';
                         endforeach;

                   ?>

                      </select>
                   </div>

                    <div class="col-2 col-sm-2 col-md-2">
                  <select id='searchByEspeces'  class="form-control form-control-sm">
                     <option value=''> Especes </option>
                        <?php
                         foreach ($listespece as $row):
                          echo '<option value="'.$row["especes_nom"].'">'. $row["especes_nom"].'</option>';
                         endforeach;

                   ?>
                  </select>
                  </div>

              <div class="col-3 col-sm-3 col-md-3">

                  <select id='searchByParcelle'  class="form-control form-control-sm">
                    <option value=''> Superficie parcelle (en ha) </option>
                     <?php
                         foreach ($listclass as $row):
                          echo '<option value="'.$row["class"].'">'. $row["class"].'</option>';
                         endforeach;

                   ?>

                  </select>
              </div>
              <div class="col-3 col-sm-3 col-md-3">

                  <select id='searchByOrganisme'  class="form-control form-control-sm">
                    <option value=''> Financement </option>
                    <?php
                         foreach ($listfinancement as $row):
                          echo '<option value="'.$row["financement"].'">'. $row["financement"].'</option>';
                         endforeach;

                   ?>
                  </select>
              </div>
          </div>

          <div class='row'>
                  <div class="col-12 col-sm-12 col-md-12 " >

                         <button type="button" class="btn btn-block btn-success btn-sm" id="afficher">Afficher</button>

                      </div>
         </div>


         </div>



       </div>

</section>
<section>


             <div  id="filtre" class="text-success">

             </div>


</section>
<section>

          <div class="card">


                         <div class="card-header">
                           <h5 class="card-title m-0"><strong>Réalisation</strong></h5>
                         </div>
                         <div class="card-body" id='data-container'>
                           <table id="tabData" class="display" style="width:100%;font-weight:400">


                           </table>
                         </div>


             </div>


</section>
</section>

                            </div>
                        </div>

        </div>

</section>


</div>





<style type="text/css">
 #analysemulticritere{
     height: 750px;
     width: 100%;
     border: none;
     scrolling : no;
     overflow: hidden;

 }
 .bg-card{
   background-color: #92bc7d !important;
 }


</style>


<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.checkboxes.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.css">

<script src="<?php echo base_url();?>assets/js/dataTables.select.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/reboisement.css">


<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/chart.js/Chart.min.js"></script>
 <script src="<?php echo base_url();?>assets/popper/popper.min.js"></script>
 <script src="<?php echo base_url();?>assets/tether/tether.min.js"></script>
 <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
 <script src="<?php echo base_url();?>assets/smoothscroll/smooth-scroll.js"></script>
 <script src="<?php echo base_url();?>assets/dropdown/js/nav-dropdown.js"></script>
 <script src="<?php echo base_url();?>assets/dropdown/js/navbar-dropdown.js"></script>
 <script src="<?php echo base_url();?>assets/touchswipe/jquery.touch-swipe.min.js"></script>
 <script src="<?php echo base_url();?>assets/theme/js/script.js"></script>
<script src="<?php echo base_url();?>assets/js/leaflet.js"></script>
<script src="<?php echo base_url();?>assets/js/leaflet.shpfile.js"></script>
<script src="<?php echo base_url();?>assets/js/shp.js"></script>
 <script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript">



 $('.region').select2();
 $('#datedebut').datepicker();
 $('#datefin').datepicker();
 regiontoDisplay = "<?php echo $regiontoDisplay ?>";
 realisationDistrict =  "<?php echo $realisationDistrict ?>";


 $('#analyseRegion').val(regiontoDisplay);
 $('#analyseRegion').change(function(){

    var value = $('#analyseRegion').val();
     $.ajax({
         type: 'POST',
        data:{'regiondisplay':value},
        dataType:'html',
        success: function (e) {

            var newHTML = document.open("text/html", "replace");
            newHTML.write(e);
            newHTML.close();

        },
        before:function(e){

        },
         error :  function(e){
            console.log(e);
                               }
    });


 });


  $('#searchByRegion').change(function () {

     var url="<?php echo base_url();?>";

     if (($('#searchByRegion').val()).length >1 ){

   var choixregion = $('#searchByRegion').val();
   var arrayRegion = [];

        for (var region of Object.keys(choixregion)) {
            var uneregion = "'"+choixregion[region]+"'";
            arrayRegion.push(uneregion);

        }

    }
 else if ($('#searchByRegion').val().length =1){

         arrayRegion = "'"+$('#searchByRegion').val()+"'";
    };


    sql = "select * from district where region_libelle in ("+ arrayRegion +")  ";

      htmlDistrict="<select id='district'  class='form-control form-control-sm'><option value=''> District </option>";

    $.post("<?php echo base_url();?>"+"index.php/activite.php/getList", {sql: sql}, function(result){

      const obj = JSON.parse(result);
       $.each(obj, function(key, value) {

          htmlDistrict=htmlDistrict+'<option value="'+value["nom_district"]+'">'+ value["nom_district"]+'</option>';
                      });
              htmlDistrict=htmlDistrict+"</select>";

               htmlDistrict=htmlDistrict+"</select>";
               $("#district").html="";
               $("#district").html(htmlDistrict);
    });

  });


  $('#district').change(function () {


     var url="<?php echo base_url();?>";
      arraydistrict = "'"+$('#district').val()+"'";

    sql = "select * from commune where nom_district in ("+ arraydistrict +")  ";

     console.log(sql);

      htmlCommune="<select id='commune' class='form-control form-control-sm'><option value=''> Commune </option>";


    $.post(url+"index.php/activite.php/getList", {sql: sql}, function(result){
      const obj = JSON.parse(result);

       $.each(obj, function(key, value) {
          htmlCommune=htmlCommune+"<option value="+value['nom_commune']+">"+value['nom_commune']+"</option>";
                      });
              htmlCommune=htmlCommune+"</select>";
               $("#commune").html="";
               $("#commune").html(htmlCommune);
    });

  });




var arrayCol = <?php echo json_encode($listChamps); ?>;

var cols =[];
 for (var i=0; i<arrayCol.length;i++){
   if (arrayCol[i].type !=='select'){

     aCol ={};
              aCol.data=arrayCol[i].nom;
              aCol.title=arrayCol[i].libelle;
              cols.push(aCol);
   }

 }

var dataSet=<?php echo json_encode($dataToload); ?>;


var btn=[];

 var btn=[
               {extend: 'excelHtml5',
                filename: function(){
                         var d = new Date();
                         var t = "Export";
                         var n = d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear();
                         return t + '-' + n;
                                         },
                 text: '<i class="fas fa-file-excel">Export excel</i>'

               }
             ];

   var lang= {
                            processing:     "Traitement en cours...",
                            search:         "Rechercher&nbsp;:",
                            lengthMenu:     "Afficher _MENU_ &eacute;l&eacute;ments",
                            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                            infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                            infoPostFix:    "",
                            loadingRecords: "Chargement en cours...",
                            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                            emptyTable:     "Aucune donnée disponible dans le tableau",
                            paginate: {
                                first:      "Premier",
                                previous:   "Pr&eacute;c&eacute;dent",
                                next:       "Suivant",
                                last:       "Dernier"
                            },
                            "select": {
                            "rows": {
                                "_": ".   %d lignes sélectionnées",
                                "0": ".   Aucune ligne sélectionnée",
                                "1": ".   1 ligne sélectionnée"
                            }
                            },
                            aria: {
                                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                                sortDescending: ": activer pour trier la colonne par ordre décroissant"
                            }
                        };



var tab=$('#tabData').DataTable( {
               aaData: dataSet,
               dataType: 'json',
               dom: 'iftrpB',
               select: 'single',
               scrollX:true,
               columns: cols,
               buttons: btn,
               language: lang,
               pageLength:10,
               columnDefs : [
                  { visible: false,
                   targets: [0,1,2,3,5,6,7,8,9,11,12,13],
                   className: 'dt-body-right',
                   render: $.fn.dataTable.render.number(' ', '.', 2, '') }
                 ]

               } );


var btns=[];


 var totalTableau=getTotalRow();
 //var footer = "<td>"+ totalTableau['TOTAL_NOMBRE_PLANTS'] +"</td><td>"+totalTableau['TOTAL_SURFACE_REALISE']+"</td>";
 //$("tfoot").empty().append(footer);
displayDataRegion();


 function displayDataRegion(){


   var arrayColRegion = <?php echo json_encode($listChampsRegion); ?>;

   var colsRegion =[];
    for (var i=0; i<arrayColRegion.length;i++){
      if (arrayColRegion[i].type !=='select'){

        aCol ={};
                 aCol.data=arrayColRegion[i].nom;
                 aCol.title=arrayColRegion[i].libelle;
                 colsRegion.push(aCol);
      }

    }

   var dataSetRegion=<?php echo json_encode($realisationParRegion); ?>;


   var btnRegion=[];

    var btnRegion=[
                  {extend: 'excelHtml5',
                   filename: function(){
                            var d = new Date();
                            var t = "Export";
                            var n = d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear();
                            return t + '-' + n;
                                            },
                    text: '<i class="fas fa-file-excel">Export excel</i>'

                  }
                ];

      var langRegion= {
                               processing:     "Traitement en cours...",
                               search:         "Rechercher&nbsp;:",
                               lengthMenu:     "Afficher _MENU_ &eacute;l&eacute;ments",
                               info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                               infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                               infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                               infoPostFix:    "",
                               loadingRecords: "Chargement en cours...",
                               zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                               emptyTable:     "Aucune donnée disponible dans le tableau",
                               paginate: {
                                   first:      "Premier",
                                   previous:   "Pr&eacute;c&eacute;dent",
                                   next:       "Suivant",
                                   last:       "Dernier"
                               },
                               "select": {
                               "rows": {
                                   "_": ".   %d lignes sélectionnées",
                                   "0": ".   Aucune ligne sélectionnée",
                                   "1": ".   1 ligne sélectionnée"
                               }
                               },
                               aria: {
                                   sortAscending:  ": activer pour trier la colonne par ordre croissant",
                                   sortDescending: ": activer pour trier la colonne par ordre décroissant"
                               }
                           };



   var tabRegion=$('#tabDataRegion').DataTable( {
                  aaData: dataSetRegion,
                  dataType: 'json',
                  dom: 'iftrpB',
                  select: 'single',
                  scrollX:true,
                  columns: colsRegion,
                  buttons: btnRegion,
                  language: langRegion,
                  pageLength:12,
                   columnDefs: [
                            {
                                targets: "_all",
                                className: 'dt-body-right',
                                render: $.fn.dataTable.render.number(' ', '.', 2, '')
                            }
                          ]
                  } );

   var btnsRegion=[];

}

 function getTotalRow(){
  var totalPlants =0;
  var totalSurfaceReboisee =0;
  var total=[];

   tab.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
    var data = this.data();
    totalPlants = parseInt(totalPlants)+parseInt(data['NOMBRE_PLANTS']);
    totalSurfaceReboisee = (parseFloat(totalSurfaceReboisee)+parseFloat(data['superficieRealise'])).toFixed(4);
  } );

   total['TOTAL_NOMBRE_PLANTS']=totalPlants;
   total['TOTAL_SURFACE_REALISE']=totalSurfaceReboisee;

  return total;
}



$('#afficher').click(function(){



     if (($('#searchByRegion').val()).length >1 ){

               var choixregion = $('#searchByRegion').val();
               var arrayRegion = [];

                    for (var region of Object.keys(choixregion)) {
                        var uneregion = "'"+choixregion[region]+"'";
                        arrayRegion.push(uneregion);

                    }

                }
             else if ($('#searchByRegion').val().length =1){

                     arrayRegion = "'"+$('#searchByRegion').val()+"'";
                };

        var anneeDebut = ($('#datedebut').val()==''?' - ':$('#datedebut').val());
        var anneeFin = ($('#datefin').val()==''?' - ':$('#datefin').val());
        var objectifRpf  = ($('#searchByObjectifRPF').val()==''?' tous ':$('#searchByObjectifRPF :selected').text());
        var searchByEcosysteme = ($('#searchByEcosysteme').val()==''?' Terrestre et mangrove ':$('#searchByEcosysteme :selected').text());
        var searchByEspeces  = ($('#searchByEspeces').val()==''?' tous ':$('#searchByEspeces :selected').text());
        var searchByActeur = ($('#searchByActeur').val()==''?' tous ':$('#searchByActeur :selected').text());
        var searchByRegion = ($('#region').val()==''?' tous ':arrayRegion);
        var classParcelle  = ($('#searchByParcelle').val()==''?' tous ':$('#searchByParcelle :selected').text());
        var organisme = ($('#searchByOrganisme').val()==''?' tous ':$('#searchByOrganisme :selected').text());
        var district  = ($('#district').val()==''?' tous ':$('#district :selected').text());
        var commune = ($('#commune').val()==''?' tous ':$('#commune :selected').text());

        var htmlFiltre =" <p></br><span ><i>Période du </i>  "+anneeDebut +"<i> au </i>"+ anneeFin  +"- <i> Objectif:  </i>"+objectifRpf +" - <i>Ecosystème: </i>"+ searchByEcosysteme +"- <i>Espèces: </i>"+ searchByEspeces +" - <i>Acteur: </i>"+ searchByActeur +"</span></br><span ><i>Région </i>  "+searchByRegion +"<i> District </i>"+ district  +"- <i> Commune:  </i>"+commune +" - <i>Classe superficie: </i>"+ classParcelle +" - <i>Financement: </i>"+ organisme +"</span></p>";

        $('#filtre').empty().append( htmlFiltre);


        dateDebut=$("#datedebut").val();
        dateFin=$("#datefin").val();
        objectifRpf=$("#searchByObjectifRPF").val();
        ecosysteme=$("#searchByEcosysteme").val();
        espece=$("#searchByEspeces").val();
        typeacteur=$("#searchByActeur").val();
        region = arrayRegion;
        classParcelle  = $('#searchByParcelle').val();
        organisme = $('#searchByOrganisme').val();
        district  = $('#district').val();
        commune = $('#commune').val();


        updateTable(dateDebut,dateFin,objectifRpf,ecosysteme,espece,region,typeacteur,classParcelle,organisme,district,commune);

  });




   function updateTable(dateDebut,dateFin,objectifRpf,ecosysteme,espece,region,acteur,classParcelle,organisme,district,commune){

    var baseUrl="<?php echo base_url();?>";
    var action = baseUrl+"index.php/activite.php/getDataToLoadWithFilterDynamique.php";


                   var $this = $(this);

                            $.ajax({
                               url: action,
                               type:"POST",
                               dataType: "html",
                               data:{dateDebut:dateDebut,dateFin:dateFin,objectifRpf:objectifRpf,ecosysteme:ecosysteme,espece:espece,region:region,typeacteur:typeacteur,classParcelle:classParcelle,organisme:organisme,district:district,commune:commune},
                               success: function(response,e) {
                                   console.log(response);
                                   $("#data-container").empty().append(response);

                                   e.preventDefault;


                               },
                               error :  function(e){

                                  console.log(e);
                               }
                          });

}



  function initializeFilter(){

   $("option:selected").prop("selected", false);

    id_region = '';
    libelle_region = '';
    $("#datedebut").val('');
    $("#datefin").val('');
    $('#searchByRegion').val('');
    $('#searchByRegion').trigger('change');

    var htmlfiltre= "Aucun filtre appliqué.";


     $('#filtre').empty().append( htmlfiltre);



        dateDebut=$("#datedebut").val();
        dateFin=$("#datefin").val();
        objectifRpf=$("#searchByObjectifRPF").val();
        ecosysteme=$("#searchByEcosysteme").val();
        espece=$("#searchByEspeces").val();
        typeacteur=$("#searchByActeur").val();
        region = '';
        classParcelle  = $('#searchByParcelle').val();
        organisme = $('#searchByOrganisme').val();
        district  = $('#district').val();
        commune = $('#commune').val();

         $("#data-container").empty();

  }




</script>
<script>

var an=<?php echo json_encode($anneeReboisement);?>;
var sr=<?php echo json_encode($anneeSufaceRealise);?>;
var sp=<?php echo json_encode($anneeSufacePrevue);?>;
var sta=<?php echo json_encode($surfaceRealiseParActeur);?>;
var ta=<?php echo json_encode($typeActeur);?>;
var srObjRpf=<?php echo json_encode($surfaceRealiseParObjectifRpf);?>;
var objRpf=<?php echo json_encode($objectifRpf);?>;
var srObjR=<?php echo json_encode($surfaceRealiseParObjectifReboisement);?>;
var objR=<?php echo json_encode($objectifReboisement);?>;
var srOrg=<?php echo json_encode($surfaceRealiseParOrganisme);?>;
var org=<?php echo json_encode($organisme);?>;
  // Get context with jQuery - using jQuery's .get() method.
 /* var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

  var salesChartData = {
    labels: an,
    datasets: [
      {
        label: 'Surface realisée',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: sr
      },
      {
        label: 'Surface prevue',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data:sp
      }
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart(salesChartCanvas, {
    type: 'line',
    data: salesChartData,
    options: salesChartOptions
  }
  )
*/

  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: ta,
      datasets: [
        {
          data: sta,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef','#eb9e34','#9da623','#387a11','#0f5987','#7f0f87','#05e3d0'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
       legend : {position:'right'}
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

      var donutChartCanvas = $('#donutChart2').get(0).getContext('2d')
    var donutData2        = {
      labels: objR,
      datasets: [
        {
          data: srObjR,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef','#eb9e34','#9da623','#387a11','#0f5987','#7f0f87','#a832a6','#49006a','f768a1','#fff7f3','#c7e9b4','#41b6c4','#a6bddb','#d0d1e6','#fd8d3c','#e31a1c','#ffffcc'],
        }
      ]
    }
    var donutOptions2     = {
      maintainAspectRatio : false,
      responsive : true,
      legend : {position:'left'}
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData2,
      options: donutOptions2
    })


    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData        = {
        labels: objRpf,
        datasets: [
          {
            data: srObjRpf,
            backgroundColor : ['#f1c232', '#a4b748', '#3d85c6', '#00c0ef','#eb9e34','#9da623','#387a11','#387a11'],
          }
        ]
      }
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
         legend : {position:'left'}
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })


    var pieChartCanvas = $('#pieChart2').get(0).getContext('2d')
      var pieData        = {
        labels: org,
        datasets: [
          {
            data: srOrg,
            backgroundColor : ['#8B0000', '#a4b748', '#005353', '#00c0ef','#D0DBDF','#9da623','#387a11','#387a11'],
          }
        ]
      }
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
         legend : {position:'right'}
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })

       //-------------
    //- BAR CHART -
    //-------------
     if (realisationDistrict){
       var lstregiondistrict=<?php echo json_encode($districtregion);?>;
       var surfaceRealiseRegionDistrict=<?php echo json_encode($superficieRealiseDistrict);?>;
       var surfacePrevuRegionDistrict=<?php echo json_encode($surfacePrevuDistrict);?>;

    } else {

         var lstregiondistrict=<?php echo json_encode($region);?>;
         var surfaceRealiseRegionDistrict=<?php echo json_encode($superficieRealiseRegion);?>;
         var surfacePrevuRegionDistrict=<?php echo json_encode($surfacePrevuRegion);?>;
    }
         var areaChartData = {
       labels  : lstregiondistrict,
       datasets: [
         {
           label               : 'Surface réalisée',
           backgroundColor     : '#ffce6f',
           borderColor         : 'rgba(60,141,188,0.8)',
           pointRadius          : false,
           pointColor          : '#3b8bba',
           pointStrokeColor    : 'rgba(60,141,188,1)',
           pointHighlightFill  : '#fff',
           pointHighlightStroke: 'rgba(60,141,188,1)',
           data                : surfaceRealiseRegionDistrict
         },
         {
           label               : 'Surface planifiée',
           backgroundColor     : '#3a43f9',
           borderColor         : 'rgba(210, 214, 222, 1)',
           pointRadius         : false,
           pointColor          : 'rgba(210, 214, 222, 1)',
           pointStrokeColor    : '#c1c7d1',
           pointHighlightFill  : '#fff',
           pointHighlightStroke: 'rgba(220,220,220,1)',
           data                : surfacePrevuRegionDistrict
         },
       ]
     }

    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
    scales: {

        yAxes: [{

          ticks: {
                   callback: function(value){return value+ " Ha"}
                },
        }]
      }
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })



</script>
</body>
</html>
