<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require "$root/reboisement/reboisementU/reboisement/FirePHPCore/fb.php";
session_start();


// controllers

 function accueil()
  {
         $config = parse_ini_file("config/accueil.ini", true);
         $url=base_url();
         $leftMenu=array(array("lien"=>$url."index.php/divers.php/apropos","libelle"=>"A propos"),
                         array("lien"=>$url."index.php/activite.php/chat","libelle"=>"Discussion en ligne"),
                         array("lien"=>$url."index.php/activite.php/chat","libelle"=>"FAQ"),
                        );
          $surfaceReboisePrevueAnnuelle = getDataToLoad("SELECT year(DATE_PLANTATION) annee,sum(SURFACE_REALISE) as surfacereboisee,sum(SURFACE_PREVUE) as surfaceprevue FROM plantation group by year(DATE_PLANTATION)");
         require 'view/accueil.php';
  }

   function entreesdonnees()
  {
         require 'view/entreedonnees.php';
  }

   function discussion_en_ligne(){
    require 'view/discussionenligne.php';
  }


   function entreesdonneesproduction()
  {
         require 'view/entreedonneesproduction.php';
  }

   function referentielreboisement()
  {
         require 'view/referentielreboisement.php';
  }



function chat()
  {

         $url=base_url()."index.php/activite.php/gestionChat";
         $leftMenu=array(array("lien"=>$url.'?tableName=sujet_discussion',"libelle"=>"Sujet de discussion"),
                         array("lien"=>$url,"libelle"=>"Gestion de discussion"),
                          array("lien"=>"#","libelle"=>"Votre avis nous intéresse, participez!")
                        );
         $lstSujet=getDataToLoad("select ID_SUJET,LIBELLE_SUJET from sujet_discussion");
         $lstDiscussion=getDataToLoad("select * from sujet_discussion_details order by DATE_SAISIE");
         $userConnect= isset($_SESSION['connectUser'])?$_SESSION['connectUser']:'non connecté';

         require 'view/chat.php';
  }


function createMenu($config){
        $lstMenu= explode(",", $config['menu']["leftMenu"]);
        $leftMenu= array();
        $i=0;
        foreach ($lstMenu as $value) {
          $tmp['lien']='referentiel?tableName='.$value;
          $tmp['libelle']=ucfirst(str_replace("_"," ",$value));
          $leftMenu[$i] = $tmp;
          $i++;
        }
        return $leftMenu;
   }

 function gestionChat($tableName)
  {

        $config = parse_ini_file("config/referentiel.ini", true);
        $dataToload=getDataToLoad($config[$tableName.'-data']['data']);
        $maxPerRow = $config['formulaire']['maxperrow'];
        $listChamps = $config[$tableName.'-column'];
        $table=$tableName;
        $userConnect="";

        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification',
                                                             'action'=>'http://localhost/meedReboisement/index.php/referentielCrud?tableName=espece'),
                                      array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'javascript:void(0)')];

        $formulaire=createFormulaire($listChamps,$maxPerRow);
        if (isset($_SESSION['connectUser'])){
                 $userConnect=  $_SESSION['connectUser'];
        }else{
                  $userConnect="";
        }

         $leftMenu=array(array("lien"=>"#","libelle"=>"Sujet de discussion"),array("lien"=>"#","libelle"=>"Votre avis nous intéresse, participez!"));
         require 'view/gestionChat.php';
  }

