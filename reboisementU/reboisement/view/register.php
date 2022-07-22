<div class="modal fade" id="registerMOdal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content ">

            <div class="modal-header">
              <h4 class="modal-title">Reboi<b>sement</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                
                <!-- /.login-logo -->
                
                    <p class="login-box-msg">Inscrivez vous pour ouvrir une session</p>

                    <form   id="frmAction" method="post" class="needs-validation" novalidate>
                      <input type="hidden" class="form-control"  id="id" name="id" value="" required>
                       <input type="hidden" class="form-control"  id="actif" name="actif" value="N" required>
                      <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Nom utilisateur" id="username" name="username" required>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user-lock"></span>
                          </div>
                          <div class="invalid-feedback">Nom utilisateur obligatoire</div>
                        </div>
                      </div>
                      <div class="input-group mb-4">
                        <input type="email" class="form-control" placeholder="Adresse mail" id="mail" name="email" required>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                        <div class="invalid-feedback">Adresse mail obligatoire</div>
                      </div>

                      <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Mot de passe" id="pass" name="pass" required>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
                     
                      <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Confirmer mot de passe" id="confirmePassword" name="confirmePassword">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                        <div id='passNotMatch' class="invalid-feedback">Le mot de passe ne correspond pas</div>
                      </div>
                     <div class="container">
                          <button type="button" id ="btnEnvoyer" class="btn btn-warning btn-block ">Envoyer <i class="fas fa-check"></i></button>
                      </div>
                    </form>
      </div>           
</div>

<script type="text/javascript">

$(document).ready(function () {
  document.getElementById("frmAction").reset();

   $('#loginMOdal').modal('hide'); 
    const forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms).forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
        form.classList.add('was-validated');
      }, false);
    });
var pass1="";
var pass2="";
var url="<?php echo base_url() ?>";

$("#pass").on("blur", function () {
    pass1=$("#pass").val();
});

$("#confirmePassword").on("blur", function () {
    pass2=$("#confirmePassword").val();
  if (pass1===pass2) {
     $('#btnEnvoyer').removeClass("disabled");
     $("#passNotMatch").hide();

  }else{
    $("#btnEnvoyer").addClass("disabled");
    $("#passNotMatch").show();
  }
});

//oninput='confirmePassword.setCustomValidity(pass.val() != confirmePassword.value ? true : false)'
$( "#btnEnvoyer" ).click(function( event ) {
  var valSaisi =$("#frmAction").serialize();
  persistance('users',valSaisi);
});

  function persistance(tableName,valSaisi){
    idTraitement='Ajout';
    oldsValue=""; 
    config='referentiel.ini';
    $.ajax({
                                              url: url+'index.php/auth.php/register',
                                              type:"POST",
                                              dataType: "html",
                                              data:{valSaisi:valSaisi,tableName:tableName,idTraitement:idTraitement,oldsValue:oldsValue,config:config},
                                              success: function(response) {
                                                console.log(response);
                                                $('#registerMOdal').modal('hide'); 
                                                $('#loginMOdal').modal('hide');      
                                              }, 
                                              beforeSend: function() { 
                                            },
                                              error :  function(e){
                                                 console.log(e);
                                        }      
                                       });
  }

});
 

</script>