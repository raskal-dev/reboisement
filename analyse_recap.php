<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/function.php';
$Fonction->logged_only();

 $index_annee_deb="";
	$index_annee_fin="";
if(isset($_GET['index_annee_deb']) && !empty($_GET['index_annee_deb']) || isset($_GET['index_annee_fin']) && !empty($_GET['index_annee_fin']))
{
//  $_SESSION['index_annee_deb'] = $Fonction->secure($_GET['index_annee_deb']);
//		$_SESSION['index_annee_fin'] = $Fonction->secure($_GET['index_annee_fin']);

		$index_annee_deb = $Fonction->secure($_GET['index_annee_deb']);
		$index_annee_fin = $Fonction->secure($_GET['index_annee_fin']);

$sql="select
    `reboisement`.`region` as `region`,
				`reboisement`.`mangroveOuTerrestre` as `mangroveOuTerrestre`,
    sum(`reboisement`.`superficieRealise`) as `surfacerealise`,
				sum(`plant_mise_terre`.`nombrePlantMiseEnTerre`) as `nbrmisenterre`
    from `reboisement`
				join plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
				WHERE `plant_mise_terre`.`dateMiseEnTerre` between '$index_annee_deb' and '$index_annee_fin'
				and `reboisement`.`mangroveOuTerrestre` LIKE 'Terrestre'
    group by
    `reboisement`.`region`,`reboisement`.`mangroveOuTerrestre`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs=$db->prepare($sql);
  $reqs->execute();

$sql1="select
    `reboisement`.`region` as `region`,
				`reboisement`.`mangroveOuTerrestre` as `mangroveOuTerrestre`,
    sum(`reboisement`.`superficieRealise`) as `surfacerealise`,
				sum(`plant_mise_terre`.`nombrePlantMiseEnTerre`) as `nbrmisenterre`
    from `reboisement`
				join plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
				WHERE `plant_mise_terre`.`dateMiseEnTerre` between '$index_annee_deb' and '$index_annee_fin'
				and `reboisement`.`mangroveOuTerrestre` LIKE 'Mangrove'
    group by
    `reboisement`.`region`,`reboisement`.`mangroveOuTerrestre`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs1=$db->prepare($sql1);
  $reqs1->execute();

$sql5="select
    `reboisement`.`region` as `region`,
				`reboisement`.`mangroveOuTerrestre` as `mangroveOuTerrestre`,
    sum(`reboisement`.`superficieRealise`) as `surfacerealisetot`,
				sum(`plant_mise_terre`.`nombrePlantMiseEnTerre`) as `nbrmisenterretot`
    from `reboisement`
				join plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
				WHERE `plant_mise_terre`.`dateMiseEnTerre` between '$index_annee_deb' and '$index_annee_fin'
    group by
    `reboisement`.`region`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs5=$db->prepare($sql5);
  $reqs5->execute();

	$regions2='';
 $surfacerealisetots='';
	$nbrmisenterretots='';

$sql4="select
    `reboisement`.`region` as `region`,
				`reboisement`.`mangroveOuTerrestre` as `mangroveOuTerrestre`,
    sum(`reboisement`.`superficieRealise`) as `surfacerealisetot`,
				sum(`plant_mise_terre`.`nombrePlantMiseEnTerre`) as `nbrmisenterretot`
    from `reboisement`
				join plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
				WHERE `plant_mise_terre`.`dateMiseEnTerre` between '$index_annee_deb' and '$index_annee_fin'
    group by
    `reboisement`.`region`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs4=$db->prepare($sql4);
  $reqs4->execute();

  while($row4=$reqs4->fetch(PDO::FETCH_ASSOC))
  {
   $region2=$row4['region'];
   $surfacerealisetot=$row4['surfacerealisetot'];
			$nbrmisenterretot=$row4['nbrmisenterretot'];

   $regions2=$regions2.'"'.$region2.'",';
   $surfacerealisetots=$surfacerealisetots.'"'.$surfacerealisetot.'",';
			$nbrmisenterretots=$nbrmisenterretots.'"'.$nbrmisenterretot.'",';
  }

  $regions2=trim($regions2,",");
  $surfacerealisetots=trim($surfacerealisetots,",");
		$nbrmisenterretots=trim($nbrmisenterretots,",");

 $regions='';
 $surfacerealises='';
	$nbrmisenterres='';

$sql2="select
    `reboisement`.`region` as `region`,
				`reboisement`.`mangroveOuTerrestre` as `mangroveOuTerrestre`,
    sum(`reboisement`.`superficieRealise`) as `surfacerealise`,
				sum(`plant_mise_terre`.`nombrePlantMiseEnTerre`) as `nbrmisenterre`
    from `reboisement`
				join plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
				WHERE `plant_mise_terre`.`dateMiseEnTerre` between '$index_annee_deb' and '$index_annee_fin'
				and `reboisement`.`mangroveOuTerrestre` LIKE 'Terrestre'
    group by
    `reboisement`.`region`,`reboisement`.`mangroveOuTerrestre`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs2=$db->prepare($sql2);
  $reqs2->execute();

  while($row2=$reqs2->fetch(PDO::FETCH_ASSOC))
  {
   $region=$row2['region'];
   $surfacerealise=$row2['surfacerealise'];
			$nbrmisenterre=$row2['nbrmisenterre'];

   $regions=$regions.'"'.$region.'",';
   $surfacerealises=$surfacerealises.'"'.$surfacerealise.'",';
			$nbrmisenterres=$nbrmisenterres.'"'.$nbrmisenterre.'",';
  }

  $regions=trim($regions,",");
  $surfacerealises=trim($surfacerealises,",");
		$nbrmisenterres=trim($nbrmisenterres,",");


	$regions1='';
 $surfacerealises1='';
	$nbrmisenterres1='';

$sql3="select
    `reboisement`.`region` as `region`,
				`reboisement`.`mangroveOuTerrestre` as `mangroveOuTerrestre`,
    sum(`reboisement`.`superficieRealise`) as `surfacerealise`,
				sum(`plant_mise_terre`.`nombrePlantMiseEnTerre`) as `nbrmisenterre`
    from `reboisement`
				join plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
				WHERE `plant_mise_terre`.`dateMiseEnTerre` between '$index_annee_deb' and '$index_annee_fin'
				and `reboisement`.`mangroveOuTerrestre` LIKE 'Mangrove'
    group by
    `reboisement`.`region`,`reboisement`.`mangroveOuTerrestre`,`reboisement`.`anneeRebois`
    ORDER BY `reboisement`.`region` ASC";
  $reqs3=$db->prepare($sql3);
  $reqs3->execute();

  while($row3=$reqs3->fetch(PDO::FETCH_ASSOC))
  {
   $region1=$row3['region'];
   $surfacerealise1=$row3['surfacerealise'];
			$nbrmisenterre1=$row3['nbrmisenterre'];

   $regions1=$regions1.'"'.$region1.'",';
   $surfacerealises1=$surfacerealises1.'"'.$surfacerealise1.'",';
			$nbrmisenterres1=$nbrmisenterres1.'"'.$nbrmisenterre1.'",';
  }

  $regions1=trim($regions1,",");
  $surfacerealises1=trim($surfacerealises1,",");
		$nbrmisenterres1=trim($nbrmisenterres1,",");
/*---------------------------*/

}



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
  <div class="card-body" style="height: auto;overflow-x: auto;overflow-y: auto" id="acceuil">
            <div style="color: #111010">
              <form action="" method="get" id="form">


     <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="9" style="font-size: small">Date début :</label>
          <input class="form-control" name="index_annee_deb"
            onChange="this.form.submit();" type="date" value="<?php echo  $index_annee_deb ?>"/>
								</div>
						</div>
						<div class="col-sm-6">
								<div class="form-group">
									<label for="9" style="font-size: small">Date fin :</label>
          <input class="form-control" name="index_annee_fin"
            onChange="this.form.submit();" type="date" value="<?php echo  $index_annee_fin ?>"/>
        </div>
      </div>
     </div>