function plantation()
  {
        $config = parse_ini_file("config/plantation.ini", true);
        $dataToload=getDataToLoad($config['plantation-data']['data']);
        $maxPerRow = $config['formulaire']['maxperrow'];
        $listChamps = $config['plantation-column'];


        $table='plantation';

        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification',
                                                             'action'=>'#'),
                  array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'#')];

     $url=base_url();

     $leftMenu=array(array("lien"=>$url."index.php/activite.php/plantation","libelle"=>"Plantation"),
                       array("lien"=>$url."index.php/activite.php/plantationFicheTechnique?idPlantation=*","libelle"=>"Fiche technique"),
                       array("lien"=>$url."index.php/activite.php/suiviActiveFeu","libelle"=>"Lutte active contre le feu"),
                         array("lien"=>$url."index.php/activite.php/planificationAnnuelle","libelle"=>"Planification Annuelle"),
                         array("lien"=>$url."index.php/activite.php/suiviDensiteReussite","libelle"=>"Taux de reussite"),
                       );

          $lstRegion=getDataToLoad("select * from region");
          $formulaire=createFormulaire($listChamps,$maxPerRow);
 		  $listChamps  = [array('nom'=>'ID_PLANTATION', 'libelle'=>'Id plantation'),
                          array('nom'=>'NOM_ACTEUR', 'libelle'=>'Promoteur'),
   						 array('nom'=>'LIBELLE_ESPECE', 'libelle'=>'espece'),
                          array('nom'=>'LIBELLE_STRUCTURE', 'libelle'=>'Structure'),
                          array('nom'=>'LIBELLE_COMMUNE','libelle'=>"Commune"),
                          array('nom'=>'NOMBRE_PLANTS','libelle'=>"Nombre"),
                         array('nom'=>'DATE_PLANTATION','libelle'=>"Date")];
        require 'view/plantation.php';
  }

 function planificationAnnuelle()
  {
        $config = parse_ini_file("config/planification.ini", true);
        $dataToload=getDataToLoad($config['planification_annuelle-data']['data']);
         $maxPerRow = $config['formulaire']['maxperrow'];
        $listChamps = $config['planification_annuelle-column'];
        $table='planification_annuelle';
        $url=base_url();
        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification',
                                                             'action'=>'#'),
                                      array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'#')];
               $leftMenu=array(array("lien"=>$url."index.php/activite.php/plantation","libelle"=>"Plantation"),
                       array("lien"=>$url."index.php/activite.php/plantationFicheTechnique?idPlantation=*","libelle"=>"Fiche technique"),
                       array("lien"=>$url."index.php/activite.php/suiviActiveFeu","libelle"=>"Lutte active contre le feu"),
                         array("lien"=>$url."index.php/activite.php/planificationAnnuelle","libelle"=>"Planification Annuelle"),
                         array("lien"=>$url."index.php/activite.php/suiviDensiteReussite","libelle"=>"Taux de reussite"),
                       );
        $formulaire=createFormulaire($listChamps,$maxPerRow);

        $lstRegion=getDataToLoad("select * from region");

        require 'view/planificationAnnuelle.php';
  }


  function planificationPluriAnnuelle()
  {
        $config = parse_ini_file("config/planification.ini", true);
        $dataToload=getDataToLoad($config['planification_pluriannuelle_reboisement-data']['data']);
         $maxPerRow = 1;
        $listChamps = $config['planification_pluriannuelle_reboisement-column'];

        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification',
                                                             'action'=>'#'),
                                      array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'#')];
        $formulaire=createFormulaire($listChamps,$maxPerRow);

        require 'view/planificationPluriAnnuelle.php';
  }

 function planificationPluriAnnuelleDetail()
  {
        $config = parse_ini_file("config/planification.ini", true);
        $dataToload=getDataToLoad($config['detail_planification-data']['data']);
         $maxPerRow = 1;
        $listChamps = $config['detail_planification-column'];

        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification',
                                                             'action'=>'#'),
                                      array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'#')];
        $formulaire=createFormulaire($listChamps,$maxPerRow);

        require 'view/planificationPluriAnnuelleDetail.php';
  }

function pepiniere()
  {
        $tableName='pepiniere';
        $config = parse_ini_file("config/pepiniere.ini", true);
        $dataToload=getDataToLoad($config[$tableName.'-data']['data']);
        $maxPerRow = $config['formulaire']['maxperrow'];
        $listChamps = $config[$tableName.'-column'];
        $table=$tableName;
        $url=base_url();

        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification'),
                                      array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'javascript:void(0)'),
                                      array('id'=>'Production',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'javascript:void(0)')];

        $formulaire=createFormulaire($listChamps,$maxPerRow);
        $url=base_url();
       $leftMenu=array(array("lien"=>$url."index.php/activite.php/pepiniere","libelle"=>"Annuaire des pepinières"),
                         array("lien"=>$url."index.php/activite.php/pepiniereCatalogue","libelle"=>"Catalogue"),
                         array("lien"=>$url."index.php/activite.php/pepiniereProduction?tableName=pepiniere","libelle"=>"Gestion des pepinières"),
                       );
        $lstRegion=getDataToLoad("select * from region");
         require 'view/pepiniere.php';
  }

