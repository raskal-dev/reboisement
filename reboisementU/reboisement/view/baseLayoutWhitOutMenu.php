<!-- templates/baseLayout.php -->
<!DOCTYPE html>
<html>
<head>
	<?php
	require_once 'utility.php';
?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

</head>
<link rel="stylesheet" href="<?php echo home_base_url();?>plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo home_base_url();?>css/leaflet.css">

<script src="<?php echo home_base_url();?>js/leaflet.js"></script>
<script src="<?php echo home_base_url();?>js/leaflet.shpfile.js"></script>
<script src="<?php echo home_base_url();?>js/shp.js"></script>

<body class="hold-transition sidebar-collapse layout-top-nav">
 <div class="container-xl container-md container-sm">
     <div>
    <img src= "<?php echo home_base_url();?>images/header_small.png" style="height: 150px;width:100%;" class="img-fluid" ></img>
    </div>
    <div> <?php   include 'header.php'; ?></div>

<?php 
                    echo '<div class="fixed-bottom" style="width:210px;margin-bottom:350px">';

                      if (isset($_SESSION['isConnected'])){
                          if ($_SESSION['isConnected']){
                            echo '<a id="btnLogout"href="#" class="btn btn-sm btn-outline-warning btn-block "><i class="fas fa-user-lock"></i> Se deconneter</a>';
                           }else{
                            echo '<a href="#"  data-toggle="modal" data-target="#loginMOdal" class="btn  btn-sm btn-outline-warning btn-block "><i class="fas fa-user-lock"></i> Se connecter</a>'
                  ;
                          }
                   }else{       
                    echo '<a href="#"  data-toggle="modal" data-target="#loginMOdal" class="btn  btn-sm btn-outline-warning btn-block "><i class="fas fa-user-lock"></i> Se connecter</a>'
                  ;
                      }
                   echo '</div>';
echo $content;
?>
</div>	
    
  </div>
</body>

<script>
$(document).ready(function () {




  $("#btnLogout").click(function(){
    url='<?php echo base_url();?>index.php/auth.php/logout';
        $.ajax({
                                              url: url,
                                              type:"POST",
                                              dataType: "html",
                                              success: function(response) {
                                                    location.reload();
                                                   
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

</html>