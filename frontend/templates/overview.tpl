<html>
<head>
    <title>W&auml;rmepumpen-Monitor &Uuml;bersicht</title>
    <meta name="robots" content="noindex">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="/css/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="/css/styles.css" type="text/css">
</head>
<body>
    <script type="text/javascript" src="/js/jquery-2.0.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="/js/general.js">
    </script>
    <div id="diagram">
        <img src="/img/thome.gif" class="picture" id="home">
        <img src="img/ds_std.gif" class="picture" id="background">
    <!-- Temperatures -->
        <div id="OutdoorTemp"><span id="description">T<sub>A</sub></span><span class="blackText" id="value"></span></div>
        <div id="OutdoorTemp1h"><span id="description">T<sub>A1h</sub></span><span class="blackText" id="value"></span></div>
        <div id="OutdoorTemp24h"><span id="description">T<sub>A24h</sub></span><span class="blackText" id="value"></span></div>
        <div id="RoomTemp"><span id="description">T<sub>Raum</sub></span><span class="blackText" id="value"></span></div>
        <div id="RoomTemp1h"><span id="description">T<sub>Raum 1h</sub></span><span class="blackText" id="value"></span></div>
        <div id="RoomTempNominal"><span id="description">T<sub>Raum-Soll</sub></span><span class="targetText" id="value"></span></div>
    <!-- General -->
        <div id="RTCDate"><span id="description">Date</span><span class="blackText" id="value"></div>
        <div id="RTCTime"><span id="description">Time</span><span class="blackText" id="value"></div>
        <div id="FirmwareVersion"><span id="description">Firmware</span><span class="blackText" id="value"></div>
        <div id="FirmwareDate"><span id="description">F. Date</span><span class="blackText" id="value"></div>
    <!-- Heatsource -->
        <div id="HeatSourceIn"><span class="redText" id="value"></span></div>
        <div id="HeatSourceOut"><span class="blueText" id="value"></span></div>
        <div id="iconPumpHeatSource"><img alt="" src="/img/pump_90rgb.ico"></div>
    <!-- Condensator -->
        <div id="CondensationTemp"><span class="redText" id="value"></span></div>
        <div id="CondensationPress"><span class="redText" id="value"></span></div>
    <!-- Middle -->
        <div id="SunctionGasTemp"><span class="blackText" id="value"></span></div>
        <div id="OHCompressor1"><span class="blackText" id="value"></span></div>
        <div id="iconCompressor1"><img alt="" src="/img/refrig_0rgb.ico"></div>
        <div id="iconMagnetValve"><img alt="" src="/img/valve_magn_0rgb.ico"></div>
    <!-- Evaporator -->
        <div id="EvaporationTemp"><span class="blueText" id="value"></span></div>
        <div id="EvaporationPress"><span class="blueText" id="value"></span></div>
    <!-- HeatTarget -->
        <div id="FlowTemp"><span class="redText" id="value"></span></div>
        <div id="HeatReturnTemp2"><span class="blueText" id="value"></span></div>
        <div id="iconPumpHeating"><img alt="" src="/img/pump_180rgb.ico"></div>
    <!--  Consumption -->
        <div class="blackText" id="Pelectric"><span id="description">Electrical (P<sub>el</sub>)</span><span id="value"></div>
        <div class="blackText" id="Pthermal"><span id="description">Termal (P<sub>th</sub>)</span><span id="value"></div>
        <div class="blackText" id="COP"><span id="description">Efficiency (COP)</span><span id="value"></div>
    <!-- Status and Values -->
        <div id="iconCooling"><img alt="" src="/img/cool_32x32_inactive.ico"></div>
        <div class="targetText" id="CoolReturnTempNominal"><span id="value"></span></div>
        <div class="blackText" id="CoolReturnTemp"><span id="value"></span></div>

        <div id="iconHeating"><img alt="" src="/img/heat_32x32_inactive.ico"></div>
        <div class="targetText" id="HeatReturnTempNominal"><span id="value"></span></div>
        <div class="blackText" id="HeatReturnTemp"><span id="value"></span></div>

        <div id="iconDomesticWater"><img alt="" src="/img/hw_32x32_inactive.ico"></div>
        <div class="targetText" id="DomesticWaterTempNominal"><span id="value"></span></div>
        <div class="blackText" id="DomesticWaterTempActual"><span id="value"></span></div>
        
        <div id="iconPool"><img alt="" src="/img/pool_32x32_inactive.ico"></div>
        <div class="targetText" id="PoolTempNominal"><span id="value"></span></div>
        <div class="blackText" id="PoolTempActual"><span id="value"></span></div>

        <div id="iconSolar"><img alt="" src="/img/solar_32x32_inactive.ico"></div>
        <div class="targetText" id="SolarTempNominalMin"><span id="value"></span></div>
        <div class="blackText" id="SolarTempActual"><span id="value"></span></div>

        <div id="icon3way"><img alt="" src="/img/3way_32x32_inactive.ico"></div>
        <div class="targetText" id="HeatingCircuitNominal"><span id="value"></span></div>
        <div class="blackText" id="HeatingCircuitTemp"><span id="value"></span></div>
    <!-- Date and Time Selector -->
        <div id="dateTimeField"><span id="description">Date/Time</span><span><input type="text" id="dateTimePicker"></span></div>
    </div>
</body>
</html>
