<?php class Fonction
{
    
    
    function secure($donnees)
    {
        $donnees=trim( $donnees);
        $donnees=stripslashes( $donnees);
        $donnees=addslashes( $donnees);
        return $donnees;
    }
    
    function debug($variable)
    {
        echo '<pre>' . print_r($variable,true) . '</pre>';
    }
    
	function unlogged()
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
        }
		
        if (isset($_SESSION['authentifier']))
        {
            define ('SESSION_TIMEOUT', "3600");
            // On vérifie si le temps d'inactivité n'a pas été dépassé
            if(time()-$_SESSION['last_accessrbsmt'] > SESSION_TIMEOUT)
            {
                    header('location:logoutForcing.php');
            }
            else
            {
                    // On stocke l'heure de dernière connexion
                    // time s'exprime en secondes à partir du 01/01/70 à 00:00:00
                    $_SESSION['last_accessrbsmt'] = time();
            }
        }
        
	}
    
    function str_random($length)
    {
        $alphabet="0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet,$length)),0,$length);
    }
    
    function compt_on()
    {
        if (isset($_SESSION['last_visit']))
        {
            define ('SESSION_TIMEOUT', "86400");
            // On vérifie si le temps d'inactivité n'a pas été dépassé
            if(time()-$_SESSION['last_visit'] > SESSION_TIMEOUT)
            {
                    unset($_SESSION['last_visit']);
            }
            else
            {
                    // On stocke l'heure de dernière connexion
                    // time s'exprime en secondes à partir du 01/01/70 à 00:00:00
                    $_SESSION['last_visit'] = time();
            }
        }
    }
	
    function logged_only()
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
        }
		
        if(!isset($_SESSION['authentifier']))
        {
            $_SESSION['flash']['danger']="Vous n'avez pas le droit d'accéder à cette page";
            header('location:login.php');
            exit();
        }
        
        define ('SESSION_TIMEOUT', "3600");
        if (isset($_SESSION['authentifier']))
        {
            // On vérifie si le temps d'inactivité n'a pas été dépassé
            if(time()-$_SESSION['last_accessrbsmt'] > SESSION_TIMEOUT)
            {
                    header('location:logoutForcing.php');
            }
            else
            {
                    // On stocke l'heure de dernière connexion
                    // time s'exprime en secondes à partir du 01/01/70 à 00:00:00
                    $_SESSION['last_accessrbsmt'] = time();
            }
        }
    }
    
    
    function logged_only2()
    {
        if(!isset($_SESSION['reboisement']))
        {
            $_SESSION['flash']['danger']='Vous devez avant tout remplir la "Fiche Reboisement" inscrit dans l\'onglet "Enregistrement Données"';
            header('location:account.php');
            exit();
        }
        
        define ('SESSION_TIMEOUT', "3600");
        if (isset($_SESSION['authentifier']))
        {
            // On vérifie si le temps d'inactivité n'a pas été dépassé
            if(time()-$_SESSION['last_accessrbsmt'] > SESSION_TIMEOUT)
            {
                    header('location:logoutForcing.php');
            }
            else
            {
                    // On stocke l'heure de dernière connexion
                    // time s'exprime en secondes à partir du 01/01/70 à 00:00:00
                    $_SESSION['last_accessrbsmt'] = time();
            }
        }
    }
    
    function allow($rang)
    {
        require 'db.php';
        $sql="SELECT slug,level FROM role";
        $req=$db->prepare($sql);
        $req->execute();
        $data=$req->fetchAll();
        $role=array();
        foreach($data as $d)
        {
            $role[$d->slug]=$d->level;
        }
        if(!$this->user('slug'))
        {
            $this->redirect();
        }else
        {
            if($role[$rang] > $this->user('level'))
            {
                $this->redirect();
            }
        }
    }
    
    function user($field)
    {
        if($field=='role')$field='slug';
        if(isset($_SESSION['authentifier'][$field]))
        {
            return $_SESSION['authentifier'][$field];
        }else
        {
            return false;
        }
    }
    
    function redirect()
    {
        header('location:forbidden.php');
    }
    
    function pagination($pageCourant, $totalPage){
   		$start = 1;
   		$end = $totalPage > 5 ? 5 : $totalPage;
    	if(strlen($pageCourant) > 1){
    		if($pageCourant==$totalPage){
    			$test=substr($pageCourant, -1);
    			if($test==0){
    				$start =$pageCourant-5;
    				$end = $totalPage > ($start + 5) ? $start + 5 : $totalPage;
    			}else{
    				$start = (int) substr($pageCourant, 0, -1)."0";
    				$end = $totalPage > ($start + 5) ? $start + 5 : $totalPage;
    			}
    		}else{
    			$start = substr($pageCourant, 0, -1)."0";
       			$end = $totalPage > ($start + 5) ? $start + 5 : $totalPage;
    		}
    	}
   		return [
        	"current" => $pageCourant, 
        	"start" => $start,
        	"end" => $end];
	}
}

$Fonction=new Fonction();