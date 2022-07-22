<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/tether/tether.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dropdown/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/socicon/css/styles.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/style.css">
  <link rel="preload" as="style" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="<?php echo base_url();?>assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/leaflet.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
<?php

 require '../utility.php';

    $listChamps=[array('nom'=>'ID_SUJET','libelle'=>'Id','type'=>"affichage"),
               array('nom'=>'LIBELLE_SUJET','libelle'=>'Libellé','type'=>"input"),
               array('nom'=>'DATE_SAISIE','libelle'=>'Date création','type'=>"date"),
               array('nom'=>'UTILISATEUR','libelle'=>'creée par','type'=>"inputDisable"),
               ];
    $formulaire=createFormulaire($listChamps,1);
    $dataToload=getDataToLoad("select * from sujet_discussion");

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
                                                            'action'=>'javascript:void(0)')];
    $table = 'sujet_discussion';
    $userConnect= isset($_SESSION['authentifier']['identifiant']) ?   $_SESSION['authentifier']['identifiant']:'Non connecté';

    require 'donneeTabulaire.php';



       function connect_db()
            {
                $dsn="mysql:dbname=reboisement;host=localhost:3306";

            try
            {

                $connexion=new PDO($dsn,'root','');

                $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

              $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            }
            catch(PDOException $e)
            {
            printf("Echec connexion : %s\n",
            $e->getMessage());
            exit();
            }
            return $connexion;
          }

 function base_url(){
   $url = 'http://102.16.25.129/reboisement/reboisementU/reboisement/';
   return $url;
 }

 function getDataToLoad($sqlText)
 {

     $connexion=connect_db();

     $result=Array();


$info=$connexion->query($sqlText);

if (isset($info)){
  foreach ($info as $row)
   {

        $result[]=$row;
   }
} else {
    $result[]=[];
}

//print_r($result);
     return $result;

 }

 function setDataChart($ar)
 {

     $result=Array();

 if (sizeof($ar)>0){

   foreach ($ar as $row)
    {

         $result[]=$row;
         array_push($result,$row);
    }

 } else {
     $result[]=[];
 }

     return $result;
 }



?>


 <div id="frmDialog">
        <?php include 'donneeFormulaire.php'; ?>
 </div>

<script type="text/javascript">
$(document).ready(function () {


     var url="<?php echo base_url() ?>";
     utilisateur="<?php echo $userConnect ?>";

    function persistance(tableName,valSaisi){

    idTraitement=$("#frmDialog").dialog("option", "idTratitement");
    oldsValue=$("#frmDialog").dialog("option", "oldsValue");
    config='referentiel.ini';


        $.ajax({
                                              url: 'http://102.16.25.129/reboisement/reboisementU/reboisement/index.php/activite.php/persitance',
                                              type:"POST",
                                              dataType: "html",
                                              data:{valSaisi:valSaisi,tableName:tableName,idTraitement:idTraitement,oldsValue:oldsValue,config:config,utilisateur:utilisateur},

                                              success: function(response) {
                                                console.log(response);
                                              },
                                              beforeSend: function() {
                                            },
                                              error :  function(e){
                                                 console.log(e);
                                        }
                                       });
    }


  var tableName='<?php echo $table ?>';

    $( "#frmDialog" ).dialog({
                                     autoOpen: false,
                                     modal: true,
                                     maxHeight: window.innerHeight - 15,
                                     height:310,
                                     width:440,
                                     idTratitement: '',
                                     oldsValue: '',
                                     title: 'Formulaire saisie',
                                      buttons: {
                                      "Enregistrer": function() {

                                        var valSaisi =$("#frmAction").serialize();

                                        idTraitement=$( this ).dialog("option", "idTratitement");

                                        persistance(tableName,valSaisi);

                                        $('#frmDialog').dialog('close');

                                      },
                                      "Cancel": function() {
                                        $('#frmDialog').dialog('close')
                                      }
                                    },
                                    "close": function() {
                                      $('#frmDialog').dialog('close')
                                    }
                           });
 });

</script>


<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.checkboxes.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.css">

<script src="<?php echo base_url();?>assets/js/dataTables.select.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/reboisement.css">


<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/plugins/chart.js/Chart.min.js"></script>
 <script src="<?php echo base_url();?>assets/popper/popper.min.js"></script>
 <script src="<?php echo base_url();?>assets/tether/tether.min.js"></script>
 <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
 <script src="<?php echo base_url();?>assets/smoothscroll/smooth-scroll.js"></script>
 <script src="<?php echo base_url();?>assets/dropdown/js/nav-dropdown.js"></script>
 <script src="<?php echo base_url();?>assets/dropdown/js/navbar-dropdown.js"></script>
 <script src="<?php echo base_url();?>assets/touchswipe/jquery.touch-swipe.min.js"></script>
 <script src="<?php echo base_url();?>assets/theme/js/script.js"></script>
<script src="<?php echo base_url();?>assets/js/leaflet.js"></script>
<script src="<?php echo base_url();?>assets/js/leaflet.shpfile.js"></script>
<script src="<?php echo base_url();?>assets/js/shp.js"></script>
