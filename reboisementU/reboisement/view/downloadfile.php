
<?php
  ob_start();
  //include 'donneeTabulaire.php';
?>


          <div class="content">

            
                      <div class="row mt">
                          <div class="col-6" style="margin-top: 20px;">
                            
                            <label  for="doc" class="frmLabel">Partager documents</label> <br>
                            <div class="row">
                               <div class="col-6">
			  	            <input class="form-control form-control mx-2 border-success" type="file" id="doc" name="doc"></input>
                               </div>
                               <div class="col-6">
                            <button id="uploadfile" type="button" class="btn btn-sm btn-tool" ><i class="fas fa-upload"></i></button>
                            </div>
                            <div>
                        </br>
                             <label  for="doc" class="frmLabel">Voir documents</label> <br>
                              <table id="tabData" class="table table-bordered" style="width:100%">
                                <thead>
                                  <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width:60%">Titre</th>
                                    <th style="width:30%"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                 <?php for ($i=0; $i <count($listFile) ; $i++) {  ?>
                                <tr>
                                <td><?php echo $i; ?></td>
                                <td ><p id='doc'><?php echo ($listFile[$i]); ?></p></td>
                                <td >  <a href="download.php?file=<?php echo ($listFile[$i]); ?>">Télécharger</a></td>
                               </tr>
                               <?php } ?>
                               </tbody>
                              </table>
                          </div>
                         
                           
                          
                    </div><!-- /.container-fluid -->
          
              <!-- /.content -->  
        </div>
  


  
 
<?php
  $content = ob_get_clean();
  include 'baseLayout.php';
?>
<script>
   
   function uploadDoc(){
    var aFormData = new FormData();
    aFormData.append("filename", $('#doc').get(0).files[0]);

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
</script>


