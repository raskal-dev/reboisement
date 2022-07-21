<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();


$index_annee=""; 
if(isset($_GET['index_annee']) && !empty($_GET['index_annee']))
{
  $index_annee = $Fonctionary->secure($_GET['index_annee']);
  $sql="SELECT *,year(dateSemi) as anneeSemi FROM pepiniere
          LEFT JOIN essence_pepiniere_semi on essence_pepiniere_semi.id_pepiniere=pepiniere.id_pepiniere
          LEFT JOIN region on region.nom_region=pepiniere.region
          LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id
          WHERE diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
          AND anneeSemi LIKE '$index_annee'";
  $req=$db->prepare($sql);
  $req->execute();
  $info=$req->fetchALL();
  
  $data['gps']=json_encode($info, JSON_FORCE_OBJECT);
  
  $sql1="SELECT *,year(dateMiseEnTerre) as anneeReb
          FROM reboisement
          LEFT JOIN plant_mise_terre on plant_mise_terre.reboisement_id=reboisement.id
          LEFT JOIN region on region.nom_region=pepiniere.region
          LEFT JOIN diredd_dredd_ciredd_region on diredd_dredd_ciredd_region.id_region=region.id
          WHERE diredd_dredd_ciredd_region.id_diredd_dredd_ciredd='".$id_diredd_dredd_ciredd."'
          AND anneeSemi LIKE '$index_annee'";
  $req1=$db->prepare($sql1);
  $req1->execute();
  $info1=$req1->fetchALL();
  
  $data1['gps']=json_encode($info1, JSON_FORCE_OBJECT);
}
  
if(isset($_POST['retour']))
{
	header('location:/coketes/Flores.php?accueil_Flores');
    exit();
}


$requete="SELECT DISTINCT year(dateMiseEnTerre) as annee FROM reboisement ORDER BY `vue_general_pneu`.`annee` ASC";
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
          <div class="col-md-3">
            <div class="form-group">
              <label for="9" style="font-size: small">Recherche par date :</label>
              
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
        </div>
     </div>
  <div class="card-body scrollable" id="acceuil">
<?php if(isset($_GET['index_annee']) && !empty($_GET['index_annee'])):?>      
        <div id="maCarte"></div>
        <form method="post">
            <button type="submit" name="retour" class="btn btn-danger btn-sm">Retour <span class="glyphicon glyphicon-remove-sign"></span></button>
        </form>
        

<!-- Fichiers Javascript -->
        <script>
            var invents=<?=$data1['gps']?>;
            var items=<?=$data['gps']?>;
            
            var tableauMarqueurs = [];
            

            // On initialise la carte
            var carte = L.map('maCarte').setView([-18.766947, 46.869107], 13);
            
            // On charge les "tuiles"
            var mainlayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                minZoom: 1,
                maxZoom: 20
            });
            
            mainlayer.addTo(carte);
            
            var marqueurs1 = L.markerClusterGroup();
            var marqueurs = L.markerClusterGroup();
            // On personnalise le marqueur
            var icone = L.icon({
                iconUrl: "img/inventaire.png",
                iconSize: [50, 50],
                iconAnchor: [25, 50],
                popupAnchor: [0, -50]
            });
            var icone1 = L.icon({
                iconUrl: "img/arbre.png",
                iconSize: [50, 50],
                iconAnchor: [25, 50],
                popupAnchor: [0, -50]
            });
            
            // On parcourt les différentes villes
            for(invent in invents){
                // On crée le marqueur et on lui attribue une popup
                var marqueurInvent = L.marker([invents[invent].latitude, invents[invent].longitude], {icon: icone}); //.addTo(carte); Inutile lors de l'utilisation des clusters
                marqueurInvent.bindPopup("<p><b><mark>"+invents[invent].nom_type_ecosysteme+"</mark></b><br><b>Numéro compartiment:</b> " +invents[invent].numero_compartiment+"</b><br><b>Lieu:</b> " +invents[invent].lieu+"<br><b>Lat:</b> " +invents[invent].latitude+"<br><b>Long:</b> "+invents[invent].longitude+"<br><b>Description Forêt:</b> "+invents[invent].description_foret+"<br><b>Type sol:</b> "+invents[invent].type_sol+"<br><b>Toposequence:</b> "+invents[invent].toposequence+"<br><b>Pente:</b> "+invents[invent].pente+"%</p>");
                marqueurs1.addLayer(marqueurInvent); // On ajoute le marqueur au groupe

                // On ajoute le marqueur au tableau
                tableauMarqueurs.push(marqueurInvent);
            }
            for(item in items){
                // On crée le marqueur et on lui attribue une popup
                var marqueur = L.marker([items[item].latitude, items[item].longitude], {icon: icone1}); //.addTo(carte); Inutile lors de l'utilisation des clusters
                marqueur.bindPopup("<p><b><mark>"+items[item].nomBinomial+"</mark></b><br><b>Numéro:</b> " +items[item].numero_espececible+"</b><br><b>Lieu:</b> " +items[item].lieu+"<br><b>Lat:</b> " +items[item].latitude+"<br><b>Long:</b> "+items[item].longitude+"</p>");
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
                'Reboisement':marqueurInvent2,
                }).addTo(carte);
            
        </script>
<?php endif;?>       
</div>
</div>
</div>
<?php require 'includes/footer.php' ; ?>
