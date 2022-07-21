<!-- templates/baseLayout.php -->
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <title>Reboisement</title>



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



</head>




                            <div class="card-header">
                              <h5 class="card-title m-0"><?php echo ucfirst($table); ?></h5>
                            </div>
                            <div class="card-body" >
                              <table id="tabData" class="display" style="width:100%">
                                <thead>

                                </thead>
                                <tbody style="text-align: right;"></tbody>
                                <tfoot style="background-color:#e6e6e6;text-align: right;font-weight:bold" id='footer'>

                                </tfoot>
                              </table>
                            </div>

<!-- Modal -->


<script>

$(document).ready(function () {

 var arrayCol = <?php echo json_encode($listChamps); ?>;

 var cols =[];
  for (var i=0; i<arrayCol.length;i++){
    if (arrayCol[i].type !=='select'){

      aCol ={};
               aCol.data=arrayCol[i].nom;
               aCol.title=arrayCol[i].libelle;
               cols.push(aCol);
    }

  }

 var dataSet=<?php echo json_encode($dataToload); ?>;



 var btn=[];

  var btn=[

                {extend: 'excelHtml5',
                 filename: function(){
                          var d = new Date();
                          var t = "Export";
                          var n = d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear();
                          return t + '-' + n;
                                          },
                  text: '<i class="fas fa-file-excel">Export excel</i>'

                }
              ];

    var lang= {
                             processing:     "Traitement en cours...",
                             search:         "Rechercher&nbsp;:",
                             lengthMenu:     "Afficher _MENU_ &eacute;l&eacute;ments",
                             info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                             infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                             infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                             infoPostFix:    "",
                             loadingRecords: "Chargement en cours...",
                             zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                             emptyTable:     "Aucune donnée disponible dans le tableau",
                             paginate: {
                                 first:      "Premier",
                                 previous:   "Pr&eacute;c&eacute;dent",
                                 next:       "Suivant",
                                 last:       "Dernier"
                             },
                             "select": {
                             "rows": {
                                 "_": ".   %d lignes sélectionnées",
                                 "0": ".   Aucune ligne sélectionnée",
                                 "1": ".   1 ligne sélectionnée"
                             }
                             },
                             aria: {
                                 sortAscending:  ": activer pour trier la colonne par ordre croissant",
                                 sortDescending: ": activer pour trier la colonne par ordre décroissant"
                             }
                         };



var tab=$('#tabData').DataTable( {
                aaData: dataSet,
                dataType: 'json',
                dom: 'iftrpB',
                select: 'single',
                scrollX:true,
                columns: cols,
                buttons: btn,
                language: lang,
                pageLength:5
                } );




var btns=[];


 var totalTableau=getTotalRow();
 var footer = "<td>"+ totalTableau['TOTAL_NOMBRE_PLANTS'] +"</td><td>"+totalTableau['TOTAL_SURFACE_REALISE']+"</td>";
 $("tfoot").empty().append(footer);

function getTotalRow(){

  var totalPlants =0;
  var totalSurfaceReboisee =0;
  var total=[];

   tab.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
    var data = this.data();
    totalPlants = parseInt(totalPlants)+parseInt(data['NOMBRE_PLANTS']);
    totalSurfaceReboisee = (parseFloat(totalSurfaceReboisee)+parseFloat(data['SURFACE_REALISE'])).toFixed(4);

  } );

   total['TOTAL_NOMBRE_PLANTS']=totalPlants;
   total['TOTAL_SURFACE_REALISE']=totalSurfaceReboisee;

  return total;
}




});






</script>
