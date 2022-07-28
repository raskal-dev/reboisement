<?php
session_start();
require_once 'includes/function.php';
require_once 'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');


$sql = "SELECT * FROM region ORDER BY nom_region ASC";
$req_reg = $db->prepare($sql);
$req_reg->execute();

if ($Fonction->user('Level') != 3 || $Fonction->user('id_diredd_dredd_ciredd') != 21) {
  $id_diredd_dredd_ciredd = $Fonction->user('id_diredd_dredd_ciredd');
}

$sql1 = "SELECT * FROM diredd_dredd_ciredd ";
if ($Fonction->user('Level') != 3 || $Fonction->user('id_diredd_dredd_ciredd') != 21) {
  $sql1 .= "WHERE id_diredd_dredd_ciredd= '" . $id_diredd_dredd_ciredd . "' ";
}
$sql1 .= "ORDER BY nom_diredd_dredd_ciredd ASC";
$req1 = $db->prepare($sql1);
$req1->execute();

$sql2 = "SELECT * FROM type_acteur ORDER BY LIBELLETYPE_ACTEUR ASC";
$req_typeact = $db->prepare($sql2);
$req_typeact->execute();
$sql3 = "SELECT * FROM especes ORDER BY especes_nom ASC";
$req_espece = $db->prepare($sql3);
$req_espece->execute();

function fill_espece($db)
{
  $output = '';
  $mot_cle = " select  *
            from  especes  ORDER BY especes_nom ASC
           ";
  $statement = $db->prepare($mot_cle);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    $output .= '<option value="' . $row["especes_nom"] . '">' . $row["especes_nom"] . '</option>';
  }
  return $output;
}
$sql4 = "SELECT * FROM pepiniere ORDER BY site ASC";
$req_pep = $db->prepare($sql4);
$req_pep->execute();

function type_acteur($db)
{
  $outputtype_acteur = '';
  $sql_act = " select  *
            from  type_acteur";
  $statement = $db->prepare($sql_act);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    $outputtype_acteur .= '<option value="' . $row["ID_TYPE_ACTEUR"] . '">' . $row["LIBELLETYPE_ACTEUR"] . '</option>';
  }
  return $outputtype_acteur;
}

function type_acteur2($db)
{
  $outputtype_acteur2 = '';
  $sql_act = " select  *
            from  type_acteur";
  $statement = $db->prepare($sql_act);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    $outputtype_acteur2 .= '<option value="' . $row["ID_TYPE_ACTEUR"] . '">' . $row["LIBELLETYPE_ACTEUR"] . '</option>';
  }
  return $outputtype_acteur2;
}

function nom_pepiniere($db)
{
  $output = '';
  $sql_act = " select  *
            from  nom_pepiniere";
  $statement = $db->prepare($sql_act);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    $output .= '<option value="' . $row["nom_pep"] . '">' . $row["nom_pep"] . '</option>';
  }
  return $output;
}

function type_semi($db)
{
  $outputtype_semi = '';
  $sql_act = " select  *
            from  semis";
  $statement = $db->prepare($sql_act);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    $outputtype_semi .= '<option value="' . $row["type_semis"] . '">' . $row["type_semis"] . '</option>';
  }
  return $outputtype_semi;
}


// existance

