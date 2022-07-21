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
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">

</head>
<link rel="stylesheet" href="<?php echo home_base_url();?>plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo home_base_url();?>css/leaflet.css">

<script src="<?php echo home_base_url();?>js/leaflet.js"></script>
<script src="<?php echo home_base_url();?>js/leaflet.shpfile.js"></script>
<script src="<?php echo home_base_url();?>js/shp.js"></script>

<body class="hold-transition sidebar-collapse layout-top-nav">
 <div class="container-xl container-md container-sm">
     <div>
  <div> <?php   include 'header2.php'; ?></div>

<?php 
                   
echo $content;
?>
</div>  
    
  </div>
</body>
<script src="<?php echo home_base_url();?>plugins/jquery/jquery.min.js"></script>


<!-- Bootstrap 4 -->
<script src="<?php echo home_base_url();?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo home_base_url();?>dist/js/adminlte.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo home_base_url();?>plugins/jquery-ui/jquery-ui.min.js"></script>



</html>