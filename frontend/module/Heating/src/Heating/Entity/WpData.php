<?php

namespace Heating\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpData
 *
 * @ORM\Table(name="wp_data", indexes={@ORM\Index(name="wpdata_timestamp", columns={"timestamp"})})
 * @ORM\Entity
 */
class WpData
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime", nullable=false)
     */
    private $timestamp = 'CURRENT_TIMESTAMP';

    /**
     * @var float
     *
     * @ORM\Column(name="FailureTempFlow", type="float", precision=10, scale=0, nullable=false)
     */
    private $failuretempflow;

    /**
     * @var integer
     *
     * @ORM\Column(name="WarningsDiv", type="integer", nullable=false)
     */
    private $warningsdiv;

    /**
     * @var float
     *
     * @ORM\Column(name="PoolTempNominal", type="float", precision=10, scale=0, nullable=false)
     */
    private $pooltempnominal;

    /**
     * @var float
     *
     * @ORM\Column(name="SolarTempNominalMin", type="float", precision=10, scale=0, nullable=false)
     */
    private $solartempnominalmin;

    /**
     * @var float
     *
     * @ORM\Column(name="ReturnTempNominal", type="float", precision=10, scale=0, nullable=false)
     */
    private $returntempnominal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="AuxiliaryHeatMode", type="boolean", nullable=false)
     */
    private $auxiliaryheatmode;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatCharacteristicLimit", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatcharacteristiclimit;

    /**
     * @var float
     *
     * @ORM\Column(name="OHDomesticWaterCompressor", type="float", precision=10, scale=0, nullable=false)
     */
    private $ohdomesticwatercompressor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="HeatOff", type="boolean", nullable=false)
     */
    private $heatoff;

    /**
     * @var float
     *
     * @ORM\Column(name="PSourcePump", type="float", precision=10, scale=0, nullable=false)
     */
    private $psourcepump;

    /**
     * @var float
     *
     * @ORM\Column(name="Hysteresis", type="float", precision=10, scale=0, nullable=false)
     */
    private $hysteresis;

    /**
     * @var integer
     *
     * @ORM\Column(name="Pincode", type="integer", nullable=false)
     */
    private $pincode;

    /**
     * @var float
     *
     * @ORM\Column(name="OHCooling", type="float", precision=10, scale=0, nullable=false)
     */
    private $ohcooling;

    /**
     * @var float
     *
     * @ORM\Column(name="CondensationTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $condensationtemp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ModemType", type="boolean", nullable=false)
     */
    private $modemtype;

    /**
     * @var float
     *
     * @ORM\Column(name="OHCompressor2", type="float", precision=10, scale=0, nullable=false)
     */
    private $ohcompressor2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="PoolMaxRunTime", type="boolean", nullable=false)
     */
    private $poolmaxruntime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="RoomTempFactor", type="boolean", nullable=false)
     */
    private $roomtempfactor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SourcePumpPreRunPeriod", type="boolean", nullable=false)
     */
    private $sourcepumpprerunperiod;

    /**
     * @var float
     *
     * @ORM\Column(name="OHPoolCompressor", type="float", precision=10, scale=0, nullable=false)
     */
    private $ohpoolcompressor;

    /**
     * @var float
     *
     * @ORM\Column(name="ScreedTempNominal", type="float", precision=10, scale=0, nullable=false)
     */
    private $screedtempnominal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="HeatingUpScreed", type="boolean", nullable=false)
     */
    private $heatingupscreed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DomesticWaterTimeOff", type="time", nullable=false)
     */
    private $domesticwatertimeoff;

    /**
     * @var integer
     *
     * @ORM\Column(name="Failure", type="integer", nullable=false)
     */
    private $failure;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ServicePool", type="boolean", nullable=false)
     */
    private $servicepool;

    /**
     * @var boolean
     *
     * @ORM\Column(name="PoolTimeDelayOnSolar", type="boolean", nullable=false)
     */
    private $pooltimedelayonsolar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LegionellaTimeOn", type="time", nullable=false)
     */
    private $legionellatimeon;

    /**
     * @var boolean
     *
     * @ORM\Column(name="DWNumberOfCompressors", type="boolean", nullable=false)
     */
    private $dwnumberofcompressors;

    /**
     * @var integer
     *
     * @ORM\Column(name="WarningsOthers", type="integer", nullable=false)
     */
    private $warningsothers;

    /**
     * @var float
     *
     * @ORM\Column(name="Pelectric", type="float", precision=10, scale=0, nullable=false)
     */
    private $pelectric;

    /**
     * @var boolean
     *
     * @ORM\Column(name="AuxilaryModeHeating", type="boolean", nullable=false)
     */
    private $auxilarymodeheating;

    /**
     * @var float
     *
     * @ORM\Column(name="CondensationPress", type="float", precision=10, scale=0, nullable=false)
     */
    private $condensationpress;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureTempPool", type="float", precision=10, scale=0, nullable=false)
     */
    private $failuretemppool;

    /**
     * @var float
     *
     * @ORM\Column(name="OperatingHoursValue", type="float", precision=10, scale=0, nullable=false)
     */
    private $operatinghoursvalue;

    /**
     * @var float
     *
     * @ORM\Column(name="EvaporationPress", type="float", precision=10, scale=0, nullable=false)
     */
    private $evaporationpress;

    /**
     * @var boolean
     *
     * @ORM\Column(name="PoolOff", type="boolean", nullable=false)
     */
    private $pooloff;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatSourceOut", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatsourceout;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatTempHyst", type="float", precision=10, scale=0, nullable=false)
     */
    private $heattemphyst;

    /**
     * @var string
     *
     * @ORM\Column(name="DOManualOperatingModeOn", type="string", length=16, nullable=false)
     */
    private $domanualoperatingmodeon;

    /**
     * @var float
     *
     * @ORM\Column(name="SolarTempActual", type="float", precision=10, scale=0, nullable=false)
     */
    private $solartempactual;

    /**
     * @var string
     *
     * @ORM\Column(name="LCD_Display_Line_1", type="string", length=16, nullable=false)
     */
    private $lcdDisplayLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="WarningInMask", type="string", length=16, nullable=false)
     */
    private $warninginmask;

    /**
     * @var float
     *
     * @ORM\Column(name="OHDomesticWaterAuxilary", type="float", precision=10, scale=0, nullable=false)
     */
    private $ohdomesticwaterauxilary;

    /**
     * @var float
     *
     * @ORM\Column(name="DomesticWaterTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $domesticwatertemp;

    /**
     * @var integer
     *
     * @ORM\Column(name="SelectedValue", type="integer", nullable=false)
     */
    private $selectedvalue;

    /**
     * @var float
     *
     * @ORM\Column(name="OHHeatingCompressor", type="float", precision=10, scale=0, nullable=false)
     */
    private $ohheatingcompressor;

    /**
     * @var float
     *
     * @ORM\Column(name="SolarTempHyst", type="float", precision=10, scale=0, nullable=false)
     */
    private $solartemphyst;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SolarTimeOn", type="time", nullable=false)
     */
    private $solartimeon;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SolarOff", type="boolean", nullable=false)
     */
    private $solaroff;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ServiceAuxiliaryHeating", type="boolean", nullable=false)
     */
    private $serviceauxiliaryheating;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatingCircuitTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatingcircuittemp;

    /**
     * @var float
     *
     * @ORM\Column(name="OffsetPn", type="float", precision=10, scale=0, nullable=false)
     */
    private $offsetpn;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatCharacteristicGradient", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatcharacteristicgradient;

    /**
     * @var string
     *
     * @ORM\Column(name="LCD_Display_Line_2", type="string", length=16, nullable=false)
     */
    private $lcdDisplayLine2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SoftwareReset", type="boolean", nullable=false)
     */
    private $softwarereset;

    /**
     * @var boolean
     *
     * @ORM\Column(name="HeatingPumpPreRunPeriod", type="boolean", nullable=false)
     */
    private $heatingpumpprerunperiod;

    /**
     * @var string
     *
     * @ORM\Column(name="ManufSerialNum", type="string", length=16, nullable=false)
     */
    private $manufserialnum;

    /**
     * @var boolean
     *
     * @ORM\Column(name="NDStatus", type="boolean", nullable=false)
     */
    private $ndstatus;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatSourceIn", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatsourcein;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SolarTimeOff", type="time", nullable=false)
     */
    private $solartimeoff;

    /**
     * @var float
     *
     * @ORM\Column(name="CharacteristicGradient", type="float", precision=10, scale=0, nullable=false)
     */
    private $characteristicgradient;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatReturnTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatreturntemp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Ta", type="boolean", nullable=false)
     */
    private $ta;

    /**
     * @var boolean
     *
     * @ORM\Column(name="DomesticWaterTimeDelayOnSolar", type="boolean", nullable=false)
     */
    private $domesticwatertimedelayonsolar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="OperatingStartTime", type="time", nullable=false)
     */
    private $operatingstarttime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CoolTimeOn", type="time", nullable=false)
     */
    private $cooltimeon;

    /**
     * @var boolean
     *
     * @ORM\Column(name="CommMode", type="boolean", nullable=false)
     */
    private $commmode;

    /**
     * @var float
     *
     * @ORM\Column(name="OHHeatingAuxilary", type="float", precision=10, scale=0, nullable=false)
     */
    private $ohheatingauxilary;

    /**
     * @var string
     *
     * @ORM\Column(name="SetManufSerialNum", type="string", length=16, nullable=false)
     */
    private $setmanufserialnum;

    /**
     * @var string
     *
     * @ORM\Column(name="SetManufType", type="string", length=16, nullable=false)
     */
    private $setmanuftype;

    /**
     * @var float
     *
     * @ORM\Column(name="OHSolar", type="float", precision=10, scale=0, nullable=false)
     */
    private $ohsolar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DomesticWaterTimeOn", type="time", nullable=false)
     */
    private $domesticwatertimeon;

    /**
     * @var float
     *
     * @ORM\Column(name="Kp", type="float", precision=10, scale=0, nullable=false)
     */
    private $kp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="AutomaticOffDownUpSwitch", type="boolean", nullable=false)
     */
    private $automaticoffdownupswitch;

    /**
     * @var integer
     *
     * @ORM\Column(name="WarningsInput", type="integer", nullable=false)
     */
    private $warningsinput;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SolarSensor", type="boolean", nullable=false)
     */
    private $solarsensor;

    /**
     * @var float
     *
     * @ORM\Column(name="RoomTempNominal", type="float", precision=10, scale=0, nullable=false)
     */
    private $roomtempnominal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeatIncreaseTimeOn", type="time", nullable=false)
     */
    private $heatincreasetimeon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FailureTimeStampDATE", type="datetime", nullable=false)
     */
    private $failuretimestampdate;

    /**
     * @var float
     *
     * @ORM\Column(name="OutdoorTemp24h", type="float", precision=10, scale=0, nullable=false)
     */
    private $outdoortemp24h;

    /**
     * @var integer
     *
     * @ORM\Column(name="WarningsOutput", type="integer", nullable=false)
     */
    private $warningsoutput;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PoolTimeOff", type="time", nullable=false)
     */
    private $pooltimeoff;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ServiceDomesticWater", type="boolean", nullable=false)
     */
    private $servicedomesticwater;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatCharacteristicSetPointBaseTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatcharacteristicsetpointbasetemp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="CoolOff", type="boolean", nullable=false)
     */
    private $cooloff;

    /**
     * @var integer
     *
     * @ORM\Column(name="LngSelect", type="integer", nullable=false)
     */
    private $lngselect;

    /**
     * @var boolean
     *
     * @ORM\Column(name="NumberOfCompressors", type="boolean", nullable=false)
     */
    private $numberofcompressors;

    /**
     * @var boolean
     *
     * @ORM\Column(name="View", type="boolean", nullable=false)
     */
    private $view;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureTempOutdoor", type="float", precision=10, scale=0, nullable=false)
     */
    private $failuretempoutdoor;

    /**
     * @var integer
     *
     * @ORM\Column(name="ExtControlCode", type="integer", nullable=false)
     */
    private $extcontrolcode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="OperatingHoursSelector", type="boolean", nullable=false)
     */
    private $operatinghoursselector;

    /**
     * @var boolean
     *
     * @ORM\Column(name="PoolNumberOfCompressors", type="boolean", nullable=false)
     */
    private $poolnumberofcompressors;

    /**
     * @var string
     *
     * @ORM\Column(name="FirmwareDate", type="string", length=16, nullable=false)
     */
    private $firmwaredate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="HeatingPumpAfterRunPeriod", type="boolean", nullable=false)
     */
    private $heatingpumpafterrunperiod;

    /**
     * @var integer
     *
     * @ORM\Column(name="SelectedYear", type="integer", nullable=false)
     */
    private $selectedyear;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureTempDomesticWater", type="float", precision=10, scale=0, nullable=false)
     */
    private $failuretempdomesticwater;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SetDefaultSettings", type="boolean", nullable=false)
     */
    private $setdefaultsettings;

    /**
     * @var boolean
     *
     * @ORM\Column(name="CyclicMeasurementPeriod", type="boolean", nullable=false)
     */
    private $cyclicmeasurementperiod;

    /**
     * @var float
     *
     * @ORM\Column(name="CoolReturnTempHyst", type="float", precision=10, scale=0, nullable=false)
     */
    private $coolreturntemphyst;

    /**
     * @var float
     *
     * @ORM\Column(name="CharacteristicLimit", type="float", precision=10, scale=0, nullable=false)
     */
    private $characteristiclimit;

    /**
     * @var float
     *
     * @ORM\Column(name="PoolTempHyst", type="float", precision=10, scale=0, nullable=false)
     */
    private $pooltemphyst;

    /**
     * @var float
     *
     * @ORM\Column(name="SunctionGasTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $sunctiongastemp;

    /**
     * @var float
     *
     * @ORM\Column(name="RoomTemp1h", type="float", precision=10, scale=0, nullable=false)
     */
    private $roomtemp1h;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ServiceCooling", type="boolean", nullable=false)
     */
    private $servicecooling;

    /**
     * @var string
     *
     * @ORM\Column(name="ManufType", type="string", length=16, nullable=false)
     */
    private $manuftype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CoolTimeOff", type="time", nullable=false)
     */
    private $cooltimeoff;

    /**
     * @var float
     *
     * @ORM\Column(name="CoolCharacteristicSetPoint", type="float", precision=10, scale=0, nullable=false)
     */
    private $coolcharacteristicsetpoint;

    /**
     * @var float
     *
     * @ORM\Column(name="OHCompressor1", type="float", precision=10, scale=0, nullable=false)
     */
    private $ohcompressor1;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureTempSuctionGas", type="float", precision=10, scale=0, nullable=false)
     */
    private $failuretempsuctiongas;

    /**
     * @var float
     *
     * @ORM\Column(name="DomesticWaterTempNominal", type="float", precision=10, scale=0, nullable=false)
     */
    private $domesticwatertempnominal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Ringtones", type="boolean", nullable=false)
     */
    private $ringtones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeatIncreaseTimeOff", type="time", nullable=false)
     */
    private $heatincreasetimeoff;

    /**
     * @var float
     *
     * @ORM\Column(name="AuxilaryMaxDifference", type="float", precision=10, scale=0, nullable=false)
     */
    private $auxilarymaxdifference;

    /**
     * @var float
     *
     * @ORM\Column(name="FlowTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $flowtemp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="OperatingStopTime", type="time", nullable=false)
     */
    private $operatingstoptime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Tn", type="boolean", nullable=false)
     */
    private $tn;

    /**
     * @var float
     *
     * @ORM\Column(name="AuxiliaryHeatTempLimitSourceIn", type="float", precision=10, scale=0, nullable=false)
     */
    private $auxiliaryheattemplimitsourcein;

    /**
     * @var integer
     *
     * @ORM\Column(name="WarningOutMask", type="integer", nullable=false)
     */
    private $warningoutmask;

    /**
     * @var float
     *
     * @ORM\Column(name="OutdoorTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $outdoortemp;

    /**
     * @var integer
     *
     * @ORM\Column(name="Interruption", type="integer", nullable=false)
     */
    private $interruption;

    /**
     * @var float
     *
     * @ORM\Column(name="DomesticWaterTempActual", type="float", precision=10, scale=0, nullable=false)
     */
    private $domesticwatertempactual;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatReturnTempNominal", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatreturntempnominal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="DomesticWaterOff", type="boolean", nullable=false)
     */
    private $domesticwateroff;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureEvaporationTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $failureevaporationtemp;

    /**
     * @var float
     *
     * @ORM\Column(name="CoolReturnTempNominal", type="float", precision=10, scale=0, nullable=false)
     */
    private $coolreturntempnominal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ServiceSolar", type="boolean", nullable=false)
     */
    private $servicesolar;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureTempHeatSourceOut", type="float", precision=10, scale=0, nullable=false)
     */
    private $failuretempheatsourceout;

    /**
     * @var float
     *
     * @ORM\Column(name="SolarTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $solartemp;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureTempSolar", type="float", precision=10, scale=0, nullable=false)
     */
    private $failuretempsolar;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatCharacteristicSetPoint", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatcharacteristicsetpoint;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Refrigerant", type="boolean", nullable=false)
     */
    private $refrigerant;

    /**
     * @var float
     *
     * @ORM\Column(name="OffsetPh", type="float", precision=10, scale=0, nullable=false)
     */
    private $offsetph;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatIncreaseSetPtOffset", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatincreasesetptoffset;

    /**
     * @var float
     *
     * @ORM\Column(name="ReturnTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $returntemp;

    /**
     * @var float
     *
     * @ORM\Column(name="TimeScaler", type="float", precision=10, scale=0, nullable=false)
     */
    private $timescaler;

    /**
     * @var float
     *
     * @ORM\Column(name="SolarTempReturn", type="float", precision=10, scale=0, nullable=false)
     */
    private $solartempreturn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeatTimeOn", type="time", nullable=false)
     */
    private $heattimeon;

    /**
     * @var float
     *
     * @ORM\Column(name="OutdoorTemp1h", type="float", precision=10, scale=0, nullable=false)
     */
    private $outdoortemp1h;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureTempReturn", type="float", precision=10, scale=0, nullable=false)
     */
    private $failuretempreturn;

    /**
     * @var float
     *
     * @ORM\Column(name="EvaporationTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $evaporationtemp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ServiceMixer", type="boolean", nullable=false)
     */
    private $servicemixer;

    /**
     * @var float
     *
     * @ORM\Column(name="PowerValue", type="float", precision=10, scale=0, nullable=false)
     */
    private $powervalue;

    /**
     * @var integer
     *
     * @ORM\Column(name="WarningOthersMask", type="integer", nullable=false)
     */
    private $warningothersmask;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PoolTimeOn", type="time", nullable=false)
     */
    private $pooltimeon;

    /**
     * @var integer
     *
     * @ORM\Column(name="ADC_Error", type="integer", nullable=false)
     */
    private $adcError;

    /**
     * @var string
     *
     * @ORM\Column(name="FailureOperatingMode", type="string", length=16, nullable=false)
     */
    private $failureoperatingmode;

    /**
     * @var float
     *
     * @ORM\Column(name="CoolReturnTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $coolreturntemp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LegionellaTimeOff", type="time", nullable=false)
     */
    private $legionellatimeoff;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RTCTime", type="datetime", nullable=false)
     */
    private $rtctime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RTCDate", type="datetime", nullable=false)
     */
    private $rtcdate;

    /**
     * @var string
     *
     * @ORM\Column(name="FirmwareVersion", type="string", length=16, nullable=false)
     */
    private $firmwareversion;

    /**
     * @var float
     *
     * @ORM\Column(name="Pthermal", type="float", precision=10, scale=0, nullable=false)
     */
    private $pthermal;

    /**
     * @var float
     *
     * @ORM\Column(name="RoomTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $roomtemp;

    /**
     * @var float
     *
     * @ORM\Column(name="HeatingCircuitNominal", type="float", precision=10, scale=0, nullable=false)
     */
    private $heatingcircuitnominal;

    /**
     * @var integer
     *
     * @ORM\Column(name="FailureDIBuffer", type="integer", nullable=false)
     */
    private $failuredibuffer;

    /**
     * @var float
     *
     * @ORM\Column(name="COP", type="float", precision=10, scale=0, nullable=false)
     */
    private $cop;

    /**
     * @var boolean
     *
     * @ORM\Column(name="LegionellaSchedule", type="boolean", nullable=false)
     */
    private $legionellaschedule;

    /**
     * @var float
     *
     * @ORM\Column(name="PoolTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $pooltemp;

    /**
     * @var float
     *
     * @ORM\Column(name="CharacteristicSetPointBaseTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $characteristicsetpointbasetemp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="DOExtStatus", type="boolean", nullable=false)
     */
    private $doextstatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HeatTimeOff", type="time", nullable=false)
     */
    private $heattimeoff;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureCondensationTemp", type="float", precision=10, scale=0, nullable=false)
     */
    private $failurecondensationtemp;

    /**
     * @var integer
     *
     * @ORM\Column(name="WarningDivMask", type="integer", nullable=false)
     */
    private $warningdivmask;

    /**
     * @var integer
     *
     * @ORM\Column(name="FailureDOBuffer", type="integer", nullable=false)
     */
    private $failuredobuffer;

    /**
     * @var integer
     *
     * @ORM\Column(name="FailureAIError", type="integer", nullable=false)
     */
    private $failureaierror;

    /**
     * @var boolean
     *
     * @ORM\Column(name="HeatIncreaseOff", type="boolean", nullable=false)
     */
    private $heatincreaseoff;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FailureTimeStampTIME", type="datetime", nullable=false)
     */
    private $failuretimestamptime;

    /**
     * @var float
     *
     * @ORM\Column(name="FailureTempHeatSourceIn", type="float", precision=10, scale=0, nullable=false)
     */
    private $failuretempheatsourcein;

    /**
     * @var float
     *
     * @ORM\Column(name="LegionellaTempNominal", type="float", precision=10, scale=0, nullable=false)
     */
    private $legionellatempnominal;

    /**
     * @var float
     *
     * @ORM\Column(name="DomesticWaterTempHyst", type="float", precision=10, scale=0, nullable=false)
     */
    private $domesticwatertemphyst;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOBuffer", type="integer", nullable=false)
     */
    private $dobuffer;

    /**
     * @var integer
     *
     * @ORM\Column(name="OperatingState", type="integer", nullable=false)
     */
    private $operatingstate;

    /**
     * @var float
     *
     * @ORM\Column(name="PoolTempActual", type="float", precision=10, scale=0, nullable=false)
     */
    private $pooltempactual;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ServiceHeating", type="boolean", nullable=false)
     */
    private $serviceheating;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIBuffer", type="integer", nullable=false)
     */
    private $dibuffer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="HeatSourceMinT", type="boolean", nullable=false)
     */
    private $heatsourcemint;


}
