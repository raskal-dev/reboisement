<?php
session_start();
require_once 'includes/function.php';
require_once'includes/db.php';
$Fonction->logged_only();

$id_region="";
$id_region=$_SESSION['region'];

$sql="SELECT pepinieriste,nb_platebande,Longueur,largeur,latitude,longitude FROM pepiniere
        JOIN region ON region.id=pepiniere.id_region
        WHERE pepiniere.id_region=:id_region";
$req=$db->prepare($sql);
$req->execute(array("id_region"=>$id_region));
$info=$req->fetchALL();

$data['gps']=json_encode($info, JSON_FORCE_OBJECT);
if(isset($_POST['retour']))
{
    
    header('location:MAJpepiniere.php');
    exit();
    
}
?>
<?php
require_once ('includes/header.php');
require_once ('includes/scripts.php'); 
require_once ('includes/navbar.php'); 
?>
<?php if(!empty($erreurs)): ?>
   <div class="alert alert-danger" id="messageFlash">
      <p>Vous n'avez pas rempli le formulaire correctement</p>
      <ul>
         <?php foreach($erreurs as $erreur): ?>
            <li><?= $erreur; ?></li>
         <?php endforeach; ?>
      </ul>
   </div>
   <?php endif; ?>
      <div class="container-fluid">

<!-- DataTales Example -->
    <div class="card shadow mb-4">
	 <div class="card-body">  
        <div id="maCarte" class="mb-2"></div>
        <form method="post">
            <button type="submit" name="retour" class="btn btn-danger btn-sm">Retour <span class="glyphicon glyphicon-remove-sign"></span></button>
        </form>
    </div>
    </div>
    </div> 

<!-- Fichiers Javascript -->
        <script>
            var items=<?=$data['gps']?>;
            
            var tableauMarqueurs = [];

            // On initialise la carte
            var carte = L.map('maCarte').setView([-18.766947, 46.869107], 13);
            
            // On charge les "tuiles"
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                minZoom: 1,
                maxZoom: 20
            }).addTo(carte);

            var marqueurs = L.markerClusterGroup();

            // On personnalise le marqueur
            var icone = L.icon({
                iconUrl: "./img/pepiniere.png",
                iconSize: [50, 50],
                iconAnchor: [25, 50],
                popupAnchor: [0, -50]
            });

            // On parcourt les différentes villes
            for(item in items){
                // On crée le marqueur et on lui attribue une popup
                var marqueur = L.marker([items[item].latitude, items[item].longitude], {icon: icone}); //.addTo(carte); Inutile lors de l'utilisation des clusters
                marqueur.bindPopup("<p><b><mark>"+items[item].pepinieriste+"</mark></b><br><b>Nombre plate bande:</b> " +items[item].nb_platebande+"</b><br><b>Longueur:</b> " +items[item].Longueur+ " mètre<br><b>Largeur:</b> " +items[item].largeur+ " mètre<br><b>Lat:</b> " +items[item].latitude+"<br><b>Long:</b> "+items[item].longitude+"</p>");
                marqueurs.addLayer(marqueur); // On ajoute le marqueur au groupe

                // On ajoute le marqueur au tableau
                tableauMarqueurs.push(marqueur);
            }
            // On regroupe les marqueurs dans un groupe Leaflet
            var groupe = new L.featureGroup(tableauMarqueurs);

            // On adapte le zoom au groupe
            carte.fitBounds(groupe.getBounds().pad(0.5));

            carte.addLayer(marqueurs);
        </script>
<?php require 'includes/footer.php' ; ?>
