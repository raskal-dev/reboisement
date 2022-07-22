/* Copyright 2021, SimpleMaps, http://simplemaps.com
 Released under MIT license - https://opensource.org/licenses/MIT 
 Requires SimpleMaps version 3.5+
 */ 
(function(plugin){

  //End helper functions
  var api_object={
      map: false,
			instructions: "Choose a Country..."
  }
    
  window[plugin]=api_object;   

	$(document).ready(function(){
		setTimeout(function(){ //gives map time to initialize first
		
			var me = api_object;	
			var map = me.map ? me.map : window['simplemaps_worldmap']; //worldmap is default			
			var state_list = $("#state_list");
			state_list.attr('data-placeholder', me.instructions);
			state_list.append($("<option></option>"));
			state_list.append($("<option></option>").attr("value", '-1').text('----------- Zoom out -----------'));
			for (var state in map.mapdata.state_specific){
				var key = state;
				var value = map.mapdata.state_specific[state].name;
				 state_list.append($("<option></option>").attr("value",key).text(value)); 
			}						
			state_list.chosen();
			state_list.change(function(){
				var id=$(this).val();
				if (id == "-1"){map.back();}
				else{
					map.state_zoom(id);
				}
			});					
		
			map.hooks.back=function(){
				$("#state_list").val(''); //When you zoom out, reset the select
				$("#state_list").trigger("chosen:updated"); //update chosen
			}
		}, 10);
	
	})

})('simplemaps_search'); //change plugin name to use across multiple maps on the same page
