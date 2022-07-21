<?php



function register()
{   	
		$config = parse_ini_file("config/config.ini", true);
      	persistance();
  /*    	$to = $config['admin']['mail'];
		$subject = "Demande login reboisement";
		$txt = "Bonjour Admin!?,Demande login pour l'utilisateur ".$_POST['username']."  " .$_POST['email'];
		$headers = $_POST['email'];
		mail($to,$subject,$txt,$headers);*/
}

function login()
  {   
         if (authentication($_POST['username'],$_POST['pass'])){
         	$vret='succes';
         	$_SESSION['isConnected']=true;
         	$_SESSION["connectUser"] = $_POST['username'];
         }else{
         	$vret='error'; 
         }
         
		echo $vret;
  }
  function logout()
  {   
        session_start(); 
		session_destroy();
  }

?>