<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');
unset($_SESSION['id_stocks']);
unset($_SESSION['inputs']);
unset($_SESSION['district']);
unset($_SESSION['commune']);
unset($_SESSION['params']);
unset($_SESSION['id_pepiniere']);
unset($_SESSION['nom_vernac']);
unset($_SESSION['region']);
unset($_SESSION['region']);
unset($_SESSION['district']);
unset($_SESSION['id_pepiniere']);
unset($_SESSION['pepinieriste']);
if(isset($_GET['del']))
{
    $del=$_GET['del'];
    $deleteuser=$_SESSION['authentifier']['identifiant'];

    $sql="DELETE
    FROM essence_pepiniere_semi
    WHERE essence_pepiniere_semi.id_pepiniere=?";
    $req=$db->prepare($sql);
    $req->execute([$del]);

    $sql1="DELETE
    FROM pepiniere
    WHERE pepiniere.id_pepiniere=?";
    $req1=$db->prepare($sql1);
    $req1->execute([$del]);

    $_SESSION['flash']['success']="Données supprimées!!";
    header("location:pepiniere.php");
    exit();
}

if(isset($_GET['reg']))
{
    header("location:FichePepiniere.php");
    unset($_SESSION['id_stocks']);
    unset($_SESSION['inputs']);
    unset($_SESSION['district']);
    unset($_SESSION['commune']);
    unset($_SESSION['params']);
    unset($_SESSION['id_pepiniere']);
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
    $sql="SELECT COUNT(*) AS nbElmt FROM pepiniere
         LEFT JOIN region on region.nom_region=pepiniere.region
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
        $sql.="responsablePepiniere LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'



               OR region LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR district LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR commune LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR fokontany LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR site LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'";
        $i++;
    }
    $sql.="ORDER BY pepiniere.id_pepiniere DESC";
}else
{
    $sql="SELECT COUNT(*) AS nbElmt FROM pepiniere
         LEFT JOIN region on region.nom_region=pepiniere.region
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
    $sql="SELECT  *,pepiniere.id_pepiniere as PEP_id
         FROM pepiniere
         LEFT JOIN region on region.nom_region=pepiniere.region
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
        $sql.="responsablePepiniere LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'



               OR region LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR district LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR commune LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR fokontany LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
               OR site LIKE '%$mot%' AND diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'";
        $i++;
    }
    $sql.="ORDER BY pepiniere.id_pepiniere DESC LIMIT ".(($pagenum-1) * $page_rows).", $page_rows";
    $req=$db->query($sql);
}else
{
    $sql="SELECT *,pepiniere.id_pepiniere as PEP_id
    FROM pepiniere
    LEFT JOIN region on region.nom_region=pepiniere.region
    LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id


    WHERE diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
    ORDER BY pepiniere.id_pepiniere DESC LIMIT ".(($pagenum-1) * $page_rows).", $page_rows";

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
               $id_pepiniere=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
               $region=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
               $district=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
               $commune=$worksheet->getCellByColumnAndRow(3,$row)->getValue();
               $fokontany=$worksheet->getCellByColumnAndRow(4,$row)->getValue();
               $site=$worksheet->getCellByColumnAndRow(5,$row)->getValue();
               $responsablePepiniere=$worksheet->getCellByColumnAndRow(6,$row)->getValue();
               $latitude=$worksheet->getCellByColumnAndRow(7,$row)->getValue();
               $longitude=$worksheet->getCellByColumnAndRow(8,$row)->getValue();
               $nombrePlatebande=$worksheet->getCellByColumnAndRow(9,$row)->getValue();
               $annee=$worksheet->getCellByColumnAndRow(10,$row)->getValue();

               $id_pepiniere=trim($Fonction->secure($id_pepiniere));
               $region=trim($Fonction->secure($region));
               $district=trim($Fonction->secure($district));
               $commune=trim($Fonction->secure($commune));
               $fokontany=trim($Fonction->secure($fokontany));
               $site=trim($Fonction->secure($site));
               $responsablePepiniere=trim($Fonction->secure($responsablePepiniere));
               if($latitude==""){
                 $latitude="0.0";
               }else
               {$latitude=trim($Fonction->secure($latitude));}
               if($longitude==""){
                 $longitude="0.0";
               }else
               {$longitude=trim($Fonction->secure($longitude));}
               if($nombrePlatebande==""){
                 $nombrePlatebande="0";
               }else
               {$nombrePlatebande=trim($Fonction->secure($nombrePlatebande));}
               $annee=trim($Fonction->secure($annee));
               $users_id=$Fonction->user('id');

               $sql_id_pep="SELECT id_pepiniere FROM pepiniere WHERE id_pepiniere=:id_pepiniere";
               $req_id_pep=$db->prepare($sql_id_pep);
               $req_id_pep->execute(array("id_pepiniere"=>$id_pepiniere));
               $info_id_pep=$req_id_pep->fetch(PDO::FETCH_ASSOC);

               if($region!="" && $id_pepiniere!="" && $annee!="" && !$info_id_pep['id_pepiniere'])
               {
                  $sql="INSERT INTO `pepiniere`(`id_pepiniere`, `dateRempl`, `region`, `district`, `commune`, `fokontany`, `site`, `responsablePepiniere`, `longitude`, `latitude`, `nombrePlatebande`, `anneeExercice`, `users_id`) VALUES ('$id_pepiniere',NOW(),'$region','$district','$commune','$fokontany','$site','$responsablePepiniere','$longitude','$latitude','$nombrePlatebande','$annee','$users_id') ";
                  $req=$db->prepare($sql);
                  $req->execute();
                  $_SESSION['flash']['success']='Fichier Importé avec succès!';
               }

            }

         }
         header('location: pepiniere.php');
         exit();

   }
   else
   {
      $_SESSION['flash']['danger']='Seul les fichiers Excel sont autorisées';
      header('location: pepiniere.php');
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
               $id_pep=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
               $essence=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
               $nombrePlantSemi=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
               $dateSemi=$worksheet->getCellByColumnAndRow(3,$row)->getValue();


               $nombrePlantSemi=trim($Fonction->secure($nombrePlantSemi));
               $essence=trim($Fonction->secure($essence));
               $dateSemi=trim($Fonction->secure($dateSemi));
               $id_pep=trim($Fonction->secure($id_pep));
               $users_id=$Fonction->user('id');

               $sql_pep="SELECT id_pepiniere FROM pepiniere WHERE id_pepiniere=:id_pepiniere";
               $req_pep=$db->prepare($sql_pep);
               $req_pep->execute(array("id_pepiniere"=>$id_pep));
               $info_pep=$req_pep->fetch();

               if($info_pep && $nombrePlantSemi!="")
					{
                  $sql="INSERT INTO `essence_pepiniere_semi`(`dateRegist`, `nombrePlantSemi`, `essence`, `dateSemi`,  `id_pepiniere`, `users_id`) VALUES (NOW(),'$nombrePlantSemi','$essence','$dateSemi','$id_pep','$users_id') ";
                  $req=$db->prepare($sql);
                  $req->execute();
                  $_SESSION['flash']['success']='Fichier Importé avec succès!';
               }


            }

         }
         header('location: pepiniere.php');
         exit();

   }
   else
   {
      $_SESSION['flash']['danger']='Seul les fichiers Excel sont autorisées';
      header('location: pepiniere.php');
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
      <div class="col-sm-6">
         <h6 class=" ml-4">&nbsp;&nbsp;&nbsp;Importation Fichier Pepinière
            <form action=" " method="post" enctype="multipart/form-data">
                  <input name="result_file"  required=""  type="file" class="btn btn-default btn-sm" accept=".xlsx,.xls">
                  <button type="submit" name="upload_excel" class="btn btn-primary btn-rounded btn-sm ml-2"> Upload Excel</button>
             </form>
         </h6>
      </div>
      <div class="col-sm-6">
         <h6 class=" ml-4">&nbsp;&nbsp;&nbsp;Importation Fichier Essences
            <form action=" " method="post" enctype="multipart/form-data">
                  <input name="result_file2"  required=""  type="file" class="btn btn-default btn-sm" accept=".xlsx,.xls">
                  <button type="submit" name="upload_excel2" class="btn btn-primary btn-sm ml-2"> Upload Excel</button>
             </form>
         </h6>
      </div>
   </div>
<div class="card-body scrollable" id="acceuil">



					<div class="row">

						<div class="col-sm-7">
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

                  <div class="col-sm-5">
                     <form method="GET" action="">
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
                    <tr><th>#</th><th>Région> District> Commune> Fokontany</th><th>Site de pepiniere</th><th>Localisation</th><th>Info pépinière</th><th colspan="2">Détails</th></tr>
                </thead>
                <tbody>
                      <?php while($donnee=$req->fetch()):?>
                      <tr>
                           <td><?=$donnee->PEP_id?></td>
                           <td><b>Région:</b><?=$donnee->region?></br>
                                <b>District:</b> <?=$donnee->district?></br>
                                <b>Commune:</b> <?=$donnee->commune?></br>
                                <b>Fokontany:</b> <?=$donnee->fokontany?>
                           </td>
                           <td><?=$donnee->site?></td>
                           <td>
                                 <b>Longitude:</b> <?=$donnee->longitude?></br>
                                 <b>Latitude:</b> <?=$donnee->latitude?>

                           </td>

                           <?php
                                //$PEP_id=$donnee->PEP_id;
                                //$sqlTot="SELECT sum(objectif) as objectifTot, sum(realise) as realiseTot FROM fiche_technique
                                //        JOIN pepiniere ON pepiniere.id_pepiniere=fiche_technique.id_pepiniere
                                //        WHERE fiche_technique.id_pepiniere=id_pepiniere";
                                //$reqTot=$db->prepare($sqlTot);
                                //$reqTot->execute(array("id_pepiniere"=>$PEP_id));
                                //$fetch=$reqTot->fetch(PDO::FETCH_ASSOC);
                           ?>

                            <td>
                                 <b>Responsable pépinière:</b> <?=$donnee->responsablePepiniere?></br>
                                 <b>Nombre plate-bande:</b> <?=$donnee->nombrePlatebande?></br>
                                 <b>Année de l'Exercice:</b> <?=$donnee->anneeExercice?>
                           </td>
                            <td><a class="btn btn-success btn-sm" href="detailPepiniere.php?PEP_id=<?=$donnee->PEP_id ?>" style="border-radius: 2em;font-size: xx-small"><span class="fas fa-file"></span></a>

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
                            <a class="btn btn-danger btn-sm" href="pepiniere.php?del=<?=$donnee->PEP_id ?>" style="border-radius: 2em;font-size: xx-small" onclick="return(confirm('Etes-vous sûr de vouloir supprimer la ligne'));"><span class="fas fa-trash"></span></a>
                            <?php elseif($Fonction->user('level')>=3): ?>
                            <a class="btn btn-danger btn-sm" href="pepiniere.php?del=<?=$donnee->PEP_id ?>" style="border-radius: 2em;font-size: xx-small" onclick="return(confirm('Etes-vous sûr de vouloir supprimer la ligne'));"><span class="fas fa-trash"></span></a></td>
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