function pepiniereCatalogue()
  {
        $tableName='v_catalogue_pepiniere';
        $config = parse_ini_file("config/pepiniere.ini", true);
         $dataToload=getDataToLoad($config[$tableName.'-data']['data']);
		//print_r($dataToload);
        $maxPerRow = 0;
        $listChamps = $config[$tableName.'-column'];
        $table='Catalogue';
        $buttons=[];



        $url=base_url();
        $leftMenu=array(array("lien"=>$url."index.php/activite.php/pepiniere","libelle"=>"Annuaire des pepinières"),
                         array("lien"=>$url."index.php/activite.php/pepiniereCatalogue","libelle"=>"Catalogue"),
                         array("lien"=>$url."index.php/activite.php/pepiniereProduction?tableName=pepiniere","libelle"=>"Gestion des pepinières"),
                       );
         require 'view/catalogue.php';
  }

   function pepiniereProduction($tableName)
  {

        $config = parse_ini_file("config/pepiniere.ini", true);
        $dataToload=getDataToLoad($config[$tableName.'-data']['data']);

           $maxPerRow = 3;
        $listChamps = $config[$tableName.'-column'];
        $table=$tableName;
        $url=base_url();

        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification',
                                                             'action'=>'http://localhost/meedReboisement/index.php/referentielCrud?tableName=espece'),
                                      array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'javascript:void(0)')];
        $formulaire=createFormulaire($listChamps,$maxPerRow);
         $leftMenu=array(array("lien"=>$url."index.php/activite.php/pepiniere","libelle"=>"Annuaire des pepinières"),
                         array("lien"=>$url."index.php/activite.php/pepiniereCatalogue","libelle"=>"Catalogue"),
                         array("lien"=>$url."index.php/activite.php/pepiniereProduction?tableName=pepiniere","libelle"=>"Gestion des pepinières"),
                       );
         $lstRegion=getDataToLoad("select * from region");
         require 'view/pepiniereProduction.php';
  }


  function plantationFicheTechnique($idPlantation)
  {
        $config = parse_ini_file("config/plantation.ini", true);
        $dataToload=getDataToLoad($config['plantation-data']['data']." where ID_PLANTATION='".$idPlantation."'");
        $maxPerRow = 6;
        $listChamps = $config['plantation-column'];

        //$listChampsAffiche=$config['plantation-column'];
        $url=base_url();

        $table='plantation';
         $leftMenu=[];

        $lstRegion=getDataToLoad("select * from region");
        $dataToloadFeu=getDataToLoad("select * from lutte_active_feu where ID_PLANTATION='".$idPlantation."'");
        $listChampsFeu = $config['lutte_active_feu-column'];

        $dataToloadTauxReussite=getDataToLoad("select m.ID_PLANTATION,NOM_ACTEUR,LIBELLE_ESPECE, NOMBRE_PLANTS,LIBELLE_STRUCTURE,LIBELLE_COMMUNE,LIBELLE_DISTRICT,LIBELLE_REGION,DENSITE,TAUX_REUSSITE,DATE_PRISE_DONNEE from  plantation m
     LEFT JOIN  acteurs a ON  m.ID_ACTEUR=a.ID_ACTEUR
     LEFT JOIN espece d ON m.ID_ESPECE=d.ID_ESPECE
     LEFT JOIN structure_administrative e ON m.ID_STRUCTURE=e.ID_STRUCTURE
     LEFT JOIN commune f ON m.ID_COMMUNE=f.ID_COMMUNE
     LEFT JOIN district n ON f.ID_DISTRICT=n.ID_DISTRICT
     LEFT JOIN region o ON n.ID_REGION=o.ID_REGION
     LEFT JOIN plantation_densite_reussite r on m.ID_PLANTATION=r.ID_PLANTATION where r.ID_PLANTATION='".$idPlantation."'");


    $listChampsTauxReussite  = [array('nom'=>'LIBELLE_ESPECE', 'libelle'=>'espece'),
                               array('nom'=>'DENSITE', 'libelle'=>'Densité'),
                               array('nom'=>'TAUX_REUSSITE', 'libelle'=>'Taux reussite'),
                               array('nom'=>'DATE_PRISE_DONNEE','libelle'=>"Date prise donnéess")];

        $formulaire=createFormulaire($listChamps,$maxPerRow);

        require 'view/ficheTechnique.php';
  }

function suiviActiveFeu()
  {
        $config = parse_ini_file("config/plantation.ini", true);
        $dataToload=getDataToLoad($config['lutte_active_feu-data']['data']);
        $maxPerRow = 1;
        $listChamps = $config['lutte_active_feu-column'];

        //$listChampsAffiche=$config['plantation-column'];
        $url=base_url();

        $table='lutte_active_feu';
        $leftMenu=array(array("lien"=>$url."index.php/activite.php/plantation","libelle"=>"Plantation"),
                       array("lien"=>$url."index.php/activite.php/plantationFicheTechnique?idPlantation=*","libelle"=>"Fiche technique"),
                       array("lien"=>$url."index.php/activite.php/suiviActiveFeu","libelle"=>"Lutte active contre le feu"),
                         array("lien"=>$url."index.php/activite.php/planificationAnnuelle","libelle"=>"Planification Annuelle"),
                       );
        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification',
                                                             'action'=>'#'),
                                      array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'#')];
        $formulaire=createFormulaire($listChamps,$maxPerRow);

        require 'view/suiviActiveFeu.php';
  }

