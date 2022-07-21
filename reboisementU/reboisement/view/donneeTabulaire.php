<!-- templates/baseLayout.php -->
<!DOCTYPE html>
<html>
<?php

function home_base_url(){
   $url = 'http://102.16.25.129/reboisement/reboisementU/reboisement/assets/';
   return $url;
 }

?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <title>Reboisement</title>


<script src="<?php echo home_base_url();?>plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo home_base_url();?>js/jquery.dataTables.min.js" type="text/javascript"></script> 

<script src="<?php echo home_base_url();?>js/dataTables.buttons.min.js"></script>
<script src="<?php echo home_base_url();?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo home_base_url();?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo home_base_url();?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo home_base_url();?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo home_base_url();?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo home_base_url();?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo home_base_url();?>plugins/jquery-ui/jquery-ui.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo home_base_url();?>css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo home_base_url();?>css/dataTables.checkboxes.css">
<link rel="stylesheet" type="text/css" href="<?php echo home_base_url();?>css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo home_base_url();?>css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo home_base_url();?>plugins/jquery-ui/jquery-ui.css">

<script src="<?php echo home_base_url();?>js/dataTables.select.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo home_base_url();?>plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo home_base_url();?>css/reboisement.css">


<!-- Bootstrap 4 -->
<script src="<?php echo home_base_url();?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo home_base_url();?>dist/js/adminlte.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo home_base_url();?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- ChartJS -->
<script src="<?php echo home_base_url();?>plugins/chart.js/Chart.min.js"></script>

 <link rel="stylesheet" href="<?php echo home_base_url();?>dist/css/adminlte.min.css">
<style type="text/css">

.dataTables_wrapper {
    font-family: tahoma;
    font-size: 11px;
    clear: both;
    *zoom: 1;
    zoom: 1;
}
</style>

</head>

  <div class="row">
          <div class="content">

            <div >
                      <div class="row">
                        <div ><!-- /.col-md-6 -->
                        <div class="col-lg-12">
                          <div class="card mt-3">
                           
                            <div class="card-body">
                              <table id="tabData" class="display" style="width:100%"></table>
                            </div>
                          </div>

                        </div>
                        <!-- /.col-md-6 -->
                      </div>
                      <!-- /.row -->
                    </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
              <!-- /.content -->  
        </div>
  </div>
      <!-- Main content -->

   
<!-- Modal -->


<script>

$(document).ready(function () {

  //$.noConflict();

  

function openDialogCRUD (selData,idTraitement,oldsValue){
  
  document.getElementById("frmAction").reset();
 
 $.each( selData, function( key, value ) {
  $("#"+key).val(value);
 });



var oldsValue =$("#frmAction").serialize();
 $("#frmDialog").dialog("option", "idTratitement",idTraitement);
 $("#frmDialog").dialog("option", "oldsValue",oldsValue);
 $("#frmDialog").dialog("open");
}


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

$.fn.dataTable.ext.buttons.template = {
    
    action: function ( e, dt, node, config ) {

        el = $(this[0].node);
        idTraitement=el.attr('idTraitement');
        toDo=el.attr('href');
        var selectedData = dt.rows( { selected: true }).data()[0];

        if(selectedData === undefined){
            selectedData='';
        }

        openDialogCRUD(selectedData,idTraitement);
        }
};

 var btn=[];      

  var btn=[{
                    extend: 'template',
                    text: '1',
                },
                 {
                    extend: 'template',
                    text: '2',
                },
                {
                    extend: 'template',
                    text: '3',
                    titleAttr:''
                },
                {
                    extend: 'template',
                    text: '4',
                    titleAttr:''
                },
                 {
                    extend: 'template',
                    text: '5',
                    titleAttr:''
                },
                {
                    extend: 'template',
                    text: '6',
                    titleAttr:''
                },
            
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
                pageLength:10,
                columnDefs : [
                  { 
                   className: 'dt-body-right',
                   render: $.fn.dataTable.render.number(' ', '.', 2, '') }
                 ]
                } );




var btns=<?php echo json_encode($buttons);?>; 
  for (var i = 0; i < 6; i++) {
    if (i<btns.length){
       tab.buttons(i).text(btns[i].libelle); 
       tab.button(i).nodes().attr('id',btns[i].id);
       tab.button(i).nodes().attr('idTraitement',btns[i].idTraitement);
       tab.button(i).nodes().attr('href',btns[i].action);
       var id="#"+btns[i].id;
       tab.button(i).nodes().css( 'margin-top', '10px' );
       if (btns[i].selection=='O'){
        tab.buttons( $(id) ).disable();
       }
    }else {
         tab.button(i).nodes().css( 'display', 'none' );
    }
    
  }   

  tab.on( 'select', function () {
            for (var i = 0; i < btns.length; i++) {
                var id="#"+btns[i].id;
                if (btns[i].selection=='O'){
                   tab.buttons( $(id) ).enable();
                }else{
                  tab.buttons( $(id) ).disable();
                }
            }
  });
    
    tab.on( 'deselect', function () {
               for (var i = 0; i < btns.length; i++) {
                 var id="#"+btns[i].id;
                if (btns[i].selection=='O'){
                         tab.buttons( $(id) ).disable();
                }else{
                  tab.buttons( $(id) ).enable();
                }
            }
            });    

});
     

   

</script> 



