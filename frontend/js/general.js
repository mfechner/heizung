$(document).ready(function() {
	refreshValues();
	window.setInterval(refreshValues, 60000);

});

function refreshValues() {
	$.ajax({
		// the URL for the request
		url : "post.php",
		// the data to send (will be converted to a query string)
		data : {
			action : 'overview',
			START: '2013-04-30 22:05:17'
		},
		// whether this is a POST or GET request
		type : "GET",
		// the type of data we expect back
		dataType : "json",
		// code to run if the request succeeds;
		// the response is passed to the function
		success : function(json) {
			updateValues(json);
		},
		// code to run if the request fails; the raw request and
		// status codes are passed to the function
		error : function(xhr, status) {
			alert("Sorry, there was a problem!");
		},
		// code to run regardless of success or failure
		complete : function(xhr, status) {
			//alert("The request is complete!");
		}
	});

	
}

function updateValues(json) {
	for(var key in json) {
		$("#"+key+" #value").html(json[key]);
	}
	$("#HeatReturnTemp2 #value").html(json.HeatReturnTemp);

	console.log("OperatingState: "+json.OperatingState);
	if(json.OperatingState.charAt(7) == 1) { // Warmwasser
		$("#iconDomesticWater img").attr("src", "/img/hw_32x32_active.ico");
	} else {
		$("#iconDomesticWater img").attr("src", "/img/hw_32x32_inactive.ico");
	}
	if(json.OperatingState.charAt(6) == 1) { // Heizen
		$("#iconHeating img").attr("src", "/img/heat_32x32_active.ico");
	} else {
		$("#iconHeating img").attr("src", "/img/heat_32x32_inactive.ico");
	}
	if(json.OperatingState.charAt(5) == 1) { // Beckenwasser
		$("#iconPool img").attr("src", "/img/pool_32x32_active.ico");
	} else {
		$("#iconPool img").attr("src", "/img/pool_32x32_inactive.ico");
	}
	if(json.OperatingState.charAt(4) == 1) { // Naturkühlung
		$("#iconCooling img").attr("src", "/img/cool_32x32_active.ico");
	} else {
		$("#iconCooling img").attr("src", "/img/cool_32x32_inactive.ico");
	}
	if(json.OperatingState.charAt(3) == 1) { // Kompressor aktiv
	} else {
	}
	if(json.OperatingState.charAt(2) == 1) { // Stufe 2
	} else {
	}
	if(json.OperatingState.charAt(1) == 1) { // Solar
	} else {
	}
	

	console.log("DOBuffer: "+json.DOBuffer);
	if(json.DOBuffer.charAt(0) == 1) { // Kompressor 1
		$("#iconCompressor1 img").attr("src", "/img/refrig_0_g_.ico");
	} else {
		$("#iconCompressor1 img").attr("src", "/img/refrig_0rgb.ico");
	}
	if(json.DOBuffer.charAt(1) == 1) { // Kompressor 2
	}
	if(json.DOBuffer.charAt(2) == 1) { // Heizungspumpe
		$("#iconPumpHeating img").attr("src", "/img/pump_180_g_.ico");
	} else {
		$("#iconPumpHeating img").attr("src", "/img/pump_180rgb.ico");
	}
	if(json.DOBuffer.charAt(3) == 1) { // Magnetventil
		$("#iconMagnetValve img").attr("src", "/img/valve_magn_0_g_.ico");
	} else {
		$("#iconMagnetValve img").attr("src", "/img/valve_magn_0rgb.ico");
	}
	if(json.DOBuffer.charAt(4) == 1) { // Alarm
	} else {
	}
	if(json.DOBuffer.charAt(5) == 1) { // Motorventil Naturkühlung
	} else {
	}
	if(json.DOBuffer.charAt(6) == 1) { // Motorventil Warmwasser
	} else {
	}
	if(json.DOBuffer.charAt(7) == 1) { // Pumpe Quelle
		$("#iconPumpHeatSource img").attr("src", "/img/pump_90_g_.ico");
	} else {
		$("#iconPumpHeatSource img").attr("src", "/img/pump_90rgb.ico");
	}
	if(json.DOBuffer.charAt(8) == 1) { // Ventil Pool
	} else {
	}
	if(json.DOBuffer.charAt(9) == 1) { // Solarbetrieb
	} else {
	}
	
}