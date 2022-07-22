<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
require_once "getdatakobo.php";
$Fonction->logged_only();
$Fonction->allow('member');
unset($_SESSION['id_stocks']);
unset($_SESSION['inputs']);
unset($_SESSION['district']);
unset($_SESSION['commune']);
unset($_SESSION['params']);
unset($_SESSION['reboisement_id']);
unset($_SESSION['nom_vernac']);
unset($_SESSION['region']);
unset($_SESSION['region']);
unset($_SESSION['district']);
unset($_SESSION['id_pepiniere']);
unset($_SESSION['pepinieriste']);


if(isset($_GET['valider'])){
  getDataCollected($db);
  header('location: account.php');
  exit();
}

if(isset($_GET['del']))
{
    $del=$_GET['del'];
    $deleteuser=$_SESSION['authentifier']['identifiant'];


    $sql="INSERT INTO deletelog
         (`deletedate`, `acteur`, `typeActeur`, `dreed`, `region`, `district`, `commune`, `fokontany`, `site`, `situationJuridique`, `responsable`, `objectifReboisement`, `objectifRpf`, `Approche`, `surfaceTotalPrevu`, `superficieRealise`, `class_`, `mangroveOuTerrestre`, `dateMiseEnTerre`, `anneeRebois`, `reboisement_id`)
         SELECT  NOW(), acteur, typeActeur, dreed, region, district, commune, fokontany, site, situationJuridique, responsable, objectifReboisement, objectifRpf, Approche, surfaceTotalPrevu, superficieRealise, class_, mangroveOuTerrestre, dateMiseEnTerre, anneeRebois, id
         FROM reboisement WHERE reboisement.id = ? ";
    $req=$db->prepare($sql);
    $req->execute([$del]);
    $id=$db->lastInsertId();

    $sql="UPDATE deletelog SET deleteuser=:deleteuser WHERE id=:id";
    $req=$db->prepare($sql);
    $req->execute(array(
                        'deleteuser'=>$deleteuser,
                        'id'=>$id
                        ));

    $sql="DELETE
    FROM reboisement
    WHERE reboisement.id=?";
    $req=$db->prepare($sql);
    $req->execute([$del]);

    $_SESSION['flash']['success']="Données supprimées!!";
    header("location:account.php");
    exit();
}

if(isset($_GET['reg']))
{
    header("location:FicheReboisement.php");
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
}


$nom_region2="";
$clef=$Fonction->user('slug');
if($Fonction->user('level')>=3)
{
   $nom_region="%";
}else
{
   $nom_region=$Fonction->secure($_SESSION['authentifier']['nom_region']);
}
$id_diredd_dredd_ciredd=$_SESSION['authentifier']['id_diredd_dredd_ciredd'];
if(isset($_GET['query']))
{
    $q=$Fonction->secure($_GET['query']);
    $s=explode(' ',$q);
    $sql="SELECT COUNT(*) AS nbElmt FROM reboisement
         LEFT JOIN region on region.nom_region=reboisement.region
         LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id


         ";
    $i=0;
    foreach($s as $mot)
    {
        if($i==0)
        {
            $sql.=" WHERE ";
        }else
        {
            $sql.=" AND ";
        }
        $sql.="objectifReboisement LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR acteur LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR typeActeur LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR objectifRpf LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR region LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR district LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR commune LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR fokontany LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR site LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'";
        $i++;
    }
    $sql.="ORDER BY reboisement.id DESC";
}else
{
    $sql="SELECT COUNT(*) AS nbElmt FROM reboisement
         LEFT JOIN region on region.nom_region=reboisement.region
         LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id


         WHERE diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'";
}
$req=$db->query($sql);
$row=$req->fetch(PDO::FETCH_ASSOC);

$q="";
$page_rows=6;
$rows=$row['nbElmt'];
$last=ceil($rows / $page_rows);

if($last<1)
{
    $last=1;
}

$pagenum=1;

