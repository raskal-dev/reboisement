


<?php
  ob_start();
?>
 <div class="container">
    <div class="row" style="margin-top:20px">    
                 <div class="col-2">
                  <?php
                    foreach ($leftMenu as $value) {
                      if ($value['libelle']=='Gestion des pepinières'){
                        if (isset($_SESSION['isConnected'])){
                          echo '<a class="nav-link active" style="color:green;" href="'.$value['lien'].'">'.$value['libelle'].'</a>';
                        }
                    }else{
                       echo '<a class="nav-link active" style="color:green;" href="'.$value['lien'].'">'.$value['libelle'].'</a>';
                    }
                    }?>
                    
                    
                </div>

                <div class="col-6">
                  <div class="row bg-transparent" id="map"  style="height:250%"></div>
                </div>
                <div class="col-4">
                                    <div class="row ">
                                      <h6>
                                        <strong><u>Nom:</u></strong><input id="nomPep" name="name" class="border-0"></input></h6>
                                    </div>
                                    <div class="row">
                                            <h6><strong><u>Localisation</u></strong></h6>
                                    </div>
                                    <div class="row">
                                      <h6>Région:<input  id="regionPep" class="border-0"></input></h6>
                                    </div>
                                    <div class="row ">
                                      <h6>Comune:<input id="communePep" class="border-0"></input></h6>
                                    </div>
                                    <div class="row ">
                                      <h6>Fokontany:<input id="fokontanyPep" class="border-0"></input></h6>
                                    </div>    
                                    <div class="row ">
                                      <h6>Latitude:<input id="latPep" class="border-0"></input></h6>
                                    </div>   
                                    <div class="row ">
                                      <h6>Longitude:<input id="longPep" class="border-0"></input></h6>
                                    </div>                             
                                    <div class="row ">
                                            <h6><strong><u>espèces produit</u></strong></h6>
                                    </div>
                                    <div class="row ">
                                      <p id="especePep" class="border-0"></p>
                                    </div> 
                </div> 

   </div>              

 <div id="frmDialog">

       <select id="ID_REGION"class="form-select" name="ID_REGION" aria-label="Default select example">
                  <?php
                      foreach ($lstRegion as $value) { 
                        echo "<option value=".$value['ID_REGION'].">".$value['LIBELLE_REGION']."</option>";
                      }
                  ?>
                 
        </select>
       <?php  include 'donneeFormulaire.php'; ?>
 </div>
