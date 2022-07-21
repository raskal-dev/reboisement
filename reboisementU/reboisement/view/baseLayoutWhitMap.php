<!-- templates/baseLayout.php -->
<!DOCTYPE html>
<html>
<head>
  <?php
  require_once 'utility.php';
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo home_base_url();?>plugins/fontawesome-free/css/all.min.css">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="container-xl container-md container-sm">
    <div>
    <img src= "<?php echo home_base_url();?>images/header_small.png" style="height: 150px;width:100%;" class="img-fluid" ></img>
    </div>
    <div> <?php   include 'header.php'; ?></div>


   <div class="row">
         <div class="col-3 col-sm-3 col-md-3 ">
         <nav class="nav flex-column menunav">
          
                <div id="card-map" style="float:left ">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Madagascar
                </h3>
                
                <!-- /.card-tools -->
              </div>
                
                <div id="map" style="width:380px;height: 650px;background: white;" ></div>
                <span class="form-control-sm">Choisir région sur la carte</span>
                <select id="commune" class="custom-select form-control-border form-control-sm"  style="margin-bottom:10px;margin-top:10px;">

            <option value=''>Choisir Commune</option>
                  <?php
                      foreach($lstCommune as $lst) {                        
                       echo '<option value="'.$lst['ID_COMMUNE'].'">'.$lst['LIBELLE_COMMUNE'].'</option>';
                      }

                  ?>
                    
        </select>

              </div>

             <div class="row text-center" style="width:150px;margin-top:150px;margin-left:10px;margin-bottom: 50px;">

                      <?php
                      if (isset($_SESSION['isConnected'])){
                          if ($_SESSION['isConnected']){
                            echo '<a id="btnLogout"href="#" class="btn btn-sm btn-outline-warning btn-block "><i class="fas fa-user-lock"></i> Se deconneter</a>';
                           }else{
                            echo '<a href="#"  data-toggle="modal" data-target="#loginMOdal" class="btn  btn-sm btn-outline-warning btn-block "><i class="fas fa-user-lock"></i> Se connecter</a>'
                  ;
                          }
                   }else{       
                    echo '<a href="#"  data-toggle="modal" data-target="#loginMOdal" class="btn  btn-sm btn-outline-warning btn-block "><i class="fas fa-user-lock"></i> Se connecter</a>'
                  ;
                      }
                        ?> 
            </div>
                     

        </nav>

  </div>
       <div class="col-10 col-sm-10">
        <?php echo $content ?>
       </div>
      
  

    </div>
</body>

<link rel="stylesheet" href="<?php echo home_base_url();?>css/leaflet.css">

<script src="<?php echo home_base_url();?>js/leaflet.js"></script>
<script src="<?php echo home_base_url();?>js/leaflet.shpfile.js"></script>
<script src="<?php echo home_base_url();?>js/shp.js"></script>
<script src="<?php echo home_base_url();?>js/centroide_region.js"></script>

<script>
var assetUrl = "<?php echo home_base_url(); ?>";
$(document).ready(function () {


  $("#btnLogout").click(function(){
    url='<?php echo base_url();?>index.php/auth.php/logout';
        $.ajax({
                                              url: url,
                                              type:"POST",
                                              dataType: "html",
                                              success: function(response) {
                                                    location.reload();
                                                   
                                              }, 
                                              beforeSend: function() { 
                                            },
                                              error :  function(e){
                                                 console.log(e);
                                        }      
                                       });
    }); 
  
  

});
  /*MAP

   /* MAP*/
