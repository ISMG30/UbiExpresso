<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Wialon Playground - Track layer</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="https://hst-api.wialon.com/wsdk/script/wialon.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">    
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body >
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.2/leaflet.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.2/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <link rel="stylesheet" href="../styles/map.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="styles.css">
<div class="d-flex">
  <div id="sidebar">
	<div class="contenedor columna"> 
			<ul class="list-group">

			Unidades: <select class=" btn btn-secondary Yelow" id="units"><option>Unidades</option></select>
		
			Select track color:<select class="btn btn-secondary dropdown-toggle"  href="#" id="color">
				<option value="ff0000">Red</option>
				<option value="00ff00">Green</option>
				<option value="0000ff">Blue</option>
				<option value="808000">Olive</option>
				<option value="800080">Purple</option>
				<option value="ffff00">Yelow</option>
				<option value="800000">Maroon</option>
				<option value="ffffff">White</option>
				<option value="000000">Black</option>
			</select>
			<!--<input class="btn btn-primary btn-sm" id="build" type="button" value="Ejecutar">-->
			<div style="text-align: center;" >
			<button type ="button" class="btn btn-secondary"   style="--bs-btn-padding-y: .50rem; --bs-btn-padding-x: .70rem; --bs-btn-font-size: .90rem;" id="build" value="Ejecutae">Ejecutar</button>
			
			<br>
			
			</ul>
	<div>
		Consulta de ruta<input class="contenedor" type="datetime-local" id="fecha" value="15-12-2022 09:00 a.m."></input>
	</div>
	
	</div>
		<ul class="list-grup">
			<div class="contenedor  column"> 
				<table id="tracks">
					<thead>
					<td>Unidad</td>
					<td>Informacion</td>
					<td>Color</td>
					<td>Eliminar</td>
					</thead>
				</table>
				
			</div>
			
			
		</ul>
</div>
	<div id="log"></div>
		  
    	<!--<div class="contenedorm columnam" id="map" ></div>-->	
		<div class="content w-100">
			  <div class="container-xl">
				<section class="p-3">
				<div class="container">
					<div class="row">
					<div class="col-md-12">
						<div class="conten" id="map" ></div>
					</div>
					</div>
				</div>
				</section>
	</div>
</div> 
      
</body >

    <script  type="text/javascript"  >
		
  var map, markers = {}, tile_layer, layers = {}; // global variables

// Print message to log
function msg(text) {
	  alert(text);
	  ("#log").prepend(text + "<br/>"); }

		
function init() { // Execute after login succeed
	var sess = wialon.core.Session.getInstance(), // get instance of current Session
		flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage, // specify what kind of data should be returned
		renderer = wialon.core.Session.getInstance().getRenderer();
	
	renderer.addListener("changeVersion", update_renderer);
	sess.loadLibrary("itemIcon"); // load Icon Library 
	
	sess.updateDataFlags( // load items to current session
	    [{type: "type", data: "avl_unit", flags: flags, mode: 0}], // Items specification
	    function (code) { // updateDataFlags callback
		    if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			
		    var units = sess.getItems("avl_unit"); // get loaded 'avl_resource's items
		    if (!units || !units.length){ msg("No se encontraron unidades"); return; } // check if units found
		    for (var i = 0; i< units.length; i++) // construct Select list using found resources
			    $("#units").append("<option value='"+ units[i].getId() +"'>"+ units[i].getName()+ "</option>");
		    $("#build").click( show_track );  // bind action to select change event
			$("#tracks").on("click", ".close_btn", delete_track); //click, when need delete current track
			$("#tracks").on("click", ".unit", focus_track); //click, when need to see any track
	});
}

