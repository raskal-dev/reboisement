var simplemaps_countrymap_mapdata={
  main_settings: {
   //General settings
    width: "250", //'700' or 'responsive'
    background_color: "#FFFFFF",
    background_transparent: "yes",
    border_color: "#ffffff",

    
    //State defaults
    state_description: "Choisir région",
    state_color: "#88A4BC",
    state_hover_color: "#3B729F",
    state_url: "",
    border_size: 1.5,
    all_states_inactive: "no",
    all_states_zoomable: "yes",
    
    //Location defaults
    location_description: "Location description",
    location_url: "",
    location_color: "#FF0067",
    location_opacity: 0.8,
    location_hover_opacity: 1,
    location_size: 25,
    location_type: "square",
    location_image_source: "frog.png",
    location_border_color: "#FFFFFF",
    location_border: 2,
    location_hover_border: 2.5,
    all_locations_inactive: "no",
    all_locations_hidden: "no",
    
    //Label defaults
    label_color: "#d5ddec",
    label_hover_color: "#d5ddec",
    label_size: 22,
    label_font: "Arial",
    hide_labels: "no",
    hide_eastern_labels: "no",
   
    //Zoom settings
    zoom: "yes",
    manual_zoom: "no",
    back_image: "no",
    initial_back: "no",
    initial_zoom: "0",
    initial_zoom_solo: "no",
    region_opacity: 1,
    region_hover_opacity: 0.6,
    zoom_out_incrementally: "yes",
    zoom_percentage: 1.2,
    zoom_time: 0.5,
    
    //Popup settings
    popup_color: "white",
    popup_opacity: 0.9,
    popup_shadow: 1,
    popup_corners: 5,
    popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
    popup_nocss: "no",
    
    //Advanced settings
    div: "map",
    auto_load: "yes",
    url_new_tab: "no",
    images_directory: "default",
    fade_time: 0.1,
    link_text: "View Website",
    popups: "detect",
    state_image_url: "",
    state_image_position: "",
    location_image_url: ""
  },
  state_specific: {
    MDG5860: {
      name: "Alaotra-Mangoro",
      url:"javascript:displaysuivi('jZSeqRhMzMf','Alaotra-Mangoro')"
    },
    MDG5861: {
      name: "Amoron'i Mania",
      url:"javascript:displaysuivi('ISDawPTDZa0','Amoron i Mania')"
    },
    MDG5862: {
      name: "Analamanga",
      url:"javascript:displaysuivi('mqGL0NiPcec','Analamanga')"
     // description: '<a href="#" onclick="return displaysuivi(ANALAMANGA);">Afficher les données</a>'
    },
    MDG5863: {
      name: "Analanjirofo",
       url:"javascript:displaysuivi('gNTJNBeVAdw','Analanjirofo')"
    },
    MDG5864: {
      name: "Androy",
       url:"javascript:displaysuivi('cHPOvpxlXMw','Androy')"
    },
    MDG5865: {
      name: "Anosy",

       url:"javascript:displaysuivi('jxGgd3kt5HY','Anosy')"
    },
    MDG5866: {
      name: "Atsimo-Andrefana",
      url:"javascript:displaysuivi('NW1vJsYdpGz','Atsimo-Andrefana')"
    },
    MDG5867: {
      name: "Atsimo-Atsinanana",
      url:"javascript:displaysuivi('wQG7psHRxws','Atsinanana')"
    },
    MDG5868: {
      name: "Atsinanana",

       url:"javascript:displaysuivi('Qu7UWIazLio','')"
    },
    MDG5869: {
      name: "Betsiboka",

       url:"javascript:displaysuivi('HP4eZRkBE7z','Betsiboka')"
    },
    MDG5870: {
      name: "Boeny",

       url:"javascript:displaysuivi('WZKpWZXcLyE','Boeny')"
    },
    MDG5871: {
      name: "Bongolava",

       url:"javascript:displaysuivi('Suz4yH8p4g7','Bongolava')"
    },
    MDG5872: {
      name: "Diana",
      url:"javascript:displaysuivi('YrBwNNPDnIg','Diana')"
    },
    MDG5873: {
      name: "Haute Matsiatra",
      url:"javascript:displaysuivi('RhTiKl4os9P','Haute Matsiatra')"
    },
    MDG5874: {
      name: "Ihorombe",
      url:"javascript:displaysuivi('MVyhiM2ZyNA','Ihorombe')"
    },
    MDG5875: {
      name: "Itasy",
      url:"javascript:displaysuivi('XgVBu2DdJnk','Itasy')"
    },
    MDG5876: {
      name: "Melaky",
      url:"javascript:displaysuivi('RCQGHSS7fE3','Melaky')"
    },
    MDG5878: {
      name: "Menabe",
      url:"javascript:displaysuivi('Kh7xrmAUqLF','Menabe')"
    },
    MDG5879: {
      name: "Sava",
      url:"javascript:displaysuivi('xCgSy7HhxJx','Sava')"
    },
    MDG5880: {
      name: "Sofia",
      url:"javascript:displaysuivi('ECu3oHQ68cS','Sofia')"
    },
    MDG5881: {
      name: "Vakinankaratra",
      url:"javascript:displaysuivi('Kl7p3xpui09','Vakinankaratra')"
    },
    MDG5882: {
      name: "Vatovavy-Fitovinany",
      url:"javascript:displaysuivi('GEJgLPD9gZf','Vatovavy-Fitovinany')"
    }
  },
  locations: {
    "0": {
      lat: "-18.916667",
      lng: "47.516667",
      name: "Antananarivo"
    }
  },
  labels: {},
  legend: {
    entries: []
  },
  regions: {},
  data: {
    data: {
      MDG5862: "12355"
    }
  }
};