if(isset($_GET['pn']))
{
    $pagenum=preg_replace('#[^0-9]#','',$_GET['pn']);
}

if($pagenum<1)
{
    $pagenum=1;
}elseif($pagenum>$last)
{
    $pagenum=$last;
}


if(isset($_GET['query']))
{
    $q=$Fonction->secure($_GET['query']);
    $s=explode(' ',$q);
    $sql="SELECT  *,reboisement.id as RB_id
         FROM reboisement
         LEFT JOIN region on region.nom_region=reboisement.region
         LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id
         ";
    $i=0;
    foreach($s as $mot)
    {
        if($i==0)
        {
            $sql.=" WHERE ";
        }else
        {
            $sql.=" AND ";
        }
        $sql.="objectifReboisement LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR acteur LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR typeActeur LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR objectifRpf LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR region LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR district LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR commune LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR fokontany LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR site LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'";
        $i++;
    }
    $sql.="ORDER BY reboisement.id DESC LIMIT ".(($pagenum-1) * $page_rows).", $page_rows";
    $req=$db->query($sql);
}else
{
    $sql="SELECT *,reboisement.id as RB_id
    FROM reboisement
    LEFT JOIN region on region.nom_region=reboisement.region
    LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id


    WHERE diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
    ORDER BY reboisement.id DESC LIMIT ".(($pagenum-1) * $page_rows).", $page_rows";

    $req=$db->query($sql);
}

$textline1=" $rows Résultat(s) trouvé(s)";
$textline2="Page <b>$pagenum</b> sur <b>$last</b>";

$paginationCtrls='';

if($last !=1)
{

    if($pagenum>1)
    {
        $previous=$pagenum-1;
        $paginationCtrls .='<a href="' .$_SERVER['PHP_SELF'].'?pn='.$previous.'&query='.$q.'">Previous</a> &nbsp;&nbsp;';
        for($i=$pagenum-4;$i<$pagenum;$i++)
        {
            if($i>0)
            {
                $paginationCtrls.='<a href="' .$_SERVER['PHP_SELF'].'?pn='.$i.'&query='.$q.'">'.$i.'</a> &nbsp;';
            }
        }
    }

    $paginationCtrls.=''.$pagenum.'&nbsp;';
    for($i=$pagenum+1;$i<=$last;$i++)
    {
        $paginationCtrls.='<a href="' .$_SERVER['PHP_SELF'].'?pn='.$i.'&query='.$q.'">'.$i.'</a> &nbsp;';
        if($i>=$pagenum+4)
        {
            break;
        }
    }

    if($pagenum!=$last)
    {
        $next=$pagenum+1;
        $paginationCtrls .='<a href="' .$_SERVER['PHP_SELF'].'?pn='.$next.'&query='.$q.'">Next</a> &nbsp;&nbsp;';
    }

}

