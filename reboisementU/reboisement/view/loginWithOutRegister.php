<div class="modal fade" id="loginMOdal" >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content ">

            <div class="modal-header">
              <h4 class="modal-title">Reboi<b>sement</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                
                <!-- /.login-logo -->
                
                    <p class="login-box-msg">Authentification</p>

                    <form action="#" method="post" id="frmLogin">
                      <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Utilisateur" id="username" name="username">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user-lock"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Mot de passe" id="pass" name="pass">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
                     <div class="container">
                          <button type="button" class="btn btn-warning btn-block" id="btnLogin"><i class="fas fa-user-lock"></i> Connexion</button>
                      </div>
                    </form>  
              </div>    
              <div class="modal-footer">
                <div id='passNotMatch'  class="invalid-feedback ">Identifiant ou mot de passe erroné!!</div>   
              </div>
          
</div>
<script type="text/javascript">

$(document).ready(function () {

document.getElementById("frmLogin").reset();


  $("#btnLogin").click(function(){
    url='<?php echo base_url();?>index.php/auth.php/login';
         user = $("#username").val();
          pass = $("#pass").val();
        $.ajax({
                                              url: url,
                                              type:"POST",
                                              dataType: "html",
                                              data:{username:user,pass:pass},
                                              success: function(response) {
                                                console.log(response);
                                                if (response=="succes"){
                                                   $("#loginMOdal").modal("hide");
                                                    location.reload();
                                                }else{
                                                  $('#passNotMatch').removeClass("invalid-feedback");
                                                }
                                                   
                                              }, 
                                              beforeSend: function() { 
                                            },
                                              error :  function(e){
                                                 console.log(e);
                                        }      
                                       });
    }); 
  
  




});
 

</script>