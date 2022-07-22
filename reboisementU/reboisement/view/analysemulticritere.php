
<?php
  ob_start();

 ?>

<body>
   
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12">

                      <div class="card " >

                              <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                  <h4 class="card-title"><strong>Filtre</strong> </h4>
                                      <div class="card-tools">
                                       <a href="#" onclick="initializeFilter()"><strong></strong>Réinitialiser tous les filtres</strong></a>
                                </div>
                                </div>
                              </div>


              <div class="card-body">


                 <div class="form-row">

                    <div class="row">

                     <div class="col-1.5 col-sm-1.5 col-md-1.5">


                     <select id='searchByYear' class="form-control form-control-sm">
                       <option value=''> Période du </option>
                       <?php
                            foreach ($lstAnnee as $row):
                             echo '<option value="'.$row["date_plantation"].'">'. $row["date_plantation_text"].'</option>';
                            endforeach;

                      ?>

                     </select>

                      </div>



                    <div class="col-1.5 col-sm-1.5 col-md-1.5">


                      <select id='searchByendYear' class="form-control form-control-sm">
                       <option value=''> au </option>
                       <?php
                            foreach ($lstAnnee as $row):
                             echo '<option value="'.$row["date_plantation"].'">'. $row["date_plantation_text"].'</option>';
                            endforeach;

                      ?>

                     </select>

                   </div>
                     <div class="col col-sm col-md">

                     <select id='region' class="form-control form-control-sm">
                        <option value=''> Région </option>
                         <?php
                            foreach ($lstRegion as $row):
                             echo '<option value="'.$row["ID_REGION"].'">'. $row["LIBELLE_REGION"].'</option>';
                            endforeach;

                         ?>

                     </select>

                     </div>

                    <div class="col-1.5 col-sm-1.5 col-md-1.5">

                     <select id='searchByObjectifRPF' class="form-control form-control-sm">
                        <option value=''> Objectif RPF </option>
                        <option value='1'> Reforestation </option>
                        <option value='2'> Restauration </option>
                        <option value='3'> Conservation </option>

                     </select>

                     </div>

                      <div class="col-1.5 col-sm-1.5 col-md-1.5">

                         <select id='searchByEcosysteme' class="form-control form-control-sm pi" >
                            <option value=''> Ecosystème </option>
                            <option value='1'> Terrestre </option>
                            <option value='2'> Mangrove </option>

                         </select>
                      </div>

                       <div class="col-1.5 col-sm-1.5 col-md-1.5">
                     <select id='searchByEspeces' class="form-control form-control-sm pp">
                        <option value=''> Especes </option>
                           <?php
                            foreach ($listEspece as $row):
                             echo '<option value="'.$row["ID_ESPECE"].'">'. $row["LIBELLE_ESPECE"].'</option>';
                            endforeach;

                      ?>
                     </select>
                     </div>

                       <div class="col-1.5 col-sm-1.5 col-md-1.5">


                     <select id='searchByActeur' class="form-control form-control-sm">
                       <option value=''> Type acteur </option>
                        <?php
                            foreach ($lstTypeActeur as $row):
                             echo '<option value="'.$row["ID_TYPE_ACTEUR"].'">'. $row["LIBELLETYPE_ACTEUR"].'</option>';
                            endforeach;

                      ?>

                     </select>
                 </div>

                     <div class="col-12 col-sm-12 col-md-12 " style="margin-top:10px">

                            <button type="button" class="btn btn-block btn-success btn-sm" id="afficher">Afficher</button>

                         </div>
                     </div>


              </div>



          </div>
            <!-- /.card -->


        <!-- /.row -->
      </div>

            </div>
            <div class="col-auto col-sm col-md align-items-center">

                 <div class="col-12 text-center"><h6><strong> Superficie reboisée selon les filtres choisis</strong></h6>

                <div  id="filtre" class="text-success">
                   <p >Période : tous - Objectifs RPF confondus - Terrestre et mangrove - Tout type d'espèces confondus  - Tous type d'acteurs - Madagascar</p>
                </div>
               </div>


                <div class="col-12">

                              <div class="card">

              <div class="card-body" id='data-container' style="color:black;align-content: center;">

                            <div class="card-header">
                              <h5 class="card-title m-0"><strong><?php echo ucfirst($table); ?></strong></h5>
                            </div>
                            <div class="card-body" >
                              <table id="tabData" class="display" style="width:100%">
                                <thead>

                                </thead>
                                <tbody style="text-align: right;"></tbody>
                                <tfoot style="background-color:#e6e6e6;text-align: right;font-weight:bold" id="footer">

                                </tfoot>
                              </table>
                            </div>





              </div>

                </div>
                </div>


            </div>

        </div>

</body>




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

<script type="text/javascript">
var libelle_region = '';
var id_region = '';


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
                pageLength:5,

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