if(isset($_POST['upload_excel']))
{
   $file_name = $_FILES["result_file"]["name"];
   $file_info = $_FILES["result_file"]["tmp_name"];
   /*$file_directory = "../uploads/";*/
   $file_extension = strrchr($file_name,".");
   /*$new_file_name = date("dmY his").$file_extension;*/

   $extension_autorise = array ('.xlsx','.xls');

   if(in_array($file_extension,$extension_autorise))
   {
         require './PHPExcel/classes/PHPExcel.php';
         require_once './PHPExcel/classes/PHPExcel/IOFactory.php';
         $objPHPExcel = PHPExcel_IOFactory::load($file_info);

         foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
         {

            echo $highestrow=$worksheet->getHighestRow();

            for($row=0;$row<=$highestrow;$row++)
            {
               $id=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
               $acteur=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
               $typeActeur=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
               $dreed=$worksheet->getCellByColumnAndRow(3,$row)->getValue();
               $region=$worksheet->getCellByColumnAndRow(4,$row)->getValue();
               $district=$worksheet->getCellByColumnAndRow(5,$row)->getValue();
               $commune=$worksheet->getCellByColumnAndRow(6,$row)->getValue();
               $fokontany=$worksheet->getCellByColumnAndRow(7,$row)->getValue();
               $site=$worksheet->getCellByColumnAndRow(8,$row)->getValue();
               $situationJuridique=$worksheet->getCellByColumnAndRow(9,$row)->getValue();
               $responsable=$worksheet->getCellByColumnAndRow(10,$row)->getValue();
               $objectifReboisement=$worksheet->getCellByColumnAndRow(11,$row)->getValue();
               $objectifRpf=$worksheet->getCellByColumnAndRow(12,$row)->getValue();
               $Approche=$worksheet->getCellByColumnAndRow(13,$row)->getValue();
               $surfaceTotalPrevu=$worksheet->getCellByColumnAndRow(14,$row)->getValue();
               $superficieRealise=$worksheet->getCellByColumnAndRow(15,$row)->getValue();
               $class=$worksheet->getCellByColumnAndRow(16,$row)->getValue();
               $mangroveOuTerrestre=$worksheet->getCellByColumnAndRow(17,$row)->getValue();
               $dateMiseEnTerre=$worksheet->getCellByColumnAndRow(18,$row)->getValue();
               $annee=$worksheet->getCellByColumnAndRow(19,$row)->getValue();

					     $id=trim($Fonction->secure($id));
               $acteur=trim($Fonction->secure($acteur));
               $typeActeur=trim($Fonction->secure($typeActeur));
               $dreed=trim($Fonction->secure($dreed));
               $region=trim($Fonction->secure($region));
               $district=trim($Fonction->secure($district));
               $commune=trim($Fonction->secure($commune));
               $fokontany=trim($Fonction->secure($fokontany));
               $site=trim($Fonction->secure($site));
               $situationJuridique=trim($Fonction->secure($situationJuridique));
               $responsable=trim($Fonction->secure($responsable));
               $objectifReboisement=trim($Fonction->secure($objectifReboisement));
               $objectifRpf=trim($Fonction->secure($objectifRpf));
               $Approche=trim($Fonction->secure($Approche));

               if($surfaceTotalPrevu==""){
                 $surfaceTotalPrevu="0";
               }else
               {$surfaceTotalPrevu=trim($Fonction->secure($surfaceTotalPrevu));}

               if($superficieRealise==""){
                 $superficieRealise="0";
               }else
               {$superficieRealise=trim($Fonction->secure($superficieRealise));}

               if($dateMiseEnTerre==""){
                 $dateMiseEnTerre="0000-00-00";
               }else
               {$dateMiseEnTerre=trim($Fonction->secure($dateMiseEnTerre));}

               $class=trim($Fonction->secure($class));

               $mangroveOuTerrestre=trim($Fonction->secure($mangroveOuTerrestre));

               $annee=trim($Fonction->secure($annee));
               $users_id=$Fonction->user('id');

               $sql_id="SELECT id FROM reboisement WHERE id=:id";
               $req_id=$db->prepare($sql_id);
               $req_id->execute(array("id"=>$id));
               $info_id=$req_id->fetch(PDO::FETCH_ASSOC);

               if($region!="" && $id!="" && !$info_id['id'])
					{
                  $sql="INSERT INTO `reboisement`(`id`,`dateRemplissage`,`acteur`, `typeActeur`, `dreed`, `region`, `district`, `commune`, `fokontany`, `site`, `situationJuridique`, `responsable`, `objectifReboisement`, `objectifRpf`, `Approche`, `surfaceTotalPrevu`, `superficieRealise`, `class_`, `mangroveOuTerrestre`, `dateMiseEnTerre`, `anneeRebois`, `users_id`) VALUES ('$id',NOW(),'$acteur','$typeActeur','$dreed','$region','$district','$commune','$fokontany','$site','$situationJuridique','$responsable','$objectifReboisement','$objectifRpf','$Approche','$surfaceTotalPrevu','$superficieRealise','$class','$mangroveOuTerrestre','$dateMiseEnTerre','$annee','$users_id') ";
                  $req=$db->prepare($sql);
                  $req->execute();
                  $_SESSION['flash']['success']='Fichier Importé avec succès!';
               }


            }

         }
         header('location: account.php');
         exit();

   }
   else
   {
      $_SESSION['flash']['danger']='Seul les fichiers Excel sont autorisées';
      header('location: account.php');
      exit();
   }

}