function displaysuivi(region,name){
var niveau = region;
var titre =name;

$("#niveau").empty();
$("#niveau").html(titre);

 $("#loader").show();
var codeprogramme=$("#choixProgramme").val();
var codeobjectif=$("#choixObjectif").val();

if (region!='BkjcPj8Zv7E'){
          $.ajax({url:'../welcome/listeCommuneDynamique/'+region,
                                beforeSend: function() {
                                $("#loader").show();
                                 },
                                type: "POST"
                           }).done(function(response) {
                             $("#commune").empty();
                             $("#commune").html(response);
                                     
                         }).fail(function(e) {

                         }).always(function() {
                        });
}

 $.ajax({
              url:'../Programmation/suiviObjectif/'+codeprogramme+'/'+codeobjectif+'/'+region,
              beforeSend: function() {
                $("#loader").show();
              },
              type: "POST"
                 }).done(function(response) {
                         tmp =JSON.parse(response);
                         suiviRealisation(tmp['donnees'],tmp['periode']);
                         $("#loader").hide();
               }).fail(function(e) {
                   console.log(e);
               }).always(function() {
                 
              });
}




function suiviRealisation(donnee,periode){
     
   
   var l=[];
   var o=[];
   var r=[];

   for (var i = 0; i < periode.length; i++) {
     l.push(donnee[i]['idperiode']);
   }
  for (var i = 0; i < periode.length; i++) {
     r.push(donnee[i]['tauxrealisation']);
   }
  for (var i = 0; i < periode.length; i++) {
     o.push(donnee[i]['tauxobjectif']);
   }


     var areaChartData = {
      labels  : l,
      datasets: 
      //national
      [        
          {
            label               : 'Objectif',
            backgroundColor     : '#FFA500',
            borderColor         : 'rgba(178,34,34, 1)',
            pointRadius         : false,
            pointColor          : 'rgba( 23, 165, 137 , 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : o
          },
                
        {
          label               : 'Réalisation',
          backgroundColor     : '#FFD700',
          borderColor         : 'rgba( 55,255,0, 1)',
          pointRadius         : false,
          pointColor          : 'rgba( 23, 165, 137 , 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : r
        }

      ]

    }

    var barChartData = $.extend(true, {}, areaChartData);


    var stackedBarChartCanvas = $('#suivi').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      legend: {
          display: true,
          position:'right'
      },
      scales: {
        xAxes: [{
          stacked: false,
        }],
        yAxes: [{
          stacked: false,
         ticks: {
            
                   min: 0,
                   max: 100,
                   callback: function(value){return value+ "%"}
                },
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions,
    })
   }

