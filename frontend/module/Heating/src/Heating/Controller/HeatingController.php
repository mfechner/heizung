<?php
namespace Heating\Controller;

use Zend\View\Model\JsonModel;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HeatingController extends AbstractActionController {
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function getEntityManager() {
        if(null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction() {
        return new ViewModel(array(

        ));
    }
    public function getAction() {
        $em=$this->getEntityManager();
        
        $queryStart = "w.timestamp";
        $overviewQuery = ",w.firmwareversion
                   ,w.FirmwareDate
                   ,w.operatingstate
                   ,w.outdoortemp
                   ,w.outdoortemp1h
                   ,w.outdoortemp24h
                   ,w.coolreturntempnominal
                   ,w.coolreturntemp
                   ,w.heatreturntempnominal
                   ,w.heatreturntemp
                   ,w.flowtemp
                   ,w.domesticwatertempnominal
                   ,w.domesticwatertempactual
                   ,w.roomtemp
                   ,w.roomtemp1h
                   ,w.roomtempnominal
                   ,w.heatsourcein
                   ,w.heatsourceout
                   ,w.evaporationtemp
                   ,w.evaporationpress
    			   ,w.condensationtemp
                   ,w.condensationpress
    		       ,w.sunctiongastemp
                   ,w.rtctime
                   ,w.rtcdate
                   ,w.ohcompressor1
                   ,w.pooltempnominal
                   ,w.pooltempactual
                   ,w.solartempactual
                   ,w.solartempnominalmin
                   ,w.heatingcircuitnominal
                   ,w.heatingcircuittemp
                   ,w.dobuffer
                   ,w.dibuffer
                   ,w.pelectric
                   ,w.pthermal
                   ,w.cop";
        
        $heatingQuery = ",w.heatoff
				,w.heattimeon
				,w.heattimeoff
				,w.heatcharacteristicsetpoint
				,w.heatcharacteristicsetpointbasetemp
				,w.heatcharacteristicgradient
				,w.heatcharacteristiclimit
				,w.heatreturntemp
				,w.heatreturntempnominal
				,w.heattemphyst
				,w.roomtempnominal
				,w.roomtempfactor
				,w.heatincreaseoff
				,w.heatincreasetimeon
				,w.heatincreasetimeoff
				,w.heatincreasesetptoffset
				,w.auxilarymodeheating
				,w.auxilarymaxdifference";
        
        $coolingQuery = " ,w.cooloff
                ,w.cooltimeon
                ,w.cooltimeoff
                ,w.coolcharacteristicsetpoint
                ,w.coolreturntemp
                ,w.coolreturntempnominal
                ,w.coolreturntemphyst";
        
        $hotwaterQuery = ",w.domesticwateroff
				,w.domesticwatertimeon
				,w.domesticwatertimeoff
				,w.domesticwatertempactual
				,w.domesticwatertempnominal
				,w.domesticwatertemphyst
				,w.legionellaschedule
				,w.legionellatimeon
				,w.legionellatimeoff
				,w.legionellatempnominal
				,w.dwnumberofcompressors
				,w.domesticwatertimedelayonsolar";
        
        $qb =$em->createQueryBuilder();
        $qb->select($queryStart.$overviewQuery.$heatingQuery.$coolingQuery.$hotwaterQuery)
            ->from("Heating\\Entity\\WpData", "w")
            ->orderBy("w.id", "DESC")
            ->setMaxResults(1);
        $query=$qb->getQuery();
        $result = new JsonModel($query->getArrayResult()[0]);
        return $result;
    }
}