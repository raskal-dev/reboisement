<?php
  ob_start();
?>

<div class="wrapper ml-2">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        
        <!-- SEARCH FORM 
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        -->
      </div>

    </div>
  </nav>
  <!-- /.navbar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    

    <!-- Main content -->
    <div class="content mt-2">
      <div >
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-success">
               <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Surface  prévue / réalisée</h3>
                  
                </div>
              </div>
              <div class="card-body">
               

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Réalisée
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Prévue
                  </span>
                </div>
             
            </div>

           
          </div>
     
          <!-- /.col-md-6 -->
        </div>
             <!-- /.col-md-6 -->
          <div class="col-lg-6">
              <!-- solid sales graph -->
            <div class="card ">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Evolution des surfaces reboisées
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-secondary btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-secondary btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
          
              <!-- /.card-footer -->
            </div>
           
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
       <div class="row">
          <div class="col-lg-6">
            <div class="card card-success" style="height:400%" >
               <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Situation des plantations</h3>
                  
                </div>
              </div>
              <div class="card-body">
               
                  <div class="row bg-transparent" id="map" style="height:100%"></div>
             
            </div>

           
          </div>
     
          <!-- /.col-md-6 -->
        </div>
             <!-- /.col-md-6 -->
         <div class="col-lg-6">
            <div class="card card-success" style="height:400%" >
               <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Feu</h3>
                  
                </div>
              </div>
              <div class="card-body">
               
                  <div class="row bg-transparent" id="map1" style="height:100%"></div>
             
            </div>

           
          </div>
     
          <!-- /.col-md-6 -->
        </div>
       
        <!-- /.row -->
      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  

 
</div>
 
<?php
  include 'login.php';
  include 'register.php';
  $content = ob_get_clean();
  include 'baseLayout.php';
?>
<link rel="stylesheet" href="<?php echo home_base_url();?>css/leaflet.css">

<script src="<?php echo home_base_url();?>js/leaflet.js"></script>
<script src="<?php echo home_base_url();?>js/leaflet.shpfile.js"></script>
<script src="<?php echo home_base_url();?>js/shp.js"></script>
<script type="text/javascript">
  var assetUrl = "<?php echo home_base_url(); ?>";
  var surfaceReboisePrevueAnnuelle = <?php echo json_encode($surfaceReboisePrevueAnnuelle)?>;
  var x=[];
  var y=[];
  var z=[];

  for (var i = surfaceReboisePrevueAnnuelle.length - 1; i >= 0; i--) {


          x[i]=surfaceReboisePrevueAnnuelle[i]['annee'];
          y[i]=surfaceReboisePrevueAnnuelle[i]['surfacereboisee'];
          z[i]=surfaceReboisePrevueAnnuelle[i]['surfaceprevue'];
    
  }


      var ticksStyle = {
          fontColor: '#495057',
          fontStyle: 'bold'
        }


     var mode = 'index'
     var intersect = true
  
    var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: x,
      datasets: [
        {
          backgroundColor: '#3cb371',
          borderColor: '#3cb371',
          data: y
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: z
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
             /* if (value >= 1000) {
                value /= 1000
                value += 'Ha'
              }*/

               value += ' ha'

              return  value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

  /////
   var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    labels: x,
    datasets: [
      {
        label: 'Surface reboisée',
        fill: false,
        borderWidth: 2,
        lineTension: 0,
        spanGaps: true,
        borderColor: '#008000',
        pointRadius: 3,
        pointHoverRadius: 7,
        pointColor: '##008000',
        pointBackgroundColor: '#008000',
        data: y
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        ticks: {
          fontColor: '#000000'
        },
        gridLines: {
          display: false,
          color: '#000000',
          drawBorder: false
        }
      }],
      yAxes: [{
        ticks: {
          stepSize: 1000,
          fontColor: '#000000'
        },
        gridLines: {
          display: true,
          color: '#000000',
          drawBorder: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesGraphChartData,
    options: salesGraphChartOptions
  })
  


  /*MAP

   /* MAP*/
/*************/

    // defini map niveau region 
      
  var map = L.map('map').setView([-18.7785704655, 46.830888048], 5.1);
  var map1 = L.map('map1').setView([-18.7785704655, 46.830888048], 5.1);

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


  var markersLayer;
  addLayerNational().addTo(map);
  addShapeFile('shapefileforet').addTo(map);
  addShapeFile('carte_ac').addTo(map1);
  
  legend.addTo(map);
  addLayerNational().addTo(map1);
  
  
var markersLayer
  var style = {
        "clickable": true,
        "color": "#38761d",
        "fillColor": "#38761d",
        "weight": 1.0,
        "opacity": 0.3,
        "fillOpacity": 0.2
    };

   function style(feature,shapefile) {
    return {
        fillColor: getColor(shapefile),
        color: getColor(shapefile),
        clickable:true
    };
  
}

   function addLayerNational (){
     let madagascarlayer = L.tileLayer(assetUrl+'images/region_tiles/{z}/{x}/{y}.png', {
        
                      minZoom: 4,
                      maxZoom: 6,
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

   function getColor(d) {

        return d === 'shapefileforet'  ? "#38761d" :
               d === 'carte_ac'  ? "#eb6e34" : "#ffff" ;
    }


</script>