function show_track() {
	
    var unit_id = $("#units").val(),
	  fecha = $("#fecha").val(),
      sess = wialon.core.Session.getInstance(), // get instance of current Session	
      renderer = sess.getRenderer(),
      cur_day = new Date(fecha),
      from = Math.round(new Date(cur_day.getFullYear(), cur_day.getMonth(), cur_day.getDate()) /1000), // get begin time - beginning of day
      to = from + 3600 * 24 - 1, // end of day in seconds
      unit = sess.getItem(unit_id), // get unit by id
      color = $("#color").val() || "ffffff"; // track color
		if (!unit) return; // exit if no unit

		// check the existence info in table of such track 
		if (document.getElementById(unit_id))
		{
			msg("Ya tienes esta unidad.");
			return;
		}
      
		var pos = unit.getPosition(); // get unit position
		if(!pos) return; // exit if no position

		// callback is performed, when messages are ready and layer is formed
		callback =  qx.lang.Function.bind(function(code, layer) {
			if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			
			if (layer) { 
				var layer_bounds = layer.getBounds(); // fetch layer bounds
				if (!layer_bounds || layer_bounds.length != 4 || (!layer_bounds[0] && !layer_bounds[1] && !layer_bounds[2] && !layer_bounds[3])) // check all bounds terms
				    return;
				
				// if map existence, then add tile-layer and marker on it
				if (map) {
				   //prepare bounds object for map
				    var bounds = new L.LatLngBounds(
					L.latLng(layer_bounds[0],layer_bounds[1]),
					L.latLng(layer_bounds[2],layer_bounds[3])
				    );
				    map.fitBounds(bounds); // get center and zoom
				    // create tile-layer and specify the tile template
					if (!tile_layer)
						tile_layer = L.tileLayer(sess.getBaseUrl() + "/adfurl" + renderer.getVersion() + "/avl_render/{x}_{y}_{z}/"+ sess.getId() +".png", {zoomReverse: true, zoomOffset: -1}).addTo(map);
					else 
						tile_layer.setUrl(sess.getBaseUrl() + "/adfurl" + renderer.getVersion() + "/avl_render/{x}_{y}_{z}/"+ sess.getId() +".png");
				    // push this layer in global container
				    layers[unit_id] = layer;
				    // get icon
				    var icon = L.icon({ iconUrl: unit.getIconUrl(24) });
				    //create or get marker object and add icon in it
				    var marker = L.marker({lat: pos.y, lng: pos.x}, {icon: icon}).addTo(map);
				    
					marker.setLatLng({lat: pos.y, lng: pos.x}); // icon position on map
					marker.setIcon(icon); // set icon object in marker
					markers[unit_id] = marker;	    
				}
				// create row-string with data
				var row = "<tr id='" + unit_id + "'>";  
				// print message with information about selected unit and its position
				row += "<td class='unit'><img src='" + unit.getIconUrl(16) + "'/> " + unit.getName() + "</td>"; 
				row += "<td>Posición  " + pos.x + ", " + pos.y + "<br> Kilometraje " + layer.getMileage() + "</td>";
				row += "<td style='border: 10px solid #" + color + "'>     </td>";
				row += "<td class='close_btn'>x</td></tr>";
				//add info in table
				$("#tracks").append(row);
			}
	});
	// query params
	params = {
		"layerName": "route_unit_" + unit_id, // layer name
		"itemId": unit_id, // ID of unit which messages will be requested
		"timeFrom": from, //interval beginning
		"timeTo": to, // interval end
		"tripDetector": 0, //use trip detector: 0 - no, 1 - yes
		"trackColor": color, //track color in ARGB format (A - alpha channel or transparency level)
		"trackWidth": 5, // track line width in pixels
		"arrows": 0, //show course of movement arrows: 0 - no, 1 - yes
		"points": 1, // show points at places where messages were received: 0 - no, 1 - yes
		"pointColor": color, // points color
		"annotations": 0 //show annotations for points: 0 - no, 1 - yes
	};
	renderer.createMessagesLayer(params, callback);
}

function update_renderer () {
	var sess = wialon.core.Session.getInstance(),
		renderer = sess.getRenderer();
	if (tile_layer && tile_layer.setUrl)
		tile_layer.setUrl(sess.getBaseUrl() + "/adfurl" + renderer.getVersion() + "/avl_render/{x}_{y}_{z}/" + sess.getId() + ".png"); // update url-mask in tile-layer
}

function focus_track (evt) {
	var row = evt.target.parentNode, // get row with data by target parentNode
		unit_id = row.id; // get unit id from current row
	// get bounds for map
	if (layers && layers[unit_id])
		var bounds =  layers[unit_id].getBounds();
	if (bounds && map)
	{
		// create object with need params
		var map_bounds = new L.LatLngBounds(
			L.latLng(bounds[0],bounds[1]),
			L.latLng(bounds[2],bounds[3])
		);
		// set view in geting bounds
		map.fitBounds(map_bounds); // get center and zoom
	}
}

function delete_track (evt) {
	var row = evt.target.parentNode, // get row with data by target parentNode
		unit_id = row.id, // get unit id from current row
		sess = wialon.core.Session.getInstance(),
		renderer = sess.getRenderer();
	if (layers && layers[unit_id])
	{
		// delete layer from renderer
		renderer.removeLayer(layers[unit_id], function(code) { 
			if (code) 
				msg(wialon.core.Errors.getErrorText(code)); // exit if error code
			else 
				msg("Eliminar recorrido."); // else send message, then ok
		});
		delete layers[unit_id]; // delete layer from container
	}
	// move marker behind bounds
	if (map)
		map.removeLayer(markers[unit_id]);
	delete markers[unit_id];
	// remove row from info table
	$(row).remove();
}

function init_map() {
    // create a map in the "map" div, set the view to a given place and zoom 18°27'28.9"N 97°22'48.5"W
    map = L.map('map').setView([18.458067, -97.380115], 16);
	var sess = wialon.core.Session.getInstance(); // get instance of current Session	
    // add WebGIS tile layer
	L.tileLayer(sess.getBaseGisUrl("render") + "/gis_render/{x}_{y}_{z}/" + sess.getCurrUser().getId() + "/tile.png", {
		zoomReverse: true, 
		zoomOffset: -1
	}).addTo(map);
    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
maxZoom: 30
}).addTo(map);
}

// execute when DOM ready
$.ajax({
	 type:  'POST',
	 url: 'eje.php'
   })

$(document).ready(function () {

	
    
	
   /*$.ajax({
	url: '../config//conexionlogin.php?opcion = conexion ',
	data: parametros,
	type: 'post',

	columns:[
		{data: 'token'}
	 ]
   	});*/
  	wialon.core.Session.getInstance().initSession("http://local.ubiexpress.net"); // init session
    // For more info about how to generate token check
    // http://sdk.wialon.com/playground/demo/app_auth_token
	wialon.core.Session.getInstance().loginToken("9184acef7671d237a45f10b8cf35cb44C71D4D9829D2C22C5805B559B6D5A09A4CB65A11", "", // try to login
		function (code) { // login callback
		    // if error code - print error message
			if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
			//msg("Logged successfully");
            init_map();
            init(); // when login suceed then run init() function
	});
})
  </script>
</html>