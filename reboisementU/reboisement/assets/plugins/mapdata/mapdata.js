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
      url:"javascript:display('jZSeqRhMzMf','Alaotra-Mangoro')"
    },
    MDG5861: {
      name: "Amoron'i Mania",
      url:"javascript:display('ISDawPTDZa0','Amoron i Mania')"
    },
    MDG5862: {
      name: "Analamanga",
      url:"javascript:display('mqGL0NiPcec','Analamanga')"
     // description: '<a href="#" onclick="return display(ANALAMANGA);">Afficher les données</a>'
    },
    MDG5863: {
      name: "Analanjirofo",
       url:"javascript:display('gNTJNBeVAdw','Analanjirofo')"
    },
    MDG5864: {
      name: "Androy",
       url:"javascript:display('cHPOvpxlXMw','Androy')"
    },
    MDG5865: {
      name: "Anosy",

       url:"javascript:display('jxGgd3kt5HY','Anosy')"
    },
    MDG5866: {
      name: "Atsimo-Andrefana",
      url:"javascript:display('NW1vJsYdpGz','Atsimo-Andrefana')"
    },
    MDG5867: {
      name: "Atsimo-Atsinanana",
      url:"javascript:display('wQG7psHRxws','Atsinanana')"
    },
    MDG5868: {
      name: "Atsinanana",

       url:"javascript:display('Qu7UWIazLio','')"
    },
    MDG5869: {
      name: "Betsiboka",

       url:"javascript:display('HP4eZRkBE7z','Betsiboka')"
    },
    MDG5870: {
      name: "Boeny",

       url:"javascript:display('WZKpWZXcLyE','Boeny')"
    },
    MDG5871: {
      name: "Bongolava",

       url:"javascript:display('Suz4yH8p4g7','Bongolava')"
    },
    MDG5872: {
      name: "Diana",
      url:"javascript:display('YrBwNNPDnIg','Diana')"
    },
    MDG5873: {
      name: "Haute Matsiatra",
      url:"javascript:display('RhTiKl4os9P','Haute Matsiatra')"
    },
    MDG5874: {
      name: "Ihorombe",
      url:"javascript:display('MVyhiM2ZyNA','Ihorombe')"
    },
    MDG5875: {
      name: "Itasy",
      url:"javascript:display('XgVBu2DdJnk','Itasy')"
    },
    MDG5876: {
      name: "Melaky",
      url:"javascript:display('RCQGHSS7fE3','Melaky')"
    },
    MDG5878: {
      name: "Menabe",
      url:"javascript:display('Kh7xrmAUqLF','Menabe')"
    },
    MDG5879: {
      name: "Sava",
      url:"javascript:display('xCgSy7HhxJx','Sava')"
    },
    MDG5880: {
      name: "Sofia",
      url:"javascript:display('ECu3oHQ68cS','Sofia')"
    },
    MDG5881: {
      name: "Vakinankaratra",
      url:"javascript:display('Kl7p3xpui09','Vakinankaratra')"
    },
    MDG5882: {
      name: "Vatovavy-Fitovinany",
      url:"javascript:display('GEJgLPD9gZf','Vatovavy-Fitovinany')"
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





function display(region,name){

var BASE_URL = "<?php echo base_url(); ?>";
var titre =name;

$("#niveauEau").empty();
$("#niveauEau").html(titre);

$("#niveauHygiene").empty();
$("#niveauHygiene").html(titre);

$("#niveauAss").empty();
$("#niveauAss").html(titre);

 $("#loader").show();

$.ajax({url: 'welcome/listeCommuneDynamique/'+region,
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


labels=setLabel();
$.ajax({
        url: 'welcome/eauDynamique',
        data: {ou:region,labels:JSON.stringify(labels)},
        beforeSend: function() {
            $("#loader").show();
        },
        type: "POST"
       }).done(function(response) {
         tmp =JSON.parse(response);

         niveauServiceEauRegion(tmp['serviceGereentoutesecurite'],tmp['serviceNonAmeliore'],tmp['serviceElementaire'],
         tmp['eauSurface'],labels);
         $("#accesAEP").val(tmp['tauxaccesAEP'][0]);
         $("#accesAEPU").val(tmp['tauxaccesAEP'][1]);
         $("#accesAEPR").val(tmp['tauxaccesAEP'][2]);
         $.ajax({
                url: 'welcome/hygieneDynamique',
                data: {ou:region,labels:JSON.stringify(labels)},
                beforeSend: function() {
                    $("#loader").show();
                },
                type: "POST"
               }).done(function(response) {
                 tmp =JSON.parse(response);
                 niveauServiceHygieneRegion(tmp['hygieneBase'],tmp['hygieneLimite'],tmp['hygienePasDeService'],labels);
                $.ajax({
                      url: 'welcome/assainissementDynamique',
                      data: {ou:region,labels:JSON.stringify(labels)},
                      beforeSend: function() {
                      $("#loader").show();
                       },
                      type: "POST"
                 }).done(function(response) {
                         tmp =JSON.parse(response);
                         niveauServiceAssainissmentRegion(tmp['assGTS'],tmp['assServiceLimite'],tmp['assServiceNonAmeliore'],tmp['assDal'],labels);
                             $("#loader").hide();
               }).fail(function(e) {

               }).always(function() {
                             
             });
                  
                                
               }).fail(function(e) {
                                console.log(e);
               }).always(function() {
                             
         });

       }).fail(function(e) {
                        console.log(e);
       }).always(function() {
                     
       });





}

function setLabel(){
  label=[];  
    $("#Ensemble").is(':checked')?label.push('Ensemble'):null;
    $("#Urbain").is(':checked')?label.push('Urbain'):null;
    $("#Rural").is(':checked')?label.push('Rural'):null;
    return label;
}

function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}


 function niveauServiceEauRegion(serviceGereentoutesecurite,serviceNonAmeliore,serviceElementaire,eauSurface,labelArray){

       
    const areaChartData = {
      labels  : labelArray,
      datasets: 
      //national
      [  {
            label               : 'Géré en toute sécurité',
            backgroundColor     : '#FFA500',
            borderColor         : 'rgba(178,34,34, 1)',
            pointRadius         : false,
            pointColor          : 'rgba( 23, 165, 137 , 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : serviceGereentoutesecurite
          },
                
        {
          label               : 'Service non amélioré',
          backgroundColor     : '#FFD700',
          borderColor         : 'rgba( 55,255,0, 1)',
          pointRadius         : false,
          pointColor          : 'rgba( 23, 165, 137 , 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : serviceNonAmeliore
        },
        {
          label               : 'Service élémentaire',
          backgroundColor     : '#4682B4',
          borderColor         : '#4682B4',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : serviceElementaire
        },
        {
          label               : 'Eau de  surface',
          backgroundColor     : '#87CEEB',
          borderColor         : '#87CEEB',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : eauSurface
        },
         {
          label               : '',
          backgroundColor     : '#fff',
          borderColor         : '#fff',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [0,0,0]
        },

      ]

    }

    Chart.helpers.each(Chart.instances, function(instance){
        if (instance.chart.canvas.id === "stackedBarChartEau") {
        instance.chart.data.labels=Object.values(areaChartData)[0];
        instance.chart.data.datasets=Object.values(areaChartData)[1];
        instance.chart.update();
     }
    });
  const getCircularReplacer = () => {
  const seen = new WeakSet();
  return (key, value) => {
    if (typeof value === "object" && value !== null) {
      if (seen.has(value)) {
        return;
      }
      seen.add(value);
    }
    return value;
  };
};  
  sessionStorage.setItem("dataChartEau", JSON.stringify(areaChartData, getCircularReplacer()));     

  }

   function niveauServiceHygieneRegion(hygieneBase,hygieneLimite,hygienePasDeService,labelArray){
     
    const areaChartData = {
      labels  : labelArray,
      datasets: 
      //national
      [        
           {
            label               : 'Service de base',
            backgroundColor     : '#FFA500',
            borderColor         : 'rgba(178,34,34, 1)',
            pointRadius         : false,
            pointColor          : 'rgba( 23, 165, 137 , 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : hygieneBase
          },
                
        {
          label               : 'Service limité',
          backgroundColor     : '#FFD700',
          borderColor         : 'rgba( 55,255,0, 1)',
          pointRadius         : false,
          pointColor          : 'rgba( 23, 165, 137 , 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : hygieneLimite
        },
        {
          label               : 'Pas d\'installation',
          backgroundColor     : '#4682B4',
          borderColor         : '#4682B4',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : hygienePasDeService
        },
        {
          label               : '',
          backgroundColor     : '#fff',
          borderColor         : '#fff',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [0,0,0]
        },
         {
          label               : '',
          backgroundColor     : '#fff',
          borderColor         : '#fff',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [0,0,0]
        },

     

      ]

    }

    Chart.helpers.each(Chart.instances, function(instance){
        if (instance.chart.canvas.id === "stackedBarChartHygiene") {
        instance.chart.data.labels=Object.values(areaChartData)[0];
        instance.chart.data.datasets=Object.values(areaChartData)[1];
        instance.chart.update();
     }
    });
    const getCircularReplacer = () => {
  const seen = new WeakSet();
  return (key, value) => {
    if (typeof value === "object" && value !== null) {
      if (seen.has(value)) {
        return;
      }
      seen.add(value);
    }
    return value;
  };
};
    sessionStorage.setItem("dataChartHygiene", JSON.stringify(areaChartData,getCircularReplacer()));
  
  }



  function niveauServiceAssainissmentRegion(assGTS,assServiceLimite,assServiceNonAmeliore,assDal,labelArray){
     
      
 
    var areaChartData = {
      labels  : labelArray,
      datasets: 
      //national
      [        
          {
            label               : 'Géré en toute sécurité',
            backgroundColor     : '#FFA500',
            borderColor         : 'rgba(178,34,34, 1)',
            pointRadius         : false,
            pointColor          : 'rgba( 23, 165, 137 , 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : assGTS
          },
                
        {
          label               : 'De base',
          backgroundColor     : '#FFD700',
          borderColor         : 'rgba( 55,255,0, 1)',
          pointRadius         : false,
          pointColor          : 'rgba( 23, 165, 137 , 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [0,0,0]
        },
        {
          label               : 'Limité',
          backgroundColor     : '#4682B4',
          borderColor         : '#4682B4',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : assServiceLimite
        },
        {
          label               : 'Non amélioré',
          backgroundColor     : '#87CEEB',
          borderColor         : '#87CEEB',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : assServiceNonAmeliore
        },
         {
          label               : 'Défécation en plein air',
          backgroundColor     : '#b9b9b9',
          borderColor         : '#b9b9b9',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : assDal
        },

      ]

    }
    Chart.helpers.each(Chart.instances, function(instance){
        if (instance.chart.canvas.id === "stackedBarChartAssainissement") {
        instance.chart.data.labels=Object.values(areaChartData)[0];
        instance.chart.data.datasets=Object.values(areaChartData)[1];
        instance.chart.update();
     }
    });
    const getCircularReplacer = () => {
      const seen = new WeakSet();
      return (key, value) => {
        if (typeof value === "object" && value !== null) {
          if (seen.has(value)) {
            return;
          }
          seen.add(value);
        }
        return value;
      };
    };
    sessionStorage.setItem("dataChartAssainissement", JSON.stringify(areaChartData,getCircularReplacer()));

  }