<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/function.php';
$Fonction->logged_only();

 $index_annee=""; 
if(isset($_GET['index_annee']) && !empty($_GET['index_annee']))
{
  $index_annee = $Fonction->secure($_GET['index_annee']);
 
$sql="select
    `reboisement`.`typeActeur` as `typeActeur`,
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

$sql1="select
    `reboisement`.`typeActeur` as `typeActeur`,
    sum(case when `reboisement`.`class_` = 'Inf_01ha' then `reboisement`.`superficieRealise` else 0 end) as `Inf_01ha`,
				sum(case when `reboisement`.`class_` = '1_10' then `reboisement`.`superficieRealise` else 0 end) as `1_10`,
				sum(case when `reboisement`.`class_` = '10_100' then `reboisement`.`superficieRealise` else 0 end) as `10_100`,
				sum(case when `reboisement`.`class_` = 'Sup_100' then `reboisement`.`superficieRealise` else 0 end) as `Sup_100`
    from `reboisement`
				WHERE `reboisement`.`anneeRebois` LIKE '$index_annee'
    group by
    `reboisement`.`typeActeur`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`typeActeur` ASC";
  $reqs1=$db->prepare($sql1);
  $reqs1->execute();
 
 $typeActeurs='';
 $Inf_01has='';
	$_1_10s='';
	$_10_100s='';
	$Sup_100s='';
 
$sql2="select
    `reboisement`.`typeActeur` as `typeActeur`,
    sum(case when `reboisement`.`class_` = 'Inf_01ha' then `reboisement`.`superficieRealise` else 0 end) as `Inf_01ha`,
				sum(case when `reboisement`.`class_` = '1_10' then `reboisement`.`superficieRealise` else 0 end) as `1_10`,
				sum(case when `reboisement`.`class_` = '10_100' then `reboisement`.`superficieRealise` else 0 end) as `10_100`,
				sum(case when `reboisement`.`class_` = 'Sup_100' then `reboisement`.`superficieRealise` else 0 end) as `Sup_100`
    from `reboisement`
				WHERE `reboisement`.`anneeRebois` LIKE '$index_annee'
    group by
    `reboisement`.`typeActeur`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`typeActeur` ASC";
  $reqs2=$db->prepare($sql2);
  $reqs2->execute();
 
  while($row2=$reqs2->fetch(PDO::FETCH_ASSOC))
  {
   $typeActeur=$row2['typeActeur'];
   $Inf_01ha=$row2['Inf_01ha'];
			$_1_10=$row2['1_10'];
			$_10_100=$row2['10_100'];
			$Sup_100=$row2['Sup_100'];
   
   $typeActeurs=$typeActeurs.'"'.$typeActeur.'",';
   $Inf_01has=$Inf_01has.'"'.$Inf_01ha.'",';
			$_1_10s=$_1_10s.'"'.$_1_10.'",';
			$_10_100s=$_10_100s.'"'.$_10_100.'",';
			$Sup_100s=$Sup_100s.'"'.$Sup_100.'",';
  }
  
  $typeActeurs=trim($typeActeurs,",");
  $Inf_01has=trim($Inf_01has,",");
		$_1_10s=trim($_1_10s,",");
		$_10_100s=trim($_10_100s,",");
		$Sup_100s=trim($Sup_100s,",");
  
/*---------------------------*/

}
  
  
 $requete="SELECT DISTINCT anneeRebois as annee FROM reboisement ORDER BY `reboisement`.`anneeRebois` ASC";
 $result=$db->prepare($requete);
 $result->execute();
 
  
?>

<?php
require('includes/header.php');
require('includes/scripts.php');
require('includes/navbar.php'); 
?>
 <div class="container">
    <?php if(!empty($erreurs)): ?>
      <div class="alert alert-danger" id="messageFlash">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
          <?php foreach($erreurs as $erreur): ?>
            <li><?=$erreur;?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif;?>
  </div>
 
 
 
<div class="container-fluid">

<!-- DataTales Example -->
 <div class="card shadow mb-4">
  <div class="card-body" style="height: auto;overflow-x: auto;overflow-y: auto">
            <div style="color: #111010">
              <form action="" method="get" id="form">
     
     
     <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="9" style="font-size: small">Recherche par date :</label>
          
          <select class="form-control" name="index_annee"
            onChange="this.form.submit();" >
            <option value=""></option>
            <?php  while($infocont=$result->fetch(PDO::FETCH_ASSOC)) {?>  
             <option 
              value="<?php echo  $infocont['annee'] ?>" 
              <?php if($infocont['annee']===$index_annee) echo "selected"?> > 
              <?php echo  $infocont['annee'] ?> 
             </option>       
            <?php  } ?>       
         </select>
        </div>
      </div>
     </div>
     
<?php if(isset($_GET['index_annee']) && !empty($_GET['index_annee'])):?>     
     <div class="row">
       <div class="col-md-12" id="table">
        <div class="scrollable">
          <table class="table table-bordered"> 
                 
                  <thead style="background: #E5E8EA">
                   
                    <h6><?php if(isset($_GET['index_annee']) && !empty($_GET['index_annee'])):?><a href="excel.php?search=class&index_annee=<?=$index_annee?>" class="btn btn-success btn-sm">Export excel</a>
                    <?php endif;?>
																				</h6>
																				<h6><b>Somme de la Superficie par Classe Année : <?=$index_annee?></b></h6>
																				<tr>
                    <td><b>Type Acteurs</b></td>
																				<td><b>Inf_01ha</b></td>
																				<td><b>1_10</b></td>
																				<td><b>10_100</b></td>
																				<td><b>Sup_100</b></td>
                   </tr> 
                  </thead> 
                  <tbody>
                    
                      <?php while($req=$reqs->fetch(PDO::FETCH_ASSOC)):?>
																						<tr>
																								<td><b><?=$req['typeActeur'];?></b></td>
																								<td><b><?=$req['Inf_01ha'];?></b></td>
																								<td><b><?=$req['1_10'];?></b></td>
																								<td><b><?=$req['10_100'];?></b></td>
																								<td><b><?=$req['Sup_100'];?></b></td>
																							</tr>
                      <?php endwhile;?>
                    
                  </tbody> 
          </table>
         
        
         <div class="chart-container">
          <canvas id="myChart"></canvas>
         </div>
         
        </div> 
       </div>
       <script>
           var ctx = document.getElementById('myChart').getContext('2d');
        
           var chart = new Chart(ctx, {
        
           // The type of chart we want to create
           type: 'bar',
           // The data for our dataset
           data: {
            labels: [<?=$typeActeurs;?>],
            datasets:
            [
             {
               label: 'Inf_01ha',
               backgroundColor: 'rgba(2, 238, 242, 0.2)',
               borderColor: 'turquoise',
               data: [<?=$Inf_01has;?>]
             },
             {
               label: '1_10',
               backgroundColor: 'rgba(237,11,11,0.2)',
               borderColor: 'red',
               data: [<?=$_1_10s;?>]
             },
             {
               label: '10_100',
               backgroundColor:'rgba(36,239,14,0.2)',
               borderColor: 'green',
               data: [<?=$_10_100s;?>]
             },
             {
               label: 'Sup_100',
               backgroundColor: 'rgba(187, 71, 237, 0.2)',
               borderColor:'purple',
               data: [<?=$Sup_100s;?>]
             }
            ],
           },
          });
         </script>
     </div>
     
     
 <?php endif;?>    
     
              </form>
            </div>      
  </div>
 </div>
</div>

<?php

require('includes/footer.php');
?>