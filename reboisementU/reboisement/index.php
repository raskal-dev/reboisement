<?php
  // index.php
  // On charge les modeles et les controleurs

  require_once "modele.php";

  require_once 'controleur/activite.php';

  require_once 'controleur/auth.php';

  require_once 'controleur/divers.php';

require_once 'controleur/carte.php';

  require_once "utility.php";


  // gestion des routes
  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


  if($uri=='/reboisement/'){
    $uri='/reboisement/index.php';
  }
  if ('/reboisement/index.php' == $uri)
    {
        apropos();
    }
	elseif ('/reboisement' == $uri)
    {
        apropos();
    }
   elseif ('/reboisement/index.php/activite.php/accueil' == $uri)
    {
        apropos();
    }
 	elseif ('/reboisement/index.php/activite.php/plantation' == $uri)
    {
        plantation();
    }

   elseif ('/reboisement/reboisementU/reboisement/index.php/activite.php/getList' == $uri)

    {  getList($_POST['sql']);
       
    }

  elseif ('/reboisement/index.php/activite.php/planificationAnnuelle' == $uri )
    {
        planificationAnnuelle();
    }
    elseif ('/reboisement/index.php/planificationPluriAnnuelle' == $uri )
    {
        planificationPluriAnnuelle();
    }
    elseif ('/reboisement/index.php/planificationPluriAnnuelleDetail' == $uri )
    {
        planificationPluriAnnuelleDetail();
    }
  elseif ('/reboisement/index.php/activite.php/downloadFile' == $uri )
    {
        downloadFile();
    }
      elseif ('/reboisement/index.php/activite.php/download.php' == $uri)
    {
        download();
    }
  elseif ('/reboisement/index.php/divers.php/uploadFile'==$uri){
      uploadFile();
     }
       elseif ('/reboisement/index.php/activite.php/plantationFicheTechnique'==$uri && isset($_GET['idPlantation'])){
      plantationFicheTechnique($_GET['idPlantation']);
     }
     elseif ('/reboisement/index.php/activite.php/suiviActiveFeu'==$uri){
      suiviActiveFeu();
     }
     elseif ('/reboisement/index.php/referentiel' == $uri && isset($_GET['tableName']))

    {
      referentiel($_GET['tableName']);

    }

    elseif ('/reboisement/index.php/referentiel' == $uri && isset($_GET['tableName']))

    {
      referentiel($_GET['tableName']);

    }
      elseif ('/reboisement/index.php/activite.php/referentielreboisement' == $uri )

    {
      referentielreboisement();

    }

    elseif ('/reboisement/reboisementU/reboisement/index.php/activite.php/persitance'== $uri){
      persistance();
    }
     elseif ('/reboisement/index.php/activite.php/entreesdonnees'== $uri){
      entreesdonnees();
    }
     elseif ('/reboisement/index.php/activite.php/entreesdonneesproduction'== $uri){
      entreesdonneesproduction();
    }
    elseif ('/reboisement/index.php/auth.php/register'== $uri){
      register();
    }
     elseif ('/reboisement/index.php/auth.php/login'==$uri){
      login();
     }
      elseif ('/reboisement/index.php/auth.php/logout'==$uri){
      logout();
     }
     elseif ('/reboisement/reboisementU/reboisement/index.php/activite.php/chat'==$uri){
      chat();
     }
     elseif ('/reboisement/reboisementU/reboisement/index.php/activite.php/getDataToLoadWithFilter.php' == $uri )
    {
        getDataToLoadWithFilter();
    }
    elseif ('/reboisement/reboisementU/reboisement/index.php/activite.php/getDataToLoadWithFilterDynamique.php' == $uri )
    {
        getDataToLoadWithFilterDynamique();
    }
     


    elseif ('/reboisement/index.php/activite.php/analysemulticritere' == $uri )
    {
        analysemulticritere();
    }
      elseif ('/reboisement/index.php/activite.php/analyse' == $uri)
    {
        analyse();
    }
     elseif ('/reboisement/reboisementU//reboisement/index.php/activite.php/gestionChat'==$uri && isset($_GET['tableName'])){
      gestionChat($_GET['tableName']);
     }
     elseif ('/reboisement/reboisementU/reboisement/index.php/activite.php/refreshChat'==$uri ){
      refreshChat();
     }
     elseif ('/reboisement/index.php/divers.php/apropos'==$uri ){
      apropos();
     } elseif ('/reboisement/index.php/activite.php/pepiniere'==$uri){
      pepiniere();
     } elseif ('/reboisement/index.php/activite.php/pepiniereProduction'==$uri && isset($_GET['tableName'])){
      pepiniereProduction($_GET['tableName']);
     }
      elseif ('/reboisement/reboisementU/reboisement/index.php/activite.php/getDistrict'==$uri && isset($_GET['sql'])){
      getDistrict($_GET['sql']);
     }
     elseif ('/reboisement/index.php/activite.php/pepiniereCatalogue'==$uri){
      pepiniereCatalogue();
     }
     elseif ('/reboisement/index.php/activite.php/suiviDensiteReussite'==$uri){
      suiviDensiteReussite();
     }
	elseif ('/reboisement/index.php/carte.php/carteInteractiveReboisement'==$uri){
      carteInteractiveReboisement();
     }
	elseif ('/reboisement/index.php/carte.php/carteInteractiveFeu'==$uri){
      carteInteractiveFeu();
     }
    else
    {
        header('Status: 404 Not Found');
        echo '<html><body><h1>Page Not Found</h1></body></html>';
    }
  ?>
