<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();
$Fonction->allow('member');


   $sql="SELECT * FROM region ORDER BY nom_region ASC";
   $req_reg=$db->prepare($sql);
   $req_reg->execute();
   
   if($Fonction->user('Level')!=3 || $Fonction->user('id_diredd_dredd_ciredd')!=21)
   {
      $id_diredd_dredd_ciredd=$Fonction->user('id_diredd_dredd_ciredd');
   }
   
   $sql1="SELECT * FROM diredd_dredd_ciredd ";
   if($Fonction->user('Level')!=3 || $Fonction->user('id_diredd_dredd_ciredd')!=21)
   {
      $sql1.="WHERE id_diredd_dredd_ciredd= '".$id_diredd_dredd_ciredd."' ";
   }
   $sql1.="ORDER BY nom_diredd_dredd_ciredd ASC";
   $req1=$db->prepare($sql1);
   $req1->execute();
   
   


?>
<?php
require_once ('includes/header.php');
require_once ('includes/scripts.php'); 
require_once ('includes/navbar.php'); 
?>
   <?php if(!empty($erreurs)): ?>..
   <div class="alert alert-danger" id="messageFlash">
      <p>Vous n'avez pas rempli le formulaire correctement</p>
      <ul>
         <?php foreach($erreurs as $erreur): ?>
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
               <h5><b>Délimitation Administrative</b></h5>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                           <label>Région : </label>
                           <select name="region" type="text" class="form-control region" id="id_region">
                              <option></option>
                              <?php while($info_reg=$req_reg->fetch(PDO::FETCH_ASSOC)):?>
                                 <option value="<?=$info_reg['id']?>"><?=$info_reg['nom_region']?></option>
                              <?php endwhile;?>
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
                            <label>Responsable : </label>
                            <input name="responsablePepiniere" type="text" class="form-control responsable">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nombre de plate-bande : </label>
                            <input name="nombrePlatebande" type="text" class="form-control objectifReboisement">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Année de l'exercice : </label>
                            <input name="anneeExercice" type="text" class="form-control anneeExercice">
                        </div>
                    </div>
                </div>
                
                <h5><b>Information sur les Essences</b></h5>
                <div class="row">
                <div class="col-sm-12">
                  <div class="scrollable">
                     <table class="table table-bordered" id="item_table">
                     <thead>
                         <tr><th>Essences</th><th>Nombre repiqué/semi</th><th>Date semi</th><th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="fa fa-plus"></span></button></th></tr>
                     </thead>
                     <tbody>
                           <tr>
                                 <td><input name="essence[]" type="text" class="form-control essence"></td>
                                 <td><input name="nombrePlantSemi[]" type="text" class="form-control nombrePlantSemi"></td>
                                 <td><input name="dateSemi[]" type="date" class="form-control dateSemi"></td>
                           </tr>
                     </tbody>
                     </table>
                     <script>
                        $(document).ready(function(){
                          $(document).on('click','.add',function(){
                            var html = '';
                            html += '<tr>';
                            html += '<td><input name="essence[]" type="text" class="form-control essence"></td>';
                            html += '<td><input name="nombrePlantSemi[]" type="text" class="form-control nombrePlantSemi"></td>';
                            html += '<td><input name="dateSemi[]" type="date" class="form-control dateSemi"></td>';
                            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-asterisk"></span></button></td></tr>';
                            $('#item_table').append(html);
                          });
                          $(document).on('click','.remove',function(){
                            $(this).closest('tr').remove();
                          });
                          $('#submit').click(function(event){
                            
                            
                            var timer=setTimeout(cacher,6000);
                            $('#messageFlash').click(function(){
                              clearTimeout(timer);
                              $(this).hide(3000);
                            });
                          
                            $("#close").click(function(){
                              $('#erreur').hide();
                            });
                            function cacher(){
                            $('#messageFlash').hide(6000);
                            }
                            
                            event.preventDefault();
                            var error = '';
                            
                            $('.region').each(function(){
                              var count = 1;
                              if($(this).val() === '')
                              {
                                error += "<li>le champ  région ne doit pas être vide</li>";
                                return false;
                              }
                              count = count + 1;
                            });
                            $('.anneeExercice').each(function(){
                              var count = 1;
                              if($(this).val() === '')
                              {
                                error += "<li>le champ  année de l'exercice ne doit pas être vide</li>";
                                return false;
                              }
                              count = count + 1;
                            });
                            $('.essence').each(function(){
                              var count = 1;
                              if($(this).val() === '')
                              {
                                error += "<li>Un ou plusieurs champ(s) vide dans la colonne  essence</li>";
                                return false;
                              }
                              count = count + 1;
                            });
                            $('.nombrePlantSemi').each(function(){
                              var count = 1;
                              if($(this).val() === '')
                              {
                                error += "<li>Un ou plusieurs champ(s) vide dans la colonne  nombre semi</li>";
                                return false;
                              }
                              count = count + 1;
                            });
                            
                            if(error === '')
                            {
                                var insert = $('#insert')[0];
                                var data = new FormData(insert);
                                $.ajax({
                                url:"insert_pepiniere.php",
                                method:"POST",
                                data:data,
                                processData: false,
                                contentType: false,
                                cache: false,
                                timeout: 600000,
                                success:function(reponse)
                                {
                                  alert("voulez-vous confirmer la commande?");
                                  $('#insert')[0].reset();
                                  $('#error').html('<div class="alert alert-success" id="messageFlash"><p><li>Informations insérées</li></p></div>');
                                  location.reload();
                                  return false;
                                }
                              });
                            }
                            else
                            {
                              $('#error').html('<div class="alert alert-danger" id="messageFlash">'+error+'</div>');
                            }
                          });
                        });
                        
                      </script>
                      <div class="modal-footer">
                          <a type="button" class="btn btn-danger" href="pepiniere.php">Retour</a>
                          <input type="submit" id="submit" class="btn btn-success" value="Valider">
                      </div>
                  </div>
               </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
  
 <script>
 $(document).ready(function(){
		$('#id_region').on('change',function(){
         
			var ID_region=$(this).val();
			if(ID_region){
				$.ajax({
					method:"POST",
					url:"select_dist.php",
					data:'id_region='+ID_region,
					success:function(html)
					{
						$('#id_district').html(html);
					}
				});
			}else
			{
				$('#id_district').html('<option value=""></option>');
            $('#id_commune').html('<option value=""></option>');
			}
		});
		$('#id_district').on('change',function(){
			var ID_district=$(this).val();
			if(ID_district){
				$.ajax({
					method:"POST",
					url:"select_commune.php",
					data:'id_district='+ID_district,
					success:function(html)
					{
						$('#id_commune').html(html);
					}
				});
			}else
			{
				$('#id_commune').html('<option value=""></option>');
			}
		});
	});
 </script>
 <script type="text/javascript">
	$(document).ready(function(){
		
		$('#dispositiion').on('change',function(){
				$(this).find("option:selected").each(function(){
						var val = $(this).attr("value");
						if(val){
								$(".msg").not("." + val).hide();
								$("." + val).show();
						} else{
								$(".msg").hide();
						}
				});
		}).change();
	});
</script> 
<?php require 'includes/footer.php' ; ?>