function suiviDensiteReussite()
  {
        $config = parse_ini_file("config/plantation.ini", true);
        $dataToload=getDataToLoad($config['plantation_densite_reussite-data']['data']);
        $maxPerRow = 1;
        $listChamps = $config['plantation_densite_reussite-column'];


        $url=base_url();

        $table='plantation_densite_reussite';
        $leftMenu=array(array("lien"=>$url."index.php/activite.php/plantation","libelle"=>"Plantation"),
                       array("lien"=>$url."index.php/activite.php/plantationFicheTechnique?idPlantation=*","libelle"=>"Fiche technique"),
                       array("lien"=>$url."index.php/activite.php/suiviActiveFeu","libelle"=>"Lutte active contre le feu"),
                         array("lien"=>$url."index.php/activite.php/planificationAnnuelle","libelle"=>"Planification Annuelle"),
                         array("lien"=>$url."index.php/activite.php/suiviDensiteReussite","libelle"=>"Taux de reussite"),
                       );
        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification',
                                                             'action'=>'#'),
                                      array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'#')];
        $formulaire=createFormulaire($listChamps,$maxPerRow);

        require 'view/suiviTauxReussite.php';
  }

 function persistance()
    {
         $vret="";
         $idTraitement=$_POST['idTraitement'];
         $valSaisi = array();
         parse_str($_POST['valSaisi'], $valSaisi);

         $oldValue = array();

         parse_str($_POST['oldsValue'], $oldsValue);

         if (isset($_SESSION['connectUser'])){
                 $valSaisi['UTILISATEUR']= $_SESSION['connectUser'];
        }else{
                  $valSaisi['UTILISATEUR']="";
        }
         $valSaisi['DATE_SAISIE']=date('Y-m-d H:i:s');
         $config='config/'.$_POST['config'];
      switch ($idTraitement) {

        case 'Ajout':
      
        
             $vret=addData($config,$_POST['tableName'],$valSaisi);
             break;

        case 'Modification':
              $vret=updateData($config,$_POST['tableName'],$oldsValue,$valSaisi);
          break;
        case 'Suppression':
              $vret=deleteData($config,$_POST['tableName'],$oldsValue,$valSaisi);
          break;
      }
     echo $vret;
  }

