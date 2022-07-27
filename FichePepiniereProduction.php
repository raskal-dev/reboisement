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


?>
<?php
require_once('includes/header.php');
require_once('includes/scripts.php');
require_once('includes/navbar.php');
?>

<!-- debug de var_dump -->
<?php if(isset($_SESSION)){var_dump($_SESSION);} ?>
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

            <!--debut Modal -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Nouveau Pépinière</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                  </div>
                  <div class="modal-body">


                    <form action="" method="post">

                      <h3>Délimitation Administrative</h3>

                      <div class="row">
                        <div class="col-sm-3">
                          <label for="region" class="form-group">Région :</label>
                          <input type="text" name="region" id="region" class="form-control">
                        </div>

                        <div class="col-sm-3">
                          <label for="district" class="form-group">District :</label>
                          <input type="text" name="district" id="district" class="form-control">
                        </div>

                        <div class="col-sm-3">
                          <label for="commune" class="form-group">commune :</label>
                          <input type="text" name="commune" id="commune" class="form-control">
                        </div>

                        <div class="col-sm-3">
                          <label for="site" class="form-group">Site :</label>
                          <input type="text" name="site" id="site" class="form-control">
                        </div>

                        <div class="col-sm-3">
                          <label for="cooX" class="form-group">Coordonnées X :</label>
                          <input type="text" name="cooX" id="cooX" class="form-control">
                        </div>

                        <div class="col-sm-3">
                          <label for="cooY" class="form-group">Coordonnées Y :</label>
                          <input type="text" name="cooY" id="cooY" class="form-control">
                        </div>

                        <div class="col-sm-3">
                          <label for="region" class="form-group">Région :</label>
                          <input type="text" name="region" id="region" class="form-control">
                        </div>
                      </div>

                      <br>

                      <h3>Information sur la pepinière</h3>

                      <div class="row">
                        <div class="col-sm-3">
                          <label for="responsable" class="form-group">Responsable :</label>
                          <input type="text" name="responsable" id="responsable" class="form-control">
                        </div>

                        <div class="col-sm-3">
                          <label for="nbplatebande" class="form-group">Nombre de plate-bande :</label>
                          <input type="text" name="nbplatebande" id="nbplatebande" class="form-control">
                        </div>

                        <div class="col-sm-3">
                          <label for="anneexerc" class="form-group">Année de l'exercice :</label>
                          <input type="text" name="anneexerc" id="anneexerc" class="form-control">
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="type_acteur">TYPE ACTEUR</label>
                            <select name="type_acteur" type="text" class="form-control">
                              <option></option>
                              <?php echo type_acteur2($db); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="responsable">Responsable Pepiniere</label>
                            <input type="text" name="" id="responsable" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="responsable">Contact Pepiniere</label>
                            <input type="text" name="" id="contact-pep" class="form-control">


                          </div>
                        </div>
                      </div>



                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Enregistrer</button>
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

                <select name="id_pepiniere" type="text" class="form-control id_pepiniere">
                  <option></option>
                  <?php while ($info = $req_pep->fetch(PDO::FETCH_ASSOC)) : ?>
                    <option value="<?= $info['id_pepiniere'] ?>"><?= $info['site'] ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="type_acteur">TYPE ACTEUR</label>
                <select name="type_acteur" type="text" class="form-control type_acteur">
                  <option></option>
                  <?php echo type_acteur2($db); ?>
                </select>
              </div>
            </div>
            <span class="col-sm-3" data-toggle="modal" data-target="#staticBackdrop"> <span class="btn btn-success mx-3" data-toggle="tooltip" data-placement="top" title="nouveau pepiniere"><span class="fa fa-plus"></span></span></span>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label for="responsable">Responsable : </label>
              <input type="text" name="responsable" id="responsable" class="form-control responsable">
            </div>

            <div class="col-sm-3">
              <label for="contact_pepineriste">Contact responsable pépinière : </label>
              <input type="text" name="contact_pepineriste" id="contact_pepineriste" class="form-control contact_pepineriste">
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
          $('.type_acteur').each(function() {
            var count = 1;
            if ($(this).val() === '') {
              error += "<li>le champ Type acteur ne doit pas être vide</li>";
              return false;
            }
            count = count + 1;
          });
          $('.responsable').each(function() {
            var count = 1;
            if ($(this).val() === '') {
              error += "<li>le champ  résponsable ne doit pas être vide</li>";
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

          $('.contact_pepineriste').each(function() {
            var count = 1;
            if ($(this).val() === '') {
              error += "<li>le champ contact ne doit pas être vide</li>";
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
      <input type="submit" name="valider" class="btn btn-success" value="Valider">
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