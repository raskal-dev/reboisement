<?php
  ob_start();
  include 'donneeTabulaire.php';
?>

 <?php
  echo '<div id="frmDialog" style="width:790px;">';?>
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

  
  

  $("#btnShow" ).click(function() {
  $("#loginMOdal").modal("show");
  $("#loginMOdal").appendTo("body");
});
  var selectDistrict='';
  var selectRegion='';
  var url="<?php echo base_url() ?>";
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
 
  function persistance(tableName,valSaisi){

    idTraitement=$("#frmDialog").dialog("option", "idTratitement");
    oldsValue=$("#frmDialog").dialog("option", "oldsValue"); 
    config='planification.ini';

    console.log(url+'index.php/activite.php/persitance');
    $.ajax({
                                              url:url+'index.php/activite.php/persitance',
                                              type:"POST",
                                              dataType: "html",
                                              data:{valSaisi:valSaisi,tableName:tableName,idTraitement:idTraitement,oldsValue:oldsValue,config:config},
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
  var tableName='<?php echo $table ?>';
  $( "#frmDialog" ).dialog({
                                     autoOpen: false,
                                     modal: true,                                     
                                     width: "100%",
                                     maxWidth: "500px",
                                     autoResize:true,
                                     overflow:'scroll',
                                     idTratitement: '',
                                     oldsValue: '',
                                     title: 'Formulaire saisie',
                                      buttons: {
                                      "Enregistrer": function() {
                                        var valSaisi =$("#frmAction").serialize();
                                        idTraitement=$( this ).dialog("option", "idTratitement");
                                        persistance(tableName,valSaisi);
                                        $( this ).dialog( "close" );
                                        location.reload(true);
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
