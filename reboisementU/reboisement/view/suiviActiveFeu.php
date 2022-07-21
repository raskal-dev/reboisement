
<?php
  ob_start();
  include 'donneeTabulaire.php';
  
  echo '<div id="frmDialog">';
  		include 'donneeFormulaire.php';
  echo '</div>';
  
?>
  
<script type="text/javascript">
$(document).ready(function () {
  var url="<?php echo base_url() ?>";
	function persistance(tableName,valSaisi){
		idTraitement=$("#frmDialog").dialog("option", "idTratitement");
    oldsValue=$("#frmDialog").dialog("option", "oldsValue"); 
    config='plantation.ini';

		$.ajax({
                                              url: url+'index.php/activite.php/persitance',
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
                                     width: "50%",
                                     maxWidth: "100px",
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

