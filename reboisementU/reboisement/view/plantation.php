<?php
  ob_start();
  
  include 'donneeTabulaire.php';
?>

 

 <?php
  echo '<div id="frmDialog" style="width:690px;">';?>
  <select class="form-control border-success mx-2" id="ID_REGION"class="form-select" name="ID_REGION" aria-label="Default select example">
                  <?php
                      foreach ($lstRegion as $value) { 
                        echo "<option value=".$value['ID_REGION'].">".$value['LIBELLE_REGION']."</option>";
                      }
                  ?>
                 
        </select>
   <?php
      include 'donneeFormulaire.php';
  echo '</div>';
?>    

<script type="text/javascript">

$(document).ready(function () {

  $( "#btnShow" ).click(function() {
    $("#loginMOdal").modal("show");
    $("#loginMOdal").appendTo("body");
});

  var assetUrl = "<?php echo home_base_url(); ?>";
  var url="<?php echo base_url() ?>";
  var selectDistrict='';
  var selectRegion='';
  

 $('#ID_REGION').change(function () {
     valueSelected =$(this).val();
     var sql="select a.ID_COMMUNE,a.LIBELLE_COMMUNE from commune a, district b where a.ID_DISTRICT=b.ID_DISTRICT and b.ID_REGION='"+valueSelected+"'";
      htmlCommune="<select id='ID_COMMUNE'>";
     $.ajax({
              url: url+'index.php/activite.php/getList',
              type:"POST",
               dataType: "json",
               data:{sql:sql},
               success: function(response) {  
                      $.each(response, function(key, value) {
                              htmlCommune=htmlCommune+"<option value="+value['ID_COMMUNE']+">"+value['LIBELLE_COMMUNE']+"</option>";
                      });
              htmlCommune=htmlCommune+"</select>"; 
               $("#ID_COMMUNE").html="";
              $("#ID_COMMUNE").html(htmlCommune);           
              }, 
               beforeSend: function() {
                                            },
               error :  function(e){
                console.log(e);
              }      
                                       
    });
  });
 
 function uploadShape(){
    var aFormData = new FormData();
    aFormData.append("filename", $('#COORDONNEES_DELIMITATION_REALISATION1').get(0).files[0]);

    $.ajax({
                                              url:url+'index.php/divers.php/uploadFile',
                                              type:"POST",
                                              dataType: "html",
                                              contentType: false,
                                              processData: false,
                                              data:aFormData,
                                              success: function(response) { 
                                                console.log(response);
                                              }, 
                                              beforeSend: function() {
                                                
                                              },
                                              error :  function(e){
                                                 console.log(e);
                                              }      
                                       });
  }

  function persistance(tableName,valSaisi){
    idTraitement=$("#frmDialog").dialog("option", "idTratitement");
    oldsValue=$("#frmDialog").dialog("option", "oldsValue"); 
    config='plantation.ini';
    $.ajax({
                                              url:url+'index.php/activite.php/persitance',
                                              type:"POST",
                                              dataType: "html",
                                              data:{valSaisi:valSaisi,tableName:tableName,idTraitement:idTraitement,oldsValue:oldsValue,config:config},
                                              success: function(response) { 
                                                  uploadShape();
                                              }, 
                                              beforeSend: function() {
                                            },
                                              error :  function(e){
                                                 console.log(e);
                                        }      
                                       });
  }

  var tableName='<?php echo $table ?>';
  $( "#frmDialog" ).dialog({
                                     autoOpen: false,
                                     modal: true,  
                                      show: {
                                          effect: "highlight",
                                          duration: 1500
                                        },
                                        hide: {
                                          effect: "fade",
                                          duration: 1000
                                        },
                                     width: "100%",
                                     maxWidth: "500px",
                                     autoResize:true,
                     resizable: false,
                                    position: [10,28],
                                     overflow:'scroll',
                                     idTratitement: '',
                                     oldsValue: '',
                                     title: 'Formulaire saisie',
                                      buttons: {
                                      "Enregistrer": function() {
                                        //let f1=document.getElementById("COORDONNEES_DELIMITATION_REALISATION1").files[0].name;
                                      // $("#COORDONNEES_DELIMITATION_REALISATION").val(f1);
                                        var valSaisi =$("#frmAction").serialize();
                                        idTraitement=$( this ).dialog("option", "idTratitement");
                                        persistance(tableName,valSaisi);
                                        //uploadShape();
                                        $( this ).dialog( "close" );
                                        //location.reload(true);
                                      },
                                      Cancel: function() {
                                        $( this ).dialog( "close" );
                                      }
                                    },
                                    close: function() {
                                      $( this ).dialog( "close" );
                                    }
                           });
 }); 
</script>