if(isset($_POST['upload_excel2']))
{
   $file_name2 = $_FILES["result_file2"]["name"];
   $file_info2 = $_FILES["result_file2"]["tmp_name"];
   /*$file_directory = "../uploads/";*/
   $file_extension2 = strrchr($file_name2,".");
   /*$new_file_name = date("dmY his").$file_extension;*/

   $extension_autorise2 = array ('.xlsx','.xls');

   if(in_array($file_extension2,$extension_autorise2))
   {
         require './PHPExcel/classes/PHPExcel.php';
         require_once './PHPExcel/classes/PHPExcel/IOFactory.php';
         $objPHPExcel = PHPExcel_IOFactory::load($file_info2);

         foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
         {

            echo $highestrow=$worksheet->getHighestRow();

            for($row=0;$row<=$highestrow;$row++)
            {
               $rebois_id=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
               $nombrePlantMiseEnTerre=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
               $nomVernaculaire=$worksheet->getCellByColumnAndRow(2,$row)->getValue();

               $SourcePlant=$worksheet->getCellByColumnAndRow(3,$row)->getValue();


               $nomVernaculaire=trim($Fonction->secure($nomVernaculaire));
               $nombrePlantMiseEnTerre=trim($Fonction->secure($nombrePlantMiseEnTerre));
               $dateMiseEnTerre=trim($Fonction->secure($dateMiseEnTerre));
               $SourcePlant=trim($Fonction->secure($SourcePlant));
               $rebois_id=trim($Fonction->secure($rebois_id));
               $users_id=$Fonction->user('id');

               $sql_plant="SELECT id FROM reboisement WHERE id=:id";
               $req_plant=$db->prepare($sql_plant);
               $req_plant->execute(array("id"=>$rebois_id));
               $info_plant=$req_plant->fetch();

               if($info_plant && $nomVernaculaire!="")
					{
                  $sql="INSERT INTO `plant_mise_terre`(`dateRegister`, `nomVernaculaire`, `nombrePlantMiseEnTerre`, `SourcePlant`, `reboisement_id`, `users_id`) VALUES (NOW(),'$nomVernaculaire','$nombrePlantMiseEnTerre','$SourcePlant','$rebois_id','$users_id') ";
                  $req=$db->prepare($sql);
                  $req->execute();
                  $_SESSION['flash']['success']='Fichier Importé avec succès!';
               }


            }

         }
         header('location: account.php');
         exit();

   }
   else
   {
      $_SESSION['flash']['danger']='Seul les fichiers Excel sont autorisées';
      header('location: account.php');
      exit();
   }

}


