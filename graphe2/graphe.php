<?php
/*$db=new PDO('mysql:host=localhost;dbname=revenue_mensuel;charset=UTF8','root','');
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$db->query("SET NAMES 'utf8', lc_time_names = 'fr_FR'");


$requete = 'SELECT DISTINCT * FROM recette';

$afficher = $db->prepare($requete);

$afficher->execute();*/



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Graphique avec chart JS</title>
	<script src="dist/Chart.bundle.js"></script>
</head>
<body>

	<canvas id="myChart"></canvas>

	<script>
			var ctx = document.getElementById('myChart').getContext('2d');

			var chart = new Chart(ctx, {

		    // The type of chart we want to create
		    type: 'line',

		    // The data for our dataset
		    data: {
		        labels: ['a','b','c','d','e','f','g'],
		        datasets: [{
		            label: 'My First dataset',
		            backgroundColor: 'rgb(255, 99, 132)',
		            borderColor: 'rgb(255, 99, 132)',
		            data: [0, 10, 5, 2, 20, 30, 45]
		        }]
		    },

		    // Configuration options go here
		    options: {
		    	
		    	
		    }
		});
	</script>

</body>
</html>
