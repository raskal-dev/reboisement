<?php
session_start();
$erreurs="Vous ne disposez pas des droits necessaires pour acceder à cette page!!!";
$erreur2="Veuillez contacter un Administrateur!!!";
?>

<?php
require_once ('includes/header.php');
require_once ('includes/scripts.php'); 
require_once ('includes/navbar.php'); 
?>
<?php if(!empty($erreurs)): ?>
   <div class="alert alert-danger">
      <h1>Accès refusé</h1>
      <li><?= $erreurs;?> </li>
      <li><?= $erreur2;?> </li>
   </div>
<?php endif; ?>

<a class="btn btn-danger btn-sm" href="account.php">Menu Principale</a>
<?php require 'includes/footer.php' ; ?>