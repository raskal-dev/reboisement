<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('admin');
if(isset($_GET['refresh']))
{
    $refresh=$_GET['refresh'];

    $sql="INSERT INTO reboisement
         (`id`, `acteur`, `typeActeur`, `dreed`, `region`, `district`, `commune`, `fokontany`, `site`, `situationJuridique`, `responsable`, `objectifReboisement`, `objectifRpf`, `Approche`, `surfaceTotalPrevu`, `superficieRealise`, `class_`, `mangroveOuTerrestre`, `dateMiseEnTerre`, `anneeRebois`)
         SELECT  reboisement_id, acteur, typeActeur, dreed, region, district, commune, fokontany, site, situationJuridique, responsable, objectifReboisement, objectifRpf, Approche, surfaceTotalPrevu, superficieRealise, class_, mangroveOuTerrestre, dateMiseEnTerre, anneeRebois
         FROM deletelog WHERE deletelog.id = ? ";
    $req=$db->prepare($sql);
    $req->execute([$refresh]);
    $id=$db->lastInsertId();


    $sql="DELETE
    FROM deletelog
    WHERE deletelog.id=?";
    $req=$db->prepare($sql);
    $req->execute([$refresh]);

    $_SESSION['flash']['success']="Données supprimées!!";
    header("location:deletelog.php");
    exit();
}

$sql="SELECT COUNT(*) AS nbElmt FROM deletelog ORDER BY id DESC";
$req=$db->query($sql);
$row=$req->fetch(PDO::FETCH_ASSOC);
$rows=$row['nbElmt'];
$textline1="Nombre de ligne (<b>$rows</b>)";


    $id_diredd_dredd_ciredd=$_SESSION['authentifier']['id_diredd_dredd_ciredd'];

$sql="SELECT *,deletelog.id as id_deletelog
         FROM deletelog
         LEFT JOIN region on region.nom_region=deletelog.region
         LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id
         WHERE diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
         ORDER BY deletelog.id DESC";

$req=$db->query($sql);
$rows=$req->rowCount();
$textline1="Nombre de ligne (<b>$rows</b>)";
?>
<?php
require_once ('includes/header.php');
require_once ('includes/scripts.php');
require_once ('includes/navbar.php');
?>
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4 mt-4">
<div class="row ml-1 mb-1">
    <?php echo $textline1;?>
</div>
<div class="row ml-1 mb-3">
    <a class="btn btn-danger btn-sm" href="admin.php">Retour</a>
</div>
<div class="card-body scrollable" id="acceuil">



<div class="row">
    <div class="col-sm-12">
            <table class="table table-bordered mt-2">
                <thead>
                    <tr><th>#</th><th>Date de suppression</th><th>Supprimé par</th><th>Information</th><th>Région> District> Commune> Fokontany</th><th>Site de Reboisement</th><th>Objectif Reboisement</th><th>Objectif RPF</th><th>Détails</th></tr>
                </thead>
                <tbody>
                      <?php while($donnee=$req->fetch()):?>
                      <tr>
                            <td><?=$donnee->id_deletelog?></td>
                            <td><?=$donnee->deletedate?></td>
                            <td><?=$donnee->deleteuser?></td>

                            <td>
                                 <u>Acteur:</u> <?=$donnee->acteur?></br>
                                 <u>Type:</u> <?=$donnee->typeActeur?>
                            </td>

                            <td><u>Région:</u><?=$donnee->region?></br>
                                <u>District:</u> <?=$donnee->district?></br>
                                <u>Commune:</u> <?=$donnee->commune?></br>
                                <u>Fokontany:</u> <?=$donnee->fokontany?>

                            </td>
                            <td><?=$donnee->site?></td>
                            <td><?=$donnee->objectifReboisement?></td>
                            <td><?=$donnee->objectifRpf?></td>
                            <td><a class="btn btn-success" href="deletelog.php?refresh=<?=$donnee->id_deletelog ?>" style="border-radius: 2em;font-size: small" onclick="return(confirm('Etes-vous sûr de vouloir restaurer la ligne'));"><span class="fas fa-sync"></span></a></td>
                      </tr>
                      <?php endwhile;?>
                </tbody>
            </table>

    </div>

</div>
</div>
<div class="row">
    <div class="col-sm-6 ml-1 mb-1 mt-3">
        <a class="btn btn-danger btn-sm" href="admin.php">Retour</a>
    </div>
</div>

</div>
</div>
<?php require'includes/footer.php';?>
