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
    <script type="text/javascript" src="/js/jquery.jeditable.mini.js"></script>
    <script type="text/javascript" src="/js/general.js">
    </script>
    <div id="diagram">
        <img src="/img/thome.gif" class="picture" id="home">
        <img src="img/ds_std.gif" class="picture" id="background">
    <!-- Temperatures -->
        <div id="OutdoorTemp"><span id="description_short"></span><span class="value blackText" id="OutdoorTemp"></span></div>
        <div id="OutdoorTemp1h"><span id="description_short"></span><span class="value blackText" id="OutdoorTemp1h"></span></div>
        <div id="OutdoorTemp24h"><span id="description_short"></span><span class="value blackText" id="OutdoorTemp24h"></span></div>
        <div id="RoomTemp"><span id="description_short"></span><span class="value blackText" id="RoomTemp"></span></div>
        <div id="RoomTemp1h"><span id="description_short"></span><span class="value blackText" id="RoomTemp1h"></span></div>
        <div id="RoomTempNominal"><span id="description_short"></span><span class="value redText edit" id="RoomTempNominal"></span></div>
    <!-- General -->
        <div id="RTCDate"><span id="description"></span><span class="value blackText" id="RTCDate"></div>
        <div id="RTCTime"><span id="description"></span><span class="value blackText" id="RTCTime"></div>
        <div id="FirmwareVersion"><span id="description_short"></span><span class="value blackText" id="FirmwareVersion"></div>
        <div id="FirmwareDate"><span id="description_short"></span><span class="value blackText" id="FirmwareDate"></div>
    <!-- Heatsource -->
        <div id="HeatSourceIn"><span class="value redText" id="HeatSourceIn"></span></div>
        <div id="HeatSourceOut"><span class="value blueText" id="HeatSourceOut"></span></div>
        <div id="iconPumpHeatSource"><img alt="" src="/img/pump_90rgb.ico"></div>
    <!-- Condensator -->
        <div id="CondensationTemp"><span class="value redText" id="CondensationTemp"></span></div>
        <div id="CondensationPress"><span class="value redText" id="CondensationPress"></span></div>
    <!-- Middle -->
        <div id="SunctionGasTemp"><span class="value blackText" id="SunctionGasTemp"></span></div>
        <div id="OHCompressor1"><span class="value blackText" id="OHCompressor1"></span></div>
        <div id="iconCompressor1"><img alt="" src="/img/refrig_0rgb.ico"></div>
        <div id="iconMagnetValve"><img alt="" src="/img/valve_magn_0rgb.ico"></div>
    <!-- Evaporator -->
        <div id="EvaporationTemp"><span class="value blueText" id="EvaporationTemp"></span></div>
        <div id="EvaporationPress"><span class="value blueText" id="EvaporationPress"></span></div>
    <!-- HeatTarget -->
        <div id="FlowTemp"><span class="value redText" id="FlowTemp"></span></div>
        <div id="HeatReturnTemp2"><span class="blueText" id="HeatReturnTemp2"></span></div>
        <div id="iconPumpHeating"><img alt="" src="/img/pump_180rgb.ico"></div>
    <!--  Consumption -->
        <div class="blackText" id="Pelectric"><span id="description"></span><span id="Pelectric"></div>
        <div class="blackText" id="Pthermal"><span id="description"></span><span id="Pthermal"></div>
        <div class="blackText" id="COP"><span id="description"></span><span id="COP"></div>
    <!-- Status and Values -->
        <div id="iconCooling"><img alt="" src="/img/cool_32x32_inactive.ico"></div>
        <div class="value targetText" id="CoolReturnTempNominal"><span class="edit" id="CoolReturnTempNominal"></span></div>
        <div class="value blackText" id="CoolReturnTemp"><span id="CoolReturnTemp"></span></div>

        <div id="iconHeating"><img alt="" src="/img/heat_32x32_inactive.ico"></div>
        <div class="value targetText" id="HeatReturnTempNominal"><span class="" id="HeatReturnTempNominal"></span></div>
        <div class="value blackText" id="HeatReturnTemp"><span id="HeatReturnTemp"></span></div>

        <div id="iconDomesticWater"><img alt="" src="/img/hw_32x32_inactive.ico"></div>
        <div class="value targetText" id="DomesticWaterTempNominal"><span class="edit" id="DomesticWaterTempNominal"></span></div>
        <div class="value blackText" id="DomesticWaterTempActual"><span id="DomesticWaterTempActual"></span></div>
        
        <div id="iconPool"><img alt="" src="/img/pool_32x32_inactive.ico"></div>
        <div class="value targetText" id="PoolTempNominal"><span class="edit" id="PoolTempNominal"></span></div>
        <div class="value blackText" id="PoolTempActual"><span id="PoolTempActual"></span></div>

        <div id="iconSolar"><img alt="" src="/img/solar_32x32_inactive.ico"></div>
        <div class="value targetText" id="SolarTempNominalMin"><span class="edit" id="SolarTempNominalMin"></span></div>
        <div class="value blackText" id="SolarTempActual"><span id="SolarTempActual"></span></div>

        <div id="icon3way"><img alt="" src="/img/3way_32x32_inactive.ico"></div>
        <div class="value targetText" id="HeatingCircuitNominal"><span class="edit" id="HeatingCircuitNominal"></span></div>
        <div class="value blackText" id="HeatingCircuitTemp"><span id="HeatingCircuitTemp"></span></div>
    <!-- Date and Time Selector -->
        <div id="dateTimeField"><span id="description">Date/Time</span><span><input type="text" id="dateTimePicker"></span></div>
    </div>
</body>
</html>