/*************/

    // defini map niveau region 
      
  var map = L.map('map').setView([-18.7785704655, 46.830888048], 4.1);
  var markerGroup = L.featureGroup().addTo(map);
 
   var legend = L.control({position: 'bottomleft'});
    legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend');
    labels = ['<strong>Zone reboisée</strong>'],
    categories = ['foret'];

    for (var i = 0; i < categories.length; i++) {

            div.innerHTML += 
            labels.push(
                '<i class="fa fa-circle" style="color:' + getColor(categories[i]) + '"></i> ' +
            (categories[i] ? categories[i] : '+'));

        }
        div.innerHTML = labels.join('<br>');


    return div;
    };


  addLayerNational().addTo(map);
  var pathData=assetUrl+"data/region.geojson";
   addJsonLayer(pathData);
   addCentroid().addTo(map);
   addText().addTo(map);
 
 
  
   
   function style1(feature) {
    return {
        fillColor: '#ffff',
        weight: 0.5,
        opacity: 1,
        color: 'black',
        dashArray: '2',
        fillOpacity: 0
    };
}

   function style(feature,shapefile) {
    return {
        fillColor: getColor(shapefile),
        color: getColor(shapefile),
        clickable:true
    };
  
}

   function addLayerNational (){
     let madagascarlayer = L.tileLayer(assetUrl+'images/region_tiles/{z}/{x}/{y}.png', {
        
                      minZoom: 5,
                      maxZoom: 8,
                      tms: false,
                      attribution: 'Generated by HayTic'
                     
                    });
      return madagascarlayer;
   }

   function addShapeFile(tilesName){

    var shpfile = new L.Shapefile(assetUrl+'images/'+tilesName+'.zip', {

      //style: style,
      onEachFeature: function(feature, layer) {

         layer.setStyle({fillColor: getColor(tilesName),
                         color: getColor(tilesName),
                         clickable:true,
                         weight:1});
        
        if (feature.properties) {
           layer.bindPopup(Object.keys(feature.properties).map(function(k) {
            return k + ": " + feature.properties[k];
          }).join("<br />"), {
            maxHeight: 200
          });
        }
      }
    });
    return shpfile;
  
   }


function addJsonLayer(pathData){

  $.getJSON(pathData,function(data){


  var datalayer = L.geoJson(data ,{
    style: style1,
    onEachFeature: function(feature, featureLayer) {  

    
      if (feature.properties) {

           featureLayer.bindPopup(Object.keys(feature.properties).map(function(k) {

                  return k + ": " + feature.properties[k];
                }).join("<br />"), {
                  maxHeight: 200
                }).openPopup();
              }
          

           featureLayer.on('click',function(e){
            clickOnMap(feature.properties);
           
          });
       
   }
  }).addTo(map);

  
});
}



function addCentroid(){

  var regionCentro=L.geoJson(regioncentro, {
  pointToLayer: function (feature, latlng) {

    return L.circleMarker(latlng,{
      radius : 4, 
      color : '#005824',
      fillOpacity: 1,
      fillColor: '#41AE76'
     });
   }
    });

  return regionCentro;
}

function addText(){

  var regionText=L.geoJson(regioncentro, {
  pointToLayer: function (feature, latlng) {

    var icon = L.divIcon({
         iconSize:null,
         html:'<div>'+feature.properties.REGION+'</div>'
       });
 
    return L.marker(latlng,{
      icon:icon
     });
   }
    });

  return regionText;
}

function  clickOnMap(data){  

   id_region = data['P_CODE'];
   libelle_region =data['REGION'];
   getListCommuneRegion(id_region);
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
  

}

function getListCommuneRegion(region){

   var baseUrl="<?php echo base_url();?>";
    valueSelected =region;
     var sql="select a.ID_COMMUNE,a.LIBELLE_COMMUNE from commune a, district b where a.ID_DISTRICT=b.ID_DISTRICT and b.ID_REGION='"+valueSelected+"'";
    
      htmlCommune="<select id='ID_COMMUNE'>";
     $.ajax({
              url: baseUrl+'index.php/activite.php/getList',
              type:"POST",
               dataType: "json",
               data:{sql:sql},
               success: function(response) {  
                      htmlCommune=htmlCommune+"<option value=''>Choisir</option>";
                      $.each(response, function(key, value) {
                              htmlCommune=htmlCommune+"<option value="+value['ID_COMMUNE']+">"+value['LIBELLE_COMMUNE']+"</option>";
                      });
              htmlCommune=htmlCommune+"</select>"; 
               $("#commune").html="";
              $("#commune").html(htmlCommune);           
              }, 
               beforeSend: function() {
                                            },
               error :  function(e){
                console.log(e);
              }      
                                       
    });
  }



   function getColor(d) {

        return d === 'shapefileforet'  ? "#38761d" :
               d === 'carte_ac'  ? "#eb6e34" : "#ffff" ;
    }

</script>



</html>