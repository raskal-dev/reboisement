<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');
if(isset($_GET['RB_id']) || isset($_SESSION['RB_id']))
{
   if(isset($_GET['RB_id']))
   {
      $RB_id=(int) $_GET['RB_id'];
   }else
   {
      $RB_id=$_SESSION['RB_id'];
   }

   $sql="SELECT *
         FROM reboisement
         WHERE reboisement.id=?";
   $req=$db->prepare($sql);
   $req->execute([$RB_id]);
   $infoRebois=$req->fetch();



   $sql="SELECT *
         FROM plant_mise_terre
         LEFT JOIN reboisement ON reboisement.id=plant_mise_terre.reboisement_id
         WHERE reboisement.id=?
         group by nomVernaculaire,dateMiseEnTerre,SourcePlant
        ";
   $req1=$db->prepare($sql);
   $req1->execute([$RB_id]);

   $sql2="SELECT *
         FROM gpsrebois
         LEFT JOIN reboisement ON reboisement.id=gpsrebois.reboisement_id
         WHERE reboisement.id=?
        ";
   $req2=$db->prepare($sql2);
   $req2->execute([$RB_id]);

   if(isset($_POST['retour']))
   {
      header('location:account.php');
      unset($_SESSION['RB_id']);
      unset($_SESSION['ft_id']);
      exit();
   }


}else
{
   $_SESSION['flash']['danger']="Vous ne pouvez pas accédé directement à cette page!!";
   header('location:account.php');
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
               <h5><b>Institution</b></h5>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Acteur : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->acteur?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Type d'acteur : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->typeActeur?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="commune">DREDD/CIREDD : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->dreed?>">
                        </div>
                    </div>
                </div>
               <h5><b>Délimitation Administrative</b></h5>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Région : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->region?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>District : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->district?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="commune">commune : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->commune?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="fokontany">fokontany : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->fokontany?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="fokontany">Site : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->site?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="date_reboisement">Situation juridique : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->situationJuridique?>">
                        </div>
                    </div>
                </div>
                <h5><b>Coordonnées GPS</b></h5>
                <div class="row">
                <div class="col-sm-12">
                  <div class="scrollable">
                     <table class="table table-bordered">
                     <thead>
                         <tr><th>Coordonnées X</th><th>Coordonnées Y</th></tr>
                     </thead>
                     <tbody>
                           <?php while($donnee2=$req2->fetch()):?>
                           <tr>
                                 <td><?=$donnee2->longitude?></td>
                                 <td><?=$donnee2->latitude?></td>
                           </tr>
                           <?php endwhile;?>
                     </tbody>
                     </table>
                  </div>
               </div>
            </div>
                <h5><b>Plan de Reboisement</b></h5>
                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="objectif_reboisement">Responsable : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->responsable?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="type_reboisement">Objectif de reboisement : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->objectifReboisement?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="site_reboisement">Objectif RPF : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->objectifRpf?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="surfaceTotalReboise">Approche : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->Approche?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Superficie total prévue (en Ha) : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->surfaceTotalPrevu?>">
                        </div>
                    </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                            <label>Superficie réalisée (en Ha) : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->superficieRealise?>">
                        </div>
                    </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                            <label>Class : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->class_?>">
                        </div>
                    </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                            <label>Ecosystème : </label>
                            <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->mangroveOuTerrestre?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                       <div class="form-group">
                           <label>Date de reboisement : : </label>
                           <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->dateMiseEnTerre?>">
                       </div>
                   </div>
                   <div class="col-sm-3">
                      <div class="form-group">
                          <label>Campagne : </label>
                          <input type="text" readonly="readonly" class="form-control" value="<?= $infoRebois->anneeRebois?>">
                      </div>
                  </div>
                </div>

                <h5><b>Information sur Plants mise en terre</b></h5>
                <div class="row">
                <div class="col-sm-12">
                  <div class="scrollable">
                     <table class="table table-bordered">
                     <thead>
                         <tr><th>Essence</th><th>Nombre plants mise en terre</th><th>Source plants</th></tr>
                     </thead>
                     <tbody>
                           <?php while($donnee=$req1->fetch()):?>
                           <tr>
                                 <td><?=$donnee->nomVernaculaire?></td>
                                 <td><?=$donnee->nombrePlantMiseEnTerre?></td>
                                 <td><?=$donnee->SourcePlant?></td>
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
                         <a class="btn btn-primary" href="detailSuivi.php?RB_id=<?=$infoRebois->RB_id ?>">Listes Suivi effectué</a>
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
