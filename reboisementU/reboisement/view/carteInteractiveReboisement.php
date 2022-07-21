
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

  function base_url(){
    $url = 'http://102.16.25.129/reboisement/reboisementU/reboisement/';
    return $url;
  }

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

  function getDataToLoad($sqlText){

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

  $listregion = getDataToLoad('select * from regionmap');
?>
     <link rel="stylesheet" href="<?php echo base_url();?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
           <style type="text/css">
             .parent {
              position: relative;
              width: auto;
              height: 750px;
              margin: 0px;
          }
          .child1 {
              position: absolute;
              width: 100%;
              height: 100%;
              top: 0;
              left: 0;
              opacity: 0.7;

          }
          .child2 {
              z-index: 10;
              margin-left: 900px;
              margin-top : 25px;

          }
          .legend {
              padding: 4px 6px;
              background: white;
              font: 14px/16px Arial, Helvetica, sans-serif;
              background: rgba(255,255,255,0.8);
              box-shadow: 0 0 15px rgba(0,0,0,0.2);
              border-radius: 5px;
              min-width: 200px;


          }
          #map{
                width: 100%;
                height: 600px;
                background: none;
                left: 2%;
                top: 3%;
            }
         .transparent-tooltip {
                background: transparent;
                border: none;
                box-shadow: none;

              }

              .transparent-tooltip::before {
                border: none;
              }


 </style>

    <section class="map1 cid-t5w89jH6Nw " id="map1-y">

        <div style="margin-top:20px">
        <div class="mbr-section-head mb-4 mt-2">
            <h4 class=" mbr-fonts-style align-center mb-0 display-2">
                <strong>Cartes intéractives</strong></h4>

        </div>
        <div class="google-map justify-content-center">
             <div class="row  ">

                  <div class="col-12 col-sm-12 col-md-9 col-lg-9" id="map" style="height: 870px;margin-right: 25px;" ></div>


                    <div class="col-12 col-sm-12 col-md col-lg" >

                     <div class="card ">
                            <div class="card-header">
                              <h5 class="card-title m-0">Région</h5>
                            </div>
                            <div class="card-body">

                                 <div class="form-row">

                                     <div class="col-12">
                                      <p class="text-left">
                                          <strong></strong>
                                      </p>
                                      <div class="form-group clearfix">
                                           <div class="icheck-info d-inline">
                                              <input type="radio" name="region" id="tous" value="tous">
                                              <label for="tous">
                                                Toutes
                                              </label>
                                            </div>
                                            <br>
                                        <?php for ($i=0; $i < count($listregion); $i++) { ?>


                                          <div class="icheck-info d-inline display-6">
                                          <input type="radio" name="region" id=<?php echo json_encode($listregion[$i]['ID_REGION']) ?> value=<?php echo json_encode($listregion[$i]['ID_REGION']) ?>>
                                          <label for=<?php echo json_encode($listregion[$i]['LIBELLE_REGION']) ?>>
                                            <?php echo ($listregion[$i]['LIBELLE_REGION']) ?>
                                          </label>
                                        </div>
                                        <br>

                                       <?php }  ?>
                                      </div>

                                   </div>



                                 </div>

                            </div>
                          </div>
                  </div>
                  </div>

   -->
        </div>
    </div>
      </section>


<script type="text/javascript">

