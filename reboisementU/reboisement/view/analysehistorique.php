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
 $listChamps=[ array('nom'=>'acteur','libelle'=>'acteur'),
                array('nom'=>'typeActeur','libelle'=>'typeActeur'),
               array('nom'=>'objectifReboisement','libelle'=>'objectifReboisement'),
               array('nom'=>'objectifRpf','libelle'=>'objectifRpf'),
                array('nom'=>'region','libelle'=>'region'),
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

  $listChampsRegion=[ array('nom'=>'region','libelle'=>'Région'),
                      array('nom'=>'surfacePrevu','libelle'=>'Objectif total (en ha)'),
                      array('nom'=>'superficieRealise','libelle'=>'Superficie totale réalisée (en ha)'),
                      array('nom'=>'pourcentage','libelle'=>'Pourcentage totale réalisation %'),
                     ];


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

        $result[]=$row;
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


   $vret=getDataToLoad('select * from v_realisation');
   $dataToload=$vret;
   $x=array();

   $listregion = getDataToLoad('select * from region');
   $listespece = getDataToLoad('select * from especes');
   $listdistrict = getDataToLoad('select * from district');
   $listcommune = getDataToLoad('select * from commune');
   $listclass = getDataToLoad('select * from class');
   $listtypeacteur = getDataToLoad('select * from type_acteur');
   $surfacePrevuNational = getDataToLoad('select sum(surfaceTotalPrevu) totalObjectif,mangroveOuTerrestre from planification group by mangroveOuTerrestre');
   $surfacePrevuNationalMangrove = getDataToLoad('select sum(surfaceTotalPrevu) totalObjectif,mangroveOuTerrestre from planification where mangroveOuTerrestre="Mangrove" group by mangroveOuTerrestre');
    $surfacePrevuNationalTerrestre = getDataToLoad('select sum(surfaceTotalPrevu) totalObjectif,mangroveOuTerrestre from planification where mangroveOuTerrestre="Terrestre" group by mangroveOuTerrestre');
   $surfaceTotale=getDataToLoad('select  sum(superficieRealise) as superficieRealise ,sum(surfacePrevu) as surfacePrevu,sum(nombre_plants) as nombre_plants from v_realisation');
   $nombreActeur =getDataToLoad('select  count(distinct(acteur)) as nombreActeur from v_realisation');
   $annee =getDataToLoad('select  distinct(annee_reboisement) as annee_reboisement from v_realisation');
   $anneeReboisement=array();

   $anneeSuface=getDataToLoad('select sum(superficieRealise) as superficieRealise,sum(surfacePrevu) as surfacePrevu,annee_reboisement from v_realisation group by  annee_reboisement order by annee_reboisement');
   $surfaceReboiseeParRegion=getDataToLoad('select ifnull(sum(superficieRealise),0) as superficieRealise ,ifnull(sum(surfaceTotalPrevu),0) as surfacePrevu,a.nom_region as region
from region a left join reboisement b on(a.nom_region = b.region)
group by a.nom_region');

   $superficieRealiseRegion = array();
   $surfacePrevuRegion = array();
   $region = array();

    foreach ($surfaceReboiseeParRegion as $row) {
        array_push($superficieRealiseRegion,$row['superficieRealise']);
        array_push($surfacePrevuRegion,$row['surfacePrevu']);
        array_push($region,$row['region']);
   }


   $anneeSufaceRealise = array();
   $anneeSufacePrevue = array();

   foreach ($anneeSuface as $row) {
        array_push($anneeReboisement,$row['annee_reboisement']);
        array_push($anneeSufaceRealise,$row['superficieRealise']);
        array_push($anneeSufacePrevue,$row['surfacePrevu']);
   }

   $surfaceParTypeActeur=getDataToLoad('select sum(superficieRealise) as superficieRealise,typeActeur from v_realisation group by typeActeur');
   $surfaceRealiseParActeur=array();
   $typeActeur = array();

   foreach ($surfaceParTypeActeur as $row){

      array_push($surfaceRealiseParActeur,$row['superficieRealise']);
      array_push($typeActeur,$row['typeActeur']);
   }

   $surfaceParObjectifRpf=getDataToLoad('select sum(superficieRealise) as superficieRealise,objectifRpf from reboisement group by objectifRpf');
   $surfaceRealiseParObjectifRpf=array();
   $objectifRpf = array();

   foreach ($surfaceParObjectifRpf as $row){

      array_push($surfaceRealiseParObjectifRpf,$row['superficieRealise']);
      array_push($objectifRpf,$row['objectifRpf']);
   }

     $surfaceParObjectifReboisement=getDataToLoad('select sum(superficieRealise) as superficieRealise,objectifReboisement from reboisement group by objectifReboisement');
   $surfaceRealiseParObjectifReboisement=array();
   $objectifReboisement = array();

   foreach ($surfaceParObjectifReboisement as $row){

      array_push($surfaceRealiseParObjectifReboisement,$row['superficieRealise']);
      array_push($objectifReboisement,$row['objectifReboisement']);
   }

       $surfaceParOrganisme=getDataToLoad('select sum(superficieRealise) as superficieRealise,financement from reboisement group by financement');
   $surfaceRealiseParOrganisme=array();
   $organisme = array();

   foreach ($surfaceParOrganisme as $row){

      array_push($surfaceRealiseParOrganisme,$row['superficieRealise']);
      array_push($organisme,$row['financement']);
   }


   $surfacePlanifie = getDataToLoad('select sum(surfaceTotalPrevu) as surfaceTotalPlanifie from planification group by anneeRebois');
   $surfacePlanifieRegion = getDataToLoad('select ifnull(sum(surfaceTotalPrevu),0) as surfacePrevu,a.nom_region as region
              from region a left join planification b on(a.nom_region = b.region)
              group by a.nom_region');


   $surfacePlanifieRegionMangrove = getDataToLoad('select ifnull(sum(surfaceTotalPrevu),0) as surfacePrevu,a.nom_region as region from region a left join planification b on(a.nom_region = b.region) where mangroveOuTerrestre="Mangrove" group by a.nom_region');
    $surfacePlanifieRegionTerrestre = getDataToLoad('select ifnull(sum(surfaceTotalPrevu),0) as surfacePrevu,a.nom_region as region from region a left join planification b on(a.nom_region = b.region) where mangroveOuTerrestre="Terrestre" group by a.nom_region');

   $surfaceRealiseEnCours=getDataToLoad('select sum(superficieRealise) as superficieRealise  from reboisement ');
   $nombrePlantsEnCours=getDataToLoad('select sum(nombrePlantMiseEnTerre) as nombre_plants from plant_mise_terre');
   $pourcentageRealisationEnCours =(isset($surfacePlanifie[0]['surfaceTotalPlanifie']) ? number_format(100*((float)(isset($surfaceRealiseEnCours[0]['superficieRealise'])?  $surfaceRealiseEnCours[0]['superficieRealise']:  0)/(float)(isset($surfacePlanifie[0]['surfaceTotalPlanifie'])?  $surfacePlanifie[0]['surfaceTotalPlanifie']:  0)),2) :0);
   $realisationParRegion = getDataToLoad('select ifnull(sum(b.surfaceTotalPrevu),0) as surfacePrevu,ifnull(sum(superficieRealise),0) as superficieRealise,a.nom_region as region,ifnull(round(100*(ifnull(sum(superficieRealise),0)/ifnull(sum(b.surfaceTotalPrevu),0)),2),0) as pourcentage
                                          from region a left join planification b on(a.nom_region = b.region)
                                          left join reboisement c on (a.nom_region =c.region)
                                          group by a.nom_region');

  ?>


<div>
      <section class="content-header">
        <div class="row">
            <div class="col-8 col-md-8 col-sm-8 align-left">
                <h3 class="mbr-section-title mb-0 ml-4 mbr-fonts-style display-5">
                    <strong>Analyse des données</strong>
                </h3>

            </div>
               <div class="col-4 col-md-4 col-sm-4  align-right ">
                  <ol class="breadcrumb float-sm-right">
                    <?php
                      echo '<li class="breadcrumb-item"><a href="/reboisement/index.php">Campagne en cours</a></li>'
                                               ?>

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
                                        <strong>Historique des campagnes </strong></h5><br>

                                         </div>
                                         <div class="row">
                                          <div class="col-4 col-md-4">
                                             <h5 >
                                                     <select id='searchByNiveau' class="form-control form-control-sm">
                                                        <option value=''> Niveau national </option>
                                                        <?php
                                                             foreach ($listregion as $row):
                                                              echo '<option value="'.$row["id"].'">'. 'Région ' .$row["nom_region"].'</option>';
                                                             endforeach;

                                                       ?>

                                                </select>
                                                </h5>
                                            </div>
                                            <div class="col-4 col-md-4">
                                             <h5 >
                                                     <select id='searchByYear' class="form-control form-control-sm">
                                                        <option value=''> Période du </option>
                                                        <?php
                                                             foreach ($annee as $row):
                                                                echo '<option value="'.$row["annee_reboisement"].'">'. $row["annee_reboisement"].'</option>';
                                                              endforeach;

                                                       ?>

                                                </select>
                                                </h5>
                                            </div>
                                            <div class="col-4 col-md-4">
                                             <h5 >
                                                     <select id='searchByYearEnd' class="form-control form-control-sm">
                                                        <option value=''> au </option>
                                                        <?php
                                                              foreach ($annee as $row):
                                                               echo '<option value="'.$row["annee_reboisement"].'">'. $row["annee_reboisement"].'</option>';
                                                               endforeach;
                                                       ?>

                                                </select>
                                                </h5>
                                            </div>
                                          </div>
                                     </section>
                                         <section class="content">
                                             <div class="row">

                                                <div class="col-md-4 col-sm-6 col-12">
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-info"><i class="fas fa-chart-area"></i></span>

                                                            <div class="info-box-content">
                                                                <span class="h6">Objectif national</span>
                                                                <span class="info-box-number"><?php echo isset($surfacePlanifie[0]['surfaceTotalPlanifie'])?  number_format(round($surfacePlanifie[0]['surfaceTotalPlanifie']),0,',',' '):  0?> ha</span>
                                                            </div>
                                                                  <!-- /.info-box-content -->
                                                    </div>
                                                                <!-- /.info-box -->
                                                </div>
                                                 <div class="col-md-4 col-sm-6 col-12">
                                                   <div class="info-box">
                                                     <span class="info-box-icon bg-danger"><i class="fas fa-chart-line"></i></span>

                                                     <div class="info-box-content">
                                                       <span class="h6">Objectif terrestre</span>
                                                       <span class="info-box-number"><?php echo isset($surfacePrevuNationalTerrestre[0]['totalObjectif'])?  number_format(round($surfacePrevuNationalTerrestre[0]['totalObjectif']),0,',',' '):  0?> ha</span>
                                                     </div>
                                                     <!-- /.info-box-content -->
                                                   </div>
                                                   <!-- /.info-box -->
                                                 </div>

                                                      <!-- /.col -->
                                                 <div class="col-md-4 col-sm-6 col-12">
                                                   <div class="info-box">
                                                     <span class="info-box-icon bg-warning"><i class="fas fa-chart-bar"></i></span>

                                                     <div class="info-box-content">
                                                       <span class="h6">Objectif mangrove</span>
                                                       <span class="info-box-number"><?php echo isset($surfacePrevuNationalMangrove[0]['totalObjectif'])?  number_format(round($surfacePrevuNationalMangrove[0]['totalObjectif']),0,',',' '):  0?> ha</span>
                                                     </div>
                                                     <!-- /.info-box-content -->
                                                   </div>
                                                   <!-- /.info-box -->
                                                 </div>


                                           </div>
                                             <div class="row">


                                                 <div class="col-md-4 col-sm-6 col-12">
                                                   <div class="info-box">
                                                     <span class="info-box-icon bg-warning"><i class="fas fa-tree"></i></span>

                                                     <div class="info-box-content">
                                                       <span class="h6">Surface reboisée</span>
                                                       <span class="info-box-number"><?php echo isset($surfaceRealiseEnCours[0]['superficieRealise'])?  number_format(round($surfaceRealiseEnCours[0]['superficieRealise']),0,',',' '):  0?> ha</span>
                                                     </div>
                                                     <!-- /.info-box-content -->
                                                   </div>
                                                   <!-- /.info-box -->
                                                 </div>

                                                      <!-- /.col -->
                                                 <div class="col-md-4 col-sm-6 col-12">
                                                   <div class="info-box">
                                                     <span class="info-box-icon bg-success"><i class="bi bi-flower3"></i></span>

                                                     <div class="info-box-content">
                                                       <span class="h6">Nombre de plants mis en terre</span>
                                                       <span class="info-box-number"><?php echo isset($nombrePlantsEnCours[0]['nombre_plants'])?  number_format(round($nombrePlantsEnCours[0]['nombre_plants']),0,',',' '):  0?></span>
                                                     </div>
                                                     <!-- /.info-box-content -->
                                                   </div>
                                                   <!-- /.info-box -->
                                                 </div>

                                                 <div class="col-md-4 col-sm-6 col-12">
                                                   <div class="info-box">
                                                     <span class="info-box-icon bg-primary"><i class="fas fa-users"></i></span>

                                                     <div class="info-box-content">
                                                       <span class="h6">Pourcentage de réalisation</span>
                                                       <span class="info-box-number"><?php echo isset($pourcentageRealisationEnCours)?  $pourcentageRealisationEnCours:  0?>%</span>
                                                     </div>
                                                     <!-- /.info-box-content -->
                                                   </div>
                                                   <!-- /.info-box -->
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
                                                      <strong>Surface reboisée par région:</strong>
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

                      <select id='searchByYear' class="form-control form-control-sm">
                        <option value=''> Période du </option>
                        <?php
                             foreach ($annee as $row):
                              echo '<option value="'.$row["annee_reboisement"].'">'. $row["annee_reboisement"].'</option>';
                             endforeach;

                       ?>

                      </select>

                   </div>



                 <div class="col-2 col-sm-2 col-md-2">


                   <select id='searchByendYear'  class="form-control form-control-sm">
                    <option value=''> au </option>
                    <?php
                         foreach ($annee as $row):
                          echo '<option value="'.$row["annee_reboisement"].'">'. $row["annee_reboisement"].'</option>';
                         endforeach;

                   ?>

                  </select>

                </div>

                  <div class="col-2 col-sm-2 col-md-2">

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
                     <option value='Reforestation'> Reforestation </option>
                     <option value='Restauration'> Restauration </option>
                     <option value='Conservation'> Conservation </option>

                  </select>

                  </div>

                   <div class="col-2 col-sm-2 col-md-2">

                      <select id='searchByEcosysteme'  class="form-control form-control-sm" >
                         <option value=''> Ecosystème </option>
                         <option value='Terrestre'> Terrestre </option>
                         <option value='Mangrove'> Mangrove </option>
                         <option value='Zone humide'> Zone humide </option>
                         <option value='Autres'> Autres </option>

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
                          echo '<option value="'.$row["id"].'">'. $row["class"].'</option>';
                         endforeach;

                   ?>

                  </select>
              </div>
              <div class="col-3 col-sm-3 col-md-3">

                  <select id='searchByOrganisme'  class="form-control form-control-sm">
                    <option value=''> Financement </option>

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

              <div class="col-12 col-md-12 text-center"><h6><strong> Superficie reboisée selon les filtres choisis</strong></h6>
                </div>
             <div  id="filtre" class="text-success">
                <p >Période : tous - Objectifs RPF confondus - Ecosystème confondu - Tout type d'espèces confondus  - Tous type d'acteurs - Madagascar</p>
             </div>


</section>
<section>

          <div class="card">


                         <div class="card-header">
                           <h5 class="card-title m-0"><strong>Réalisation</strong></h5>
                         </div>
                         <div class="card-body">
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

<!-- ChartJS -->
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
               'columnDefs' : [
          { 'visible': false, 'targets': [0,1,2,3,4,5,6,7,8,9,11,12,13] }
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

        var anneeDebut = ($('#searchByYear').val()==''?' - ':$('#searchByYear').val());
        var anneeFin = ($('#searchByendYear').val()==''?' - ':$('#searchByendYear').val());
        var objectifRpf  = ($('#searchByObjectifRPF').val()==''?' tous ':$('#searchByObjectifRPF :selected').text());
        var searchByEcosysteme = ($('#searchByEcosysteme').val()==''?' Terrestre et mangrove ':$('#searchByEcosysteme :selected').text());
        var searchByEspeces  = ($('#searchByEspeces').val()==''?' tous ':$('#searchByEspeces :selected').text());
        var searchByActeur = ($('#searchByActeur').val()==''?' tous ':$('#searchByActeur :selected').text());
          var searchByRegion = ($('#region').val()==''?' Région ':$('#region :selected').text());

        var htmlFiltre =" </br><span ><i>Période du </i>  "+anneeDebut +"<i> au </i>"+ anneeFin  +"- <i> Objectif:  </i>"+objectifRpf +" - <i>Ecosystème: </i>"+ searchByEcosysteme +"- <i>Espèces: </i>"+ searchByEspeces +" - <i>Acteur: </i>"+ searchByActeur +"</span>";

        $('#filtre').empty().append( htmlFiltre);


        dateDebut=$("#searchByYear").val();
        dateFin=$("#searchByendYear").val();
        objectifRpf=$("#searchByObjectifRPF").val();
        ecosysteme=$("#searchByEcosysteme").val();
        espece=$("#searchByEspeces").val();
        typeacteur=$("#searchByActeur").val();
        region = $('#region').val();

        updateTable(dateDebut,dateFin,objectifRpf,ecosysteme,espece,region,typeacteur);

  });




   function updateTable(dateDebut,dateFin,objectifRpf,ecosysteme,espece,region,acteur) {

    var baseUrl="<?php echo base_url();?>";
    var action = baseUrl+"index.php/activite.php/getDataToLoadWithFilter.php";

                   var $this = $(this);

                            $.ajax({
                               url: action,
                               type:"POST",
                               dataType: "html",
                               data:{dateDebut:dateDebut,dateFin:dateFin,objectifRpf:objectifRpf,ecosysteme:ecosysteme,espece:espece,region:region,typeacteur:typeacteur},
                               success: function(response,e) {

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

    var htmlfiltre= "&nbsp;&nbsp;Période : tous - Objectifs RPF confondus - Terrestre et mangrove - Tout type d\'especes confondus - Tous type d'acteurs - Madagascar";


     $('#filtre').empty().append( htmlfiltre);

     dateDebut=$("#searchByYear").val();
        dateFin=$("#searchByendYear").val();
        objectifRpf=$("#searchByObjectifRPF").val();
        ecosysteme=$("#searchByEcosysteme").val();
        espece=$("#searchByEspeces").val();
        region=$('#region').val();
        typeacteur=$("#searchByActeur").val();

        updateTable(dateDebut,dateFin,objectifRpf,ecosysteme,espece,commune,region,typeacteur);
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
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef','#eb9e34','#9da623','#387a11','#0f5987','#7f0f87'],
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
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef','#eb9e34','#9da623','#387a11','#0f5987','#7f0f87'],
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
    var lstregion=<?php echo json_encode($region);?>;
     var surfaceRealiseRegion=<?php echo json_encode($superficieRealiseRegion);?>;
     var surfacePrevuRegion=<?php echo json_encode($surfacePrevuRegion);?>;

         var areaChartData = {
       labels  : lstregion,
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
           data                : surfaceRealiseRegion
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
           data                : surfacePrevuRegion
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
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })



</script>
</body>
</html>
