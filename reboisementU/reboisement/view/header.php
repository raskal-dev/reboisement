<?php
   require_once 'utility.php';
?>  <!-- Navbar -->
<head>

   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">
   
</head>

<body>
<div class="main-header">
       
      <nav class="navbar navbar-expand-sm navbar-light" >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">              
                        <ul class="nav navbar-nav nav-flat">                  
                         
                          <li class="nav-item d-none d-sm-inline-block">

                            <a href="<?php echo base_url();?>index.php/activite.php/accueil" class="nav-link"><i class="fas fa-home"></i> Accueil</a>
                         </li>
                         <li class="nav-item d-none d-sm-inline-block">
                            <a href="<?php echo base_url();?>index.php/activite.php/plantation" class="nav-link"><i class="fa fa-tree" aria-hidden="true"></i> Plantation</a>
                         </li>
                         <li class="nav-item d-none d-sm-inline-block">
                            <a href="<?php echo base_url();?>index.php/activite.php/pepiniere" class="nav-link"><i class="fa fa-leaf" ></i> Pepinière</a>
                         </li>

                         <li class="nav-item d-none d-sm-inline-block">
                            <a href="<?php echo base_url();?>index.php/activite.php/analyse" class="nav-link"><i class="fas fa-chart-line"></i> Analyse</a>
                         </li>

                         <li class="nav-item d-none d-sm-inline-block">
                            <a href="<?php echo base_url();?>index.php/carte.php/carteInteractiveReboisement" class="nav-link"><i class="fas fa-map-marked">
                              </i> Cartes</a>
                         </li>

                         <li class="nav-item d-none d-sm-inline-block">
                          <a href="<?php echo base_url();?>index.php/activite.php/downloadFile" class="nav-link"><i class="fa fa-book"></i> Documents & Recherche</a>
                        </li>
                        <?php

                            if (isset($_SESSION['isConnected'])){
                              if ($_SESSION['isConnected']){
                                echo ' <li class="nav-item d-none d-sm-inline-block ">
                                <a href="'.base_url().'index.php/referentiel?tableName=espece" class="nav-link"><i class="fa fa-database"></i> Referentiel</a>
                               </li>';
                               echo '</ul>';
                              }
                              
                            }
                          ?>

                        </li>
                          
                    </ul> 
                        
           <?php  
                        if (isset($_SESSION['connectUser'])){
                            echo '<ul class="navbar-nav ml-auto mt-2">';
                            echo '<li class="nav-item d-none d-sm-inline-block">';
                            echo '<label class="nav-link ">';
                            echo 'Utilisateur:'.$_SESSION['connectUser'];
                            echo '</label>';
                            echo '</ul>';
                        }
                          

                        ?>
       </nav>
  </div>
</body>
  


<script src="<?php echo home_base_url();?>plugins/jquery/jquery.min.js"></script>


<!-- Bootstrap 4 -->
<script src="<?php echo home_base_url();?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo home_base_url();?>dist/js/adminlte.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo home_base_url();?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- ChartJS -->
<script src="<?php echo home_base_url();?>plugins/chart.js/Chart.min.js"></script>

 
 <style type="text/css">
   .navbar-light .navbar-nav .nav-link {
    color: green  !important;
   }
 
  .ui-widget-overlay {
        opacity: .50 !important; /* Make sure to change both of these, as IE only sees the second one */
        filter: Alpha(Opacity=50) !important;
        background: rgb(50, 50, 50) !important; /* This will make it darker */
	}
 </style>


