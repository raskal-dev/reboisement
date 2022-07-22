<?php

  function base_url(){
    $url = 'http://102.16.25.129/reboisement/reboisementU/reboisement/';
    return $url;
  }

  function connect_db()
  {
      $dsn="mysql:dbname=reboisement;host=localhost:3306";

  try
  {

    $connexion=new PDO($dsn,'root','');

      $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  }
  catch(PDOException $e)
  {
  printf("Echec connexion : %s\n",
  $e->getMessage());
  exit();
  }
  return $connexion;
}

  function getDataToLoad($sqlText){

      $connexion=connect_db();

      $result=Array();


 $info=$connexion->query($sqlText);

 if (isset($info)){
   foreach ($info as $row)
    {

         $result[]=$row;
    }
 } else {
     $result[]=[];
 }

 //print_r($result);
      return $result;

  }

 $lstSujet=getDataToLoad("select ID_SUJET,LIBELLE_SUJET from sujet_discussion");
 $lstDiscussion=getDataToLoad("select * from sujet_discussion_details order by DATE_SAISIE");
 $userConnect= isset($_SESSION['authentifier']) ? $_SESSION['authentifier']:'Non connecté';


?>


<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.0.29, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/medd-126x120.png" type="image/x-icon">
  <meta name="description" content="">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/tether/tether.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dropdown/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/socicon/css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/style.css">
  <link rel="preload" as="style" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/leaflet.css">



</head>
<body>

<form id="frmAction"  method="post" action="#">
  <input id="ID_DISCUSSION" type="hidden" value="" name="ID_DISCUSSION">
      <section style="background-color: #eee;">
        <div class="container py-5">

          <div class="row d-flex justify-content-center" >
            <div class="col-md-10 col-lg-8 col-xl-6">

              <div class="card" id="chat2">
                <div class="card-header d-flex justify-content-between align-items-center p-3">
                  <h6 class="mb-0">Sujet de discussion</h6>
                <select id="ID_SUJET"class="form-select" name="ID_SUJET" aria-label="Default select example">
                  <?php
                      foreach ($lstSujet as $value) {
                        echo "<option value=".$value['ID_SUJET'].">".$value['LIBELLE_SUJET']."</option>";
                      }
                  ?>

                </select>

                </div>

                <div id="chatBody" class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px;overflow-y: scroll">
                  <div id="messages">

                  </div>

                </div>
                <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                  <input type="text" id="MESSAGE" name="MESSAGE" class="form-control form-control " id="exampleFormControlInput1"
                    placeholder="Type message">
                  <a class="ms-1 text-muted mr-1" href="#!"><i class="fas fa-paperclip"></i></a>
                  <a class="ms-3 text-muted mr-1" href="#!"><i class="fas fa-smile"></i></a>
                  <button  id="sendMessage" type="button" class="btn"><i class="fas fa-paper-plane text-warning"></i></button>
                </div>
              </div>

            </div>
          </div>

        </div>
      </section>
    </form>
  </body>
<style>
    .form-control:focus {
        border-color:   #FFCC00;
    }
</style>

 <script src="<?php echo base_url();?>assets/web/assets/jquery/jquery.min.js"></script>
<script type="text/javascript">


$(document).ready(function () {

var  refreshChat=setInterval(function () {refreshDiv()}, 10000);

var url="<?php echo base_url() ?>";

$("#sendMessage").click(function( event ) {
  $("#ID_DISCUSSION").val("");
  var valSaisi =$("#frmAction").serialize();

  persistance('sujet_discussion_details',valSaisi);

});


  function persistance(tableName,valSaisi ){
    idTraitement='Ajout';
    oldsValue="";
    config='referentiel.ini';
    utilisateur="<?php echo $userConnect ?>";
    alert(utilisateur);
    $.ajax({
                                              url: 'http://102.16.25.129/reboisement/reboisementU/reboisement/index.php/activite.php/persitance',
                                              type:"POST",
                                              dataType: "html",
                                              data:{valSaisi:valSaisi,tableName:tableName,idTraitement:idTraitement,oldsValue:oldsValue,config:config,utilisateur:utilisateur},
                                              success: function(response) {

                                                console.log(response);
                                                refreshDiv();
                                              },
                                              beforeSend: function() {
                                            },
                                              error :  function(e){
                                                 console.log(e);
                                        }
                                       });
  }

 });

function refreshDiv(){
  var url="<?php echo base_url() ?>";
  var idSujet=$("#ID_SUJET").val();


    $.ajax({
                                              url: 'http://102.16.25.129/reboisement/reboisementU/reboisement/index.php/activite.php/refreshChat',
                                              type:"POST",
                                              dataType: "html",
                                              data:{idSujet:idSujet},
                                              success: function(response) {
                                                $("#messages").html(response);
                                                $("#inputMess").val("");
                                              },
                                              beforeSend: function() {
                                            },
                                              error :  function(e){
                                                 console.log(e);
                                        }
                                       });

//$('#chatBody').scrollTop($('#chatBody').height())

    $('#chatBody').animate({scrollTop: $('#chatBody')[0].scrollHeight}, "slow");

}
</script>
