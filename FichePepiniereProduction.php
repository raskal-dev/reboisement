<?php
session_start();
require_once 'includes/function.php';
require_once 'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');


$sql = "SELECT * FROM region ORDER BY nom_region ASC";
$req_reg = $db->prepare($sql);
$req_reg->execute();
// novana *************************************************************************
$id_diredd_dredd_ciredd=$_SESSION['authentifier']['id_diredd_dredd_ciredd'];

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
$sql4 = "SELECT * FROM pepiniere 
LEFT JOIN region on region.nom_region=pepiniere.region
LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id 
WHERE diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
ORDER BY site ASC ";
$req_pep = $db->prepare($sql4);
$req_pep->execute();
// ****************************************************************************************************************
function type_acteur($db)
{
  $outputtype_acteur = '';
  $sql_act = " select  *
            from  type_acteur";
  $statement = $db->prepare($sql_act);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    $outputtype_acteur .= '<option value="' . $row["LIBELLETYPE_ACTEUR"] . '">' . $row["LIBELLETYPE_ACTEUR"] . '</option>';
  }
  return $outputtype_acteur;
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

if(isset($_POST['submitmodal']))
{
  $erreurs=array();
  if (empty($_POST['region'])) {
    $erreurs['region']="Le champ region ne doit pas être vide !!!";
  }
  if (empty($_POST['district'])) {
    $erreurs['district']="Le champ district ne doit pas être vide !!!";
  }
  if (empty($_POST['commune'])) {
    $erreurs['commune']="Le champ commune ne doit pas être vide !!!";
  }
  if (empty($_POST['fokontany'])) {
    $erreurs['fokontany']="Le champ fokontany ne doit pas être vide !!!";
  }
  if (empty($_POST['responsablePepiniere'])) {
    $erreurs['responsablePepiniere']="Le champ responsable Pepiniere ne doit pas être vide !!!";
  }
  if (empty($_POST['site'])) {
    $erreurs['site']="Le champ site Pepiniere ne doit pas être vide !!!";
  }
  if (empty($_POST['nom_pepiniere'])) {
    $erreurs['nom_pepiniere']="Le champ Nom pépinière ne doit pas être vide !!!";
  }else{
    $insert_region1=trim($Fonction->secure($_POST['region']));
    $insert_district1=trim($Fonction->secure($_POST['district']));
    $insert_commune1=trim($Fonction->secure($_POST['commune']));
    
    $sql_region1="SELECT * FROM region WHERE id=?";
    $req_region1=$db->prepare($sql_region1);
    $req_region1->execute([$insert_region1]);
    $info_region1=$req_region1->fetch(PDO::FETCH_ASSOC);
    $region1=$info_region1['nom_region'];
    
    $sql_district1="SELECT * FROM district WHERE id=?";
    $req_district1=$db->prepare($sql_district1);
    $req_district1->execute([$insert_district1]);
    $info_district1=$req_district1->fetch(PDO::FETCH_ASSOC);
    $district1=$info_district1['nom_district'];
    
    $sql_commune1="SELECT * FROM commune WHERE id=?";
    $req_commune1=$db->prepare($sql_commune1);
    $req_commune1->execute([$insert_commune1]);
    $info_commune1=$req_commune1->fetch(PDO::FETCH_ASSOC);
    $commune1=$info_commune1['nom_commune'];
    $sql="SELECT * FROM pepiniere WHERE region=:region AND district=:district AND commune=:commune AND fokontany=:fokontany AND site=:site AND nom_pepiniere=:nom_pepiniere";

    $req_exist=$db->prepare($sql);
    $req_exist->execute(array(
                "region" => $region1,
                "district" => $district1,
                "commune" => $commune1,
                "fokontany" => $_POST['fokontany'],
                "site" => $_POST['site'],
                "nom_pepiniere" => $_POST['nom_pepiniere']
        ));

    $ligne_exist=$req_exist->rowCount();
    if ($ligne_exist) {
      $erreurs['nom_pepiniere']="Le pépinière existe déjà";
    }
  }



  if(empty($erreurs)){
    $insert_region=trim($Fonction->secure($_POST['region']));
    $insert_district=trim($Fonction->secure($_POST['district']));
    $insert_commune=trim($Fonction->secure($_POST['commune']));
    
    $sql_region="SELECT * FROM region WHERE id=?";
    $req_region=$db->prepare($sql_region);
    $req_region->execute([$insert_region]);
    $info_region=$req_region->fetch(PDO::FETCH_ASSOC);
    $region=$info_region['nom_region'];
    
    $sql_district="SELECT * FROM district WHERE id=?";
    $req_district=$db->prepare($sql_district);
    $req_district->execute([$insert_district]);
    $info_district=$req_district->fetch(PDO::FETCH_ASSOC);
    $district=$info_district['nom_district'];
    
    $sql_commune="SELECT * FROM commune WHERE id=?";
    $req_commune=$db->prepare($sql_commune);
    $req_commune->execute([$insert_commune]);
    $info_commune=$req_commune->fetch(PDO::FETCH_ASSOC);
    $commune=$info_commune['nom_commune'];
    
    $fokontany=trim($Fonction->secure($_POST['fokontany']));
    $site=trim($Fonction->secure($_POST['site']));
    $longitude=trim($Fonction->secure($_POST['longitude']));
    $latitude=trim($Fonction->secure($_POST['latitude']));
    $responsablePepiniere=trim($Fonction->secure($_POST['responsablePepiniere']));
    $nombrePlatebande=trim($Fonction->secure($_POST['nombrePlatebande']));
    $contact_responsable=trim($Fonction->secure($_POST['contact_responsable']));
    $nom_pepiniere=trim($Fonction->secure($_POST['nom_pepiniere']));
    $type_acteur=trim($Fonction->secure($_POST['type_acteur']));
    $users_id=$Fonction->user('id');
    
    
    $sql_rbsmt="INSERT INTO `pepiniere`(`dateRempl`, `region`, `district`, `commune`, `fokontany`, `site`, `nom_pepiniere`, `contact_responsable`,`type_acteur`,  `longitude`, `latitude`, `responsablePepiniere`,`nombrePlatebande`, `users_id`) VALUES (NOW(), :region, :district, :commune, :fokontany, :site, :nom_pepiniere, :contact_responsable, :type_acteur, :longitude, :latitude, :responsablePepiniere, :nombrePlatebande, :users_id)";
    $req_rbsmt=$db->prepare($sql_rbsmt);
    $req_rbsmt->execute(array(
                "region" => $region,
                "district" => $district,
                "commune" => $commune,
                "fokontany" => $fokontany,
                "site" => $site,
                "nom_pepiniere" => $nom_pepiniere,
                "contact_responsable" => $contact_responsable,
                "type_acteur" => $type_acteur,
                "longitude" => $longitude,
                "latitude" => $latitude,
                "responsablePepiniere" => $responsablePepiniere,
                "nombrePlatebande" => $nombrePlatebande,
                "users_id"=>$users_id
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

<!-- debug de var_dump -->
<?php /*if(isset($_SESSION)){var_dump($_SESSION);}*/ ?>
<div class="container-fluid">
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

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="starter-template">
        <div class="col-sm-12">
          <span id="error"></span>
          <h5><b>Fiche de collecte des sorties des pépinières</b></h5>

          <br><br>

          <h5><b>SYSTÈME DE SUIVI DES ACTIVITÉS DE REBOISEMENT ET DE RESTAURATION DES PAYSAGES FORÊSTIERS À MADAGASCAR . MINISTÈRE DE L'ENVIRONNEMENT ET DU DÉVELOPPEMENT DURABLE - COLLECTE DES DONNÉES SUR LES PÉPINIÈRES - PRODUCTION</b></h5>
          <br>
          <h5><b>Promoteur</b></h5>
          <div class="row">
          <form action="" method="post">
            <!--debut Modal -->
            <div class="modal fade" id="staticBackdrop" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Nouveau Pépinière</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                  </div>


                  
                    <div class="modal-body">

                      <div class="container-fluid">








                        <!-- debut donnée et form modal -->


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
                                        <label>Nom Pépinière : </label>
                                        <select class="form-control nom_pepiniere" name="nom_pepiniere" id="nom_pepiniere">
                                          <option></option>
                                        <?= nom_pepiniere($db) ?>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label>Type Acteur : </label>
                                        <select class="form-control type_acteur" name="type_acteur" id="type_acteur">
                                          <option></option>
                                        <?= type_acteur($db) ?>
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






                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- fin donnée et form modal -->


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Retour</button>
                        <input type="submit" name="submitmodal" class="btn btn-success" value="Valider" onclick="return(confirm('Etes-vous sûr de vouloir confirmer la commande'));">
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
        <!-- fin modal -->













        <form method="post" action="insert_pepiniereproduction.php" id="insert">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label>Nom Pépinière :</label>
                <span class="col-sm-3" data-toggle="modal" data-target="#staticBackdrop"> <span class="btn btn-success mx-3" data-toggle="tooltip" data-placement="top" title="nouveau pepiniere"><span class="fa fa-plus"></span></span></span>

                <select name="id_pepiniere" type="text" class="form-control id_pepiniere">
                  <option></option>
                  <?php while ($info = $req_pep->fetch(PDO::FETCH_ASSOC)) : ?>
                    <option value="<?= $info['id_pepiniere'] ?>"><?= $info['site'] ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>

          </div>



          <h5><b>Information sur les Essences</b></h5>
          <div class="row">
            <div class="col-sm-12">
              <div class="scrollable">
                <table class="table table-bordered" id="item_table">
                  <thead>
                    <tr>
                      <th>Espece</th>
                      <th>Date de Semi</th>
                      <th>Type Semi</th>
                      <th>Nobre de Plants Produits</th>
                      <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="fa fa-plus"></span></button></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <select name="essence[]" class="form-control essence">
                          <option></option>
                          <?php echo fill_espece($db); ?>
                        </select>
                      </td>
                      <td><input name="dateSemi[]" type="date" class="form-control dateSemi"></td>
                      <!-- type semi -->
                      <td>
                        <select name="type_semi[]" class="form-control type_semi">
                          <option></option>
                          <?php echo type_semi($db); ?>
                        </select>
                      </td>
                      <td><input name="nombrePlantSemi[]" type="text" class="form-control nombrePlantSemi"></td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>
            <!-- success -->
          </div>
      </div>

    </div>

    <script>
      $(document).ready(function() {
        $(document).on('click', '.add', function() {
          var html = '';
          html += '<tr>';
          html += '<td><select name="essence[]" class="form-control essence"> <option></option><?php echo fill_espece($db); ?></select></td>';
          html += '<td><input name="dateSemi[]" type="date" class="form-control dateSemi"></td>';
          html += '<td><select name="type_semi[]" class="form-control type_semi"> <option></option><?php echo type_semi($db); ?></select></td>';
          html += '<td><input name="nombrePlantSemi[]" type="text" class="form-control nombrePlantSemi"></td>';
          html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-asterisk"></span></button></td></tr>';
          $('#item_table').append(html);
        });


        $(document).on('click', '.remove', function() {
          $(this).closest('tr').remove();
        });


        $('#submit').click(function(event) {

          var timer = setTimeout(cacher, 6000);
          $('#messageFlash').click(function() {
            clearTimeout(timer);
            $(this).hide(3000);
          });

          $("#close").click(function() {
            $('#erreur').hide();
          });

          function cacher() {
            $('#messageFlash').hide(6000);
          }

          event.preventDefault();
          var error = '';

          $('.id_pepiniere').each(function() {
            var count = 1;

            if ($(this).val() === '') {
              error += "<li>le champ  nom pépinière ne doit pas être vide</li>";
              return false;
            }
            count = count + 1;
          });
          $('.essence').each(function() {
            var count = 1;
            if ($(this).val() === '') {
              error += "<li>le champ  espece ne doit pas être vide</li>";
              return false;
            }
            count = count + 1;
          });
          $('.dateSemi').each(function() {
            var count = 1;
            if ($(this).val() === '') {
              error += "<li>vous devez entrer une date semi</li>";
              return false;
            }
            count = count + 1;
          });
          $('.type_semi').each(function() {
            var count = 1;
            if ($(this).val() === '') {
              error += "<li>le champ  type semi ne doit pas être vide</li>";
              return false;
            }
            count = count + 1;
          });
          $('.nombrePlantSemi').each(function() {
            var count = 1;
            if ($(this).val() === '') {
              error += "<li>le champ nombre plant semi ne doit pas être vide</li>";
              return false;
            }
            count = count + 1;
          });


          if (error === '') {
            var insert = $('#insert')[0];
            var data = new FormData(insert);
            $.ajax({
              url: "insert_pepiniereproduction.php",
              method: "POST",
              data: data,
              processData: false,
              contentType: false,
              cache: false,
              timeout: 600000,
              success: function(reponse) {
                alert("voulez-vous confirmer la commande?");
                $('#insert')[0].reset();
                $('#error').html('<div class="alert alert-success" id="messageFlash"><p><li>Informations insérées</li></p></div>');
                location.reload();
                return false;
              }
            });
          } else {
            $('#error').html('<div class="alert alert-danger" id="messageFlash">' + error + '</div>');
          }
        });
      });
    </script>
    <div class="modal-footer">
      <a type="button" class="btn btn-danger" href="pepinieresortie.php">Retour</a>
      <input type="submit" id="submit" class="btn btn-success" value="Valider">
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