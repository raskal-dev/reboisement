
<?php
  ob_start();
  //include 'donneeTabulaire.php';
?>


          <div class="content h-600">

            <div style="margin-top:20px">
                      <div class="row mt">
                          <div class="col-7">
                              <table id="tabData" class="display" style="width:100%"></table>
                          </div>
                           <div class="col-5">
                            
                              <div id="carouselExampleControls" class="carousel slide vertical" data-ride="carousel">
                                <p id="nomPep" class="border-0"></p>
                                  <div class="carousel-inner" id="crInner">
                                   
                                  </div>
                                
                                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </div>
                          </div>
                          
                    </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
              <!-- /.content -->  
        </div>
  


  
<script>

$(document).ready(function () {

  $("#carouselExampleControls").hide();

 var arrayCol = <?php echo json_encode($listChamps); ?>; 

 var cols =[];
  for (var i=0; i<arrayCol.length;i++){
               aCol ={};
               aCol.data=arrayCol[i].nom;
               aCol.title=arrayCol[i].libelle;
               cols.push(aCol);
  }

 var dataSet=<?php echo json_encode($dataToload);?>;




 
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


var btn=[];
var tab=$('#tabData').DataTable( {
                aaData: dataSet, 
                dataType: 'json',
                dom: 'ftrpB',
                select: 'single',
                scrollX:true,
                buttons: btn,
                columns: cols,
                language: lang,
                pageLength:5
                } );


var rowData
  tab.on( 'select', function () {
    rowData = tab.rows( { selected: true } ).data()[0]; 
    getIdentification(rowData.LIBELLE_PEPINIERE);
    getDetail(rowData.LIBELLE_PEPINIERE);
    $("#carouselExampleControls").show();

            
  });
    
    tab.on( 'deselect', function () {
      $("#carouselExampleControls").hide();
      rowData=null;
      }); 


    var url="<?php echo base_url() ?>";


    function getDetail(popupContent){
            var sql="SELECT  LIBELLE_PEPINIERE,LIBELLE_ESPECE,c.QTE_PRODUIT,IFNULL(c.QTE_SORTIE,0) as NB_SORTIE,c.QTE_PRODUIT-IFNULL(c.QTE_SORTIE,0) AS QTE_DISPONIBLE FROM v_catalogue_pepiniere c, pepiniere p, espece e where c.ID_PEPINIERE=p.ID_PEPINIERE and c.ID_ESPECE=e.ID_ESPECE and p.LIBELLE_PEPINIERE='"+popupContent+"'";
     $.ajax({
              url: url+'index.php/activite.php/getList',
              type:"POST",
               dataType: "json",
               data:{sql:sql},
               success: function(data) {  
                htmlCar="";
                for (var i = data.length - 1; i >= 0; i--) {
                     if (i==0){
                      htmlCar=htmlCar+'<div class="carousel-item active">';
                    }else{
                      htmlCar=htmlCar+'<div class="carousel-item">';
                    }
                     htmlCar=htmlCar+'<p><strong>Espèce</strong>:'+data[i].LIBELLE_ESPECE+'</p>';
                     htmlCar=htmlCar+'<p><strong>quantite produit:</strong>'+data[i].QTE_PRODUIT+'</p>'
                     htmlCar=htmlCar+'<p><strong>quantie sortie :</strong>'+data[i].NB_SORTIE+'</p>';
                     htmlCar=htmlCar+'<p><strong>disponible:</strong>'+data[i].QTE_DISPONIBLE+'</p>';
                     htmlCar=htmlCar+'</div>';
                }
                 $("#crInner").html(htmlCar); 

               
              }, 
               beforeSend: function() {
                                            },
               error :  function(e){
                console.log(e);
              }      
                                       
    });
  }

    function getIdentification(popupContent){
            var sql="select LIBELLE_PEPINIERE,FOKONTANY,LIBELLE_COMMUNE,LIBELLE_REGION from pepiniere p, commune c, region r, district d where p.ID_COMMUNE=c.ID_COMMUNE and c.ID_DISTRICT=d.ID_DISTRICT and d.ID_REGION=r.ID_REGION and p.LIBELLE_PEPINIERE='"+popupContent+"'";
     $.ajax({
              url: url+'index.php/activite.php/getList',
              type:"POST",
               dataType: "json",
               data:{sql:sql},
               success: function(data) {  
                identification='Pepinère: '+data[0].LIBELLE_PEPINIERE+' Région:'+data[0].LIBELLE_REGION+ ' Commune:'+data[0].LIBELLE_COMMUNE+ ' Fokontany :'+data[0].FOKONTANY;
                $("#nomPep").text(identification);              
              }, 
               beforeSend: function() {
                                            },
               error :  function(e){
                console.log(e);
              }      
                                       
    });
  }



});
     



   

</script> 
<?php
  $content = ob_get_clean();
  include 'baseLayout.php';
?>


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