if (isset($_POST['submitmodal'])) {
  $erreurs = array();
  if (empty($_POST['region'])) {
    $erreurs['region'] = "Le champ region ne doit pas être vide !!!";
  }
  if (empty($_POST['district'])) {
    $erreurs['district'] = "Le champ district ne doit pas être vide !!!";
  }
  if (empty($_POST['commune'])) {
    $erreurs['commune'] = "Le champ commune ne doit pas être vide !!!";
  }
  if (empty($_POST['fokontany'])) {
    $erreurs['fokontany'] = "Le champ fokontany ne doit pas être vide !!!";
  }
  if (empty($_POST['responsablePepiniere'])) {
    $erreurs['responsablePepiniere'] = "Le champ responsable Pepiniere ne doit pas être vide !!!";
  }
  if (empty($_POST['site'])) {
    $erreurs['site'] = "Le champ site Pepiniere ne doit pas être vide !!!";
  }
  if (empty($_POST['nom_pepiniere'])) {
    $erreurs['nom_pepiniere'] = "Le champ Nom pépinière ne doit pas être vide !!!";
  } else {
    $insert_region1 = trim($Fonction->secure($_POST['region']));
    $insert_district1 = trim($Fonction->secure($_POST['district']));
    $insert_commune1 = trim($Fonction->secure($_POST['commune']));

    $sql_region1 = "SELECT * FROM region WHERE id=?";
    $req_region1 = $db->prepare($sql_region1);
    $req_region1->execute([$insert_region1]);
    $info_region1 = $req_region1->fetch(PDO::FETCH_ASSOC);
    $region1 = $info_region1['nom_region'];

    $sql_district1 = "SELECT * FROM district WHERE id=?";
    $req_district1 = $db->prepare($sql_district1);
    $req_district1->execute([$insert_district1]);
    $info_district1 = $req_district1->fetch(PDO::FETCH_ASSOC);
    $district1 = $info_district1['nom_district'];

    $sql_commune1 = "SELECT * FROM commune WHERE id=?";
    $req_commune1 = $db->prepare($sql_commune1);
    $req_commune1->execute([$insert_commune1]);
    $info_commune1 = $req_commune1->fetch(PDO::FETCH_ASSOC);
    $commune1 = $info_commune1['nom_commune'];
    $sql = "SELECT * FROM pepiniere WHERE region=:region AND district=:district AND commune=:commune AND fokontany=:fokontany AND site=:site AND nom_pepiniere=:nom_pepiniere";

    $req_exist = $db->prepare($sql);
    $req_exist->execute(array(
      "region" => $region1,
      "district" => $district1,
      "commune" => $commune1,
      "fokontany" => $_POST['fokontany'],
      "site" => $_POST['site'],
      "nom_pepiniere" => $_POST['nom_pepiniere']
    ));

    $ligne_exist = $req_exist->rowCount();
    if ($ligne_exist) {
      $erreurs['nom_pepiniere'] = "Le pépinière existe déjà";
    }
  }



  if (empty($erreurs)) {
    $insert_region = trim($Fonction->secure($_POST['region']));
    $insert_district = trim($Fonction->secure($_POST['district']));
    $insert_commune = trim($Fonction->secure($_POST['commune']));

    $sql_region = "SELECT * FROM region WHERE id=?";
    $req_region = $db->prepare($sql_region);
    $req_region->execute([$insert_region]);
    $info_region = $req_region->fetch(PDO::FETCH_ASSOC);
    $region = $info_region['nom_region'];

    $sql_district = "SELECT * FROM district WHERE id=?";
    $req_district = $db->prepare($sql_district);
    $req_district->execute([$insert_district]);
    $info_district = $req_district->fetch(PDO::FETCH_ASSOC);
    $district = $info_district['nom_district'];

    $sql_commune = "SELECT * FROM commune WHERE id=?";
    $req_commune = $db->prepare($sql_commune);
    $req_commune->execute([$insert_commune]);
    $info_commune = $req_commune->fetch(PDO::FETCH_ASSOC);
    $commune = $info_commune['nom_commune'];

    $fokontany = trim($Fonction->secure($_POST['fokontany']));
    $site = trim($Fonction->secure($_POST['site']));
    $longitude = trim($Fonction->secure($_POST['longitude']));
    $latitude = trim($Fonction->secure($_POST['latitude']));
    $responsablePepiniere = trim($Fonction->secure($_POST['responsablePepiniere']));
    $nombrePlatebande = trim($Fonction->secure($_POST['nombrePlatebande']));
    $contact_responsable = trim($Fonction->secure($_POST['contact_responsable']));
    $nom_pepiniere = trim($Fonction->secure($_POST['nom_pepiniere']));
    $users_id = $Fonction->user('id');


    $sql_rbsmt = "INSERT INTO `pepiniere`(`dateRempl`, `region`, `district`, `commune`, `fokontany`, `site`, `nom_pepiniere`, `contact_responsable`,  `longitude`, `latitude`, `responsablePepiniere`,`nombrePlatebande`, `users_id`) VALUES (NOW(), :region, :district, :commune, :fokontany, :site, :nom_pepiniere, :contact_responsable, :longitude, :latitude, :responsablePepiniere, :nombrePlatebande, :users_id)";
    $req_rbsmt = $db->prepare($sql_rbsmt);
    $req_rbsmt->execute(array(
      "region" => $region,
      "district" => $district,
      "commune" => $commune,
      "fokontany" => $fokontany,
      "site" => $site,
      "nom_pepiniere" => $nom_pepiniere,
      "contact_responsable" => $contact_responsable,
      "longitude" => $longitude,
      "latitude" => $latitude,
      "responsablePepiniere" => $responsablePepiniere,
      "nombrePlatebande" => $nombrePlatebande,
      "users_id" => $users_id
    ));
    header('location:FichePepiniereProduction.php');
    exit();
  }
}
// fin insertion de modal

