<?php
  ob_start();
  include 'donneeTabulaire.php';
  echo '<div id="frmDialog" style="width:790px;">';
  		include 'donneeFormulaire.php';
  echo '</div>';
?>
<script type="text/javascript">
	function persistance(tableName,valSaisi){
		idTraitement=$("#frmDialog").dialog("option", "idTratitement");
		$.ajax({
                        url: '/meedReboisement/controleur/activite.php/persitance',
                        type:"POST",
                        dataType: "html",
                        data:{valSaisi:valSaisi},
                        success: function(response) {
                         console.log(response);
                                                     
                        }, beforeSend: function() {
                            
                      },
                        error :  function(e){
                           console.log(e);
                        }      
                   });

	}
	$( "#frmDialog" ).dialog({
                                     autoOpen: false,
                                     modal: true,
                                     maxHeight: window.innerHeight - 15,
                                     overflow:'scroll',
                                     idTratitement: 'value',
                                     title: 'Formulaire saisie',
                                      buttons: {
                                      "Enregistrer": function() {
                                      	var valSaisi =$("#frmAction").serialize();
                                        persistance('planification_annuelle',valSaisi);
                                      },
                                      Cancel: function() {
                                        $( this ).dialog( "close" );
                                      }
                                    },
                                    close: function() {
                                      $( this ).dialog( "close" );
                                    }
                           });
</script>
<?php
  $content = ob_get_clean();
  include 'baseLayout.php';
?>