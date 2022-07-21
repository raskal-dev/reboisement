<?php

 function national()
  {
        require 'view/carte.php';
  }


function carteInteractiveReboisement()
  {
  		
        $config = parse_ini_file("config/plantation.ini", true);
        $dataToload=getDataToLoad($config['plantation-data']['data']);
         $configCatalogue = parse_ini_file("config/pepiniere.ini", true);

         $sqlPepiniere="select LIBELLE_PEPINIERE,FOKONTANY,LIBELLE_COMMUNE,LIBELLE_REGION,LONGITUDE,LATITUDE from pepiniere p, commune c, region r, district d where p.ID_COMMUNE=c.ID_COMMUNE and c.ID_DISTRICT=d.ID_DISTRICT and d.ID_REGION=r.ID_REGION";

        $listPepiniere = getDataToLoad($sqlPepiniere);
        $dataCatalogue=getDataToLoad($configCatalogue['v_catalogue_pepiniere-data']['data']);

        $url=base_url();
        $leftMenu=array(  array("lien"=>$url."index.php/carte.php/carteInteractiveReboisement","libelle"=>"Carte interactive reboisement"),
                          array("lien"=>$url."index.php/carte.php/carteInteractiveFeu","libelle"=>"Carte interactive feux"),
                          array("lien"=>$url."index.php/activite.php/pepiniere","libelle"=>"Carte interactive pepinière"),
                        );
        require 'view/carteInteractiveReboisement.php';
  }

function carteInteractiveFeu()
  {
  		
        $config = parse_ini_file("config/plantation.ini", true);
        $dataToload=getDataToLoad($config['lutte_active_feu-data']['data']);
        $url=base_url();
        $leftMenu=array(  array("lien"=>$url."index.php/carte.php/carteInteractiveReboisement","libelle"=>"Carte interactive reboisement"),
                          array("lien"=>$url."index.php/carte.php/carteInteractiveFeu","libelle"=>"Carte interactive feux"),
                          array("lien"=>"#","libelle"=>"Carte interactive pepinière"),
                        );
        require 'view/carteInteractiveFeu.php';
  }

?>