function referentiel($tableName)
  {

        $config = parse_ini_file("config/referentiel.ini", true);
        $dataToload=getDataToLoad($config[$tableName.'-data']['data']);
        $maxPerRow = $config['formulaire']['maxperrow'];
        $listChamps = $config[$tableName.'-column'];
        $table=$tableName;

        $buttons=[ array('id'=>'Ajout',
                'libelle'=>'<i class="fas fa-plus">Ajout</i>',
                'selection'=>'N',
                'whereKey'=>[],
                'idTraitement'=>'Ajout',
                'action'=>'#'),
                  array('id'=>'Modification','libelle'=>'<i class="fas fa-edit"> Modification</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Modification',
                                                             'action'=>'http://localhost/meedReboisement/index.php/referentielCrud?tableName=espece'),
                                      array('id'=>'Suppression',
                                                            'libelle'=>'<i class="fas fa-trash-alt"> Suppression</i>',
                                                            'selection'=>'O',
                                                            'idTraitement'=>'Suppression',
                                                            'action'=>'javascript:void(0)')];

        $formulaire=createFormulaire($listChamps,$maxPerRow);
        $lstMenu= explode(",", $config['menu']["leftMenu"]);
        $leftMenu= array();
        $i=0;
        foreach ($lstMenu as $value) {
          $tmp['lien']='referentiel?tableName='.$value;
          $tmp['libelle']=ucfirst(str_replace("_"," ",$value));
          $leftMenu[$i] = $tmp;
          $i++;
        }
         require 'view/referentiel.php';
  }

function refreshChat(){
  $htmlChat="";
  $lstDiscussion=getDataToLoad("select * from sujet_discussion_details where ID_SUJET='".$_POST['idSujet']."' order by DATE_SAISIE");
  $userConnect= isset($_SESSION['connectUser'])?$_SESSION['connectUser']:'non connecté';
    foreach ($lstDiscussion as $conversation) {
                      if (isset($conversation['UTILISATEUR'])){
                        if ($conversation['UTILISATEUR']!==$userConnect){
                            $htmlChat=$htmlChat.'<div class="d-flex flex-row justify-content-start">';
                            $htmlChat=$htmlChat.'<h6>'.$conversation['UTILISATEUR'].'</h6>';
                            $htmlChat=$htmlChat.'<div><p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">'.$conversation['MESSAGE'].'</p>';
                            $htmlChat=$htmlChat.'<p class="small ms-3 mb-3 rounded-3 text-muted">23:58</p>';
                            $htmlChat=$htmlChat.'</div></div>';

                        }else{

                            $htmlChat=$htmlChat.' <div class="d-flex flex-row justify-content-end mb-4 pt-1">';
                            $htmlChat=$htmlChat.'<div><p class="small p-2 me-3 mb-1 text-white rounded bg-success">'.$conversation['MESSAGE'].'</p><p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">00:06</p></div>';
                            $htmlChat=$htmlChat.'<h6>'.$conversation['UTILISATEUR'].'</h6></div>';

            }
          }
      }

      echo $htmlChat;
}