<?php if(isset($_GET['index_annee_deb']) && !empty($_GET['index_annee_deb']) || isset($_GET['index_annee_fin']) && !empty($_GET['index_annee_fin'])):?>
<h6><a href="excel.php?search=recap&index_annee_fin=<?=$index_annee_fin?>&index_annee_deb=<?=$index_annee_deb?>" class="btn btn-success btn-sm">Export excel</a></h6>
     <div class="row">
       <div class="col-md-4" id="table">
        <div class="scrollable">
          <table class="table table-bordered">

                  <thead style="background: #E5E8EA">


																				<tr>
                    <td colspan="4" align="center"><b>Terrestre</b></td>
																				</tr>
																			<tr>
																				<td><b>Région</b></td>
																				<td><b>Somme de Superficie (Ha)</b></td>
																				<td><b>Somme de Nombre plants mise en terre</b></td>
                   </tr>

                  </thead>

                  <tbody>

                      <?php while($req=$reqs->fetch(PDO::FETCH_ASSOC)):?>
																						<tr>
																							<td><b><?=$req['region'];?></b></td>
																								<td><b><?=$req['surfacerealise'];?></b></td>
																								<td><b><?=$req['nbrmisenterre'];?></b></td>
																							</tr>
                      <?php endwhile;?>

                  </tbody>

          </table>
									</div>
								  <div class="chart-container">
          <canvas id="myChart"></canvas>
         </div>
							<script>
           var ctx = document.getElementById('myChart').getContext('2d');

           var chart = new Chart(ctx, {

           // The type of chart we want to create
           type: 'bar',
           // The data for our dataset
           data: {
            labels: [<?=$regions;?>],
            datasets:
            [

													{
               label: 'Σ Superficie (Ha)',
               borderColor: 'red',
               backgroundColor:'rgba(239, 7, 76, 0.2)',
               data: [<?=$surfacerealises;?>]
             },
             {
               label: 'Σ Nbr plants mise en terre',
               borderColor: 'turquoise',
               backgroundColor:'rgba(5, 95, 96, 0.2)',
               data: [<?=$nbrmisenterres;?>]
             }
            ],
           },
          });
         </script>
							</div>
							<div class="col-md-4" id="table">
        <div class="scrollable">
										<table class="table table-bordered">
																	<thead style="background: #E5E8EA">
																			<tr>
                    <td colspan="4" align="center"><b>Mangrove</b></td>
																				</tr>
																			<tr>
																				<td><b>Région</b></td>
																				<td><b>Somme de Superficie (Ha)</b></td>
																				<td><b>Somme de Nombre plants mise en terre</b></td>
                   </tr>

                  </thead>

                  <tbody>

                      <?php while($req1=$reqs1->fetch(PDO::FETCH_ASSOC)):?>
																						<tr>
																							<td><b><?=$req1['region'];?></b></td>
																								<td><b><?=$req1['surfacerealise'];?></b></td>
																								<td><b><?=$req1['nbrmisenterre'];?></b></td>
																							</tr>
                      <?php endwhile;?>

                  </tbody>

        </table>
								</div>
								<div class="chart-container">
          <canvas id="myChart1"></canvas>
         </div>
							<script>
           var ctx = document.getElementById('myChart1').getContext('2d');

           var chart = new Chart(ctx, {

           // The type of chart we want to create
           type: 'bar',
           // The data for our dataset
           data: {
            labels: [<?=$regions1;?>],
            datasets:
            [

													{
               label: 'Σ Superficie (Ha)',
               borderColor: 'red',
               backgroundColor:'rgba(239, 7, 76, 0.2)',
               data: [<?=$surfacerealises1;?>]
             },
             {
               label: 'Σ Nbr plants mise en terre',
               borderColor: 'turquoise',
               backgroundColor:'rgba(5, 95, 96, 0.2)',
               data: [<?=$nbrmisenterres1;?>]
             }
            ],
           },
          });
         </script>
							</div>
       <div class="col-md-4" id="table">
        <div class="scrollable">
										<table class="table table-bordered">
																	<thead style="background: #E5E8EA">
																			<tr>
                    <td colspan="4" align="center"><b>Total</b></td>
																				</tr>
																			<tr>
																				<td><b>Région</b></td>
																				<td><b>Total Somme de Superficie (Ha)</b></td>
																				<td><b>Total Somme de Nombre plants mise en terre</b></td>
                   </tr>

                  </thead>

                  <tbody>

                      <?php while($req5=$reqs5->fetch(PDO::FETCH_ASSOC)):?>
																						<tr>
																							<td><b><?=$req5['region'];?></b></td>
																								<td><b><?=$req5['surfacerealisetot'];?></b></td>
																								<td><b><?=$req5['nbrmisenterretot'];?></b></td>
																							</tr>
                      <?php endwhile;?>

                  </tbody>

        </table>
								</div>
								<div class="chart-container">
          <canvas id="myChart2"></canvas>
         </div>
							<script>
           var ctx = document.getElementById('myChart2').getContext('2d');

           var chart = new Chart(ctx, {

           // The type of chart we want to create
           type: 'bar',
           // The data for our dataset
           data: {
            labels: [<?=$regions2;?>],
            datasets:
            [

													{
               label: 'Tot Σ Superficie (Ha)',
               borderColor: 'red',
               backgroundColor:'rgba(239, 7, 76, 0.2)',
               data: [<?=$surfacerealisetots;?>]
             },
             {
               label: 'Tot Σ Nbr plants mise en terre',
               borderColor: 'turquoise',
               backgroundColor:'rgba(5, 95, 96, 0.2)',
               data: [<?=$nbrmisenterretots;?>]
             }
            ],
           },
          });
         </script>
							</div>

        </div>
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
