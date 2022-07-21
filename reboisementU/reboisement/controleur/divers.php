<?php

function apropos()
  {   
        $config = parse_ini_file("config/accueil.ini", true);
		  $url=base_url();
         $leftMenu=array(array("lien"=>$url."index.php/divers.php/apropos","libelle"=>"A propos"),
                         array("lien"=>$url."index.php/activite.php/chat","libelle"=>"Discussion en ligne"),
                         array("lien"=>$url."index.php/divers.php/chat","libelle"=>"FAQ"),
                       );
         require 'view/apropos.php';
  }

 function uploadFile()
  {   
        
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        $target_dir = $root."/reboisement/assets/images/";
        $target_file = $target_dir . basename($_FILES['filename']["name"]);
		$tmp = $_FILES['filename']['tmp_name'];
		move_uploaded_file($tmp, $target_file);

  }
?>