  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-lightblue " pt="200px" style="margin-top: 0px">
    <!-- Brand Logo -->
    <!--
    <img src= "<?php echo asset_url();?>images/logo_banner.png" style="height:178px;width:100%;margin-bottom:1px"></img>
    <a href="#" class="brand-link bg-lightblue" sytle="margin-top:6px">
      <span class="brand-text font-weight-light"> <img src= "<?php echo asset_url();?>images/barremenu.png" style="height:30px;width:100%;margin:0"></img></span>
    </a>
  -->
    
    <!-- Sidebar -->
    <div class="sidebar" style="overflow-x: hidden;margin-left: auto;
    margin-right: auto;">
     

      <!-- Sidebar Menu -->
     
     <div  class="text-center" style="margin-top:10px;">
        <h6><i class="fas fa-filter text-warning"></i> Filtre</h6>
     </div>

    

 <div  class="text-center" style="margin-top:30px;">
        <i class="fas fa-cogs"></i>
</div> 
<div  class="text-center" style="margin-top:10px;">
        <h6>Accès aux modules connexes</h6>
</div>          
 
 <div class="row text-center" style="margin-top:30px;">
  <?php     
              echo ($this->session->userdata('identity')) ? 
               '<a href="auth/logout" class="btn  btn-outline-warning btn-block "><i class="fas fa-user-lock"></i></i> Se deconnecter</a>':'<a href="#"  data-toggle="modal" data-target="#loginMOdal" class="btn  btn-outline-warning btn-block "><i class="fas fa-user-lock"></i></i>'."S'".'authentifier</a>';
  ?>
                  
 </div> 

    
      
  </aside> 



  <div class="modal fade" id="loginMOdal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content ">

            <div class="modal-header">
              <h4 class="modal-title">SE&<b>AM</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                
                <!-- /.login-logo -->
                
                    <p class="login-box-msg">Identifiez vous pour ouvrir une session</p>

                    <form action="auth/login" method="post">
                      <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Utilisateur" id="identity" name="identity">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user-lock"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Mot de passe" id="password" name="password">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-4">
                          <div class="icheck-primary">
                            
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-8">
                          <button type="submit" class="btn btn-warning btn-block">Se connecter</button>
                        </div>
                        <!-- /.col -->
                      </div>
                    </form>

      </div>
       
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


   


  <style>
    @media screen and (min-width: 676px) {
        .modal-dialog {
          max-width: 350px; /* New width for default modal */
           max-height: : 650px;
        }
    }

</style>
