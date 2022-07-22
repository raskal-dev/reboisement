<?php
// header('location: ../redirection');
session_start();
require_once 'includes/db.php';
require_once 'includes/function.php';
?>

<?php
include('includes/header.php');
include('includes/scripts.php');
include('includes/navbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="card-body">
    <?php

    include('reboisementU/reboisement/view/analysehistorique.php');
    ?>
  </div>
</div>
  <!-- Content Row -->


<?php
include('includes/footer.php');
?>
