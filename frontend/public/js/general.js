$(document).ready(function() {
	refreshCaptions();
	refreshValues();
	window.setInterval(refreshValues, 60000);
	$( "#dateTimePicker" ).datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'HH:mm',
		onSelect: function (dateTime, inst) {
			refreshValues();
		}
	});
	$('.edit').editable('/save.php', {
		indicator: 'Saving...',
		tooltip: 'Click to edit...',
		"submitdata": function (value, settings) {
		      return {
		           "oldValue": this.revert
		      };
		 }
	});
	$("#tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
	$("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");
	
});

function refreshCaptions() {
	console.log("Retrieve description json string");
	$.ajax({
		url: "config.json",
		type: "GET",
		dataType: "json",
		success: function(json) {
			updateCaptions(json);
		}
	});
}

function updateCaptions(json) {
	console.log("Update captions");
	for(var key in json) {
		if(json[key]["caption"]) {
			$("#"+key+" #description").html(json[key]["caption"]);
		}
		if(json[key]["webcaption"]) {
			$("#"+key+" #description_short").html(json[key]["webcaption"]);
		}
	}
}

function refreshValues() {
	var dateTime= $( "#dateTimePicker").val();
	console.log("date:" + dateTime);
	var url = this.location.pathname;
	var filename = url.substring(url.lastIndexOf('/')+1);
	$.ajax({
		// the URL for the request
		url : "post.php",
		// the data to send (will be converted to a query string)
		data : {
			action : filename,
			START: dateTime
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
			alert("Could not retrieve data for selected date/time!");
		},
		// code to run regardless of success or failure
		complete : function(xhr, status) {
			//alert("The request is complete!");
		}
	});

	
}

function updateValues(json) {
	for(var key in json) {
		$("#"+key+" #"+key).html(json[key]);
	}
	if(json.HeatReturnTemp) {
		$("#HeatReturnTemp2 #HeatReturnTemp2").html(json.HeatReturnTemp);
	}
	
	if(json.OperatingState & 0x1) { // Warmwasser
		$("#iconDomesticWater img").attr("src", "/img/hw_32x32_active.ico");
	} else {
		$("#iconDomesticWater img").attr("src", "/img/hw_32x32_inactive.ico");
	}
	if(json.OperatingState & 0x2) { // Heizen
		$("#iconHeating img").attr("src", "/img/heat_32x32_active.ico");
	} else {
		$("#iconHeating img").attr("src", "/img/heat_32x32_inactive.ico");
	}
	if(json.OperatingState & 0x4) { // Beckenwasser
		$("#iconPool img").attr("src", "/img/pool_32x32_active.ico");
	} else {
		$("#iconPool img").attr("src", "/img/pool_32x32_inactive.ico");
	}
	if(json.OperatingState & 0x8) { // Naturkühlung
		$("#iconCooling img").attr("src", "/img/cool_32x32_active.ico");
	} else {
		$("#iconCooling img").attr("src", "/img/cool_32x32_inactive.ico");
	}
	if(json.OperatingState & 0x10) { // Kompressor aktiv
		$("#iconCompressor1 img").attr("src", "/img/refrig_0_g_.ico");
	} else {
		$("#iconCompressor1 img").attr("src", "/img/refrig_0rgb.ico");
	}
	if(json.OperatingState & 0x20) { // Stufe 2
	} else {
	}
	if(json.OperatingState & 0x40) { // Solar
	} else {
	}
	

	if(json.DOBuffer & 0x1) { // Kompressor 1
	}
	if(json.DOBuffer & 0x2) { // Kompressor 2
	}
	if(json.DOBuffer & 0x4) { // Heizungspumpe
		$("#iconPumpHeating img").attr("src", "/img/pump_180_g_.ico");
	} else {
		$("#iconPumpHeating img").attr("src", "/img/pump_180rgb.ico");
	}
	if(json.DOBuffer & 0x8) { // Magnetventil
		$("#iconMagnetValve img").attr("src", "/img/valve_magn_0_g_.ico");
	} else {
		$("#iconMagnetValve img").attr("src", "/img/valve_magn_0rgb.ico");
	}
	if(json.DOBuffer & 0x10) { // Alarm
	} else {
	}
	if(json.DOBuffer & 0x20) { // Motorventil Naturkühlung
	} else {
	}
	if(json.DOBuffer & 0x40) { // Motorventil Warmwasser
	} else {
	}
	if(json.DOBuffer & 0x80) { // Pumpe Quelle
		$("#iconPumpHeatSource img").attr("src", "/img/pump_90_g_.ico");
	} else {
		$("#iconPumpHeatSource img").attr("src", "/img/pump_90rgb.ico");
	}
	if(json.DOBuffer & 0x100) { // Ventil Pool
	} else {
	}
	if(json.DOBuffer & 0x200) { // Solarbetrieb
	} else {
	}

	if(json.DIBuffer & 0x1) { // Externe Abschaltung
	}
	if(json.DIBuffer & 0x2) { // SM Kompressor 2 / Stufe 2
	}
	if(json.DIBuffer & 0x4) { // Freigabe Beckenwasser
	}
	if(json.DIBuffer & 0x8) { // SM PhaseDrehfeld
	}
	if(json.DIBuffer & 0x10) { // SM Pumpe Quelle
	}
	if(json.DIBuffer & 0x20) { // SM Hd Pressostat
	}
	if(json.DIBuffer & 0x40) { // SM Nd Pressostat
	}
	if(json.DIBuffer & 0x80) { // SM Kompressor 1
	}

}
