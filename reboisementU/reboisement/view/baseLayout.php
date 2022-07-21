<!-- templates/baseLayout.php -->
<!DOCTYPE html>
<html>
<head>
	<?php
	require_once 'utility.php';
?>
    
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.0.29, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/medd-126x120.png" type="image/x-icon">
  <meta name="description" content="">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/tether/tether.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dropdown/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/socicon/css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/style.css">
  <link rel="preload" as="style" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/leaflet.css">



</head>
<body >
     <div class="container">
    
    <section class="menu cid-s48OLK6784" once="menu" id="menu1-h">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top collapsed">
        <div class="container">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="https://www.environnement.mg/">
                        <img src="<?php echo base_url();?>assets/images/medd-126x120.png" alt="Mobirise" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-7" href="https://www.environnement.mg/">Ministère de l'Environnement et du Développement Durable</a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                	  <li class="nav-item ">
                	  	<a class="nav-link link text-black text-primary display-4" href="<?php echo base_url();?>index.php/activite.php/accueil"><span class="mobi-mbri  mbr-iconfont mbr-iconfont-btn"><i class="fas fa-home"></i> </span>Accueil</a>
                	    </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link link text-black text-primary dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" aria-expanded="false"><span class="mobi-mbri mobi-mbri-contact-form mbr-iconfont mbr-iconfont-btn"></span>Entrée des données<br></a>
                        <div class="dropdown-menu">
                            <a class="text-black text-primary dropdown-item display-4" href="<?php echo base_url();?>index.php/activite.php/entreesdonnees">Plantation</a>
                            <a class="text-black text-primary dropdown-item display-4" href="<?php echo base_url();?>index.php/activite.php/entreesdonneesproduction" aria-expanded="true">Pépinière</a>
                            <a class="text-black text-primary dropdown-item display-4" href="<?php echo base_url();?>index.php/activite.php/referentielreboisement" aria-expanded="false">Référentiel<br></a>
                        </div>
                    </li>
                    <li class="nav-item">
                    	<a class="nav-link link text-black text-primary display-4" href="<?php echo base_url();?>index.php/carte.php/carteInteractiveReboisement"><span class="mobi-mbri  mbr-iconfont mbr-iconfont-btn"><i class="fas fa-map-marked"></i></span> Carte intéractive<br></a>
                    </li>
                    <li class="nav-item">
                    	<a class="nav-link link text-black text-primary display-4" href="<?php echo base_url();?>index.php/activite.php/analyse"><span class="mobi-mbri  mbr-iconfont mbr-iconfont-btn"><i class="fas fa-chart-line"></i></span> Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                    	<a class="nav-link link text-black text-primary display-4" href="<?php echo base_url();?>index.php/activite.php/downloadFile"><span class="mobi-mbri  mbr-iconfont mbr-iconfont-btn"><i class="fas fa-book"></i></span> Documents & recherche</a>
                    </li>
                    
                  </ul>
                
                
            </div>
        </div>
    </nav>


</section>

<section >
 
		<?php echo $content ?>
    
 </section>
</div>			
<section class="footer3 cid-t5vWABtfnT" once="footers" id="footer3-q">
   
   
        <div class="media-container-row align-center mbr-white">
            <div class="row row-links">
                <ul class="foot-menu">
                                       
                    
                <li class="foot-menu-item mbr-fonts-style display-7">MEDD<a class="text-white text-primary" href="https://www.environnement.mg/" target="_blank">&nbsp;</a></li>
                <li class="foot-menu-item mbr-fonts-style display-7">World<a href="https://www.wwf.mg/en/" class="text-primary" target="_blank"> </a>Wild Fund&nbsp;<br><br></li>

            </ul>
            </div>
        
            <div class="row row-copirayt">
                <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-7">
                    © Copyright 2022 Hayticmg. All Rights Reserved.
                </p>
            </div>
        </div>
    
</section>

    

 <script src="<?php echo base_url();?>assets/web/assets/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/popper/popper.min.js"></script>
  <script src="<?php echo base_url();?>assets/tether/tether.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/smoothscroll/smooth-scroll.js"></script>
  <script src="<?php echo base_url();?>assets/dropdown/js/nav-dropdown.js"></script>
  <script src="<?php echo base_url();?>assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="<?php echo base_url();?>assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="<?php echo base_url();?>assets/theme/js/script.js"></script>
<script src="<?php echo base_url();?>assets/js/leaflet.js"></script>
<script src="<?php echo base_url();?>assets/js/leaflet.shpfile.js"></script>
<script src="<?php echo base_url();?>assets/js/shp.js"></script>
<script src="<?php echo base_url();?>assets/plugins/uplot/uPlot.iife.min.js"></script>


</body>
</html>