if(isset($_POST['upload_excel3']))
{
   $file_name3 = $_FILES["result_file3"]["name"];
   $file_info3 = $_FILES["result_file3"]["tmp_name"];
   /*$file_directory = "../uploads/";*/
   $file_extension3 = strrchr($file_name3,".");
   /*$new_file_name = date("dmY his").$file_extension;*/

   $extension_autorise3 = array ('.xlsx','.xls');

   if(in_array($file_extension3,$extension_autorise3))
   {
         require './PHPExcel/classes/PHPExcel.php';
         require_once './PHPExcel/classes/PHPExcel/IOFactory.php';
         $objPHPExcel = PHPExcel_IOFactory::load($file_info3);

         foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
         {

            echo $highestrow=$worksheet->getHighestRow();

            for($row=0;$row<=$highestrow;$row++)
            {
               $rebois_id=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
               $latitude=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
               $longitude=$worksheet->getCellByColumnAndRow(2,$row)->getValue();


               $longitude=trim($Fonction->secure($longitude));
               $latitude=trim(htmlspecialchars($latitude));
               $rebois_id=trim($Fonction->secure($rebois_id));
               $users_id=$Fonction->user('id');

               $sql_plant="SELECT id FROM reboisement WHERE id=:id";
               $req_plant=$db->prepare($sql_plant);
               $req_plant->execute(array("id"=>$rebois_id));
               $info_plant=$req_plant->fetch();

               if($info_plant && $longitude!="" && $latitude!="")
					{
                  $sql="INSERT INTO `gpsrebois`(`dateInsert`,`longitude`, `latitude`, `reboisement_id`, `users_id`) VALUES (NOW(),'$longitude','$latitude','$rebois_id','$users_id') ";
                  $req=$db->prepare($sql);
                  $req->execute();
                  $_SESSION['flash']['success']='Fichier Importé avec succès!';
               }


            }

         }
         header('location: account.php');
         exit();

   }
   else
   {
      $_SESSION['flash']['danger']='Seul les fichiers Excel sont autorisées';
      header('location: account.php');
      exit();
   }

}
?>

<?php
require_once ('includes/header.php');
require_once ('includes/scripts.php');
require_once ('includes/navbar.php');
?>
 <div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4 mt-4">
   <div class="row">
      <div class="col-sm-4">
         <h6 class=" ml-4">&nbsp;&nbsp;&nbsp;Importation Fichier Reboisement
            <form action=" " method="post" enctype="multipart/form-data">
                  <input name="result_file"  required=""  type="file" class="btn btn-default btn-sm" accept=".xlsx,.xls">
                  <button type="submit" name="upload_excel" class="btn btn-primary btn-rounded btn-sm ml-2"> Upload Excel</button>
             </form>
         </h6>
      </div>
      <div class="col-sm-4">
         <h6 class=" ml-4">&nbsp;&nbsp;&nbsp;Importation Fichier GPS
            <form action=" " method="post" enctype="multipart/form-data">
                  <input name="result_file3"  required=""  type="file" class="btn btn-default btn-sm" accept=".xlsx,.xls">
                  <button type="submit" name="upload_excel3" class="btn btn-primary btn-rounded btn-sm ml-2"> Upload Excel</button>
             </form>
         </h6>
      </div>
      <div class="col-sm-4">
         <h6 class=" ml-4">&nbsp;&nbsp;&nbsp;Importation Fichier Plants mise en terre
            <form action=" " method="post" enctype="multipart/form-data">
                  <input name="result_file2"  required=""  type="file" class="btn btn-default btn-sm" accept=".xlsx,.xls">
                  <button type="submit" name="upload_excel2" class="btn btn-primary btn-sm ml-2"> Upload Excel</button>
             </form>
         </h6>
      </div>
   </div>
<div class="card-body scrollable" id="acceuil">



					<div class="row">

						<div class="col-sm-5">
							<h6>Site :
								<b>
									<?= (isset($_SESSION['authentifier']))? $_SESSION['authentifier']['nom_diredd_dredd_ciredd']:"";?>
								</b>
							</h6>
                     <h6>Liste insertion :
								<b>
									<?php echo $textline1.'&nbsp;&nbsp;['.$textline2.']';?>
								</b>
							</h6>

						</div>

                  <div class="col-sm-7">
                     <form method="GET" action="">
                       <button type="submit"  class="btn btn-primary btn-sm" name="valider">KOBO</button>
                        <button type="submit"  class="btn btn-success btn-sm" name="reg"><span class="fas fa-pen-alt"> Nouveau Enregistrement</span></button>
                        <input style="color: black" type="text" name="query" value="<?=$q?>" placeholder="...Recherche..."/>
                        <button type="submit"  class="btn btn-default btn-sm" style="background: rgba(7, 247, 239, 0.2)"><span class="fas fa-search"></span></button>
                     </form>
                  </div>
               </div>
					<div class="row">
					<!--Bouton Menu-->
					<!--Fin bouton-->

                        <div class="col-sm-12">





