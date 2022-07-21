<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
require "getdatakobo.php";

if(isset($_POST['valider'])){
  getDataCollected($db);
  exit();
}

 ?>
<form method="post" action="">
<button type="submit" name="valider">valider</button>
</form>
