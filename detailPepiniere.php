<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');
if(isset($_GET['PEP_id']) || isset($_SESSION['PEP_id']))
{
   if(isset($_GET['PEP_id']))
   {
      $PEP_id=(int) $_GET['PEP_id'];
   }else
   {
      $PEP_id=$_SESSION['PEP_id'];
   }
   
   $sql="SELECT *
         FROM pepiniere
         WHERE pepiniere.id_pepiniere=?";
   $req=$db->prepare($sql);
   $req->execute([$PEP_id]);
   $infoRebois=$req->fetch();
   
   
   
   $sql="SELECT *
         FROM essence_pepiniere_semi
         LEFT JOIN pepiniere ON pepiniere.id_pepiniere=essence_pepiniere_semi.id_pepiniere
         WHERE essence_pepiniere_semi.id_pepiniere=?
         group by essence,dateSemi
        ";
   $req1=$db->prepare($sql);
   $req1->execute([$PEP_id]);
   
   if(isset($_POST['retour']))
   {
      header('location:pepiniere.php');
      unset($_SESSION['PEP_id']);
      unset($_SESSION['ft_id']);
      exit();
   }
   
   
}else
{
   $_SESSION['flash']['danger']="Vous ne pouvez pas accédé directement à cette page!!";
   header('location:pepiniere.php');
   exit();
}
?>

<?php
require_once ('includes/header.php');
require_once ('includes/scripts.php'); 
require_once ('includes/navbar.php'); 
?>
<?php if(!empty($erreurs)): ?>..
   <div class="alert alert-danger" id="messageFlash">
      <p>Vous n'avez pas rempli le formulaire correctement</p>
      <ul>
         <?php foreach($erreurs as $erreur): ?>
            <li><?= $erreur; ?></li>
         <?php endforeach; ?>
      </ul>
   </div>
   <?php endif; ?>
   
<div class="rem">
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-body">
    <div class="starter-template">
        <div class="col-sm-12">
            <form method="post" action="">
               <h5><b>Délimitation Administrative</b></h5>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Région : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->region?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>District : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->district?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="commune">commune : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->commune?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="fokontany">fokontany : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->fokontany?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="fokontany">Site : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->site?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="date_pepiniere">Coordonnées X : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->longitude?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="date_pepiniere">Coordonnées Y : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->latitude?>">
                        </div>
                    </div>
                </div>
                <h5><b>Information sur la pepinière</b></h5>
                <div class="row">
                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="objectif_pepiniere">Responsable : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->responsablePepiniere?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="type_pepiniere">Nombre de plate-bande : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->nombrePlatebande?>">
                        </div>
                    </div>
                </div>
                
                <h5><b>Information sur les Essences</b></h5>
                <div class="row">
                <div class="col-sm-12">
                  <div class="scrollable">
                     <table class="table table-bordered">
                     <thead>
                         <tr><th>Essences </th><th>Nombre repiqué/semi</th><th>Date semi</th></tr>
                     </thead>
                     <tbody>
                           <?php while($donnee=$req1->fetch()):?>
                           <tr>
                                 <td><?=$donnee->essence?></td>
                                 <td><?=$donnee->nombrePlantSemi?></td>
                                 <td><?=$donnee->dateSemi?></td>
                           </tr>
                           <?php endwhile;?>
                     </tbody>
                     </table>
                  </div>
               </div>
            </div>
             <div class="row">
                <div class="x1">
                    <button type="submit" name="retour" class="btn btn-danger">Retour</button>
                    <?php if(isset($infoRebois->SV_id)):?>
                         <a class="btn btn-primary" href="detailSuivi.php?PEP_id=<?=$infoRebois->PEP_id ?>">Listes Suivi effectué</a>
                    <?php endif;?>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?php require 'includes/footer.php' ; ?>