</div>
<script type="text/javascript">
$(document).ready(function () {

  $( "#btnShow" ).click(function() {
  $("#loginMOdal").modal("show");

    $("#loginMOdal").appendTo("body");
});
 
  
/* formulaire*/
/*************/
  var assetUrl = "<?php echo home_base_url(); ?>";
  var url="<?php echo base_url() ?>";
  var selectDistrict='';
  var selectRegion='';
  

 $('#ID_REGION').change(function () {
     valueSelected =$(this).val();
     var sql="select a.ID_COMMUNE,a.LIBELLE_COMMUNE from commune a, district b where a.ID_DISTRICT=b.ID_DISTRICT and b.ID_REGION='"+valueSelected+"'";
      htmlCommune="<select id='ID_COMMUNE'>";
     $.ajax({
              url: url+'index.php/activite.php/getList',
              type:"POST",
               dataType: "json",
               data:{sql:sql},
               success: function(response) {  
                      $.each(response, function(key, value) {
                              htmlCommune=htmlCommune+"<option value="+value['ID_COMMUNE']+">"+value['LIBELLE_COMMUNE']+"</option>";
                      });
              htmlCommune=htmlCommune+"</select>"; 
               $("#ID_COMMUNE").html="";
              $("#ID_COMMUNE").html(htmlCommune);           
              }, 
               beforeSend: function() {
                                            },
               error :  function(e){
                console.log(e);
              }      
                                       
    });
  });
 

/*Data   */
/*********/

  function persistance(tableName,valSaisi){
    idTraitement=$("#frmDialog").dialog("option", "idTratitement");
    oldsValue=$("#frmDialog").dialog("option", "oldsValue"); 
    config='pepiniere.ini';


    $.ajax({
                                              url:url+'index.php/activite.php/persitance',
                                              type:"POST",
                                              dataType: "html",
                                              data:{valSaisi:valSaisi,tableName:tableName,idTraitement:idTraitement,oldsValue:oldsValue,config:config},
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
                                     height:550,
                                     width: "30%",
                                     maxWidth: "500px",
                                    position: [10,28],
                                     overflow:'scroll',
                                     idTratitement: '',
                                     oldsValue: '',
                                     title: 'Formulaire saisie',
                                      buttons: {
                                      "Enregistrer": function() {
                                        var valSaisi =$("#frmAction").serialize();
                                        idTraitement=$( this ).dialog("option", "idTratitement");
                                        persistance(tableName,valSaisi);
                                        $( this ).dialog( "close" );
                                        location.reload(true);
                                      },
                                      Cancel: function() {
                                        $( this ).dialog( "close" );
                                      }
                                    },
                                    close: function() {
                                      $( this ).dialog( "close" );
                                    }
                           });
  
     function listeEspece(popupContent){
        var sql="SELECT  DISTINCT e.LIBELLE_ESPECE from pepiniere_production p, espece e where p.ID_ESPECE=e.ID_ESPECE and p.ID_PEPINIERE='"+popupContent+"'";
     $.ajax({
              url: url+'index.php/activite.php/getList',
              type:"POST",
               dataType: "json",
               data:{sql:sql},
               success: function(data) {  
                //console.log(document.getElementById("nomPep"));
                let espece=""
                for (var i = 0; i < data.length; i++) {
                  espece=espece+data[i].LIBELLE_ESPECE+";"
                }
                 ;
                $("#especePep").text(espece.substring(0, espece.length - 1));
              }, 
               beforeSend: function() {
                                            },
               error :  function(e){
                console.log(e);
              }      
                                       
    });
     }
 /* MAP*/
/*************/

    // defini map niveau region 
      
  var map = L.map('map').setView([-18.7785704655, 46.830888048], 5.1);

  var LeafIcon = L.Icon.extend({
    options: {
       iconSize:     [25, 25],
       iconAnchor: [12,25],
       popupAnchor:  [-3, -76]
    }
});

var greenIcon = new LeafIcon({
    iconUrl: assetUrl+'/images/pepiniere.png'
})

//var marker = new L.Marker([-17.8345566, 49.8308880],{icon: greenIcon});
//marker.addTo(map);
  var markersLayer;
  addLayerNational().addTo(map);
  var lstPepinier=<?php echo json_encode($dataToload);?>;
  for (var i=0; i<lstPepinier.length;i++){
                createMarker(lstPepinier[i].LATITUDE ,lstPepinier[i].LONGITUDE,lstPepinier[i].ID_PEPINIERE);
  }
  
  
var markersLayer
   function addLayerNational (){
     let madagascarlayer = L.tileLayer(assetUrl+'images/communeAll/{z}/{x}/{y}.png', {
        
                      minZoom: 6,
                      maxZoom: 10,
                      tms: false,
                      attribution: 'Generated by HayTic',
                      style:function (feature) {
                        return { color: 'red', weight: 4 };
                      }
                    });
      return madagascarlayer;
   }

   

  function createMarker(latitude,longitude,popupContent){
    L.marker([latitude,longitude],{icon: greenIcon}).addTo(map).on('click',function(e){
         var sql="select LIBELLE_PEPINIERE,FOKONTANY,LIBELLE_COMMUNE,LIBELLE_REGION,LATITUDE,LONGITUDE from pepiniere p, commune c, region r, district d where p.ID_COMMUNE=c.ID_COMMUNE and c.ID_DISTRICT=d.ID_DISTRICT and d.ID_REGION=r.ID_REGION and p.ID_PEPINIERE='"+popupContent+"'";
     $.ajax({
              url: url+'index.php/activite.php/getList',
              type:"POST",
               dataType: "json",
               data:{sql:sql},
               success: function(data) {  
                //console.log(document.getElementById("nomPep"));
                $('#nomPep').val(data[0].LIBELLE_PEPINIERE);
                $('#regionPep').val(data[0].LIBELLE_REGION);
                $('#communePep').val(data[0].LIBELLE_COMMUNE);
                $('#fokontanyPep').val(data[0].FOKONTANY);
                $('#latPep').val(data[0].LATITUDE);
                $('#longPep').val(data[0].LONGITUDE);
                listeEspece(popupContent);
              }, 
               beforeSend: function() {
                                            },
               error :  function(e){
                console.log(e);
              }      
                                       
    });


      });
  }
  


 });

</script>
<?php
  
  include 'login.php';
  include 'register.php';
  $content = ob_get_clean();
  include 'baseLayoutWhitOutMenu.php';
?>