$(document).ready(function () {




/* formulaire*/
/*************/
  var assetUrl = "<?php echo base_url().'assets/'; ?>";
  var url="<?php echo base_url() ?>";


/*Data   */
/*********/



 /* MAP*/
/*************/

    // defini map niveau region

  var map = L.map('map').setView([-18.7785704655, 46.830888048], 6.3);
  addLayerNational().addTo(map);
  addLayerControl().addTo(map);;

  var LeafIcon = L.Icon.extend({
    options: {
       iconSize:     [30, 30],
       iconAnchor: [15,25],
       popupAnchor:  [-3, -76]
    }
});

var greenIcon = new LeafIcon({
    iconUrl: assetUrl+'/images/plantation-1.png'
});

var location = new LeafIcon({
    iconUrl: assetUrl+'/images/location.png'
});

  var listReboisement=[];
  for (var i=0; i<listReboisement.length;i++){
              //  createMarker(listReboisement[i].LATITUDE ,listReboisement[i].LONGITUDE,listReboisement[i].ID_PLANTATION);
  }


   function addLayerNational (){
     /*let madagascarlayer = L.tileLayer(assetUrl+'images/osm/{z}/{x}/{y}.png', {


                      minZoom: 6,
                      maxZoom: 10,
                      tms: false,
                      attribution: 'Generated by HayTic',
                      style:function (feature) {
                        return { color: 'red', weight: 4 };
                      }
                    });*/

          let madagascarlayer = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
                    maxZoom: 20,
                    subdomains:['mt0','mt1','mt2','mt3']
                });
      return madagascarlayer;
   }

      function addRegionLayer(region){
      var pathDataRegion=assetUrl+"data/region_district/"+region+"_json.geojson";
       getJsonLayer(pathDataRegion);
      }

     function getJsonLayer(pathData){



          $.getJSON(pathData,function(data){

          datalayer = L.geoJson(data,{

            style: style,// css carte defin ery ambony
            onEachFeature: function(feature, featureLayer) {
              featureLayer.bindTooltip(feature.properties.DISTRICT, {
                                                          permanent: true,
                                                          direction : 'bottom',
                                                          className: 'transparent-tooltip',
                                                          offset: [0, -8]
                                                        });
            }
          }).addTo(map);


          map.fitBounds(datalayer.getBounds());
      });
     }

       function style(feature) {


          return {

              weight: 0.8,
              opacity: 1,
              color: 'red',
              dashArray: '2',

          };

        }

   function addLayerControl(){



     var pathSurfaceReboiseNational=assetUrl+"data/realisation/national/national_2020.geojson";;
   //  var  surfaceReboise = getJsonLayer(pathSurfaceReboiseNational);
     var  pepiniere = [];
     var  surfaceBrule = [];
     var surfaceReboiseEnCours = "";

     var isconnected = "<?php echo isset($_SESSION['isConnected']) ? 'connecte' : 'nonconnecte'; ?>";



      var layersurfaceReboise = L.layerGroup(getJsonLayer(pathSurfaceReboiseNational));
      var layersurfaceReboiseEnCours = L.layerGroup(surfaceReboiseEnCours);
      var layerpepiniere = L.layerGroup(pepiniere);
      var layersurfaceBrule = L.layerGroup(surfaceBrule);


      layersurfaceReboise.addTo(map);
      layerpepiniere.addTo(map);
      layersurfaceBrule.addTo(map);


          var overlayMaps = {
            " <span class='my-layer-item'> Surface reboisée</span>": layersurfaceReboise,
            " <span class='my-layer-item'> Reboisement en cours </span>": layersurfaceReboiseEnCours,
            "<span class='my-layer-item'>Pépinière</span>": layerpepiniere,
            "<span class='my-layer-item'>Surface brulée</span>": layersurfaceBrule,

           };



           var legend = L.control({position: 'topleft'});

                legend.onAdd = function () {
                      var div = L.DomUtil.create('div');
                      div.innerHTML = ' <p class="text-left" style="color:white"><h5><strong>Restauration des paysages forêstiêres</strong></h5>';
                      return div;
                };
                legend.addTo(map);

                var fooCtrl = L.control.layers(null,overlayMaps,
                              {collapsed : true, position: 'topleft'});




                //console.log(fooCtrlDiv);
               // fooCtrlDiv.insertBefore(fooLegend.getContainer(), fooCtrlDiv.firstChild);

         // var layerControl = L.control.layers(null,overlayMaps,{position: 'topleft'});


              return fooCtrl;

      }


  function createMarker(latitude,longitude,popupContent){

         var marker;

      marker = L.marker([latitude,longitude],{icon: greenIcon}).addTo(map).on('click',function(e){
         var sql="select NOM_ACTEUR,LIBELLE_OBJECTIF_SPECIFIQUE,LIBELLE_STRUCTURE,LIBELLE_PLANIFICATION_ANNUELLE,LIBELLE_ESPECE,LIBELLE_COMMUNE,LIBELLE_PEPINIERE,LIBELLE_ECOSYSTEME,LIBELLE_OBJECTIF_RPF, LIBELLE_APPROCHE,LIBELLE_FERTILISATION,LIBELLE_PREPARATION_SOL,BASSIN_VERSANT, m.NOMBRE_PLANTS, DATE_PLANTATION, m.LONGITUDE, m.LATITUDE, RESPONSABLE, SOURCE_FINANCEMENT, SURFACE_PREVUE, COORDONNEES_DELIMITATION_PREVUE, MAIN_OEUVRE, COUT_PREPARATION, SOURCE_PLANTS, SURFACE_REALISE, COORDONNEES_DELIMITATION_REALISATION, m.FOKONTANY, LOCALITE,ID_PLANTATION,LIBELLE_TYPE_PARE_FEU,LIBELLE_TYPE_CADRE,LIBELLE_STRUCTURE_LUTTE,LARGEUR_PARAFEU,m.ID_ACTEUR,m.ID_COMMUNE, m.ID_TYPE_REBOISEMENT, m.ID_PLANIFICATION_ANNUELLE,m.ID_ESPECE,m.ID_STRUCTURE,m.ID_PREPRARATION_SOL,m.ID_PEPINIERE,m.ID_ECOSYSTEME,m.ID_OBJECTIF_RPF, m.ID_APPROCHE,m.ID_FERTILISATION,LIBELLE_DISTRICT,LIBELLE_REGION,o.ID_REGION from plantation m  LEFT JOIN  acteurs a ON  m.ID_ACTEUR=a.ID_ACTEUR LEFT JOIN objectif_specifique b ON  m.ID_TYPE_REBOISEMENT=b.ID_OBJECTIF_SPECIFIQUE LEFT JOIN planification_annuelle c ON m.ID_PLANIFICATION_ANNUELLE=c.ID_PLANIFICATION_ANNUELLE LEFT JOIN espece d ON m.ID_ESPECE=d.ID_ESPECE LEFT JOIN structure_administrative e ON m.ID_STRUCTURE=e.ID_STRUCTURE LEFT JOIN commune f ON m.ID_COMMUNE=f.ID_COMMUNE LEFT JOIN mode_preparation_sol g ON m.ID_PREPRARATION_SOL=g.ID_PREPRARATION_SOL LEFT JOIN pepiniere h ON m.ID_PEPINIERE=h.ID_PEPINIERE LEFT JOIN ecosysteme i ON m.ID_ECOSYSTEME=i.ID_ECOSYSTEME LEFT JOIN objectif_rpf j ON m.ID_OBJECTIF_RPF=j.ID_OBJECTIF_RPF LEFT JOIN type_approche k ON m.ID_APPROCHE=k.ID_APPROCHE LEFT JOIN fertilisation l ON m.ID_FERTILISATION=l.ID_FERTILISATION  LEFT JOIN district n ON f.ID_DISTRICT=n.ID_DISTRICT LEFT JOIN region o ON n.ID_REGION=o.ID_REGION LEFT JOIN type_parafeu p ON m.ID_TYPE_PARE_FEU=p.ID_TYPE_PARE_FEU LEFT JOIN type_cadre q ON m.ID_TYPE_CADRE=q.ID_TYPE_CADRE LEFT JOIN type_structure_lutte_feu r on m.ID_STRUCTURE_LUTTE=r.ID_STRUCTURE_LUTTE where m.ID_PLANTATION='"+popupContent+"'";

         $.ajax({
              url: url+'index.php/activite.php/getList',
              type:"POST",
               dataType: "json",
               data:{sql:sql},
               success: function(data) {

                htmlDetail="";
                htmlDetail=htmlDetail+"<p> <strong>Promoteur:</strong>"+data[0].NOM_ACTEUR+"</p>";
                htmlDetail=htmlDetail+"<p> <strong>Type Reboisement:</strong>"+data[0].LIBELLE_OBJECTIF_RPF+"</p>";
                htmlDetail=htmlDetail+"<p> <strong>Nombre plans:</strong>"+data[0].NOMBRE_PLANTS+"</p>";
                htmlDetail=htmlDetail+"<p> <strong>Espèce:</strong>"+data[0].LIBELLE_ESPECE+"</p>";
                htmlDetail=htmlDetail+"<p> <strong>Surface:</strong>"+data[0].SURFACE_REALISE+" Ha</p>";
                htmlDetail=htmlDetail+"<p> <strong>Date Reboisement:</strong>"+data[0].DATE_PLANTATION+"</p>";
                  marker.bindPopup(htmlDetail).openPopup();

              },
               beforeSend: function() {
                                            },
               error :  function(e){
                console.log(e);
              }

    });


      });
  }


    function createMarkerforProducteur(latitude,longitude,sql,icon,dataToDisplay){

         var marker;

      marker = L.marker([latitude,longitude],{icon: icon}).addTo(map).on('click',function(e){


         $.ajax({
              url: url+'index.php/activite.php/getList',
              type:"POST",
               dataType: "json",
               data:{sql:sql},
               success: function(data) {


                   htmlCar="";
                   htmlCar=dataToDisplay+'<p class="text-left"><strong>Espèces:</strong></p><div id="carouselExampleControls" class="carousel slide vertical" data-ride="carousel" style="background-color:grey"><p id="nomPep" class="border-0"></p><div class="carousel-inner" id="crInner">';


                   for (var i = data.length - 1; i >= 0; i--) {
                     if (i==0){
                      htmlCar=htmlCar+'<div class="carousel-item active">';
                    }else{
                      htmlCar=htmlCar+'<div class="carousel-item">';
                    }
                     htmlCar=htmlCar+'<p><strong>Espèce:</strong><br>'+data[i].LIBELLE_ESPECE+'</p><br>';
                     htmlCar=htmlCar+'<p><strong>Quantité produit:</strong><br>'+data[i].QTE_PRODUIT+'</p><br>'
                     htmlCar=htmlCar+'<p><strong>Quantité sortie :</strong><br>'+data[i].NB_SORTIE+'</p><br>';
                     htmlCar=htmlCar+'<p><strong>Quantité disponible:</strong><br>'+data[i].QTE_DISPONIBLE+'</p><br>';
                     htmlCar=htmlCar+'</div></div>  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>';
                   }


                  marker.bindPopup(htmlCar).openPopup();

              },
               beforeSend: function() {
                                            },
               error :  function(e){
                console.log(e);
              }

    });


      });
  }

  $(document).on('click', '[name="region"]', function () {

      var region=$(this).val();

      if (region=='tous'){
        map.setZoom(5);
        map.clearLayers();
      }
      else if (region==='MDG41'){
        regionjson ='boeny';
      }
      else if (region==='MDG42'){
        regionjson ='sofia';
      }
      else if (region==='MDG11'){
        regionjson ='analamanga';
      }
      else if (region==='MDG12'){
        regionjson ='vakinankaratra';
      }
      else if (region==='MDG13'){
        regionjson ='itasy';
      }
      else if (region==='MDG14'){
        regionjson ='bongolava';
      }
      else if (region==='MDG21'){
        regionjson ='hautematsiatra';
      }
      else if (region==='MDG22'){
        regionjson ='amoronimania';
      }
      else if (region==='MDG23'){
        regionjson ='vatovavyfitovinany';
      }
      else if (region==='MDG24'){
        regionjson ='ihorombe';
      }
      else if (region==='MDG25'){
        regionjson ='atsimoatsinanana';
      }
      else if (region==='MDG31'){
        regionjson ='atsinanana';
      }
      else if (region==='MDG32'){
        regionjson ='analanjirofo';
      }
      else if (region==='MDG33'){
        regionjson ='alaotramangoro';
      }
      else if (region==='MDG43'){
        regionjson ='betsiboka';
      }
      else if (region==='MDG44'){
        regionjson ='melaky';
      }
      else if (region==='MDG51'){
        regionjson ='atsimoandrefana';
      }
      else if (region==='MDG52'){
        regionjson ='androy';
      }
      else if (region==='MDG53'){
        regionjson ='anosy';
      }
      else if (region==='MDG54'){
        regionjson ='menabe';
      }
      else if (region==='MDG71'){
        regionjson ='diana';
      }
      else if (region==='MDG72'){
        regionjson ='sava';
      }
      else {
        regionjson ='';
      }

       if (regionjson){
         addRegionLayer(regionjson);
         map.setZoom(8);
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
