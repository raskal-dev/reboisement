var simplemaps_countrymap_mapdata={
  main_settings: {
   //General settings
    width: "300", //'700' or 'responsive'
    background_color: "#FFFFFF",
    background_transparent: "yes",
    border_color: "#ffffff",
    
    //State defaults
    state_description: "State description",
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
    manual_zoom: "yes",
    back_image: "no",
    initial_back: "no",
    initial_zoom: "-1",
    initial_zoom_solo: "no",
    region_opacity: 1,
    region_hover_opacity: 0.6,
    zoom_out_incrementally: "yes",
    zoom_percentage: 0.99,
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
      url:"javascript:display('ALAOTRA MANGORO')"
    },
    MDG5861: {
      name: "Amoron'i Mania",
      url:"javascript:display('AMORON'I MANIA)"
    },
    MDG5862: {
      name: "Analamanga",
      url:"javascript:display('ANALAMANGA')"
     // description: '<a href="#" onclick="return display(ANALAMANGA);">Afficher les données</a>'
    },
    MDG5863: {
      name: "Analanjirofo",
       url:"javascript:display('ANALANJIROFO')"
    },
    MDG5864: {
      name: "Androy",
       url:"javascript:display('ANDROY')"
    },
    MDG5865: {
      name: "Anosy",

       url:"javascript:display('ANOSY')"
    },
    MDG5866: {
      name: "Atsimo-Andrefana",
      url:"javascript:display('ATSIMO ANDREFANA')"
    },
    MDG5867: {
      name: "Atsimo-Atsinanana",
      url:"javascript:display('ATSIMO ATSINANANA')"
    },
    MDG5868: {
      name: "Atsinanana",

       url:"javascript:display('ATSINANANA')"
    },
    MDG5869: {
      name: "Betsiboka",

       url:"javascript:display('BETSIBOKA')"
    },
    MDG5870: {
      name: "Boeny",

       url:"javascript:display('BOENY')"
    },
    MDG5871: {
      name: "Bongolava",

       url:"javascript:display('BONGOLAVA')"
    },
    MDG5872: {
      name: "Diana",
      url:"javascript:display('DIANA')"
    },
    MDG5873: {
      name: "Haute Matsiatra",
      url:"javascript:display('HAUTE MATSIATRA')"
    },
    MDG5874: {
      name: "Ihorombe",
      url:"javascript:display('IHOROMBE')"
    },
    MDG5875: {
      name: "Itasy",
      url:"javascript:display('ITASY')"
    },
    MDG5876: {
      name: "Melaky",
      url:"javascript:display('MELAKY')"
    },
    MDG5878: {
      name: "Menabe",
      url:"javascript:display('MENABE')"
    },
    MDG5879: {
      name: "Sava",
      url:"javascript:display('SAVA')"
    },
    MDG5880: {
      name: "Sofia",
      url:"javascript:display('SOFIA')"
    },
    MDG5881: {
      name: "Vakinankaratra",
      url:"javascript:display('VAKINANKARATRA')"
    },
    MDG5882: {
      name: "Vatovavy-Fitovinany",
      url:"javascript:display('VATOVAVY FITOVINANY')"
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

function display(region){

var baseUrl = "http://localhost:8082/dhis";
var urlApiLocaliteRegion ="/api/29/sqlViews/JAkLC7pQ9Rh/data.json?filter=region:eq:"+region;
var urlApiPopulation = "/api/29/reportTables/DC9K5bE5R0V/data.json";
var urlApiPdo = "/api/29/reportTables/NhvjNa80E2A/data.json";
var urlApiMenage="/api/29/reportTables/mEFulIuUkub/data.json";
var urlApiTaux="/api/29/reportTables/rEaNzYMDXoS/data.json";
var urlApiPopulationDesservi="/api/29/reportTables/TyMqKZhi1a3/data.json";
var urlApiMenageDesservi="/api/29/reportTables/IfynXuKRyV1/data.json";


  $.ajax({
        type: 'GET',
        url: baseUrl+urlApiMenageDesservi,
        crossDomain: true, 
        datatype:'json',
        headers: {
            'Authorization': "Basic " + btoa("admin:district"),
            'Content-type':'json'
        },
        success: function (data) {
              var width = data['width'];
              var height = data['height'];
              var result = [];

               for (var x=0; x<height;x++){
                 var r = new Map();

               for (var i = 0; i < width; i++) {

                   r[data['headers'][i]['column']]=data['rows'][x][i];

                   if (data['rows'][x][i]==region){
                     result.push(r);
                   }
                  
                 }
               }

             
            let nombremenagedesservi= result[0]['Nbre de ménages ayant accès à l\'eau potable '];
            document.getElementById("menagedesservi").innerHTML="";
            var para = document.createElement("h3");                       // Create a <p> node
            var t = document.createTextNode(Number(nombremenagedesservi).toLocaleString());      // Create a text node
            para.appendChild(t);                                          // Append the text to <p>
            document.getElementById("menagedesservi").appendChild(para);
             
        }
    }); 


  $.ajax({
        type: 'GET',
        url: baseUrl+urlApiPopulationDesservi,
        crossDomain: true, 
        datatype:'json',
        headers: {
            'Authorization': "Basic " + btoa("admin:district"),
            'Content-type':'json'
        },
        success: function (data) {
            document.getElementById("population").appendChild(para);
             
        }
    });  


    $.ajax({
        type: 'GET',
        url: baseUrl+urlApiPdo,
        crossDomain: true, 
        datatype:'json',
        headers: {
            'Authorization': "Basic " + btoa("admin:district"),
            'Content-type':'json'
        },
        success: function (data) {
              var width = data['width'];
              var height = data['height'];
              var result = [];

               for (var x=0; x<height;x++){
                 var r = new Map();

               for (var i = 0; i < width; i++) {

                   r[data['headers'][i]['column']]=data['rows'][x][i];

                   if (data['rows'][x][i]==region){
                     result.push(r);
                   }
                  
                 }
               }
           
            let nombrepdo= result[0]['Nombre point d\'eau'];
            document.getElementById("pdo").innerHTML="";
            var para = document.createElement("h3");                       // Create a <p> node
            var t = document.createTextNode(Number(nombrepdo).toLocaleString());      // Create a text node
            para.appendChild(t);                                          // Append the text to <p>
            document.getElementById("pdo").appendChild(para);
             
        }
    }); 


    $.ajax({
        type: 'GET',
        url: baseUrl+urlApiTaux,
        crossDomain: true, 
        datatype:'json',
        headers: {
            'Authorization': "Basic " + btoa("admin:district"),
            'Content-type':'json'
        },
        success: function (data) {
              var width = data['width'];
              var height = data['height'];
              var result = [];

               for (var x=0; x<height;x++){
                 var r = new Map();

               for (var i = 0; i < width; i++) {

                   r[data['headers'][i]['column']]=data['rows'][x][i];

                   if (data['rows'][x][i]==region){
                     result.push(r);
                   }
                  
                 }
               }
           
            let taux= result[0]['taux d\'accès à l\'eau potable enquête localite'];
            document.getElementById("tauxacces").innerHTML="";
            var para = document.createElement("h3");                       // Create a <p> node
            var t = document.createTextNode(Number(taux).toLocaleString());      // Create a text node
            para.appendChild(t);
            var p= document.createElement("small");
            var f =document.createTextNode('%');
            p.appendChild(f);
            para.appendChild(p);                                              // Append the text to <p>
            document.getElementById("tauxacces").appendChild(para);
             
        }
    }); 


       $.ajax({
        type: 'GET',
        url: baseUrl+urlApiMenage,
        crossDomain: true, 
        datatype:'json',
        headers: {
            'Authorization': "Basic " + btoa("admin:district"),
            'Content-type':'json'
        },
        success: function (data) {
              var width = data['width'];
              var height = data['height'];
              var result = [];

               for (var x=0; x<height;x++){
                 var r = new Map();

               for (var i = 0; i < width; i++) {

                   r[data['headers'][i]['column']]=data['rows'][x][i];

                   if (data['rows'][x][i]==region){
                     result.push(r);
                   }
                  
                 }
               }
           
            let nombremenage= result[0]['Menage'];
            document.getElementById("menage").innerHTML="";
            var para = document.createElement("h3");                       // Create a <p> node
            var t = document.createTextNode(Number(nombremenage).toLocaleString());      // Create a text node
            para.appendChild(t);                                          // Append the text to <p>
            document.getElementById("menage").appendChild(para);
             
        }
    }); 
   

 

}
 