<form  action=" " method="post">

            <table class="table table-bordered">
                <thead>
                    <tr><th>#</th><th>Information</th><th>Région> District> Commune> Fokontany</th><th>Site de Reboisement</th><th>Objectif Reboisement</th><th>Objectif RPF</th><th colspan="2">Détails</th></tr>
                </thead>
                <tbody>
                      <?php while($donnee=$req->fetch()):?>
                      <tr>
                           <td><?=$donnee->RB_id?></td>
                            <td>
                                 <u>Acteur:</u> <?=$donnee->acteur?></br>
                                 <u>Type:</u> <?=$donnee->typeActeur?></br>
                                 <u>Année de Reboisement:</u> <?=$donnee->anneeRebois?>
                            </td>

                            <td><u>Région:</u><?=$donnee->region?></br>
                                <u>District:</u> <?=$donnee->district?></br>
                                <u>Commune:</u> <?=$donnee->commune?></br>
                                <u>Fokontany:</u> <?=$donnee->fokontany?>
                            </td>
                            <td><?=$donnee->site?></td>
                            <?php
                                //$RB_id=$donnee->RB_id;
                                //$sqlTot="SELECT sum(objectif) as objectifTot, sum(realise) as realiseTot FROM fiche_technique
                                //        JOIN reboisement ON reboisement.id=fiche_technique.reboisement_id
                                //        WHERE fiche_technique.reboisement_id=reboisement_id";
                                //$reqTot=$db->prepare($sqlTot);
                                //$reqTot->execute(array("reboisement_id"=>$RB_id));
                                //$fetch=$reqTot->fetch(PDO::FETCH_ASSOC);
                            ?>

                            <td><?=$donnee->objectifReboisement?></td>
                            <td><?=$donnee->objectifRpf?></td>
                            <td><a class="btn btn-success btn-sm" href="detailRbsmt.php?RB_id=<?=$donnee->RB_id ?>" style="border-radius: 2em;font-size: xx-small"><span class="fas fa-file"></span></a>

                            <?php
                              //$nom_region2=$Fonction->secure($donnee->region);
                              //$sql_req="SELECT id_diredd_dredd_ciredd FROM diredd_dredd_ciredd_region
                              //         LEFT JOIN region ON region.id=diredd_dredd_ciredd_region.id_region
                              //         WHERE region.nom_region LIKE '%".$nom_region2."%'";
                              //
                              //$req_sql=$db->prepare($sql_req);
                              //$req_sql->execute();
                              //$info_req=$req_sql->fetch();
                            ?>


                            <?php if($Fonction->user('level')==2 && $_SESSION['authentifier']['id_diredd_dredd_ciredd']==$donnee->id_diredd_dredd_ciredd): ?>
                            <a class="btn btn-danger btn-sm" href="account.php?del=<?=$donnee->RB_id ?>" style="border-radius: 2em;font-size: xx-small" onclick="return(confirm('Etes-vous sûr de vouloir supprimer la ligne'));"><span class="fas fa-trash"></span></a>
                            <?php elseif($Fonction->user('level')>=3): ?>
                            <a class="btn btn-danger btn-sm" href="account.php?del=<?=$donnee->RB_id ?>" style="border-radius: 2em;font-size: xx-small" onclick="return(confirm('Etes-vous sûr de vouloir supprimer la ligne'));"><span class="fas fa-trash"></span></a></td>
                            <?php endif;?>
                      </tr>

                      <?php endwhile;?>
                </tbody>
            </table>

        </form>

    <div>
        <ul class="nav-pills btn btn-default">
            <?php echo $paginationCtrls;?>
        </ul>
    </div>
</div>
</div>

</div>
</div>

</div>
<?php require 'includes/footer.php' ; ?>