function getList($sql){
 
    //$resultDynamique = getDataToLoad($sql);
    //echo json_encode($resultDynamique) ;
  $sql=$_POST['sql'];
  echo json_encode(getDataToLoad($sql));
}



  

 function downloadFile()
  {

       $dir = getcwd().'/file';

       $listFile = scandir($dir);
       array_splice($listFile,0,2);

        $leftMenu=[];
         require 'view/downloadfile.php';
  }

 function download(){
   header("Content-Type: application/octet-stream");

   $file = getcwd()."/file/".$_GET["file"];

      if (file_exists($file))
      {

      header("Content-Disposition: attachment; filename=" . urlencode($file));
      header("Content-Type: application/download");
      header("Content-Description: File Transfer");
      header("Content-Length: " . filesize($file));


      flush(); // This doesn't really matter.


      $fp = fopen($file, "r");

      while (!feof($fp)) {

          echo fread($fp, 65536);

          flush(); // This is essential for large downloads
      }
      fclose($fp);
      } else {

         echo "File does not exists";
      }

  }

    function analyse()
  {

     $users = getUsers();
      $leftMenu=[];
      $table='analyse';
      $buttons = [];
      $config = parse_ini_file("config/referentiel.ini", true);
      $listEspece = getDataToLoad($config['espece-data']['data']);

      $lstCommune = getDataToLoad("select * from commune");
      $lstTypeActeur = getDataToLoad("select * from type_acteur");
      $lstAnnee = getDataToLoad("select distinct year(DATE_PLANTATION) date_plantation,year(DATE_PLANTATION) date_plantation_text from plantation order by 1");
      $config = parse_ini_file("config/analyse.ini", true);
        $dataToload=getDataToLoad($config['analyse-data']['data'].$config['analyse-data']['groupby']);
        $maxPerRow = $config['formulaire']['maxperrow'];
        $listChamps = $config['analyse-column'];

      require 'view/analyse.php';
  }

      function analysemulticritere()
  {



     $users = getUsers();
      $leftMenu=[];
      $table='analyse';
      $buttons = [];
      $config = parse_ini_file("config/referentiel.ini", true);
      $listEspece = getDataToLoad($config['espece-data']['data']);

      $lstRegion = getDataToLoad("select * from region");
      $lstTypeActeur = getDataToLoad("select * from type_acteur");
      $lstAnnee = getDataToLoad("select distinct year(DATE_PLANTATION) date_plantation,year(DATE_PLANTATION) date_plantation_text from plantation order by 1");
      $config = parse_ini_file("config/analyse.ini", true);
      $dataToload=getDataToLoad($config['analyse-data']['data'].$config['analyse-data']['groupby']);
      $maxPerRow = $config['formulaire']['maxperrow'];
      $listChamps = $config['analyse-column'];

      require 'view/analysemulticritere.php';
  }


    function getDataToLoadWithFilter()
  {


       $dateDebut = $_POST['dateDebut'];
        $dateFin = $_POST['dateFin'];
        $objectifRpf = $_POST['objectifRpf'];
        $ecosysteme = $_POST['ecosysteme'];
        $espece = $_POST['espece'];
        $region = $_POST['region'];
         $typeacteur = $_POST['typeacteur'];

        $whereClause = ' where 1=1 ';

        if ($dateDebut !='' && $dateFin ==''){
             $whereClause =  $whereClause .' and annee_reboisement="'.$dateDebut.'"';
        }

        if ($dateDebut !='' && $dateFin !=''){

             $whereClause .= " and annee_reboisement BETWEEN  '".$dateDebut."' AND '".$dateFin."') ";

        }

         if($objectifRpf != ''){
                 $whereClause .= " and (objectifRpf ='".$objectifRpf."') ";
              }

         if($ecosysteme != ''){
                 $whereClause .= " and (mangroveOuTerrestre ='".$ecosysteme."') ";
              }
         if($espece != ''){
                 $whereClause .= " and (nomScientifique ='".$espece."') ";
              }

          if($region != ''){
                 $whereClause .= " and (region ='".$region."') ";
              }

          if($typeacteur != ''){
                 $whereClause .= " and (typeActeur ='".$typeacteur."') ";
              }

         $table='analyse';
         $buttons = [];

          $sql = "select * from v_realisation";

          $listChamps=[// array('nom'=>'acteur','libelle'=>'acteur'),
                        // array('nom'=>'typeActeur','libelle'=>'typeActeur'),
                       //  array('nom'=>'objectifReboisement','libelle'=>'objectifReboisement'),
                       //  array('nom'=>'objectifRpf','libelle'=>'objectifRpf'),
                        // array('nom'=>'region','libelle'=>'region'),
                       //  array('nom'=>'district','libelle'=>'district'),
                       //   array('nom'=>'commune','libelle'=>'commune'),
                       //   array('nom'=>'nomScientifique','libelle'=>'nomScientifique'),
                        //  array('nom'=>'mangroveOuTerrestre','libelle'=>'mangroveOuTerrestre'),
                        //  array('nom'=>'Approche','libelle'=>'Approche'),
                         array('nom'=>'NOMBRE_PLANTS','libelle'=>'Nombre plants'),
                        //  array('nom'=>'surfacePrevu','libelle'=>'surfacePrevu'),
                       //   array('nom'=>'SourcePlant','libelle'=>'SourcePlant'),
                      // array('nom'=>'annee_reboisement','libelle'=>'annee_reboisement'),
                       array('nom'=>'superficieRealise','libelle'=>'Superficie réalisée')];

          $sql = $sql.$whereClause;

          $dataToload=getDataToLoad($sql);

        require 'view/donneeTabulaireWithFooter.php';
  }


    function getDataToLoadWithFilterDynamique()
  {
    
        $dateDebut = $_POST['dateDebut'];
        $dateFin = $_POST['dateFin'];
        $objectifRpf = $_POST['objectifRpf'];
        $ecosysteme = $_POST['ecosysteme'];
        $espece = $_POST['espece'];
        $region = $_POST['region'];
        $typeacteur = $_POST['typeacteur'];
        $classParcelle = $_POST['classParcelle'];
        $organisme = $_POST['organisme'];
        $district = $_POST['district'];
        $commune = $_POST['commune'];

        $whereClause = '';
        $champs = 'region,sum(b.nombrePlantMiseEnTerre) NOMBRE_PLANTS,sum(a.superficieRealise) superficieRealise';
        $groupby ='group by region';
         $listChamps=[ array('nom'=>'region','libelle'=>'Région'),
                       array('nom'=>'NOMBRE_PLANTS','libelle'=>'Nombre plants'),
                       array('nom'=>'superficieRealise','libelle'=>'Superficie réalisée')];

        if ($dateDebut !='' && $dateFin ==''){
             $whereClause =  $whereClause .' and dateMiseEnTerre>="'.$dateDebut.'"';
            
        }

        if ($dateDebut !='' && $dateFin !=''){

             $whereClause .= " and (dateMiseEnTerre BETWEEN  '".$dateDebut."' AND '".$dateFin."') ";
            
        }

         if($objectifRpf != ''){
                 $whereClause .= " and (objectifRpf ='".$objectifRpf."') ";
                 $champs = 'objectifRpf, '.$champs;
                 $groupby = $groupby.' ,objectifRpf';
              }

         if($ecosysteme != ''){
                 $whereClause .= " and (mangroveOuTerrestre ='".$ecosysteme."') ";
                 $champs = 'mangroveOuTerrestre, '.$champs;
                 $groupby = $groupby.' ,mangroveOuTerrestre';
              }
         if($espece != ''){
                 $whereClause .= " and (nomVernaculaire ='".$espece."') ";
                 $champs = 'nomVernaculaire, '.$champs;
                 $groupby = $groupby.' ,nomVernaculaire';
              }
      
          if($region != ''){

               if (gettype($region)=='array'){
                $region = implode(',', $region);
               }
                 
                 $whereClause .= " and region in (".$region.") ";
              }

          if($typeacteur != ''){
                 $whereClause .= " and (typeActeur ='".$typeacteur."') ";
                 $champs = 'typeActeur, '.$champs;
                 $groupby = $groupby.' ,typeActeur';
              }

          if($classParcelle != ''){
                 $whereClause .= " and (class_ ='".$classParcelle."') ";
                 $champs = 'class_, '.$champs;
                 $groupby = $groupby.' ,class_';
              }

          if($organisme != ''){
                 $whereClause .= " and (financement ='".$organisme."') ";
                 $champs = 'financement, '.$champs;
                 $groupby = $groupby.' ,financement';
              }

          if($district != ''){
                 $whereClause .= " and (district ='".$district."') ";
                 $champs = 'district, '.$champs;
                 $groupby = $groupby.' ,district';
                 array_push($listChamps, array('nom'=>'district','libelle'=>'District'));
              }

          if($commune != ''){
                 $whereClause .= " and (commune  ='".$commune ."') ";
                 $champs = 'commune, '.$champs;
                 $groupby = $groupby.' ,commune';
                 array_push($listChamps, array('nom'=>'commune','libelle'=>'Commune'));

              }

         $table='reboisement';
         $buttons = [];
         
          $sql = "select ".$champs." from reboisement a,plant_mise_terre b where b.reboisement_id = a.id".$whereClause.$groupby;
        
          $dataToload=getDataToLoadAjax($sql);

        require 'view/donneeTabulaire.php';
  }