?>
<?php
require_once('includes/header.php');
require_once('includes/scripts.php');
require_once('includes/navbar.php');
?>
<?php if (!empty($erreurs)) : ?>..
<div class="alert alert-danger" id="messageFlash">
  <p>Vous n'avez pas rempli le formulaire correctement</p>
  <ul>
    <?php foreach ($erreurs as $erreur) : ?>
      <li><?= $erreur; ?></li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>


<div class="container-fluid">

  <?php /* if(isset($_SESSION)){var_dump($_SESSION);} */ ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="starter-template">
        <div class="col-sm-12">
          <form method="post" action="" id="insert">
            <span id="error"></span>
            <h5><b>Délimitation Administrative</b></h5>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Région : </label>
                  <select name="region" type="text" class="form-control region" id="id_region">
                    <option></option>
                    <?php while ($info_reg = $req_reg->fetch(PDO::FETCH_ASSOC)) : ?>
                      <option value="<?= $info_reg['id'] ?>"><?= $info_reg['nom_region'] ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>District : </label>
                  <select name="district" class="form-control district" id="id_district">
                    <option></option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>commune : </label>
                  <select name="commune" class="form-control commune" id="id_commune">
                    <option></option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>fokontany : </label>
                  <input name="fokontany" type="text" class="form-control fokontany">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Site : </label>
                  <input name="site" type="text" class="form-control site">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Coordonnées X : </label>
                  <input name="longitude" type="text" class="form-control longitude">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Coordonnées Y : </label>
                  <input name="latitude" type="text" class="form-control latitude">
                </div>
              </div>
            </div>
            <h5><b>Information sur la pepinière</b></h5>
            <div class="row">

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Nom Pépinière : <a href="Fiche_nom_pepiniere.php"><span href="#" class="fa fa-pen"></span></a> </label>
                  <select class="form-control nom_pepiniere" name="nom_pepiniere" id="nom_pepiniere">
                    <option></option>
                    <?php echo nom_pepiniere($db) ?>
                  </select>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Responsable : </label>
                  <input name="responsablePepiniere" type="text" class="form-control responsablePepiniere">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Contact Responsable : </label>
                  <input name="contact_responsable" type="text" class="form-control contact_responsable">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Nombre de plate-bande : </label>
                  <input name="nombrePlatebande" type="text" class="form-control nombrePlatebande">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Retour</button>
              <input type="submit" name="submitmodal" class="btn btn-success" value="Valider" onclick="return(confirm('Etes-vous sûr de vouloir confirmer la commande'));">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#id_region').on('change', function() {

      var ID_region = $(this).val();
      if (ID_region) {
        $.ajax({
          method: "POST",
          url: "select_dist.php",
          data: 'id_region=' + ID_region,
          success: function(html) {
            $('#id_district').html(html);
          }
        });
      } else {
        $('#id_district').html('<option value=""></option>');
        $('#id_commune').html('<option value=""></option>');
      }
    });
    $('#id_district').on('change', function() {
      var ID_district = $(this).val();
      if (ID_district) {
        $.ajax({
          method: "POST",
          url: "select_commune.php",
          data: 'id_district=' + ID_district,
          success: function(html) {
            $('#id_commune').html(html);
          }
        });
      } else {
        $('#id_commune').html('<option value=""></option>');
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {

    $('#dispositiion').on('change', function() {
      $(this).find("option:selected").each(function() {
        var val = $(this).attr("value");
        if (val) {
          $(".msg").not("." + val).hide();
          $("." + val).show();
        } else {
          $(".msg").hide();
        }
      });
    }).change();
  });
</script>
<?php require 'includes/footer.php'; ?>