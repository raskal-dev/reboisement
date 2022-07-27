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

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="starter-template">
        <div class="col-sm-12">
          <form method="post" action="" id="insert">
            <span id="error"></span>
            <h5><b>Institution</b></h5>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Acteur : </label>
                  <input name="acteur" type="text" class="form-control acteur">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Type d'acteur : </label>
                  <select name="typeActeur" class="form-control typeActeur" id="dispositiion">
                    <option></option>
                    <option value="1E1A">1E1A</option>
                    <option value="COMMUNAUTE">COMMUNAUTE</option>
                    <option value="Gestionaire AP">Gestionaire AP</option>
                    <option value="Institution publique">Institution publique</option>
                    <option value="Particulier">Particulier</option>
                    <option value="Projet">Projet</option>
                    <option value="Secteur Privé">Secteur Privé</option>
                    <option value="Autres">Autres</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>DREDD/CIREDD : </label>
                  <select name="dreed" class="form-control dreed">
                    <option></option>
                    <?php while ($info_dredd = $req1->fetch(PDO::FETCH_ASSOC)) : ?>
                      <option value="<?= $info_dredd['sign'] ?>&nbsp;<?= $info_dredd['nom_diredd_dredd_ciredd'] ?>"><?= $info_dredd['sign'] ?>&nbsp;<?= $info_dredd['nom_diredd_dredd_ciredd'] ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
              </div>
            </div>
            <h5><b>Délimitation Administrative</b></h5>
            <div class="row">
              <div class="col-sm-4">
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
              <div class="col-sm-4">
                <div class="form-group">
                  <label>District : </label>
                  <select name="district" class="form-control district" id="id_district">
                    <option></option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>commune : </label>
                  <select name="commune" class="form-control commune" id="id_commune">
                    <option></option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>fokontany : </label>
                  <input name="fokontany" type="text" class="form-control fokontany">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Site : </label>
                  <input name="site" type="text" class="form-control site">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Situation juridique : </label>
                  <input name="situationJuridique" type="text" class="form-control situationJuridique">
                </div>
              </div>

            </div>

            <h5><b>Coordonnées GPS</b></h5>
            <div class="row">
              <div class="col-sm-12">
                <div class="scrollable">
                  <table class="table table-bordered" id="item_table2">
                    <thead>
                      <tr>
                        <th>Coordonnées X</th>
                        <th>Coordonnées Y</th>
                        <th><button type="button" name="add2" class="btn btn-success btn-sm add2"><span class="fa fa-plus"></span></button></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input name="longitude[]" type="text" class="form-control longitude"></td>
                        <td><input name="latitude[]" type="text" class="form-control latitude"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <h5><b>Plan de Reboisement</b></h5>
            <div class="row">

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Responsable : </label>
                  <input name="responsable" type="text" class="form-control responsable">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Objectif de reboisement : </label>
                  <input name="objectifReboisement" type="text" class="form-control objectifReboisement">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Objectif RPF : </label>
                  <select name="objectifRpf" class="form-control objectifRpf">
                    <option></option>
                    <option value="PRODUCTION">PRODUCTION</option>
                    <option value="CONSERVATION">CONSERVATION</option>
                    <option value="REGULATION">REGULATION</option>
                    <option value="Autres">Autres</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="surfaceTotalReboise">Approche : </label>
                  <input name="Approche" type="text" class="form-control Approche">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Superficie total prévue (en Ha) : </label>
                  <input name="surfaceTotalPrevu" type="text" class="form-control surfaceTotalPrevu">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Superficie réalisée (en Ha) : </label>
                  <input name="superficieRealise" type="text" class="form-control superficieRealise">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Class : </label>
                  <select name="class_" class="form-control class_">
                    <option></option>
                    <option value="0_10">0_10</option>
                    <option value="10_100">10_100</option>
                    <option value=">100">>100</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Ecosystème : </label>
                  <select name="mangroveOuTerrestre" class="form-control mangroveOuTerrestre">
                    <option></option>
                    <option value="Mangrove">Mangrove</option>
                    <option value="Terrestre">Terrestre</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Date de reboisement : </label>
                  <input name="dateMiseEnTerre" type="date" class="form-control dateMiseEnTerre">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Campagne : </label>
                  <input name="anneeRebois" type="text" class="form-control anneeRebois">
                </div>
              </div>
            </div>

            <h5><b>Information sur Plants mise en terre</b></h5>
            <div class="row">
              <div class="col-sm-12">
                <div class="scrollable">
                  <table class="table table-bordered" id="item_table">
                    <thead>
                      <tr>
                        <th>Nom Scientifique</th>
                        <th>Nom Vernaculaire</th>
                        <th>Nombre plants mise en terre</th>
                        <th>Source plants</th>
                        <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="fa fa-plus"></span></button></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input name="nomScientifique[]" type="text" class="form-control nomScientifique"></td>
                        <td><input name="nomVernaculaire[]" type="text" class="form-control nomVernaculaire"></td>
                        <td><input name="nombrePlantMiseEnTerre[]" type="text" class="form-control nombrePlantMiseEnTerre"></td>
                        <td><input name="SourcePlant[]" type="text" class="form-control SourcePlant"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <script>
              $(document).ready(function() {
                $(document).on('click', '.add', function() {
                  var html = '';
                  html += '<tr>';
                  html += '<td><input name="nomScientifique[]" type="text" class="form-control nomScientifique"></td>';
                  html += '<td><input name="nomVernaculaire[]" type="text" class="form-control nomVernaculaire"></td>';
                  html += '<td><input name="nombrePlantMiseEnTerre[]" type="text" class="form-control nombrePlantMiseEnTerre"></td>';
                  html += '<td><input name="SourcePlant[]" type="text" class="form-control SourcePlant"></td>';
                  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-asterisk"></span></button></td></tr>';
                  $('#item_table').append(html);
                });
                $(document).on('click', '.add2', function() {
                  var html = '';
                  html += '<tr>';
                  html += '<td><input name="longitude[]" type="text" class="form-control longitude"></td>';
                  html += '<td><input name="latitude[]" type="text" class="form-control latitude"></td>';
                  html += '<td><button type="button" name="remove2" class="btn btn-danger btn-sm remove2"><span class="fa fa-asterisk"></span></button></td></tr>';
                  $('#item_table2').append(html);
                });

                $(document).on('click', '.remove', function() {
                  $(this).closest('tr').remove();
                });

                $(document).on('click', '.remove2', function() {
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

                  $('.acteur').each(function() {
                    var count = 1;

                    if ($(this).val() === '') {
                      error += "<li>le champ  acteur ne doit pas être vide</li>";
                      return false;
                    }
                    count = count + 1;
                  });
                  $('.typeActeur').each(function() {
                    var count = 1;
                    if ($(this).val() === '') {
                      error += "<li>le champ  type acteur ne doit pas être vide</li>";
                      return false;
                    }
                    count = count + 1;
                  });
                  $('.region').each(function() {
                    var count = 1;
                    if ($(this).val() === '') {
                      error += "<li>le champ  région ne doit pas être vide</li>";
                      return false;
                    }
                    count = count + 1;
                  });
                  $('.anneeRebois').each(function() {
                    var count = 1;
                    if ($(this).val() === '') {
                      error += "<li>le champ  Année de reboisement ne doit pas être vide</li>";
                      return false;
                    }
                    count = count + 1;
                  });
                  $('.longitude').each(function() {
                    var count = 1;
                    if ($(this).val() === '') {
                      error += "<li>Un ou plusieurs champ(s) vide dans la colonne  longitude</li>";
                      return false;
                    }
                    count = count + 1;
                  });
                  $('.latitude').each(function() {
                    var count = 1;
                    if ($(this).val() === '') {
                      error += "<li>Un ou plusieurs champ(s) vide dans la colonne  latitude</li>";
                      return false;
                    }
                    count = count + 1;
                  });
                  $('.nomVernaculaire').each(function() {
                    var count = 1;
                    if ($(this).val() === '') {
                      error += "<li>Un ou plusieurs champ(s) vide dans la colonne  nom vernaculaire</li>";
                      return false;
                    }
                    count = count + 1;
                  });
                  $('.nombrePlantMiseEnTerre').each(function() {
                    var count = 1;
                    if ($(this).val() === '') {
                      error += "<li>Un ou plusieurs champ(s) vide dans la colonne  nombre plants mise en terre</li>";
                      return false;
                    }
                    count = count + 1;
                  });
                  $('.SourcePlant').each(function() {
                    var count = 1;
                    if ($(this).val() === '') {
                      error += "<li>Un ou plusieurs champ(s) vide dans la colonne  source de plants</li>";
                      return false;
                    }
                    count = count + 1;
                  });

                  if (error === '') {
                    var insert = $('#insert')[0];
                    var data = new FormData(insert);

                    $.ajax({
                      url: "insert_reboisement.php",
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
              <a type="button" class="btn btn-danger" href="account.php">Retour</a>
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