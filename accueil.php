<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();

$id_diredd_dredd_ciredd=$_SESSION['authentifier']['id_diredd_dredd_ciredd'];
$index_annee=""; 
if(isset($_GET['index_annee']) && !empty($_GET['index_annee']))
{
  $index_annee = $Fonction->secure($_GET['index_annee']);
  $sql="SELECT * FROM pepiniere
          LEFT JOIN region on region.nom_region=pepiniere.region
          LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id
          WHERE diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
          AND anneeExercice LIKE '".$index_annee."'
          AND longitude != 'NULL'
          AND latitude != 'NULL'
          ";
  $req=$db->prepare($sql);
  $req->execute();
  $info=$req->fetchALL();
  
  $data['gps']=json_encode($info, JSON_FORCE_OBJECT);
  
  $sql1="SELECT  *
          FROM gpsrebois
          JOIN reboisement on gpsrebois.reboisement_id=reboisement.id
          JOIN region on region.nom_region=reboisement.region
          JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id
          WHERE diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
          AND anneeRebois LIKE '".$index_annee."'
          AND longitude != 'NULL'
          AND latitude != 'NULL'";
  $req1=$db->prepare($sql1);
  $req1->execute();
  $info1=$req1->fetchALL();
  
  $data1['gps']=json_encode($info1);
  
 
  
  
}
  
if(isset($_POST['retour']))
{
	header('location:/coketes/Flores.php?accueil_Flores');
    exit();
}


$requete="SELECT DISTINCT anneeRebois as annee FROM reboisement ORDER BY `reboisement`.`anneeRebois` ASC";
$result=$db->prepare($requete);
$result->execute();
?>
<?php
require_once ('includes/header.php');
require_once ('includes/scripts.php'); 
require_once ('includes/navbar.php'); 
?>
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4 mt-4">

      <div class="row">
          <div class="col-md-3 ml-2">
            <form method="get">
            <div class="form-group">
              <label for="9" style="font-size: small">Recherche par année :</label>
              
              <select class="form-control" name="index_annee"
                onChange="this.form.submit();" >
                <option value=""></option>
                <?php  while($infocont=$result->fetch(PDO::FETCH_ASSOC)) {?>  
                 <option 
                  value="<?php echo  $infocont['annee'] ?>" 
                  <?php if($infocont['annee']===$index_annee) echo "selected"?> > 
                  <?php echo  $infocont['annee'] ?> 
                 </option>       
                <?php  } ?>       
             </select>
            </div>
            </form>
        </div>
     </div>
  <div class="card-body scrollable" id="acceuil">
<?php if(isset($_GET['index_annee']) && !empty($_GET['index_annee'])):?>      
        <div id="maCarte"></div>
        
        

<!-- Fichiers Javascript -->
        <script>
            var items=<?=$data['gps']?>;
            
            var json='<?=$data1['gps']?>';
            var polygons= JSON.parse(json);
            
            
            var tableauMarqueurs = [];
            

            // On initialise la carte
            var carte = L.map('maCarte').setView([-18.766947, 45.869107], 5);
            
            // On charge les "tuiles"
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(carte);
            
            var marqueurs1 = L.markerClusterGroup();
            var marqueurs = L.markerClusterGroup();
            // On personnalise le marqueur
            
            polygons.forEach(item => {
              var polygon = L.polygon([[
                                       [polygons[0].latitude, polygons[0].longitude],
                                       [polygons[1].latitude, polygons[1].longitude],
                                       [polygons[2].latitude, polygons[2].longitude],
                                       [polygons[3].latitude, polygons[3].longitude],
                                       
                                     ]]);//.addTo(carte);
              marqueurs1.addLayer(polygon);
              tableauMarqueurs.push(polygon);
              });
            
            
            //
            //for(invent in invents){
            //    // On crée le marqueur et on lui attribue une popup
            //    var marqueurInvent = L.marker([invents[invent].latitude, invents[invent].longitude]); //.addTo(carte); Inutile lors de l'utilisation des clusters
            //    //
            //    marqueurInvent.bindPopup("<p><b><mark><b>Acteur: " +invents[invent].acteur+"</mark></b><br><b>Type:</b> " +invents[invent].typeActeur+"</b><br><b>Région:</b> " +invents[invent].region+"<br><b>Site:</b> " +invents[invent].site+"<br><b>Situation Juridique:</b> " +invents[invent].situationJuridique+"<br><b>Objectif RPF:</b> "+invents[invent].objectifRpf+"<br><b>Superficie:</b> "+invents[invent].superficieRealise+ "Ha<br>"+invents[invent].mangroveOuTerrestre+"<br><b>Lat:</b> "+invents[invent].latitude+"<br><b>Long:</b> "+invents[invent].longitude+"</p>");
            //    
            //    marqueurs1.addLayer(marqueurInvent); // On ajoute le marqueur au groupe
            //
            //    // On ajoute le marqueur au tableau
            //    tableauMarqueurs.push(marqueurInvent);
            //}
            //
            for(item in items){
                // On crée le marqueur et on lui attribue une popup
                
                var marqueur = L.marker([items[item].latitude, items[item].longitude]); //.addTo(carte); Inutile lors de l'utilisation des clusters
                //
                marqueur.bindPopup("<p><b><mark>Région: "+items[item].region+"</mark></b><br><b><mark>Site: "+items[item].site+"</mark></b><br><b>Responsable:</b> " +items[item].responsablePepiniere+"</b><br><b>Nombre plate bande:</b> " +items[item].nombrePlatebande+"<br><b>Lat:</b> " +items[item].latitude+"<br><b>Long:</b> "+items[item].longitude+"</p>");
                
                marqueurs.addLayer(marqueur); // On ajoute le marqueur au groupe

                // On ajoute le marqueur au tableau
                tableauMarqueurs.push(marqueur);
            }
            
            // On regroupe les marqueurs dans un groupe Leaflet
            var groupe = new L.featureGroup(tableauMarqueurs);

            // On adapte le zoom au groupe
            carte.fitBounds(groupe.getBounds().pad(0.5));
            
            var marqueur1 = marqueurs;
            var marqueurInvent2 = marqueurs1;
            
            L.control.layers({
                'Pepiniere':marqueur1,
                'Reboisement':marqueurInvent2
                }).addTo(carte);
        </script>
<?php else:?>
<div id="maCarte"></div>
<script>
  var carte = L.map('maCarte').setView([-18.766947, 45.869107], 5);
   // On charge les "tuiles"
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(carte);
</script>
<?php endif;?>       
</div>
</div>
</div>
<?php require 'includes/footer.php' ; ?>