$('#afficher').click(function(){

        var anneeDebut = ($('#searchByYear').val()==''?' - ':$('#searchByYear').val());
        var anneeFin = ($('#searchByendYear').val()==''?' - ':$('#searchByendYear').val());
        var objectifRpf  = ($('#searchByObjectifRPF').val()==''?' tous ':$('#searchByObjectifRPF :selected').text());
        var searchByEcosysteme = ($('#searchByEcosysteme').val()==''?' Terrestre et mangrove ':$('#searchByEcosysteme :selected').text());
        var searchByEspeces  = ($('#searchByEspeces').val()==''?' tous ':$('#searchByEspeces :selected').text());
        var searchByActeur = ($('#searchByActeur').val()==''?' tous ':$('#searchByActeur :selected').text());

        var htmlFiltre =" </br><span ><i>Période du </i>  "+anneeDebut +"<i> au </i>"+ anneeFin  +"- <i> Objectif:  </i>"+objectifRpf +" - <i>Ecosystème: </i>"+ searchByEcosysteme +"- <i>Espèces: </i>"+ searchByEspeces +" - <i>Acteur: </i>"+ searchByActeur +"</span>";

        $('#filtre').empty().append( htmlFiltre);


        dateDebut=$("#searchByYear").val();
        dateFin=$("#searchByendYear").val();
        objectifRpf=$("#searchByObjectifRPF").val();
        ecosysteme=$("#searchByEcosysteme").val();
        espece=$("#searchByEspeces").val();
        commune=$("#commune").val();
        typeacteur=$("#searchByActeur").val();

        updateTable(dateDebut,dateFin,objectifRpf,ecosysteme,espece,commune,id_region,typeacteur);



  });

$('#commune').change(function () {

        var anneeDebut = ($('#searchByYear').val()==''?' - ':$('#searchByYear').val());
        var anneeFin = ($('#searchByendYear').val()==''?' - ':$('#searchByendYear').val());
        var objectifRpf  = ($('#searchByObjectifRPF').val()==''?' tous ':$('#searchByObjectifRPF :selected').text());
        var searchByEcosysteme = ($('#searchByEcosysteme').val()==''?' Terrestre et mangrove ':$('#searchByEcosysteme :selected').text());
        var searchByEspeces  = ($('#searchByEspeces').val()==''?' tous ':$('#searchByEspeces :selected').text());
        var searchByCommune  = ($('#commune').val()==''?' tous ':$('#commune :selected').text());
         var searchByActeur = ($('#searchByActeur').val()==''?' tous ':$('#searchByActeur :selected').text());

        var htmlFiltre =" </br><span><i>Période du </i>  "+anneeDebut +"<i> au </i>"+ anneeFin  +"- <i> Objectif:  </i>"+objectifRpf +" - <i>Ecosystème: </i>"+ searchByEcosysteme +" <i>Espèces: </i>"+ searchByEspeces +" - <i>Acteur: </i>"+ searchByActeur +"</span></br><span><i>Région: </i>  "+libelle_region +"<i> Commune: </i>"+ searchByCommune  +"</span>";


        $('#filtre').empty().append( htmlFiltre);


        dateDebut=$("#searchByYear").val();
        dateFin=$("#searchByendYear").val();
        objectifRpf=$("#searchByObjectifRPF").val();
        ecosysteme=$("#searchByEcosysteme").val();
        espece=$("#searchByEspeces").val();
        commune=$('#commune').val();
        typeacteur=$("#searchByActeur").val();

        updateTable(dateDebut,dateFin,objectifRpf,ecosysteme,espece,commune,id_region,typeacteur);
});


   function updateTable(dateDebut,dateFin,objectifRpf,ecosysteme,espece,commune,region,acteur) {

    var baseUrl="<?php echo base_url();?>";
    var action = baseUrl+"index.php/activite.php/getDataToLoadWithFilter.php";
                   var $this = $(this);

                            $.ajax({
                               url: action,
                               type:"POST",
                               dataType: "html",
                               data:{dateDebut:dateDebut,dateFin:dateFin,objectifRpf:objectifRpf,ecosysteme:ecosysteme,espece:espece,commune:commune,region:region,typeacteur:typeacteur},
                               success: function(response,e) {


                                   $("#data-container").empty().append(response);

                                   e.preventDefault;


                               },
                               error :  function(e){

                                  console.log(e);
                               }
                          });

}



  function initializeFilter(){

   $("option:selected").prop("selected", false);

    id_region = '';
    libelle_region = '';

    var htmlfiltre= "&nbsp;&nbsp;Période : tous - Objectifs RPF confondus - Terrestre et mangrove - Tout type d\'especes confondus - Tous type d'acteurs - Madagascar";


     $('#filtre').empty().append( htmlfiltre);

     dateDebut=$("#searchByYear").val();
        dateFin=$("#searchByendYear").val();
        objectifRpf=$("#searchByObjectifRPF").val();
        ecosysteme=$("#searchByEcosysteme").val();
        espece=$("#searchByEspeces").val();
        commune=$('#commune').val();
        typeacteur=$("#searchByActeur").val();

        updateTable(dateDebut,dateFin,objectifRpf,ecosysteme,espece,commune,id_region,typeacteur);
  }



</script>
